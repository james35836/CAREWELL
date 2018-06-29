@extends('carewell.layout.layout')
@section('content')
<script type="text/javascript">
	$(document).ready(function()
	{
		settings_reports.calculateSum('sum-jan');
		settings_reports.calculateSum('sum-feb');
		settings_reports.calculateSum('sum-mar');
		settings_reports.calculateSum('sum-apr');
		settings_reports.calculateSum('sum-may');
		settings_reports.calculateSum('sum-jun');
		settings_reports.calculateSum('sum-jul');
		settings_reports.calculateSum('sum-aug');
		settings_reports.calculateSum('sum-sep');
		settings_reports.calculateSum('sum-oct');
		settings_reports.calculateSum('sum-nov');
		settings_reports.calculateSum('sum-dec');
		settings_reports.calculateSum('sum-count');

		$('body').on('click','.year-picker',function(e)
		{
			$(this).datepicker({
			format: " yyyy",
			startView: "years",
			viewMode: "years",
			minViewMode: "years",
			autoclose: true
			});
		
		});
	});

</script>
<style>
table,th,td
{
	border:2px solid #6c6c6c !important;
}
td
{
	width:100% !important;
					/*	text-align: center !important;
	vertical-align: middle !important;*/
}
/*tr td table tr th,  tr td table tr td
{
	
}*/
</style>
<div class="container">
	<div class="row">
		<div class="">
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#open" data-toggle="tab">MONTHLY MONITORING</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active showReportContent" id="open">
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
													<td colspan="2">GRAND TOTAL</td>
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
													<td id="sum-count"></td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection