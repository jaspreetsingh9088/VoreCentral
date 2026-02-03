<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\ThemeOption;
use App\Models\Option;
use App\Models\Advertisement;
use App\Models\Usercontent;
use App\Models\Content;
use App\Models\Thread;
use App\Models\Forumheading;
use App\Models\Forumcategory;
use App\Models\Threadcomment;
use App\Models\Newsarchive;
use App\Models\Tagoption;
use App\Models\Tag;
use App\Models\Achievementpoint;
use Illuminate\Support\Facades\Auth;
use App\Traits\Achievementpoints;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    use Achievementpoints;

    public $cache_time;
    public function __construct(){
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function contentSearch(Request $request){
        $theme = $this->themes('homepage','blue_theme');
        $search_key = $request->search;
        $search = '%'.$request->search.'%';

        if(Auth::check()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        // ============================ ONLINEUSER PAGE SEARCH ======================================
            $searchdata = array();
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

        // ============================ FORUM HEADING SEARCH ================================
            $forumheading = Forumheading::where('name','like',$search)->get();
            foreach($forumheading as $fh){
                $searchdata[] = array(
                    'title'     => $fh->name,
                    'pagename'  => 'Forum',
                    'pagelink'  => route('forum'),
                    'created_at'=> $fh->created_at
                );
            }
        // ============================ FORUM HEADING SEARCH ================================

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
            })->get();
            foreach($threads as $thread){
                $searchdata[] = array(
                    'title'     => $thread->topic,
                    'pagename'  => 'Thread Topic',
                    'pagelink'  => route('thread',[$thread->cid,1]),
                    'created_at'=> $thread->created_at
                );
            }
        // ============================ THREAD SEARCH =======================================

        // ============================ THREAD COMMENT SEARCH ===============================
            $threadcomment = Threadcomment::where(function ($query) use ($search){
                $query->where('comment','like',$search);
            })->get();
            foreach($threadcomment as $tc){
                $searchdata[] = array(
                    'title'     => strip_tags($tc->comment),
                    'pagename'  => 'Thread Details',
                    'pagelink'  => route('threaddetail',[$tc->threadid,1]),
                    'created_at'=> $tc->created_at
                );
            }
        // ============================ THREAD COMMENT SEARCH ===============================

        return view('front.homepage.content_search',compact('theme','font','searchdata', 'search_key'));
    }

    public function aboutus(){
        $aboutcontent = User::select('about')->where('id',Auth::user()->id)->get()->toArray();
        return view('front.user.about',compact('aboutcontent'));
    }

    public function home(){

        $theme = $this->themes('homepage');
        Cache::forget('advertisement'); // Deletes the cache entry
        Cache::forget('advertisement1'); // Deletes the cache entry
        Cache::forget('advertisement2'); // Deletes the cache entry
        Cache::forget('advertisement3'); // Deletes the cache entry
        Cache::forget('advertisement4'); // Deletes the cache entry

        $advertisement = Cache::remember('advertisement1', $this->cache_time, function () {
            return Advertisement::where('id', '1')->first();
        });
        $advertisement2 = Cache::remember('advertisement2', $this->cache_time, function () {
            return Advertisement::where('id', '1')->first();
        });
        $advertisement3 = Cache::remember('advertisement3', $this->cache_time, function () {
            return Advertisement::where('id', '1')->first();
        });
        $advertisement4 = Cache::remember('advertisement4', $this->cache_time, function () {
            return Advertisement::where('id', '1')->first();

        });
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }

        if (Auth::id()) {
            $user_antitag = Tagoption::where('user_id', Auth::id())->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
            } else {
                $usertagData = [];
            }
        } else {
            $user_antitag = $usertagData = null;
        }

        $Usercontent = Cache::remember('user_content_'. Auth::id(), $this->cache_time, function () use ($user_antitag, $usertagData) {
            $userContent = new Usercontent;
            if (Auth::id()) {
                if (!is_null($user_antitag) && count($usertagData) > 0) {
                    $userContent = $userContent->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $userContent = $userContent->limit(9)->get();

            return $userContent;
        });


        $featured_content = Cache::remember('featured_content_' . Auth::id(), $this->cache_time, function () use ($user_antitag, $usertagData) {
            $featuredContent = new Usercontent;
            if (Auth::id()) {
                if (!is_null($user_antitag) && count($usertagData) > 0) {
                    $featuredContent = $featuredContent->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $featuredContent = $featuredContent->where('is_featured', 1)->limit(5)->with(['user', 'gallerycomments', 'like'])->get();

            return $featuredContent;
        });

        $news = Cache::remember('news', $this->cache_time, function () {
            return Newsarchive::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        });

        $latest_thread = Cache::remember('latest_thread', $this->cache_time, function () {
            return Thread::where('thread_lock', 0)->orderBy('id', 'DESC')->limit(5)->get();
        });

        $latest_thread_comment = Cache::remember('latest_thread_comment', $this->cache_time, function () {
            return Threadcomment::orderBy('id', 'DESC')->limit(8)->get();
        });

        return view('front.homepage.home',compact('Usercontent','theme','advertisement','advertisement2','advertisement3','advertisement4','font','news','featured_content','latest_thread','latest_thread_comment'));
    }

    public function contentpromoted(){
        if(Auth::id()){
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
            $themes = ThemeOption::value('homepage_theme');
            $content = Content::orderBy('id','DESC')->with('sections')->get();
            return view('front.contentpromoted',compact('themes','font'));
        }else{
            return view('user-not-login');
        }
    }

    public function pm(){
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $font = Option::pluck('preffered_font')->first();
        $themes = ThemeOption::pluck('homepage_theme')->first();

        return view('front.user.pm',compact('advertisement','themes','font'));

    }
}
