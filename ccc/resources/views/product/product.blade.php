    <div id="table_data">
    <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
<hr>
    <a onclick="object.setUrl('/product/form').setMethod('Get').load()" href="javascript:void(0);" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New Product</a>

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
                    <th colspan="2">Actions</th>
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
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

            {!! $products->links()!!}
     </div>
     <!-- storing page no -->
    <!-- <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    vakues changes when user clicks
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id"/> -->
    <!-- <form method="post" id="record">
        <label>Record per Page</p>
        <select name="selectpage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
0    </form> -->
    <script>
        $(document).ready(function()
        {  
            $(document).on('click','.pagination a',function(event)
            {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                // fetch_data(page);
                $.ajax({
                    url:"/product/fetch_data?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });

            });
        
            function fetch_data(page)
            {
                $.ajax({
                    url:"/product/fetch_data?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });
            }
        });
    </script>

