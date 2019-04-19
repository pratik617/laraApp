<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/new-logo-otfcoder.png') }}" alt="home" class="light-logo" width="80" />
                <!-- Logo icon image, you can use font-icon also --><b>
             </b>
           </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                  <img src="{{ asset(App\Models\User::FILE_UPLOAD_DIR.'/'.Auth::user()->picture) }}" alt="{{ Auth::user()->full_name }}" width="36" height="36" class="img-circle">
                  <b class="hidden-xs">{{ Auth::user()->full_name }}</b><span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img">
                              <img src="{{ asset(App\Models\User::FILE_UPLOAD_DIR.'/'.Auth::user()->picture) }}" alt="{{ Auth::user()->full_name }}">
                            </div>

                            <div class="u-text">
                              <h4>{{ Auth::user()->full_name }}</h4>
                              <p class="text-muted">{{ Auth::user()->email }}</p>
                              <a href="{{ route('profile.index') }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->
