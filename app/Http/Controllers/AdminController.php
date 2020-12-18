<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
    }

    public function index()
    {

        $user = auth()->user();
        $count_currrent_month_user = (new \App\Models\User)->currentMonthUser();
        $count_currrent_month_posts = (new \App\Models\User)->currentMonthPost();
        $posts = Post::all();
        return view('admin.dashboard',compact('user','count_currrent_month_user','posts','count_currrent_month_posts'));

    }
}



