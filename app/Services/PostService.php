<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function createPost($data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->message = $data['message'];
        $post->save();
        return $post;
    }

    public function getPostById($id)
    {
        return Post::find($id);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }
        return $post;
    }
}
