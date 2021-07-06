<!-- permissionlist -->


<?php $__env->startSection('styles'); ?>
<!-- DataTables -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Permission List</h3>
            </div>
  
	        <div class="col-xs-8" style="padding-bottom: 10px;">
	            <a href="<?php echo e(URL::to('permission/create')); ?>"><input type="button" value="Create New" class="btn-success btn btn-sm button pull-left" style="font-size: 12px; font-weight: bold;"></a>
	        </div>

            <!-- /.box-header -->
            <div class="box-body" style="padding: 0px;">
	            <div class="col-xs-8" style="padding-bottom: 10px;">
	              <table id="products" class="table table-bordered table-hover">
	                <thead>
	                <tr>
	                  <th style="width:100%;">Permission Name</th>
	                  <th style="width:100%;">Display Name</th>
	                
	                </tr>
	                </thead>
	                <tbody>
	                </tbody>
	              </table>
	            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>


$(document).ready(function() {
  var table = $('#products').DataTable( {
     "processing":   true,
        "serverSide":   true,
        "paging":       true,
        "lengthChange": true,
        "searching":    true,
        "ordering":     true,
        "retrieve":     true,
        "info":         true,
       
    "ajax": "<?php echo e(URL::to('/')); ?>/getpermissionlist",
      "columns": [
          { "data": "name" },
          { "data": "display_name" },
         
      ],
    "order": [[0, 'asc']]
  } );
});
</script>


<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ibs/Documents/Project/ibs_account_beta_mail_version/resources/views/users/permission/permissionlist.blade.php ENDPATH**/ ?>