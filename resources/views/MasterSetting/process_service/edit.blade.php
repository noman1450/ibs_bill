@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/select2.min.css')}}" />
@endsection

@section('content')
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Process Service</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>


        <form method="post" action="{{ route('process_service.update', $maintenanceLedger->id) }}" onkeypress="return event.keyCode != 13;">
        	@method('PATCH')
        	@php $form_type='edit' @endphp
    		@include('MasterSetting.process_service._form')
        </form>
	</div>
</section>
@endsection


@section('script')
    <script src="{{asset('plugins/datatables/select2.min.js')}}"></script>
@endsection

