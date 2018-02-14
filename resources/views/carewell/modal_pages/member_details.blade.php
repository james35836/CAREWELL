<script>
	$(document).ready(function() 
	{
		$(document).on("click",".addDependent", function() 
		{
			$(".dependent-form").append('<tr><td><input type="text" name="member_dependent_full_name[]" id="member_dependent_full_name" class="form-control"/></td><td><input type="text" name="member_dependent_birthdate[]" id="member_dependent_birthdate[]" class="date-picker form-control datepicker"/></td><td><select  name="member_dependent_relationship[]" id="member_dependent_relationship[]" class="form-control"><option>FATHER</option><option>MOTHER</option><option>CHILD</option><option>SPOUSE</option><option>UNCLE</option><option>AUNT</option><option>BROTHER</option><option>SISTER</option><option>GRANDFATHER</option><option>GRANDMOTHER</option><option>NEPHEW</option><option>NIECE</option><option>COUSIN</option></select></td></tr>');
		});
		$(document).on("click",".removeDependent", function() 
		{
			if ($(".dependent-form tr").length >2)
			{
				$(".dependent-form tr:last").remove();
			}
			else
			{
				toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
			}
			
		});
	});
	$(function ()
	{
		//select2
		$('.select2').select2()
		//Date picker
		
		$("body").on("click", ".datepicker", function(){

	        $(this).datepicker();
	        $(this).datepicker("show");
	        
	    });
	})
</script>
<div class="row box-globals">
	<div class="col-md-8 pull-left top-label" style="">
		<p>UNIVERSAL ID  : {{$member_details->member_universal_id}}</p>
	</div>
	<div class="col-md-4 pull-right">
		<button type="button" data-transaction_member_id="{{$member_details->member_id}}" class="btn btn-primary button-lg transaction-details" ><i class="fa fa-info btn-icon"></i> TRANSACTION DETAILS</button>
	</div>
</div>
<div class="row box-globals">
	<form class="member-information-form" method="post">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Last Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_last_name}}" name="member_last_name" id="member_last_name" class="form-control" required/>
			</div>
			<div class="col-md-2 form-content">
				<label>First Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_first_name}}" name="member_first_name" id="member_first_name" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Middle Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{$member_details->member_middle_name}}" name="member_middle_name" id="member_middle_name" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$member_details->member_birthdate}}" name="member_birthdate" id="member_birthdate" class="form-control datepicker"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Gender</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_gender" id="member_gender" class="form-control">
					<option>{{$member_details->member_gender}}</option>
					<option>MALE</option>
					<option>FEMALE</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Marital Status</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_marital_status" id="member_marital_status" class="form-control">
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
				<input type="text" value="{{$member_details->member_email_address}}" name="member_email_address" id="member_email_address" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{$member_details->member_contact_number}}" name="member_contact_number" id="member_contact_number" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Mother Maiden Name</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" value="{{$member_details->member_mother_maiden_name}}" name="member_monther_maiden_name" id="member_monther_maiden_name" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Permanent Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_permanet_address" name="member_permanet_address" class="form-control" cols="30" rows="3">{{$member_details->member_permanet_address}}</textarea>
			</div>
			<div class="col-md-2 form-content">
				<label>Present Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_present_address" name="member_present_address" class="form-control" cols="30" rows="3">{{$member_details->member_present_address}}</textarea>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals" style="min-height: 300px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#company">Company Details</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#dependent">Dependent</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#government">Government Cards</a></li>
		</ul>
		<div class="tab-content">
			<div id="company" class="row tab-pane fade in active table-min-height">
				<div class="row ">
			    <div class=" col-md-3 pull-right">
			      <button type="button" class="btn btn-primary  button-lg create-company"><i class="fa fa-plus btn-icon "></i>CREATE ADJUSTMENT</button>
			    </div>
			  </div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th>CAREWELL ID</th>
							<th>COMPANY NAME</th>
							<th>EMPLOYEE ID</th>
							<th>COVERAGE PLAN</th>
							<th>JOBSITE</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
						@foreach($_member_company as $member_company)
						<tr>
							<td>{{$member_company->member_carewell_id}}</td>
							<td>{{$member_company->company_name}}</td>
							<td>{{$member_company->member_employee_number}}</td>
							<td>{{$member_company->coverage_plan_name}}</td>
							<td>{{$member_company->deployment_name}}</td>
							<td><span class="label label-success">active</span></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-danger btn-sm">Action</button>
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
										<li><button type="button" data-id="{{$member_company->member_id}}" class="btn btn-link"> Archived</button></li>
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
							<td>{{date("F j, Y",strtotime($member_dependent->dependent_birthdate))}}</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-danger btn-sm">Action</button>
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
										<li><button type="button" data-id="{{$member_dependent->member_id}}" class="btn btn-link view-member-details">View Member</button></li>
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
			<div id="government" class="row tab-pane fade table-min-height">
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>PHIL-HEALTH </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_philhealth}}"/>
					</div>
					<div class="col-md-2 form-content">
						<label>SSS </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_sss}}"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>TIN </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_tin}}"/>
					</div>
					<div class="col-md-2 form-content">
						<label>HDMF </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->government_card_hdmf}}"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>