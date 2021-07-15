<?php $__env->startSection('style'); ?>
<style type="text/css">
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	    padding: 5px;
	}
	table.dataTable thead > tr > th {
	    padding-right: 25px;
	}
	.table>tbody{
		font-size: small;
	}
	.table>thead{
		font-size: smaller;
        background-color: #fff;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="box box-default">
    <form method="post" action="<?php echo e(url('collectduesubmit')); ?>" onkeypress="return event.keyCode != 13;" id="all_frm_data">
        <?php echo e(csrf_field()); ?>

	    <div class="box-header with-border noprint">
		    <h3 class="box-title" style="margin-left:10px;">Customer List Information</h3>

            <div class="row" style="margin-left:10px;">
                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="customer" name="customer" style="width: 100%;"></select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <input type="button" id="search" value="Search" class=" btn-sm block btn-flat btn" style="margin-right: 15px; padding: 7px 10px;background-color: #EEEEEE; color: black; border:1px solid gray;">
                </div>
            </div>

		    <div class="box-tools pull-right">
			    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		    </div>
	    </div>

	    <div class="box-body">
		    <div class="row">
			    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                    <table id="designation_list_table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    <input name="select_all noprint" value="1" id="example-select-all" type="checkbox" />
                                </th>
                                <th style="width: 25%">Customer Name</th>
                                <th style="width: 25%">Month</th>
                                <th style="width: 25%">Amount</th>
                                <th style="width: 20%">Software Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
			    </div>

                <div>
                    <button type="submit" class="btn btn-success btn-flat pull-right" name="submit_btn" value="collect" id="btnSubmit" style="margin-right: 10px;">Collection</button>

                    <button type="submit" class="btn btn-info btn-flat pull-right" name="submit_btn" value="print" id="btnPrint" style="margin-right: 10px;">Print Preview</button>
                </div>

		    </div>
	    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

$(document).ready(function($) {

    $employee = $('#customer').select2({
        placeholder: 'Enter an Client Name',
        allowClear: true,
        ajax: {
            dataType: 'json',
            url: "<?php echo e(URL::to('/')); ?>/customer_name_list",
            delay: 250,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        }
    });

    $("#search").click(function() {
        $.ajax({
            type:   'GET',
            url :   "<?php echo e(URL::to('/')); ?>/client_information_data_list",
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            data:  {
                customer : $("#customer").val(),
            },
            dataType: 'json',
            success: function(data) {
                var dataSet = data.data;
                table = $('#designation_list_table').DataTable( {
                    destroy:    true,
                    paging:     false,
                    searching:  true,
                    ordering:   true,
                    bInfo:      true,
                    "data":     dataSet,
                    "columns": [
                        { "data": "checkbox",
                            "mRender": function (data, type, full) {
                                return '<input type="checkbox" name="service_conf_ids[]" value="'+full.id+'">';
                            }
                        },
                        { "data": "customer" },
                        { "data": "month_name" },
                        { "data": "collect_amount" },
                        { "data": "software_name" },
                    ],
                    order: [ 1, 'asc' ]
                });
            }
        });
    })


    $('#example-select-all').on('click', function(){
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#designation_list_table tbody').on('change', 'input[type="checkbox"]', function() {
        if(!this.checked) {
            var el = $('#example-select-all').get(0);
            if(el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

    // $(document).on('submit', '#all_frm_data', function(event) {
    //     event.preventDefault();

    //     $("#btnSubmit").attr("disabled", true);
    //     $("#btnSubmit").text('Please wait..');

    //     var form = new FormData($('#all_frm_data').get(0));

    //     var url = $('#all_frm_data').attr( "action" );

    //     var token = $("[name='_token']").val();

    //     $.ajax({
    //         type  : 'POST', // define the type of HTTP verb we want to use (POST for our form)
    //         url : url, // the url where we want to POST
    //         data : form,
    //         dataType : 'json', // what type of data do we expect back from the server
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         _token : token
    //     })
    //     .done(function(data) {
    //         if(data['success']) {
    //             $('#btnSubmit').attr("disabled", false);
    //             $("#btnSubmit").text('Submit');

    //             toastr.success(data.messages)



    //             setTimeout(function () {
    //                 window.location.reload();
    //             }, 3000)

    //         } else {
    //             toastr.error(data.messages);

    //             $('#btnSubmit').attr("disabled", false);
    //             $("#btnSubmit").text('Submit');
    //         }
    //     });
    // })
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/MasterSetting/duecollection/duecollection.blade.php ENDPATH**/ ?>