<script>
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
	
	$('body').on("click",".add-contact", function()
	{
		$('.contact-form-element:first').clone().appendTo('.contact-number-form');
	});
	$('body').on("click",".remove-contact", function()
	{
		if($('.contact-form-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".contact-form-element").remove();
		}
	});
	$('body').on("click",".add-deployment", function()
	{
		$(this).closest(".deployment-form-element").clone().appendTo('.deployment-number-form');
	});
	$('body').on("click",".remove-deployment", function()
	{
		if($('.deployment-form-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".deployment-form-element").remove();
		}
	});
	$('body').on("click",".add-coverage", function()
	{
		$(this).closest(".coverage-plan-element").clone().appendTo('.coverage-plan-form');
	});
	$('body').on("click",".remove-coverage", function()
	{
		if($('.coverage-plan-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".coverage-plan-element").remove();
		}
	});
	$('body').on("click",".add-Benifit", function()
	{
		$(this).closest(".Benifit-element").clone().appendTo('.Benifit-form');
	});
	$('body').on("click",".remove-Benifit", function()
	{
		if($('.Benifit-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".Benifit-element").remove();
		}
	});
	$('body').on("click",".add-contract", function()
	{
		$(this).closest(".contract-element").clone().appendTo('.contract-form');
	});
	$('body').on("click",".remove-contract", function()
	{
		if($('.contract-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".contract-element").remove();
		}
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
			<textarea name="company_address" id="company_address" class="form-control" rows="3" cols="10">{{$company_details->company_address}}</textarea>
		</div>
		
	</div>
	<div class="form-holder ">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		
		<div class="col-md-10 contact-number-form">
			<table class="table table-bordered">
				
				<tbody>
					@foreach($_company_number as $company_number)
					<tr>
						<td><input type="text" value="{{$company_number->company_number}}" name="company_number[]" id="company_number" class="form-control"/></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT DETAILS</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#member">MEMBER LIST</a></li>
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
						<label>Contract Images</label>
					</div>
					<div class=" form-content col-md-4">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>IMAGES</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_contract_images as $contract_images)
								<tr>
									<td><a target="_blank" href="{{$contract_images->contract_image_name}}">VIEW IMAGE</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-2 form-content">
						<label>Schedule of Benifit</label>
					</div>
					<div class=" form-content col-md-4">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>IMAGES</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_benefits_images as $benefits_images)
								<tr>
									<td><a target="_blank" href="{{$benefits_images->contract_benefits_name}}">VIEW IMAGE</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>Coverage Plan</label>
					</div>
					<div class=" form-content col-md-4">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>COVERAGE</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_coverage_plan as $coverage_plan)
								<tr>
									<td>{{$coverage_plan->coverage_plan_name}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			<div id="deployment" class="row tab-pane fade table-min-height" >
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>DEPLOYMENT</label>
					</div>
					<div class="col-md-10 deployment-number-form">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>DEPLOYMENT NAME</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_company_deployment as $company_deployment)
								<tr>
									<td>{{$company_deployment->deployment_name}}</td>
									<td>VIEW ALL MEMBERS</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="member" class="row tab-pane fade table-min-height" >
				<div class="form-holder ">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>UNIVERSAL ID</th>
									<th>CAREWELL ID</th>
									<th>MEMBER NAME</th>
									<th>DEPLOYMENT</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_company_member as $company_member)
								<tr>
									<td>{{$company_member->member_universal_id}}</td>
									<td>{{$company_member->member_carewell_id}}</td>
									<td>{{$company_member->member_first_name." ".$company_member->member_last_name}}</td>
									<td>{{$company_member->deployment_name}}</td>
									<td>VIEW ALL MEMBERS</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>