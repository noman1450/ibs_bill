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
                    <div style="border:2px solid #f7bd62;padding:30px 30px 300px;">
                        <div style="border:5px solid #479FD0;padding:10px 0;height:auto;border-radius:4px;">
                            <div class="text-center">
                                <h3 style="font-weight:600;color:#056083">I-infotech Business Solution</h3>
                                <p class="text-14" style="font-weight:500">House:1266,3rd floor,Road-10,Avenue-2 , Mirpur- DOHS, Dhaka-121</p>
                                <p class="text-14" style="font-weight:500">Phone: +8801673-201560</p>
                                <p class="text-14" style="font-weight:500">Email: info@i-infotechsolution.com</p>
                                <p class="text-14" style="font-weight:500"> Website: http://i-infotechsolution.com/</p>
                            </div>

                            <div class="text-center">
                                <h1 style="font-weight:800;">Money Receipt</h1>
                            </div>

                            <div style="display:flex;align-items:center;justify-content:space-between;padding:0 10px;margin-top:15px">
                                <p>
                                    <strong class="text-15">Cash Receipt #:</strong> {{ $money_receipt->receipt_no }}
                                </p>
                                <p>
                                    <strong class="text-15">Date:</strong> {{ $money_receipt->date }}
                                </p>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <strong class="text-15" style="word-wrap:break-word;line-height:2;">
                                    <span>Cash Received From</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ $money_receipt->client_name ?? '' }}</span>
                                    <span>of Tk</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ number_format($money_receipt->amount) ?? '' }}/=</span>
                                    <span>For</span>
                                    <span class="bottom-dot" style="font-weight:600;font-size:13px;padding:0 50px 0 30px">{{ $money_receipt->charge_for ?? '' }}</span>
                                </strong>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <p style="margin-bottom: 10px">Bank Name: </p>
                                <p>Check No: </p>
                            </div>

                            <div style="padding:0 10px;margin-top:15px">
                                <p>In Word: <strong>Six thousand & Five Hundred only</strong></p>
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

            <div class="col-md-3"></div>
        </div>

	</div>
</section>
@endsection
