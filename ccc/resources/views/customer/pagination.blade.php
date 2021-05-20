<?php $customerAddress;?>
<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Customer</h3>
<hr>
    <a onclick="object.setUrl('/customer/form').setMethod('get').load()" href="javascript:void(0);" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New customer</a>
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
    {!! $customerAddress->links()!!}

    