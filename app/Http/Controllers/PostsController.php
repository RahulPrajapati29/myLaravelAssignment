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

    public function create()
    {
        $user = auth()->user();

        return view('posts.create',compact('user'));

    }
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);

        $imagePath = request('image')->store('uploads','public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect('/admin');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        //dd($post);
        return view('admin.edit',compact('post',));
    }
    public function update($id)
    {
        date_default_timezone_set('Asia/Kolkata');
        $current_time = date('Y-m-d H:i:s');
        $data = request()->validate([
            'caption' => 'required',
            'image' => ''
        ]);
        $post = Post::find($id);
        $imagePath = $post->image;

        if(request('image'))
        {
            $imagePath = request('image');
            $imagePath = request('image')->store('uploads','public');


        }
        $post->update(array_merge(
            $data,
            ['image' => $imagePath, 'created_at' => $current_time, 'updated_at' => $current_time]
        ));
        return redirect("/admin");
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect("/admin");
    }

}
