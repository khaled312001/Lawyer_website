<?php

/**
 * Script to manage departments and services for Syria:
 * - Delete all existing departments and services
 * - Add only the most important legal departments and services in Syria
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Department;
use Modules\Lawyer\app\Models\DepartmentTranslation;
use Modules\Lawyer\app\Models\DepartmentImage;
use Modules\Lawyer\app\Models\DepartmentVideo;
use Modules\Lawyer\app\Models\DepartmentFaq;
use Modules\Service\app\Models\Service;
use Modules\Service\app\Models\ServiceTranslation;
use Modules\Service\app\Models\ServiceImage;
use Modules\Service\app\Models\ServiceVideo;
use Modules\Language\app\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

echo "========================================\n";
echo "Syria Legal Departments & Services Management\n";
echo "========================================\n\n";

// Check for dry-run mode
$dryRun = in_array('--dry-run', $argv) || in_array('-d', $argv);
if ($dryRun) {
    echo "⚠️  DRY-RUN MODE: No changes will be made to the database\n";
    echo "   Run without --dry-run to apply changes\n\n";
}

// Get all languages
$languages = Language::where('status', 1)->get();
$langCodes = $languages->pluck('code')->toArray();

echo "Found " . count($langCodes) . " active language(s): " . implode(', ', $langCodes) . "\n\n";

// ============================================
// DELETE EXISTING DEPARTMENTS
// ============================================
echo "========================================\n";
echo "DELETING EXISTING DEPARTMENTS\n";
echo "========================================\n";

$existingDepartments = Department::all();
$deletedDeptCount = 0;

$departmentsWithLawyers = [];
foreach ($existingDepartments as $dept) {
    try {
        $lawyerCount = $dept->lawyers()->count();
        
        // Check if department has lawyers
        if ($lawyerCount > 0) {
            $deptName = $dept->translation?->name ?? "Department #{$dept->id}";
            $departmentsWithLawyers[] = [
                'id' => $dept->id,
                'name' => $deptName,
                'lawyers' => $lawyerCount
            ];
            echo "  ⚠️  Cannot delete '{$deptName}' - has {$lawyerCount} lawyer(s)\n";
            continue;
        }
        
        $deptName = $dept->translation?->name ?? "Department #{$dept->id}";
        
        if (!$dryRun) {
            // Delete related data
            $dept->images()->delete();
            $dept->videos()->delete();
            $dept->department_faq()->each(function ($faq) {
                $faq->translations()->delete();
                $faq->delete();
            });
            $dept->translations()->delete();
            $dept->delete();
        }
        
        $deletedDeptCount++;
        echo "  " . ($dryRun ? "[DRY-RUN] Would delete" : "✓ Deleted") . ": {$deptName}\n";
    } catch (\Exception $e) {
        $deptName = $dept->translation?->name ?? "Department #{$dept->id}";
        echo "  ✗ Error deleting {$deptName}: " . $e->getMessage() . "\n";
    }
}

if (count($departmentsWithLawyers) > 0) {
    echo "\n⚠️  Warning: " . count($departmentsWithLawyers) . " department(s) could not be deleted because they have lawyers:\n";
    foreach ($departmentsWithLawyers as $dept) {
        echo "   - {$dept['name']} (ID: {$dept['id']}) - {$dept['lawyers']} lawyer(s)\n";
    }
    echo "\n   Please run manage_lawyers_by_department.php first to remove extra lawyers.\n";
}

echo "\nDeleted {$deletedDeptCount} department(s)\n\n";

// ============================================
// DELETE EXISTING SERVICES
// ============================================
echo "========================================\n";
echo "DELETING EXISTING SERVICES\n";
echo "========================================\n";

$existingServices = Service::all();
$deletedServiceCount = 0;

foreach ($existingServices as $service) {
    try {
        if (!$dryRun) {
            // Delete related data
            $service->images()->delete();
            $service->videos()->delete();
            $service->service_faq()->each(function ($faq) {
                $faq->translations()->delete();
                $faq->delete();
            });
            $service->translations()->delete();
            $service->delete();
        }
        
        $deletedServiceCount++;
        echo "  " . ($dryRun ? "[DRY-RUN] Would delete" : "✓ Deleted") . ": {$service->title}\n";
    } catch (\Exception $e) {
        echo "  ✗ Error deleting service: " . $e->getMessage() . "\n";
    }
}

echo "\nDeleted {$deletedServiceCount} service(s)\n\n";

// ============================================
// ADD SYRIA LEGAL DEPARTMENTS
// ============================================
echo "========================================\n";
echo "ADDING SYRIA LEGAL DEPARTMENTS\n";
echo "========================================\n";

$syriaDepartments = [
    [
        'slug' => 'civil-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-1.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون المدني',
                'description' => '<p>يتخصص قسم القانون المدني في معالجة جميع القضايا المتعلقة بالحقوق المدنية والالتزامات والعقود والمسؤولية المدنية. يشمل هذا القسم:</p><ul><li>صياغة العقود والاتفاقيات</li><li>حل النزاعات المدنية</li><li>قضايا التعويضات والأضرار</li><li>قانون الالتزامات والعقود</li><li>قضايا الملكية الفكرية</li></ul>',
                'seo_title' => 'القانون المدني - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون المدني، صياغة العقود، حل النزاعات، والتعويضات في سوريا',
            ],
            'en' => [
                'name' => 'Civil Law',
                'description' => '<p>The Civil Law Department specializes in handling all matters related to civil rights, obligations, contracts, and civil liability. This department includes:</p><ul><li>Drafting contracts and agreements</li><li>Resolving civil disputes</li><li>Compensation and damages cases</li><li>Law of obligations and contracts</li><li>Intellectual property cases</li></ul>',
                'seo_title' => 'Civil Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in civil law, contract drafting, dispute resolution, and compensation in Syria',
            ],
        ],
    ],
    [
        'slug' => 'personal-status-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-2.webp',
        'translations' => [
            'ar' => [
                'name' => 'قانون الأحوال الشخصية',
                'description' => '<p>يتخصص قسم قانون الأحوال الشخصية في جميع القضايا المتعلقة بالأسرة والزواج والطلاق والميراث. يشمل:</p><ul><li>عقود الزواج والطلاق</li><li>قضايا النفقة والحضانة</li><li>قضايا الميراث وتقسيم التركات</li><li>قضايا الوصية والهبة</li><li>قضايا النسب والاعتراف بالأبناء</li></ul>',
                'seo_title' => 'قانون الأحوال الشخصية - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في قانون الأحوال الشخصية، الزواج، الطلاق، والميراث في سوريا',
            ],
            'en' => [
                'name' => 'Personal Status Law',
                'description' => '<p>The Personal Status Law Department specializes in all matters related to family, marriage, divorce, and inheritance. Includes:</p><ul><li>Marriage and divorce contracts</li><li>Alimony and custody cases</li><li>Inheritance and estate division cases</li><li>Wills and gifts cases</li><li>Lineage and child recognition cases</li></ul>',
                'seo_title' => 'Personal Status Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in personal status law, marriage, divorce, and inheritance in Syria',
            ],
        ],
    ],
    [
        'slug' => 'commercial-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-3.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون التجاري',
                'description' => '<p>يتخصص قسم القانون التجاري في جميع القضايا المتعلقة بالأعمال التجارية والشركات. يشمل:</p><ul><li>تسجيل الشركات والمنشآت التجارية</li><li>عقود الشراكة والاستثمار</li><li>قضايا الإفلاس والتسوية</li><li>قضايا المنافسة التجارية</li><li>قضايا التجارة الإلكترونية</li></ul>',
                'seo_title' => 'القانون التجاري - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون التجاري، تسجيل الشركات، والاستثمار في سوريا',
            ],
            'en' => [
                'name' => 'Commercial Law',
                'description' => '<p>The Commercial Law Department specializes in all matters related to business and companies. Includes:</p><ul><li>Company and commercial establishment registration</li><li>Partnership and investment contracts</li><li>Bankruptcy and settlement cases</li><li>Commercial competition cases</li><li>E-commerce cases</li></ul>',
                'seo_title' => 'Commercial Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in commercial law, company registration, and investment in Syria',
            ],
        ],
    ],
    [
        'slug' => 'real-estate-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-4.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون العقاري',
                'description' => '<p>يتخصص قسم القانون العقاري في جميع القضايا المتعلقة بالعقارات والملكية. يشمل:</p><ul><li>شراء وبيع العقارات</li><li>تسجيل العقارات في السجل العقاري</li><li>قضايا الاستملاك والتنازل</li><li>عقود الإيجار والتمليك</li><li>قضايا التعدي على الملكية</li></ul>',
                'seo_title' => 'القانون العقاري - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون العقاري، شراء وبيع العقارات في سوريا',
            ],
            'en' => [
                'name' => 'Real Estate Law',
                'description' => '<p>The Real Estate Law Department specializes in all matters related to real estate and property. Includes:</p><ul><li>Real estate purchase and sale</li><li>Real estate registration in the land registry</li><li>Expropriation and transfer cases</li><li>Lease and ownership contracts</li><li>Property trespass cases</li></ul>',
                'seo_title' => 'Real Estate Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in real estate law, property purchase and sale in Syria',
            ],
        ],
    ],
    [
        'slug' => 'criminal-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-5.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون الجنائي',
                'description' => '<p>يتخصص قسم القانون الجنائي في الدفاع عن المتهمين في القضايا الجنائية. يشمل:</p><ul><li>الدفاع في قضايا الجرائم</li><li>قضايا الأموال العامة والخاصة</li><li>قضايا الاعتداءات والجرائم الأخلاقية</li><li>قضايا المخدرات</li><li>قضايا الجرائم الإلكترونية</li></ul>',
                'seo_title' => 'القانون الجنائي - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون الجنائي والدفاع في القضايا الجنائية في سوريا',
            ],
            'en' => [
                'name' => 'Criminal Law',
                'description' => '<p>The Criminal Law Department specializes in defending accused persons in criminal cases. Includes:</p><ul><li>Defense in criminal cases</li><li>Public and private property cases</li><li>Assault and moral crimes cases</li><li>Drug cases</li><li>Cybercrime cases</li></ul>',
                'seo_title' => 'Criminal Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in criminal law and defense in criminal cases in Syria',
            ],
        ],
    ],
    [
        'slug' => 'labor-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-6.webp',
        'translations' => [
            'ar' => [
                'name' => 'قانون العمل',
                'description' => '<p>يتخصص قسم قانون العمل في جميع القضايا المتعلقة بعقود العمل والعلاقات العمالية. يشمل:</p><ul><li>عقود العمل الفردية والجماعية</li><li>قضايا إنهاء الخدمة والتعويضات</li><li>قضايا الأجور والرواتب</li><li>قضايا التأمينات الاجتماعية</li><li>قضايا السلامة المهنية</li></ul>',
                'seo_title' => 'قانون العمل - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في قانون العمل وعقود العمل في سوريا',
            ],
            'en' => [
                'name' => 'Labor Law',
                'description' => '<p>The Labor Law Department specializes in all matters related to employment contracts and labor relations. Includes:</p><ul><li>Individual and collective employment contracts</li><li>Termination and compensation cases</li><li>Wages and salaries cases</li><li>Social insurance cases</li><li>Occupational safety cases</li></ul>',
                'seo_title' => 'Labor Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in labor law and employment contracts in Syria',
            ],
        ],
    ],
    [
        'slug' => 'administrative-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-7.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون الإداري',
                'description' => '<p>يتخصص قسم القانون الإداري في القضايا المتعلقة بالإدارة العامة والجهات الحكومية. يشمل:</p><ul><li>قضايا القرارات الإدارية</li><li>قضايا التعيين والفصل</li><li>قضايا الرخص والتراخيص</li><li>قضايا المناقصات والعقود الحكومية</li><li>قضايا الطعون الإدارية</li></ul>',
                'seo_title' => 'القانون الإداري - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون الإداري والقضايا الإدارية في سوريا',
            ],
            'en' => [
                'name' => 'Administrative Law',
                'description' => '<p>The Administrative Law Department specializes in matters related to public administration and government entities. Includes:</p><ul><li>Administrative decisions cases</li><li>Appointment and dismissal cases</li><li>Licenses and permits cases</li><li>Tenders and government contracts cases</li><li>Administrative appeals cases</li></ul>',
                'seo_title' => 'Administrative Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in administrative law and administrative cases in Syria',
            ],
        ],
    ],
    [
        'slug' => 'tax-law',
        'thumbnail' => 'uploads/website-images/dummy/department-thumbnail-8.webp',
        'translations' => [
            'ar' => [
                'name' => 'القانون الضريبي',
                'description' => '<p>يتخصص قسم القانون الضريبي في جميع القضايا المتعلقة بالضرائب والرسوم. يشمل:</p><ul><li>قضايا الضرائب المباشرة وغير المباشرة</li><li>قضايا الضرائب على الدخل</li><li>قضايا الضرائب العقارية</li><li>قضايا الطعون الضريبية</li><li>الاستشارات الضريبية</li></ul>',
                'seo_title' => 'القانون الضريبي - مكتب المحاماة السوري',
                'seo_description' => 'خدمات قانونية متخصصة في القانون الضريبي والضرائب في سوريا',
            ],
            'en' => [
                'name' => 'Tax Law',
                'description' => '<p>The Tax Law Department specializes in all matters related to taxes and fees. Includes:</p><ul><li>Direct and indirect tax cases</li><li>Income tax cases</li><li>Real estate tax cases</li><li>Tax appeals cases</li><li>Tax consultations</li></ul>',
                'seo_title' => 'Tax Law - Syrian Law Office',
                'seo_description' => 'Specialized legal services in tax law and taxes in Syria',
            ],
        ],
    ],
];

$createdDeptCount = 0;
foreach ($syriaDepartments as $deptData) {
    try {
        $deptName = $deptData['translations']['ar']['name'] ?? $deptData['slug'];
        
        // Check if department already exists
        $existingDept = Department::where('slug', $deptData['slug'])->first();
        if ($existingDept) {
            echo "  ⚠️  Department '{$deptName}' already exists (slug: {$deptData['slug']}), skipping...\n";
            continue;
        }
        
        if (!$dryRun) {
            $department = Department::create([
                'slug' => $deptData['slug'],
                'thumbnail_image' => $deptData['thumbnail'],
                'show_homepage' => 1,
                'status' => 1,
            ]);
            
            // Add translations for all languages
            foreach ($langCodes as $langCode) {
                $translation = $deptData['translations'][$langCode] ?? $deptData['translations']['ar'];
                
                DepartmentTranslation::create([
                    'department_id' => $department->id,
                    'lang_code' => $langCode,
                    'name' => $translation['name'],
                    'description' => $translation['description'],
                    'seo_title' => $translation['seo_title'],
                    'seo_description' => $translation['seo_description'],
                ]);
            }
        }
        
        $createdDeptCount++;
        echo "  " . ($dryRun ? "[DRY-RUN] Would create" : "✓ Created") . ": {$deptName}\n";
    } catch (\Exception $e) {
        $deptName = $deptData['translations']['ar']['name'] ?? $deptData['slug'];
        echo "  ✗ Error creating department '{$deptName}': " . $e->getMessage() . "\n";
    }
}

echo "\nCreated {$createdDeptCount} department(s)\n\n";

// ============================================
// ADD SYRIA LEGAL SERVICES
// ============================================
echo "========================================\n";
echo "ADDING SYRIA LEGAL SERVICES\n";
echo "========================================\n";

$syriaServices = [
    [
        'slug' => 'legal-consultation',
        'icon' => 'fas fa-gavel',
        'translations' => [
            'ar' => [
                'title' => 'الاستشارات القانونية',
                'sort_description' => 'استشارات قانونية متخصصة من محامين ذوي خبرة في جميع المجالات القانونية',
                'description' => '<p>نقدم استشارات قانونية شاملة ومتخصصة في جميع المجالات القانونية. فريقنا من المحامين ذوي الخبرة جاهز لتقديم النصائح القانونية المناسبة لحالتك.</p>',
                'seo_title' => 'الاستشارات القانونية - مكتب المحاماة السوري',
                'seo_description' => 'استشارات قانونية متخصصة من محامين ذوي خبرة في سوريا',
            ],
            'en' => [
                'title' => 'Legal Consultation',
                'sort_description' => 'Specialized legal consultations from experienced lawyers in all legal fields',
                'description' => '<p>We provide comprehensive and specialized legal consultations in all legal fields. Our team of experienced lawyers is ready to provide appropriate legal advice for your case.</p>',
                'seo_title' => 'Legal Consultation - Syrian Law Office',
                'seo_description' => 'Specialized legal consultations from experienced lawyers in Syria',
            ],
        ],
    ],
    [
        'slug' => 'contract-drafting',
        'icon' => 'fas fa-file-contract',
        'translations' => [
            'ar' => [
                'title' => 'صياغة العقود',
                'sort_description' => 'صياغة العقود والاتفاقيات القانونية باحترافية عالية',
                'description' => '<p>نقوم بصياغة جميع أنواع العقود والاتفاقيات القانونية بما يضمن حماية حقوقك. نغطي عقود العمل، عقود الشراكة، عقود البيع والشراء، وغيرها.</p>',
                'seo_title' => 'صياغة العقود - مكتب المحاماة السوري',
                'seo_description' => 'صياغة احترافية للعقود والاتفاقيات القانونية في سوريا',
            ],
            'en' => [
                'title' => 'Contract Drafting',
                'sort_description' => 'Professional drafting of contracts and legal agreements',
                'description' => '<p>We draft all types of contracts and legal agreements to ensure protection of your rights. We cover employment contracts, partnership contracts, sales contracts, and more.</p>',
                'seo_title' => 'Contract Drafting - Syrian Law Office',
                'seo_description' => 'Professional drafting of contracts and legal agreements in Syria',
            ],
        ],
    ],
    [
        'slug' => 'court-representation',
        'icon' => 'fas fa-balance-scale',
        'translations' => [
            'ar' => [
                'title' => 'التمثيل في المحاكم',
                'sort_description' => 'تمثيل العملاء في جميع المحاكم والدوائر القضائية',
                'description' => '<p>نوفر تمثيلاً قانونياً قوياً في جميع المحاكم والدوائر القضائية. فريقنا من المحامين المتخصصين جاهز للدفاع عن حقوقك في جميع مراحل التقاضي.</p>',
                'seo_title' => 'التمثيل في المحاكم - مكتب المحاماة السوري',
                'seo_description' => 'تمثيل قانوني احترافي في المحاكم السورية',
            ],
            'en' => [
                'title' => 'Court Representation',
                'sort_description' => 'Representing clients in all courts and judicial circuits',
                'description' => '<p>We provide strong legal representation in all courts and judicial circuits. Our team of specialized lawyers is ready to defend your rights at all stages of litigation.</p>',
                'seo_title' => 'Court Representation - Syrian Law Office',
                'seo_description' => 'Professional legal representation in Syrian courts',
            ],
        ],
    ],
    [
        'slug' => 'company-registration',
        'icon' => 'fas fa-building',
        'translations' => [
            'ar' => [
                'title' => 'تسجيل الشركات',
                'sort_description' => 'خدمات تسجيل الشركات والمنشآت التجارية',
                'description' => '<p>نساعدك في تسجيل شركتك أو منشأتك التجارية بجميع الإجراءات القانونية المطلوبة. نغطي جميع أنواع الشركات التجارية والصناعية.</p>',
                'seo_title' => 'تسجيل الشركات - مكتب المحاماة السوري',
                'seo_description' => 'خدمات تسجيل الشركات والمنشآت التجارية في سوريا',
            ],
            'en' => [
                'title' => 'Company Registration',
                'sort_description' => 'Company and commercial establishment registration services',
                'description' => '<p>We help you register your company or commercial establishment with all required legal procedures. We cover all types of commercial and industrial companies.</p>',
                'seo_title' => 'Company Registration - Syrian Law Office',
                'seo_description' => 'Company and commercial establishment registration services in Syria',
            ],
        ],
    ],
    [
        'slug' => 'dispute-resolution',
        'icon' => 'fas fa-handshake',
        'translations' => [
            'ar' => [
                'title' => 'حل النزاعات',
                'sort_description' => 'حل النزاعات القانونية بالطرق الودية والقضائية',
                'description' => '<p>نساعدك في حل النزاعات القانونية بطرق ودية أو قضائية. نعمل على إيجاد الحلول المناسبة لحالتك بأسرع وقت ممكن.</p>',
                'seo_title' => 'حل النزاعات - مكتب المحاماة السوري',
                'seo_description' => 'حل النزاعات القانونية بالطرق الودية والقضائية في سوريا',
            ],
            'en' => [
                'title' => 'Dispute Resolution',
                'sort_description' => 'Resolving legal disputes through amicable and judicial methods',
                'description' => '<p>We help you resolve legal disputes through amicable or judicial methods. We work to find appropriate solutions for your case as quickly as possible.</p>',
                'seo_title' => 'Dispute Resolution - Syrian Law Office',
                'seo_description' => 'Resolving legal disputes through amicable and judicial methods in Syria',
            ],
        ],
    ],
    [
        'slug' => 'arbitration',
        'icon' => 'fas fa-gavel',
        'translations' => [
            'ar' => [
                'title' => 'التحكيم',
                'sort_description' => 'خدمات التحكيم التجاري والقانوني',
                'description' => '<p>نوفر خدمات التحكيم التجاري والقانوني لحل النزاعات خارج المحاكم. نضمن إجراءات تحكيم عادلة وسريعة.</p>',
                'seo_title' => 'التحكيم - مكتب المحاماة السوري',
                'seo_description' => 'خدمات التحكيم التجاري والقانوني في سوريا',
            ],
            'en' => [
                'title' => 'Arbitration',
                'sort_description' => 'Commercial and legal arbitration services',
                'description' => '<p>We provide commercial and legal arbitration services to resolve disputes outside of courts. We ensure fair and fast arbitration procedures.</p>',
                'seo_title' => 'Arbitration - Syrian Law Office',
                'seo_description' => 'Commercial and legal arbitration services in Syria',
            ],
        ],
    ],
    [
        'slug' => 'legal-documentation',
        'icon' => 'fas fa-stamp',
        'translations' => [
            'ar' => [
                'title' => 'التوثيق القانوني',
                'sort_description' => 'توثيق وتصديق جميع الوثائق والمستندات القانونية',
                'description' => '<p>نوفر خدمات التوثيق والتصديق لجميع الوثائق والمستندات القانونية. نضمن صحة وإجراءات التوثيق المطلوبة.</p>',
                'seo_title' => 'التوثيق القانوني - مكتب المحاماة السوري',
                'seo_description' => 'توثيق وتصديق الوثائق والمستندات القانونية في سوريا',
            ],
            'en' => [
                'title' => 'Legal Documentation',
                'sort_description' => 'Documentation and authentication of all legal documents',
                'description' => '<p>We provide documentation and authentication services for all legal documents. We ensure the validity and required documentation procedures.</p>',
                'seo_title' => 'Legal Documentation - Syrian Law Office',
                'seo_description' => 'Documentation and authentication of legal documents in Syria',
            ],
        ],
    ],
];

$createdServiceCount = 0;
foreach ($syriaServices as $serviceData) {
    try {
        $serviceName = $serviceData['translations']['ar']['title'] ?? $serviceData['slug'];
        
        // Check if service already exists
        $existingService = Service::where('slug', $serviceData['slug'])->first();
        if ($existingService) {
            echo "  ⚠️  Service '{$serviceName}' already exists (slug: {$serviceData['slug']}), skipping...\n";
            continue;
        }
        
        if (!$dryRun) {
            $service = Service::create([
                'slug' => $serviceData['slug'],
                'icon' => $serviceData['icon'],
                'show_homepage' => 1,
                'status' => 1,
            ]);
            
            // Add translations for all languages
            foreach ($langCodes as $langCode) {
                $translation = $serviceData['translations'][$langCode] ?? $serviceData['translations']['ar'];
                
                ServiceTranslation::create([
                    'service_id' => $service->id,
                    'lang_code' => $langCode,
                    'title' => $translation['title'],
                    'sort_description' => $translation['sort_description'],
                    'description' => $translation['description'],
                    'seo_title' => $translation['seo_title'],
                    'seo_description' => $translation['seo_description'],
                ]);
            }
        }
        
        $createdServiceCount++;
        echo "  " . ($dryRun ? "[DRY-RUN] Would create" : "✓ Created") . ": {$serviceName}\n";
    } catch (\Exception $e) {
        $serviceName = $serviceData['translations']['ar']['title'] ?? $serviceData['slug'];
        echo "  ✗ Error creating service '{$serviceName}': " . $e->getMessage() . "\n";
    }
}

echo "\nCreated {$createdServiceCount} service(s)\n\n";

echo "========================================\n";
echo "SUMMARY\n";
echo "========================================\n";
echo "Deleted departments: {$deletedDeptCount}\n";
echo "Created departments: {$createdDeptCount}\n";
echo "Deleted services: {$deletedServiceCount}\n";
echo "Created services: {$createdServiceCount}\n";
echo "\nDone!\n";
