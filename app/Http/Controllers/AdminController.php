<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
class AdminController extends Controller
{
    private $postRepository;
    private $userRepository;
    public function __construct(PostRepositoryInterface $postRepository,UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {

        return $this->userRepository->fetchDashboardData();

    }
}



