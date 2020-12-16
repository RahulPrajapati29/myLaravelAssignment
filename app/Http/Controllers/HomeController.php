<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\True_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->isAdmin)
        {
            return view('home');
        }
        else if(!$user->isAdmin)
        {
            $posts = Post::all();
            //dd($posts);
            return view('posts.show',compact('posts'));
        }
        else
        {
            return abort(404, "The Partner was not found");
        }
    }

}
