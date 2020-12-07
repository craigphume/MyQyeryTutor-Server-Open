<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    @if(Auth::guard('web')->check())
        @include('includes.nav.teacher')
    @elseif(Auth::guard('admin')->check())
        @include('includes.nav.admin')
    @else
        @include('includes.nav.guest')
    @endif
</nav>
