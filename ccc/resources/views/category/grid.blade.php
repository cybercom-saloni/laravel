<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/categorytree.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/3fd66b9b9a.js" crossorigin="anonymous"></script>
</head>
<h2>Edit Category</h2>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
            <a href="javascript:void(0)" onclick="object.setUrl('/addRootCategory').setMethod('get').load();" class="btn btn-success">Add Root Category</a>
            <a href="javascript:void(0)" onclick="object.setUrl('/categoryAddSubCategory/{{$category_id}}').setMethod('get').load();" class="btn btn-success">Add Sub Category</a>
            <ul id="tree1">
                @foreach($parentcategories as $category)

                <li> <a href="javascript:void(0)" style="color: {{ $category->status == 0 ? 'red' : '' }}" onclick="object.setUrl('/category/{{$category->id}}').setMethod('get').load();">{{$category->name}}</a>
                    <ul>
                        @if(count($category->child))
                            @include('category.manageChild',['child' => $category->child])
                        @endif
                    </ul>
                </li>
                @endforeach
            </ul>
            </div>
            <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
               <form method="GET" id="form" action="{{route('categorEditSave',$categoryData[0]->id)}}">
                @csrf
                <button type="button"  onclick="object.setUrl('/categorEditSave/{{$category_id}}').setForm('form').load()" class="btn btn-md btn-success">UPDATE </button>
                <a onclick="object.setUrl('/categoryDelete/{{$categoryData[0]->id}}').setMethod('get').load()" href="javascript:void(0)" class="btn btn-secondary">Delete</a>
                <div class="form-group row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Category Name</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <input type="text" class="form-control" name="category[name]" value="@if(!$categoryData[0]->name){{' '}}@else {{$categoryData[0]->name}}@endif">
                    </div>
                </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label>Category Status</label>
                        </div>
                        <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                            <select class="form-control" name="category[status]" id="status">
                                <option disabled selected>Select Status</option>
                                <option value="1"<?php if($categoryData[0]->status==1)echo'selected'; else ' '; ?>>ENABLE</option>
                                <option value="0"<?php if($categoryData[0]->status==0)echo'selected'; else ' ';?>>DISABLE</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Description</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <textarea class="form-control" name="category[description]">@if(!$categoryData[0]->description){{' '}}@else {{$categoryData[0]->description}}@endif</textarea>
                    </div>  
               </div>
              
               </form>
               
            </div>
        </div>
    </div>
    </div>
</body>
<script src="{{asset('js/categorytree.js')}}"></script>
</html>
