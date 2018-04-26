<script>
	
	$(document).ready(function() {
	$(".add-specialization").on("click", function() {
		
		$(".specialization-form").append('<div class="specialization-count" style="margin-top: 20px;"><select name="specialization_name" class="form-control"><option>Allergist or Immunologist</option><option>Anesthesiologist</option><option>Cardiologist</option><option>Dermatologist</option><option>Gastroenterologist</option><option>Hematologist/Oncologist</option><option>Internal Medicine Physician</option><option>Nephrologist</option><option>Neurologist</option><option>Neurosurgeon</option><option>Obstetrician</option><option>Gynecologist</option><option>Nurse-Midwifery</option><option>Occupational Medicine Physician</option><option>Ophthalmologist</option><option>Oral and Maxillofacial Surgeon</option><option>Orthopaedic Surgeon</option><option>Otolaryngologist (Head and Neck Surgeon)</option><option>Pathologist</option><option>Pediatrician</option><option>Plastic Surgeon</option><option>Podiatrist</option><option>Psychiatrist</option><option>Pulmonary Medicine Physician</option><option>Radiation Onconlogist</option><option>Diagnostic Radiologist</option><option>Rheumatologist</option><option>Urologist</option></select></div>');
		
	});
	$(".remove-specialization").on("click", function() {
		$(".specialization-form").children().last().remove();
	});
	$(".add-provider").on("click", function() {
		
		$(".provider-form").append('<div class="provider-count" style="margin-top: 20px;"><select name="provider_name" class="form-control">@foreach($_provider as $provider)<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>@endforeach</select></div>');
		
	});
	$(".remove-provider").on("click", function() {
		$(".provider-form").children().last().remove();
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
			<label>Full Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$doctor_details->doctor_full_name}}" class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control" id="doctor_gender">
				<option>{{$doctor_details->doctor_gender}}</option>
				<option>MALE</option>
				<option>FEMALE</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$doctor_details->doctor_contact_number}}"  class="form-control" id="doctor_contact_number"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$doctor_details->doctor_email_address}}"  class="form-control" id="doctor_email_address"/>
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
		</ul>
		<div class="tab-content" >
			<div id="provider"  class="row tab-pane fade in active table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th>PROVIDER NAME</th>
							<th></th>
						</tr>
						@foreach($_doctor_provider as $doctor_provider)
						<tr class="table-row">
							<td class="col-md-9">
								<select name="provider_name[]" class="provider_name form-control ">
									<option value="{{$doctor_provider->provider_id}}">{{$doctor_provider->provider_name}}</option>
									@foreach($_provider as $provider)
									<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
									@endforeach
								</select>
							</td>
							<td class="col-md-3 last-td">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-primary btn-sm add-provider"><i class="fa fa-plus-circle"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-provider"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>