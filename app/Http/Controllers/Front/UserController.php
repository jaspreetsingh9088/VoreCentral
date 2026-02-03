<?php

namespace App\Http\Controllers\Front;

use App\Http\Traits\CustomFileUpload;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, CartItem};
use App\Models\Profilepost;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Rules\ReCaptcha;
use App\Models\{Journal, Paidcontent};
use App\Models\Profilecomment;
use App\Models\Follow;
use App\Models\Advertisement;
use App\Models\Usercontent;
use App\Models\Option;
use App\Models\Dlccontents;
use App\Models\Activity;
use App\Models\ThemeOption;
use App\Models\NotificationPrivacyOption;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Searchsorting;
use App\Models\DownloadDlcFile;
use App\Models\Galleryfavorite;
use App\Models\Creatorcontent;
use App\Models\Point;
use App\Models\Owncollaction;
use App\Models\Tag;
use App\Models\Paidcontentrating;
use App\Models\Featuredcontent;
use File;
use App\Models\Likedlc;
use App\Models\Dislikedlc;
use App\Models\Usertag;
use App\Models\Tagoption;
use App\Models\Thread;
use App\Models\Gallerycomment;
use App\Models\Threadcomment;
use App\Models\Achievementpoint;
use App\Models\Paidcontentcomment;
use App\Models\{Paidcontentlike, Paidcontentdislike};
use DateTime;
use Redirect;
use DB;
use Illuminate\Support\Enumerable;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use App\Models\Cart;
use Intervention\Image\Facades\Image; // For webp conversion
class UserController extends Controller
{
    use Notification, Achievementpoints, CustomFileUpload;

    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function usernotlogin($segment)
    {
        return view('user-not-login', compact('segment'));
    }

    public function visitornotlogin ()
    {
        return view('visitor-not-login');
    }


    public function userinfo()
    {
        if (!Auth::check()) {
            $segment = 'Dashboard';
            return view('user-not-login', compact('segment'));
        }
        $myData = Auth::user()->toArray();

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $general_privacy = Option::value('general_privacy');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {

            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {

            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $ActivityData = Activity::where('userid', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        if (isset($ActivityData) && is_array($ActivityData) && count($ActivityData) > 0) {

            foreach ($ActivityData as $ActivityDataK => $ActivityDataV) {
                $ActivityData[$ActivityDataK]['username'] = $myData['username'];
                $ActivityData[$ActivityDataK]['profile_pic'] = $myData['profile_pic'];
            }
        }

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);
        $themes = 'blue_theme';

        return view('front.dashboard', compact('themes', 'myData', 'ActivityData', 'AllFollower', 'AllFollowing', 'font', 'general_privacy'));
    }

    public function aboutus()
    {
        $myData = Auth::user()->toArray();
        // $aboutcontent = User::select('about')->where('id', Auth::user()->id)->get()->toArray();
        $aboutcontent = $myData['about'];

        $themes = 'blue_theme';

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        return view('front.user.about', compact('aboutcontent', 'myData', 'AllFollower', 'AllFollowing', 'themes', 'font'));
    }

    public function updateabout(Request $request)
    {
        $this->validate($request, [
            'about' => 'required',
        ]);

        $User = User::find(Auth::user()->id);
        $User->about = $request->about;
        $User->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function rpstatus()
    {
        $myData = Auth::user()->toArray();
        $themes = ThemeOption::value('homepage_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);
        return view('front.user.rpstatus', compact('myData', 'themes', 'font', 'AllFollower', 'AllFollowing'));
    }

    public function updaterpstatus(Request $request)
    {
        $this->validate($request, [
            'rpstatus' => 'required',
        ]);

        $User = User::find(Auth::user()->id);
        $User->rpstatus = $request->rpstatus;
        $User->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function profilepost()
    {
        $user_id = Auth::user()->id;
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $myPostdata = Profilepost::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0) {
            foreach ($myPostdata as $myPostdataK => $myPostdataV) {
                $commentData = Comment::where('postid', $myPostdataV['id'])->get()->toArray();
                $likecount = Like::where('postid', $myPostdataV['id'])->count();
                if (isset($commentData) && is_array($commentData) && count($commentData) > 0) {
                    foreach ($commentData as $commentDataK => $commentDataV) {
                        $UserData = User::where('id', $commentDataV['userid'])->first();
                        if ($UserData) {
                            if ($UserData['creator'] == 1) {
                                $dashboard_link = route('creatorvisitordashboard', [$UserData['id']]);
                            } else {
                                $dashboard_link = route('profiledashboard', [$UserData['id']]);
                            }
                        } else {
                            $dashboard_link = 'javascript:;';
                        }
                        $commentData[$commentDataK]['dashboardlink'] = $dashboard_link;
                        $commentData[$commentDataK]['username'] = $UserData['username'];
                    }
                }
                $myPostdata[$myPostdataK]['commentdata'] = $commentData;
                $myPostdata[$myPostdataK]['likecount'] = $likecount;
            }
        }

        $myData = Auth::user()->toArray();
        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);
        $themes = 'blue_theme';
        return view('front.user.profilepost', compact('themes', 'myPostdata', 'myData', 'AllFollower', 'AllFollowing', 'font'));
    }

    public function addpost(Request $request)
    {
        $this->validate($request, ['post' => 'required']);

        $Profilepost = new Profilepost();
        $Profilepost->post = $request->post;
        $Profilepost->userid = Auth::user()->id;
        $Profilepost->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];

        $activity = new Activity();
        $activity->userid = Auth::user()->id;
        $activity->content = "You made a post on your profile.";
        $activity->save();
        return response()->json($response, 200);
    }

    public function journal()
    {
        $themes = ThemeOption::value('homepage_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $JournalData = Journal::where('userid', Auth::user()->id)->get()->toArray();

        $myData = Auth::user()->toArray();
        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        return view('front.user.journal', compact('JournalData', 'themes', 'myData', 'AllFollower', 'AllFollowing', 'font'));
    }

    public function addjournal(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $Journal = new Journal();
        $Journal->title = $request->title;
        $Journal->heading = $request->heading;
        $Journal->userid = Auth::user()->id;
        $Journal->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function info()
    {
        $themes = ThemeOption::value('homepage_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $is_visitor = true;
        $myData = Auth::user()->toArray();

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        $userdata = Auth::user();
        if ($userdata->role_preference == 'pred') {
            if (is_null($userdata->achievements) || $userdata->achievements == 'null') {
                $profile_rank = $this->achivements($userdata->role_preference, $Pointcount);
            } else {
                $rank = json_decode($userdata->achievements);
                $profile_rank = implode(',', $rank);
            }
        } else if ($userdata->role_preference == 'prey') {
            if (is_null($userdata->prey_achievements) || $userdata->prey_achievements == 'null') {
                $profile_rank = $this->achivements($userdata->role_preference, $Pointcount);
            } else {
                $rank = json_decode($userdata->prey_achievements);
                $profile_rank = implode(',', $rank);
            }
        } else {
            $profile_rank = $userdata->achievements;
        }

        $usercontentcount = Usercontent::where('userid', Auth::id())->count();
        $dlccontentcount = Dlccontents::where('userid', Auth::id())->count();
        $paidcontentcount = Paidcontent::where('user_id', Auth::id())->count();
        $useruploadcount = $usercontentcount + $dlccontentcount + $paidcontentcount;

        $threadcount = Thread::where('userid', Auth::id())->count();

        $gallerycommentcount = Gallerycomment::where('userid', Auth::id())->count();
        $profilecommentcount = Profilecomment::where('uid', Auth::id())->count();
        $threadcommentcount = Threadcomment::where('userid', Auth::id())->count();
        $numberofcomment = $gallerycommentcount + $profilecommentcount + $threadcommentcount;


        $datetime1 = new DateTime($userdata->created_at);
        $datetime2 = new DateTime(today());
        $interval = $datetime1->diff($datetime2);
        $hasbeenmember = $interval->format('%a');
        if ($userdata->creator == 1) {
            $profile_type = 'Creator';
        } else {
            $profile_type = 'User';
        }
        $userinfo = array(
            'profile_rank' => $profile_rank,
            'profile_type' => $profile_type,
            'upload_count' => $useruploadcount,
            'thread_count' => $threadcount,
            'total_comment' => $numberofcomment,
            'hasbeenmember' => $hasbeenmember,
            'gender' => $userdata->gender
        );
        return view('front.user.info', compact('userinfo', 'myData', 'is_visitor', 'AllFollower', 'AllFollowing', 'themes', 'font'));
    }

    public function userupload()
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $commentCount=Comment::where('userid',Auth::id())->count();
        $likeCount=Like::where('userid',Auth::id())->count();
        $threadCount=Thread::where('userid',Auth::id())->count();
        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();
        $TagData = Tag::get()->toArray();
        $theme = $this->themes('homepage', 'blue_theme');
        if($commentCount>=5 || $likeCount>=5 || $threadCount>=5){
            return view('front.user.userupload', compact('theme', 'Owncollaction', 'TagData', 'font'));
        }
        else{
            return view('front.user.uploadmessage', compact('theme', 'Owncollaction', 'TagData', 'font'));
        }
    }

    // Content File Upload in Chunks
    public function uploadContentFile(Request $request)
    {
        // Log::debug('request file: ' . print_r($request->all(), true));

        $filename = time() . '_' . $request->name;

        Plupload::receive('file', function ($file) use($filename) {
            $file->move(public_path('content'), $filename);
        });

        return response()->json(['filename' => $filename]);
    }

    // Thumbnail Upload in Chunks
    public function uploadThumbnailFile(Request $request)
    {
        Plupload::receive('file', function ($file) use (&$storedFilename, $request) {

        $start = (int)trim($request->input('start'));
        $end = (int)trim($request->input('end'));
            $mime = $file->getMimeType();
            if (str_starts_with($mime, 'image/')) {
                $storedFilename = uniqid(Str::random(12)) . '.webp';
                $image = Image::make($file)->encode('webp', 90);
                $image->save(public_path('thumbnail/' . $storedFilename));
            } elseif (str_starts_with($mime, 'video/')) {
                if (!preg_match('/^\d{1,2}(:\d{2}){0,2}$/', $start)) {
                    Log::error("Invalid start time format: $start");
                    return response()->json(['error' => 'Invalid start time format.'], 400);
                }
                if (!is_numeric($end)) {
                    Log::error("Invalid end time: $end");
                    return response()->json(['error' => 'Invalid end time.'], 400);
                }
                $extension = $file->getClientOriginalExtension();
                $originalFilename = uniqid('original_') . '.' . $extension;
                $originalPath = public_path('thumbnail/' . $originalFilename);
                $file->move(public_path('thumbnail'), $originalFilename);
                $duration = max(1, (int)$end - (int)$start);
                $storedFilename = uniqid(Str::random(12)) . '.' . $extension;
                $trimmedPath = public_path('thumbnail/' . $storedFilename);
                $cmd = sprintf(
                    'ffmpeg -ss %s -i %s -t %s -c copy %s 2>&1',
                    escapeshellarg($start),
                    escapeshellarg($originalPath),
                    escapeshellarg($duration),
                    escapeshellarg($trimmedPath)
                );
                exec($cmd, $output, $returnCode);

                if ($returnCode !== 0 || !File::exists($trimmedPath)) {
                    $storedFilename = $originalFilename;
                } else {
                    File::delete($originalPath);
                    rename($trimmedPath, $originalPath);
                    $storedFilename = $originalFilename;
                }
            } else {
                abort(400, 'Unsupported file type.');
            }
        });
        return response()->json(['filename' => $storedFilename]);
    }

    public function getYouTubeVideoId($url) {
        $parts = parse_url($url);
        if (isset($parts['host']) && $parts['host'] === 'youtu.be') {
            return ltrim($parts['path'], '/');
        }
        if (isset($parts['host']) && strpos($parts['host'], 'youtube.com') !== false) {
            parse_str($parts['query'], $query);
            return $query['v'] ?? null;
        }
        return null;
    }

    function getViewKey($url) {
        $parts = parse_url($url);
        parse_str($parts['query'] ?? '', $query);
        return $query['viewkey'] ?? null;
    }

    function getDeviantArtEmbedCode($url) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $iframe = '<iframe src="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" width="100%" height="500" frameborder="0" allowfullscreen></iframe>';
            return $iframe;
        } else {
            return false;
        }
    }
    public function uploadcontent(Request $request)
    {
        // ini_set('memory_limit', -1);
        // ini_set('post_max_size', '1025M');
        // ini_set('upload_max_filesize', '1G');
        // ini_set('max_execution_time', 14400); // 4 hrs
        // ini_set('max_input_time', 1800); // 30 min

        $validationRules = [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'type' => 'required',
            'category' => 'required',
            // 'content' => 'file|mimes:jpeg,jfif,png,jpg,gif,svg,mp4,mkv,flv,avi,mp3,wav,pdf,txt',
            // 'content' => 'file|mimes:jpeg,jfif,png,jpg,gif,svg,mp4,mkv,flv,avi,mp3,wav,pdf,txt,docx,doc,rtf,odt|max:1000000', // Max 1 GB
            //'monetise' => 'required',
            // 'thumbnail' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:1000000', // Max 1 GB
            'content_type' => 'required',
        ];

        $validationMessages = [];
        // if (env('APP_ENV') == 'production') {
        //     $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
        //     $validationMessages = [ 'g-recaptcha-response.required' => 'The recaptcha field is required.'];
        // }

        $validatedData = $request->validate($validationRules, $validationMessages);

        try {
            // Tag Create
            $tag_array = [];
            foreach($request->tags as $tag) {

                if(!is_numeric($tag)) {
                    $tag_id = Tag::insertGetId([
                        'title' => $tag,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    array_push($tag_array, $tag_id);
                } else {
                    array_push($tag_array, $tag);
                }
            }

            // $this->Tagmatch($request->tags,44);
            $Usercontent = new Usercontent();
            $Usercontent->title = $request->title;
            $Usercontent->userid = Auth::user()->id;
            $Usercontent->description = $request->description;
            // $Usercontent->tags = implode(",", $request->tags);
            $Usercontent->tags = implode(",", $tag_array);
            $Usercontent->content_type = $request->content_type;
            if ($request->series) {
                $Usercontent->series = implode(",", $request->series);
            }
            $Usercontent->type = implode(",", $request->type);
            $Usercontent->category = implode(",", $request->category);


            if ($request->video_url) {

                $url = $request->video_url;
                $Usercontent->original_video_url = $request->video_url;;

                if(strstr($url,"youtu.be") || strstr($url,"youtube")){
                    $video_id = $this->getYouTubeVideoId($url);
                    if(isset($video_id)){
                        $embed_url = "https://www.youtube.com/embed/" . $video_id;
                        $Usercontent->video_url = $embed_url;
                    }

                }elseif(strstr($url,"pornhub")){
                    $video_id = $this->getViewKey($url);
                    if(isset($video_id)){
                        $embed_url = "https://www.pornhub.com/embed/" . $video_id;
                        $Usercontent->video_url = $embed_url;
                    }

                }elseif(strstr($url,"xvideos")){
                    if (strpos($url, "embedframe") !== false) {
                        $video_id = substr($url,strrpos($url,"/")+1);
                    } else {
                        $parts = explode('video.', $url);
                        $video_id="default";
                        if (isset($parts[1])) {
                            $subparts = explode('/', $parts[1]);
                            $video_id = $subparts[0];
                        }
                    }
                    if(isset($video_id)){
                        $embed_url = "https://www.xvideos.com/embedframe/" . $video_id;
                        $Usercontent->video_url = $embed_url;
                    }

                }elseif(strstr($url,"deviantart")){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    $htmlContent = curl_exec($ch);

                    if ($htmlContent === false) {
                        $error = curl_error($ch);
                    } else{
                        $pattern = '<video.*?src=[\'"](.*?)[\'"].*?>';
                        preg_match_all($pattern, $htmlContent, $matches);
                        $embed_url =  $matches[1][0];
                        $Usercontent->video_url = $embed_url;

                    } 

                }

            }

            $Usercontent->monetise = $request->monetise;

            // if ($request->file('content')) {
            //     $file = $request->file('content');
            //     $filename = time() . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('content'), $filename);
            //     $Usercontent->content = $filename;
            // }

            // if ($request->file('thumbnail')) {
            //     $Usercontent->thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'thumbnail');
            // }

            $Usercontent->content = $request->content_file_name;
            $type=implode(",",$request->type);
            if(isset($request->thumbnail_file_name)){
                $Usercontent->thumbnail = $request->thumbnail_file_name;
            }
            else if( $type=="Picture"){
            $Usercontent->thumbnail = $request->content_file_name;
            }
            elseif($type=="Audio" || $type=="Literature" || $type=="Comic" || $type=="Interactive"){
                $Usercontent->thumbnail = "default-image.jpg";
            }
            else{
                $Usercontent->thumbnail = $request->thumbnail_file_name;
            }
            $Usercontent->save();

            $allfollower = Follow::where('follow_to', Auth::id())->get();
            $allfollowing = Follow::where('follow_by', Auth::id())->get();
            $follower = array();
            foreach ($allfollower as $af) {
                $follower[] = $af->follow_by;
            }
            foreach ($allfollowing as $af) {
                $follower[] = $af->follow_to;
            }
            $follower = array_unique($follower);
            $notification_subscription = NotificationPrivacyOption::whereIn('user_id', $follower)->pluck('subscription', 'user_id');
            foreach ($notification_subscription as $key => $ns) {
                $notification = json_decode($ns);
                if (isset($notification) && in_array('subscribe_uploads', $notification)) {
                    $this->NotificationInsert(
                        Auth::id(),             // sender id
                        $key,                   // recover id
                        $Usercontent->id,       // content id
                        'Subscription upload',  // notification type
                        Auth::user()->username . ' upload content in gallery section.',
                        'subscription',         // notification type
                        0,                      // status [0 = unread, 1 = read]
                    );
                }
            }

            $activity = new Activity();
            $activity->userid = Auth::user()->id;
            $activity->content = "You have posted in the gallery.";
            $activity->save();
            if (Auth::id()) {
                $this->PointInsert($Usercontent->id, 'gallery content upload', 10, 1);
            }
            $this->addpoint(Auth::user()->id, 10, "Added for post comment");


            // Removing Gallery Items From The Cache
            Cache::forget('publicgallery_relevancy_' . Auth::id());
            Cache::forget('publicgallery_recency_' . Auth::id());
            Cache::forget('publicgallery_popularity_' . Auth::id());
            Cache::forget('publicgallery_tags_' . Auth::id());
            Cache::forget('publicgallery_featured_' . Auth::id());
            Cache::forget('publicgallery_random');
            Cache::forget('user_content_' . Auth::id());
            Cache::forget('featured_content_' . Auth::id());


            //return back()->with(['successful_message' => 'Content updated successfully']);
            return json_encode(array('result'=>'success','msg'=>'Content updated successfully'));

        } catch (\Exception $e) {
            return json_encode(array('result' => 'error', 'error_msg' => $e->getMessage()));
        }
    }

    public function gallery($sort)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $UsercontentQuery = Usercontent::where('usercontents.userid', Auth::user()->id);
        if (Auth::id()) {
            $user_antitag = Tagoption::where('user_id', Auth::id())->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if($user_antitag!=null){
                $usertagData = Tag::whereIn('id', $user_antitag)->get();

                $UsercontentQuery = $UsercontentQuery->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
        }

        if (isset($sort) && $sort === 'new') {
            $UsercontentData = $UsercontentQuery->latest()->paginate(20);
        } else if (isset($sort) && $sort === 'old') {
            $UsercontentData = $UsercontentQuery->oldest()->paginate(20);
        } else if (isset($sort) && $sort === 'random') {
            $UsercontentData = $UsercontentQuery->inRandomOrder()->paginate(20);
        } else if (isset($sort) && $sort === 'view') {
            $UsercontentData = $UsercontentQuery->OrderBy('total_views', 'desc')->paginate(20);
        } else if (isset($sort) && $sort === 'fav') {
            $UsercontentQuery->withCount('like');
            $UsercontentQuery->orderByDesc('like_count');
            $UsercontentData = $UsercontentQuery->paginate(20);
        } else {
            $UsercontentData = $UsercontentQuery->paginate(20);
        }


        $myData = Auth::user()->toArray();

        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        return view('front.creator.gallery', compact('UsercontentData', 'myData', 'AllFollower', 'AllFollowing', 'font', 'advertisement'));
    }

    public function publicgallery()
    {
        $theme="";
        if (Auth::id()) {
            $userId = Auth::user()->id;
            $theme = ThemeOption::whereUserId($userId)->pluck('gallery_theme')->first();
        }

        $UsercontentData = Cache::remember('publicgallery_relevancy_' . Auth::id(), $this->cache_time, function () {
            $UsercontentData = Usercontent::with('user:id,username,creator,profile_pic')
                    ->whereHas('user', function ($query) {
                        $query->where('creator', 1);
                    });
            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->value('antitag');
                $user_antitag = json_decode($user_antitag);
                if (!is_null($user_antitag)) {
                    $usertagData = Tag::whereIn('id', $user_antitag)->get();
                    $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $UsercontentData = $UsercontentData->get();

            return $UsercontentData;
        });

        if (isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['relevancy', 'desc']])->toArray();
        } else {
            $UsercontentData = $UsercontentData->toArray();
        }

        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (Auth::id()) {
            $this->PointInsert(0, 'gallery relevancy', 0.01, 1);
        }
        return view('front.user.gallery', compact('font', 'UsercontentData', 'theme', 'advertisement'));
    }

    public function favoriteartwork()
    {
        $themes = ThemeOption::value('homepage_theme');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $UsercontentData = array();
        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                if (isset($UserData[0])) {
                    $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                    $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
                } else {
                    $AllFollower[$AllFollowerK]['username'] = '';
                    $AllFollower[$AllFollowerK]['profile_pic'] = '';
                }
            }
        }

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }
        $Galleryfavorite = Galleryfavorite::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($Galleryfavorite) && is_array($Galleryfavorite) && count($Galleryfavorite) > 0) {
            $Galleryfavorite = array_column($Galleryfavorite, 'contentid');
            $UsercontentData = Usercontent::whereIn('id', $Galleryfavorite)->get()->toArray();
        }

        $myData = Auth::user()->toArray();
        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        return view('front.user.favoriteartwork', compact('UsercontentData', 'myData', 'AllFollower', 'AllFollowing', 'themes', 'font'));
    }

    public function subscription($pageno)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $offset = ($pageno - 1) * 2;
        $Usercontentdatacount = 0;

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        $UsercontentData = array();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            $followarray = array_values(array_unique(array_column($AllFollowing, 'follow_to')));
            $UsercontentData = Usercontent::with('user')->whereIn('userid', $followarray)->offset($offset)->limit(20)->orderBy('id', 'desc')->get();
            $Usercontentdatacount = Usercontent::whereIn('userid', $followarray)->count();
        }

        $theme = $this->themes('others_theme', 'red_theme');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        return view('front.other_page.subscription', compact('theme', 'UsercontentData', 'pageno', 'Usercontentdatacount', 'font','advertisement'));
    }

    public function projectCat(Request $request)
    {
        // $limit = $request->page * 10;
        // $fetchData = Proudct::where('hr_id', Auth::id())->where('status', 1);
        // if (isset($request->searchTerm)) {
        //     $search = $request->searchTerm;
        //     $fetchData = $fetchData->where('email', 'like', $search . '%');
        // }
        // $fetchData = $fetchData
        //     ->offset($limit - 10)
        //     ->limit($limit)
        //     ->get();
        // $data = [];
        // foreach ($fetchData as $row) {
        //     $data[] = ['id' => $row->id, 'text' => $row->email];
        // }

        //dd($request->all());
        // <option value="Literature">Literature </option>
        // <option value="Picture">Picture </option>
        // <option value="Comic">Comic </option>
        // <option value="Video">Video </option>
        // <option value="Audio">Audio </option>
        // <option value="Interactive">Interactive </option>
        if ($request->type_id == 'Literature') {
            $data = [
                ["id" => "Short story", "text" => "Short story"],
                ["id" => "Chapter", "text" => "Chapter"],
                ["id" => "Nonfiction", "text" => "nonfiction"],
                ["id" => "Other", "text" => "Other"]];
        } elseif ($request->type_id == 'Picture') {
            $data = [
                ["id" => "Traditional art", "text" => "Traditional art"],
                ["id" => "3D art", "text" => "3D art"],
                ["id" => "Photography", "text" => "Photography"],
                ["id" => "Photomanlp", "text" => "Photomanlp"],
                ["id" => "Digital art", "text" => "Digital art"],
                ["id" => "visual update", "text" => "visual update"],
            ];
        } elseif ($request->type_id == 'Comic') {
            $data = [
                ["id" => "Traditional art", "text" => "Traditional art"],
                ["id" => "Digital art", "text" => "Digital art"],
                ["id" => "3D art", "text" => "3D art"],
                ["id" => "Photography", "text" => "Photography"],
                ["id" => "Photornanip", "text" => "Photornanip"],
            ];
        } elseif ($request->type_id == 'Video') {
            $data = [
                ["id" => "Animated", "text" => "Animated"],
                ["id" => "Live Action", "text" => "Live Action"],
                ["id" => "viog", "text" => "viog"],
            ];
        } elseif ($request->type_id == 'Audio') {
            $data = [
                ["id" => "Songs", "text" => "Songs"],
                ["id" => "Various soundeffectbased content", "text" => "Various soundeffectbased content"],
                ["id" => "Spoken creations", "text" => "Spoken creations"],
                ["id" => "Spoken creations", "text" => "Spoken creations"],
                ["id" => "lmmersive Fiction", "text" => "lmmersive Fiction"],
            ];
        } elseif ($request->type_id == 'Interactive') {
            $data = [
                ["id" => "Short interacvite experiences", "text" => "Short interacvite experiences"],
                ["id" => "Visual novels", "text" => "Visual novels"],
                ["id" => "Advanced Games", "text" => "Advanced Games"],
            ];
        }
        return json_encode($data);
    }

    public function gallerySerach(Request $request)
    {
        if (isset($request->filter) && !is_null($request->filter)) {
            $filter_type = $request->filter;
        } else {
            $filter_type = '';
        }
        if(isset($request->user_id)){
            $user_id=$request->user_id;
        }
        else{
            $user_id=Auth::id();
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
            $UsercontentData = $UsercontentData->where('type',$filter_type);
        }
        if(isset($request->user_id)){
            $UsercontentData= $UsercontentData->where('userid',$user_id);
        }
        // Antitag setting
        if ($user_id) {
            $user_antitag = Tagoption::where('user_id', $user_id)->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
        }

        // Gallery vore and non-vore setting
        if ($user_id) {
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

        if (isset($request->order) && !is_null($request->order) && $request->order == 'recency') {
            $UsercontentData = $UsercontentData
                ->where('created_at', '>=', Carbon::yesterday())
                ->where('created_at', '<', Carbon::today())
                ->orderByRaw("tags DESC, created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else
                if (isset($request->order) && !is_null($request->order) && $request->order == 'prioritisePopularity') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritise', 'desc']]);
        } else
                if (isset($request->order) && !is_null($request->order) && $request->order == 'prioritiseTags') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['prioritisetags', 'desc']]);
        } else
                if (isset($request->order) && !is_null($request->order) && $request->order == 'latest') {

            $UsercontentData = $UsercontentData
                ->orderByRaw("created_at DESC")
                ->get();

            $data = $UsercontentData;
        } else if (isset($request->order) && !is_null($request->order) && $request->order == 'relevancy') {
            $UsercontentData = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
            $data = $UsercontentData;
            $data = $data->sortBy([['relevancy', 'desc']]);
        } else if (isset($request->order) && !is_null($request->order) && $request->order == 'featured') {
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
        return view('front.filter_search', compact('filter_type', 'type_tag_category', 'contenttitle', 'search', 'data', 'type', 'paginator', 'title', 'themes', 'font', 'advertisement'));
    }

    public function gallerySerachAjax(Request $request)
    {
        $search = '%' . $request->search . '%';
        $filter = $request->filter;
        $type = 'all';

        $tagData = Tag::where('title', 'like', $search)->get(['id']);
        $UsercontentData = new Usercontent;


        // Antitag setting
        if (Auth::id()) {
            $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
        }

        // Gallery vore and non-vore setting
        if (Auth::id()) {
            $searchsetting = Searchsorting::where('user_id', Auth::id())->first();
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

            $import_search = explode(' ', $search);
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

        $type = ucfirst($filter);
        $cat = ucfirst($filter);
        $types = ['Video', 'Picture', 'Literature', 'Comic', 'Audio', 'Game', 'Interactive'];
        $category = ['3D art', 'Photography', 'Animated', 'Live Action', 'Traditional art'];
        if (in_array($type, $types)) {
            $UsercontentData = $UsercontentData->whereIN('type', [$type]);
        }

        if (in_array($cat, $category)) {
            $UsercontentData = $UsercontentData->whereIN('category', [$cat]);
        }


        // Gallery priortise recency setting
        if ($filter != 'prioritisePopularity' && $filter != 'prioritiseTags' && $filter != 'relevancy') {
            if (Auth::id()) {
                if (isset($searchsetting->gallery_search) && $searchsetting->gallery_search == 'priortise_recency') {
                    $UsercontentData = $UsercontentData->where('created_at', '>=', Carbon::yesterday())
                        ->where('created_at', '<', Carbon::today())->orderBy('tags', 'DESC');
                }
            }
        }

        $data = $UsercontentData->with('user')->orderByRaw("IF(title = '{$search}',2,IF(title LIKE '{$search}',1,0)) DESC")->get();
       // gallery priortise tag setting
        if ($filter != 'prioritisePopularity' && $filter != 'prioritiseTags' && $filter != 'relevancy') {
            if (Auth::id()) {
                if (isset($searchsetting->gallery_search) && $searchsetting->gallery_search == 'priortise_my_tag') {
                    $data = $data->sortBy([['prioritisetags', 'desc']]);
                } else if (isset($searchsetting->gallery_search) && $searchsetting->gallery_search == 'priortise_popularity') {
                    $data = $data->sortBy([['prioritise', 'desc']]);
                }
            }
        }
        if ($filter == 'prioritisePopularity') {
            $data = $data->sortBy([['prioritise', 'desc']]);
        } else if ($filter == 'prioritiseTags') {
            $data = $data->sortBy([['prioritisetags', 'desc']]);
        } else if ($filter == 'relevancy') {
            $data = $data->sortBy([['relevancy', 'desc']]);
        }

        $view = (string)view('front.filter_search_ajax', compact('data'));
        $output = array('status' => 200, 'message' => 'content view', 'content' => $view);
        echo json_encode($output);
    }

    public function recency()
    {
        if (Auth::id()) {
            $user_id = Auth::id();
            $font = Option::where('user_id', Auth::id())->value('preffered_font');

            $user_antitag = Tagoption::where('user_id', Auth::id())->value('antitag');
            $user_antitag = json_decode($user_antitag);
            if (!is_null($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
            } else {
                $usertagData = [];
            }
        } else {
            $font = Option::where('user_id', 0)->value('preffered_font');
            $user_id = 0;
            $user_antitag = null;
            $usertagData = [];
        }
        //$items = new Usercontent;
        $items = Cache::remember('publicgallery_recency_' . Auth::id(), $this->cache_time, function () use ($user_antitag, $usertagData) {
            $items = Usercontent::with('user:id,username,creator,profile_pic')
                        ->whereHas('user', function ($query) {
                            $query->where('creator', 1);
                        });

            if (Auth::id()) {
                if (!is_null($user_antitag)) {
                    $items = $items->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $items = $items->where('created_at', '>=', Carbon::today())->take(5)->get();

            return $items;
        });

        if ($items->count() < 5) {
            $remaining_items = Usercontent::with('user:id,username,creator,profile_pic');
            if (Auth::id()) {
                if (!is_null($user_antitag)) {
                    $remaining_items = $remaining_items->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $remaining_items = $remaining_items->where('created_at', '>=', Carbon::yesterday())
                ->where('created_at', '<', Carbon::today())
                ->orderBy('tags', 'desc')
                ->take(5 - $items->count())->get();
            $items = $items->concat($remaining_items);
        }
        $UsercontentData = $items->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (Auth::id()) {
            $this->PointInsert(0, 'gallery recency', 0.01, 1);
        }
        $theme = $this->themes('gallery_theme');
        return view('front.user.gallery', compact('UsercontentData', 'theme', 'font', 'advertisement'));
    }

    public function prioritisePopularity()
    {

        if (Auth::id()) {
            $user_id = Auth::id();
        } else {
            $user_id = 0;
        }

        $font = Option::where('user_id', $user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        //$UsercontentData = new Usercontent;

        $UsercontentData = Cache::remember('publicgallery_popularity_' . Auth::id(), $this->cache_time, function () {
            $UsercontentData = Usercontent::with('user:id,username,creator,profile_pic')
                                            ->whereHas('user', function ($query) {
                                                        $query->where('creator', 1);
                                                    });

            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
                $user_antitag = json_decode($user_antitag);
                if (!is_null($user_antitag)) {
                    $usertagData = Tag::whereIn('id', $user_antitag)->get();
                    $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $UsercontentData = $UsercontentData->get();

            return $UsercontentData;
        });

        if (isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['prioritise', 'desc']])->toArray();
        } else {
            $UsercontentData = $UsercontentData->toArray();
        }

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (Auth::id()) {
            $this->PointInsert(0, 'gallery random', 0.01, 1);
        }
        return view('front.user.gallery', compact('UsercontentData', 'advertisement', 'theme', 'font'));
    }

    public function prioritiseTags()
    {
        $UsercontentData = Cache::remember('publicgallery_tags_' . Auth::id(), $this->cache_time, function () {
            $UsercontentData = Usercontent::with('user:id,username,creator,profile_pic')
                                            ->whereHas('user', function ($query) {
                                                        $query->where('creator', 1);
                                                    });
            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
                $user_antitag = json_decode($user_antitag);
                if (!is_null($user_antitag)) {
                    $usertagData = Tag::whereIn('id', $user_antitag)->get();
                    $UsercontentData = $UsercontentData->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $UsercontentData = $UsercontentData->get();

            return $UsercontentData;
        });

        if (isset(Auth::user()->id)) {
            $UsercontentData = $UsercontentData->sortBy([['prioritisetags', 'desc']])->toArray();
        } else {
            $UsercontentData = $UsercontentData->toArray();
        }

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (Auth::id()) {
            $user_id = Auth::id();
        } else {
            $user_id = 0;
        }

        $font = Option::where('user_id', $user_id)->value('preffered_font');
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');
        if (Auth::id()) {
            $this->PointInsert(0, 'gallery prioritise tags', 0.01, 1);
        }
        return view('front.user.gallery', compact('UsercontentData', 'advertisement', 'theme', 'font'));
    }

    public function getFilterData(Request $request, $sort)
    {
        // $themes = ThemeOption::pluck('homepage_theme')->first();
        $themes = $this->themes('gallery_theme');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        // $reqUrl = $request->segment(count($request->segments()), 0);
        $segment = $request->segments();
        $reqUrl = $request->segments();
        $reqUrl = $reqUrl[1];
        $filter = $segment[2];
        // dd($sort,$filter);
        // dd($request->segments());

        $title = "filter";
        // $str = substr($reqUrl, 0, -1);
        $str = $reqUrl;
        $type = ucfirst($str);
        if ($type == 'Pictures') {
            $type = 'Picture';
        }
        if ($type == 'Comics') {
            $type = 'Comic';
        }
        if ($type == 'Videos') {
            $type = 'Video';
        }
        if ($type == 'Games') {
            $type = 'Game';
        }
        if ($type == 'Literatures') {
            $type = 'Literature';
        }
        if($type=='All'){
            $type='All';
        }

        $types = ['Video', 'Picture', 'Literature', 'Comic', 'Audio', 'Game','All'];
        if (in_array($type, $types)) {
            // $data = Usercontent::where('type', $type)->orderBy('id','desc')->paginate(20);
            // $data = Usercontent::where('type', $type)->latest()->paginate(20);
            if ($type == 'Literature') {
                $pagename = 'gallery literatures ';
            } else if ($type == 'Picture') {
                $pagename = 'gallery pictures ';
            } else if ($type == 'Video') {
                $pagename = 'gallery videos ';
            } else if ($type == 'Comic') {
                $pagename = 'gallery comics ';
            } else if ($type == 'Audio') {
                $pagename = 'gallery audio ';
            } else if ($type == 'Game') {
                $pagename = 'gallery games ';
            }
            else if ($type == 'All') {
                $pagename = 'all';
            }
            $data = new Usercontent;
            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
                $user_antitag = json_decode($user_antitag);
                if (!is_null($user_antitag)) {
                    $usertagData = Tag::whereIn('id', $user_antitag)->get();
                    $data = $data->where(function ($query) use ($usertagData) {
                        foreach ($usertagData as $tag) {
                            $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            if($type!="All"){

            $data = $data->where('type', $type);
            }

            if ($filter == 'latest') {
                $data = $data->orderBy('created_at', 'DESC');
                $pagename .= 'latest';
            } else if ($filter == 'featured') {
                $featuredcontent = Featuredcontent::select('id')->get();
                $data = $data->whereIn('id', $featuredcontent);
                $pagename .= 'featured';
            } else if ($filter == 'recency') {
                $data = $data->where('created_at', '>=', Carbon::yesterday())
                    ->where('created_at', '<', Carbon::today())->orderBy('tags', 'DESC');
                $pagename .= 'recency';
            } else if ($filter == 'random') {
                $data = $data->inRandomOrder();
                $pagename .= 'random';
            }

            // dd($filter,$sort,$pagename);
            $data = $data->paginate(20);
            if ($filter == 'prioritisePopularity') {
                $data = $data->sortBy([['prioritise', 'desc']]);
                $pagename .= 'prioritise popularity';
            } else if ($filter == 'prioritiseTags') {
                $data = $data->sortBy([['prioritisetags', 'desc']]);
                $pagename .= 'prioritise tags';
            } else if ($filter == 'relevancy') {
                $data = $data->sortBy([['relevancy', 'desc']]);
                $pagename .= 'relevancy';
            }
        } else {
            $data = new Usercontent;
            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
                $user_antitag = json_decode($user_antitag);
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $data = $data->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET($tag->id, tags)");
                    }
                });
            }
            if($type!="All"){
              $data = $data->where('type', $type);
            }
            $data = $data->paginate(20);
        }
        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        if (Auth::id()) {
            if (isset($_GET['page'])) {
                $pageno = $_GET['page'];
            } else {
                $pageno = 1;
            }
            $this->PointInsert(0, $pagename, 0.01, $pageno);
        }
        $theme = $this->themes('gallery_theme');
        return view('front.filter', compact('theme', 'filter', 'sort', 'data', 'title', 'type', 'advertisement', 'themes', 'font'));
    }

    public function featured()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }
        $theme = ThemeOption::whereUserId($user_id)->value('gallery_theme');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        // Retrieve all Usercontent items
        //$allItems = new Usercontent;
        $UsercontentData = Cache::remember('publicgallery_featured_' . Auth::id(), $this->cache_time, function () {

            $allItems = Usercontent::with('user:id,username,creator,profile_pic')
                ->select('id', 'userid', 'thumbnail', 'title', 'created_at')
                ->whereHas('user', function ($query) {
                    $query->where('creator', 1);
                });

            if (Auth::id()) {
                $user_antitag = Tagoption::where('user_id', Auth::id())->value('antitag');
                $user_antitag = json_decode($user_antitag);
                if (!is_null($user_antitag)) {
                    $tagData = Tag::whereIn('id', $user_antitag)->get();
                    $allItems = $allItems->where(function ($query) use ($tagData) {
                        foreach ($tagData as $tag) {
                            $query->WhereRaw("NOT FIND_IN_SET($tag->id, tags)");
                        }
                    });
                }
            }
            $allItems = $allItems->where('status', 1)->get();


            // Sort by relevancy and take the top 42
            $mostRelevantItems = $allItems->sortByDesc('relevancy')->take(42);

            // Remove most relevant items from the all items collection
            $remainingItems = $allItems->diff($mostRelevantItems);

            // Sort by thirteen and take the top 13
            $topThirteenItems = $remainingItems->sortByDesc('thirteen')->take(13);

            // Remove top thirteen items from the remaining items collection
            $remainingItems = $remainingItems->diff($topThirteenItems);

            //Sort by day and take the top 14
            $topFourteenItems = $remainingItems->sortByDesc('day')->take(14);

            // Remove top fourteen items from the remaining items collection
            $remainingItems = $remainingItems->diff($topFourteenItems);

            // Get the 5 most recent items from the remainingItems collection
            $mostRecentItems = $remainingItems->where('created_at', '>=', Carbon::today())->take(5);

            // If there are less than 5 recent items, fill the rest with items from the previous day
            if ($mostRecentItems->count() < 5) {
                $remaining_items = $remainingItems->where('created_at', '>=', Carbon::yesterday())
                    ->where('created_at', '<', Carbon::today())
                    ->sortByDesc('tags')
                    ->take(5 - $mostRecentItems->count());
                $mostRecentItems = $mostRecentItems->concat($remaining_items);
            }
            // Remove most recent items from the remaining items collection
            $remainingItems = $remainingItems->diff($mostRecentItems);

            // Sort by prioritiseTags and take the top 5
            $topPrioritisedTagsItems = $remainingItems->sortByDesc('prioritisetags')->take(5);

            // Remove top prioritised tags items from the remaining items collection
            $remainingItems = $remainingItems->diff($topPrioritisedTagsItems);

            // Sort by prioritisePopularity and take the top 5
            $topPrioritisedPopularityItems = $remainingItems->sortByDesc('prioritise')->take(5);

            // Remove top prioritised popularity items from the remaining items collection
            $remainingItems = $remainingItems->diff($topPrioritisedPopularityItems);

            // Merge all subcollections into a single array
            $UsercontentData = array_merge(
                $mostRelevantItems->toArray(),
                $topFourteenItems->toArray(),
                $topThirteenItems->toArray(),
                $mostRecentItems->toArray(),
                $topPrioritisedTagsItems->toArray(),
                $topPrioritisedPopularityItems->toArray()
            );

            return $UsercontentData;
        });

        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $font = Option::where('user_id', 0)->value('preffered_font');
        }
        if (Auth::id()) {
            $this->PointInsert(0, 'gallery featured', 0.01, 1);
        }
        return view('front.user.gallery', compact('UsercontentData', 'theme', 'font', 'advertisement'));
    }

    public function publicstore(Request $request)
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $option = Option::where('user_id', $user_id)->pluck('webstore_level')->first();
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $user_id = 0;
            $option = Option::where('user_id', 0)->pluck('webstore_level')->first();
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $themes = ThemeOption::value('homepage_theme');
        $cart_id = Session::get('cart_id');
        $cartItems = CartItem::with('paidcontent')->where('cart_id', $cart_id)->get();
        $total = CartItem::where('cart_id', $cart_id)->sum('price');

        $reqUrl = $request->segment(count($request->segments()), 0);
        $data = Paidcontent::join('users', 'paidcontents.user_id', '=', 'users.id')
            ->select('paidcontents.*', 'users.username', 'users.profile_pic', 'users.role_preference')
            ->when($reqUrl == 'new', function ($query) {
                return $query->latest();
            })->with(['user'])->get();
        $webstore_search = '';
        if ($option == 'Low') {
            return view('front.webstore_no_stars', compact('font', 'data', 'total', 'cartItems', 'webstore_search'));
        } elseif ($option == 'Medium') {
            return view('front.webstore_stars', compact('font', 'data', 'total', 'cartItems', 'option'));
        } elseif ($option == 'High') {
            return view('front.webstore_stars_no_lyrics', compact('font', 'data', 'total', 'cartItems', 'option'));
        } elseif ($option == 'Expert') {
            return view('front.webstore_lyrics', compact('font', 'data', 'total', 'cartItems', 'option', 'webstore_search'));
        } else {
            $option = 'default';
            return view('front.webstore_stars', compact('data', 'total', 'cartItems', 'option', 'themes', 'font'));
        }
    }

    public function storeUpload()
    {
        $tags = Tag::get()->toArray();
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        return view('front.webstore_studio', compact('tags', 'font'));
    }

    public function saveMonetizeUpload(Request $request)
    {

        // ini_set('memory_limit', 1000000000);
        // ini_set('max_execution_time', 1000000000);
        // ini_set('max_input_time', 1000000000);
        // ini_set('post_max_size', 1000000000);
        // ini_set('upload_max_filesize', 1000000000);
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'price' => 'required',
            //'content' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,flv,avi,mp3,wav,mkv,pdf,txt,docs,doc,rtf',
            // 'content' => 'file|mimes:jpeg,jfif,png,jpg,gif,svg,mp4,mkv,flv,avi|max:1000000', // Max 1 GB
            // 'thumbnail' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:1000000', // Max 1 GB
            'thumbnail_file_name' => 'required',
            'content_type' => 'required'
        ], [
            'thumbnail_file_name.required' => 'The thumbnail field is required.'
        ]);

        // if ($request->file('thumbnail')) {
        //     $thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'thumbnail');
        // }

        // if ($request->file('content')) {
        //     $file = $request->file('content');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('content'), $filename);
        //     $content = $filename;
        // }

        $price = str_replace("$","",$request->price);
        try {
            $insertdata = array(
                'title' => $request->title,
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'tag_id' => implode(",", $request->tags),
                'price' => $price,
                // 'content' => $content ?? null,
                // 'thumbnail' => $thumbnail ?? null,
                'content' => $request->content_file_name,
                'thumbnail' => $request->thumbnail_file_name,
                'content_type' => $request->content_type,
                'type' => $request->type,
                'other_files' => $request->other_files,
                'other_thumbnails' => $request->other_thumbnails,


            );
            $data = Paidcontent::create($insertdata);
            $allfollower = Follow::where('follow_to', Auth::id())->get();
            $allfollowing = Follow::where('follow_by', Auth::id())->get();
            $follower = array();
            foreach ($allfollower as $af) {
                $follower[] = $af->follow_by;
            }
            foreach ($allfollowing as $af) {
                $follower[] = $af->follow_to;
            }
            $follower = array_unique($follower);
            $notification_subscription = NotificationPrivacyOption::whereIn('user_id', $follower)->pluck('subscription', 'user_id');
            foreach ($notification_subscription as $key => $ns) {
                $notification = json_decode($ns);

                if (isset($notification) && in_array('uploads_webstore', $notification)) {
                    $this->NotificationInsert(
                        Auth::id(),             // sender id
                        $key,                   // recover id
                        $data->id,              // content id
                        'Subscribe upload webstore',// notification type
                        Auth::user()->username . ' upload content in webstore.',
                        'subscription',         // notification type
                        0,                      // status [0 = unread, 1 = read]
                    );
                }
            }
            if (Auth::id()) {
                $this->PointInsert($data->id, 'webstore content upload', 50, 1);
            }
        } catch (\Exception $e) {
            dd($e);
            return back()->with(['error_message' => $e->getMessage()]);
        }
        //return back()->with(['successful_message' => 'Content updated successfully']);
        return json_encode(array('result'=>'success','msg'=>'Content updated successfull'));
    }

    public function publicstoreSearch(Request $request)
    {
        $search_key = $request->search;
        $content_type= $request->type;
        $search = '%' . $request->search . '%';
        $tagData = Tag::where('title', 'like', $search)->get(['id']);

        $data = Paidcontent::join('users', 'paidcontents.user_id', '=', 'users.id')
        ->select('paidcontents.*', 'users.username', 'users.profile_pic', 'users.role_preference')
        ->where('title', 'like', $search)
        ->when(trim($search_key) !== '', function ($query) use ($search) {
            return $query->orWhere('username', 'like', $search);
        })
        ->when($content_type !== 'All', function ($query) use ($content_type) {
            return $query->where('type', $content_type);
        });

        if($request->order=="recency"){
        $data->where('paidcontents.created_at', '>=', Carbon::yesterday())->where('paidcontents.created_at', '<', Carbon::today());
        }
        elseif($request->order=="latest"){
         $data->orderBy("created_at","desc");
        }
        if ($request->order === "prioritisePopularity") {
            $data = $data
                ->leftJoin('cart_items', 'paidcontents.id', '=', 'cart_items.paidcontent_id')
                ->addSelect(DB::raw('COUNT(cart_items.id) as added_count'))
                ->groupBy('paidcontents.id', 'users.username', 'users.profile_pic', 'users.role_preference') // group by all selected fields except aggregates
                ->orderByDesc('added_count');
        }
        elseif ($request->order === "prioritiseTags" && Auth::check()) {
            $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
            $user_antitag = json_decode($user_antitag);
            if (!empty($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $data = $data->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET(?, paidcontents.tag_id)", [$tag->id]);
                    }
                });
            }
        }

        elseif ($request->order === "relevancy" && Auth::check()) {
            $user_antitag = Tagoption::where('user_id', Auth::id())->pluck('antitag')->first();
            $user_antitag = json_decode($user_antitag);
            if (!empty($user_antitag)) {
                $usertagData = Tag::whereIn('id', $user_antitag)->get();
                $data = $data->where(function ($query) use ($usertagData) {
                    foreach ($usertagData as $tag) {
                        $query->whereRaw("NOT FIND_IN_SET(?, paidcontents.tag_id)", [$tag->id]);
                    }
                });
            }
        }
        $webstore_search = '';
        $other_creator = '';

        if (Auth::id()) {
            $searchsetting = Searchsorting::where('user_id', Auth::id())->first();
            // $webstore_search = $searchsetting->webstore_search;

            if (!is_null($searchsetting) && $searchsetting->ws_nonvore == '1') {
                $data = $data->where('content_type', 'non-vore');
            }

            if (!is_null($searchsetting) && $searchsetting->webstore_search == 'use_gallery_algorithm') {
                $data = $data->where(function ($query) use ($tagData, $search) {
                    foreach ($tagData as $tag) {
                        $query->orWhereRaw("FIND_IN_SET($tag->id, tag_id)");
                    }
                });
            }
            if (!is_null($searchsetting) && $searchsetting->webstore_search == 'use_webstore_algorithm') {
                $data = $data->where(function ($query) use ($search) {
                    $query->where('paidcontents.title', 'LIKE', $search)
                        ->orWhere('paidcontents.description', 'LIKE', $search);
                });
            }

            if (!is_null($searchsetting) && $searchsetting->webstore_search == 'include_only_creator') {
                $data = User::where('creator', 1)->where('status', 1)->where('username', 'like', $search);
            }
            if (!is_null($searchsetting) && $searchsetting->webstore_search == 'index_every_creator') {
                $data = User::where('creator', 1)->where('status', 1)->where('username', 'like', $search);
                $matchuser = $data->pluck('id');
                $other_creator = User::where('creator', 1)->where('status', 1)->whereNotIn('id', $matchuser)->get();
                // dd($other_creator->get());
            }
            if (!is_null($searchsetting) && $searchsetting->webstore_search != 'index_every_creator') {
                $other_creator = '';
            }
        }

        $data = $data->get();

        return view('front.webstore_no_stars', compact('data', 'webstore_search', 'other_creator', 'search_key'));
    }

    public function buyablecontent(Request $request, $id)
    {
        $data = Paidcontent::where('id', $id)->with(['user'])->first();

        $same_creator_content = Paidcontent::where('user_id', $data->user_id)->where('id','!=',$id)->inRandomOrder()->limit(5)->get();
        $related_content = Paidcontent::where('user_id', $data->user_id)->where('tag_id','like',$data->tag_id)->where('id','!=',$id)->limit(5)->get();
        $user_items = Paidcontent::where('user_id', $data->user_id)->count();
        $user_followers = Follow::where('follow_to', $data->user_id)->count();
        $tagIdsArray = explode(',', $data->tag_id);
        $tags=Tag::whereIn('id', $tagIdsArray)->pluck('title')->implode(', ');
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $data->user_id)->first();
        $rating = Paidcontentrating::where('content_id', $id)->where('user_id', Auth::id())->first();
        $like_count = Paidcontentlike::where('paidcontentid', $id)->count();
        $dislike_count = Paidcontentdislike::where('paidcontentid', $id)->count();

        $like_count = ($like_count!==null)? $like_count:0;
        $dislike_count = ($dislike_count!==null)? $dislike_count:0;

        $islike = Paidcontentlike::where('paidcontentid', $id)->count();
        $isdislike = Paidcontentdislike::where('paidcontentid', $id)->count();
        $average_rating = 0;
        $total_user_rating = 0;
        $total_user_rating = Paidcontentrating::where('content_id', $id)->sum('rating');
        $total_review = Paidcontentrating::where('content_id', $id)->count();
        if ($total_user_rating != 0) {
            $average_product_rating = $total_user_rating / $total_review;
            $average_product_rating = number_format((float)$average_product_rating, 0, '.', '');
        } else {
            $average_product_rating = 0;
            $total_review = 0;
        }

        $paid_status=0;
        $paid_carts=Cart::select('id')->where('user_id',Auth::id())->where('paid_status',1)->get()->toArray();

        if(!empty($paid_carts)){
            $paid_content_ids=CartItem::select('paidcontent_id')->whereIn('cart_id',$paid_carts)->get()->toArray();
            $paid_content_ids_array=array();
            foreach($paid_content_ids as $paid_content_id){
                array_push($paid_content_ids_array,$paid_content_id['paidcontent_id']);
            }

            if(in_array($id,$paid_content_ids_array)){
                $paid_status=1;
            }
            else{
                $paid_status=0;
            }
        }
        else{
            $paid_status=0;
        }
        $comment = Paidcontentcomment::where('content_id', $id)->where('comment_parent_id', 0)->with(['user'])->orderBy('id', 'DESC')->paginate(10);
        $replies=array();
        foreach($comment as $c) {
            $reply_data = Paidcontentcomment::where('content_id', $id)
                ->where('comment_parent_id', $c->id)
                ->with(['user'])
                ->get();
             $c['reply_data'] = $reply_data;

             $c['comment_like_count']=Paidcontentlike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();
             $c['comment_dislike_count']=Paidcontentdislike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();

        }
        $comment = Paidcontentcomment::where('content_id', $id)->where('comment_parent_id', 0)->where('type','comments')->with(['user'])->orderBy('id', 'DESC')->paginate(10);
        $replies=array();
        foreach($comment as $c) {
            $reply_data = Paidcontentcomment::where('content_id', $id)
                ->where('comment_parent_id', $c->id)
                ->with(['user'])
                ->get();
             $c['reply_data'] = $reply_data;
             $c['comment_like_count']=Paidcontentlike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();
             $c['comment_dislike_count']=Paidcontentdislike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();

        }
        $reviews = Paidcontentcomment::where('content_id', $id)->where('comment_parent_id', 0)->where('type','reviews')->with(['user'])->orderBy('id', 'DESC')->paginate(10);
        $replies=array();

        foreach($reviews as $c) {
            $review_reply_data = Paidcontentcomment::where('content_id', $id)
                ->where('comment_parent_id', $c->id)
                ->with(['user'])
                ->get();
             $c['reply_data'] = $review_reply_data;

             $total_sum_of_comment_rating = Paidcontentrating::where('content_id', $id)->where('comment_id',$c->id)->sum('rating');
             $total_comment_rating = Paidcontentrating::where('content_id', $id)->where('comment_id',$c->id)->count();
             if ($total_sum_of_comment_rating != 0) {
                 $average_rating = $total_sum_of_comment_rating / $total_comment_rating;
                 $average_rating = number_format((float)$average_rating, 0, '.', '');
             } else {
                 $average_rating = 0;
                 $total_review = 0;
             }
             $c['comment_average_rating']=$average_rating;
             $c['comment_like_count']=Paidcontentlike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();
             $c['comment_dislike_count']=Paidcontentdislike::where('paidcontentid',$id)->where('comment_id',$c->id)->count();

        }

        return view('front.buyable_content', compact('data', 'font', 'isFollowing', 'rating', 'average_rating', 'total_review', 'comment', 'like_count', 'dislike_count', 'islike', 'isdislike','paid_status','same_creator_content','related_content','tags','user_items','user_followers','reviews','average_product_rating'));
    }

    public function ratings(Request $request)
    {
        if (Auth::id()) {
            $rating = Paidcontentrating::where('content_id', $request->content_id)->where('comment_id', $request->comment_id)->where('user_id', Auth::id())->first();
            if (!is_null($rating)) {
                $rating->rating = $request->rating;
                $rating->comment_id = $request->comment_id;
                $rating->save();
            } else {
                $rating = new Paidcontentrating;
                $rating->content_id = $request->content_id;
                $rating->rating = $request->rating;
                $rating->comment_id = $request->comment_id;
                $rating->user_id = Auth::id();
                $rating->save();
            }
            $response = array('code' => 200, 'message' => 'Rating added successfully');
        } else {
            $response = array('code' => 422, 'message' => 'Are you not login, please first login');
        }
        return response()->json($response, 200);
    }

    public function browsecreator()
    {
        $data = User::where('creator', 1)->paginate(20);
        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        return view('front.market', compact('data', 'font'));
    }

    public function random()
    {

        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $randomContent = Paidcontent::inRandomOrder()->first();

        return view('front.webstore_random', compact('randomContent', 'font'));
    }

    public function filterResults(Request $request)
    {
        $themes = $this->themes('gallery_theme', 'green_theme');
        if (Auth::id()) {
            $user_id = Auth::id();
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $user_id = 0;
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $sort = 'comic';

        $search = '%' . $request->search . '%';
        $type = $request->type;
        $title = "filter";
        $tagData = Tag::where('title', 'like', $search)->get(['id']);

        $data = Usercontent::where(function ($query) use ($tagData, $search) {
            foreach ($tagData as $tag) {
                $query->orWhereRaw("FIND_IN_SET($tag->id, tags)");
            }
        })->orWhere(function ($query) use ($type, $search) {
            $query->where('title', 'like', $search)
                ->orWhere('description', 'like', $search);
            if ($type != 'all') {
                $query->orWhere('type', 'like', $type);
            }
        })->paginate(20);

        return view('front.filter', compact('data', 'title', 'type', 'themes', 'font', 'sort'));
    }

    public function randomGallery()
    {
        $UsercontentData = Cache::remember('publicgallery_random', $this->cache_time, function () {
            return Usercontent::with('user:id,username,creator,profile_pic')->inRandomOrder()->get()->toArray();
        });

        if (Auth::id()) {
            $user_id = Auth::id();
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $user_id = 0;
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $theme = ThemeOption::whereUserId($user_id)->pluck('gallery_theme')->first();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (Auth::id()) {
            $this->PointInsert(0, 'gallery random', 0.01, 1);
        }
        return view('front.user.gallery', compact('UsercontentData', 'theme', 'font', 'advertisement'));
    }

    public function creatorsGallery()
    {
        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $users = User::orderBy('id', 'desc')->get();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        return view('front.user.creatorsGallery', compact('users', 'font', 'advertisement'));
    }

    public function searchCreator(Request $request)
    {
        if (Auth::id()) {
            $font = Option::where('user_id', Auth::id())->value('preffered_font');
        } else {
            $font = Option::where('user_id', 0)->pluck('preffered_font')->first();
        }
        $search = '%' . $request->search . '%';
        $users = User::select('*')
            ->where('username', 'like', $search)
            ->orWhere('gender', 'like', $search)
            ->orWhere('email', 'like', $search)
            ->orWhere('sexual_orientation', 'like', $search)
            ->get();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $search_key = $request->search;

        return view('front.user.creatorsGallery', compact('users','font', 'advertisement', 'search_key'));
    }

    public function deleteUserContent($id)
    {
        $userContent = Usercontent::find($id);
        $userContent->delete();

        return redirect(route('publicgallery.featured'));
    }

}
