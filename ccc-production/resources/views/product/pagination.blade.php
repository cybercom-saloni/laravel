 <table class="table table-bordered bg-light  table-hover">
                <thead class="text-white" style="background-color: darkkhaki;">
                    <tr>
                    <th>@sortablelink('id')</th>
                        <th>@sortablelink('sku')</th>
                        <th>@sortablelink('name')</th>
                        <!-- <th>CategoryName</th> -->
                        <th>@sortablelink('price')</th>
                        <th>@sortablelink('discount')</th>
                        <th>@sortablelink('quantity')</th>
                        <th style="color:blue">Status</th>
                        <th style="color:blue" colspan="2">Actions</th>
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
                            <!-- <td>{{$controller->getCategoryName($value->category_id)}}</td> -->
                            <td>{{$value->price}}</td>
                            <td>{{$value->discount}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>
                            @if($value->status == 1)
                            <a href='/product/status/{{$value->id}}' class="btn btn-warning">Enable</a>
                                @else
                                <a href='/product/status/{{$value->id}}' class="btn btn-danger"> Disable</a>
                            @endif
                            </td>
                            <td><a href='/product/form/{{$value->id}}' class="btn btn-secondary">Edit</a></td>
                            <td> <a href='/productDelete/{{ $value->id }}'class="btn btn-secondary">Delete</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
     <div class="text-center">
                                {{ $products->links() }}
                            </div>