@foreach($child as $value)
	<li>
        <a href="javascript:void(0)" onclick="object.setUrl('/category/{{$value->id}}').setMethod('get').load();">{{$value->name}}</a>
	@if(count($value->child))
            @include('category.manageChild',['child' => $value->child])
        @endif
	</li>
@endforeach