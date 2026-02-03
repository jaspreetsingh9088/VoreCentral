<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\CustomFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Tag ;
use App\Models\Usertag ;
use App\Models\ThemeOption;
use App\Models\Option;
use App\Models\Userantitag;
use App\Models\Loginactivity;
use App\Models\Tagoption;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Hash;
use App\Traits\Achievementpoints;
use App\Traits\StripeTrait;
use App\Traits\ApiResponse;
use App\Models\NotificationPrivacyOption;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use Achievementpoints,StripeTrait,ApiResponse,CustomFileUpload;
    protected function guard()
    {
        return Auth::guard('web');
    }
    public function signupview()
    {
        $themes = ThemeOption::pluck('homepage_theme')->first();
        $font = Option::pluck('preffered_font')->first();
        $Tagdata = Tag::pluck('title', 'id');
        $advertisement = Advertisement::where('status','=',1)->first();
        return view('front.signup', compact('Tagdata','themes','font','advertisement'));
    }

    public function signup(Request $request)
    {
        // Log::debug('request: '.print_r($request->all(), true));
        $validationRules = [
            'username'          => 'required|unique:users,username',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|confirmed|min:6',
            'gender'            => 'required',
            'sexual_orientation'=> 'required',
            'role_preference'   => 'required',
            'dob'               => 'required',
            // 'registration_code' => 'required'
        ];

        // $RegCodes = array('syFXobf3HS', 'ar9bxe61jW', 'wS9i4ccIBt', 'R7E9HIZWRb', 'q2zo5nvIuq', 'x2sZRvwO7w',' rketDWyI2f', '0zsgQlyYRX', 'ROC9YadvH9', 'oitbkXTlw0', '4mBVnvQWaN', 'lTw718SjD2', 's33TI04X8O', 'WXvXWWuN7r', '00DucQ79Bt', 'qRhSYG7IVu', 'yqCsF3tuBN', 'LzMWOosRWX', '1I0atlxj45', 'JEaupBUKiZ');


        $validationMessages = [];
        if (env('APP_ENV') == 'production') {
            $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
            $validationMessages = [ 'g-recaptcha-response.required' => 'The recaptcha field is required.'];
        }

        $validatedData = $request->validate($validationRules, $validationMessages);

        // if(!in_array($request->registration_code, $RegCodes)){
        //     return json_encode(array('result'=> 'error', 'error_message' => 'Sorry registration code is invaild! try again.'));
        // }

        $userdata = $request->all();
        // unset($userdata['registration_code']);

        $userdata['status'] = 1;
        $userData = User::create($userdata);

        if ($userData->id) {
            $clientIP = $request->ip();
            $Latalongdata = \Location::get($clientIP);
            if($Latalongdata != false){
                $User = User::find($userData->id);
                $User->ip_address = $clientIP ;
                $User->latitude = $Latalongdata->latitude ;
                $User->longitude= $Latalongdata->longitude ;
                $User->save();
            }

            $mytag = json_encode($request->tags);
            $myantitags = json_encode($request->antitags);
            Tagoption::insert([
                'user_id'=> $userData->id,
                'tags'   => $mytag,
                'antitag'=> $myantitags
            ]);

            if (is_array($request->tags) && count($request->tags) > 0) {
                foreach ($request->tags as $tags) {
                    $Usertags = new Usertag() ;
                    $Usertags->userid  = $userData->id;
                    $Usertags->tagid   = $tags;
                    $Usertags->save();
                }
            }

            if (is_array($request->antitags) && count($request->antitags) > 0) {
                foreach ($request->antitags as $antitags) {
                    $Userantitag = new Userantitag();
                    $Userantitag->userid  = $userData->id;
                    $Userantitag->tagid   = $antitags;
                    $Userantitag->save();
                }
            }

            NotificationPrivacyOption::Insert([
                'user_id' => $userData->id,
                'profileview_access' => 'Everyone',
                'gallary_notification' => json_encode(array("like","dislike","comment","newitem")),
                'activity' => 'showall',
                'subscription' => json_encode(array("subscribe_uploads","uploads_webstore")),
                'post_access' => 'all',
                'general_privacy' => json_encode(array("show_vorerole","show_gender","show_orientation")),
                'radio_group' => 'all',
                'notification_userpage' => json_encode(array("comment_on_userpage","update_from_user_i_follow","comment_like_on_my_userpage")),
                'notification_forum' => json_encode(array("userquote_my_message","user_mention_me","post_in_thread_i_have_posted","post_in_thread_i_followed","post_in_thread_i_started","user_likes_my_post")),
                'notification_dlc' => json_encode(array("new_dlc_from_creators_i_follow","somebody_download_my_dlc","somebody_reacts_to_my_dlc"))
            ]);

            return json_encode(array('result'=> 'success'));
        } else {
            return json_encode(array('result'=> 'error', 'error_message' => 'Something went wrong'));
        }
    }

    public function login(Request $request)
    {
        $validationRules = [
            // 'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ];
        $validationMessages = [];
        if (env('APP_ENV') == 'production') {
            $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
            $validationMessages = [ 'g-recaptcha-response.required' => 'The recaptcha field is required.'];
        }

        $validatedData = $request->validate($validationRules, $validationMessages);

        // $credentials = $request->only('email', 'password');
        $credentials = $request->only('username', 'password');
        $credentials['status'] = 1;

        if (Auth::attempt($credentials)) {
            $this->LoginPointInsert();
            Loginactivity::create([
                'user_id' => Auth::id()
            ]);

            return redirect(route('home'));
        }else{
            return back()->withErrors(['error_message' => 'Incorrect Login Credentials'])->withInput();
        }
    }

    public function updateprofilepic(Request $request){
        ini_set('memory_limit', 1000000000);
        ini_set('max_execution_time', 1000000000);
        ini_set('max_input_time', 1000000000);
        ini_set('post_max_size', 1000000000);
        ini_set('upload_max_filesize', 1000000000);
        $this->validate($request, ['profile_pic' => 'required|image|mimes:jpeg,png,jpg' ]);
        $User = User::find(Auth::id());
        if ($request->file('profile_pic')) {
            $User->profile_pic = $this->uploadImageFile($request->file('profile_pic'), 'profilepic');
        }
        $User->save();
        $response = [
            'code' => 200,
            'message' => "Profile pic updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function updatecoverpic(Request $request){
        // ini_set('memory_limit', 1000000000);
        // ini_set('max_execution_time', 1000000000);
        // ini_set('max_input_time', 1000000000);
        // ini_set('post_max_size', 1000000000);
        // ini_set('upload_max_filesize', 1000000000);
        $this->validate($request, [
            'cover_pic' => 'required|image|max:10000', // Max 10 MB
        ],[
            'cover_pic.max' => 'The cover pic must not be greater than 10 MB.'
        ]);

        try {
            $User = User::find(Auth::user()->id);
            if ($request->file('cover_pic')) {
                $User->cover_pic = $this->uploadImageFile($request->file('cover_pic'), 'coverpic');
            }

            $User->save();

            $response = [
                'code' => 200,
                'message' => "Banner updated successfully"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(array('result' => 'error', 'error_msg' => $e->getMessage()));
        }
    }

    // Remove pictures from disk
    public function removePicture(Request $request)
    {
        if ($request->type == 'banner') {
            $dir_name = 'coverpic';
            $param_name = 'cover_pic';
        }
        elseif ($request->type == 'profile_picture') {
            $dir_name = 'profilepic';
            $param_name = 'profile_pic';
        }

        // Image name
        $image_name = basename(Auth::user()->$param_name);

        $path = public_path() . '/' . $dir_name;
        $image_path = $path . '/' . $image_name;
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete from user table
        User::where('id', Auth::id())->update([$param_name => NULL]);

        return redirect()->back()->with(['successful_message' => 'Picture is removed successfully.']);
    }

    public function updatethemebg(Request $request)
    {
        ini_set('memory_limit', 1000000000);
        ini_set('max_execution_time', 1000000000);
        ini_set('max_input_time', 1000000000);
        ini_set('post_max_size', 1000000000);
        ini_set('upload_max_filesize', 1000000000);
        $this->validate($request, [
            'themebg' => 'required|image',
        ]);

        $User = User::find(Auth::user()->id);
        if ($request->file('themebg')) {
            $User->themebg = $this->uploadImageFile($request->file('themebg'), 'themebg');
        }

        $User->save();
        return redirect()->back()->with('success_message', 'Theme Background update successfully');
        // return $this->sendResponse('Theme Background update successfully',200);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect(route('home'));
    }

    public function loginget(Request $request){

        $themes = ThemeOption::pluck('homepage_theme')->first();
        $font = Option::pluck('preffered_font')->first();
        $advertisement = Advertisement::where('status','=',1)->first();
        return view('front.login',compact('themes','font','advertisement'));
    }

    public function update_password(Request $request){

        $this->validate($request, [
            'new_password'   => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = $request->new_password;
        $user->save();

        return json_encode(array('result'=>'success'));

    }
}
