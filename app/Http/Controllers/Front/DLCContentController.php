<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use App\Models\DownloadDlcFile ;
use App\Models\Dlccontents ;
use App\Models\Likedlc;
use App\Models\Dislikedlc;
use App\Models\Option;
use App\Models\Advertisement;
use App\Models\Follow;
use App\Models\Tag;
use App\Models\Owncollaction;
use App\Models\NotificationPrivacyOption;
use App\Models\User;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Cache;

class DLCContentController extends Controller
{
    use Notification,Achievementpoints;

    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function dlc(){
        $theme = $this->themes('others_theme','red_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        if(Auth::id()){
            $pagename = 'dlc';
            if(isset($_GET['page'])){
                $pageno = $_GET['page'];
            }else{
                $pageno = 1;
            }
            $this->PointInsert(0,$pagename,0.01,$pageno);
        }

        $generalsetting = Cache::remember('generalsetting_' . Auth::id(), $this->cache_time, function () {
            return Option::where('user_id', Auth::id())->where('show_comments', 1)->first();
        });

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $DlccontentsData = Dlccontents::with('user')->orderBy('total_likes','DESC')->paginate(10);

        return view('front.other_page.dlc', compact('DlccontentsData','font','theme','advertisement','generalsetting'));
    }

    public function dlcFilter($sort){
        $theme = $this->themes('others_theme','red_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $generalsetting = Cache::remember('generalsetting_' . Auth::id(), $this->cache_time, function () {
            return Option::where('user_id', Auth::id())->where('show_comments', 1)->first();
        });

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $dlccontent = new Dlccontents;
        if($sort == 'latest'){
            $dlccontent = $dlccontent->orderBy('created_at','DESC');
        }elseif($sort == 'featured'){
            $dlccontent = $dlccontent->orderBy('total_likes','DESC');
        }else{
            $dlccontent = $dlccontent->where('type',$sort);
        }
        $dlccontent = $dlccontent->with('user')->paginate(10);
        $DlccontentsData = $dlccontent;

        return view('front.other_page.dlc', compact('DlccontentsData','font','theme','advertisement','generalsetting'));
    }

    public function dlcupload()
    {
        $TagData = Tag::get()->toArray();

        $Owncollaction = Owncollaction::where('userid', Auth::id())->get()->toArray();
        $themes = 'green_theme';

        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        return view('front.user.dlcupload', compact('Owncollaction', 'TagData','themes','font'));
    }

    public function uploaddlccontent(Request $request)
    {
        $validationRules = [
            'title'     => 'required',
            'content'   => 'required',
            'type'      => 'required'
        ];

        $validationMessages = [];
        if (env('APP_ENV') == 'production') {
            $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
            $validationMessages = [ 'g-recaptcha-response.required' => 'The recaptcha field is required.'];
        }

        $validatedData = $request->validate($validationRules, $validationMessages);

        $Dlccontents = new Dlccontents();
        $Dlccontents->title = $request->title;
        $Dlccontents->userid = Auth::user()->id;
        if ($request->file('content')) {
            $file= $request->file('content');
            $extension = $file->getClientOriginalExtension();
            $filename= time().'.'.$file->getClientOriginalExtension();
            $file-> move(public_path('dlccontent'), $filename);
            $Dlccontents->content = $filename;
            $Dlccontents->filetype = $extension;
        }
        $Dlccontents->type = $request->type;

        $Dlccontents->save();
        $following = Follow::where('follow_by',Auth::id())->get();
        foreach($following as $follow){
            $notification_dlc = NotificationPrivacyOption::where('user_id',$follow->follow_to)->pluck('notification_dlc')->first();
            $notification_dlc = json_decode($notification_dlc);
            if(isset($notification_dlc) && in_array('new_dlc_from_creators_i_follow',$notification_dlc)){
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $follow->follow_to,     // recover id
                    $Dlccontents->id,       // content id
                    'DLC creators follow',  // notification type
                    Auth::user()->username.' upload new DLC Content',
                    'DLC',          // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }
        }
        if(Auth::id()){
            $this->PointInsert($Dlccontents->id,'dlc content upload',10,1);
        }
        //return back()->with(['successful_message' => 'Your DLC Content updated successfully']);
        return json_encode(array('result'=>'success','msg'=>'Your DLC Content updated successfully'));
    }

    public function downloaddlcFile($file)
    {
        $dlccontent = Dlccontents::where('content',$file)->first();
        $myFile = public_path("dlccontent/".$file);
        $headers = ['Content-Type: application/pdf'];
        $newName = $file ;
        $user_id = Auth::user()->id;
        $downloadDlcFile = DownloadDlcFile::Insert([
            'user_id' => $user_id,
            'content_id'    =>$dlccontent->id,
            'download' => $file,
        ]);
        $notification_dlc = NotificationPrivacyOption::where('user_id',$dlccontent->userid)->pluck('notification_dlc')->first();
        $notification_dlc= json_decode($notification_dlc);
        if(isset($notification_dlc) && in_array('somebody_download_my_dlc',$notification_dlc)){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $dlccontent->userid,    // recover id
                $dlccontent->id,        // content id
                'DLC download',         // notification type
                Auth::user()->username.' download your DLC Content',
                'DLC',          // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }
        return response()->download($myFile, $newName, $headers);
    }

    public function likedlc($id)
    {
        $isdislike = Dislikedlc::where('dlcid', $id)->where('userid',Auth::id())->first();
        $islike = Likedlc::where('dlcid', $id)->where('userid',Auth::id())->first();
        if(!is_null($isdislike)){
            $isdislike->delete();
        }
        if(is_null($islike)){
            $Likedlc = new Likedlc() ;
            $Likedlc->userid  = Auth::user()->id;
            $Likedlc->dlcid  = $id ;
            $Likedlc->save();
            $dlccontent = Dlccontents::where('id',$id)->first();
            $dlccontent->total_likes = $dlccontent->total_likes + 1;
            $dlccontent->save();
            $notification_dlc = NotificationPrivacyOption::where('user_id',$dlccontent->userid)->pluck('notification_dlc')->first();
            $notification_dlc= json_decode($notification_dlc);
            if(isset($notification_dlc) && in_array('somebody_reacts_to_my_dlc',$notification_dlc)){
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $dlccontent->userid,    // recover id
                    $dlccontent->id,        // content id
                    'DLC reacts',         // notification type
                    Auth::user()->username.' likes your DLC Content',
                    'DLC',          // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }

            if(Auth::id()){
                $this->PointInsert($dlccontent->id,'dlc content likes',0.05,1);
            }
        }
        return redirect()->route('dlc');
    }

    public function dislikedlc($id)
    {
        $isdislike = Dislikedlc::where('dlcid', $id)->where('userid',Auth::id())->first();
        $islike = Likedlc::where('dlcid', $id)->where('userid',Auth::id())->first();
        if(!is_null($islike)){
            $islike->delete();
            $dlccontent = Dlccontents::where('id',$id)->first();
            $dlccontent->total_likes = $dlccontent->total_likes - 1;
            $dlccontent->save();
        }
        if(is_null($isdislike)){
            $Dislikedlc = new Dislikedlc() ;
            $Dislikedlc->userid  = Auth::user()->id;
            $Dislikedlc->dlcid  = $id ;
            $Dislikedlc->save();
            $dlccontent = Dlccontents::where('id',$id)->first();
            $notification_dlc = NotificationPrivacyOption::where('user_id',$dlccontent->userid)->pluck('notification_dlc')->first();
            $notification_dlc= json_decode($notification_dlc);
            if(isset($notification_dlc) && in_array('somebody_reacts_to_my_dlc',$notification_dlc)){
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $dlccontent->userid,    // recover id
                    $dlccontent->id,        // content id
                    'DLC reacts',           // notification type
                    Auth::user()->username.' dislikes your DLC Content',
                    'DLC',                  // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }
            if(Auth::id()){
                $this->PointInsert($dlccontent->id,'dlc content dislike',0.05,1);
            }
        }
        return redirect()->route('dlc');
    }
}
