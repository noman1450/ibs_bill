
<style>
    body {
        margin: -0.5cm;
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
        bottom: 68%;
        transform: rotate(-32deg);
    }
</style>


<div style="padding: 10px 15px">
    <div style="border:2px solid #f7bd62;padding:30px;">
        <div class="watermark" style="border:5px solid #479FD0;padding:10px 0;height:auto;border-radius:4px;">
            <div style="text-align:center">
                <h2 style="font-weight:600;color:#056083;margin-top:5px;margin-bottom:5px">I-infotech Business Solution</h2>
                <p style="font-size:13px;font-weight:normal;margin:0;line-height:1.2">House:126,Road-01,Avenue-3 , Mirpur-DOHS, Dhaka-1216</p>
                <p style="font-size:13px;font-weight:normal;margin:0;line-height:1.2">Phone: +8801673-201560</p>
                <p style="font-size:13px;font-weight:normal;margin:0;line-height:1.2">Email: info@i-infotechsolution.com</p>
                <p style="font-size:13px;font-weight:normal;margin:0;line-height:1.2"> Website: http://i-infotechsolution.com</p>
            </div>

            <div style="text-align:center">
                <h1 style="font-weight:800;">Money Receipt</h1>
            </div>

            <div style="display:flex;padding:0 10px;margin-top:15px">
                <p style="text-align:left">
                    <strong class="text-15">Receipt No #:</strong> {{ $money_receipt->receipt_no }}
                </p>
                <p style="text-align:right">
                    <strong class="text-15">Date:</strong> {{ date('d M, Y', strtotime($money_receipt->date)) }}
                </p>
            </div>

            <div style="padding:0 10px;margin-top:-60px">
                <strong class="text-15" style="word-break:break-all;line-height:2;">
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
                <p style="margin:0">Cheque No: {{ $money_receipt->check_no ?? '' }}</p>
            </div>

            <div style="padding:0 10px;">
                <p>In Word: <strong style="text-transform: capitalize">{{ ucwords(\Riskihajar\Terbilang\Facades\Terbilang::make($money_receipt->amount)) ?? '' }} tk only</strong></p>
            </div>

            <div style="padding:0 10px;margin-top:15px">
                <div style="text-align:right">
                    <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

                    <p style="margin:0">
                        -------------------------------------
                    </p>

                    <p class="text-14" style="font-weight:600;margin:0 40px 0 0">Signed By</p>
                </div>
            </div>
        </div>
    </div>
</div>
