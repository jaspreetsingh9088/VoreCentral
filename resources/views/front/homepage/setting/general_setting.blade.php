@extends('front.homepage.setting.layout.app')

@section('title', 'General Setting')
@section('style')
    <style>
        body{
            font-family: !important;
            cursor: !important;
        }
        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .slidecontainer {
            width: 100%;
        }
        .slider {
            -webkit-appearance: none;
            width: 90%;
            height: 25px;
            background: #ffffff;
            outline: none;
        }
        .slider:hover {
            opacity: 1;
        }
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
<section class="viewhistory-wrapper">
    <div class="container-fluid">


        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="view_history-outer p-0 m-0">
                    <div class="news_archieve_wrapper general_warp">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger w-50">
                                    <strong>{{ $error }}</strong>
                                </div>
                            @endforeach
                        @endif
                        @if (Session::has('successful_message'))
                            <div class="alert alert-success w-50">
                                {{ Session::get('successful_message') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('generalSettingstore')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="news_archieve_odd privacy_box">
                                        <div class="src_sort_box">
                                            <div class="col-lg-6">
                                                <h4>Preferred Font</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="preffered_font" style="width:100%;" value="">
                                                    {{-- <option  value=" {{$option->preffered_font}} Arial, sans-serif">Arial (sans-serif)</option> --}}
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == 'Arial, sans-serif') selected @endif value="Arial, sans-serif">Arial (sans-serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == 'Verdana, sans-serif') selected @endif value="Verdana, sans-serif">Verdana (sans-serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == 'Tahoma, sans-serif') selected @endif value="Tahoma, sans-serif">Tahoma (sans-serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == "'Trebuchet MS', sans-serif") selected @endif value="'Trebuchet MS', sans-serif">Trebuchet MS (sans-serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == "'Times New Roman', serif") selected @endif value="'Times New Roman', serif">Times New Roman (serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == 'Georgia, serif') selected @endif value="Georgia, serif">Georgia (serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == 'Garamond, serif') selected @endif value="Garamond, serif">Garamond (serif)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font ==  "'Courier New', monospace") selected @endif value="'Courier New', monospace">Courier New (monospace)</option>
                                                    <option @if(isset($option->preffered_font) && $option->preffered_font == "'Brush Script MT', cursive") selected @endif value="'Brush Script MT', cursive">Brush Script MT (cursive)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="news_archieve_odd privacy_box">
                                        <div class="src_sort_box">
                                            <h4>General Privacy</h4>
                                            <div class="">
                                                @php
                                                    if(isset($option)){
                                                        $generalprivacy = json_decode($option->general_privacy);
                                                    }else{
                                                        $generalprivacy = null;
                                                    }
                                                @endphp
                                                <div class="form-group">
                                                    <input type="checkbox"  name="show_vorerole_preference" id="default130"
                                                    @if($generalprivacy != null && in_array('show_vorerole_preference',$generalprivacy)) checked @endif>
                                                    <label for="default130">Show vorerole preference</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="show_gender" id="default210"
                                                    @if($generalprivacy != null && in_array('show_gender',$generalprivacy)) checked @endif>
                                                    <label for="default210">Show gender</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="show_orientation" id="pritag220"
                                                    @if($generalprivacy != null && in_array('show_orientation',$generalprivacy)) checked @endif>
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
                                            <div class="">
                                                <div class="col-lg-6">
                                                    <h4>Timezone</h4>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <select name="timezone" style="width:100%;" required>
                                                            @foreach($timezone as $tz)
                                                                <option @if(isset($option->timezone) && $tz->name == $option->timezone) selected @endif value="{{ $tz->name }}">{{ $tz->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="news_archieve_even privacy_box">
                                        <div class="src_sort_box">
                                            <h4>Gender</h4>
                                            @php
                                                if(isset($option)){
                                                    $gender = $option->gender;
                                                }else{
                                                    $gender = '';
                                                }
                                            @endphp
                                            <div class="">
                                                <div class="form-group">
                                                    <input type="radio" id="fmale" name="gender" value="female" @if(!empty($gender) && $gender == 'female') checked @endif>
                                                    <label for="fmale">Female</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="male" name="gender" value="male" @if(!empty($gender) && $gender == 'male') checked @endif>
                                                    <label for="male">Male</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="other" name="gender" value="other" @if(!empty($gender) && $gender == 'other') checked @endif>
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
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Enter New Email</label>
                                                        <input type="email" name="change_email" class="change_email" value="">
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
                                                @php
                                                if(isset($option)){
                                                    $sexualorientation = $option->sexual_orientation;
                                                }else{
                                                    $sexualorientation = null;
                                                }
                                            @endphp
                                                <div class="form-group">
                                                    <input type="radio" id="s1" name="sexual_orientation" value="Heterosexual"
                                                    @if($sexualorientation != null && $sexualorientation == 'Heterosexual') checked @endif>
                                                    <label for="s1">Heterosexual</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s2" name="sexual_orientation" value="Homosexual"
                                                    @if($sexualorientation != null && $sexualorientation == 'Homosexual') checked @endif>
                                                    <label for="s2">Homosexual</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s3" name="sexual_orientation" value="Bisexual"
                                                    @if($sexualorientation != null && $sexualorientation == 'Bisexual') checked @endif>
                                                    <label for="s3">Bisexual</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s4" name="sexual_orientation" value="Other"
                                                    @if($sexualorientation != null && $sexualorientation == 'Other') checked @endif>
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
                                                            <input type="checkbox" name="show_comments" value="1" id="default10"
                                                            @if(isset($option) && $option->show_comments == 1) checked  @endif>
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
                                                    <input type="radio" id="s11" name="vore_role_preference" value="Pred"
                                                    @if(isset($option) && $option->vore_role_preference == 'Pred') checked @endif>
                                                    <label for="s11">Pred</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s12" name="vore_role_preference" value="Prey"
                                                    @if(isset($option) && $option->vore_role_preference == 'Prey') checked @endif>
                                                    <label for="s12">Prey</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s13" name="vore_role_preference" value="Switch"
                                                    @if(isset($option) && $option->vore_role_preference == 'Switch') checked @endif>
                                                    <label for="s13">Switch</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s14" name="vore_role_preference" value="Observer"
                                                    @if(isset($option) && $option->vore_role_preference == 'Observer') checked @endif>
                                                    <label for="s14">Observer</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" id="s15" name="vore_role_preference" value="Other"
                                                    @if(isset($option) && $option->vore_role_preference == 'Other') checked @endif>
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
                                                            <input type="checkbox" name="creator_pages_custom_theme" value="1"  id="default11"
                                                            @if(isset($option) && $option->creator_pages_custom_theme == 1) checked @endif>
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
                                                        <option @if(isset($option) && $option->cursor_style == 'unset') selected @endif value="unset">Default</option>
                                                        <option @if(isset($option) && $option->cursor_style == 'help') selected @endif value="help">Help</option>
                                                        <option  @if(isset($option) && $option->cursor_style == 'wait') selected @endif value="wait">Wait</option>
                                                        <option @if(isset($option) && $option->cursor_style == 'crosshair') selected @endif value="crosshair">Crosshair</option>
                                                        <option @if(isset($option) && $option->cursor_style == 'not-allowed') selected @endif value="not-allowed">Not-Allowed</option>
                                                        <option @if(isset($option) && $option->cursor_style == 'zoom-in') selected @endif value="zoom-in">Zoom-In</option>
                                                        <option @if(isset($option) && $option->cursor_style == 'grab') selected @endif value="grab">Grab</option>
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
                                                @php
                                                    if($option){
                                                        if($option->webstore_level == 'Low'){
                                                            $level_epilapsy = 1;
                                                        }else if($option->webstore_level == 'Medium'){
                                                            $level_epilapsy = 2;
                                                        }else if($option->webstore_level == 'High'){
                                                            $level_epilapsy = 3;
                                                        }else if($option->webstore_level == 'Expert'){
                                                            $level_epilapsy = 4;
                                                        }else{
                                                            $level_epilapsy = 0;
                                                        }
                                                    }else{
                                                        $level_epilapsy = 0;
                                                    }
                                                @endphp
                                                {{-- <input type="range" min="1" max="4" value="1" class="slider" id="myRange"> --}}
                                                <input style="-webkit-appearance: none;width: 90%;height: 25px;background: #ffffff; outline: none;"
                                                type="range" min="1" max="4" name="level_epilapsy" id="level_epilapsy"
                                                value="{{ $level_epilapsy }}" />
                                                <p><span id="demo" style="color:#fff;"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style=" padding: 43px 200px;">
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
@endsection
