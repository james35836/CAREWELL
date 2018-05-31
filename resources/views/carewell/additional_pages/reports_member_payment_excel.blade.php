<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Export Data</title>
        <style>
            table,tr,th,td
            {
                text-align: center !important;
            }
            td
            {
                width:35px;
            }
            span.label-info
            {
                background-color: #F39C12 !important;
            }
            span.label-warning
            {
                background-color: #F39C12 !important;
            }
            span.label-primary
            {
                background-color: #F39C12 !important;
            }
        </style>
    </head>

    <body>
        <table class="table table-hover table-bordered">
                <tr class="titlerow">
                    <th>Year</th>
                    <th colspan="2">January</th>
                    <th colspan="2">February</th>
                    <th colspan="2">March</th>
                    <th colspan="2">April</th>
                    <th colspan="2">May</th>
                    <th colspan="2">June</th>
                    <th colspan="2">July</th>
                    <th colspan="2">August</th>
                    <th colspan="2">September</th>
                    <th colspan="2">October</th>
                    <th colspan="2">November</th>
                    <th colspan="2">December</th>
                </tr>
                @foreach($_payment as $payment)
                <tr>
                    <td class="col-md-5">{{$payment->year}}</td>
                    <td colspan="{{$payment->colspan}}"></td>
                    @foreach($payment->cal_payment as $payments)
                    <td colspan="1"><span class="label label-info">{{$payments->cal_number}}</span>-<span class="label label-warning">{{date("F j, Y",strtotime($payments->cal_payment_start))}}</span> to <span class="label label-primary">{{date("F j, Y",strtotime($payments->cal_payment_end))}}</span></td>
                    @endforeach
                </tr>
                @endforeach
            </table>
    </body>
</html>