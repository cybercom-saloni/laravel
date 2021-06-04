<div id="layoutSidenav_content">
    <div class="container">
        <main>
            <style>
                .tree,
                .tree ul {
                    margin: 0;
                    padding: 0;
                    list-style: none
                }
                .tree ul {
                    margin-left: 1em;
                    position: relative
                }
                .tree ul ul {
                    margin-left: .5em;
                }
                .tree ul:before {
                    content: "";
                    display: block;
                    width: 0;
                    position: absolute;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    border-left: 1px solid
                }
                .tree li {
                    margin: 0;
                    padding: 0 1em;
                    line-height: 2em;
                    color: #369;
                    font-weight: 700;
                    position: relative
                }
                .tree ul li:before {
                    content: "";
                    display: block;
                    width: 10px;
                    height: 0;
                    border-top: 1px solid;
                    margin-top: -1px;
                    position: absolute;
                    top: 1em;
                    left: 0
                }
                .tree ul li:last-child:before {
                    background: #fff;
                    height: auto;
                    top: 1em;
                    bottom: 0
                }
                .indicator {
                    margin-right: 5px;
                }
                .tree li a {
                    cursor: pointer;
                    text-decoration: none;
                    color: #369;
                }
                .tree li button,
                .tree li button:active,
                .tree li button:focus {
                    text-decoration: none;
                    color: #369;
                    border: none;
                    background: transparent;
                    margin: 0px 0px 0px 0px;
                    padding: 0px 0px 0px 0px;
                    outline: 0;
                }
            </style>
          
            @if(session('Delete'))
                <div class ="alert alert-success del" style="display:block">{{session('Delete')}}</div>
            @endif
            @if(session('error'))
                <div class ="alert alert-success er" style="display:block">{{session('error')}}</div>
            @endif
            @if(session('Added'))
                <div class ="alert alert-success ad" style="display:block">{{session('Added')}}</div>
            @endif

            @if(session('Updated'))
                <div class ="alert alert-success up" style="display:block">{{session('Updated')}}</div>
            @endif
            <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                   
                </div>
            <div class="container-fluid">
                <button type="button" id="show" class="btn btn-success mt-2 mb-2">Add Root Category</button>
                @if (request()->id)
                <button type="button" id="showSub" class="btn btn-success mt-2 mb-2">Add subcategory</button>
                @endif
                <script>
                    $("#addRootForm").hide();
                    $(document).ready(function() {
                        
                        $("#show").click(function() {
                            $("#addRootForm").show();
                            $("#editCategoryModal").hide();
                            $("#addSubForm").hide();
                            $(".ad").css('display','none');
                            $(".up").css('display','none');
                            $(".del").css('display','none');
                            $(".er").css('display','none');
                        });
                    });
                </script>
                <script>
                    $("#addSubForm").hide();
                    $(document).ready(function() {
                        $("#showSub").click(function() {

                            $("#addSubForm").show();
                            $("#editCategoryModal").hide();
                            $("#addRootForm").hide();
                            $(".ad").css('display','none');
                            $(".up").css('display','none');
                            $(".del").css('display','none');
                            $(".er").css('display','none');
                        });
                    });
                </script>
               <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                    <ul id="tree1">
                                        @foreach ($categories as $category)
                                        <li><span class="fa fa-sticky-note"></span>
                                            <a  style="color: {{ $category->status == 0 ? 'red' : '' }} href="javascript:void(0);" onclick="object.setUrl('<?php echo  route('formEdit', $category->id) ?>').setMethod('get').load();" style="color: {{ $category->status == 0 ? 'red' : '' }}">{{ $category->name }}</a>
                                            <ul>
                                            @if (count($category->childs))
                                                @include('category.child',['childs' => $category->childs])
                                            @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                        </div>
                    <div class="col-md-8 col-lg-8" id="addRootForm">
                        
                             
                                <form action="" method="Post" id="myrootform">
                                    @csrf
                                   
                                    <div class="form-group col-lg-12">
                                        <button type="button" id="addRootCategory"  class="btn btn-success">Add Root Category</button>
                                    </div>
                                    <h3 class="text-center">Add New Root Category</h3>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="name">Category Name</label>
                                            <input type="text" class="form-control" name="category[name]" id="name" aria-describedby="helpId" placeholder="Category Name">
                                        </div>
                                    </div>
                                   
                                
                                        <div class="form-group col-lg-12">
                                            <label for="name">Select Status</label>
                                            <select class="form-control" name="category[status]" id="">
                                                <option disabled selected>Choose Status</option>
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    <div class="form-group col-lg-12">
                                        <label for="name">Category Description</label>
                                        <textarea name="category[description]" id="description" style="resize: vertical" rows="5" class="form-control" placeholder="Category Description"></textarea>
                                    </div>
                                    
                                </form>
                            </div>
                  

                    <!-- add root category script -->

                    <script>
                        $(function () {
                            $('#addRootCategory').on('click', function (e) {
                                
                                e.preventDefault();
                                
                                var name = $("input[name='category[name]']").val();
                                console.log(name);
                                $.ajax({
                                    type: 'post',
                                    url: '<?php echo route('addRoot') ?>',
                                    data: $('#myrootform').serializeArray(),
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

                    <!-- end add root category  -->


                    <div class="col-md-8 col-lg-8" id="addSubForm">
                     
                              
                            
                                <form action="" method="Post" id="mySubCategoryform">
                                    @csrf
                                    <div class="form-group col-lg-12">
                                        <button type="button" id="addSubCategory" class="btn btn-success">Add SubCategory</button>
                                    </div>
                                    <h3 class="card-title text-center">Add SubCategory</h3>
                                        <div class="form-group col-lg-12">
                                            <label for="name">Category Name</label>
                                            <input type="text" class="form-control" name="category[name]" id="name" aria-describedby="helpId" placeholder="Category Name">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="name">Select Status</label>
                                            <select class="form-control" name="category[status]" id="">
                                                <option disabled selected>Choose Status</option>
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    <div class="form-group col-lg-12">
                                        <label for="name">Category Description</label>
                                        <textarea name="category[description]" id="description" style="resize: vertical" rows="5" class="form-control" placeholder="Category Description"></textarea>
                                    </div>
                                   
                                </form>
                            </div>
                 

                        <!-- add root category script -->

                    <script>
                        $(function () {
                            $('#addSubCategory').on('click', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    type: 'post',
                                    url: '<?php echo route('addRoot',request()->id) ?>',
                                    data: $('#mySubCategoryform').serializeArray(),
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

                    <!-- end add root category  -->


                    @if(isset(request()->id))
                    <?php Session::forget('Added');?>
                   
                    
                    <div class="col-md-8 col-lg-8" id="editCategoryModal">
                     
                                
                            
                                <form action="" method="Post" id="myform">
                                    @csrf
                                  
                                    <div class="form-group col-lg-12">
                                        <button type="button" id="updateCategory" class="btn btn-success">Update Category</button>
                                        <button type="button" id="deleteCategory" class="btn btn-secondary">Delete Category</button>
                                    </div>
                                    <h3 class="card-title text-center">Edit Category </h3>
                                        <div class="form-group col-lg-12">
                                            <label for="name">Category Name</label>
                                            <input type="text" class="form-control" name="category[name]" id="name" aria-describedby="helpId" placeholder="Category Name" value="{{ $singleCategory->name }}">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="name">Select Status</label>
                                            <select class="form-control" name="category[status]" id="">
                                                <option disabled selected>Choose Status</option>
                                                <option value="1" {{ $singleCategory->status == 1 ? 'selected' : '' }}>Enable</option>
                                                <option value="0" {{ $singleCategory->status == 0 ? 'selected' : '' }}>Disable</option>
                                            </select>
                                        </div>
                                    <div class="form-group col-lg-12">
                                        <label for="name">Category Description</label>
                                        <textarea name="category[description]" id="description" style="resize: vertical" rows="5" class="form-control" placeholder="Category Description">{{ $singleCategory->description }}</textarea>
                                    </div>
                                  
                                
                                </form>
                            </div>
                    </div>

                                    <script>
                                        $(function () {
                                            $('#updateCategory').on('click', function (e) {
                                                e.preventDefault();
                                                var name = $("input[name='category[name]']").val();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '<?php echo route('updateCategory', $singleCategory->id) ?>',
                                                    data: $('#myform').serializeArray(),
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

                                    <!-- end update category  -->

                                    <!-- delete categories -->

                                    <script>
                                        $(function () {
                                            $('#deleteCategory').on('click', function (e) {
                                                e.preventDefault();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '<?php echo route('deleteCategory', $singleCategory->id) ?>',
                                                    data: $('#myform').serializeArray(),
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
                                    </script>

                                    <!-- end update category  -->
                            </div>
                        </div>
                    </div>
                    @endif


                </div>

                <!-- <script>
                    $.fn.extend({
                        treed: function(o) {
                            var openedClass = 'glyphicon-minus-sign';
                            var closedClass = 'glyphicon-plus-sign';
                            if (typeof o != 'undefined') {
                                if (typeof o.openedClass != 'undefined') {
                                    openedClass = o.openedClass;
                                }
                                // if (typeof o.closedClass != 'undefined') {
                                //     closedClass = o.closedClass;
                                // }
                             };
                            //initialize each of the top levels
                            var tree = $(this);
                            tree.addClass("tree");
                            tree.find('li').has("ul").each(function() {
                                var branch = $(this); //li with children ul
                                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                                branch.addClass('branch');
                                branch.on('click', function(e) {
                                    if (this == e.target) {
                                        var icon = $(this).children('i:first');
                                        icon.toggleClass(openedClass + " " + closedClass);
                                        $(this).children().children().toggle();
                                    }
                                })
                                //branch.children().children().toggle();
                            });
                            //fire event from the dynamically added icon
                            tree.find('.branch .indicator').each(function() {
                                $(this).on('click', function() {
                                    $(this).closest('li').click();
                                });
                            });
                            //fire event to open branch if the li contains an anchor instead of text
                            tree.find('.branch>a').each(function() {
                                $(this).on('click', function(e) {
                                    $(this).closest('li').click();
                                });
                            });
                            //fire event to open branch if the li contains a button instead of text
                            tree.find('.branch>button').each(function() {
                                $(this).on('click', function(e) {
                                    $(this).closest('li').click();
                                });
                            });
                        }
                    });
                    //Initialization of treeviews
                    $('#tree1').treed();
                    $('#tree2').treed({
                        openedClass: 'glyphicon-folder-open',
                        closedClass: 'glyphicon-folder-close'
                    });
                    $('#tree3').treed({
                        openedClass: 'glyphicon-chevron-right',
                        closedClass: 'glyphicon-chevron-down'
                    });
                </script> -->
                 <script>
      $.fn.extend({
    treed: function(o) {
        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';
        if (typeof o != 'undefined') {
            if (typeof o.openedClass != 'undefined') {
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined') {
                closedClass = o.closedClass;
            }
        };
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function() {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            // branch.on('click', function(e) {
            //     if (this == e.target) {
            //         var icon = $(this).children('i:first');
            //         icon.toggleClass(openedClass + " " + closedClass);
            //         $(this).children().children().toggle();
            //     }
            // })
            // branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function() {
            $(this).on('click', function() {
                $(this).closest('li').click();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function() {
            $(this).on('click', function(e) {
                $(this).closest('li').click();
                //e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function() {
            $(this).on('click', function(e) {
                $(this).closest('li').click();
                //e.preventDefault();
            });
        });
    }
});

 $('#tree1').treed();
// $('#tree1').treed({
//     openedClass: 'glyphicon-folder-open',
//     closedClass: 'glyphicon-folder-close'
// });
// $('#tree1').treed({
//     openedClass: 'glyphicon-chevron-right',
//     closedClass: 'glyphicon-chevron-down'
// });
                </script> 

                
        </main>
    </div>