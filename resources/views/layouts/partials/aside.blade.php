<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar pt-3">
        <!-- Sidebar user panel (optional) -->
        <div class="brand-text mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center text-center flex-column">
            <div class="image mb-3">
                <img src="{{ auth()->user()->image_url }}" id="profileImage" width="150px" height="150px"
                    class="img img-circle  sidebar-photo" alt="User Image"
                    style="box-shadow: 0 5px 10px #333;padding: 7px;">
            </div>
            <div class="info">
                <a href="#" class="brand-text d-block mb-2">{{ auth()->user()->name }}</a>
                <a href="javascript:void(0);" class="brand-link">
                    <span class="brand-text font-weight-light">{{ settings('site_name') }}</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}"
                        class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.appointments') }}"
                        class="nav-link {{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            {{ __('Appointments') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}"
                        class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ __('Settings') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();this.closest('form').submit()" class="nav-link">
                            <i class="nav-icon fa fa-sign-out-alt"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
