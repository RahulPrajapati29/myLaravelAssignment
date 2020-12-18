<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }

    public function currentMonthUser()
    {
        $users = User::all();
        $count_currrent_month_user = 0;
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        foreach($users as $x=>$user){
            $c_day = $user['created_at']->day;
            $c_month = $user['created_at']->month;
            $c_year = $user['created_at']->year;
            if($c_year == $year and $c_month == $month and $c_day == $day){
                $count_currrent_month_user +=1;
            }
        }
        return $count_currrent_month_user;
    }

    public function currentMonthPost()
    {
        $posts = Post::all();
        $count_currrent_month_posts = 0;
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        foreach($posts as $x=>$post){
            $c_day = $post['created_at']->day;
            $c_month = $post['created_at']->month;
            $c_year = $post['created_at']->year;
            if($c_year == $year and $c_month == $month and $c_day == $day){
                $count_currrent_month_posts +=1;
            }
        }
        return $count_currrent_month_posts;
    }

}
