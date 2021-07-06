<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" id="modalButton_0" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalBody_0" onClick="createNewModal(this)">
  Launch demo modal
</button>

<div id="dialogs">
 <div class="dialog-tmpl">
  <div class="dialog-body"></div>
 </div>
</div>


<script type="text/javascript">
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ibs/Documents/Project/ibs_account_beta_mail_version/resources/views/home.blade.php ENDPATH**/ ?>