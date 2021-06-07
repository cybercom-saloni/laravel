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
                                    <ul id="tree1">
                                        @foreach ($categories as $category)
                                        <li>
                                            <a  style="color: {{ $category->status == 0 ? 'red' : '' }} href="javascript:void(0);" onclick="object.setUrl('<?php echo  route('formEdit', $category->id) ?>').setMethod('get').load();" style="color: {{ $category->status == 0 ? 'red' : '' }}">{{ $category->name }}</a>
                                            <ul>
                                            @if (count($category->childs))
                                                @include('category.child',['childs' => $category->childs])
                                            @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>