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
                        <textarea class="form-control" id="address" name="billing[address]" placeholder="address"  required>{{$billing ? $billing->address : ' '}}</textarea>
                    </div>
                </div>
                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.address'][0]);?>
                </div>
                @endif

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="billing[area]" placeholder="area"   value="{{$billing ? $billing->area : ' '}}" required>
                    </div>
                </div>

                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.area'][0]);?>
                </div>
                @endif
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="billing[city]" placeholder="city"   value="{{$billing ? $billing->city : ' '}}" required>
                    </div>
                </div>

                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.city'][0]);?>
                </div>
                @endif
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="billing[state]" placeholder="state"   value="{{$billing ? $billing->state : ' '}}" required>
                    </div>
                </div>
                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.state'][0]);?>
                </div>
                @endif
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="billing[zipcode]" placeholder="zipcode"   value="{{$billing ? $billing->zipcode : ' '}}" required>
                    </div>
                </div>
                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.zipcode'][0]);?>
                </div>
                @endif
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="billing[country]" placeholder="country"   value="{{$billing ? $billing->country : ' '}}" required>
                    </div>
                    
                </div>
                @if(Session::get('billingError'))
                <div class ="alert alert-danger">
                <?php $output=Session::get('billingError');
                    print_r($output->getMessages()['billing.country'][0]);?>
                </div>
                @endif


                <h2 style="font-weight:bold; font-size:16px;" class="mt-2">Customer Shipping Address Details</h2>
                <!-- <input type="hidden" class="form-control"  name="shipping[customerId]" placeholder="customerId"   value="{{$customerId}}" required>
        <input type="hidden" class="form-control"  name="shipping[addressType]" placeholder="addressType"   value="shipping" required> -->
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="shipping[address]" placeholder="address" >{{$shipping ? $shipping->address : ' '}}</textarea>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="shipping[area]" placeholder="area"   value="{{$shipping ? $shipping->area : ' '}}">
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="shipping[city]" placeholder="city" value="{{$shipping ? $shipping->city : ' '}}"  >
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="shipping[state]" placeholder="state"   value="{{$shipping ? $shipping->state : ' '}}">
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="shipping[zipcode]" placeholder="zipcode"   value="{{$shipping ? $shipping->zipcode : ' '}}">
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="shipping[country]" placeholder="country"   value="{{$shipping ? $shipping->country : ' '}}">
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

