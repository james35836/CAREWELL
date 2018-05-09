<div class="row box-globals">
	<input type="hidden" value="{{$company_details->company_id}}" id="company_id" name="">
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
			<input type="text" value="{{$company_details->company_email_address}}" name="company_email_address" id="company_email_address" class="form-control lowercase-text"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Tel/Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$company_details->company_contact_number}}" name="company_contact_number" id="company_contact_number" class="form-control"/>
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
	<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Contact Person(1)</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$company_details->contact_person_name}}" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="NAME"/>
			</div>
			<div class="col-md-2 form-content">
				<input type="text" value="{{$company_details->contact_person_position}}" name="contact_person_position" id="contact_person_position" class="form-control" placeholder="POSITION"/>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$company_details->contact_person_number}}" name="contact_person_number" id="contact_person_number" class="form-control" placeholder="CONTACT NUMBER"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Contact Person(2)</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$company_details->contact_person_names}}" name="contact_person_names" id="contact_person_names" class="form-control" placeholder="NAME"/>
			</div>
			<div class="col-md-2 form-content">
				<input type="text" value="{{$company_details->contact_person_positions}}" name="contact_person_positions" id="contact_person_positions" class="form-control" placeholder="POSITION"/>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$company_details->contact_person_numbers}}" name="contact_person_numbers" id="contact_person_numbers" class="form-control" placeholder="CONTACT NUMBER"/>
			</div>
		</div>
</div>
<div class="row box-globals" >
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT DETAILS</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#coverage">COVERAGE PLAN</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#member">MEMBER LIST</a></li>
		</ul>
		<div class="tab-content" >
			<div id="contract" class="row tab-pane fade in active table-min-height" >
				<div class="form-holder col-md-12">
					<div class="col-md-2 form-content">
						<label>Contract Number</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" value="{{$company_contract->contract_number}}" id="contract_number" class="form-control"/>
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
			</div>
			<div id="coverage" class="row tab-pane fade table-min-height" >
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>COVERAGE PLAN</label>
					</div>
					<div class="col-md-10 deployment-number-form">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>COVERAGE PLAN NAME</th>
									<th class="col-md-1 col-xs-2"><button data-company_id = "{{$company_details->company_id}}" class="btn-primary btn btn-sm add-company-plan"><i class="fa fa-plus"></i> ADD</button></th>
								</tr>
							</thead>
							<tbody>
								@foreach($_coverage_plan as $coverage_plan)
								<tr>
									<td><span  class="label label-success ">{{$coverage_plan->coverage_plan_name}}</span></td>
									<td><span data-coverage_plan_id="{{$coverage_plan->coverage_plan_id}}"  data-size="md" class="label label-info coverage-plan-details"><i class="fa fa-eye"></i> VIEW</span></td>
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
									<th class="col-md-1 col-xs-2"><button data-company_id = "{{$company_details->company_id}}" class="btn-primary btn btn-sm add-company-deployment"><i class="fa fa-plus"></i> ADD DEPLOYMENT</button></th>
								</tr>
							</thead>
							<tbody>
								@foreach($_company_deployment as $company_deployment)
								<tr>
									<td>{{$company_deployment->deployment_name}}</td>
									<td><span  data-size="md" class="label label-info company-deployment-member"><i class="fa fa-eye"></i> VIEW  MEMBERS</span></td>
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
									<td>VIEW  MEMBERS</td>
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