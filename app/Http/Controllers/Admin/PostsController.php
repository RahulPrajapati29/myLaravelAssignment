<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        return view('posts.list');
    }
    public function create()
    {
        return view('posts.create');
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
    public function show()
    {
        return view('posts.list');
    }
    public function showDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('edit', function ($data) {
                    return '<a href="' . route('post.edit', $data->id) . '" class="btn btn-primary" >Edit</a>';
                })
                ->addColumn('delete', function ($data) {

                    $c = csrf_field();
                    $m = method_field('DELETE');

                    return '<form action= "' . route('post.destroy', $data->id) . '" method="POST")>

                            ' . $c . '

                            ' . $m . '

                            <button class="btn btn-primary deletePost" data-name='.$data->caption.'> Delete</button>
                            </form>';
                })
                ->rawColumns(["name", "edit", "delete"])
                ->make(true);
        }
    }


}
