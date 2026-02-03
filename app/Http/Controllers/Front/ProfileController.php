<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profilepost;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Journal;
use App\Models\Profilecomment ;
use App\Models\Follow ;
use App\Models\Activity ;
use App\Models\ThemeOption ;
use App\Models\Option;
use App\Models\Comment ;
use App\Models\Like ;
use App\Models\Usercontent ;
use App\Models\Galleryfavorite ;
use App\Events\CommentNotification;
use App\Models\Point ;
use App\Models\Advertisement;
use App\Models\Featuredcontent;
use App\Models\Dlccontents;
use App\Models\Paidcontent;
use App\Models\Thread;
use App\Models\Gallerycomment;
use App\Models\Threadcomment;
use Carbon\Carbon;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use App\Models\NotificationPrivacyOption;
use DateTime;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    use Notification,Achievementpoints;

    public $cache_time, $limit;
    public function __construct(){
        $this->limit = 20;

        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function index(){
        $AllUsersdata = User::get()->toArray();
        return view('front.onlineuser',compact('AllUsersdata'));
    }

    public function userinfo($id){
        $notification_privacy_option = NotificationPrivacyOption::where('user_id', $id)->select('profileview_access', 'activity')->first();

        $notificationoption = $notification_privacy_option ? $notification_privacy_option->profileview_access : null;
        if($notificationoption){
            if($notificationoption == 'registered'){
                if(!Auth::id()){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
                }
            }else if($notificationoption == 'followers'){
                if(!Auth::id()){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }else{
                    $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                    $allfollower = json_decode($allfollower);
                    if(!in_array(Auth::id(),$allfollower)){
                        return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                    }
                }
            }else if($notificationoption == 'Nobody'){
                return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
            }
        }

        $is_visitor = true;
        $themes = 'blue_theme';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $myData = User::where('id',$id)->get()->toArray();

        $ActivityData = Activity::where('userid',$id)->orderBy('id','desc');

        $notification_activity = $notification_privacy_option ? $notification_privacy_option->activity : null;
        if($notification_activity){
            if($notification_activity != null && $notification_activity == 'showlikes'){
                $ActivityData =$ActivityData->where('content', 'like', "%liked%");
            }
        }
        $ActivityData = $ActivityData->get()->toArray();

        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
             $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
             $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
             $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
                $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        if(isset($ActivityData) && is_array($ActivityData) && count($ActivityData) > 0)
        {
            foreach($ActivityData as $ActivityDataK => $ActivityDataV){
                $UserData = User::where('id',$ActivityDataV['userid'])->get()->toArray();
                $ActivityData[$ActivityDataK]['username'] = $UserData[0]['username'] ;
                $ActivityData[$ActivityDataK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $Pointcount = Point::where('userid',Auth::user()->id)->sum('point');
        if(isset($myData[0])){
            $myData[0]['achivement'] = $this->achivements($myData[0]['role_preference'],$Pointcount) ;
        }
        $general_setting = Option::where('user_id',$id)->first();
        return view('front.profilevisitor.dashboard',compact('general_setting','themes','myData','is_visitor','id','isFollowing','AllFollower','AllFollowing','ActivityData','font'));
    }

    public function aboutus($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $is_visitor = true ;
        $myData = User::where('id',$id)->get()->toArray();
        $userId = Auth::user()->id;
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $themes = 'blue_theme';
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
             $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
             $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
             $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $general_setting = Option::where('user_id',$id)->first();

        return view('front.profilevisitor.about',compact('general_setting','font','themes','myData','id','is_visitor','AllFollower','AllFollowing','isFollowing'));

    }

    public function updateabout(Request $request){

         $this->validate($request, [
           'about' => 'required',]);

            $User = User::find(Auth::user()->id);
            $User->about = $request->about ;
            $User->save();

            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    // Rp status
    public function journal($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();

        $AllFollower   = Follow::where('follow_to', $id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
             $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
             $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
             $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $is_visitor = true ;
        $JournalData = Journal::where('userid',$id)->get()->toArray();
        $myData = User::where('id',$id)->get()->toArray();
        $Pointcount = Point::where('userid',Auth::user()->id)->sum('point');
        $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'],$Pointcount) ;
        $themes = 'blue_theme';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $general_setting = Option::where('user_id',$id)->first();
        return view('front.profilevisitor.journal',compact('general_setting','JournalData','myData','is_visitor','id','AllFollower','AllFollowing','isFollowing','font','themes'));
    }

    public function rpstatus($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
             $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
             $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
             $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        $is_visitor = true ;
        $myData = User::where('id',$id)->get()->toArray();
        $Pointcount = Point::where('userid',Auth::user()->id)->sum('point');
        $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'],$Pointcount) ;
        $themes = 'blue_theme';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $general_setting = Option::where('user_id',$id)->first();
        return view('front.profilevisitor.rpstatus',compact('general_setting','font','myData','is_visitor','id','AllFollower','AllFollowing','isFollowing','themes'));
    }

    public function updaterpstatus(Request $request){

         $this->validate($request, [
           'rpstatus' => 'required',]);

            $User = User::find(Auth::user()->id);
            $User->rpstatus = $request->rpstatus ;
            $User->save();

            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }
       /// Rp status ///
    public function profilepost($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $font = Option::where('user_id',Auth::id())->value('preffered_font');
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
        $themes = 'blue_theme';

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();

                if(isset($UserData[0])){

                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                }else{

                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
                $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $is_visitor = true ;
        $myPostdata = Profilepost::where('userid',$id)->orderBy('id','DESC')->get()->toArray();
         if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0)
        {
            foreach($myPostdata as $myPostdataK => $myPostdataV){
                $likecount = Like::where('postid',$myPostdataV['id'])->count();
                $commentData = Comment::where('postid',$myPostdataV['id'])->get()->toArray();
         if(isset($commentData) && is_array($commentData) && count($commentData) > 0)
        {
            foreach($commentData as $commentDataK => $commentDataV){
                $UserData = User::where('id',$commentDataV['userid'])->get()->toArray();
                if(!is_null($UserData[0])){
                    if($UserData[0]['creator'] == 1){
                        $dashboard_link = route('creatorvisitordashboard',[$UserData[0]['id']]);
                    }else{
                        $dashboard_link = route('profiledashboard',[$UserData[0]['id']]);
                    }
                }else{
                    $dashboard_link = 'javascript:;';
                }
                $commentData[$commentDataK]['dashboardlink'] = $dashboard_link;
                $commentData[$commentDataK]['username'] = $UserData[0]['username'] ;
        }}
             $myPostdata[$myPostdataK]['commentdata'] = $commentData ;
             $myPostdata[$myPostdataK]['likecount'] = $likecount ;
            }
        }

        $myData = User::where('id',$id)->get()->toArray();
        $Pointcount = Point::where('userid',Auth::user()->id)->sum('point');
        $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'],$Pointcount) ;
        $general_setting = Option::where('user_id',$id)->first();
        // ****************************************** START POSTS ON USERPAGE SETTING ******************************************
            $setting_post_access = NotificationPrivacyOption::where('user_id',$id)->value('post_access');
            $post_access = 1;
            if($setting_post_access == 'followers'){
                $post_access  = Follow::where('follow_by',$id)->where('follow_to',Auth::id())->count();
            }else if($setting_post_access == 'followed'){
                $post_access = Follow::where('follow_to',$id)->where('follow_by',Auth::id())->count();
            }else if($setting_post_access == 'all'){
                $post_access = 1;
            }
        // ****************************************** END POSTS ON USERPAGE SETTING ********************************************
        return view('front.profilevisitor.profilepost',compact('post_access','general_setting','myPostdata','myData','is_visitor','id','AllFollower','AllFollowing','isFollowing','themes','font'));

    }

    public function follow($id){
        $Follow = new Follow ;
        $Follow->follow_by  = Auth::user()->id;
        $Follow->follow_to  = $id ;
        $Follow->save();

        $myData  = User::where('id',Auth::user()->id)->get()->toArray();

        $user = User::find($id);
        $username = $user->username;

        $activity = new Activity();
        $activity->userid = $user->id;
        $activity->refrenceid = Auth::user()->id;
        $activity->content = Auth::user()->username . " started following you.";
        $activity->save();

        $activity = new Activity();
        $activity->userid = Auth::user()->id;
        $activity->refrenceid = $user->id;
        $activity->content = "You are now following " . $username;
        $activity->save();

        $notificationGallaryOption = NotificationPrivacyOption::where('user_id',$id)->pluck('notification_userpage')->first();
        $notificationGallaryOption = json_decode($notificationGallaryOption);
        if(isset($notificationGallaryOption) && in_array('update_from_user_i_follow',$notificationGallaryOption) ){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $id,                    // recover id
                $Follow->id,            // content id
                'follow',               // notification type
                Auth::user()->username.' start following',
                'userpage',             // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }
        if(Auth::id()){
            $this->PointInsert($id,'follow',1,1);
        }
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];

        return redirect()->back();
    }

    public function unfollow($id){

        $Follow = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->delete();
        $user = User::find($id);
        if(isset($user)){
            $username = $user->username;
            $activity = new Activity();
            $activity->userid = $user->id;
            $activity->refrenceid = Auth::user()->id;
            $activity->content = Auth::user()->username . " unfollowed you.";
            $activity->save();

            $activity = new Activity();
            $activity->userid = Auth::user()->id;
            $activity->refrenceid = $user->id;;
            $activity->content = "You have unfollowed " . $username;
            $activity->save();
        }
        return redirect()->back();
    }

    public function info($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $is_visitor = true ;
        $myData = User::where('id',$id)->get()->toArray();
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        $AllFollowing  = Follow::where('follow_by',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
                $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $themes = 'blue_theme';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $general_setting = Option::where('user_id',$id)->first();
        $userdata = User::where('id',$id)->first();
        $Pointcount = Point::where('userid', $userdata->id)->sum('point');
        if($userdata->role_preference == 'pred'){
            if(is_null($userdata->achievements) || $userdata->achievements == 'null'){
                $profile_rank = $this->achivements($userdata->role_preference,$Pointcount);
            }else{
                $rank = json_decode($userdata->achievements);
                $profile_rank = implode(',',$rank);
            }
        }else if($userdata->role_preference == 'prey'){
            if(is_null($userdata->prey_achievements) || $userdata->prey_achievements == 'null'){
                $profile_rank = $this->achivements($userdata->role_preference,$Pointcount);
            }else{
                $rank = json_decode($userdata->prey_achievements);
                $profile_rank = implode(',',$rank);
            }
        }else{
            $profile_rank = $userdata->achievements;
        }
        // $profile_rank = $this->achivements(strtolower($userdata->role_preference),$userdata->points);

        $usercontentcount = Usercontent::where('userid',$id)->count();
        $dlccontentcount = Dlccontents::where('userid',$id)->count();
        $paidcontentcount = Paidcontent::where('user_id',$id)->count();
        $useruploadcount = $usercontentcount + $dlccontentcount + $paidcontentcount;

        $threadcount = Thread::where('userid',$id)->count();

        $gallerycommentcount = Gallerycomment::where('userid',$id)->count();
        $profilecommentcount = Profilecomment::where('uid',$id)->count();
        $threadcommentcount  = Threadcomment::where('userid',$id)->count();
        $numberofcomment = $gallerycommentcount + $profilecommentcount + $threadcommentcount;


        $datetime1 = new DateTime($userdata->created_at);
        $datetime2 = new DateTime(today());
        $interval = $datetime1->diff($datetime2);
        $hasbeenmember = $interval->format('%a');
        if($userdata->creator == 1){ $profile_type = 'Creator'; }else{ $profile_type = 'User'; }
        $userinfo = array(
            'profile_rank'  => $profile_rank,
            'profile_type'  => $profile_type,
            'upload_count'  => $useruploadcount,
            'thread_count'  => $threadcount,
            'total_comment' => $numberofcomment,
            'hasbeenmember' => $hasbeenmember,
            'gender'        => $userdata->gender
        );

        return view('front.profilevisitor.info',compact('userinfo','general_setting','myData','id','is_visitor','AllFollower','AllFollowing','isFollowing','themes','font'));
    }

    public function addcomment(Request $request){
        $this->validate($request, [
            'comment' => 'required',
            'postid' => 'required',
        ]);

        $Comment = new Comment;
        $Comment->userid = Auth::user()->id ;
        $Comment->postid = $request->postid ;
        $Comment->comment = $request->comment ;
        if($request->has('comment_id')) {
            $Comment->comment_parent_id = $request->comment_id;
        }
        $Comment->save();

        $profilePost = Profilepost::find($request->postid);
        $postOwner = User::find($profilePost->userid);
        $userid = Auth::user()->id;

        Activity::updateOrCreate(
            [
                'userid' => $postOwner->id,
                'post_id' => $request->postid,
                'refrenceid' => $userid,
                'content' => Auth::user()->username." commented on your post."
            ],
        );

        Activity::updateOrCreate(
            [
                'userid' => $userid,
                'post_id' => $request->postid,
                'refrenceid' => $postOwner->id,
                'content' => "You have commented on " . $postOwner->username . "'s post."
            ],
        );

        $notificationGallaryOption = NotificationPrivacyOption::where('user_id',$profilePost->userid)->pluck('notification_userpage')->first();
        $notificationGallaryOption = json_decode($notificationGallaryOption);
        if(isset($notificationGallaryOption) && in_array('comment_on_userpage',$notificationGallaryOption)){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $profilePost->userid,   // recover id
                $profilePost->id,       // content id
                'comment userpage',  // notification type
                Auth::user()->username.' comment your profile post',
                'userpage',             // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }elseif(isset($notificationGallaryOption) && in_array('comment_like_on_my_userpage',$notificationGallaryOption)){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $profilePost->userid,   // recover id
                $profilePost->id,       // content id
                'comment reacts userpage',  // notification type
                Auth::user()->username.' comment your profile post',
                'userpage',             // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }
        if(Auth::id()){
            $this->PointInsert($request->postid,'profile post reply',0.05,1);
        }

        $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];
        // event(new CommentNotification($request->comment));
        return response()->json($response, 200);
    }

    public function like($id){

        $profilePost = Profilepost::find($id);
        $postOwner = User::find($profilePost->userid);
        // dd($profilePost);
        $userid = Auth::user()->id;

        Like::updateOrCreate(
            ['userid' => $userid, 'postid' => $id],
        );

        Activity::updateOrCreate(
            [
                'userid' => $postOwner->id,
                'post_id' => $id,
                'refrenceid' => $userid,
                'content' => Auth::user()->username." liked your post."
            ],
        );

        Activity::updateOrCreate(
            [
                'userid' => $userid,
                'post_id' => $id,
                'refrenceid' => $postOwner->id,
                'content' => "You have liked " . $postOwner->username . "'s post."
            ],
        );
        $notificationGallaryOption = NotificationPrivacyOption::where('user_id',$profilePost->userid)->pluck('notification_userpage')->first();
        $notificationGallaryOption = json_decode($notificationGallaryOption);
        if(isset($notificationGallaryOption) && in_array('comment_like_on_my_userpage',$notificationGallaryOption) ){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $profilePost->userid,   // recover id
                $profilePost->id,       // content id
                'comment reacts user page',  // notification type
                Auth::user()->username.' likes your profile post',
                'userpage',             // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }elseif(isset($notificationGallaryOption) && in_array('comment_like_on_my_userpage',$notificationGallaryOption)){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $profilePost->userid,   // recover id
                $profilePost->id,       // content id
                'comment reacts userpage',  // notification type
                Auth::user()->username.' likes your profile post',
                'userpage',             // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }
        if(Auth::id()){
            $this->PointInsert($id,'profile post likes',0.05,1);
        }

        return redirect()->back();
    }

    public function media($id,$sort){
        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        $creatore = User::where('id',$id)->first();
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        if (isset($sort) && $sort=="Random") {
            $UsercontentData = Usercontent::where('userid', $id)->paginate($this->limit);
        } elseif (isset($sort) && $sort!=="Random") {
            $UsercontentData = Usercontent::where('userid', $id)->where('type', $sort)->paginate($this->limit);
        } else {
            $UsercontentData = Usercontent::where('userid', $id)->paginate($this->limit);
        }

        $myData = User::where('id', $id)->get()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });
        return view('front.profilevisitor.media', compact('creatore','UsercontentData', 'myData','font','advertisement'));
    }

    public function featuredgallery($id,$sort){
        $creatore = User::where('id',$id)->first();
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $UsercontentData = array();
        $featuredData = Featuredcontent::where('userid', $id)->get()->toArray();
        if (isset($featuredData) && is_array($featuredData) && count($featuredData) > 0) {
            $featuredData = array_column($featuredData, 'contentid');
            $query = Usercontent::whereIn('id', $featuredData);
            if($sort === 'new') {
                $UsercontentData = $query->latest()->paginate($this->limit);
            } else if($sort === 'old') {
                $UsercontentData = $query->oldest()->paginate($this->limit);
            } else if($sort === 'random') {
                $UsercontentData = $query->inRandomOrder()->paginate($this->limit);
            } else if($sort === 'view'){
                $UsercontentData = $query->OrderBy('total_views','desc')->paginate($this->limit);
            } else {
                $UsercontentData = $query->paginate($this->limit);
            }
        }

        $myData = User::where('id', $id)->get()->toArray();
        return view('front.profilevisitor.featuredgallery', compact('creatore','UsercontentData', 'myData','advertisement','font'));
    }

    public function prioritisePopularity($id){
        if(Auth::id()){ $user_id = Auth::id(); }else{ $user_id = 0; }
        $font = Option::where('user_id',$user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        $creatore = User::where('id',$id)->first();
        $myData = User::where('id',$id)->get()->toArray();
        $UsercontentData = Usercontent::get();
        if (isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['prioritise', 'desc']])->toArray();
        } else {
            $UsercontentData = $UsercontentData->toArray();
        }

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
            $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
            $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
            $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        return view('front.profilevisitor.gallery',compact('creatore','font','UsercontentData','myData','AllFollower','AllFollowing'));
    }

    public function prioritiseTags($id){
        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }

        if(Auth::id()){ $user_id = Auth::id(); }else{ $user_id = 0; }
        $creatore = User::where('id',$id)->first();
        $myData = User::where('id',$id)->get()->toArray();
        $font = Option::where('user_id',$user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        $UsercontentData = Usercontent::get();
        if (isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['prioritisetags', 'desc']])->toArray();
        } else {
            $UsercontentData = $UsercontentData->toArray();
        }

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        $AllFollowing  = Follow::where('follow_by', $id)->get()->toArray();
        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
            $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
            $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
            $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        return view('front.profilevisitor.gallery',compact('creatore','font','UsercontentData','myData','AllFollower','AllFollowing'));
    }

    public function relevancy($id){
        if(Auth::id()){ $user_id = Auth::id(); }else{ $user_id = 0; }
        $creatore = User::where('id',$id)->first();
        $myData = User::where('id',$id)->get()->toArray();
        $font = Option::where('user_id',$user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        $UsercontentData = Usercontent::get();
        if(isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['relevancy', 'desc']])->toArray();
        }else{
            $UsercontentData = $UsercontentData->toArray();
        }
        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        $AllFollowing  = Follow::where('follow_by',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
            $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
            $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
            $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        return view('front.profilevisitor.gallery', compact('creatore','UsercontentData','theme','font','myData','AllFollower','AllFollowing'));
    }

    public function recency($id){
        $creatore = User::where('id',$id)->first();
        if(Auth::id()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        $myData = User::where('id',$id)->get()->toArray();
        $font = Option::where('user_id',$user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        $items = Usercontent::where('created_at', '>=', Carbon::today())->take(5)->get();
        if($items->count() < 5) {
            $remaining_items = Usercontent::where('created_at', '>=', Carbon::yesterday())
                                ->where('created_at', '<', Carbon::today())
                                ->orderBy('tags', 'desc')
                                ->take(5 - $items->count())->get();
            $items = $items->concat($remaining_items);
        }
        $UsercontentData = $items->toArray();
        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        $AllFollowing  = Follow::where('follow_by',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
            $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
            $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
            $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        return view('front.profilevisitor.gallery', compact('creatore','UsercontentData','theme','font','myData','AllFollower','AllFollowing'));
    }

    public function gallery($id,$sort){
        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption == 'registered'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
            }
        }else if($notificationoption == 'followers'){
            if(!Auth::id()){
                return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
            }else{
                $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                $allfollower = json_decode($allfollower);
                if(!in_array(Auth::id(),$allfollower)){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }
            }
        }else if($notificationoption == 'Nobody'){
            return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
        }
        $creatore = User::where('id',$id)->first();
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        $AllFollowing  = Follow::where('follow_by',$id)->get()->toArray();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
            $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
            $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
            $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }
        // $UsercontentData = Usercontent::get()->toArray();
        if (isset($sort) && $sort == "new") {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->orderBy('created_at', 'desc')->get()->toArray();
        } elseif (isset($sort) && $sort == "old") {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->orderBy('created_at', 'asc')->get()->toArray();
        } else {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->get()->toArray();
        }
        $myData = User::where('id',$id)->get()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        return view('front.profilevisitor.gallery',compact('creatore','font','UsercontentData','myData','AllFollower','AllFollowing','advertisement'));
    }

    public function favoriteartwork($id){
        if(!Auth::check()){
            return view('user-not-login');
        }

        // $notificationactivity = NotificationPrivacyOption::where('user_id',$id)->value('activity');
        // if($notificationactivity){
        //     if($notificationactivity != 'showlikes'){
        //         return redirect()->back()->with(['successful_message' => "Sorry, this page can't access "]);
        //     }
        // }

        $notificationoption = NotificationPrivacyOption::where('user_id',$id)->value('profileview_access');
        if($notificationoption){
            if($notificationoption == 'registered'){
                if(!Auth::id()){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only registered']);
                }
            }else if($notificationoption == 'followers'){
                if(!Auth::id()){
                    return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                }else{
                    $allfollower = Follow::where('follow_to',$id)->pluck('follow_by');
                    $allfollower = json_decode($allfollower);
                    if(!in_array(Auth::id(),$allfollower)){
                        return redirect()->back()->with(['successful_message' => 'Sorry, this page access only followers']);
                    }
                }
            }else if($notificationoption == 'Nobody'){
                return redirect()->back()->with(['successful_message' => 'Sorry, This page access accessble']);
            }
        }

        $AllFollower   = Follow::where('follow_to',$id)->get()->toArray();
        $AllFollowing  = Follow::where('follow_by',$id)->get()->toArray();
        $UsercontentData = array();
        if(isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0)
        {
            foreach($AllFollower as $AllFollowerK => $AllFollowerV){
                $UserData = User::where('id',$AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        if(isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0)
        {
            foreach($AllFollowing as $AllFollowingK => $AllFollowingV){
                $UserData = User::where('id',$AllFollowingV['follow_to'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
                    $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $Galleryfavorite = Galleryfavorite::where('userid',$id)->get()->toArray();
        if(isset($Galleryfavorite) && is_array($Galleryfavorite) && count($Galleryfavorite) > 0)
        {
            foreach($Galleryfavorite as $GalleryfavoriteK => $GalleryfavoriteV){
                $UsercontentData = Usercontent::where('id',$GalleryfavoriteV['contentid'])->get()->toArray();
            }
        }
        
        $myData = User::where('id',$id)->get()->toArray();
        $Pointcount = Point::where('userid',Auth::user()->id)->sum('point');
        $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'],$Pointcount) ;
        $themes = 'blue_theme';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $general_setting = Option::where('user_id',$id)->first();
        $isFollowing = Follow::where('follow_by',Auth::id())->where('follow_to',$id)->first();
        return view('front.profilevisitor.favoriteartwork',compact('isFollowing','id','general_setting','UsercontentData','myData','AllFollower','AllFollowing','themes','font'));
    }
}
