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
	<form class="member-information-form" method="post">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Last Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_last_name" id="member_last_name" class="form-control" required/>
			</div>
			<div class="col-md-2 form-content">
				<label>First Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_first_name" id="member_first_name" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Middle Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_middle_name" id="member_middle_name" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_birthdate" id="member_birthdate" class="form-control datepicker"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Gender</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_gender" id="member_gender" class="form-control">
					<option>SELECT GENDER</option>
					<option>MALE</option>
					<option>FEMALE</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Marital Status</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_marital_status" id="member_marital_status" class="form-control">
					<option>SELECT STATUS</option>
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
				<input type="text" name="member_email_address" id="member_email_address" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_contact_number" id="member_contact_number" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Mother Maiden Name</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" name="member_monther_maiden_name" id="member_monther_maiden_name" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Permanent Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_permanet_address" name="member_permanet_address" class="form-control" cols="30" rows="3"></textarea>
			</div>
			<div class="col-md-2 form-content">
				<label>Present Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_present_address" name="member_present_address" class="form-control" cols="30" rows="3"></textarea>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals">
	<form class="member-dependent-form" method="post">
		<table class="table table-bordered dependent-form" style="border:none !important;">
			<thead>
				<tr>
					<th>Dependent Full Name</th>
					<th>Birthdate</th>
					<th>Relationship</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="member_dependent_full_name[]" id="member_dependent_full_name" class="form-control"/></td>
					<td><input type="text" name="member_dependent_birthdate[]" id="member_dependent_birthdate[]" class="form-control datepicker"/></td>
					<td>
						<select  name="member_dependent_relationship[]" id="member_dependent_relationship[]" class="form-control">
							<option>FATHER</option>
							<option>MOTHER</option>
							<option>CHILD</option>
							<option>SPOUSE</option>
							<option>UNCLE</option>
							<option>AUNT</option>
							<option>BROTHER</option>
							<option>SISTER</option>
							<option>GRANDFATHER</option>
							<option>GRANDMOTHER</option>
							<option>NEPHEW</option>
							<option>NIECE</option>
							<option>COUSIN</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<div class="form-holder">
		<div class="form-content" style="text-align: center;margin-top:3px;">
			<div class="btn-group">
				<button type="button" class="btn btn-primary addDependent"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-danger removeDependent"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
<div class="row box-globals">
	<form class="member-government-form" method="post">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Phil-Health Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_government_card_philhealth" id="member_government_card_philhealth" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>SSS Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_government_card_sss" id="member_government_card_sss" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Tin Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_government_card_tin" id="member_government_card_tin" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>HDMF</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_government_card_hdmf" id="member_government_card_hdmf" class="form-control"/>
			</div>
		</div>
	</form>
</div>
<div class="row box-globals">
	<form class="member-company-form" method="post">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Company</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="company_id" id="company_id" class="form-control select2 select_company">.
					<option>SELECT COMPANY</option>
					@foreach($_company as $company)
					<option value="{{$company->company_id}}">{{$company->company_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Coverage Plan</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="availment_plan_id" id="availment_plan_id" class="form-control select2 coverage-plan-show" disabled>
					<option>COVERAGE PLAN</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Deployment</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="jobsite_id" id="jobsite_id" class="form-control jobsite-show" disabled>
					<option >DEPLOYMENT</option>
				</select>
			</div>
			
			<div class="col-md-2 form-content">
				<label>Employee Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  name="member_company_employee_number" id="member_company_employee_number" class="form-control"/>
			</div>
		</div>
	</form>
</div>