<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
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
    </div>
</nav>