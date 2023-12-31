<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="<?php echo base_url('tabler') ?>/static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>

        <!-- Mobile only topbar -->
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/tabler/tabler" class="btn btn-outline-white" target="_blank" rel="noreferrer">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                        </svg>
                        Source code
                    </a>
                    <a href="https://github.com/sponsors/codecalm" class="btn btn-outline-white" target="_blank" rel="noreferrer">
                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>
           
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?php echo get_gravatar(get_user()->email, 128 )?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ get_user()->first_name }}</div>
                        <div class="mt-1 small text-muted">{{ get_user_group()->description }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Profile &amp; account</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ site_url('auth/logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <!-- /Mobile only topbar -->

        <!-- Sidebar -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item <?php if (alink(1, 'dashboard') && alink(2, '')) echo 'active' ?>">
                    <a class="nav-link" href="{{ site_url('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i data-feather="home"></i>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>
                
                <li class="nav-item <?php if (alink(1, 'auth') && alink(2, '')) echo 'active' ?>">                    
                    <a class="nav-link" href="{{ site_url('auth') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i data-feather="user"></i>
                        </span>
                        <span class="nav-link-title">
                            Users
                        </span>
                    </a>
                </li>

                <li class="nav-item <?php if (alink(1, 'groups') && alink(2, '')) echo 'active' ?>">
                    <a class="nav-link" href="{{ site_url('groups') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i data-feather="users"></i>
                        </span>
                        <span class="nav-link-title">
                            Groups
                        </span>
                    </a>
                </li>
               
            </ul>
        </div>
        <!-- /Sidebar -->

    </div>
</aside>