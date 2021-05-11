<!DOCTYPE html>
<html lang="en">

<head>
    <title>CCC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin/tree.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->
</head>

<body class="bg-light">
<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-12 bg-secondary mainHeader">
      <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="nav-link" class="navbar-brand"  style="text-decoration:none; font-size: 25px; color:white;" href="">Ccc</a>
                </div>
                <ul class="navbar-nav navbar-right">
                  <li class="nav-item">
                    <a class="nav-link" href="/addRootCategory" style="text-decoration:none; font-size: 25px; color:white;">Category</a>
                  </li>
                  <li class="nav-item navbar-right">
                    <a class="nav-link" onclick="object.setUrl('<?php echo route('productGrid'); ?>').setMethod('get').load();" href="javascript:void(0);"style="text-decoration:none; font-size: 25px; color:white;">Product</a>
                  </li>
                </ul>
            </div>
          </nav>
				</div>
			</div>
    <div class="row mainBody bg-light">
    <div class="container">
        @yield('container')
    </div>
    </div>
    </div>
</body>
<script src="{{asset('js/jquery.js')}}"></script>
  <script src="{{asset('js/mage.js')}}"></script>
</html>
