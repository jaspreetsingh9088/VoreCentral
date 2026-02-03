<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Threadcomment;
use App\Models\Follow;
use App\Models\ThemeOption;
use App\Models\Forumcategory;
use App\Models\Advertisement;
use App\Models\Forumheading;
use App\Models\Point;
use App\Models\Option;
use App\Models\Searchsorting;
use App\Models\Profilepost;
use App\Models\NotificationPrivacyOption;
use App\Models\Threadcommentdislike;
use App\Models\Threadcommentlike;
use App\Models\Achievementpoint;
use App\Models\Newsarchive;
use App\Models\Section;
use App\Models\Content;
use App\Models\Usercontent;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ForumController extends Controller
{
    use Notification,Achievementpoints;

    public $cache_time;
    public function __construct() {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function forumcategory()
    {
        // $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
        //     return Advertisement::where('status', '=', 1)->first();
        // });
        $advertisement = Advertisement::where('status', 2)->first(); // For testing

        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

        $theme = $this->themes('forum_theme','orange_theme');

        $ForumheadingData = Forumheading::get()->toArray();

        if(isset($ForumheadingData) && is_array($ForumheadingData) && count($ForumheadingData) > 0){
            foreach($ForumheadingData as $ForumheadingDataK => $ForumheadingDataV){
                $ForumcategoryData = Forumcategory::where('hid',$ForumheadingDataV['id'])->get()->toArray();

                if(isset($ForumcategoryData) && is_array($ForumcategoryData) && count($ForumcategoryData) > 0){
                    foreach($ForumcategoryData as $ForumcategoryDataK => $ForumcategoryDataV){

                        $ThreadData = Thread::where('cid',$ForumcategoryDataV['id'])->orderBy('id', 'desc')->first();
                        if(isset($ThreadData)){
                            $ForumcategoryData[$ForumcategoryDataK]['threaddata'] = $ThreadData ;
                        }
                    }
                }
                $ForumheadingData[$ForumheadingDataK]['category'] = $ForumcategoryData ;
            }
        }

        $search = '';

        $news = Cache::remember('forum_news', $this->cache_time, function () {
            return Newsarchive::orderBy('created_at', 'DESC')->first();
        });

        return view('front.forum.forum',compact('search','ForumheadingData','theme','advertisement','font','news'));
    }

    public function forumSearch(Request $request){
        $theme = $this->themes('forum_theme','orange_theme');
        if(Auth::check()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $search = '%'.$request->search.'%';
        $searchdata = array();
        // ============================ FORUM HEADING CATEGORY SEARCH =======================
            $forumcategorie = Forumcategory::where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('description', 'like', $search);
            })->get();
            foreach($forumcategorie as $fg){
                $searchdata[] = array(
                    'title'     => $fg->name,
                    'pagename'  => 'Thread',
                    'pagelink'  => route('thread',[$fg->id,1]),
                    'created_at'=> $fg->created_at
                );
            }
        // ============================ FORUM HEADING CATEGORY SEARCH =======================

        // ============================ THREAD SEARCH =======================================
            $threads = Thread::where(function ($query) use ($search){
                $query->where('topic','like',$search)
                ->orWhere('comment','like',$search);
            })->with(['user'])->get();
            foreach($threads as $thread){
                if(!is_null($thread->user)){ $thread_start = $thread->user->username; }else{ $thread_start = 'User not found'; }
                $searchdata[] = array(
                    'title'     => $thread->topic,
                    'pagename'  => 'Thread Topic',
                    'pagelink'  => route('thread',[$thread->cid,1]),
                    'thread_start'=> $thread_start,
                    'created_at'=> $thread->created_at
                );
            }
        // ============================ THREAD SEARCH =======================================

        // ============================ THREAD COMMENT SEARCH ===============================
            $threadcomment = Threadcomment::where(function ($query) use ($search){
                $query->where('comment','like',$search);
            })->with(['user'])->get();
            foreach($threadcomment as $tc){
                if(!is_null($tc->user)){ $who_comment = $tc->user->username; }else{ $who_comment = 'User Not Found'; }
                $searchdata[] = array(
                    'title'     => strip_tags($tc->comment),
                    'pagename'  => 'Thread Details',
                    'pagelink'  => route('threaddetail',[$tc->threadid,1]),
                    'who_comment'=> $who_comment,
                    'created_at'=> $tc->created_at
                );
            }
        // ============================ THREAD COMMENT SEARCH ===============================
        if(Auth::check()){
            $search_setting = Searchsorting::where('user_id',Auth::id())->first();
            $forum_setting = '';
            if(!is_null($search_setting) && $search_setting->forum_search == 'include_post_index'){
                $forum_setting = 'include_post_index';
            }elseif(!is_null($search_setting) && $search_setting->forum_search == 'include_userpage'){
                $forum_setting = 'include_userpage';
            }elseif(!is_null($search_setting) && $search_setting->forum_search == 'include_post_userpage'){
                $forum_setting = 'include_post_userpage';
                $profilepost = Profilepost::where('post','like',$search)->get();
                foreach($profilepost as $pp){
                    if(!is_null($pp->user)){ $username = $tc->user->username; }else{ $username = 'User Not Found'; }
                    $searchdata[] = array(
                        'title'     => $pp->post,
                        'pagename'  => 'User Profile Post',
                        'pagelink'  => route('profileprofilepost',[$pp->userid]),
                        'username'  => $username,
                        'created_at' => $tc->created_at
                    );
                }
            }elseif(!is_null($search_setting) && $search_setting->forum_search == 'include_homesite_material'){
                $forum_setting = 'include_post_userpage';
                // ============================ ONLINEUSER PAGE SEARCH ======================================
                    $onlineuser = User::where('username','like', $search)->where('status',1)->get();
                    foreach($onlineuser as $ou){
                        $searchdata[] = array(
                            'title'     => $ou->username,
                            'pagename'  => 'Online User',
                            'pagelink'  => route('onlineuser'),
                            'created_at'=> $ou->created_at
                        );
                    }
                // ============================ ONLINEUSER PAGE SEARCH ======================================

                // ============================ ABOUTUS PAGE CONTENT SEARCH =================================
                    $abountcontent = $aboutcontent = Content::where('alias','aboutus')->first();
                    $aboutsection = Section::select('text','created_at')->where('cid',$abountcontent->id)->where('text','like', $search)->get();
                    foreach($aboutsection as $as){
                        $searchdata[] = array(
                            'title'     => $as->text,
                            'pagename'  => 'About Us',
                            'pagelink'  => route('aboutus'),
                            'created_at'=> $as->created_at
                        );
                    }
                // ============================ ABOUTUS PAGE CONTENT SEARCH =================================

                // ============================ CONTENT PROMOTED PAGE SEARCH ================================
                    $usercontent = Usercontent::where(function ($query) use ($search) {
                                    $query->where('title', 'like', $search)
                                        ->orWhere('description', 'like', $search)
                                        ->orWhere('type', 'like', $search)
                                        ->orWhere('category','like', $search);
                                });
                    $usercontent = $usercontent->where('promoted',1)->get();
                    foreach($usercontent as $uc){
                        $searchdata[] = array(
                            'title'     => $uc->title,
                            'pagename'  => 'Content Promoted and Produced',
                            'pagelink'  => route('content.promoted.produced'),
                            'created_at'=> $uc->created_at
                        );
                    }
                // ============================ CONTENT PROMOTED PAGE SEARCH ================================

                // ============================ NEWS ARCHIVE PAGE SEARCH ====================================
                    $newsarchive = Newsarchive::where(function ($query) use ($search) {
                        $query->where('title', 'like', $search)
                            ->orWhere('description', 'like', $search);
                    });
                    $newsarchive = $newsarchive->where('status',1)->get();
                    foreach($newsarchive as $na){
                        $searchdata[] = array(
                            'title'     => $na->title,
                            'pagename'  => 'News Archive',
                            'pagelink'  => route('news_archieve'),
                            'created_at'=> $na->created_at
                        );
                    }
                // ============================ NEWS ARCHIVE PAGE SEARCH ====================================

                // ============================ Content search in blade file ================================
                    $templatePaths = [
                        resource_path('views/front/homepage/terms_service.blade.php'),
                        resource_path('views/front/homepage/privacypolicy.blade.php'),
                        resource_path('views/front/homepage/ourstaff.blade.php'),
                        resource_path('views/front/homepage/information-different-subjects.blade.php'),
                        resource_path('views/front/homepage/helpandsupport.blade.php'),
                        resource_path('views/front/homepage/contactus.blade.php'),
                        resource_path('views/front/homepage/creator-information-monetisation.blade.php'),
                    ];

                    $searchTerm = $request->search;
                    // Iterate over the list of template files and search for the string
                    foreach ($templatePaths as $templatePath) {
                        $templateContent = file_get_contents($templatePath);
                        $templateContent = strip_tags($templateContent);
                        // dd($templateContent);
                        $lines = explode("\n", $templateContent);

                        // Search for the string in each line of the template content
                        $lines = array_map('trim', $lines);
                        // dd($lines);
                        $linecount = 1;
                        if(in_array('page : creator information',$lines)){
                            $pagename = 'Creator Information Monetisation';
                            $pagelink = route('creator.information.monetisation');
                        }elseif(in_array('page : contactus',$lines)){
                            $pagename = 'Contact Us';
                            $pagelink = route('contactus');
                        }elseif(in_array('page : help and support',$lines)){
                            $pagename = 'Help and Support';
                            $pagelink = route('helpandsupport');
                        }elseif(in_array('page : information differnt subject',$lines)){
                            $pagename = 'Information Different Subject';
                            $pagelink = route('information.different.subject');
                        }elseif(in_array('page : our staff',$lines)){
                            $pagename = 'Our Staff';
                            $pagelink = route('ourstaff');
                        }elseif(in_array('page : privacy policy',$lines)){
                            $pagename = 'Privacy and Policy';
                            $pagelink = route('privacypolicy');
                        }elseif(in_array('page : term and service',$lines)){
                            $pagename = 'Term and Service';
                            $pagelink = route('termsservice');
                        }else{
                            $pagename = ''; $pagelink = '';
                        }
                        $contentstart = array_search('content start',$lines) + 1;
                        $contentend = array_search('content end',$lines);
                        for ($i=$contentstart; $i < $contentend; $i++) {
                            if($lines[$i] != ''){
                                if (strpos($lines[$i], $searchTerm) !== false) {
                                    $searchdata[] = array(
                                        'title'     => $lines[$i],
                                        'pagename'  => $pagename,
                                        'pagelink'  => $pagelink,
                                        'created_at'=> ''
                                    );
                                }
                                $linecount++;
                            }
                        }
                    }
                // ============================ Content search in blade file ================================
            }
        }else{
            $forum_setting = '';
        }
        return view('front.forum.search',compact('theme','font','searchdata','forum_setting'));
    }

    public function forumcategorySearch(Request $request){

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

        $theme =  $this->themes('forum_theme');

        $ForumheadingData = Forumheading::get()->toArray();

        if(isset($ForumheadingData) && is_array($ForumheadingData) && count($ForumheadingData) > 0){
            foreach($ForumheadingData as $ForumheadingDataK => $ForumheadingDataV){
                $ForumcategoryData = Forumcategory::where('hid',$ForumheadingDataV['id']);
                if($request->search){
                    $search = '%'.$request->search.'%';
                    $ForumcategoryData = $ForumcategoryData->Where(function ($query) use ($search) {
                        $query->where('name', 'like', $search);
                    });
                }
                $ForumcategoryData = $ForumcategoryData->get()->toArray();
                if(isset($ForumcategoryData) && is_array($ForumcategoryData) && count($ForumcategoryData) > 0){
                    foreach($ForumcategoryData as $ForumcategoryDataK => $ForumcategoryDataV){

                        $ThreadData = Thread::where('cid', $ForumcategoryDataV['id'])->orderBy('id', 'desc')->first();
                        if (isset($ThreadData)) {
                            $ForumcategoryData[$ForumcategoryDataK]['threaddata'] = $ThreadData;
                        }
                    }
                }
                $ForumheadingData[$ForumheadingDataK]['category'] = $ForumcategoryData;
            }
        }
        $search = $request->search;

        $news = Cache::remember('forum_news', $this->cache_time, function () {
            return Newsarchive::orderBy('created_at', 'DESC')->first();
        });

        return view('front.forum.forum',compact('search','ForumheadingData','theme','advertisement','font', 'news'));
    }

    public function index($id,$pageno){
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $offset = ($pageno-1) * 2;
        $Threaddatacount = Thread::where('cid',$id)->where('thread_lock', 0)->count();
        $ThreadData = Thread::where('cid',$id)->where('thread_lock', 0)->offset($offset)->limit(10)->orderBy('id','DESC')->get()->toArray();

        $categoryData = Forumcategory::select('name')->where('id',$id)->get()->toArray();
        if(Auth::id()){
            $pagename = 'thread';
            $this->PointInsert($id,$pagename,0.01,$pageno);
            // $achi_point = Achievementpoint::where('user_id',Auth::id())->where('page',$pagename)->where('page_no',$pageno)->count();
            // if($achi_point == 0){
            // }
        }
        $theme = $this->themes('forum_theme');

        $news = Cache::remember('forum_news', $this->cache_time, function () {
            return Newsarchive::orderBy('created_at', 'DESC')->first();
        });
        return view('front.forum.thread',compact('theme','ThreadData','id','Threaddatacount','pageno','categoryData','font','advertisement','news'));
    }

    public function threadSearch($id,$pageno,Request $request){
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $offset = ($pageno-1) * 2;
        $Threaddatacount = Thread::where('cid',$id)->where('thread_lock', 0)->count();
        $ThreadData = Thread::where('cid',$id)->where('thread_lock', 0);
        if($request->search){
            $search = '%'.$request->search.'%';
            $ThreadData = $ThreadData->Where(function ($query) use ($search) {
                $query->where('topic', 'like', $search)
                      ->orWhere('comment','like',$search);
            });
        }
        $ThreadData = $ThreadData->offset($offset)->limit(10)->get()->toArray();

        $categoryData = Forumcategory::select('name')->where('id',$id)->get()->toArray();
        if(Auth::id()){
            $pagename = 'thread';
            $this->PointInsert($id,$pagename,0.01,$pageno);
        }
        $theme = $this->themes('forum_theme');

        $news = Cache::remember('forum_news', $this->cache_time, function () {
            return Newsarchive::orderBy('created_at', 'DESC')->first();
        });

        return view('front.forum.thread',compact('id','pageno','theme','ThreadData','id','Threaddatacount','pageno','categoryData','font','advertisement','news'));
    }

    public function threaddetail($id,$pageno){
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $subForum = [];

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $offset = ($pageno-1) * 2;

        $ThreadData = Thread::where('id',$id)->first();
        if(isset($ThreadData))
        {
            $UserData = User::where('id', $ThreadData['userid'])->first();
            if(isset($UserData)){

                $Pointcount = Point::where('userid', $ThreadData['userid'])->sum('point');
                $subForum = Forumcategory::where('id', $ThreadData['cid'])->first();

                if($UserData['role_preference'] == 'pred'){
                    if(is_null($UserData['achievements']) || $UserData['achievements'] == 'null'){
                        $profile_rank = $this->achivements($UserData['role_preference'],$Pointcount);
                    }else{
                        $rank = json_decode($UserData['achievements']);
                        $profile_rank = implode(',',$rank);
                    }
                }else if($UserData['role_preference'] == 'prey'){
                    if(is_null($UserData['prey_achievements']) || $UserData['prey_achievements'] == 'null'){
                        $profile_rank = $this->achivements($UserData['role_preference'],$Pointcount);
                    }else{
                        $rank = json_decode($UserData['prey_achievements']);
                        $profile_rank = implode(',',$rank);
                    }
                }else{
                    $profile_rank = $UserData['achievements'];
                }

                $ThreadData['username'] = $UserData['username'];
                $ThreadData['profile_pic'] = $UserData['profile_pic'];
                $ThreadData['achivement'] = $profile_rank;
            }else{
                $ThreadData['username'] = 'Admin';
                $ThreadData['profile_pic'] = asset('assets/images/item-09.webp');
                $ThreadData['achivement'] = '';
            }
        }

        $threadcommentDatacount = Threadcomment::where('threadid', $id)->count();
        $threadcommentData = Threadcomment::where('threadid', $id)->offset($offset)->orderBy('id', 'ASC')->limit(15)->get()->toArray();

        if(isset($threadcommentData) && is_array($threadcommentData) && count($threadcommentData) > 0)
        {
            foreach($threadcommentData as $ThreadDataK => $ThreadDataV){
                $UserData = User::where('id',$ThreadDataV['userid'])->first();
                if(empty($UserData)) {
                    $threadcommentData[$ThreadDataK]['achivement'] = '';
                    $threadcommentData[$ThreadDataK]['dashboard_link'] = '';
                    $threadcommentData[$ThreadDataK]['username'] = '';
                    $threadcommentData[$ThreadDataK]['profile_pic'] = '';
                    continue;
                }
                $Pointcount = Point::where('userid',$ThreadDataV['userid'])->sum('point');

                $threadcommentData[$ThreadDataK]['username'] = $UserData['username'] ;
                $threadcommentData[$ThreadDataK]['profile_pic'] = $UserData['profile_pic'] ;

                if($UserData->creator == 1) {
                    $dashboard_link = route('creatorvisitordashboard',[$UserData->id]);
                }
                else {
                    $dashboard_link = route('profiledashboard',[$UserData->id]);
                }
                $threadcommentData[$ThreadDataK]['dashboard_link'] = $dashboard_link;

                $threadcommentData[$ThreadDataK]['achivement'] = $this->achivements($UserData['role_preference'],$Pointcount) ;
                if($UserData['role_preference'] == 'pred'){
                    if(is_null($UserData['achievements']) || $UserData['achievements'] == 'null'){
                        $profile_rank = $this->achivements($UserData['role_preference'],$Pointcount);
                    }else{
                        $rank = json_decode($UserData[0]['achievements']);
                        $profile_rank = implode(',',$rank);
                    }
                }else if($UserData['role_preference'] == 'prey'){
                    if(is_null($UserData['prey_achievements']) || $UserData['prey_achievements'] == 'null'){
                        $profile_rank = $this->achivements($UserData['role_preference'],$Pointcount);
                    }else{
                        $rank = json_decode($UserData['prey_achievements']);
                        $profile_rank = implode(',',$rank);
                    }
                }else{
                    $profile_rank = $UserData['achievements'];
                }
                $threadcommentData[$ThreadDataK]['achivement'] = $profile_rank;
            }
        }

        // $AllFollower = Follow::where('follow_by',Auth::id())->pluck('follow_to');
        $follow = array();
        if(Auth::id()){
            $AllFollower   = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
            $AllFollowing  = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
            $follower_following = array();
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->first();
                if(isset($UserData)){
                    $follower_following[] = $UserData['username'];
                }
            }
            if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
                foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                    $username = User::where('id', $AllFollowingV['follow_to'])->value('username');
                    $follower_following[] = $username;
                }
            }
            $follower_following = array_unique($follower_following);

            foreach ($follower_following as $key => $val) {
                $follow[] = '@'.$val;
            }

            $pagename = 'thread detail';
            $this->PointInsert($id,$pagename,0.01,$pageno);
        }
        $theme =  $this->themes('forum_theme');
        $generalsetting = Option::where('user_id', Auth::id())->where('show_comments',1)->first();
        return view('front.forum.threaddetail',compact('generalsetting','theme','ThreadData', 'follow', 'subForum','threadcommentData','threadcommentDatacount','id','pageno','font','advertisement'));
    }

    public function createthread(Request $request){
        $this->validate($request, [
           'topic' => 'required',
           'comment' => 'required',
           'cid' => 'required',
        ]);
        $Thread = new Thread ;
            if($request->file('media')){
                $file= $request->file('media');
                $filename= time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('thread'), $filename);
                copy(public_path('thread/').$filename, public_path('threadcomment/').$filename);
                $Thread->media = $filename ;
            }
        $Thread->topic    = $request->topic;
        $Thread->comment  = $request->comment;
        $Thread->userid   = Auth::user()->id;
        $Thread->cid      = $request->cid;
        $Thread->save();

        $Threadcomment = new Threadcomment;
        $Threadcomment->comment  = $request->comment;
        if(isset($filename)){$Threadcomment->media  = $filename;}
        $Threadcomment->userid   = Auth::user()->id;
        $Threadcomment->threadid = $Thread->id;
        $Threadcomment->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        if(Auth::id()){
            $pagename = 'add forum post';
            // dd($Thread);
            $this->PointInsertEveryTime($pagename,2,1,$Thread->id);
        }
        $this->addpoint(Auth::user()->id,2,"Added for forum post");
        return back()->with(['successful_message' => 'Content updated successfully']) ;
    }

    public function quotesmessage(Request $request){
        if($request->replay == '<p>The <strong>Basic</strong> package is perfect for short text fields that require little formatting, such as:</p>'){
            return back()->with(['successful_message' => 'Replay is required']) ;
        }
        $this->validate($request, [
            'parent_id' => 'required',
            'replay'    => 'required',
        ]);

        $Threadcomment = new Threadcomment;
        $Threadcomment->comment  = $request->replay;
        $Threadcomment->userid   = Auth::user()->id;
        $Threadcomment->threadid = $request->threadid;
        $Threadcomment->parent_id = $request->parent_id;
        $Threadcomment->save();

        $parentcomment = Threadcomment::where('id',$request->parent_id)->first();
        $notification_forum  = NotificationPrivacyOption::where('user_id',$parentcomment->userid)->pluck('notification_forum')->first();
        $notification_forum = json_decode($notification_forum);

        if(isset($notification_forum) && in_array('userquote_my_message',$notification_forum)){
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $parentcomment->userid, // recover id
                $Threadcomment->id,     // content id
                'quotes message',       // notification type
                Auth::user()->username.' replay your comment.',
                'forums',               // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }
        if(Auth::id()){
            $this->PointInsert($request->parent_id,'thread comment reply',0.05,1);
        }
        return back()->with(['successful_message' => 'Replay submit successfully']) ;
    }

    public function addthreadcomment(Request $request){
        if($request->comment == '<p>The <strong>Basic</strong> package is perfect for short text fields that require little formatting, such as:</p>'){
            return back()->with(['successful_message' => 'Comment is required']) ;
        }

        $this->validate($request, [
           'comment' => 'required',
           'threadid' => 'required',
        ]);
        $Threadcomment = new Threadcomment ;
        if($request->file('media')){
            $file= $request->file('media');
            $filename= time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('threadcomment'), $filename);
            $Threadcomment->media = $filename;
        }
        $Threadcomment->comment  = $request->comment;
        $Threadcomment->userid   = Auth::user()->id;
        $Threadcomment->threadid = $request->threadid;
        $Threadcomment->parent_comment_id = $request->parent_id;
        $Threadcomment->save();
        if(Auth::id()){
            $pagename = 'added thread comment';
            $this->PointInsert($request->threadid,$pagename,0.2,1);
        }
        $thread = Thread::where('id',$request->threadid)->first();
        // ================================================= Post in thread I've started =================================================
            $notification_forum  = NotificationPrivacyOption::where('user_id',$thread->userid)->pluck('notification_forum')->first();
            $notification_forum = json_decode($notification_forum);
            if(isset($notification_forum) && in_array('post_in_thread_i_started',$notification_forum)){
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $thread->userid,        // recover id
                    $Threadcomment->id,     // content id
                    'post thread started',  // notification type
                    Auth::user()->username.' comment your thread.',
                    'forums',               // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }
        // ===============================================================================================================================
        // ================================================= Post in thread I follow =====================================================
            $follow = Follow::where('follow_to',Auth::id())->pluck('follow_by');
            $notification_forum  = NotificationPrivacyOption::select('notification_forum','user_id')->whereIn('user_id',$follow)->get();
            foreach($notification_forum as $nf){
                $notification_forum = json_decode($nf->notification_forum);
                if(isset($notification_forum) && in_array('post_in_thread_i_followed',$notification_forum)){
                    $this->NotificationInsert(
                        Auth::id(),             // sender id
                        $nf->user_id,           // recover id
                        $Threadcomment->id,     // content id
                        'post thread I follow', // notification type
                        Auth::user()->username.' comment in '.$thread->topic.' thread',
                        'forums',               // notification type
                        0,                      // status [0 = unread, 1 = read]
                    );
                }
            }
        // ===============================================================================================================================
        // ================================================= Post in thread I've posted in ===============================================
            $allcomment = Threadcomment::where('threadid',$request->threadid)->pluck('userid');
            $notification_forum  = NotificationPrivacyOption::select('notification_forum','user_id')->whereIn('user_id',$allcomment)->whereNotIn('user_id',[Auth::id()])->get();
            foreach($notification_forum as $nf){
                $notification_forum = json_decode($nf->notification_forum);
                if(isset($notification_forum) && in_array('post_in_thread_i_have_posted',$notification_forum)){
                    $this->NotificationInsert(
                        Auth::id(),             // sender id
                        $nf->user_id,           // recover id
                        $Threadcomment->id,     // content id
                        'posted thread',     // notification type
                        Auth::user()->username.' comment in '.$thread->topic.' thread',
                        'forums',               // notification type
                        0,                      // status [0 = unread, 1 = read]
                    );
                }
            }
        // ===============================================================================================================================
        // ================================================= User @mentions me ===========================================================
            $comment = $request->comment;
            $username = array();
            $pattern = '/data-mention="@([^"]+)"/';
            if (preg_match_all($pattern, $comment, $matches)) {
                $username[] =  $matches[1];
            }
            if(isset($username[0])){
                $username = $username[0];
                for ($i=0; $i < count($username); $i++) {
                    $user = User::where('username',$username[$i])->first();

                    $notification_forum  = NotificationPrivacyOption::where('user_id',$user->id)->pluck('notification_forum')->first();
                    $notification_forum = json_decode($notification_forum);

                    if(isset($notification_forum) && in_array('user_mention_me',$notification_forum)){
                        $this->NotificationInsert(
                            Auth::id(),             // sender id
                            $user->id,              // recover id
                            $Threadcomment->id,     // content id
                            'mentions',             // notification type
                            Auth::user()->username.' mentions you in thread comment.',
                            'forums',               // notification type
                            0,                      // status [0 = unread, 1 = read]
                        );
                    }
                }
            }
        // ===============================================================================================================================
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        $this->addpoint(Auth::user()->id,0.2,"Added for forum post comment");
        return back()->with(['successful_message' => 'Content updated successfully']) ;
    }

    public function threadCommentLike($id){
        if(!empty($id)){
            $isdislike = Threadcommentdislike::where('comment_id',$id)->where('user_id',Auth::id())->first();
            if(isset($isdislike)){
                $isdislike->delete();
            }
            $isthreadlike = Threadcommentlike::where('comment_id',$id)->where('user_id',Auth::id())->first();
            if(isset($isthreadlike)){
                $isthreadlike->delete();
                return back()->with(['successful_message' => 'Like deleted']) ;
            }else{
                $commentlike = new Threadcommentlike;
                $commentlike->user_id = Auth::id();
                $commentlike->comment_id = $id;
                $commentlike->save();
                $threadcomment = Threadcomment::where('id',$id)->first();
                $notification_forum  = NotificationPrivacyOption::where('user_id',$threadcomment->userid)->pluck('notification_forum')->first();
                $notification_forum = json_decode($notification_forum);

                if(isset($notification_forum) && in_array('user_mention_me',$notification_forum)){
                    $this->NotificationInsert(
                        Auth::id(),             // sender id
                        $threadcomment->userid, // recover id
                        $commentlike->id,       // content id
                        'thread like',          // notification type
                        Auth::user()->username.' like your thread comment.',
                        'forums',               // notification type
                        0,                      // status [0 = unread, 1 = read]
                    );
                }
                if(Auth::id()){
                    $this->PointInsert($id,'thread comment likes',0.05,1);
                }
                return back()->with(['successful_message' => 'Comment liked successfully.']) ;
            }
        }
    }

    public function threadCommentDislike($id){
        if(!empty($id)){
            $islike = Threadcommentlike::where('comment_id',$id)->where('user_id',Auth::id())->first();
            if(isset($islike)){
                $islike->delete();
            }

            $isthreaddislike = Threadcommentdislike::where('comment_id',$id)->where('user_id',Auth::id())->first();
            if(isset($isthreaddislike)){
                $isthreaddislike->delete();
                return back()->with(['successful_message' => 'Unlike deleted']) ;
            }else{
                $commentlike = new Threadcommentdislike;
                $commentlike->user_id = Auth::id();
                $commentlike->comment_id = $id;
                $commentlike->save();
                if(Auth::id()){
                    $this->PointInsert($id,'thread comment dislike',0.05,1);
                }
                return back()->with(['successful_message' => 'Comment disliked successfully.']) ;
            }
        }
    }

    public function mytopics(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $theme = ThemeOption::whereUserId(Auth::user()->id)->value('others_theme');

        $ThreadData = Thread::where('userid',Auth::user()->id)->get()->toArray();

        return view('front.other_page.mytopics',compact('font','ThreadData','theme'));
    }

    public function mytopicsSearch(Request $request){
        $search = '%'.$request->search.'%';

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $theme = ThemeOption::whereUserId(Auth::user()->id)->value('others_theme');

        $ThreadData = Thread::where(function ($query) use ($search) {
            $query->where('topic', 'like', $search)
                ->orWhere('comment', 'like', $search);
        });

        $ThreadData = $ThreadData->where('userid',Auth::user()->id)->get()->toArray();


        return view('front.other_page.mytopics',compact('font','ThreadData','theme'));
    }

}
