<table>
  <tr>
    <td colspan="14">MONTLY MONITORING</td>
  </tr>
  <tr>
    <td colspan="14">{{$date}}</td>
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
    <td class="sum-jun">{{$company->count_june}}</td>
    <td class="sum-jul">{{$company->count_july}}</td>
    <td class="sum-aug">{{$company->count_aug}}</td>
    <td class="sum-sep">{{$company->count_sept}}</td>
    <td class="sum-oct">{{$company->count_oct}}</td>
    <td class="sum-nov">{{$company->count_nov}}</td>
    <td class="sum-dec">{{$company->count_dec}}</td>
    <td class="sum-count">{{$company->count}}</td>
  </tr>
  @endforeach
  <tr>
    <td>TOTAL</td>
    <td id="sum-jan">-</td>
    <td id="sum-feb">-</td>
    <td id="sum-mar">-</td>
    <td id="sum-apr">-</td>
    <td id="sum-may">-</td>
    <td id="sum-jun">-</td>
    <td id="sum-jul">-</td>
    <td id="sum-aug">-</td>
    <td id="sum-sep">-</td>
    <td id="sum-oct">-</td>
    <td id="sum-nov">-</td>
    <td id="sum-dec">-</td>
    <td id="sum-count">{{$total_avail}}</td>
  </tr>
</table>