

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrapvalidator/bootstrapValidator.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Create User Information</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<form method="POST" action="<?php echo e(url('users')); ?>" onkeypress = "return event.keyCode != 13;" id="frm_data">
    		<?php $form_type ='create' ?>
			<?php echo $__env->make('users/users/_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</form>
	</div>		
</section>
<?php $__env->stopSection(); ?>
			            

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('plugins/daterangepicker/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/select2/select2.full.min.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrapvalidator/bootstrapValidator.min.js')); ?>"></script>
<script>
$(document).ready(function($) {
		$('#employee_name').select2({
		placeholder: 'Enter Employee Name',
		allowClear: true,
		ajax: {
		dataType: 'json',
		url: '<?php echo e(URL::to('/')); ?>/join_employee_list',
		delay: 250,
		data: function(params) {
		return {
		term: params.term
		}
		},
		processResults: function (data, params) {
		params.page = params.page || 1;
		return {
		results: data
		};
		},
		cache: true
		}
		});
			$.ajax({
					type:   'POST',
					url :   "<?php echo e(URL::to('/')); ?>/location_list",
					headers:{
					'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
					},
						dataType: 'json',
						success: function(data) {
							var dataSet = data.data;
							table = $('#list_table').DataTable( {
							destroy:    true,
							paging:     false,
							searching:  false,
							ordering:   true,
							bInfo:      false,
							"data":     dataSet,
							"columns": [
									{ "data": "location_name" },
										{ "data": "checkbox",
											"mRender": function (data, type, full) {
											return '<input type="checkbox" name="permissionlocation[]" value="'+full.id+'">';
										}
									},
										{ "data": "radio",
											"mRender": function (data, type, full) {
											return '<input type="radio" name="defaultlocation[]" value="'+full.id+'">';
										}
									}
						],
						"order": [[0,'asc']]
					});
			}
			});
});
$(document).ready(function() {
$('#identicalForm').bootstrapValidator({
feedbackIcons: {
valid: 'glyphicon glyphicon-ok',
invalid: 'glyphicon glyphicon-remove',
validating: 'glyphicon glyphicon-refresh'
},
fields: {
password: {
validators: {
identical: {
field: 'password_confirmation',
message: 'The password and its confirm are not the same'
},
stringLength: {
min: 6,
message: 'Password minimum 6 characters'
}
}
},
password_confirmation: {
validators: {
identical: {
field: 'password',
message: 'The password and its confirm are not the same'
},
stringLength: {
min: 6,
message: 'Password minimum 6 characters'
}
}
}
}
});
});
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/users/users/create.blade.php ENDPATH**/ ?>