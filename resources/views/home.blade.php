@extends('layouts.main')
@section('content')
    <!-- Button trigger modal -->
    <button type="button" id="modalButton_0" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalBody_0" onClick="createNewModal(this)">
        Launch demo modal
    </button>

    <div id="dialogs">
        <div class="dialog-tmpl">
            <div class="dialog-body"></div>
        </div>
    </div>
@endsection
