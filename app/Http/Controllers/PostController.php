<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //reads all posts and all categories from the database
        $posts = Post::all()->sortByDesc('created_at');
        $categories = Category::all();
        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $post = new Post;
        return view('posts.create', compact('users', 'categories'))->with('post', $post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new post instance
        $newPost = new Post;
        $newPost->title = $validatedData['title'];
        $newPost->body = $validatedData['body'];
        $newPost->author_id = $validatedData['author_id'];
        $newPost->category_id = $validatedData['category_id'];
        $newPost->save();

        // Redirect to the newly created post
        return redirect()->route('posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.show', compact('users', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit', compact('users', 'post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //very basic validation - there shold be at least some data in the fields
        if ($request->title == null || $request->author_id == null || $request->body == null) {
            //if you deleted everyting - go back and fill it!
            return redirect()->route('posts.edit', $id);
        }
        
        //all clear - updating the post!
        $post = Post::find($id);
        $post->title = $request->title;
        $post->author_id = $request->author_id;
        $post->body = $request->body;
        $post->save();
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::findOrfail($id)->delete();
        return redirect()->route('posts.index');    
    }
}
