<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Order Details</h3>
<hr>

<div class="col-12">
    <div class ="row">
        <div class ="col-12">
            <h6>Customer Details</h6>
            <table>
                <tr>
                    <td>Customer Name :-</td>
                    <td>{{$customer->firstname}} {{$customer->lastname}}</td>
                </tr>
                <tr>
                    <td>Email Address:-</td>
                    <td>{{$customer->email}}</td>
                </tr>
                <tr>
                    <td>Contact Number:-</td>
                    <td>{{$customer->contactno}}</td>
                </tr>
                <tr>
                    <td>Payment Details:-</td>
                    <td>{{$controller->getPaymentName($orderDetails->paymentId)}}</td>
                </tr>
                <tr>
                    <td>Shipping Details:-</td>
                    <td>{{$controller->getShippingName($orderDetails->shippingId)}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="col-12">
    <div class ="row">
        <div class ="col-6">
            <h6>Billing Address</h6>
            <table>
                <tr>
                    <td>Address :-</td>
                    <td>{{$orderBillingAddressDetails[0]->address}}</td>
                </tr>
                <tr>
                    <td>Area :-</td>
                    <td>{{$orderBillingAddressDetails[0]->area}}</td>
                </tr>
                <tr>
                    <td>City :-</td>
                    <td>{{$orderBillingAddressDetails[0]->city}}</td>
                </tr>
                <tr>
                    <td>Area :-</td>
                    <td>{{$orderBillingAddressDetails[0]->state}}</td>
                </tr>
                <tr>
                    <td>City :-</td>
                    <td>{{$orderBillingAddressDetails[0]->zipcode}}</td>
                </tr>
                <tr>
                    <td>Area :-</td>
                    <td>{{$orderBillingAddressDetails[0]->country}}</td>
                </tr>
            </table>
        </div>
        <div class ="col-6">
        <h6>Shipping Address</h6>
            <table>
            <tr>
                    <td>Address :-</td>
                    <td>{{$orderShippingAddressDetails[0]->address}}</td>
                </tr>
            <tr>
                    <td>Area :-</td>
                    <td>{{$orderShippingAddressDetails[0]->area}}</td>
                </tr>
                <tr>
                    <td>City :-</td>
                    <td>{{$orderShippingAddressDetails[0]->city}}</td>
                </tr>
                <tr>
                    <td>Area :-</td>
                    <td>{{$orderShippingAddressDetails[0]->state}}</td>
                </tr>
                <tr>
                    <td>City :-</td>
                    <td>{{$orderShippingAddressDetails[0]->zipcode}}</td>
                </tr>
                <tr>
                    <td>Area :-</td>
                    <td>{{$orderShippingAddressDetails[0]->country}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<table class="table table-bordered bg-light  table-hover">
    <thead class="bg-dark text-white">
        <tr>
        <th>PRODUCT NAME</th>
        <th>BASE PRICE</th>
        <th>QUANTITY</th>
        <th>DISCOUNT</th>
        <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItemsDetails as $orderItem)
        <tr>
           <td>{{$controller->getProductName($orderItem->productId)}}</td>
            <td>Rs.{{$orderItem->basePrice}}</td>
            <td>{{$orderItem->quantity}}</td>
            <td>{{$orderItem->discount}}%</td>
            <td>Rs. @php $rowtotal = $orderItem->quantity*$orderItem->price @endphp {{$rowtotal - $rowtotal*($orderItem->discount/100)}}.00</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Shipping Charge</td>
            <td>Rs.{{$orderDetails->shippingAmount}}</td>
        </tr>
        <tr>
        <td colspan="4">Total</td>
            <td>Rs.{{$orderDetails->total}}</td>
        </tr>
    </tbody>
</table>