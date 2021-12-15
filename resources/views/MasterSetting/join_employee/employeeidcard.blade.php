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
        {{-- <form method="post" action="{{ url('submitemployeeidcardpost') }}" onkeypress="return event.keyCode != 13;"> --}}
            @csrf

            <div class="box-header with-border">
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
                                <option value="{{ $month->id }}">{{ $month->name }}</option>
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
                                    <th style="width: 10%">BillNo</th>
                                    <th style="width: 10%">BillDate</th>
                                    <th style="width: 10%">MonthYear</th>
                                    <th style="width: 10%">CustomerName</th>
                                    <th style="width: 10%">SendTo</th>
                                    <th style="width: 10%">FromInformation</th>
                                    <th style="width: 10%">ToInformation</th>
                                    <th style="width: 5%">Amount</th>
                                    <th style="width: 15%">SoftwareName</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    {{-- <input type="submit" class="btn btn-success btn-flat pull-right" value="Multiple Print" id="btnSubmit" style="margin-right: 10px;"> --}}
                </div>
            </div>
        {{-- </form> --}}
    </div>
@endsection

@section('script')
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
                        { data: "amount" },
                        { data: "software_name" },
                        { data: 'Link',
                            mRender: function (data, type, full) {
                                return '<a target="_blank" href="{{ url("process_service") }}/'+full.maintenace_bill_ledger_id+'/edit" class="btn btn-success btn-sm btn-block"><i class="fa fa-edit"></i> Edit</a>'
                                    + '<a target="_blank" href="{{ url("view_process_service") }}/'+full.id+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye"></i> View</a>';
                            },
                            orderable: false, searchable: false
                        }
                    ],
                    order: [ 1, 'asc' ]
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
