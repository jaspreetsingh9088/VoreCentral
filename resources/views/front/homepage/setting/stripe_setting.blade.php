@extends('front.homepage.setting.layout.app')
@section('title', 'Stripe Setting')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        .card-group {
            font-size: 20px;
            width : 100%;
        }

        .card {
            position: relative;
            height: 270px;
            width: 450px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(30px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .logo img,
        .chip img,
        .number,
        .name,
        .from,
        .to,
        .ring {
        position: absolute; /* All items inside card should have absolute position */
        }

        .logo img {
            top: 35px;
            right: 40px;
            width: 80px;
            height: auto;
            opacity: 0.8;
        }

        .chip img {
            top: 120px;
            left: 40px;
            width: 50px;
            height: auto;
            opacity: 0.8;
        }

        .number,
        .name,
        .from,
        .to {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
            letter-spacing: 2px;
            text-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
        }

        .number {
            left: 40px;
            bottom: 65px;
            font-family: "Nunito", sans-serif;
        }

        .name {
            font-size: 0.9rem;
            left: 40px;
            bottom: 35px;
        }

        .from {
            font-size: 0.9rem;
            bottom: 35px;
            right: 125px;
        }

        .to {
            font-size: 1.5rem;
            bottom: 35px;
            right: 40px;
            z-index: 9999;
            cursor: pointer;
        }

        /* The two rings on the card background */
        .ring {
            height: 500px;
            width: 500px;
            border-radius: 50%;
            background: transparent;
            border: 50px solid rgba(255, 255, 255, 0.1);
            bottom: -250px;
            right: -250px;
            box-sizing: border-box;
        }

        .ring::after {
            content: "";
            position: absolute;
            height: 600px;
            width: 600px;
            border-radius: 50%;
            background: transparent;
            border: 30px solid rgba(255, 255, 255, 0.1);
            bottom: -80px;
            right: -110px;
            box-sizing: border-box;
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
                    <div class="news_archieve_odd src-sort p-3">
                        <div class="row">
                            @if(count($carddata) > 0)
                                @for($i = 0; $i < count($carddata); $i++)
                                    <div class="col-md-6">
                                        <div class="card-group mb-2">
                                            <div class="card">
                                                @if($carddata[$i]['brand'] == 'Visa')
                                                    <div class="logo">
                                                        {{-- <img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/Visa-Logo-PNG-Image.png" alt="Visa"> --}}
                                                        <img src="{{ url('/assets/images/Visa-Logo-PNG-Image.png') }}" alt="Visa">
                                                    </div>
                                                @endif
                                                <div class="chip">
                                                    {{-- <img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/chip.png" alt="chip"> --}}
                                                    <img src="{{ url('/assets/images/chip.png') }}" alt="chip">
                                                </div>
                                                <div class="number">**** **** **** {{ $carddata[$i]['last'] }}</div>
                                                <div class="name">{{ Auth::user()->username }}</div>
                                                <div class="from">{{$carddata[$i]['exp_month']}}/{{$carddata[$i]['exp_year']}}</div>
                                                <div class="to">
                                                    @if(count($carddata) != 1)
                                                        <span class="delete-card-btn text-danger font-weight-bold" onclick="deletecard(`{{ $carddata[$i]['id'] }}`)">Delete</span>
                                                    @endif
                                                </div>
                                                <div class="ring"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn-info btn addcard_btn"
                        data-toggle="modal" data-target=".bd-example-modal-lg"
                        style="background: #3390b4;color: black;font-weight: bold;padding: 15px 45px;">
                        Add Card
                        </button>
                    </div>
                </div>
            </div>
       </div>
    </div>
</section>
<div class="modal fade" id="addcard-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('stripe.card.store') }}" method="post" redirecturl="{{ route('stripe.setting') }}" id="addcard_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Card Number</label>
                        <input name="card_number" type="number" class="form-control" placeholder="4242 4242 4242 4242" minlength="16" maxlength="16" >
                    </div>
                    <div class="form-group">
                        <label for="">CVC</label>
                        <input name="cvc_number" type="number" class="form-control" placeholder="123" minlength="3" maxlength="3">
                    </div>
                    <div class="form-group">
                        <label for="">Exp. Month</label>
                        <input name="exp_month" type="number" class="form-control" placeholder="01" minlength="1" maxlength="2">
                    </div>
                    <div class="form-group">
                        <label for="">Exp. Year</label>
                        <input name="exp_year" type="number" class="form-control" placeholder="2025" minlength="4" maxlength="4">
                    </div>
                    <div class="form-group">
                        <div id="addcard_form-errors"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script>
    function deletecard(id){
        let text = "Are you sure want to delete card";
        if (confirm(text) == true) {
            var cardid = id;
            var url = "{{ url('/stripe-card-delete') }}/"+cardid;
            $.ajax({
                type: 'GET',
                url: url,
                contentType: false,
                processData: false,
                success: function(response) {
                    location.reload();
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function(k, v) {
                        alert(v);
                    });

                }
            });
        } else {
            text = "You canceled!";
        }
    }
    $('#addcard_form').submit(function(e) {
        e.preventDefault();
        var frm = $("#addcard_form");
        var data = new FormData(this);
        var redirecturl = $(this).attr("redirecturl");
        $('#addcard_form-errors').empty();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.replace(redirecturl);
            },
            error: function(data) {
                var errors = data.responseJSON;
                errorsHtml = '<strong class="text-danger">';
                $.each(errors.errors, function(k, v) {
                    errorsHtml += v + ', ';
                });
                errorsHtml += '</strong>';
                $('#addcard_form-errors').html(errorsHtml);
            }
        });
    });
    $('.addcard_btn').click(function(){
        // $('.addcard-modal').modal('show');
        $('#addcard-modal').modal('show');

    })
</script>
@endsection
