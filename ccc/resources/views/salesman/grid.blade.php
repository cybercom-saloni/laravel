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
                                            <div class="alert alert-danger salesmanDelete" style="display:block">{{session('salesmanDelete')}}</div>

                                            @endif
                                            @if(session('NewSalesman'))
                                            <div class="alert alert-success NewSalesman" style="display:none">{{session('NewSalesman')}}</div>
                                            @endif
                                            <div class="alert alert-danger print-error-msg" style="display:none">
                                                <ul></ul>
                                            </div>
                                        <thead>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="sku" placeholder="SALESMAN NAME" name="namesearch"></td>
                                                    <td><button type="button" class="btn btn-md btn-primary" id="searchSalesman">   <i class="fa fa-search"></i></button></td>
                                                    <td><a onclick="object.setUrl('/salesmanGrid').setMethod('get').load();" href="javascript:void(0);0" class="btn btn-md btn-primary"><i class="fa fa-remove"></i> </a></td>
                                                    <td><a href="javascript:void(0);" id="salesmanAddGrid" class="btn btn-md btn-primary"><i class="fa fa-plus"></i></a></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="newSalesmanAdd">
                                                    <td colspan="2"> <input type="text" class="form-control" id="sku" placeholder="SALESMAN NAME" name="salesman[name]" required></td>
                                                    <td colspan='2'><button type="button" class="btn btn-md btn-primary" id="addSalesman"><i class="fa fa-plus"></i></button></td>
                                                </tr>

                                                @if($salesmanName->count()> 0)
                                                    @foreach($salesmanName as $key => $value)
                                                        @if(session('selectedId') == $value->id)
                                                        <tr style="background-color:gray">
                                                            <td class="row1" colspan='2'>{{$value->name}}</td>
                                                            <td class="row1"><a href="javascript:void(0);" onclick="object.setUrl('/salesmanDelete/{{$value->id}}').setMethod('get').load();" class="btn btn-md btn-primary"><i class="fa fa-trash-o fa-lg"></i></a></td>
                                                            <td class="row1"><a href="javascript:void(0);"  onclick="object.setUrl('/SalesmanPrice/{{$value->id}}').setMethod('post').load();" class="btn btn-md btn-primary">Price</a></td>
                                                        </tr>
                                                        @else
                                                    <tr>

                                                        <td class="row1" colspan='2'>{{$value->name}}</td>
                                                        <td class="row1"><a href="javascript:void(0);" onclick="object.setUrl('/salesmanDelete/{{$value->id}}').setMethod('get').load();" class="btn btn-md btn-primary"><i class="fa fa-trash-o fa-lg"></i></a></td>
                                                        <td class="row1"><a href="javascript:void(0);"  onclick="object.setUrl('/SalesmanPrice/{{$value->id}}').setMethod('post').load();" class="btn btn-md btn-primary">Price</a></td>
                                                    </tr>
                                                    @endif


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
                        @if(session('salesId'))
                        <div class="col-md-6">
                            <div class="card">
                                      <div class="card-body">

                                    <form action="" method="POST" id="form">
                                      @csrf

                                        <div class="row">
                                            <div class="col-8"><h3 class="card-title"> Manage Salesman Price</h3></div>
                                            @if(session('salesmanDelete'))
                                            <div class="col-4"></div>
                                            @else
                                            <div class="col-4"><button type="button" id="update" class="btn btn-md btn-primary" onclick="myFunction()"><i class="fa fa-pencil"></i>UPDATE</button></td></div>
                                            @endif
                                        </div>
                                        @if(session('successAdd'))
                                            <div class="alert alert-success successAdd" style="display:none">{{session('successAdd')}}</div>
                                     @endif


                                    <div class="alert alert-success salesmanAddedProduct" style="display:none">Salesman Product Price Updated!!!!</div>


                                        <table class="table table-bordered bg-light  table-hover" id="comparisonTable-{{session('salesId')}}">
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

                                                @if(session('salesmanDelete'))
                                                <tr><td colspan="5"><b>No Salemen Selected!!!<b></td></tr>
                                                @else
                                                <tr>
                                                   <div class="alert alert-danger print-error-msg1" style="display:none">
                                                <ul></ul>
                                            </div>
                                                   <td></td>
                                                    <td><input type="text" class="form-control" name="addsalesman[sku]"></td>
                                                    <td><input type="text" class="form-control" name="addsalesman[price]"></td>
                                                    <td colspan='2'><button type="button" class="btn btn-md btn-primary" id="addSalesmanBtn" ><i class="fa fa-plus"></i></button></td>
                                                </tr>


                                                @foreach(session('salesmanId') as $key => $value)
                                                <tr id="message">

                                                <?php //print_r($value);?>
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->sku}}</td>
                                                    <td  id="productPrice-{{$value->id}}" class="productPrice">{{$value->price}}</td>
                                                    <td><input type="text" id="price"  class="form-control salesmanPrice"  name="updateSalesmanPrice[<?php echo $value->id;?>]" value="{{$value->salesmanPrice}}"></td>
                                                    <td><input type="text" class="form-control"  name="updateSalesmanDiscount[<?php echo $value->id;?>]"value="{{$value->salesmanDiscount}}"></td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                            @endif
                                        </table>

                                    </div>
                            </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
<script>
function myFunction() {
    // var productPrice = document.getElementById('price').value;
    var rows = $("#comparisonTable-{{session('salesId')}}").find("tbody tr");
    // console.log(rows);
    rows.each(function() { //iterate over each row.

    var thisRow = $(this), //this is the current row
        productPrice = parseFloat(thisRow.find(".productPrice").text()), //this is the first value
        salesmanPrice = parseFloat(thisRow.find(".salesmanPrice").val()); //this is the second value
        // console.log(productPrice);
        // console.log(salesmanPrice);
    if (productPrice > salesmanPrice) {
        console.log(salesmanPrice);
        //  document.getElementById('message').style.backgroundColor  = 'green';
        thisRow.find(".salesmanPrice").css('backgroundColor', 'yellow');

    }
    else
    {
        thisRow.find(".salesmanPrice").css('backgroundColor', 'white');
    }

    $(".successAdd").css('display','none');
    $(".salesmanAddedProduct").css('display','block');
    });

}
$(document).ready(function(){
    $('#update').on('click',function(e){
        e.preventDefault();
        $('.price').each(function() {
           var sellingPrice =  $(this).val();
    });
    $(".productPrice").each(function () {
        var price = $(this).html();
        // console.log(price);
    });


        $.ajax({
            type:'post',
            url:'/salesmanUpdatePrice/{{session("salesId")}}',
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
                        $(".successAdd").css('display','none');
                        $(".salesmanAddedProduct").css('display','block');
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
    $('#addSalesmanBtn').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'<?php echo route('SalesmanAddNewProduct',session('salesId'))?>',
            data:$('#form').serializeArray(),
            success:function(data)
            {
                if($.isEmptyObject(data.error)){
                        if(typeof data.element == 'object')
                        {

                            $(data.element).each(function(i, element)
                            {
                                $('#content').html(element.html);
                                $(".successAdd").css('display','block');
                                $(".salesmanAddedProduct").css('display','none');
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
            $(".print-error-msg1").find("ul").html('');
            $(".print-error-msg1").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg1").find("ul").append('<li>'+value+'</li>');
            });
        }
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
                                $(".NewSalesman").css('display','block');
                                $(".salesmanDelete").css('display','none');

                            });
                        }
                 }
                else
                {
                    printErrorMsg(data.error);
                    $(".salesmanDelete").css('display','none');
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
            data:$('#formadd').serializeArray(),
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
        $.ajax({
            type:'post',
            url:'/SalesmanPrice/{{request()->id}}',
            data:$('#formadd').serializeArray(),
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
</script>
