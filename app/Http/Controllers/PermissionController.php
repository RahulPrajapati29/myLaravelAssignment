<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    //
    public function create()
    {
        $user = auth()->user();
        $items = User::all();
        return view('admin.grantaccess',compact('user','items'));
    }
    public function store()
    {
        $user = auth()->user();
        $data = request()->validate([
            'id' => 'required',
        ]);
        $user_id = request('id');
        $user_name = DB::table('users')->where('id', $user_id)->pluck('name');
        $response = $this->setPermission($user_id, $user_name, $data);
        return $response;

    }
    public function setPermission($user_id, $user_name, $data)
    {
        if(User::find($user_id))
        {
            if(DB::table('users')->where('id', $user_id)->pluck('isAdmin')[0] == 1){
                return Redirect::to("/admin/permission")->with('success', true)->with('message',"{$user_name[0]} is already Admin.");

            }
            $update = DB::table('users')->where('id', $user_id)->update(['isAdmin' => true]);
            return Redirect::to("/admin/permission")->with('success', true)->with('message',"Success! {$user_name[0]} has been granted admin permission.");
        }
        else{
            return Redirect::to("admin/permission")->with('Error', false)->with('message','Not a registered user.');
        }
    }
}
