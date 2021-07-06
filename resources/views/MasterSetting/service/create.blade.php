@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatables/select2.min.css')}}" />
@endsection

@section('content')
<section class="content">
	<div id="alert-danger"></div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Create Service Confiq</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<form method="POST" action="{{ route('services.store') }}" onkeypress = "return event.keyCode != 13;" id="frm_data">
			@php $form_type ='create' @endphp
			@include('MasterSetting/Service/_form')
		</form>




	</div>		
</section>
@endsection


@section('script')
<script src="{{asset('plugins/datatables/select2.min.js')}}"></script>
@endsection