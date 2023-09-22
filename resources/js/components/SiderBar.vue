<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="/admins" class="brand-link">
      <img
        src="../../../public/admin/dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!--            @if(Auth::guard('admin')->check())-->
      <!--            <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
      <!--                <div class="image">-->
      <!--                    <img src="{{ asset ('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">-->
      <!--                </div>-->
      <!--                <div class="info">-->
      <!--                    <a href="#" class="d-block"></a>-->
      <!--                    <a href="{{ route('logins.logout') }}" class="btn btn-danger btn-sm">Logout</a>-->
      <!--                </div>-->
      <!--            </div>-->
      <!--            @endif-->
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input
            class="form-control form-control-sidebar"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <router-link :to="{ name: 'admin-category' }">
                <p>
                  Danh mục sản phẩm
                  <span class="right badge badge-danger">New</span>
                </p>
              </router-link>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Menus</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <router-link :to="{ name: 'admin-product' }">
                <p>Sản phẩm</p>
              </router-link>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Role</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
