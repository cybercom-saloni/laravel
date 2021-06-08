<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
<hr>


<table class="table table-bordered bg-light  table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Sku</th>
                    <th>Name</th>
                    <th>CategoryName</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Quantity</th>
                    <th>status</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
        
                @if (!$products)
                
                    <tr>
                        <td colspan="12" class="text-center">No Records Found</td>
                    </tr>
                @else
                    @foreach ($products as $value)
                    <?php //echo $value;echo "<pre>";print_r($products);die;?>
                        <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->sku}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$controller->getCategoryName($value->category_id)}}</td>
                        <td>{{$value->price}}</td>
                        <td>{{$value->discount}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>
                        @if($value->status == 1)
                        <a onclick="object.setUrl('/product/status/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-warning">Enable</a>
                            @else
                            <a onclick="object.setUrl('/product/status/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-danger"> Disable</a>
                        @endif
                        </td>
                        <td><a onclick="object.setUrl('/product/form/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-success">Edit</a></td>
                        <td> <a onclick="object.setUrl('/productDelete/{{ $value->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Delete</a></td>
                        <td> <a onclick="object.setUrl('/cart/{{ $value->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Add to Cart</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

            {!! $products->links()!!}