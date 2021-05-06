<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);

       Post::create([
           'name' => request('name'),
       ]);
   
       return redirect('/posts');
    }
    public function index()
    {
         dd(Post::all());
        $posts= Post::all();
        // return view('posts.index',compact('posts'));
        return view('posts.index',['posts'=>$posts]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit',['post'=>$post]);
    }

    public function update(Post $post)
    {
        // dd(request()->all());
        request()->validate([
            'name' => 'required',
        ]);

        $post->update([
            'id'=>request('id'),
            'name'=>request('content')
        ]);

        return redirect('/posts');
    }
}

