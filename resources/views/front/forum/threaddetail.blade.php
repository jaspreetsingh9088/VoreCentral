@extends('front.forum.layout.app')
@section('title', 'Thread Details')
@section('style')
    <style>
        button.preview-thread-btn {
            background-color: #fff;
            border: 1px solid #000;
            padding: 10px 15px;
            margin-right: 10px;
        }

        button.preview-thread-btn:hover {
            background-color: #000;
            color: #FFFFFF;
        }

        button.submit-thread-btn {
            background-color: #fea803;
            border: 1px solid #000;
            padding: 10px 15px;
            font-weight: bold;
        }

        button.submit-thread-btn:hover {
            background-color: #ed9b00;
            border: 1px solid #ed9b00;
            color: #FFFFFF;
        }

        input#input-file-box {
            display: none;
        }

        .upload-box {
            border: 1px solid #d1d1d1;
            border-top: 0px;
            padding: 10px;
            margin-bottom: 30px;
            background-color: #FFFFFF;
        }

        .upload-box label {
            margin: 0px;
        }

        .reply-form label {
            font-weight: bold;
        }

        ul.social-icons {
            text-align: right;
            margin-top: 30px;
            padding: 0px;
        }

        .navbar-nav li:hover>ul.dropdown-menu {
            display: block;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
        }

        /* rotate caret on hover */
        .dropdown-menu>li>a:hover:after {
            text-decoration: underline;
            transform: rotate(-90deg);
        }

        ul.dropdown-menu {
            margin: 0px;
            border-radius: 0px;
            padding: 0px;
            border: 0px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            border-bottom: 1px solid #e3e3e3;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #123e12;
            color: #fff;
        }

        .buttons-container {
            text-align: right;
            margin-top: -40px;
        }

        .creator_logo h2 {
            background: #fff;
            margin-top: 8px;
            padding: 48px 8px;
            font-size: 19px;
            margin: 0px;
        }

        .orange_theme .all-notifications {
            background-color: #d2470e;
        }
        .original-comment{
            background: #ff7c04;
            padding:18px;
        }
        .post-body img{
            max-width: 600px;
        }
    </style>
@endsection
@section('content')
    <div class="option_theme secondary_header mt-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 mt-30">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse justify-content-start" id="navbar10">
                        <ul class="navbar-nav nav-fill w-100">
                            <li class="nav-item"><a class="nav-link" href="{{ route('generalSetting') }}">General</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Sorting and search settings</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tagOption') }}">Tag settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('notificationOption') }}">Notifications and Privacy</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('technicalOption') }}">Technical settings etc</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('themeOption') }}">Theme Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('socialOption') }}">Social</a></li>
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
                    <div class="view_history-outer p-0 mt-3 thread3_wrapp">
                        <p class="page_breadcrumb">
                            <a href="{{ route('home') }}">Home</a> >
                            <a href="{{ URL('forum') }}">Forums </a> >
                            @if ($subForum)
                                <a href="{{ URL('thread/' . $subForum->id . '/1') }}"> {{ $subForum->name }} </a>
                            @endif
                            <a href="Javascript:void(0)">{{ $ThreadData['topic'] }} </a>
                        </p>

                        <div class="news_adsquare contact_ad text-center mx-auto">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>
                        <div class="thread3-top mb-3">
                            <div class="thread_portrait">
                                <img src="{{ $ThreadData['profile_pic'] }}" class="" alt="" />
                            </div>
                            <div class="thread_data">
                                <h4>{{ ucwords($ThreadData['topic']) }}</h4>
                                <p>
                                    By {{ $ThreadData['username'] }},
                                    {{ date('d M Y', strtotime($ThreadData['created_at'])) }}
                                </p>
                            </div>
                        </div>
                        <?php
                        $no_of_records_per_page = 10;
                        $offset = ($pageno - 1) * $no_of_records_per_page;
                        $total_rows = $threadcommentDatacount;
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        ?>
                        <div class="pagination_subforums pagi-top mb-3">
                            <ul class="list-none">
                                <li><?php echo 'Page ' . $pageno . ' of ' . $total_pages; ?></li>
                                <li><a style="color:#222;" href="{{ URL('threaddetail/' . $id . '/1') }}">First</a>
                                </li>
                                <li class="<?php if ($pageno <= 1) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno <= 1) {
                                        echo '#';
                                    } else {
                                        echo URL('threaddetail/' . $id . '/' . $pageno - 1);
                                    } ?>">Prev</a>
                                </li>

                                <li class="<?php if ($pageno >= $total_pages) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                    } else {
                                        echo URL('threaddetail/' . $id . '/' . $pageno + 1);
                                    } ?>">Next</a>
                                </li>
                                <li><a style="color:#222;"
                                        href="{{ URL('threaddetail/' . $id . '/' . $total_pages) }}">Last</a></li>
                            </ul>
                        </div>
                        {{-- <div class="user_online_odd poster_row d-none" style="min-height: 300px;">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="poster_figure">
                                        <h4 class="m-0">
                                            <a href="{{ URL('/dashboard/' . $ThreadData[0]['userid']) }}">
                                                {{ $ThreadData[0]['username'] }}
                                            </a>
                                        </h4>
                                        <p>{{ $ThreadData[0]['achivement'] }}</p>
                                        <img src="{{ $ThreadData[0]['profile_pic'] }}" style="height: 115px;width: 115px;" alt="" />
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="">
                                        <p class="p-date">{{ date('d M Y', strtotime($ThreadData[0]['created_at'])) }}</p>
                                        <div class=""style="min-height:150px;overflow:hidden;">
                                            {!! html_entity_decode($ThreadData[0]['comment']) !!}
                                        </div>
                                        <img src="{{asset('threadcomment/'.$ThreadData[0]['media'])}}">
                                        <hr style="border: 0;border-top: 2px solid #221;">
                                        <div class="clearfix">
                                            <p class="">
                                                <b>Wacky quote Wacky quote Wacky quote Wacky quote Wacky quote Wacky quote</b>
                                                </p>
                                            <p class="float-right"></p>
                                            <p class="float-left">
                                                <b>{{ date('d M Y', strtotime($ThreadData[0]['created_at'])) }}</b>
                                            </p>
                                            <p class="float-right">#1</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--user row end-->
                        <?php
                        $replay = 0;
                        if(isset($threadcommentData) && is_array($threadcommentData) && count($threadcommentData) > 0){
                            foreach($threadcommentData as $threadcommentDataK => $threadcommentDataV){
                                $totallike = App\Models\Threadcommentlike::where('comment_id',$threadcommentDataV['id'])->count();
                                $totaldislike = App\Models\Threadcommentdislike::where('comment_id',$threadcommentDataV['id'])->count();
                                $islike = App\Models\Threadcommentlike::where('comment_id',$threadcommentDataV['id'])->where('user_id',Auth::id())->count();
                                $isdislike = App\Models\Threadcommentdislike::where('comment_id',$threadcommentDataV['id'])->where('user_id',Auth::id())->count();
                                $parentComment = App\Models\Threadcomment::where('id',$threadcommentDataV['parent_comment_id'])->first();
                                $negative_content = false;
                                if(!is_null($generalsetting) && $generalsetting->show_comments == 1){
                                    if($totaldislike > $totallike){
                                        $negative_content = true;
                                    }
                                }
                                ?>
                                @if($negative_content == true)
                                    <div class="user_online_even poster_row" >
                                        <div class="row d-flex justify-content-around">
                                            <div class="col-md-8">
                                                <div class="top_gallery creator_gallery_search">
                                                    <div class="d-flex search_box">
                                                        <span class="type-box-grn">This content is hidden because it has negative like/dislike ratio. To view this, manage your settings from General option page</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div id="threadcomment{{$threadcommentDataV['id']}}" class="user_online_even poster_row"
                                        <?php echo array_key_last($threadcommentData) == $threadcommentDataK ? 'style="border-bottom:3px solid #000;"' : ''; ?>>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="poster_figure">
                                                    <h4 class="m-0">
                                                        <a href="{{ $threadcommentDataV['dashboard_link'] }}">
                                                            {{ $threadcommentDataV['username'] }}
                                                        </a>
                                                    </h4>
                                                    <p style="width: 100%;word-wrap: break-word;">{{ $threadcommentDataV['achivement'] }}</p>
                                                    @if($threadcommentDataV['profile_pic'])
                                                        <img src="{{ $threadcommentDataV['profile_pic'] }}" style="height: 115px;width: 115px;" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="post-body">
                                                @php
                                                if ($parentComment) {
                                                @endphp

                                                <div class="original-comment">
                                                    @php
                                                    echo html_entity_decode($parentComment->comment); // Decode HTML entities
                                                    @endphp
                                                </div>
                                                @php
                                                }
                                                @endphp
                                                <p class="p-date">
                                                        {{ date('d M Y', strtotime($threadcommentDataV['created_at'])) }}
                                                </p>
                                                    <div>
                                                        {!! html_entity_decode($threadcommentDataV['comment']) !!} </div> 
                                                        @if($threadcommentDataV['media'])
                                                            <img style="height: 200px;width : 200px;" class="threadImg" src="{{ $threadcommentDataV['media'] }}">
                                                        @endif
                                                    <hr style="border: 0;border-top: 2px solid #221;">
                                                    @if(Auth::check())
                                                        <p style="cursor: pointer; font-weight: bold;" class="float-left replay mr-2" data-replay="{{$replay}}">Reply</p>
                                                        <p>
                                                            <a style="color: unset; font-weight: bold; font-size : 20px;" href="{{ route('thread.comment.like',[$threadcommentDataV['id']]) }}" class="float-left mr-2 like_btn" title="Like">
                                                                @if($islike > 0)
                                                                    <i class="fa fa-thumbs-up text-black" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="fa fa-thumbs-o-up text-black" aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                            ({{ $totallike }})
                                                            &nbsp;
                                                            <a style="color: unset; font-weight: bold; font-size : 20px;" href="{{ route('thread.comment.dislike',[$threadcommentDataV['id']]) }}" class="dislike_btn" title="Dislike">
                                                                @if($isdislike > 0)
                                                                    <i class="fa fa-thumbs-down text-black" aria-hidden="true"></i>
                                                                @else
                                                                    <i class='fa fa-thumbs-o-down text-black' aria-hidden="true"></i>
                                                                @endif
                                                            </a>
                                                            ({{ $totaldislike }})
                                                        </p>
                                                    @endif
                                                    <div class="clearfix" style="display: none;" id="replay-box{{$replay}}">
                                                        <form action="{{ route('addthreadcomment') }}" method="post">
                                                            <input type="hidden" name="threadid" value="{{ $ThreadData['id'] }}">
                                                            <input type="hidden" name="parent_id" value="{{$threadcommentDataV['id']}}">
                                                            @csrf
                                                            <textarea id="replay-editor{{$replay}}" class="replay__editor" name="comment" required>
                                                                &lt;p&gt;The &lt;strong&gt;Basic&lt;/strong&gt; package is perfect for short text fields that require little formatting, such as:&lt;/p&gt;
                                                            </textarea>
                                                            <br>
                                                            <button type="submit" class="submit-thread-btn">Submit</button>
                                                        </form>
                                                    </div>
                                                    <?php
                                                        $replaycomment = App\Models\Threadcomment::where('parent_id',$threadcommentDataV['id'])->get();
                                                        if(count($replaycomment) != 0){
                                                            foreach($replaycomment as $row){ ?>
                                                                <div class="clearfix" id="quotesmessage{{$row->id}}">
                                                                    <p class="">
                                                                        <b><?php echo $row->comment ?></b>
                                                                    </p>
                                                                    <p class="float-right"></p>
                                                                    <p class="float-left">
                                                                        <b><?php echo date('d M Y', strtotime($row->created_at)) ?></b>
                                                                    </p>
                                                                    {{-- <p class="float-right">#<?php //echo $threadcommentDataK + 2 ?></p> --}}
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $replay++; ?>
                                @endif
                                <?php
                            }
                        } ?>
                        <input type="hidden" value="{{$replay}}" class="totalreplay">
                        <div class="pagination_subforums my-5">
                            <ul class="list-none">
                                <li><?php echo 'Page ' . $pageno . ' of ' . $total_pages; ?></li>
                                <li><a style="color:#222;" href="{{ URL('threaddetail/' . $id . '/1') }}">First</a>
                                </li>
                                <li class="<?php if ($pageno <= 1) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno <= 1) {
                                        echo '#';
                                    } else {
                                        echo URL('threaddetail/' . $id . '/' . $pageno - 1);
                                    } ?>">Prev</a>
                                </li>

                                <li class="<?php if ($pageno >= $total_pages) {
                                    echo 'disabled';
                                } ?>">
                                    <a style="color:#222;" href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                    } else {
                                        echo URL('threaddetail/' . $id . '/' . $pageno + 1);
                                    } ?>">Next</a>
                                </li>
                                <li><a style="color:#222;"
                                        href="{{ URL('threaddetail/' . $id . '/' . $total_pages) }}">Last</a></li>
                            </ul>
                        </div>
                        @php
                            $cid = request()->segment(2);
                        @endphp
                        @if($ThreadData['thread_lock'] == 0 && Auth::check() && $cid != 2)
                            <div class="reply-form">
                                <form class="sign_up_form" action="{{ route('addthreadcomment') }}" class="card mb-3"
                                    method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Comment:</label>
                                            <textarea id="sample-editor" class="chat__editor" name="comment" required>
                                                &lt;p&gt;The &lt;strong&gt;Basic&lt;/strong&gt; package is perfect for short text fields that require little formatting, such as:&lt;/p&gt;
                                            </textarea>
                                            <div class="upload-box"><label for="input-file-box"><i class="fa fa-plus"
                                                        aria-hidden="true"></i> Add Media</label><input type="file"
                                                    id="input-file-box" name="media" onchange="previewImage(event)" /></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="threadid" value="{{ $ThreadData['id'] }}">
                                        <div class="col-12">
                                            <div id="image-preview-container" style="display: none;">
                                                <img id="image-preview" src="" alt="Image Preview"
                                                    style="width: 100px; height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="submit-thread-btn">Submit Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <div class="news_adsquare thread3_ad">
                            <div class="ad_banner landscape">
                                <div data-banner-id="425470"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-1">
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>

    <script>
        $('.replay').click(function(){
            var index = $(this).data('replay');
            $('#replay-box'+index).toggle();
        })
        var replay = $('.totalreplay').val();
        for (let index = 0; index < replay; index++) {
            CKEDITOR.ClassicEditor.create(document.getElementById("replay-editor"+index), {
                toolbar: {
                    items: [
                        'heading', '|', 'bold', 'italic', 'strikethrough', 'underline', 'code', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|','alignment', '|','sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },

                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },

                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType'
                ]
            });
        }
    </script>
    <script>
        // This sample still does not showcase all CKEditor 5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("sample-editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Comment',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: <?php echo json_encode($follow); ?>,
                        minimumCharacters: 0
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
    </script>
    <script>
    function previewImage(event) {
        var input = event.target;
        var previewContainer = document.getElementById("image-preview-container");
        var previewImage = document.getElementById("image-preview");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = "block";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
   </script>
    <script>
        $(document).ready(function() {
            document.getElementById("image-preview-container").text="";
            $("#post-body-error").hide();
            $(".notifications-list").hide();
            $(".notification-icon").click(function() {
                $(".notifications-list").toggle();
            });
            $('#close').click(function(){
                $('.notifications-list').slideToggle();
            });

            $('.like_btn, .dislike_btn').click(function(){
                $(this).css({
                    'pointer-events': 'none'
                });
            });
        });
    </script>
@endpush
