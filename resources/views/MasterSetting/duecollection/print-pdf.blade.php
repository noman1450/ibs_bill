@extends('layouts.main')

@section('content')
<div class="box box-default">
    <div class="box-body">
        <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-xs-12">
                <table id="designation_list_table" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 25%">Customer Name</th>
                            <th style="width: 25%">Month</th>
                            <th style="width: 25%">Amount</th>
                            <th style="width: 20%">Software Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection as $item)
                            @php $rj = $item->client_name @endphp
                            <tr>
                                @if($rj !== $reserve)
                                    <td rowspan="{{ $loop->index }}" style="vertical-align:middle; text-align:center;text-transform:capitalize">
                                        <strong>{{ $item->client_name }}</strong>
                                    </td>
                                    @php $reserve = $item->client_name @endphp
                                @endif
                                <td>{{ $item->month_name }}</td>
                                <td>{{ $item->collect_amount }}</td>
                                <td>{{ $item->software_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="noprint">
                <button type="button" class="btn btn-info btn-flat pull-right" id="btnPrint" onclick="print()" style="margin-right: 10px;">Print</button>
            </div>
        </div>
    </div>
</div>
@endsection
