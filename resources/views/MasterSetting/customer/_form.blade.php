@csrf

<div class="box-body">
    <div class="col-lg-12 col-md-12 col-xs-12">
       <div class="col-lg-6 col-md-6 col-xs-12">
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
            <div class="input-group col-md-6">
            	<label>Customer Name <span class="required">*</span></label>
                <input type="text" class="form-control" name="client_name" placeholder="Customer Name.." value="{{ old('client_name', $customer->client_name ?? null) }}" autofocus>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Customer Code</label>
                <input type="text" class="form-control" name="client_code" placeholder="Customer Code.." value="{{ old('client_code', $customer->client_code ?? null) }}">
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>From Email</label>
                <input type="email" class="form-control" name="from_email" placeholder="From Email.." value="{{ old('from_email', $customer->from_email ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Customer Email</label>
                <input type="email" class="form-control" name="email" placeholder="Customer Email.." value="{{ old('email', $customer->email ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
                <label>CC Email</label>
                <select class="form-control" name="cc_email[]" id="cc_email" multiple>
                    @if ($form_type === 'edit')
                        @foreach ($cc_emails as $email)
                            <option selected>{{ $email }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Address <span class="required">*</span></label>
                <input type="text" class="form-control" name="address" placeholder="Address.." value="{{ old('address', $customer->address ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Contact Person</label>
                <input type="text" class="form-control" name="contact_person" placeholder="Contact Person.." value="{{ old('contact_person', $customer->contact_person ?? null) }}">
            </div>
        </div>

        @if($form_type =='edit')
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="input-group col-lg-6 col-md-6 col-xs-12">
                    <label>Active Status</label>
                    <select class="form-control select2" name="active_status" style="width: 100%;">
                        <option value="1" {{ $customer->activity === 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $customer->activity === 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        @endif
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

