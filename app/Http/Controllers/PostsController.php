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



}
