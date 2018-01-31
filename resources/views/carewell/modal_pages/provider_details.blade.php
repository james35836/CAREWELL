<script>
	$(function ()
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
		//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
	})
	})
</script>
<style>
#bb
{
padding: 20px;
background: #929090;
display: table;
color: #fff;
width:100%;
text-align: center;
}
input[type="file"] {
display: none;
}
</style>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Provider Name</label>
		</div>
		<div class="col-md-10 form-content">
			<input type="text" id="provider_name" value="{{$provider_details->provider_name}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_person"  value="{{$provider_details->provider_contact_person}}" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_email" value="{{$provider_details->provider_contact_email}}" class="form-control"/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Telephone Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_number" value="{{$provider_details->provider_contact_number}}" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_mobile_number" value="{{$provider_details->provider_mobile_number}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>ZIP CODE </label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_zip" value="{{$provider_details->provider_zip}}" class="form-control datepicker"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Street </label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_street" value="{{$provider_details->provider_street}}" class="form-control datepicker"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>City/Town</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_city" value="{{$provider_details->provider_city}}" class="form-control datepicker"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Country</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_country" value="{{$provider_details->provider_country}}" class="form-control datepicker"/>
		</div>
	</div>
	<div class="row form-holder">
		<div class="form-content pull-right col-md-4">
			<input type="checkbox" id="provider_name_agreed" class="minimal"/> <label> Use provider name as my billing name.</label>
		</div>
		
	</div>
</div>
<div class="row box-globals" style="min-height: 258px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#billing">Billing Details</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#doctors">List of Doctors</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#attachment">Attachment</a></li>
		</ul>
		<div class="tab-content">
			<div id="billing" class="tab-pane fade in active table-min-height">
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>Billing Name</label>
					</div>
					<div class="col-md-10 form-content">
						<input type="text" id="provider_billing_name" value="{{$provider_details->provider_billing_name}}"  class="form-control"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label> Email Address</label>
					</div>
					<div class="col-md-10 form-content">
						<input type="text" id="provider_billing_email" value="{{$provider_details->provider_billing_email}}"  class="form-control"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label> Telephone Number</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_telephone" value="{{$provider_details->provider_billing_telephone}}"  class="form-control"/>
					</div>
					<div class="col-md-2 form-content">
						<label> Mobile Number</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_mobile" value="{{$provider_details->provider_billing_mobile}}"  class="form-control"/>
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>ZIP CODE </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_zipcode" value="{{$provider_details->provider_billing_zipcode}}"  class="form-control datepicker"/>
					</div>
					<div class="col-md-2 form-content">
						<label>Street </label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_street" value="{{$provider_details->provider_billing_street}}"  class="form-control datepicker"/>
					</div>
					
				</div>
				<div class="form-holder">
					<div class="col-md-2 form-content">
						<label>City/Town</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_city" value="{{$provider_details->provider_billing_city}}"  class="form-control datepicker"/>
					</div>
					
					<div class="col-md-2 form-content">
						<label>Country</label>
					</div>
					<div class="col-md-4 form-content">
						<input type="text" id="provider_billing_country" value="{{$provider_details->provider_billing_country}}"  class="form-control datepicker"/>
					</div>
				</div>
			</div>
			<div id="doctors" class="tab-pane fade table-min-height">
				<div class=" form-holder">
					<div class="row">
						<div class="col-xs-12">
							<div class="box-header">
								<h3 class="box-title">MEMBERS</h3>
								<div class="box-tools">
									<div class="input-group input-group-sm" style="width: 150px;">
										<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
										<div class="input-group-btn">
											<button type="submit" class="btn btn-default" ><i class="fa fa-search" ></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="box-body table-responsive no-padding">
								<table class="table table-hover table-bordered">
									<tr>
										<th>DOCTOR ID</th>
										<th>DOCTOR NAME</th>
										<th>SPECIALIZATION</th>
										<th>DATE ADDED</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
									@foreach($_provider_doctor as $provider_doctor)
									<tr>
										<td>{{$provider_doctor->doctor_id}}</td>
										<td>{{$provider_doctor->doctor_first_name." ".$provider_doctor->doctor_last_name}}</td>
										<td>
											@foreach($provider_doctor->doctor_specialization as $specialization)
											<span class="label label-default">{{$specialization->specialization_name}}</span>
											@endforeach
										</td>
										<td>{{date("F j, Y",strtotime($provider_doctor->doctor_created))}}</td>
										<td><span class="label label-success">active</span></td>
										<td><button class="btn btn-link">VIEW MORE</button></td>
									</tr>
									@endforeach
								</table>
							</div>
							<div class="box-footer clearfix">
								{{-- @include('globals.pagination', ['paginator' => $_cal_member]) --}}
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div id="attachment" class="tab-pane fade table-min-height">
				<div class="row form-holder">
					<div class="col-md-2 form-content">
						<label>ATTACHMENT</label>
					</div>
					<div class="col-md-10 form-content">
						<label id="bb"> CLICK TO SELECT FILE (max.25MB)
							<input type="file" id="File"   size="60" >
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>