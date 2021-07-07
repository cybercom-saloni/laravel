@if (Session::has('error'))

    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <i class="fa fa-info-circle"></i> {{ Session::get('error') }}
        {{ Session::forget('error') }}

    </div>

@endif


@if (Session::has('success'))

    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <i class="fa fa-info-circle"></i> {{ Session::get('success') }}
        {{ Session::forget('success') }}
    </div>

@endif
