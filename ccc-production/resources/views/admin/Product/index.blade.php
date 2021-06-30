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
				<div class="col-sm-12 col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12 bg-light Body" id ="content">
          <h3 style="font-weight:bold; font-size:32px;" class="mt-2">Product</h3>
          <hr>
          <a href="/admin/product/create" class="btn btn-md btn-success mb-4" style="float:right"><i class="fas fa-plus-square"></i> Create New Product</a>
          <table class="table table-bordered bg-light  table-hover">
            <thead class="bg-dark text-white">
            
                <th>Product Id</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Description</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>
              @if($product)
                @foreach($product as $item)
                  <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->sku}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->quantity}}</td>
                      <td>{{$item->discount}}</td>
                      <td>{{$item->description}}</td>
                      <td>{{$item->status}}</td>
                      <td><a  href="/admin/product/{{$item->id}}/edit"><i class="fad fa-edit"></i></a></td>
                      <td><a href="/admin/product/{{$item->id}}"><i class="fas fa-trash-alt"></i></a></td>
                      <!-- <form method="POST" action="/product/{{$item->id}}">
                      @method('DELETE')
                      @csrf
                      <td><button type="submit" name="delete">Delete</button></td>
                      </form> -->
                      
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="10">No Record Found!!</td>
                </tr>
              @endif
            </tbody>
          </table>
				</div>
			</div>
			<div class="row fixed-bottom">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12 mainFooter bg-secondary">
					<p class="text-white text-center">@copyRight-Saloni Maheshwari</p>
				</div>		
			</div>
		</div>	
	</div>
</body>
</html>