<script>
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
	$(".addJobsite").on("click", function()
	{
		$(".jobsite-form").append("<div class=' form-content'><input type='text' name='jobsite[]' class='form-control'/></div>");
	});
	$(".removeJobsite").on("click", function()
	{
		$(".jobsite-form").children().last().remove();
	});
	$(".addTrunk").on("click", function()
	{
		$(".trunk-form").append("<div class=' form-content'><input type='text' name='trunk[]' class='form-control'/></div>");
	});
	$(".removeTrunk").on("click", function()
	{
		$(".trunk-form").children().last().remove();
	});
	$(".add-coverage").on("click", function() {
	
	$(".coverage-form").append('<div class="coverage-count" style="margin-top: 5px;" ><select class="form-control" name="coverage_plan" id="coverage_plan">@foreach($_availment_plan as $availment_plan)<option value="{{$availment_plan->availment_plan_id}}">{{$availment_plan->availment_plan_name}}</option>@endforeach</select></div>');
	
});
$(".remove-coverage").on("click", function() {
	
	$(".coverage-form").children().last().remove();
	
});
});
</script>
<div class="row box-globals">
	<div class="form-holder">
		
		<div class="col-md-4 form-content pull-right top-label">
			<label>COMPANY CODE : {{$company_details->company_code}}</label>
		</div>
		
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Company Name</label>
		</div>
		<div class="col-md-10 form-content">
			<input type="text" value="{{$company_details->company_name}}" name="company_name" id="company_name"  class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$company_details->company_email_address}}" name="company_email_address" id="company_email_address" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$company_details->company_contact_person}}" name="company_contact_person" id="company_contact_person" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Company Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea name="company_address" id="company_address" class="form-control" rows="5" cols="10">{{$company_details->company_address}}</textarea>
		</div>
		
	</div>
	<div class="form-holder ">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		
		<div class="col-md-10 contact-number-form">
			@foreach($_company_number as $company_number)
			<div class=" form-content contact-form-element">
				<div class="input-group">
					<input type="text" value="{{$company_number->company_number}}" name="company_number[]" id="company_number" class="form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-contact" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-contact" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
			@endforeach
		</div>
		
	</div>
</div>
<div class="row box-globals" >
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT DETAILS</a></li>
				<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
			</ul>
			<div class="tab-content" >
				<div id="contract" class="row tab-pane fade in active table-min-height" >
					<div class="form-holder">
						<div class="col-md-2 form-content">
							<label>Contract Number</label>
						</div>
						<div class="col-md-4 form-content">
							<input type="text" value="{{$company_contract->contract_number}}" id="contract_number" class="form-control"/>
						</div>
						<div class="col-md-2 form-content">
							<label>Mode of Payment</label>
						</div>
						<div class="col-md-4 form-content">
							<select id="payment_mode_id" class="form-control">
								<option>{{$company_contract->payment_mode_name}}</option>
								<option disabled>MODE OF PAYMENT</option>
								@foreach($_payment_mode as $payment_mode)
								<option value="{{$payment_mode->payment_mode_id}}">{{$payment_mode->payment_mode_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
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
							<label>Schedule of Benifit</label>
						</div>
						<div class=" form-content col-md-10">
							<input type="file" name="contract_benefits_name[]" id="contract_benefits_name" class="form-control" multiple/>
						</div>
					</div>
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>Coverage Plan</label>
						</div>
						<div class="col-md-10 coverage-plan-form">
							<div class=" form-content coverage-plan-element">
								
								<div class="input-group">
									<select class="form-control coverage_plan_name" name="coverage_plan_name[]" id="coverage_plan">
										<option>SELECT COVERAGE</option>
										@foreach($_coverage_plan as $coverage_plan)
										<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_plan_name}}</option>
										@endforeach
									</select>
									<span class="input-group-btn">
										<button class="btn btn-primary add-coverage" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
										<button class="btn btn-danger remove-coverage" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="deployment" class="row tab-pane fade table-min-height" >
					<div class="form-holder ">
						<div class="col-md-2 form-content">
							<label>DEPLOYMENT</label>
						</div>
						<div class="col-md-10 deployment-number-form">
							@foreach($_company_deployment as $company_deployment)
							<div class=" form-content deployment-form-element">
								<div class="input-group">
									<input type="text" value="{{$company_deployment->deployment_name}}" name="deployment_name[]" id="deployment_name" class="contract_number form-control"/>
									<span class="input-group-btn">
										<button class="btn btn-primary add-deployment" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
										<button class="btn btn-danger remove-deployment" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
									</span>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>