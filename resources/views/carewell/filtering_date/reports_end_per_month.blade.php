<div class="row top-element">
<!-- 	<div class="col-md-3 col-xs-12 pull-left">
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
			<input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="end_per_month" >
		</div>
		
	</div>
</div>
<div class="table-responsive no-padding">
	<table class="table table-hover table-bordered sum_table">
		<tr class="titlerow">
			<th>COMPANY</th>
			<th>PREM</th>
			<th>DATE ACQUIRED</th>
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
		</tr>
		@foreach($_company as $company)
		<tr>
			<td>{{$company->company_name}}</td>
			<td>{{$company->coverage_plan_premium}}</td>
			<td>{{substr($company->company_created,0,10)}}</td>
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
		</tr>
		@endforeach
		<tr>
			<td>TOTAL</td>
			<td></td>
			<td></td>
			<td id="sum-jan"></td>
			<td id="sum-feb"></td>
			<td id="sum-mar"></td>
			<td id="sum-apr"></td>
			<td id="sum-may"></td>
			<td id="sum-jun"></td>
			<td id="sum-jul"></td>
			<td id="sum-aug"></td>
			<td id="sum-sep"></td>
			<td id="sum-oct"></td>
			<td id="sum-nov"></td>
			<td id="sum-dec"></td>
		</tr>
	</table>
</div>
<div class="box-footer clearfix">
	@include('globals.pagination', ['paginator' => $_company])
</div>