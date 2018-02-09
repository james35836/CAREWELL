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
		
		$('.select3').select2()
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
							<th>SPECIALIZATION NAME</th>
							<th></th>
						</tr>
						<tr class="table-row">
							<td class="col-md-9">
								<div class="input-group">
									<select name="child_availment_charges[]" class="form-control select2 ">
										@foreach($_specialization as $specialization)
										<option value="{{$specialization->specialization_id}}">{{$specialization->specialization_name}}</option>
										@endforeach
									</select>
									<span class="input-group-btn">
										<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
									</span>
								</div>
							</td>
							<td class="col-md-3 last-td">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="provider" class="row tab-pane fade table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th>PROVIDER NAME</th>
							<th></th>
						</tr>
						<tr class="table-row">
							<td class="col-md-9">
								<div class="input-group">
									<select name="child_availment_charges[]" class="form-control ">
										@foreach($_provider as $provider)
										<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
										@endforeach
									</select>
									<span class="input-group-btn">
										<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
									</span>
								</div>
							</td>
							<td class="col-md-3 last-td">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>