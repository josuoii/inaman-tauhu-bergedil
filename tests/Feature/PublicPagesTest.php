<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $ayam = Category::create(['name' => 'Tauhu Bergedil Ayam', 'slug' => 'ayam', 'type' => 'menu', 'sort_order' => 1]);
        Category::create(['name' => 'Resepi', 'slug' => 'resepi', 'type' => 'blog', 'sort_order' => 1]);

        MenuItem::create([
            'category_id' => $ayam->id,
            'name' => 'Pakej 6 Percubaan',
            'slug' => 'ayam-pakej-6',
            'quantity' => 6,
            'price' => 12.00,
            'description' => 'Enam keping rangup.',
            'image_path' => '/images/menu/ayam-6.jpg',
            'is_available' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        MenuItem::create([
            'name' => 'Pakej 10 Habis',
            'slug' => 'daging-pakej-10',
            'quantity' => 10,
            'price' => 20.00,
            'is_available' => false,
        ]);

        BlogPost::create([
            'title' => 'Resepi Tauhu Bergedil',
            'slug' => 'resepi-tauhu',
            'excerpt' => 'Ringkasan resepi.',
            'content' => '<p>Langkah memasak.</p>',
            'image_path' => '/images/blog/resepi.jpg',
            'published_at' => now()->subDay(),
        ]);

        BlogPost::create([
            'title' => 'Belum Terbit',
            'slug' => 'belum-terbit',
            'content' => '<p>Draf.</p>',
            'published_at' => now()->addDay(),
        ]);
    }

    public function test_home_page_renders_hero_and_featured_menu(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('INAMAN');
        $response->assertSee('Pakej 6 Percubaan');
        $response->assertSee('RM 12.00');
    }

    public function test_menu_page_lists_available_items(): void
    {
        $response = $this->get('/menu');

        $response->assertStatus(200);
        $response->assertSee('Pakej 6 Percubaan');
        $response->assertSee('Habis buat masa ini');
    }

    public function test_blog_index_lists_published_posts_only(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('Resepi Tauhu Bergedil');
        $response->assertDontSee('Belum Terbit');
    }

    public function test_unpublished_blog_post_is_hidden_from_public(): void
    {
        $response = $this->get('/blog/belum-terbit');

        $response->assertStatus(404);
    }

    public function test_contact_page_shows_address(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Sungai Buloh');
    }

    public function test_admin_routes_require_authentication(): void
    {
        foreach (['/admin', '/admin/menu', '/admin/categories', '/admin/blog', '/admin/settings'] as $url) {
            $this->get($url)->assertRedirect('/login');
        }
    }

    public function test_admin_can_see_dashboard_when_logged_in(): void
    {
        User::factory()->create(['email' => 'admin@inaman.my', 'password' => bcrypt('inaman123')]);

        $this->actingAs(User::where('email', 'admin@inaman.my')->first())
            ->get('/admin')
            ->assertStatus(200);
    }
}