@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatables/select2.min.css')}}" />
@endsection

@section('content')


<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Service Confiq</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>


        <form method="POST" action="{{ route('services.update',$service->id) }}" onkeypress = "return event.keyCode != 13;">
        	@method('PATCH')
        	@php $form_type='edit' @endphp
    		@include('MasterSetting.service._form')
        </form>
	</div>
</section>




@endsection


@section('script')
<script src="{{asset('plugins/datatables/select2.min.js')}}"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script> -->





@endsection

