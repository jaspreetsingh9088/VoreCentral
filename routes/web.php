<?php

use App\Http\Controllers\Admin\CreatorsAdminController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\EmployeeAdminController;
use App\Http\Controllers\Admin\RoleAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\SubscriptionAdminController;
use App\Http\Controllers\Admin\CmsAdminController;
use App\Http\Controllers\Admin\SectionAdminController;
use App\Http\Controllers\Admin\ForumAdminController;
use App\Http\Controllers\Admin\NewsarchiveAdminController;
use App\Http\Controllers\Admin\ForumthreadAdminController;
use App\Http\Controllers\Admin\{ForumheadingAdminController, AdvertisementAdminController};
use App\Http\Controllers\Admin\{CreatorWiseVisitorAdminController,
    GallaryAdminController,
    DashboardAdminController,
    VisitorAdminController
};
use App\Http\Controllers\Admin\PurchasedContentController;
use App\Http\Controllers\Admin\ProfileAdminController;


use App\Http\Controllers\Front\AboutusController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\{ForumController, CartController};
use App\Http\Controllers\Front\OptionController;
use App\Http\Controllers\Front\MessageController;


use App\Http\Controllers\Front\JournalController;

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\AchievementController;
use App\Http\Controllers\Front\CreatorController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\CreatorvisiterController;
use App\Http\Controllers\Front\SettingController;
use App\Http\Controllers\Front\PersonalMessageController;
use App\Http\Controllers\Front\MiscellanousController;
use App\Http\Controllers\Front\DLCContentController;

use App\Http\Controllers\Admin\RevenueAdminController;
use App\Http\Controllers\DBController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PayPalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::middleware(['auth'])->group(function () {
// ====================================== DLC ==============================================================
    Route::get('/dlc', [DLCContentController::class, 'dlc'])->name('dlc');
    Route::get('/dlc-type/{sort}', [DLCContentController::class, 'dlcFilter'])->name('dlc.type');
    Route::get('/dlcupload', [DLCContentController::class, 'dlcupload'])->name('dlcupload');
    Route::post('/uploaddlccontent', [DLCContentController::class, 'uploaddlccontent'])->name('uploaddlccontent');
    Route::get('donwload-dlcfile/{file}', [DLCContentController::class, 'downloaddlcFile'])->name('downloaddlcFile');
    Route::get('/likedlc/{id}', [DLCContentController::class, 'likedlc'])->name('likedlc');
    Route::get('/dislikedlc/{id}', [DLCContentController::class, 'dislikedlc'])->name('dislikedlc');
    // ====================================== DLC ==============================================================

    // ====================================== PM Pages =========================================================
    Route::get('/pm', [PersonalMessageController::class, 'pminbox'])->name('pm')->middleware('is_signin');
    Route::get('/send-message', [PersonalMessageController::class, 'pmsendmessageinbox'])->name('pmsendmessage')->middleware('is_signin');
    Route::get('/newpm', [PersonalMessageController::class, 'newpm'])->name('newpm')->middleware('is_signin');
    Route::get('/send-message/{id}', [PersonalMessageController::class, 'sendMsgtoUser'])->name('sendMsgtoUser')->middleware('is_signin');
    Route::post('/sendmsg', [PersonalMessageController::class, 'sendmsg'])->name('sendmsg')->middleware('is_signin');
    Route::get('/msgDraft', [PersonalMessageController::class, 'msgDraft'])->name('msgDraft')->middleware('is_signin');
    Route::get('/pmfriends', [PersonalMessageController::class, 'pmfriends'])->name('pmfriends')->middleware('is_signin');
    Route::get('/pmdraft', [PersonalMessageController::class, 'pmdraft'])->name('pmdraft')->middleware('is_signin');
    Route::get('/pminbox_message_view/{id}', [PersonalMessageController::class, 'pminbox_message_view'])->name('pminbox_message_view')->middleware('is_signin');
    Route::get('/pminbox', [PersonalMessageController::class, 'pminbox'])->name('pminbox')->middleware('is_signin');
    // ====================================== Pm Pages =========================================================

    // ====================================== Miscellanous Pages =========================================================
    Route::get('/onlineuser', [MiscellanousController::class, 'index'])->name('onlineuser');
    Route::get('/onlineuser-search', [MiscellanousController::class, 'onlineuserSearch'])->name('onlineuser.search');
    Route::GET('/aboutus', [MiscellanousController::class, 'aboutus'])->name('aboutus');
    Route::GET('/ourstaff', [MiscellanousController::class, 'ourstaff'])->name('ourstaff');
    Route::GET('/news_archieve', [MiscellanousController::class, 'news_archieve'])->name('news_archieve');
    Route::get('/news_archieve/{id}', [MiscellanousController::class, 'news_detail'])->name('news_detail');
    Route::get('/contactus', [MiscellanousController::class, 'contactus'])->name('contactus');
    Route::post('/contactus-mail', [MiscellanousController::class, 'contactusMail'])->name('contactus-mail');
    Route::get('/content-promoted-produced', [MiscellanousController::class, 'contentPromotedProduced'])->name('content.promoted.produced');
    Route::get('/creator-information-monetisation', [MiscellanousController::class, 'creatorInformationMonetisation'])->name('creator.information.monetisation');
    Route::get('/helpandsupport', [MiscellanousController::class, 'helpandsupport'])->name('helpandsupport');
    Route::get('/information-different-subject', [MiscellanousController::class, 'informationDifferentSubject'])->name('information.different.subject');
    Route::get('/privacypolicy', [MiscellanousController::class, 'privacypolicy'])->name('privacypolicy');
    Route::get('/term-and-service', [MiscellanousController::class, 'termsservice'])->name('termsservice');
    Route::get('/send-mail', [MiscellanousController::class, 'sendPersonalData'])->name('sendmail')->middleware('is_signin');
    // ====================================== Miscellanous Pages =========================================================

    // ====================================== Setting Pages ==============================================================
    Route::get('/general_setting', [SettingController::class, 'generalSetting'])->name('generalSetting')->middleware('is_signin');
    Route::post('/general_setting', [SettingController::class, 'generalSettingstore'])->name('generalSettingstore')->middleware('is_signin');
    Route::get('/theme_option', [SettingController::class, 'themeOption'])->name('themeOption')->middleware('is_signin');
    Route::post('/theme_option', [SettingController::class, 'themeOptionStore'])->name('themeOptionStore')->middleware('is_signin');
    Route::get('/social_option', [SettingController::class, 'socialOption'])->name('socialOption')->middleware('is_signin');
    Route::get('/search_sorting', [SettingController::class, 'searchSorting'])->name('search.sorting')->middleware('is_signin');
    Route::post('/search-sorting', [SettingController::class, 'searchSortingStore'])->name('search.sorting.store')->middleware('is_signin');
    Route::post('/stripe-card-store', [SettingController::class, 'stripeCardStore'])->name('stripe.card.store')->middleware('is_signin');
    Route::get('/stripe-card-delete/{id}', [SettingController::class, 'stripeCardDelete'])->name('stripe.card.delete')->middleware('is_signin');
    Route::get('/tag_option', [SettingController::class, 'tagOption'])->name('tagOption')->middleware('is_signin');
    Route::post('/tag_option', [SettingController::class, 'tagOptionStore'])->name('tagOptionStore')->middleware('is_signin');
    Route::post('/tag-dropdown', [SettingController::class, 'tagDropdown'])->name('tag.drop.down')->middleware('is_signin');
    Route::get('/technical_option', [SettingController::class, 'technicalOption'])->name('technicalOption')->middleware('is_signin');
    Route::get('/searchuser', [SettingController::class, 'searchuser'])->name('search.user')->middleware('is_signin');
    Route::get('/search-block-user', [SettingController::class, 'searchBlockUser'])->name('search.block.user')->middleware('is_signin');
    Route::get('/block-user/{id}', [SettingController::class, 'blockUser'])->name('block.user')->middleware('is_signin');
    Route::get('/unblock-user/{id}', [SettingController::class, 'unblockUser'])->name('unblock.user')->middleware('is_signin');
    Route::get('/notification_option', [SettingController::class, 'notificationOption'])->name('notificationOption')->middleware('is_signin');
    Route::post('/notification_option', [SettingController::class, 'notificationOptionStore'])->name('notificationOptionStore')->middleware('is_signin');
    Route::get('/achievements', [SettingController::class, 'achievementOption'])->name('achievement.index')->middleware('is_signin');
    Route::post('/achievements-store', [SettingController::class, 'achievementStore'])->name('achievement.store')->middleware('is_signin');
    Route::post('/update-password', [AuthController::class, 'update_password'])->name('update.password')->middleware('is_signin');
    // ====================================== Setting Pages ==============================================================

    // ====================================== Forum Pages ==============================================================
    Route::get('/forum', [ForumController::class, 'forumcategory'])->name('forum');
    Route::get('/forum-search', [ForumController::class, 'forumSearch'])->name('forum.search');
    Route::get('/forum-category-search', [ForumController::class, 'forumcategorySearch'])->name('forum.category.search')->middleware('is_signin');
    Route::get('/thread/{id}/{offset}', [ForumController::class, 'index'])->name('thread');
    Route::get('/thread/{id}/{offset}/search', [ForumController::class, 'threadSearch'])->name('thread.search')->middleware('is_signin');
    Route::post('/createthread', [ForumController::class, 'createthread'])->name('createthread')->middleware('is_signin');
    Route::get('/threaddetail/{id}/{offset}', [ForumController::class, 'threaddetail'])->name('threaddetail');
    Route::post('/quotesmessage', [ForumController::class, 'quotesmessage'])->name('quotesmessage')->middleware('is_signin');
    Route::get('/thread-comment-like/{id}', [ForumController::class, 'threadCommentLike'])->name('thread.comment.like')->middleware('is_signin');
    Route::get('/thread-comment-dilike/{id}', [ForumController::class, 'threadCommentDislike'])->name('thread.comment.dislike')->middleware('is_signin');
    Route::post('/addthreadcomment', [ForumController::class, 'addthreadcomment'])->name('addthreadcomment')->middleware('is_signin');
    Route::get('/mytopics', [ForumController::class, 'mytopics'])->name('mytopics')->middleware('is_signin')->middleware('is_signin');
    Route::get('/mytopics-search', [ForumController::class, 'mytopicsSearch'])->name('mytopics.search')->middleware('is_signin')->middleware('is_signin');
    // ====================================== Forum Pages ==============================================================
    // ================================== PROFILE VISITOR ==============================================================================
    Route::get('{id}/dashboard', [ProfileController::class, 'userinfo'])->name('profiledashboard')->middleware('is_signin')->middleware('blockuser');
    Route::get('/gallery/prioritise-popularity/{id}', [ProfileController::class, 'prioritisePopularity'])->name('visitores.gallery.prioritisePopularity')->middleware('is_signin')->middleware('blockuser');
    Route::get('/gallery/prioritise-tags/{id}', [ProfileController::class, 'prioritiseTags'])->name('visitores.gallery.prioritiseTags')->middleware('is_signin')->middleware('blockuser');
    Route::get('/gallery/relevancy/{id}', [ProfileController::class, 'relevancy'])->name('visitores.gallery.relevancy')->middleware('is_signin')->middleware('blockuser');
    Route::get('/gallery/recency/{id}', [ProfileController::class, 'recency'])->name('visitores.gallery.recency')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/profilepost', [ProfileController::class, 'profilepost'])->name('profileprofilepost')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/about', [ProfileController::class, 'aboutus'])->name('profileabout')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/rpstatus', [ProfileController::class, 'rpstatus'])->name('profilerpstatus')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/journal', [ProfileController::class, 'journal'])->name('profilejournal')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/info', [ProfileController::class, 'info'])->name('profileinfo')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/like', [ProfileController::class, 'like'])->name('profilelike')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/gallery/{sort}', [ProfileController::class, 'gallery'])->name('profilegallery')->middleware('is_signin')->middleware('blockuser');
    Route::get('/featuredgallery/{id}/{sort}', [ProfileController::class, 'featuredgallery'])->name('featuredgallery')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/favoriteartwork', [ProfileController::class, 'favoriteartwork'])->name('profilefavoriteartwork')->middleware('is_signin')->middleware('blockuser');
    Route::get('/media/{id}/{sort}', [ProfileController::class, 'media'])->name('profile.visitore.media')->middleware('is_signin')->middleware('blockuser');
    // ================================== PROFILE VISITOR ==============================================================================

    // ================================== CREATOR VISITER ======================================================================
    Route::get('/{id}/creatordashboard', [CreatorvisiterController::class, 'dashboard'])->name('creatorvisitordashboard')->middleware('is_signin');
    Route::get('/{id}/creatorwebstore', [CreatorvisiterController::class, 'creatorwebstore'])->name('creatorvisitorwebstore')->middleware('is_signin')->middleware('blockuser');
    Route::get('{id}/gallery/{sort}', [CreatorvisiterController::class, 'gallery'])->name('creator.gallery')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/creatorupload', [CreatorvisiterController::class, 'creatorupload'])->name('creatorvisitorupload')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/monetizeupload', [CreatorvisiterController::class, 'monetizeupload'])->name('monetizevisitorupload')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/media/{sort}', [CreatorvisiterController::class, 'media'])->name('creator.visitore.media')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/creatorgallery/{sort}/{order?}', [CreatorvisiterController::class, 'creatorgallery'])->name('creatorvisitorgallery')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/usergallery/{sort}/{order?}', [CreatorvisiterController::class, 'usergallery'])->name('usergallery')->middleware('is_signin')->middleware('blockuser');

    Route::get('/{id}/collection', [CreatorvisiterController::class, 'collection'])->name('creator.visitor.collection')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/contentdetail/{cid}', [CreatorvisiterController::class, 'contentdetail'])->name('contentvisitordetail')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/creatorjournal', [CreatorvisiterController::class, 'journal'])->name('creatorvisitorjournal')->middleware('is_signin')->middleware('blockuser');
    Route::post('/{id}/creatorjournal', [CreatorvisiterController::class, 'addjournal'])->name('creatorvisitorcreatejournal')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/webstoredetail/{iid}', [CreatorvisiterController::class, 'webstoredetail'])->name('visitorwebstoredetail')->middleware('is_signin')->middleware('blockuser');
    Route::post('/{id}/addgallerycomment', [CreatorvisiterController::class, 'addgallerycomment'])->name('visitoraddgallerycomment')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/community', [CreatorvisiterController::class, 'community'])->name('creatorvisiter.community')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/markgalleryfavorite/{iid}', [CreatorvisiterController::class, 'markgalleryfavorite'])->name('markgalleryfavorite')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/groupfavourite', [CreatorvisiterController::class, 'groupfavourite'])->name('creatorvisiter.groupfavourite')->middleware('is_signin')->middleware('blockuser');
    Route::get('/{id}/featuredgallery/{sort}', [CreatorvisiterController::class, 'featuredgallery'])->name('creatorvisiter.featuredgallery')->middleware('is_signin')->middleware('blockuser');
    Route::get('/delete-comment', [CreatorvisiterController::class, 'deleteComment'])->name('delete-comment')->middleware('is_signin');
    // ================================== CREATOR  VISITOR ==============================================================
    Route::get('/user-not-login/{segment}', [UserController::class, 'usernotlogin'])->name('user.not.login');
    // Route::POST('/general_setting_save', [UserController::class, 'generalSettingSave'])->name('general.setting.save')->middleware('is_signin');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index')->middleware('is_signin');
    Route::get('/update-notification-status', [NotificationController::class, 'updateStatus'])->name('notifications.update')->middleware('is_signin');

    Route::get('/', [DashboardController::class, 'home'])->name('home');
    Route::get('/content-search', [DashboardController::class, 'contentSearch'])->name('content.search');
    Route::get('/contentpromoted', [DashboardController::class, 'contentpromoted'])->name('contentpromoted');

    Route::view('/activity', 'front.user.activity')->name('activity')->middleware('is_signin');
    Route::get('/gallery/{sort}', [UserController::class, 'gallery'])->name('gallery')->middleware('is_signin');
    Route::get('/publicgallery/relevancy', [UserController::class, 'publicgallery'])->name('publicgallery');

    Route::get('/favoriteartwork', [UserController::class, 'favoriteartwork'])->name('favoriteartwork');
    Route::post('/get_project_cat', [UserController::class, 'projectCat'])->name('projectcat');

    Route::get('/delete-collection/{id}', [CreatorController::class, 'deleteCollection'])->name('delete.collection')->middleware('is_signin');
    Route::get('/delete-feature-content/{id}', [CreatorController::class, 'deleteFeatureContent'])->name('delete.feature.content')->middleware('is_signin');
    Route::get('/delete-feature-collection/{id}', [CreatorController::class, 'deleteFeatureCollection'])->name('delete.feature.collection')->middleware('is_signin');
    Route::get('/delete-feature-channels/{id}', [CreatorController::class, 'deleteFeatureChannels'])->name('delete.feature.channels')->middleware('is_signin');
    Route::get('/delete-fav-collections/{id}', [CreatorController::class, 'deleteFavCollections'])->name('delete.fav.collections')->middleware('is_signin');

    Route::get('/subscription/{offset}', [UserController::class, 'subscription'])->name('subscription')->middleware('is_signin');

    Route::get('/creator', [CreatorController::class, 'createview'])->name('creator');
    Route::post('/creator', [CreatorController::class, 'create'])->name('creatorpost');
    Route::post('/updateprofilepic', [AuthController::class, 'updateprofilepic'])->name('updateprofilepic');
    Route::post('/updatecoverpic', [AuthController::class, 'updatecoverpic'])->name('updatecoverpic');
    Route::post('/updatethemebg', [AuthController::class, 'updatethemebg'])->name('updatethemebg');
    Route::get('/remove-picture', [AuthController::class, 'removePicture'])->name('remove-picture');

    Route::post('/upload-content-file', [UserController::class, 'uploadContentFile'])->name('upload-content-file')->middleware('is_signin');
    Route::post('/upload-thumbnail-file', [UserController::class, 'uploadThumbnailFile'])->name('upload-thumbnail-file')->middleware('is_signin');

    Route::get('/userupload', [UserController::class, 'userupload'])->name('userupload')->middleware('is_signin');
    Route::post('/uploadcontent', [UserController::class, 'uploadcontent'])->name('uploadcontent')->middleware('is_signin');
    Route::get('/creatorcontentupload', [CreatorController::class, 'creatorcontentupload'])->name('creator.content.upload')->middleware('is_signin','is_creator');
    Route::get('/creatordlcupload', [CreatorController::class, 'creatordlcupload'])->name('creator.dlc.upload')->middleware('is_signin','is_creator');
    Route::post('/uploadmonetize', [CreatorController::class, 'uploadmonetize'])->name('uploadmonetize')->middleware('is_signin');
    Route::get('/webstore-manage-content', [CreatorController::class, 'webstoreManageContent'])->name('webstore.manage.content')->middleware('is_creator','is_signin');
    Route::get('/paid-content-edit/{id}', [CreatorController::class, 'paidContentEdit'])->name('paid.content.edit')->middleware('is_signin');
    Route::post('/update-paidcontent/{id}', [CreatorController::class, 'updatePaidContent'])->name('update.paidcontent')->middleware('is_signin');
    Route::post('/webstore-content-delete', [CreatorController::class, 'webstoreContentDelete'])->name('webstore.content.delete')->middleware('is_signin');
    Route::post('/webstore-content-collection', [CreatorController::class, 'webstoreContentCollection'])->name('webstore.content.collection')->middleware('is_signin');

    Route::get('/dashboard', [UserController::class, 'userinfo'])->name('dashboard');
    Route::get('/profilepost', [UserController::class, 'profilepost'])->name('profilepost')->middleware('is_signin');
    Route::post('/addpost', [UserController::class, 'addpost'])->name('addpost')->middleware('is_signin');
    Route::get('/about', [UserController::class, 'aboutus'])->name('about')->middleware('is_signin');
    Route::post('/about', [UserController::class, 'updateabout'])->name('updateabout')->middleware('is_signin');
    Route::get('/rpstatus', [UserController::class, 'rpstatus'])->name('rpstatus')->middleware('is_signin');
    Route::post('/rpstatus', [UserController::class, 'updaterpstatus'])->name('updaterpstatus');
    Route::get('/journal', [UserController::class, 'journal'])->name('journal')->middleware('is_signin');
    Route::post('/journal', [UserController::class, 'addjournal'])->name('createjournal')->middleware('is_signin');
    Route::get('/info', [UserController::class, 'info'])->name('info')->middleware('is_signin');

    Route::post('/rpstatus', [UserController::class, 'updaterpstatus'])->name('updaterpstatus');
    Route::post('/rpstatus', [UserController::class, 'updaterpstatus'])->name('updaterpstatus');
    Route::post('/journal', [UserController::class, 'addjournal'])->name('createjournal');
    Route::post('/addcomment', [ProfileController::class, 'addcomment'])->name('addcomment');
    Route::get('/removecomment/{id}', [ProfileController::class, 'removecomment'])->name('removecomment');
    Route::get('/follow/{id}', [ProfileController::class, 'follow'])->name('follow')->middleware('is_signin');
    Route::get('/unfollow/{id}', [ProfileController::class, 'unfollow'])->name('unfollow')->middleware('is_signin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/creatordashboard', [CreatorController::class, 'dashboard'])->name('creatordashboard')->middleware('is_creator');

    // Route::get('/send-message', [CreatorController::class, 'pmsendmessageinbox'])->name('pmsendmessage');
    // Route::get('/sendmsg/{id}', [CreatorController::class, 'sendmsguser'])->name('sendmsguser');

    Route::get('/creatorwebstore', [CreatorController::class, 'creatorwebstore'])->name('creatorwebstore')->middleware('is_signin','is_creator');
    Route::get('/creatorupload', [CreatorController::class, 'creatorupload'])->name('creatorupload')->middleware('is_signin');
    Route::get('/monetizeupload', [CreatorController::class, 'monetizeupload'])->name('monetizeupload');
    Route::get('/creatorgallery/{sort}', [CreatorController::class, 'creatorgallery'])->name('creatorgallery')->middleware('is_signin','is_creator');
    Route::get('/contentdetail/{id}', [CreatorController::class, 'contentdetail'])->name('contentdetail')->middleware('is_signin');
    Route::post('/usercontent-ratings', [CreatorController::class, 'usercontentRatings'])->name('usercontent.ratings')->middleware('is_signin');
    Route::get('/creatorjournal', [CreatorController::class, 'journal'])->name('creatorjournal')->middleware('is_signin','is_creator');
    Route::post('/creatorjournal', [CreatorController::class, 'addjournal'])->name('creatorcreatejournal')->middleware('is_signin','is_creator');
    Route::get('/webstoredetail/{id}', [CreatorController::class, 'webstoredetail'])->name('webstoredetail');
    Route::post('/paid-content-comment/{id}', [CreatorController::class, 'paidContentComment'])->name('paid.content.comment')->middleware('is_signin');
    Route::get('/remove-webstore-comment/{id}', [CreatorController::class, 'removeWebstoreComment'])->name('remove.webstore.comment')->middleware('is_signin');
    Route::post('/addgallerycomment', [CreatorController::class, 'addgallerycomment'])->name('addgallerycomment')->middleware('is_signin');
    Route::post('/updategallerycomment', [CreatorController::class, 'updateGalleryComment'])->name('updateGalleryComment')->middleware('is_signin');
    Route::get('/removegallerycomment/{id}', [CreatorController::class, 'removegallerycomment'])->name('removegallerycomment')->middleware('is_signin');
    Route::get('/featuredgallery/{sort}', [CreatorController::class, 'featuredgallery'])->name('creator.featuredgallery')->middleware('is_signin','is_creator');
    Route::get('/collection', [CreatorController::class, 'collection'])->name('collection')->middleware('is_signin','is_creator');

    // Creator Edit Content
    Route::get('/edit-content', [CreatorController::class, 'editContent'])->name('edit-content')->middleware('is_signin');
    Route::get('/content-delete', [CreatorController::class, 'deleteContent'])->name('content-delete')->middleware('is_signin');
    Route::get('/content-show', [CreatorController::class, 'showContent'])->name('content-show')->middleware('is_signin');
    Route::post('/update-content', [CreatorController::class, 'updateContent'])->name('update-content')->middleware('is_signin');


    Route::get('/media/{media_type}', [CreatorController::class, 'media'])->name('media')->middleware('is_signin','is_creator');

    Route::get('/myvault', [CreatorController::class, 'myvault'])->name('myvault')->middleware('is_signin');
    Route::get('/myvaultcontent/{id}', [CreatorController::class, 'myvaultcontent'])->name('myvaultcontent')->middleware('is_signin');
    Route::get('/vaultlike/{id}', [CreatorController::class, 'vaultlike'])->name('vaultlike');
    Route::get('/vaultdislike/{id}', [CreatorController::class, 'vaultdislike'])->name('vaultdislike');
    Route::get('/download-file/{file}', [CreatorController::class, 'downloadFile']);

    Route::post('/createowncollaction', [CreatorController::class, 'createowncollaction'])->name('createowncollaction');
    Route::post('/featuredcontents', [CreatorController::class, 'featuredcontents'])->name('featuredcontents');
    Route::post('/featuredcollection', [CreatorController::class, 'featuredcollection'])->name('featuredcollection');
    Route::post('/favroitecollection', [CreatorController::class, 'favroitecollection'])->name('favroitecollection');
    Route::post('/singlefeaturedcontents', [CreatorController::class, 'singlefeaturedcontents'])->name('singlefeaturedcontents');
    Route::get('/removesinglefeaturedcontents', [CreatorController::class, 'removesinglefeaturedcontents'])->name('removesinglefeaturedcontents');
    Route::post('/setfeaturedchannel', [CreatorController::class, 'setfeaturedchannel'])->name('setfeaturedchannel');
    Route::get('/featuredchannel', [CreatorController::class, 'featuredchannel'])->name('featuredchannel')->middleware('is_creator');
    Route::get('/custombg', [CreatorController::class, 'custombg'])->name('custombg')->middleware('is_creator');

    Route::get('/markgalleryfavorite/{id}', [CreatorController::class, 'markgalleryfavorite'])->name('creator.markgalleryfavorite')->middleware('is_signin');
    Route::get('/markdislike/{id}', [CreatorController::class, 'markdislike'])->name('markdislike')->middleware('is_signin');
    Route::get('/contentlike/{id}/{status}', [CreatorController::class, 'contentlike'])->name('contentlike')->middleware('is_signin');
    Route::get('/marklike/{id}', [CreatorController::class, 'marklike'])->name('marklike')->middleware('is_signin');
    Route::get('community', [CreatorController::class, 'community'])->name('community')->middleware('is_signin','is_creator');

    Route::get('/groupfavourite', [CreatorController::class, 'groupfavourite'])->name('groupfavourite')->middleware('is_signin','is_creator');

    /* filter Routes */
    Route::get('/publicgallery/literatures', [UserController::class, 'getFilterData'])->name('publicgallery.literatures');
    Route::get('/publicgallery/videos', [UserController::class, 'getFilterData'])->name('publicgallery.videos');
    Route::get('/publicgallery/{media}/{sort}', [UserController::class, 'getFilterData'])->name('publicgallery.pictures');
    // Route::get('/publicgallery/pictures', [UserController::class, 'getFilterData'])->name('publicgallery.pictures');
    Route::get('/publicgallery/audios', [UserController::class, 'getFilterData'])->name('publicgallery.audios');
    Route::get('/publicgallery/games', [UserController::class, 'getFilterData'])->name('publicgallery.games');
    Route::get('/publicgallery/comics', [UserController::class, 'getFilterData'])->name('publicgallery.comics');
    Route::get('/publicgallery/filter-results', [UserController::class, 'filterResults'])->name('publicgallery.filRes');
    /* Gallery Search */

    Route::get('/publicgallery/search', [UserController::class, 'gallerySerach'])->name('publicgallery.gallerySerach');
    Route::post('/publicgallery/search/ajax', [UserController::class, 'gallerySerachAjax'])->name('publicgallery.gallerySerach.ajax');
    Route::get('/publicgallery/recency', [UserController::class, 'recency'])->name('publicgallery.recency');
    Route::get('/publicgallery/prioritise-popularity', [UserController::class, 'prioritisePopularity'])->name('publicgallery.prioritisePopularity');
    Route::get('/publicgallery/prioritise-tags', [UserController::class, 'prioritiseTags'])->name('publicgallery.prioritiseTags');
    Route::get('/publicgallery', [UserController::class, 'featured'])->name('publicgallery.featured');
    Route::get('/publicgallery-latest', [UserController::class, 'featured'])->name('publicgallery.latest');
    Route::get('/publicgallery/random', [UserController::class, 'randomGallery'])->name('publicgallery.random');
    Route::get('/publicgallery/creators', [UserController::class, 'creatorsGallery'])->name('publicgallery.creators');
    Route::get('/publicgallery/search-creators', [UserController::class, 'searchCreator'])->name('publicgallery.searchCreator');
    Route::get('/public-gallery/delete/{id}', [UserController::class, 'deleteUserContent'])->name('deleteContent');
    Route::get('/publicstore', [UserController::class, 'publicstore'])->name('publicstore');
    Route::get('/publicstore/new', [UserController::class, 'publicstore'])->name('publicstore.new');
    Route::get('/publicstore/search-result', [UserController::class, 'publicstoreSearch'])->name('publicstore.search');

    Route::get('/publicstore/upload', [UserController::class, 'storeUpload'])->name('webStoremonetizeupload')->middleware('is_signin','is_creator');
    Route::post('/ratings', [UserController::class, 'ratings'])->name('ratings');
    Route::post('/save-monetize-upload', [UserController::class, 'saveMonetizeUpload'])->name('saveStoreUpload')->middleware('is_creator');
    Route::get('/browsecreator', [UserController::class, 'browsecreator'])->name('browsecreator');
    Route::get('/publicstore/random', [UserController::class, 'random'])->name('random');

    Route::get('/buyablecontent/{id}', [UserController::class, 'buyablecontent'])->name('buyablecontent')->middleware('is_signin');
    Route::get('/buyablecontentlike/{id}/{commentid}', [CreatorController::class, 'paidcontentlike'])->name('buyablecontentlike')->middleware('is_signin');
    Route::get('/buyablecontentdislike/{id}/{commentid}', [CreatorController::class, 'paidcontentdislike'])->name('buyablecontentdislike')->middleware('is_signin');
// });

Route::get('/login', [AuthController::class, 'loginget'])->name('login');
Route::get('/signup', [AuthController::class, 'signupview'])->name('signupview');
Route::post('/login', [AuthController::class, 'login'])->name('loginpost');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Route::get('/visitor-not-login', [UserController::class, 'visitornotlogin'])->name('visitor.not.login');


//add all auth required route in below group
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('checkout.index');
    Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order_success');
    Route::post('remove-item', [CartController::class, 'removeItem'])->name('removeItem');
    Route::get('getCartItems', [CartController::class, 'getCartItems'])->name('getCartItems');
});


Route::group([ 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AuthAdminController::class, 'index']);
    Route::post('/login', [AuthAdminController::class, 'login'])->name('login');
    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin', 'adminpermissions'])->group(function () {
        Route::get('admindashboard', [DashboardAdminController::class, 'dashboard'])->name('admindashboard');

        Route::resource('creators', CreatorsAdminController::class)->except('create');
        Route::resource('forumthread', ForumthreadAdminController::class)->except('update');

        Route::resources([
            'users' => UserAdminController::class,
            // 'creators' => CreatorsAdminController::class,
            'tags' => TagAdminController::class,
            'subscription' => SubscriptionAdminController::class,
            'roles' => RoleAdminController::class,
            'cms' => CmsAdminController::class,
            'section' => SectionAdminController::class,
            'employees' => EmployeeAdminController::class,
            'revenue' => RevenueAdminController::class,
            'forumcategory' => ForumAdminController::class,
            'galary' => GallaryAdminController::class,
            'advertisement' => AdvertisementAdminController::class,
            'forumheading' => ForumheadingAdminController::class,
            'newsarchive' => NewsarchiveAdminController::class,
            // 'forumthread' => ForumthreadAdminController::class,
            'visitors' => VisitorAdminController::class,
            "creator-wise-visitors" => CreatorWiseVisitorAdminController::class,
            'profile' => ProfileAdminController::class
        ]);


        Route::post('profile/change-password', [ProfileAdminController::class, 'changePassword'])->name('profile.change.password');

        Route::get('purchased-content', [PurchasedContentController::class, 'index'])->name('purchasedcontent.index');

        Route::get('creators/create/{id}', [CreatorsAdminController::class, 'create'])->name('creators.create');
        Route::get('creators/make/{id}', [CreatorsAdminController::class, 'makeCreator'])->name('creators.make');
        Route::get('forumthread/delete/{id}', [ForumthreadAdminController::class, 'destroy'])->name('forumthread.delete');
        Route::get('forumthread/status/{id}/{status}', [ForumthreadAdminController::class, 'update'])->name('forumthread.updatestatus');
        Route::post('forumthread/update/{id}/{status}', [ForumthreadAdminController::class, 'update'])->name('forumthread.update');
        Route::get('newsarchive/delete/{id}', [NewsarchiveAdminController::class, 'destroy'])->name('newsarchive.delete');
        Route::get('galary/delete/{id}', [GallaryAdminController::class, 'destroy'])->name('gallerycontent.delete');
        Route::get('forumcategory/delete/{id}', [ForumAdminController::class, 'destroy'])->name('forumcategory.delete');
        Route::get('forumheading/delete/{id}', [ForumheadingAdminController::class, 'delete'])->name('forumheading.delete');
        // Route::resource('newsarchive', NewsarchiveAdminController::class);

        //Route::get('cms/showaddform', [CmsAdminController::class, 'ShowAddForm'])->name('cms.create');
        //Route::get('sectioncms/{id}', [SectionAdminController::class, 'createsectioncms'])->name('section.createsectioncms');
        Route::post('roles/{role}/visible_tabs', [RoleAdminController::class, 'VisibleTab'])->name('roles.visibletabs');
        Route::GET('section/addsection/{id}', [SectionAdminController::class, 'addsection'])->name('addsection');
        Route::GET('subscription/status/{id}/{status}', [SubscriptionAdminController::class, 'updatestatus'])->name('subscription.updatestatus');
        Route::GET('advertisement/status/{id}/{status}', [AdvertisementAdminController::class, 'updatestatus'])->name('advertisement.updatestatus');
        Route::GET('galary/status/{id}/{status}', [GallaryAdminController::class, 'updatestatus'])->name('galary.updatestatus');
        Route::GET('creators/status/{id}/{status}', [CreatorsAdminController::class, 'updatestatus'])->name('creators.updatestatus');
        Route::GET('users/status/{id}/{status}', [UserAdminController::class, 'updatestatus'])->name('users.updatestatus');
    });
});

Route::get('/8888', [AuthAdminController::class, 'index'])->middleware('trustedAccess');

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return 'Config cache cleared';
});

Route::group([
    'prefix' => 'db',
], function () {
    // Database Migration
    Route::get('/migrate', [DBController::class, 'migrate']);
    Route::get('/migrate-fresh', [DBController::class, 'migrateFresh']);
    Route::get('/migrate-rollback', [DBController::class, 'migrateRollback']);
    Route::get('/seed', [DBController::class, 'seed']);
    Route::get('/seed/{class}', [DBController::class, 'seedClass']);
});


Route::post('paypal/order', [PayPalController::class, 'createOrder']);
Route::post('paypal/capture', [PayPalController::class, 'captureOrder']);