<script>
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
	
	$('body').on("click",".add-payee", function()
	{
		$('.payee-form-element:first').clone().appendTo('.payee-number-form');
	});
	$('body').on("click",".remove-payee", function()
	{
		if($('.payee-form-element').length==1)
		{
			toastr.error('You cannot remove all text-box.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".payee-form-element").remove();
		}
	});
});
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
			<input type="text" value="{{$provider_details->provider_name}}" id="provider_name" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_contact_person}}"  id="provider_contact_person" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_contact_email}}"  id="provider_contact_email" class="form-control"/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Telephone Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_telephone_number}}"  id="provider_telephone_number" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_mobile_number}}"  id="provider_mobile_number" class="form-control"/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea cols="30" rows="3" id="provider_address" class="form-control">{{$provider_details->provider_address}}</textarea>
		</div>
	</div>
	<div class="form-holder ">
		<div class="col-md-2 form-content">
			<label>Payee</label>
		</div>
		<div class="col-md-10 payee-number-form">
			@foreach($_provider_payee as $provider_payee)
			<div class=" form-content payee-form-element">
				<div class="input-group">
					<input type="text" value="{{$provider_payee->provider_payee_name}}" name="company_number[]" id="company_number" class="form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-payee" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-payee" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="row box-globals" style="min-height: 258px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#doctors">List of Doctors</a></li>
		</ul>
		<div class="tab-content">
			
			<div id="doctors" class="tab-pane fade in active table-min-height">
				<div class=" form-holder">
					<div class="row">
						<div class="col-xs-12">
							<div class="box-header">
								<h3 class="box-title">DOCTORS</h3>
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
			
		</div>
	</div>
</div>