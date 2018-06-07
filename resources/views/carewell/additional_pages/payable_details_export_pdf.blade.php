<!DOCTYPE html>
<html lang="en">
<head>
	<title>Payable</title>
	<style>
	body
	{
		font-family:sans-serif;
	}
	@page 
	{
		size: Legal landscape;
		margin: 0.4in;
	}
	table
	{
		border-collapse: collapse;
		width:100%;
	}
	table, th, td
	{
		border: 1px solid black;
	}

	div table.payable-header
	{
		text-align: center;
	}	
	.td-static
	{
		padding-left: 10px;
		font-weight: bold;
	}

	.center-text
	{
		text-align: center;
		font-size: 19px;
	}

	.center-text-sub
	{
		font-size: 15px;
		text-align: center;
	}

	.padding-text-sub
	{
		padding: 5px,0px,5px,0px;
	}



</style>
</head>
<body>
	<div>
		<h2>PAYABLE DETAILS<hr></h2>
	</div>
	<div>
		<table class="payable-header">
			<tr>
				<th>PROVIDER:</th>
				<td>{{$payable_details->provider_name}}</td>
				<th>SOA NUMBER:</th>
				<td>{{$payable_details->payable_soa_number}}</td>
			</tr>
			<tr>
				<th>RECIEVED:</th>
				<td>{{$payable_details->payable_recieved}}</td>
				<th>DUE DATE:</th>
				<td>{{$payable_details->payable_due}}</td>
			</tr>
			<tr>
				<th>PREPARATION DATE:</th>
				<td>{{date("F j, Y",strtotime($payable_details->payable_created))}}</td>
				<th>PREPARED BY:</th>
				<td>{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
			</tr>
		</table>
	</div>
	<div>
		<h2>APPROVAL LIST<hr></h2>
	</div>
	<div>
		@foreach($_payable_approval as $payable_approval)
		<table>
				<tr>
					<td rowspan="3" colspan="2" class="center-text"><span class="td-static">MEMBER NAME:</span>
						{{$payable_approval->member_first_name." ".$payable_approval->member_last_name }} 
					</td>
					<td class="td-static">APPROVAL #:</td>
					<td class="padding-text-sub">{{$payable_approval->approval_number}}</td>
				</tr>
				<tr>
					<td class="td-static">CAREWELL ID:</td>
					<td class="padding-text-sub">{{$payable_approval->member_carewell_id}}</td>
				</tr>
				<tr>
					<td class="td-static">APPROVAL CREATED:</td>
					<td class="padding-text-sub">{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
				</tr>
				<tr>
					<td class="td-static">PHYSICIAN:</td>
					<td class="padding-text-sub">
						@foreach($payable_approval->doctor as $doctor)
						<span>{{$doctor->doctor_full_name}}</span><br>
						@endforeach
					</td>
					<td class="td-static">PROCEDURE:</td>
					<td class="padding-text-sub">
						@foreach($payable_approval->availed as $availed)
						<span>{{$availed->procedure_name }}</span><br>
						@endforeach
					</td>
				</tr>
				<tr>
					<td class="center-text-sub"><span class="td-static">PROFESSIONAL FEE:</span><br>
						{{$payable_approval->doctor_fee}}
					</td>
					<td class="center-text-sub"><span class="td-static">D/A:</span><br>
						{{$payable_approval->charge_carewell}}
					</td>
					<td class="center-text-sub"><span class="td-static">CHARGE TO CAREWELL:</span><br>
						{{$payable_approval->charge_carewell}}
					</td>
					<td class="center-text-sub"><span class="td-static">AMOUNT:</span><br>
						{{$payable_approval->charge_carewell}}
					</td>
				</tr>
				<tr>
					<td colspan="4"><span class="td-static">REMARKS:</span><br>
						<span>
							<p class="padding-text-sub">	
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi volutpat fermentum metus nec congue. Etiam vestibulum velit ut ullamcorper tristique. Morbi at erat in magna interdum porta ut consequat nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi est mi, viverra ac accumsan sed, ultricies vitae dolor. Curabitur tempus at quam hendrerit venenatis. Etiam elementum orci eu mauris feugiat, sed suscipit sapien suscipit. In ipsum ante, convallis vel quam ac, accumsan ultricies sapien. Curabitur consequat ultrices ante id faucibus. Vestibulum lobortis odio sit amet ultricies feugiat. In hac habitasse platea dictumst. Cras quam urna, aliquam volutpat eleifend condimentum, rhoncus et ante.
							</p>
						</span>
						
					</td>
				</tr>
		</table>
		<br>

		@endforeach
	</div>
</body>
</html>