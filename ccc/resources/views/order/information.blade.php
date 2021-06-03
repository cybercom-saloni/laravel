<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Order Details</h3>
<hr>


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
            <td>Rs. @php $rowtotal = $orderItem->quantity*$orderItem->price; $value = $rowtotal - $rowtotal*($orderItem->discount/100)@endphp {{number_format($value, 2)}}</td>
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
 <h3>Order Comment</h3>
 @if(session('orderStatus'))
<div class="alert alert-success ad" style="display:block">{{session('orderStatus')}}</div>
@endif
<table class="table table-bordered bg-light  table-hover">
    <thead>
        <tr>
            <th>Comment</th>
            <th>Status</th>
            <th>Date And Time</th>
         </tr>
    </thead>
    <tbody>
    
        @if ($comments)
            @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->comment ? $comment->comment : '-' }}</td>
                <td>{{ $comment->status }}</td>
                <td>{{ $comment->created_at }}</td>
            </tr>
            @endforeach
        @endif
            <tr>
                <td colspan="3">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                    <form action="saveComment/{{$orderDetails->id}}" method="post" id='comments'>
                    @csrf
                            <div class="form-group col-md-12">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" name="comments[comment]" id="comment" rows="2" style="resize: none"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="status">Select Status</label>
                                <select class="form-control" name="comments[status]" id="status">
                                    <option selected disabled> Select Status </option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirm">Confirm</option>
                                    <option value="InProcess">In Process</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button type="button" id='saveComment'class="btn btn-primary"> Save Status</button>
                            </div>
                    </form>
                </td>
             </tr>
    </tbody>
</table>

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

<script>
    $(function() {
        $('#saveComment').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'saveComment/{{$orderDetails->id}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                data: $('#comments').serializeArray(),
                success : function(data) {
                        if($.isEmptyObject(data.error)){
                            if(typeof data.element == 'object') {
                                 $(data.element).each(function(i, element) {
                                        $('#content').html(element.html);
                                 });
                                }
                        }else{
                            printErrorMsg(data.error);
                        }
                     }

                });
            });
            function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $(".ad").css('display','none');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
</script>


