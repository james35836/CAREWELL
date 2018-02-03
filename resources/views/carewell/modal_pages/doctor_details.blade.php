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
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$doctor_details->doctor_last_name}}"  class="form-control" id="doctor_last_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$doctor_details->doctor_first_name}}" class="form-control" id="doctor_first_name"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$doctor_details->doctor_middle_name}}" class="form-control" id="doctor_middle_name"/>
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
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$doctor_details->doctor_birthdate}}" class="form-control datepicker" id="doctor_birthdate"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-4 form-content">
			<textarea class="form-control" name="" id="doctor_address" cols="30" rows="3">{{$doctor_details->doctor_address}}</textarea>
		</div>
	</div>
	
	
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#specialization">SPECIALIZATION</a></li>
		</ul>
		<div class="tab-content" >
			<div id="provider" class="row tab-pane fade in active table-min-height">
				<div class="row form-holder">
					<div class="col-md-3 pull-right form-content">
						<div class="btn-group">
							<button type="button" class="btn btn-primary add-provider"><i  class="fa fa-plus btn-icon"></i> PROVIDER</button>
							<button type="button" class="btn btn-danger remove-provider"><i  class="fa fa-minus btn-icon"></i> PROVIDER</button>
						</div>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						
					</div>
					<div class="col-md-9 form-content provider-form">
						
					</div>
				</div>
				<div class="col-md-12 form-holder">
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>ID</th>
								<th>PROVIDER NAME</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
							@foreach($_doctor_provider as $doctor_provider)
							<tr>
								<td>{{$doctor_provider->provider_id}}</td>
								<td>{{$doctor_provider->provider_name}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$doctor_provider->provider_id}}" class="btn btn-link view-member-details">View Member</button></li>
											<li><button type="button" class="btn btn-link">Update Member</button></li>
										</ul>
									</div>
								</td>
							</tr>
							@endforeach
							<tr style="height:70px;">
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="specialization" class="row tab-pane fade table-min-height">
				<div class="row form-holder">
					<div class="col-md-4 pull-right form-content">
						<div class="btn-group">
							<button type="button" class="btn btn-primary add-specialization"><i  class="fa fa-plus btn-icon"></i> SPECIALIZATION</button>
							<button type="button" class="btn btn-danger remove-specialization"><i  class="fa fa-minus btn-icon"></i> SPECIALIZATION</button>
						</div>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						
					</div>
					<div class="col-md-9 form-content specialization-form">
						
					</div>
				</div>
				<div class="col-md-12 form-holder">
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>ID</th>
								<th>SPECIALIZATION</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
							@foreach($_doctor_specialization as $doctor_specialization)
							<tr>
								<td>{{$doctor_specialization->specialization_id}}</td>
								<td>{{$doctor_specialization->specialization_name}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$doctor_specialization->specialization_id}}" class="btn btn-link view-member-details">View Member</button></li>
											<li><button type="button" class="btn btn-link">Update Member</button></li>
										</ul>
									</div>
								</td>
							</tr>
							@endforeach
							<tr style="height:70px;">
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>