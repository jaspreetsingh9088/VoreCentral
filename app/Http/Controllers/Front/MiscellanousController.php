<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Mail\NotifyMail;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\{User,CartItem};
use App\Models\Profilepost;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Rules\ReCaptcha;
use App\Models\{Journal,Paidcontent};
use App\Models\Profilecomment ;
use App\Models\Follow ;
use App\Models\Advertisement ;
use App\Models\Usercontent ;
use App\Models\Option ;
use App\Models\Dlccontents ;
use App\Models\Activity ;
use App\Models\ThemeOption ;
use App\Models\NotificationPrivacyOption ;
use App\Models\Comment ;
use App\Models\Like ;
use App\Models\Content;
use App\Models\Section;
use App\Models\Searchsorting;
use App\Models\DownloadDlcFile ;
use App\Models\Galleryfavorite ;
use App\Models\Creatorcontent ;
use App\Models\Point ;
use App\Models\Owncollaction ;
use App\Models\Tag;
use App\Models\Featuredcontent;
use File;
use App\Models\Likedlc;
use App\Models\Dislikedlc;
use App\Models\Usertag;
use App\Models\Tagoption;
use App\Models\Achievementpoint;
use App\Models\Newsarchive;
use DateTime;
use Redirect;
use DB;
use Illuminate\Support\Enumerable;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

class MiscellanousController extends Controller
{
    use Notification,Achievementpoints;
    public function index()
    {
        $advertisement = Advertisement::where('status','=',1)->first();
        $AllUsersdata = User::where('status',1)->with('lastlogin')->get()->toArray();
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.onlineuser', compact('theme','font','AllUsersdata', 'advertisement'));
    }

    public function onlineuserSearch(Request $request){
        $search = '%'.$request->search.'%';
        $advertisement = Advertisement::where('status','=',1)->first();
        $AllUsersdata = User::where('username','like', $search);
        $AllUsersdata = $AllUsersdata->where('status',1);
        $AllUsersdata = $AllUsersdata->with('lastlogin')->get()->toArray();
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.onlineuser', compact('theme','font','AllUsersdata', 'advertisement'));
    }

    public function aboutus(){
        $aboutcontent = Content::where('alias','aboutus')->get()->toArray();
        if(isset($aboutcontent) && is_array($aboutcontent) && count($aboutcontent) > 0)
        {
            foreach($aboutcontent as $aboutcontentK => $aboutcontentV){
            $aboutcontent[$aboutcontentK]['sections'] = Section::select('text')->where('cid',$aboutcontentV['id'])->get()->toArray();
            }
        }
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.aboutus',compact('theme','font','aboutcontent'));
    }

    public function ourstaff(){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $advertisement = Advertisement::where('status','=',1)->first();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.ourstaff',compact('theme','font','advertisement'));
    }

    public function news_archieve(){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $news = Newsarchive::where('status',1)->orderBy('id','DESC')->get();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.news_archieve',compact('theme','news','font'));
    }

    public function news_detail($id){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $news = Newsarchive::where('id',$id)->first();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.news_detail',compact('theme','news','font'));
    }

    public function contactus(){
        $advertisement = Advertisement::where('status','=',1)->first();
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.contactus',compact('theme','font','advertisement','font'));

    }

    public function contentPromotedProduced(){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $content = Usercontent::where('promoted',1)->orderBy('id','DESC')->with(['user'])->paginate(20);
        $advertisement = Advertisement::where('status','=',1)->first();
        if(Auth::id()){
            $pagename = 'content promoted';
            if(isset($_GET['page'])){
                $pageno = $_GET['page'];
            }else{
                $pageno = 1;
            }
            $this->PointInsert(0,$pagename,0.01,$pageno);
        }
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.content-promoted-produced',compact('theme','content','font','advertisement'));
    }

    public function creatorInformationMonetisation(){
        if(Auth::id()){
            $uid = Auth::id();
        }else{
            $uid = 0;
        }
        $font = Option::where('user_id',$uid)->value('preffered_font');
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.creator-information-monetisation',compact('theme','font'));
    }

    public function helpandsupport(){
        if(Auth::id()){
            $uid = Auth::id();
        }else{
            $uid = 0;
        }
        $font = Option::where('user_id',$uid)->value('preffered_font');
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.helpandsupport',compact('theme','font'));
    }

    public function informationDifferentSubject(){
        if(Auth::id()){
            $uid = Auth::id();
        }else{
            $uid = 0;
        }
        $font = Option::where('user_id',$uid)->value('preffered_font');
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.information-different-subjects',compact('theme','font'));
    }

    public function privacypolicy(){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $advertisement = Advertisement::where('status','=',1)->first();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.privacypolicy',compact('theme','advertisement','font'));
    }

    public function termsservice(){
        if(Auth::id()){
            $font = Option::where('user_id',Auth::id())->value('preffered_font');
        }else{
            $font = Option::where('user_id',0)->value('preffered_font');
        }
        $advertisement = Advertisement::where('status','=',1)->first();
        $theme =  $this->themes('homepage','blue_theme');
        return view('front.homepage.terms_service',compact('theme','advertisement','font'));
    }

    public function sendPersonalData(){

        try{
            //Mail::to(Auth::user()->email)->send(new NotifyMail());
           Mail::to("ranjeet@neuronsit.sg")->send(new NotifyMail());

            //dd($mail);

        }
        catch (Swift_TransportException $e) {
            // Handle the error
            $errorMessage = $e->getMessage();
            // Log the error or display a friendly message to the user
            // You can also redirect back with an error flash message, etc.
            return back()->withErrors(['email_error' => $errorMessage]);
        }
       // echo 'Your Personal data send in mail';
        return back()->with(['successful_message' => 'Your Personal data send in mail']);
    }

    public function contactusMail(Request $request)
    {
        try {
            // Mail Send
            Mail::to("info@vorecentral.com")->send(new ContactUsMail($request->email, $request->subject, $request->message));

            return back()->with(['successful_message' => 'Your message send successfully. We will contact you shortly.']);

        } catch (\Exception $e) {
            Log::debug('Mail Error:: '. print_r($e->getMessage(), true));
            return back()->with(['error_message' => 'Mail send failed.']);
        }
    }
}
