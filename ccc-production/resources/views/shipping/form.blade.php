@extends('layoutTemplate.main')

@section('content')
    <div id="Content">

        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
<?php $customerData = isset($customer) ? $customer : null ?>
<div class="row">
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">shipping Details</h3>
        <form action="/shippingSave/{{$customerData ? $customerData->id : ' '}}"  method="POST" id="form">
        @csrf
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Name</label>

                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="firstname" placeholder="name" value="{{$customerData ? $customerData->name : ' '}}" name="shipping[name]">
                    </div>
                 </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Code</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control"  id="lastname" placeholder="code" name="shipping[code]" value="{{$customerData ? $customerData->code : ' '}}" required>
                    </div>
                </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Amount</label>
                    </div>
                    <div class="col-lg-6">
                    <input type="number" class="form-control" value="{{ $customerData ? $customerData->amount : '' }}" id="price"
                            placeholder="amount" name="shipping[amount]" required max="100" min="0" step="0.01">
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="email"> Description</label>
                    </div>
                    <div class="col-lg-6">
                    <textarea name="shipping[description]" id="description" style="resize: vertical" rows="5" class="form-control" placeholder="Description">{{$customerData ? $customerData->description : ' '}}</textarea>
                    </div>
                </div>


                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Status</label>
                        </div>
                    <div class="col-lg-6">
                        <select name="shipping[status]" id="status" class="form-control" required>
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
                    <button type="submit" id ="update" class="btn btn-success btn-md">Save shipping Details</button>
                </div>
                <div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            });
        });

    </script>
@endsection




    <!-- <script>
        $(function () {
             $('#update').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/shippingSave/{{$customerData ? $customerData->id : ' '}}',
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






