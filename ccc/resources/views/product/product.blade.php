@extends('layoutTemplate.main')
@section('container')

    <div id="table_data">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
		    <i class="fa fa-bars"></i>
		        <span class="sr-only">Toggle Menu</span>
		</button>
        <h3 style="font-weight:bold;font-size:32px;margin-inline-end: auto;padding-left: 30px;">Product</h3>

    </div>


</nav>

<div class="col-lg-12">
    <div class="row">
        <div class="col-4">
            <a href="{{'/product/form'}}" class="btn btn-md btn-secondary mb-4"><i class="fa fa-plus-square"></i> Create New Product</a>
        </div>
        <div class="col-4">
        <form action="" id="form" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <input type="file" class="form-control-file" id="file" name="file">
                <button type="button" onclick="object.setUrl('/importExcelCsv').setMethod('post').uploadFile().resetParam();" class="btn btn-primary btn-md">Import</button>
        </form>
        </div>
        <div class="col-4">
            <a href="javascript:void(0)" id= "export" class="btn btn-primary btn-md">Export</a>
        </div>
    </div>
</div>
@if(session('productStatus'))

<div class ="alert alert-success">{{session('productStatus')}}</div>
@endif
@if(Session::get('productSaves'))
<div class ="alert alert-success">{{Session::get('productSaves')}}</div>
@endif
@if(session('productDelete'))
<div class ="alert alert-success">{{session('productDelete')}}</div>
@endif

@if(session('productImport'))
<div class ="alert alert-success">{{session('productImport')}}</div>
@endif
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
                        <a onclick="object.setUrl('/product/status/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-warning">Enable</a>
                            @else
                            <a onclick="object.setUrl('/product/status/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-danger"> Disable</a>
                        @endif
                        </td>
                        <td><a onclick="object.setUrl('/product/form/{{$value->id}}').setMethod('get').load();" href="javascript:void(0);" class="btn btn-secondary">Edit</a></td>
                        <td> <a onclick="object.setUrl('/productDelete/{{ $value->id }}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Delete</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

            <!-- {!! $products->links()!!} -->
            <!-- pagination -->
     </div>
     <div>
     <div class ="col-12">
        <div class ="row">
            <div class="col-6">
                <nav>
                    <ul class="pagination">

                        @if($products->currentPage() != 1)
                        <li class="page-item">
                            <a class="page-link{{$products->previousPageUrl()? ' ':'disabled'}}" href="javascript:void(0)" onclick="object.setUrl('{{$products->previousPageUrl()}}').setMethod('get').load()">Previous</a>
                        </li>
                        @endif
                        @for($i=1;$i<=$products->lastPage();$i++)
                            <li class="page-item {{Request::get('page') == $i ? 'active' : ' '}}">
                                <a class="page-link" onclick="object.setUrl('{{$products->url($i)}}').setMethod('get').load()" href="javascript:void(0);">{{$i}}</a>
                            </li>
                        @endfor
                        @if($products->currentPage() != $products->lastPage())
                        <li class="page-item">
                            <a class="page-link{{$products->nextPageUrl() ? ' ':'disabled'}}" onclick="object.setUrl('{{$products->nextPageUrl()}}').setMethod('get').load();" href="javascript:void(0)">Next</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class ="col-6">
                    <form action="/setPages/product" method="post" id="records">
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
<script>
$(function() {
    $('#recordPerPage').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/setPages/product',
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


$(document).ready(function(){
    $('#export').click(function()
    {
       $.ajax({
        url:"/exportExcelCsv",
        type:'get',
        headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        data:{},
        success:function(response)
        {
            var file = new Blob([response],{
                type:'text/csv',
            });
            var a = document.createElement('a');
            a.href=URL.createObjectURL(file);
            a.download ="product.csv";
            document.body.appendChild(a);
            a.click();
        }
       });
    });
});
</script>
@stop
