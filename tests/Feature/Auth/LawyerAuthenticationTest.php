<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Lawyer\app\Enums\LawyerStatus;
use Modules\Lawyer\app\Models\Lawyer;
use Tests\TestCase;

class LawyerAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_lawyer_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login?type=lawyer');

        $response->assertStatus(200);
        $response->assertSee('Lawyer', false);
    }

    public function test_lawyers_can_authenticate_using_the_login_screen(): void
    {
        $lawyer = Lawyer::create([
            'department_id' => 1,
            'location_id' => 1,
            'name' => 'Daniel Martinez',
            'slug' => 'daniel-martinez',
            'email' => 'daniel.martinez@law.com',
            'password' => Hash::make('1234'),
            'phone' => '1234567890',
            'fee' => 100,
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'daniel.martinez@law.com',
            'password' => '1234',
        ]);

        $this->assertAuthenticated('lawyer');
        $response->assertRedirect(route('lawyer.dashboard'));
    }

    public function test_lawyers_can_not_authenticate_with_invalid_password(): void
    {
        $lawyer = Lawyer::create([
            'department_id' => 1,
            'location_id' => 1,
            'name' => 'Daniel Martinez',
            'slug' => 'daniel-martinez',
            'email' => 'daniel.martinez@law.com',
            'password' => Hash::make('1234'),
            'phone' => '1234567890',
            'fee' => 100,
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'daniel.martinez@law.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('lawyer');
        $response->assertRedirect(route('login', ['type' => 'lawyer']));
    }

    public function test_lawyers_can_not_authenticate_with_invalid_email(): void
    {
        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'nonexistent@law.com',
            'password' => '1234',
        ]);

        $this->assertGuest('lawyer');
        $response->assertRedirect(route('login', ['type' => 'lawyer']));
    }

    public function test_inactive_lawyers_can_not_authenticate(): void
    {
        $lawyer = Lawyer::create([
            'department_id' => 1,
            'location_id' => 1,
            'name' => 'Daniel Martinez',
            'slug' => 'daniel-martinez',
            'email' => 'daniel.martinez@law.com',
            'password' => Hash::make('1234'),
            'phone' => '1234567890',
            'fee' => 100,
            'status' => LawyerStatus::INACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'daniel.martinez@law.com',
            'password' => '1234',
        ]);

        $this->assertGuest('lawyer');
        $response->assertRedirect(route('login', ['type' => 'lawyer']));
    }

    public function test_unverified_lawyers_can_not_authenticate(): void
    {
        $lawyer = Lawyer::create([
            'department_id' => 1,
            'location_id' => 1,
            'name' => 'Daniel Martinez',
            'slug' => 'daniel-martinez',
            'email' => 'daniel.martinez@law.com',
            'password' => Hash::make('1234'),
            'phone' => '1234567890',
            'fee' => 100,
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => null,
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'daniel.martinez@law.com',
            'password' => '1234',
        ]);

        $this->assertGuest('lawyer');
        $response->assertRedirect(route('login', ['type' => 'lawyer']));
    }

    public function test_lawyers_can_logout(): void
    {
        $lawyer = Lawyer::create([
            'department_id' => 1,
            'location_id' => 1,
            'name' => 'Daniel Martinez',
            'slug' => 'daniel-martinez',
            'email' => 'daniel.martinez@law.com',
            'password' => Hash::make('1234'),
            'phone' => '1234567890',
            'fee' => 100,
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($lawyer, 'lawyer')->post('/lawyer/logout');

        $this->assertGuest('lawyer');
        $response->assertRedirect(route('login', ['type' => 'lawyer']));
    }

    public function test_daniel_martinez_login_with_seeded_data(): void
    {
        // This test assumes the database has been seeded
        // Run: php artisan db:seed
        
        $lawyer = Lawyer::where('email', 'daniel.martinez@law.com')->first();
        
        if (!$lawyer) {
            $this->markTestSkipped('Lawyer daniel.martinez@law.com not found. Please run: php artisan db:seed');
        }

        // Ensure the lawyer is active and verified
        $lawyer->update([
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'daniel.martinez@law.com',
            'password' => '1234',
        ]);

        $this->assertAuthenticated('lawyer');
        $response->assertRedirect(route('lawyer.dashboard'));
    }

    public function test_james_anderson_login_with_seeded_data(): void
    {
        // This test assumes the database has been seeded
        // Run: php artisan db:seed
        
        $lawyer = Lawyer::where('email', 'james.anderson@law.com')->first();
        
        if (!$lawyer) {
            $this->markTestSkipped('Lawyer james.anderson@law.com not found. Please run: php artisan db:seed');
        }

        // Ensure the lawyer is active and verified
        $lawyer->update([
            'status' => LawyerStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/lawyer/lawyer-login', [
            'email' => 'james.anderson@law.com',
            'password' => '1234',
        ]);

        $this->assertAuthenticated('lawyer');
        $response->assertRedirect(route('lawyer.dashboard'));
    }
}

