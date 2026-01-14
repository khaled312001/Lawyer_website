<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\Cache;

class UpdateGoogleCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:update-credentials 
                            {--client_id= : Google Client ID}
                            {--client_secret= : Google Client Secret}
                            {--status=active : Google Login Status (active/inactive)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Google Login credentials and activate Google Login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating Google Login credentials...');
        $this->newLine();

        // Get credentials from command options or prompt
        $clientId = $this->option('client_id') ?: $this->ask('Enter Google Client ID');
        $clientSecret = $this->option('client_secret') ?: $this->secret('Enter Google Client Secret');
        $status = $this->option('status') ?: 'active';

        if (empty($clientId) || empty($clientSecret)) {
            $this->error('❌ Client ID and Client Secret are required!');
            return Command::FAILURE;
        }

        try {
            // Update Google Client ID
            Setting::updateOrCreate(
                ['key' => 'gmail_client_id'],
                ['value' => $clientId]
            );
            $this->info('✓ Google Client ID updated successfully');

            // Update Google Secret ID
            Setting::updateOrCreate(
                ['key' => 'gmail_secret_id'],
                ['value' => $clientSecret]
            );
            $this->info('✓ Google Secret ID updated successfully');

            // Update Google Login Status
            Setting::updateOrCreate(
                ['key' => 'google_login_status'],
                ['value' => $status]
            );
            $this->info("✓ Google Login Status set to: {$status}");

            // Clear cache
            Cache::forget('setting');
            $this->info('✓ Cache cleared');
            $this->newLine();

            $this->info('✅ All Google Login credentials have been updated successfully!');
            $this->newLine();
            $this->line('Google Redirect URI: https://amanlaw.ch/auth/google/callback');
            $this->line('Make sure this URI is added in Google Cloud Console:');
            $this->line('https://console.cloud.google.com/apis/credentials');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
