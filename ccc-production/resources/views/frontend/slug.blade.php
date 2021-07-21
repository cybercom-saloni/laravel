@extends('layoutTemplate.frontend.main1')
<style>


[type="submit"], [type="reset"], button, html [type="button"] {
    margin-left: 0;
    border-radius: 0;
    background: black;
    border: none;
    font-weight: 300;
    padding: 10px 0;
    line-height: 1;
}
</style>
@section('content')
@include('layoutTemplate.frontend.header')
<div id="table_data">
<div id="Content">
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="container-fluid">

            <!-- OVERVIEW -->
            <div class="panel panel-headline">

                <div class="panel-heading">

                </div>
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


                                    @if($attribute->count() == 0)
                                    <h3>No Data Found for this form....</h3>
                                    @endif
                                    <h3>{{$entity->entity_name}}</h3><br>
                                <form action="/admin/manageform/frontuser/save/{{$entity->id}}" id ="slugform" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @foreach($attribute as $key=>$value)

                                    @if ($value->input_type == 'textarea')
                                         @if($value->description_type == 1)
                                            <div class="row" style="padding-bottom: 20px;">
                                                <div class="col-lg-2">
                                                    <label for="{{$value->name}}"> {{$value->name}}</label>
                                                </div>
                                                <div class="col-lg-10">
                                                <textarea class="form-control TextText"  name="{{$value->name}}"  value="{{old($value->name)}}" id="description"  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="resize: vertical;{{$controller->getStyle($value->id,$entity->id)}}" ></textarea>
                                                <span class="desc" style="color:#a94442; font-family: 'Source Sans Pro','sans-serif';font-size: 15px;">This is a required field</span>
                                                </div>
                                            </div><br>
                                        @elseif($value->description_type == 0)
                                        <div class="row" style="padding-bottom: 20px;">
                                                <div class="col-lg-2">
                                                    <label for="{{$value->name}}"> {{$value->name}}</label>
                                                </div>
                                                <div class="col-lg-10">
                                                <textarea name="{{$value->name}}" id="description"   class="form-control"  value="{{old($value->name)}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" placeholder="{{$value->placeholder}}"  <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>></textarea>
                                                </div>
                                            </div><br>
                                        @endif
                                     @endif

                                    @if ($value->input_type == 'text')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control"   value="{{old($value->name)}}" name="{{$value->name}}" id="{{$value->name}}" placeholder="{{$value->placeholder}}"    <?php if($value->isrequired == 1) echo " aria-describedby='helpId' data-validation='required'"; else "";?> {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'number')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="number" value="{{old($value->name)}}" name="{{$value->name}}" id="{{$value->name}}" class="form-control" placeholder="{{$value->placeholder}}"   <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}}  style="{{$controller->getStyle($value->id,$entity->id)}}">
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'password')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="password"  value="{{old($value->name)}}" name="{{$value->name}}" id="{{$value->name}}" class="form-control" placeholder="{{$value->placeholder}}"   <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'email')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="email"  value="{{old($value->name)}}"  name="{{$value->name}}" id="{{$value->name}}" class="form-control" placeholder="{{$value->placeholder}}"   <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'button')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">

                                        </div>
                                        <div class="col-lg-10">
                                            <button type="sumbit"  value="{{$value->name}}" name="{{$value->name}}" id="{{$value->name}}" class="btn btn-success" placeholder="{{$value->placeholder}}"   <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">{{$value->name}}</button>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($value->input_type == 'select')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">

                                            <select class="form-control"  name="{{$value->name}}[]" id="{{$value->name}}"  <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?> {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                            <option value="" disabled selected>Select</option>
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <option value="{{$option->id}}" id="{{$option->id}}" {{old($value->name) === $option->id ? 'selected' : ''}}>{{$option->name}}{{old($option->id)}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif


                                    @if ($value->input_type == 'multiselect')
                                    <div class="row"  style="padding-bottom: 20px;" >
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">

                                            <select multiple class="form-control multiple-select"  name="{{$value->name}}[]" id="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}"  <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>>
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                                <option value="{{$option->id}}" id="{{$option->id}}" {{ old($value->id) === $option ? 'selected' : ''}}>{{$option->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'radio')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <input type="radio"  name="{{$value->name}}[]" id="{{$value->name}}" {{ old($value->id) === $option ? 'selected' : ''}} {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" value="{{$option->id}}"  <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>>{{$option->name}}
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'checkbox')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10 form-check form-check-inline" >
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <input type="checkbox" value="{{$option->id}}" class="form-check-input checkboxValidation"   name="{{$value->name}}[]" id="{{$value->name}}" {{ old($value->id) === $option ? 'checked' : ''}} {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">{{$option->name}}
                                            @endforeach
                                            <br><span class="checkboxvali" style="color:#a94442; font-family: 'Source Sans Pro','sans-serif';font-size: 15px;">This is a required field</span>
                                        </div>
                                    </div>
                                    @endif





                                    @if ($value->input_type == 'date')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text"  value="{{old($value->name)}}" class="form-control"  name="{{$value->name}}" id="datepicker"  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'color')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="color"  value="{{old($value->name)}}" class="form-control"  name="{{$value->name}}" id="{{$value->name}}"  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>>
                                        </div>
                                    </div>
                                    @endif


                                    @if ($value->input_type == 'file')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="file" class="form-control"  name="{{$value->name}}[]" id="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" <?php if($value->isrequired == 1) echo "data-validation='required'"; else "";?>>
                                        </div>
                                    </div>
                                    @endif

                                    @endforeach

                                </form>

                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
<script type="text/javascript">
 $(document).ready(function(){
    $('.desc').hide();
    $('.checkboxvali').hide();
        $(window).load(function() {
        $("#loading").fadeOut(3000);
        });

 $("#sumbit").click(function(){
    $.validate();

    if($('.TextText').summernote('isEmpty')) {
        $('.desc').show();

        console.log('contents is empty, fill it!');

    }
    else
    {
    $('.desc').hide();
    }

    if($(".checkboxValidation").filter(":checked").length < 1)
    {
        $('.checkboxvali').show();

    }
    else
    {
        $('.checkboxvali').hide();
    }


    $("#loading").show();  $("#loading").fadeOut(3000);
    });
 });



        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            })
        });

        // $(".multiple-select").select2({
        // //   maximumSelectionLength: 2
        // });
        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat:"dd-mm-yy",
                maxDate :'D'
            });
        } );




    </script>

@stop
