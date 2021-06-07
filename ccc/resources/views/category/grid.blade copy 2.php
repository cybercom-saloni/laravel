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
<div id="layoutSidenav_content">
    <div class="container">
        <main>
           <div class="col-12 row">
                <div class="col-6">
                <button type="button" id="show" class="btn btn-success mt-2 mb-2">Add Root Category</button>
                @if (request()->id)
                <button type="button" id="showSub" class="btn btn-success mt-2 mb-2">Add subcategory</button>
                @endif
                <script>
                    $("#addRootForm").hide();
                    $(document).ready(function() {
                        
                        $("#show").click(function() {
                            $("#addRootForm").show();
                            $("#editCategoryModal").hide();
                            $("#addSubForm").hide();
                            $(".ad").css('display','none');
                            $(".up").css('display','none');
                            $(".del").css('display','none');
                            $(".er").css('display','none');
                        });
                    });
                </script>
                <script>
                    $("#addSubForm").hide();
                    $(document).ready(function() {
                        $("#showSub").click(function() {

                            $("#addSubForm").show();
                            $("#editCategoryModal").hide();
                            $("#addRootForm").hide();
                            $(".ad").css('display','none');
                            $(".up").css('display','none');
                            $(".del").css('display','none');
                            $(".er").css('display','none');
                        });
                    });
                </script>
                                    <ul id="tree1">
                                        @foreach ($categories as $category)
                                        <li>
                                            <a  style="color: {{ $category->status == 0 ? 'red' : '' }} href="javascript:void(0);" onclick="object.setUrl('<?php echo  route('formEdit', $category->id) ?>').setMethod('get').load();" style="color: {{ $category->status == 0 ? 'red' : '' }}">{{ $category->name }}</a>
                                            <ul>
                                            @if (count($category->childs))
                                                @include('category.child',['childs' => $category->childs])
                                            @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                </div>
                <div class="col-6 bg-primary">
                @if(session('Delete'))
                <div class ="alert alert-success del" style="display:block">{{session('Delete')}}</div>
            @endif
            @if(session('error'))
                <div class ="alert alert-success er" style="display:block">{{session('error')}}</div>
            @endif
            @if(session('Added'))
                <div class ="alert alert-success ad" style="display:block">{{session('Added')}}</div>
            @endif

            @if(session('Updated'))
                <div class ="alert alert-success up" style="display:block">{{session('Updated')}}</div>
            @endif
            <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                   
                </div>
                </div>
           </div>                
        </main>
    </div>
    <script src="{{asset('js/categorytree.js')}}"></script>