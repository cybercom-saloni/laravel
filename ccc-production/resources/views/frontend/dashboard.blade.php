@include('layoutTemplate.frontend.main')
@include('layoutTemplate.frontend.header')
Welcome <b>{{session('login')}}</b>
<a href="/users/logout" class="btn btn-primary btn-toggle-fullwidth" style="color:black;">
            <i class="fa fa-user"></i>

            Logout
        </a>
        </div>

