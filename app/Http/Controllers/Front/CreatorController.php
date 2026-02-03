<?php

namespace App\Http\Controllers\Front;

use App\Enum\StripeAccountStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Traits\CustomFileUpload;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profilepost;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Journal;
use App\Models\Follow;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Contentview;
use App\Models\Like;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Usercontent;
use App\Models\Option;
use App\Models\Creatorcontent;
use App\Models\Gallerycomment;
use App\Models\Advertisement;
use App\Models\Galleryfavorite;
use App\Models\NotificationPrivacyOption;
use App\Models\Point;
use App\Models\{Gallerydislike, Gallerylike};
use App\Models\Owncollaction;
use App\Models\Featuredcontent;
use App\Models\Favouritecollection;
use App\Models\Singlefeaturedcontent;
use App\Models\Featuredchannel;
use App\Models\ThemeOption;
use App\Models\Creator;
use App\Models\Paidcontent;
use App\Models\Webstoreowncollaction;
use App\Models\Dlccontents;
use App\Models\Thread;
use App\Models\Tag;
use App\Models\Profilecomment;
use App\Models\Threadcomment;
use App\Models\Usercontentrating;
use App\Models\Paidcontentrating;
use App\Models\Paidcontentcomment;
use App\Models\{Paidcontentlike, Paidcontentdislike};
use App\Http\Requests\CreatorRequest;
use App\Traits\Notification;
use App\Traits\Achievementpoints;
use App\Traits\StripeTrait;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// use Stripe\OAuth;

class CreatorController extends Controller
{
    use Notification, Achievementpoints, StripeTrait, ApiResponse, CustomFileUpload;

    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }

    public function webstoreManageContent()
    {
        $paidcontent = Paidcontent::where('user_id', Auth::id())->where('is_delete', '1')->get();
        $deletecontent = Paidcontent::where('user_id', Auth::id())->where('is_delete', '0')->get();
        $webstorecollection = Webstoreowncollaction::select('id', 'collection_name', 'contentids')->where('userid', Auth::id())->get()->toArray();
        $collectiondata = array();
        foreach ($webstorecollection as $wc) {
            $jsonobject = json_decode($wc['contentids']);
            $paid_cnt = Paidcontent::select('id', 'thumbnail', 'title')->whereIn('id', $jsonobject)->get()->toArray();
            $wc['content'] = $paid_cnt;
            $collectiondata[] = $wc;
        }
        $allpaidcontent = Paidcontent::where('user_id', Auth::id())->get();
        return view('front.creator.webstore_manage_content', compact('paidcontent', 'deletecontent', 'collectiondata', 'allpaidcontent'));
    }

    public function paidContentEdit($id)
    {
        $content = Paidcontent::where('id', $id)->first();

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $tags = Tag::get();
        return view('front.creator.content.edit', compact('font', 'content', 'tags'));
    }

    public function updatePaidContent(Request $request, $id)
    {
        ini_set('memory_limit', 1000000000);
        ini_set('max_execution_time', 1000000000);
        ini_set('max_input_time', 1000000000);
        ini_set('post_max_size', 1000000000);
        ini_set('upload_max_filesize', 1000000000);
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'price' => 'required',
            'cat_image' => 'file|mimes:jpeg,jfif,png,jpg,gif,svg,mp4,mkv,flv,avi,mp3,wav,pdf,txt',
            'thumbnail' => 'file|mimes:jpeg,png,jpg,gif,svg',
            'content_type' => 'required'
        ]);
        $content = Paidcontent::where('id', $id)->first();

        $price = str_replace("$","",$request->price);

        $updatedata = array(
            'title' => $request->title,
            'description' => $request->description,
            'tag_id' => implode(",", $request->tags),
            'price' => $price,
            'content_type' => $request->content_type
        );
        // dd($request->all());
        if ($request->file('thumbnail')) {
            if (file_exists(public_path() . '/thumbnail/' . $content->getRawOriginal('thumbnail'))) {
                $this->deleteFile($content->getRawOriginal('thumbnail'), asset('thumbnail/'));
            }

            $thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'thumbnail');
            $updatedata['thumbnail'] = $thumbnail;
        }

        if ($request->file('content')) {
            if (file_exists(public_path() . '/content/' . $content->getRawOriginal('content'))) {
                $this->deleteFile($content->getRawOriginal('content'), asset('content/'));
            }
            $content = $this->uploadImageFile($request->file('content'), 'content');
            $updatedata['content'] = $content;
        }
        // dd($updatedata);
        try {
            $data = Paidcontent::where('id', $id)->update($updatedata);

        } catch (\Exception $e) {
            return back()->with(['successful_message' => $e->getMessage()]);
        }

        //return redirect()->route('webstore.manage.content')->with(['successful_message' => 'Content updated successfully']);
        return json_encode(array('result'=>'success','msg'=>'Content updated successfully'));
    }

    public function webstoreContentDelete(Request $request)
    {
        $this->validate($request, [
            'content_id' => 'required'
        ]);
        foreach ($request->content_id as $cid) {
            Paidcontent::where('id', $cid)->update(['is_delete' => '0']);
        }

        return redirect()->back()->with(['successful_message' => 'Content remove to webstore.']);
    }

    public function webstoreContentCollection(Request $request)
    {
        $this->validate($request, [
            'content_id' => 'required',
            'collection_name' => 'required'
        ]);
        $jsoncollaction = json_encode($request->content_id);
        $owncollaction = new Webstoreowncollaction();
        $owncollaction->collection_name = $request->collection_name;
        $owncollaction->contentids = $jsoncollaction;
        $owncollaction->userid = Auth::user()->id;
        $owncollaction->save();
        return redirect()->back()->with(['successful_message' => 'New collection create successfully.']);
    }

    public function createview(Request $request)
    {
        $user = Auth::user();
        if ($user === null) {
            abort(404);
        }

        $themes = ThemeOption::whereUserId($user->id)->value('others_theme');
        $font = Option::where('user_id', $user->id)->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $creator = Creator::where('userid', $user->id)->first();
        $errors = [];

        $current_ip = $request->ip();
        if (config('app.env') == 'local') {
            $current_ip = '178.238.11.6';
        }

        $response = Http::get('http://ipinfo.io/'. $current_ip .'/geo');
        $country = json_decode($response->body())->country;

        if (empty($user->stripe_acc)) {
            $account_data = array(
                // 'country' => 'US',
                'country' => $country,
                'type' => 'express',
                'email' => $user->email,
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
            );
            $stripe_account = $this->createAccount($account_data);
            if (isset($stripe_account, $stripe_account->id)) {
                $user->update(['stripe_acc' => $stripe_account->id]);
            }
        }
        $stripe_link_expires_at = null;
        if (isset($user->stripe_link_expires_at)) {
            $stripe_link_expires_at = Carbon::parse($user->stripe_link_expires_at);
        }

        if (isset($user->stripe_acc)) {
            $account = $this->retrieveAccount($user->stripe_acc);
            if (isset($account->requirements->disabled_reason)) {
                // Account has pending requirements
                if (isset($account->requirements->errors)) {
                    foreach ($account->requirements->errors as $err) {
                        $errors[] = $err["reason"];
                    }
                } else {
                    $errors[] = "Your Stripe is not active due to unknown reason, for more detail connect us.";
                }
                if (empty($stripe_link_expires_at) || $stripe_link_expires_at->isPast()) {
                    $account_link_data = array(
                        'account' => $user->stripe_acc,
                        // 'refresh_url' => route('creator'),
                        // 'return_url' => route('creator'),
                        'refresh_url' => "https://vorecentral.com/creator",
                        'return_url' => "https://vorecentral.com/creator",
                        'type' => 'account_onboarding',
                    );
                    $account_link = $this->AccountLink($account_link_data);

                    if(isset($account_link->url)) {
                        $user->update([
                            'stripe_account_link' => $account_link->url,
                            'stripe_link_expires_at' => Carbon::createFromTimestamp($account_link->expires_at),
                            'stripe_status' => StripeAccountStatusEnum::PENDING
    //                        'stripe_status' => StripeAccountStatusEnum::ACTIVE
                        ]);
                    } else {
                        Log::debug("account link error: " . print_r($account_link, true));
                        // $errors[] = $account_link['message'];
                        // Account create
                        $account_data = array(
                            'country' => $country,
                            'type' => 'express',
                            'email' => $user->email,
                            'capabilities' => [
                                'card_payments' => ['requested' => true],
                                'transfers' => ['requested' => true],
                            ],
                        );
                        $stripe_account = $this->createAccount($account_data);
                        if (isset($stripe_account, $stripe_account->id)) {
                            $user->update(['stripe_acc' => $stripe_account->id]);
                        }

                        $account_link_data = array(
                            'account' => $user->stripe_acc,
                            // 'refresh_url' => route('creator'),
                            // 'return_url' => route('creator'),
                            'refresh_url' => "https://vorecentral.com/creator",
                            'return_url' => "https://vorecentral.com/creator",
                            'type' => 'account_onboarding',
                        );
                        $account_link = $this->AccountLink($account_link_data);
                        $user->update([
                            'stripe_account_link' => $account_link->url,
                            'stripe_link_expires_at' => Carbon::createFromTimestamp($account_link->expires_at),
                            'stripe_status' => StripeAccountStatusEnum::PENDING
                        ]);
                    }
                }

            } else if ($account->charges_enabled) {
                // Account is fully activated
                $user->update([
                    'stripe_status' => StripeAccountStatusEnum::ACTIVE
                ]);
            } else {
                // Account is restricted
                $user->update([
                    'stripe_status' => StripeAccountStatusEnum::RESTRICTED
                ]);
            }
        }

        if (isset($user->stripe_link_expires_at)) {
            $stripe_link_expires_at = Carbon::parse($user->stripe_link_expires_at);
        }
        return view('front.creator', compact('themes', 'font', 'advertisement', 'creator', 'stripe_link_expires_at', 'errors'));
    }

    private function getToken($code)
    {
        $token = null;
        try {
            $token = OAuth::token([
                'grant_type' => 'authorization_code',
                'code' => $code
            ]);
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function getAccount($connectedAccountId)
    {
        $account = null;
        try {
            $account = $this->stripe->accounts->retrieve(
                $connectedAccountId,
                []
            );
        } catch (Exception $e) {
            $account['error'] = $e->getMessage();
        }
        return $account;
    }

    public function create(CreatorRequest $request)
    {
        $iscreator = Creator::where('userid', Auth::id())->get()->toArray();
        if (isset($iscreator) && is_array($iscreator) && count($iscreator)== 0) {
            $creator = Creator::create(
                array_merge(
                    $request->only('content_type', 'old_account', 'subgenres', 'content_description'),
                    ['paypal' => null, 'userid' => Auth::id()]
                )
            );
            $creator->status = 2;
            $creator->save();
            return $this->sendResponse("Request submit successfully, wait for activation", 200);
        }else{
            return $this->sendResponse("Request was already submitted, wait for activation", 200);
        }
    }

    public function dashboard()
    {
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->count();

        $UsercontentData = array();
        $SingleFeaturedcontentData = array();
        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->where('featured', 1)->get()->toArray();
        if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0) {
            foreach ($Owncollaction as $OwncollactionK => $OwncollactionV) {
                $contentarray = json_decode($OwncollactionV['contentids'], true);
                $UsercontentData[] = Usercontent::select('thumbnail', 'id')->whereIn('id', $contentarray)->get()->toArray();
            }
        }

        $RecentUsercontent = Usercontent::select('thumbnail', 'id')->where('userid', Auth::user()->id)->limit(3)->get()->toArray();

        $myData = Auth::user()->toArray();
        $Pointcount = Point::where('userid', Auth::user()->id)->sum('point');
        $myData['achivement'] = $this->achivements($myData['role_preference'], $Pointcount);

        $SinglefeaturedData = Singlefeaturedcontent::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($SinglefeaturedData) && is_array($SinglefeaturedData) && count($SinglefeaturedData) > 0) {
            $SingleFeaturedcontentData = Usercontent::where('id', $SinglefeaturedData[0]['contentid'])->get()->toArray();
        }

        $creatore = Auth::user();
        if ($creatore->role_preference == 'pred') {
            if (is_null($creatore->achievements) || $creatore->achievements == 'null') {
                $profile_rank = $this->achivements($creatore->role_preference, $Pointcount);
            } else {
                $rank = json_decode($creatore->achievements);
                $profile_rank = implode(',', $rank);
            }
        } else if ($creatore->role_preference == 'prey') {
            if (is_null($creatore->prey_achievements) || $creatore->prey_achievements == 'null') {
                $profile_rank = $this->achivements($creatore->role_preference, $Pointcount);
            } else {
                $rank = json_decode($creatore->prey_achievements);
                $profile_rank = implode(',', $rank);
            }
        } else {
            $profile_rank = $creatore->achievements;
        }
        // $profile_rank = $this->achivements(strtolower($myData['role_preference']),$myData['points']);

        $usercontentcount = Usercontent::where('userid', Auth::id())->count();
        $dlccontentcount = Dlccontents::where('userid', Auth::id())->count();
        $paidcontentcount = Paidcontent::where('user_id', Auth::id())->count();
        $useruploadcount = $usercontentcount + $dlccontentcount + $paidcontentcount;

        $threadcount = Thread::where('userid', Auth::id())->count();

        $gallerycommentcount = Gallerycomment::where('userid', Auth::id())->count();
        $profilecommentcount = Profilecomment::where('uid', Auth::id())->count();
        $threadcommentcount = Threadcomment::where('userid', Auth::id())->count();
        $numberofcomment = $gallerycommentcount + $profilecommentcount + $threadcommentcount;


        $datetime1 = new DateTime($myData['created_at']);
        $datetime2 = new DateTime(today());
        $interval = $datetime1->diff($datetime2);
        $hasbeenmember = $interval->format('%a');
        if ($myData['creator'] == 1) {
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
            'gender' => $myData['gender']
        );
        return view('front.creator.dashboard', compact('userinfo', 'generalsetting', 'font', 'myData', 'AllFollower', 'UsercontentData', 'RecentUsercontent', 'SingleFeaturedcontentData', 'advertisement'));
    }

    public function createowncollaction(Request $request)
    {
        if($request['images']) {
            $jsoncollaction = json_encode($request['images']);
            $Owncollaction = new Owncollaction();
            $Owncollaction->collection_name = $request['collection_name'];
            $Owncollaction->contentids = $jsoncollaction;
            $Owncollaction->userid = Auth::user()->id;
            $Owncollaction->save();
            return redirect()->route('creatorupload');
        } else {
            return redirect()->back()->with('error_message', 'Please select image to create own collection.');
        }
    }

    public function favroitecollection(Request $request)
    {
        $jsoncollaction = json_encode($request['images']);
        $Favouritecollection = new Favouritecollection();
        $Favouritecollection->contentids = $jsoncollaction;
        $Favouritecollection->userid = Auth::user()->id;
        $Favouritecollection->save();
        return redirect()->route('creatorupload');
    }

    public function singlefeaturedcontents(Request $request)
    {
        if (isset($request['images']) && is_array($request['images']) && count($request['images']) > 0) {
            foreach ($request['images'] as $imageK => $imageV) {
                $SinglefeaturedcontentData = Singlefeaturedcontent::where('userid', Auth::user()->id)->get()->toArray();
                if (isset($SinglefeaturedcontentData) && is_array($SinglefeaturedcontentData) && count($SinglefeaturedcontentData) > 0) {
                    Singlefeaturedcontent::where('id', $SinglefeaturedcontentData[0]['id'])->update(array('contentid' => $request['images'][0]));
                } else {
                    $Singlefeaturedcontent = new Singlefeaturedcontent();
                    $Singlefeaturedcontent->contentid = $request['images'][0];
                    $Singlefeaturedcontent->userid = Auth::user()->id;
                    $Singlefeaturedcontent->save();
                }
            }
        }
        return redirect()->route('creatorupload');
    }
    public function removesinglefeaturedcontents(Request $request)
    {
        $SinglefeaturedcontentData = Singlefeaturedcontent::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($SinglefeaturedcontentData) && is_array($SinglefeaturedcontentData) && count($SinglefeaturedcontentData) > 0) {
            Singlefeaturedcontent::where('id', $SinglefeaturedcontentData[0]['id'])->delete();
        }
        return redirect()->route('creatorupload');
    }


    public function setfeaturedchannel(Request $request)
    {
        if (isset($request['images']) && is_array($request['images']) && count($request['images']) > 0) {
            foreach ($request['images'] as $imageK => $imageV) {
                $Featuredchannel = new Featuredchannel();
                $Featuredchannel->contentid = $imageV;
                $Featuredchannel->userid = Auth::user()->id;
                $Featuredchannel->save();
            }
        }
        return redirect()->route('creatorupload');
    }

    public function featuredcontents(Request $request)
    {
        if (isset($request['images']) && is_array($request['images']) && count($request['images']) > 0) {
            foreach ($request['images'] as $imageK => $imageV) {
                $Featuredcontent = new Featuredcontent();
                $Featuredcontent->contentid = $imageV;
                $Featuredcontent->userid = Auth::user()->id;
                $Featuredcontent->save();
            }
        }
        return redirect()->route('creatorupload');
    }

    public function featuredcollection(Request $request)
    {
        if (isset($request['images']) && is_array($request['images']) && count($request['images']) > 0) {
            Owncollaction::whereIn('id', $request['images'])->update(array('featured' => 1));
        }
        return redirect()->route('creatorupload');
    }

    public function creatorupload()
    {

        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        $AllFeaturedchannel = Featuredchannel::where('userid', Auth::user()->id)->get()->toArray();
        $AllUserData = array();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $followarray = array_values(array_unique(array_column($AllFollowing, 'follow_to')));
            $AllUserData = User::whereIn('id', $followarray)->whereNotIn('id', $featuredarray)->get()->toArray();
        }
        $UserData = array();
        if (isset($AllFeaturedchannel) && is_array($AllFeaturedchannel) && count($AllFeaturedchannel) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $UserData = User::whereIn('id', $featuredarray)->get()->toArray();
        }

        $myData = Auth::user()->toArray();

        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;

        $FeaturedcontentData = array();
        $SingleFeaturedcontentData = array();
        $UsercontentData = Usercontent::where('userid', Auth::user()->id)->get()->toArray();
        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();

        if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0) {
            foreach ($Owncollaction as $OwncollactionK => $OwncollactionV) {

                if($OwncollactionV['contentids']!=""){
                    $contentarray = json_decode($OwncollactionV['contentids'], true);
                    if(count($contentarray)>0){
                        $UsercontentData1 = Usercontent::where('id', $contentarray[0])->get()->toArray();
                        if(count($UsercontentData1)>0){
                            $Owncollaction[$OwncollactionK]['content_id'] = $contentarray[0];
                            $Owncollaction[$OwncollactionK]['image'] = $UsercontentData1[0]['thumbnail'];
                        }else{
                            unset($Owncollaction[$OwncollactionK]);
                        }

                    }
                }else{
                    unset($Owncollaction[$OwncollactionK]);
                }


            }
        }

        $featuredData = Featuredcontent::where('userid', Auth::user()->id)->get()->toArray();

        if (isset($featuredData) && is_array($featuredData) && count($featuredData) > 0) {
            $featuredData = array_column($featuredData, 'contentid');
            $FeaturedcontentData = Usercontent::whereIn('id', $featuredData)->get()->toArray();
        }


        $Galleryfavorite = Galleryfavorite::where('userid', Auth::user()->id)->get()->toArray();
        $FavouritecontentData = array();
        if (isset($Galleryfavorite) && is_array($Galleryfavorite) && count($Galleryfavorite) > 0) {
            $Galleryfavorite = array_column($Galleryfavorite, 'contentid');
            $FavouritecontentData = Usercontent::whereIn('id', $Galleryfavorite)->get()->toArray();
        }

        $Favouritecollection = Favouritecollection::where('userid', Auth::user()->id)->get()->toArray();

        if (isset($Favouritecollection) && is_array($Favouritecollection) && count($Favouritecollection) > 0) {

            foreach ($Favouritecollection as $FavouritecollectionK => $FavouritecollectionV) {
                $contentarray = json_decode($FavouritecollectionV['contentids'], true);
                $UsercontentData2 = Usercontent::where('id', $contentarray[0])->get()->toArray();
                $Favouritecollection[$FavouritecollectionK]['image'] = $UsercontentData2[0]['thumbnail'];
            }
        }

        $SinglefeaturedData = Singlefeaturedcontent::where('userid', Auth::user()->id)->get()->toArray();

        if (isset($SinglefeaturedData) && is_array($SinglefeaturedData) && count($SinglefeaturedData) > 0) {
            $SingleFeaturedcontentData = Usercontent::where('id', $SinglefeaturedData[0]['contentid'])->get()->toArray();
        }
        return view('front.creator.creatorupload', compact('generalsetting', 'font', 'UsercontentData', 'Owncollaction', 'FeaturedcontentData', 'myData', 'FavouritecontentData', 'Favouritecollection', 'SingleFeaturedcontentData','AllUserData','UserData'));
    }

    public function creatorwebstore()
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $CreatorcontentData = Paidcontent::where('user_id', Auth::user()->id)->paginate(10);
        return view('front.creator.webstore', compact('CreatorcontentData', 'font'));
    }

    public function creatorcontentupload()
    {
        $commentCount=Comment::where('userid',Auth::id())->count();
        $likeCount=Like::where('userid',Auth::id())->count();
        $threadCount=Thread::where('userid',Auth::id())->count();
        //$favorite=Favouritecollection::select(['contentids'])->where('userid',Auth::id())->get()->toArray();
        //$favouriteCount=count(json_decode($favorite[0]['contentids']));
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;

        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();
        $TagData = Tag::get()->toArray();
        $themes = 'green_theme';
        $myData = Auth::user()->toArray();

        if(Auth::user()->creator){
         return view('front.creator.content.add', compact('themes', 'Owncollaction', 'TagData', 'themes', 'font', 'myData', 'generalsetting'));
        }
        else if($commentCount>=5 || $likeCount>=5 || $threadCount>=5){
        return view('front.creator.content.add', compact('themes', 'Owncollaction', 'TagData', 'themes', 'font', 'myData', 'generalsetting'));
        }
        else{
        return view('front.creator.content.uploadmessage', compact('themes', 'Owncollaction', 'TagData', 'themes', 'font', 'myData', 'generalsetting'));

        }
    }

    public function creatordlcupload()
    {
        $TagData = Tag::get()->toArray();
        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();
        $themes = 'green_theme';
        $myData = Auth::user()->toArray();
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.content.dlcadd', compact('Owncollaction', 'TagData', 'themes', 'font', 'myData', 'generalsetting'));
    }

    public function paidContentComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        if($request->has('comment_id')){
            $parent_content_id=$request->input('comment_id');
        }
        else{
            $parent_content_id=0;
        }
        if($request->has('comment_id')){
            $parent_content_id=$request->input('comment_id');

        }
        else{
            $parent_content_id=0;
        }

        if($request->has('contentid')){
            $content_id=$request->input('contentid');

        }
        else{
            $content_id=$id;
        }
        if($request->has('type')){
            $type=$request->input('type');

        }
        else{
            $type='comments';
        }
        $comment = Paidcontentcomment::insert([
            'user_id' => Auth::id(),
            'content_id' => $content_id,
            'comment' => $request->comment,
            'type'=>$type,
            'comment_parent_id'=>$parent_content_id
        ]);
        return redirect()->back()->with('successful_message', 'Comment added successfully');
        // return $this->sendResponse('Comment add successfully',200);
    }

    public function webstoredetail($id)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');
        $isfavourite = 0;
        $data = Paidcontent::where('id', $id)->first();
        if (Auth::check()) {
            $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $data->user_id)->first();
            $this->visitCount(Auth::id(), $data->user_id, url()->current());
        } else {
            $isFollowing = '';
        }
        $rating = Paidcontentrating::where('content_id', $id)->where('user_id', Auth::id())->first();
        $comment = Paidcontentcomment::where('content_id', $id)->with(['user'])->orderBy('id', 'ASC')->paginate(10);
        $total_user_rating = 0;
        $total_user_rating = Paidcontentrating::where('content_id', $id)->sum('rating');
        $total_review = Paidcontentrating::where('content_id', $id)->count();
        if ($total_user_rating != 0) {
            $average_rating = $total_user_rating / $total_review;
            $average_rating = number_format((float)$average_rating, 0, '.', '');
        } else {
            $average_rating = 0;
            $total_review = 0;
        }

        $like_count = Paidcontentlike::where('paidcontentid', $id)->count();
        $dislike_count = Paidcontentdislike::where('paidcontentid', $id)->count();

        $like_count = ($like_count!==null)? $like_count:0;
        $dislike_count = ($dislike_count!==null)? $dislike_count:0;

        $islike = Paidcontentlike::where('paidcontentid', $id)->where('userid', Auth::id())->count();
        $isdislike = Paidcontentdislike::where('paidcontentid', $id)->where('userid', Auth::id())->count();

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
     return view('front.buyable_content', compact('data', 'isfavourite', 'rating', 'average_rating', 'total_review', 'font', 'isFollowing', 'comment', 'like_count', 'dislike_count', 'islike', 'isdislike','paid_status'));
    }

    public function removeWebstoreComment($id)
    {
        $Comment = Paidcontentcomment::where('id', $id)->delete();
        return redirect()->back()->with('successful_message', 'Comment delete successfully.');
    }

    public function featuredchannel()
    {
        $AllFollowing = Follow::where('follow_by', Auth::user()->id)->get()->toArray();
        $AllFeaturedchannel = Featuredchannel::where('userid', Auth::user()->id)->get()->toArray();

        $AllUserData = array();
        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $followarray = array_values(array_unique(array_column($AllFollowing, 'follow_to')));
            $AllUserData = User::whereIn('id', $followarray)->whereNotIn('id', $featuredarray)->get()->toArray();
        }

        $UserData = array();
        if (isset($AllFeaturedchannel) && is_array($AllFeaturedchannel) && count($AllFeaturedchannel) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $UserData = User::whereIn('id', $featuredarray)->get()->toArray();
        }

        $myData = Auth::user()->toArray();
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.featuredchannel', compact('generalsetting', 'myData', 'AllUserData', 'UserData', 'font'));
    }

    public function custombg()
    {
        $myData = Auth::user()->toArray();
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.custombg', compact('generalsetting', 'advertisement', 'myData', 'font'));
    }

    public function monetizeupload()
    {
        return view('front.creator.monetizeupload');
    }

    public function creatorgallery($sort)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        if (isset($sort) && $sort == "new") {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->select('id', 'thumbnail')->orderBy('id', 'desc')->paginate(20);
        } elseif (isset($sort) && $sort == "old") {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->select('id', 'thumbnail')->orderBy('id', 'asc')->paginate(20);
        } else {
            $UsercontentData = Usercontent::where('userid', Auth::user()->id)->select('id', 'thumbnail')->paginate(20);
        }

        $myData = Auth::user()->toArray();
        return view('front.creator.featuredgallery', compact('font', 'UsercontentData', 'advertisement', 'myData'));
    }

    public function media(Request $request, $media_type)
    {
        $sort = $request->input('sort');

        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $query = Usercontent::where('userid', Auth::user()->id);
        if (isset($media_type) && $media_type !== "Random") {
            $query = $query->where('type', $media_type);
        }
        if ($sort === 'new') {
            $UsercontentData = $query->latest()->paginate(20);
        } else if ($sort === 'old') {
            $UsercontentData = $query->oldest()->paginate(20);
        } else if ($sort === 'random') {
            $UsercontentData = $query->inRandomOrder()->paginate(20);
        } else if ($sort === 'view') {
            $UsercontentData = $query->OrderBy('total_views', 'desc')->paginate(20);
        } else if ($sort === 'fav') {
            $query = $query->withCount('like');
            $UsercontentData = $query->orderByDesc('like_count')->paginate(20);
        } else {
            $UsercontentData = $query->paginate(20);
        }
        $myData = Auth::user()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });
        return view('front.creator.media', compact('UsercontentData', 'myData', 'font', 'advertisement', 'media_type'));
    }


    public function featuredgallery($sort)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $UsercontentData = array();
        $featuredData = Featuredcontent::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($featuredData) && is_array($featuredData) && count($featuredData) > 0) {
            $featuredData = array_column($featuredData, 'contentid');
            $query = Usercontent::whereIn('id', $featuredData)->select('id', 'thumbnail');
            if ($sort === 'new') {
                $UsercontentData = $query->latest()->paginate(20);
            } else if ($sort === 'old') {
                $UsercontentData = $query->oldest()->paginate(20);
            } else if ($sort === 'random') {
                $UsercontentData = $query->inRandomOrder()->paginate(20);
            } else if ($sort === 'view') {
                $UsercontentData = $query->OrderBy('total_views', 'desc')->paginate(20);
            } else {
                $UsercontentData = $query->paginate(20);
            }
        }

        $myData = Auth::user()->toArray();

        return view('front.creator.featuredgallery', compact('UsercontentData', 'advertisement', 'font', 'myData'));
    }

    public function contentdetail($id)
    {
        $theme = $this->themes('gallery_theme', 'green_theme');
        $totallike = Gallerylike::where('contentid', $id)->count();
        $totaldislike = Gallerydislike::where('contentid', $id)->count();
        if (Auth::check()) {
            $negative_setting = Option::where('user_id', Auth::id())->value('show_comments');

            $negative_content = false;
            if ($totaldislike > $totallike && $negative_setting == 1) {
                $negative_content = true;
            } else {
                $negative_content = false;
            }
        } else {
            $negative_content = false;
        }
        // $ratio = $totaldislike / ($totaldislike + $totallike) * 100;
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $UsercontentData = Usercontent::where('id', $id)->first();
        $isfavourite = 0;
        $isdislike = 0;
        $islike = 0;

        if (isset($UsercontentData)) {
            $commentData = Gallerycomment::where('contentid', $UsercontentData->id)->get()->toArray();
            if (isset($commentData) && is_array($commentData) && count($commentData) > 0) {
                foreach ($commentData as $commentDataK => $commentDataV) {
                    $UserData = User::where('id', $commentDataV['userid'])->first();
                    if(isset($UserData)){
                        $commentData[$commentDataK]['id'] = $UserData->id;
                        $commentData[$commentDataK]['username'] = $UserData->username;
                        $commentData[$commentDataK]['profile_pic'] = $UserData->profile_pic;
                        $commentData[$commentDataK]['is_owner'] = 0;
                    }
                    if (isset(Auth::user()->id) && $UsercontentData->userid == Auth::user()->id) {
                        $commentData[$commentDataK]['is_owner'] = 1;
                    }
                }
            }
            $UsercontentData['commentdata'] = $commentData;
            //$myPostdata[$myPostdataK]['likecount'] = $LIKECOUNT ;
            if (isset(Auth::user()->id)) {
                $isfavourite = Galleryfavorite::where('userid', Auth::user()->id)->where('contentid', $UsercontentData->id)->count();
                $isdislike = Gallerydislike::where('userid', Auth::user()->id)->where('contentid', $UsercontentData->id)->count();
                $islike = Gallerylike::where('userid', Auth::user()->id)->where('contentid', $UsercontentData->id)->count();

            }

            /* add & Update view */
            if (Auth::id()) {
                if (isset($_GET['page'])) {
                    $pageno = $_GET['page'];
                } else {
                    $pageno = 1;
                }

                if ($UsercontentData->userid == AUth::id()) {
                    $point = 0.005;
                } else {
                    $point = 0.01;
                }
                $this->OwnEarnPoint($UsercontentData->userid, $UsercontentData->id, 'own gallert content views', 0.005, $pageno, Auth::id());
                $this->PointInsert($UsercontentData->id, 'content details', 0.01, $pageno);

                $this->visitCount(Auth::id(), $UsercontentData->userid, url()->current());
            }

            $commentData = Gallerycomment::where('contentid', $id)->where('comment_parent_id', 0)->with(['user'])->orderBy('id', 'DESC')->paginate(5);

            // Reply to comment
            foreach($commentData as $comment) {
                $reply_data = Gallerycomment::where('contentid', $id)
                    ->where('comment_parent_id', $comment->id)
                    ->with(['user'])
                    ->get();
                $comment['reply_data'] = $reply_data;
            }


            $contentId = $id;
            $viewerId = Auth::user()->id;
            $userid = $UsercontentData->userid;

            if ($viewerId != $userid) {
                // Use updateOrCreate method to update or create a new Contentview record
                Contentview::updateOrCreate(
                    ['viewerid' => $viewerId, 'contentid' => $id],
                    ['userid' => $userid]
                );

                // Retrieve the total number of views for the content
                $totalViews = Contentview::where('contentid', $id)->count();

                // Update the total views of the Usercontent
                Usercontent::where('id', $id)->update(['total_views' => $totalViews]);
            }

            $sameauthor = Usercontent::where('userid', $UsercontentData->userid)->whereNotIn('id', [$UsercontentData->id])->orderBy('created_at', 'DESC')->limit(9)->get();
            $featuredcontent = Featuredcontent::select('contentid')->where('userid', $UsercontentData->userid)->get();
            $authorfeatured = Usercontent::whereIn('id', $featuredcontent)->whereNotIn('id', [$UsercontentData->id])->orderBy('created_at')->limit(4)->get();
            $relatedart = Usercontent::where('type', $UsercontentData->type)->whereNotIn('id', [$UsercontentData->id])->limit(4)->get();
            $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $UsercontentData->userid)->first();

        } else {
            $isFollowing = [];
            $relatedart = [];
            $authorfeatured = [];
            $sameauthor = [];
            $commentData = [];
            $userid = $viewerId = '';
        }


        /* end */
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });


        $rating = Usercontentrating::where('content_id', $id)->where('user_id', Auth::id())->first();
        $total_user_rating = 0;
        $total_user_rating = Usercontentrating::where('content_id', $id)->sum('rating');
        $total_review = Usercontentrating::where('content_id', $id)->count();
        if ($total_user_rating != 0) {
            $average_rating = $total_user_rating / $total_review;
            $average_rating = number_format((float)$average_rating, 0, '.', '');
        } else {
            $average_rating = 0;
            $total_review = 0;
        }
        return view(
            'front.creator.contentdetail',
            compact(
                'rating', 'average_rating', 'total_review', 'theme', 'isFollowing', 'negative_content', 'relatedart', 'authorfeatured', 'sameauthor',
                'commentData', 'advertisement', 'font', 'UsercontentData', 'userid', 'viewerId', 'islike', 'isfavourite', 'isdislike'
            )
        );
    }

    public function usercontentRatings(Request $request)
    {
        if (Auth::id()) {
            $rating = Usercontentrating::where('content_id', $request->content_id)->where('user_id', Auth::id())->first();
            if (!is_null($rating)) {
                $rating->rating = $request->rating;
                $rating->save();
            } else {
                $rating = new Usercontentrating;
                $rating->content_id = $request->content_id;
                $rating->rating = $request->rating;
                $rating->user_id = Auth::id();
                $rating->save();
            }

            $total_user_rating = 0;
            $total_user_rating = Usercontentrating::where('content_id', $request->content_id)->sum('rating');
            $total_review = Usercontentrating::where('content_id', $request->content_id)->count();
            if ($total_user_rating != 0) {
                $average_rating = $total_user_rating / $total_review;
                $average_rating = number_format((float)$average_rating, 0, '.', '');
            } else {
                $average_rating = 0;
                $total_review = 0;
            }

            $response = array('code' => 200, 'message' => 'Rating added successfully', 'average_rating' => $average_rating, 'total_review' => $total_review);
        } else {
            $response = array('code' => 422, 'message' => 'Are you not login, please first login');
        }
        return response()->json($response, 200);
    }

    /*public function userinfo($id)
    {
        $is_visitor = true;
        $myData = User::where('id', $id)->get()->toArray();
        $ActivityData = Activity::where('userid', $id)->get()->toArray();
        $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $id)->first();
        $AllFollower = Follow::where('follow_to', $id)->get()->toArray();
        $AllFollowing = Follow::where('follow_by', $id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        return view('front.profilevisitor.dashboard', compact('myData', 'is_visitor', 'id', 'isFollowing', 'AllFollower', 'AllFollowing', 'ActivityData'));
    }

    public function aboutus($id)
    {
        $is_visitor = true;
        $myData = User::where('id', $id)->get()->toArray();
        $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $id)->first();
        $AllFollower = Follow::where('follow_to', $id)->get()->toArray();
        $AllFollowing = Follow::where('follow_by', $id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }
        return view('front.profilevisitor.about', compact('myData', 'id', 'is_visitor', 'AllFollower', 'AllFollowing', 'isFollowing'));
    }

    public function updateabout(Request $request)
    {
        $this->validate($request, [
            'about' => 'required',]);

        $User = User::find(Auth::user()->id);
        $User->about = $request->about;
        $User->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return response()->json($response, 200);
    }

    public function profilepost($id)
    {
        $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $id)->first();
        $AllFollower = Follow::where('follow_to', $id)->get()->toArray();
        $AllFollowing = Follow::where('follow_by', $id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        $is_visitor = true;
        $myPostdata = Profilepost::where('userid', $id)->get()->toArray();
        if (isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0) {
            foreach ($myPostdata as $myPostdataK => $myPostdataV) {
                $likecount = Like::where('postid', $myPostdataV['id'])->count();
                $commentData = Comment::where('postid', $myPostdataV['id'])->get()->toArray();
                if (isset($commentData) && is_array($commentData) && count($commentData) > 0) {
                    foreach ($commentData as $commentDataK => $commentDataV) {
                        $UserData = User::where('id', $commentDataV['userid'])->get()->toArray();
                        $commentData[$commentDataK]['username'] = $UserData[0]['username'];
                    }
                }
                $myPostdata[$myPostdataK]['commentdata'] = $commentData;
                $myPostdata[$myPostdataK]['likecount'] = $likecount;
            }
        }
        $myData = User::where('id', $id)->get()->toArray();
        return view('front.profilevisitor.profilepost', compact('myPostdata', 'myData', 'is_visitor', 'id', 'AllFollower', 'AllFollowing', 'isFollowing'));
    }

    public function follow($id)
    {
        $Follow = new Follow();
        $Follow->follow_by = Auth::user()->id;
        $Follow->follow_to = $id;
        $Follow->save();

        $myData = Auth::user()->toArray();
        $Activity = new Activity();
        $Activity->userid = $id;
        $Activity->content = $myData['username'] . " started following you";
        $Activity->save();

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        $this->addpoint(Auth::user()->id, 1, "Added for follow");
        return redirect()->back();
    }

    public function unfollow($id)
    {
        $Follow = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $id)->delete();
        $myData = Auth::user()->toArray();
        $Activity = new Activity();
        $Activity->userid = $id;
        $Activity->content = $myData['username'] . " un-followed you";
        $Activity->save();
        return redirect()->back();
    }

    public function info($id)
    {
        $is_visitor = true;
        $myData = User::where('id', $id)->get()->toArray();
        $isFollowing = Follow::where('follow_by', Auth::user()->id)->where('follow_to', $id)->first();
        $AllFollower = Follow::where('follow_to', $id)->get()->toArray();
        $AllFollowing = Follow::where('follow_by', $id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            foreach ($AllFollower as $AllFollowerK => $AllFollowerV) {
                $UserData = User::where('id', $AllFollowerV['follow_by'])->get()->toArray();
                $AllFollower[$AllFollowerK]['username'] = $UserData[0]['username'];
                $AllFollower[$AllFollowerK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        if (isset($AllFollowing) && is_array($AllFollowing) && count($AllFollowing) > 0) {
            foreach ($AllFollowing as $AllFollowingK => $AllFollowingV) {
                $UserData = User::where('id', $AllFollowingV['follow_to'])->get()->toArray();
                $AllFollowing[$AllFollowingK]['username'] = $UserData[0]['username'];
                $AllFollowing[$AllFollowingK]['profile_pic'] = $UserData[0]['profile_pic'];
            }
        }

        return view('front.profilevisitor.info', compact('myData', 'id', 'is_visitor', 'AllFollower', 'AllFollowing', 'isFollowing'));
    }

    public function addcomment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'postid' => 'required',]);

        $Comment = new Comment();
        $Comment->userid = Auth::user()->id;
        $Comment->postid = $request->postid;
        $Comment->comment = $request->comment;
        $Comment->save();

        $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];

        return response()->json($response, 200);
    }

    public function like($id)
    {
        $Like = new Like();
        $Like->userid = Auth::user()->id;
        $Like->postid = $id;
        $Like->save();

        return redirect()->back();
    } */

    public function uploadmonetize(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'price' => 'required',
        ]);

        $Creatorcontent = new Creatorcontent();
        $Creatorcontent->title = $request->title;
        $Creatorcontent->description = $request->description;
        $Creatorcontent->tags = $request->tags;
        $Creatorcontent->price = $request->price;
        $Creatorcontent->userid = $request->userid;

        if ($request->file('content')) {
            $file = $request->file('content');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('creatorcontent'), $filename);
            $Creatorcontent->content = $filename;
            $Creatorcontent->type = $file->getClientOriginalExtension();
        }

        if ($request->file('thumbnail')) {
            $Creatorcontent->thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'creatorthumbnail');
        }
        $Creatorcontent->save();
        $this->addpoint(Auth::user()->id, 50, "Added for webstore  content");
        return back()->with(['successful_message' => 'Content updated successfully']);
    }

    public function journal()
    {
        $JournalData = Journal::where('userid', Auth::user()->id)->get()->toArray();
        $myData = Auth::user()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.journal', compact('generalsetting', 'JournalData', 'myData', 'font', 'advertisement'));
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

    public function updateGalleryComment(Request $request){

        $galleryComment=Gallerycomment::findorFail($request->comment_id);

        $galleryComment->comment= $request->comment;
        $galleryComment->save();
        $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];
        return response()->json($response, 200);
    }
    public function addgallerycomment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'contentid' => 'required',
        ]);

        $Gallerycomment = new Gallerycomment();
        $Gallerycomment->userid = Auth::user()->id;
        $Gallerycomment->contentid = $request->contentid;
        $Gallerycomment->comment = $request->comment;
        if ($request->has('comment_id')) {
            $Gallerycomment->comment_parent_id = $request->comment_id;
        }
        $Gallerycomment->save();

        $usercontent = Usercontent::where('id', $request->contentid)->first();
        $notificationGallaryOption = NotificationPrivacyOption::where('user_id', $usercontent->userid)->pluck('gallary_notification')->first();
        $notificationGallaryOption = json_decode($notificationGallaryOption);
        if (isset($notificationGallaryOption) && in_array('dislike', $notificationGallaryOption)) {
            $this->NotificationInsert(
                Auth::id(),             // sender id
                $usercontent->userid,   // recover id
                $request->contentid,    // content id
                'comment',              // notification type
                Auth::user()->username . ' comment on your gallery content',
                'usercontent',          // notification type
                0,                      // status [0 = unread, 1 = read]
            );
        }

        if (Auth::id()) {
            $this->OwnEarnPoint($usercontent->userid, $usercontent->id, 'own gallery content comment', 0.02, 1, Auth::id());
            $this->PointInsert($usercontent->id, 'gallery content comment', 1, 1);
        }

        $response = [
            'code' => 200,
            'message' => "Comment Added successfully"
        ];
        return response()->json($response, 200);
    }

    public function removegallerycomment($id)
    {
        $Comment = Gallerycomment::where('id', $id)->delete();
        Gallerycomment::where('comment_parent_id', $id)->delete();
        return redirect()->back();
    }

    public function markgalleryfavorite($id)
    {
        $usercontent = Usercontent::where('id', $id)->first();
        $isfavourite = Galleryfavorite::where('userid', Auth::user()->id)->where('contentid', $id)->get()->toArray();
        if (isset($isfavourite) && is_array($isfavourite) && count($isfavourite) > 0) {
            Galleryfavorite::where('userid', Auth::user()->id)->where('contentid', $id)->delete();
        } else {
            $Galleryfavorite = new Galleryfavorite();
            $Galleryfavorite->userid = Auth::user()->id;
            $Galleryfavorite->contentid = $id;
            $Galleryfavorite->save();

            if (Auth::id()) {
                $this->OwnEarnPoint($usercontent->userid, $usercontent->id, 'own gallery content favorite', 0.2, 1, Auth::id());
                $this->PointInsert($usercontent->id, 'gallery content favorite', 0.5, 1);
            }
        }

        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function contentlike($id, $status)
    {
        if ($status == 'like') {
            $isdislike = Gallerydislike::where('userid', Auth::id())->where('contentid', $id)->first();
            if (isset($isdislike) && $isdislike != null) {
                $isdislike->delete();
            }
            $this->marklike($id);
            return redirect()->back();
        } else if ($status == 'unlike') {
            $islike = Gallerylike::where('userid', Auth::user()->id)->where('contentid', $id)->first();
            if (isset($islike) && $islike != null) {
                $islike->delete();
            }
            $this->markdislike($id);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function markdislike($id)
    {
        if (Gallerylike::where('userid', Auth::user()->id)->where('contentid', $id)->exists()) {
            Gallerylike::where('userid', Auth::user()->id)->where('contentid', $id)->delete();
        }

        $usercontent = Usercontent::where('id', $id)->first();
        $isdislike = Gallerydislike::where('userid', Auth::user()->id)->where('contentid', $id)->get()->toArray();
        if (isset($isdislike) && is_array($isdislike) && count($isdislike) > 0) {
            Gallerydislike::where('userid', Auth::user()->id)->where('contentid', $id)->delete();
        } else {
            $Gallerydislike = new Gallerydislike();
            $Gallerydislike->userid = Auth::user()->id;
            $Gallerydislike->contentid = $id;
            $Gallerydislike->save();

            $notificationGallaryOption = NotificationPrivacyOption::where('user_id', $usercontent->userid)->pluck('gallary_notification')->first();
            $notificationGallaryOption = json_decode($notificationGallaryOption);
            if (isset($notificationGallaryOption) && in_array('dislike', $notificationGallaryOption)) {
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $usercontent->userid,   // recover id
                    $id,                    // content id
                    'dislike',              // notification type
                    Auth::user()->username . ' dislike on your gallery content',
                    'usercontent',          // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }
            if (Auth::id()) {
                $this->PointInsert($usercontent->id, 'gallery content dislike', 0.5, 1);
            }
        }
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function marklike($id)
    {
        if (Gallerydislike::where('userid', Auth::user()->id)->where('contentid', $id)->exists()) {
            Gallerydislike::where('userid', Auth::user()->id)->where('contentid', $id)->delete();
        }

        $islike = Gallerylike::where('userid', Auth::user()->id)->where('contentid', $id)->get()->toArray();
        $notificationGallaryOption = NotificationPrivacyOption::where('user_id', Auth::user()->id)->pluck('gallary_notification')->first();
        $usercontent = Usercontent::where('id', $id)->first();

        $notificationGallaryOption = NotificationPrivacyOption::where('user_id', $usercontent->userid)->pluck('gallary_notification')->first();
        $notificationGallaryOption = json_decode($notificationGallaryOption);

        $user_id = Auth::user()->id;
        if (isset($islike) && is_array($islike) && count($islike) > 0) {
            Gallerylike::where('userid', Auth::user()->id)->where('contentid', $id)->delete();
        } else {
            $Gallerylike = new Gallerylike();
            $Gallerylike->userid = Auth::user()->id;
            $Gallerylike->contentid = $id;
            $Gallerylike->save();

            if (isset($notificationGallaryOption) && in_array('like', $notificationGallaryOption)) {
                $this->NotificationInsert(
                    Auth::id(),             // sender id
                    $usercontent->userid,   // recover id
                    $id,                    // content id
                    'like',                 // notification type
                    Auth::user()->username . ' like on your gallery content',
                    'usercontent',          // notification type
                    0,                      // status [0 = unread, 1 = read]
                );
            }
            if (Auth::id()) {
                $this->PointInsert($usercontent->id, 'gallery content likes', 0.5, 1);
                $this->OwnEarnPoint($usercontent->userid, $usercontent->id, 'own gallery content likes', 0.05, 1, Auth::id());
            }
        }
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function community()
    {
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $myPostdata = Profilepost::where('userid', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        if (isset($myPostdata) && is_array($myPostdata) && count($myPostdata) > 0) {
            foreach ($myPostdata as $myPostdataK => $myPostdataV) {
                $commentData = Comment::where('postid', $myPostdataV['id'])->where('comment_parent_id', 0)->get()->toArray();
                $likecount = Like::where('postid', $myPostdataV['id'])->count();
                if (isset($commentData) && is_array($commentData) && count($commentData) > 0) {
                    foreach ($commentData as $commentDataK => $commentDataV) {
                        $UserData = User::where('id', $commentDataV['userid'])->value('username');
                        $commentData[$commentDataK]['username'] = $UserData;

                        // Reply to data
                        $reply_data = Comment::join('users', 'users.id', '=', 'comments.userid')
                            ->where('postid', $myPostdataV['id'])
                            ->where('comment_parent_id', $commentDataV['id'])
                            ->select('comments.*', 'username')
                            ->get();
                        $commentData[$commentDataK]['reply_data'] = $reply_data;
                    }
                }
                $myPostdata[$myPostdataK]['commentdata'] = $commentData;
                $myPostdata[$myPostdataK]['likecount'] = $likecount;
            }
        }

        $myData = Auth::user()->toArray();
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.community', compact('generalsetting', 'myPostdata', 'myData', 'advertisement', 'font'));
    }

    public function groupfavourite()
    {
        $Galleryfavorite = Galleryfavorite::where('userid', Auth::user()->id)->get()->toArray();
        $UsercontentData = array();
        $GroupcontentData = array();
        $FollowingcontentData = array();
        if (isset($Galleryfavorite) && is_array($Galleryfavorite) && count($Galleryfavorite) > 0) {
            $Galleryfavorite = array_column($Galleryfavorite, 'contentid');
            $UsercontentData = Usercontent::whereIn('id', $Galleryfavorite)->get()->toArray();
        }
        $myData = Auth::user()->toArray();

        $AllFollower = Follow::where('follow_to', Auth::user()->id)->get()->toArray();
        if (isset($AllFollower) && is_array($AllFollower) && count($AllFollower) > 0) {
            $AllFollower = array_column($AllFollower, 'follow_by');
            $GroupcontentData = Usercontent::whereIn('userid', $AllFollower)->get()->toArray();
        }


        $AllFeaturedchannel = Featuredchannel::where('userid', Auth::user()->id)->get()->toArray();
        $UserData = array();
        if (isset($AllFeaturedchannel) && is_array($AllFeaturedchannel) && count($AllFeaturedchannel) > 0) {
            $featuredarray = array_values(array_unique(array_column($AllFeaturedchannel, 'contentid')));
            $FollowingcontentData = User::whereIn('id', $featuredarray)->get()->toArray();
        }
        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.groupfavourite', compact('generalsetting', 'advertisement', 'UsercontentData', 'myData', 'GroupcontentData', 'FollowingcontentData', 'font'));
    }

    public function collection()
    {
        $UsercontentData = array();
        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();
        if (isset($Owncollaction) && is_array($Owncollaction) && count($Owncollaction) > 0) {
            foreach ($Owncollaction as $OwncollactionK => $OwncollactionV) {
                $contentarray = json_decode($OwncollactionV['contentids'], true);
                $Owncollaction[$OwncollactionK]['contentData'] = Usercontent::select('thumbnail', 'id')->whereIn('id', $contentarray)->get()->toArray();
            }
        }

        $myData = Auth::user()->toArray();
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;
        return view('front.creator.collection', compact('generalsetting', 'Owncollaction', 'myData', 'font'));
    }

    public function deleteCollection($id)
    {

        Owncollaction::where('userid', Auth::user()->id)->where('id',$id)->delete();
        return redirect()->route('creatorupload');

    }
    public function deleteFeatureContent($id)
    {

        Featuredcontent::where('userid', Auth::user()->id)->where('contentid',$id)->delete();
        return redirect()->route('creatorupload');

    }
    public function deleteFeatureCollection($id)
    {

        Owncollaction::where('userid', Auth::user()->id)
        ->update([
            'featured' => 0,
        ]);
        return redirect()->route('creatorupload');
    }
    public function deleteFeatureChannels($id)
    {
        Featuredchannel::where('userid', Auth::user()->id)->where('contentid',$id)->delete();

        return redirect()->route('creatorupload');

    }

    public function deleteFavCollections($id)
    {

        Favouritecollection::where('userid', Auth::user()->id)->where('id',$id)->delete();

        return redirect()->route('creatorupload');

    }

    public function Myvault()
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $carts = Cart::where('paid_status', '1')->where('user_id', Auth::user()->id)->pluck('id');

        $CreatorcontentData = CartItem::with('paidcontent')->whereIn('cart_id', $carts)->get();
        $theme = $this->themes('others_theme', 'red_theme');

        return view('front.other_page.vault', compact('theme', 'CreatorcontentData', 'font'));
    }

    public function myvaultcontent($id){
        $data = Paidcontent::where('id', $id)->first();
        return view('front.other_page.vault_content', compact('data'));
    }

    public function vaultlike($id)
    {
        $this->paidcontentlike($id);
        return redirect()->back();
    }

    public function vaultdislike($id)
    {
        $this->paidcontentdislike($id);
        return redirect()->back();
    }
    public function productPaidStatus($id){
        $paid_status=0;
        $paid_carts=Cart::select('id')->where('user_id',Auth::id())->where('paid_status',1)->get()->toArray();

        if(!empty($paid_carts)){
            $paid_content_ids=CartItem::select('paidcontent_id')->whereIn('cart_id',$paid_carts)->get()->toArray();
            $paid_content_ids_array=array();
            foreach($paid_content_ids as $paid_content_id){
                array_push($paid_content_ids_array,$paid_content_id['paidcontent_id']);
            }

            if(in_array($id,$paid_content_ids_array)){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
           return 0;
        }
    }
    public function paidcontentdislike($id, $comment_id)
    {
        $type=Paidcontentcomment::where('id',$comment_id)->select('type')->first();

         if($type->type=="reviews" ){
            if(!$this->productPaidStatus($id)){
                return redirect()->back()->withErrors(['Only person who bought the product can dislike the review']);
            }
         }
        $islike = Paidcontentlike::where('userid', Auth::id())->where('paidcontentid', $id)->where('comment_id', $comment_id)->first();
        if (isset($islike) && $islike != null) {
            $islike->delete();
        }

        $paidcontent = Paidcontent::where('id', $id)->first();
        $isdislike = Paidcontentdislike::where('userid', Auth::user()->id)->where('paidcontentid', $id)->where('comment_id', $comment_id)->get()->toArray();
        if (isset($isdislike) && is_array($isdislike) && count($isdislike) > 0) {
            Paidcontentdislike::where('userid', Auth::user()->id)->where('paidcontentid', $id)->delete();
        } else {
            $Paidcontentdislike = new Paidcontentdislike();
            $Paidcontentdislike->userid = Auth::user()->id;
            $Paidcontentdislike->paidcontentid = $id;
            $Paidcontentdislike->comment_id = $comment_id;
            $Paidcontentdislike->save();


            $this->NotificationInsert(
                Auth::id(),             // sender id
                $paidcontent->user_id,   // receiver id
                $id,                    // content id
                'dislike',              // notification type
                Auth::user()->username . ' dislike on your store content',
                'storecontent',          // notification type
                0,                      // status [0 = unread, 1 = read]
            );

        }
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }

    public function paidcontentlike($id, $comment_id)
    {
        $type=Paidcontentcomment::where('id',$comment_id)->select('type')->first();

        if($type->type=="reviews" ){
           if(!$this->productPaidStatus($id)){
               return redirect()->back()->withErrors(['Only person who bought the product can like the review']);
           }
        }
        $isdislike = Paidcontentdislike::where('userid', Auth::user()->id)->where('paidcontentid', $id)->where('comment_id', $comment_id)->first();
        if (isset($isdislike) && $isdislike != null) {
            $isdislike->delete();
        }

        $islike = Paidcontentlike::where('userid', Auth::user()->id)->where('paidcontentid', $id)->where('comment_id', $comment_id)->get()->toArray();
        $paidcontent = paidcontent::where('id', $id)->first();

        $user_id = Auth::user()->id;
        if (isset($islike) && is_array($islike) && count($islike) > 0) {
            Paidcontentlike::where('userid', Auth::user()->id)->where('paidcontentid', $id)->delete();
        } else {
            $Paidcontentlike = new Paidcontentlike();
            $Paidcontentlike->userid = Auth::user()->id;
            $Paidcontentlike->paidcontentid = $id;
            $Paidcontentlike->comment_id = $comment_id;
            $Paidcontentlike->save();

            $this->NotificationInsert(
                Auth::id(),             // sender id
                $paidcontent->user_id,   // receiver id
                $id,                    // content id
                'like',                 // notification type
                Auth::user()->username . ' like on your store content',
                'storecontent',          // notification type
                0,                      // status [0 = unread, 1 = read]
            );

        }
        $response = [
            'code' => 200,
            'message' => "Data updated successfully"
        ];
        return redirect()->back();
    }



    public function downloadFile($file)
    {
        $myFile = public_path("content/" . $file);
        $headers = ['Content-Type: application/pdf'];
        $newName = $file;
        return response()->download($myFile, $newName, $headers);
    }



    public function editContent(Request $request)
    {
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $UsercontentData = Usercontent::where('userid', Auth::user()->id)->latest()->paginate(20);

        $myData = Auth::user()->toArray();

        $advertisement = Cache::remember('advertisement', $this->cache_time, function () {
            return Advertisement::where('status', '=', 1)->first();
        });

      return view('front.creator.edit-content', compact('UsercontentData', 'myData', 'font', 'advertisement'));
    }

    public function deleteContent(Request $request)
    {
        $this->validate($request, [
            'content_id' => 'required'
        ]);

        Usercontent::where('id', $request->content_id)->delete();

        return redirect()->back()->with(['successful_message' => 'Content deleted successfully.']);
    }

    public function showContent(Request $request)
    {
        $user_content_data = Usercontent::where('id',$request->content_id)->first();
        $tags = explode(',', $user_content_data->tags);

        $Owncollaction = Owncollaction::where('userid', Auth::user()->id)->get()->toArray();
        $TagData = Tag::get()->toArray();
        $themes = 'green_theme';
        $myData = Auth::user()->toArray();
        $generalsetting = Option::where('user_id', Auth::id())->first();
        $font = $generalsetting ? $generalsetting->preffered_font : null;

        return view('front.creator.content.edit-content', compact('user_content_data', 'tags', 'themes', 'Owncollaction', 'TagData', 'themes', 'font', 'myData', 'generalsetting'));
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
    public function updateContent(Request $request)
    {
        $validationRules = [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'type' => 'required',
            'category' => 'required',
            // 'content' => 'file|mimes:jpeg,jfif,png,jpg,gif,svg,mp4,mkv,flv,avi,mp3,wav,pdf,txt,docx,doc,rtf,odt|max:1000000', // Max 1 GB
            // 'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1000000', // Max 1 GB
            'content_type' => 'required',
        ];

        $validationMessages = [];
        // if (env('APP_ENV') == 'production') {
        //     $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
        //     $validationMessages = ['g-recaptcha-response.required' => 'The recaptcha field is required.'];
        // }

        $validatedData = $request->validate($validationRules, $validationMessages);

        try {
            // Tag Create
            $tag_array = [];
            foreach ($request->tags as $tag) {

                if (!is_numeric($tag)) {
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

            Usercontent::where('id', $request->content_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'tags' => implode(",", $tag_array),
                'series' => $request->series ? implode(",", $request->series) : '',
                'type' => implode(",", $request->type),
                'category' => implode(",", $request->category),
                'userid' => Auth::user()->id,
                'monetise' => $request->monetise,
                'content_type' => $request->content_type,
                'original_video_url'=>$request->video_url
            ]);

            if ($request->video_url) {

                $url = $request->video_url;

                if (strstr($url, "youtu.be") || strstr($url, "youtube")) {
                    $video_id = $this->getYouTubeVideoId($url);
                    if(isset($video_id)){
                        $embed_url = "https://www.youtube.com/embed/" . $video_id;
                        $video_url = $embed_url;
                    }

                } elseif (strstr($url, "pornhub")) {
                    $video_id = $this->getViewKey($url);
                    if(isset($video_id)){
                        $embed_url = "https://www.pornhub.com/embed/" . $video_id;
                        $video_url = $embed_url;
                    }
                } elseif (strstr($url, "xvideos")) {
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
                        $video_url= $embed_url;
                    }

                } elseif (strstr($url, "deviantart")) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    $htmlContent = curl_exec($ch);

                    if ($htmlContent === false) {
                        $error = curl_error($ch);
                    } else {
                        $pattern = '<video.*?src=[\'"](.*?)[\'"].*?>';
                        preg_match_all($pattern, $htmlContent, $matches);
                        $embed_url =  $matches[1][0];
                        $video_url = $embed_url;
                    }
                }

                Usercontent::where('id', $request->content_id)->update([
                    'video_url' => $video_url,
                ]);
            }

            // if ($request->file('content')) {
            //     $file = $request->file('content');
            //     $filename = time() . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('content'), $filename);
            //     $content = $filename;
            //     Usercontent::where('id', $request->content_id)->update([
            //         'content' => $content,
            //     ]);
            // }

            // if ($request->file('thumbnail')) {
            //     $thumbnail = $this->uploadImageFile($request->file('thumbnail'), 'thumbnail');
            //     Usercontent::where('id', $request->content_id)->update([
            //         'thumbnail' => $thumbnail,
            //     ]);
            // }

            if ($request->filled('content_file_name')) {
                Usercontent::where('id', $request->content_id)->update([
                    'content' => $request->content_file_name,
                ]);
            }
            $type=implode(",",$request->type);

            if ($request->filled('thumbnail_file_name')) {
                Usercontent::where('id', $request->content_id)->update([
                    'thumbnail' => $request->thumbnail_file_name,
                ]);
            }
             elseif($type=="Picture"){
                Usercontent::where('id', $request->content_id)->update([
                    'thumbnail' =>$request->content_file_name,
                ]);
            }
            elseif($type=="Audio" || $type=="Literature" || $type=="Comic" || $type=="Interactive"){
                Usercontent::where('id', $request->content_id)->update([
                    'thumbnail' =>"default-image.jpg",
                ]);
            }
            else{
                Usercontent::where('id', $request->content_id)->update([
                    'thumbnail' => $request->thumbnail_file_name,
                ]);
            }

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
                        $request->content_id,       // content id
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
                $this->PointInsert($request->content_id, 'gallery content upload', 10, 1);
            }
            $this->addpoint(Auth::user()->id, 10, "Added for post comment");
            //return back()->with(['successful_message' => 'Content updated successfully']);
            return json_encode(array('result' => 'success', 'msg' => 'Content updated successfully'));

        } catch (\Exception $e) {
            return json_encode(array('result' => 'error', 'error_msg' => $e->getMessage()));
        }
    }
}
