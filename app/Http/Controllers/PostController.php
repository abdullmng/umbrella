<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::where('id', $id)->with(['comments', 'user'])->first();
        $related = Post::where('category_id', $post->category_id)->where('id', '!=', $id)->latest()->limit(3)->get();
        return view('users.hub_post', ['post' => $post, 'related_posts' => $related]);
    }
}
