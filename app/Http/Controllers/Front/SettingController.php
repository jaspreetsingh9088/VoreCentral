<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Option;
use App\Models\User;
use App\Models\ThemeOption;
use App\Models\Timezone;
use App\Models\Activity;
use App\Models\Follow;
use App\Models\Point;
use App\Models\Tagoption;
use App\Models\Searchsorting;
use App\Models\Tag;
use App\Models\NotificationPrivacyOption;
use App\Models\Userantitag;
use App\Models\Usertag;
use App\Models\Achievement;
use App\Models\Blockuser;
use App\Traits\StripeTrait;
use App\Traits\ApiResponse;
use App\Traits\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    use StripeTrait,ApiResponse, Notification;

    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function notificationOption(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $theme =  $this->themes('homepage','blue_theme');
        $setting = NotificationPrivacyOption::whereUserId(Auth::user()->id)->first();

        if(is_null($setting)){
            $setting = NotificationPrivacyOption::whereUserId(0)->first();
        }
        return view('front.homepage.setting.notification',compact('theme','setting','font'));
    }

    public function notificationOptionStore(Request $request)
    {
        $user_id = Auth::user()->id;
        $notification_option = NotificationPrivacyOption::whereUserId(Auth::user()->id)->get();
        $gallary_notification = json_encode($request->gallary_notification);
        $activity = $request->activity;
        $subscription = json_encode($request->subscription);
        $general_privacy = json_encode($request->general_privacy);
        $notification_userpage = json_encode($request->notification_userpage);
        $notification_forum = json_encode($request->notification_forum);
        $notification_dlc = json_encode($request->notification_dlc);

        if($notification_option != '[]'){
            NotificationPrivacyOption::where('user_id',$user_id)->update([
            'user_id' =>$user_id,
            'profileview_access' => $request->profileview_access,
            'gallary_notification' => $gallary_notification,
            'activity' => $activity,
            'subscription' => $subscription,
            'post_access' => $request->post_access,
            'general_privacy' => $general_privacy,
            'radio_group' => $request->radio_group,
            'notification_userpage' => $notification_userpage,
            'notification_forum' => $notification_forum,
            'notification_dlc' => $notification_dlc,
            ]);
        }else{
            NotificationPrivacyOption::Insert([
                'user_id' => $user_id,
                'profileview_access' => $request->profileview_access,
                'gallary_notification' => $gallary_notification,
                'activity' => $activity,
                'subscription' => $subscription,
                'post_access' => $request ->post_access,
                'general_privacy' => $general_privacy,
                'radio_group' => $request->radio_group,
                'notification_userpage' => $notification_userpage,
                'notification_forum' => $notification_forum,
                'notification_dlc' => $notification_dlc,
            ]);
        }
        return redirect()->back()->withSuccess('Saved!');
    }

    public function generalSetting(){
        $timezone = Timezone::where('status','1')->get();
        $option =  Option::whereUserId(Auth::user()->id)->first();
        $font = $option ? $option->preffered_font : null;

        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.setting.general_setting',compact('theme','option','font','timezone'));
    }

    public function generalSettingstore(Request $request){
        if($request->change_email){
            $this->validate($request, [
                'change_email' => 'email|unique:users,email,' . Auth::id(),
            ]);
        }

        //email|unique:users,email,' . $this->id
        $show_orientation = $request->show_orientation == 'on' ? 'show_orientation' : '';
        $show_gender = $request->show_gender == 'on' ? 'show_gender' : '';
        $show_vorerole_preference = $request->show_vorerole_preference == 'on' ? 'show_vorerole_preference' : '';
        $general_privacy = [ $show_orientation, $show_gender, $show_vorerole_preference ];
        $general_privacy = json_encode($general_privacy);
        $userId = Auth::id();
        $option =  Option::whereUserId(Auth::id())->get();
        if($request->level_epilapsy == 1){
            $level_epilapsy = 'Low';
        }else if($request->level_epilapsy == 2){
            $level_epilapsy = 'Medium';
        }else if($request->level_epilapsy == 3){
            $level_epilapsy = 'High';
        }else if($request->level_epilapsy == 4){
            $level_epilapsy = 'Expert';
        }else{
            $level_epilapsy = 'Low';
        }
        if($option != '[]'){
            Option::where('user_id',$userId)->update([
                'user_id' => $userId,
                'preffered_font' => $request->preffered_font,
                'timezone' => $request->timezone,
                'show_comments' => $request->show_comments,
                'creator_pages_custom_theme' => $request->creator_pages_custom_theme,
                'webstore_level' =>  $level_epilapsy,
                'general_privacy' => $general_privacy,
                'gender' => $request->gender,
                'sexual_orientation' => $request->sexual_orientation,
                'vore_role_preference' => $request->vore_role_preference,
                'cursor_style' => $request->cursor_style,
            ]);
        }else{
            $optiondata = [
                'user_id' => $userId,
                'preffered_font' => $request->preffered_font,
                'timezone' => $request->timezone,
                'show_comments' => $request->show_comments,
                'creator_pages_custom_theme' => $request->creator_pages_custom_theme,
                'webstore_level' =>  $level_epilapsy,
                'general_privacy' => $general_privacy,
                'gender' => $request->gender,
                'sexual_orientation' => $request->sexual_orientation,
                'vore_role_preference' => $request->vore_role_preference,
                'cursor_style' => $request->cursor_style,
            ];
            Option::Insert($optiondata);
        }

        $data = Option::select('gender','vore_role_preference','sexual_orientation')->whereUserId(Auth::user()->id)->first();

        $userData = [
            'email' => $request->change_email,
            'gender' => $data->gender,
            'role_preference' => strtolower($data->vore_role_preference),
            'sexual_orientation' => $data->sexual_orientation
        ];
        User::where('id', $userId)->update(array_filter($userData));
        return redirect()->back()->with(['successful_message' => 'General setting updated successfully']);
    }

    public function themeOption(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $theme =  $this->themes('homepage','blue_theme');
        $setting = ThemeOption::where('user_id',Auth::id())->first();
        return view('front.homepage.setting.theme_option',compact('theme','setting','font'));
    }

    public function themeOptionStore(Request $request){
        $userId = Auth::user()->id;
        $themeOption = ThemeOption::whereUserId(Auth::user()->id)->get();
        if($themeOption != '[]'){
            //update
            ThemeOption::where('user_id',$userId)->update([
                'user_id' => $userId,
                'homepage_theme' => $request->homepage_theme,
                'gallery_theme' => $request->gallery_theme,
                'forums_theme' => $request->forums_theme,
                'others_theme' => $request->others_theme,
            ]);
        }else{
            ThemeOption::Insert([
                'user_id' => $userId,
                'homepage_theme' => $request->homepage_theme,
                'gallery_theme' => $request->gallery_theme,
                'forums_theme' => $request->forums_theme,
                'others_theme' => $request->others_theme,
            ]);
        }
        return redirect()->back()->with(['successful_message' => 'Theme option setting updated successfully']);
    }

    public function socialOption(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        // $myData       = User::where('id', Auth::user()->id)->get()->toArray();
        // $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'], $Pointcount) ;


        $AllFollower   = Follow::where('follow_to', Auth::user()->id)->get()->toArray();

        $AllFollowing  = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if(isset($UserData[0])){
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'] ;
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'] ;
                }else{
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'] ;
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'] ;
            }
        }

        // $ActivityData = Activity::where('userid', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        // if (isset($ActivityData) && is_array($ActivityData) && count($ActivityData) > 0) {
        //     foreach ($ActivityData as $ActivityDataK => $ActivityDataV) {
        //         $UserData = User::where('id', $ActivityDataV['userid'])->get()->toArray();
        //         $ActivityData[$ActivityDataK]['username'] = $UserData[0]['username'] ;
        //         $ActivityData[$ActivityDataK]['profile_pic'] = $UserData[0]['profile_pic'] ;
        //     }
        // }

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');

        $theme =  $this->themes('homepage','blue_theme');
        $blockuser = Blockuser::where('block_by',Auth::id())->with(['user'])->get();
        $blockyou = Blockuser::where('block_to',Auth::id())->with(['byuser'])->get();
        return view('front.homepage.setting.social_option',compact('blockyou','blockuser','theme','AllFollower','AllFollowing','font'));
    }

    public function searchuser(Request $request){
        $search = '%'.$request->search.'%';
        $user = User::where('username','like',$search)->where('status',1)->get();
        $html = '';
        foreach($user as $row){
            $is_follow = Follow::where('follow_by',Auth::id())->where('follow_to',$row->id)->count();
            if($is_follow > 0){
                $button = '<a data-id="'.$row->id.'" class="btn-info btn unfollow-btn">Un-Follow</a>';
            }else{
                $button = '<a data-id="'.$row->id.'" class="btn-info btn follow-btn">Follow</a>';
            }
            $html .= '<div class="col-md-8 mt-1">
                <img src="'.$row->profile_pic.'" alt="'.$row->username.'" style="width : 35px; height : 35px;">
                <span>'.$row->username.'</span>
            </div>
            <div class="col-md-4 mt-1">
                '.$button.'
            </div>';
        }
        return $this->sendResponse('User list fount',200,$html);
    }

    public function searchBlockUser(Request $request){
        $search = '%'.$request->search.'%';
        $user = User::where('username','like',$search)->where('status',1)->where('id','!=',Auth::id())->get();
        $html = '';
        foreach($user as $row){
            $is_block = Blockuser::where('block_by',Auth::id())->where('block_to',$row->id)->count();
            if($is_block > 0){
                $button = '<a data-id="'.$row->id.'" class="btn-info btn unblock-btn">Un-Block</a>';
            }else{
                $button = '<a data-id="'.$row->id.'" class="btn-info btn block-btn">Block</a>';
            }
            $html .= '<div class="col-md-8 mt-1">
                <img src="'.$row->profile_pic.'" alt="'.$row->username.'" style="width : 35px; height : 35px;">
                <span>'.$row->username.'</span>
            </div>
            <div class="col-md-4 mt-1">
                '.$button.'
            </div>';
        }

        return $this->sendResponse('User list fount',200,$html);
    }

    public function unblockUser($id){
        if(!is_null($id)){
            $is_block = Blockuser::where('block_by',Auth::id())->where('block_to',$id)->first();
            if(!is_null($is_block)){
                $blockuser = Blockuser::where('block_by',Auth::id())->where('block_to',$id)->delete();
                return $this->sendResponse('Use unblock successfully',200);
            }else{
                return $this->sendResponse("This user not block",200);
            }
        }else{
            return $this->sendResponse("Unblock user id not found",200);
        }
    }

    public function blockUser($id){
        if(!is_null($id)){
            $is_block = Blockuser::where('block_by',Auth::id())->where('block_to',$id)->first();
            $you_follow = Follow::where('follow_by',Auth::id())->where('follow_to',$id)->first();
            if(!is_null($you_follow)){
                $you_follow->delete();
            }
            $is_follow = Follow::where('follow_by',$id)->where('follow_to',Auth::id())->first();
            if(!is_null($is_follow)){
                $is_follow->delete();
            }
            if(is_null($is_block)){
                $blockuser = Blockuser::insert([
                    'block_by' => Auth::id(),
                    'block_to' => $id
                ]);
                return $this->sendResponse('User block successfully',200);
            }else{
                return $this->sendResponse('This user already blocked',200);
            }
        }else{
            return $this->sendResponse('Block user id not found',200);
        }
    }

    public function searchSorting(){
        if(Auth::id()){
            $setting = Searchsorting::where('user_id',Auth::id())->first();

            $font = Option::where('user_id', Auth::id())->value('preffered_font');

            $theme =  $this->themes('homepage','blue_theme');
            return view('front.homepage.setting.search_sorting',compact('theme','setting','font'));
        }else{
            return view('user-not-login');
        }
    }

    public function searchSortingStore(Request $request){
        $search_setting = Searchsorting::where('user_id',Auth::id())->first();
        $gallery_search = $request->gallery_search;
        $forum_search = $request->forum_search;
        $webstore_search = $request->webstore_search;
        if($request->gallery_search_nonvore){
            $gs_nonevore = $request->gallery_search_nonvore;
        }else{
            $gs_nonevore = '0';
        }
        if(isset($request->webstore_search_nonvore)){
            $ws_nonvore = $request->webstore_search_nonvore;
        }else{
            $ws_nonvore = '0';
        }
        // dd($request->all());
        if(isset($search_setting)){
            Searchsorting::where('user_id',Auth::id())->update([
                'gallery_search'    => $gallery_search,
                'forum_search'      => $forum_search,
                'webstore_search'   => $webstore_search,
                'gs_nonevore'       => $gs_nonevore,
                'ws_nonvore'        => $ws_nonvore
            ]);
        }else{
            Searchsorting::insert([
                'user_id'           => Auth::id(),
                'gallery_search'    => $gallery_search,
                'forum_search'      => $forum_search,
                'webstore_search'   => $webstore_search,
                'gs_nonevore'       => $gs_nonevore,
                'ws_nonvore'        => $ws_nonvore
            ]);
        }
        return redirect()->back()->with(['successful_message' => 'Search sorting setting updated successfully']);
    }

    public function stripeSetting(){
        if(Auth::user()->customer_id == null){
            $customer = $this->createCustomer(Auth::user()->email,Auth::user()->username);
            $user = User::where('id',Auth::id())->update([ 'customer_id' => $customer->id ]);
            $customer_id = $customer->id;
        }else{
            $customer_id = Auth::user()->customer_id;
        }

        $customer_card = $this->customerCardList($customer_id,10);
        $carddata = array();
        if(isset($customer_card->data)){
            $card = $customer_card->data;
            for ($i=0; $i <count($card) ; $i++) {
                $carddata[] = array(
                    'id'        => $card[$i]->id,
                    'brand'     => $card[$i]->brand,
                    'exp_month' => $card[$i]->exp_month,
                    'exp_year'  => $card[$i]->exp_year,
                    'last'      => $card[$i]->last4
                );
            }
        }
        return view('front.homepage.setting.stripe_setting',compact('carddata'));
    }

    public function stripeCardStore(Request $request){

        // $this->validate($request, [
        //     'card_number'   => 'required',
        //     'cvc_number'    => 'required',
        //     'exp_month'     => 'required',
        //     'exp_year'      => 'required',
        // ]);

        // $carddata = array(
        //     'number'    => $request->card_number,
        //     'cvc'       => $request->cvc_number,
        //     'exp_month' => $request->exp_month,
        //     'exp_year'  => $request->exp_year
        // );

        $card_token = $request->stripeToken;
        $card = $this->createCard(Auth::user()->customer_id, $card_token);

        if($card['status'] == 402){
            return back()->with(['error_message' => $card['message']]);
            // $error = array($card['param'] => array($card['message']));
            // return $this->sendErrorResponse($error, 422);
        }else if($card['status'] == 400){
            $customer = $this->createCustomer(Auth::user()->email,Auth::user()->username);
            User::where('id',Auth::id())->update([ 'customer_id' => $customer->id ]);
            $customer_id = $customer->id;
            $card = $this->createCard($customer_id, $card_token);
        } else {
            return back()->with(['error_message' => $card['message']]);
        }
        // return $this->sendResponse('Card create successfully',200);
        return redirect()->back()->with(['message' => 'Card create successfully']);
    }

    public function stripeCardDelete($id){
        if($id){
            $card = $this->deleteCustomerCard(Auth::user()->customer_id, $id);
            return $this->sendResponse('Card delete successfully.',200);
        }
    }

    public function tagOption(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $tagoption = Tagoption::where('user_id',Auth::id())->first();
        $tagoptioncount = Tagoption::where('user_id', Auth::id())->count();
        $usertag = Usertag::where('userid',Auth::id())->pluck('tagid');
        $userantitag = Userantitag::where('userid',Auth::id())->pluck('tagid');
        $usertags = json_encode($usertag);
        $userantitags = json_encode($userantitag);

        if($tagoption != null){
            if($tagoptioncount != 0){
                $mytags = json_decode($tagoption->tags);
                $myantitag = json_decode($tagoption->antitag);
            }else{
                $mytags = json_decode($usertags);
                $myantitag = json_decode($userantitags);
            }
        }else{
            $mytags = null;
            $myantitag = null;
            if($usertags && $userantitags){
                $mytags = json_decode($usertags);
                $myantitag = json_decode($userantitags);
            }
        }


        $tag  = new Tag;
        if(!is_null($myantitag)){
            $tag = $tag->whereNotIn('id',$myantitag);
        }
        $tag = $tag->get();

        $antitags = new Tag;
        if(!is_null($mytags)){
            $antitags = $antitags->whereNotIn('id',$mytags);
        }
        $antitags = $antitags->get();

        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.setting.tag_option',compact('theme','tag','mytags','myantitag','antitags','font'));
    }

    public function tagDropdown(Request $request){
        $html = '';
        $mytags = $request->mytag;
        $myantitag = $request->myantitag;

        $antitags = new Tag;
        if(!is_null($mytags)){
            $antitags = $antitags->whereNotIn('id',$mytags);
        }
        $antitags = $antitags->get();

        $tag  = new Tag;
        if(!is_null($myantitag)){
            $tag = $tag->whereNotIn('id',$myantitag);
        }
        $tag = $tag->get();

        if($request->action == 'antitag'){
            foreach($antitags as $tg){
                $html .='<option ';
                if(isset($myantitag) && in_array($tg->id, $myantitag))
                {
                    $html .='selected ';
                }
                $html .='value="'.$tg->id.'">'.$tg->title.'</option>';
            }
        }elseif($request->action == 'mytag'){
            foreach($tag as $tg){
                $html .='<option';
                if(isset($mytags) && in_array($tg->id, $mytags)){
                    $html.= ' selected ';
                }
                $html .=' value="'.$tg->id.'">'.$tg->title.'</option>';
            }
        }
        echo json_encode($html);
    }

    public function tagOptionStore(Request $request){
        $tagoption = Tagoption::where('user_id',Auth::id())->first();

        $tag = json_encode($request->tag);
        $antitag = json_encode($request->antitag);
        Usertag::where('userid',Auth::id())->delete();
        Userantitag::where('userid',Auth::id())->delete();
        if(isset($request->tag)){
            foreach($request->tag as $tags){
                $Usertags = new Usertag();
                $Usertags->userid  = auth::id();
                $Usertags->tagid   = $tags;
                $Usertags->save();
            }
        }
        if(isset($request->antitag)){
            foreach($request->antitag as $antitags){
                $Userantitag = new Userantitag();
                $Userantitag->userid  = auth::id();
                $Userantitag->tagid   = $antitags;
                $Userantitag->save();
            }
        }

        if($tagoption != null){
            Tagoption::where('user_id',Auth::id())->update([
                'tags'   => $tag,
                'antitag'=> $antitag
            ]);
        }else{
            Tagoption::insert([
                'user_id'=> Auth::id(),
                'tags'   => $tag,
                'antitag'=> $antitag
            ]);
        }
        return redirect()->back()->with(['successful_message' => 'Tag setting updated successfully']);
    }

    public function technicalOption(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        if(Auth::user()->customer_id == null){
            $customer = $this->createCustomer(Auth::user()->email,Auth::user()->username);
            User::where('id',Auth::id())->update([ 'customer_id' => $customer->id ]);
            $customer_id = $customer->id;
        }else{
            $customer_id = Auth::user()->customer_id;
        }

        $customer_card = $this->customerCardList($customer_id,10);
        $carddata = array();
        if(isset($customer_card->data)){
            $card = $customer_card->data;
            for ($i=0; $i <count($card) ; $i++) {
                $carddata[] = array(
                    'id'        => $card[$i]->id,
                    'brand'     => $card[$i]->brand,
                    'exp_month' => $card[$i]->exp_month,
                    'exp_year'  => $card[$i]->exp_year,
                    'last'      => $card[$i]->last4
                );
            }
        }
        $theme =  $this->themes('homepage','blue_theme');

        return view('front.homepage.setting.technical_option',compact('theme','carddata','font'));
    }



    public function achievementOption(){

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $achievement_pred = Achievement::where('type','pred')->get();
        $achievement_prey = Achievement::where('type','prey')->get();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.setting.achievement',compact('theme','achievement_pred','achievement_prey','font'));
    }

    public function achievementStore(Request $request){

        $achievements = json_encode($request->achievements);
        $updatedata = array();
        if($request->role == 'pred'){
            $updatedata = array('achievements' => $achievements);
        }elseif($request->role == 'prey'){
            $updatedata = array('prey_achievements' => $achievements);
        }
        $user = User::where('id',Auth::id())->update($updatedata);

        // Notification
        $this->NotificationInsert(
            Auth::id(),                 // sender id
            Auth::id(),                 // receiver id
            0,                          // content id
            'achievement',              // notification type
            'You get an achievement',   // message
            'userachievement',          // type
            0,                          // status [0 = unread, 1 = read]
        );

        return redirect()->back()->with(['successful_message' => 'Achievements setting updated successfully']);
    }


}
