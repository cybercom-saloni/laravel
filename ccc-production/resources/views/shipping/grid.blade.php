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
                            <h3 class="panel-title">Manage Shipping</h3>
                        </div>

<div class="col-12">
    <div class = "row">
        <div class="col-6">
            <a href="/shipping/form" id="formid" class="btn btn-md btn-success mb-4"><i class="fas fa-plus-square"></i> Create New shipping</a>
        </div>
        <div class="col-6">
        </div>
    </div>
</div>
@if(session('shippingstatus'))

<div class ="alert alert-success">{{session('shippingstatus')}}</div>
@endif
@if(Session::get('shippingSave'))
<div class ="alert alert-success">{{Session::get('shippingSave')}}</div>
@endif
@if(session('shippingDelete'))
<div class ="alert alert-success">{{session('shippingDelete')}}</div>
@endif

<table class="table table-bordered bg-light  table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>

                @if (!$shippings)

                    <tr>
                        <td colspan="12" class="text-center">No Records Found</td>
                    </tr>
                @else
                    @foreach ($shippings as $value)

                        <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->code}}</td>
                        <td>{{$value->amount}}</td>
                        <td>{{$value->description}}</td>
                        <td>
                        @if($value->status == 1)
                        <a href="/shipping/status/{{$value->id}}" class="btn btn-warning">Enable</a>
                            @else
                            <a href="/shipping/status/{{$value->id}}" class="btn btn-danger"> Disable</a>
                        @endif
                        </td>
                        <td><a href="/shipping/form/{{$value->id}}" class="btn btn-success">Edit</a></td>
                        <td> <a href="/shippingDelete/{{ $value->id }}" class="btn btn-secondary">Delete</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

            <!-- pagination -->

     </div>
     <div>
     <div class ="col-12">
        <div class ="row">
            <div class="col-6">
                <nav>
                    <ul class="pagination">

                        @if($shippings->currentPage() != 1)
                        <li class="page-item">
                            <a class="page-link{{$shippings->previousPageUrl()? ' ':'disabled'}}" href="javascript:void(0)" onclick="object.setUrl('{{$shippings->previousPageUrl()}}').setMethod('get').load()">Previous</a>
                        </li>
                        @endif
                        @for($i=1;$i<=$shippings->lastPage();$i++)
                            <li class="page-item {{Request::get('page') == $i ? 'active' : ' '}}">
                                <a class="page-link" onclick="object.setUrl('{{$shippings->url($i)}}').setMethod('get').load()" href="javascript:void(0);">{{$i}}</a>
                            </li>
                        @endfor
                        @if($shippings->currentPage() != $shippings->lastPage())
                        <li class="page-item">
                            <a class="page-link{{$shippings->nextPageUrl() ? ' ':'disabled'}}" onclick="object.setUrl('{{$shippings->nextPageUrl()}}').setMethod('get').load();" href="javascript:void(0)">Next</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class ="col-6">
                    <form action="/setPages/shipping" method="post" id="records">
                        @csrf
                        <div class="navbar-btn navbar-btn-right">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="recordPerPage">Record Per Page</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="recordPerPage" id="recordPerPage" class="form-control col-lg-5">
                                            <option value="2"
                                                {{ Session::has('page') ? (Session::get('page') == 2 ? 'selected' : '') : '' }}>
                                                2
                                            </option>
                                            <option value="4"
                                                {{ Session::has('page') ? (Session::get('page') == 4 ? 'selected' : '') : '' }}>
                                                4
                                            </option>
                                            <option value="20"
                                                {{ Session::has('page') ? (Session::get('page') == 20 ? 'selected' : '') : '' }}>
                                                20
                                            </option>
                                            <option value="50"
                                                {{ Session::has('page') ? (Session::get('page') == 50 ? 'selected' : '') : '' }}>
                                                50
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
<script>
$(function() {
    $('#recordPerPage').on('change', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '/setPages/shipping',
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
});
</script>
@endsection
