<header>
    <div>
        <img src="https://i-infotechsolution.com/assets/ibs/background2.jpg" class="brand-logo">
    </div>

    <div style="padding: 20px">
        <div>
            <p class="font-14px">
                Bill No.: <strong>IBS-{{ ($multiple ? $bill_no : $info->bill_no) ?? '' }}</strong>
            </p>
            <p class="font-14px">
                Bill Date: <strong>{{ date('jS M, Y') }}</strong>
            </p>
            <p style="margin-top: 15px">
                To
            </p>
            <p style="font-weight: 400">{{ $info->send_to ?? '' }}</p>

            <p class="client-name">
                <strong>{{ ucwords($info->client_name) ?? '' }}</strong>
            </p>

            <p class="font-14px client-address">
                <em>{{ $info->client_address ?? '' }}</em>
            </p>
        </div>
    </div>
</header>

<main style="margin-top: 330px;padding: 20px">
    <div>
        <div style="width:100%;text-align:center;text-decoration:underline;font-weight:600">Subject Bill</div>
    </div>

    <div style="margin-top:20px">
        <table class="table-bordered">
            <thead>
                <th>SL</th>
                <th>SOFTWARE NAME</th>
                <th>DURATION</th>
                <th>AMOUNT TK</th>
            </thead>

            <tbody>

                @php
                    $totalAmt = 0;
                @endphp
                @foreach ($details as $item)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $item->software_name ?? '' }}</td>
                        <td>{{ $item->month_year ?? '' }}</td>
                        <td>Tk. {{ number_format($item->amount) ?? '' }}/=</td>
                    </tr>

                    @php($totalAmt = $totalAmt += $item->amount)
                @endforeach

                <tr>
                    <td colspan="3" style="text-align:right">
                        <p style="font-weight:500;font-size:12px">TOTAL</p>

                        <p><em>(excluding vat & tax)</em></p>
                    </td>

                    <td><strong>Tk. {{ number_format($totalAmt) ?? '' }}/=</strong></td>
                </tr>
            </tbody>
        </table>

        <p class="font-14px" style="margin-top:10px">In-Words: <strong style="text-transform: capitalize">{{ ucwords(\Riskihajar\Terbilang\Facades\Terbilang::make($totalAmt)) }} Tk. Only</strong></p>
    </div>
</main>

<footer>
    <div style="padding-right: 20px">
        <div style="text-align:right">
            <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

            <p>
                -------------------------------------
            </p>

            <p class="font-14px">Authorized Signature</p>
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
</footer>
