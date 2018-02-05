<script>
	
	$(document).ready(function() {
	$('#selectAllSpecializationList').click (function () {
	     var checkedStatus = this.checked;
	    $('.specialization-table  tr').find('td:first :checkbox').each(function () {
	        $(this).prop('checked', checkedStatus);
	     });
	});
	$('#selectAllProviderList').click (function () {
	     var checkedStatus = this.checked;
	    $('.provider-table  tr').find('td:first :checkbox').each(function () {
	        $(this).prop('checked', checkedStatus);
	     });
	});

	


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
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_last_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_first_name"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control" id="doctor_gender">
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
			<input type="text" class="form-control" id="doctor_contact_number"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_email_address"/>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control datepicker" id="doctor_birthdate"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-4 form-content">
			<textarea class="form-control" name="" id="doctor_address" cols="30" rows="3"></textarea>
		</div>
	</div>
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#specialization">SPECIALIZATION</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
		</ul>
		<div class="tab-content" >
			<div id="specialization" class="row tab-pane fade in active table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th><input type="checkbox" id="selectAllSpecializationList"></th>
							<th>SPECIALIZATION NAME</th>
						</tr>
						@foreach($_specialization as $specialization)
						<tr>
							<td><input type="checkbox" name="specialization_id" value="{{$specialization->specialization_id}}" name="specialization_name"></td>
							<td>{{$specialization->specialization_name}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
			<div id="provider" class="row tab-pane fade table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered provider-table">
						<tr>
							<th><input type="checkbox" id="selectAllProviderList"></th>
							<th>PROVIDER NAME</th>
						</tr>
						@foreach($_provider as $provider)
						<tr>
							<td><input type="checkbox" name="provider_id" value="{{$provider->provider_id}}"></td>
							<td>{{$provider->provider_name}}</td>
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