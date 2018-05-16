<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Export Data</title>
    </head>
    <body>
        <table class="table table-hover table-bordered">
            <tr class="titlerow">
                <th>Date Paid</th>
                <th>Amount</th>
            </tr>
             @foreach($_member as $member)
            <tr>
                <td>{{$member->cal_payment_start}}</td>
                <td>{{$member->amount}}</td>
            </tr>
            @endforeach
        </table>    
    </body>
</html>