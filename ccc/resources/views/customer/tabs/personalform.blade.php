<div class="row">
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2"> Customer Details</h3>
      {{ $customerData = isset($customer) ? $customer : ' ' }}
        <form action="" method="POST" id="form">
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> First Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="name" placeholder="firstname"  value="{{$customerData ? $customerData->firstname : ' '}}" name="customer[firstname]" required>
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
                        <input type="text" class="form-control"  id="email" required placeholder="email" name="customer[email]" value="{{$customerData ? $customerData->email : ' '}}" required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="password"> Password</label>
                        </div>
                    <div class="col-lg-6">
                    <input type="text" class="form-control"  id="password" required placeholder="password" name="customer[password]" value="{{$customerData ? $customerData->password : ' '}}"required>
                    </div>
                </div>
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="contactno"> Contact Number</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" id="contactno" class="form-control"placeholder="contactno" name="customer[contactno]"  max="10"  value="{{$customerData ? $customerData->contactno : ' '}}" required>
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
                    <button type="button" onclick="object.setUrl('').setForm('form').load();" class="btn btn-success btn-md">Product</button>
                </div>
                <div>
            </form>
        </div>
    </div>

