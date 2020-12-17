<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\PermissionController;
class AdminController extends Controller
{
    public function __construct(PermissionController $permissionController)
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
        $this->PermissionController = $permissionController;
    }
    public function index()
    {
        $array = array();
        $posts = Post::all();
        foreach($posts as $x){
            $array[] = ($x['user_id']);
        }
        $posts = Post::paginate(5);
        //dd($posts);
        $user = auth()->user();
        //dd($posts->links());
        return view('admin.show',compact('user','posts'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('admin.grantaccess',compact('user'));
    }
    public function store()
    {

        $user = auth()->user();
        $data = request()->validate([
            'id' => 'required',
            'name' => 'required'
        ]);
        $user_id = request('id');
        $user_name = DB::table('users')->where('id', $user_id)->pluck('name');
        $response = $this->PermissionController->setPermission($user_id, $user_name, $data);
        return $response;

    }

    public function show()
    {
        //$users = auth()->user()->posts()->pluck('posts.user_id');

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
