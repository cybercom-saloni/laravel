@extends('layoutTemplate.main')
@section('content')
<style>
tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<div id="table_data">
<div id="Content">
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->
                <div class="panel panel-headline" style="background-color: ghostwhite;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Manage Deleted Products</h3>
                        </div>
                        @include('layoutTemplate.message')


                       <table class="table table-bordered bg-light  table-hover" id="example">
                            <thead class="text-white" style="background-color: darkkhaki;">
                                <tr>
                                    <th>@sortablelink('id')</th>
                                    <th>@sortablelink('sku')</th>
                                    <th>@sortablelink('slug')</th>
                                    <th>@sortablelink('name')</th>
                                    <th>@sortablelink('price')</th>
                                    <th style="width:100px;">@sortablelink('discount')</th>
                                    <th style="width:100px;">@sortablelink('quantity')</th>
                                    <th style="color:#3b98c8">Status</th>
                                    <th style="color:#3b98c8">deleted Date</th>
                                    <th style="color:#3b98c8">Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                @if (!$products)

                                <tr>
                                    <td colspan="12" class="text-center">No Records Found</td>
                                </tr>
                                 @else
                                     @foreach ($products as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->sku}}</td>
                                    <td>{{$value->slug}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->price}}</td>
                                    <td>{{$value->discount}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td> <a href='/productdelete/status/{{$value->id}}' class="btn btn-danger"> Restore </a></td>
                                    <td>{{$value->deletedOn}}</td>
                                    <td> <a href='/productCacheDelete/{{ $value->id }}'class="btn btn-secondary">Delete </a></td>
                                </tr>
                                    @endforeach
                                @endif
                            </tbody>
                       </table>


                    {{$products->links()}}


                <!-- END OVERVIEW -->
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function()
        {
            $(document).on('click','.pagination a',function(event)
            {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
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


@stop
