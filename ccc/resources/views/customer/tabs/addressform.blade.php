<?php $customerId = request()->id;?>
<div class="row">
@include('customer.tabs')
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer Details</h3>
        <hr>
        <form action="/customerAdress/save/{{$customerId}}" method="POST" id="form">
        @csrf
        <h2 style="font-weight:bold; font-size:16px;" class="mt-2">Customer Billing Address Details</h2>
        <!-- <input type="hidden" class="form-control"  name="billing[customerId]" placeholder="customerId"   value="{{$customerId}}" required>
        <input type="hidden" class="form-control"  name="billing[addressType]" placeholder="addressType"   value="billing" required> -->
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="billing[address]" placeholder="address"  required>{{$billing ? $billing->address : null}}</textarea>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="billing[area]" placeholder="area"   value="{{$billing ? $billing->area : null}}" required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="billing[city]" placeholder="city"   value="{{$billing ? $billing->city : null}}" required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="billing[state]" placeholder="state"   value="{{$billing ? $billing->state : null}}" required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="billing[zipcode]" placeholder="zipcode"   value="{{$billing ? $billing->zipcode : null}}" required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="billing[country]" placeholder="country"   value="{{$billing ? $billing->country : null}}" required>
                    </div>
                </div>


                <h2 style="font-weight:bold; font-size:16px;" class="mt-2">Customer Shipping Address Details</h2>
                <!-- <input type="hidden" class="form-control"  name="shipping[customerId]" placeholder="customerId"   value="{{$customerId}}" required>
        <input type="hidden" class="form-control"  name="shipping[addressType]" placeholder="addressType"   value="shipping" required> -->
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="shipping[address]" placeholder="address"  required>{{$shipping ? $shipping->address : null}}</textarea>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="shipping[area]" placeholder="area"   value="{{$shipping ? $shipping->area : null}}" required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="shipping[city]" placeholder="city" value="{{$shipping ? $shipping->city : null}}"   required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="shipping[state]" placeholder="state"   value="{{$shipping ? $shipping->state : null}}" required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="shipping[zipcode]" placeholder="zipcode"   value="{{$shipping ? $shipping->zipcode : null}}" required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="shipping[country]" placeholder="country"   value="{{$shipping ? $shipping->country : null}}" required>
                    </div>
                </div>
                    <div class="form-group row">
                     <div class="col-lg-4">
                     </div>
                    <div class="col-lg-6">
                    <button type="button" onclick="object.setUrl('/customerAdress/save/{{$customerId}}').setForm('form').load();" class="btn btn-success btn-md">Save Customer Address Details</button>
                </div>
                <div>
            </form>
        </div>
    </div>

