<script type="text/javascript">
$(document).ready(function(){
// settings_reports.calculateSum('sum-jan');
// settings_reports.calculateSum('sum-feb');
// settings_reports.calculateSum('sum-mar');
// settings_reports.calculateSum('sum-apr');
// settings_reports.calculateSum('sum-may');
// settings_reports.calculateSum('sum-jun');
// settings_reports.calculateSum('sum-jul');
// settings_reports.calculateSum('sum-aug');
// settings_reports.calculateSum('sum-sep');
// settings_reports.calculateSum('sum-oct');
// settings_reports.calculateSum('sum-nov');
// settings_reports.calculateSum('sum-dec');
// settings_reports.calculateSum('sum-count');
});
</script>
<div class="row top-element">
    <!--     <div class="col-md-3 col-xs-12 pull-left">
        <select class="form-control">
            <option value="">SELECT COMPANY</option>
            @foreach($_company as $company)
            <option>{{$company->company_name}}</option>
            @endforeach
        </select>
    </div> -->
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
            <input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="availment_per_month" >
        </div>
        
    </div>
</div>
<div  id="showTable" class="load-data load-reports-availment-per-month" data-target="load-reports-availment-per-month">
    <div class="table-responsive no-padding">
        <table class="table table-hover table-bordered sum_table">
            <tr class="titlerow">
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
                <td>TOTAL FOR YEAR {{$date}}</td>
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
    </div>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination_v2', ['paginator' => $_company])
</div>