
<div class="row box-globals">
	<form class="new-provider-doctor">
		@if($warning=="show")
		<div class="form-holder">
			<div class="alert alert-warning">YOU ARE REQUIRED TO CHANGE ALL THE FIELDS RELATED TO PROVIDER ONCE YOU PROCEED!</div>
		</div>
		@endif
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Provider Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="provider_name" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Rate/RVS</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="provider_rvs" id="provider_rvs" class="form-control">
					<option value="201">2001</option>
					<option value="209">2009</option>
				</select>
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
	</form>
</div>