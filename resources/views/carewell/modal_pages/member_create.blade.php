
@include('carewell.additional_pages.script_function')
<form class="member-submit-form">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Last Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_last_name" id="member_last_name" class="form-control required" required/>
			</div>
			<div class="col-md-2 form-content">
				<label>First Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_first_name" id="member_first_name" class="form-control required"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Middle Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_middle_name" id="member_middle_name" class="form-control required"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Birthdate</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_birthdate" id="member_birthdate" class="form-control required datepicker"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Gender</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_gender" id="member_gender" class="form-control">
					<option value="">SELECT GENDER</option>
					<option>MALE</option>
					<option>FEMALE</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Marital Status</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_marital_status" id="member_marital_status" class="form-control ">
					<option value="">SELECT STATUS</option>
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
				<input type="email" name="member_email_address" id="member_email_address" class="form-control "/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="member_contact_number" id="member_contact_number" class="form-control "/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Permanent Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_permanet_address" name="member_permanet_address" class="form-control " cols="30" rows="3"></textarea>
			</div>
			<div class="col-md-2 form-content">
				<label>Present Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea  id="member_present_address" name="member_present_address" class="form-control " cols="30" rows="3"></textarea>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Mother Maiden Name</label>
			</div>
			<div class="col-md-10 form-content">
				<input type="text" name="member_mother_maiden_name" id="member_mother_maiden_name" class="form-control "/>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="box-body table-responsive no-padding">
			<table class="table table-bordered dependent-form" style="border:none !important;">
				<thead>
					<tr>
						<th>Dependent Full Name</th>
						<th>Birthdate</th>
						<th>Relationship</th>
						<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
					</tr>
				</thead>
				<tbody>
					<tr class="table-row">
						<td><input type="text" name="dependent_full_name[]" id="dependent_full_name" class="form-control "/></td>
						<td><input type="text" name="dependent_birthdate[]" id="dependent_birthdate[]" class="form-control  datepicker"/></td>
						<td>
							<select  name="dependent_relationship[]" id="dependent_relationship[]" class="form-control ">
								<option value="">SELECT RELATION</option>
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
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" data-number="2" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Phil-Health Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="government_card_philhealth" id="government_card_philhealth" class="form-control "/>
			</div>
			<div class="col-md-2 form-content">
				<label>SSS Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="government_card_sss" id="government_card_sss" class="form-control "/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Tin Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="government_card_tin" id="government_card_tin" class="form-control "/>
			</div>
			<div class="col-md-2 form-content">
				<label>HDMF</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="government_card_hdmf" id="government_card_hdmf" class="form-control "/>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Company</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="company_id" id="company_id" class="form-control required select2 select_company">.
					<option value="">SELECT COMPANY</option>
					@foreach($_company as $company)
					<option value="{{$company->company_id}}">{{$company->company_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Coverage Plan</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="coverage_plan_id" id="coverage_plan_id" class="form-control required coverageList">
					<option value="">COVERAGE PLAN</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Deployment</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="deployment_id" id="deployment_id" class="form-control required deploymentList">
					<option value="">DEPLOYMENT</option>
				</select>
			</div>
			
			<div class="col-md-2 form-content">
				<label>Company ID</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  name="member_employee_number" id="member_employee_number" class="form-control required"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Mode of Payment</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_payment_mode" id="member_payment_mode" class="form-control required">
					<option value="">MODE OF PAYMENT</option>
					@foreach($_payment_mode as $payment_mode)
					<option>{{$payment_mode->payment_mode_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</form>