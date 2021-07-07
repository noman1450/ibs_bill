

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/select2.min.css')); ?>" /> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Service Confiq</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	

        <form method="POST" action="<?php echo e(route('services.update',$service->id)); ?>" onkeypress = "return event.keyCode != 13;" id="frm_data">
        	<?php echo method_field('PATCH'); ?>
        	<?php $form_type='edit' ?>
    		<?php echo $__env->make('MasterSetting/Service/_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>		
	</div>		
</section>




<?php $__env->stopSection(); ?>
			            

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('plugins/datatables/select2.min.js')); ?>"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script> -->





<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/MasterSetting/service/edit.blade.php ENDPATH**/ ?>