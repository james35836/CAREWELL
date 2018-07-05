<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Payable</title>
		<link href="{{ public_path('assets/css/export_excel.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="table-header-container">
			<table>
				<tr><th colspan="6">Request for Payments</th></tr>
				<tr><th colspan="6">Carewell Health Systems Inc.</th></tr>
			</table>
		</div>
		<br><br>
		
		<div class="table-top-container">
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
					<td>{{$procedure_total}}</td>
					<th>PHYSICIAN TOTAL:</th>
					<td>{{$doctor_total}}
				</tr>
			</table>
		</div>
		<div class="header-info">
			<table>
				<tr>
					<th colspan="6">APPROVAL LIST</th>
				</tr>
			</table>
		</div>
		<div class="table-body-container">
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
		<br>
		<div class="header-info">
			<table>
				<tr>
					<th colspan="10">PLEASE MAKE PAYABLE TO <span class="highlight-text">"{{$payable_details->provider_name}}"</span> WITH THE AMOUNT OF {{$payable_total}}</th>
				</tr>
			</table>
		</div>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="table-footer-container">
			<table>
				<tr>
					<td colspan="6">Excel Generated : {{date("F j, Y",strtotime(date('Y-m-d')))}}</td>
				</tr>
			</table>
			
		</div>
	</body>
</html>