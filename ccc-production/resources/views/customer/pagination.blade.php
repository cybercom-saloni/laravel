<?php $customerAddress;?>
<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer</h3>
<hr>
<div id="table_data">
<div id="Content">
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->
                <div class="panel panel-headline" style="background-color: ghostwhite;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Manage Customer</h3>
                        </div>

@if(session('custstatus'))
<div class ="alert alert-success">{{session('custstatus')}}</div>
@endif
@if(session('custDelete'))
<div class ="alert alert-success">{{session('custDelete')}}</div>
@endif
@if(session('custSave'))
<div class ="alert alert-success">{{session('custSave')}}</div>
@endif
@if(session('custAddressSave'))
<div class ="alert alert-success">{{session('custAddressSave')}}</div>
@endif
                        <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                         <a href="{{'/customer/form'}}" class="btn btn-lg bg-primary btn-secondary mb-4"><i class="fa fa-plus-square"></i> Create New Customer</a>
                                    </div>
                                     <div class="col-lg-3">

                                        <!-- <form action="/importExcelCsv" id="form" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <input type="file" class="form-control-file" id="file" name="file">
                                            <button type="submit"  class="btn btn-primary btn-md">Import</button>
                                         </form> -->
                                     </div>
                                    <div class="col-lg-3">
                                        <!-- <a href="javascript:void(0)" id= "export" class="btn btn-primary btn-md">Export</a> -->
                                    </div>
                                </div>
                                <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                                <form action="/setPages/customerGrid" method="post" id="records">
                                     @csrf
                                        <div class="navbar-btn navbar-btn-right">
                                             <div class="form-group">
                                                 <div class="row">
                                                    <div class="col-6">
                                                             <label for="recordPerPage">Record Per Page</label>
                                                    </div>
                                                    <div class="col-6">
                                                       <select name="recordPerPage" id="recordPerPage" class="form-control col-lg-5">
                                                            <option value="2"
                                                                {{ Session::has('page') ? (Session::get('page') == 2 ? 'selected' : '') : '' }}>
                                                                2
                                                            </option>
                                                            <option value="4"
                                                                {{ Session::has('page') ? (Session::get('page') == 4 ? 'selected' : '') : '' }}>
                                                                4
                                                            </option>
                                                            <option value="20"
                                                                {{ Session::has('page') ? (Session::get('page') == 20 ? 'selected' : '') : '' }}>
                                                                20
                                                            </option>
                                                            <option value="50"
                                                                {{ Session::has('page') ? (Session::get('page') == 50 ? 'selected' : '') : '' }}>
                                                                50
                                                            </option>
                                                        </select>
                                                    </div>

                                                 </div>
                                              </div>
                                        </div>
                                </form>
                            </div>

                        </div>
                    </div>
                       </div>
        <table class="table table-bordered bg-light  table-hover" id="example">
            <thead class="text-white" style="background-color: darkkhaki;">

            <tr>
                <th >@sortablelink('ID')</th>
                <th >@sortablelink('First Name')</th>
                <th >@sortablelink('Last Name')</th>
                <th >@sortablelink('Email')</th>
                <th >@sortablelink('Contact Number')</th>
                <th >@sortablelink('AddressType')</th>
                <th >@sortablelink('Address')</th>
                <th >@sortablelink('Area')</th>
                <th >@sortablelink('City')</th>
                <th >@sortablelink('State')</th>
                <th >@sortablelink('Zipcode')</th>
                <th >@sortablelink('Country')</th>
                 <th >status</th>
                <th colspan="3">Action</th>
            </tr>

        </thead>
        <tbody>
        <tr>
            <form method="POST" action="/customer/customerId" id="productid">
             @csrf
                <th><input type="text" class="form-control filter-input"  name="id" id="searchid" placeholder="search Id.." value="{{Session::get('searchid') ? Session::get('searchid'): ' '}}"></th>
                <th><input type="text" class="form-control filter-input" placeholder="search Sku.." id="searchSku"  name="sku" value="{{Session::get('searchsSku') ? Session::get('searchsSku'): ' '}}"></th>
                <th><input type="text" class="form-control filter-input" placeholder="search Name.." id="searchName" name="name" value="{{Session::get('searchName') ? Session::get('searchName'): ' '}}"></th>
                <th><input type="text" class="form-control filter-input" placeholder="search.." id="searchPrice" name="price" value="{{Session::get('searchPrice') ? Session::get('searchPrice'): ' '}}"></th>
                <th><input type="text" class="form-control filter-input" placeholder="search.." id="searchNumber" name="number" value="{{Session::get('searchNumber') ? Session::get('searchNumber'): ' '}}"></th>
                <th><a href="/customerGrid" class="btn btn-md btn-primary" name="clear" value="clear"><i class="fa fa-remove"></i>Remove Filter </a></th>
            </form>
        </tr>

            @if (!$customerAddress)
                <tr>
                    <td colspan="17" class="text-center">No Records Found</td>
                </tr>
            @else

            @foreach($customerAddress as $customer)
                <tr>
                    @if($customer->addressType != 'shipping')
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->firstname}}</td>
                        <td>{{$customer->lastname}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->contactno}}</td>
                        <td>{{$customer->addressType}}</td>
                        <td>{{$customer->address ? $customer->address : ' ' }}</td>

                        <td>{{$customer->area}}</td>
                        <td>{{$customer->city}}</td>
                        <td>{{$customer->state}}</td>
                        <td>{{$customer->zipcode}}</td>
                        <td>{{$customer->country}}</td>

                        <td>
                        @if($customer->status == 1)
                        <a href="/customer/status/{{$customer->id}}" class="btn btn-warning">Enable</a>
                            @else
                            <a href="/customer/status/{{$customer->id}}" class="btn btn-danger"> Disable</a>
                        @endif
                        </td>
                        <td><a href="/customer/form/{{$customer->id}}" class="btn btn-success">Edit</a></td>
                        <td> <a href="/customerDelete/{{ $customer->id }}" class="btn btn-secondary">Delete</a></td>
                    @endif
                </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div>

   {{$customerAddress->links()}}

</div>

<script>
 document.getElementById('recordPerPage').onchange = function() {
                document.getElementById('records').submit();
            };

            document.getElementById('searchid').onchange = function() {
                document.getElementById('productid').submit();
            };
document.getElementById('searchSku').onchange = function() {
                document.getElementById('productid').submit();
            };
document.getElementById('searchName').onchange = function() {
                document.getElementById('productid').submit();
            };
            document.getElementById('searchNumber').onchange = function() {
                document.getElementById('productid').submit();
            };

document.getElementById('searchPrice').onchange = function() {
                document.getElementById('productid').submit();
            };


</script>

