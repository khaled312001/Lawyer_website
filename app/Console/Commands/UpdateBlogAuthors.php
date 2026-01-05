<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Modules\Blog\app\Models\Blog;

class UpdateBlogAuthors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:update-authors {--from=Khaled} {--to=Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all blog posts author from one admin to another';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fromName = $this->option('from');
        $toName = $this->option('to');

        $this->info("Updating blog authors from '{$fromName}' to '{$toName}'...");

        // Find the admin to change from
        $fromAdmin = Admin::where('name', $fromName)->first();
        
        if (!$fromAdmin) {
            $this->warn("Admin with name '{$fromName}' not found.");
            return Command::FAILURE;
        }

        $this->info("Found admin '{$fromName}' with ID: {$fromAdmin->id}");

        // Find or create the admin to change to
        $toAdmin = Admin::where('name', $toName)->first();
        
        if (!$toAdmin) {
            $this->warn("Admin with name '{$toName}' not found. Creating new admin...");
            
            // Create new admin with name "Admin"
            $toAdmin = Admin::create([
                'name' => $toName,
                'email' => 'admin@' . str_replace(['http://', 'https://'], '', config('app.url')) . '.com',
                'password' => bcrypt('password'), // Default password, should be changed
            ]);
            
            $this->info("Created new admin '{$toName}' with ID: {$toAdmin->id}");
            $this->warn("⚠️  Please change the password for this admin account!");
        } else {
            $this->info("Found admin '{$toName}' with ID: {$toAdmin->id}");
        }

        // Count blogs to update
        $blogsCount = Blog::where('admin_id', $fromAdmin->id)->count();
        
        if ($blogsCount === 0) {
            $this->info("No blogs found with author '{$fromName}'.");
            return Command::SUCCESS;
        }

        $this->info("Found {$blogsCount} blog(s) to update.");

        if ($this->confirm("Do you want to update {$blogsCount} blog(s) from '{$fromName}' to '{$toName}'?")) {
            // Update all blogs
            $updated = Blog::where('admin_id', $fromAdmin->id)
                ->update(['admin_id' => $toAdmin->id]);

            $this->info("✅ Successfully updated {$updated} blog(s)!");
            
            return Command::SUCCESS;
        } else {
            $this->info("Operation cancelled.");
            return Command::FAILURE;
        }
    }
}

