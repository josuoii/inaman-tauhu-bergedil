<?php

namespace App\Livewire\Blog;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $categoryId = null;

    public function setCategory(?int $id): void
    {
        $this->categoryId = $id;
        $this->resetPage();
    }

    public function render()
    {
        $categories = \App\Models\Category::where('type', 'blog')->orderBy('sort_order')->get();

        $posts = BlogPost::published()
            ->with('category')
            ->when($this->categoryId, fn ($q) => $q->where('category_id', $this->categoryId))
            ->orderByDesc('published_at')
            ->paginate(6);

        return view('livewire.blog.index', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
}