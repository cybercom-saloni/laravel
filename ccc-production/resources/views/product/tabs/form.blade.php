@extends('layoutTemplate.main')
<style>
  #loading{
	position: fixed;
	width: 100%;
	height: 100vh;
	background: #fff
	url("{{ asset('spnner.gif') }}")
	 no-repeat center center;
	z-index: 99999;
}
</style>
@section('content')
    <div id="Content">

        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                <!-- OVERVIEW -->
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Add New Product Details</h3>
        <form action="/productSave" method="POST" id="form">
                @csrf

                @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-warning-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span arial-hidden="true">x</span>
            </button>
             @foreach($errors->all() as $error)
             {{$error}}<br>
        @endforeach
        </div>
      @endif

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
             <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="sku"> Sku</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{old('product.sku') }}" id="sku"
                            placeholder="PRODUCT SKU" name="product[sku]" >
                    </div>

                </div>

                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ old('product.name')  }}" id="name"
                            placeholder="PRODUCT NAME" name="product[name]" onload="createSlug(this.value)" onkeyup="createSlug(this.value)" >
                    </div>

                </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Slug</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{old('product.slug')  }}" id="slug"
                            placeholder="PRODUCT SLUG" name="product[slug]">
                    </div>

                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Price( in Rs.)</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{old('product.price') }}" id="price"
                          min="1" step="0.01" placeholder="PRODUCT PRICE" name="product[price]" >
                    </div>
                </div>


                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="discount"> Discount(in %)</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{old('product.discount')  }}" id="price"
                            placeholder="PRODUCT DISCOUNT" name="product[discount]"  max="100" min="0" step="0.01">
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Quantity</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" id="quantity" class="form-control"
                            value="{{old('product.quantity') }}" placeholder="PRODUCT QUANTITY"
                            name="product[quantity]"  max="100" min="1" >
                    </div>
                    </div>

                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Status</label>
                        </div>
                    <div class="col-lg-6">
                        <select name="product[status]" id="status" class="form-control" >
                            <option disabled selected>Select Status</option>
                            <option value="1">
                                ENABLE
                            </option>
                            <option value="0">
                                DISABLE
                            </option>
                        </select>
                    </div>

                    </div>

                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Category</label>
                        </div>
                    <div class="col-lg-6">
                    <select id="category" name="product[category_id]" class="form-control" >
                        <option disabled selected>Choose Category</option>
                        @foreach ($product->getCategoryOptions() as $options)
                        <option value="{{ $options->id }}">
                            {{ $options->name }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                    </div>

                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="description"> Description</label>
                        </div>
                    <div class="col-lg-6">
                        <textarea name="product[description]" id="description" style="resize: vertical"
                            class="form-control"
                            placeholder="PRODUCT DESCRIPTION">{{old('product.description') }}</textarea>
                    </div>
                    </div>
                    <div class="form-group row">
                     <div class="col-lg-4">
                     </div>
                    <div class="col-lg-6">

                    <button type="submit" id ="update" class="btn btn-primary btn-md">Add new Product</button>
                </div>
                <div>
            </form>

        </div>
    </div>



                        </div>

                    </div>
                    <!-- END OVERVIEW -->
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
    </div>

    <div id="loading">  </div>
    <script type="text/javascript">
        $(function() {
                $('#description').summernote({
                    focus: true,
                    height: 250,
                    callbacks: {
                        onImageUpload: function(files) {
                            for (let i = 0; i < files.length; i++) {
                                sendFile(files[i]);
                            }
                        }
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function sendFile(file, editor, welEditable) {
                    data = new FormData();
                    data.append("file", file);

                    $.ajax({
                        data: data,
                        method: 'POST',
                        url: "/summernote/product/img-upload",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(file.name);
                            var image = $('<img>').attr('src', `/images/summernote_temp/product/${file.name}`);
                            $('#description').summernote("insertNode", image[0]);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus + " " + errorThrown);
                        }
                    });
                }

            });
        // $(document).ready(function() {
        //     $('#description').summernote({
        //         height: 200,
        //         callbacks: {
        //         onImageUpload: function(image) {
        //             uploadImage(image[0]);
        //         }
        //     }
        //     });

        // });
        // $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });

        // function uploadImage(image) {
        //     var data = new FormData();
        //     data.append("image", image);
        //     console.log(image);

        //     $.ajax({
        //         url: '/summernote/product/img-upload',
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         data: data,
        //         type: "POST",
        //         success: function(url) {
        //             console.log(url);
        //             console.log(image.name);
        //             // http://127.0.0.1:8000/images/summernote_temp/
        //             var image = $('<img>').attr('src', `/images/summernote_temp/${image.name}`);
        //             $('#description').summernote("insertNode", image[0]);
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //                     console.log(textStatus + "" + errorThrown);
        //                 }
        //     });
        // }

        function createSlug(str)
        {
             //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g,' ').toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm,'');

             // replace space with dash/hyphen
            str = str.replace(/\s+/g, '-');
            $('#slug').val(str);
        }
        $(document).ready(function(){
            $("#slug").focusout(function() {
            slug = $('#slug').val();
            if(!slug)
            {
                str = $('#name').val();
                createSlug(str);
            }
            else
            {
                console.log(slug);
                createSlug(slug);
                console.log(slug);
            }
        });
        });

        $(window).load(function() {
        $("#loading").fadeOut(3000);
        });
        $("#update").click(function() {
            // $(this).html("<img src='{{ asset('spnner.gif') }}' />");
            jQuery("#loading").show();
        });

    </script>

@endsection
