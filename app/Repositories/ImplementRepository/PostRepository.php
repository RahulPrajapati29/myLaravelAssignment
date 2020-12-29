<?php


namespace App\Repositories\ImplementRepository;


use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Route;



class PostRepository implements PostRepositoryInterface
{
    public function find($id)
    {
        return Post::find($id);
    }
    public function all()
    {
        return Post::all();
    }
    public function index($request)
    {
        if ($request->ajax()) {
            $data = Post::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function ($data){
                    return DB::table('users')->where('id', $data->user_id)->pluck('name')[0];
                })
                ->addColumn('edit', function ($data) {
                    return '<a href="'.route('post.edit', $data->id).'" class="btn btn-primary" >Edit</a>';
                })
                ->addColumn('delete', function ($data) {

                    $c = csrf_field();
                    $m = method_field('DELETE');

                    return '<form action= "'.route('post.destroy',$data->id).'" method="POST")>

                            '.$c.'

                            '.$m.'

                            <button class="btn btn-primary"> Delete</button>
                            </form>';
                })
                ->rawColumns(["name","edit","delete"])
                ->make(true);
        }
        return view('posts.list');
    }
    public function create()
    {
        $user = auth()->user();

        return view('posts.create',compact('user'));

    }
    public function store($request)
    {
        (new \App\Models\Post)->storeThePost($request);
        return redirect(route('post.index'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.edit',compact('post',));
    }
    public function update($request,$id)
    {
        (new \App\Models\Post)->updateThePost($request,$id);
        return redirect(route('post.index'));
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('post.index'));
    }
}


