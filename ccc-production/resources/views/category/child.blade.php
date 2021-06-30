    <ol class="dd-list list-group">

        @foreach ($childs as $child)


            <li class="dd-item list-group-item" data-id="{{ $child['id'] }}" >
                <div class="dd-handle"></div>
                <div class="dd-option-handle">

                <a href="<?php echo route('formEdit', ['id' =>$child->id, 'type' => 'category'])?>"
                    style="margin-left: -35px;color: <?php $child->status == 2 ? 'grey' : '' ?>">
                    {{ $child->name }}</a>

                </div>


                @if (count($child->childs))
                    @include('category.child',['childs' => $child->childs])
                @endif
            </li>
        @endforeach
    </ol>

