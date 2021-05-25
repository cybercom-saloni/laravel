<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Order Details</h3>
<hr>
@if(session('changeCustomer'))
<div class="alert alert-success">{{session('changeCustomer')}}</div>
@endif
<form action="/order/customer" method="post" id="customerId">
    @csrf
    <div class="form-group">
        <label for="customer">Select Customer</label>
        <select name="customer" id="customer" class="form-control col-lg-5">
                <option disabled selected>select</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" 
                        {{ Session::has('ordercustomerId') ? (Session::get('ordercustomerId') == $customer->id ? 'selected' : '') : '' }}>
                        {{ $customer->firstname . ' ' . $customer->lastname }}
                    </option>
                @endforeach 
        </select>
    </div>
</form>
<div class="col-12">
    <div class ="row">
        <div class ="col-12">
            <h6>Customer Details</h6>
            <table>
                <tr>
                    <td>Customer Name :-</td>
                    <td>{{$customerDetails->firstname}} {{$customerDetails->lastname}}</td>
                </tr>
                <tr>
                    <td>Email Address:-</td>
                    <td>{{$customerDetails->email}}</td>
                </tr>
                <tr>
                    <td>Contact Number:-</td>
                    <td>{{$customerDetails->contactno}}</td>
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
                    <td>Country :-</td>
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
                    <td>Country :-</td>
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
<!-- <h3>Order Status</h3>
<table class="table table-bordered bg-light  table-hover">
<form action="" method="POST" id="form">
    <thead>
        <tr>
            <td>Status</td>
            <td> 
                 <select class="form-control" name="orderStatus" id="orderStatus">
                    <option selected disabled>Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="InProcess">InProcess</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </td>
            <select name="customer" id="customer" class="form-control col-lg-5">
                <option disabled selected>select</option>
                <option value="Pending">Pending</option>
                </select>
        <tr>
        <tr>
            <td></td>
            <td><button type="button" id="addressUpdate" class="btn btn-md btn-primary">Order Status</button></td>
        </tr>
    </thead>
</form>
</table> -->
<script>
 $(function() {
        $('#customer').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/order/customer',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                data: $('#customerId').serializeArray(),
                success: function(response) {
                    if (typeof response.element == 'undefined') {
                        return false;
                    }
                    if (typeof response.element == 'object') {
                        $(response.element).each(
                            function(i, element) {
                                $('#content').html(element.html);
                            })
                    } else {
                        $(response.element.selector).html(response
                            .element.html);
                    }
                }
            });
        });
    });

    // $(function(){
    //     $('#addressUpdate').on('click',function(e){
    //         e.preventDefault();
    //         $.ajax({
    //             type : 'POST',
    //             url : '/saveStatus',
    //             headers : {
    //                 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    //             },
    //             data : $('#form').serializeArray(),
    //             success : function(response)
    //             {
                   
    //                 if(typeof response.element == 'undefined')
    //                 {
    //                     return false;
    //                 }
    //                 if(typeof response.element == 'object')
    //                 {
    //                     $(response.element).each(
    //                         function(i,element)
    //                         {
    //                             $('#content').html(element.html);
    //                         }
    //                     )
    //                 }
    //                 else
    //                 {
    //                     $(response.element.selector).html(response.element.html);
    //                 }
    //             }
    //         });
    //     });
    // });  
 </script>


