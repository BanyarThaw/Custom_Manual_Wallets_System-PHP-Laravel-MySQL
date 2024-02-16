<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('images/logo.jpg') }}" class="rounded-circle" alt="" width="22" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('images/logo.jpg') }}" class="rounded-circle" alt="" width="50" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('payment')" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="mdi mdi-sticker-text-outline"></i> <span data-key="t-pages">Payments</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('payments.create') }}" class="nav-link" data-key="t-starter">New Payment Method
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.index') }}" class="nav-link" data-key="t-starter">Payment List </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.removed.list') }}" class="nav-link" data-key="t-starter">Removed Payment List </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('point')" href="{{ route('points.index') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarPoint">
                        <i class="mdi mdi-centos"></i> <span>Points
                        </span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('deposit')" href="#sidebarDeposit" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-todo-line"></i> <span data-key="t-pages">Deposit</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDeposit">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('deposits.index') }}" class="nav-link" data-key="t-starter">Deposit Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('deposits.approve.list') }}" class="nav-link" data-key="t-starter">Approved Deposit List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('deposits.reject.list') }}" class="nav-link" data-key="t-starter">Rejected Deposit List</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('withdrawal')" href="#sidebarWithdrawal" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-article-fill"></i> <span data-key="t-pages">Withdrawal</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarWithdrawal">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('withdrawals.index') }}" class="nav-link" data-key="t-starter">Withdrawal Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('withdrawals.approve.list') }}" class="nav-link" data-key="t-starter">Approved Withdrawal List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('withdrawals.reject.list') }}" class="nav-link" data-key="t-starter">Rejected Withdrawal List</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('contact_us')" href="/contact" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bx bx-id-card"></i> <span data-key="t-pages">Contact Us</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
