    <div id="table_data">
    <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
<hr>
<div class="col-lg-12">
    <div class="row">
        <div class="col-4 ">
            <a onclick="object.setUrl('/product/form').setMethod('Get').load()" href="javascript:void(0);" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New Product</a>
        </div>
        <div class="col-4 ">
        <form action="/importCsv" id="form" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <input type="file" class="form-control-file" id="file" name="file">
                <button type="button" onclick="object.setUrl('/importCsv').setMethod('post').uploadFile().resetParams();" class="btn btn-success btn-md">Import</button>
        </form>
        </div>
        <div class="col-4"> 
            <form method="post" enctype="multipart/data">
                    <button type ="button" class="btn btn-md btn-primary">Export</div>
            </form>
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

                        
</script>

     <!-- storing page no -->
    <!-- <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    vakues changes when user clicks
    <input type="hid
    
    
    den" name="hidden_column_name" id="hidden_column_name" value="id"/> -->
    <!-- <form method="post" id="record">
        <label>Record per Page</p>
        <select name="selectpage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
0    </form> -->
    <!-- <script>
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
    </script> -->

