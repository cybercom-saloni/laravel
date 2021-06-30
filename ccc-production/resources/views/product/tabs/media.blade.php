@extends('layoutTemplate.main')

@section('content')
<div id="Content">
        <div class="main">
        <?php $data = $product->getMedias(); ?>
        <h1> Product Media</h1>
        @include('product.tabs')

        @include('layoutTemplate.message')
      @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span arial-hidden="true">x</span>
            </button>
                <i class="fa fa-warning-circle"></i> {{$error}}
        </div>
        @endforeach
      @endif

        @if(session('productUpload'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span arial-hidden="true">x</span>
            </button>
                <i class="fa fa-warning-circle"></i> {{session('productUpload')}}
        </div>
        @endif
        @if(session('updateMedia'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span arial-hidden="true">x</span>
            </button>
                <i class="fa fa-warning-circle"></i> {{session('updateMedia')}}
        </div>
        @endif
        @if(session('deleteMedia'))
            <div class ="alert alert-success">{{session('deleteMedia')}}</div>
        @endif
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Media </h3>
        <form action="/media/update/{{ request()->id }}" id="formupdate" method="POST">
        <button type="submit" name="update"   value="update"  name="update" value="update" class="btn btn-md btn-success"> <i
                        class="fa fa-pencil"></i></button>
                <button type="submit" name="delete"  value="delete" class="btn btn-md btn-secondary"> <i
                        class="fa fa-trash"  value="delete"></i></button>
                @csrf
                <div class="row">
                    <table class="table table-bordered bg-light  table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Image</th>
                                <th>Label</th>
                                <th>Small</th>
                                <th>Thumb</th>
                                <th>Base</th>
                                <th>Gallery</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$data)
                                <tr>
                                    <td colspan="7">No Images Found</td>
                                </tr>
                            @else
                                @foreach ($data as $media)
                                    <tr>

                                        <td>
                                            <a href="\images\products\cache\200x200\{{$media->media}}" target="_blank"><img src="\images\products\cache\100x100\{{$media->media}}"
                                                height="100" width="100"></a>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="image[{{ $media->id }}][label]" placeholder="Label" id="name"
                                                    value="{{ $media->label }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="small[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[small]" {{ $media->small == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="thumb[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[thumb]" {{ $media->thumb == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="radio" id="base[{{ $media->id }}]"
                                                    value="{{ $media->id }}"
                                                    name="image[base]" {{ $media->base == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="custom-control">
                                                <input type="checkbox"
                                                    id="gallery[{{ $media->id }}]"
                                                    name="image[{{ $media->id }}][gallery]"
                                                    {{ $media->gallery == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control">
                                                <input type="checkbox"
                                                    id="remove[{{ $media->id }}]"
                                                    name="image[{{ $media->id }}][remove]">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
            <form action="/product/imageUpload/{{ $product->id }}" id="upload_form" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="row">
                    <div class="col-10">
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-2">
                        <button type="submit"  name="upload" id="upload" class="btn btn-primary btn-md">Upload</button>
                    </div>
                </div>

            </form>
        </div>
        </div>
</div>
        <!-- <script>
                        $(function () {

                            $('#updatebtn').on('click', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '/media/update/{{ request()->id }}',
                                    data: $('#formupdate').serializeArray(),
                                    success: function (response) {
                                        if (typeof response.element == 'undefined') {
                                            return false;
                                        }
                                        if(typeof response.element == 'object') {
                                            $(response.element).each(function(i, element) {
                                                $('#content').html(element.html);
                                            })
                                        }
                                        else{
                                            $(response.element.selector).html(response.element.html);
                                        }
                                    }
                                });
                            });
                        });

                        $(function () {
                            $('#deletebtn').on('click', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '/media/delete/{{ request()->id }}',
                                    data: $('#formupdate').serializeArray(),
                                    success: function (response) {
                                        if (typeof response.element == 'undefined') {
                                            return false;
                                        }
                                        if(typeof response.element == 'object') {
                                            $(response.element).each(function(i, element) {
                                                $('#content').html(element.html);
                                            })
                                        }
                                        else{
                                            $(response.element.selector).html(response.element.html);
                                        }
                                    }
                                });
                            });

                        });


                            $(document).ready(function(){
                            $('#upload_form').on('submit', function(event){
                            event.preventDefault();
                            var _token = $("input[name='_token']").val();
                            var image = $("input[name='image']").val();
                            console.log(image);
                            $.ajax({
                            url:"/product/imageUpload/{{ $product->id }}",
                            method:"POST",
                            data:new FormData(this),
                            dataType:'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                                success: function(data) {
                                        if($.isEmptyObject(data.error)){
                                            if(typeof data.element == 'object') {
                                                $(data.element).each(function(i, element) {
                                                        $('#content').html(element.html);
                                                });
                                                }
                                        }else{
                                            printErrorMsg(data.error);
                                        }
                                    }
                            });
                            });
                            function printErrorMsg (msg) {
                                    $(".print-error-msg").find("ul").html('');
                                    $(".print-error-msg").css('display','block');
                                    $.each( msg, function( key, value ) {
                                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                                    });
                                }
                            });

                        </script> -->

@endsection
