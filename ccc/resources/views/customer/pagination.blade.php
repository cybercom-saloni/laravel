<?php $customerAddress;?>
<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer</h3>
<hr>
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
<div class="col-12">
    <div class = "row">
        <div class="col-6">
        <a onclick="object.setUrl('/customer/form').setMethod('get').load()" href="javascript:void(0);" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New customer</a>
        </div>
       
            <div class="col-6">
            <form action="/setPages/customerGrid" method="post" id="records">
                            @csrf
                            <div class="navbar-btn navbar-btn-right">
                                <div class="form-group">
                                    <label for="recordPerPage">Record Per Page</label>
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
                        </form>
            </div>
        
    </div>
</div>
    
    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Area</th>
                <th>City</th>
                <th>State</th>
                <th>Zipcode</th>
                <th>Country</th>
                <th>AddressType</th>
                <th>status</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
     
            @if (!$customerAddress)
                <tr>
                    <td colspan="17" class="text-center">No Records Found</td>
                </tr>
            @else
           
            @foreach($customerAddress as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->firstname}}</td>
                    <td>{{$customer->lastname}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->contactno}}</td>
                    <td>{{$customer->address ? $customer->address : ' ' }}</td>   
                    <td>{{$customer->area}}</td>
                    <td>{{$customer->city}}</td>
                    <td>{{$customer->state}}</td>
                    <td>{{$customer->zipcode}}</td>
                    <td>{{$customer->country}}</td>
                    <td>{{$customer->addressType}}</td>
                    <td>
                       @if($customer->status == 1)
                       <a onclick="object.setUrl('/customer/status/{{$customer->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-warning">Enable</a>
                        @else
                        <a onclick="object.setUrl('/customer/status/{{$customer->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-danger"> Disable</a>
                       @endif
                    </td>
                    <td><a onclick="object.setUrl('/customer/form/{{$customer->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-success">Edit</a></td>
                    <td> <a onclick="object.setUrl('/customerDelete/{{ $customer->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Delete</a></td>

                </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
    <!-- {!! $customerAddress->links()!!} -->
    <div>
    <nav>
        <ul class="pagination">
            
            @if($customerAddress->currentPage() != 1)
            <li class="page-item">
                <a class="page-link{{$customerAddress->previousPageUrl()? ' ':'disabled'}}" href="javascript:void(0)" onclick="object.setUrl('{{$customerAddress->previousPageUrl()}}').setMethod('get').load()">Previous</a>
            </li>
            @endif
            @for($i=1;$i<=$customerAddress->lastPage();$i++)
                <li class="page-item {{Request::get('page') == $i ? 'active' : ' '}}">
                    <a class="page-link" onclick="object.setUrl('{{$customerAddress->url($i)}}').setMethod('get').load()" href="javascript:void(0);">{{$i}}</a>
                </li>
            @endfor
            @if($customerAddress->currentPage() != $customerAddress->lastPage())
            <li class="page-item">
                <a class="page-link{{$customerAddress->nextPageUrl() ? ' ':'disabled'}}" onclick="object.setUrl('{{$customerAddress->nextPageUrl()}}').setMethod('get').load();" href="javascript:void(0)">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>

<script>
$(function() {
    $('#recordPerPage').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/setPages/customerGrid',
            data: $('#records').serializeArray(),
            success: function(response) {
                if (typeof response.element == 'undefined') {
                    return false;
                }
                if (typeof response.element == 'object') {
                    $(response.element).each(
                        function(i, element) {
                            $('#content').html(element.html);
                        })
                        } 
                        else {
                            $(response.element.selector).html(response.element.html);
                        }
                }
        });
    });
});




</script>

    