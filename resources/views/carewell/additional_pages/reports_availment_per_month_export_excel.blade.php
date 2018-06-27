<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="assets/css/export_excel.css">

        
    </head>
    <body>
        <table>
            <tr>
                <th colspan="14">AVAILMENT PER MONTH SUMMARY</th>
            </tr>
            <tr>
                <th colspan="14">{{$date}}</th>
            </tr>
            <tr>
                <th>COMPANY</th>
                <th>JAN</th>
                <th>FEB</th>
                <th>MAR</th>
                <th>APR</th>
                <th>MAY</th>
                <th>JUNE</th>
                <th>JULY</th>
                <th>AUG</th>
                <th>SEPT</th>
                <th>OCT</th>
                <th>NOV</th>
                <th>DEC</th>
                <th>TOTAL</th>
            </tr>
            @foreach($_company as $company)
            <tr>
                <td>{{$company->company_name}}</td>
                <td class="sum-jan">{{$company->count_jan}}</td>
                <td class="sum-feb">{{$company->count_feb}}</td>
                <td class="sum-mar">{{$company->count_mar}}</td>
                <td class="sum-apr">{{$company->count_apr}}</td>
                <td class="sum-may">{{$company->count_may}}</td>
                <td class="sum-jun">{{$company->count_jun}}</td>
                <td class="sum-jul">{{$company->count_jul}}</td>
                <td class="sum-aug">{{$company->count_aug}}</td>
                <td class="sum-sep">{{$company->count_sep}}</td>
                <td class="sum-oct">{{$company->count_oct}}</td>
                <td class="sum-nov">{{$company->count_nov}}</td>
                <td class="sum-dec">{{$company->count_dec}}</td>
                <td class="sum-count">{{$company->count}}</td>
            </tr>
            @endforeach
            <tr>
                <td>TOTAL</td>
                <td id="sum-jan">{{$total[0]}}</td>
                <td id="sum-feb">{{$total[1]}}</td>
                <td id="sum-mar">{{$total[2]}}</td>
                <td id="sum-apr">{{$total[3]}}</td>
                <td id="sum-may">{{$total[4]}}</td>
                <td id="sum-jun">{{$total[5]}}</td>
                <td id="sum-jul">{{$total[6]}}</td>
                <td id="sum-aug">{{$total[7]}}</td>
                <td id="sum-sep">{{$total[8]}}</td>
                <td id="sum-oct">{{$total[9]}}</td>
                <td id="sum-nov">{{$total[10]}}</td>
                <td id="sum-dec">{{$total[11]}}</td>
                <td id="sum-count">{{$total_count}}</td>
            </tr>
        </table>
    </body>