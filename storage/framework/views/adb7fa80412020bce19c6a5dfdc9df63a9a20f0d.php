<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>

 

<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Branch Information List</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
		        <div class="form-group col-lg-12 col-md-12 col-xs-12">
		            <a href="<?php echo e(URL::to('branchs/create')); ?>"><input type="button" value="Create New" class="btn-success btn btn-sm button btn-flat pull-left" style="font-size: 12px; font-weight: bold;"></a>
		        </div>				
			</div>

			<div class="row">
				<div class="form-group col-lg-12 col-md-12 col-xs-12">
	              	<table id="branch-table" class="table table-bordered table-hover">
		                <thead>
			                <tr>
			                  	<th>Branch Name</th>
			                  	<th>Contact No</th>
			                  	<th>Email</th>
			                  	<th>Address</th>
			                  	<th>Active Status</th>
			                  	<th>Action</th>
			                </tr>
		                </thead>
		                <tbody>
		                </tbody>
	              	</table>					
				</div>
			</div>

		</div>

	</div>
</section>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>

<!-- <script src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
 -->
 

<script type="text/javascript">
	$(document).ready(function() {

	  	$('#branch-table').DataTable( {
		    "processing":   true,
		    "serverSide":   true,
		    "paging":       true,
		    "lengthChange": true,
		    "searching":    true,
		    "ordering":     true,
		    "info":         true,
		    "autoWidth":    false,
			"ajax": {
				"url": 		"<?php echo e(URL::to('/')); ?>/branch",
				"type": 	"GET",
		        "dataType": "json",
			},    
		    "columns": [
				{ "data": "branch" },
				{ "data": "contact_number" },
				{ "data": "email" },
				{ "data": "address" },
				{ "data": "active_status" },
				{ "data": "Link", name: 'link', orderable: false, searchable: false}      
		    ],
		    "order": [[0, 'asc']]
	  	});
	});		



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ibs/Documents/Project/ibs_account_beta_mail_version/resources/views/MasterSetting/branch/index.blade.php ENDPATH**/ ?>