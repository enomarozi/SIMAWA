<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ URL::asset('/assets/images/icon_user.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ session()->get('nama') }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Profile</span></a>
                    
                    <a class="dropdown-item d-block" href="{{ route('setting') }}"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Setting</span></a>

                    <a class="dropdown-item d-block" href="{{ route('logout') }}"><i class="uil-arrow-circle-left font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
