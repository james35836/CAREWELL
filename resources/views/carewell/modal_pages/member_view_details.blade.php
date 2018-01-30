<script>
	$(document).ready(function() {
	$(".addDependent").on("click", function() {
		$(".appendDependent").append("<div class='form-holder'><div class='col-md-3 form-content'><label>Dependent Full Name</label></div><div class='col-md-9 form-content'><input type='text' class='form-control'/></div></div><div class='form-holder' ><div class='col-md-3 form-content'><label>Birthdate</label></div><div class='col-md-3 form-content'><input type='text' class='form-control'/></div><div class='col-md-3 form-content'><label>Relationship</label></div><div class='col-md-3 form-content'><input type='text' class='form-control'/></div></div>");
	});
	$(".removeDependent").on("click", function() {
	$(".appendDependent").children().last().remove();
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
	<div class="col-md-8 pull-left top-label" style="">
		<p>UNIVERSAL ID  : {{$member_details->member_universal_id}}</p>
	</div>
	<div class="col-md-4 pull-right">
		<button type="button" data-transaction_member_id="{{$member_details->member_id}}" class="btn btn-primary button-lg transaction-details" ><i class="fa fa-info btn-icon"></i> TRANSACTION DETAILS</button>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_last_name}}"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_first_name}}"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_middle_name}}"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control datepicker" value="{{$member_details->member_birthdate}}"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>{{$member_details->member_gender}}</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>Marital Status</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>{{$member_details->member_marital_status}}</option>
				<option>MARIED</option>
				<option>SINGLE</option>
				<option>SEPARATED</option>
			</select>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Mother's Maiden Name</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_monther_maiden_name}}"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Permanent Address</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_permanet_address}}"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Present Address</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_present_address}}"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_email_address}}"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control" value="{{$member_details->member_contact_number}}"/>
		</div>
	</div>
</div>
<div class="row box-globals" style="min-height: 300px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#company">Company Details</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#dependent">Dependent</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#government">Government Cards</a></li>
		</ul>
		<div class="tab-content">
			<div id="company" class="tab-pane fade in active">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th>Carewell ID</th>
							<th>Company Name</th>
							<th>Jobsite</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						@foreach($_member_company as $member_company)
						<tr>
							<td>{{$member_company->member_company_carewell_id}}</td>
							<td>{{$member_company->company_name}}</td>
							<td>{{$member_company->jobsite_name}}</td>
							<td><span class="label label-success">active</span></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-danger btn-sm">Action</button>
									<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
									<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu" style="position: absolute !important;">
										<li><button type="button" data-id="{{$member_company->member_id}}" class="btn btn-link view-member-details">View</button></li>
										<li><button type="button" class="btn btn-link"> Archived</button></li>
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
			<div id="dependent" class="tab-pane fade">
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
							<td>{{$member_dependent->member_dependent_full_name}}</td>
							<td>{{$member_dependent->member_dependent_relationship}}</td>
							<td>{{date("F j, Y",strtotime($member_dependent->member_dependent_birthdate))}}</td>
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
			<div id="government" class="tab-pane fade">
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>PHIL-HEALTH </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->member_government_card_philhealth}}"/>
					</div>
					<div class="col-md-2 form-content">
						<label>SSS </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->member_government_card_sss}}"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>TIN </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->member_government_card_tin}}"/>
					</div>
					<div class="col-md-2 form-content">
						<label>HDMF </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" class="form-control" value="{{$member_government->member_government_card_hdmf}}"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>