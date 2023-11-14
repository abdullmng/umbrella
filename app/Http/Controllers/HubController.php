<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index()
    {
        $topics = Category::all();
        $posts = Post::latest()->paginate(10);

        if (request()->has("s")) {
            $posts = Post::where("name","like","%". request("s")."%")->orWhere('description', 'like','%'. request('s').'%')->orWhere('content', 'like','%'. request('s').'%')->paginate(10);
        }
        return view("users.hub", ["topics" => $topics,"posts"=> $posts]);
    }

    public function topic($id)
    {
        $topic = Category::where('id', $id)->first();
        $topics = Category::all();
        $posts = Post::where('category_id', $id)->latest()->paginate(10);

        if (request()->has("s")) {
            $posts = Post::where('category_id', $id)->where("name","like","%". request("s")."%")->orWhere('description', 'like','%'. request('s').'%')->orWhere('content', 'like','%'. request('s').'%')->paginate(10);
        }
        return view("users.hub_topic", ["topics" => $topics,"posts"=> $posts, 'cat' => $topic]);
    }

    public function postComment($id, Request $request)
    {
        $request->validate(['comment' => 'required']);

        if (!is_null($request->comment_id))
        {
            $reply = Reply::create([
                'comment_id' => $request->comment_id,
                'user_id' => $request->user_id,
                'reply' => $request->comment
            ]);
            return back();
        }

        $comment = Comment::create(
            [
                'user_id' => $request->user_id,
                'post_id' => $id,
                'comment' => $request->comment
            ]
        );

        return back();
    }
}
