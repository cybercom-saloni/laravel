@extends('layoutTemplate.main')
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->
                <!-- <div class="panel panel-headline"> -->


                    <div class="panel-heading">
                        <h3 class="panel-title">Manage Category</h3>
                    </div>

                   
                    <div class="panel-body">
                        <div>
                            <a href="{{ route('formEdit', ['id' => 0, 'type' => 'root']) }}" class="btn btn-info">
                                ADD ROOT CATEGORY
                            </a>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dd" id="nestable-wrapper">
                                     <ol class="dd-list list-group">
                                            @foreach ($categories as $categoryId => $category)
                                            <li class="dd-item list-group-item" data-id="{{ $category['id'] }}" style="color: <?php $category->status == 2 ? 'grey' : '' ?>" >
                                                    <div class="dd-handle" ></div>
                                                    <div class="dd-option-handle">

                                                    <a href="{{ route('formEdit', ['id' => $category->id, 'type' => 'category']) }}"
                                                        style="margin-left: -170px;color: <?php $category->status == 2 ? 'grey' : '' ?>">
                                                        {{ $category->name }}</a>
                                                    </div>

                                                    @if (count($category->childs))
                                                        @include('category.child',['childs' => $category->childs])
                                                    @endif

                                            </li>
                                            @endforeach
                                     </ol>
                                </div>
                                     <div class="row">
                                        <form action="{{ route('category-subcategory.save-nested-categories') }}" method="post">
                                            @csrf
                                            <textarea style="display:none;" name="nested_category_array" id="nestable-output"></textarea>
                                            <button type="submit" class="btn btn-success" style="margin-top: 15px;" >Save category</button>
                                        </form>
                                    </div>
                            </div>





                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h3 class="card-title">
                                            @if (request()->type == 'root')
                                                Add Root Category
                                            @elseif(request()->type == 'subCategory')
                                                Add sub category
                                                <!-- Add Sub Category In {{ $controller->categoryName(request()->id) }} -->
                                            @else
                                            Edit
                                                <!-- Edit {{ $controller->categoryName(request()->id) }} -->
                                            @endif
                                        </h3>

                                        <div class="row">
                                            @if (isset(request()->id) && request()->id != 0 && request()->type == 'category')

                                                <a href="{{ route('formEdit', ['id' => request()->id, 'type' => 'subCategory']) }}"
                                                    class="btn btn-lg">
                                                    <!-- {{ 'ADD SUB CATEGORY TO ' . $controller->categoryName(request()->id) }} -->
                                                     {{ 'ADD SUB CATEGORY '}}
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <br>

                                                <a href="{{ route('deleteCategory', ['id' => request()->id]) }}"
                                                    class="btn btn-lg">
                                                    <i class="fa fa-trash-o"></i>
                                                    <!-- {{ 'DELETE ' . $controller->categoryName(request()->id) }} -->
                                                    {{ 'DELETE '}}
                                                </a>

                                            @endif
                                        </div>

                                        <form
                                            action="{{ route('saveCategory', ['id' => request()->id, 'type' => request()->type]) }}"
                                            method="post" id="formCategory">
                                            @csrf
                                            <div class="form-group col-lg-12">
                                                <label for="name">CATEGORY NAME</label>
                                                <input type="text" class="form-control" name="category[name]" id="name"
                                                    aria-describedby="helpId" placeholder="CATEGORY NAME"
                                                    value="{{ isset($singleCategory) ? $singleCategory->name : '' }}">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="">CATEGORY STATUS</label>
                                                <select class="form-control" name="category[status]" id="status">
                                                    <option disabled selected>Select Status</option>
                                                    <option value="1"
                                                        {{ isset($singleCategory) ? ($singleCategory->status == 1 ? 'selected' : '') : '' }}>
                                                        ENABLE
                                                    </option>
                                                    <option value="2"
                                                        {{ isset($singleCategory) ? ($singleCategory->status == 2 ? 'selected' : '') : '' }}>
                                                        DISABLE
                                                    </option>
                                                </select>
                                            </div>

                                            <div c[;lass="form-group col-lg-12">
                                                <label for="name">CATEGORY DESCRIPTION</label>
                                                <textarea name="category[description]" id="description" class="form-control"
                                                    placeholder="CATEGORY DESCRIPTION">{{ isset($singleCategory) ? $singleCategory->description : '' }}</textarea>
                                            </div>

                                            <button type="submit" name="saveCategory" id="saveCategory"
                                                class="btn  btn-lg ">
                                                <!-- btn-block -->
                                                @if (request()->type == 'category')
                                                    UPDATE CATEGORY
                                                @elseif(request()->type == 'root')
                                                    ADD ROOT CATEGORY
                                                @else
                                                    ADD SUB CATEGORY
                                                    <!-- {{ $controller->categoryName(request()->id) }} -->
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        <!-- </div>
                    </div>
                </div> -->

            </div>
            <!-- END OVERVIEW -->

        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
            });
        });

    </script>
      <script src="{{ url('category-subcategory-assets/js/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ url('category-subcategory-assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('category-subcategory-assets/js/jquery.nestable.js') }}"></script>
        <script src="{{ url('category-subcategory-assets/js/style.js') }}"></script>

@endsection
