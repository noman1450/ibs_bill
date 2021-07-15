<?php $__env->startSection('content'); ?>
<div class="box box-default">
    <div class="box-body">
        <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <table id="designation_list_table" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 25%">Customer Name</th>
                            <th style="width: 25%">Month</th>
                            <th style="width: 25%">Amount</th>
                            <th style="width: 20%">Software Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $rj = $item->customer ?>
                            <tr>
                                <?php if($rj !== $reserve): ?>
                                    <td rowspan="<?php echo e($loop->index); ?>" style="vertical-align:middle; text-align:center;text-transform:capitalize">
                                        <strong><?php echo e($item->customer); ?></strong>
                                    </td>
                                    <?php $reserve = $item->customer ?>
                                <?php endif; ?>
                                <td><?php echo e($item->month_name); ?></td>
                                <td><?php echo e($item->collect_amount); ?></td>
                                <td><?php echo e($item->software_name); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div>
                <button type="button" class="btn btn-info btn-flat pull-right" id="btnPrint" style="margin-right: 10px;">Print</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/work/ibs_accounts_mail_version/resources/views/MasterSetting/duecollection/print-preview.blade.php ENDPATH**/ ?>