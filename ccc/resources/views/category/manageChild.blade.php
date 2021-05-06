<ul>
@if($category->id)
<a href="{{route('addSubCategory',$category->id)}}" class="btn btn-success">ADD SUBCATEGORY</a>
@endif
@foreach($child as $value)
	<li>
        <a href="{{route('categoryEdit',$category->id)}}">{{$value->name}}</a>
        <a href="{{route('categoryDelete',$value->id)}}">Delete</a>
        <a href="{{route('categoryEdit',$value->id)}}">Edit</a>
        <a href="http://127.0.0.1:8000/categoryAddSubCategory/{{$value->id}}" class="btn btn-success">ADD SUBCATEGORY</a>
	@if(count($value->child))
            @include('category.manageChild',['child' => $value->child])
        @endif
	</li>
@endforeach
</ul>