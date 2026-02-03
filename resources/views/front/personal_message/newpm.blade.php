@extends('front.personal_message.layout.app')
@section('title', 'Send Message')
@section('style')
    <style>
    .btn-design input[type="submit"] {
        background: url("{{ url('public/assets/images/orange-middle-pattern.webp') }}");
        padding: 10px 20px;
        background-size: contain;
        font-weight: bold;
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
                          <li class="page_active" ><a href="{{route('newpm')}}">New PM</a></li>
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

                  <div class="col-lg-8 p-2">
                  <form class="sign_up_form" action="{{ route('sendmsg')}}" class="card mb-3" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="pm-inbox-middle middle-part-pm-message">
                           <div class="row mb-3">
                               <div class="col-md-12"><label>To</label>
                               <select name="receiverid" class="form-control">
                                   <option value="0"> Select User</option>
                                                          @foreach($receiver as $receivers)
                                                                      <option value={{$receivers ->id}}>{{$receivers-> username}}</option>
                                                                      @endforeach
                                                                   </select>

                               </div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-md-12"><label>Subject</label><input type="text" value="" class="form-control"  name="subject" required /></div>
                           </div>

                           <div class="row mb-3">
                               <div class="col-md-12">
                                <textarea class="ckeditor" rows="4" name="message" style="width: 691px; height: 213px;"  class="form control" required></textarea>
                              </div>
                           </div>


                           <div class="row mb-3">
                               <div class="col-md-12 text-right btn-design">
                               <input type="submit" name="action_type" value="Save Draft" />
                               <input type="submit" name="action_type" value="Send PM" /></div>
                           </div>

                      </div>
                  </form>
                  </div>

                  <div class="col-lg-4 pl-0">
                      <div class="pm-inbox-right">

                      </div>
                  </div>
               </div>
          </div>

       </div>
  </div>
</section>
@endsection
@push('script')
    <script>
            CKEDITOR.replace( 'message' );
    </script>
@endpush
