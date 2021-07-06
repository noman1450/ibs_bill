<!-- employee_list -->


<!-- styles -->
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>">

<?php $__env->stopSection(); ?>

<!-- content -->
<?php $__env->startSection('content'); ?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Users List</h3>
	    <div class="col-xs-12" style="padding-left: 0px; padding-top: 10px;">
	        <a href="<?php echo e(URL::to('users/create')); ?>"><input type="button" value="Create New User" class="btn-success btn btn-sm button pull-left btn-flat" style="font-size: 12px; font-weight: bold;"></a>
	    </div>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	

	<div class="box-body">
		<div class="row">
    <div class="col-md-12"> 
	        <div class="form-group col-lg-12 col-md-12 col-xs-12">   	
				<table id="list_table" class="table table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							
							<th style="width: 20%">User Name</th>
              <th style="width: 25%">Email</th>
              <th style="width: 10%">Edit</th>
				      <th style="width: 15%">Reset pwd</th>
	            <th style="width: 10%">Reactive</th>
             
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
    </div>
	</div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>


   <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>




<!-- script -->
<script>
$(document).ready(function($) {
      $.ajax({
        type:   'POST', 
        url :   "<?php echo e(URL::to('/')); ?>/users_list",
        headers:{
                  'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },        
        dataType: 'json',
        success: function(data) {
            var dataSet = data.data;
            table = $('#list_table').DataTable( {
              destroy:    true,
              paging:     true,
              searching:  true,
              ordering:   true,
              bInfo:      true,  
              "data":     dataSet,

            "columns": [
                                             
              { "data": "name" },                     
              { "data": "email" },                     
                            
                    
              { "data": "Link",
                "mRender": function (data, type, full) {
                    return '<a href="<?php echo e(URL::to('/')); ?>/users/'+full.id+'/edit"> <span class="glyphicon glyphicon-edit"></span> Edit</a>';
                }
              },
              { "data": "Link",
                "mRender": function (data, type, full) {
                    return '<a href="<?php echo e(URL::to('/')); ?>/users/'+full.id+'/reset"> <span class="glyphicon glyphicon glyphicon-share-alt"></span>Reset pwd</a>';
                }
              },
               

              // { "data": "Link",
              //   "mRender": function (data, type, full) {
              //       return '<a href="<?php echo e(URL::to('/')); ?>/users/'+full.id+'/cancel"  onclick="return confirm(\'Do you really want to DELETE?\');" class="btn btn-danger btn-sm btn-flat"><span class="glyphicon glyphicon-trash"></span> Delete</a>';
              //   }
              // },

              { "data": "Link",
                "mRender": function (data, type, full) {
                if(full.valid == 1 ){
                  return '<a href="<?php echo e(URL::to('/')); ?>/users/'+full.id+'/cancel"  onclick="return confirm(\'Do you really want to DELETE?\');" class="btn btn-danger btn-sm btn-flat"><span class="glyphicon glyphicon-trash"></span> Delete</a>';
                  
                }else{
                  return '<a href="<?php echo e(URL::to('/')); ?>/users/'+full.id+'/reactive"   class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-share-alt"></span> Reactive</a>';
                }
              }
            },
            ],
            "order": [[0,'asc']]
            });
        }
      }); 
});

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\work\ibs_accounts_mail_version\resources\views/users/users/index.blade.php ENDPATH**/ ?>