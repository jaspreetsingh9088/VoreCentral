@extends('front.homepage.setting.layout.app')

@section('title', 'Achievement')
@section('style')
    @php
        $image = url('achievement_icon.webp');
    @endphp
    <style>
        .align-middle-cls{
            margin-bottom: 40px;
        }
        .achievement_fig{
            width: 100%;
            height: 80px;
            /* background: url({{ $image }}) no-repeat; */
            /* background-size: cover; */
            /* margin-bottom: 40px; */
        }

        .src_checks {
            margin-top: 15px;
        }

        .achievement_fig .img-overlaw{
            /* position: absolute; */
            /* top: 9px; */
            /* left: 29px; */
            width: 60%;
            height: 100%;
            /* transform: translate(50%, 50%); */
        }


        .src_checks .form-group {
            display: table-cell;
            margin-bottom: 10px;
        }
        .src_checks form{
            display: table;
            width: 100%;
        }
        .src_checks .form-group input {
            padding: 0;
            height: initial;
            width: initial;
            margin-bottom: 0;
            /* display: none; */
            cursor: pointer;

        }
        .news_archieve_wrapper.achievement_wrap .src_checks .form-group input{
            opacity: 1;
        }
        /* .src_checks .form-group label {
            position: relative;
            cursor: pointer;
            font-weight: 500;
            color: #000;
            font-size: 18px;
            margin-right: 20px;
        } */
        .src_checks .form-group span {
            position: relative;
            cursor: pointer;
            font-weight: 500;
            color: #000;
            font-size: 18px;
            margin-right: 20px;
        }
        /* .src_checks .form-group label:before {
            content:'';
            -webkit-appearance: none;
            background-color:#fff;
            border: 3px solid #000;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 10px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 10px;
            float: left;
            width: 22px;
            height: 22px;
        }
        .src_checks .form-group input:checked + label:after {
            content: '';
            display: block;
            position: relative;
            top: -8px;
            float: left;
            right:25px;
            width: 12px;
            height: 29px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        } */
        .src_checks .form-group .labeldisabled{
            color: #484242;
        }
        .src_checks .form-group .labeldisabled:before{
            background-color: #a1a1a1;
        }
        .news_archieve_wrapper.achievement_wrap .src_checks .form-group input{
            background-color: #fff;
            border: 3px solid #000;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 10px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 10px;
            float: left;
            width: 22px;
            height: 22px;
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
                        <div class="news_archieve_wrapper achievement_wrap">
                            <form action="{{ route('achievement.store') }}" method="post">
                                @csrf
                                @php $userpoint = Auth::user()->points; @endphp
                                @if(Auth::user()->role_preference == 'pred' || Auth::user()->role_preference == 'Pred')
                                    <input type="hidden" name="role" value="pred">
                                    @foreach($achievement_pred  as $ap)
                                        @php
                                            $show = 0;
                                        @endphp
                                        @if(($userpoint > 0) && $ap->name == "Maiden")
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 5) && $ap->name == "Madame")
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 30) && $ap->name == 'Lady')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 100) && $ap->name == 'Countess')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 251) && $ap->name == 'Baroness')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 501) && $ap->name == 'Duchess')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 1001) && $ap->name == 'Princess')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 4001) && $ap->name == 'Grand Princess')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 7501) && $ap->name == 'Archduchess')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 10001) && $ap->name == 'Queen')
                                            @php $show = 1; @endphp
                                        @elseif(($userpoint > 50000) && $ap->name == 'Empress')
                                            @php $show = 1; @endphp
                                        @endif
                                        @php
                                            $achievements = json_decode(Auth::user()->achievements);
                                        @endphp
                                        <div class="row align-middle-cls">
                                            <div class="col-lg-2">
                                                <div class="achievement_fig">
                                                    <img src="{{ strtolower(str_replace(' ','-',$ap->images)) }}" class="img-overlaw" alt="" @if($show == 0) style="opacity : 0.2;" @endif>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="src_checks">
                                                    <div class="form-group" @if($show != 0) onclick="selectrank(this)" @endif>
                                                        <input type="checkbox" id="pritag235" name="achievements[]" value="{{ $ap->name }}" @if($show == 0) disabled @endif
                                                        @if(is_array($achievements) && in_array($ap->name,$achievements)) checked @endif>
                                                        <span for="pritag235" class="achivement_cls @if($show == 0) labeldisabled @endif">{{ $ap->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @elseif(Auth::user()->role_preference == 'prey' || Auth::user()->role_preference == 'Prey')
                                    <input type="hidden" name="role" value="prey">
                                    @foreach($achievement_prey  as $ap)
                                        @php
                                            $disabled = 0;
                                            if($userpoint > 0 && $ap->name == 'French fry'){
                                                $disabled = 1;
                                            }elseif($userpoint > 6 && $ap->name == "Chocolate Chip Cookie") {
                                                $disabled = 1;
                                            }elseif(($userpoint > 30) && $ap->name == "Cupcake") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 101) && $ap->name == "Cream Cheese Sushi Roll") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 251) && $ap->name == "BBQ Ribs Sandwich") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 501) && $ap->name == "Vanilla Strawberry Cake") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 1001) && $ap->name == "Bucket of Fried Chicken") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 4001) && $ap->name == "Cheeseburger-Lasagna") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 7501) && $ap->name == "Marzipan Icecream-Cheese-Cake") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 10001) && $ap->name == "Deepfried-Pizzas-With-Baconcheeseburgers-and-Icecream-and-Cheesecake-Taco-Lasagna with Chocolate-Strawberry-Honey-Buttercream-Sorbet for dessert") {
                                                $disabled = 1;
                                            }
                                            elseif(($userpoint > 50001) && $ap->name == "A feast for a queen") {
                                                $disabled = 1;
                                            }
                                            $achievements = json_decode(Auth::user()->prey_achievements);
                                            // dd(Auth::user(),$achievements);
                                        @endphp
                                        <div class="row align-middle-cls">
                                            <div class="col-lg-2">
                                                <div class="achievement_fig">
                                                <img src="{{ strtolower(str_replace(' ','-',$ap->images)) }}" class="img-overlaw" alt="" @if($disabled == 0) style="opacity : 0.2;" @endif>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="src_checks">
                                                    <div class="form-group" @if($disabled != 0) onclick="selectrank(this) @endif">
                                                        <input type="checkbox" id="pritag235" name="achievements[]" value="{{ $ap->name }}" @if($disabled == 0) disabled @endif
                                                            @if(is_array($achievements) && in_array($ap->name,$achievements)) checked @endif>
                                                        <span for="pritag235" class="achivement_cls @if($disabled == 0) labeldisabled @endif">{{ $ap->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                                <div class="form-group d-flex justify-content-center">
                                    <input type="submit" name="submit" class="btn-info btn"  value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        function selectrank(row)
        {
            var firstInput = row.getElementsByTagName('input')[0];
            firstInput.checked = !firstInput.checked;
        }
    </script>
@endpush
