@csrf

<div class="box-body">

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
            	<label>Bill No <span class="required">*</span></label>
                <input type="text" class="form-control" name="bill_no" placeholder="Bill Number.." value="{{ old('bill_no', $maintenance->bill_no ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Bill Date <span class="required">*</span></label>
                <input type="date" class="form-control" name="created_at" value="{{ old('created_at', date('Y-m-d', strtotime($maintenance->created_at)) ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Send To <span class="required">*</span></label>
                <input type="text" class="form-control" name="send_to" placeholder="Send To.." value="{{ old('send_to', $maintenance->send_to ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Software Name <span class="required">*</span></label>
                <input type="text" class="form-control" name="software_name" placeholder="Software Name.." value="{{ old('software_name', $maintenanceLedger->software_name ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Amount <span class="required">*</span></label>
                <input type="number" step="any" class="form-control" name="payableamount" placeholder="Amount.." value="{{ old('payableamount', $maintenanceLedger->payableamount ?? null) }}">
            </div>
        </div>
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
