<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Advertisement;
use App\Models\Message;
use App\Models\User;
use App\Models\Follow;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PersonalMessageController extends Controller
{
    use Notification,Achievementpoints;

    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function pminbox()
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        // $messages = Message::where('receiver_id','=', Auth::user()->id)->get();
        $data = Message::select('messages.*','users.*','users.id as uid')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->where('receiver_id','=', Auth::user()->id)
            ->get();
        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.pminbox',compact('theme','font','data','advertisement'));
    }

    public function pmsendmessageinbox(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        // $message = Message::where('sender_id','=',Auth::user()->id)->get();
        $data = Message::join('users', 'messages.receiver_id', '=', 'users.id')
            ->select('messages.*','users.username','users.profile_Pic','users.email','users.role_preference','users.id as uid')
            ->where('sender_id','=', Auth::user()->id)
            ->orderBy('id','DESC')
            ->with(['user'])
            ->get();
        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.pminbox_message',compact('theme','font','data','advertisement'));
    }

    public function newpm(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $allfollower   = Follow::where('follow_to',Auth::id())->pluck('follow_by');
        $allfollowing  = Follow::where('follow_by',Auth::id())->pluck('follow_to');
        $allfollower = $allfollower->merge($allfollowing);
        $friends = array_unique(json_decode($allfollower));
        $receiver = User::whereIn('id',$friends)->get();

        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.newpm',compact('theme','receiver','advertisement','font'));
    }

    public function sendMsgtoUser(Request $request, $id){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $receiver = User::where('id',$id)->get();
        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.newpm',compact('theme','font','receiver','advertisement'));
    }

    public function sendmsg(Request $request){
        $advertisement = Advertisement::where('status','=',1)->first();
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);
        switch ($request->input('action_type')) {
            case 'Save Draft':
                $message = new Message() ;
                $message->subject = $request->subject ;
                $message->message = $request->message ;
                $message->sender_id = Auth::user()->id ;
                $message->receiver_id = $request->receiverid ;
                $message->is_draft = '1' ;
                // dd($message);
                $message->save();
                break;

            case 'Send PM':
                $message = new Message() ;
                $message->subject = $request->subject ;
                $message->message = $request->message ;
                $message->sender_id = Auth::user()->id ;
                $message->receiver_id = $request->receiverid ;
                $message->is_draft = '0' ;

                $message->save();
                break;
        }
        return redirect()->back()->withSuccess('Success!');
    }

    public function msgDraft(Request $request){
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);

        $message = new Message() ;
        $message->subject = $request->subject ;
        $message->message = $request->message ;
        $message->sender_id = Auth::user()->id ;
        $message->receiver_id = $request->receiverid ;
        $message->is_draft = '1' ;
        $message->save();
        return redirect()->back()->withSuccess('Draft Saved!');
    }

    public function pmfriends(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        // $sender = User::where('id', Auth::user()->id)->get();

        $allfollower   = Follow::where('follow_to',Auth::id())->pluck('follow_by');
        $allfollowing  = Follow::where('follow_by',Auth::id())->pluck('follow_to');
        $allfollower = $allfollower->merge($allfollowing);
        $friends = array_unique(json_decode($allfollower));
        $receiver = User::whereIn('id',$friends)->get();
        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.pmfriends',compact('theme','font','receiver','advertisement'));
    }

    public function pmdraft(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $draft = Message::select('messages.*','users.*','users.id as uid')
                    ->where('is_draft',1)->join('users', 'messages.receiver_id', '=', 'users.id')
                    ->where('sender_id','=', Auth::user()->id)
                    ->with(['user'])
                    ->get();

        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.pmdraft',compact('theme','font','draft','advertisement'));
    }

    public function pminbox_message_view(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $data = Message::where('id',$request->id)->get();
        $theme =  $this->themes('forum_theme','orange_theme');
        return view('front.personal_message.pminbox_message_view',compact('theme','font','data','advertisement'));
    }
}
