@extends('front.creatorvisitor.layout.app')
@section('title', 'Journal')
@section('bodyclass','green_theme subforums_page')
@section('content')
    <section class="dlc-wrapper creatorjournal">
        <div class="container">
            <div class="creator-jornal-pg">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="user-section1" style="height:auto;margin-top:0px;">
                        <div class="col-md-10" style="padding: 20px;color: #fff;">
                            <ul>
                            <?php
                                if(isset($JournalData) && is_array($JournalData) && count($JournalData) > 0){
                                    foreach($JournalData as $JournalDataK => $JournalDataV){ ?>
                                        <li>
                                            {{$JournalDataV['heading']}}
                                            <br>
                                            {{$JournalDataV['title']}}
                                        </li>
                                        <?php
                                    }
                                }else{ ?>
                                    <h3 class="text-center">Data not found.</h3>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="creator-jornal-right pt-4">
                            <h4>Journal History</h4>
                            <img src="assets/images/long-add.webp" style="width:300px;height:400px;" alt=""/>
                            <img src="assets/images/add.webp" class="mt-4" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
