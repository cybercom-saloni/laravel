@include('layoutTemplate.frontend.main')
<div id="table_data">
<div id="Content">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">

                <div class="panel-heading">
                    <h3 class="panel-title text-center"> Sign Up </h3>
                </div>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> </h3>
                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-warning-circle"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span arial-hidden="true">x</span>
                                            </button>
                                            @foreach($errors->all() as $error)
                                            {{$error}}<br>
                                        @endforeach
                                        </div>
                                    @endif
        <form action="/user/save"  method="POST" id="form">
        @csrf
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="firstname"> First Name</label>

                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="firstname" placeholder="firstname" value="{{old('customer.firstname')}}"  name="customer[firstname]">
                    </div>
                 </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Last Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control"  id="lastname" placeholder="lastname" name="customer[lastname]" value="{{old('customer.lastname')}}"  required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="email"> email</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="email" class="form-control"  id="email"  placeholder="email" name="customer[email]" value="{{old('customer.email')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="password"> Password</label>
                        </div>
                    <div class="col-lg-6">
                    <input type="password" class="form-control"  id="password"  placeholder="password" name="customer[password]"  value="{{old('customer.password')}}" >
                    </div>
                </div>
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="password"> Confirm Password</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="password" class="form-control"  id="cpassword"  placeholder="password" name="customer[password_confirmation]"  value="{{old('customer.password_confirmation')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="contactno"> Contact Number</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="text" id="contactno" class="form-control"placeholder="contactno" name="customer[contactno]"   value="{{old('customer.contactno')}}" required>
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





