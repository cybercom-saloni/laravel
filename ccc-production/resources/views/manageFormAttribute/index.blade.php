@extends('layoutTemplate.main')

@section('content')
<style>
  #loading{
	position: fixed;
	width: 100%;
	height: 100vh;
	background: #fff
	url("{{ asset('spnner.gif') }}")
	 no-repeat center center;
	z-index: 99999;
}
</style>
<div id="loading"> </div>

<div id="Content">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">


                <div class="panel-body">
                 @include('layoutTemplate.message')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> Add Custom Attribute</h3>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <a href="/admin/formNameAttribute/create" class="btn btn-lg btn-mute mb-10" style="margin-bottom:15px"><i class="fa fa-plus-square"></i> Create New Attribute</a><br>
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                            </div>

                            <table class="table table-bordered bg-light col-12  table-hover table-responsive" id="example">
                                <thead class="text-white" style="background-color: darkkhaki;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Entity_type_id</th>
                                        <th>Name</th>
                                        <th>slug</th>
                                        <th>input_type</th>
                                        <th>backend_type</th>
                                        <th>label</th>
                                        <th>placeholder</th>
                                        <th>validation</th>
                                        <th>style</th>
                                        <th>isrequired</th>
                                        <th>Sort_Order</th>
                                        <th>Status</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!$attribute->count()> 0)
                                    <tr><td colspan="16">No Record Found!!!</td></tr>
                                    @endif
                                    @foreach($attribute as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$controller->entityName($value->entity_type_id)}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->slug}}</td>
                                        <td>{{$value->input_type}}</td>
                                        <td>{{$value->backend_type}}</td>
                                        <td>{{$value->label}}</td>
                                        <td>{{$value->placeholder}}</td>
                                        <td>{{$value->validation}}</td>
                                        <td>{{$value->style}}</td>
                                        <td>{{$value->isrequired}}</td>
                                        <td>{{$value->sort_order}}</td>
                                        <td>
                                            @if($value->status == 1)
                                            <a href='/admin/formNameStatus/{{$value->id}}' class="btn btn-warning" id="status">Enable</a>
                                                @else
                                                <a href='/admin/formNameStatus/{{$value->id}}' class="btn btn-danger" id="status"> Disable</a>
                                            @endif
                                        </td>
                                        <td><a href='/admin/formNameEdit/{{$value->id}}' class="btn btn-secondary" id="status">Edit</a></td>
                                        <td>  <a href='/admin/formNameDelete/{{$value->id}}' class="btn btn-secondary" id="status">Delete</a></td>
                                        @if($value->input_type == 'select')
                                        <td style="padding-left:0px">  <a  href='/admin/Attribute/option/{{$value->id}}' class="btn btn-secondary" id="options">Options</a></td>
                                        @elseif($value->input_type == 'radio')
                                        <td style="padding-left:0px">  <a  href='/admin/Attribute/option/{{$value->id}}' class="btn btn-secondary" id="options">Options</a></td>
                                        @elseif($value->input_type == 'checkbox')
                                        <td style="padding-left:0px">  <a  href='/admin/Attribute/option/{{$value->id}}' class="btn btn-secondary" id="options">Options</a></td>
                                        @else
                                        <td></td>
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

<script>
    $(window).load(function() {
        $("#loading").fadeOut(3000);
        });
        $("#status").click(function() {
            jQuery("#loading").show();
        });
</script>
@stop
