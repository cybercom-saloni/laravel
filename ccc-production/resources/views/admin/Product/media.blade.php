<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Ccc</title>
  </head>
  <body  class="bg-light">
 
  <div class="wrapper">
		<div class="container-fluid">
			<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12 bg-secondary mainHeader">
          <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="nav-link" class="navbar-brand" style="text-decoration:none; font-size: 25px; color:white;" href="">QuesteCom</a>
                </div>
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/category" style="text-decoration:none; font-size: 25px; color:white;">Category</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/product" style="text-decoration:none; font-size: 25px; color:white;" href="/admin/product">Product</a>
                  </li>
                </ul>
            </div>
          </nav>
				</div>
			</div>
            <div class="row mainBody bg-light">
                <div class="col-sm-2 col-lg-2 col-md-2 col-xl-2 col-2 bg-warning" id="tab">
                    <ul class="nav flex-column">
                        <li class="nav-item list-group p-0 h-100 w-100">
                             <a class="nav-link list-group-item list-group-item-action mt-2 text-center font-weight-bold font-weight italic" href="/admin/product/edit">Information</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link list-group-item list-group-item-action mt-2 text-center font-weight-bold font-weight italic" href="/admin/product/media/">Media</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link list-group-item list-group-item-action mt-2 text-center font-weight-bold font-weight italic" href="tabs-3">Group</a>
                        </li>
                    </ul>
				          </div>
                  <div class="col-sm-10 col-lg-10 col-md-10 col-sm-10 col-xl-10 col-10 bg-light Body" id ="content">
                    <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Edit Product</h3>
                    <hr>
                    <table class="table table-hover">
        <thead>
            <tr class="text-center">
                <th scope="row" style="white-space: nowrap;">Image</th>
                <th>Label</th>
                <th>Small</th>
                <th>Thumb</th>
                <th>Base</th>
                <th>Gallery</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>  
        @foreach($media as $value) 
          {{$value->media}}       
            <tr class="text-center">
                <th scope="row" style="white-space: nowrap;"><img src="assest('public\images\product\{{$value->media}}')" style="height:100px; width:100px" alt=""></th>
                <th><input type="text" name="img[data][{{$value->imageId}}][label]" ></th>
                <th><input type="radio" name="img[small]" value="{{$value->imageId}}" ></th>
                <th><input type="radio" name="img[thumb]" value="{{$value->imageId}}" ></th>
                <th><input type="radio" name="img[base]" value="{{$value->imageId}}" ></th>
                <th><input type="checkbox" name="img[data][{{$value->imageId}}][gallery]"></th>
                <th><input type="checkbox" name="remove[{{$value->imageId}}]" ></th>
            </tr>
            @endforeach
        </tbody>
    </table>
                    <form method="POST" action="/admin/product/">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Upload</label>
                            </div>
                            <div class="col-2">
                                 <input type="file" class="form-control"  id="image" name="image">
                            </div>
                            <div class="col-2">
                            <button id="update" class="btn btn-success btn-md"  name="update">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<div class="row fixed-bottom">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12 mainFooter bg-secondary">
					<p class="text-white text-center">@copyRight-Saloni Maheshwari</p>
				</div>		
			</div>
		</div>	
	</div>
		
	</div>
</body>
</html>