<!-- Sidebar -->
<aside class="col-md-3 nav-sticky dashboard-sidebar">
        <!-- User Info Section -->
        <div class="user-info text-center p-3">
            <img src="{{ asset(Auth::guard('web')->user()->image ) }}" alt="User Image" class="rounded-circle mb-2"
                style="width: 80px; height: 80px; object-fit: cover" />
            <h5 class="mb-0" style="color: #ff6f61">{{ Auth::guard()->user()->name }}</h5>
        </div>
        <!-- Sidebar Menu -->
        <div class="list-group profile-sidebar-menu">
            <a href="{{ route('frontend.dashboard.profile') }}" class="list-group-item list-group-item-action {{$currActiveProfile ?? ''}}  menu-item"
                data-section="profile">
                <i class="fas fa-user"></i> Profile
                </a>
            <a href="{{route('frontend.dashboard.notification.index')}}" class="list-group-item list-group-item-action {{$currActiveNotify ?? ''}}  menu-item"
                data-section="notifications">
                <i class="fas fa-bell"></i> Notifications
            </a>
            <a href="{{route('frontend.dashboard.setting.index')}}" class="list-group-item list-group-item-action {{$currActiveSettings ?? ''}} menu-item" data-section="settings">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="{{$getSetting->wa}}" class="list-group-item list-group-item-action menu-item">
            <i class="fa fa-phone" aria-hidden="true"></i> Send ME With WA
            </a>
            <a href="javascript:void(0)" onclick="document.getElementById('logOutID').submit()" class="list-group-item list-group-item-action menu-item">
            <i class="fa fa-sign-language" aria-hidden="true"></i> Logout
            </a>
        </div>
        <form action="{{route('logout')}}" method="POST" id="logOutID">
            @csrf
        </form>
    </aside>
