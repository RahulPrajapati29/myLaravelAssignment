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
        $array = array();
        $posts = Post::all();
        foreach($posts as $x){
            $array[] = ($x['user_id']);
        }
        $posts = Post::whereIn('user_id',$array)->paginate(5);
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
        $user_name = request('name');
        if(User::find($user_id))
        {
            $update = DB::table('users')->where('id', $user_id)->update(['isAdmin' => true]);
            return Redirect::to("/admin")->with('success', true)->with('message',"{$user_name} has been granted admin permission.");;
        }
        else{
            return Redirect::to("admin/permission")->with('success', false)->with('message','Not a registered user.');;
        }
    }
    public function edit($index,User $user)
    {   $pos = $index;
        $array = array();
        $posts = Post::all();
        foreach($posts as $x){
            $array[] = ($x['user_id']);
        }
        $post = Post::whereIn('user_id',$array)->get();
        return view('admin.edit',compact('pos','post','user'));
    }

    public function update()
    {
        date_default_timezone_set('Asia/Kolkata');
        $current_time = date('Y-m-d H:i:s');
        $post = Post::all();
        $user = auth()->user();
        $data = request()->validate([
            'caption' => 'required',
            'image' => ''
        ]);
        $pos = htmlspecialchars($_REQUEST['path']);
        $imagePath = $post[$pos]->image;
        if(request('image'))
        {
            $imagePath = request('image');
            $imagePath = request('image')->store('uploads','public');


        }
        $post[$pos]->update(array_merge(
            $data,
            ['image' => $imagePath, 'created_at' => $current_time, 'updated_at' => $current_time]
        ));
        return redirect("/admin");
    }
    public function destroy($index)
    {
        $array = array();
        $posts = Post::all();
        foreach($posts as $x){
            $array[] = ($x['user_id']);
        }
        $post = Post::whereIn('user_id',$array)->get();
        $delete_post = $post[$index];
        $delete_post->delete();
        return redirect("/admin");
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
