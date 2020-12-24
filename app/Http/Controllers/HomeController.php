<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
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
    private $postRepository;
    private $userRepository;
    public function __construct(PostRepositoryInterface $postRepository,UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->userRepository->redirectUser();

    }

}
