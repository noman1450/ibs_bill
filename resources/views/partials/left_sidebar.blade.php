
<aside class="main-sidebar" data-widget="tree">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

{{--                <li {!! Request::is('users','user_role','assigned_roles','role_permission','role','permission','permission/create','users/create') ? ' class="active treeview"' : ' class="treeview"' !!}>--}}
{{--                <a href="#">--}}
{{--                  <i class="fa fa-user"></i>--}}
{{--                  <span>User Manager</span>--}}
{{--                  <i class="fa fa-angle-left pull-right"></i>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                  <li {!! Request::is('users','users/create') ? 'class="active"' : null !!}>--}}
{{--                  <a href="{{URL::to('/users')}}">--}}
{{--                     <i class="fa fa-user-plus"></i>--}}
{{--                     Create User</a>--}}
{{--                  </li>--}}
{{--                  <li {!! Request::is('permission','permission/create') ? 'class="active"' : null !!}>--}}
{{--                    <a href="{{URL::to('permission')}}">--}}
{{--                    <i class="fa fa-plus"></i>Permission List</a></li>--}}
{{--                  <li {!! Request::is('role') ? 'class="active"' : null !!}>  <a href="{{URL::to('/role')}}"><i class="fa fa-users"></i>Role</a></li>--}}
{{--                  <li {!! Request::is('role_permission') ? 'class="active"' : null !!}>  <a href="{{URL::to('/role_permission')}}"><i class="fa fa-tasks"></i>Role Permission</a></li>--}}
{{--                  <li {!! Request::is('assigned_roles') ? 'class="active"' : null !!}>  <a href="{{URL::to('assigned_roles')}}"><i class="fa fa-share-alt"></i>Roles Assign </a></li>--}}
{{--                </ul>--}}
{{--              </li>--}}





            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-md"></i>
                    <span>Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> User Manager <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li {!! Request::is('users','users/create') ? 'class="active"' : null !!}>
                                <a href="{{URL::to('/users')}}">
                                    <i class="fa fa-user-plus"></i>
                                    Create User
                                </a>
                            </li>
                            <li {!! Request::is('permission','permission/create') ? 'class="active"' : null !!}>
                                <a href="{{URL::to('permission')}}">
                                    <i class="fa fa-plus"></i>
                                    Permission List
                                </a>
                            </li>
                            <li {!! Request::is('role') ? 'class="active"' : null !!}>
                                <a href="{{URL::to('/role')}}">
                                    <i class="fa fa-users"></i>
                                    Role
                                </a>
                            </li>
                            <li {!! Request::is('role_permission') ? 'class="active"' : null !!}>
                                <a href="{{URL::to('/role_permission')}}">
                                    <i class="fa fa-tasks"></i>Role Permission
                                </a>
                            </li>
                            <li {!! Request::is('assigned_roles') ? 'class="active"' : null !!}>
                                <a href="{{URL::to('assigned_roles')}}">
                                    <i class="fa fa-share-alt"></i>
                                    Roles Assign
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Master Config</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li>
                        <a href="{{URL::to('/companys')}}"><i class="fa fa-circle-o"></i>Company Info</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/branchs')}}"><i class="fa fa-circle-o"></i>Branchs Info</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/customer_information')}}"><i class="fa fa-circle-o"></i>Client Information</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/services')}}"><i class="fa fa-circle-o"></i>Service Confiq</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/process_service_view')}}"><i class="fa fa-circle-o"></i>Process Service View</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/employeeidcard')}}"><i class="fa fa-circle-o"></i>Process Service</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/dueCollection')}}"><i class="fa fa-circle-o"></i>Due Collection</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
