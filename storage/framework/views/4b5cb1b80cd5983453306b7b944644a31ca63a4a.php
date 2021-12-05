<?php $__env->startSection('styles'); ?>
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
            background-color: #C1C2C7;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="box box-default">
        <form  method="POST" action="<?php echo e(url('submitemployeeidcard')); ?>" onkeypress="return event.keyCode != 13;" id="all_frm_data">
            <?php echo e(csrf_field()); ?>

            <div class="box-header with-border">
                <h3 class="box-title">Service Id Card Print</h3>

                <div class="row" style="margin-left:10px; ">

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                        <select class="form-control" id="year" name="year" style="width: 100%;">
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">

                        <select class="form-control" id="month" name="month" style="width: 100%;">
                            <option value="1" >January</option>
                            <option value="2" >February</option>
                            <option value="3" >March</option>
                            <option value="4" >April</option>
                            <option value="5" >May</option>
                            <option value="6" >June</option>
                            <option value="7" >July</option>
                            <option value="8" >August</option>
                            <option value="9" >September</option>
                            <option value="10" >October</option>
                            <option value="11" >November</option>
                            <option value="12" >December</option>
                        </select>
                    </div>


                    <!--
                         <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                             <select class="form-control" id="designation" name="designation" style="width: 100%;" >
                             </select>
                         </div> -->

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                        <input type="button" id="search" value="Search" class="btn-sm btn-primary btn-flat btn" style="margin-right: 15px; padding: 7px 10px;">
                    </div>
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                        <table id="designation_list_table" class="table table-striped table-bordered"    width="100%">
                            <thead >
                            <tr>
                                <th  style="width: 3%"><input name="select_all" value="1" id="example-select-all" type="checkbox" /></th>
                                <th style="width: 20%">Customer Name</th>
                                <th style="width: 20%">Send To</th>
                                <th style="width: 15%">From Information</th>
                                <th style="width: 15%">To Information</th>
                                <th style="width: 15%">Amount</th>
                                <th style="width: 15%">Software Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <input type="submit" class="btn btn-success btn-flat pull-right" value="Submit" id="btnSubmit" style="margin-right: 10px;">
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function($) {
            $("#search").click(function() {
                $.ajax({
                    type:   'POST',
                    url :   "<?php echo e(URL::to('/')); ?>/employeeidcardlistdata",
                    headers:{
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    data:   {
                        year_id : $("#year").val(),
                        month_id : $("#month").val(),
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
                            data:     dataSet,
                            columns: [
                                { data: "checkbox",
                                    mRender: function (data, type, full) {
                                        return '<input type="checkbox" name="ids[]" value="'+full.id+'">';
                                    }
                                },
                                { data: "customer" },
                                { data: "send_to" },
                                { data: "from_information" },
                                { data: "to_information" },
                                { data: "amount" },
                                { data: "software_name" },
                            ],
                            order: [ 1, 'asc' ]
                        });
                    }
                });
            });

            $('#example-select-all').on('click', function(){
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            $('#designation_list_table tbody').on('change', 'input[type="checkbox"]', function(){
                if (!this.checked) {
                    var el = $('#example-select-all').get(0);
                    if(el && el.checked && ('indeterminate' in el)){
                        el.indeterminate = true;
                    }
                }
            });

            $( "#all_frm_data" ).submit(function(event){
                event.preventDefault();
                $("#btnSubmit").attr("disabled", true);
                $("#btnSubmit").val('Please wait..');
                var $form   = $( this ),

                url = $form.attr( "action" );
                token = $("[name='_token']").val();
                $.ajax({
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : url, // the url where we want to POST
                    data        : $form.serialize(),
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode      : true,
                    _token      : token
                })
                    .done(function(response) {
                        if (response['success']) {
                            $('#btnSubmit').attr("disabled", false);
                            $("#btnSubmit").val('Submit');

                            toastr.success(response.messages)
                            var audio = new Audio("<?php echo e(asset('/audio/audio_file.mp3')); ?>");
                            audio.play();
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 3000)
                        } else {
                            toastr.error(response.messages);
                            var audio = new Audio("<?php echo e(asset('/audio/audio_file1.mp3')); ?>");
                            audio.play();
                            $('#btnSubmit').attr("disabled", false);
                            $("#btnSubmit").val('Submit');
                        }
                    });
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/MasterSetting/join_employee/employeeidcard.blade.php ENDPATH**/ ?>