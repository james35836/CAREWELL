<table>
  <tr>
    <th>AVAILMENT TYPE</th>
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
  @foreach($_availment as $availment)
  <tr>
    <td>{{$availment->availment_name}}</td>
    <td class="sum-jan">{{$availment->count_jan}}</td>
    <td class="sum-feb">{{$availment->count_feb}}</td>
    <td class="sum-mar">{{$availment->count_mar}}</td>
    <td class="sum-apr">{{$availment->count_apr}}</td>
    <td class="sum-may">{{$availment->count_may}}</td>
    <td class="sum-jun">{{$availment->count_jun}}</td>
    <td class="sum-jul">{{$availment->count_jul}}</td>
    <td class="sum-aug">{{$availment->count_aug}}</td>
    <td class="sum-sep">{{$availment->count_sep}}</td>
    <td class="sum-oct">{{$availment->count_oct}}</td>
    <td class="sum-nov">{{$availment->count_nov}}</td>
    <td class="sum-dec">{{$availment->count_dec}}</td>
    <td class="sum-count">{{$availment->count}}</td>
  </tr>
  @endforeach
  <tr>
    <td>TOTAL</td>
    <td id="sum-jan">{{$total_jan}}</td>
    <td id="sum-feb">{{$total_feb}}</td>
    <td id="sum-mar"><{{$total_mar}}</td>
    <td id="sum-apr">{{$total_apr}}</td>
    <td id="sum-may">{{$total_may}}</td>
    <td id="sum-jun">{{$total_jun}}</td>
    <td id="sum-jul">{{$total_jul}}</td>
    <td id="sum-aug">{{$total_aug}}</td>
    <td id="sum-sep">{{$total_sep}}</td>
    <td id="sum-oct">{{$total_oct}}</td>
    <td id="sum-nov">{{$total_nov}}</td>
    <td id="sum-dec">{{$total_dec}}</td>
    <td id="sum-count">{{$total_all}}</td>
  </tr>
</table>
