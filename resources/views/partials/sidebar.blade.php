<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand text-center" href="/">
        {{$site->title}}
      </a>
  
      <ul class="sidebar-nav">
        <li class="sidebar-item  ">
          <a class="sidebar-link" href="/dashboard">
            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item {{ request()->is('hipam*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/hipam">
            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Hipam</span>
          </a>
        </li>
        <li class="sidebar-item ">
          <a class="sidebar-link" href="/maps">
            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Peta Objek</span>
          </a>
        </li>
  
        <li class="sidebar-header">
          CMS Peta
        </li>
  
        <li class="sidebar-item {{ request()->is('object/*') ? 'active' : '' }}">
          <a data-bs-target="#object-menu" data-bs-toggle="collapse" {{ request()->is('object/*') ? 'class=sidebar-link aria-expanded=true' : 'class=sidebar-link collapsed aria-expanded=false' }}">
            <i class="align-middle" data-feather="git-pull-request"></i> <span class="align-middle">Objek</span>
          </a>
          <ul id="object-menu" class="sidebar-dropdown list-unstyled collapse {{ request()->is('object/*') ? 'show' : '' }}" data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->is('object/source*') ? 'active' : '' }}">
              <a class="sidebar-link" href="/object/source"> <i class="align-middle" data-feather="droplet"></i> Sumber
                Air</a>
            </li>
            <li class="sidebar-item {{ request()->is('object/production*') ? 'active' : '' }}">
              <a class="sidebar-link" href="/object/production"> <i class="align-middle" data-feather="codepen"></i> Unit Produksi</a>
            </li>
            <li class="sidebar-item  {{ request()->is('object/distribution*') ? 'active' : '' }}"><a class="sidebar-link"
                href="/object/distribution"><i class="align-middle" data-feather="package"> </i>Unit Distribusi</a></li>
            <li class="sidebar-item  {{ request()->is('object/pipe*') ? 'active' : '' }}"><a class="sidebar-link"
                href="/object/pipe"> <i class="align-middle" data-feather="git-branch"></i> Saluran</a></li>
          </ul>
        </li>
        <li class="sidebar-item  {{ request()->is('filter*') ? 'active' : '' }}">
          <a data-bs-target="#filters-menu" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="filter"></i> <span class="align-middle">Saring</span>
          </a>
          <ul id="filters-menu" class="sidebar-dropdown list-unstyled collapse {{ request()->is('filter*') ? 'show' : '' }}" data-bs-parent="#sidebar">
            <li class="sidebar-item  {{ request()->is('filter-area*') ? 'active' : '' }}"><a class="sidebar-link"
                href="/filter-area">Wilayah</a></li>
            <li class="sidebar-item {{ request()->is('filter-misc*') ? 'active' : '' }}"><a class="sidebar-link" href="/filter-misc">Lainnya</a></li>
          </ul>
        </li>
        <li class="sidebar-item {{ request()->is('customer*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/customer">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Pelanggan</span>
          </a>
        </li>
        <li class="sidebar-item {{ request()->is('surveyors*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/surveyors">
            <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Surveyor</span>
          </a>
        </li>
        <!-- <li class="sidebar-item ">
      <a class="sidebar-link" href="/contractors">
       <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kontraktor</span>
      </a>
     </li> -->
        <li class="sidebar-item {{ request()->is('organization*') ? 'active' : '' }}">
          <a class="sidebar-link " href="/organization">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Organisasi</span>
          </a>
        </li>
  
        <li class="sidebar-header">
          Pengaturan
        </li>
  
        <li class="sidebar-item {{ request()->is('user*') ? 'active' : '' }}" >
          <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Pengguna</span>
          </a>
          <ul id="users" class="sidebar-dropdown list-unstyled collapse {{ request()->is('user*') ? 'show' : '' }}" data-bs-parent="#sidebar">
            <li class="sidebar-item  {{ request()->is('users*') ? 'active' : '' }}"><a class="sidebar-link"
                href="/users">Daftar Pengguna</a></li>
            <li class="sidebar-item  {{ request()->is('user/roles') ? 'active' : '' }}">
                          <a class="sidebar-link" href="/user/roles">Daftar Peran</a></li>
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
      </ul>
    </div>
  </nav>
  