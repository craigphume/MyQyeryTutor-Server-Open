<div class="container" style="background-color: indianred">
    <a class="navbar-brand" href="{{ route('admin.home') }}">
        {{ env('APP_NAME') . ' ADMIN' }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item dropdown">
                <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::guard('admin')->user()->name }} (ADMIN) <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                    <a href="{{route('admin.home')}}" class="dropdown-item">Dashboard</a>
                    <a href="{{route('admin.profile')}}" class="dropdown-item">Profile</a>
                    <a href="{{route('admin.settings')}}" class="dropdown-item">Settings</a>
                    <a href="{{route('admin.queue')}}" class="dropdown-item">Queued Jobs</a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                        Logout
                    </a>
                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
