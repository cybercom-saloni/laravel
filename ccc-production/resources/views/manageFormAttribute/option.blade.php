@extends('layoutTemplate.main')
@section('content')
<div id="loading" class="loading"> </div>
<div id="Content">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">


                <div class="panel-body">
                    @include('layoutTemplate.message')
                @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-warning-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span arial-hidden="true">x</span>
            </button>
             @foreach($errors->all() as $error)
             {{$error}}<br>
        @endforeach
        </div>
      @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> Add Attribute Option</h3>

                                </div>
                            </div>
     <form action="/admin/Attribute/option/save/{{request()->id}}" method="POST">
     @csrf
        <div class="form-group contentHtml">
            <input type="submit" value="Update" id="update" class="btn btn-info btn-md">
            <input type="button" name="addOption"  value="Add Option" onclick="addRow()" class="btn btn-warning btn-md">
                <br><br>
                <table width=100 boarder=2 id="existingOption" class="table">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Sort Order</th>
                        <th>Delete</th>
                    <thead>
                    <tbody>

                      @if($attribute->count() == 0)
                            <tr id='NoDataFound'>
                                <td colspand=3>Data Not Found...</td>
                            </tr>
                     @endif
                     @foreach($attribute as $key=>$option)
                            <tr>
                            <td><input type="text" name="Exist[{{$option->id}}][id]" placeholder="id"
                                value="{{ $option->id}}" class="form-control" readonly></td>
                                <td><input type="text" name="Exist[{{$option->id}}][name]" placeholder="Name"
                                value="{{ $option->name}}" class="form-control" data-validation="required"></td>

                                <td><input type="number" name="Exist[{{$option->id}}][sort_order]"
                                placeholder="Sort Order" value="{{ $option->sort_order}}" class="form-control"></td>

                                <td><a name="remove" value="remove Option"
                                class="btn btn-danger btn-md" href="/admin/Attribute/option/delete/{{$option->id}}">
                                <span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                     @endforeach
                    </tbody>
                </table>
        </div>
    </form>
    <div style="display:none">
        <table id='newOption' class='table'>
            <tbody>
                <tr>
                        <td></td>
                        <td><input type="text" name="New[name][]" placeholder="Name" class="form-control"></td>
                        <td><input type="text" name="New[sort_order][]" placeholder="Sort Order" class="form-control"></td>
                        <td><a type="button" name="remove" value="remove Option"  onclick="removeOption(this)" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
                    </div>

            </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $(window).load(function() {
        $("#loading").fadeOut(3000);
        });

//     $("#update").validate({
//         rules:{
//         "exists[]":{
//             required: true,

//         }
//     },
//     messages:{
//         "exists[]":{
//             required: "* field is required",
//         }
//     },
// });
//     });
    $("#update").click(function(){

        $.validate();
        $("#loading").show();  $("#loading").fadeOut(3000);
    });
    $('.addRow').on('click',function(){
  		$("table tbody").append($("table tbody tr:first").clone(true));
    });
});
</script>
@endsection


<script>

    function addRow() {
        var newOptiontable = document.getElementById('newOption');
        var existOptiontable = document.getElementById('existingOption').children[0];
        var NoDataFound = document.getElementById('NoDataFound');
        existOptiontable.append(newOptiontable.children[0].children[0].cloneNode(true));
        NoDataFound.remove();
    }

    function removeOption(button) {
        var objTr =$(button).closest('tr');
        console.log(objTr);
        objTr.remove();
    }
</script>
