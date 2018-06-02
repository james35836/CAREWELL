<!DOCTYPE html>
<html lang="en">
    	<head>
        	<title>Payable</title>
        	<style>
            	table,tr,th,td
            	{
                	text-align: center !important;
            	}
            	table.highlight tr td
            	{
            		color: #333;
            	}
            
        	</style>
    	</head>
    	<body>
    		<div>
	        	<table class="highlight">
				<tr>
					<th>PROVIDER</th>
					<td>{{$payable_details->provider_name}}</td>
					<th>SOA NUMBER</th>
					<td>{{$payable_details->payable_soa_number}}</td>
					
				</tr>
				<tr>
					<th>RECIEVED</th>
					<td>{{$payable_details->payable_recieved}}</td>
					<th>DUE DATE</th>
					<td>{{$payable_details->payable_due}}</td>
					
				</tr>
				<tr>
					<th>PREPARATION DATE</th>
					<td>{{date("F j, Y",strtotime($payable_details->payable_created))}}</td>
					<th>PREPARED BY</th>
					<td>{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
					
				</tr>
			</table>
		</div>
		<table>
			<tr>
				<td colspan="20"></td>
			</tr>
		</table>
	    	<div>
	        	<table class="table table-hover table-bordered">
				<tr>
					<th>APPROVAL #</th>
					<th>CAREWELL ID</th>
					<th>MEMBER NAME</th>
					<th>APPROVAL CREATED</th>
					<th>PROCEDURE</th>
					<th>AMOUNT</th>
					<th>PHYSICIAN</th>
					<th>PROFESSIONAL FEE</th>
					<th>D/A</th>
					<th>CHARGE CAREWELL</th>
					<th>REMARKS</th>
				</tr>
				@foreach($_payable_approval as $payable_approval)
				<tr>
					<td>{{$payable_approval->approval_number}}</td>
					<td>{{$payable_approval->member_carewell_id}}</td>
					<td>{{$payable_approval->member_first_name." ".$payable_approval->member_last_name }}</td>
					<td>{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
					<td>
						@foreach($payable_approval->availed as $availed)
						<span class="label label-default">{{$availed->procedure_name }}</span>
						@endforeach
					</td>
					<td>{{$payable_approval->member_carewell_id}}</td>
					<td>
						@foreach($payable_approval->doctor as $doctor)
						<span class="label label-default">{{$doctor->doctor_full_name}}</span>
						@endforeach
					</td>
					<td>{{$payable_approval->doctor_fee}}</td>
					<td>{{$payable_approval->charge_carewell}}</td>
					<td>{{$payable_approval->charge_carewell}}</td>
					<td>{{$payable_approval->charge_carewell}}</td>
				</tr>
				@endforeach
				
			</table>
		</div>
    	</body>
</html>




