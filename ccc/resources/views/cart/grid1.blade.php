<h3 style="font-weight:bold; font-size:32px;" class="mt-2">View Cart</h3>
<div id="productId">
    <div id="table_data">
    <h5 style="font-weight:bold; font-size:32px;" class="mt-2">Add New Product</h5>
    <hr>
    <table class="table table-bordered bg-light  table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Actions</th>
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
                            <td>{{$value->price}}</td>
                            <td>{{$value->discount}}</td>
                            <td> <a onclick="object.setUrl('/cart/{{ $value->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Add to Cart</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

                {!! $products->links()!!}
        </div>
    </div>
<hr>
<form action="/cart/customer" method="post" id="customerId">
    @csrf
    <div class="form-group">
        <label for="customer">Select Customer</label>
        <select name="customer" id="customer" class="form-control col-lg-5">
          
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" 
                        {{ Session::has('customerId') ? (Session::get('customerId') == $customer->id ? 'selected' : '') : '' }}>
                        {{ $customer->firstname . ' ' . $customer->lastname }}
                    </option>
                @endforeach 
        </select>
    </div>
</form> 

<!-- <form action="/cart/customer" method="post" id="customerIdform">
    @csrf
    <div class="form-group">
        <label for="customer">Select Customer</label>
        <select name="customer" id="customer" class="form-control col-lg-5">
          
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" 
                        {{ Session::has('customerId') ? (Session::get('customerId') == $customer->id ? 'selected' : '') : '' }}>
                        {{ $customer->firstname . ' ' . $customer->lastname }}
                    </option>
                @endforeach 
        </select>
    <button type="button" id="customerIdbtn" class="btn btn-danger btn-md">GO</button> 
    </div>
</form> -->


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

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Area</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingarea"  value="{{$billing ? $billing->area : ' '}}" name="billing[area]" placeholder="area"   required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> City</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingcity" value="{{$billing ? $billing->city : ' '}}" name="billing[city]" placeholder="city"  required>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> State</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingstate" value="{{$billing ? $billing->state : ' '}}" name="billing[state]" placeholder="state"  required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Zipcode</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingzipcode" value="{{$billing ? $billing->zipcode : ' '}}" name="billing[zipcode]" placeholder="zipcode"  required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-lg-4">
                                <label for="firstname"> Country</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="billingcountry" name="billing[country]" value="{{$billing ? $billing->country : ' '}}" placeholder="country"   required>
                            </div>
                        </div>
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
                    <td><h6><input type="radio" name="payment" value="{{$value->id}}" <?php if($cart->paymentId == $value->id) echo 'checked';?>>{{$value->name}}</h6></td>
                </tr>
               
                @endforeach
            </table>
         </div>
         <div class="col-6">
             <h3>Shipping Method</h3>
             <table class="table-responsive">
             @foreach($controller->getShipping() as $key => $value)
                <tr>
                   <td><h6><input type="radio" name="shippingMethod" value="{{$value->id}}" <?php if($cart->shippingId == $value->id) echo 'checked';?>>{{$value->name}}</h6></td>
                   <td><h6>{{$value->amount}}</h6></td>
                </tr>
             @endforeach 
             </table>
         </div>
    </div>
    
</div>
<button type="button"  id="addressUpdate" class="btn btn-md btn-success">UPDATE</button>
</form>

<form method="POST" id="cartItemUpdate" action="/cartItem/update">
<button type="button"  id="cartItemUpdatebtn" class="btn btn-md btn-success">UPDATE CART</button>
<a href="javascript:void(0)" onclick="object.setUrl('/product').setMethod('get').load();" class="btn btn-secondary">ADD NEW PRODUCT</a>
<div class="col-12">
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
                    <td><input type="text" class="form-control" name="quantityCart[{{$cartItem->id}}]" value="{{ $cartItem->quantity }}"></td>
                    <td>Rs.@php  echo $rowtotal = $cartItem->quantity*$cartItem->price @endphp .00</td>
                    <td>Rs.{{$discounttotal = $cartItem->discount * $cartItem->quantity}}.00</td>
                    <td>Rs.{{$rowtotal - $discounttotal}}.00</td>     
                    <td><a href="javascript:void(0)" onclick="object.setUrl('/cartItem/delete/{{$cartItem->id}}').setMethod('get').load();" class="btn btn-secondary">DELETE</a></td>               
                </tr>
                @endforeach
                <tr>
                <td colspan="5">Shipping Charge</td>
                <td>Rs.{{$cart->shippingAmount}}</td>
                <td></td>
                </tr>
                <tr>
                <td colspan="5">Total</td>
                <td>Rs.{{$cart->total}}</td>
                <td></td>
                </tr>
       </tbody>
    </table>
</div>
</form>
</div> 
 <script>
   $(function(){
        $('#cartItemUpdatebtn').on('click',function(e){
            alert('tem');
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
            alert('address');
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

    $(function() {
        $('#customerIdbtn').on('click', function(e) {
            alert(1111);
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/cart/customer',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                data: $('#customerIdform').serializeArray(),
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

    // function billingsaveInAddressBookFunction()
    // {
    //     var billingsaveInAddressBook = document.getElementById('billingsaveInAddressBook');
    //     if(billingsaveInAddressBook.checked == true)
    //     {
    //         document.getElementById('sameAsBilling').disabled=true;
    //         document.getElementById('area').disabled=true;
    //         document.getElementById('address').disabled=true;
    //         document.getElementById('city').disabled=true;
    //         document.getElementById('state').disabled=true;
    //         document.getElementById('zipcode').disabled=true;
    //         document.getElementById('country').disabled=true;
    //         document.getElementById('shippingsaveInAddressBook').disabled=true;
          
    //     }
    //     else
    //     {
    //         document.getElementById('sameAsBilling').disabled=false;
    //         document.getElementById('area').disabled=false;
    //         document.getElementById('address').disabled=false;
    //         document.getElementById('city').disabled=false;
    //         document.getElementById('state').disabled=false;
    //         document.getElementById('zipcode').disabled=false;
    //         document.getElementById('country').disabled=false;
    //         document.getElementById('shippingsaveInAddressBook').disabled=false;
    //     }
        
    // }

    // function shippingsaveInAddressBookFunction()
    // {
    //     var shippingsaveInAddressBook = document.getElementById('shippingsaveInAddressBook');
    //     if(billingsaveInAddressBook.checked == true)
    //     {
    //         document.getElementById('sameAsBilling').disabled=true;
    //         document.getElementById('area').disabled=true;
    //         document.getElementById('address').disabled=true;
    //         document.getElementById('city').disabled=true;
    //         document.getElementById('state').disabled=true;
    //         document.getElementById('zipcode').disabled=true;
    //         document.getElementById('country').disabled=true;
    //         document.getElementById('saveInAddressBook').disabled=true;
          
    //     }
    //     else
    //     {
    //         document.getElementById('sameAsBilling').disabled=false;
    //         document.getElementById('area').disabled=false;
    //         document.getElementById('address').disabled=false;
    //         document.getElementById('city').disabled=false;
    //         document.getElementById('state').disabled=false;
    //         document.getElementById('zipcode').disabled=false;
    //         document.getElementById('country').disabled=false;
    //         document.getElementById('saveInAddressBook').disabled=false;
    //     }
    // }
</script>
<script>
        $(document).ready(function()
        {  
            $(document).on('click','.pagination a',function(event)
            {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $.ajax({
                    url:"/cartproduct/fetch_cartdata?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });

            });
        
            function fetch_cartdata(page)
            {
                $.ajax({
                    url:"/cartproduct/fetch_cartdata?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });
            }
        });
    </script>
