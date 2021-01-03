<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index() {

        $posts = Post::latest()->with(['user', 'likes'])->paginate(2);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post){

        if($post->ownedBy(auth()->user())){
            $post->delete();
        }
        return back();
    }
}
