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
            	<label>Name of Branch<span class="required">*</span></label>
                <input type="text" class="form-control" name="branch" placeholder="Name of Branch.." value="<?php echo e(old('branch',$branch->branch_name??null)); ?>" autofocus="" required="required">
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Email<span class="required">*</span></label>
                <input type="email" class="form-control" name="email" placeholder="Email.." value="<?php echo e(old('email',$branch->email??null)); ?>" autofocus="" required="required">
            </div>
        </div>  	

  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
            	<label>Address<span class="required">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="Address.." value="<?php echo e(old('address',$branch->address??null)); ?>" required="required">
            </div>
        </div>		

  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
            	<label>Contact Number<span class="required">*</span></label>
                <input type="number" class="form-control" name="contact_number" placeholder="Contact Number.." value="<?php echo e(old('contact_number',$branch->contact_number??null)); ?>" required="required">
            </div>
        </div>

            <div class="col-xs-12 form-group has-feedback ">
                 <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                                <label control-label">Company Name</label>
                                    <select class="form-control" name="company_id" id="company" required>
                                    <option>-- Select company --</option>
                                        <?php $__currentLoopData = $companys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($keys->id); ?>><?php echo e($keys->full_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                 </div>		
            </div>      

        <?php if($form_type =='edit'): ?>
  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>Active Status</label>
                <select class="form-control select2" name="active_status" style="width: 100%;" >
                	<?php if($branch->valid == 1): ?>
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

<?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/MasterSetting/Branch/_form.blade.php ENDPATH**/ ?>