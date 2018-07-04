<script>
$(document).ready(function()
{
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
	});
	$('body').find('.get-member-info').select2();
	$('body').find('.getAvailmentInfo').select2();
	$('body').find('.getProviderInfo').select2();
	$('body').find('.default-select2').select2();
	$('body').find('.my-select').select2();
    $('body').find('.approval_date_availed').datepicker();
	
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

<form class="approval-update-form-submit">
	<input type="hidden" id="member_id" value="{{$approval_details->member_id}}">
	<input type="hidden" id="approval_id" name="approval_id" value="{{$approval_details->approval_id}}">
	<div class="row box-globals">
		<div class="col-md-8 pull-left top-label" style="">
			<p>APPROVAL ID  : {{$approval_details->approval_number}}</p>
		</div>
		<div class="col-md-4 pull-right">
			<a target="_new_page" href="/availment/approval_export_pdf/{{$approval_details->approval_id}}"><button type="button" data-transaction_member_id="{{$approval_details->approval_id}}" class="btn btn-primary top-element" ><i class="fa fa-file-pdf-o btn-icon"></i>EXPORT PDF</button></a>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
			<p style="font-size:20px;">CALLER INFO</p>
			</center>
		</div>
	</div>
	<div class="row box-globals" >
		<div class="form-holder col-md-12 col-xs-12">
			<div class=" col-md-1 col-xs-6 pull-right no-padding">
				<button class="btn btn-default top-element enable-element" type="button" ><i class="fa fa-pencil-square-o btn-icon "></i>EDIT</button>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<input type="text" disabled class="form-control" value="{{$approval_details->user_first_name." ".$approval_details->user_last_name}}"  />
			</div>
			<div class="col-md-2 form-content">
				<label>Date Called</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{date("F j, Y",strtotime($approval_details->approval_created))}}"  />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Caller NUMBER</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{$approval_details->user_number}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control"  value="{{$approval_details->user_contact_number}}" />
			</div>
		</div>
	</div>
	@if(count($ajudication)!=0)
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
			<p style="font-size:20px;">AJUDICATION</p>
			</center>
		</div>
	</div>
	<div class="row box-globals" >
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
						<th>NAME</th>
						<th>DATE AJUDICATED</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ajudication as $ajudicated)
					<tr>
						<td>{{$ajudicated->user_first_name." ".$ajudicated->user_last_name}}</td>
						<td>{{date("F j, Y",strtotime($ajudicated->ajudication_created))}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
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
				<input type="text" disabled class="form-control" value="{{$approval_details->member_first_name." ".$approval_details->member_last_name}}"  />
			</div>
			<div class="col-md-2 form-content">
				<label>Company</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{$approval_details->company_name}}"  />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Universal ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{$approval_details->member_universal_id}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Carewell ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control"  value="{{$approval_details->member_carewell_id}}" />
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{$approval_details->member_birthdate}}" />
			</div>
			<div class="col-md-2 form-content">
				<label>Age</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" disabled class="form-control" value="{{date_create($approval_details->member_birthdate)->diff(date_create('today'))->y }}" />
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
				<input type="text" readonly name="approval_date_availed" id="approval_date_availed" class="approval_date_availed form-control" value="{{$approval_details->approval_date_availed}}" />
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select readonly class="form-control getProviderInfo" data-warning="show" id="provider_id" name="provider_id">
						<option value="{{$approval_details->provider_id}}">{{$approval_details->provider_name}}</option>
						@foreach($_provider as $provider)
						<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
						@endforeach
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary create-new-provider" data-warning="show" data-size="md" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
			</div>
			<div class="col-md-2 form-content">
				<label>Type of availment</label>
			</div>
			<div class="col-md-4 form-content">
				<select  readonly data-name="availment" class="form-control getAvailmentInfo" data-warning="show" name="availment_id" id="availment_id">
					<option value="{{$approval_details->availment_id}}">{{$approval_details->availment_name}}</option>
					@foreach($_availment as $availment)
					<option value="{{$availment->availment_id}}">{{$availment->availment_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Cheif Complaint</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="approval_complaint" readonly id="approval_complaint" cols="2" rows="3" class="form-control" >{{$approval_details->approval_complaint}}</textarea>
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Initial Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" readonly class="form-control" name="diagnosis_id" value="{{$approval_details->diagnosis_name}}" />
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10">
				@foreach($_final_diagnosis as $final_diagnosis)
				<div class=" form-content">
					<input type="text" readonly class="form-control" value="{{$final_diagnosis->diagnosis_name}}" />
				</div>
				@endforeach
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Charge</label>
			</div>
			<div class="col-md-10 form-content">
				<select readonly class="form-control charge_diagnosis" id="charge_diagnosis" name="charge_diagnosis_id" >
					<option value="{{$final_diagnosis->diagnosis_id}}">{{$charge_diagnosis->diagnosis_name}}</option>
					@foreach($_final_diagnosis as $final_diagnosis)
					<option value="{{$final_diagnosis->diagnosis_id}}">{{$final_diagnosis->diagnosis_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</div>
	@if($approval_details->availment_id!=4)
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
			<p style="font-size:20px;">PROCEDURE</p>
			</center>
		</div>
	</div>
	<div class="row box-globals" id="changeAvailmentInfo" data-id="procedure">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
						<th>DESCRIPTION</th>
						<th>GROSS AMOUNT</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>CHARGE TO CAREWELL</th>
						<th>DISAPPROVED</th>
						<th>REMARKS</th>
						<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
					</tr>
				</thead>
				<tbody>
					@foreach($_availed as $availed)
					<tr>
						<td>
							<select readonly class="form-control approval-select procedureList" name="procedure_id[]">
								<option value="{{$availed->procedure_id}}">{{$availed->procedure_name}}</option>
								@foreach($_procedure as $procedure)
								<option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
								@endforeach
							</select>
						</td>
						<td><input type="hidden" id="procedure_approval_id" name="procedure_approval_id[]" value="{{$availed->procedure_approval_id}}"/><input type="number" readonly name="procedure_gross_amount[]" id="" class="gross-amount form-control" value="{{$availed->procedure_gross_amount}}" @if($availed->procedure_disapproved=="on") disabled  @endif/></td>
						<td><input type="number" readonly name="procedure_philhealth[]" id="" class="philhealth form-control" value="{{$availed->procedure_philhealth}}" @if($availed->procedure_disapproved=="on") disabled  @endif/></td>
						<td><input type="number" readonly name="procedure_charge_patient[]" id="" class="charge-patient form-control" value="{{$availed->procedure_charge_patient}}" @if($availed->procedure_disapproved=="on") disabled  @endif/></td>
						<td><input type="number" readonly name="procedure_charge_carewell[]" id="" class="charge-carewell form-control" value="{{$availed->procedure_charge_carewell}}" @if($availed->procedure_disapproved=="on") disabled  @endif/></td>
						<td><input type="checkbox" value="disapproved" name="procedure_disapproved[]" id="" class="procedure_disapproved" @if($availed->procedure_disapproved=="on") checked disabled  @endif/></td>
						<td><textarea readonly name="procedure_remarks[]" id="procedure_remarks"  cols="2" rows="1"  class="form-control" @if($availed->procedure_disapproved=="on") disabled  @endif>{{$availed->procedure_remarks}}</textarea></td>
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" data-ref="PROCEDURE" data-id="{{$availed->procedure_approval_id}}" class="remove-approval-details-confirm btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i></button>
							</div>
						</td>
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
				<input type="number" readonly class="form-control total_gross_amount" id="total_gross_amount" name="procedure_total_gross_amount" value="{{$procedure_gross_amount}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_philhealth" id="total_philhealth" name="procedure_total_philhealth"  value="{{$procedure_philhealth}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_charge_patient" id="total_charge_patient" name="procedure_total_charge_patient"  value="{{$procedure_charge_patient}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_charge_carewell" id="total_charge_carewell" name="procedure_total_charge_carewell"  value="{{$procedure_charge_carewell}}">
			</div>
		</div>
	</div>
	@endif
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
			<p style="font-size:20px;">PHYSICIAN</p>
			</center>
		</div>
	</div>
	<div class="row box-globals" id="changeProviderInfo" data-id="physician">
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
						<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
					</tr>
				</thead>
				<tbody>
					@foreach($_doctor_assigned as $doctor_assigned)
					<tr>
						<td>
							<select readonly class="form-control approval-select doctorList" name="doctor_id[]">
								<option  value="{{$doctor_assigned->doctor_id}}">{{$doctor_assigned->doctor_full_name}}</option>
								@foreach($_doctor as $doctor)
								<option  value="{{$doctor->doctor_id}}">{{$doctor->doctor_full_name}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<div class="input-group">
								<select readonly class="form-control approval-select" name="specialization_name[]">
									<option>{{$doctor_assigned->specialization_name}}</option>
									@foreach($_specialization as $specialization)
									<option>{{$specialization->specialization_name}}</option>
									@endforeach
								</select>
								<span class="input-group-btn">
									<button data-ref="string" class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
								</span>
							</div>
						</td>
						<td><input type="text" readonly class="form-control" value="{{$approval_details->provider_rvs}}" /></td>
						<td>
							<select readonly class="form-control approval-select" name="doctor_procedure_id[]">
								<option value="{{$doctor_assigned->doctor_procedure_id}}">{{$doctor_assigned->doctor_procedure_descriptive}}</option>
								@foreach($_procedure_doctor as $procedure_doctor)
								<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
								@endforeach
							</select>
						</td>
						<td><input type="hidden" id="approval_doctor_id" name="approval_doctor_id[]" value="{{$doctor_assigned->approval_doctor_id}}"/><input readonly type="number" readonly name="approval_doctor_actual_pf[]" class="gross-amount form-control" value="{{$doctor_assigned->approval_doctor_actual_pf}}" /></td>
						<td><input readonly type="number" readonly name="approval_doctor_phil_charity[]" class="philhealth form-control" value="{{$doctor_assigned->approval_doctor_phil_charity}}" /></td>
						<td><input readonly type="number" readonly name="approval_doctor_charge_patient[]" class="charge-patient form-control" value="{{$doctor_assigned->approval_doctor_charge_patient}}" /></td>
						<td><input readonly type="number" readonly name="approval_doctor_charge_carewell[]" class="charge-carewell form-control" value="{{$doctor_assigned->approval_doctor_charge_carewell}}" /></td>
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" data-ref="PHYSICIAN" data-id="{{$doctor_assigned->approval_doctor_id}}" class="remove-approval-details-confirm btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i></button>
							</div>
						</td>
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
				<input type="number" readonly class="form-control total_gross_amount" name="doctor_total_gross_amount" id="total_gross_amount" value="{{$approval_doctor_actual_pf}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Philhealth Charity</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_philhealth" name="doctor_total_philhealth" id="total_philhealth"  value="{{$approval_doctor_phil_charity}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Patient</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_charge_patient" name="doctor_total_charge_patient" id="total_charge_patient"  value="{{$approval_doctor_charge_patient}}">
			</div>
		</div>
		<div class="col-md-6 pull-right col-xs-12">
			<div class="col-md-6 form-holder">
				<label>Total Charge to Carewell</label>
			</div>
			<div class="col-md-6 form-holder">
				<input type="number" readonly class="form-control total_charge_carewell" name="doctor_total_charge_carewell" id="total_charge_carewell"  value="{{$approval_doctor_charge_carewell}}">
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
		<div class="col-md-6  col-xs-12">
			<div class="col-md-4 form-holder">
				<label>Hospital Fee</label>
			</div>
			<div class="col-md-8 form-holder">
				<input type="text" disabled class="form-control " name="" id="" value="{{$approval_payee}}">
			</div>
		</div>
		<div class="col-md-6  col-xs-12">
			<div class="col-md-4 form-holder">
				<label>Amount</label>
			</div>
			<div class="col-md-8 form-holder">
				<input type="number" disabled class="form-control " name="" id=""  value="{{$payee_company}}">
			</div>
		</div>
		@foreach($_doctor_assigned as $doctor_assigned)
		<div class="col-md-6  col-xs-12">
			<div class="col-md-4 form-holder">
				<label>Professional Fee</label>
			</div>
			<div class="col-md-8 form-holder">
				<input type="text" disabled class="form-control" name="" id=""  value="{{$doctor_assigned->doctor_full_name}}">
			</div>
		</div>
		<div class="col-md-6  col-xs-12">
			<div class="col-md-4 form-holder">
				<label>Amount</label>
			</div>
			<div class="col-md-8 form-holder">
				<input type="number" disabled class="form-control " name="" id=""  value="{{$doctor_assigned->approval_doctor_charge_carewell}}">
			</div>
		</div>
		@endforeach
		
		<div class="col-md-6  pull-right col-xs-12">
			<div class="col-md-4 form-holder">
				<label>Grand Total</label>
			</div>
			<div class="col-md-8 form-holder">
				<input type="number" disabled class="form-control total_charge_carewell" name="grand_total" id="grand_total"  value="{{$grand_total}}">
			</div>
		</div>
	</div>
	
</form>