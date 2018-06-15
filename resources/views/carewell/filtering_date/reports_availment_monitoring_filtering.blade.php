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
    <div  id="showTable" class="load-data load-reports-availment-monitoring" data-target="load-reports-availment-monitoring">
    <table class="table table-hover table-bordered sum_table">
        <tr class="titlerow">
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
            <td id="sum-count"></td>
        </tr>
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination', ['paginator' => $_availment])
</div>