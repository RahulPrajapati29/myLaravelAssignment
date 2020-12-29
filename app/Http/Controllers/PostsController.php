<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostValidation;
use App\Http\Requests\UpdatePostValidation;
use App\Models\Post;
use App\Repositories\ImplementRepository\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\isUserAdmin');
        $this->postRepository = $postRepository;
    }
    public function index(Request $request)
    {
        return $this->postRepository->index($request);
    }
    public function create()
    {
        return $this->postRepository->create();

    }
    public function store(StorePostValidation $request)
    {
        return $this->postRepository->store($request);
    }

    public function edit($id)
    {
        return $this->postRepository->edit($id);
    }
    public function update(UpdatePostValidation $request,$id)
    {
        return $this->postRepository->update($request,$id);
    }
    public function destroy($id)
    {
        return $this->postRepository->destroy($id);
    }



}
