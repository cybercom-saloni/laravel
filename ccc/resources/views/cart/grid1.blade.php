<h3 style="font-weight:bold; font-size:32px;" class="mt-2">View Cart</h3>
<hr>
{{$productId}}
{{$controller->getProductName($productId)}}
<table class="table table-bordered bg-light  table-hover">
<form method="post" id="form" action="/cart/customer">
@csrf
<tbody>
    <tr>
        <td>SELECT CUSTOMER</td>
        <td>
            <select class="form-control" name="customer[name]">
            <option selected  hidden disabled>Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->firstname}} {{$customer->lastname}}</option>
                    <option value="{{ $customer->id }}" {{ Session::has('customerId') ? (Session::get('customerId') == $customer->id ? 'selected' : '') : '' }}>{{ $customer->firstname . ' ' . $customer->lastname }}</option>
                @endforeach
            </select>
        </td>
        <td><button type="button" onclick="object.setUrl('/cart/customer').load();" class="btn btn-success btn-md">Selected</button></td>
    </tr>
</tbody>
</table>
<div class="col-12">
   <div class="row">
        <div class="col-6">
        <h3>BILLING  ADDRESS</h3>
        <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="shipping[address]" placeholder="address"  required></textarea>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="shipping[area]" placeholder="area"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="shipping[city]" placeholder="city"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="shipping[state]" placeholder="state"   required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="shipping[zipcode]" placeholder="zipcode"   required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="shipping[country]" placeholder="country"   required>
                    </div>
                </div>
        </div>
        <div class="col-6">
        <h3>Shipping Address</h3>
        <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="billing[address]" placeholder="address"  required></textarea>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="billing[area]" placeholder="area"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="billing[city]" placeholder="city"  required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="billing[state]" placeholder="state"  required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="billing[zipcode]" placeholder="zipcode"  required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="billing[country]" placeholder="country"   required>
                    </div>
                </div>
        </div>
   </div>
</div>
<button>UPDATE</button>
<div class="col-12">
    <div class="row">
         <div class="col-6">
             <h3>Payment Method</h3>
             <table class="table-responsive">
                <tr>
                    <td><input type="radio">cash on Delivery</td>
                </tr>
            </table>
         </div>
         <div class="col-6">
             <h3>Shipping Method</h3>
             <table class="table-responsive">
                <tr>
                    <td><input type="radio" name="delivery">Express Delivery</td>
                    <td>Rs.100</td>
                </tr>
                <tr>
                    <td><input type="radio" name="delivery">Normal Delivery</td>
                    <td>Rs.50</td>
                </tr>
             </table>
         </div>
    </div>
</div>
<div class="col-12">
    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Product Total Price</th>
       </thead>
    </table>
</div>
</div>
<h3 style="font-weight:bold; font-size:32px;" class="mt-2">View Cart</h3>
<hr>
{{$productId}}
{{$controller->getProductName($productId)}}
<table class="table table-bordered bg-light  table-hover">
<form method="post" id="form" action="/cart/customer">
@csrf
<tbody>
    <tr>
        <td>SELECT CUSTOMER</td>
        <td>
            <select class="form-control" name="customer[name]">
            <option selected  hidden disabled>Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->firstname}} {{$customer->lastname}}</option>
                    <option value="{{ $customer->id }}" {{ Session::has('customerId') ? (Session::get('customerId') == $customer->id ? 'selected' : '') : '' }}>{{ $customer->firstname . ' ' . $customer->lastname }}</option>
                @endforeach
            </select>
        </td>
        <td><button type="button" onclick="object.setUrl('/cart/customer').load();" class="btn btn-success btn-md">Selected</button></td>
    </tr>
</tbody>
</table>
<div class="col-12">
   <div class="row">
        <div class="col-6">
        <h3>BILLING  ADDRESS</h3>
        <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="shipping[address]" placeholder="address"  required></textarea>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="shipping[area]" placeholder="area"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="shipping[city]" placeholder="city"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="shipping[state]" placeholder="state"   required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="shipping[zipcode]" placeholder="zipcode"   required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="shipping[country]" placeholder="country"   required>
                    </div>
                </div>
        </div>
        <div class="col-6">
        <h3>Shipping Address</h3>
        <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="billing[address]" placeholder="address"  required></textarea>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="billing[area]" placeholder="area"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="billing[city]" placeholder="city"  required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="billing[state]" placeholder="state"  required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="billing[zipcode]" placeholder="zipcode"  required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="billing[country]" placeholder="country"   required>
                    </div>
                </div>
        </div>
   </div>
</div>
<button>UPDATE</button>
<div class="col-12">
    <div class="row">
         <div class="col-6">
             <h3>Payment Method</h3>
             <table class="table-responsive">
                <tr>
                    <td><input type="radio">cash on Delivery</td>
                </tr>
            </table>
         </div>
         <div class="col-6">
             <h3>Shipping Method</h3>
             <table class="table-responsive">
                <tr>
                    <td><input type="radio" name="delivery">Express Delivery</td>
                    <td>Rs.100</td>
                </tr>
                <tr>
                    <td><input type="radio" name="delivery">Normal Delivery</td>
                    <td>Rs.50</td>
                </tr>
             </table>
         </div>
    </div>
</div>
<div class="col-12">
    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Product Total Price</th>
       </thead>
    </table>
</div>
</div>
