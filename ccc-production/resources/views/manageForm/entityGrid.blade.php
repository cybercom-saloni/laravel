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
                                    <h3 class="card-title"> Add Custom Page</h3>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <a href="/admin/createNewFormName" class="btn btn-lg btn-mute mb-10" style="margin-bottom:15px"><i class="fa fa-plus-square"></i> Create New Entity</a><br>
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                            </div>

                            <table class="table table-bordered bg-light col-12  table-hover" id="example">
                                <thead class="text-white" style="background-color: darkkhaki;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!$entity->count()> 0)
                                    <tr><td colspan="8">No Record Found!!!</td></tr>
                                    @endif
                                    @foreach($entity as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->entity_name}}</td>
                                        <td>{{$value->slug}}</td>
                                        <td>{{$value->sort_order}}</td>
                                        <td>
                                            @if($value->status == 1)
                                            <a href='/admin/createNewFormNameStatus/{{$value->id}}' class="btn btn-warning" id="status">Enable</a>
                                                @else
                                                <a href='/admin/createNewFormNameStatus/{{$value->id}}' class="btn btn-danger" id="status"> Disable</a>
                                            @endif
                                        </td>
                                        <td><a href='/admin/createFormNameEdit/{{$value->id}}' class="btn btn-secondary" id="status">Edit</a></td>
                                        <td>  <a href='/admin/createFormDelete/{{$value->id}}' class="btn btn-secondary" id="status">Delete</a></td>
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
