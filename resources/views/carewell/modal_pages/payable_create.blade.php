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
			<select class="form-control select2" id="provider_id">
				<option>Select Provider</option>
				@foreach($_provider as $provider)
				<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>SOA #</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_number"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Recieved</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_last_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Due</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_first_name"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Preperation Date</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Prepared by</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_middle_name"/>
		</div>
	</div>
</div>
<div class="payable-create-table">
	<div class="box-globals">
		<div class="row">
			<div class="col-xs-12">
				<div class="box-header">
					<h3 class="box-title medical-btn-sample">APPROVAL LIST</h3>
					<div class="box-tools">
						<div class="input-group input-group-sm" style="width: 150px;">
							<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th><input type="checkbox"></th>
							<th>APPROVAL #</th>
							<th>UNIVERSAL ID</th>
							<th>CAREWELL ID</th>
							<th>PATIENT NAME</th>
							<th>COMPANY</th>
							<th>PROVIDER</th>
							<th>STATUS</th>
						</tr>
						@foreach($_approval as $approval)
						<tr>
							<td><input type="checkbox"></td>
							<td>{{$approval->approval_number}}</td>
							<td>{{$approval->member_universal_id}}</td>
							<td>{{$approval->member_company_carewell_id}}</td>
							<td>{{$approval->member_first_name." ".$approval->member_last_name }}</td>
							<td>{{$approval->company_name}}</td>
							<td>{{$approval->provider_name}}</td>
							<td><span class="label label-success">active</span></td>
						</tr>
						@endforeach
						<tr style="height:70px;">
						</tr>
					</table>
				</div>
				<div class="box-footer clearfix">
					@include('globals.pagination', ['paginator' => $_approval])
				</div>
			</div>
		</div>
	</div>
</div>