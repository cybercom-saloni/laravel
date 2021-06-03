<?php $customerData = isset($customer) ? $customer : null ?>
<div class="row">
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Payment Details</h3>
        <form action="/paymentSave/{{$customerData ? $customerData->id : ' '}}"  method="POST" id="form">
        @csrf
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> Name</label>
                       
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="firstname" placeholder="name" value="{{$customerData ? $customerData->name : ' '}}" name="payment[name]">
                    </div>
                 </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Code</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control"  id="lastname" placeholder="code" name="payment[code]" value="{{$customerData ? $customerData->code : ' '}}" required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="email"> Description</label>
                    </div>
                    <div class="col-lg-6">
                    <textarea name="payment[description]" id="description" style="resize: vertical" rows="5" class="form-control" placeholder="Description">{{$customerData ? $customerData->description : ' '}}</textarea>
                    </div>
                </div>

               
                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Status</label>
                        </div>
                    <div class="col-lg-6">
                        <select name="payment[status]" id="status" class="form-control" required>
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
                    <button type="button" id ="update" class="btn btn-success btn-md">Save Payment Details</button>
                </div>
                <div>
            </form>
        </div>
    </div>



    <script>
        $(function () {
             $('#update').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/paymentSave/{{$customerData ? $customerData->id : ' '}}',
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
    </script>


   

        

