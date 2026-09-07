<?php

namespace App\Livewire\Menu;

use App\Models\Category;
use App\Models\MenuItem;
use Livewire\Component;

class Index extends Component
{
    public ?int $categoryId = null;

    public function setCategory(?int $id): void
    {
        $this->categoryId = $id;
    }

    public function whatsappMessage(MenuItem $item): string
    {
        $phone = \App\Models\SiteSetting::get('whatsapp', '601131441795');
        $text = urlencode("Assalamualaikum, saya ingin menempah {$item->name} ({$item->quantity} keping) - {$item->formatted_price}.");

        return "https://wa.me/{$phone}?text={$text}";
    }

    public function render()
    {
        $categories = Category::where('type', 'menu')->orderBy('sort_order')->get();

        $items = MenuItem::with('category')
            ->when($this->categoryId, fn ($q) => $q->where('category_id', $this->categoryId))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('livewire.menu.index', [
            'categories' => $categories,
            'items' => $items,
        ]);
    }
}