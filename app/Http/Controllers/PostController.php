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

        $post = new Post();
        $post->subject = $request->input('subject');
        $post->Content = $request->input('Content');
        $post->image = $imagePath;
        $post->user_id = auth()->id();


        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }


    public function index()
    {
        $posts = Post::all();
        return view('blog.article', compact('posts'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::delete($post->image);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
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
        $post->subject = $request->input('subject');
        $post->Content = $request->input('Content');

        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::delete($post->image);
            }


            $imagePath = $request->file('image')->store('public/posts');
            $post->image = $imagePath;
        }


        $post->save();


        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function create()
    {
        return view('posts.create');
    }
}
