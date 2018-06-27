<table class="table table-bordered">
	<thead>
		<tr>
			<th>LAST NAME</th>
			<th>FIRST NAME</th>
			<th>MIDDLE NAME</th>
			<th>BIRTHDATE</th>
			<th>COVERAGE PLAN</th>
			<th>DEPLOYMENT</th>
			<th>MODE OF PAYMENT</th>
			<th>PAYMENT AMOUNT</th>
		</tr>
	</thead>
	<tbody>
		@foreach($_company_member as $company_member)
		<tr>
			<td>{{$company_member->member_last_name}}</td>
			<td>{{$company_member->member_first_name}}</td>
			<td>{{$company_member->member_middle_name}}</td>
			<td>{{$company_member->member_birthdate}}</td>
			<td>{{$company_member->coverage_plan_name}}</td>
			<td>{{$company_member->deployment_name}}</td>
			<td>{{$company_member->member_payment_mode}}</td>
			<td>{{$company_member->coverage_plan_premium}}</td>
		</tr>
		@endforeach
	</tbody>
</table>