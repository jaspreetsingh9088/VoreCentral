<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use App\Models\User;
use App\Models\Usertag;
use App\Models\Userantitag;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        $user = User::select('users.id as uid','creators.id as cid','users.*')->leftjoin('creators','creators.userid','users.id')->get()->toArray();
        return view('admin.users.index',compact('user'));
    }


    public function show(User $user)
    {

        return view('admin.users.show');
    }

     public function updatestatus($id,$status)
    {
            $User = User::find($id);
            $User->status = ($status==1?0:1);
            $User->save();
            return redirect()->back()->with('Status updated succesfully');
    }
}
