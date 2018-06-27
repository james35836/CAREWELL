<style type="text/css">
	body
	{
		font-family: sans-serif;
	}
	table
	{
		border-collapse: collapse;
		width: 100%;
	}
	table,th, td
	{
		border: 1px solid black;
		padding:2px;
	}
	td, th
	{
		padding-left:5px
	}
	@page
	{
		size: A4;
		margin: 0.4in;
	}
	.center
	{
		text-align: center;
	}
</style>
<table>
	<tr>
		<th colspan="4"><h2>COVERAGE PLAN DETAILS</h2></th>
	</tr>
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
	<tr>
		<td height="10" colspan="4"></td>
	</tr>
	<tr>
		<th colspan="4" class="center">TYPES OF AVAILMENT</th>
	</tr>
	<tr>
		<td height="10" colspan="4"></td>
	</tr>
	@foreach($_coverage_plan_covered as $coverage_plan_covered)
	<tr>
		<th colspan="4" class="center" height="20">{{$coverage_plan_covered->availment_name}}</th>
	</tr>
	<tr>
		<th class="center">PROCEDURE</th>
		<th class="center"	>CHARGE</th>
		<th class="center">AMOUNT COVERED</th>
		<th class="center">LIMIT</th>
	</tr>
	@foreach($coverage_plan_covered->procedure as $procedure)
	<tr>
		<td>{{$procedure->procedure_name}}</td>
		<td class="center">{{$procedure->plan_charges}}</td>
		<td class="center">{{number_format($procedure->plan_covered_amount)}}</td>
		<td class="center">{{$procedure->plan_limit}}</td>
	</tr>
	@endforeach
	@endforeach
</table>