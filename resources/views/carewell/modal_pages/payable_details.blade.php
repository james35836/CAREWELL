<script>
	
	$(document).ready(function() {
	$(".add-specialization").on("click", function() {
		
		$(".specialization-form").append('<div class="specialization-count" style="margin-top: 20px;"><select name="specialization_name" class="form-control"><option>Allergist or Immunologist</option><option>Anesthesiologist</option><option>Cardiologist</option><option>Dermatologist</option><option>Gastroenterologist</option><option>Hematologist/Oncologist</option><option>Internal Medicine Physician</option><option>Nephrologist</option><option>Neurologist</option><option>Neurosurgeon</option><option>Obstetrician</option><option>Gynecologist</option><option>Nurse-Midwifery</option><option>Occupational Medicine Physician</option><option>Ophthalmologist</option><option>Oral and Maxillofacial Surgeon</option><option>Orthopaedic Surgeon</option><option>Otolaryngologist (Head and Neck Surgeon)</option><option>Pathologist</option><option>Pediatrician</option><option>Plastic Surgeon</option><option>Podiatrist</option><option>Psychiatrist</option><option>Pulmonary Medicine Physician</option><option>Radiation Onconlogist</option><option>Diagnostic Radiologist</option><option>Rheumatologist</option><option>Urologist</option></select></div>');
		
	});
	$(".remove-specialization").on("click", function() {
		if( $(".specialization-count").length!=1)
			{
		$(".specialization-form").children().last().remove();
		}
	});
	});
	
	$(function ()
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
	})
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>PROVIDER</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control select2 get-all-approval" id="provider_id">
				<option>{{$payable_details->provider_name}}</option>
				@foreach($_provider as $provider)
				<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>SOA #</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->payable_soa_number}}" class="form-control" id="payable_soa_number"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Recieved</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->payable_recieved}}""  class="form-control datepicker" id="payable_recieved"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Due</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$payable_details->payable_due}}"  class="form-control datepicker" id="payable_due"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Preperation Date</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{date("F j, Y",strtotime($payable_details->payable_created))}}"  class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Prepared by</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->user_first_name." ".$payable_details->user_last_name }}" class="form-control" id="doctor_middle_name"/>
		</div>
	</div>
</div>
<div class="payable-create-table" id="payable-create-table">
	<div class="box-globals">
		<div class="row">
			<div class="col-xs-12">
				<div class="box-header">
					<h3 class="box-title medical-btn-sample">APPROVAL LIST</h3>
					<div class="box-tools">
						<button type="submit" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> EXPORT TO PDF</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th><input type="checkbox" class="checkAllCheckbox"></th>
							<th>APPROVAL #</th>
							<th>CAREWELL ID</th>
							<th>MEMBER NAME</th>
							<th>APPROVAL CREATED</th>
							<th>PROCEDURE/LAB</th>
							<th>AMOUNT</th>
							<th>PHYSICIAN</th>
							<th>PROFESIONAL FEE</th>
							<th>D/A</th>
							<th>CHARGE CAREWELL</th>
							<th>REMARKS</th>
							
						</tr>
						@foreach($_payable_approval as $payable_approval)
						<tr>
							<td><input type="checkbox" ></td>
							<td>{{$payable_approval->approval_number}}</td>
							<td>{{$payable_approval->member_carewell_id}}</td>
							<td>{{$payable_approval->member_first_name." ".$payable_approval->member_last_name }}</td>
							<td>{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
							<td>@foreach($payable_approval->availed as $availed)
								<span class="label label-default">{{$availed->availment_name }}</span>
								@endforeach</td>
							<td>{{$payable_approval->member_carewell_id}}</td>
							<td>
								@foreach($payable_approval->doctor as $doctor)
								<span class="label label-default">{{$doctor->doctor_first_name." ".$doctor->doctor_last_name }}</span>
								@endforeach
							</td>
							<td>{{$payable_approval->doctor_fee}}</td>
							<td>{{$payable_approval->provider_name}}</td>
							<td>{{$payable_approval->charge_carewell}}</td>
							<td>{{$payable_approval->charge_carewell}}</td>
						</tr>
						@endforeach
						
					</table>
				</div>
				
			</div>
		</div>
	</div>
</div>