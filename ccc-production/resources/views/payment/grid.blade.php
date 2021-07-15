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
                            <h3 class="panel-title">Manage Payment</h3>
                        </div>
<div class="col-12">
    <div class = "row">
        <div class="col-6">
            <a href="/payment/form" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New Payment</a>
        </div>
        <div class="col-6">
        </div>
    </div>
</div>
@if(session('paymentstatus'))

<div class ="alert alert-success">{{session('paymentstatus')}}</div>
@endif
@if(Session::get('PaymentSave'))
<div class ="alert alert-success">{{Session::get('PaymentSave')}}</div>
@endif
@if(session('paymentDelete'))
<div class ="alert alert-success">{{session('paymentDelete')}}</div>
@endif

<table class="table table-bordered bg-light  table-hover">
            <thead class="bg-dark text-white">
              
                <tr>
                    <?php $order = "asc"?>
                    <th><a class="column_sort" data-column_name="id" data-sorting_type="asc" style="cursor:pointer;">ID</a></th>
                    <th><a class="column_sort" data-column_name="name" data-sorting_type="asc" style="cursor:pointer;">Name</a></th>
                    <th><a class="column_sort" data-column_name="code" data-sorting_type="asc" style="cursor:pointer;">Code</a></th>
                    <th><a class="column_sort" data-column_name="description" data-sorting_type="asc" style="cursor:pointer;">Description</th>
                    <th>Status</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>

                @if (!$payments)

                    <tr>
                        <td colspan="12" class="text-center">No Records Found</td>
                    </tr>
                @else
                    @foreach ($payments as $value)

                        <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->code}}</td>
                        <td>{{$value->description}}</td>
                        <td>
                        @if($value->status == 1)
                        <a href="/payment/status/{{$value->id}}"class="btn btn-warning">Enable</a>
                            @else
                            <a href="/payment/status/{{$value->id}}"class="btn btn-danger"> Disable</a>
                        @endif
                        </td>
                        <td><a href="/payment/form/{{$value->id}}" class="btn btn-success">Edit</a></td>
                        <td> <a href="/paymentDelete/{{ $value->id}}"class="btn btn-secondary">Delete</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id">
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">


            <!-- pagination -->

     </div>


<script>
$(function() {
    $('#recordPerPage').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/setPages/payment',
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
    $(document).ready(function(){
        function fetch_data(sort_type="" ,column_name="")
        {
            $.ajax({
                url:"/payment/sorting?sortby="+column_name+"&sort_type="+sort_type,
                success:function(data)
                {
                    $("#table_data").html(data);
                }
            });
            }
        $(document).on('click','.column_sort',function(){

           var column_name = $(this).data('column_name');
           var order_type = $(this).data('sorting_type');
           var reverse_order ="";
           if(order_type == "asc")
           {
               $(this).data('sorting_type','desc');
               reverse_order = 'desc';
           }
           else
           {
               $(this).data('sorting_type','asc');
               reverse_order = 'asc';
           }
           $("#hidden_column_name").val(column_name);
           $("#hidden_sort_type").val(reverse_order);
           fetch_data(reverse_order,column_name);
        });
    });
});
</script>
@endsection
