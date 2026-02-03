<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rav-popup">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                    <p class="mb-2 text-center">
                        Total <i class="text-info font-weight-bold" id="totalproduct"></i> items in your cart
                    </p>
                    <table id="shoppingCart" style="width: 100%;border: 1px solid black;" class="p-2 border-1{{--table table-condensed table-responsive--}}">
                        <thead>
                            <tr>
                                <th {{--style="width:38%"--}}>Product</th>
                                <th {{--style="width:15%"--}}>Price</th>
                                <th {{--style="width:5%"--}}></th>
                            </tr>
                        </thead>
                        <tbody class="cart_table">
                            
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Subtotal:</h4>
                        <h1 class="total"></h1>
                    </div>
                </div>
            </div>
            <div class="row mt-2 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right">
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
                </div>
                <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                    <a href="#" class="btn btn-primary "> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
