<div class="row box-globals">
	<input type="hidden" value="{{$provider_details->provider_id}}" id="provider_id" name="">
	<div class="form-holder col-md-12 col-xs-12">
		<div class=" col-md-1 col-xs-6 pull-right no-padding">
			<button class="btn btn-default top-element enable-element" type="button" ><i class="fa fa-pencil-square-o btn-icon "></i>EDIT</button>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Provider Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_name}}" id="provider_name" class="form-control" readonly/>
		</div>
		<div class="col-md-2 form-content">
			<label>Rate/RVS</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_rvs}}" id="provider_rvs" class="form-control" readonly/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_contact_person}}"  id="provider_contact_person" class="form-control" readonly/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_contact_email}}"  id="provider_contact_email" class="form-control" readonly/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Telephone #</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_telephone_number}}"  id="provider_telephone_number" class="form-control" readonly/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_mobile_number}}"  id="provider_mobile_number" class="form-control" readonly/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea cols="30" rows="3" id="provider_address" class="form-control" readonly>{{$provider_details->provider_address}}</textarea>
		</div>
	</div>
</div>
<div class="row box-globals" style="min-height: 258px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#doctors">List of Doctors</a></li>
			<li class="my-tab"><a href="#open" data-toggle="tab">OPEN PAYABLE</a></li>
			<li class="my-tab"><a href="#close" data-toggle="tab">CLOSED PAYABLE</a></li>
		</ul>
		<div class="tab-content">
			<div id="doctors" class="row tab-pane fade in active   table-min-height">
				<div class=" form-holder">
					<div class="form-content">
						<div class="col-md-3 col-xs-12 pull-left">
							<h4 class="box-title top-element">DOCTORS</h4>
						</div>
						<div class="col-md-3 col-xs-12 pull-right">
							<input type="text" data-name="doctors" class="top-element form-control table-searcher">
						</div>
					</div>
					<div class="form-content">
						<div class="col-xs-12">
							<div class="table-responsive no-padding">
								<table class="table table-hover table-bordered doctors">
									<tr>
										<th>DOCTOR ID</th>
										<th>DOCTOR NAME</th>
										<th>DATE ADDED</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
									@foreach($_provider_doctor as $provider_doctor)
									<tr>
										<td>{{$provider_doctor->doctor_id}}</td>
										<td class="word">{{$provider_doctor->doctor_full_name}}</td>
										<td>{{date("F j, Y",strtotime($provider_doctor->doctor_created))}}</td>
										@if($provider_doctor->doctor_archive == 0)
										<td><span class="label label-success">active</span></td>
										@else
										<td><span class="label label-danger">inactive</span></td>
										@endif
										
										<td><button data-doctor_id="{{$provider_doctor->doctor_id}}" data-size="md" class="btn btn-link view-doctor-details btn-sm">VIEW MORE</button></td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="open" class="row tab-pane fade in table-min-height">
				<div class=" form-holder">
					<div class="form-content">
						<div class="col-xs-12">
							<div class="table-responsive no-padding">
								<table class="table table-hover table-bordered">
									<tr>
										<th class="live-search">ID</th>
										<th class="live-search">SOA NUMBER</th>
										<th class="live-search">DATE RECEIVED</th>
										<th class="live-search">DUE DATE</th>
										<th class="live-search">APPROVAL NUMBER</th>
										<th class="live-search">PREPARED BY</th>
										<th class="live-search">PREPARATION DATE</th>
									</tr>
									@foreach($_provider_payable_open as $provider_payable_open)
									<tr>
										<td>{{$provider_payable_open->payable_id}}</td>
										<td>{{$provider_payable_open->payable_soa_number}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_open->payable_recieved))}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_open->payable_due))}}</td>
										<td>{{$provider_payable_open->approval_number}}</td>
										<td>{{$provider_payable_open->user_first_name." ".$provider_payable_open->user_last_name}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_open->payable_created))}}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="close" class="row tab-pane fade in table-min-height">
				<div class=" form-holder">
					<div class="form-content">
						<div class="col-xs-12">
							<div class="table-responsive no-padding">
								<table class="table table-hover table-bordered">
									<tr>
										<th class="live-search">ID</th>
										<th class="live-search">SOA NUMBER</th>
										<th class="live-search">DATE RECEIVED</th>
										<th class="live-search">DUE DATE</th>
										<th class="live-search">APPROVAL NUMBER</th>
										<th class="live-search">PREPARED BY</th>
										<th class="live-search">PREPARATION DATE</th>
									</tr>
									@foreach($_provider_payable_close as $provider_payable_close)
									<tr>
										<td>{{$provider_payable_close->payable_id}}</td>
										<td>{{$provider_payable_close->payable_soa_number}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_close->payable_recieved))}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_close->payable_due))}}</td>
										<td>{{$provider_payable_close->approval_number}}</td>
										<td>{{$provider_payable_close->user_first_name." ".$provider_payable_close->user_last_name}}</td>
										<td>{{date("F j, Y",strtotime($provider_payable_close->payable_created))}}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>