<script>
$(function ()
{
	$('.select2').select2()
	$('.datepicker').datepicker(
	{
	autoclose: true
	})
	//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
$(".add-procedure").on("click", function() {
$(".procedure-form").append('<tr><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><span class="label label-success">active</span></td></tr>');
});
$(".remove-procedure").on("click", function() {
	if ($(".procedure-form tr").length != 1)
	{
			$(".procedure-form tr:last").remove();
			}
	
});
});
})
</script>
<div class="row box-globals">
	<div class="col-md-8 pull-left top-label" style="">
		<p>APPROVAL ID  : {{$approval_details->approval_number}}</p>
	</div>
	<div class="col-md-4 pull-right">
		<button type="button" data-transaction_member_id="{{$approval_details->approval_id}}" class="btn btn-primary button-lg transaction-details" ><i class="fa fa-file-pdf-o btn-icon"></i>EXPORT PDF</button>
	</div>
</div>
<div class="row box-globals" >
	<form class="member-submit-form" method="post" id="insertUser">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<input type="text" class="form-control" value="{{$approval_details->user_first_name." ".$approval_details->user_last_name}}"  disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Date Called</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{date("F j, Y",strtotime($approval_details->approval_created))}}"  disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller NUMBER</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->user_number}}" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control"  value="{{$approval_details->user_contact_number}}" disabled/>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals" >
	<form class="member-submit-form" method="post" id="insertMember">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<input type="text" class="form-control" value="{{$approval_details->member_first_name." ".$approval_details->member_last_name}}"  disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Company</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->company_name}}"  disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Universal ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->member_universal_id}}" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Carewell ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control"  value="{{$approval_details->member_carewell_id}}" disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->member_birthdate}}" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Age</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{date_create($approval_details->member_birthdate)->diff(date_create('today'))->y }}" disabled/>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals">
	<form class="approval-submit-form" method="post">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->provider_name}}" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Type of availment</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->availment_name}}" disabled/>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Cheif Complaint</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" disabled>{{$approval_details->approval_complaint}}</textarea>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Initial Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" class="form-control" value="{{$approval_details->approval_initial_diagnosis}}" disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" class="form-control" value="{{$approval_details->approval_final_diagnosis}}" disabled/>
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</form>
	<div class="form-holder">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
						<th>DESCRIPTION</th>
						<th>GROSS AMOUNT</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>CHARGE TO CAREWELL</th>
						<th>ASSIGNED DIAGNOSIS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($_availed as $availed)
					<tr>
						<td><input type="text" class="form-control" value="{{$availed->procedure_name}}" disabled/></td>
						<td><input type="text" name="procedure_gross_amount[]" id="" class="form-control" value="{{$availed->procedure_gross_amount}}" disabled/></td>
						<td><input type="text" name="procedure_philhealth[]" id="" class="form-control" value="{{$availed->procedure_philhealth}}" disabled/></td>
						<td><input type="text" name="procedure_charge_patient[]" id="" class="form-control" value="{{$availed->procedure_charge_patient}}" disabled/></td>
						<td><input type="text" name="procedure_charge_carewell[]" id="" class="form-control" value="{{$availed->procedure_charge_carewell}}" disabled/></td>
						<td><input type="text" name="diagnosis_name[]" id="" class="form-control" value="{{$availed->diagnosis_name}}" disabled/></td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Gross Amount</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" id="total_gross_amount">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" id="total_philhealth">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" id="total_charge_patient">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" id="total_charge_carewell">
			</div>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
	</div>
	<div class="form-holder">
		
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
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
					<tr>
						<td><input type="text" class="form-control" value="{{$doctor_assigned->doctor_first_name." ".$doctor_assigned->doctor_last_name}}" disabled/></td>
						<td><input type="text" name="[]" class="form-control" value="{{$doctor_assigned->specialization_name}}" disabled/></td>
						<td><input type="text" name="approval_doctor_actual_pf[]" class="form-control" value="{{$doctor_assigned->approval_doctor_actual_pf}}" disabled/></td>
						<td><input type="text" name="procedure[]" class="form-control" value="{{$doctor_assigned->doctor_procedure_descriptive}}" disabled/></td>
						<td><input type="text" name="approval_doctor_rate_rvs[]" class="form-control" value="201" disabled/></td>
						<td><input type="text" name="approval_doctor_phil_charity[]" class="form-control" value="{{$doctor_assigned->approval_doctor_phil_charity}}" disabled/></td>
						<td><input type="text" name="approval_doctor_charge_patient[]" class="form-control" value="{{$doctor_assigned->approval_doctor_charge_patient}}" disabled/></td>
						<td><input type="text" name="approval_doctor_charge_carewell[]" class="form-control" value="{{$doctor_assigned->approval_doctor_charge_carewell}}" disabled/></td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Actual PF Charges</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" id="" class="form-control">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control">
			</div>
		</div>
		
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder col-md-6">
		<div class="form-content col-md-2">
			<label>Payee</label>
		</div>
		<div class="form-content col-md-10 form-element">
			@foreach($_payee as $payee)
			<div class="my-element">
				<input type="text" class="form-control" value="{{$payee->provider_payee_name}}">
			</div>
			@endforeach
		</div>
	</div>
</div>