<div class="row">
        <?php $data = $product->getProducts();?>
     
  
        <div class="col-sm-9">
        <h3 style="font-weight:bold; font-size:32px;" class="mt-2">{{ $data ? 'Edit' : 'Add' }} Product Details</h3>
        <form action="" method="POST" id="form">
                @if($data)
                @include('product.tabs')
                @endif
                @csrf
    
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
             <div class=" form-group row">
                    <div class="col-lg-4">
                        <label for="sku"> Sku</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ $data ? $data[0]->sku : '' }}" id="sku"
                            placeholder="PRODUCT SKU" name="product[sku]" required>
                    </div>
                  
                </div>
                
                <div class=" form-group row">
                    <div class="form-group col-lg-4">
                        <label for="name"> Name</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ $data ? $data[0]->name : '' }}" id="name"
                            placeholder="PRODUCT NAME" name="product[name]" required>
                    </div>
                   
                </div>
                
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Price( in Rs.)</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{ $data ? $data[0]->price : '' }}" id="price"
                        required  min="1" step="0.01" placeholder="PRODUCT PRICE" name="product[price]" required>
                    </div>
                </div>
                

                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="discount"> Discount(in %)</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" value="{{ $data ? $data[0]->discount : '' }}" id="price"
                            placeholder="PRODUCT DISCOUNT" name="product[discount]" required max="100" min="0" step="0.01">
                    </div>
                </div>
                
                <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="price"> Quantity</label>
                        </div>
                    <div class="col-lg-6">
                        <input type="number" id="quantity" class="form-control"
                            value="{{ $data ? $data[0]->quantity : '' }}" placeholder="PRODUCT QUANTITY"
                            name="product[quantity]" required max="100" min="1" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                     <div class="col-lg-4">
                        <label for="status"> Status</label>
                        </div>
                    <div class="col-lg-6">
                        <select name="product[status]" id="status" class="form-control" required>
                            <option disabled selected>Select Status</option>
                            <option value="1" {{ $data ? ($data[0]->status == 1 ? 'selected' : '') : '' }}>
                                ENABLE
                            </option>
                            <option value="0" {{ $data ? ($data[0]->status == 0 ? 'selected' : '') : '' }}>
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
                    <select id="category" name="product[category_id]" class="form-control" required>
                        <option disabled selected>Choose Category</option>
                        @foreach ($product->getCategoryOptions() as $options)
                        <option value="{{ $options->id }}"
                            {{ $data ? ($data[0]->category_id == $options->id ? 'selected' : '') : '' }}>
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
                        <textarea name="product[description]" id="description" style="resize: vertical" required
                            class="form-control"
                            placeholder="PRODUCT DESCRIPTION">{{ $data ? $data[0]->description : '' }}</textarea>
                    </div>
                    </div>
                    
                    
                    <div class="form-group row">
                     <div class="col-lg-4">
                     </div>
                    <div class="col-lg-6">
                    <button type="button" id ="update" class="btn btn-success btn-md">{{ $data ? 'Update' : 'Add' }} Product</button>
                </div>
                <div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
             $('#update').on('click', function (e) {
               
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                 var sku = $("input[name='product[sku]']").val();
                 var name = $("input[name='product[name]']").val();
                 var price = $("input[name='product[price]']").val();
                 var discount = $("input[name='product[discount]']").val();
                 var status = $("input[name='product[status]']").val();
                 var category = $("input[name='product[category]']").val();
                 console.log(sku);
                $.ajax({
                    type: 'post',
                    url: '/productSave{{ $data ? '/' . $data[0]->id : '' }}',
                    data: $('#form').serializeArray(),
                    success : function(data) {
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
