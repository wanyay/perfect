<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ auth()->user()->name }}</strong>
                        </span> <span class="text-muted text-xs block">Adminstrator<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a>

                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form></li>
                    </ul>
                </div>
            </li>
            @if(auth()->user()->hasRole('admin'))
            <li>
                <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li>
                <a href="{{url('units')}}"><i class="glyphicon glyphicon-glass"></i> <span class="nav-label">Units</span></a>
            </li>
            <li>
                <a href="{{url('producttype')}}"><i class="glyphicon glyphicon-tag"></i><span class="nav-label"> Product Type</span></a>
            </li>
            <li>
                <a href="{{url('customers')}}"><i class="glyphicon glyphicon-user"></i><span class="nav-label">Customers</span></a>
            </li>
            <li>
                <a href="{{url('suppliers')}}"><i class="glyphicon glyphicon-user"></i><span class="nav-label">Suppliers</span></a>
            </li>
            <li>
                <a href="{{url('items')}}"><i class="fa fa-product-hunt"></i><span class="nav-label">Items</span></a>
            </li>
            <li>
                <a href="{{url('sales')}}"><i class="fa fa-product-hunt"></i><span class="nav-label">Sales</span></a>
            </li>
            @else
            <li>
                <a href="{{url('sales')}}"><i class="fa fa-product-hunt"></i><span class="nav-label">Sales</span></a>
            </li>
        </ul>

    </div>
</nav>
