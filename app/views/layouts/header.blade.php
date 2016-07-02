<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
    Lion Cloud7 - ACMA
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
         <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <!--<li><a href="{{ url('/auth/register') }}">Register</a></li>-->
                    @else
                         <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("img/avatar-default.jpeg") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset("img/avatar-default.jpeg") }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->name }} - Rol
                                <!--<small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->
                       <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('admin/auth/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
                    @endif
            </ul>
        </div>
    </nav>
</header>