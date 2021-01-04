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


