<?php

namespace App\Livewire\Admin\Blog;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public int $editingId = 0;
    public bool $showForm = false;

    public string $title = '';
    public string $excerpt = '';
    public string $content = '';
    public string $imagePath = '';
    public int $categoryId = 0;
    public string $publishedAt = '';

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = 0;
    }

    public function edit(int $id): void
    {
        $post = BlogPost::findOrFail($id);
        $this->editingId = $post->id;
        $this->title = $post->title;
        $this->excerpt = $post->excerpt ?? '';
        $this->content = $post->content;
        $this->imagePath = $post->image_path ?? '';
        $this->categoryId = $post->category_id ?? 0;
        $this->publishedAt = $post->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i');
        $this->showForm = true;
    }

    public function delete(int $id): void
    {
        BlogPost::findOrFail($id)->delete();
    }

    public function save(): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'imagePath' => ['nullable', 'string', 'max:500'],
            'categoryId' => ['nullable', 'exists:categories,id'],
            'publishedAt' => ['required', 'date'],
        ]);

        $data = [
            'category_id' => $this->categoryId ?: null,
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(5),
            'excerpt' => $this->excerpt ?: null,
            'content' => $this->content,
            'image_path' => $this->imagePath ?: null,
            'published_at' => \Carbon\Carbon::parse($this->publishedAt),
        ];

        if ($this->editingId) {
            BlogPost::findOrFail($this->editingId)->update($data);
        } else {
            BlogPost::create($data);
        }

        $this->showForm = false;
        $this->dispatch('blog-saved', message: 'Artikel disimpan.');
    }

    private function resetForm(): void
    {
        $this->editingId = 0;
        $this->title = '';
        $this->excerpt = '';
        $this->content = '';
        $this->imagePath = '';
        $this->categoryId = Category::where('type', 'blog')->value('id') ?? 0;
        $this->publishedAt = now()->format('Y-m-d\TH:i');
    }

    public function render()
    {
        $categories = Category::where('type', 'blog')->orderBy('sort_order')->get();
        $posts = BlogPost::with('category')->orderByDesc('published_at')->get();

        return view('livewire.admin.blog.index', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
}