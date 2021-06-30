

<nav class="navbar navbar-default navbar-fixed-top bg-light">
    <div class="brand bg-light" style="background-color: ghostwhite;">
        <a href="http://127.0.0.1:8000/"  style="color:black;font-size: 20px;background-color: ghostwhite;">CCC</a>
    </div>
    <div class="container-fluid" style="background-color: ghostwhite;">

        <div class="navbar-btn">
             <button type="button" id="sidebarCollapse" class="btn btn-primary btn-toggle-fullwidth" style="color:black;">
            <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
        </button>
        </div>
        <div class="navbar-btn" style="margin-left: 1000px;">
        <a href="/custom-logout" class="btn btn-primary btn-toggle-fullwidth" style="color:black;">
            <i class="fa fa-user"></i>

             {{session('loginname')}} Logout
        </a>
        </div>
    </div>
</nav>
