@extends('layouts.main')

@section('style')
    <style>
        .ck-editor__editable {min-height: 150px;}
    </style>
@endsection


@section('content')
    <div class="box box-default">
        <form action="{{ url('/process_service_generate') }}" method="post" target="_blank">
            <div class="box-header with-border">
                <h3 class="box-title">Process Service List</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>

                <div class="row" style="margin-left:10px;">

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                        <select class="form-control" id="year" name="year" style="width: 100%;">
                            <option>{{ date('Y', strtotime('-1 year')) }}</option>
                            <option selected>{{ date('Y') }}</option>
                            <option>{{ date('Y', strtotime('+1 year')) }}</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                        <select class="form-control" id="month" name="month" multiple style="width: 100%;">
                            @foreach ($months as $month)
                                <option value="{{ $month->id }}" {{ date('F', strtotime('-1 month')) === $month->name ? 'selected' : null }}>{{ $month->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                        <select class="form-control" id="client_information_id" name="client_information_id" style="width: 100%;">
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    @csrf

                    <input type="hidden" name="client_id" id="client_id">

                    <table id="designation_list_table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th  style="width: 3%">
                                    <input name="select_all" value="1" id="example-select-all" type="checkbox" />
                                </th>
                                <th style="width: 10%">BillNo</th>
                                <th style="width: 10%">BillDate</th>
                                <th style="width: 10%">MonthYear</th>
                                <th style="width: 10%">CustomerName</th>
                                <th style="width: 10%">SendTo</th>
                                <th style="width: 10%">FromEmail</th>
                                <th style="width: 10%">ToEmail</th>
                                <th style="width: 10%">CC-Email</th>
                                <th style="width: 10%">Amount</th>
                                <th style="width: 10%">SoftwareName</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <button type="button" id="smbtBtn" data-toggle="modal" data-target="#exampleModal" class="btn btn-success" style="display: none"><i class="fa fa-envelope"></i> Configure Email</button>
                        <button type="submit" id="viewBtn" name="send_or_view" value="view" class="btn btn-primary" style="display: none">View</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Send Mail Configuration</h3>
                                </div>

                                <div class="modal-body" id="modal_body">
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
                                        <select class="form-control tagable" id="cc_email" name="cc_email[]" multiple style="width: 100%">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject.." value="{{ date('F', strtotime('-1 month')).' - '.date('Y') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Body</label>
                                        <textarea class="form-control" id="editor" name="body" rows="5" placeholder="Email Body..">Lorem, ipsum dolor.</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="send_or_view" value="send" class="btn btn-primary"><i class="fa fa-send"></i> Send Mail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                }).catch( err => {
                    console.error( err.stack );
                });



            $('#month').select2({
                placeholder: 'Select months'
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
                    paging:       false,
                    searching:    true,
                    ordering:     false,
                    info:         true,
                    autoWidth:    false,
                    width:        "100%",
                    ajax: {
                        url: "{{ url('/get-process_service_view-data') }}",
                        type: "POST",
                        dataType: "json",
                        data: function (query) {
                            query.year_id = $("#year").val()
                            query.month_id = $("#month").val()
                            query.client_information_id = $("#client_information_id").val()
                        }
                    },
                    columns: [
                        { data: "checkbox",
                            mRender: function (data, type, full) {
                                return '<input type="checkbox" name="ids[]" value="'+full.maintenace_bill_ledger_id+'">';
                            },
                            orderable: false, searchable: false
                        },
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
                                return '<a target="_blank" href="{{ url("view_process_service") }}/'+full.id+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye"></i> View</a>';
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

            load_table()


            var $clientInfo = $("#client_information_id").select2({
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

            $clientInfo.on('select2:select', (e) => {
                $('#client_id').val(e.params.data.id)

                load_table()

                $('#from_email').val(e.params.data.from_email)
                $('#to_email').val(e.params.data.email)

                if (e.params.data.cc_email != null) {
                    let arr = e.params.data.cc_email.split(',')
                    $('#cc_email').select2({
                        data: [...arr],
                        tags: true
                    });
                    $('#cc_email').val([...arr]).trigger('change')
                }

                $('#smbtBtn').show()
                $('#viewBtn').show()
            })

            $clientInfo.on('select2:unselect', () => {
                $('#client_id').val('')

                load_table()

                $('#from_email').val('')
                $('#to_email').val('')
                $('#cc_email').val('')

                $('#smbtBtn').hide()
                $('#viewBtn').hide()
            })
        });
    </script>
@endsection
