<?php echo csrf_field(); ?>
<div class="box-body">

      <div class="col-lg-12 col-md-12 col-xs-12">

       <div class=" col-lg-6 col-md-6 col-xs-12">
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
    <div class="col-md-6" >
                        <div class="col-md-12">
                            <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                                <label control-label">User Name</label>
                                <input type="text" value="<?php echo e(old('username',$edit_data[0]->name??null)); ?>" class="form-control" name="username" placeholder="User Name"  required>
                            </div>
                            
                       <!--      <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('designation') ? ' has-error' : ''); ?>">
                                <label control-label">Designation</label>
                                <input type="text" class="form-control" name="designation" placeholder="Designation"  required>
                            </div> -->
                            <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label control-label">Email</label>
                                <input type="text" class="form-control"   <?php if($form_type == 'edit'): ?> readonly <?php endif; ?> value="<?php echo e(old('email',$edit_data[0]->email??null)); ?>" name="email" placeholder="Email" required>
                            </div>

                                <input type="text" id="user_id" name="user_id" value="<?php echo e(old('id',$edit_data[0]->id??null)); ?>" hidden>

                            <?php if($form_type != 'edit'): ?>
                            
                            <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label control-label">Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Password at least 6 characters"  required>
                            </div>

                            <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                                <label control-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"  required>
                            </div>
                            <?php endif; ?>
                         <!--    <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('employee_name') ? ' has-error' : ''); ?>">
                                <label control-label">Employee Name</label>
                                <select class="form-control" id="employee_name" name="employee_name" >
                                </select>
                            </div>
                            <div class="col-xs-12 form-group has-feedback <?php echo e($errors->has('userrole') ? ' has-error' : ''); ?>">
                                <label control-label">User Role</label>
                                <select class="form-control" id="userrole" name="userrole" required>
                                    <option>-- Select Role --</option>
                                    <?php $__currentLoopData = $role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value=<?php echo e($keys->id); ?>><?php echo e($keys->guard_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> -->
                        </div>
                    </div>
                <!--     <div class="col-md-6" >
                        <div class="col-md-12">
                            <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                <table id="list_table" class=" table table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead style="background-color: #3C8DBC; color: white; ">
                                        <tr>
                                            <th style="width: 60%">Branch Name</th>
                                            <th style="width: 20%">Permission</th>
                                            <th style="width: 20%">Default</th>
                                        </tr>
                                    </thead>
                                    <tbody ">
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        
                    </div> -->
</div>
<div class="box-footer">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="input-group col-lg-6 col-md-6 col-xs-12">      	
			<!-- <button type="submit" class="btn btn-success pull-right btn-flat">Submit</button> -->
              <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">
		</div>
	</div>		        
</div>	<?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/users/users/_form.blade.php ENDPATH**/ ?>