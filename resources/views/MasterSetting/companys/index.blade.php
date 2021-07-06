@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection


@section('content')
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Company Information List</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
		        <div class="form-group col-lg-12 col-md-12 col-xs-12">
		            <a href="{{ URL::to('companys/create')}}"><input type="button" value="Create New" class="btn-success btn btn-sm button btn-flat pull-left" style="font-size: 12px; font-weight: bold;"></a>
		        </div>				
			</div>

			<div class="row">
				<div class="form-group col-lg-12 col-md-12 col-xs-12">
	              	<table id="branch-table" class="table table-bordered table-hover">
		                <thead>
			                <tr>
			                  	<th>Full Name</th>
			                  	<th>Short Name</th>
			                    <th>Contact No</th>
			                    <th>Email</th>
			                    <th>Address</th>
			                  	<th>Reg Info</th>
			                  	<th>Action</th>
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


<script type="text/javascript">
	$(document).ready(function() {
	  	$('#branch-table').DataTable( {
		    "processing":   true,
		    "serverSide":   true,
		    "paging":       true,
		    "lengthChange": true,
		    "searching":    true,
		    "ordering":     true,
		    "retrieve":     true,
		    "info":         true,
		     "responsive": true,
		      "dom": 'Bfrtip',
			    "buttons": [
			        'copy', 'csv', 'excel', 'pdf', 'print'
			    ],
			"ajax": {
				"url": 		"{{URL::to('/')}}/company",
				"type": 	"GET",
		        "dataType": "json",
			},    
		    "columns": [
				{ "data": "full_name" },
				{ "data": "short_name" },
				{ "data": "contact_number" },
				{ "data": "email" },
				{ "data": "address" },
				{ "data": "reg_date" },
				{ "data": "Link", name: 'link', orderable: false, searchable: false}      
		    ],
		  
      
		    "order": [[0, 'asc']]
	  	});
	});		
</script>
@endsection

