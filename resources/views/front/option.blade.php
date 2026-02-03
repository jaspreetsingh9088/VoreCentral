
<!DOCTYPE html>

<html lang="en">

   <head>

        <title>Option</title>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
                content="Welcome to VoreCentral! We aim to be the prime location to visit for discovering and experiencing, and interacting with human pred vore. For this purpose, you may have a look at our Forum for interactions and community-building, have a look in the Webstore for purchasing items from our many talented creators, or, probably most importantly, view the Gallery where a catalogue of free to view vore-artwork of unmatched quality awaits you. We offer vore media in the form of litterature, images, even video, and, which we would like to promote also audio as we believe it to be quite an underrated avenue for experiencing vore-content. So, we hope you have a fantastic time browsing our site, and... most importanly try not to get eaten!">
        <link rel="icon" href="{{asset('assets/images/favicon.png')}}" sizes="32x32" />
        <link rel="stylesheet" href="assets/css/style-1.css">

        <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.min.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   </head>

   <body class="blue_theme bg_pattern">

      <header id="header" class="equal-menus">

         <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">

               <div class="navbar-top">

                  <div class="d-flex justify-content-between align-items-center">

                     <div>

                        <a class="navbar-brand" href="{{route('optionindex')}}">OPTION</a>

                     </div>
                     <span class="noti-icon">
                          <a href="#" class=""><img src="assets/images/notification.png" alt=""></a>
                      </span>
                  </div>

               </div>

               <div class="navbar-bottom">

                  <div class="">

                     <div>

                        <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="navbar-collapse collapse" id="navbarSupportedContent">

                           <ul class="navbar-nav mx-auto nav-justify text-center w-100">

                              <li>

                                 <button class="navbar-close">

                                 <img src="{{ url('public/assets/images/close.png') }}" alt="">

                                 </button>

                              </li>

                              <li class="nav-item active">

                                <a class="nav-link" href="{{ route('home') }}">Home</a>

                              </li>

                              <li class="nav-item">

                                <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>

                              </li>

                              <li class="nav-item">

                                <a class="nav-link" href="{{route('forum')}}">Forums</a>

                              </li>

                              <li class="nav-item">

                                <a class="nav-link" href="{{ URL('subscription/1') }}">MY ARTISTS</a>

                              </li>

                              <li class="nav-item">

                                <a class="nav-link" href="{{route('myvault')}}">Purchased Content</a>

                              </li>
                              @if (Auth::check())
                                  @if(Auth::user()->creator == 0)
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{URL('/dashboard')}}">My page</a>
                                      </li>
                                  @elseif(Auth::user()->creator == 1)
                                      <li class="nav-item">
                                          <a class="nav-link" href="{{URL('/creatordashboard')}}">Creator Dashboard</a>
                                      </li>
                                  @endif
                                  <li class="nav-item">
                                     <a class="nav-link" href="{{ route('mytopics') }}">MY TOPICS</a>
                                  </li>
                              @endif

                           </ul>

                        </div>

                     </div>

                  </div>

               </div>

            </nav>

         </div>

      </header>

      <!-- secondary header-->

        <div class="option_theme secondary_header mt-5">

            <div class="container">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">

                    <div class="container">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="navbar-collapse collapse justify-content-start" id="navbar10">

                            <ul class="navbar-nav nav-fill w-100">

                                <li class="nav-item"><a class="nav-link" href="{{route('optionindex')}}">General</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Sorting and search settings</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Tag settings</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Notifications and Privacy</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Technical settings etc</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Theme Settings</a></li>

                                <li class="nav-item"><a class="nav-link" href="#">Social</a></li>

                            </ul>

                        </div>

                    </div>

                </nav>

            </div>

        </div>

      <!-- main content start -->

      <section class="viewhistory-wrapper">

        <div class="container-fluid">

                       <div class="row">


              <div class="col-lg-1">

              </div>

              <div class="col-lg-10">

                 <div class="view_history-outer p-0 m-0">

                    <div class="news_archieve_wrapper general_warp">

                     <form method="post" action="https://employeyarena.com/vore1/public/themesetting">
                         <input type="hidden" name="_token" value="sbe8x1Og0FwZMLOfm8oiFhsCwZm3JhHvCJRFKkHt">                        <div class="row">

                          <div class="col-lg-6">

                                <div class="news_archieve_odd privacy_box">

                                   <div class="src_sort_box">

                                       <div class="row">

                                           <div class="col-lg-6">

                                                <h4>Preferred Font</h4>

                                           </div>

                                           <div class="col-lg-6">

                                                   <select name="preffered_font" style="width:100%;" required>

                                                           <option  value="Arial, sans-serif">Arial (sans-serif)</option>
                                                           <option  value="Verdana, sans-serif">Verdana (sans-serif)</option>
                                                           <option  value="Tahoma, sans-serif">Tahoma (sans-serif)</option>
                                                           <option  value="'Trebuchet MS', sans-serif">Trebuchet MS (sans-serif)</option>
                                                           <option  value="'Times New Roman', serif">Times New Roman (serif)</option>
                                                           <option  value="Georgia, serif">Georgia (serif)</option>
                                                           <option  value="Garamond, serif">Garamond (serif)</option>
                                                           <option  value="'Courier New', monospace">Courier New (monospace)</option>
                                                           <option  value="'Brush Script MT', cursive">Brush Script MT (cursive)</option>


                                                       </select>

                                           </div>

                                       </div>

                                   </div>

                                </div>

                          </div>
                           <div class="col-lg-6">

                              <div class="news_archieve_odd privacy_box">

                                   <div class="src_sort_box">

                                        <h4>General Privacy</h4>

                                        <div class="">



                                            <div class="form-group">

                                               <input type="checkbox" name="general_privacy[]" id="default130" >

                                               <label for="default130">Show vorerole preference</label>

                                            </div>

                                             <div class="form-group">

                                               <input type="checkbox" name="general_privacy[]" id="default210"  >

                                               <label for="default210">Show gender</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="checkbox" name="general_privacy[]" id="pritag220"  >

                                               <label for="pritag220">Show orientation</label>

                                             </div>



                                         </div>

                                    </div>

                                </div>

                          </div>


                       </div>

                       <!-- row ends-->

                       <div class="row">

                          <div class="col-lg-6">

                               <div class="news_archieve_even privacy_box">

                                   <div class="src_sort_box">

                                       <div class="row">

                                           <div class="col-lg-6">

                                               <h4>Timezone</h4>

                                           </div>

                                           <div class="col-lg-6">
                                           <select name="timezone" style="width:100%;" required>
                                           <option  value="ANAT">ANAT</option>
                                           <option  value="AEST">AEST</option>
                                           <option  value="JST">JST</option>
                                           <option  value="CST">CST</option>
                                           <option  value="WIB">WIB</option>
                                           <option  value="BST">BST</option>
                                           <option  value="UZT">UZT</option>
                                           <option  value="GST">GST</option>
                                           <option  value="MSK">MSK</option>
                                           <option  value="CEST">CEST</option>
                                           <option  value="BST">BST</option>
                                           <option  value="GMT">GMT</option>
                                           <option  value="CVT">CVT</option>
                                           <option  value="WGST">WGST</option>
                                           <option  value="ART">ART</option>
                                           <option  value="EDT">EDT</option>
                                           <option  value="CDT">CDT</option>
                                           <option  value="CST">CST</option>
                                           <option  value="PDT">PDT</option>
                                           <option  value="AKDT">AKDT</option>
                                           <option  value="HDT">HDT</option>
                                           <option  value="HST">HST</option>
                                           <option  value="NUT">NUT</option>
                                           <option  value="AoE">AoE</option>
                                           </select>
                                           </div>

                                       </div>

                                   </div>

                               </div>

                           </div>

                           <div class="col-lg-6">

                              <div class="news_archieve_even privacy_box">

                                   <div class="src_sort_box">

                                        <h4>Gender</h4>

                                        <div class="">



                                            <div class="form-group">

                                               <input type="radio" id="fmale" name="gender" value="female" >

                                               <label for="fmale">Female</label>

                                            </div>

                                             <div class="form-group">

                                               <input type="radio" id="male" name="gender" value="male" >

                                               <label for="male">Male</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="other" name="gender" value="other" >

                                               <label for="other">Other</label>

                                             </div>



                                         </div>

                                    </div>

                                </div>

                          </div>

                       </div>

                       <!-- row ends-->

                       <div class="row">

                          <div class="col-lg-6">

                                <div class="news_archieve_odd privacy_box">

                                    <div class="src_sort_box">

                                       <div class="row">

                                            <div class="col-lg-12">

                                               <h4>Change Email</h4>

                                           </div>

                                            <div class="col-lg-12">

                                                <div class="form-group mt-4">
                                                   <div class="row">
                                                   <div class="col-lg-4">
                                                       <h4 class="remove_space">Enter New Email</h4>
                                                   </div>
                                                       <div class="col-lg-8">
                                                       <input type="email" name="change_email" class="change_email" value="">
                                                       </div>
                                                   </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                          </div>
                           <div class="col-lg-6">

                              <div class="news_archieve_odd privacy_box">

                                   <div class="src_sort_box">

                                        <h4>Sexual Orientation</h4>

                                        <div class="">



                                            <div class="form-group">

                                               <input type="radio" id="s1" name="sexual_orientation" value="Heterosexual" >

                                               <label for="s1">Heterosexual</label>

                                            </div>

                                             <div class="form-group">

                                               <input type="radio" id="s2" name="sexual_orientation" value="Homosexual" >

                                               <label for="s2">Homosexual</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="s3" name="sexual_orientation" value="Bisexual" >

                                               <label for="s3">Bisexual</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="s4" name="sexual_orientation" value="Other" >

                                               <label for="s4">Other</label>

                                             </div>



                                         </div>

                                    </div>

                                </div>

                          </div>

                       </div>

                       <!-- row ends-->

                        <div class="row">

                          <div class="col-lg-6">

                                <div class="news_archieve_even privacy_box">

                                    <div class="src_sort_box">

                                       <div class="row">

                                           <div class="col-lg-10">

                                               <h4>Show comments/posts with a negative like/dislike ratio</h4>

                                           </div>

                                           <div class="col-lg-2 text-right">

                                               <div class="mt-4">

                                                        <div class="form-group">

                                                           <input type="checkbox" name="show_comments"  id="default10">

                                                           <label for="default10"></label>

                                                        </div>

                                               </div>

                                           </div>

                                       </div>

                                    </div>

                                </div>

                          </div>

                          <div class="col-lg-6">

                              <div class="news_archieve_even privacy_box">

                                   <div class="src_sort_box">

                                        <h4>Vore role preference</h4>

                                        <div class="">



                                            <div class="form-group">

                                               <input type="radio" id="s11" name="vore_role_preference" value="Pred" >

                                               <label for="s11">Pred</label>

                                            </div>

                                             <div class="form-group">

                                               <input type="radio" id="s12" name="vore_role_preference" value="Prey" >

                                               <label for="s12">Prey</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="s13" name="vore_role_preference" value="Switch" >

                                               <label for="s13">Switch</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="s14" name="vore_role_preference" value="Observer"  >

                                               <label for="s14">Observer</label>

                                             </div>

                                             <div class="form-group">

                                               <input type="radio" id="s15" name="vore_role_preference" value="Other" >

                                               <label for="s15">Other</label>

                                             </div>



                                         </div>

                                    </div>

                                </div>

                          </div>

                       </div>

                       <!-- row ends-->

                        <div class="row">

                          <div class="col-lg-6">

                                <div class="news_archieve_odd privacy_box">

                                    <div class="src_sort_box">

                                        <div class="row">

                                           <div class="col-lg-10">

                                               <h4>Creator Pages Custom Themes</h4>

                                           </div>

                                           <div class="col-lg-2 text-right">

                                               <div class="mt-4">



                                                        <div class="form-group">

                                                           <input type="checkbox" name="creator_pages_custom_theme	"  id="default11">

                                                           <label for="default11"></label>

                                                        </div>



                                               </div>

                                           </div>

                                        </div>

                                    </div>

                                </div>

                          </div>

                          <div class="col-lg-6">

                                <div class="news_archieve_odd privacy_box">

                                    <div class="src_sort_box">

                                        <div class="row">

                                           <div class="col-lg-6">

                                               <h4>Cursor Style</h4>

                                           </div>

                                          <div class="col-lg-6">

                                           <select name="cursor_style" style="width:100%;" required>
                                           <option   value="help">help</option>
                                           <option   value="wait">wait</option>
                                           <option   value="crosshair">crosshair</option>
                                           <option   value="not-allowed">not-allowed</option>
                                           <option   value="zoom-in">zoom-in</option>
                                           <option   value="grab">grab</option>
                                           </select>

                                           </div>

                                       </div>

                                    </div>

                                </div>

                          </div>

                       </div>

                       <!-- row ends-->

                        <div class="row">

                          <div class="col-lg-6">

                                <div class="news_archieve_even privacy_box">

                                    <div class="src_sort_box">

                                        <h4>Webstore extravagance</h4>

                                        <div>
                                            <input type="range" min="1" max="4" value="1" class="slider" id="myRange">
                                            <input type="hidden" name="level_epilapsy" id="level_epilapsy" />
                                            <p><span id="demo" style="color:#fff;"></span></p>
                                        </div>

                                    </div>

                                </div>

                          </div>



                           <div class="col-lg-6">

                           <div class="form-group" style="
                           padding: 43px 200px;
                           ">
                           <input type="submit" name="submit" class="btn-info btn"  value="Submit">
                           </div>

                          </div>



                       </div>

                     </form>
                    </div>

                 </div>

              </div>

              <div class="col-lg-1">

              </div>

           </div>

        </div>

     </section>

     <footer>

        <div class="footer-bottom">

           <div class="container">

              <div class="row">

                 <div class="col-sm-12">

                    <div class="d-sm-flex justify-content-between align-items-center">

                       <div class="fs-14 font-weight-600">

                          <ul class="footer_menu">

                            <li>
                                <a href="{{ URL('contactus') }}">Contact us</a>
                            </li>

                            <li>
                                <a href="{{ URL('aboutus') }}">About us</a>
                            </li>

                            <li>
                                <a href="{{ route('privacypolicy') }}">Privacy Policy</a>
                            </li>

                            <li>
                                <a href="{{route('termsservice')}}">Terms of Service</a>
                            </li>

                          </ul>

                          © 2022. All rights reserved.

                       </div>

                        <ul class="social-media mb-3">
                            <li>
                                <a href="{{ env('APP_YOU_TUBE_LINK', '#') }}">
                                    <i class="mdi mdi-youtube"></i>
                                    <span class="sr-only">{{ env('APP_NAME')  }} Youtube</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ env('APP_TWITTER_LINK', '#') }}">
                                    <i class="mdi mdi-twitter"></i>
                                    <span class="sr-only">{{ env('APP_NAME')  }} Twitter</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                 </div>

              </div>

           </div>

        </div>

     </footer>

  <script type="text/javascript">
var phpdebugbar = new PhpDebugBar.DebugBar();
phpdebugbar.addIndicator("php_version", new PhpDebugBar.DebugBar.Indicator({"icon":"code","tooltip":"PHP Version"}), "right");
phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");
phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));
phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");
phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));
phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));
phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()}));
phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");
phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"database","title":"Queries", "widget": new PhpDebugBar.Widgets.LaravelSQLQueriesWidget()}));
phpdebugbar.addTab("models", new PhpDebugBar.DebugBar.Tab({"icon":"cubes","title":"Models", "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()}));
phpdebugbar.addTab("livewire", new PhpDebugBar.DebugBar.Tab({"icon":"bolt","title":"Livewire", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addTab("gate", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Gate", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()}));
phpdebugbar.setDataMap({
"php_version": ["php.version", ],
"messages": ["messages.messages", []],
"messages:badge": ["messages.count", null],
"time": ["time.duration_str", '0ms'],
"timeline": ["time", {}],
"memory": ["memory.peak_usage_str", '0B'],
"exceptions": ["exceptions.exceptions", []],
"exceptions:badge": ["exceptions.count", null],
"views": ["views", []],
"views:badge": ["views.nb_templates", 0],
"route": ["route", {}],
"currentroute": ["route.uri", ],
"queries": ["queries", []],
"queries:badge": ["queries.nb_statements", 0],
"models": ["models.data", {}],
"models:badge": ["models.count", 0],
"livewire": ["livewire.data", {}],
"livewire:badge": ["livewire.count", 0],
"gate": ["gate.messages", []],
"gate:badge": ["gate.count", null],
"session": ["session", {}],
"request": ["request", {}]
});
phpdebugbar.restoreState();
phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar, undefined, true);
phpdebugbar.ajaxHandler.bindToFetch();
phpdebugbar.ajaxHandler.bindToXHR();
phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"https:\/\/employeyarena.com\/vore1\/public\/_debugbar\/open"}));
phpdebugbar.addDataSet({"__meta":{"id":"X2f7cca5e242a42761f7cacc709caf50a","datetime":"2023-02-01 13:30:42","utime":1675258242.091155,"method":"GET","uri":"\/vore1\/public\/generaloption","ip":"14.102.93.208"},"php":{"version":"8.1.13","interface":"litespeed"},"messages":{"count":0,"messages":[]},"time":{"start":1675258242.028846,"end":1675258242.091172,"duration":0.06232595443725586,"duration_str":"62.33ms","measures":[{"label":"Booting","start":1675258242.028846,"relative_start":0,"end":1675258242.044042,"relative_end":1675258242.044042,"duration":0.015196084976196289,"duration_str":"15.2ms","params":[],"collector":null},{"label":"Application","start":1675258242.044139,"relative_start":0.015292882919311523,"end":1675258242.091175,"relative_end":3.0994415283203125e-6,"duration":0.047036170959472656,"duration_str":"47.04ms","params":[],"collector":null}]},"memory":{"peak_usage":3754008,"peak_usage_str":"4MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":1,"templates":[{"name":"front.user.option.generaloption (resources\/views\/front\/user\/option\/generaloption.blade.php)","param_count":2,"params":["AllUsersdata","Usersetting"],"type":"blade"}]},"route":{"uri":"GET generaloption","middleware":"web","controller":"App\\Http\\Controllers\\Front\\ProfileController@generaloption","namespace":null,"prefix":"","where":[],"as":"generaloption","file":"<a href=\"phpstorm:\/\/open?file=\/home\/p4usmzxq3x8r\/public_html\/employeyarena.com\/vore1\/app\/Http\/Controllers\/Front\/ProfileController.php&line=422\">app\/Http\/Controllers\/Front\/ProfileController.php:422-428<\/a>"},"queries":{"nb_statements":3,"nb_failed_statements":0,"accumulated_duration":0.029670000000000002,"accumulated_duration_str":"29.67ms","statements":[{"sql":"select * from `users`","type":"query","params":[],"bindings":[],"hints":null,"show_copy":false,"backtrace":[{"index":17,"namespace":null,"name":"\/app\/Http\/Controllers\/Front\/ProfileController.php","line":424},{"index":18,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php","line":54},{"index":19,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/ControllerDispatcher.php","line":45},{"index":20,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php","line":261},{"index":21,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php","line":204}],"duration":0.02888,"duration_str":"28.88ms","stmt_id":"\/app\/Http\/Controllers\/Front\/ProfileController.php:424","connection":"vore","start_percent":0,"width_percent":97.337},{"sql":"select * from `users` where `id` = 25 limit 1","type":"query","params":[],"bindings":["25"],"hints":null,"show_copy":false,"backtrace":[{"index":15,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/EloquentUserProvider.php","line":52},{"index":16,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/SessionGuard.php","line":148},{"index":17,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/AuthManager.php","line":336},{"index":19,"namespace":null,"name":"\/app\/Http\/Controllers\/Front\/ProfileController.php","line":425},{"index":20,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php","line":54}],"duration":0.00031,"duration_str":"310\u03bcs","stmt_id":"\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/EloquentUserProvider.php:52","connection":"vore","start_percent":97.337,"width_percent":1.045},{"sql":"select * from `usersettings` where `userid` = 25","type":"query","params":[],"bindings":["25"],"hints":null,"show_copy":false,"backtrace":[{"index":14,"namespace":null,"name":"\/app\/Http\/Controllers\/Front\/ProfileController.php","line":426},{"index":15,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php","line":54},{"index":16,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/ControllerDispatcher.php","line":45},{"index":17,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php","line":261},{"index":18,"namespace":null,"name":"\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php","line":204}],"duration":0.00047999999999999996,"duration_str":"480\u03bcs","stmt_id":"\/app\/Http\/Controllers\/Front\/ProfileController.php:426","connection":"vore","start_percent":98.382,"width_percent":1.618}]},"models":{"data":{"App\\Models\\Usersetting":1,"App\\Models\\User":40},"count":41},"livewire":{"data":[],"count":0},"gate":{"count":0,"messages":[]},"session":{"_token":"sbe8x1Og0FwZMLOfm8oiFhsCwZm3JhHvCJRFKkHt","_previous":"array:1 [\n  \"url\" => \"https:\/\/employeyarena.com\/vore1\/public\/generaloption\"\n]","_flash":"array:2 [\n  \"old\" => []\n  \"new\" => []\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"25","PHPDEBUGBAR_STACK_DATA":"[]"},"request":{"path_info":"\/generaloption","status_code":"<pre class=sf-dump id=sf-dump-1554416823 data-indent-pad=\"  \"><span class=sf-dump-num>200<\/span>\n<\/pre><script>Sfdump(\"sf-dump-1554416823\", {\"maxDepth\":0})<\/script>\n","status_text":"OK","format":"html","content_type":"text\/html; charset=UTF-8","request_query":"<pre class=sf-dump id=sf-dump-293166119 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-293166119\", {\"maxDepth\":0})<\/script>\n","request_request":"<pre class=sf-dump id=sf-dump-1753582689 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-1753582689\", {\"maxDepth\":0})<\/script>\n","request_headers":"<pre class=sf-dump id=sf-dump-63586184 data-indent-pad=\"  \"><span class=sf-dump-note>array:17<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>accept<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"124 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-encoding<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-language<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"14 characters\">en-US,en;q=0.9<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>content-length<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>0<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cookie<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"713 characters\">XSRF-TOKEN=eyJpdiI6ImViWFFPU3FrNWlqZW54VFJoMUgySlE9PSIsInZhbHVlIjoic2tCU0poWCtwZmswWjIxeHZ0cGdVSlZnakVFS1FVb0thenVCSGtLM3hUdWMyYTZ2aVRqckhETFI1UWN5RHR5VThhdHBFZ2JLZ1g4QTlENVRvNVY5REppZk9uaE1oYm5LbDU5M0FSR3NqbTIvWnoxbFE3MjZySGhzbEhsSWNxaXciLCJtYWMiOiIwZTBmZDdmMWQ1ZTJiOGVjY2M5MGRjY2NkYzc2ZTI5MjIzMjBmOTVkYzRjYzgzNzhkZTQxNGE5YmJlODQ0YzQ0IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InBWZWo3a0xzSWhYYTFHYm9tRmxNSGc9PSIsInZhbHVlIjoiOC95b3o5NFpBWnY1Sis3TEo4bDQ5b3dpK1dPU29FbExUOXlKRU1xMWppU0VFdnVGSzUyUUVKdmNJVVlkUS82Vi9uNTdaUzBqU1VzOG5vR0U5TlM5djFmd3hrQytrQ082SXJSbDhGd1lqSC9sQjdKdGZscUY5VEJEcUtZamVPOE8iLCJtYWMiOiI2Y2U1MDVmZWU0MmRkMzIxYWIzMWViOTRmYzJmMWYyZGI2OGIwM2U3NmIwNWIzNDhmNjVjZjBiMWZmMDQzZjIyIiwidGFnIjoiIn0%3D<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>host<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">employeyarena.com<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>referer<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"51 characters\">https:\/\/employeyarena.com\/vore1\/public\/socialoption<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>user-agent<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"129 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/109.0.0.0 Safari\/537.36 Edg\/109.0.1518.70<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-ch-ua<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"66 characters\">&quot;Not_A Brand&quot;;v=&quot;99&quot;, &quot;Microsoft Edge&quot;;v=&quot;109&quot;, &quot;Chromium&quot;;v=&quot;109&quot;<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-ch-ua-mobile<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"2 characters\">?0<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-ch-ua-platform<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"9 characters\">&quot;Windows&quot;<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>upgrade-insecure-requests<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-site<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"11 characters\">same-origin<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-mode<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-user<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-dest<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>x-https<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>1<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-63586184\", {\"maxDepth\":0})<\/script>\n","request_server":"<pre class=sf-dump id=sf-dump-1529749707 data-indent-pad=\"  \"><span class=sf-dump-note>array:72<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>LSPHP_ENABLE_USER_INI<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">on<\/span>\"\n  \"<span class=sf-dump-key>PATH<\/span>\" => \"<span class=sf-dump-str title=\"28 characters\">\/usr\/local\/bin:\/usr\/bin:\/bin<\/span>\"\n  \"<span class=sf-dump-key>TEMP<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">\/tmp<\/span>\"\n  \"<span class=sf-dump-key>TMP<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">\/tmp<\/span>\"\n  \"<span class=sf-dump-key>TMPDIR<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">\/tmp<\/span>\"\n  \"<span class=sf-dump-key>PWD<\/span>\" => \"<span class=sf-dump-str>\/<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT<\/span>\" => \"<span class=sf-dump-str title=\"124 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_ENCODING<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_LANGUAGE<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">en-US,en;q=0.9<\/span>\"\n  \"<span class=sf-dump-key>CONTENT_LENGTH<\/span>\" => \"<span class=sf-dump-str>0<\/span>\"\n  \"<span class=sf-dump-key>HTTP_COOKIE<\/span>\" => \"<span class=sf-dump-str title=\"713 characters\">XSRF-TOKEN=eyJpdiI6ImViWFFPU3FrNWlqZW54VFJoMUgySlE9PSIsInZhbHVlIjoic2tCU0poWCtwZmswWjIxeHZ0cGdVSlZnakVFS1FVb0thenVCSGtLM3hUdWMyYTZ2aVRqckhETFI1UWN5RHR5VThhdHBFZ2JLZ1g4QTlENVRvNVY5REppZk9uaE1oYm5LbDU5M0FSR3NqbTIvWnoxbFE3MjZySGhzbEhsSWNxaXciLCJtYWMiOiIwZTBmZDdmMWQ1ZTJiOGVjY2M5MGRjY2NkYzc2ZTI5MjIzMjBmOTVkYzRjYzgzNzhkZTQxNGE5YmJlODQ0YzQ0IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InBWZWo3a0xzSWhYYTFHYm9tRmxNSGc9PSIsInZhbHVlIjoiOC95b3o5NFpBWnY1Sis3TEo4bDQ5b3dpK1dPU29FbExUOXlKRU1xMWppU0VFdnVGSzUyUUVKdmNJVVlkUS82Vi9uNTdaUzBqU1VzOG5vR0U5TlM5djFmd3hrQytrQ082SXJSbDhGd1lqSC9sQjdKdGZscUY5VEJEcUtZamVPOE8iLCJtYWMiOiI2Y2U1MDVmZWU0MmRkMzIxYWIzMWViOTRmYzJmMWYyZGI2OGIwM2U3NmIwNWIzNDhmNjVjZjBiMWZmMDQzZjIyIiwidGFnIjoiIn0%3D<\/span>\"\n  \"<span class=sf-dump-key>HTTP_HOST<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>HTTP_REFERER<\/span>\" => \"<span class=sf-dump-str title=\"51 characters\">https:\/\/employeyarena.com\/vore1\/public\/socialoption<\/span>\"\n  \"<span class=sf-dump-key>HTTP_USER_AGENT<\/span>\" => \"<span class=sf-dump-str title=\"129 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/109.0.0.0 Safari\/537.36 Edg\/109.0.1518.70<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_CH_UA<\/span>\" => \"<span class=sf-dump-str title=\"66 characters\">&quot;Not_A Brand&quot;;v=&quot;99&quot;, &quot;Microsoft Edge&quot;;v=&quot;109&quot;, &quot;Chromium&quot;;v=&quot;109&quot;<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_CH_UA_MOBILE<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">?0<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_CH_UA_PLATFORM<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">&quot;Windows&quot;<\/span>\"\n  \"<span class=sf-dump-key>HTTP_UPGRADE_INSECURE_REQUESTS<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_SITE<\/span>\" => \"<span class=sf-dump-str title=\"11 characters\">same-origin<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_MODE<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_USER<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_DEST<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  \"<span class=sf-dump-key>HTTP_X_HTTPS<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_UNIQUE_ID<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">Y9ppgpo-vx-Lrz7H9FALnQABiAc<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_SCRIPT_URL<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_SCRIPT_URI<\/span>\" => \"<span class=sf-dump-str title=\"52 characters\">https:\/\/employeyarena.com\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_GD-USERNAME<\/span>\" => \"<span class=sf-dump-str title=\"12 characters\">p4usmzxq3x8r<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_HTTPS<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">on<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_SSL_TLS_SNI<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_HTTP2<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">on<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_H2PUSH<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">off<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_H2_PUSH<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">off<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_H2_PUSHED<\/span>\" => \"\"\n  \"<span class=sf-dump-key>REDIRECT_H2_PUSHED_ON<\/span>\" => \"\"\n  \"<span class=sf-dump-key>REDIRECT_H2_STREAM_ID<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_H2_STREAM_TAG<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">392-1<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_STATUS<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">200<\/span>\"\n  \"<span class=sf-dump-key>UNIQUE_ID<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">Y9ppgpo-vx-Lrz7H9FALnQABiAc<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_URL<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_URI<\/span>\" => \"<span class=sf-dump-str title=\"52 characters\">https:\/\/employeyarena.com\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>GD-USERNAME<\/span>\" => \"<span class=sf-dump-str title=\"12 characters\">p4usmzxq3x8r<\/span>\"\n  \"<span class=sf-dump-key>HTTPS<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">on<\/span>\"\n  \"<span class=sf-dump-key>SSL_TLS_SNI<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>HTTP2<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">on<\/span>\"\n  \"<span class=sf-dump-key>H2PUSH<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">off<\/span>\"\n  \"<span class=sf-dump-key>H2_PUSH<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">off<\/span>\"\n  \"<span class=sf-dump-key>H2_PUSHED<\/span>\" => \"\"\n  \"<span class=sf-dump-key>H2_PUSHED_ON<\/span>\" => \"\"\n  \"<span class=sf-dump-key>H2_STREAM_ID<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>H2_STREAM_TAG<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">392-1<\/span>\"\n  \"<span class=sf-dump-key>SERVER_SIGNATURE<\/span>\" => \"\"\n  \"<span class=sf-dump-key>SERVER_SOFTWARE<\/span>\" => \"<span class=sf-dump-str title=\"6 characters\">Apache<\/span>\"\n  \"<span class=sf-dump-key>SERVER_NAME<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>SERVER_ADDR<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">184.168.115.31<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PORT<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">443<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_ADDR<\/span>\" => \"<span class=sf-dump-str title=\"13 characters\">14.102.93.208<\/span>\"\n  \"<span class=sf-dump-key>DOCUMENT_ROOT<\/span>\" => \"<span class=sf-dump-str title=\"48 characters\">\/home\/p4usmzxq3x8r\/public_html\/employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_SCHEME<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">https<\/span>\"\n  \"<span class=sf-dump-key>CONTEXT_PREFIX<\/span>\" => \"\"\n  \"<span class=sf-dump-key>CONTEXT_DOCUMENT_ROOT<\/span>\" => \"<span class=sf-dump-str title=\"48 characters\">\/home\/p4usmzxq3x8r\/public_html\/employeyarena.com<\/span>\"\n  \"<span class=sf-dump-key>SERVER_ADMIN<\/span>\" => \"<span class=sf-dump-str title=\"39 characters\">webmaster@employeyarena.addonvision.com<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_FILENAME<\/span>\" => \"<span class=sf-dump-str title=\"71 characters\">\/home\/p4usmzxq3x8r\/public_html\/employeyarena.com\/vore1\/public\/index.php<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_PORT<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">60198<\/span>\"\n  \"<span class=sf-dump-key>REDIRECT_URL<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PROTOCOL<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">HTTP\/2.0<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_METHOD<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">GET<\/span>\"\n  \"<span class=sf-dump-key>QUERY_STRING<\/span>\" => \"\"\n  \"<span class=sf-dump-key>REQUEST_URI<\/span>\" => \"<span class=sf-dump-str title=\"27 characters\">\/vore1\/public\/generaloption<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_NAME<\/span>\" => \"<span class=sf-dump-str title=\"23 characters\">\/vore1\/public\/index.php<\/span>\"\n  \"<span class=sf-dump-key>PHP_SELF<\/span>\" => \"<span class=sf-dump-str title=\"23 characters\">\/vore1\/public\/index.php<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_TIME_FLOAT<\/span>\" => <span class=sf-dump-num>1675258242.0288<\/span>\n  \"<span class=sf-dump-key>REQUEST_TIME<\/span>\" => <span class=sf-dump-num>1675258242<\/span>\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1529749707\", {\"maxDepth\":0})<\/script>\n","request_cookies":"<pre class=sf-dump id=sf-dump-972029173 data-indent-pad=\"  \"><span class=sf-dump-note>array:2<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>XSRF-TOKEN<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">sbe8x1Og0FwZMLOfm8oiFhsCwZm3JhHvCJRFKkHt<\/span>\"\n  \"<span class=sf-dump-key>laravel_session<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">zusagqQUoYGyOCTLwjmwcSAJwCF0NbH3QYNc92ZE<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-972029173\", {\"maxDepth\":0})<\/script>\n","response_headers":"<pre class=sf-dump id=sf-dump-804871958 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>content-type<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"24 characters\">text\/html; charset=UTF-8<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cache-control<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">no-cache, private<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>date<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"29 characters\">Wed, 01 Feb 2023 13:30:42 GMT<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>set-cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"428 characters\">XSRF-TOKEN=eyJpdiI6IlJTMG9oeUdCUnhBZk1MMWkxNzdjbnc9PSIsInZhbHVlIjoiNkc3M045S1ozZjhjTmE5QklGcXVUbTZCZzZoUDRBNThsOXRISG8ydVBobXRzQ2Z1ZWJ1aE96VExFVDE4dXdCZ2ZlYTIwR2Y4V2pXVVdtYXNteTdzNGxlTzZud1dCZzA3b3cxc1VwbjhUMEpwTXNQSjVBemJmcXYvT3U0Z1FsL1MiLCJtYWMiOiIzZTIzMTljMzFmYjQ3YjY5OTM0OTUzOTQ4YWIyZjc2NjI3YTdiMTg3NGFmMTBiMzE1YzlmODM0M2FhODYzN2MzIiwidGFnIjoiIn0%3D; expires=Wed, 01 Feb 2023 15:30:42 GMT; Max-Age=7200; path=\/; samesite=lax<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"443 characters\">laravel_session=eyJpdiI6IjU2djNMakNubkpvQzUrTlNQdGdITGc9PSIsInZhbHVlIjoiUE0vRGROWFE1aU54QW5QVjg1cnlLSkplaEhIMWZDaVJBNzMxaGo5TTZGY2M1MGxQRjRmTTNEZ000c2ZtdkptbXpVTmRSc3RDS0pKN0tqOTdaeDdwcTJ6ME5QOGJLSTdVbXVKNVVwcmVwSnI0U3ZOVm9ramxySldvY3Z1TWpGaGEiLCJtYWMiOiJiNjViMmU3MGJmNDEwZWRkNTg1ZDY2MzZmZjVjMmU0ZDFmOGYyZDM4MTc0YWFkYWFiOTM1OTI4NTI5ZGZlMGIyIiwidGFnIjoiIn0%3D; expires=Wed, 01 Feb 2023 15:30:42 GMT; Max-Age=7200; path=\/; httponly; samesite=lax<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>Set-Cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"400 characters\">XSRF-TOKEN=eyJpdiI6IlJTMG9oeUdCUnhBZk1MMWkxNzdjbnc9PSIsInZhbHVlIjoiNkc3M045S1ozZjhjTmE5QklGcXVUbTZCZzZoUDRBNThsOXRISG8ydVBobXRzQ2Z1ZWJ1aE96VExFVDE4dXdCZ2ZlYTIwR2Y4V2pXVVdtYXNteTdzNGxlTzZud1dCZzA3b3cxc1VwbjhUMEpwTXNQSjVBemJmcXYvT3U0Z1FsL1MiLCJtYWMiOiIzZTIzMTljMzFmYjQ3YjY5OTM0OTUzOTQ4YWIyZjc2NjI3YTdiMTg3NGFmMTBiMzE1YzlmODM0M2FhODYzN2MzIiwidGFnIjoiIn0%3D; expires=Wed, 01-Feb-2023 15:30:42 GMT; path=\/<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"415 characters\">laravel_session=eyJpdiI6IjU2djNMakNubkpvQzUrTlNQdGdITGc9PSIsInZhbHVlIjoiUE0vRGROWFE1aU54QW5QVjg1cnlLSkplaEhIMWZDaVJBNzMxaGo5TTZGY2M1MGxQRjRmTTNEZ000c2ZtdkptbXpVTmRSc3RDS0pKN0tqOTdaeDdwcTJ6ME5QOGJLSTdVbXVKNVVwcmVwSnI0U3ZOVm9ramxySldvY3Z1TWpGaGEiLCJtYWMiOiJiNjViMmU3MGJmNDEwZWRkNTg1ZDY2MzZmZjVjMmU0ZDFmOGYyZDM4MTc0YWFkYWFiOTM1OTI4NTI5ZGZlMGIyIiwidGFnIjoiIn0%3D; expires=Wed, 01-Feb-2023 15:30:42 GMT; path=\/; httponly<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-804871958\", {\"maxDepth\":0})<\/script>\n","session_attributes":"<pre class=sf-dump id=sf-dump-2992293 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp data-depth=1 class=sf-dump-expanded>\n  \"<span class=sf-dump-key>_token<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">sbe8x1Og0FwZMLOfm8oiFhsCwZm3JhHvCJRFKkHt<\/span>\"\n  \"<span class=sf-dump-key>_previous<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    \"<span class=sf-dump-key>url<\/span>\" => \"<span class=sf-dump-str title=\"52 characters\">https:\/\/employeyarena.com\/vore1\/public\/generaloption<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>_flash<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp data-depth=2 class=sf-dump-compact>\n    \"<span class=sf-dump-key>old<\/span>\" => []\n    \"<span class=sf-dump-key>new<\/span>\" => []\n  <\/samp>]\n  \"<span class=sf-dump-key>login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d<\/span>\" => <span class=sf-dump-num>25<\/span>\n  \"<span class=sf-dump-key>PHPDEBUGBAR_STACK_DATA<\/span>\" => []\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-2992293\", {\"maxDepth\":0})<\/script>\n"}}, "X2f7cca5e242a42761f7cacc709caf50a");

</script>
</body>

<script>
var $ = jQuery;
$('#progress_bar li').on('click', function(){

   var id = $(this).attr('id');
   $('#progress_bar li').removeClass('current_line');
   $(this).addClass('current_line');
   $('#progress_bar li').removeClass('current');
    for(var i = 1; i < parseInt(id); i++){
       $('#'+i).addClass('current');
    }

});
function myFunction1() {

 var x = document.getElementById("custom_dropdown");

 if (x.style.display === "block") {

   x.style.display = "none";

 } else {

   x.style.display = "block";

 }

}

function myFunction2() {

 var x = document.getElementById("custom_dropdown2");

 if (x.style.display === "block") {

   x.style.display = "none";

 } else {

   x.style.display = "block";

 }

}

function myFunction3() {

 var x = document.getElementById("custom_dropdown3");

 if (x.style.display === "block") {

   x.style.display = "none";

 } else {

   x.style.display = "block";

 }

}


var level_epilapsy = document.getElementById("level_epilapsy");
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = "";
var sliderval = "Low" ;
slider.oninput = function() {
   if(this.value==1){
        sliderval = "Low" ;
   }
   if(this.value==2){
        sliderval = "Medium" ;
   }
   if(this.value==3){
        sliderval = "High" ;
   }
   if(this.value==4){
        sliderval = "Expert" ;
   }
  level_epilapsy.value=sliderval
 output.innerHTML = sliderval ;
}
</script>

</html>
