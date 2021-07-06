<?php echo csrf_field(); ?>



<div class="box-body">

   <div class="col-lg-12 col-md-12 col-xs-12">

       <div class="col-lg-6 col-md-6 col-xs-12">
          <div id="alert-danger1"></div>
          <div id="alert-success1"></div>
       </div>

   </div>



	<div class="row">
		<?php if(count($errors) > 0): ?>
			<div class="col-lg-12 col-md-12 col-xs-12">
			    <div class="alert alert-danger">
			        <ul>
			            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <li><?php echo e($error); ?></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </ul>
			    </div>
			</div>
		<?php endif; ?>

  	   <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Send To<span class="required">*</span></label>
                <input  class="form-control" name="send_to" placeholder="Send To.." value="<?php echo e(old('send_to',$service->send_to??null)); ?>" required="required">
            </div>
        </div>     



          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>From Information<span class="required">*</span></label>
                <input  class="form-control" name="from_information" placeholder="From information.." value="<?php echo e(old('from_information',$service->from_information??null)); ?>" required="required">
            </div>
        </div>      

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>To Information<span class="required">*</span></label>
                <input  class="form-control" name="to_information" placeholder="Email.." value="<?php echo e(old('to_information',$service->to_information??null)); ?>" autofocus="" required="required">
            </div>
        </div>  	

  	

  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
            	<label>Software Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="software_name" placeholder="Software name.." value="<?php echo e(old('software_name',$service->software_name??null)); ?>" required="required">
            </div>
        </div>  

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
              <label>Amount<span class="required">*</span></label>
                <input type="number" class="form-control" name="amount" placeholder="Amount.." value="<?php echo e(old('amount',$service->amount??null)); ?>" required="required">
            </div>
        </div>

            <div class="col-xs-12 form-group has-feedback ">
                 <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                                <label control-label">Clients Name</label>
                                    <select class="form-control" name="client_id" id="client" required>
                                    <option>-- Select Client --</option>
                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($keys->id); ?>><?php echo e($keys->client_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                 </div>		
            </div>      

        <?php if($form_type =='edit'): ?>
  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>Active Status</label>
                <select class="form-control select2" name="active_status" style="width: 100%;" >
                	<?php if($service->valid == 1): ?>
                		<option value="0">Inactive</option>
                		<option value="1" selected>Active</option>
                	<?php else: ?>
                		<option value="0" selected>Inactive</option>
                		<option value="1">Active</option>
                	<?php endif; ?>
                	
                </select>
            </div>
        </div>
        <?php endif; ?>
	</div>
</div>
<div class="box-footer">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="input-group col-lg-6 col-md-6 col-xs-12">      	
			<!-- <button type="submit" id="btnSubmit" class="btn btn-success pull-right btn-flat">Submit</button> -->
        <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">


		</div>
	</div>		        
</div>	

<?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/MasterSetting/Service/_form.blade.php ENDPATH**/ ?>