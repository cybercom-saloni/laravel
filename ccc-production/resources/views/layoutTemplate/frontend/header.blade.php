<div class="col-12">
    <div class="row">
        <div class="nav">
            <a style="margin-left:50px; font-size:24px;" class="nav-link" href="/user/dashboard"> Home</a>
            @foreach($controller->showSlug() as $key =>$value)
            <a style="margin-left:50px; font-size:24px;" class="nav-link" href="/user/{{$value->slug}}">{{$value->entity_name}}</a>
            @endforeach
        </div>

    </div>
</div>
