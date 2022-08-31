<div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href=".">
            <img src="{{ asset('static/logos/logo.png') }}" width="200" alt="AP" class="navbar-brand-image">
        </a>
    </h1>
    <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item d-none d-md-flex me-3">
            <div class="btn-list">
                <a href="#" class="btn btn-outline-white">
                    <!-- Download SVG icon from http://tabler-icons.io/i/logout -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 12h14l-3 -3m0 6l3 -3" /></svg>
                    Logout
                </a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                    <div>{{@Auth::user()->name}}</div>
                    <div class="mt-1 small text-muted">User</div>
                </div>
            </a>
        </div>
    </div>
</div>
