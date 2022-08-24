<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" style="box-shadow:none;background-color:inherit" href="/"><img src="/img/iropin50th.png" alt="" width="75"><img src="/img/iropin.png" alt="" width="75"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/peserta*') ? 'active' : '' }}" href="/dashboard/peserta">
                <span data-feather="users" class="align-text-bottom"></span>
                Data Peserta
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/absensi*') ? 'active' : '' }}" href="/dashboard/absensi">
                <span data-feather="check-square" class="align-text-bottom"></span>
                Absensi Peserta
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="nav-link px-3 bg-light text-dark border-0"><span data-feather="power" class="align-text-bottom"></span> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>