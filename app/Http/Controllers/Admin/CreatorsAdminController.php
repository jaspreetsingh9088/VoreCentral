<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminCreatorRequest;

class CreatorsAdminController extends Controller
{
    public function index()
    {
        $Creator = Creator::all()->toArray();
        return view('admin.creators.index',compact('Creator'));
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function create($id){
        $user = User::where('id',$id)->first();
        return view('admin.creators.create',compact('user'));
    }

    public function store(AdminCreatorRequest $request){
        $creator = New Creator;
        $creator->paypal = $request->paypal;
        $creator->content_type = $request->content_type;
        $creator->old_account = $request->old_account;
        $creator->content_description = $request->content_description;
        $creator->subgenres = $request->subgenres;
        $creator->userid = $request->user_id;
        $creator->status = 1;
        $creator->save();

        return redirect()->back()->with('User Role change succesfully');
    }

     public function updatestatus($id,$status)
    {
            $new_status = $status == 1 ? 0 : 1;
            $Creator = Creator::find($id);
            $Creator->status = $new_status;
            $Creator->save();

            $user = User::where('id',$Creator->userid->id)->first();
            $user->creator = $new_status;
            $user->save();

            return redirect()->back()->with('Status updated succesfully');
    }

    /**
     * Make Creator
     */
    public function makeCreator($id)
    {
        $username = User::where('id', $id)->value('username');

        // Creator create
        $creator = new Creator;
        $creator->userid = $id;
        $creator->status = 1;
        $creator->save();

        // User status changed
        User::where('id', $id)->update(['creator' => 1]);


        return redirect()->back()->with(['message' => $username.' role change succesfully']);
    }
}
