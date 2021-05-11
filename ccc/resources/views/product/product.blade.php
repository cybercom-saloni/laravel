<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
<hr>
    <a onclick="object.setUrl('/product/form').setMethod('Get').load()" href="javascript:void(0);" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New Product</a>

    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>Sku</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>status</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
     
            @if (!$products)
            
                <tr>
                    <td colspan="12" class="text-center">No Records Found</td>
                </tr>
            @else
                @foreach ($products->getProducts() as $value)
                <?php //echo $value;echo "<pre>";print_r($products);die;?>
                    <tr>
                       <td>{{$value->id}}</td>
                       <td>{{$value->sku}}</td>
                       <td>{{$value->name}}</td>
                       <td>{{$value->price}}</td>
                       <td>{{$value->discount}}</td>
                       <td>{{$value->quantity}}</td>
                       <td>{{$value->status}}</td>
                       <td><a onclick="object.setUrl('/product/form/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-secondary">Edit</a></td>
                       <td> <a onclick="object.setUrl('/productDelete/{{ $value->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Delete</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

