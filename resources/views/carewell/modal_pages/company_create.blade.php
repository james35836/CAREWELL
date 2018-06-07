<script>
	$('input.string-only').keypress('keypress', string_only);//function in layout name string_only
	$('input.integer-only').keypress('keypress', integer_only);
	// $(document).ready(function() 
	// {
	// 	$("body").on('change','.coverage_plan_name',function() 
	// 	{
	// 		var selected = $("option:selected", $(this)).val();
	// 		$(".coverage_plan_name option").each(function() 
	// 		{
	// 			$(this).show();
	// 		});
	// 		$(".coverage_plan_name").each(function() 
	// 		{
	// 			$("option[value='" + selected + "']", $(this)).attr("disabled", true);
	// 		});
	// 	});
	// });
</script>
<form class="company-form" method="post">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Company Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="company_name" id="company_name"  class="form-control string-only"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Company Code</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="company_code" id="company_code"  class="form-control string-only"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Email Address</label>
			</div>
			<div class="col-md-4 form-content">
				<input  type="text" name="company_email_address" id="company_email_address" class="form-control lowercase-text"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Tel/Mobile Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="company_contact_number" id="company_contact_number" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Company Address</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea name="company_address" id="company_address" class="form-control" rows="5" cols="10"></textarea>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Contact Person(1)</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="contact_person_name" id="contact_person_name" class="form-control string-only" placeholder="NAME"/>
			</div>
			<div class="col-md-2 form-content">
				<input type="text" name="contact_person_position" id="contact_person_position" class="form-control string-only" placeholder="POSITION"/>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="contact_person_number" id="contact_person_number" class="form-control integer-only" placeholder="CONTACT NUMBER"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Contact Person(2)</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="contact_person_names" id="contact_person_names" class="form-control string-only" placeholder="NAME"/>
			</div>
			<div class="col-md-2 form-content">
				<input type="text" name="contact_person_positions" id="contact_person_positions" class="form-control string-only" placeholder="POSITION"/>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="contact_person_numbers" id="contact_person_numbers" class="form-control integer-only" placeholder="CONTACT NUMBER"/>
			</div>
		</div>
	</div>
	<div class="row box-globals" >
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT</a></li>
				<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
			</ul>
			<div class="tab-content" >
				<div id="contract" class="row tab-pane fade in active table-min-height" >
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>Contract Image</label>
						</div>
						<div class="col-md-10 form-content">
							<input type="file" name="contract_image_name[]" id="contract_image_name" class="contract_image_name form-control convoFile" multiple/>
						</div>
					</div>
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>Schedule of Benefit</label>
						</div>
						<div class=" form-content col-md-10">
							<input type="file" name="contract_benefits_name[]" id="contract_benefits_name" class="form-control" multiple/>
						</div>
					</div>
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>Coverage Plan</label>
						</div>
						<div class="form-content col-md-10 form-element">
							<div class="input-group my-element">
								<select class="form-control coverage_plan_name" name="coverage_plan_name[]" id="coverage_plan">
									<option>SELECT COVERAGE</option>
									@foreach($_coverage_plan as $coverage_plan)
									@if($coverage_plan->ref!="hidden")
									<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_plan_name}}</option>
									@endif
									@endforeach
								</select>
								<span class="input-group-btn">
									<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div id="deployment" class="row tab-pane fade table-min-height" >
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>DEPLOYMENT</label>
						</div>
						<div class="form-content col-md-10 form-element">
							<div class="input-group my-element">
								<input type="text" name="deployment_name[]" id="deployment_name" class="contract_number form-control"/>
								<span class="input-group-btn">
									<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>