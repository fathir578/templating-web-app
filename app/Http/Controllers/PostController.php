<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create([
        'title' => $request->title,
        'body' => $request->body,
    ]);

        return redirect('/posts');
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect('/posts');
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts');
    }
}
