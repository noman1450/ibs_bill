<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">



    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/Ionicons/css/ionicons.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/bower_components/select2/dist/css/select2.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/skins/_all-skins.min.css')); ?>">

    <style>
        @media  print
        {
            .noprint {
                display:none !important;
                visibility:hidden !important;
            }
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $__env->yieldContent('style'); ?>
    <?php echo toastr_css(); ?>
</head>


<body class="skin-blue sidebar-mini fixed sidebar-mini-expand-feature">
<div class="wrapper">

    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('partials.left_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="flash-message" style="margin-bottom: -15px; padding: 5px; margin-right: auto; margin-left: auto; padding-left: 25px; padding-right: 25px;">
                <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Session::has('alert-' . $msg)): ?>
                        <h1 style="font-size: x-large;" class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h1>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <footer class="main-footer noprint" style="text-align: end;">
        <strong>
            <a href="http://i-infotechsolution.com"><b>Version</b> 2.3.0</a>
        </strong>
    </footer>

</div><!-- ./wrapper -->
<?php echo jquery(); ?>
<?php echo toastr_js(); ?>
<?php echo app('toastr')->render(); ?>


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

<script src="<?php echo e(asset('/admin/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>

<!-- FastClick -->
<script src="<?php echo e(asset('/admin/bower_components/fastclick/lib/fastclick.js')); ?>"></script>

<!-- DataTables -->
<script src="<?php echo e(asset('/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('/admin/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo e(asset('/admin/dist/js/adminlte.min.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>


<script src="<?php echo e(asset('js/formsubmitscript.js')); ?>"></script>
<?php echo $__env->make('layouts/modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH /mnt/c/work/ibs_accounts_mail_version/resources/views/layouts/main.blade.php ENDPATH**/ ?>