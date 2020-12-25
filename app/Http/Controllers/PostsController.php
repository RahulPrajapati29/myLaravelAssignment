<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidation;
use App\Models\Post;
use App\Repositories\ImplementRepository\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostsController extends Controller
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        return $this->postRepository->index();
    }
    public function create()
    {
        return $this->postRepository->create();

    }
    public function store(RequestValidation $request)
    {
        return $this->postRepository->store($request);
    }

    public function edit($id)
    {
        return $this->postRepository->edit($id);
    }
    public function update(RequestValidation $request,$id)
    {
        return $this->postRepository->update($request,$id);
    }
    public function destroy($id)
    {
        return $this->postRepository->destroy($id);
    }

}
