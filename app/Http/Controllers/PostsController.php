<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
    }
    public function index()
    {
        $posts = Post::all();
        $posts = Post::paginate(5);
        $user = auth()->user();
        return view('posts.list',compact('user','posts'));
    }
    public function create()
    {
        $user = auth()->user();

        return view('posts.create',compact('user'));

    }
    public function store()
    {
        (new \App\Models\Post)->storeThePost();
        return redirect(route('post.index'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.edit',compact('post',));
    }
    public function update($id)
    {
        (new \App\Models\Post)->updateThePost($id);
        return redirect(route('post.index'));
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('post.index'));
    }

}
