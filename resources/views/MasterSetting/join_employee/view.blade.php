@extends('layouts.main')

@section('style')
    <style>
        .brand-logo {
            width: 100%;
            height: auto;
        }

        .font-13px {
            font-size: 13px;
        }
        .footer-img {
            background-size: cover;
            height: 30px;
            text-align: center;
            padding-top: 5px;
            background-image: url('https://i-infotechsolution.com/assets/ibs/background4_1.jpg');
        }
    </style>
@endsection

@section('content')
<section class="content">
	<div id="alert-danger"></div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Invoice for {{ ucwords($data->client_name) ?? '' }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div style="padding: 10px 15px">
                    <div style="border:3px solid #479FD0;padding:0;">
                        <div>
                            <img src="https://i-infotechsolution.com/assets/ibs/background2.jpg" class="brand-logo">
                        </div>

                        <div style="padding: 20px">
                            <div>
                                <p class="font-14px">
                                    Bill No.: <strong>{{ $data->bill_no ?? '22112121' }}</strong>
                                </p>
                                <p class="font-14px">
                                    Bill Date: <strong>{{ date('dS M, Y', strtotime($data->created_at)) }}</strong>
                                </p>
                                <p style="margin-top: 15px">
                                    To
                                </p>
                                <p style="font-weight: 500">
                                    {{ $data->send_to ?? '' }}
                                </p>

                                <p class="client-name">
                                    <strong>
                                        {{ ucwords($data->client_name) ?? '' }}
                                    </strong>
                                </p>

                                <p class="font-14px client-address">
                                    <em>
                                        {{ $data->client_address ?? '' }}
                                    </em>
                                </p>
                            </div>

                            <div style="margin-top: 50px">
                                <div style="width:100%;text-align:center;text-decoration:underline;font-weight:600">Subject Bill</div>
                            </div>

                            <div style="margin-top:20px">
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="text-center font-13px">SL</th>
                                        <th class="text-center font-13px">SOFTWARE NAME</th>
                                        <th class="text-center font-13px">DURATION</th>
                                        <th class="text-center font-13px">AMOUNT TK</th>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td  class="text-center">1</td>
                                            <td  class="text-center">
                                                {{ $data->software_name ?? '' }}
                                            </td>
                                            <td  class="text-center">
                                                {{ $data->month_year }}
                                            </td>
                                            <td  class="text-center">Tk.
                                                {{ $data->amount ?? '' }}/=
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="text-align:right">
                                                <p style="font-weight:900;font-size:12px">TOTAL</p>

                                                <p><em>(excluding vat & tax)</em></p>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle">Tk.
                                                {{ $data->amount ?? '' }}/=
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p class="font-14px" style="margin-top:10px">In-Words: <strong>
                                    {{ ucwords($word) ?? '' }} tk only
                                </strong></p>
                            </div>

                            <div style="padding-right:20px;margin-top:100px;">
                                <div style="text-align:right">
                                    <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

                                    <p>
                                        -------------------------------------
                                    </p>

                                    <p class="font-14px">Authorized Signature</p>
                                </div>
                            </div>
                        </div>

                        <div class="footer-img font-14px" style="text-align:center;margin-top:30px">
                            <a href="https://i-infotechsolution.com" style="text-decoration:none;display:block;margin-top:3px;color:#000;">
                                www.i-infotechsolution.com
                            </a>
                        </div>

                        <div style="padding: 5px 20px 10px 10px">
                            <p class="font-14px">
                                <strong>i-infotech Business Solution</strong>
                            </p>
                            <p style="font-size: 11px">
                                House: 126, Road-01, Avenue-3 , Mirpur-DOHS, Dhaka-1216
                            </p>
                            <p style="font-size: 11px">
                                E-mail: iinfotechbs@gmail.com, info@i-infotechsolution.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div style="padding: 20px">
                    <a href="{{ route('process_service.show', $data->id) }}" class="btn btn-info">
                        <i class="fa fa-print"></i> Make Pdf
                    </a>
                </div>
            </div>
        </div>
	</div>
</section>
@endsection
