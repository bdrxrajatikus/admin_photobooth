<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/dashboards">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link " href="/settings">
      <i class="bi bi-camera"></i>
      <span>Master Photobooth</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="/vouchers">
      <i class="bi bi-card-checklist"></i>
      <span>Voucher</span>
    </a>
  </li>

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