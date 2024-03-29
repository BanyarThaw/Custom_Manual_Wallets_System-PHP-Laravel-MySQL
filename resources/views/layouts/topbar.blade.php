<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form action="/detail/search" method="post" class="app-search d-none d-md-block">
                    @csrf
                    <div class="position-relative">
                        <input type="text" class="form-control" name="keyword" placeholder="Search..." autocomplete="off"
                            id="search-options" value="" style="display:none;">
                        <!-- <span class="mdi mdi-magnify search-widget-icon"></span> -->
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('images/super-admin-icon.jpg') }}"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Admin</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                          <!-- item-->
                          <a class="dropdown-item" href="/change-password"><i class="bx bx-edit-alt fs-16 align-middle me-1"></i><span
                                class="align-middle" >change password</span></a>

                        <!-- item-->
                        <a class="dropdown-item" href="/logout"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" >Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
