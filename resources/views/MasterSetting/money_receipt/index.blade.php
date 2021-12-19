@extends('layouts.main')

@section('style')
<style>
    table.table tbody td {
        word-break: break-word !important;
    }
</style>
@endsection



@section('content')
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Money Receipt List</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
		        <div class="form-group col-lg-12 col-md-12 col-xs-12">
		            <a href="{{ URL::to('money_receipt/create')}}"><input type="button" value="Create New" class="btn-success btn btn-sm button btn-flat pull-left" style="font-size: 12px; font-weight: bold;"></a>
		        </div>
			</div>

			<div class="row">
				<div class="form-group col-lg-12 col-md-12 col-xs-12">
	              	<table id="money_receipt-table" class="table table-bordered table-hover">
		                <thead>
			                <tr>
			                  	<th style="width: 10%">ReceiptNo</th>
			                  	<th style="width: 10%">ReceiptType</th>
			                  	<th style="width: 10%">CustomerName</th>
			                  	<th style="width: 15%">ChargeFor</th>
			                  	<th style="width: 10%">Amount</th>
			                  	<th style="width: 10%">Date</th>
			                  	<th style="width: 10%">BankName</th>
			                  	<th style="width: 15%">CheckNo</th>
			                  	<th style="width: 10%">Action</th>
			                </tr>
		                </thead>
		                <tbody>
		                </tbody>
	              	</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection





@section('script')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>


<script>

	$(document).ready(function() {
	  	$('#money_receipt-table').DataTable( {
		    "processing":   true,
		    "serverSide":   true,
		    "paging":       true,
		    "lengthChange": true,
		    "searching":    true,
		    "ordering":     true,
		    "info":         true,
		    "autoWidth":    false,
			"ajax": {
				"url": 		"{{ url('/get-money_receipt-data') }}",
				"type": 	"GET",
		        "dataType": "json",
			},
		    "columns": [
				{ "data": "receipt_no" },
				{ "data": "receipt_type" },
				{ "data": "client_name" },
				{ "data": "charge_for" },
				{ "data": "amount" },
				{ "data": "date" },
				{ "data": "bank_name" },
				{ "data": "check_no" },
				{ "data": "Link", orderable: false, searchable: false}
		    ],
		    "order": [[0, 'asc']]
	  	});
	});
</script>
@endsection
