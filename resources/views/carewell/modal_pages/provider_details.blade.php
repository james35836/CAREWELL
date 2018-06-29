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
			<li class="my-tab"><a data-toggle="tab" href="#payables">Payable List</a></li>
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
			<div id="payables" class="row tab-pane fade   table-min-height">
				<div class=" form-holder">
					<div class="form-content">
						<div class="col-md-3 col-xs-12 pull-left">
							<h4 class="box-title top-element">PAYABLES</h4>
						</div>
						<div class="col-md-3 col-xs-12 pull-right">
							<input type="text" data-name="doctors" class="top-element form-control table-searcher">
						</div>
					</div>
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
										<th class="live-search">STATUS</th>
										<th class="live-search">PREPARED BY</th>
										<th class="live-search">PREPARATION DATE</th>
									</tr>
									@foreach($_payable as $payable)
									<tr>
										<td>{{$payable->payable_number}}</td>
										<td>{{$payable->payable_soa_number}}</td>
										<td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
										<td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
										<td>
											@foreach($payable->approval_number as $approval_number)
											<span class="label label-default">{{$approval_number->approval_number}}</span>
											@endforeach
										</td>
										<td>
											@if($payable->new_archived==0)
											<span class="label label-success">OPEN</span>
											@else
											<span class="label label-danger">CLOSED</span>
											@endif
										</td>
										<td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
										<td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
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
