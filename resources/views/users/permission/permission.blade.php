    @extends('layouts.main')
    @section('content')

    <section class="content">
        <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">Permission info</h2>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      {!! Form::open(array('route'=>'permission.store', 'onkeypress'=> "return event.keyCode != 13;", 'files'=>true, 'id'=>'frm_data')) !!}
      {{ csrf_field() }}

        
        <div class="box-body">
          
        <div class="row">

          <div class="col-lg-12 col-md-12 col-xs-12">  
              <div class="col-lg-6"> 
                <label>Permission Name</label>
                <input type="text" id="permission_name" name="permission_name" value="{{ old('permission_name') }}" class="form-control" placeholder="Permission Name..">
              </div>
          </div>

          <div class="col-lg-12 col-md-12 col-xs-12">  
              <div class="col-lg-6"> 
                <label>Display Name</label>
                <input type="text" id="display_name" name="display_name" class="form-control" value="{{ old('display_name') }}" placeholder="Display Name..">
              </div>
          </div>


          <div class="col-lg-12 col-md-12 col-xs-12">  
              <div class="col-lg-6">  

                 <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-top: 1.7em;">
               
              </div>
          </div>



          </div> 


          
          <!-- /.box-body -->

        </div>
        </div>
      {!! Form::close() !!}
      <!-- /.box-body -->
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
    </div>
  </section>

  @endsection



  @section('script')
  <script type="text/javascript">

  $("#frm_permission").validate({
   rules: {
    // simple rule, converted to {required:true}
    permission_name: {"required":true, "minlength": 5}
    display_name: {"required":true, "minlength": 5}
    


  },
  messages: {
    permission_name: {"required":"Please specify permission name"}
    display_name: {"required":"Please specify display name", "minlength": "minlength"}
  }
});

  </script>
  @endsection


