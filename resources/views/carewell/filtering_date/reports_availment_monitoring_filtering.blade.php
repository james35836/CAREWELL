<div class="row top-element">
    <div class="col-md-3 col-xs-12">
        <div class="btn-group">
            <a href="{{$link}}"><button type="button" class="btn btn-success">EXPORT EXCEL</button></a>
        </div>
    </div>
    <div class="col-md-6 col-xs-12 pull-right">
        <div class="col-md-4">
            <label style="display:inline-block;">Filter Report:</label>
        </div>
        <div class="col-md-8">
            <input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="availment_monitoring" >
        </div>
    </div>
</div>
<div class="table-responsive no-padding">
    <table class="table table-hover table-bordered sum_table">
        <tr class="titlerow">
            <th>AVAILMENT TYPE</th>
            <th>NO. OF PATIENT</th>
            <th>JAN</th>
            <th>NO. OF PATIENT</th>
            <th>FEB</th>
            <th>NO. OF PATIENT</th>
            <th>MAR</th>
            <th>NO. OF PATIENT</th>
            <th>APR</th>
            <th>NO. OF PATIENT</th>
            <th>MAY</th>
            <th>NO. OF PATIENT</th>
            <th>JUNE</th>
            <th>NO. OF PATIENT</th>
            <th>JULY</th>
            <th>NO. OF PATIENT</th>
            <th>AUG</th>
            <th>NO. OF PATIENT</th>
            <th>SEPT</th>
            <th>NO. OF PATIENT</th>
            <th>OCT</th>
            <th>NO. OF PATIENT</th>
            <th>NOV</th>
            <th>NO. OF PATIENT</th>
            <th>DEC</th>
            <th>TOTAL NO. OF PATIENT</th>
            <th>TOTAL AMOUNT</th>
        </tr>
        @foreach($_availment as $availment)
        <tr>
            <td>{{$availment->availment_name}}</td>
            <td>{{$availment->count_jan}}</td>
            <td>{{$availment->count_jan_amount}}</td>
            <td>{{$availment->count_feb}}</td>
            <td>{{$availment->count_feb_amount}}</td>
            <td>{{$availment->count_mar}}</td>
            <td>{{$availment->count_mar_amount}}</td>
            <td>{{$availment->count_apr}}</td>
            <td>{{$availment->count_apr_amount}}</td>
            <td>{{$availment->count_may}}</td>
            <td>{{$availment->count_may_amount}}</td>
            <td>{{$availment->count_jun}}</td>
            <td>{{$availment->count_jun_amount}}</td>
            <td>{{$availment->count_jul}}</td>
            <td>{{$availment->count_jul_amount}}</td>
            <td>{{$availment->count_aug}}</td>
            <td>{{$availment->count_aug_amount}}</td>
            <td>{{$availment->count_sep}}</td>
            <td>{{$availment->count_sep_amount}}</td>
            <td>{{$availment->count_oct}}</td>
            <td>{{$availment->count_oct_amount}}</td>
            <td>{{$availment->count_nov}}</td>
            <td>{{$availment->count_nov_amount}}</td>
            <td>{{$availment->count_dec}}</td>
            <td>{{$availment->count_dec_amount}}</td>
            <td>{{$availment->count}}</td>
            <td>{{$availment->count_sum}}</td>
        </tr>
        @endforeach
        <tr>
            <td>TOTAL</td>
            <td>{{$total[0]}}</td>
            <td>{{$total_amount[0]}}</td>
            <td>{{$total[1]}}</td>
            <td>{{$total_amount[1]}}</td>
            <td>{{$total[2]}}</td>
            <td>{{$total_amount[2]}}</td>
            <td>{{$total[3]}}</td>
            <td>{{$total_amount[3]}}</td>
            <td>{{$total[4]}}</td>
            <td>{{$total_amount[4]}}</td>
            <td>{{$total[5]}}</td>
            <td>{{$total_amount[5]}}</td>
            <td>{{$total[6]}}</td>
            <td>{{$total_amount[6]}}</td>
            <td>{{$total[7]}}</td>
            <td>{{$total_amount[7]}}</td>
            <td>{{$total[8]}}</td>
            <td>{{$total_amount[8]}}</td>
            <td>{{$total[9]}}</td>
            <td>{{$total_amount[9]}}</td>
            <td>{{$total[10]}}</td>
            <td>{{$total_amount[10]}}</td>
            <td>{{$total[11]}}</td>
            <td>{{$total_amount[11]}}</td>
            <td>{{$count_approval}}</td>
            <td>{{$sum_approval}}</td>
        </tr>
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination', ['paginator' => $_availment])
</div>