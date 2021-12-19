@extends('layouts.main')


@section('content')
<section class="content">
	<div id="alert-danger"></div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Create Money Receipt</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>

		<form method="post" action="{{ route('money_receipt.store') }}" onkeypress="return event.keyCode != 13;">
			@php $form_type ='create' @endphp
			@include('MasterSetting.money_receipt._form')
        </form>

	</div>
</section>
@endsection
