<!DOCTYPE html>
<html lang="en">
	<head>
		<title>APPROVAL</title>
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
			padding: 5px,0px,5px,0px;
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
			font-size:12px !important;
			font-weight: bold !important;
		}
		div.table-container table td
		{
			font-size:15px !important;
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
			<div class="header-id">APPROVAL ID : {{$approval_details->approval_number}}</div>
		</div>
		<br>
		
		<div class="box-border">
			
			<br>
			<div class="box-border-content">
				<div class="header-text">CALLER INFORMATION</div>
				<div class="table-container">
					<table >
						<tr>
							<td>Caller Name:</td>
							<td>{{$approval_details->user_first_name." ".$approval_details->user_last_name}}</td>
							<td>Date Called:</td>
							<td>{{date("F j, Y",strtotime($approval_details->approval_created))}}</td>
						</tr>
						<tr>
							<td>Caller Number:</td>
							<td>{{$approval_details->user_number}}</td>
							<td>Contact Number:</td>
							<td>{{$approval_details->user_contact_number}}</td>
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
							<td>{{$approval_details->member_first_name." ".$approval_details->member_last_name}}</td>
							<td>Company:</td>
							<td>{{$approval_details->company_name}}</td>
						</tr>
						<tr>
							<td>Universal ID:</td>
							<td>{{$approval_details->member_universal_id}}</td>
							<td>Carewell ID:</td>
							<td>{{$approval_details->member_carewell_id}}</td>
						</tr>
						<tr>
							<td>Birthdate:</td>
							<td>{{$approval_details->member_birthdate}}</td>
							<td>Age:</td>
							<td>{{date_create($approval_details->member_birthdate)->diff(date_create('today'))->y }}</td>
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
							<td colspan="3">{{$approval_details->approval_date_availed}}</td>
						</tr>
						<tr>
							<td colspan="1">Network Provider:</td>
							<td colspan="1">{{$approval_details->provider_name}}</td>
							<td colspan="1">Type of availment:</td>
							<td colspan="1">{{$approval_details->availment_name}}</td>
						</tr>
						<tr>
							<td colspan="1">Cheif Complaint:</td>
							<td colspan="3">{{$approval_details->approval_complaint}}</td>
						</tr>
						<tr>
							<td colspan="1">Initial Diagnosis:</td>
							<td colspan="3">{{$approval_details->diagnosis_name}}</td>
						</tr>
						<tr>
							<td colspan="1">Final Diagnosis:</td>
							<td colspan="3">
								@foreach($_final_diagnosis as $final_diagnosis)
								{{$final_diagnosis->diagnosis_name}}<br>
								@endforeach
							</td>
						</tr>
						<tr>
							<td colspan="1">Charge:</td>
							<td colspan="3">{{$charge_diagnosis->diagnosis_name}}</td>
						</tr>
					</table>
				</div>
			</div>
			@if($approval_details->availment_id!=4)
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
						
						@foreach($_availed as $availed)
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
							<td>{{$procedure_gross_amount}}</td>
							<td>Total Philhealth Charity:</td>
							<td>{{$procedure_philhealth}}</td>
						</tr>
						<tr>
							<td>Total Charge to Patient:</td>
							<td>{{$procedure_charge_patient}}</td>
							<td>Total Charge to Carewell:</td>
							<td>{{$procedure_charge_carewell}}</td>
						</tr>
					</table>
				</div>
			</div>
			@endif
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
						@foreach($_doctor_assigned as $doctor_assigned)
						<tr >
							<td>{{$doctor_assigned->doctor_full_name}}</td>
							{{-- <td >{{$doctor_assigned->specialization_name}}</td> --}}
							<td >{{$approval_details->provider_rvs}}</td>
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
							<td >{{$approval_doctor_actual_pf}}</td>
							<td >Total Charge to Patient:</td>
							<td >{{$approval_doctor_phil_charity}}</td>
						</tr>
						<tr>
							<td >Total Philhealth Charity:</td>
							<td >{{$approval_doctor_charge_patient}}</td>
							<td >Total Charge to Carewell:</td>
							<td >{{$approval_doctor_charge_carewell}}</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="box-border-content">
				<div class="header-text">
					PAYEE INFORMATION
				</div>
				<div class="table-container">
					<table>
						<thead>
							<tr>
								<th>PAYEE NAME</th>
								<th>AMOUNT</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$approval_details->provider_name}}</td>
								<td>{{$payee_company}}</td>
							</tr>
							@foreach($_doctor_assigned as $doctor_assigned)
							<tr>
								<td>{{$doctor_assigned->doctor_full_name}}</td>
								<td>{{$doctor_assigned->approval_doctor_charge_carewell}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="box-border-content">
				<div class="header-text">
					GRAND TOTAL  = {{$grand_total}}
				</div>
			</div>
		</div>
		
	</div>
	<br>
	
	<br>
	
	<div class="pdf-footer">PDF GENERATED : {{date("F j, Y",strtotime(date('Y-m-d')))}}</div>
</body>
</html>