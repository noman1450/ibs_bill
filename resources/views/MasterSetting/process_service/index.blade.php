@extends('layouts.main')

@section('style')
    <style>
        .ck-editor__editable {min-height: 150px;}
        /* .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline p {
            margin: 0;
        } */
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
                    <select class="form-control monthchange" id="year" name="year" style="width: 100%;">
                        <option>{{ date('Y', strtotime('-1 year')) }}</option>
                        <option selected>{{ date('Y') }}</option>
                        <option>{{ date('Y', strtotime('+1 year')) }}</option>
                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control monthchange" id="month" name="month" style="width: 100%;">
                        <option disabled selected>-- Select Month --</option>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}" {{ date('F', strtotime('-1 month')) === $month->name ? 'selected' : null }}>{{ $month->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="client_information_id" style="width: 100%;">
                    </select>
                </div>

                <div class="col-md-4 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <input type="button" id="Process" value="Process" class="btn-sm btn-success btn-flat btn" style="margin-right: 15px; padding: 7px 10px;">

                    <span id="successMsg"></span>
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Send Mail Configuration</h3>
                </div>

                <form action="{{ url("process_service/send_mail") }}" method="post">

                    @csrf

                    <div class="modal-body" id="modal_body">
                        <input type="hidden" name="maintenace_bill_id" id="master_id">

                        <div class="form-group">
                            <label>From Email</label>
                            <input type="email" class="form-control" id="from_email" name="from_email" value="" placeholder="from_email">
                        </div>

                        <div class="form-group">
                            <label>Sender Name</label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name" value="I-infotech Business Solution">
                        </div>

                        <div class="form-group">
                            <label>To</label>
                            <input type="email" class="form-control" id="to_email" name="to_email" value="" placeholder="to_email">
                        </div>

                        <div class="form-group">
                            <label>CC</label>
                            <select class="form-control tagable" id="cc_email" name="cc_email[]" multiple="multiple" style="width: 100%">
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject.." value="{{ date('M') }}">
                        </div>

                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" id="editor" name="body" rows="5" placeholder="Email Body.."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Send Mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script> --}}

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(document).ready(function($) {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [
                        'heading','bold', 'italic', 'link', 'blockQuote',
                        'alignment', 'selectAll', 'fontBackgroundColor',
                        'fontColor', 'fontSize', 'numberedList', 'bulletedList',
                        'imageUpload', 'undo', 'redo', 'highlight', 'horizontalLine'
                    ]

                }).then(editor => {
                    window.editor = editor;
                    editor.ui.view.editable.element.style.height = '150px';
                    editor.setData(`<p>Dear Sir,</p>
<p>Here is the attached Software Maintenance due bill. Please pay as soon as possible.</p>

<p>--</p>
<line>Regards,</line> <br/>
<line><strong>Abdullah Al Noman</strong></line> <br/>
<line><strong>Co-Founder,</strong></line> <br/>
<line><strong><a href="https://i-infotechsolution.com/">i-infotech Business Solution</a></strong></line> <br/>
<line>House:126,Road-01,Avenue-3 , Mirpur-DOHS, Dhaka-1216</line> <br/>
<line><strong>Cell: +88 01722565045</strong></line>
                    `);
                }).catch(err => {
                    console.error(err.stack);
                });


            $('#Process').click(function(e) {
                e.preventDefault()

                $.post("{{ url('/process_service') }}", {
                    year: $('#year').val(),
                    month: $('#month').val(),
                    client_information_id: $('#client_information_id').val(),
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

            $(".monthchange").change(function(e) {
                e.preventDefault();

                load_table()
            });

            $("#client_information_id").change(function(e) {
                e.preventDefault()

                load_table()
            })

            function load_table() {
                var table = $('#designation_list_table').DataTable({
                    destroy:      true,
                    responsive:   true,
                    processing:   true,
                    serverSide:   true,
                    paging:       false,
                    lengthChange: false,
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
                            query.client_information_id = $("#client_information_id").val()
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
                                    + '<a href="#" data-master_id="'+full.id+'" data-to_information="'+full.to_information+'" data-from_information="'+full.from_information+'" data-cc_email="'+full.cc_email+'" class="btn showme btn-primary btn-sm btn-block"><i class="fa fa-send"></i> Mail ('+full.mail_count+')</a>'
                                    + '<a href="{{ url("process_service_delete") }}/'+full.id+'/delete" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i> Delete</a>';
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

            $('#designation_list_table').on('click', '.showme', function(e) {
                e.preventDefault()

                $('#master_id').val($(this).data('master_id'));
                $('#from_email').val($(this).data('from_information'));
                $('#to_email').val($(this).data('to_information'));
                // $('#cc_email').val($(this).data('cc_email'));
                $('#subject').val($('#month option:selected').text() +' - '+ $('#year').val())

                if ($(this).data('cc_email') != null) {
                    let arr = $(this).data('cc_email').split(',')
                    $('#cc_email').select2({
                        data: [...arr],
                        tags: true
                    });
                    $('#cc_email').val([...arr]).trigger('change')
                }

                $('#exampleModal').modal('show');
            });

            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#master_id').val("");
                $('#from_email').val("");
                $('#to_email').val("");
                $('#cc_email').val("");
                $('#subject').val("")
            })
        });
    </script>
@endsection
