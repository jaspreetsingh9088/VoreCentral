<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usercontent;
use App\Models\User;
use App\Models\Owncollaction;
use App\Models\Tag;
use App\Traits\ApiResponse;
use App\Traits\CheckPermissionTrait;
use Illuminate\Support\Facades\Auth;

class GallaryAdminController extends Controller
{

    public function index(Request $request)
    {
        $permissions = $request->session()->get('permission');
        // $gallary_item = Usercontent::join('users', 'usercontents.userid', '=', 'users.id')->orderBy('usercontents.id','DESC')->with(['dislike','like'])->get();

        return view('admin.gallary.index');
    }

    public function create(){
        $TagData = Tag::get()->toArray();
        return view('admin.gallary.create',compact('TagData'));
    }

    public function store(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'type' => 'required',
            'category' => 'required',
       ]);

        $Usercontent = new Usercontent();
        $Usercontent->title = $request->title ;
        $Usercontent->userid = Auth::user()->id ;
        $Usercontent->description = $request->description ;
        $Usercontent->tags = implode(",", $request->tags);
        if($request->series){
            $Usercontent->series = implode(",", $request->series);
        }
        $Usercontent->type = implode(",", $request->type) ;
        $Usercontent->category = implode(",", $request->category) ;

        if($request->video_url){
            $url = $request->video_url;
            $substr = "=";
            if (strpos($url, $substr) !== false) {
                $url_arr  = explode("=", $url);
                $video_id = $url_arr[1];
            } else {
                $url_arr  = explode("/", $url);
                $video_id = $url_arr[3];
            }
            $embed_url = "https://www.youtube.com/embed/" . $video_id;
            $Usercontent->video_url = $embed_url;
        }

        $Usercontent->monetise = $request->monetise ;

        if ($request->file('content')) {
            $file= $request->file('content');
            $filename= time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('content'), $filename);
            $Usercontent->content = $filename;
        }

        if ($request->file('thumbnail')) {
            $Usercontent->thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'thumbnail');
        }
        $Usercontent->save();

        // $activity = new Activity();
        // $activity->userid = Auth::user()->id;
        // $activity->content = "You have posted in the gallery.";
        // $activity->save();

        return redirect()->back()->with('Content store succesfully');
    }

    public function updatestatus($id,$status)
    {
        if($status == 'promoted'){
            $content = Usercontent::where('id',$id)->first();
            $content->promoted = 1;
            $content->save();
            return redirect()->back()->with('Content promoted succesfully');
        }else if($status == 'demote'){
            $content = Usercontent::where('id',$id)->first();
            $content->promoted = 0;
            $content->save();
            return redirect()->back()->with('Content demote succesfully');
        }else if($status == 'featured'){
            $content = Usercontent::where('id',$id)->first();
            $content->is_featured = 1;
            $content->save();
            return redirect()->back()->with('Content make featured succesfully');
        }else if($status == 'mature'){
            $content = Usercontent::where('id',$id)->first();
            $content->is_featured = 0;
            $content->save();
            return redirect()->back()->with('Content make mature succesfully');
        }else{
            $gallary = Usercontent::find($id);
            $gallary->status = ($status==1?0:1);
            $gallary->save();
           return redirect()->back()->with('Status updated succesfully');
        }
    }
    public function destroy($id){
        $content = Usercontent::where('id',$id)->first();
        $content->delete();
        return redirect()->back()->with('Content delete succesfully');
    }
}
