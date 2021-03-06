<div class="row box-globals">
	<input type="hidden" value="{{$member_details->member_id}}" id="member_id">
	<div class="col-md-8 pull-left top-label" style="">
		<p>UNIVERSAL ID  : {{$member_details->member_universal_id}}</p>
	</div>
	<div class="col-md-4 pull-right">
		<button type="button" data-member_id="{{$member_details->member_id}}" class="btn btn-primary top-element transaction-details" ><i class="fa fa-info btn-icon"></i> TRANSACTION DETAILS</button>
	</div>
</div>
<div class="row box-globals">
	<form class="member-information-form" method="post">
		<div class="form-holder col-md-12 col-xs-12">
		    <div class=" col-md-1 col-xs-6 pull-right no-padding">
		      <button class="btn btn-default top-element enable-element" type="button" ><i class="fa fa-pencil-square-o btn-icon "></i>EDIT</button>
		    </div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Last Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_last_name}}" name="member_last_name" id="member_last_name" class="form-control" readonly/>
			</div>
			<div class="col-md-2 form-content">
				<label>First Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_first_name}}" name="member_first_name" id="member_first_name" class="form-control" readonly/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Middle Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{$member_details->member_middle_name}}" name="member_middle_name" id="member_middle_name" class="form-control" readonly/>
			</div>
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_birthdate}}" name="member_birthdate" id="member_birthdate" class="form-control datepicker" readonly/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Gender</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_gender" id="member_gender" class="form-control" readonly>
					<option>{{$member_details->member_gender}}</option>
					<option>MALE</option>
					<option>FEMALE</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Marital Status</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_marital_status" id="member_marital_status" class="form-control" readonly>
					<option>{{$member_details->member_marital_status}}</option>
					<option>SINGLE</option>
					<option>MARRIED</option>
					<option>DIVORCED</option>
					<option>SEPARATED</option>
					<option>WIDOWED</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Email Address</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_email_address}}" name="member_email_address" id="member_email_address" class="form-control" readonly/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{$member_details->member_contact_number}}" name="member_contact_number" id="member_contact_number" class="form-control" readonly/>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Permanent Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_permanet_address" name="member_permanet_address" class="form-control" cols="30" rows="3" readonly>{{$member_details->member_permanet_address}}</textarea>
			</div>
			<div class="col-md-2 form-content">
				<label>Present Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_present_address" name="member_present_address" class="form-control" cols="30" rows="3" readonly>{{$member_details->member_present_address}}</textarea>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Mother Maiden Name</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" value="{{$member_details->member_mother_maiden_name}}" name="member_monther_maiden_name" id="member_mother_maiden_name" class="form-control" readonly/>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals" style="min-height: 300px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab "><a data-toggle="tab" href="#company">Company Details</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#dependent">Dependent</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#government">Government Cards</a></li>
		</ul>
		<div class="tab-content">
			<div id="company" class="row tab-pane fade in active table-min-height">
				<div class="row ">
			    <div class=" col-md-3 pull-right">
			      <button type="button" class="btn btn-primary  top-element member-adjustment" data-member_id="{{$member_details->member_id}}"><i class="fa fa-plus btn-icon "></i>CHANGE COMPANY</button>
			    </div>
			  </div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th>CAREWELL ID</th>
							<th>COMPANY NAME</th>
							<th>COMPANY ID</th>
							<th>COVERAGE PLAN</th>
							<th>MODE OF PAYMENT</th>
							<th>DEPLOYMENT</th>
							<th>STATUS</th>
							<th>DATE CHANGE</th>
						</tr>
						@foreach($_member_company as $member_company)
						<tr>
							<td>{{$member_company->member_carewell_id}}</td>
							<td>{{$member_company->company_name}}</td>
							<td>{{$member_company->member_employee_number}}</td>
							<td>{{$member_company->coverage_plan_name}}</td>
							<td>{{$member_company->member_payment_mode}}</td>
							<td>{{$member_company->deployment_name}}</td>
							<td>
								@if($member_company->inactive==0)
								<span class="label label-success">active</span>
								@else
								<span class="label label-danger">inactive</span>
								@endif
							</td>
							<td>{{date("F j, Y",strtotime($member_company->member_transaction_date))}}</td>
						</tr>
						@endforeach
					</table>
				</div>
	        </div>
			<div id="dependent" class="row tab-pane fade table-min-height">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th>Dependent Name</th>
							<th>Ralationship</th>
							<th>Birthdate</th>
							<th>Action</th>
						</tr>
						@foreach($_member_dependent as $member_dependent)
						<tr>
							<td>{{$member_dependent->dependent_full_name}}</td>
							<td>{{$member_dependent->dependent_relationship}}</td>
							<td>@if($member_dependent->dependent_birthdate=="N/A"){{$member_dependent->dependent_birthdate}}@else{{date("F j, Y",strtotime($member_dependent->dependent_birthdate))}}@endif</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-danger btn-sm">Action</button>
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
										{{-- <li><button type="button" data-id="{{$member_dependent->member_id}}" class="btn btn-link view-member-details">View Member</button></li>
										<li><button type="button" class="btn btn-link">Update Member</button></li> --}}
									</ul>
								</div>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
			<div id="government" class="row tab-pane fade table-min-height">
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>PHIL-HEALTH</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_philhealth}}" name="government_card_philhealth" id="government_card_philhealth" readonly/>
					</div>
					<div class="col-md-2 form-content">
						<label>SSS</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_sss}}" name="government_card_sss" id="government_card_sss" readonly/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>TIN</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_tin}}" name="government_card_tin" id="government_card_tin" readonly />
					</div>
					<div class="col-md-2 form-content">
						<label>HDMF</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_hdmf}}" name="government_card_hdmf" id="government_card_hdmf" readonly/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



