<!DOCTYPE html>

<html>

    <head>
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page  {
                margin: 0;
            }
            .brand-logo {
                width: 100%;
                height: auto;
                max-height: 150px
            }
            .font-14px {
                font-size: 14px;
            }
            p {
                margin: 0
            }
            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }
            .table-bordered>thead>tr>th,
            .table-bordered>tbody>tr>th,
            .table-bordered>thead>tr>td,
            .table-bordered>tbody>tr>td {
                border: 1px solid #666;
                font-size: 14px;
                text-align: center;
            }
            .table-bordered>tbody>tr>td {
                padding: 7px
            }
            .table-bordered>thead>tr>th {
                font-size: 12px;
                padding: 5px;
            }
            .footer-img {
                background-size: cover;
                height: 25px;
                padding-top: 5px;
                background-image: url('https://i-infotechsolution.com/assets/ibs/background4_1.jpg');
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin: 1cm;
                /* margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm; */
            }

            /** Define the header rules **/
            header, footer {
                position: absolute;
                left: 0;
                right: 0;
                height: auto;
                padding-left:1px;
                padding-right:1px;
            }

            header {
                padding-top:1px;
                top: 0;
            }

            /** Define the footer rules **/
            footer {
                bottom: 0;
            }
        </style>
    </head>

    <body style="border:2px solid #479FD0;padding:0;">
        <header>
            <div>
                <img src="https://i-infotechsolution.com/assets/ibs/background2.jpg" class="brand-logo">
            </div>

            <div style="padding: 20px">
                <div>
                    <p class="font-14px">
                        Reference: <strong>IBS-21060004</strong>
                    </p>

                    <p class="font-14px">
                        Date: June 05, 2021
                    </p>

                    <p style="margin-top: 15px">
                        To
                    </p>
                    <p style="font-weight: 400">Managing Director</p>

                    <p class="client-name">
                        <strong>The Homeo Research Laboratory (BD) Ltd.</strong>
                    </p>

                    <p class="font-14px client-address">
                        <em>49/3 Rajabo, Ghorashal, Palash, Narsingdi</em>
                    </p>

                    <p class="font-14px client-email">
                        email@gmail.com
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
                        <th>PARTICULARS</th>
                        <th>QTY</th>
                        <th>AMOUNT TK</th>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = range(1, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->index+1); ?></td>
                                <td>HRM Software</td>
                                <td>1@ Tk. /=</td>
                                <td>Tk. /=</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                        <tr>
                            <td colspan="3" style="text-align:right">
                                <p style="font-weight:500;font-size:12px">TOTAL</p>

                                <p><em>(excluding vat & tax)</em></p>
                            </td>

                            <td>Tk. /=</td>
                        </tr>
                    </tbody>
                </table>

                <p class="font-14px" style="margin-top:10px">In-Words: <strong>Hello only</strong></p>
            </div>


            <div style="margin-top: 100px">
                <div style="text-align:right">
                    <img src="https://i-infotechsolution.com/assets/ibs/signature.jpg" width="150">

                    <p>
                        -------------------------------------
                    </p>

                    <p class="font-14px">Authorized Signature</p>
                </div>
            </div>
        </main>

        <footer>
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

    </body>
</html>


<?php /**PATH H:\xammp\htdocs\ibs_accounts_mail_version\resources\views/mails/hello.blade.php ENDPATH**/ ?>