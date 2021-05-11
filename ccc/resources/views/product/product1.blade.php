@extends('core.head')
@section('container')
<h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
<hr>

    <a href="/product/form" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New Product</a>

    <table class="table table-bordered bg-light  table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>Sku</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
     
            @if (!$product->getProductModel()->getProducts())
                <tr>
                    <td colspan="12" class="text-center">No Records Found</td>
                </tr>
            @else
                @foreach ($product->getProductModel()->getProducts() as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->sku }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->discount }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td><a href="/product/form/{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td><a href="/productDelete/{{ $value->id }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@stop 


@foreach ($products as $key)
                <?php echo $key;echo "<pre>";print_r($products);die;?>
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->sku }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->discount }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td><a href="/product/form/{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td><a href="/productDelete/{{ $value->id }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach


//tab

<div class="col-3">
<ul class="nav flex-column">
    <li class="nav-item list-group p-0 h-100 w-100" style="margin-left: -60px;">
         <a class="nav-link list-group-item list-group-item-action bg-warning mt-2 text-center font-weight-bold font-weight italic" href="/product/form{{ $data ? '/' . $data[0]->id : '' }}">Information</a>
    </li>
         <li class="nav-item list-group p-0 h-100 w-100" style="margin-left: -60px;">
            <a  class="nav-link list-group-item bg-warning list-group-item-action mt-2 text-center font-weight-bold font-weight italic" href="/product/media{{ $data ? '/' . $data[0]->id : '' }}">Media</a>
        </li>

    </ul>
</div>