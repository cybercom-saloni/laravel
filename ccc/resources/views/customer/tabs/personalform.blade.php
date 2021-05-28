<?php $customerData = isset($customer) ? $customer : null ?>
<?php $passwordData =isset($password)?$password :null?>

<div class="row">
        <div class="col-sm-9">
        @if($customerData)
        @include('customer.tabs')
        @endif

       
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer Details</h3>
        <form action="/customer/save/{{$customerData ? $customerData->id : ' '}}"  method="POST" id="form">
        @csrf
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> First Name</label>
                       
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="name" placeholder="firstname" pattern="[A-Za-z].{2,}" title="Please write your name more than 2 letter"  value="{{$customerData ? $customerData->firstname : ' '}}" name="customer[firstname]" required>
                    </div>
                    <span id="username" class="text-danger font-weight-bold"> </span>
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
                        <input type="number" id="contactno" class="form-control"placeholder="contactno" name="customer[contactno]"   value="{{$customerData ? $customerData->contactno : ' '}}" required>
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
                    <button type="button" onclick="object.setUrl('/customer/save/{{$customerData ? $customerData->id : ' '}}').setForm('form').load();" class="btn btn-success btn-md">Save Customer Details</button>
                </div>
                <div>
            </form>
        </div>
    </div>

   

        

