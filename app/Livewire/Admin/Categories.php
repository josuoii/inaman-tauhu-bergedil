<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Categories extends Component
{
    public string $name = '';
    public string $type = 'menu';
    public int $sortOrder = 0;
    public ?int $editingId = null;

    public function create(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:menu,blog'],
            'sortOrder' => ['integer', 'min:0'],
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name) . '-' . Str::random(4),
            'type' => $this->type,
            'sort_order' => $this->sortOrder,
        ]);

        $this->reset(['name', 'sortOrder']);
        $this->dispatch('categories-updated', message: 'Kategori ditambah.');
    }

    public function edit(int $id): void
    {
        $cat = Category::findOrFail($id);
        $this->editingId = $cat->id;
        $this->name = $cat->name;
        $this->type = $cat->type;
        $this->sortOrder = $cat->sort_order;
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingId', 'name', 'type', 'sortOrder']);
    }

    public function saveEdit(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:menu,blog'],
            'sortOrder' => ['integer', 'min:0'],
        ]);

        Category::findOrFail($this->editingId)->update([
            'name' => $this->name,
            'type' => $this->type,
            'sort_order' => $this->sortOrder,
        ]);

        $this->cancelEdit();
        $this->dispatch('categories-updated', message: 'Kategori dikemas kini.');
    }

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
        $this->dispatch('categories-updated', message: 'Kategori dipadam.');
    }

    public function render()
    {
        $categories = Category::orderBy('type')->orderBy('sort_order')->get();

        return view('livewire.admin.categories', ['categories' => $categories]);
    }
}