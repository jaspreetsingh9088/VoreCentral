@extends('front.homepage.setting.layout.app')

@section('title', 'Tag Option')
@section('style')
<link rel="stylesheet" href="{{ url('public/assets/css/select2.css') }}" />
@endsection
@section('content')
    <section class="viewhistory-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                    <div class="view_history-outer p-0 m-0">
                        <div class="news_archieve_wrapper tags_warp">
                            <form class="row" action="{{ route('tagOptionStore') }}" method="post">                                
                                @csrf
                                <div class="col-lg-6">
                                    <div class="news_archieve_odd privacy_box">
                                        <div class="p-3">
                                            <div class="form-group">
                                                <label for="">My Tags</label>
                                                <select id="tags" name="tag[]" class="select2" style="width: 100%;" multiple>
                                                    @foreach($tag as $tg)
                                                        <option @if(isset($mytags) && in_array($tg->id, $mytags)) selected @endif value="{{ $tg->id }}">{{ $tg->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @foreach($tag as $tg)
                                                @if(isset($mytags) && in_array($tg->id,$mytags))
                                                    <span class="badge badge-secondary">{{$tg->title}}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="news_archieve_even privacy_box">
                                        <div class="p-3">
                                            <div class="form-group">
                                                <label for="">Antitags</label>
                                                <select id="antitags" name="antitag[]" class="select2" style="width: 100%;" multiple>
                                                    @foreach($antitags as $tg)
                                                        <option @if(isset($myantitag) && in_array($tg->id, $myantitag)) selected @endif value="{{ $tg->id }}">{{ $tg->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @foreach($antitags as $tg)
                                                @if(isset($myantitag) && in_array($tg->id,$myantitag))
                                                    <span class="badge badge-secondary">{{$tg->title}}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group " style="padding: 40px 0px;">
                                        <input type="submit" name="submit" class="btn-info btn" value="Submit">
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
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script>
        $('#tags').change(function(){
            var mytag = $(this).val();
            var myantitag = $('#antitags').val();
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('tag.drop.down') }}",
                data: { mytag : mytag, myantitag : myantitag, action : 'antitag', _token : token },
                method: 'post',
                dataType: 'JSON',
                success: function(response) {
                    $('#antitags').html(response);
                    $('.select2').select2({
                        closeOnSelect: false
                    });
                },
            });
        })
        $('#antitags').change(function(){
            var mytag = $('#tags').val();
            var myantitag = $(this).val();
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('tag.drop.down') }}",
                data: { myantitag : myantitag, mytag : mytag, action : 'mytag', _token : token },
                method: 'post',
                dataType: 'JSON',
                success: function(response) {
                    $('#tags').html(response);
                    $('.select2').select2({
                        closeOnSelect: false
                    });
                },
            });
        });
        $('.select2').select2({
            closeOnSelect: false
        });
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {

                    a[i].style.display = "";

                } else {

                    a[i].style.display = "none";

                }

            }

        }

    </script>
@endpush
