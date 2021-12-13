@extends('layouts.main')

@section('styles')
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
@endsection


@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Process Service List</h3>

            {{-- <div class="row" style="margin-left:10px;">

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="year" name="year" style="width: 100%;">
                        <option>{{ date('Y', strtotime('-1 year')) }}</option>
                        <option selected>{{ date('Y') }}</option>
                        <option>{{ date('Y', strtotime('+1 year')) }}</option>
                    </select>
                </div> --}}

                {{-- <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control select2" id="month" name="month" multiple style="width: 100%;">
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}">{{ $month->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <select class="form-control" id="client_information_id" name="client_information_id" style="width: 100%;">

                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-xs-12 form-group" style="padding-left: 0px; padding-top: 10px;">
                    <input type="button" id="search" value="Search" class="btn-sm btn-primary btn-flat btn" style="margin-right: 15px; padding: 7px 10px;">
                </div>
            </div> --}}

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
                                {{-- <th  style="width: 3%">
                                    <input name="select_all" value="1" id="example-select-all" type="checkbox" />
                                </th> --}}
                                <th style="width: 20%">Customer Name</th>
                                <th style="width: 20%">Send To</th>
                                <th style="width: 15%">From Information</th>
                                <th style="width: 15%">To Information</th>
                                <th style="width: 15%">Amount</th>
                                <th style="width: 15%">Software Name</th>
                                {{-- <th></th> --}}
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
    <script>
        (function() {
            // e.preventDefault();

            $.ajax({
                type: "post",
                url : "{{ url('/get-process_service_view-data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // data: {
                //     year_id : $("#year").val(),
                //     month_id : $("#month").val(),
                //     client_information_id : $("#client_information_id").val(),
                // },
                dataType: 'json',
                success: function(data) {
                    var dataSet = data.data;
                    table = $('#designation_list_table').DataTable({
                        destroy:    true,
                        paging:     false,
                        searching:  true,
                        ordering:   true,
                        bInfo:      true,
                        data:     dataSet,
                        columns: [
                            // { data: "checkbox",
                            //     mRender: function (data, type, full) {
                            //         return '<input type="checkbox" name="ids[]" value="'+full.id+'">';
                            //     },
                            //     orderable: false, searchable: false
                            // },
                            { data: "customer" },
                            { data: "send_to" },
                            { data: "from_information" },
                            { data: "to_information" },
                            { data: "amount" },
                            { data: "software_name" },
                            // { data: 'Link',
                            //     mRender: function (data, type, full) {
                            //         return '<a target="_blank" href="{{ url("view_employee_id_card") }}/'+full.id+'?year='+$("#year").val()+'&month='+$("#month").val()+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye"></i> View</a>'
                            //             // + '<a href="{{ url("submitemployeeidcard") }}/'+full.id+'?year='+$("#year").val()+'&month='+$("#month").val()+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-print"></i> Print</a>';
                            //     },
                            //     orderable: false, searchable: false
                            // }
                        ],
                        order: [ 1, 'asc' ]
                    });
                }
            });
        })();


        $(document).ready(function($) {
            $('.select2').select2({
                placeholder: 'Select months'
            })

            $("#search").click(function(e) {
                e.preventDefault();

                $.ajax({
                    type:   'POST',
                    url :   "{{URL::to('/')}}/employeeidcardlistdata",
                    headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:   {
                        year_id : $("#year").val(),
                        month_id : $("#month").val(),
                        client_information_id : $("#client_information_id").val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        var dataSet = data.data;
                        table = $('#designation_list_table').DataTable({
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
                                    },
                                    orderable: false, searchable: false
                                },
                                { data: "customer" },
                                { data: "send_to" },
                                { data: "from_information" },
                                { data: "to_information" },
                                { data: "amount" },
                                { data: "software_name" },
                                { data: 'Link',
                                    mRender: function (data, type, full) {
                                        return '<a target="_blank" href="{{ url("view_employee_id_card") }}/'+full.id+'?year='+$("#year").val()+'&month='+$("#month").val()+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye"></i> View</a>'
                                            // + '<a href="{{ url("submitemployeeidcard") }}/'+full.id+'?year='+$("#year").val()+'&month='+$("#month").val()+'" class="btn btn-info btn-sm btn-block"><i class="fa fa-print"></i> Print</a>';
                                    },
                                    orderable: false, searchable: false
                                }
                            ],
                            order: [ 1, 'asc' ]
                        });
                    }
                });
            });



            // $('#example-select-all').on('click', function(){
            //     var rows = table.rows({ 'search': 'applied' }).nodes();
            //     $('input[type="checkbox"]', rows).prop('checked', this.checked);
            // });

            // $('#designation_list_table tbody').on('change', 'input[type="checkbox"]', function(){
            //     if (!this.checked) {
            //         var el = $('#example-select-all').get(0);
            //         if(el && el.checked && ('indeterminate' in el)){
            //             el.indeterminate = true;
            //         }
            //     }
            // });


            // $("#client_information_id").select2({
            //     placeholder: 'Search Customer',
            //     width: '100%',
            //     allowClear: true,
            //     ajax: {
            //         dataType: 'json',
            //         url: "{{ url('customer_name_list') }}",
            //         delay: 100,
            //         data: function(params) {
            //             return {
            //                 term: params.term
            //             }
            //         },
            //         processResults: function (data, params) {
            //             params.page = params.page || 1;
            //             return {
            //                 results: data
            //             };
            //         },
            //     },
            // });
        });
    </script>
@endsection
