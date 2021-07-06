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

  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
            	<label>Company Full Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="full_name" placeholder="Company Full Name.." value="{{ old('full_name',$company->full_name??null) }}" autofocus="" required="required">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Company Short Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="short_name" placeholder="Company Short Name.." value="{{ old('short_name',$company->short_name??null) }}" autofocus="" required="required">
            </div>
        </div>



        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Email<span class="required">*</span></label>
                <input type="email" class="form-control" name="email" placeholder="Email.." value="{{ old('email',$company->email??null) }}" autofocus="" required="required">
            </div>
        </div> 
	

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Contact Number<span class="required">*</span></label>
                <input type="number" class="form-control" name="contact_number" placeholder="Contact Number.." value="{{ old('contact_number',$company->contact_number??null) }}" required="required">
            </div>
        </div>      


        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Website Address<span class="required">*</span></label>
                <input type="text" class="form-control" name="web_address" placeholder="Website Address.." value="{{ old('web_address',$company->web_address??null) }}" required="required">
            </div>
        </div> 


         <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
                <label>Registration date<span class="required">*</span></label>
                <input type="date" class="form-control" name="reg_date" placeholder="Registration date.." value="{{ old('reg_date',$company->reg_date??null) }}" required="required">
            </div>
        </div>      


  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12"> 
            	<label>Address<span class="required">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="Address.." value="{{ old('address',$company->address??null) }}" required="required">
            </div>
        </div>		

  		
        @if($form_type =='edit')
  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>Active Status</label>
                <select class="form-control select2" name="active_status" style="width: 100%;" >
                	@if($company->valid == 1)
                		<option value="0">Inactive</option>
                		<option value="1" selected>Active</option>
                	@else
                		<option value="0" selected>Inactive</option>
                		<option value="1">Active</option>
                	@endif
                	
                </select>
            </div>
        </div>
        @endif
	</div>
</div>
<div class="box-footer">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="input-group col-lg-6 col-md-6 col-xs-12">      	
			<!-- <button type="submit" class="btn btn-success pull-right btn-flat">Submit</button> -->
              <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">
		</div>
	</div>		        
</div>	