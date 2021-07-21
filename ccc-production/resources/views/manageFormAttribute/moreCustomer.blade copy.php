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
                                    <h3 class="card-title"> View All Customer of {{$controller->getFormName($form_id)}} Form</h3>

                           <table class="table table-bordered bg-light col-12  table-hover" id="example">
                                <tbody>
                                    <tr>
                                        <td class="text-center">Fields</td>
                                        <td class="text-center">Values</td>
                                    </tr>
                                    @foreach($values as $formvalue)
                                    <tr>
                                        @if($controller->getFormFieldName($formvalue->form_field_id) === "sumbit")
                                            <td class="text-center" colspan="2">New Record</td>
                                        @else
                                            <td class="text-center">{{$controller->getFormFieldName($formvalue->form_field_id)}}</td>
                                        @endif
                                            @if($formvalue->input_values != null)
                                                @if(strpos($formvalue->input_values, '.jpg') !== false ||strpos($formvalue->input_values, '.jpeg') !== false ||strpos($formvalue->input_values, '.png') !== false ||strpos($formvalue->input_values, '.svg') !== false ||strpos($formvalue->input_values, '.gif') !== false)
                                                    <td class="text-center"><img src="\frontend\images\{{$formvalue->input_values}}" width="100px" height="100px"></td>
                                                @elseif(strpos($formvalue->input_values, '.docx') !== false ||strpos($formvalue->input_values, '.csv') !== false ||strpos($formvalue->input_values, '.pdf') !== false ||strpos($formvalue->input_values, '.txt') !== false||strpos($formvalue->input_values, '.xls') !== false)
                                                    <td class="text-center"><a href="\frontend\files\{{$formvalue->input_values}}" style="color:#676a6d;">{{$formvalue->input_values}}</a></td>
                                                @else
                                                    @if($formvalue->input_values === "sumbit")

                                                    @else
                                                    <td class="text-center">{{$formvalue->input_values}}</td>
                                                    @endif
                                                @endif
                                            @elseif($formvalue->option_id != null)
                                                <td class="text-center">{{$controller->getOptionName($formvalue->option_id)}}</td>
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

