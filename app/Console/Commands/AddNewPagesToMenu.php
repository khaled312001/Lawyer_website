<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\CustomMenu\app\Enums\AllMenus;
use Modules\CustomMenu\app\Models\Menu;
use Modules\CustomMenu\app\Models\MenuItem;
use Modules\CustomMenu\app\Models\MenuItemTranslation;
use Modules\Language\app\Models\Language;

class AddNewPagesToMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:add-new-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new pages (Book Appointment, Business Subscription, Partnerships, Legal Aid Check) to the main menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Adding new pages to menu...');

        // Get main menu
        $mainMenu = Menu::where('slug', AllMenus::MAIN_MENU)->first();
        
        if (!$mainMenu) {
            $this->error('Main menu not found!');
            return 1;
        }

        // Get all languages
        $languages = Language::where('status', 1)->get();
        
        if ($languages->isEmpty()) {
            $this->error('No active languages found!');
            return 1;
        }

        // Define new pages
        $newPages = [
            [
                'link' => '/book-appointment',
                'labels' => [
                    'en' => 'Book Appointment',
                    'ar' => 'حجز موعد',
                ],
            ],
            [
                'link' => '/business-subscription',
                'labels' => [
                    'en' => 'Business Subscription',
                    'ar' => 'اشتراك الأعمال',
                ],
            ],
            [
                'link' => '/partnerships',
                'labels' => [
                    'en' => 'Partnerships',
                    'ar' => 'الشراكات',
                ],
            ],
            [
                'link' => '/legal-aid-check',
                'labels' => [
                    'en' => 'Legal Aid Check',
                    'ar' => 'فحص المساعدة القانونية',
                ],
            ],
        ];

        // Find or create "Pages" parent menu item
        $pagesParent = MenuItem::where('menu_id', $mainMenu->id)
            ->where(function($query) {
                $query->where('link', '#')
                      ->orWhere('link', 'javascript:;')
                      ->orWhere('link', '');
            })
            ->whereHas('translations', function($q) {
                $q->where('label', 'LIKE', '%Pages%')
                  ->orWhere('label', 'LIKE', '%صفحات%');
            })
            ->first();

        // If Pages doesn't exist, try to find it by common patterns
        if (!$pagesParent) {
            $pagesParent = MenuItem::where('menu_id', $mainMenu->id)
                ->whereHas('translations', function($q) {
                    $q->whereIn('label', ['Pages', 'صفحات', 'Page', 'صفحة']);
                })
                ->first();
        }

        // If still not found, create it
        if (!$pagesParent) {
            $this->info('Creating "Pages" parent menu item...');
            $sort = MenuItem::getNextSortRoot($mainMenu->id);
            
            $pagesParent = new MenuItem();
            $pagesParent->label = 'Pages';
            $pagesParent->link = 'javascript:;';
            $pagesParent->menu_id = $mainMenu->id;
            $pagesParent->parent_id = 0;
            $pagesParent->sort = $sort;
            $pagesParent->custom_item = 0;
            $pagesParent->open_new_tab = 0;
            $pagesParent->save();

            // Add translations for Pages
            foreach ($languages as $language) {
                $label = $language->code == 'ar' ? 'صفحات' : 'Pages';
                MenuItemTranslation::create([
                    'menu_item_id' => $pagesParent->id,
                    'lang_code' => $language->code,
                    'label' => $label,
                ]);
            }
            $this->info('✓ Created "Pages" parent menu item');
        }

        $addedCount = 0;
        $skippedCount = 0;

        // Get next sort order for child items
        $maxChildSort = MenuItem::where('menu_id', $mainMenu->id)
            ->where('parent_id', $pagesParent->id)
            ->max('sort') ?? 0;

        foreach ($newPages as $page) {
            // Check if menu item already exists
            $existingItem = MenuItem::where('menu_id', $mainMenu->id)
                ->where('link', $page['link'])
                ->first();

            if ($existingItem) {
                // If exists but not under Pages, move it
                if ($existingItem->parent_id != $pagesParent->id) {
                    $existingItem->parent_id = $pagesParent->id;
                    $existingItem->sort = ++$maxChildSort;
                    $existingItem->save();
                    $this->info("✓ Moved '{$page['link']}' under Pages");
                    $addedCount++;
                } else {
                    $this->warn("Menu item for '{$page['link']}' already exists under Pages. Skipping...");
                    $skippedCount++;
                }
                continue;
            }

            // Create menu item as child of Pages
            $menuItem = new MenuItem();
            $menuItem->label = $page['labels']['en'] ?? $page['labels']['ar'] ?? 'New Page';
            $menuItem->link = $page['link'];
            $menuItem->menu_id = $mainMenu->id;
            $menuItem->parent_id = $pagesParent->id; // Child of Pages
            $menuItem->sort = ++$maxChildSort;
            $menuItem->custom_item = 0;
            $menuItem->open_new_tab = 0;
            $menuItem->save();

            // Add translations
            foreach ($languages as $language) {
                $label = $page['labels'][$language->code] ?? $page['labels']['en'] ?? 'New Page';
                
                MenuItemTranslation::updateOrCreate(
                    [
                        'menu_item_id' => $menuItem->id,
                        'lang_code' => $language->code,
                    ],
                    [
                        'label' => $label,
                    ]
                );
            }

            $this->info("✓ Added: {$page['link']}");
            $addedCount++;
        }

        $this->newLine();
        $this->info("Completed! Added: {$addedCount}, Skipped: {$skippedCount}");

        return 0;
    }
}
