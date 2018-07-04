<form class="new-provider-submit-form">
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
				<div class="col-md-6 form-content">
					
					<div class="input-group">
						<select name="provider_id" id="provider_id" class="form-control required">
							<option value="">SELECT PROVIDER</option>
							@foreach($_provider as $provider)
							<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
							@endforeach
						</select>
						<span class="input-group-btn">
							<button class="btn btn-secondary add-option" data-ref="string" data-size="md" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
						</span>
					</div>
				</div>
				<div class="col-md-2 form-content">
					<label>Rate/RVS</label>
				</div>
				<div class="col-md-2 form-content">
					<select name="provider_rvs" id="provider_rvs" class="form-control required">
						<option value="2001">2001</option>
						<option value="2009">2009</option>
					</select>
				</div>
			</div>
			<div class="form-holder ">
				<div class="col-md-2 form-content">
					<label>Doctor</label>
				</div>
				<div class="form-content col-md-10 form-element">
					<div class="input-group my-element">
						<input type="text" name="doctor_full_name[]" id="doctor_full_name" class="form-control required"/>
						<span class="input-group-btn">
							<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
							<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
						</span>
					</div>
				</div>
			</div>
		</form>
	</div>
</form>