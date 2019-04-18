<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav slimscrollsidebar">
    <div class="sidebar-head">
        <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
    </div>
    <ul class="nav" id="side-menu">
      <li>
        <a href="{{ route('dashboard') }}" class="waves-effect{{ (Request::is('dashboard'))?' active':'' }}">
          <i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span>
        </a>
      </li>
      <li>
        <a href="{{ route('users.index') }}" class="waves-effect{{ (Request::is('users*'))?' active':'' }}">
          <i class="mdi mdi-account-multiple fa-fw" data-icon="v"></i> <span class="hide-menu"> Users </span>
        </a>
      </li>
    </ul>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
