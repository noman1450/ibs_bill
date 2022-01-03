<!DOCTYPE html>

<html>

    <head>
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
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
        @include('mails.pdf_base', ['multiple' => true])

    </body>
</html>
