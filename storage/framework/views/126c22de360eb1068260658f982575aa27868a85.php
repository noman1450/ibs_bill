      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo e(asset('admin-lte/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->

          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            

            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                
              </a>
            </li>


            
            
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>






     <!--  <li <?php echo Request::is('users','user_role','assigned_roles','role_permission','role','permission','permission/create','users/create') ? ' class="active treeview"' : ' class="treeview"'; ?>>
        <a href="#">
          <i class="fa fa-user"></i>
          <span>User Manager</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li <?php echo Request::is('users','users/create') ? '               class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/users')); ?>">                       <i class="fa fa-user-plus"></i>Create User</a></li>
          <li <?php echo Request::is('permission','permission/create') ? '     class="active"' : null; ?>>  <a href="<?php echo e(URL::to('permission')); ?>">      <i class="fa fa-plus"></i>Permission List</a></li>
          <li <?php echo Request::is('role') ? '                               class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/role')); ?>">                        <i class="fa fa-users"></i>Role</a></li>
          <li <?php echo Request::is('role_permission') ? '                    class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/role_permission')); ?>">             <i class="fa fa-tasks"></i>Role Permission</a></li>
          <li <?php echo Request::is('assigned_roles') ? '                     class="active"' : null; ?>>  <a href="<?php echo e(URL::to('assigned_roles')); ?>">        <i class="fa fa-share-alt"></i>Roles Assign </a></li>
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
                <li <?php echo Request::is('users','users/create') ? '               class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/users')); ?>">                       <i class="fa fa-user-plus"></i>Create User</a></li>
                <li <?php echo Request::is('permission','permission/create') ? '     class="active"' : null; ?>>  <a href="<?php echo e(URL::to('permission')); ?>">      <i class="fa fa-plus"></i>Permission List</a></li>
                <li <?php echo Request::is('role') ? '                               class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/role')); ?>">                        <i class="fa fa-users"></i>Role</a></li>
                <li <?php echo Request::is('role_permission') ? '                    class="active"' : null; ?>>  <a href="<?php echo e(URL::to('/role_permission')); ?>">             <i class="fa fa-tasks"></i>Role Permission</a></li>
                <li <?php echo Request::is('assigned_roles') ? '                     class="active"' : null; ?>>  <a href="<?php echo e(URL::to('assigned_roles')); ?>">        <i class="fa fa-share-alt"></i>Roles Assign </a></li>
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
              <a href="<?php echo e(URL::to('/companys')); ?>"><i class="fa fa-circle-o"></i>Company Info</i></a>
             
            </li>
          </ul>

          <ul class="treeview-menu">
            <li>
              <a href="<?php echo e(URL::to('/branchs')); ?>"><i class="fa fa-circle-o"></i>Branchs Info</i></a>
             
            </li>
          </ul>

           <ul class="treeview-menu">
            <li>
              <a href="<?php echo e(URL::to('/services')); ?>"><i class="fa fa-circle-o"></i>Service Confiq</i></a>
             
            </li>
          </ul>

          <ul class="treeview-menu">
            <li>
              <a href="<?php echo e(URL::to('/employeeidcard')); ?>"><i class="fa fa-circle-o"></i>Process Service</i></a>
             
            </li>
          </ul>


           <ul class="treeview-menu">
            <li>
              <a href="<?php echo e(URL::to('/dueCollection')); ?>"><i class="fa fa-circle-o"></i>Due Collection</i></a>
             
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









            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
<?php /**PATH /home/ibs/Documents/Project/ibs_account_beta_mail_version/resources/views/layouts/left_sidebar.blade.php ENDPATH**/ ?>