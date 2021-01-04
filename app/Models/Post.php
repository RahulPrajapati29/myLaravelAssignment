<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function updateThePost($request,$id)
    {
        date_default_timezone_set('Asia/Kolkata');
        $current_time = date('Y-m-d H:i:s');
        $data = $request->validated();
        $post = Post::find($id);
        $imagePath = $post->image;

        if(request('image'))
        {
            $imagePath = request('image');
            $imagePath = request('image')->store('uploads','public');


        }
        $post->update(array_merge(
            $data,
            ['image' => $imagePath, 'created_at' => $current_time, 'updated_at' => $current_time]
        ));
    }
    public function storeThePost($request)
    {
        $data = $request->validated();
        $imagePath = request('image')->store('uploads','public');
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
    }
}
