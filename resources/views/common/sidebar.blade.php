<!-- Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="#" class="brand-link bg-white">
    <img src="{{ asset ('img/fronted/logo.png')}}" class="brand-image bg-light mt-0.9" style="height:100px">
    <span class="brand-text font-weight-light"><h4>Giveit-Getit</h4></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <li class="nav-item menu-open">
          {{-- <a href="/" class="nav-link {{ Route::currentRouteName() == '#' || Route::currentRouteName() == '#' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User Management
              {{-- <i class="right fas fa-angle-left"></i> --}}
            {{-- </p>
          </a> --}} 
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link">
                <i class="far fa-user"></i>
                <p>Users</p>
              </a>
            </li>
          </ul>
          
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <i class="bi bi-tags-fill"></i>
                <p>Categories</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="{{route('requirement.index')}}" class="nav-link">
                <i class="fab fa-critical-role"></i>
                <p>Requirements</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
