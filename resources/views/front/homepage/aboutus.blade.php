@extends('front.homepage.layout.app')
@section('title', 'About Us')
@section('content')
<section class="viewhistory-wrapper" style="height: 100vh;">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-1"></div>
         <div class="col-lg-10">
            {{-- <div class="search_box_forums">
               <div class="d-flex search_box justify-content-end">
                  <span class="mr-3 text-danger">
                     <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                     </div>
                  </span>
               </div>
            </div> --}}
            <div class="news_archieve_wrapper about_content">
                  <?php
                  if(isset($aboutcontent) && is_array($aboutcontent) && count($aboutcontent) > 0 ){
                     foreach($aboutcontent as $aboutcontentK => $aboutcontentV){
                        foreach($aboutcontentV['sections'] as $sectionK => $sectionKV){
                           echo $sectionKV['text'] ;
                        }
                     }
                  }
                  ?>
            </div>
         </div>
         <div class="col-lg-1"></div>
      </div>
   </div>
</section>
@endsection
@push('script')
    
@endpush