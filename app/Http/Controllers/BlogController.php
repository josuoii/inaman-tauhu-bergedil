<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function show(BlogPost $post)
    {
        abort_unless($post->published_at !== null && $post->published_at->lte(now()), 404);

        $recent = BlogPost::published()
            ->whereKeyNot($post->getKey())
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'recent'));
    }
}