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
<div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 bg-light">
            <a href="javascript:void(0)" onclick="object.setUrl('/addRootCategory').setMethod('get').load();" class="btn btn-success">Add Root Category</a>
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
            </div>
            </div>
            </div>
</body>
<script src="{{asset('js/categorytree.js')}}"></script>
</html>