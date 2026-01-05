<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StorageLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:link-custom
                {--relative : Create the symbolic link using relative paths}
                {--force : Recreate existing symbolic links}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the symbolic links configured for the application (workaround for disabled symlink function)';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $relative = $this->option('relative');
        $force = $this->option('force');
        $allSuccess = true;

        foreach ($this->links() as $link => $target) {
            // Check if link already exists
            if (file_exists($link) || is_link($link)) {
                if (!$force) {
                    $this->error("The [{$link}] link already exists. Use --force to recreate it.");
                    $allSuccess = false;
                    continue;
                }
                
                // Remove existing link/file
                if (is_link($link)) {
                    unlink($link);
                } else {
                    if (is_dir($link)) {
                        rmdir($link);
                    } else {
                        unlink($link);
                    }
                }
            }

            // Ensure target directory exists
            if (!is_dir($target)) {
                $this->files->makeDirectory($target, 0755, true);
                $this->info("Created target directory: {$target}");
            }

            // Try to create symlink
            $success = false;
            $targetPath = $target;
            
            // Method 1: Try PHP symlink() if available
            if (function_exists('symlink')) {
                try {
                    if ($relative) {
                        $targetPath = $this->getRelativeTarget($link, $target);
                    }
                    if (symlink($targetPath, $link)) {
                        $success = true;
                        $this->info("The [{$link}] link has been connected to [{$targetPath}] using PHP symlink().");
                    }
                } catch (\Exception $e) {
                    $this->warn("PHP symlink() failed: " . $e->getMessage());
                }
            }

            // Method 2: Try shell command if PHP symlink() is not available or failed
            if (!$success) {
                $absoluteTarget = realpath($target);
                if (!$absoluteTarget) {
                    $this->error("Target path does not exist: {$target}");
                    $allSuccess = false;
                    continue;
                }

                if ($relative) {
                    $absoluteTarget = $this->getRelativeTarget($link, $absoluteTarget);
                }

                // Use ln -s command
                $linkDir = dirname($link);
                
                // Ensure link directory exists
                if (!is_dir($linkDir)) {
                    $this->files->makeDirectory($linkDir, 0755, true);
                }

                // Create symlink using shell command
                $command = sprintf(
                    'ln -s %s %s',
                    escapeshellarg($absoluteTarget),
                    escapeshellarg($link)
                );

                $output = [];
                $returnVar = 0;
                @exec($command . ' 2>&1', $output, $returnVar);

                if ($returnVar === 0 && is_link($link)) {
                    $success = true;
                    $this->info("The [{$link}] link has been connected to [{$absoluteTarget}] using shell command.");
                } else {
                    $error = implode("\n", $output);
                    $this->error("Failed to create symlink from [{$link}] to [{$absoluteTarget}].");
                    $this->error("Error: {$error}");
                    $this->warn("You may need to create the symlink manually using:");
                    $this->line("  ln -s " . escapeshellarg($absoluteTarget) . " " . escapeshellarg($link));
                    $allSuccess = false;
                }
            }
        }

        return $allSuccess ? 0 : 1;
    }

    /**
     * Get the symbolic links that are configured for the application.
     *
     * @return array
     */
    protected function links()
    {
        return $this->laravel['config']['filesystems.links'] ??
               [public_path('storage') => storage_path('app/public')];
    }

    /**
     * Get relative target path.
     *
     * @param  string  $link
     * @param  string  $target
     * @return string
     */
    protected function getRelativeTarget($link, $target)
    {
        $linkDir = dirname($link);
        $targetDir = dirname($target);
        
        // Calculate relative path
        $linkParts = explode('/', $linkDir);
        $targetParts = explode('/', $targetDir);
        
        // Remove common parts
        while (!empty($linkParts) && !empty($targetParts) && $linkParts[0] === $targetParts[0]) {
            array_shift($linkParts);
            array_shift($targetParts);
        }
        
        // Build relative path
        $relative = str_repeat('../', count($linkParts));
        $relative .= implode('/', $targetParts);
        $relative .= '/' . basename($target);
        
        return $relative;
    }
}

