        <?php $data = $product->getMedias(); ?>
        @include('product.tabs')
        @if(session('productUpload'))
            <div class ="alert alert-success">{{session('productUpload')}}</div>
        @endif
        @if(session('updateMedia'))
            <div class ="alert alert-success">{{session('updateMedia')}}</div>
        @endif
        @if(session('deleteMedia'))
            <div class ="alert alert-success">{{session('deleteMedia')}}</div>
        @endif
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Media </h3>
        <form action="" id="formupdate" method="POST">
                 <button type="button" name="update"  id="updatebtn"  value="update"   class="btn btn-md btn-success"> <i
                        class="fa fa-pencil"></i></button> 
                <button type="button" name="delete" id="deletebtn" value="delete" class="btn btn-md btn-secondary"> <i 
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
                                            <img src="\images\products\{{ $product->id }}\{{ $media->media }}"
                                                height=" 100px" width="100px">
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
            <form action="" id="upload_form" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="row">
                    <div class="col-10">
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="col-2">
                        <button type="submit"  name="upload" id="upload" class="btn btn-success btn-md">Upload</button>
                    </div>
                </div>

            </form>
        </div>

        <script>
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

                        </script>
