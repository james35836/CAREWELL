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
			<input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="company_availment_per_month" >
		</div>
		
	</div>
</div>
<div  id="showTable" class="load-data load-reports-company-availment-per-month" data-target="load-reports-company-availment-per-month">
	<div class="table-responsive no-padding">
		
		<table class="">
			@foreach($_company as $keys =>$company)
			<tr>
				<td>
					<table class="">
						@if($keys==0)
						<tr>
							<th>COMPANY</th>
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
						@endif
						@foreach($company->availment as $key=> $availment)
						<tr>
							@if($key==0)
							<td><strong>{{$company->company_name}}</strong></td>
							@else
							<td></td>
							@endif
							<td>{{$availment->availment_name}}</td>
							<td>{{$availment->count_jan}}</td>
							<td>{{$availment->count_feb}}</td>
							<td>{{$availment->count_mar}}</td>
							<td>{{$availment->count_apr}}</td>
							<td>{{$availment->count_may}}</td>
							<td>{{$availment->count_jun}}</td>
							<td>{{$availment->count_jul}}</td>
							<td>{{$availment->count_aug}}</td>
							<td>{{$availment->count_sep}}</td>
							<td>{{$availment->count_oct}}</td>
							<td>{{$availment->count_nov}}</td>
							<td>{{$availment->count_dec}}</td>
							<td>{{$availment->total}}</td>
						</tr>
						@if($key == 7)
						<tr>
							<td colspan="2">TOTAL</td>
							<td class="sum-jan">{{$company->count_jan_total}}</td>
							<td class="sum-feb">{{$company->count_feb_total}}</td>
							<td class="sum-mar">{{$company->count_mar_total}}</td>
							<td class="sum-apr">{{$company->count_apr_total}}</td>
							<td class="sum-may">{{$company->count_may_total}}</td>
							<td class="sum-jun">{{$company->count_jun_total}}</td>
							<td class="sum-jul">{{$company->count_jul_total}}</td>
							<td class="sum-aug">{{$company->count_aug_total}}</td>
							<td class="sum-sep">{{$company->count_sep_total}}</td>
							<td class="sum-oct">{{$company->count_oct_total}}</td>
							<td class="sum-nov">{{$company->count_nov_total}}</td>
							<td class="sum-dec">{{$company->count_dec_total}}</td>
							<td class="sum-count">{{$company->total_all}}</td>
						</tr>
						<tr><td colspan="15" height="20"></td></tr>
						@endif
						@endforeach
					</table>
				</td>
			</tr>
			@endforeach
			<tr>
				<td>
					<table class="" style="width: 100%;">
						<tr>
							<td colspan="2">GRAND TOTAL FOR YEAR {{$date}}</td>
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
							<td id="sum-count">{{$grand_total_all}}</td>
						</tr>
					<tr></tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div class="box-footer clearfix">
	@include('globals.pagination_v2', ['paginator' => $_company])
</div>