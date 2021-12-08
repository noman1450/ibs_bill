<?php $__env->startSection('style'); ?>
    <style>
        .brand-logo {
            width: 100%;
            height: auto;
        }

        .font-13px {
            font-size: 13px;
        }
        .footer-img {
            background-size: cover;
            height: 30px;
            text-align: center;
            padding-top: 5px;
            background-image: url('https://i-infotechsolution.com/assets/ibs/background4_1.jpg');
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
	<div id="alert-danger"></div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Invoice for <?php echo e(ucwords($data->client_name) ?? ''); ?></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div style="padding: 10px 15px">
                    <div style="border:3px solid #479FD0;padding:0;">
                        <div>
                            <img src="https://i-infotechsolution.com/assets/ibs/background2.jpg" class="brand-logo">
                        </div>

                        <div style="padding: 20px">
                            <div>
                                <p class="font-14px">
                                    Reference: <strong>IBS-<?php echo e($bill_no ?? '22112121'); ?></strong>
                                </p>

                                <p class="font-14px">
                                    <?php echo e(date('F d, Y')); ?>

                                </p>

                                <p style="margin-top: 15px">
                                    To
                                </p>
                                <p style="font-weight: 500">
                                    <?php echo e($data->from_information ?? ''); ?>

                                    
                                </p>

                                <p class="client-name">
                                    <strong>
                                        <?php echo e(ucwords($data->client_name) ?? ''); ?>

                                        
                                    </strong>
                                </p>

                                <p class="font-14px client-address">
                                    <em>
                                        <?php echo e($data->client_address ?? ''); ?>

                                        
                                    </em>
                                </p>

                                <p class="font-14px client-email">
                                    <?php echo e($data->client_email ?? ''); ?>

                                    
                                </p>
                            </div>

                            <div style="margin-top: 50px">
                                <div style="width:100%;text-align:center;text-decoration:underline;font-weight:600">Subject Bill</div>
                            </div>

                            <div style="margin-top:20px">
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="text-center font-13px">SL</th>
                                        <th class="text-center font-13px">PARTICULARS</th>
                                        <th class="text-center font-13px">QTY</th>
                                        <th class="text-center font-13px">AMOUNT TK</th>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td  class="text-center">1</td>
                                            <td  class="text-center">
                                                <?php echo e($data->software_name ?? ''); ?>

                                                
                                            </td>
                                            <td  class="text-center">1@ Tk.
                                                <?php echo e($data->amount ?? ''); ?>/=
                                                
                                            </td>
                                            <td  class="text-center">Tk.
                                                <?php echo e($data->amount ?? ''); ?>/=
                                                
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align:right">
                                                <p style="font-weight:900;font-size:12px">TOTAL</p>

                                                <p><em>(excluding vat & tax)</em></p>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle">Tk.
                                                <?php echo e($data->amount ?? ''); ?>/=
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p class="font-14px" style="margin-top:10px">In-Words: <strong>
                                    <?php echo e(ucwords($word) ?? ''); ?> only
                                    
                                </strong></p>
                            </div>

                            <div style="padding-right:20px;margin-top:100px;">
                                <div style="text-align:right">
                                    <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

                                    <p>
                                        -------------------------------------
                                    </p>

                                    <p class="font-14px">Authorized Signature</p>
                                </div>
                            </div>
                        </div>

                        <div class="footer-img font-14px" style="text-align:center;margin-top:30px">
                            <a href="https://i-infotechsolution.com" style="text-decoration:none;display:block;margin-top:3px;color:#000;">
                                www.i-infotechsolution.com
                            </a>
                        </div>

                        <div style="padding: 5px 20px 10px 10px">
                            <p class="font-14px">
                                <strong>i-infotech Business Solution</strong>
                            </p>
                            <p style="font-size: 11px">
                                House: 126, Road-01, Avenue-3 , Mirpur-DOHS, Dhaka-1216
                            </p>
                            <p style="font-size: 11px">
                                E-mail: iinfotechbs@gmail.com, info@i-infotechsolution.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div style="padding: 20px">
                    <a href="<?php echo e(route('submitemployeeidcard', ['id' => $data->id, 'year' => request('year'), 'month' => request('month')])); ?>" class="btn btn-info">
                        <i class="fa fa-print"></i> Make Pdf
                    </a>
                </div>
            </div>
        </div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/MasterSetting/join_employee/view.blade.php ENDPATH**/ ?>