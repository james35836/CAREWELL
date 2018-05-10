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

	$('body').find('.my-select').select2();
    
	
	
	$('body').on('change','.gross-amount',function()
	{
		
		var value 		= $(this).val();
		var $amount 	= $(this).parents('tr').find('.gross-amount');
		var $philhealth = $(this).parents('tr').find('.philhealth');
		var $patient 	= $(this).parents('tr').find('.charge-patient');
		var $carewell 	= $(this).parents('tr').find('.charge-carewell');

		$philhealth.val('0');
		$patient.val('0');
		$carewell.val(value);

		var $this 		= $(this).closest('div.box-globals');
		availment_center.get_total($this);
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
			var $this 		= $(this).closest('div.box-globals');
			availment_center.get_total($this);
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
	<div class="row box-globals">
		<div class="col-md-8 pull-left top-label" style="">
			<p>APPROVAL ID  : {{$approval_details->approval_number}}</p>
		</div>
		<div class="col-md-4 pull-right">
			<button type="button" data-transaction_member_id="{{$approval_details->approval_id}}" class="btn btn-primary top-element" ><i class="fa fa-file-pdf-o btn-icon"></i>EXPORT PDF</button>
		</div>
	</div>
	<div class="row box-globals" >
        <div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<input type="text" class="form-control" value="{{$approval_details->user_first_name." ".$approval_details->user_last_name}}"  />
			</div>
			<div class="col-md-2 form-content">
				<label>Date Called</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{date("F j, Y",strtotime($approval_details->approval_created))}}"  />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller NUMBER</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->user_number}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control"  value="{{$approval_details->user_contact_number}}" />
			</div>
		</div>
	</div>
	<div class="row box-globals" >
	    <div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<input type="text" class="form-control" value="{{$approval_details->member_first_name." ".$approval_details->member_last_name}}"  />
			</div>
			<div class="col-md-2 form-content">
				<label>Company</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->company_name}}"  />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Universal ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->member_universal_id}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Carewell ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control"  value="{{$approval_details->member_carewell_id}}" />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->member_birthdate}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Age</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{date_create($approval_details->member_birthdate)->diff(date_create('today'))->y }}" />
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder col-md-12 no-padding">
			<div class="col-md-2 form-content">
				<label>Availment Date</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->approval_date_availed}}" />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->provider_name}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Type of availment</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" class="form-control" value="{{$approval_details->availment_name}}" />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Cheif Complaint</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" >{{$approval_details->approval_complaint}}</textarea>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Initial Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" class="form-control" value="{{$approval_details->diagnosis_name}}" />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10">
				@foreach($_final_diagnosis as $final_diagnosis)
				<div class=" form-content">
					<input type="text" class="form-control" value="{{$final_diagnosis->diagnosis_name}}" />
				</div>
				@endforeach
			</div>
			
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Charge</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" class="form-control" value="{{$charge_diagnosis->diagnosis_name}}" />
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">PROCEDURE</p>
			</center>
		</div>
	</div>
	<div class="box-globals row">
		<div class="form-holder">
			<div class="table-responsive no-padding">
				<table class="table table-hover table-bordered procedure-form">
					<thead>
						<tr>
							<th style="width: 300px;">DESCRIPTION</th>
							<th>GROSS AMOUNT</th>
							<th>PHILHEALTH CHARITY/SWA</th>
							<th>CHARGE TO PATIENT</th>
							<th>CHARGE TO CAREWELL</th>
						</tr>
					</thead>
					<tbody>
						@foreach($_availed as $availed)
						<tr>
							<td><input type="text" class="form-control" value="{{$availed->procedure_name}}" /></td>
							<td><input type="text" name="procedure_gross_amount[]" id="" class="form-control" value="{{$availed->procedure_gross_amount}}" /></td>
							<td><input type="text" name="procedure_philhealth[]" id="" class="form-control" value="{{$availed->procedure_philhealth}}" /></td>
							<td><input type="text" name="procedure_charge_patient[]" id="" class="form-control" value="{{$availed->procedure_charge_patient}}" /></td>
							<td><input type="text" name="procedure_charge_carewell[]" id="" class="form-control" value="{{$availed->procedure_charge_carewell}}" /></td>
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
					<input type="text" class="form-control" id="total_gross_amount" name="procedure_total_gross_amount" value="{{$total_procedure->total_gross_amount}}">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Philhealth Charity</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control" id="total_philhealth" name="procedure_total_philhealth"  value="{{$total_procedure->total_philhealth}}">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Patient</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control" id="total_charge_patient" name="procedure_total_charge_patient"  value="{{$total_procedure->total_charge_patient}}">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Carewell</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control" id="total_charge_carewell" name="procedure_total_charge_carewell"  value="{{$total_procedure->total_charge_carewell}}">
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
	<div class="row box-globals">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
						<th style="width: 300px;">PHYSICIAN</th>
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
						<td><input style="width: 250px;" type="text" name="doctor_id[]" class="form-control" value="{{$doctor_assigned->doctor_full_name}}" /></td>
						<td><input style="width: 300px;" type="text" name="specialization_name[]" class="form-control" value="{{$doctor_assigned->specialization_name}}" /></td>
						<td><input type="text" name="approval_doctor_actual_pf[]" class="form-control" value="{{$approval_details->provider_rvs}}" /></td>
						<td><input style="width: 300px;" type="text" name="doctor_procedure_id[]" class="form-control" value="{{$doctor_assigned->doctor_procedure_descriptive}}" /></td>
						<td><input type="text" name="approval_doctor_actual_pf[]" class="form-control" value="{{$doctor_assigned->approval_doctor_actual_pf}}" /></td>
						<td><input type="text" name="approval_doctor_phil_charity[]" class="form-control" value="{{$doctor_assigned->approval_doctor_phil_charity}}" /></td>
						<td><input type="text" name="approval_doctor_charge_patient[]" class="form-control" value="{{$doctor_assigned->approval_doctor_charge_patient}}" /></td>
						<td><input type="text" name="approval_doctor_charge_carewell[]" class="form-control" value="{{$doctor_assigned->approval_doctor_charge_carewell}}" /></td>
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
				<input type="text" class="form-control" name="doctor_total_gross_amount" id="total_gross_amount" value="{{$total_doctor->total_gross_amount}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" name="doctor_total_philhealth" id="total_philhealth"  value="{{$total_doctor->total_philhealth}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" name="doctor_total_charge_patient" id="total_charge_patient"  value="{{$total_doctor->total_charge_patient}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="text" class="form-control" name="doctor_total_charge_carewell" id="total_charge_carewell"  value="{{$total_doctor->total_charge_carewell}}">
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
		<div class="form-holder col-md-8">
			<div class="form-content col-md-4">
				<label>Doctor Payee</label>
			</div>
			<div class="form-content col-md-8 form-element">
				@foreach($_payee_doctor as $payee_doctor)
				<div class="my-element">
					<input type="text" class="form-control" name="doctor_payee_id[]" value="{{$payee_doctor->doctor_full_name}}">
				</div>
				@endforeach
				
			</div>
			<div class="form-content col-md-4">
				<label>Other Payee</label>
			</div>
			<div class="form-content col-md-8 form-element">
				@foreach($_payee_other as $payee_other)
				<div class="my-element">
					<input type="text" class="form-control" name="payee_name[]" value="{{$payee_other->payee_name}}">
				</div>
				@endforeach
			</div>
		</div>
	</div>
</form>
