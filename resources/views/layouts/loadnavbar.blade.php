<div class="ui fixed top  menu no-border no-radius borderless navmenu">
    <a class="item active no-padding logo" style="width:250px;" href="dashboard.html">

        <img class="ui image logoImg" src="{{url('img/saytana-logo.png')}}" />
    </a>
    <!-- <a class="item hamburger" data-name="show">
        <i class="align justify icon"></i>
    </a> -->
    <div class="right menu">
        <div class="ui dropdown item">
            <img class="ui mini circular image" src="{{url('img/avatar/people/Enid.png')}}">
            <div class="menu">
                <a class="item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Sign Out
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>
