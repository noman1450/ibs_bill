      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
{{--           <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> --}}
          <!-- /.search form -->

          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            {{-- <li class="header">MAIN NAVIGATION</li> --}}
            
{{--             <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
              </ul>
            </li>
 --}}
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                {{-- <small class="label pull-right bg-green">new</small> --}}
              </a>
            </li>


            
{{--             <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
 --}}            
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>






     <!--  <li {!! Request::is('users','user_role','assigned_roles','role_permission','role','permission','permission/create','users/create') ? ' class="active treeview"' : ' class="treeview"' !!}>
        <a href="#">
          <i class="fa fa-user"></i>
          <span>User Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li {!! Request::is('users','users/create') ? '               class="active"' : null !!}>  <a href="{{URL::to('/users')}}">                       <i class="fa fa-user-plus"></i>Create User</a></li>
          <li {!! Request::is('permission','permission/create') ? '     class="active"' : null !!}>  <a href="{{URL::to('permission')}}">      <i class="fa fa-plus"></i>Permission List</a></li>
          <li {!! Request::is('role') ? '                               class="active"' : null !!}>  <a href="{{URL::to('/role')}}">                        <i class="fa fa-users"></i>Role</a></li>
          <li {!! Request::is('role_permission') ? '                    class="active"' : null !!}>  <a href="{{URL::to('/role_permission')}}">             <i class="fa fa-tasks"></i>Role Permission</a></li>
          <li {!! Request::is('assigned_roles') ? '                     class="active"' : null !!}>  <a href="{{URL::to('assigned_roles')}}">        <i class="fa fa-share-alt"></i>Roles Assign </a></li>
        </ul>
      </li>
 -->



        <li class="treeview">

          <a href="#">
            <i class="fa fa-user-md"></i> <span>Admin</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> User Manager <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li {!! Request::is('users','users/create') ? '               class="active"' : null !!}>  <a href="{{URL::to('/users')}}">                       <i class="fa fa-user-plus"></i>Create User</a></li>
                <li {!! Request::is('permission','permission/create') ? '     class="active"' : null !!}>  <a href="{{URL::to('permission')}}">      <i class="fa fa-plus"></i>Permission List</a></li>
                <li {!! Request::is('role') ? '                               class="active"' : null !!}>  <a href="{{URL::to('/role')}}">                        <i class="fa fa-users"></i>Role</a></li>
                <li {!! Request::is('role_permission') ? '                    class="active"' : null !!}>  <a href="{{URL::to('/role_permission')}}">             <i class="fa fa-tasks"></i>Role Permission</a></li>
                <li {!! Request::is('assigned_roles') ? '                     class="active"' : null !!}>  <a href="{{URL::to('assigned_roles')}}">        <i class="fa fa-share-alt"></i>Roles Assign </a></li>
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
              <a href="{{URL::to('/companys')}}"><i class="fa fa-circle-o"></i>Company Info</i></a>
             
            </li>
          </ul>

          <ul class="treeview-menu">
            <li>
              <a href="{{URL::to('/branchs')}}"><i class="fa fa-circle-o"></i>Branchs Info</i></a>
             
            </li>
          </ul>

           <ul class="treeview-menu">
            <li>
              <a href="{{URL::to('/services')}}"><i class="fa fa-circle-o"></i>Service Confiq</i></a>
             
            </li>
          </ul>

          <ul class="treeview-menu">
            <li>
              <a href="{{URL::to('/employeeidcard')}}"><i class="fa fa-circle-o"></i>Process Service</i></a>
             
            </li>
          </ul>


           <ul class="treeview-menu">
            <li>
              <a href="{{URL::to('/dueCollection')}}"><i class="fa fa-circle-o"></i>Due Collection</i></a>
             
            </li>
          </ul>
        </li>












<!-- 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>


 -->









{{--             <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
 --}}            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
