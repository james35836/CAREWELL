<div class="table-responsive no-padding">
	<table class="table table-hover table-bordered sum_table" id="showReport">
		<tr class="titlerow">
			<th>COMPANY</th>
			<th>NUMBER OF MEMBER</th>
			<th>AVAILMENT AS OF</th>
			<th>YEAR TO DATE AVAIL</th>
			<th>APE</th>
			<th>CONFINEMENT-MED</th>
			<th>CONFINEMENT-SURG</th>
			<th>CONS/OP</th>
			<th>DENTAL</th>
			<th>LAB</th>
			<th>MO</th>
			<th>FA</th>
			<th>DB</th>
			<th>HIB</th>
			<th>TOTAL</th>
		</tr>
		@foreach($_company as $company)
		<tr>
			<td>{{$company->company_name}}</td>
			<td>{{$company->count_mem}}</td>
			<td>DEC-NOV</td>
			<td>DEC-NOV</td>
			<td>CAL 01</td>
			<td>DEC-NOV</td>
			<td>DEC-NOV</td>
			<td>DIGIMA</td>
			<td>DIGIMA</td>
			<td><span class="label label-success">active</span></td>
			<td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
			<td>DEC-NOV</td>
			<td>DEC-NOV</td>
			<td>DIGIMA</td>
			<td>DIGIMA</td>
		</tr>
		@endforeach
		
	</table>
</div>