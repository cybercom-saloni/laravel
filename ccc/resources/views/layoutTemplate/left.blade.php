<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">CCC</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a  onclick="object.setUrl('<?php echo route('dashboard'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-home"></span> Home</a>
          </li>
          <li>
              <a onclick="object.setUrl('<?php echo route('productGrid'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-user"></span> Product</a>
          </li>
          <li>
            <a  onclick="object.setUrl('<?php echo route('addnewRootCategory'); ?>').setMethod('get').load();" href="javascript:void(0);"><span class="fa fa-sticky-note"></span> Category</a>
          </li>
        </ul>
    	</nav>