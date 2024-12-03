<div>
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="home" class="logo">
            <img src="images/logo1.png" alt="navbar brand" class="navbar-brand" height="50" style="border-radius: 18px;" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
              <a href="home" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Home</p>
              </a>
            </li>
            @if (Auth::user()->role == 'admin')
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section"></h4>
            </li>
            <li class="nav-item {{ request()->is('create_news') ? 'active' : '' }}">
              <a href="{{route('admin.create')}}">
                <i class="fas fa-newspaper"></i>
                <p>Create News</p>
              </a>
            </li>
            <li class="nav-item {{ request()->is('news', 'videos', 'poetrys', 'posters') ? 'active' : '' }}">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Category</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="news">
                      <span class="sub-item">News</span>
                    </a>
                  </li>
                  <li>
                    <a href="videos">
                      <span class="sub-item">Videos</span>
                    </a>
                  </li>
                  <li>
                    <a href="poetrys">
                      <span class="sub-item">Poetrys</span>
                    </a>
                  </li>
                  <li>
                    <a href="posters">
                      <span class="sub-item">Posters</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{route('artwork.reposted')}}">
                <i class="far fa-arrow-alt-circle-down"></i>
                <p>Repost</p>
              </a>
            </li>
            @else
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Feature</h4>
            </li>
            <li class="nav-item {{ request()->is('create') ? 'active' : '' }}">
              <a href="{{route('student.create')}}">
                <i class="fas fa-plus-square"></i>
                <p>Create</p>
              </a>
            </li>
            <li class="nav-item {{ request()->is('news', 'videos', 'poetrys', 'posters') ? 'active' : '' }}">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Category</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="news">
                      <span class="sub-item">News</span>
                    </a>
                  </li>
                  <li>
                    <a href="videos">
                      <span class="sub-item">Videos</span>
                    </a>
                  </li>
                  <li>
                    <a href="poetrys">
                      <span class="sub-item">Poetrys</span>
                    </a>
                  </li>
                  <li>
                    <a href="posters">
                      <span class="sub-item">Posters</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{route('artwork.reposted')}}">
                <i class="fas fa-trophy"></i>
                <p>Best Art</p>
              </a>
            </li>
            <li class="nav-item {{ request()->is('history') ? 'active' : '' }}">
              <a href="{{route('student.history')}}">
                <i class="fas fa-history"></i>
                <p>History</p>
              </a>
            </li>
            @endif
          </ul>
        </div>
            
      </div>
    </div>
    <!-- End Sidebar -->
</div>