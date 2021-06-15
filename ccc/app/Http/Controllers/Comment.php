<?php

namespace App\Http\Controllers;
use App\Models\Comment as CommentModel;
use Illuminate\Http\Request;

class Comment extends Controller
{
    public function index()
    {
        echo "<pre>";
        $post = CommentModel::find(1)->getPostId();
        print_r($post);
    }
}
