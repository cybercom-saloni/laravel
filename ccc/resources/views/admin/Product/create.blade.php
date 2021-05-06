<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                                    <a class="nav-link" href="/admin/product/" style="text-decoration:none; font-size: 25px; color:white;">Product</a>
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
                    <form method="POST" action="/admin/product">
                        @csrf
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Name</label>
                            </div>
                            <div class="col-10">
                                 <input type="text" id="name" name="name" class="form-control" id="sku" placeholder="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Sku</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="sku" class="form-control" placeholder="sku"  name="sku">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Price</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="price" class="form-control" placeholder="price"  name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Quantity</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="quantity" class="form-control" placeholder="quantity"  name="quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Discount</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="discount" class="form-control" placeholder="discount"  name="discount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Description</label>
                            </div>
                            <div class="col-10">
                                <textarea id="description" class="form-control" placeholder="description"  name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label class="form-label text-uppercase">Status</label>
                            </div>
                            <div class="col-10">
                                <select id="status" class="form-control" name="status">
                                    <option name="statusopt" value="1">1</option>
                                    <option name="statusopt" value="0">0</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <button id="create" class="btn btn-success btn-md"  name="create">CREATE</button>
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>