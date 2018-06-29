<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Payable</title>
		<style>
		@page
		{
			/*size: Legal landscape;*/
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
			font-size:13px !important;
			font-weight: bold !important;
			text-align: center;
			margin-top:30px;
		}
		</style>

	</head>
	<body>
		<div class="header-container">
			<div class="header-text">PAYABLES</div>
			<div class="header-text">Carewell Health Systems Inc.</div>
			<div class="header-text">Availment Forms</div>
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
							<td>{{$procedure_total}}</td>
							<th>PHYSICIAN TOTAL:</th>
							<td>{{$doctor_total}}
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
			@foreach($_payable_approval as $payable_approval)
			<div class="box-border">
				<div class="box-content-id">
					<div class="header-id">APPROVAL ID  : <strong>{{$payable_approval->approval_number}}</strong></div>
				</div>
				<br>
				<div class="box-border-content">
					<div class="header-text">CALLER INFORMATION</div>
					<div class="table-container">
						<table >
							<tr>
								<td>Caller Name:</td>
								<td>{{$payable_approval->user_first_name." ".$payable_approval->user_last_name}}</td>
								<td>Date Called:</td>
								<td>{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
							</tr>
							<tr>
								<td>Caller Number:</td>
								<td>{{$payable_approval->user_number}}</td>
								<td>Contact Number:</td>
								<td>{{$payable_approval->user_contact_number}}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						MEMBER INFORMATION
					</div>
					<div class="table-container">
						<table >
							<tr>
								<td>Name:</td>
								<td>{{$payable_approval->member_first_name." ".$payable_approval->member_last_name}}</td>
								<td>Company:</td>
								<td>{{$payable_approval->company_name}}</td>
							</tr>
							<tr>
								<td>Universal ID:</td>
								<td>{{$payable_approval->member_universal_id}}</td>
								<td>Carewell ID:</td>
								<td>{{$payable_approval->member_carewell_id}}</td>
							</tr>
							<tr>
								<td>Birthdate:</td>
								<td>{{$payable_approval->member_birthdate}}</td>
								<td>Age:</td>
								<td>{{date_create($payable_approval->member_birthdate)->diff(date_create('today'))->y }}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						AVAILMENT INFORMATION
					</div>
					<div class="table-container">
						<table >
							<tr>
								<td colspan="1">Availment Date:</td>
								<td colspan="3">{{$payable_approval->approval_date_availed}}</td>
							</tr>
							<tr>
								<td colspan="1">Network Provider:</td>
								<td colspan="1">{{$payable_approval->provider_name}}</td>
								<td colspan="1">Type of availment:</td>
								<td colspan="1">{{$payable_approval->availment_name}}</td>
							</tr>
							<tr>
								<td colspan="1">Cheif Complaint:</td>
								<td colspan="3">{{$payable_approval->approval_complaint}}</td>
							</tr>
							<tr>
								<td colspan="1">Initial Diagnosis:</td>
								<td colspan="3">{{$payable_approval->diagnosis_name}}</td>
							</tr>
							<tr>
								<td colspan="1">Final Diagnosis:</td>
								<td colspan="3">
									@foreach($payable_approval->_final_diagnosis as $final_diagnosis)
									{{$final_diagnosis->diagnosis_name}}<br>
									@endforeach
								</td>
							</tr>
							<tr>
								<td colspan="1">Charge:</td>
								<td colspan="3">{{$payable_approval->charge_diagnosis->diagnosis_name}}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						PROCEDURE
					</div>
					<div class="table-container">
						<table >
							<tr >
								<th>DESCRIPTION</th>
								<th>GROSS AMOUNT</th>
								<th>PHILHEALTH CHARITY/SWA</th>
								<th>CHARGE TO PATIENT</th>
								<th>CHARGE TO CAREWELL</th>
								<th>REMARKS</th>
							</tr>
							
							@foreach($payable_approval->_availed as $availed)
							<tr >
								<td>{{$availed->procedure_name}}</td>
								<td>{{$availed->procedure_gross_amount}}</td>
								<td>{{$availed->procedure_philhealth}}</td>
								<td>{{$availed->procedure_charge_patient}}</td>
								<td>{{$availed->procedure_charge_carewell}}</td>
								<td>{{$availed->procedure_remarks}}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						PROCEDURE COMPUTATION
					</div>
					<div class="table-container">
						<table >
							<tr>
								<td>Total Gross Amount:</td>
								<td>{{$payable_approval->total_procedure->total_gross_amount}}</td>
								<td>Total Philhealth Charity:</td>
								<td>{{$payable_approval->total_procedure->total_philhealth}}</td>
							</tr>
							<tr>
								<td>Total Charge to Patient:</td>
								<td>{{$payable_approval->total_procedure->total_charge_patient}}</td>
								<td>Total Charge to Carewell:</td>
								<td>{{$payable_approval->total_procedure->total_charge_carewell}}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						PHYSICIAN
					</div>
					<div class="table-container">
						<table >
							<tr >
								<th>PHYSICIAN</th>
								{{-- <th>SPECIALIZATION</th> --}}
								<th>RATE/R VS</th>
								<th>PROCEDURE</th>
								<th>ACTUAL PF CHARGES</th>
								<th>PHILHEALTH CHARITY/SWA</th>
								<th>CHARGE TO PATIENT</th>
								<th>CHARGE TO CAREWELL</th>
							</tr>
							@foreach($payable_approval->_doctor_assigned as $doctor_assigned)
							<tr >
								<td>{{$doctor_assigned->doctor_full_name}}</td>
								{{-- <td >{{$doctor_assigned->specialization_name}}</td> --}}
								<td >{{$payable_approval->provider_rvs}}</td>
								<td>{{$doctor_assigned->doctor_procedure_descriptive}}</td>
								<td >{{$doctor_assigned->approval_doctor_actual_pf}}</td>
								<td >{{$doctor_assigned->approval_doctor_phil_charity}}</td>
								<td >{{$doctor_assigned->approval_doctor_charge_patient}}</td>
								<td >{{$doctor_assigned->approval_doctor_charge_carewell}}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						PHYSICIAN COMPUTATION
					</div>
					<div class="table-container">
						<table >
							<tr>
								<td >Total Gross Amount:</td>
								<td >{{$payable_approval->total_doctor->total_gross_amount}}</td>
								<td >Total Charge to Patient:</td>
								<td >{{$payable_approval->total_doctor->total_charge_patient}}</td>
							</tr>
							<tr>
								<td >Total Philhealth Charity:</td>
								<td >{{$payable_approval->total_doctor->total_philhealth}}</td>
								<td >Total Charge to Carewell:</td>
								<td >{{$payable_approval->total_doctor->total_charge_carewell}}</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-border-content">
					<div class="header-text">
						PAYEE INFORMATION
					</div>
					<div class="table-container">
						<table >
							<tr>
								<td colspan="1" >Doctor Payee:</td>
								<td colspan="3">
									@foreach($payable_approval->_payee_doctor as $payee_doctor)
									{{$payee_doctor->doctor_full_name}}<br>
									@endforeach
								</td>
							</tr>
							<tr>
								<td colspan="1" >Other Payee:</td>
								<td colspan="3">
									@foreach($payable_approval->_payee_other as $payee_other)
									{{$payee_other->payee_name}}<br>
									@endforeach
								</td>
							</tr>
						</table>
					</div>
				</div>
				
			</div>
		</div>
		<br>
		@endforeach
		<div class="pdf-footer">PDF GENERATED : {{date("F j, Y",strtotime(date('Y-m-d')))}}</div>
	</body>
</html>