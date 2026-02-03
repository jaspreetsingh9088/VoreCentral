<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\CustomFileUpload;
use App\Traits\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profilepost;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Journal;
use App\Models\Profilecomment ;
use App\Models\Follow ;
use App\Models\Activity ;
use App\Models\Comment ;
use App\Models\Like ;
use App\Models\Usercontent ;
use App\Models\Creatorcontent ;
use App\Models\Gallerycomment ;
use App\Models\Galleryfavorite ;
use App\Models\Point ;
use App\Models\Option;
use App\Models\NotificationPrivacyOption;
use App\Models\Advertisement;
use App\Models\Featuredcontent;
use App\Models\Dlccontents;
use App\Models\Paidcontent;
use App\Models\Thread;
use App\Models\Threadcomment;
use App\Models\Owncollaction;
use App\Models\Singlefeaturedcontent;
use App\Models\Featuredchannel;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use DB;
use App\Models\Tagoption;
use App\Models\Tag;
use App\Models\ThemeOption;
use App\Models\Searchsorting;

class CreatorvisiterController extends Controller
{
    use CustomFileUpload, Notification;

    public $cache_time, $limit;
    public function __construct(){
        $this->limit = 20;

        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function dashboard($id){
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
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $id, url()->current());
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $myData       = User::where('id',$id)->get()->toArray();
        $AllFollower   = Follow::where('follow_to',$id)->count();
        if(Auth::id()){
            $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->count();
        }else{
            $isFollowing = 0;
        }
        $Pointcount = Point::where('userid',$id)->sum('point');
        $myData[0]['achivement']= $this->achivements($myData[0]['role_preference'],$Pointcount) ;

        $Pointcount = Point::where('userid', $myData[0]['id'])->sum('point');
        if($myData[0]['role_preference'] == 'pred'){
            if(is_null($myData[0]['achievements']) || $myData[0]['achievements'] == 'null'){
                $profile_rank = $this->achivements($myData[0]['role_preference'],$Pointcount);
            }else{
                $rank = json_decode($myData[0]['achievements']);
                $profile_rank = implode(',',$rank);
            }
        }else if($myData[0]['role_preference'] == 'prey'){
            if(is_null($myData[0]['prey_achievements']) || $myData[0]['prey_achievements'] == 'null'){
                $profile_rank = $this->achivements($myData[0]['role_preference'],$Pointcount);
            }else{
                $rank = json_decode($myData[0]['prey_achievements']);
                $profile_rank = implode(',',$rank);
            }
        }else{
            $profile_rank = $myData[0]['achievements'];
        }

        $usercontentcount = Usercontent::where('userid',$id)->count();
        $dlccontentcount = Dlccontents::where('userid',$id)->count();
        $paidcontentcount = Paidcontent::where('user_id',$id)->count();
        $useruploadcount = $usercontentcount + $dlccontentcount + $paidcontentcount;

        $threadcount = Thread::where('userid',$id)->count();

        $gallerycommentcount = Gallerycomment::where('userid',$id)->count();
        $profilecommentcount = Profilecomment::where('uid',$id)->count();
        $threadcommentcount  = Threadcomment::where('userid',$id)->count();
        $numberofcomment = $gallerycommentcount + $profilecommentcount + $threadcommentcount;


        $datetime1 = new DateTime($myData[0]['created_at']);
        $datetime2 = new DateTime(today());
        $interval = $datetime1->diff($datetime2);
        $hasbeenmember = $interval->format('%a');
        if($myData[0]['moderator'] == 1){ $profile_type = 'Moderator'; }elseif($myData[0]['creator'] == 1){ $profile_type = 'Creator'; }else{ $profile_type = 'User'; }
        $userinfo = array(
            'profile_rank'  => $profile_rank,
            'profile_type'  => $profile_type,
            'upload_count'  => $useruploadcount,
            'thread_count'  => $threadcount,
            'total_comment' => $numberofcomment,
            'hasbeenmember' => $hasbeenmember,
            'gender'        => $myData[0]['gender']
        );
        $generalsetting = Option::where('user_id',$id)->first();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $RecentUsercontent = Usercontent::select('thumbnail', 'id')->where('userid', $id)->limit(3)->get()->toArray();

        $UsercontentData = array();
        $SingleFeaturedcontentData = array();
        $Owncollaction = Owncollaction::where('userid', $id)->where('featured', 1)->get()->toArray();
        if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0) {
            foreach ($Owncollaction as $OwncollactionK => $OwncollactionV) {
                $contentarray = json_decode($OwncollactionV['contentids'], true);
                $UsercontentData[] = Usercontent::select('thumbnail', 'id')->whereIn('id', $contentarray)->get()->toArray();
            }
        }

        $SinglefeaturedData = Singlefeaturedcontent::where('userid', $id)->get()->toArray();
        if (isset($SinglefeaturedData) && is_array($SinglefeaturedData) && count($SinglefeaturedData) > 0) {
            $SingleFeaturedcontentData = Usercontent::where('id', $SinglefeaturedData[0]['contentid'])->get()->toArray();
        }
        // dd($SingleFeaturedcontentData);
        return view('front.creatorvisitor.dashboard',compact('SingleFeaturedcontentData','UsercontentData','RecentUsercontent','myData','AllFollower','id','isFollowing','font','userinfo','generalsetting','advertisement'));

    }

    public function featuredgallery($id,$sort){
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
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $id, url()->current());
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

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
        return view('front.creatorvisitor.featuredgallery', compact('font','UsercontentData', 'myData','advertisement','font'));
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

        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $id, url()->current());
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
            $UsercontentData = Usercontent::where('userid', $id)->orderBy('id', 'desc')->paginate(20);
        } elseif (isset($sort) && $sort == "old") {
            $UsercontentData = Usercontent::where('userid', $id)->orderBy('id', 'asc')->paginate(20);
        } else {
            $UsercontentData = Usercontent::where('userid', $id)->paginate(20);
        }

        $myData = User::where('id',$id)->get()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        return view('front.creatorvisitor.gallery',compact('myData','font','UsercontentData','AllFollower','AllFollowing','advertisement'));
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

        if(Auth::id()){
            $this->visitCount(Auth::id(), $id, url()->current());
        }

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
        return view('front.creatorvisitor.media', compact('UsercontentData','myData','font','advertisement'));
    }

    public function collection(Request $request,$id){
        $search = '%' . $request->search . '%';
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $UsercontentData = array();
        $Owncollaction = Owncollaction::where('userid', $id)
        ->when($request->search, function ($query, $search) {
            $query->where('collection_name', 'like', '%' . $search . '%');
        })
        ->get()
        ->toArray();
        if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0) {
            foreach ($Owncollaction as $OwncollactionK => $OwncollactionV) {
                $contentarray = json_decode($OwncollactionV['contentids'], true);
                $Owncollaction[$OwncollactionK]['contentData'] = Usercontent::select('thumbnail', 'id')->whereIn('id', $contentarray)->get()->toArray();
            }
        }
        $myData = User::where('id', $id)->get()->toArray();
        // $generalsetting = Option::where('user_id',Auth::id())->first();
        return view('front.creatorvisitor.collection', compact('Owncollaction','font','myData'));
    }

    public function creatorupload($id){
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        return view('front.creatorvisitor.creatorupload',compact('id','font'));
    }

    public function creatorwebstore($id){
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
        $CreatorcontentData = Paidcontent::where('user_id',$id)->paginate(10);
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $id, url()->current());
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        return view('front.creatorvisitor.webstore',compact('CreatorcontentData','id','font'));
    }

    public function webstoredetail($id){
        $isfavourite = 0 ;
        $CreatorcontentData = Creatorcontent::where('id',$id)->get()->toArray();
         if(isset($CreatorcontentData) && is_array($CreatorcontentData) && count($CreatorcontentData) > 0)
        {
            foreach($CreatorcontentData as $CreatorcontentDataK => $CreatorcontentDataV){
                $commentData = Gallerycomment::where('contentid',$CreatorcontentDataV['id'])->get()->toArray();
                if(isset($commentData) && is_array($commentData) && count($commentData) > 0){
                    foreach($commentData as $commentDataK => $commentDataV){
                        $UserData = User::where('id',$commentDataV['userid'])->get()->toArray();
                        $commentData[$commentDataK]['username'] = $UserData[0]['username'] ;
                    }
                }
                $CreatorcontentData[$CreatorcontentDataK]['commentdata'] = $commentData;
                $isfavourite  = Galleryfavorite::where('userid',Auth::user()->id)->where('contentid',$CreatorcontentDataV['id'])->count();
            }
        }
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $id, url()->current());
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        return view('front.creatorvisitor.webstoredetail',compact('CreatorcontentData','isfavourite','font'));

    }

    public function monetizeupload(){
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        return view('front.creatorvisitor.monetizeupload',compact('font'));

    }

    public function creatorgallery(Request $request,$id,$sort){

        $user_id=$id;
        $myData=User::where('id',$user_id)->get()->toArray();
        $order="";
        $segment = $request->segments();
        if(isset($segment[3])){
            $order = $segment[3];
            }
            else{
            $order="";
            }
        if (isset($sort) && !is_null($sort)) {
            $filter_type = $sort;
        } else {
            $filter_type = '';
        }
        $title = "search";
        $search = '%' . $request->search . '%';
        if($filter_type=="all"){
            $filter_type="";
        }
        else{
            $filter_type= $filter_type;
        }
        $type='';
        $tagData = Tag::where('title', 'like', $search)->get(['id']);
        $themes = ThemeOption::value('homepage_theme');
        $font = Option::value('preffered_font');
        $UsercontentData = new Usercontent;

        if($filter_type!=""){
            $UsercontentData = $UsercontentData->where('type',$filter_type)->where("userid",$user_id);
        }
        else{
            $UsercontentData = $UsercontentData->where("userid",$user_id);
        }

        // Antitag setting
         if ($user_id) {
            $user_antitag = Tagoption::where('user_id',$user_id)->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                      //  $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
        }

        // Gallery vore and non-vore setting
        if (Auth::id()) {
            $searchsetting = Searchsorting::where('user_id',$user_id)->first();
            if (isset($searchsetting->gs_nonevore) && $searchsetting->gs_nonevore == '1') {
                $UsercontentData = $UsercontentData->where('content_type', 'non-vore');
            }
        }

        $UsercontentData = $UsercontentData->where('status', 1);
        $UsercontentData = $UsercontentData->where(function ($query) use ($tagData, $search) {
            foreach ($tagData as $tag) {
                $query->orWhereRaw("FIND_IN_SET($tag->id, tags)");
            }

            $query->orWhere('title', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('type', 'like', $search)
                ->orWhere('category', 'like', $search);

            $import_search =array($search);
            if (count($import_search) > 0) {
                for ($i = 0; $i < count($import_search); $i++) {
                    $im_search = '%' . $import_search[$i] . '%';
                    $query->orWhere('title', 'like', $im_search);
                    $query->orWhere('description', 'like', $im_search);
                    $query->orWhere('type', 'like', $im_search);
                    $query->orWhere('category', 'like', $im_search);
                }
            }
        });

        if ( $order == 'recency') {
            $UsercontentData = $UsercontentData
                ->where('created_at', '>=', Carbon::yesterday())
                ->where('created_at', '<', Carbon::today())
                ->orderByRaw("tags DESC, created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else
                if ($order == 'prioritisePopularity') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritise', 'desc']]);
        } else
                if ($order == 'prioritiseTags') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritisetags', 'desc']]);
        } else
                if ($order == 'latest') {

            $UsercontentData = $UsercontentData
                ->orderByRaw("created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else if ($order == 'relevancy') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['relevancy', 'desc']]);
        } else if ($order == 'featured') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;

            $featuredcontent = Featuredcontent::pluck('contentid')->toArray();
            $data = $data->whereIn('id', $featuredcontent);
        } else {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
        }
        $currentPage = request()->page;
        $perPage = $data->count() == 0 ? 1 : $data->count();
        $data = $data->forPage($currentPage, $perPage);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data->all(),
            $data->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $contenttitle = Usercontent::pluck('title');
        $type_tag_category = array('Literature', 'Picture', 'Comic', 'Video', 'Audio', 'Interactive', 'Short', 'story', 'chapter', '3D Art', 'Photograhy', 'Photomanip', 'Visual Update', 'Traditional Art', 'Digital Art');
        $type_tag_category = collect($type_tag_category);
        $contenttitle = $contenttitle->merge($type_tag_category);
        $search = $request->search;
        return view('front.creatorvisitor.gallery', compact('filter_type', 'type_tag_category', 'contenttitle', 'search', 'data', 'type', 'paginator', 'title', 'themes', 'font', 'advertisement','myData'));


    }

    public function usergallery(Request $request,$id,$sort){

        $user_id=$id;
        $myData=User::where('id',$user_id)->get()->toArray();
        $order="";
        $segment = $request->segments();
        if(isset($segment[3])){
            $order = $segment[3];
            }
            else{
            $order="";
            }
        if (isset($sort) && !is_null($sort)) {
            $filter_type = $sort;
        } else {
            $filter_type = '';
        }
        $title = "search";
        $search = '%' . $request->search . '%';
        if($filter_type=="all"){
            $filter_type="";
        }
        else{
            $filter_type= $filter_type;
        }
        $type='';
        $tagData = Tag::where('title', 'like', $search)->get(['id']);
        $themes = ThemeOption::value('homepage_theme');
        $font = Option::value('preffered_font');
        $UsercontentData = new Usercontent;

        if($filter_type!=""){
            $UsercontentData = $UsercontentData->where('type',$filter_type)->where("userid",$user_id);
        }
        else{
            $UsercontentData = $UsercontentData->where("userid",$user_id);
        }

        // Antitag setting
         if ($user_id) {
            $user_antitag = Tagoption::where('user_id',$user_id)->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                      //  $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
        }

        // Gallery vore and non-vore setting
        if (Auth::id()) {
            $searchsetting = Searchsorting::where('user_id',$user_id)->first();
            if (isset($searchsetting->gs_nonevore) && $searchsetting->gs_nonevore == '1') {
                $UsercontentData = $UsercontentData->where('content_type', 'non-vore');
            }
        }

        $UsercontentData = $UsercontentData->where('status', 1);
        $UsercontentData = $UsercontentData->where(function ($query) use ($tagData, $search) {
            foreach ($tagData as $tag) {
                $query->orWhereRaw("FIND_IN_SET($tag->id, tags)");
            }

            $query->orWhere('title', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('type', 'like', $search)
                ->orWhere('category', 'like', $search);

            $import_search =array($search);
            if (count($import_search) > 0) {
                for ($i = 0; $i < count($import_search); $i++) {
                    $im_search = '%' . $import_search[$i] . '%';
                    $query->orWhere('title', 'like', $im_search);
                    $query->orWhere('description', 'like', $im_search);
                    $query->orWhere('type', 'like', $im_search);
                    $query->orWhere('category', 'like', $im_search);
                }
            }
        });

        if ( $order == 'recency') {
            $UsercontentData = $UsercontentData
                ->where('created_at', '>=', Carbon::yesterday())
                ->where('created_at', '<', Carbon::today())
                ->orderByRaw("tags DESC, created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else
                if ($order == 'prioritisePopularity') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritise', 'desc']]);
        } else
                if ($order == 'prioritiseTags') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritisetags', 'desc']]);
        } else
                if ($order == 'latest') {

            $UsercontentData = $UsercontentData
                ->orderByRaw("created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else if ($order == 'relevancy') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['relevancy', 'desc']]);
        } else if ($order == 'featured') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;

            $featuredcontent = Featuredcontent::pluck('contentid')->toArray();
            $data = $data->whereIn('id', $featuredcontent);
        } else {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
        }
        $currentPage = request()->page;
        $perPage = $data->count() == 0 ? 1 : $data->count();
        $data = $data->forPage($currentPage, $perPage);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data->all(),
            $data->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $contenttitle = Usercontent::pluck('title');
        $type_tag_category = array('Literature', 'Picture', 'Comic', 'Video', 'Audio', 'Interactive', 'Short', 'story', 'chapter', '3D Art', 'Photograhy', 'Photomanip', 'Visual Update', 'Traditional Art', 'Digital Art');
        $type_tag_category = collect($type_tag_category);
        $contenttitle = $contenttitle->merge($type_tag_category);
        $search = $request->search;
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.creatorvisitor.usergallery', compact('filter_type', 'type_tag_category', 'contenttitle', 'search', 'data', 'type', 'paginator', 'title', 'themes', 'font', 'advertisement','myData','theme'));


    }

    public function contentdetail($uid,$id){
        $isfavourite = 0 ;
        $UsercontentData = Usercontent::where('id',$id)->get()->toArray();
        $creatore = User::where('id',$uid)->first();
        if(isset($UsercontentData) && is_array($UsercontentData) && count($UsercontentData) > 0)
        {
            foreach($UsercontentData as $UsercontentDataK => $UsercontentDataV){
                $commentData = Gallerycomment::where('contentid',$UsercontentDataV['id'])->get()->toArray();
                // $likecount = Like::where('postid',$myPostdataV['id'])->count();
                if(isset($commentData) && is_array($commentData) && count($commentData) > 0)
                {
                    foreach($commentData as $commentDataK => $commentDataV){
                        $UserData = User::where('id',$commentDataV['userid'])->value('username');
                        $commentData[$commentDataK]['username'] = $UserData;
                    }
                }

                $UsercontentData[$UsercontentDataK]['commentdata'] = $commentData ;
                //$myPostdata[$myPostdataK]['likecount'] = $LIKECOUNT ;
                $isfavourite  = Galleryfavorite::where('userid',Auth::user()->id)->where('contentid',$UsercontentDataV['id'])->count();
            }
        }
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $this->visitCount(Auth::id(), $uid, url()->current());
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });
        return view('front.creatorvisitor.contentdetail',compact('UsercontentData','isfavourite','creatore','font','advertisement'));

    }

    /* public function userinfo($id){
        $is_visitor = true ;
        $myData = User::where('id',$id)->get()->toArray();
        $ActivityData = Activity::where('userid',$id)->get()->toArray();
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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

        return view('front.profilevisitor.dashboard',compact('myData','is_visitor','id','isFollowing','AllFollower','AllFollowing','ActivityData'));
    }

    public function aboutus($id){
       $is_visitor = true ;
       $myData = User::where('id',$id)->get()->toArray();
       $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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
        return view('front.profilevisitor.about',compact('myData','id','is_visitor','AllFollower','AllFollowing','isFollowing'));

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
    } */

    /// Rp status ////
    /*
        public function journal($id){

            $isFollowing   = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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

            $is_visitor = true ;
            $JournalData = Journal::where('userid',$id)->get()->toArray();
            $myData = User::where('id',$id)->get()->toArray();
            return view('front.profilevisitor.journal',compact('JournalData','myData','is_visitor','id','AllFollower','AllFollowing','isFollowing'));

        }
        public function rpstatus($id){
            $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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
            $is_visitor = true ;
            $myData = User::where('id',$id)->get()->toArray();
            return view('front.profilevisitor.rpstatus',compact('myData','is_visitor','id','AllFollower','AllFollowing','isFollowing'));

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
    */

    // Rp status
    /* public function profilepost($id){
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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

        $is_visitor = true ;
        $myPostdata = Profilepost::where('userid',$id)->get()->toArray();
         if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0)
        {
            foreach($myPostdata as $myPostdataK => $myPostdataV){
                 $likecount = Like::where('postid',$myPostdataV['id'])->count();
                 $commentData = Comment::where('postid',$myPostdataV['id'])->get()->toArray();
         if(isset($commentData) && is_array($commentData) && count($commentData) > 0)
        {
            foreach($commentData as $commentDataK => $commentDataV){
               $UserData = User::where('id',$commentDataV['userid'])->get()->toArray();
             $commentData[$commentDataK]['username'] = $UserData[0]['username'] ;
        }}
             $myPostdata[$myPostdataK]['commentdata'] = $commentData ;
             $myPostdata[$myPostdataK]['likecount'] = $likecount ;
            }
        }
        $myData = User::where('id',$id)->get()->toArray();
        return view('front.profilevisitor.profilepost',compact('myPostdata','myData','is_visitor','id','AllFollower','AllFollowing','isFollowing'));

    }

    public function follow($id){

            $Follow = new Follow ;
            $Follow->follow_by  = Auth::user()->id;
            $Follow->follow_to  = $id ;
            $Follow->save();

           $myData  = User::where('id',Auth::user()->id)->get()->toArray();
           $Activity = new Activity ;
           $Activity->userid  = $id ;
           $Activity->content  = $myData[0]['username']." started following you" ;
           $Activity->save();

            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function unfollow($id){

        $Follow = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->delete();
        $myData  = User::where('id',Auth::user()->id)->get()->toArray();
        $Activity = new Activity ;
        $Activity->userid  = $id ;
        $Activity->content  = $myData[0]['username']." un-followed you" ;
        $Activity->save();
        return redirect()->back();
       }


        public function info($id){
        $is_visitor = true ;
        $myData = User::where('id',$id)->get()->toArray();
        $isFollowing = Follow::where('follow_by',Auth::user()->id)->where('follow_to',$id)->first();
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

        return view('front.profilevisitor.info',compact('myData','id','is_visitor','AllFollower','AllFollowing','isFollowing'));

    }

    public function addcomment(Request $request){
        $this->validate($request, [
        'comment' => 'required',
        'postid' => 'required',]);

        $Comment = new Comment ;
        $Comment->userid = Auth::user()->id ;
        $Comment->postid = $request->postid ;
        $Comment->comment = $request->comment ;
        $Comment->save();

        $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];
        return response()->json($response, 200);
    }

    public function like($id){

        $Like = new Like ;
        $Like->userid  = Auth::user()->id;
        $Like->postid  = $id ;
        $Like->save();

        return redirect()->back();
    }

    public function uploadmonetize(Request $request){

          $this->validate($request, [
           'title' => 'required',
           'description' => 'required',
           'tags' => 'required',
           'price' => 'required',
       ]);

        $Creatorcontent = new Creatorcontent;
        $Creatorcontent->title = $request->title ;
        $Creatorcontent->description = $request->description ;
        $Creatorcontent->tags = $request->tags ;
        $Creatorcontent->price = $request->price ;

          if($request->file('content')){
                $file= $request->file('content');
                $filename= time().".".$file->getClientOriginalExtension();
                $file-> move(public_path('creatorcontent'), $filename);
                $Creatorcontent->content = $filename ;
                $Creatorcontent->type = $file->getClientOriginalExtension();
            }

            if($request->file('thumbnail')){
                $Creatorcontent->thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'creatorthumbnail');
            }
        $Creatorcontent->save();
        return back()->with(['successful_message' => 'Content updated successfully']) ;

    }  */

    public function journal($id){
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
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $JournalData = Journal::where('userid',Auth::user()->id)->get()->toArray();
        $myData = User::where('id', $id)->get()->toArray();
        return view('front.creatorvisitor.journal',compact('myData','JournalData','id','font'));

    }

    public function addjournal(Request $request){

         $this->validate($request, [
           'title' => 'required',
           ]);

            $Journal = new Journal ;
            $Journal->title  = $request->title;
            $Journal->userid  = Auth::user()->id;
            $Journal->save();

            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function addgallerycomment(Request $request){

         $this->validate($request, [
           'comment' => 'required',
           'contentid' => 'required',]);

            $Gallerycomment = new Gallerycomment ;
            $Gallerycomment->userid = Auth::user()->id ;
            $Gallerycomment->contentid = $request->contentid ;
            $Gallerycomment->comment = $request->comment ;
            $Gallerycomment->save();

            $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];
        return response()->json($response, 200);
    }

    public function markgalleryfavorite($id){
        $isfavourite  = Galleryfavorite::where('userid',Auth::user()->id)->where('contentid',$id)->get()->toArray();
        if(isset($isfavourite) && is_array($isfavourite) && count($isfavourite) > 0 )
        {
            Galleryfavorite::where('userid',Auth::user()->id)->where('contentid',$id)->delete();
        }else{
            $Galleryfavorite = new Galleryfavorite ;
            $Galleryfavorite->userid  = Auth::user()->id;
            $Galleryfavorite->contentid  = $id ;
            $Galleryfavorite->save();
        }

            $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function community($id){
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

        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $myPostdata = Profilepost::where('userid',$id)->orderby('id','desc')->get()->toArray();

        if(isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0)
        {
            foreach($myPostdata as $myPostdataK => $myPostdataV){
                $commentData = Comment::where('postid',$myPostdataV['id'])->where('comment_parent_id', 0)->get()->toArray();
                $likecount = Like::where('postid',$myPostdataV['id'])->count();
                if(isset($commentData) && is_array($commentData) && count($commentData) > 0)
                {
                    foreach($commentData as $commentDataK => $commentDataV){
                        $UserData = User::where('id',$commentDataV['userid'])->get()->toArray();
                        $commentData[$commentDataK]['username'] = $UserData[0]['username'] ;

                        // Reply to data
                        $reply_data = Comment::join('users', 'users.id', '=', 'comments.userid')
                            ->where('postid', $myPostdataV['id'])
                            ->where('comment_parent_id', $commentDataV['id'])
                            ->select('comments.*', 'username')
                            ->get();
                        $commentData[$commentDataK]['reply_data'] = $reply_data;
                    }
                }

                $myPostdata[$myPostdataK]['commentdata'] = $commentData ;
                $myPostdata[$myPostdataK]['likecount'] = $likecount ;
            }
        }
        $myData = User::where('id',$id)->get()->toArray();
        $advertisement = Advertisement::where('status','=',1)->first();
        return view('front.creatorvisitor.community',compact('myPostdata','id','font','myData','advertisement'));
    }

    public function groupfavourite($id){
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

        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

        $Galleryfavorite = Galleryfavorite::where('userid', $id)->get()->toArray();
        $UsercontentData = array();
        $GroupcontentData = array();
        $FollowingcontentData = array();
        if (isset($Galleryfavorite) && is_array($Galleryfavorite) && count($Galleryfavorite) > 0) {
            $Galleryfavorite = array_column($Galleryfavorite, 'contentid');
            $UsercontentData = Usercontent::whereIn('id', $Galleryfavorite)->get()->toArray();
        }
        $myData = User::where('id', $id)->get()->toArray();

        $AllFollower   = Follow::where('follow_to', $id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            $AllFollower = array_column($AllFollower, 'follow_by');
            $GroupcontentData = Usercontent::whereIn('userid', $AllFollower)->get()->toArray();
        }


        $AllFeaturedchannel = Featuredchannel::where('userid', $id)->get()->toArray();
        $UserData = array();
        if (isset($AllFeaturedchannel) && is_array($AllFeaturedchannel) && count($AllFeaturedchannel) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $FollowingcontentData = User::whereIn('id', $featuredarray)->get()->toArray();
        }
        $advertisement = Advertisement::where('status','=',1)->first();
        $generalsetting = Option::where('user_id',Auth::id())->first();
       return view('front.creatorvisitor.groupfavourite',compact('generalsetting','advertisement','UsercontentData', 'myData', 'GroupcontentData', 'FollowingcontentData','font'));

    }

    public function deleteComment(Request $request)
    {
        Comment::where('id', $request->id)->delete();
        Comment::where('comment_parent_id', $request->id)->delete();
        return redirect()->back()->with(['successful_message' => 'Comment is deleted successfully.']);
    }
}
