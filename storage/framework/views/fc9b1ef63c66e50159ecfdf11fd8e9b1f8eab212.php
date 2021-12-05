

<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Create Company Information</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<form method="POST" action="<?php echo e(route('companys.store')); ?>" onkeypress = "return event.keyCode != 13;" id="frm_data">
    		<?php $form_type ='create' ?>
			<?php echo $__env->make('MasterSetting/Companys/_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</form>
	</div>		
</section>
<?php $__env->stopSection(); ?>
			            

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/MasterSetting/companys/create.blade.php ENDPATH**/ ?>