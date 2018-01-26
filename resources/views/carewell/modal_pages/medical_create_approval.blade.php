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
<div class="row box-globals" >
	<form class="member-submit-form" method="post" id="insertMember">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Name</label>
			</div>
			<div class="col-md-4 form-content form-group">
				<select data-name="member" class="form-control select2 get-member-info" style="width: 100%;">
	                <option selected="selected">SELECT PATIENT</option>
					@foreach($_member as $member)
					<option value="{{$member->member_id}}">{{$member->member_first_name." ".$member->member_middle_name." ".$member->member_last_name}}</option>
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
				<button type="button" class="btn btn-warning button-lg medical-transaction-details" disabled><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals">
	<form class="approval-submit-form" method="post">
		<input type="hidden" value="{{csrf_token()}}" name="_token">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Network Provider</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control get-doctor-info" id="provider_id" name="provider_id">
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
			<label>Cheif Complaint</label>
		</div>
		<div class="col-md-4 form-content">
			<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" ></textarea>
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
			<select class="form-control" id="approval_initial_diagnosis" name="approval_initial_diagnosis" >
				<option>HYPERTENSION</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Final Diagnosis</label>
		</div>
		<div class="col-md-10 form-content">
			<select class="form-control" id="approval_final_diagnosis" name="approval_final_diagnosis" >
				<option>HYPERTENSION</option>
			</select>
		</div>
	</div>
	<div class="row form-holder">
	</div>
    </form>
	<div class="form-holder">
		<form class="procedure-availed-submit-form" method="post" id="insertAvailed">

			<!-- INSERT HERE -->
		</form>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
	</div>
    <div class="form-holder">
    	<form class="procedure-doctor-submit-form" method="post" id="insertDoctor">
			{{-- <div class="table-responsive no-padding">
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
						<tr>
							<td>
								<select class="form-control select2" name="doctor_id">
									<option>SELECT DOCTOR</option>
									@foreach($_doctor as $doctor)
									<option value="{{$doctor->doctor_id}}">{{$doctor->doctor_first_name." ".$doctor->doctor_last_name}}</option>
									@endforeach
								</select>
							</td>
							<td>
								<select class="form-control select2" name="">
									<option>JAMES OMOSORA</option>
								</select>
							</td>
							<td><input type="text" name="procedure_doctor_actual_pf_charges" class="form-control"/></td>
							<td>
								<select class="form-control select2" name="procedure_id">
									<option>SELECT PROCEDURE</option>
									@foreach($_procedure as $procedure)
									<option>{{$procedure->procedure_name}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" name="procedure_doctor_rate_r_vs" class="form-control"/></td>
							<td><input type="text" name="procedure_doctor_philhealth_charity" class="form-control"/></td>
							<td><input type="text" name="procedure_doctor_charge_to_patient" class="form-control"/></td>
							<td><input type="text" name="procedure_doctor_disapproved" class="form-control"/></td>
							<td><input type="text" name="procedure_doctor_charge_to_carewell" class="form-control"/></td>
						</tr>
					</tbody>
				</table>
			</div> --}}
		</form>
	</div>
</div>
