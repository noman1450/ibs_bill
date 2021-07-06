@csrf
<div class="box-body">

      <div class="col-lg-12 col-md-12 col-xs-12">

       <div class=" col-lg-6 col-md-6 col-xs-12">
          <div id="alert-danger1"></div>
          <div id="alert-success1"></div>
       </div>

   </div>
	<div class="row">
		@if (count($errors) > 0)
			<div class="col-lg-12 col-md-12 col-xs-12">
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			</div>
		@endif
    <div class="col-md-6" >
                        <div class="col-md-12">
                            <div class="col-xs-12 form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label control-label">User Name</label>
                                <input type="text" value="{{ old('username',$edit_data[0]->name??null) }}" class="form-control" name="username" placeholder="User Name"  required>
                            </div>
                            
                       <!--      <div class="col-xs-12 form-group has-feedback {{ $errors->has('designation') ? ' has-error' : '' }}">
                                <label control-label">Designation</label>
                                <input type="text" class="form-control" name="designation" placeholder="Designation"  required>
                            </div> -->
                            <div class="col-xs-12 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label control-label">Email</label>
                                <input type="text" class="form-control"   @if($form_type == 'edit') readonly @endif value="{{ old('email',$edit_data[0]->email??null) }}" name="email" placeholder="Email" required>
                            </div>

                                <input type="text" id="user_id" name="user_id" value="{{ old('id',$edit_data[0]->id??null) }}" hidden>

                            @if($form_type != 'edit')
                            
                            <div class="col-xs-12 form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label control-label">Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Password at least 6 characters"  required>
                            </div>

                            <div class="col-xs-12 form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label control-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"  required>
                            </div>
                            @endif
                         <!--    <div class="col-xs-12 form-group has-feedback {{ $errors->has('employee_name') ? ' has-error' : '' }}">
                                <label control-label">Employee Name</label>
                                <select class="form-control" id="employee_name" name="employee_name" >
                                </select>
                            </div>
                            <div class="col-xs-12 form-group has-feedback {{ $errors->has('userrole') ? ' has-error' : '' }}">
                                <label control-label">User Role</label>
                                <select class="form-control" id="userrole" name="userrole" required>
                                    <option>-- Select Role --</option>
                                    @foreach ($role_list as $keys)
                                    <option value={{$keys->id}}>{{$keys->guard_name}}</option>
                                    @endforeach
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
</div>	