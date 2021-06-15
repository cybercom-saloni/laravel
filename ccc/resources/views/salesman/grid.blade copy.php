<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">

                <div class="panel-heading">
                    <h3 class="panel-title text-center"> Salesmen Grid</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> Manage Salesmen</h3>
                                    <form action="" method="POST" id="formadd">
                                      @csrf
                                        <table class="table table-bordered bg-light  table-hover">
                                            @if(session('salesmanDelete'))
                                            <div class="alert alert-success">{{session('salesmanDelete')}}</div>
                                            @endif
                                            @if(session('NewSalesman'))
                                            <div class="alert alert-success">{{session('NewSalesman')}}</div>
                                            @endif
                                            <div class="alert alert-danger print-error-msg" style="display:none">
                                                <ul></ul>
                                            </div>
                                        <thead>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="sku" placeholder="SALESMAN NAME" name="namesearch"></td>
                                                    <td><button type="button" class="btn btn-md btn-primary" id="searchSalesman">Search</button></td>
                                                    <td><a href="javascript:void(0);" id="salesmanAddGrid" class="btn btn-md btn-primary">Add</a></td>
                                                    <td><a onclick="object.setUrl('/salesmanGrid').setMethod('get').load();" href="javascript:void(0);0" class="btn btn-md btn-primary">Clear</a></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="newSalesmanAdd">
                                                    <td colspan="2"> <input type="text" class="form-control" id="sku" placeholder="SALESMAN NAME" name="salesman[name]" required></td>
                                                    <td colspan='2'><button type="button" class="btn btn-md btn-primary" id="addSalesman">Add</button></td>
                                                </tr>
                                                @if($salesman->count()> 0)
                                                    @foreach($salesman as $key => $value)
                                                    <tr>
                                                        <td colspan='2'>{{$value->name}}</td>
                                                        <td><a href="javascript:void(0);" onclick="object.setUrl('/salesmanDelete/{{$value->id}}').setMethod('get').load();" class="btn btn-md btn-primary">Delete</a></td>
                                                        <td><a href="javascript:void(0);" id="salesmanPriceGrid" class="btn btn-md btn-primary">Price</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="4"><b>No Record Found For Salemen!!!<b></td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="SalesmanPrice">
                            <div class="card">
                                <form action="" method="POST" id="form">
                                      @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8"><h3 class="card-title"> Manage Salesman Price</h3></div>
                                            <div class="col-4"><button type="button" id="update" class="btn btn-md btn-primary">Update</button></td></div>
                                        </div>
                                        <table class="table table-bordered bg-light  table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Id</td>
                                                    <td>Sku</td>
                                                    <td>Product Price</td>
                                                    <td>Salesman Price</td>
                                                    <td>Salesman Discount</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                    <td></td>
                                                    <td><input type="text" class="form-control" name="addsalesman[sku]"></td>
                                                    <td><input type="text" class="form-control" name="addsalesman[price]"></td>
                                                    <td colspan='2'><button type="button" class="btn btn-md btn-primary" id="add">Add</button></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>Id</td>
                                                    <td><input type="text" class="form-control" name="add[sku]"></td>
                                                    <td><input type="text" class="form-control" name="add[productPrice]"></td>
                                                    <td><input type="text" class="form-control" name="add[SalesmanPrice]"></td>
                                                    <td><input type="text" class="form-control" name="add[SalesmanDiscount]"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                            
                            
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
<script>
$(document).ready(function(){
    $('#update').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'/salesmanUpdatePrice',
            data:$('#form').serializeArray(),
            success:function(response)
            {
                if(typeof response.element == 'undefined')
                {
                    return false;
                }
                if(typeof response.element =='object')
                {
                    $(response.element).each(function(i,element){
                        $('#content').html(element.html);
                    });
                }
                else
                {
                    $(response.element.selector).html(response.element.html);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('#add').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'/salesmanAddPrice',
            data:$('#form').serializeArray(),
            success:function(response)
            {
                if(typeof response.element=='undefined')
                {
                    return false;
                }
                if(typeof response.element == 'object')
                {
                    $(response.element).each(function(i,element){
                        $('#content').html(element.html);
                    });
                }
                else{
                    $(response.element.selector).html(response.element.html);
                }
            }
        });
    });
});
$(document).ready(function(){
    $('#addSalesman').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'/salesmanAdd',
            data:$('#formadd').serializeArray(),
            success:function(data)
            {
                if($.isEmptyObject(data.error)){
                        if(typeof data.element == 'object')
                        {
                            $(data.element).each(function(i, element)
                            {
                                $('#content').html(element.html);
                            });
                        }
                 }
                else
                {
                    printErrorMsg(data.error);
                }
            }

            });
            });
            function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
$(document).ready(function(){
    $('#salesmanDeleteGrid').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'/salesmanDelete',
            data:$('#form').serializeArray(),
            success:function(response)
            {
                if(typeof response.element=='undefined')
                {
                    return false;
                }
                if(typeof response.element == 'object')
                {
                    $(response.element).each(function(i,element){
                        $('#content').html(element.html);
                    });
                }
                else{
                    $(response.element.selector).html(response.element.html);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('#searchSalesman').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'/salesmanGrid/searchSalesman',
            data:$('#formadd').serializeArray(),
            success:function(data)
            {
                if($.isEmptyObject(data.error)){
                        if(typeof data.element == 'object')
                        {
                            $(data.element).each(function(i, element)
                            {
                                $('#content').html(element.html);
                            });
                        }
                 }
                else
                {
                    printErrorMsg(data.error);
                }
            }

            });
            });
            function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });


$(document).ready(function(){
    $("#newSalesmanAdd").hide();
    $('#salesmanAddGrid').click(function(){
        $("#newSalesmanAdd").show();
    });
});
$(document).ready(function()
{
    $("#SalesmanPrice").hide();
    $("#salesmanPriceGrid").click(function(){
        $("#SalesmanPrice").show();
        
    });
});
</script>
