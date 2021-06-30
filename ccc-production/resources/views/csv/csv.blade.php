@extends('layoutTemplate.main')
@section('content')
<div id="table_data">
<div id="Content">
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->
                <div class="panel panel-headline" style="background-color: ghostwhite;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Manage CSV</h3>
                        </div>
@if(session('productImport'))
<div class ="alert alert-success">{{session('productImport')}}</div>
@endif
<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-8">
        <form action="" id="form" class="form-inline" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
                <input type="file" class="form-control-file" id="file" name="file">
                <button type="button" onclick="object.setUrl('/importExcelCsv').setMethod('post').uploadFile().resetParam();" class="btn btn-primary btn-md">Import</button>
                <!-- <button type="button" onclick="object.setUrl('/importCsv').setMethod('post').uploadFile().resetParam();" class="btn btn-primary btn-md">Import</button> -->
                <!-- <button type="button" id ="update" class="btn btn-success btn-md">Import</button> -->
        </form>
        </div>
        <div class="col-3">
        <!-- <a href="javascript:void(0)" onclick="object.setUrl('/exportExcelCsv').setMethod('get').load();" class="btn btn-primary btn-md">Export</a> -->
            <a href="javascript:void(0)" id= "exportFromDB" class="btn btn-primary btn-md">Export</a>
        </div>


    </div>
</div>
@endsection
<script>
// $(document).ready(function () {
//     $('#exportFromDB').click(function () {
//         $.ajax({
//             url: "/exportExcelCsv",
//             type: "get",
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             data: {},
//             success: function (response) {
//                 var file = new Blob([response], {
//                             type: 'text/csv'
//                         });
//                 var a = document.createElement("a");
//                 a.href =URL.createObjectURL(file);
//                 a.download = "ccc.csv";
//                 document.body.appendChild(a);
//                 a.click();
//                 console.log(a);
//             }
//         });
//     });
// });
</script>
<!-- <script>
     $(function () {
             $('#update').on('click', function (e) {

                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/importCsv',
                    data: $('#form').serializeArray(),
                    success : function(data) {
                        if($.isEmptyObject(data.error)){
                            if(typeof data.element == 'object') {
                                 $(data.element).each(function(i, element) {
                                        $('#content').html(element.html);
                                 });
                                }
                        }else{
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
    </script> -->
