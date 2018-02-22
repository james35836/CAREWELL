<script>
$(document).ready(function()
{
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
});
$('body').find('.get-member-info').select2();
$('body').find('.select3').select2();
$('body').on("click",".add-row", function()
{
	var $table = $(this).closest('table');
	$table.find('tbody tr.table-row:first').clone().appendTo($(this).closest('table tbody')).find('.select2').select2();
	
});
$('body').on("click",".remove-row", function()
{
	var $table = $(this).closest('table');
	var count  = $table.find('tr.table-row').length;
	if($(this).closest('table tr.table-row').index()==0)
	{
		toastr.error('You cannot remove first rows.', 'Something went wrong!', {timeOut: 3000})
	}
	else
	{
		$(this).closest("tr").remove();
	}
	
});
$('body').on('change','.amount',function()
{
	var sum=$(".amount").val();
	alert(sum);
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
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control get-provider-doctor select3" id="provider_id" name="provider_id">
					<option>SELECT PROVIDER</option>
					@foreach($_provider as $provider)
					<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Type of availment</label>
			</div>
			<div class="col-md-4 form-content">
				<select data-name="availment" class="form-control get-availment-info select3" name="availment_id" id="availment_id">
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
				<label>Cheif Complaint</label>
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
				<select class="form-control select3" id="approval_initial_diagnosis" name="approval_initial_diagnosis" >
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
			<div class="col-md-10 form-content">
				<select class="form-control select3" id="approval_final_diagnosis" name="approval_final_diagnosis" >
					<option>SELECT DIAGNOSIS</option>
					@foreach($_diagnosis as $diagnosis)
					<option value="{{$diagnosis->diagnosis_id}}">{{$diagnosis->diagnosis_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</div>
	<div id="insertAvailed">
		<div class="row box-globals">
			<div class="table-responsive no-padding">
				<table class="table table-bordered" >
					<thead>
						<tr>
							<th>LABORATORY</th>
							<th>AMOUNT</th>
							<th>PHILHEALTH CHARITY/SWA</th>
							<th>CHARGE TO PATIENT</th>
							<th>CHARGE TO CAREWELL</th>
							<th>REMARKS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<tr class="table-row">
							<td>
								<select class="form-control select2 get-laboratory-amount" name="laboratory_id[]">
									<option value="0">-Select-</option>
									@foreach($_laboratory as $laboratory)
									<option value="{{$laboratory->laboratory_id}}">{{$laboratory->laboratory_name}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" value="0.0" name="laboratory_amount[]" id="laboratory_amount" class="laboratory_amount form-control"/></td>
							<td><input type="text" value="0.0" name="availed_phil_charity[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_patient[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_carewell[]" id="" class="form-control"/></td>
							<td><textarea  name="availed_remarks[]" id="" cols="20" rows="2">NONE</textarea></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
								</div>
							</td>
						</tr>
						<tr class="table-row">
							<td>
								<select class="form-control select2 get-laboratory-amount" name="laboratory_id[]">
									<option value="0">-Select-</option>
									@foreach($_laboratory as $laboratory)
									<option value="{{$laboratory->laboratory_id}}">{{$laboratory->laboratory_name}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" value="0.0" name="laboratory_amount[]" id="laboratory_amount" class="laboratory_amount form-control"/></td>
							<td><input type="text" value="0.0" name="availed_phil_charity[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_patient[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_carewell[]" id="" class="form-control"/></td>
							<td><textarea  name="availed_remarks[]" id="" cols="20" rows="2">NONE</textarea></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
								</div>
							</td>
						</tr>
						<tr class="table-row">
							<td>
								<select class="form-control select2 get-laboratory-amount" name="laboratory_id[]">
									<option value="0">-Select-</option>
									@foreach($_laboratory as $laboratory)
									<option value="{{$laboratory->laboratory_id}}">{{$laboratory->laboratory_name}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" value="0.0" name="laboratory_amount[]" id="laboratory_amount" class="laboratory_amount form-control"/></td>
							<td><input type="text" value="0.0" name="availed_phil_charity[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_patient[]" id="" class="form-control"/></td>
							<td><input type="text" value="0.0" name="availed_charge_carewell[]" id="" class="form-control"/></td>
							<td><textarea  name="availed_remarks[]" id="" cols="20" rows="2">NONE</textarea></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus"></i></button>
								</div>
							</td>
						</tr>
					</tbody>
					<tfooter>
					<tr>
						<th>TOTAL:</th>
						<th>0.0</th>
						<th>0.0</th>
						<th>0.0</th>
						<th>0.0</th>
						<th>0.0</th>
						<th>0.0</th>
					</tr>
					</tfooter>
				</table>
			</div>
		</div>
	</div>
	<div id="insertDoctor">
		<div class="row box-globals">
			<div class="form-holder">
				<form class="procedure-doctor-submit-form" method="post">
					
					<div class="table-responsive no-padding">
						<table class="table table-hover table-bordered procedure-doctor-form">
							<thead>
								<tr>
									<th>PHYSICIAN</th>
									<th>SPECIALIZATION</th>
									<th>ACTUAL PF CHARGES</th>
									<th>PROCEDURE</th>
									<th>RATE/R VS</th>
									<th>PHILHEALTH CHARITY/SWA</th>
									<th>CHARGE TO PATIENT</th>
									<th>CHARGE TO CAREWELL</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody>
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
									<td><input type="text"  value="0.0" name="approval_doctor_actual_pf[]" class="form-control"/></td>
									<td>
										<select class="form-control select2" name="procedure_id[]">
											<option>SELECT PROCEDURE</option>
											@foreach($_procedure_doctor as $procedure_doctor)
											<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" value="0.0" name="approval_doctor_rate_rvs[]" class="form-control"/></td>
									<td><input type="text" value="0.0" name="approval_doctor_phil_charity[]" class="form-control"/></td>
									<td><input type="text" value="0.0" name="approval_doctor_charge_patient[]" class="form-control"/></td>
									<td><input type="text" value="0.0" name="approval_doctor_charge_carewell[]" class="form-control"/></td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary btn-sm  add-row"><i class="fa fa-plus"></i></button>
											<button type="button" class="btn btn-danger btn-sm  remove-row"><i class="fa fa-minus"></i></button>
										</div>
									</td>
								</tr>
								
							</tbody>
							<tfoot>
							<tr class="last-tr">
								<th>TOTAL:</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
								<th>0.0</th>
							</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="insertPayee">
		<div class="row box-globals">
			<div class="form-holder col-md-6">
				<div class="form-content col-md-2">
					<label>Payee</label>
				</div>
				<div class="form-content col-md-10 payee-form">
					<div class="input-group payee-element">
						<select class="form-control payee_id" name="payee_id[]" id="payeeList">
							<option value="0">SELECT PAYEE</option>
							{{-- @foreach($_coverage_plan as $coverage_plan)
							<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_plan_name}}</option>
							@endforeach --}}
						</select>
						<span class="input-group-btn">
							<button class="btn btn-primary add-payee" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
							<button class="btn btn-danger remove-payee" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>