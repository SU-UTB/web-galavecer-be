@php
    $aDashboard = '';
    $aNominations = '';
    $aNominees = '';
    $aVotes = '';
    $aResults = '';
    if (request()->routeIs('dashboard')) {
        $aDashboard = 'active';
    } elseif (request()->routeIs('nominations')) {
        $aNominations = 'active';
    } elseif (request()->routeIs('nominees')) {
        $aNominees = 'active';
    } elseif (request()->routeIs('votes')) {
        $aVotes = 'active';
    } elseif (request()->routeIs('results')) {
        $aResults = 'active';
    }
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                <li class="nav-item">
                    <a class="nav-link {{ $aResults }}" href="/admin/results">Results</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" name="logout-form" id="logout-form">
                @csrf

                <div class="form-group">
                    <button type="submit" class="btn btn-blue">Logout</button>
                </div>
            </form>

        </div>
    </div>
</nav>
