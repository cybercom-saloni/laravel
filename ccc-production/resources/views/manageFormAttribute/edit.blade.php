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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <h3 class="card-title"> Edit {{$formName}}  Fields</h3>
                                </div>
                            </div>
                            <form action="/admin/formNameEditSave/{{$attributeEdit->id}}" method="post" id="form">
                                @csrf
                                <div class="form-group col-lg-12">

                                    <input type="hidden"  class="form-control" value="{{$entity_name}}" name="attribute[entity_type_id]" id="name" aria-describedby="helpId" placeholder="ENTITY NAME">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="{{$attributeEdit->name}}" name="attribute[name]" id="name" aria-describedby="helpId" placeholder="ENTITY NAME" data-validation="required length" data-validation-length="min2" onload="createSlug(this.value)" onkeyup="createSlug(this.value)">
                                    </div>

                             
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label for="name">label</label>
                                    <input type="text"  value="{{$attributeEdit->label}}" class="form-control" name="attribute[label]" id="label" aria-describedby="helpId" placeholder="Attribute Label" data-validation="required">
                                </div>
                            
                                <div class="form-group col-lg-6">
                                    <label for="name">placeholder</label>
                                    <input type="text"  value="{{$attributeEdit->placeholder}}" class="form-control" name="attribute[placeholder]" id="placeholder" aria-describedby="helpId" placeholder="Attribute Placeholder" data-validation="required">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label for="name">Validation</label>
                                    <input type="text"   id="validation" value="{{$attributeEdit->validation}}" class="form-control" name="attribute[validation]" id="placeholder" aria-describedby="helpId" placeholder="For example:- minlength=1,maxlength=10">
                                    <br>
                                    <div class="alert alert-warning">
                                    Validations that can be used as comma-separated:-
                                    minimum characters (minlength = value)
                                    maximum characters (maxlength = value)
                                    For example:- minlength=1,maxlength=10
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="name">style</label>
                                        <input type="text"  value="{{$attributeEdit->style}}" class="form-control" name="attribute[style]" id="style" aria-describedby="helpId"  placeholder="background-color:red,font-size:10px"><br>
                                        <div class="alert alert-warning">
                                    Css Styles that can be used as comma-separated:-

                                    For example:- background-color:red,font-size:10px
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-4">
                                
                                    <label for="name">isrequired</label>
                                    <select name="attribute[isrequired]" id="isrequired" class="form-control"  data-validation="required number">
                                            <option disabled selected>Select isRequired</option>
                                            <option value="1" {{$attributeEdit ? ($attributeEdit->isrequired == 1? 'selected' : ''): ' '}}>
                                               Yes
                                            </option>
                                            <option value="0" {{$attributeEdit ? ($attributeEdit->status == 0? 'selected' : ''): ' '}}>
                                                no
                                            </option>
                                        </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="name">Sort Order</label>
                                        <input type="text"  value="{{$attributeEdit->sort_order}}"class="form-control" name="attribute[sort_order]" id="sort_order" aria-describedby="helpId" placeholder="Attribute Sorting Order" data-validation="required number">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="name">STATUS</label>
                                         <select name="attribute[status]" id="status" class="form-control"  data-validation="required number">
                                            <option disabled selected>Select Status</option>
                                            <option value="1" {{$attributeEdit ? ($attributeEdit->status == 1? 'selected' : ''): ' '}}>
                                                ENABLE
                                            </option>
                                            <option value="0" {{$attributeEdit ? ($attributeEdit->status == 0? 'selected' : ''): ' '}}>
                                                DISABLE
                                            </option>
                                        </select>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="name">input Type</label>
                                    <select name="attribute[input_type]" id="inputType" class="form-control"  data-validation="required" readonly disabled>
                                             <option disabled selected>Select Input Type</option>
                                             @foreach ($controller->getInputTypeOption() as $key => $value)
                                             <option value="{{$value}}" {{$attributeEdit ? ($attributeEdit->input_type == $value? 'selected' : ''): ' '}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-lg-6">
                                     <br><button type="submit" name="saveCategory" id="update" class="btn  btn-lg btn-secondary">UPDATE</button>
                                </div>
                            </div>

                            </form>
                           
                                    <br>

                                    @if($attributeEdit->input_type == 'select' || $attributeEdit->input_type == 'checkbox' || $attributeEdit->input_type == 'radio'|| $attributeEdit->input_type == 'multiselect' )

                                    <form action="/admin/Attribute/option/save/{{request()->id}}" method="POST">
                                    @csrf
                                    <div class="form-group contentHtml col-lg-6">
                                            <input type="submit" value="Update" onclick="submitForm()" id="update" class="btn btn-info btn-md">
                                            <input type="button" name="addOption"  value="Add Option" onclick="addRow()" class="btn btn-warning btn-md">
                                            <br><br>
                                            <table width=100 boarder=2 id="existingOption" class="table">
                                                    <thead>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Sort Order</th>
                                                        <th>Delete</th>
                                                    <thead>
                                                        <tbody>

                                                            @if($attribute->count() == 0)
                                                            <tr id='NoDataFound'>
                                                                <td colspand=3>Data Not Found...</td>
                                                            </tr>
                                                            @endif
                                                            @foreach($attribute as $key=>$option)
                                                            <tr>
                                                                <td><input type="text" name="Exist[{{$option->id}}][id]" placeholder="id"
                                                                value="{{ $option->id}}" class="form-control" readonly></td>
                                                                <td><input type="text" name="Exist[{{$option->id}}][name]" placeholder="Name"
                                                                value="{{ $option->name}}" class="form-control" data-validation="required"></td>

                                                                <td><input type="number" name="Exist[{{$option->id}}][sort_order]"
                                                                placeholder="Sort Order" value="{{ $option->sort_order}}" class="form-control"></td>

                                                                <td><a name="remove" value="remove Option"
                                                                class="btn btn-danger btn-md" href="/admin/Attribute/option/delete/{{$option->id}}">
                                                                <span class="glyphicon glyphicon-trash"></span></a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>

                                            <div style="display:none">
                                                <table id='newOption' class='table'>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="text" name="New[name][]" placeholder="Name" class="form-control"></td>
                                                    <td><input type="text" name="New[sort_order][]" placeholder="Sort Order" class="form-control"></td>
                                                    <td><a type="button" name="remove" value="remove Option"  onclick="removeOption(this)" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-trash"></span></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </form>
                                    @endif

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="/admin/manageform/viewfields/{{Session::get('entity_type_id')}}"><h3 class="card-title"> View {{$formName}} Fields </h3></a>
                                                </div>
                                                <div class="col-lg-6"><a href="/admin/manageform/viewFormfields/{{Session::get('entity_type_id')}}"><h3> View Dummy Form </h3></a></div>
                                            </div>
                                            </div>
                                        </div>

                                        <table  class="table table-bordered bg-light col-12  table-hover table-responsive" id="example">
                                            <thead class="text-white" style="background-color: darkkhaki;">
                                                <tr>
                                                    
                                                    
                                                    <th>Name</th>
                                                    <th>input_type</th>
                                                    <th>label</th>
                                                    <th>placeholder</th>
                                                    <th>validation</th>
                                                    <th>style</th>
                                                    <th>isrequired</th>
                                                    <th colspan="4">Action</th>
                                                </tr>
                                            </thead>
                                        <tbody>

                                                @if(!$fields->count()> 0)
                                                <tr><td colspan="16">No Record Found!!!</td></tr>
                                                @endif
                                                @foreach($fields as $value)
                                                <tr>
                                                   
                                                    <td>{{$value->name}}</td>

                                                    <td>{{$value->input_type}}</td>

                                                    <td>{{$value->label}}</td>
                                                    <td>{{$value->placeholder}}</td>
                                                    <td>{{$value->validation}}</td>
                                                    <td>{{$value->style}}</td>
                                                    <td>@if($value->isrequired == '1')
                                                        Yes
                                                        @else
                                                        No
                                                        @endif
                                                    </td>
                                                    
                                                  
                                                    <td>
                                            @if($value->status == 1)
                                            <a href='/admin/formNameStatus/{{$value->id}}' class="btn btn-warning" id="status">Enable</a>
                                                @else
                                                <a href='/admin/formNameStatus/{{$value->id}}' class="btn btn-danger" id="status"> Disable</a>
                                            @endif
                                        </td>
                                        <td><a href='/admin/manageform/editfields/{{$value->id}}' class="btn btn-secondary" id="status">Edit</a></td>
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

        $(document).ready(function(){
            inputType =$('#inputType').val();
        console.log(inputType);
        if(inputType == "date" || inputType == "multiselect" || inputType == "checkbox" || inputType == "radio")
        {
          $("#validation").prop('readonly', true);
        }
        else
        {
          $("#validation").prop('readonly', false);
        }

        $('.addRow').on('click',function(){
  		$("table tbody").append($("table tbody tr:first").clone(true));
        });
       });

        function addRow() {
        var newOptiontable = document.getElementById('newOption');
        var existOptiontable = document.getElementById('existingOption').children[0];
        var NoDataFound = document.getElementById('NoDataFound');
        existOptiontable.append(newOptiontable.children[0].children[0].cloneNode(true));
        NoDataFound.remove();
    }

    function removeOption(button) {
        var objTr =$(button).closest('tr');
        console.log(objTr);
        objTr.remove();
    }
</script>

@endsection
