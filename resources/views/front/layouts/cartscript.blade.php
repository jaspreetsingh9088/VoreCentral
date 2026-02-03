<script>
    $(document).ready(function() {
        $('#cartModal').one('click',function() {
            var html = "";
            var total = "";
            var image = "";
            $(".cart_table").append(html);
            $(".total").append(total);
            $.ajax({
                url: '{{ route('getCartItems') }}',
                type: 'GET',
                success: function(data) {
                    if (data.code === 200) {
                        if(data.cartItems.length == 0){
                            html = '<tr align="center">\
                                <td class="text-center" colspan="3">You do not have any product yet. Please add to view here</td>\
                            </tr>';
                            $(".cart_table").append(html);
                        }else{
                            $('#totalproduct').html(data.cartItems.length);
                        }
                        $.each(data.cartItems, function(k, cartItem) {
                            image = "{{ asset('thumbnail') }}" + '/' + cartItem
                                .paidcontent.thumbnail;
                            html =
                                '<tr><td data-th="Product"><div class="row"><div class="col-md-3 text-left"><img src=' +
                                image +
                                ' alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow"></div><div class="col-md-9 text-left mt-sm-2"><h4>' +
                                cartItem.paidcontent.title +
                                '</h4><p class="font-weight-light"></p></div></div></td><td data-th="Price">$' +
                                cartItem.paidcontent.price +
                                '</td><td class="text-center"><a class="remove-from-cart" id="removeItem" data-id="' +
                                cartItem.id +
                                '" href="javascript:void(0);" data-toggle="tooltip" title="" data-original-title="Remove item">Remove</a></td></tr>';
                            $(".cart_table").append(html);
                        });
                        total = "$" + data.total;
                        $(".total").append(total);
                    } else {
                        html = '<tr align="center">\
                            <td class="text-center" colspan="3">You do not have any product yet. Please add to view here</td>\
                        </tr>';
                        $(".cart_table").append(html);
                        toastr.error("Something went wrong.");
                    }
                },
                error: function(xhr, status, error) {
                    html = '<tr align="center">\
                        <td class="text-center" colspan="3">You do not have any product yet. Please add to view here</td>\
                    </tr>';
                    $(".cart_table").append(html);
                }
            });
        });
        
        $(document).on('click','#removeItem',function(){
            var id = $(this).data("id");
            $.ajax({
                url: '{{ route('removeItem') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    toastr.options = {
                        preventDuplicates: true,
                        timeOut: 4000,
                        progressBar: true,
                    }
                    if (data.code === 200) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 4000);
                    } else {
                        toastr.error("Something went wrong.");
                    }

                },
                error: function(xhr, status, error) {
                    // handle error response from the server
                }
            });
        });
    });
</script>