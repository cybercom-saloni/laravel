<ul>
    @foreach ($childs as $child)
        <li style="color: {{ $child->status == 0 ? 'red' : '' }}">
            <a style="color: {{ $child->status == 0 ? 'red' : '' }} href="javascript:void(0);" onclick="object.setUrl('<?php echo route('formEdit', $child->id) ?>').setMethod('get').load();" style="color:{{ $child->status == 0 ?'grey':''}}">
                {{ $child->name }}
            </a>
            @if (count($child->childs))
                @include('category.child',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>

