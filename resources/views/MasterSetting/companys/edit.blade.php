@extends('layouts.main')

@section('styles')
@endsection

@section('content')
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Company Information</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
        <form method="POST" action="{{ route('companys.update',$company->id) }}" onkeypress = "return event.keyCode != 13;" id="frm_data">
        	@method('PATCH')
        	@php $form_type='edit' @endphp
    		@include('MasterSetting/companys/_form')
        </form>		
	</div>		
</section>
@endsection
			            

@section('script')
@endsection