<?php


namespace App\Repositories;
namespace App\Repositories\ImplementRepository;

use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use http\Message;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function all()
    {
        return User::all();
    }
    public function selectDataWhereNotAdmin()
    {
        return User::select('name','id')->where('isAdmin', false)->orderBy('name')->get();
    }

    public function pluckNameHavingGivenId($user_id)
    {
        return DB::table('users')->where('id', $user_id)->pluck('name');
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create()
    {
        $user = auth()->user();
        $items = $this->selectDataWhereNotAdmin();
        return view('admin.grantaccess', compact('user', 'items'));
    }

    public function store($user_id)
    {
        $response = $this->pluckNameHavingGivenId($user_id);
        return $response[0];
    }

    public function setPermission($user_id, $user_name)
    {
        $affected = DB::update('update users set isAdmin = ? where id = ?',[true,$user_id]);
        $response = redirect('/admin/permission')->with('success', "{$user_name} is now Admin.");
        return $response;
    }
    public function redirectUser()
    {
        $user = auth()->user();
        if($user->isAdmin)
        {
            return view('home');
        }
        else if(!$user->isAdmin)
        {
            $posts = $this->postRepository->all();
            return view('posts.show',compact('posts'));
        }
        else
        {
            return abort(404, "The Partner was not found");
        }
    }
    public function fetchDashboardData()
    {
        $user = auth()->user();
        $count_currrent_month_user = (new \App\Models\User)->currentMonthUser();
        $count_currrent_month_posts = (new \App\Models\User)->currentMonthPost();
        $posts = $this->postRepository->all();
        return view('admin.dashboard',compact('user','count_currrent_month_user','posts','count_currrent_month_posts'));
    }

}
