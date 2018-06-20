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
            <td>{{$availment->count_jan_amount->total_gross}}</td>
            <td>{{$availment->count_feb}}</td>
            <td>{{$availment->count_feb_amount->total_gross}}</td>
            <td>{{$availment->count_mar}}</td>
            <td>{{$availment->count_mar_amount->total_gross}}</td>
            <td>{{$availment->count_apr}}</td>
            <td>{{$availment->count_apr_amount->total_gross}}</td>
            <td>{{$availment->count_may}}</td>
            <td>{{$availment->count_may_amount->total_gross}}</td>
            <td>{{$availment->count_jun}}</td>
            <td>{{$availment->count_jun_amount->total_gross}}</td>
            <td>{{$availment->count_jul}}</td>
            <td>{{$availment->count_jul_amount->total_gross}}</td>
            <td>{{$availment->count_aug}}</td>
            <td>{{$availment->count_aug_amount->total_gross}}</td>
            <td>{{$availment->count_sep}}</td>
            <td>{{$availment->count_sep_amount->total_gross}}</td>
            <td>{{$availment->count_oct}}</td>
            <td>{{$availment->count_oct_amount->total_gross}}</td>
            <td>{{$availment->count_nov}}</td>
            <td>{{$availment->count_nov_amount->total_gross}}</td>
            <td>{{$availment->count_dec}}</td>
            <td>{{$availment->count_dec_amount->total_gross}}</td>
            <td>{{$availment->count}}</td>
            <td>{{$availment->count_sum->total_gross}}</td>
        </tr>
        @endforeach
        <tr>
            <td>TOTAL</td>
            <td>{{$availment->count_jan_member_avail}}</td>
            <td>{{$availment->count_jan_amount->total_gross}}</td>
            <td>{{$availment->count_feb_member_avail}}</td>
            <td>{{$availment->count_feb_amount->total_gross}}</td>
            <td>{{$availment->count_mar_member_avail}}</td>
            <td>{{$availment->count_mar_amount->total_gross}}</td>
            <td>{{$availment->count_apr_member_avail}}</td>
            <td>{{$availment->count_apr_amount->total_gross}}</td>
            <td>{{$availment->count_may_member_avail}}</td>
            <td>{{$availment->count_may_amount->total_gross}}</td>
            <td>{{$availment->count_jun_member_avail}}</td>
            <td>{{$availment->count_jun_amount->total_gross}}</td>
            <td>{{$availment->count_jul_member_avail}}</td>
            <td>{{$availment->count_jul_amount->total_gross}}</td>
            <td>{{$availment->count_aug_member_avail}}</td>
            <td>{{$availment->count_aug_amount->total_gross}}</td>
            <td>{{$availment->count_sep_member_avail}}</td>
            <td>{{$availment->count_sep_amount->total_gross}}</td>
            <td>{{$availment->count_oct_member_avail}}</td>
            <td>{{$availment->count_oct_amount->total_gross}}</td>
            <td>{{$availment->count_nov_member_avail}}</td>
            <td>{{$availment->count_nov_amount->total_gross}}</td>
            <td>{{$availment->count_dec_member_avail}}</td>
            <td>{{$availment->count_dec_amount->total_gross}}</td>
            <td>{{$count_approval}}</td>
            <td>{{$sum_approval->total_gross}}</td>
        </tr>
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination', ['paginator' => $_availment])
</div>