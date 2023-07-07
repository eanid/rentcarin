<header class="navbar navbar-expand-md navbar-light d-print-none d-none d-sm-block">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            
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
        
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('backups') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i data-feather="database"></i>
                        </span>
                        <span class="nav-link-title">
                            Backup
                        </span>
                    </a>
                </li>               
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('settings') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i data-feather="settings"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>     
            </ul>
        </div>
    </div>
</header>