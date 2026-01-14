<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\Cache;

class EnableWhatsAppLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:enable {--number=41795578786 : WhatsApp number to use}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable WhatsApp login functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('تفعيل تسجيل الدخول بالواتساب...');
        $this->newLine();

        // Get WhatsApp number from option or use default
        $whatsappNumber = $this->option('number');

        // Enable WhatsApp login status
        Setting::updateOrCreate(
            ['key' => 'whatsapp_login_status'],
            ['value' => 'active']
        );
        $this->info('✓ تم تفعيل حالة تسجيل الدخول بالواتساب');

        // Set WhatsApp number
        Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => $whatsappNumber]
        );
        $this->info("✓ تم تعيين رقم الواتساب: {$whatsappNumber}");

        // Clear cache
        Cache::forget('setting');
        $this->info('✓ تم مسح الكاش');
        $this->newLine();

        // Verify settings
        $whatsappStatus = Setting::where('key', 'whatsapp_login_status')->first();
        $whatsappNumberSetting = Setting::where('key', 'whatsapp_number')->first();

        $this->table(
            ['الإعداد', 'القيمة'],
            [
                ['حالة تسجيل الدخول بالواتساب', $whatsappStatus ? $whatsappStatus->value : 'غير موجود'],
                ['رقم الواتساب', $whatsappNumberSetting ? $whatsappNumberSetting->value : 'غير موجود'],
            ]
        );

        $this->newLine();
        $this->info('تم تفعيل تسجيل الدخول بالواتساب بنجاح!');
        $this->info('يمكنك الآن زيارة صفحة تسجيل الدخول ورؤية زر الواتساب.');
        $this->info('الرابط: ' . url('/login'));

        return Command::SUCCESS;
    }
}
