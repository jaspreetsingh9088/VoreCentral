<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gallery List</h3>
        <div class="card-tools">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" wire:model="search">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>S.No.</th>
                <th>Date</th>
                <th>Name of Creator</th>
                <th>Title of Content</th>
                <th>Description</th>
                <th>Like/Dislike</th>
                <th>Views</th>
                <th>View Content</th>
                <th>Content Promoted</th>
                <th>featured</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($gallary_item as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ date('d/m/Y',strtotime($item->created_at)) }}</td>
                    <td>{{ $item->username }}</td>
                    <td><p>{{ $item->title }}</p></td>
                    <td>
                        <div class="description">
                            @if(strlen($item->description) > 20)
                                <p>{{ substr($item->description, 0, 20) }}... <span class="show-more">Show
                                            More</span><span class="more-text"
                                                             style="display:none;">{{ substr($item->description, 20) }}</span><span
                                        class="show-less" style="display:none;"> Show Less</span></p>
                            @else
                                <p>{{ $item->description}}</p>
                        @endif
                    </td>
                    <td>{{ $item->like_count."/".$item->dislike_count }}</td>
                    <td>{{ $item->total_views??0 }}</td>

                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal{{ $item->id }}">
                            View
                        </button>
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    @php
                                        $striped_content = '';
                                        $content = '';
                                        $ext = pathinfo($item['content'], PATHINFO_EXTENSION);
                                        $audiofilepath = '';
                                        $docxfilepath = '';
                                    @endphp
                                    @if (!empty($item['video_url']))
                                        <iframe width="560" height="315"
                                                src="{{ $item['video_url'] }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div
                                            style="padding: 0.7em; max-height:800px; overflow-y: auto;background-color: #fff;border:0.3rem solid gray;">

                                            @if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif')
                                                @php

                                                    $url = $item['content'];

                                                    $lastSlashPos = strrpos($url, '/');

                                                    $fileName = substr($url, $lastSlashPos + 1);

                                                @endphp

                                                <a href="{{ asset('content/' . $fileName) }}" class="mfp-image">

                                                    <img src="{{ asset('content/' . $fileName) }}" alt=""
                                                         srcset="" width="100%">

                                                </a>
                                            @elseif($ext == 'mp3' || $ext == 'wav')
                                                @php

                                                    $url = $item['content'];

                                                    $lastSlashPos = strrpos($url, '/');

                                                    $fileName = substr($url, $lastSlashPos + 1);

                                                @endphp

                                                <div class="">

                                                    <!-- <div id="waveform"></div>

                                                        <div class="controls">

                                                            <img src="{{ asset('media/play.png') }}" alt=""
                                                                id="playBtn">

                                                            <img src="{{ asset('media/stop.png') }}" alt=""
                                                                id="stopBtn">

                                                            <img src="{{ asset('media/volume.png') }}" alt=""
                                                                id="volumeBtn">

                                                        </div> -->

                                                    <p>Click on the play button to play a sound:</p>
                                                    <audio controls>
                                                        <source src="{{ asset('content/' . $fileName) }}"
                                                                type="audio/ogg">

                                                    </audio>

                                                </div>
                                            @elseif($ext == 'webm' || $ext == 'mp4')
                                                <video width="100%" height="100%" controls>

                                                    <source src="{{ $item['content'] }}"
                                                            type="video/{{ $ext }}">

                                                </video>
                                            @elseif($ext == 'txt')
                                                @php

                                                    $url = $item['content'];

                                                    $lastSlashPos = strrpos($url, '/');

                                                    $fileName = substr($url, $lastSlashPos + 1);

                                                    $contents = File::get(public_path('content/' . $fileName));

                                                @endphp

                                                {!! nl2br(e($contents)) !!}
                                            @elseif($ext == 'rtf')
                                                @php

                                                    $url = $item['content'];

                                                    $lastSlashPos = strrpos($url, '/');

                                                    $fileName = substr($url, $lastSlashPos + 1);

                                                    $rtf = File::get(public_path('content/' . $fileName));

                                                    $document = new RtfHtmlPhp\Document($rtf);

                                                    $formatter = new RtfHtmlPhp\Html\HtmlFormatter('UTF-8');

                                                    echo $formatter->Format($document);

                                                @endphp
                                            @elseif($ext == 'docx')
                                                @php

                                                    $docxfilepath = $item['content'];

                                                @endphp

                                                <div class="" id="docstext"></div>
                                            @elseif($ext == 'doc')
                                                {{-- @php
                                                    $url = $item['content'];
                                                    $lastSlashPos = strrpos($url, '/');
                                                    $fileName = substr($url, $lastSlashPos + 1);
                                                    $file = public_path('content/'.$fileName);

                                                    if (($fh = fopen($file, 'r')) !== false) {
                                                        $headers = fread($fh, 0xa00);

                                                        // read doc from 0 to 255 characters

                                                        $n1 = ord($headers[0x21c]) - 1;

                                                        // read doc from 256 to 63743 charact   ers

                                                        $n2 = (ord($headers[0x21d]) - 8) * 256;

                                                        // read doc from 63744 to 16775423 characters

                                                        $n3 = ord($headers[0x21e]) * 256 * 256;

                                                        //read doc from 16775424 to 4294965504 characters

                                                        $n4 = ord($headers[0x21f]) * 256 * 256 * 256;

                                                        // Total length of text in the document

                                                        $textLength = $n1 + $n2 + $n3 + $n4;

                                                        ini_set('memory_limit', '-1');

                                                        $extracted_plaintext = fread($fh, abs($textLength));

                                                        echo nl2br($extracted_plaintext);
                                                    }

                                                @endphp --}}
                                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{$item['content']}}" width='100%' height='900px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>

                                            @elseif($ext == 'pdf')
                                                @php
                                                    $pdfParser = new \Smalot\PdfParser\Parser();
                                                    $url = $item['content'];
                                                    $lastSlashPos = strrpos($url, '/');
                                                    $fileName = substr($url, $lastSlashPos + 1);
                                                    $pdf = $pdfParser->parseFile(public_path('content/' . $fileName));
                                                    $text = $pdf->getText();
                                                @endphp
                                                {!! nl2br(e($text)) !!}
                                            @endif
                                        </div>
                                    @endif
                                    <!-- <div class="modal-body">
                                            <img id="image" src="{{ $item->content }}"
                                                style="height: 461px;width: 467px" alt="Click on button" />
                                        </div> -->

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($item->promoted == 0)
                            <a href="{{ URL::to('admin/galary/status/'.$item->id.'/promoted') }}"
                               class="btn btn-success btn-sm">Promoted</a>
                        @elseif($item->promoted == 1)
                            <a href="{{ URL::to('admin/galary/status/'.$item->id.'/demote') }}"
                               class="btn btn-danger btn-sm">Demote</a>
                        @endif
                    </td>
                    <td>
                        @if($item->is_featured == 0)
                            <a href="{{ URL::to('admin/galary/status/'.$item->id.'/featured') }}"
                               class="btn btn-success btn-sm">Feature Content</a>
                        @elseif($item->is_featured == 1)
                            <a href="{{ URL::to('admin/galary/status/'.$item->id.'/mature') }}"
                               class="btn btn-danger btn-sm">Mature</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ URL::to('admin/galary/status/'.$item->id.'/'.$item->status) }}"
                           class="<?php echo ($item->status==1?'btn btn-sm btn-success':' btn-sm btn btn-danger'); ?>">
                                <?php echo($item->status == 1 ? 'Activate' : 'De-activate'); ?>
                        </a>
                        {{-- <a href="{{ route('admin.gallerycontent.delete',[$item->id]) }}" class="btn  btn-sm btn-danger">Delete</a> --}}

                        <a href="javascript:;"
                           onclick="confirmDelete('content',`{{ route('admin.gallerycontent.delete',[$item->id]) }}`)"
                           class="btn btn-sm btn-danger">Delete&nbsp;</a>
                    </td>
                    {{-- <td>
                        <button type="button" class="text-primary mr-2 border-0 bg-transparent"
                            onclick="edittag(this, {{ $item->id }})">Edit</button>
                            <button type="button" class="text-danger mr-2 border-0 bg-transparent"
                            wire:click="destory({{ $item->id }})">Delete</button>
                     </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="2">No More Data Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Showing {{ $gallary_item->firstItem() ? $gallary_item->firstItem() : 0 }} to
                {{ $gallary_item->lastItem() ? $gallary_item->lastItem() : 0 }} of
                {{ $gallary_item->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{-- {{ $gallary_item->links('vendor.pagination.adminpanel') }} --}}
                    {{ $gallary_item->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script>
    $(".show-more a").on("click", function () {
        var $this = $(this);
        var $content = $this.parent().prev("div.content");
        var linkText = $this.text().toUpperCase();

        if (linkText === "SHOW MORE") {
            linkText = "Show less";
            $content.switchClass("hideContent", "showContent", 400);
        } else {
            linkText = "Show more";
            $content.switchClass("showContent", "hideContent", 400);
        };

        $this.text(linkText);
    });

</script> -->
<!-- <style>
    .hideContent {
        overflow: hidden;
        width: 200px;
        height: 2em;
    }

    .showContent {

        width: 400px;
    }

    .showContent {
        width: 400px;
    }


    .show-more {
        padding: 10px 0;
        text-align: left;
    }

</style> -->

<script>
    $(document).ready(function () {
        $('.show-more').click(function () {
            $(this).hide();
            $(this).siblings('.more-text').show();
            $(this).siblings('.show-less').show();
        });
        $('.show-less').click(function () {
            $(this).hide();
            $(this).siblings('.more-text').hide();
            $(this).siblings('.show-more').show();
        });
    });
</script>
