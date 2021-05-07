<ul>
@foreach($child as $value)
	<li>
        <a href="{{route('addSubCategory',$value->id)}}">{{$value->name}}</a>
        <a href="{{route('categoryDelete',$value->id)}}">Delete</a>
        <a href="{{route('categoryEdit',$value->id)}}">Edit</a>
	@if(count($value->child))
            @include('category.manageChild',['child' => $value->child])
        @endif
	</li>
@endforeach
</ul>