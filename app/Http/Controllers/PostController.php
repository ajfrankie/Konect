<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'Content' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/posts');

        $post = Post::create([
            'subject' => $request->input('subject'),
            'Content' => $request->input('Content'),
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('blog.article', compact('posts'));
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }


        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);


        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'Content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $post = Post::findOrFail($id);


        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->subject = $request->input('subject');
        $post->Content = $request->input('Content');

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $post->image = $request->file('image')->store('public/posts');
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function create()
    {
        return view('posts.create');
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.show', compact('post'));
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        // Validate the search query
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        // Search posts by title
        $posts = Post::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('blog.search_results', compact('posts', 'searchTerm'));
    }
}
