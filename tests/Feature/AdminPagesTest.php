<?php

namespace Tests\Feature;

use App\Livewire\Admin\Settings;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['email' => 'admin@inaman.my', 'password' => bcrypt('inaman123')]);
    }

    public function test_admin_pages_render_when_logged_in(): void
    {
        $pages = ['/admin', '/admin/menu', '/admin/categories', '/admin/blog', '/admin/settings'];

        foreach ($pages as $url) {
            $this->actingAs($this->admin)->get($url)->assertStatus(200);
        }
    }

    public function test_settings_component_loads_saved_values(): void
    {
        SiteSetting::set('brand_name', 'INAMAN TAUHU BERGEDIL');
        SiteSetting::set('whatsapp', '601131441795');

        Livewire::actingAs($this->admin)
            ->test(Settings::class)
            ->assertSet('brandName', 'INAMAN TAUHU BERGEDIL')
            ->assertSet('whatsapp', '601131441795');
    }

    public function test_settings_can_be_saved_and_persist(): void
    {
        Livewire::actingAs($this->admin)
            ->test(Settings::class)
            ->set('brandName', 'INAMAN Tauhu')
            ->set('whatsapp', '60123456789')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('settings-saved');

        $this->assertDatabaseHas('site_settings', ['key' => 'brand_name', 'value' => 'INAMAN Tauhu']);
        $this->assertEquals('60123456789', SiteSetting::get('whatsapp'));
    }

    public function test_site_setting_missing_key_returns_default(): void
    {
        $this->assertEquals('fallback', SiteSetting::get('tidak_wujud', 'fallback'));
    }
}