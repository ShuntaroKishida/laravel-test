<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\PostService;

class PostsController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(PostRequest $request)
    {
        $this->postService->createPost($request->validated());
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.show', ['post' => $post]);
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('posts.index');
    }
}
