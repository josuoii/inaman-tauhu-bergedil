<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\MenuItem;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            ['label' => 'Menu Pakej', 'value' => MenuItem::count(), 'icon' => 'menu'],
            ['label' => 'Tersedia', 'value' => MenuItem::where('is_available', true)->count(), 'icon' => 'check'],
            ['label' => 'Kategori', 'value' => Category::count(), 'icon' => 'cat'],
            ['label' => 'Resepi / Kisah', 'value' => BlogPost::count(), 'icon' => 'blog'],
        ];

        $recentMenu = MenuItem::with('category')->latest()->limit(5)->get();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentMenu' => $recentMenu,
        ]);
    }
}