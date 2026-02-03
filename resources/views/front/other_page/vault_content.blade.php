<style>
.preview-pic {
  border: 3px solid #000;
  background: #fff;
  margin: 0 0 30px;
  height: 500px;
  overflow: hidden;
}
.mfp-close{
    margin-right: 15px;
}
</style>
<div class="row">
    <div class="col-md-8 offset-2">
        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
        <div class="preview-pic">
            @if (isset($data) )
                                            
                @php
                    $striped_content = '';
                    $content = '';
                    $ext = pathinfo($data->content, PATHINFO_EXTENSION);
                    $audiofilepath = '';
                    $docxfilepath = '';
                    
                @endphp
                @if (!empty($data->video_url))
                    <iframe width="560" height="315" src="{{ $data->video_url }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                    </iframe>
                @else
                    <div style="padding: 0.7em; max-height:800px; overflow-y: auto;background-color: #fff;border:0.3rem solid gray;">
                        @if ($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'webp')
                            @php
                                $url = $data->content;
                                $lastSlashPos = strrpos($url, '/');
                                $fileName = substr($url, $lastSlashPos + 1);
                            @endphp
                            {{-- <a href="{{ asset('content/' . $fileName) }}" class="mfp-image">
                                <img src="{{ $data->content }}" alt="" srcset="" width="100%">
                            </a> --}}
                            <a href="{{ $data->content }}" data-fancybox data-caption="{{ $data->title }}">
                                <img src="{{ $data->content }}" alt="" srcset="" width="100%">
                            </a>
                        @elseif($ext == 'mp3' || $ext == 'wav')
                            @php
                                $audiofilepath = $data->content;
                            @endphp
                            <div class="">
                                <div id="waveform"></div>
                                <div class="controls">
                                    <img src="{{ asset('media/play.png') }}" alt="" id="playBtn">
                                    <img src="{{ asset('media/stop.png') }}" alt="" id="stopBtn">
                                    <img src="{{ asset('media/volume.png') }}" alt="" id="volumeBtn">
                                </div>
                            </div>
                        @elseif($ext == 'webm' || $ext == 'mp4')
                            <video width="100%" height="100%" controls controlsList="nodownload">
                                <source src="{{ $data->content }}" type="video/{{ $ext }}">
                            </video>
                        @elseif($ext == 'txt')
                            @php
                                $url = $data->content;
                                $lastSlashPos = strrpos($url, '/');
                                $fileName = substr($url, $lastSlashPos + 1);
                                $contents = File::get(public_path('content/' . $fileName));
                            @endphp
                            {!! nl2br(e($contents)) !!}
                        @elseif($ext == 'rtf')
                            @php
                                $url = $data->content;
                                $lastSlashPos = strrpos($url, '/');
                                $fileName = substr($url, $lastSlashPos + 1);
                                $rtf = File::get(public_path('content/' . $fileName));
                                $document = new RtfHtmlPhp\Document($rtf);
                                $formatter = new RtfHtmlPhp\Html\HtmlFormatter('UTF-8');
                                echo $formatter->Format($document);
                            @endphp
                        @elseif($ext == 'docx')
                            @php
                                $docxfilepath = $data->content;
                            @endphp
                            <div class="" id="docstext"></div>
                        @elseif($ext == 'doc')
                            @php
                                $url = $data->content;
                                // $lastSlashPos = strrpos($url, '/');
                                // $fileName = substr($url, $lastSlashPos + 1);
                                // $file = public_path('content/'.$fileName);
                                // if (($fh = fopen($file, 'r')) !== false) {
                                //     $headers = fread($fh, 0xa00);
                                //     // read doc from 0 to 255 characters
                                //     $n1 = ord($headers[0x21c]) - 1;
                                //     // read doc from 256 to 63743 charact   ers
                                //     $n2 = (ord($headers[0x21d]) - 8) * 256;
                                //     // read doc from 63744 to 16775423 characters
                                //     $n3 = ord($headers[0x21e]) * 256 * 256;
                                //     //read doc from 16775424 to 4294965504 characters
                                //     $n4 = ord($headers[0x21f]) * 256 * 256 * 256;
                                //     // Total length of text in the document
                                //     $textLength = $n1 + $n2 + $n3 + $n4;
                                //     ini_set('memory_limit', '-1');
                                //     $extracted_plaintext = fread($fh, abs($textLength));
                                //     // echo nl2br($extracted_plaintext);
                                // }
                                @endphp
                                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{$url}}" width='100%' height='900px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                        @elseif($ext == 'pdf')
                            @php
                                $pdfParser = new \Smalot\PdfParser\Parser();
                                $url = $data->content;
                                $lastSlashPos = strrpos($url, '/');
                                $fileName = substr($url, $lastSlashPos + 1);
                                $pdf = $pdfParser->parseFile(public_path('content/' . $fileName));
                                $text = $pdf->getText();
                            @endphp
                            {!! nl2br(e($text)) !!}
                        @endif
                    </div>
                @endif

        @endif
        </div>
    </div>
</div>