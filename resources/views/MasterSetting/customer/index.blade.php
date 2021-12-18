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
			<h3 class="box-title">Customer Information List</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
		        <div class="form-group col-lg-12 col-md-12 col-xs-12">
		            <a href="{{ URL::to('customer_information/create')}}"><input type="button" value="Create New" class="btn-success btn btn-sm button btn-flat pull-left" style="font-size: 12px; font-weight: bold;"></a>
		        </div>
			</div>

			<div class="row">
				<div class="form-group col-lg-12 col-md-12 col-xs-12">
	              	<table id="customer-table" class="table table-bordered table-hover">
		                <thead>
			                <tr>
			                  	<th style="width: 5%">Code</th>
			                  	<th style="width: 10%">CustomerName</th>
			                  	<th style="width: 10%">FromEmail</th>
			                  	<th style="width: 10%">CustomerEmail</th>
			                  	<th style="width: 25%">CC-Email</th>
			                  	<th style="width: 20%">Address</th>
			                  	<th style="width: 10%">ContactPerson</th>
			                  	<th style="width: 5%">Active</th>
			                  	<th style="width: 5%">Action</th>
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
	  	$('#customer-table').DataTable( {
		    "processing":   true,
		    "serverSide":   true,
		    "paging":       true,
		    "lengthChange": true,
		    "searching":    true,
		    "ordering":     true,
		    "info":         true,
		    "autoWidth":    false,
			"ajax": {
				"url": 		"{{ url('/get-customer_information-data') }}",
				"type": 	"GET",
		        "dataType": "json",
			},
		    "columns": [
				{ "data": "client_code" },
				{ "data": "client_name" },
				{ "data": "from_email" },
				{ "data": "email" },
				{ "data": "cc_email" },
				{ "data": "address" },
				{ "data": "contact_person" },
				{ "data": "activity" },
				{ "data": "Link", orderable: false, searchable: false}
		    ],
		    "order": [[0, 'asc']]
	  	});
	});
</script>
@endsection
