<?php


namespace App\Repositories\ImplementRepository;


use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

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
    public function index()
    {
        $posts = $this->all();
        $posts = Post::paginate(5);
        $user = auth()->user();
        return view('posts.list',compact('user','posts'));
    }
    public function create()
    {
        $user = auth()->user();

        return view('posts.create',compact('user'));

    }
    public function store()
    {
        (new \App\Models\Post)->storeThePost();
        return redirect(route('post.index'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.edit',compact('post',));
    }
    public function update($id)
    {
        (new \App\Models\Post)->updateThePost($id);
        return redirect(route('post.index'));
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('post.index'));
    }
}


