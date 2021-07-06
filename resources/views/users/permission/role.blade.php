   

@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection

@section('content')
   <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Role List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          
          </div>

        </div>

        <div class="box-body">
          <div class="row">
              <div class="box-body">
              <div class="form-group">
               @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              </div>               


                <div class="box-header with-border">
                  <button type="button" class="col-lg-3 col-md-3 col-xs-3 btn btn-success center-block btn-flat" data-toggle="modal" data-target="#modal_material_type" data-whatever="@mdo" style="width: 14%;">Add Role</button>
                </div>                

                <div class="col-xs-10" style="padding-bottom: 10px;">
                  <table id="list_table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                     
                      <th style="width:20%;">Role Name</th>
                      <th style="width:20%;">Display Name</th>
                      <th style="width:20%;">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>                


                <!-- Modal for Material Type -->
                <div class="modal fade" id="modal_material_type" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                         
                        {!! Form::open(['method'=>'POST', 'action'=>['User\RoleController@role_store'],'onkeypress'=> "return event.keyCode != 13;", 'id'=>'modal_frm_data']) !!} 

                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="groupAddLabel">Add/Update Role Inforation</h4>
                              </div><!--modal-header-->
                              
                              <div class="modal-body" style="padding: 0px;">
                                  <div class="col-lg-12 entry_panel_body ">
                                      <input type="hidden" class="form-control "  id="id" name="id" />
                                  </div>
                              </div>

                                <div class="modal-body" style="padding: 0px;">
                                  <div class="col-lg-12 entry_panel_body ">
                                      <input type="text" class="form-control "  id="name" name="name" placeholder="Role Name" style="width: 100%; margin-left: 5px; margin-top: 10px; margin-bottom: 10px;" required/>
                                  </div>
                              </div>

                               <div class="modal-body" style="padding: 0px;">
                                  <div class="col-lg-12 entry_panel_body ">
                                      <input type="text" class="form-control "  id="display_name" name="display_name" placeholder="Display Name" style="width: 100%; margin-left: 5px; margin-top: 10px; margin-bottom: 10px;" required/>
                                  </div>
                              </div>

                        <!--        <div class="modal-body" style="padding: 0px;">
                                  <div class="col-lg-12 entry_panel_body ">
                                      <input type="text" class="form-control "  id="description" name="description" placeholder="Description" style="width: 100%; margin-left: 5px; margin-top: 10px; margin-bottom: 10px;" required/>
                                  </div>
                              </div> -->

                              <div class="modal-footer">
                               
                                <button type="button" class="btn btn-default closeId" data-dismiss="modal">Close</button>

                                 <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit">
                              </div><!--modal-footer-->
                         
                            {!! Form::close() !!}

                        </div><!--modal-content-->
                    </div><!--modal-dialog-->
                </div><!--modal-->
                <!--End Modal for Material Type -->


              </div>
          </div>
        </div>
        

      <div>
    </section>

@endsection
@section('script')
<script src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/fileinput.js')}}"></script>

<script>

$(document).ready(function($) {
      $.ajax({
          type:   'POST',
          url :   "{{URL::to('/')}}/role_list",
          headers:{
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
            dataType: 'json',
            success: function(data) {
              var dataSet = data.data;
              table = $('#list_table').DataTable( {
              destroy:    true,
              paging:     false,
              searching:  false,
              ordering:   true,
              bInfo:      false,
              "data":     dataSet,
              "columns": [

              { "data": "name" },                     
              { "data": "guard_name" },                     
              // { "data": "Link",
              //   "mRender": function (data, type, full) {
              //       return '<a href="{{URL::to('/')}}/role/'+full.id+'/edit" data-toggle="modal" data-target="#modal_material_type" data-whatever="@mdo" style="width: 14%;"> <span class="glyphicon glyphicon-edit"></span> Edit</a>';

                     
              //   }
              // },


      { "data": "Link",
                  "mRender": function (data, type, full) {
                  return '<a  data-id="'+full.id+'" data-name="'+full.name+'" data-display_name="'+full.guard_name+'"  class="btn btn-primary btn-flat btn-sm showme"> <span class="glyphicon glyphicon-edit">Edit</a>';            
                  }
                 },

            ],
            "order": [[0,'asc']]
          });
      }
      });



       $('#list_table').on('click', '.showme', function(e){
             $('#id').val($(this).data('id'));
             $('#name').val($(this).data('name'));
             $('#display_name').val($(this).data('display_name'));
             $('#modal_material_type').modal('show');
         });

       $('#modal_material_type').on('hidden.bs.modal', function () {
        location.reload();
       })
});




</script>
@endsection









