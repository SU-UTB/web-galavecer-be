@php
    $aDashboard = '';
    $aNominations = '';
    if (request()->routeIs('dashboard')) {
        $aDashboard = 'active';
    } elseif (request()->routeIs('nominations')) {
        $aNominations = 'active';
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link {{ $aDashboard }}" href="/admin">Dashboard </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aNominations }}" href="/admin/nominations">Nominations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aNominees }}" href="/admin/nominees">Nominees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $aVotes }}" href="/admin/votes">Votes</a>
            </li>

        </ul>
        <div class="mx-auto"></div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" name="logout-form" id="logout-form">
                    @csrf

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue">Logout</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>
