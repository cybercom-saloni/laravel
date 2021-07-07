@extends('layoutTemplate.main')
<style>
  #loading{
	position: fixed;
	width: 100%;
	height: 100vh;
	background: #fff
	url("{{ asset('spnner.gif') }}")
	 no-repeat center center;
	z-index: 99999;
}
</style>
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
                            <h3 class="panel-title">Manage Products</h3>
                        </div>
                        @include('layoutTemplate.message')
                        @if (Session::has('productStatus'))

                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <i class="fa fa-info-circle"></i> {{ Session::get('productStatus') }}
                                {{ Session::forget('productStatus') }}
                            </div>

                        @endif


                        @if(Session::get('productSaves'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <i class="fa fa-info-circle"></i> {{ Session::get('productSaves') }}
                                {{ Session::forget('productSaves') }}
                            </div>
                        @endif

                        @if(session('productDelete'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <i class="fa fa-info-circle"></i> {{ Session::get('productDelete') }}
                                {{ Session::forget('productDelete') }}
                        </div>
                        @endif

                        @if(session('productImport'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <i class="fa fa-info-circle"></i> {{ Session::get('productImport') }}
                                {{ Session::forget('productImport') }}

                        </div>
                        @endif
                        <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                         <a href="{{'/product/create'}}" class="btn btn-md btn-secondary mb-4"><i class="fa fa-plus-square"></i> Create New Product</a>
                                    </div>
                                     <div class="col-lg-3">
                                        <form action="/importExcelCsv" id="form" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <input type="file" class="form-control-file" id="file" name="file">
                                            <button type="submit"  class="btn btn-primary btn-md">Import</button>
                                         </form>
                                     </div>
                                    <div class="col-lg-3">
                                        <a href="javascript:void(0)" id= "export" class="btn btn-primary btn-md">Export</a>
                                    </div>
                                </div>
                       </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
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
                                    <th style="color:#3b98c8">CreatedDate</th>
                                    <th style="color:#3b98c8" colspan="2">Actions</th>
                                </tr>
                                <!-- <tr>
                                    @foreach ($controller->getColumns() as $columns)
                                        <th>
                                        <a href="{{route('productGrid', ['orderBy' => $columns['field'], 'orderDirection' => request('orderDirection') == 'asc' ? 'desc' : 'asc'])}}">
                                                        {{ $columns['label'] }}
                                            <span
                                                {{ request()->orderDirection && request()->orderBy == $columns['field'] ? (request()->orderDirection == 'asc' ? 'class=' . $columns['class_asc'] : 'class=' . $columns['class_desc']) : '' }}></span>
                                                    </a>
                                                </th>
                                            @endforeach

                                            <th colspan="2">Actions</th>
                                </tr> -->
                            </thead>
                            <tbody>
                                <tr>
                                    <form method="POST" action="/search/productId" id="productid">
                                    @csrf
                                    <th><input type="text" class="form-control filter-input"  name="id" id="searchid" placeholder="search Id.." value="{{Session::get('searchid') ? Session::get('searchid'): ' '}}"></th>
                                    <th><input type="text" class="form-control filter-input" placeholder="search Sku.." id="searchSku"  name="sku" value="{{Session::get('searchsSku') ? Session::get('searchsSku'): ' '}}"></th>
                                    <th></th>
                                    <th><input type="text" class="form-control filter-input" placeholder="search Name.." id="searchName" name="name" value="{{Session::get('searchName') ? Session::get('searchName'): ' '}}"></th>
                                    <!-- <th>CategoryName</th> -->
                                    <th><input type="text" class="form-control filter-input" placeholder="search.." id="searchPrice" name="price" value="{{Session::get('searchPrice') ? Session::get('searchPrice'): ' '}}"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><input type="date" class="form-control filter-input" placeholder="search.." id="createdDate" name="createdDate" value="{{Session::get('createdDate') ? Session::get('createdDate'): ' '}}"></th>
                                    <th><button type="submit" class="btn btn-md btn-secondary">Apply Filter</button></th>
                                    <th><a href="/products" class="btn btn-md btn-primary" name="clear" value="clear"><i class="fa fa-remove"></i>Remove Filter </a></th>
                                    </form>
                                </tr>
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
                                    <!-- <td>{{$controller->getCategoryName($value->category_id)}}</td> -->
                                    <td>{{$value->price}}</td>
                                    <td>{{$value->discount}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td>
                                    @if($value->status == 1)
                                    <a href='/product/status/{{$value->id}}' class="btn btn-warning" id="status">Enable</a>
                                        @else
                                        <a href='/product/status/{{$value->id}}' class="btn btn-danger" id="status"> Disable</a>
                                    @endif
                                    </td>
                                    <td>{{$value->created_at}}</td>
                                    <td><a href='/product/edit/{{$value->id}}' class="btn btn-secondary" id="edit">Edit</a></td>
                                    <td> <a href='/productDelete/{{ $value->id }}'class="btn btn-secondary" id ="delete">Delete</a></td>
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
<div id="loading">  </div>
<script>
 $(window).load(function() {
        $("#loading").fadeOut(1000);
        });
        $("#delete").click(function() {
            // $(this).html("<img src='{{ asset('spnner.gif') }}' />");
            jQuery("#loading").show();
        });
        $("#edit").click(function() {
            // $(this).html("<img src='{{ asset('spnner.gif') }}' />");
            jQuery("#loading").show();
        });
        $("#status").click(function() {
            // $(this).html("<img src='{{ asset('spnner.gif') }}' />");
            jQuery("#loading").show();
        });
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
document.getElementById('searchPrice').onchange = function() {
                document.getElementById('productid').submit();
            };
            // document.getElementById('createdDate').onclick = function() {
            //     document.getElementById('productid').submit();
            // };

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

//         $(document).ready(function() {
//             alert(1);
//     // Setup - add a text input to each footer cell
//     $('#example tfoot th').each( function () {
//         var title = $('#example thead th').eq( $(this).index() ).text();
//         console.log(title);
//         $(this).html( '<input type="text"  class="form-control" placeholder="Search '+title+'" />' );
//     } );

//     // DataTable
//     var table = $('#example').DataTable();

//     // Apply the search
//     table.columns().every( function () {
//         var that = this;

//         $( 'input', this.footer() ).on( 'keyup change', function () {
//             that
//                 .search( this.value )
//                 .draw();
//         } );
//     } );
// } );


//   $(function () {

//     var table = $('.yajra-datatable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: "{{ route('students.list') }}",
//         columns: [
//             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
//             {data: 'id', name: 'id'},
//             {data: 'sku', name: 'sku'},
//             {data: 'name', name: 'name'},
//             {
//                 data: 'action',
//                 name: 'action',
//                 orderable: true,
//                 searchable: true
//             },
//         ]
//     });

//   });
</script>


@stop
