<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Payable</title>
		<style>
		@page
		{
			size: Legal landscape;
			margin: 0.4in;
		}
		body
		{
			font-family:sans-serif;
		}
		div.header-container
		{
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;

		}
		div.header-text
		{
			text-align: center;
			font-size: 15px;
			font-weight: bold;
		}
		div.box-content-id
		{
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}
		div.header-id
		{
			position: absolute;
			right: 5px;

		}
		div.box-border
		{
			border:1px solid black;
		}
		table, th, td
		{
			text-align: center;
			border: 1px solid gray;
			border-collapse: collapse;
			width:100%;
		}
		div.table-container table th
		{
			font-size:13px !important;
			font-weight: bold !important;
		}
		div.table-container table td
		{
			font-size:13px !important;
		}
		div.pdf-footer
		{
			font-size:8px !important;
			font-weight: bold !important;
			text-align: center;
			margin-top:30px;
		}
		</style>

	</head>
	<body>
		<div class="header-container">
			<div class="header-text">Request for Payments</div>
			<div class="header-text">Carewell Health Systems Inc.</div>
			<div class="header-text">Ajudication Forms</div>
		</div>
		<br><br><br><br>
		
		<div class="box-border">
			<div class="box-border-content">
				
				<div class="table-container">
					<table>
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
						<tr>
							<th>PROCEDURE TOTAL:</th>
							<td>{{$procedure_charge_carewell}}</td>
							<th>PHYSICIAN TOTAL:</th>
							<td>{{$approval_doctor_charge_carewell}}
						</tr>
					</table>
				</div>
				
			</div>
			
		</div>
		<br>
		<div class="header-container">
			<div class="header-text">APPROVAL LIST</div>
		</div>
		<br>
		<div>
			
			<div class="box-border">
				<div class="box-border-content">
					<div class="table-container">
						<table >
							<tr>
								<th>No.</th>
								<th>Px</th>
								<th>Ap No.</th>
								<th>Co</th>
								<th>Date</th>
								<th>Dx</th>
								<th>Lab</th>
								<th>Amt</th>
								<th>Phy</th>
								<th>PF</th>
								<th>D/A</th>
								<th>C/o CW</th>
								<th>REMARKS</th>
							</tr>
							@foreach($_payable_approval as $key=>$payable_approval)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$payable_approval->member_first_name." ".$payable_approval->member_last_name}}</td>
								<td>{{$payable_approval->approval_number}}</td>
								<td>{{$payable_approval->member_carewell_id}}</td>
								<td>{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
								<td>{{$payable_approval->diagnosis_name}}</td>
								<td>
									@foreach($payable_approval->_availed as $availed)
									{{$availed->procedure_name}},
									@endforeach
								</td>
								<td>{{$payable_approval->procedure_charge_carewell}}</td>
								<td>
									@foreach($payable_approval->_doctor_assigned as $doctor_assigned)
									{{$doctor_assigned->doctor_full_name}},
									@endforeach
								</td>
								<td>{{$payable_approval->approval_doctor_charge_carewell}}</td>
								<td>{{$payable_approval->disapproved}}</td>
								<td>{{$payable_approval->grand_total}}</td>
								<td>{{$payable_approval->procedure_remarks}}</td>
								
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
			

		</div>
		<br>
		<div class="header-container">
			<div class="header-text">PLEASE MAKE PAYABLE TO JAMES OMOSORA WITH THE AMOUNT OF 30000</div>
		</div>
		<br><br>
		<div class="box-border">
			<div class="box-border-content">
					<div class="table-container">
						<table >
							<tr>
								<th>Check and Verified By</th>
								<th>Validated By</th>
								<th>Noted BY</th>
								<th>Audited By</th>
								<th>Noted By</th>
							</tr>
							<tr>
								<td colspan="1" >{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
								<td colspan="1" >{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
								<td colspan="1" >{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
								<td colspan="1" >{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
								<td colspan="1" >{{$payable_details->user_first_name." ".$payable_details->user_last_name }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
		<div class="pdf-footer">PDF GENERATED : {{date("F j, Y",strtotime(date('Y-m-d')))}}</div>
	</body>
</html>