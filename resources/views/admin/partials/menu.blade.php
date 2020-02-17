<div class="row align-items-center">
    <div class="col-lg-3 ml-auto">
        {{--        <form class="input-icon my-3 my-lg-0">--}}
        {{--            <input type="search" class="form-control header-search" placeholder="Search&hellip;"--}}
        {{--                   tabindex="1">--}}
        {{--            <div class="input-icon-addon">--}}
        {{--                <i class="fe fe-search"></i>--}}
        {{--            </div>--}}
        {{--        </form>--}}
    </div>
    <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="fe fe-home"></i> Home
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i> Users</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                        @can('permissions_manage')
                        <a href="{{ route('admin.permissions.index') }}" class="dropdown-item ">Permissions</a>
                        @endcan

                        @can('roles_manage')
                        <a href="{{ route('admin.roles.index') }}" class="dropdown-item ">Roles</a>
                        @endcan

                        @can('users_manage')
                            <a href="{{ route('admin.users.index') }}" class="dropdown-item ">Users</a>
                        @endcan
                    </div>
                </li>
        </ul>
    </div>
</div>