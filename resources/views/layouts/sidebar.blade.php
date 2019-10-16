<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="index.html">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo"><img src="{{ url('images/logo.png') }}" alt=""></div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">{{ env('APP_NAME', 'Perfect') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu pos-r scrollbar" id="style-3">
            <li class="nav-item mT-30 actived"><a class="sidebar-link" href="{{ url('/') }}"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{ url('/units') }}"><span class="icon-holder"><i class="c-brown-500 ti-magnet"></i> </span><span class="title">Units</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{ url('/ptypes') }}"><span class="icon-holder"><i class="c-orange-500 ti-tag"></i> </span><span class="title">Product Type</span></a></li>
        </ul>
    </div>
</div>
