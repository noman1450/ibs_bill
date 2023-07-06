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
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>Send To<span class="required">*</span></label>
                <input  class="form-control" name="send_to" placeholder="Send To.." value="{{ old('send_to',$service->send_to??null) }}">
            </div>
        </div>



          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>From Information<span class="required">*</span></label>
                <input  class="form-control" name="from_information" placeholder="From information.." value="{{ old('from_information',$service->from_information??null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label>To Information<span class="required">*</span></label>
                <input  class="form-control" name="to_information" placeholder="Email.." value="{{ old('to_information',$service->to_information??null) }}" autofocus="">
            </div>
        </div>

  		<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
            	<label>Software Name<span class="required">*</span></label>
                <input type="text" class="form-control" name="software_name" placeholder="Software name.." value="{{ old('software_name',$service->software_name??null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
              <label>Amount<span class="required">*</span></label>
                <input type="number" class="form-control" name="amount" placeholder="Amount.." value="{{ old('amount',$service->amount??null) }}">
            </div>
        </div>

        <div class="col-xs-12 form-group has-feedback ">
            <div class="input-group col-lg-6 col-md-6 col-xs-12">
                <label control-label">Clients Name</label>
                <select class="form-control" name="client_id" id="client" >
                <option>-- Select Client --</option>
                    @foreach ($clients as $key)
                        <option value={{ $key->id }} {{ $form_type === 'edit' ? ($key->id == $service->client_information_id ? 'selected' : null) : ''}}>{{ $key->client_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3 form-group">
            <label>Vat</label>
            <input type="number" step="any" class="form-control" name="vat" placeholder="Vat.." value="{{ old('vat', $service->vat ?? null) }}">
        </div>

        <div class="col-md-2 form-group">
            <label style="margin-top: 30px">
                <input type="checkbox" name="is_apply_vat" id="is_apply_vat" {{ isset($service) ? ($service->is_apply_vat == 1 ? 'checked' : null) : null }}>
                Is Apply Vat
            </label>
        </div>

        @if($form_type =='edit')
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="input-group col-lg-6 col-md-6 col-xs-12">
                    <label>Active Status</label>
                    <select class="form-control select2" name="active_status" style="width: 100%;" >
                        @if($service->valid == 1)
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
			<!-- <button type="submit" id="btnSubmit" class="btn btn-success pull-right btn-flat">Submit</button> -->
        <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">


		</div>
	</div>
</div>

