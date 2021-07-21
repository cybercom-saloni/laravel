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
                                    <h3 class="card-title"> View Customer of {{$controller->getFormName($form_id)}} Form</h3>

                           <table class="table table-bordered bg-light col-12  table-hover" id="example">
                                <thead class="text-white" style="background-color: darkkhaki;">
                                    <tr>
                                        <th class="col-sm-1">ID</th>
                                        <th class="col-sm-2">Customer Name</th>
                                        <th  style="width:400px;" class="col-sm-2">Field Name</th>
                                        <th style="width:400px" class="col-sm-3">Field Values</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($values) == 0)
                                        <tr><td colspan="4"> No Data Found For {{$controller->getFormName($form_id)}} Form</td></tr>
                                    @endif
                                    @foreach($values as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$controller->getCustomerName($value->customer_id)}}</td>
                                        <td>{{$controller->getFormFieldName($value->form_field_id)}}</td>
                                        <td id="values" >
                                        @if($value->input_values != null)
                                            @if(strpos($value->input_values, '.jpg') !== false ||strpos($value->input_values, '.jpeg') !== false ||strpos($value->input_values, '.png') !== false ||strpos($value->input_values, '.svg') !== false ||strpos($value->input_values, '.gif') !== false)
                                                <img src="\frontend\images\{{$value->input_values}}" width="100px" height="100px">
                                            @elseif(strpos($value->input_values, '.docx') !== false ||strpos($value->input_values, '.csv') !== false ||strpos($value->input_values, '.pdf') !== false ||strpos($value->input_values, '.txt') !== false||strpos($value->input_values, '.xls') !== false)
                                                <a href="\frontend\files\{{$value->input_values}}" style="color:#676a6d;">{{$value->input_values}}</a>
                                            @else
                                                {{$value->input_values}}
                                            @endif
                                        @elseif($value->option_id != null)
                                            {{$controller->getOptionName($value->option_id)}}
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                           </table>
                                {{$values->links()}}
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
