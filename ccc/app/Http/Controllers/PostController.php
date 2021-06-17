<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Comment_post;
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
        // $posts= Post::all();
        // return view('posts.index',compact('posts'));
            // $posts = Comment::with(relations: 'getPostId')->get();
            // echo "<pre>";
            // $posts=Post::find(1)->getCommentId;
            // print_r($posts);

            // $posts=Post::find(1);
            // dd($posts->comments);
            // $comment1=Comment::find(1);
            // dd($comment1->comments);

            //counts realtionship
            $posts = Post::withCounts('comments')->get();
            dd($posts);
            die;
            // Event::find(1)->course;
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

