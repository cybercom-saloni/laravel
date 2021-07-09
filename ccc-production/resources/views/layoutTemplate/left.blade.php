
<div id="sidebar-nav" class="sidebar bg-primary" style="background-color: cornflowerblue;font-size: 20px;">

<div class="sidebar-scroll">
    <nav>
        <ul class="nav">



           <li class="dropdown">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style=
                "color:white;"><span class="fa fa-sticky-note"></span> Product  <i class="icon-submenu lnr lnr-chevron-down"></i></a>
	            <ul class="collapse list-unstyled" id="homeSubmenu" style="padding-left:60px">
                <li>
                    <a href="<?php echo route('productGrid');?>"  style=
                "color:white;"><span class="fa fa-user"></span>Product List</a>
                </li><br>
                <li>
                    <a href="/productCacheDeleteGrid"  style=
                "color:white;"><span class="fa fa-user"></span>Deleted Product List</a>
                </li>
	            </ul>
	        </li>

          <li>
            <a href="<?php echo route('formEdit');?>"  style=
                "color:white;"><span class="fa fa-user"></span> Category</a>
          </li>



            <li>
            <a href="<?php echo route('customerGrid'); ?>" style=
                "color:white;"><span class="fa fa-user"></span> Customer</a>
          </li>

          <li>
            <a href="<?php echo route('payment');?>"  style=
                "color:white;"><span class="fa fa-user"></span> Payment</a>
          </li>
          <li>
            <a href="<?php echo route('shipment');?>" style=
                "color:white;"><span class="fa fa-user"></span> Shipment</a>
          </li>
          <li>
            <a href="/cart"  style=
                "color:white;"><span class="fa fa-sticky-note"></span> Cart</a>
          </li>
          <li>
            <a href="/manageOrder"  style=
                "color:white;"><span class="fa fa-sticky-note"></span> Order</a>
          </li>
          <li>
            <a href="/csv/grid"  style=
                "color:white;"><span class="fa fa-sticky-note"></span> Csv</a>
          </li>
          <li>
            <a href="/salesmanClear" style=
                "color:white;"><span class="fa fa-sticky-note"></span>Salesman</a>
          </li>
              <li>
            <a href="/admin/manageForm" style=
                "color:white;"><span class="fa fa-sticky-note"></span>Manage Form</a>
          </li>
        </ul>
    </nav>
</div>
</div>

