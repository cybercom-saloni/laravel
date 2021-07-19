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
                                    <h3 class="card-title"> Add Custom Form</h3>
                                </div>
                            </div>
                            <form action="/admin/createNewFormNameSave" method="post" id="form">
                                @csrf
                                <div class="form-group col-lg-12">
                                    <label for="name">Entity_Name</label>
                                        <input type="text" class="form-control"  name="entity[entity_name]" id="name" aria-describedby="helpId" placeholder="ENTITY NAME" data-validation="required length" data-validation-length="min2" onload="createSlug(this.value)" onkeyup="createSlug(this.value)">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name">Slug</label>
                                        <input type="text" class="form-control" name="entity[slug]" id="slug" aria-describedby="helpId" placeholder="Entity Slug" data-validation="required length" data-validation-length="min2">

                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name">Sort Order</label>
                                        <input type="text"  min="1" step="1" class="form-control" name="entity[sort_order]" id="sort_order" aria-describedby="helpId" placeholder="Entity Sorting Order" data-validation="required number">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="name">STATUS</label>
                                         <select name="entity[status]" id="status" class="form-control"  data-validation="required number">
                                            <option disabled selected>Select Status</option>
                                            <option value="1">
                                                ENABLE
                                            </option>
                                            <option value="0">
                                                DISABLE
                                            </option>
                                        </select>
                                </div>
                                <div class="form-group col-lg-12">
                                    <center><button type="submit" name="saveCategory" id="update" class="btn  btn-lg btn-secondary">Add</button></center>
                                </div>
                            </form>
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
    $("#update").click(function(){

        $.validate();
        $("#loading").show();  $("#loading").fadeOut(3000);
    });

});
function createSlug(str)
        {
             //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g,' ').toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm,'');

             // replace space with dash/hyphen
            str = str.replace(/\s+/g, '-');
            $('#slug').val(str);
        }
        $(document).ready(function(){
            $("#slug").focusout(function() {
            slug = $('#slug').val();
            if(!slug)
            {
                str = $('#name').val();
                createSlug(str);
            }
            else
            {
                console.log(slug);
                createSlug(slug);
                console.log(slug);
            }
        });
        });

    // $('#myform').submit()
</script>
@endsection
