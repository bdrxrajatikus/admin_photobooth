<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/dashboards">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-money-dollar-box-line"></i><span>Harga</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>  
            <a href="/settings">
              <i class="bi bi-circle"></i><span>Master Harga</span>
            </a>
          </li>
          <li>
            <a href="/vouchers">
              <i class="bi bi-circle"></i><span>Vouchers</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

  <li class="nav-item">
    <a class="nav-link " href="/templates">
      <i class="bi bi-card-image"></i>
      <span>Tamplates</span>
    </a>
  </li>

  <!-- Tampilkan menu "Account" hanya untuk admin -->
  @if (Auth::check() && Auth::user()->level == 'admin')
  <li class="nav-item">
      <a class="nav-link @if (request()->is('users*')) active @endif" href="{{ route('users.index') }}">
          <i class="ri-account-box-fill"></i>
          <span>Account</span>
      </a>
  </li>
  @endif


</ul>

</aside>