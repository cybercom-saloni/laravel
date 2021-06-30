@extends('layoutTemplate.main')
@section('content')
<?php $customerData = isset($customer) ? $customer : null ?>
<?php $passwordData =isset($password)?$password :null?>
<div id="Content">

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
<div class="row">
        <div class="col-sm-9">
        @if($customerData)
        @include('customer.tabs')
        @endif


        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer Details</h3>
        <form action="/customer/save/{{$customerData ? $customerData->id : ' '}}"  method="POST" id="form">
        @csrf
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> First Name</label>

                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="firstname" placeholder="firstname" value="{{$customerData ? $customerData->firstname : ' '}}" name="customer[firstname]">
                    </div>
                 </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Last Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control"  id="lastname" placeholder="lastname" name="customer[lastname]" value="{{$customerData ? $customerData->lastname : ' '}}" required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="email"> email</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="email" class="form-control"  id="email"  placeholder="email" name="customer[email]" value="{{$customerData ? $customerData->email : ' '}}" required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="password"> Password</label>
                        </div>
                    <div class="col-lg-6">
                    <input type="password" class="form-control"  id="password"  placeholder="password" name="customer[password]" value="{{$passwordData}}"required>
                    </div>
                </div>
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="contactno"> Contact Number</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="text" id="contactno" class="form-control"placeholder="contactno" name="customer[contactno]"   value="{{$customerData ? $customerData->contactno : ' '}}" required>
                    </div>
                    </div>

                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Status</label>
                        </div>
                    <div class="col-lg-6">
                        <select name="customer[status]" id="status" class="form-control" required>
                            <option disabled selected>Select Status</option>
                            <option value="1" {{$customerData ? ($customerData->status == 1? 'selected' : ''): ' '}}>
                                ENABLE
                            </option>
                            <option value="0" {{$customerData ? ($customerData->status == 0? 'selected' : ''):' '}}>
                                DISABLE
                            </option>
                        </select>
                    </div>
                    </div>

                    <div class="form-group row">
                     <div class="col-lg-4">
                     </div>
                    <div class="col-lg-6">
                    <button type="submit" id ="update" class="btn btn-success btn-md">Save Customer Details</button>
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
                 var firstname = $("input[name='customer[firstname]']").val();
                 var lastname = $("input[name='customer[lastname]']").val();
                 var email = $("input[name='customer[email]']").val();
                 var contactno = $("input[name='customer[contactno]']").val();
                 var password = $("input[name='customer[password]']").val();
                 var status = $("input[name='customer[status]']").val();
                 console.log(firstname);
                 console.log(lastname);
                $.ajax({
                    type: 'post',
                    url: '/customer/save/{{$customerData ? $customerData->id : ',
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





