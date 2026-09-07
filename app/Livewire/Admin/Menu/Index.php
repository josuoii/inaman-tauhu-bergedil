<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public int $editingId = 0;
    public bool $showForm = false;

    public string $name = '';
    public int $categoryId = 0;
    public int $quantity = 1;
    public string $price = '';
    public string $description = '';
    public string $imagePath = '';
    public bool $isAvailable = true;
    public bool $isFeatured = false;
    public int $sortOrder = 0;

    public string $search = '';
    public int $filterCategory = 0;

    protected $listeners = ['refreshMenu' => '$refresh'];

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = 0;
    }

    public function edit(int $id): void
    {
        $item = MenuItem::findOrFail($id);
        $this->editingId = $item->id;
        $this->name = $item->name;
        $this->categoryId = $item->category_id ?? 0;
        $this->quantity = $item->quantity;
        $this->price = (string) $item->price;
        $this->description = $item->description ?? '';
        $this->imagePath = $item->image_path ?? '';
        $this->isAvailable = $item->is_available;
        $this->isFeatured = $item->is_featured;
        $this->sortOrder = $item->sort_order;
        $this->showForm = true;
    }

    public function toggleAvailable(int $id): void
    {
        $item = MenuItem::findOrFail($id);
        $item->update(['is_available' => ! $item->is_available]);
    }

    public function toggleFeatured(int $id): void
    {
        $item = MenuItem::findOrFail($id);
        $item->update(['is_featured' => ! $item->is_featured]);
    }

    public function delete(int $id): void
    {
        MenuItem::findOrFail($id)->delete();
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'categoryId' => ['required', 'exists:categories,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'imagePath' => ['nullable', 'string', 'max:500'],
            'sortOrder' => ['integer', 'min:0'],
        ]);

        $data = [
            'category_id' => $this->categoryId,
            'name' => $this->name,
            'slug' => Str::slug($this->name) . '-' . Str::random(5),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description ?: null,
            'image_path' => $this->imagePath ?: null,
            'is_available' => $this->isAvailable,
            'is_featured' => $this->isFeatured,
            'sort_order' => $this->sortOrder,
        ];

        if ($this->editingId) {
            MenuItem::findOrFail($this->editingId)->update($data);
        } else {
            MenuItem::create($data);
        }

        $this->showForm = false;
        $this->dispatch('menu-saved', message: 'Menu disimpan.');
    }

    public function updatedName(): void
    {
        if (! $this->editingId) {
            $this->slugPreview = Str::slug($this->name);
        }
    }

    public ?string $slugPreview = null;

    private function resetForm(): void
    {
        $this->editingId = 0;
        $this->name = '';
        $this->categoryId = Category::where('type', 'menu')->value('id') ?? 0;
        $this->quantity = 6;
        $this->price = '12.00';
        $this->description = '';
        $this->imagePath = '';
        $this->isAvailable = true;
        $this->isFeatured = false;
        $this->sortOrder = 0;
        $this->slugPreview = null;
    }

    public function render()
    {
        $categories = Category::where('type', 'menu')->orderBy('sort_order')->get();

        $items = MenuItem::with('category')
            ->when($this->filterCategory, fn ($q) => $q->where('category_id', $this->filterCategory))
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('livewire.admin.menu.index', [
            'categories' => $categories,
            'items' => $items,
        ]);
    }
}