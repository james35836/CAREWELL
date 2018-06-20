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
<div  id="showTable" class="load-data load-reports-availment-per-month" data-target="load-reports-availment-per-month">
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
							<td class="sum-count">{{$availment->total}}</td>
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
							<td colspan="2">GRAND TOTAL</td>
							<td id="sum-jan">{{$company->count_jan_grand_total}}</td>
							<td id="sum-feb">{{$company->count_feb_grand_total}}</td>
							<td id="sum-mar">{{$company->count_mar_grand_total}}</td>
							<td id="sum-apr">{{$company->count_apr_grand_total}}</td>
							<td id="sum-may">{{$company->count_may_grand_total}}</td>
							<td id="sum-jun">{{$company->count_jun_grand_total}}</td>
							<td id="sum-jul">{{$company->count_jul_grand_total}}</td>
							<td id="sum-aug">{{$company->count_aug_grand_total}}</td>
							<td id="sum-sep">{{$company->count_sep_grand_total}}</td>
							<td id="sum-oct">{{$company->count_oct_grand_total}}</td>
							<td id="sum-nov">{{$company->count_nov_grand_total}}</td>
							<td id="sum-dec">{{$company->count_dec_grand_total}}</td>
							<td id="sum-count">{{$grand_total_all}}</td>
						</tr>
					<tr></tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</div>
<div class="box-footer clearfix">
@include('globals.pagination', ['paginator' => $_company])
</div>