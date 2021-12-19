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
            	<label>Customer</label>
                <select class="form-control" name="client_information_id" id="client_information_id" style="width: 100%;">
                    @if ($form_type === 'edit')
                        <option value="{{ $money_receipt->client_information_id }}">{{ $money_receipt->client_name }}</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Receipt Type</label>
                <select class="form-control" name="receipt_type" style="width: 100%;">
                    <option {{ $form_type === 'edit' ? ($money_receipt->receipt_type === 'Cash' ? 'selected' : null) : null }}>
                        Cash
                    </option>
                    <option {{ $form_type === 'edit' ? ($money_receipt->receipt_type === 'Bank' ? 'selected' : null) : null }}>
                        Bank
                    </option>
                </select>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Date</label>
                <input type="date" class="form-control" name="date" value="{{ old('date', $form_type === 'edit' ? $money_receipt->date : date('Y-m-d')) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Amount</label>
                <input type="number" step="any" class="form-control" name="amount" placeholder="Amount.." value="{{ old('amount', $money_receipt->amount ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
                <label>Charge For</label>
                <textarea class="form-control" name="charge_for" placeholder="Charge For..">{{ old('charge_for', $money_receipt->charge_for ?? null) }}</textarea>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Bank Name</label>
                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name.." value="{{ old('bank_name', $money_receipt->bank_name ?? null) }}">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="input-group col-md-6">
            	<label>Check No</label>
                <input type="text" class="form-control" name="check_no" placeholder="Check No.." value="{{ old('check_no', $money_receipt->check_no ?? null) }}">
            </div>
        </div>
	</div>
</div>

<div class="box-footer">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="input-group col-lg-6 col-md-6 col-xs-12">
            <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">
		</div>
	</div>
</div>

@section('script')
    <script>
        $(document).ready(() => {
            $("#client_information_id").select2({
                placeholder: 'Search Customer',
                width: '100%',
                allowClear: true,
                ajax: {
                    dataType: 'json',
                    url: "{{ url('customer_name_list') }}",
                    delay: 100,
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data
                        };
                    },
                },
            });
        })
    </script>
@endsection

