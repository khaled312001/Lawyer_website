<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\CustomMenu\app\Enums\AllMenus;
use Modules\CustomMenu\app\Models\Menu;
use Modules\CustomMenu\app\Models\MenuItem;
use Modules\CustomMenu\app\Models\MenuItemTranslation;
use Modules\Language\app\Models\Language;

class AddRealEstateToMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:add-real-estate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Real Estate page to the main menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Adding Real Estate page to menu...');

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

        // Check if menu item already exists
        $existingItem = MenuItem::where('menu_id', $mainMenu->id)
            ->where('link', '/real-estate')
            ->first();

        if ($existingItem) {
            $this->warn('Real Estate menu item already exists. Skipping...');
            return 0;
        }

        // Get next sort order
        $sort = MenuItem::getNextSortRoot($mainMenu->id);

        // Create menu item
        $menuItem = new MenuItem();
        $menuItem->label = 'Real Estate';
        $menuItem->link = '/real-estate';
        $menuItem->menu_id = $mainMenu->id;
        $menuItem->parent_id = 0;
        $menuItem->sort = $sort;
        $menuItem->custom_item = 0;
        $menuItem->open_new_tab = 0;
        $menuItem->save();

        // Add translations
        foreach ($languages as $language) {
            $label = $language->code == 'ar' ? 'خدمات العقارات' : 'Real Estate';
            
            MenuItemTranslation::create([
                'menu_item_id' => $menuItem->id,
                'lang_code' => $language->code,
                'label' => $label,
            ]);
        }

        $this->info('✓ Real Estate page added to menu successfully!');
        return 0;
    }
}

