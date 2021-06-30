@extends('layoutTemplate.main')
@section('content')
<?php $customerData = isset($customer) ? $customer : null ?>
<?php $passwordData =isset($password)?$password :null?>
<div id="Content">

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
<?php $customerId = request()->id;?>

<div class="row">
@include('customer.tabs')
</div>
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer Details</h3>
        <hr>
        <form action="/customerAdress/save/{{$customerId}}" method="POST" id="form">
        @csrf
        <h2 style="font-weight:bold; font-size:16px;" class="mt-2">Customer Billing Address Details</h2>
        <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Address</label>
                    </div>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="address" name="billing[address]" placeholder="address"  required>{{$billing ? $billing->address : ' '}}</textarea>
                    </div>
                </div>


                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Area</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="area" name="billing[area]" placeholder="area"   value="{{$billing ? $billing->area : ' '}}" required>
                    </div>
                </div>


                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> City</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="city" name="billing[city]" placeholder="city"   value="{{$billing ? $billing->city : ' '}}" required>
                    </div>
                </div>


                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> State</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="state" name="billing[state]" placeholder="state"   value="{{$billing ? $billing->state : ' '}}" required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Zipcode</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="zipcode" name="billing[zipcode]" placeholder="zipcode"   value="{{$billing ? $billing->zipcode : ' '}}" required>
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Country</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="country" name="billing[country]" placeholder="country"   value="{{$billing ? $billing->country : ' '}}" required>
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
                    <button type="submit" id ="update"  class="btn btn-success btn-md">Save Customer Address Details</button>
                </div>
                <div>
            </form>
        </div>
    </div>

    <!-- <script>
        $(function () {
             $('#update').on('click', function (e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                 var address = $("input[name='billing[address]']").val();
                 var area = $("input[name='billing[area]']").val();
                 var city = $("input[name='billing[city]']").val();
                 var state = $("input[name='billing[state]']").val();
                 var zipcode = $("input[name='billing[zipcode]']").val();
                 var country = $("input[name='billing[country]']").val();
                $.ajax({
                    type: 'post',
                    url: '/customerAdress/save/{{$customerId}}',
                    data: $('#form').serializeArray(),
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
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
    </script> -->

@endsection
