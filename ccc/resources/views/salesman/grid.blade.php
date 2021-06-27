<?php $idSales = session('idSales')?>
<?php
?>
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
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
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
                                            <div class="alert alert-success NewSalesman" style="display:block">{{session('NewSalesman')}}</div>
                                            @endif


                                        <thead>

                                                <tr>
                                                     <td><input type="search" id="namesearch"  name="namesearch" class="form-control" placeholder="Search Salesman..." aria-label="Search"
                                                    aria-describedby="search-addon" />
                                                    </td>
                                                    <td><button type="button" class="btn btn-md btn-primary" onclick="object.setForm('form').setMethod('post').setUrl('/salesmanGrid/searchSalesman').load();">   <i class="fa fa-search"></i></button></td>
                                                  <td><a onclick="object.setUrl('/salesmanClear').setMethod('get').resetParam().load();" href="javascript:void(0);" class="btn btn-md btn-primary" name="clear" value="clear"><i class="fa fa-remove"></i> </a></td>
                                                    <td><a href="javascript:void(0);" id="salesmanAddGrid" class="btn btn-md btn-primary"><i class="fa fa-plus"></i></a></td>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr id="newSalesmanAdd">
                                                    <td colspan="2"> <input type="text" class="form-control" id="sku" placeholder="SALESMAN NAME" name="salesman[name]" required></td>
                                                    <td colspan='2'><button type="button" class="btn btn-md btn-primary" onclick="object.setForm('form').setMethod('post').setUrl('/salesmanAdd/{{$idSales}}').load();"><i class="fa fa-plus"></i></button></td>
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
                        @if(session('idSales'))
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                     <form action="" method="POST" id="form">
                                        @csrf
                                         <div class="row">
                                            <div class="col-8"><h3 class="card-title"> Manage Salesman Price</h3></div>
                                                @if($salesmanName->count()> 0)
                                                 @if(session('salesmanDelete'))
                                                 <div class="col-4"></div>
                                                  @else
                                                  <div class="col-4"><button type="button" class="btn btn-md btn-primary" onclick="updateFunction()"><i class="fa fa-pencil"></i>UPDATE
                                                </button></td></div>
                                                  @endif
                                                @else
                                                   <div class="col-4"></div>
                                                @endif
                                        </div>
                                        @if(session('successAdd'))
                                            <div class="alert alert-success successAdd">{{session('successAdd')}}</div>
                                        @endif

                                        @if(session('successError'))
                                            <div class="alert alert-danger successError">{{session('successError')}}</div>
                                        @endif

                                           <div class="salesmanAddedProduct alert alert-success" style="display:none;">Salesman Product Price Updated!!!!</div>


                                        <table class="table table-bordered bg-light  table-hover" id="comparisonTable-{{session('idSales')}}">
                                            <thead>
                                                <tr>
                                                    <td>Id</td>
                                                    <td>Sku</td>
                                                    <td>Product Price</td>
                                                    <td>Salesman Price</td>
                                                    <td>Salesman Discount(in %)</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if($salesmanName->count()> 0)
                                                @if(session('salesmanDelete'))
                                                <tr><td colspan="5"><b>No Salemen Selected!!!<b></td></tr>
                                                @else
                                                <tr>
                                                   <td></td>
                                                     <td><input type="text" class="form-control" name="addsalesman[sku]"></td>
                                                    <td><input type="text" class="form-control" name="addsalesman[price]"></td>
                                                <td colspan='2'><button type="button"  onclick="object.setForm('form').setMethod('post').setUrl('SalesmanAddNewProduct/{{$idSales}}').load();" class="btn btn-md btn-primary"><i class="fa fa-plus"></i></button></td>
                                                </tr>


                                                @foreach(session('salesmanId') as $key => $value)
                                                <tr id="message">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->sku}}</td>
                                                    <td  id="productPrice-{{$value->id}}" class="productPrice">{{$value->price}}</td>
                                                    <td><input type="text"  class="salesmanPrice form-control"  name="updateSalesmanPrice[<?php echo $value->id;?>]" value="{{$value->salesmanPrice}}"></td>
                                                    <td><input type="text" class="form-control"  name="updateSalesmanDiscount[<?php echo $value->id;?>]"value="{{$value->salesmanDiscount}}"></td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                            @endif
                                            @else
                                             <tr><td colspan="5"><b>No Salemen Selected!!!<b></td></tr>
                                            @endif
                                        </table>

                                    </div>

                                     </form>
                                    </div>

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
function priceCheck()
{
    var rows = $("#comparisonTable-{{session('idSales')}}").find("tbody tr");
    rows.each(function() {
        var thisRow = $(this),
            productPrice = parseFloat(thisRow.find(".productPrice").text());
            salesmanPrice = parseFloat(thisRow.find(".salesmanPrice").val());

        if (productPrice > salesmanPrice) {
            console.log(salesmanPrice);
            thisRow.find(".salesmanPrice").css('backgroundColor', 'gray');

        }
        else
        {
            thisRow.find(".salesmanPrice").css('backgroundColor', 'white');
        }

        $(".successAdd").css('display','none');
        salesmanPrice = parseFloat(salesmanPrice).toFixed(2);

        if(!isNaN(salesmanPrice))
        {
            $(thisRow.find(".salesmanPrice")).val(salesmanPrice);
        }

    });
}

$(document).ready(function(){
    $("#newSalesmanAdd").hide();
    $('#salesmanAddGrid').click(function(){
        $("#newSalesmanAdd").show();
    });
});

$('.salesmanPrice').change(function(e) {
    priceCheck();
});

function updateFunction()
{
   priceCheck();
    $(".salesmanAddedProduct").css('display','block');
     $('#form').attr('onclick',"object.setForm('form').setMethod('post').setUrl('salesmanUpdatePrice/{{$idSales}}').load()");
}
</script>
