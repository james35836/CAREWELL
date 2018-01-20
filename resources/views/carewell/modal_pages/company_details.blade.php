<script>
 //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //append
    $(document).ready(function() {  
            $(".addJobsite").on("click", function() {  
                $(".jobsite-form").append("<div class=' form-content'><input type='text' name='jobsite[]' class='form-control'/></div>");  
            });  
            $(".removeJobsite").on("click", function() {  
                $(".jobsite-form").children().last().remove();  
            });  
        });  

</script>
<div class="row box-globals">
	<div class="form-holder">
		
		<div class="col-md-4 form-content pull-right top-label">
			<label>Company Code : {{$company_details->company_code}}</label>
		</div>
		
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Name</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_name" value="{{$company_details->company_name}}"  class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Code</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_code" value="{{$company_details->company_code}}" class="form-control"/>
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
			<label>Company Address</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_address" value="{{$company_details->company_address}}" class="form-control"/>
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
			<label>Company Trunk Line</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_trunk_line" value="{{$company_details->company_trunk_line}}" class="form-control"/>
		</div>
	</div>
	<hr>
</div>
<div class="row box-globals" style="min-height: 320px;">
	<ul class="nav nav-tabs">
		<li class="active company-tab"><a data-toggle="tab" href="#contract">Contract Details</a></li>
		<li class="company-tab"><a data-toggle="tab" href="#coverage">Coverage Plan</a></li>
		<li class="company-tab"><a data-toggle="tab" href="#jobsite">Jobsite</a></li>
	</ul>
	<div class="tab-content">
		<div id="contract" class="tab-pane fade in active">

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
						<a href="{{$company_contract->contract_image}}" target="_blank">
							<img src="{{$company_contract->contract_image}}" class="img-thumbnail" alt="Contract Image">
						</a>
					</div>
					<div class="col-md-6">
						<a href="{{$company_contract->contract_schedule_of_benifits_image}}" target="_blank">
							<img src="{{$company_contract->contract_schedule_of_benifits_image}}" class="img-thumbnail" alt="Schedule Of Benifit Image">
						</a>
					</div>
				</div>
			</div>
			
		</div>
		<div id="coverage" class="tab-pane fade">
			<div class="form-holder">
				<div class="col-md-3 form-content">
					<label>Coverage Plan</label>
				</div>
				<div class="col-md-9 form-content">
					@foreach($_availment_plan as $availment_plan)
					<div class="col-md-4 form-content">
						<input type="checkbox" name="availment_plan" class="minimal"  value="{{$availment_plan->availment_plan_id}}" checked> 
						<label>{{$availment_plan->availment_plan_name}}</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div id="jobsite" class="tab-pane fade">
			<div class="row form-holder">
				<div class="col-md-4 pull-right">
					<div class="col-xs-6">
						<button class="btn btn-primary addJobsite"><i class="fa fa-plus btn-icon"></i>Add New</button> 
					</div>
					<div class="col-xs-6">
						<button class="btn btn-danger removeJobsite"><i class="fa fa-trash btn-icon"></i>Remove </button> 
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
	</div>
</div>