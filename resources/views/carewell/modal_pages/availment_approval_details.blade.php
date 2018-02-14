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
				<label>Caller ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->user_id_number}}" disabled/>
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
				<input type="text" class="form-control"  value="{{$approval_details->member_company_carewell_id}}" disabled/>
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
		<div class="form-holder row">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Cheif Complaint</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" disabled>{{$approval_details->approval_complaint}}</textarea>
			</div>
			<div class="col-md-6 form-content">
				<input type="checkbox" class="minimal" ><label> Laboratory?</label>
			</div>
		</div>
		<div class="row form-holder">
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
		<form class="procedure-availed-submit-form" method="post" id="insertAvailed">
			<div class="table-responsive no-padding">
				<table class="table table-hover table-bordered procedure-form" style="display: inline !important;">
					<thead>
						<tr>
							<th>PROCEDURE/LABORATORY</th>
							<th>AMOUNT</th>
							<th>REMARKS</th>
							<th>PHILHEALTH CHARITY/SWA</th>
							<th>CHARGE TO PATIENT</th>
							<th>DISAPPROVE</th>
							<th>CHARGE TO CAREWELL</th>
						</tr>
					</thead>
					<tbody>
						@foreach($_availed as $availed)
						<tr>
							<td><input type="text" class="form-control" value="{{$availed->procedure_name}}" disabled/></td>
							<td><input type="text" name="procedure_availed_amount[]" id="" class="form-control" value="{{$availed->procedure_amount}}" disabled/></td>
							<td><textarea  name="procedure_availed_remarks[]" id="" cols="20" rows="2" disabled>{{$availed->procedure_availed_remarks}}</textarea></td>
							<td><input type="text" name="procedure_availed_philhealth_charity[]" id="" class="form-control" value="{{$availed->procedure_availed_philhealth_charity}}" disabled/></td>
							<td><input type="text" name="procedure_availed_charge_to_patient[]" id="" class="form-control" value="{{$availed->procedure_availed_charge_to_patient}}" disabled/></td>
							<td><input type="text" name="procedure_availed_disapproved[]" id="" class="form-control" value="{{$availed->procedure_availed_disapproved}}" disabled/></td>
							<td><input type="text" name="procedure_availed_charge_to_carewell[]" id="" class="form-control" value="{{$availed->procedure_availed_charge_to_carewell}}" disabled/></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
	</div>
	<div class="form-holder">
		<form class="procedure-doctor-submit-form" method="post" id="insertDoctor">
			<div class="table-responsive no-padding">
				<table class="table table-hover table-bordered procedure-form" style="display: inline !important;text-align:center !important;">
					<thead>
						<tr>
							<th>PHYSICIAN/DOCTOR</th>
							<th>SPECIALIZATION</th>
							<th>ACTUAL PF CHARGES</th>
							<th>PROCEDURE/LABORATORY</th>
							<th>RATE/R VS</th>
							<th>PHILHEALTH CHARITY/SWA</th>
							<th>CHARGE TO PATIENT</th>
							<th>DISAPPROVED</th>
							<th>CHARGE TO CAREWELL</th>
						</tr>
					</thead>
					<tbody>
						@foreach($_doctor_assigned as $doctor_assigned)
						<tr>
							<td><input type="text" class="form-control" value="{{$doctor_assigned->doctor_first_name." ".$doctor_assigned->doctor_last_name}}" disabled/></td>
							<td><input type="text" name="[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_rate_r_vs}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_actual_pf_charges[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_actual_pf_charges}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_rate_r_vs[]" class="form-control" value="{{$doctor_assigned->procedure_name}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_rate_r_vs[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_rate_r_vs}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_philhealth_charity[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_philhealth_charity}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_charge_to_patient[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_charge_to_patient}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_disapproved[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_disapproved}}" disabled/></td>
							<td><input type="text" name="procedure_doctor_charge_to_carewell[]" class="form-control" value="{{$doctor_assigned->procedure_doctor_charge_to_carewell}}" disabled/></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>