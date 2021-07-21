@extends('layoutTemplate.main')
@section('content')
<div id="table_data">
<!-- <div id="loading" class="loading"> </div> -->
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                        <a href="/admin/manageform/view" class="btn btn-lg btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                        <h3 class="card-title" style="padding-left: 108px;margin-top: -33px;"> View Customer of {{$controller->getFormName($form_id)}} Form</h3>

                           <table class="table table-bordered bg-light col-12  table-hover" id="example">
                                <thead>

                                </thead>
                                <tbody>

                                <tr class="text-white" style="background-color: darkkhaki;">
                                    <th rowspan="3" class="text-center" style="color:white; font-weight:bold;padding-top:50px;">Customers Name</th>
                                    <th colspan="9" class="text-center" style="color:white; font-weight:bold;">Form Fields</th>
                                </tr>
                                <tr  class="text-white" style="background-color: darkkhaki;">
                                    <td colspan="2"class="text-center" style="color:white; font-weight:bold;">field 1</td>
                                    <td colspan="2"class="text-center" style="color:white; font-weight:bold;">field 2</td>
                                    <td colspan="2"class="text-center" style="color:white; font-weight:bold;">field 3</td>
                                    <td colspan="2"class="text-center" style="color:white; font-weight:bold;">field 4</td>
                                    <td rowspan="2" style="padding-top:30px; color:white; font-weight:bold;"> Display All Fields</td>
                                </tr>
                                <tr  class="text-white" style="background-color: darkkhaki;">
                                    <td class="text-center" style="color:white; font-weight:bold;">form field</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form field</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form field</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form field</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form value</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form value</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form value</td>
                                    <td class="text-center" style="color:white; font-weight:bold;">form value</td>
                                </tr>
                                @if(count($customers_id) == 0)
                                    <tr><td colspan="10"  class="text-center"> No Data Found For {{$controller->getFormName($form_id)}} Form</td></tr>
                                @endif
                                @foreach($customers_id as $value)
                                <tr>
                                    <td class="text-center">{{$controller->getCustomerName($value)}}</td>
                                    @foreach($controller->getFormField($value) as $formvalue)
                                        <td class="text-center">{{$controller->getFormFieldName($formvalue->form_field_id)}}</td>
                                        <td class="text-center">{{$formvalue->input_values}}</td>
                                    @endforeach
                                    @if(count($controller->getFormField($value))== 4)
                                        <td class="text-center">
                                            <a href="/admin/manageform/viewmorecustomers/{{$value}}" class="btn btn-secondary btn-lg">More</a>
                                        </td>
                                    @elseif(count($controller->getFormField($value))== 2)
                                        <td class="text-center" colspan="7" style="color:black; font-weight:bold;"> No More Fields</td>
                                    @elseif(count($controller->getFormField($value))== 3)
                                        <td class="text-center" colspan="5" style="color:black; font-weight:bold;"> No More Fields</td>
                                    @elseif(count($controller->getFormField($value))== 1)
                                        <td class="text-center" colspan="8" style="color:black; font-weight:bold;">No More Fields</td>
                                    @endif
                                </tr>
                                @endforeach
                                </tbody>


                           </table>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>

    </div>
</div>
    </div>

<script>
$(document).ready(function(){
        // $(window).load(function() {
        // $("#loading").fadeOut(3000);
        // });
        var values=document.getElementById('values').value;
        console.log(values);
});
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
                    url:"/admin/manageform/viewcustomers/fetch_data/{{$form_id}}?page="+page,
                    success:function(data)
                    {
                        $('#table_data').html(data);
                        console.log(data);
                    }
                });

            }
        });
</script>
@endsection
