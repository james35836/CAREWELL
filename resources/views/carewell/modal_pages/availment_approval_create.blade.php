<script>
$(document).ready(function()
{
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
	});
	$('body').find('.get-member-info').select2();
	$('body').find('.approval_date_availed').datepicker();
	$('body').find('.getAvailmentInfo').select2();
	$('body').find('.getProviderInfo').select2();
	$('body').find('.default-select2').select2();
	$('body').find('.my-select').select2();
    


	$('body').on('change','.procedureList,.gross-amount,.philhealth,.charge-patient',function()
	{
		var $carewell 		= $(this).parents('tr').find('.charge-carewell').val();
		var $procedure 	    = $(this).parents('tr').find('.procedureList').val();
		var $amount 		= $(this).parents('tr').find('.gross-amount').val();
		var $philhealth 	= $(this).parents('tr').find('.philhealth').val();
		var $patient 		= $(this).parents('tr').find('.charge-patient').val();

        var new_carewell    = 0;
		var $member_id    	= $('#member_id').val();
		var $availment_id   = $('#availment_id').val();
		if($(this).hasClass('procedureList'))
		{
			$(this).parents('tr').find('.philhealth').val('0');
			$(this).parents('tr').find('.charge-patient').val('0');
			$(this).parents('tr').find('.charge-carewell').val('0');
			availment_center.check_procedure_amount(0,$member_id,$procedure,$availment_id);
		}
		else
		{

			if($(this).hasClass('philhealth'))
			{
				new_carewell 		= parseInt($amount)-(parseInt($philhealth)+parseInt($patient));
			}
			else if($(this).hasClass('charge-patient'))
			{ 
				new_carewell = parseInt($amount)-(parseInt($patient)+parseInt($philhealth));
			}

			if (new_carewell >=0)
			{
				if($(this).hasClass('gross-amount'))
				{
					$(this).parents('tr').find('.philhealth').val('0');
					$(this).parents('tr').find('.charge-patient').val('0');
					$(this).parents('tr').find('.charge-carewell').val($(this).val());
				}
				else
				{
					var div_id   =  $(this).find('div.box-globals').data('id');
					if(div_id == "procedure")
					{
						availment_center.check_procedure_amount(new_carewell,$member_id,$procedure,$availment_id);
					}
					
					$(this).parents('tr').find('.charge-carewell').val(new_carewell);
				}
				
				var $this 		= $(this).closest('div.box-globals');
				availment_center.get_total($this);
			}
			else
			{
				toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
			}
		}
	});
	$('body').on('change','.final_diagnosis_id',function()
	{
		var value = $(this).val();
		var text  = $(this).find(":selected").text();
		$('select.charge_diagnosis').append('<option value="'+value+'" selected="selected">'+text+'</option>');
	});
	$('body').on('click','.procedure_disapproved',function()
	{
		var $this 			= $(this).closest('div.box-globals');
		availment_center.get_total($this);
	});
	


});
</script>

<form class="approval-submit-form" method="post">
	<div  id="insertMember">
		<div class="row box-globals">
			<div class="row form-holder">
				<center>
					<p style="font-size:20px;">MEMBER INFO</p>
				</center>
			</div>
		</div>
		<div class="row box-globals" >
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Name</label>
				</div>
				<div class="col-md-4 form-content form-group">
					<select data-name="member" name="member_id" id="member_id" class="form-control required select2 get-member-info member_id" style="width: 100%;">
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
					<input type="text" class="form-control required company_name"  disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Universal ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control required member_universal_id" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Carewell ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control required member_carewell_id" disabled/>
				</div>
			</div>
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Birthdate</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control required member_birthdate" disabled/>
				</div>
				<div class="col-md-2 form-content">
					<label>Company ID</label>
				</div>
				<div class="col-md-4 form-content">
					<input type="text" class="form-control required member_employee_number" disabled/>
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
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">AVAILMENT INFO</p>
			</center>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder col-md-12 no-padding">
			<div class="col-md-6 form-content">
				<!-- FOR SPACING -->
			</div>
			<div class="col-md-2 form-content">
				<label>Availment Date</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="approval_date_availed" id="approval_date_availed" class="approval_date_availed form-control required" value="{{date('m-d-Y')}}"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select class="form-control required getProviderInfo" id="provider_id" name="provider_id">
						<option value="">SELECT PROVIDER</option>
						@foreach($_provider as $provider)
						<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
						@endforeach
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary create-new-provider" data-size="md" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
				
			</div>
			<div class="col-md-2 form-content">
				<label>Type of Availment</label>
			</div>
			<div class="col-md-4 form-content">
				<select data-name="availment" class="form-control required getAvailmentInfo" name="availment_id" id="availment_id">
					<option value="">SELECT AVAILMENT</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Chief Complaint</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control required" placeholder="REQUIRED"></textarea>
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Admitting Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control required" id="diagnosis_id" name="diagnosis_id">
					<option value="">SELECT DIAGNOSIS</option>
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
					<select class="form-control required final_diagnosis_id " id="final_diagnosis_id" name="final_diagnosis_id[]" >
						<option value="">SELECT DIAGNOSIS</option>
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
				<select class="form-control required charge_diagnosis" id="charge_diagnosis" name="charge_diagnosis_id" >
					<option value="">CHARGE TO DIAGNOSIS</option>
				</select>
			</div>
		</div>
		<div class="row">
			
		</div>
	</div>
	<div id="minorOps">
		<div class="row box-globals">
			<div class="row form-holder">
				<center>
					<p style="font-size:20px;">PROCEDURE</p>
				</center>
			</div>
		</div>
		<div class="row box-globals" id="changeAvailmentInfo" data-id="procedure">
			<div class="table-responsive no-padding">
				<table class="table table-bordered" >
					<tr>
						<th>DESCRIPTION</th>
						<th>GROSS AMOUNT</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>CHARGE TO CAREWELL</th>
						<th>REMARKS</th>
						<th>DISAPPROVED</th>
						<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
					</tr>
					<tr class="table-row">
						<td>
							<select class="form-control required approval-select procedureList" name="procedure_id[]">
								<option value="">-Select Description-</option>
							</select>
						</td>
						<td><input type="number"  value="0" name="procedure_gross_amount[]" id="" class="gross-amount form-control required"/></td>
						<td><input type="number" value="0" name="procedure_philhealth[]" id="" class="philhealth form-control required"/></td>
						<td><input type="number" value="0" name="procedure_charge_patient[]" id="" class="charge-patient form-control required"/></td>
						<td><input type="number" value="0" name="procedure_charge_carewell[]" id="" class="charge-carewell form-control required"/></td>
						<td><textarea name="procedure_remarks[]"  cols="2" rows="1"  id="procedure_remarks[]" class="form-control required" placeholder="REMARKS"></textarea></td>
						<td><input type="checkbox" value="disapproved" name="procedure_disapproved[]" id="" class="procedure_disapproved"/></td>
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
					<label>Total Gross Amount</label>
				</div>
				<div class="col-md-6 form-holder">
					<input readonly type="number" class="form-control total_gross_amount" name="procedure_total_gross_amount" id="total_gross_amount">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Philhealth Charity</label>
				</div>
				<div class="col-md-6 form-holder">
					<input readonly type="number" class="form-control total_philhealth" name="procedure_total_philhealth" id="total_philhealth">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Patient</label>
				</div>
				<div class="col-md-6 form-holder">
					<input readonly type="number" class="form-control total_charge_patient" name="procedure_total_charge_patient" id="total_charge_patient">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Carewell</label>
				</div>
				<div class="col-md-6 form-holder">
					<input readonly type="number" class="form-control total_charge_carewell" name="procedure_total_charge_carewell" id="total_charge_carewell">
				</div>
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
	
	<div class="row box-globals" data-id="physician">
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
						<select class="form-control required approval-select doctorList" name="doctor_id[]">
							<option value="">SELECT PROVIDER</option>
						</select>
					</td>
					<td>
						
						<div class="input-group">
							<select class="form-control required approval-select specializationList" name="specialization_name[]">
								<option value="">SPECIALIZATION</option>
								@foreach($_specialization as $specialization)
								<option>{{$specialization->specialization_name}}</option>
								@endforeach
							</select>
							<span class="input-group-btn">
								<button data-ref="string" class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
							</span>
						</div>
					</td>
					<td><input disabled type="text"  value="" name="" class="form-control rateRvs"/></td>
					<td>
						<select class="form-control required approval-select doctorProcedureList" name="doctor_procedure_id[]">
							@foreach($_procedure_doctor as $procedure_doctor)
							<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="number" value="0" name="approval_doctor_actual_pf[]" class="gross-amount form-control required"/></td>
					<td><input type="number" value="0" name="approval_doctor_phil_charity[]" class="philhealth form-control required"/></td>
					<td><input type="number" value="0" name="approval_doctor_charge_patient[]" class="charge-patient form-control required"/></td>
					<td><input type="number" value="0" name="approval_doctor_charge_carewell[]" class="charge-carewell form-control required"/></td>
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
				<input readonly type="number" class="form-control  total_gross_amount" name="doctor_total_gross_amount" id="total_gross_amount">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input readonly type="number" class="form-control  total_philhealth" name="doctor_total_philhealth" id="total_philhealth">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input readonly type="number" class="form-control  total_charge_patient" name="doctor_total_charge_patient" id="total_charge_patient">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input readonly type="number" class="form-control  total_charge_carewell" name="doctor_total_charge_carewell" id="total_charge_carewell">
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p class="show-money">GRAND TOTAL  =  <span class="show-money">&#8369;</span><span class="show-money" id="grand_total">0</span></p>
			</center>
		</div>
	</div>
	
</form>