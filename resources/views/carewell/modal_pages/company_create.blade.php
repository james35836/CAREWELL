<form class="company-form" method="post">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Company Name</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" name="company_name" id="company_name"  class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Email Address</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="company_email_address" id="company_email_address" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Person</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="company_contact_person" id="company_contact_person" class="form-control"/>
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
		<div class="form-holder ">
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class=" form-content col-md-10 form-element">
				<div class="input-group my-element">
					<input type="text" name="company_number[]" id="company_number" class="form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
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
							<input type="text" id="contract_number" class="form-control" disabled/>
						</div>
						<div class="col-md-2 form-content">
							<label>Mode of Payment</label>
						</div>
						<div class="col-md-4 form-content">
							<select id="payment_mode_id" class="form-control">
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
						<div class="form-content col-md-10 form-element">
							<div class="input-group my-element">
								<select class="form-control coverage_plan_name" name="coverage_plan_name[]" id="coverage_plan">
									<option>SELECT COVERAGE</option>
									@foreach($_coverage_plan as $coverage_plan)
									<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_plan_name}}</option>
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