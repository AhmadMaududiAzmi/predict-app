<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <span class="sidebar-brand text-center">
      {{-- {{$site->title}} --}}
      CPP
    </span>

    <ul class="sidebar-nav">
      <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Dashboard</span>
        </a>
      </li>
      <li class="sidebar-item {{ request()->is('grafik*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/grafik">
          <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Grafik</span>
        </a>
      </li>

      <li class="sidebar-header">
        Data-Data
      </li>

      <li class="sidebar-item {{ request()->is('komoditas/*') ? 'active' : '' }}">
        <a data-bs-target="#object-menu" data-bs-toggle="collapse" {{ request()->is('komoditas/*') ? 'class=sidebar-link
          aria-expanded=true' : 'class=sidebar-link collapsed aria-expanded=false' }}>
          <i class="align-middle" data-feather="git-pull-request"></i> <span class="align-middle">Komoditas</span>
        </a>
        <ul id="object-menu"
          class="sidebar-dropdown list-unstyled collapse {{ request()->is('komoditas/*') ? 'show' : '' }}"
          data-bs-parent="#sidebar">
          <li class="sidebar-item {{ request()->is('komoditas/listkomoditas*') ? 'active' : '' }}">
            <a class="sidebar-link" href="/komoditas/listkomoditas"> <i class="align-middle" data-feather="droplet"></i> Daftar
              Komoditas</a>
          </li>
          <li class="sidebar-item {{ request()->is('komoditas/hargakomoditas*') ? 'active' : '' }}">
            <a class="sidebar-link" href="/komoditas/hargakomoditas"> <i class="align-middle" data-feather="codepen"></i> Harga
              Komoditas</a>
          </li>
        </ul>
      </li>
      
      <li class="sidebar-item {{ request()->is('pasar*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/pasar">
          <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Pasar</span>
        </a>
      </li>

      {{-- <li class="sidebar-header">
        Pengaturan
      </li>

      <li class="sidebar-item {{ request()->is('user*') ? 'active' : '' }}">
        <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
          <i class="align-middle" data-feather="users"></i> <span class="align-middle">Pengguna</span>
        </a>
        <ul id="users" class="sidebar-dropdown list-unstyled collapse {{ request()->is('user*') ? 'show' : '' }}"
          data-bs-parent="#sidebar">
          <li class="sidebar-item  {{ request()->is('users*') ? 'active' : '' }}"><a class="sidebar-link"
              href="/pengguna/daftar_pengguna">Daftar Pengguna</a></li>
          <li class="sidebar-item  {{ request()->is('user/roles') ? 'active' : '' }}">
            <a class="sidebar-link" href="/pengguna/daftar_peran">Daftar Peran</a>
          </li>
        </ul>
      </li>
      <li class="sidebar-item ">
        <a class="sidebar-link" href="/settings">
          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Situs Web</span>
        </a>
      </li>
      <!-- <li class="sidebar-item ">
      <a class="sidebar-link" href="/menu">
       <i class="align-middle" data-feather="link-2"></i> <span class="align-middle">Menu</span>
      </a>
     </li> -->
      <li class="sidebar-item {{ request()->is('activity-log*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/activity-log">
          <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Log
            Aktifitas</span>
        </a>
      </li>
      <li class="sidebar-item {{ request()->is('system-log*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/system-log">
          <i class="align-middle" data-feather="terminal"></i> <span class="align-middle">Log Sistem</span>
        </a>
      </li>
    </ul> --}}
  </div>
</nav>