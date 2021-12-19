@extends('layouts.main')

@section('style')
    <style>
        p {
            margin: 0;
            line-height: 1;
        }
        .text-14 {
            font-size: 14px;
        }
        .text-15 {
            font-size: 15px;
        }
        .bottom-dot {
            border-bottom: 2px dotted #000;
        }

        .watermark { position: relative; }
        .watermark::after {
            content: "";
            width: 100%;
            height: 100px;
            opacity: 0.3;
            background: url('https://i-infotechsolution.com/assets/img/logo.png') no-repeat;
            background-size: 500px 100px;
            position: absolute;
            left: 10%;
            bottom: 50%;
            transform: rotate(-30deg);
        }
    </style>
@endsection

@section('content')
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Show Money Receipt</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div style="padding: 10px 15px">
                    <div style="border:2px solid #f7bd62;padding:30px;">
                        <div class="watermark" style="border:5px solid #479FD0;padding:10px 0;height:auto;border-radius:4px;">
                            <div class="text-center">
                                <h3 style="font-weight:600;color:#056083">I-infotech Business Solution</h3>
                                <p class="text-14" style="font-weight:500">House:126,Road-01,Avenue-3 , Mirpur-DOHS, Dhaka-1216</p>
                                <p class="text-14" style="font-weight:500">Phone: +8801673-201560</p>
                                <p class="text-14" style="font-weight:500">Email: info@i-infotechsolution.com</p>
                                <p class="text-14" style="font-weight:500"> Website: http://i-infotechsolution.com</p>
                            </div>

                            <div class="text-center">
                                <h1 style="font-weight:800;">Money Receipt</h1>
                            </div>

                            <div style="display:flex;align-items:center;justify-content:space-between;padding:0 10px;margin-top:15px">
                                <p>
                                    <strong class="text-15">Receipt No #:</strong> {{ $money_receipt->receipt_no }}
                                </p>
                                <p>
                                    <strong class="text-15">Date:</strong> {{ $money_receipt->date }}
                                </p>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <strong class="text-15" style="word-break:break-word;line-height:2;">
                                    <span>{{ $money_receipt->receipt_type === 'Bank' ? 'Cheque' : 'Cash' }} Received From</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ $money_receipt->client_name ?? '' }}</span>
                                    <span>of Tk</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ number_format($money_receipt->amount) ?? '' }}/=</span>
                                    <span>For</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ $money_receipt->charge_for ?? '' }}</span>
                                </strong>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <p style="margin-bottom: 10px">Bank Name: {{ $money_receipt->bank_name ?? '' }}</p>
                                <p>Cheque No: {{ $money_receipt->check_no ?? '' }}</p>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <p>In Word: <strong style="text-transform: capitalize">{{ ucwords(\Riskihajar\Terbilang\Facades\Terbilang::make($money_receipt->amount)) ?? '' }} tk only</strong></p>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <div style="text-align:right">
                                    <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

                                    <p>
                                        -------------------------------------
                                    </p>

                                    <p class="text-14" style="font-weight:600;margin-right:40px">Signed By</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div style="padding: 20px 0">
                    <a href="{{ route('money_receipt.send', encrypt($money_receipt->id)) }}" class="btn btn-info" target="_blank">
                        <i class="fa fa-send"></i> Send Mail
                    </a>
                </div>
            </div>
        </div>

	</div>
</section>
@endsection
