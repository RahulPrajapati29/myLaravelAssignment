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
        $posts = Post::all();
        $user = auth()->user();
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $count_currrent_month_user = 0;
        $count_currrent_month_posts = 0;
        $users = User::all();


        foreach($users as $x=>$val){
            $c_day = $val['created_at']->day;
            $c_month = $val['created_at']->month;
            $c_year = $val['created_at']->year;
            if($c_year == $year and $c_month == $month and $c_day == $day){
                $count_currrent_month_user +=1;
            }
        }
        foreach($posts as $x=>$val){
            $c_day = $val['created_at']->day;
            $c_month = $val['created_at']->month;
            $c_year = $val['created_at']->year;
            if($c_year == $year and $c_month == $month and $c_day == $day){
                $count_currrent_month_posts +=1;
            }
        }
        return view('admin.dashboard',compact('user','count_currrent_month_user','posts','count_currrent_month_posts'));

    }
}



