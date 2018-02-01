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
		<div class="col-md-3 form-content">
			<label>Company Name</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_name" value="{{$company_details->company_name}}"  class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Email Address</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_email_address" value="{{$company_details->company_email_address}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Contact Person</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_contact_person" value="{{$company_details->company_contact_person}}" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Contact Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_phone_number" value="{{$company_details->company_phone_number}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company ZipCode</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_zipcode" value="{{$company_details->company_zipcode}}" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Street</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_street" value="{{$company_details->company_street}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company City/Town</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_city" value="{{$company_details->company_city}}" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Country</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_country" value="{{$company_details->company_country}}" class="form-control"/>
		</div>
	</div>
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#coverage">COVERAGE PLAN</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#trunk">TRUNK LINE</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#jobsite">DEPLOYMENT</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#member">MEMBER's LIST</a></li>
		</ul>
		<div class="tab-content" >
			<div id="contract" class="row tab-pane fade in active table-min-height">
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Contract Number</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="text" id="contract_number" value="{{$company_contract->contract_number}}" class="form-control"/>
					</div>
					<div class="col-md-3 form-content">
						<label>Mode of Payment</label>
					</div>
					<div class="col-md-3 form-content">
						<select id="contract_mode_of_payment" class="form-control">
							<option>{{$company_contract->contract_mode_of_payment}}</option>
							<option disabled>MODE OF PAYMENT</option>
							@foreach($_payment_mode as $payment_mode)
							<option value="{{$payment_mode->payment_mode_id}}">{{$payment_mode->payment_mode_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Contract</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="file" name="contract_image" id="contract_image" class="form-control convoFile"/>
					</div>
					<div class="col-md-3 form-content">
						<label>Schedule of Benifit</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="file" id="contract_schedule_of_benifits_image" class="form-control"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>IMAGES :</label>
					</div>
					<div class="col-md-9 form-content">
						<div class="col-md-6">
							<a href="{{$company_contract->contract_image}}" target="_blank">VIEW CONTRACT IMAGE</a>
						</div>
						<div class="col-md-6">
							<a href="{{$company_contract->contract_schedule_of_benifits_image}}" target="_blank">VIEW SCHEDULE OF BENEFITS IMAGE</a>
						</div>
					</div>
				</div>
			</div>
			<div id="coverage" class="row tab-pane fade table-min-height">
				<div class="row form-holder">
					<div class="col-md-3 pull-right form-content">
						<div class="btn-group">
							<button type="button" class="btn btn-primary add-coverage"><i  class="fa fa-plus btn-icon"></i> PLAN</button>
							<button type="button" class="btn btn-danger remove-coverage"><i  class="fa fa-minus btn-icon"></i> PLAN</button>
						</div>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						
					</div>
					<div class="col-md-9 form-content coverage-form">
						
					</div>
				</div>
				<div class="col-md-12 form-holder">
					
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>ID</th>
								<th>COVERAGE PLAN NAME</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							@foreach($_company_availment_plan as $coverage_plan)
							<tr>
								<td>{{$coverage_plan->availment_plan_id}}</td>
								<td>{{$coverage_plan->availment_plan_name}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$coverage_plan->availment_plan_id}}" class="btn btn-link view-member-details">View Member</button></li>
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
			<div id="trunk" class="row tab-pane fade table-min-height" >
				<div class="row form-holder">
					<div class="col-md-4 pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary addTrunk"><i  class="fa fa-plus btn-icon"></i> TRUNK LINE</button>
							<button type="button" class="btn btn-danger removeTrunk"><i  class="fa fa-minus btn-icon"></i> TRUNK LINE</button>
						</div>
					</div>
				</div>
				<div class="col-md-2 form-holder">
				</div>
				<div class="col-md-9 form-holder trunk-form " >
					<!-- TRUNK FORM -->
					
				</div>
				<div class="col-md-12 form-holder">
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>ID</th>
								<th>TRUNKLINE  NUMBER</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
							@foreach($_company_trunkline as $company_trunkline)
							<tr>
								<td>{{$company_trunkline->trunkline_id}}</td>
								<td>{{$company_trunkline->trunkline_number}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$company_trunkline->trunkline_id}}" class="btn btn-link view-member-details">View Member</button></li>
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
			<!-- /.tab-pane -->
			<div id="jobsite" class="row tab-pane fade table-min-height">
				<div class="row form-holder">
					<div class="col-md-4 pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary addJobsite"><i  class="fa fa-plus btn-icon"></i> DEPLOYMENT</button>
							<button type="button" class="btn btn-danger removeJobsite"><i  class="fa fa-minus btn-icon"></i> DEPLOYMENT</button>
						</div>
					</div>
				</div>
				<div class=" form-holder">
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>ID</th>
								<th>Deployment Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							@foreach($_company_jobsite as $company_jobsite)
							<tr>
								<td>{{$company_jobsite->jobsite_id}}</td>
								<td>{{$company_jobsite->jobsite_name}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$company_jobsite->jobsite__id}}" class="btn btn-link view-member-details">View Member</button></li>
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
				<div class="form-holder jobsite-form " style="padding:0% 5% 0% 5%;">
				</div>
			</div>
			<div id="member" class="row tab-pane fade table-min-height" >
				<div class="col-md-12 form-holder">
					<div class=" box-body table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<tr>
								<th>UNIVERSAL ID</th>
								<th>CAREWELL ID</th>
								<th>EMPLOYEE NUMBER</th>
								<th>MEMBER NAME</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
							@foreach($_company_member as $company_member)
							<tr>
								<td>{{$company_member->member_universal_id}}</td>
								<td>{{$company_member->member_company_carewell_id}}</td>
								<td>{{$company_member->member_company_employee_number}}</td>
								<td>{{$company_member->member_first_name." ".$company_member->member_last_name}}</td>
								<td><span class="label label-success">Active</span></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm">Action</button>
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
											<li><button type="button" data-id="{{$company_member->trunkline_id}}" class="btn btn-link view-member-details">View Member</button></li>
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