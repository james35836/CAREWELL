<script>
$(document).ready(function()
{
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
	});
	$('body').find('.get-member-info').select2();
	$('.date-picker').datepicker();
	$('body').find('.get-availment-info').select2();
	$('body').find('.get-provider-info').select2();
	$('body').find('.default-select2').select2();

	$('body').find('.my-select').select2();
    
	
	
	$('body').on('change','.gross-amount',function()
	{
		
		var value 		= $(this).val();
		var $amount 		= $(this).parents('tr').find('.gross-amount');
		var $philhealth 	= $(this).parents('tr').find('.philhealth');
		var $patient 		= $(this).parents('tr').find('.charge-patient');
		var $carewell 		= $(this).parents('tr').find('.charge-carewell');

		$philhealth.val('0');
		$patient.val('0');
		$carewell.val(value);

		var $this 		= $(this).closest('div.box-globals');
		availment_center.get_total($this);
	});
	$('body').on('change','.philhealth',function()
	{
		var $member_id    	= $('#member_id').val();
		var $availment_id   = $('#availment_id').val();
		var new_carewell 	= 0;
		var value 		= $(this).val();
	     var $procedure 	= $(this).parents('tr').find('.procedureList');
		var $amount 		= $(this).parents('tr').find('.gross-amount');
		var $patient 		= $(this).parents('tr').find('.charge-patient');
		var $carewell 		= $(this).parents('tr').find('.charge-carewell');
		new_carewell 		= parseInt($amount.val())-(parseInt(value)+parseInt($patient.val()));
		
		if (new_carewell >=0)
		{
			$carewell.val(new_carewell);
			var $this 		= $(this).closest('div.box-globals');
			availment_center.get_total($this);
			availment_center.check_procedure_amount($carewell,$member_id,$procedure,$availment_id);
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
				var $this 		= $(this).closest('div.box-globals');
				availment_center.get_total($this);
			}
			else
			{
				toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
			}
			
	});
	$('body').on('click','.reimbursementBtn',function()
	{
		$('.reemburse-provider').html('<input type="text" class="form-control" name="state_d" id="state_d">');
		$('.doctorList').replaceWith('<input type="text" class="form-control" name="state_d" id="state_d">');
		$('.payeeList').replaceWith('<input type="text" class="form-control" name="state_d" id="state_d">');
	

	});
	$('body').on('change','.final_diagnosis_id',function()
	{
		var value = $(this).val();
		var text  = $(this).find(":selected").text();
		$('select.charge_diagnosis').append('<option value="'+value+'" selected="selected">'+text+'</option>');
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
					<select data-name="member" name="member_id" id="member_id" class="form-control select2 get-member-info member_id" style="width: 100%;">
						<option value="0" selected="selected">SELECT MEMBER</option>
						@foreach($_member as $member)
						<option value="{{$member->member_id}}">{{$member->member_carewell_id." ".$member->member_first_name." ".$member->member_middle_name." ".$member->member_last_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2 form-content">
					<label>Company</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control company_name"  disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Universal ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control member_universal_id" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Carewell ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control member_carewell_id" disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Birthdate</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control member_birthdate" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Employee Number</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control member_employee_number" disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="pull-right multiple-button-holder">
					<button type="button" class="btn btn-warning button-lg transaction-details" disabled><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="form-holder col-md-12 no-padding">
			<div class="col-md-3 form-content">
				<button type="button" class="btn btn-primary top-element reimbursementBtn" ><i class="fa fa-upload btn-icon"></i> REIMBURSEMENT</button>
			</div>
			<div class="col-md-3 form-content">
				
			</div>
			<div class="col-md-2 form-content">
				<label>Availment Date</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="approval_date_availed" id="approval_date_availed" class="form-control date-picker" value="{{date('m-d-Y')}}"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content reemburse-provider">
				<select class="form-control get-provider-info" id="provider_id" name="provider_id">
					<option value="0">SELECT PROVIDER</option>
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
					<option value="0">SELECT AVAILMENT</option>
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
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" >NOTHING TO COMPLAIN</textarea>
			</div>
			
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Admitting Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control default-select2" id="initial_diagnosis_id" name="diagnosis_id" >
					<option value="0">SELECT DIAGNOSIS</option>
					@foreach($_diagnosis as $diagnosis)
					<option value="{{$diagnosis->diagnosis_id}}">{{$diagnosis->diagnosis_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row">
			
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10 form-content form-element">
				<div class="input-group my-element">
					<select class="form-control final_diagnosis_id " id="final_diagnosis_id" name="final_diagnosis_id[]" >
						<option value="0">SELECT DIAGNOSIS</option>
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
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Charge : </label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control charge_diagnosis" id="charge_diagnosis" name="charge_diagnosis_id" >
					<option value="0">CHARGE TO DIAGNOSIS</option>
				</select>
			</div>
		</div>
		<div class="row">
			
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">PROCEDURE</p>
			</center>
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
					<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
				</tr>
				<tr class="table-row">
					<td>
						<select style="width: 250px;" class="form-control select2 procedureList" name="procedure_id[]">
							<option value="0">-Select Description-</option>
						</select>
					</td>
					<td><input type="text"  value="0.0" name="procedure_gross_amount[]" id="laboratory_amount" class="gross-amount form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_philhealth[]" id="" class="philhealth form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_patient[]" id="" class="charge-patient form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_carewell[]" id="" class="charge-carewell form-control"/></td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" data-number="2" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
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
				<input type="text" class="form-control total_gross_amount" name="procedure_total_gross_amount" id="total_gross_amount">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_philhealth" name="procedure_total_philhealth" id="total_philhealth">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_charge_patient" name="procedure_total_charge_patient" id="total_charge_patient">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_charge_carewell" name="procedure_total_charge_carewell" id="total_charge_carewell">
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">PHYSICIAN</p>
			</center>
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
					<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
				</tr>
				<tr class="table-row">
					<td>
						<select style="width: 200px;" class="form-control select2 doctorList" name="doctor_id[]">
							<option value="0">SELECT PROVIDER</option>
						</select>
					</td>
					<td>
						
						<div class="input-group">
							<select style="width: 254px;" class="form-control select2" name="specialization_name[]">
								<option>SPECIALIZATION</option>
								@foreach($_specialization as $specialization)
								<option>{{$specialization->specialization_name}}</option>
								@endforeach
							</select>
							<span class="input-group-btn">
								<button data-ref="string" class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
							</span>
						</div>
					</td>
					<td><input type="text"  value="2017" name="" class="form-control rateRvs"/></td>
					<td>
						<select style="width: 330px;" class="form-control select2" name="doctor_procedure_id[]">
							<option>SELECT PROCEDURE</option>
							@foreach($_procedure_doctor as $procedure_doctor)
							<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="text" value="0.0" name="approval_doctor_actual_pf[]" class="gross-amount form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_phil_charity[]" class="philhealth form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_charge_patient[]" class="charge-patient form-control"/></td>
					<td><input type="text" value="0.0" name="approval_doctor_charge_carewell[]" class="charge-carewell form-control"/></td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" data-number="2" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
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
				<input type="text" class="form-control total_gross_amount" name="doctor_total_gross_amount" id="total_gross_amount">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_philhealth" name="doctor_total_philhealth" id="total_philhealth">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_charge_patient" name="doctor_total_charge_patient" id="total_charge_patient">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control total_charge_carewell" name="doctor_total_charge_carewell" id="total_charge_carewell">
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">PAYEE</p>
			</center>
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="form-holder">
			
			<div class="form-content col-md-2">
				<label>Doctor Payee</label>
			</div>
			<div class="form-content col-md-10 form-element">
				<div class="input-group my-element">
					<select class="form-control doctor-payee" data-type="doctor" name="doctor_payee_id[]" id="payeeList">
						<option value="0">SELECT PAYEE</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
			<div class="form-content col-md-2">
				<label>Other Payee</label>
			</div>
			<div class="form-content col-md-10 form-element">
				<div class="input-group my-element">
					<input class="form-control other-payee" name="payee_name[]" data-type="other"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
		</div>
	</div>
</form>