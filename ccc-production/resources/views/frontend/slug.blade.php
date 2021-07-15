@include('layoutTemplate.frontend.main')
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
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> {{$entity->entity_name}}</h3>

                                    @if($attribute->count() == 0)
                                    <h3>No Data Found for this form....</h3>
                                    @endif
                                <form action="" method="POST">
                                    @foreach($attribute as $key=>$value)

                                    @if ($value->input_type == 'textarea')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                        <textarea name="{{$value->name}}" id="description"  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="resize: vertical;{{$controller->getStyle($value->id,$entity->id)}} class="form-control" placeholder="PRODUCT DESCRIPTION" <?php if($value->isrequired == 1) echo "required"; else "";?>></textarea>
                                        </div>
                                    </div><br>
                                     @endif
                                    @if ($value->input_type == 'text')
                                    <div class="row" style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="{{$value->placeholder}}"  <?php if($value->isrequired == 1) echo "required"; else "";?>  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                        </div>
                                    </div>
                                    @endif
                                    @if ($value->input_type == 'select')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">

                                            <select class="form-control" name="{{$value->name}}" <?php if($value->isrequired == 1) echo "required"; else "";?> {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}">
                                            <option disabled selected>Select</option>
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <option value={{$option->id}}>{{$option->name}}</option>
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

                                            <select multiple class="form-control" name="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" <?php if($value->isrequired == 1) echo "required"; else "";?>>
                                            <option disabled selected>Select</option>
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                                <option value={{$option->id}}>{{$option->name}}</option>
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
                                        <div class="col-lg-10 form-check">
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <input type="radio" class="form-check-input" name="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}" value="{{$option->name}}" <?php if($value->isrequired == 1) echo "required"; else "";?>>{{$option->name}}
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'checkbox')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10 form-check form-check-inline">
                                            @foreach($controller->getOptions($value->id) as $key =>$option)
                                            <input type="checkbox" class="form-check-input"  {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}"name="{{$value->name}}[]" value="{{$option->name}}">{{$option->name}}
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif



                                    @if ($value->input_type == 'date')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="date" class="form-control" name="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}"<?php if($value->isrequired == 1) echo "required"; else "";?>>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($value->input_type == 'number')
                                    <div class="row"  style="padding-bottom: 20px;">
                                        <div class="col-lg-2">
                                            <label for="{{$value->name}}"> {{$value->name}}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" name="{{$value->name}}" {{$value->validation?$controller->getValidation($value->id,$entity->id) : " "}} style="{{$controller->getStyle($value->id,$entity->id)}}"<?php if($value->isrequired == 1) echo "required"; else "";?>>
                                        </div>
                                    </div>
                                    @endif

                                    @endforeach
                                    <button type="submit" name="update" class="btn btn-success btn-lg">SUMBIT</button>
                                </form>

                </div>
            </div>
        </div>
        <!-- END OVERVIEW -->
    </div>
</div>
<!-- END MAIN CONTENT -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            });
        });
</script>


