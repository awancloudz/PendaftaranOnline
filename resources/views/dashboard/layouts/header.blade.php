<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/dashboard">ADMIN</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="navbar-nav">
      <div class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </div>
    </div>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link {{ Request::is('dashboard/peserta*') ? 'active' : '' }}" href="/dashboard/peserta">
          <span data-feather="users" class="align-text-bottom"></span>
          Data Peserta
        </a>
      </div>
    </div>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link {{ Request::is('dashboard/absensi*') ? 'active' : '' }}" href="/dashboard/absensi">
          <span data-feather="check-square" class="align-text-bottom"></span>
          Absensi Peserta
        </a>
      </div>
    </div>

    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
          <form action="/logout" method="post">
              @csrf
              <button type="submit" class="nav-link px-3 bg-dark border-0"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
          </form>
        {{-- <a class="nav-link px-3" href="#">Logout</a> --}}
      </div>
    </div>
  </header>