        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @can('home')
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Admins -->
            @can('admins')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminManagement"
                    aria-expanded="true" aria-controls="adminManagement">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Admins</span>
                </a>
                <div id="adminManagement" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customized admins:</h6>
                        <a class="collapse-item" href="{{route('dashboard.admins.index')}}">Admins</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Nav Item - Utilities Collapse Menu Settings-->
            @can('settings')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                <span>Settings</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Settings:</h6>
                        <a class="collapse-item" href="{{route('dashboard.settings.index')}}">Settings</a>
                        <a class="collapse-item" href="{{route('dashboard.related.index')}}">Related Links</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Nav Item - Pages Collapse Menu authorization-->
            @can('authorizations')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-gavel"></i>
                    <span>Authorizations</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Roles</h6>
                        <a class="collapse-item" href="{{route('dashboard.authorization.index')}}">Roles</a>
                        <a class="collapse-item" href="{{route('dashboard.authorization.create')}}">Create Role</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Nav Item - Pages Collapse Menu Users Management-->
            @can('users')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersManagement"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users Management</span>
                </a>
                <div id="usersManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">users</h6>
                        <a class="collapse-item" href="{{route('dashboard.users.index')}}">Users</a>
                        <a class="collapse-item" href="{{route('dashboard.users.create')}}">Add user</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Nav Item - Tables -->
            @can('categories')
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.categories.index')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Categories</span></a>
            </li>
            @endcan

            <!-- Nav Item - Pages Collapse Menu Posts Management-->
            @can('posts')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Posts Management</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom posts:</h6>
                        <a class="collapse-item" href="{{route('dashboard.posts.index')}}">View posts</a>
                        <a class="collapse-item" href="{{route('dashboard.posts.create')}}">Create Posts</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - contacts -->
            @can('contacts')
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.contacts.index')}}">
                    <i class="fas fa-fw fa-address-book "></i>
                    <span>Contacts</span></a>
            </li>
            @endcan

            <!-- Nav Item - contacts -->
            @can('alertify')
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.alertify.index')}}">
                    <i class="fas fa-fw fa-bell "></i>
                    <span>Notifications</span></a>
            </li>
            @endcan


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
