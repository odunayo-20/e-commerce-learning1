<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category') }}">List</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category.create') }}">Add</a></li>
          </ul>
        </div>
      </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.product') }}">View</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.product.create') }}">Add</a></li>


        </ul>
      </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.brand') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Brands</span>
      </a>
  </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.color') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Colors</span>
      </a>
  </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.slider') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Sliders</span>
      </a>
  </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Order</span>
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setting') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Setting</span>
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
     
      
    </ul>
  </nav>
