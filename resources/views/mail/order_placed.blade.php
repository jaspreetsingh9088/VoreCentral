<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Order Placed</title>
    </head>

    <body>
        <p style="font-weight: 600;margin: 0;">Hi {{ $username }}</p> 
        <h2>Thank You for your order</h2>    
        <p>your order detail are... </p>
        @php $index=1; @endphp
        <table  border-color="#000" cellspacing="2" cellpadding="2" border="1" style="border-collapse: collapse;">
            <tr>
                <td>S.No.</td>
                <td>Thumbnail</td>
                <td>Item Name</td>
                <td>Cost</td>
                <td>Qty</td>
                <td>total</td>
            </tr> 
            @foreach ($cartItems as $cartItem)
            @php
                $subtotal =  $cartItem->price*$cartItem->quantity;
            @endphp
                <tr>
                    <td>{{ $index++}}.</td>
                    <td><img class="img-fluid mx-auto d-block image"
                        src="{{ $cartItem->paidcontent->thumbnail }}" width="100">  </td>
                    <td><a
                        href="{{ route('buyablecontent', $cartItem->paidcontent->id) }}">
                        {{ $cartItem->paidcontent->title }}</a></td>
                    <td>${{ $cartItem->price }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>${{ $subtotal }}</td>
                </tr> 
            @endforeach
        <tr>
            <td colspan="5" align="right"><strong>Grand Total:</strong></td>                       
            <td><strong>${{ $total }}</strong></td>
        </tr> 
    </table>
        
    
    <p>&nbsp;</p>
    <p>cheers</p>
    <p>{{$app_name}}</p>
</body>
</html>