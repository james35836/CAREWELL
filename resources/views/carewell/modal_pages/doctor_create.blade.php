<div class="row box-globals">

	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Full Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_full_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control" id="doctor_gender">
				<option>MALE</option>
				<option>FEMALE</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_contact_number"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input  type="text" class="form-control lowercase-text" id="doctor_email_address"/>
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab "><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
		</ul>
		<div class="tab-content" >
			<div id="provider" class="active in row tab-pane fade table-min-height" >
				<div class="form-holder">
					<div class="form-content col-md-2">
						<label>PROVIDER NAME</label>
					</div>
					<div class="form-content col-md-10 form-element">
						<div class="input-group my-element">
							<select name="provider_name[]" class="provider_name form-control ">
								<option>SELECT PROVIDER</option>
								@foreach($_provider as $provider)
								<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
								@endforeach
							</select>
							<span class="input-group-btn">
								<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
								<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>