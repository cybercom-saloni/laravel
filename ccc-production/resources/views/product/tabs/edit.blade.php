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

        <?php $data = $product->getProducts();?>


        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">{{ $data ? 'Edit' : 'Add' }} Product Details</h3>
        <form action="/productSave{{ $data ? '/' . $data[0]->id : '' }}" method="POST" id="form">
                @if($data)
                @include('product.tabs')
                @endif
                @csrf
                @include('layoutTemplate.message')
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
                        <input type="text" class="form-control" value="{{ $data ? $data[0]->sku : old('product.sku') }}" id="sku"
                            placeholder="PRODUCT SKU" name="product[sku]" >
                    </div>

                </div>

                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ $data ? $data[0]->name : old('product.name')  }}" id="name"
                            placeholder="PRODUCT NAME" name="product[name]" onload="createSlug(this.value)" onkeyup="createSlug(this.value)" >
                    </div>

                </div>
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Slug</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ $data ? $data[0]->slug : old('product.slug')  }}" id="slug"
                            placeholder="PRODUCT SLUG" name="product[slug]">
                    </div>

                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Price( in Rs.)</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{ $data ? $data[0]->price : old('product.price') }}" id="price"
                          min="1" step="0.01" placeholder="PRODUCT PRICE" name="product[price]" >
                    </div>
                </div>


                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="discount"> Discount(in %)</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{ $data ? $data[0]->discount : old('product.discount')  }}" id="price"
                            placeholder="PRODUCT DISCOUNT" name="product[discount]"  max="100" min="0" step="0.01">
                    </div>
                </div>

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Quantity</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" id="quantity" class="form-control"
                            value="{{ $data ? $data[0]->quantity : old('product.quantity') }}" placeholder="PRODUCT QUANTITY"
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
                            <option value="1" {{ $data ? ($data[0]->status == 1 ? 'selected' : old('product.status')) : old('product.status') }}>
                                ENABLE
                            </option>
                            <option value="0" {{ $data ? ($data[0]->status == 0 ? 'selected' : old('product.status')) : old('product.status') }}>
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
                        <option value="{{ $options->id }}"
                            {{ $data ? ($data[0]->category_id == $options->id ? 'selected' : old('product.category_id')) : old('product.category_id') }}>
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
                            placeholder="PRODUCT DESCRIPTION">{{ $data ? $data[0]->description : old('product.description') }}</textarea>
                    </div>
                    </div>
                    <div class="form-group row">
                     <div class="col-lg-4">
                     </div>
                    <div class="col-lg-6">
                    <!-- <button type="button" id ="update" class="btn btn-success btn-md">{{ $data ? 'Update' : 'Add' }} Product</button> -->
                    <button type="submit" id ="update" class="btn btn-primary btn-md" onload="loader()">{{ $data ? 'Update' : 'Add' }} Product</button>
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
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            });
        });
        function createSlug(str)
        {
             //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g,' ').toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm,'');

             // replace space with dash/hyphen
            str = str.replace(/\s+/g, '-');
            console.log(str);
            $('#slug').val(str);
        }

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
