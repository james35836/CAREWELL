<!DOCTYPE html>
<html lang="en">
	<head>
		<title>COVERAGE PLAN</title>
		<style>
		@page
		{
			/*size: Legal landscape;*/
			margin: 0.4in;
		}
		</style>
		<link href="{{ public_path('assets/css/export_pdf.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="header-container">
			<div class="header-text">CAREWELL</div>
			<div class="header-text">COVERAGE PLAN</div>
			<div class="header-text">{{$coverage_plan_details->coverage_plan_name}}</div>
		</div>
		<br><br><br><br>
		<div class="box-border">
			<div class="box-border-content">
				
				<div class="table-container">
					<table>
						<tr>
							<th>Coverage Plan Name:</th>
							<td>{{$coverage_plan_details->coverage_plan_name}}</td>
							<th>Premium:</th>
							<td>{{$coverage_plan_details->coverage_plan_premium}}</td>
						</tr>
						<tr>
							<th>Age Bracket:</th>
							<td>{{$coverage_plan_details->coverage_plan_age_bracket}}</td>
							<th>Case Handling Fee:</th>
							<td>{{$coverage_plan_details->coverage_plan_case_handling}}</td>
						</tr>
						<tr>
							<th>Processing Fee:</th>
							<td>{{$coverage_plan_details->coverage_plan_processing_fee}}</td>
							<th>CARI Fee:</th>
							<td>{{$coverage_plan_details->coverage_plan_cari_fee}}</td>
						</tr>
						<tr>
							<th>HIB:</th>
							<td>{{$coverage_plan_details->coverage_plan_hib}}</td>
							<th>Pre-Existing:</th>
							<td>{{$coverage_plan_details->coverage_plan_name}}</td>
						</tr>
						<tr>
							<th>ABL:</th>
							<td>{{$coverage_plan_details->coverage_plan_annual_benefit}}</td>
							<th>MBL:</th>
							<td>{{$coverage_plan_details->coverage_plan_maximum_benefit}}</td>
						</tr>
					</table>
				</div>
				
			</div>
			<div class="checkbox-info" >
				<label><input type="checkbox" @if($coverage_plan_details->coverage_plan_mbl_illness=="on") checked @endif/>&nbsp;&nbsp;PER ILLNESS/DESEASE</label>
			</div>
			<div class="checkbox-info" >
				<label><input type="checkbox" @if($coverage_plan_details->coverage_plan_mbl_year=="on") checked @endif/>&nbsp;&nbsp;PER YEAR</label>
			</div>
		</div>
		<br>
		<div class="header-container">
			<div class="header-text">TYPE OF BENEFITS</div>
		</div>
		<br>
		<div>
			@foreach($_coverage_plan_covered as $coverage_plan_covered)
			<div class="box-border">
				<div class="box-border-content">
					<div class="header-text">
						{{$coverage_plan_covered->availment_name}}
					</div>
					<div class="table-container">
						<table >
							<tr>
								<th>PROCEDURE</th>
								<th >CHARGE</th>
								<th>AMOUNT COVERED</th>
								<th>LIMIT</th>
							</tr>
							@foreach($coverage_plan_covered->procedure as $procedure)
							<tr>
								<td>
									{{$procedure->procedure_name}}
								</td>
								<td>
									{{$procedure->plan_charges}}
								</td>
								<td>
									{{number_format($procedure->plan_covered_amount)}}
								</td>
								<td>
									{{$procedure->plan_limit}}
								</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
				
			</div>
			@endforeach
		</div>
		<br>
		
		<br><br><br><br><br><br>
		<div class="pdf-footer">PDF GENERATED : {{date("F j, Y",strtotime(date('Y-m-d')))}}</div>
	</body>
</html>
