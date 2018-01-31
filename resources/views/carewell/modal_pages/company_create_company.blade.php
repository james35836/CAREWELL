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
    	if( $(".coverage-count").length!=1)
		{
        	$(".coverage-form").children().last().remove();  
    	}
    });  
});
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Name</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_name"  class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Email Address</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" id="company_email_address" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company Contact Person</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_contact_person" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Contact Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_phone_number" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company ZipCode</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_zipcode" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Street</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_street" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company City/Town</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_city" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Company Country</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" id="company_country" class="form-control"/>
		</div>
	</div>
	
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT DETAILS</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#trunk">TRUNK LINE</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
		</ul>
		<div class="tab-content" >
			<div id="contract" class="row tab-pane fade in active table-min-height" >
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Contract Number</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="text" id="contract_number" class="form-control" disabled/>
					</div>
					<div class="col-md-3 form-content">
						<label>Mode of Payment</label>
					</div>
					<div class="col-md-3 form-content">
						<select id="contract_mode_of_payment" class="form-control">
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
						<label>Coverage Plan</label>
					</div>
					<div class="col-md-9 form-content coverage-form">
						<div class="coverage-count" style="margin-top: 0px;" >
							<select class="form-control" name="coverage_plan" id="coverage_plan">
								<option>SELECT COVERAGE</option>
								@foreach($_availment_plan as $availment_plan)
								<option value="{{$availment_plan->availment_plan_id}}">{{$availment_plan->availment_plan_name}}</option>
								@endforeach
							</select>
						</div>
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
					<label>TRUNK LINE</label>
				</div>
				<div class="col-md-9 form-holder trunk-form " >
					<!-- TRUNK FORM -->
					<div class=' form-content'>
						<input type='text' name='trunk[]' class='form-control'/>
					</div>
				</div>
			</div>
			<div id="deployment" class="row tab-pane fade table-min-height" >
				<div class="row form-holder">
					<div class="col-md-4 pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary addJobsite"><i  class="fa fa-plus btn-icon"></i> DEPLOYMENT</button>
							<button type="button" class="btn btn-danger removeJobsite"><i  class="fa fa-minus btn-icon"></i> DEPLOYMENT</button>
						</div>
					</div>
				</div>
				<div class="col-md-2 form-holder">
					<label>DEPLOYMENT</label>
				</div>
				<div class="col-md-9 form-holder jobsite-form ">
					<!-- JOBSITE FORM -->
					<div class=' form-content'>
						<input type='text' name='jobsite[]' class='form-control'/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>