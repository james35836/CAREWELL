<form class="provider-create-submit-form">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Provider Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="provider_name" name="provider_name" class="form-control required"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Rate/RVS</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="provider_rvs" id="provider_rvs" class="form-control required">
					<option value="201">2001</option>
					<option value="209">2009</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Contact Person</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="provider_contact_person" name="provider_contact_person" class="form-control required"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Email Address</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="email" id="provider_contact_email" name="provider_contact_email" class="form-control required"/>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Tel. Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="provider_telephone_number" name="provider_telephone_number" class="form-control required"/>
			</div>
			<div class="col-md-2 form-content">
				<label> Mobile Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="provider_mobile_number" name="provider_mobile_number" class="form-control required"/>
			</div>
		</div>
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Address</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea cols="30" rows="3" id="provider_address" name="provider_address" class="form-control required"></textarea>
			</div>
		</div>
		<div class="form-holder ">
			<div class="col-md-2 form-content">
				<label>Doctor</label>
			</div>
			<div class="form-content col-md-10 form-element">
				<div class="input-group my-element">
					<input type="text" name="doctor_full_name[]" id="doctor_full_name" class="form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
		</div>
	</div>
</form>