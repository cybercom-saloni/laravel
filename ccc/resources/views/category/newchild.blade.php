@foreach($child as $value)
	<li>
        <a href="{{route('addSubCategory',$value->id)}}">{{$value->name}}</a>
	@if(count($value->child))
            @include('category.manageChild',['child' => $value->child])
        @endif
	</li>
@endforeach