<div class="nav-header">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <b class="logo-abbr"><img src="{{ asset('assets/admin/images/logo.png') }}" alt=""> </b>
            <span class="logo-compact"><img src="{{ asset('assets/admin/images/logo-compact.png') }}"
                    alt=""></span>
            <span class="brand-title" style="color: white; font-weight: bold; font-size: 25px;">
                Resume Gate
                {{-- <img src="{{ asset('assets/admin/images/logo-text.png') }}" alt=""> --}}
            </span>
        </a>
    </div>
</div>

<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ get_logged_in_user()->avatar }}" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="{{ route('admin.logout') }}"><i class="icon-key"></i>
                                        <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
