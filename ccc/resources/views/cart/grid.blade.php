<h3 style="font-weight:bold; font-size:32px;" class="mt-2">View Cart</h3>
<hr>
@if(session('changeCustomer'))
<div class="alert alert-success">{{session('changeCustomer')}}</div>
@endif

<form action="/cart/customer" method="post" id="customerId">
    @csrf
    <div class="form-group">
        <label for="customer">Select Customer</label>
        <select name="customer" id="customer" class="form-control col-lg-5">
                <option disabled selected>select</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" 
                        {{ Session::has('customerId') ? (Session::get('customerId') == $customer->id ? 'selected' : '') : '' }}>
                        {{ $customer->firstname . ' ' . $customer->lastname }}
                    </option>
                @endforeach 
        </select>
    </div>
</form> 

<form method="POST" action="/cart/customer/addressSave" id="form">
@csrf

    <div class="col-12">
        <div class="row">
            <div class="col-6">
            <h3>BILLING ADDRESS </h3>
            <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Address</label>
                            </div>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="billingaddress" name="billing[address]"  placeholder="address"  required>{{$billing ? $billing->address : ' '}}</textarea>
                            </div>
                        </div>
                        @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.address'][0]);?>
                        </div>
                        @endif


                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Area</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingarea"  value="{{$billing ? $billing->area : ' '}}" name="billing[area]" placeholder="area"   required>
                            </div>
                        </div>
                         @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.area'][0]);?>
                        </div>
                        @endif
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> City</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingcity" value="{{$billing ? $billing->city : ' '}}" name="billing[city]" placeholder="city"  required>
                            </div>
                        </div>
                        @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.city'][0]);?>
                        </div>
                        @endif
                      

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> State</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingstate" value="{{$billing ? $billing->state : ' '}}" name="billing[state]" placeholder="state"  required>
                            </div>
                        </div>
                        @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.state'][0]);?>
                        </div>
                        @endif
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Zipcode</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingzipcode" value="{{$billing ? $billing->zipcode : ' '}}" name="billing[zipcode]" placeholder="zipcode"  required>
                            </div>
                        </div>
                        @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.zipcode'][0]);?>
                        </div>
                        @endif
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Country</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingcountry" name="billing[country]" value="{{$billing ? $billing->country : ' '}}" placeholder="country"   required>
                            </div>
                        </div>
                        @if(Session::get('billingCartError'))
                        <div class ="alert alert-danger">
                        <?php $output=Session::get('billingCartError');
                            Session::forget('AddressUpdated');
                            print_r($output->getMessages()['billing.country'][0]);?>
                        </div>
                        @endif
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                
                            </div>
                            <div class="col-lg-6">
                                <label for="firstname">Save in AddressBook</label>
                                <input type="checkbox"  id="billingsaveInAddressBook"  onclick="billingsaveInAddressBookFunction();"  name="billing[saveInAddressBook]" placeholder="saveInAddressBook"   required>
                            </div>
                        </div>
                </div>
                <div class="col-6">
                <h3>SHIPPING  ADDRESS</h3>
                <div class=" form-group row">
                            <div class="col-lg-4">
                                
                            </div>
                            <div class="col-lg-6">
                                <label for="firstname">Same as Billing</label>
                                <input type="checkbox"  onclick="sameAsBillingFunction();" id="sameAsBilling" name="shipping[sameAsBilling]" placeholder="saveInAddressBook"   required>
                            </div>
                </div>
                <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Address</label>
                            </div>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="address"  name="shipping[address]" placeholder="address"  required>{{$shipping ? $shipping->address : ' '}}</textarea>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Area</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{$shipping ? $shipping->area : ' '}}" id="area" name="shipping[area]" placeholder="area"   required>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> City</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" value="{{$shipping ? $shipping->city : ' '}}" id="city" name="shipping[city]" placeholder="city"   required>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> State</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control"value="{{$shipping ? $shipping->state : ' '}}" id="state" name="shipping[state]" placeholder="state"   required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Zipcode</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="zipcode" value="{{$shipping ? $shipping->zipcode : ' '}}" name="shipping[zipcode]" placeholder="zipcode"   required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Country</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="country" name="shipping[country]"value="{{$shipping ? $shipping->country : ' '}}" placeholder="country"   required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                            
                            </div>
                            <div class="col-lg-6">
                                <label for="firstname">Save in Address Book</label>
                                <input type="checkbox"  id="shippingsaveInAddressBook"onclick="shippingsaveInAddressBookFunction();" name="shipping[saveInAddressBook]" placeholder="saveInAddressBook"   required>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
  

<div class="col-12">
    <div class="row">
         <div class="col-6">
             <h3>Payment Method</h3>
             <table class="table-responsive">
                @foreach($controller->getPayment() as $key => $value)
                <tr>
                    <td><h6><input type="radio" name="payment" value="{{$value->id}}" <?php if($cart[0]->paymentId == $value->id) echo 'checked';?>>{{$value->name}}</h6></td>
                </tr>
               
                @endforeach
            </table>
         </div>
         <div class="col-6">
             <h3>Shipping Method</h3>
             <table class="table-responsive">
             @foreach($controller->getShipping() as $key => $value)
                <tr>
                   <td><h6><input type="radio" name="shippingMethod" value="{{$value->id}}" <?php if($cart[0]->shippingId == $value->id) echo 'checked';?>>{{$value->name}}</h6></td>
                   <td><h6>{{$value->amount}}</h6></td>
                </tr>
             @endforeach 
             </table>
         </div>
    </div>
    
</div>
@if(session('AddressUpdated'))
<div class="alert alert-success">{{session('AddressUpdated')}}</div>
@endif
<button type="button"  id="addressUpdate" class="btn btn-md btn-success">UPDATE</button><br>
</form>
<br>
@if($products->currentPage() != 1)
<div id="productId" style="display:block">
@else
<div id="productId" style="display:none">
@endif
<button type="button" name="addToCart" id="addToCart" class="btn btn-primary btn-md">Add Items To Cart</button>
    <hr>
    <form action="/cartItem/addItem" method="POST" id="productList">
        @csrf
        <table class="table table-bordered bg-light  table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Select Product</th>
                    </tr>
                </thead>
                <tbody>
            
                    @if (!$products)
                    
                        <tr>
                            <td colspan="12" class="text-center">No Records Found</td>
                        </tr>
                    @else
                        @foreach ($products as $value)
                            <tr>

                            <td>{{$value->sku}}</td>
                            <td>{{$value->name}}</td>
                            <td>Rs.{{$value->price}}</td>
                            <td>{{$value->discount}}%</td>
                            <td><input type="checkbox"  name="products[]" id="{{$value->id}}" value="{{$value->id}}"></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    </form>

<div>
    <nav>
        <ul class="pagination">
            
            @if($products->currentPage() != 1)
            <li class="page-item">
                <a class="page-link{{$products->previousPageUrl()? ' ':'disabled'}}" href="javascript:void(0)" onclick="object.setUrl('{{$products->previousPageUrl()}}').setMethod('get').load()">Previous</a>
            </li>
            @endif
            @for($i=1;$i<=$products->lastPage();$i++)
                <li class="page-item {{Request::get('page') == $i ? 'active' : ' '}}">
                    <a class="page-link" onclick="object.setUrl('{{$products->url($i)}}').setMethod('get').load()" href="javascript:void(0);">{{$i}}</a>
                </li>
            @endfor
            @if($products->currentPage() != $products->lastPage())
            <li class="page-item">
                <a class="page-link{{$products->nextPageUrl() ? ' ':'disabled'}}" onclick="object.setUrl('{{$products->nextPageUrl()}}').setMethod('get').load();" href="javascript:void(0)">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
</div>
<form method="get" id="cartItemUpdate" action="">
@csrf

    <button type="button"  id="cartItemUpdatebtn" class="btn btn-md btn-success">UPDATE CART</button>
    <button type="button"  id="cartItemAdd"  onclick="productListFunction();"  class="btn btn-secondary">ADD NEW PRODUCT</button>
    <div class="col-12">
    @if(session('addItem'))
         <div class ="alert alert-success">{{session('addItem')}}</div>
    @endif
    @if(session('updateqty'))
        <div class ="alert alert-success">{{session('updateqty')}}</div>
    @endif
    @if(session('deletecartItem'))
         <div class ="alert alert-success">{{session('deletecartItem')}}</div>
    @endif
    
   

        <table class="table table-bordered bg-light  table-hover">
            <thead class="bg-dark text-white">
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Row Total </th>
                <th>Product Discount</th>
                <th>Product Total Price</th>
                <th>Action</th>
        </thead>
        <tbody>
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{$controller->getProductName($cartItem->productId)}}</td>
                        <td>Rs.{{$cartItem->price}}</td>
                        <td><input type="number" class="form-control"  name="quantityCart[{{$cartItem->id}}]" value="{{ $cartItem->quantity }}"    min="1" step="1"  required></td>
                        <td>Rs.@php  echo $rowtotal = $cartItem->quantity*$cartItem->price @endphp .00</td>
                        <td>{{$cartItem->discount}}%</td>
                        <td>Rs.{{$rowtotal - $rowtotal*($cartItem->discount/100)}}</td>      
                        <td><a href="javascript:void(0)" onclick="object.setUrl('/cartItem/delete/{{$cartItem->id}}').setMethod('get').load();" class="btn btn-secondary">DELETE</a></td>               
                    </tr>
                    @endforeach
                    <tr>
                    <td colspan="5">Shipping Charge</td>
                    <td>Rs.{{$controller->getShippingAmount()}}</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td colspan="5">Total</td>
                    <td>Rs.{{$controller->getTotal()}}</td>
                    <td></td>
                    </tr>
        </tbody>
        </table>
    </div>
</form>
<a onclick="object.setUrl('/order/{{Session::get('cartId')}}').setMethod('get').load();" class="btn btn-md btn-warning" href="javascript:void(0);">Place Order</a>
<script>
 $(function() {
        $('#customer').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/cart/customer',
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

    $(function(){
        $('#addressUpdate').on('click',function(e){
            e.preventDefault();
            $.ajax({
                type : 'POST',
                url : '/cart/customer/addressSave',
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                data : $('#form').serializeArray(),
                success : function(response)
                {
                    if(typeof response.element == 'undefined')
                    {
                        return false;
                    }
                    if(typeof response.element == 'object')
                    {
                        $(response.element).each(
                            function(i,element)
                            {
                                $('#content').html(element.html);
                            }
                        )
                    }
                    else
                    {
                        $(response.element.selector).html(response.element.html);
                    }
                }
            });
        });
    });  

    function sameAsBillingFunction()
    {
        var sameAsBilling = document.getElementById('sameAsBilling');
        if(sameAsBilling.checked == true)
        {
            document.getElementById('area').disabled=true;
            document.getElementById('address').disabled=true;
            document.getElementById('city').disabled=true;
            document.getElementById('state').disabled=true;
            document.getElementById('zipcode').disabled=true;
            document.getElementById('country').disabled=true;
            document.getElementById('shippingsaveInAddressBook').disabled=true;
          
        }
        else
        {
            document.getElementById('area').disabled=false;
            document.getElementById('address').disabled=false;
            document.getElementById('city').disabled=false;
            document.getElementById('state').disabled=false;
            document.getElementById('zipcode').disabled=false;
            document.getElementById('country').disabled=false;
            document.getElementById('shippingsaveInAddressBook').disabled=false;
        }
    }

    $(function(){
        $('#cartItemUpdatebtn').on('click',function(e){
           
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/cartItem/update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                data: $('#cartItemUpdate').serializeArray(),
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

    function productListFunction()
    {
        var productId = document.getElementById('productId');
        document.getElementById("productId").style.display = "block";
    }

    $(function(){
        $('#addToCart').on('click',function(e){
           
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/cartItem/addItem',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                data: $('#productList').serializeArray(),
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

    // $(document).ready(function(){
    //     $('#cartItemAdd').on('click', function(e) {
    //         // document.getElementById("someElementId").style.display = "block";
    //         $('#productId').show();
    //         e.preventDefault();
    //         $.ajax({
    //             type: 'get',
    //             url: '/cart',
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    //                     'content')
    //             },
    //             data: $('#productList').serializeArray(),
    //             success: function(response) {
    //                 if (typeof response.element == 'undefined') {
    //                     return false;
    //                 }
    //                 if (typeof response.element == 'object') {
    //                     $(response.element).each(
    //                         function(i, element) {
    //                             $('#content').html(element.html);
    //                         })
    //                 } else {
    //                     $(response.element.selector).html(response
    //                         .element.html);
    //                 }
    //             },
               
    //         });
    //     });
    // });   
</script>