<style type="text/css">
	.all
	{
		font-family: sans-serif;
		color:black;
	}

	.group_border
	{
		border-bottom: solid 2px black;
	}

	.set_table
	{
		width: 100%;
	}
	.align_text_td
	{
		text-align: center;
	}
	table, th, td
	{
		margin: auto;
		border-collapse: collapse;
		border: solid 1px black;
	}
	td
	{
		padding-left: 5px;
	}
	.td_width
	{
		width: 25%;
	}

	th
	{
		font-size: 12px;
	}

	p
	{
		text-align: center;
	}

	.td_align_text_static
	{
		font-size:13px;
		/*padding-left: 5px;*/
	}
	@page {
    size: Legal;
    margin: 0.4in;
	}

</style>


<div class="all">

	<p class="group_border" style="text-align: left!important">APPROVAL ID  : <strong>{{$approval_details->approval_number}}</strong></p>

	<div class="group_borderx">
		<p><strong>-CALLER INFORMATION-</strong></p>
		<table class="set_table">
			<tr>
				<td class="td_align_text_static">Caller Name:</td>
				<td>{{$approval_details->user_first_name." ".$approval_details->user_last_name}}</td>	
				<td class="td_align_text_static">Date Called:</td>	
				<td>{{date("F j, Y",strtotime($approval_details->approval_created))}}</td>
			</tr>
			<tr>
				<td class="td_align_text_static">Caller Number:</td>
				<td>{{$approval_details->user_number}}</td>
				<td class="td_align_text_static">Contact Number:</td>
				<td>{{$approval_details->user_contact_number}}</td>
			</tr>
		</table>
	</div>

	<div class="group_borderx">
		<p><strong>-MEMBER INFORMATION-</strong></p>
		<table class="set_table">
			<tr>
				<td class="td_align_text_static">Name:</td>
				<td>{{$approval_details->member_first_name." ".$approval_details->member_last_name}}</td>
				<td class="td_align_text_static">Company:</td>
				<td>{{$approval_details->company_name}}</td>
			</tr>
			<tr>
				<td class="td_align_text_static">Universal ID:</td>
				<td>{{$approval_details->member_universal_id}}</td>
				<td class="td_align_text_static">Carewell ID:</td>
				<td>{{$approval_details->member_carewell_id}}</td>
			</tr>
			<tr>
				<td class="td_align_text_static">Birthdate:</td>
				<td>{{$approval_details->member_birthdate}}</td>
				<td class="td_align_text_static">Age:</td>
				<td>{{date_create($approval_details->member_birthdate)->diff(date_create('today'))->y }}</td>
			</tr>
		</table>
	</div>
	
	<div class="group_borderx">
		<p><strong>-AVAILMENT INFORMATION-</strong></p>
		<table class="set_table">
			<tr>
				<td colspan="1" class="td_align_text_static">Availment Date:</td>
				<td colspan="3">{{$approval_details->approval_date_availed}}</td>
			</tr>
			<tr>
				<td colspan="1" class="td_width td_align_text_static">Network Provider:</td>
				<td colspan="1" class="align_text_td td_width">{{$approval_details->provider_name}}</td>
				<td colspan="1" class="td_width td_align_text_static" >Type of availment:</td>
				<td colspan="1" class="align_text_td td_width">{{$approval_details->availment_name}}</td>
			</tr>
			<tr>
				<td colspan="1" class="td_width td_align_text_static">Cheif Complaint:</td>
				<td colspan="3" class="td_align_text_static">{{$approval_details->approval_complaint}}</td>
			</tr>
			<tr>
				<td colspan="1" class="td_align_text_static">Initial Diagnosis:</td>
				<td colspan="3">{{$approval_details->diagnosis_name}}</td>
			</tr>
			<tr>
				<td colspan="1" class="td_align_text_static">Final Diagnosis:</td>
				<td colspan="3">
					@foreach($_final_diagnosis as $final_diagnosis)
						{{$final_diagnosis->diagnosis_name}}<br>
					@endforeach
				</td>
			</tr>
			<tr>
				<td colspan="1" class="td_align_text_static">Charge:</td>
				<td colspan="3">{{$charge_diagnosis->diagnosis_name}}</td>
			</tr>
		</table>
	</div>

	<div class="group_borderx">
		<p style="text-align:center;"><strong>-PROCEDURE-</strong></p>
			<table class="set_table">
				<thead>
					<tr class="align_text_td">
						<th>DESCRIPTION</th>
						<th>GROSS AMOUNT</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>CHARGE TO CAREWELL</th>
					</tr>
				</thead>
				<tbody>
					@foreach($_availed as $availed)
					<tr class="align_text_td">
						<td class=" td_align_text_static">{{$availed->procedure_name}}</td>
						<td>{{$availed->procedure_gross_amount}}</td>
						<td>{{$availed->procedure_philhealth}}</td>
						<td>{{$availed->procedure_charge_patient}}</td>
						<td>{{$availed->procedure_charge_carewell}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		<br>
			<table class="set_table">
				<tr>
					<td class="td_width td_align_text_static" >Total Gross Amount:</td>
					<td class="align_text_td td_width">{{$total_procedure->total_gross_amount}}</td>	
					<td class="td_width td_align_text_static">Total Philhealth Charity:</td>
					<td class="align_text_td td_width">{{$total_procedure->total_philhealth}}</td>					
				</tr>
				<tr>
					<td class="td_width td_align_text_static">Total Charge to Patient:</td>
					<td class="align_text_td td_width">{{$total_procedure->total_charge_patient}}</td>
					<td class="td_width td_align_text_static">Total Charge to Carewell:</td>
					<td class="align_text_td td_width">{{$total_procedure->total_charge_carewell}}</td>
				</tr>
			</table>
	</div>

	<div class="group_borderx">
		<p><strong>-PHYSICIAN-</strong></p>
			<table>
				<thead>
					<tr class="align_text_td">
						<th>PHYSICIAN</th>
						<th>SPECIALIZATION</th>
						<th>RATE/R VS</th>
						<th>PROCEDURE</th>
						<th>ACTUAL PF CHARGES</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>CHARGE TO CAREWELL</th>
					</tr>
				</thead>
				<tbody>
					@foreach($_doctor_assigned as $doctor_assigned)
					<tr class="align_text_td">
						<td class="td_align_text_static">{{$doctor_assigned->doctor_full_name}}</td>
						<td >{{$doctor_assigned->specialization_name}}</td>
						<td >{{$approval_details->provider_rvs}}</td>
						<td class="td_align_text_static">{{$doctor_assigned->doctor_procedure_descriptive}}</td>
						<td >{{$doctor_assigned->approval_doctor_actual_pf}}</td>
						<td >{{$doctor_assigned->approval_doctor_phil_charity}}</td>
						<td >{{$doctor_assigned->approval_doctor_charge_patient}}</td>
						<td >{{$doctor_assigned->approval_doctor_charge_carewell}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<br>
			<table class="set_table">
				<tr>
					<td class="td_width td_align_text_static">Total Gross Amount:</td>
					<td class="td_width align_text_td">{{$total_doctor->total_gross_amount}}</td>
					<td class="td_width td_align_text_static">Total Charge to Patient:</td>
					<td class="td_width align_text_td">{{$total_doctor->total_charge_patient}}</td>
				</tr>
				<tr>
					<td class="td_width td_align_text_static">Total Philhealth Charity:</td>
					<td class="td_width align_text_td">{{$total_doctor->total_philhealth}}</td>
					<td class="td_width td_align_text_static">Total Charge to Carewell:</td>
					<td class="td_width align_text_td">{{$total_doctor->total_charge_carewell}}</td>
				</tr>
			</table>
	</div>

	<div class="group_borderx">
		<p><strong>-PAYEE-</strong></p>
		<table class="set_table">
			<tr>
				<td colspan="1" class="td_width td_align_text_static">Doctor Payee:</td>
				<td colspan="3">
					@foreach($_payee_doctor as $payee_doctor)
						{{$payee_doctor->doctor_full_name}}<br>
					@endforeach
				</td>
			</tr>
			<tr>
				<td colspan="1" class="td_width td_align_text_static">Other Payee:</td>
				<td colspan="3">
					@foreach($_payee_other as $payee_other)
						{{$payee_other->payee_name}}<br>
					@endforeach
				</td>
			</tr>
		</table>
	</div>
</div>

