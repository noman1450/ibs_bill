@extends('layouts.main')

@section('styles')
    <style>
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
@endsection


@section('content')
    <div class="box box-default">
        <div class="box-header with-border">

            @if (session('message'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-success" alert-dismissible>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <h3 class="box-title">Process Service</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>

            <div class="row" style="margin-left:10px; ">

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="year" name="year" style="width: 100%;">
                        <option>{{ date('Y', strtotime('-1 year')) }}</option>
                        <option selected>{{ date('Y') }}</option>
                        <option>{{ date('Y', strtotime('+1 year')) }}</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="month" name="month" style="width: 100%;">
                        <option disabled selected>-- Select Month --</option>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}" {{ date('F', strtotime('-1 month')) === $month->name ? 'selected' : null }}>{{ $month->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <input type="button" id="Process" value="Process" class="btn-sm btn-success btn-flat btn" style="margin-right: 15px; padding: 7px 10px;">

                    <span id="successMsg"></span>
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                    <table id="designation_list_table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 8%">BillNo</th>
                                <th style="width: 8%">BillDate</th>
                                <th style="width: 10%">MonthYear</th>
                                <th style="width: 10%">CustomerName</th>
                                <th style="width: 10%">SendTo</th>
                                <th style="width: 10%">FromEmail</th>
                                <th style="width: 10%">ToEmail</th>
                                <th style="width: 14%">CC-Email</th>
                                <th style="width: 5%">Amount</th>
                                <th style="width: 15%">SoftwareName</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(document).ready(function($) {
            $('#Process').click(function(e) {
                e.preventDefault()

                $.post("{{ url('/process_service') }}", {
                    year: $('#year').val(),
                    month: $('#month').val()
                }).then((data) => {
                    console.log(data);
                    $('#successMsg').css({
                        'display': 'inline-block',
                        'font-weight': 'bold'
                    }).text(data.message)

                    setTimeout(() => {
                        $('#successMsg').css({
                            'display': 'none'
                        })
                    }, 2000);

                    load_table()
                })
            })

            $("#month").change(function(e) {
                e.preventDefault();

                load_table()
            });

            function load_table() {
                var table = $('#designation_list_table').DataTable({
                    destroy:      true,
                    responsive:   true,
                    processing:   true,
                    serverSide:   true,
                    paging:       true,
                    lengthChange: true,
                    searching:    true,
                    ordering:     true,
                    info:         true,
                    autoWidth:    false,
                    width:        "100%",
                    // rowsGroup:    [0],

                    ajax: {
                        url: "{{ url('/get-process_service-data') }}",
                        type: "POST",
                        dataType: "json",
                        data: function (query) {
                            query.year_id = $("#year").val()
                            query.month_id = $("#month").val()
                        }
                    },

                    columns: [
                        { data: "bill_no" },
                        { data: "created_at" },
                        { data: "month_year" },
                        { data: "customer" },
                        { data: "send_to" },
                        { data: "from_information" },
                        { data: "to_information" },
                        { data: "cc_email" },
                        { data: "amount" },
                        { data: "software_name" },
                        { data: 'Link',
                            mRender: function (data, type, full) {
                                return '<a target="_blank" href="{{ url("process_service") }}/'+full.maintenace_bill_ledger_id+'/edit" class="btn btn-success btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>'
                                    + '<a target="_blank" href="{{ url("view_process_service") }}/'+full.id+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye"></i> View</a>'
                                    + '<a href="{{ url("process_service/send_mail") }}/'+full.id+'" class="btn btn-primary btn-sm btn-block"><i class="fa fa-send"></i> Mail ('+full.mail_count+')</a>';
                            },
                            orderable: false, searchable: false
                        }
                    ],
                    // order: [ 1, 'asc' ]
                });

                $('#example-select-all').on('click', function() {
                    var rows = table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });

                $('#designation_list_table tbody').on('change', 'input[type="checkbox"]', function() {
                    if (!this.checked) {
                        var el = $('#example-select-all').get(0);
                        if(el && el.checked && ('indeterminate' in el)){
                            el.indeterminate = true;
                        }
                    }
                });
            }

            load_table()


            $("#client_information_id").select2({
                placeholder: 'Search Customer',
                width: '100%',
                allowClear: true,
                ajax: {
                    dataType: 'json',
                    url: "{{ url('customer_name_list') }}",
                    delay: 100,
                    data: function(params) {
                        return {
                            term: params.term
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data
                        };
                    },
                },
            });

            // $( "#all_frm_data" ).submit(function(event){
            //     event.preventDefault();
            //     $("#btnSubmit").attr("disabled", true);
            //     $("#btnSubmit").val('Please wait..');
            //     var $form   = $( this ),

            //     url = $form.attr( "action" );
            //     token = $("[name='_token']").val();
            //     $.ajax({
            //         type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            //         url         : url, // the url where we want to POST
            //         data        : $form.serialize(),
            //         dataType    : 'json', // what type of data do we expect back from the server
            //         encode      : true,
            //         _token      : token
            //     })
            //         .done(function(response) {
            //             if (response['success']) {
            //                 $('#btnSubmit').attr("disabled", false);
            //                 $("#btnSubmit").val('Submit');

            //                 toastr.success(response.messages)
            //                 var audio = new Audio("{{ asset('/audio/audio_file.mp3') }}");
            //                 audio.play();
            //                 window.setTimeout(function () {
            //                     window.location.reload();
            //                 }, 3000)
            //             } else {
            //                 toastr.error(response.messages);
            //                 var audio = new Audio("{{ asset('/audio/audio_file1.mp3') }}");
            //                 audio.play();
            //                 $('#btnSubmit').attr("disabled", false);
            //                 $("#btnSubmit").val('Submit');
            //             }
            //         });
            // })
        });
    </script>
@endsection
