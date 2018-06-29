<head>
	<link rel="stylesheet" href="assets/css/export_excel.css">
</head>
<body>
	<table>
		<tr><th>CAREWELL HEALTH SYSTEMS, INC.</th></tr>
		<tr><th>MONTHLY AVAILMENT MONITORING</th></tr>
		<tr><th>{{$date}}</th></tr>
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
	</table>
	<table>
		@foreach($_company as $keys =>$company)
		<tr>
			<td>
				<table>
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
					<tr class="total">
						<th colspan="2" style="color:#ff0000;">TOTAL</th>
						<th class="sum-jan">{{$company->count_jan_total}}</th>
						<th class="sum-feb">{{$company->count_feb_total}}</th>
						<th class="sum-mar">{{$company->count_mar_total}}</th>
						<th class="sum-apr">{{$company->count_apr_total}}</th>
						<th class="sum-may">{{$company->count_may_total}}</th>
						<th class="sum-jun">{{$company->count_jun_total}}</th>
						<th class="sum-jul">{{$company->count_jul_total}}</th>
						<th class="sum-aug">{{$company->count_aug_total}}</th>
						<th class="sum-sep">{{$company->count_sep_total}}</th>
						<th class="sum-oct">{{$company->count_oct_total}}</th>
						<th class="sum-nov">{{$company->count_nov_total}}</th>
						<th class="sum-dec">{{$company->count_dec_total}}</th>
						<th class="sum-count">{{$company->total_all}}</th>
					</tr>
					@endif
					@endforeach
				</table>
			</td>
		</tr>
		@endforeach
		<tr>
			<td>
				<table>
					<tr class="total">
						<th colspan="2">GRAND TOTAL</th>
						<th id="sum-jan">{{$total[0]}}</th>
						<th id="sum-feb">{{$total[1]}}</th>
						<th id="sum-mar">{{$total[2]}}</th>
						<th id="sum-apr">{{$total[3]}}</th>
						<th id="sum-may">{{$total[4]}}</th>
						<th id="sum-jun">{{$total[5]}}</th>
						<th id="sum-jul">{{$total[6]}}</th>
						<th id="sum-aug">{{$total[7]}}</th>
						<th id="sum-sep">{{$total[8]}}</th>
						<th id="sum-oct">{{$total[9]}}</th>
						<th id="sum-nov">{{$total[10]}}</th>
						<th id="sum-dec">{{$total[11]}}</th>
						<th id="sum-count">{{$grand_total_all}}</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>