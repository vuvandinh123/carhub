<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts
     */
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc');
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Filter by tag
        if ($request->has('tag') && $request->tag != '') {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        $posts = $query->paginate(12)->withQueryString();
        $categories = CategoryPost::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        $featuredPosts = Post::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('pages.posts.index', compact('posts', 'categories', 'tags', 'featuredPosts'));
    }
    
    /**
     * Display a single post
     */
    public function show(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }
        
        $post->load(['category', 'tags']);
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->limit(3)
            ->get();
        
        return view('pages.posts.show', compact('post', 'relatedPosts'));
    }
}
