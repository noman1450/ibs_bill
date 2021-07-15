<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(route('home')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Accounts</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        
        <span class="logo-lg"><?php echo e(config('app.name')); ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(asset('admin/dist/img/user2-160x160.jpg')); ?>" class="user-image">
                        <span class="hidden-xs">Alexander Pierce</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(asset('admin/dist/img/user2-160x160.jpg')); ?>" class="img-circle">
                            <p>
                                Alexander Pierce - Web Developer
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Sign out</a>

                                <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="post"><?php echo csrf_field(); ?></form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>
<?php /**PATH /mnt/c/work/ibs_accounts_mail_version/resources/views/partials/navbar.blade.php ENDPATH**/ ?>