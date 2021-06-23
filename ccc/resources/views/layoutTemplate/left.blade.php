<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">CCC</a></h1>
        <ul class="list-unstyled components mb-5">
          <li>
              <a onclick="object.setUrl('<?php echo route('productGrid'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-user"></span> Product</a>
          </li>
          <li>
            <a  onclick="object.setUrl('<?php echo route('formEdit'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span> Category</a>
          </li>

          <li>
            <a onclick="object.setUrl('<?php echo route('customerGrid'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-user"></span> Customer</a>
          </li>
          <li>
            <a onclick="object.setUrl('<?php echo route('payment'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-user"></span> Payment</a>
          </li>
          <li>
            <a onclick="object.setUrl('<?php echo route('shipment'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-user"></span> Shipment</a>
          </li>
          <li>
            <a onclick="object.setUrl('/cart').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span> Cart</a>
          </li>
          <li>
            <a onclick="object.setUrl('/manageOrder').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span> Order</a>
          </li>
          <li>
            <a onclick="object.setUrl('/csv/grid').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span> Csv</a>
          </li>
          <li>
            <a onclick="object.setUrl('/salesmanClear').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span>Salesman</a>
          </li>
        </ul>
    	</nav>
