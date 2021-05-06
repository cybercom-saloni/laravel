<html>
<head>
<title>Ccc</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>
</head>
<body>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 bg-warning">
            <a href="{{route('addnewRootCategory',0)}}" class="btn btn-success">Add Root Category</a>
            <ul id="tree1">
                @foreach ($parentcategories as $category)
                    <li>
                    <a href="{{route('categoryEdit',$category->id)}}">{{$category->name}}</a><a href="{{route('categoryDelete',$category->id)}}">Delete</a>
                        <a href="{{route('categoryEdit',$category->id)}}">Edit</a>
                        @if(count($category->child))
                            @include('category.manageChild',['child' => $category->child])
                        @endif
                    </li>
                @endforeach
             </ul>
            </div>
            <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
            @foreach ($parentcategories as $category)
               <form method="GET" action="{{route('addnewSubCategoryAction',$category->id)}}">
                @csrf
            @endforeach
                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Category Name</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <input type="text" class="form-control" name="category[name]">
                    </div>
                    <div class="form-group">
                       <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                            <label>Category Status</label>
                        </div>
                        <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                            <select class="form-control" name="category[status]" id="status">
                                <option disabled selected>Select Status</option>
                                <option value="1">ENABLE</option>
                                <option value="0">DISABLE</option>
                            </select>
                        </div>
                     </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <label>Description</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                        <textarea class="form-control" name="category[description]"></textarea>
                    </div>  
               </div>
               <button class="btn btn-md btn-success">UPDATE</button>
               </form>
               
            </div>
        </div>
    </div>
</body>
<script>
$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

</script>
</html>