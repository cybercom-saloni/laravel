<nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" style="font-size:24px">
                    <a class="nav-link" onclick="object.setUrl('/customer/form/{{request()->id}}').setMethod('get').load();" href="javascript:void(0);">Personal Information</a>
                </li>
                <li class="nav-item" style="font-size:24px">
                    <a class="nav-link" href="javascript:void(0)" onclick="object.setUrl('/customer/addressform/{{request()->id}}').setMethod('get').load();">Address Information</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>  
