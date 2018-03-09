<script>
$(document).ready(function()
{
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
	});
	$('body').find('.get-member-info').select2();
	
	$('body').find('.get-availment-info').select2();
	$('body').find('.get-provider-info').select2();
	$('body').find('.default-select2').select2();
	
	
	$('body').on('change','.gross-amount',function()
	{
		
		var value = $(this).val();
		
			var $amount 	= $(this).parents('tr').find('.gross-amount');
		var $philhealth = $(this).parents('tr').find('.philhealth');
			var $patient 	= $(this).parents('tr').find('.charge-patient');
			var $carewell 	= $(this).parents('tr').find('.charge-carewell');
		
		$philhealth.val('0');
		$patient.val('0');
		$carewell.val(value);
		availment_center.get_total();
	});
	$('body').on('change','.philhealth',function()
	{
		var new_carewell = 0;
		var value = $(this).val();
		
			var $amount 	= $(this).parents('tr').find('.gross-amount');
			var $patient 	= $(this).parents('tr').find('.charge-patient');
			var $carewell 	= $(this).parents('tr').find('.charge-carewell');
		new_carewell = parseInt($amount.val())-(parseInt(value)+parseInt($patient.val()));
		if (new_carewell >=0)
		{
		$carewell.val(new_carewell);
		availment_center.get_total();
		}
		else
		{
			toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
		}
});
$('body').on('change','.charge-patient',function()
	{
		var new_carewell = 0;
		var value = $(this).val();
		
			var $amount 	= $(this).parents('tr').find('.gross-amount');
		var $philhealth = $(this).parents('tr').find('.philhealth');
			var $carewell 	= $(this).parents('tr').find('.charge-carewell');
		new_carewell = parseInt($amount.val())-(parseInt(value)+parseInt($philhealth.val()));
		if (new_carewell >= 0)
		{
		$carewell.val(new_carewell);
		availment_center.get_total();
		}
		else
		{
			toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
		}
		
});
	$('body').on('change','.final-diagnosis',function()
	{
		var val = $(this).val();
		var text = $(this).find('option:selected').text();
		var newData = $('body').find('select.assigned-diagnosis');
		newData.append('<option value="'+val+'" selected="selected">'+text+'</option>');
	});
	$('body').on('change','#total_gross_amount',function()
	{
		alert();
	});
});
</script>
<form class="approval-submit-form" method="post">
	<div  id="insertMember">
		<div class="row box-globals" >
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Name</label>
				</div>
				<div class="col-md-4 form-content form-group">
					<select data-name="member" class="form-control select2 get-member-info" style="width: 100%;">
						<option selected="selected">SELECT PATIENT</option>
						@foreach($_member as $member)
						<option value="{{$member->member_id}}">{{$member->member_carewell_id." ".$member->member_first_name." ".$member->member_middle_name." ".$member->member_last_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2 form-content">
					<label>Company</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control"  disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Universal ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Carewell ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control" disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Birthdate</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Age</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control" disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="pull-right multiple-button-holder">
					<button type="button" class="btn btn-warning button-lg availment-transaction-details" disabled><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="form-holder col-md-12 no-padding">
			<div class="pull-right col-md-3 col-xs-12">
				<button type="button" class="btn btn-primary top-element" ><i class="fa fa-upload btn-icon"></i> REEMBURSEMENT</button>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control get-provider-info" id="provider_id" name="provider_id">
					<option>SELECT PROVIDER</option>
					@foreach($_provider as $provider)
					<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Type of Availment</label>
			</div>
			<div class="col-md-4 form-content">
				<select data-name="availment" class="form-control get-availment-info" name="availment_id" id="availment_id">
					<option>SELECT AVAILMENT</option>
					<option disabled>Availment List</option>
					@foreach($_availment as $availment)
					<option value="{{$availment->availment_id}}">{{$availment->availment_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Chief Complaint</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" ></textarea>
			</div>
			
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Initial Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control default-select2" id="diagnosis_id" name="diagnosis_id" >
					<option>SELECT DIAGNOSIS</option>
					@foreach($_diagnosis as $diagnosis)
					<option value="{{$diagnosis->diagnosis_id}}">{{$diagnosis->diagnosis_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10 form-content form-element">
				<div class="input-group my-element">
					<select class="form-control final-diagnosis" id="final_diagnosis_id" name="final_diagnosis_id[]" >
						<option>SELECT DIAGNOSIS</option>
						@foreach($_diagnosis as $diagnosis)
						<option value="{{$diagnosis->diagnosis_id}}">{{$diagnosis->diagnosis_name}}</option>
						@endforeach
					</select>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="table-responsive no-padding">
			<table class="table table-bordered" >
				<tr>
					<th>DESCRIPTION</th>
					<th>GROSS AMOUNT</th>
					<th>PHILHEALTH CHARITY/SWA</th>
					<th>CHARGE TO PATIENT</th>
					<th>CHARGE TO CAREWELL</th>
					<th>ASSIGNED DIAGNOSIS</th>
					<th>ACTION</th>
				</tr>
				<tr class="table-row">
					<td>
						<select class="form-control select2 procedureList" name="procedure_id[]">
							<option value="0">-Select-</option>
							@foreach($_laboratory as $laboratory)
							<option value="{{$laboratory->laboratory_id}}">{{$laboratory->laboratory_name}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="text"  value="0.0" name="procedure_gross_amount[]" id="laboratory_amount" class="gross-amount form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_philhealth[]" id="" class="philhealth form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_patient[]" id="" class="charge-patient form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_carewell[]" id="" class="charge-carewell form-control"/></td>
					<td>
						<select class="form-control select2 assigned-diagnosis" name="assigned_diagnosis_id[]">
							<option value="0">DIAGNOSIS</option>
						</select>
					</td>
					<td>
						<div class="btn-group">
							<button type="button" data-number="1" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus"></i></button>
							<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
						</div>
					</td>
				</tr>
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
	
	
	<div class="row box-globals">
		
		
		
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-doctor-form">
				<tr>
					<th>PHYSICIAN</th>
					<th>SPECIALIZATION</th>
					<th>RATE/R VS</th>
					<th>PROCEDURE</th>
					<th>ACTUAL PF CHARGES</th>
					<th>PHILHEALTH CHARITY/SWA</th>
					<th>CHARGE TO PATIENT</th>
					<th>CHARGE TO CAREWELL</th>
					<th>action</th>
				</tr>
				<tr class="table-row">
					<td>
						<select class="form-control select2 doctor-list" name="doctor_id[]">
							<option value="0">SELECT DOCTOR</option>
							@foreach($_doctor as $doctor)
							<option value="{{$doctor->doctor_id}}">{{$doctor->doctor_first_name." ".$doctor->doctor_last_name}}</option>
							@endforeach
						</select>
					</td>
					<td>
						<select class="form-control select2 doctor-specialty" name="specialization_id[]">
							<option>SELECT SPECIALIZATION</option>
						</select>
					</td>
					<td><input type="text"  value="2017" name="" class="form-control rateRvs"/></td>
					
					
					<td>
						<select class="form-control select2" name="doctor_procedure_id[]">
							<option>SELECT PROCEDURE</option>
							@foreach($_procedure_doctor as $procedure_doctor)
							<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="text"  value="0.0" name="approval_doctor_actual_pf[]" class="form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_phil_charity[]" class="form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_charge_patient[]" class="form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_charge_carewell[]" class="form-control"/></td>
					<td>
						<div class="btn-group">
							<button type="button" data-number="1" class="btn btn-primary btn-sm  add-row"><i class="fa fa-plus"></i></button>
							<button type="button" class="btn btn-danger btn-sm  remove-row"><i class="fa fa-minus"></i></button>
						</div>
					</td>
				</tr>
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
	
	
	<div class="row box-globals">
		<div class="form-holder col-md-6">
			<div class="form-content col-md-2">
				<label>Payee</label>
			</div>
			<div class="form-content col-md-10 form-element">
				<div class="input-group my-element">
					<select class="form-control payeeList" name="provider_payee_id[]" id="payeeList">
						<option value="0">SELECT PROVIDER</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
		</div>
	</div>
</form>