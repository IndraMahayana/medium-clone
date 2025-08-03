<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DB::listen(function ($query) {
        //     Log::info($query->sql);
        // });

        // $user = auth()->user();

        $posts = Post::with('user')
            // ->where('published_at', '<=', now())
            ->withCount('claps')
            ->latest()
            ->paginate(5);
        // if ($user) {
        //     $ids = $user->following()->pluck('users.id');
        //     $query->whereIn('user_id', $ids);
        // }

        // $posts = $query->paginate(5);
        return View('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return View('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        // Get the uploaded file from the request, not from $data
        $image = $request->file('image');
        // unset($data['image']);
        $data['user_id'] = Auth::id();
        // $data['slug'] = Str::slug($data['title']);

        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        Post::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::get();

        return View('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validated();

        // Get the uploaded file from the request, not from $data
        $image = $request->file('image');
        $data['user_id'] = Auth::id();

        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        $post->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Post update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $post->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Post deleted successfully.');
    }

    public function category(Category $category)
    {
        $user = auth()->user();

        $query = $category->posts()
            ->with('user')
            ->where('published_at', '<=', now())
            ->withCount('claps')
            ->latest();

        if ($user) {
            $ids = $user->following()->pluck('users.id');
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->paginate(5);

        return View('post.index', [
            'posts' => $posts,
        ]);
    }

    public function myPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()
            ->with('user')
            ->withCount('claps')
            ->latest()
            ->paginate(5);

        return View('post.index', [
            'posts' => $posts,
        ]);
    }
}
