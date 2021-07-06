@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" id="modalButton_0" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalBody_0" onClick="createNewModal(this)">
  Launch demo modal
</button>

<div id="dialogs">
 <div class="dialog-tmpl">
  <div class="dialog-body"></div>
 </div>
</div>


<script type="text/javascript">
</script>


@endsection
