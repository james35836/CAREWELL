<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="assets/css/export_excel.css">
		

	</head>
	<body>
		<table class="table table-hover table-bordered sum_table" id="showReport">
			<tr class="titlerow">
				<th></th>
				<th>NUMBER</th>
				<th>AVAILMENT </th>
				<th>YEAR TO DATE</th>
				<th colspan="11">BREAKDOWN OF AVAILMENTS</th>
			</tr>
			<tr class="titlerow">
				<th>COMPANY</th>
				<th>OF MEMBER</th>
				<th>AS OF {{strtoupper(date("F Y",strtotime($date)))}}</th>
				<th>AVAILMENTS</th>
				<th >APE</th>
				<th colspan="2">CONFINEMENT</th>
				<th>CONS/OP</th>
				<th>DENTAL</th>
				<th>LAB</th>
				<th>MO</th>
				<th>FA</th>
				<th>DB</th>
				<th>HIB</th>
				<th>TOTAL</th>
			</tr>
			<tr class="titlerow">
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>MED</th>
				<th>SURG</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			@foreach($_company as $company)
			<tr>
				<td>{{$company->company_name}}</td>
				<td class="sum-mem">{{$company->count_mem}}</td>
				<td>0</td>
				<td>0</td>
				<td class="sum-row sum-ape">{{$company->count_ape}}</td>
				<td class="sum-row sum-cot">{{$company->count_cot}}</td>
				<td class="sum-row sum-emc">{{$company->count_emc}}</td>
				<td class="sum-row sum-con">{{$company->count_con}}</td>
				<td class="sum-row sum-den">{{$company->count_den}}</td>
				<td class="sum-row sum-lab">{{$company->count_lab}}</td>
				<td class="sum-row sum-mop">{{$company->count_mop}}</td>
				<td class="sum-row sum-fas">{{$company->count_fas}}</td>
				<td></td>
				<td></td>
				<td  class="sum-all" id="sum-row">0</td>
			</tr>
			@endforeach
			<tr>
				<td>ACTUAL</td>
				<td id="sum-mem">{{$total_mem}}</td>
				<td>0</td>
				<td>0</td>
				<td id="sum-ape">{{$total_ape}}</td>
				<td id="sum-cot">{{$total_cot}}</td>
				<td id="sum-emc">{{$total_emc}}</td>
				<td id="sum-con">{{$total_con}}</td>
				<td id="sum-den">{{$total_den}}</td>
				<td id="sum-lab">{{$total_lab}}</td>
				<td id="sum-mop">{{$total_mop}}</td>
				<td id="sum-fas">{{$total_fas}}</td>
				<td></td>
				<td></td>
				<td id="sum-all">0</td>
			</tr>
		</table>
	</div>