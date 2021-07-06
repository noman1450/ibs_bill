<?php $__env->startSection('content'); ?>
    <!-- Button trigger modal -->
    <button type="button" id="modalButton_0" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalBody_0" onClick="createNewModal(this)">
        Launch demo modal
    </button>

    <div id="dialogs">
        <div class="dialog-tmpl">
            <div class="dialog-body"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/home.blade.php ENDPATH**/ ?>