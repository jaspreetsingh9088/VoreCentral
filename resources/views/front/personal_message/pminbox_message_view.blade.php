@extends('front.personal_message.layout.app')
@section('title', 'Message View')
@section('style')
    <style>
        .pm-inbox-middle {
            border-top: 2px solid #000;
        }
        .pm-inbox-middle, .pm-inbox-right {
            margin-top: 25px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem !important;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -18px;
            margin-left: -18px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        p.messgae_header {
            color: #000;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 0px;
            margin: 0px 27px;
        }
        p {
            font-size: 15px;
            margin-bottom: 0.5rem;
            line-height: 1.8;
            margin: 0px 27px;
        }
        p.send_mail_link a {
            font-size: 16px;
            color: #031362;
            font-weight: 600;
        }
        .message_inbox_val {
            font-size: 16px;
            color: #000;
            font-weight: 600;
            margin: 0px 27px;
        }
        @media (min-width: 992px)
            .col-lg-8 {
                flex: 0 0 66.66667%;
                max-width: 66.66667%;
            }
    </style>
@endsection
@section('content')
<section class="pm-inbox-wrapper">
  <div class="container-fluid">
       <div class="row">
          <div class="col-lg-3 pr-0">
              <div class="pm-inbox-left">
                  <div class="pminbox_sidebar">
                      <ul class="list-none">
                        <li><a href="{{ route('pminbox')}}">Inbox</a></li>
                        <li><a href="{{ route('pmsendmessage')}}">Sent messages</a></li>
                        <li><a href="{{route('newpm')}}">New PM</a></li>
                        <li><a href="{{route('pmsendmessage')}}">Message users</a></li>
                        <li><a href="{{route('pmfriends')}}">Friends</a></li>
                        <li ><a href="{{route('pmdraft')}}">Drafts</a></li>
                        <li><a href="{{ route('socialOption')}}">Social Options</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-lg-9">

               <div class="pm-inbox-adspace">
                    <div class="ad_banner landscape">
                        <div data-banner-id="425470"></div>
                    </div>

               </div>


               <div class="row">
                  <div class="col-lg-8 p-0" >

                      <div class="pm-inbox-middle middle-part-pm-message">
                           <div class="row mb-3">
                           @foreach($data as $views)
                               <div class="col-md-6">

                              <p class="messgae_header">From : </p>
                                  <p class="send_mail_link"><a href="{{route('sendMsgtoUser', $views->id)}}">{{$views->receiver->email}}</a></p>
                              </div>
                              <div class="col-md-6 text-right">

                                  <p class="message_inbox_val">{{($views->created_at)->format('d/m/Y')}}</p>
                              </div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-md-12">
                                  <p class="messgae_header">Subject : </p>
                                  <p class="message_inbox_val">{{$views->subject}}</p>
                              </div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-md-12">
                              <div class="message_inbox_val">
                              <p class="messgae_header" style="margin: 0px 0px;">Message : </p>
                              {!!$views->message!!}
                              </div>
                              </div>
                              @endforeach
                           </div>



                      </div>

                  </div>

               </div>

          </div>

       </div>
  </div>
</section>
@endsection
