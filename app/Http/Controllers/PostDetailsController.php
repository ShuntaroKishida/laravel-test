<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostDetailsController extends Controller
{
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        return view('posts.show', ['post' => $post]);
    }
}
