<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Modules\Lawyer\app\Models\Department;

echo "=== حذف الأقسام المتكررة ===\n\n";

try {
    DB::beginTransaction();
    
    // Get all departments with their Arabic translations
    $departments = DB::table('departments')
        ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
        ->where('department_translations.lang_code', 'ar')
        ->select('departments.id', 'departments.slug', 'department_translations.name', 'department_translations.department_id')
        ->orderBy('departments.id')
        ->get();
    
    echo "تم العثور على " . $departments->count() . " قسم\n\n";
    
    // Group departments by name (case-insensitive, trimmed)
    $grouped = [];
    foreach ($departments as $dept) {
        $normalizedName = trim(mb_strtolower($dept->name, 'UTF-8'));
        if (!isset($grouped[$normalizedName])) {
            $grouped[$normalizedName] = [];
        }
        $grouped[$normalizedName][] = $dept;
    }
    
    // Also check for similar names (one contains the other)
    $similarGroups = [];
    $deptArray = $departments->toArray();
    foreach ($deptArray as $i => $dept1) {
        $name1 = trim(mb_strtolower($dept1->name, 'UTF-8'));
        foreach ($deptArray as $j => $dept2) {
            if ($i >= $j) continue; // Skip same or already checked
            
            $name2 = trim(mb_strtolower($dept2->name, 'UTF-8'));
            
            // Check if one name contains the other (and they're not identical)
            if ($name1 !== $name2) {
                // Remove common words for better matching
                $cleanName1 = preg_replace('/\b(قانون|law)\b/ui', '', $name1);
                $cleanName2 = preg_replace('/\b(قانون|law)\b/ui', '', $name2);
                $cleanName1 = trim(preg_replace('/\s+/', ' ', $cleanName1));
                $cleanName2 = trim(preg_replace('/\s+/', ' ', $cleanName2));
                
                // Check if one contains the other (after cleaning)
                if (strlen($cleanName1) > 3 && strlen($cleanName2) > 3) {
                    if (strpos($cleanName1, $cleanName2) !== false || strpos($cleanName2, $cleanName1) !== false) {
                        // They are similar
                        $key = min($name1, $name2);
                        if (!isset($similarGroups[$key])) {
                            $similarGroups[$key] = [];
                        }
                        if (!in_array($dept1, $similarGroups[$key])) {
                            $similarGroups[$key][] = $dept1;
                        }
                        if (!in_array($dept2, $similarGroups[$key])) {
                            $similarGroups[$key][] = $dept2;
                        }
                    }
                }
            }
        }
    }
    
    // Merge similar groups into main grouped array
    foreach ($similarGroups as $key => $similarDepts) {
        if (count($similarDepts) > 1) {
            // Use the shortest name as key (usually the more general one)
            usort($similarDepts, function($a, $b) {
                return strlen($a->name) <=> strlen($b->name);
            });
            $shortestName = trim(mb_strtolower($similarDepts[0]->name, 'UTF-8'));
            
            if (!isset($grouped[$shortestName])) {
                $grouped[$shortestName] = [];
            }
            
            foreach ($similarDepts as $dept) {
                $normalizedName = trim(mb_strtolower($dept->name, 'UTF-8'));
                if ($normalizedName !== $shortestName) {
                    // Move from old group to new group
                    if (isset($grouped[$normalizedName])) {
                        foreach ($grouped[$normalizedName] as $movedDept) {
                            if (!in_array($movedDept, $grouped[$shortestName])) {
                                $grouped[$shortestName][] = $movedDept;
                            }
                        }
                        unset($grouped[$normalizedName]);
                    } else {
                        if (!in_array($dept, $grouped[$shortestName])) {
                            $grouped[$shortestName][] = $dept;
                        }
                    }
                }
            }
        }
    }
    
    // Find duplicates
    $duplicates = [];
    $toDelete = [];
    $toKeep = [];
    
    foreach ($grouped as $name => $depts) {
        if (count($depts) > 1) {
            echo "⚠️  قسم متكرر: \"{$depts[0]->name}\" (يوجد " . count($depts) . " نسخة)\n";
            
            // Keep the first one (oldest ID), delete the rest
            usort($depts, function($a, $b) {
                return $a->id <=> $b->id;
            });
            
            $keepDept = array_shift($depts);
            $toKeep[$keepDept->id] = $keepDept;
            
            echo "   ✓ سيتم الاحتفاظ بـ: ID {$keepDept->id} - {$keepDept->name}\n";
            
            foreach ($depts as $duplicate) {
                $toDelete[$duplicate->id] = $duplicate;
                echo "   ✗ سيتم حذف: ID {$duplicate->id} - {$duplicate->name}\n";
            }
            echo "\n";
        }
    }
    
    if (empty($toDelete)) {
        echo "✅ لا توجد أقسام متكررة!\n";
        DB::rollBack();
        exit(0);
    }
    
    echo "\n=== ملخص التغييرات ===\n";
    echo "عدد الأقسام التي سيتم الاحتفاظ بها: " . count($toKeep) . "\n";
    echo "عدد الأقسام التي سيتم حذفها: " . count($toDelete) . "\n\n";
    
    // Check for lawyers assigned to departments to be deleted
    $lawyersToMove = [];
    foreach ($toDelete as $deleteId => $deleteDept) {
        $lawyers = DB::table('lawyers')->where('department_id', $deleteId)->get();
        if ($lawyers->count() > 0) {
            echo "⚠️  يوجد " . $lawyers->count() . " محامي في القسم الذي سيتم حذفه (ID: {$deleteId})\n";
            
            // Find the corresponding keep department
            $keepDept = null;
            foreach ($toKeep as $keepId => $keep) {
                $normalizedDelete = trim(mb_strtolower($deleteDept->name, 'UTF-8'));
                $normalizedKeep = trim(mb_strtolower($keep->name, 'UTF-8'));
                if ($normalizedDelete === $normalizedKeep) {
                    $keepDept = $keep;
                    break;
                }
            }
            
            if ($keepDept) {
                // Move lawyers to the kept department
                DB::table('lawyers')->where('department_id', $deleteId)->update([
                    'department_id' => $keepDept->id
                ]);
                echo "   ✓ تم نقل المحامين إلى القسم: ID {$keepDept->id} - {$keepDept->name}\n";
            }
        }
        
        // Check department_lawyer pivot table
        $pivotLawyers = DB::table('department_lawyer')->where('department_id', $deleteId)->get();
        if ($pivotLawyers->count() > 0) {
            echo "⚠️  يوجد " . $pivotLawyers->count() . " علاقة في جدول department_lawyer للقسم (ID: {$deleteId})\n";
            
            $keepDept = null;
            foreach ($toKeep as $keepId => $keep) {
                $normalizedDelete = trim(mb_strtolower($deleteDept->name, 'UTF-8'));
                $normalizedKeep = trim(mb_strtolower($keep->name, 'UTF-8'));
                if ($normalizedDelete === $normalizedKeep) {
                    $keepDept = $keep;
                    break;
                }
            }
            
            if ($keepDept) {
                // Update pivot table
                foreach ($pivotLawyers as $pivot) {
                    // Check if relationship already exists
                    $exists = DB::table('department_lawyer')
                        ->where('department_id', $keepDept->id)
                        ->where('lawyer_id', $pivot->lawyer_id)
                        ->exists();
                    
                    if (!$exists) {
                        DB::table('department_lawyer')
                            ->where('department_id', $deleteId)
                            ->where('lawyer_id', $pivot->lawyer_id)
                            ->update(['department_id' => $keepDept->id]);
                    } else {
                        // Delete duplicate relationship
                        DB::table('department_lawyer')
                            ->where('department_id', $deleteId)
                            ->where('lawyer_id', $pivot->lawyer_id)
                            ->delete();
                    }
                }
                echo "   ✓ تم تحديث علاقات department_lawyer\n";
            }
        }
    }
    
    echo "\n=== بدء الحذف ===\n";
    
    // Delete department translations first
    foreach ($toDelete as $deleteId => $deleteDept) {
        DB::table('department_translations')->where('department_id', $deleteId)->delete();
        echo "✓ تم حذف ترجمات القسم ID: {$deleteId}\n";
    }
    
    // Delete departments
    foreach ($toDelete as $deleteId => $deleteDept) {
        // Delete related data
        if (DB::getSchemaBuilder()->hasTable('department_images')) {
            DB::table('department_images')->where('department_id', $deleteId)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('department_videos')) {
            DB::table('department_videos')->where('department_id', $deleteId)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('department_faqs')) {
            DB::table('department_faqs')->where('department_id', $deleteId)->delete();
        }
        if (DB::getSchemaBuilder()->hasTable('department_lawyer')) {
            DB::table('department_lawyer')->where('department_id', $deleteId)->delete();
        }
        
        // Delete department
        DB::table('departments')->where('id', $deleteId)->delete();
        echo "✓ تم حذف القسم ID: {$deleteId} - {$deleteDept->name}\n";
    }
    
    DB::commit();
    
    echo "\n✅ تم حذف " . count($toDelete) . " قسم متكرر بنجاح!\n";
    echo "✅ تم الاحتفاظ بـ " . count($toKeep) . " قسم\n";
    
} catch (\Exception $e) {
    if (DB::transactionLevel() > 0) {
        DB::rollBack();
    }
    echo "❌ خطأ: " . $e->getMessage() . "\n";
    echo "الملف: " . $e->getFile() . "\n";
    echo "السطر: " . $e->getLine() . "\n";
    exit(1);
}
