
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
                            <li <?php echo Request::is('users','users/create') ? 'class="active"' : null; ?>>
                                <a href="<?php echo e(URL::to('/users')); ?>">
                                    <i class="fa fa-user-plus"></i>
                                    Create User
                                </a>
                            </li>
                            <li <?php echo Request::is('permission','permission/create') ? 'class="active"' : null; ?>>
                                <a href="<?php echo e(URL::to('permission')); ?>">
                                    <i class="fa fa-plus"></i>
                                    Permission List
                                </a>
                            </li>
                            <li <?php echo Request::is('role') ? 'class="active"' : null; ?>>
                                <a href="<?php echo e(URL::to('/role')); ?>">
                                    <i class="fa fa-users"></i>
                                    Role
                                </a>
                            </li>
                            <li <?php echo Request::is('role_permission') ? 'class="active"' : null; ?>>
                                <a href="<?php echo e(URL::to('/role_permission')); ?>">
                                    <i class="fa fa-tasks"></i>Role Permission
                                </a>
                            </li>
                            <li <?php echo Request::is('assigned_roles') ? 'class="active"' : null; ?>>
                                <a href="<?php echo e(URL::to('assigned_roles')); ?>">
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
                        <a href="<?php echo e(URL::to('/companys')); ?>"><i class="fa fa-circle-o"></i>Company Info</a>
                    </li>
                    <li>
                        <a href="<?php echo e(URL::to('/branchs')); ?>"><i class="fa fa-circle-o"></i>Branchs Info</a>
                    </li>
                    <li>
                        <a href="<?php echo e(URL::to('/services')); ?>"><i class="fa fa-circle-o"></i>Service Confiq</a>
                    </li>
                    <li>
                        <a href="<?php echo e(URL::to('/employeeidcard')); ?>"><i class="fa fa-circle-o"></i>Process Service</a>
                    </li>
                    <li>
                        <a href="<?php echo e(URL::to('/dueCollection')); ?>"><i class="fa fa-circle-o"></i>Due Collection</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /mnt/c/work/ibs_accounts_mail_version/resources/views/partials/left_sidebar.blade.php ENDPATH**/ ?>