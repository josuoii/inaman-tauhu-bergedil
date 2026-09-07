<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $this->seedAdmin();
        $this->seedCategories();
        $this->seedMenu();
        $this->seedBlog();
        $this->seedSettings();
    }

    private function seedAdmin(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@inaman.my'],
            ['name' => 'Admin INAMAN', 'password' => 'inaman123'],
        );
    }

    private function seedCategories(): void
    {
        $cats = [
            ['name' => 'Tauhu Bergedil Ayam', 'slug' => 'tauhu-bergedil-ayam', 'type' => 'menu', 'sort_order' => 1],
            ['name' => 'Tauhu Bergedil Daging', 'slug' => 'tauhu-bergedil-daging', 'type' => 'menu', 'sort_order' => 2],
            ['name' => 'Popia Begedil', 'slug' => 'popia-bergedil', 'type' => 'menu', 'sort_order' => 3],
            ['name' => 'Resepi', 'slug' => 'resepi', 'type' => 'blog', 'sort_order' => 1],
            ['name' => 'Kisah Kami', 'slug' => 'kisah-kami', 'type' => 'blog', 'sort_order' => 2],
        ];

        foreach ($cats as $c) {
            Category::firstOrCreate(['slug' => $c['slug']], $c);
        }
    }

    private function seedMenu(): void
    {
        $menu = [
            // Tauhu Bergedil Ayam
            ['category' => 'tauhu-bergedil-ayam', 'name' => 'Pakej 6 Percubaan', 'quantity' => 6, 'price' => 12.00, 'description' => '6 keping tauhu bergedil ayam rangup + sos kicap pedas. Sesuai untuk yang baru nak cuba!', 'is_featured' => true, 'sort_order' => 1, 'image_path' => '/images/menu/ayam-6.jpg'],
            ['category' => 'tauhu-bergedil-ayam', 'name' => 'Pakej 10 Keluarga', 'quantity' => 10, 'price' => 18.00, 'description' => '10 keping tauhu bergedil ayam + sos kicap pedas. Makanan ringan untuk seisi keluarga.', 'is_featured' => true, 'sort_order' => 2, 'image_path' => '/images/menu/ayam-10.jpg'],
            ['category' => 'tauhu-bergedil-ayam', 'name' => 'Pakej 20 Majlis', 'quantity' => 20, 'price' => 34.00, 'description' => '20 keping tauhu bergedil ayam + 2 bekas sos kicap pedas. Sesuai untuk majlis & jamuan.', 'is_featured' => false, 'sort_order' => 3, 'image_path' => '/images/menu/ayam-20.jpg'],
            // Tauhu Bergedil Daging
            ['category' => 'tauhu-bergedil-daging', 'name' => 'Pakej 6 Percubaan', 'quantity' => 6, 'price' => 13.00, 'description' => '6 keping tauhu bergedil daging berintipadu + sos kicap pedas.', 'is_featured' => true, 'sort_order' => 1, 'image_path' => '/images/menu/daging-6.jpg'],
            ['category' => 'tauhu-bergedil-daging', 'name' => 'Pakej 10 Keluarga', 'quantity' => 10, 'price' => 20.00, 'description' => '10 keping tauhu bergedil daging + sos kicap pedas.', 'is_featured' => false, 'sort_order' => 2, 'image_path' => '/images/menu/daging-10.jpg'],
            ['category' => 'tauhu-bergedil-daging', 'name' => 'Pakej 20 Majlis', 'quantity' => 20, 'price' => 38.00, 'description' => '20 keping tauhu bergedil daging + 2 bekas sos kicap pedas.', 'is_featured' => false, 'sort_order' => 3, 'image_path' => '/images/menu/daging-20.jpg'],
            // Popia Begedil
            ['category' => 'popia-bergedil', 'name' => 'Popia Bergedil 4', 'quantity' => 4, 'price' => 8.00, 'description' => 'Popia begedil ayam digoreng bersalut telur, perang keemasan + sos kicap.', 'is_featured' => false, 'sort_order' => 1, 'image_path' => '/images/menu/popia-4.jpg'],
            ['category' => 'popia-bergedil', 'name' => 'Popia Bergedil 8', 'quantity' => 8, 'price' => 15.00, 'description' => '8 keping popia begedil rangup salut telur + sos kicap pedas.', 'is_featured' => false, 'sort_order' => 2, 'image_path' => '/images/menu/popia-8.jpg'],
        ];

        foreach ($menu as $item) {
            MenuItem::firstOrCreate(
                ['slug' => $this->slugForMenu($item['category'], $item['name'])],
                [
                    'category_id' => Category::where('slug', $item['category'])->value('id'),
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'image_path' => $item['image_path'],
                    'is_available' => true,
                    'is_featured' => $item['is_featured'],
                    'sort_order' => $item['sort_order'],
                ]
            );
        }
    }

    private function slugForMenu(string $categorySlug, string $name): string
    {
        return \Str::slug($categorySlug . '-' . $name);
    }

    private function seedBlog(): void
    {
        $posts = [
            [
                'category' => 'resepi',
                'title' => 'Resepi Tauhu Bergedil Rangup Macam Kedai',
                'slug' => 'resepi-tauhu-bergedil-rangup',
                'excerpt' => 'Belajar cara buat tauhu bergedil rangup dan padat isi dari rumah — tipografi rahsia dari dapur INAMAN.',
                'image_path' => '/images/blog/resepi.jpg',
                'published_at' => now()->subDays(3),
                'content' => '<p>Tauhu bergedil yang sedap bermula dari tauhu kering yang betul dan inti yang padat. Di INAMAN, kami sumbat setiap tauhu dengan begedil ayam atau daging sehingga penuh, kemudian salut telur dan goreng sehingga perang keemasan.</p><h3>Bahan-bahan</h3><ul><li>Tauhu bulat kering</li><li>Kentang lecek</li><li>Isi ayam/daging cincang</li><li>Bawang besar, bawang putih</li><li>Daun sup & serbuk lada</li><li>Telur untuk salutan</li></ul><h3>Langkah</h3><ol><li>Korek bahagian dalam tauhu dan simpan isi tauhu.</li><li>Campur kentang lecek, daging, bawang dan perasa.</li><li>Sumbat inti ke dalam tauhu sehingga padat.</li><li>Celup dalam telur yang dipukul.</li><li>Goreng dalam minyak panas sehingga perang keemasan.</li><li>Hidang bersama sos kicap pedas.</li></ol><p>Tip: minyak mesti betul-betul panas supaya tauhu keluar rangup dan tak berminyak. Selamat mencuba!</p>',
            ],
            [
                'category' => 'kisah-kami',
                'title' => 'Kisah Di Sebalik INAMAN Tauhu Bergedil',
                'slug' => 'kisah-di-sebalik-inaman',
                'excerpt' => 'Bermula dari dapur kecil, INAMAN membawa tauhu bergedil buatan tangan ke Sungai Buloh.',
                'image_path' => '/images/blog/kisah.jpg',
                'published_at' => now()->subDays(7),
                'content' => '<p>Setiap bisnes makanan ada kisahnya. INAMAN Tauhu Bergedil bermula dari minat keluarga terhadap tauhu bergedil yang rangup, padat isi dan sos yang sekata rasa.</p><p>Kami percaya bahan segar dan buatan tangan setiap hari ialah rahsia keenakan. Tidak ada bahan serba cepat — semuanya dibuat dengan sabar, dari menyediakan inti sehinggalah menggoreng pada suhu yang tepat.</p><p>Hari ini, INAMAN terletak di Sungai Buloh, Selangor dan terbuka untuk walk-in dan tempahan majlis. Terima kasih kerana menyokong bisnes tempatan!</p>',
            ],
            [
                'category' => 'resepi',
                'title' => '5 Tips Goreng Tauhu Bergedil Kekal Rangup',
                'slug' => '5-tips-goreng-tauhu-bergedil-rangup',
                'excerpt' => 'Rahsia tauhu bergedil kekal rangup walaupun dah sejuk — 5 tips mudah untuk di rumah.',
                'image_path' => '/images/blog/tips.jpg',
                'published_at' => now()->subDays(14),
                'content' => '<ol><li><strong>Keringkan tauhu</strong> sebelum sumbat supaya tidak berair.</li><li><strong>Inti jangan terlalu basah</strong> — kentang lecek mesti kering dan sejuk sebelum digaul.</li><li><strong>Salut telur secukupnya</strong> — terlalu tebal membuat tepung tebal, terlalu nipis tak rangup.</li><li><strong>Goreng dua kali</strong> — pertama dengan api sederhana untuk masak, kedua api besar untuk rangup.</li><li><strong>Toskan atas rack</strong> bukan tisu, supaya bawah tak lembap.</li></ol><p>Itulah cara kami pastikan setiap keping INAMAN kekal rangup dari kedai sampai ke rumah.</p>',
            ],
        ];

        foreach ($posts as $p) {
            BlogPost::firstOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => Category::where('slug', $p['category'])->value('id'),
                    'title' => $p['title'],
                    'excerpt' => $p['excerpt'],
                    'content' => $p['content'],
                    'image_path' => $p['image_path'],
                    'published_at' => $p['published_at'],
                ]
            );
        }
    }

    private function seedSettings(): void
    {
        $settings = [
            'brand_name' => 'INAMAN TAUHU BERGEDIL',
            'tagline' => 'Tauhu bergedil rangup, padat isi, sos kicap pedas',
            'about_title' => 'Kisah Kami',
            'about_text' => 'INAMAN Tauhu Bergedil dibuat fresh setiap hari dengan bahan pilihan. Tauhu disumbat penuh dengan begedil ayam atau daging, digoreng bersalut telur sehingga garing keemasan dan dihidang dengan sos kicap pedas.',
            'address' => 'No 11 Jalan Selasih 5, Saujana Utama 3, 47000 Sungai Buloh, Selangor',
            'phone' => '011 3144 1795',
            'whatsapp' => '601131441795',
            'hours' => 'Isnin - Ahad: 9:00 pagi - 6:00 petang',
            'facebook' => '',
            'instagram' => '',
            'tiktok' => '',
            'map_src' => 'https://maps.google.com/maps?q=Sungai%20Buloh%2C%20Selangor&t=&z=13&ie=UTF8&iwloc=&output=embed',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}