<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;

class AddonsController extends Controller
{
    /**
     * Sync modules from Modules directory to modules_statuses.json
     */
    public function syncModules()
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $modulesPath = base_path('Modules');
        $modulesStatuses = [];
        
        if (File::exists($modulesPath)) {
            $directories = File::directories($modulesPath);
            
            foreach ($directories as $directory) {
                $moduleName = basename($directory);
                $moduleJsonPath = $directory . '/module.json';
                
                // Check if module.json exists (valid module)
                if (File::exists($moduleJsonPath)) {
                    // Check if module is already in statuses, otherwise default to enabled
                    $existingStatuses = [];
                    if (File::exists(base_path('modules_statuses.json'))) {
                        $existingStatuses = json_decode(File::get(base_path('modules_statuses.json')), true) ?? [];
                    }
                    
                    // Keep existing status if exists, otherwise set to true (enabled)
                    $modulesStatuses[$moduleName] = $existingStatuses[$moduleName] ?? true;
                }
            }
        }
        
        // Write updated statuses to file
        File::put(
            base_path('modules_statuses.json'),
            json_encode($modulesStatuses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        
        // Clear module cache
        if (class_exists(Module::class)) {
            Module::scan();
        }
        
        $notification = __('Modules synced successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        
        return redirect()->back()->with($notification);
    }
}

