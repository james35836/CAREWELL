<script>
	$('input.string-only').keypress('keypress', string_only);//function in layout name string_only
	$('input.integer-only').keypress('keypress', integer_only);
</script>
<div class="row box-globals">
	<input type="hidden" id="doctor_id" value="{{$doctor_details->doctor_id}}">
	<div class="form-holder col-md-12 col-xs-12">
	    <div class=" col-md-1 col-xs-6 pull-right no-padding">
	      <button class="btn btn-default top-element enable-element" type="button" ><i class="fa fa-pencil-square-o btn-icon "></i>EDIT</button>
	    </div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Full Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" readonly  value="{{$doctor_details->doctor_full_name}}" class="string-only form-control" id="doctor_full_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control" id="doctor_gender" readonly>
				<option>{{$doctor_details->doctor_gender}}</option>
				@if($doctor_details->doctor_gender!="MALE"&&$doctor_details->doctor_gender!="FEMALE")
				<option>MALE</option>
				<option>FEMALE</option>
				@elseif($doctor_details->doctor_gender!="MALE")
				<option>MALE</option>
				@elseif($doctor_details->doctor_gender!="FEMALE")
				<option>FEMALE</option>
				@endif
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" readonly value="{{$doctor_details->doctor_contact_number}}"  class="form-control" id="doctor_contact_number"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="email" readonly value="{{$doctor_details->doctor_email_address}}"  class="form-control" id="doctor_email_address"/>
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
		</ul>
		<div class="tab-content" >
			<div id="provider"  class="row tab-pane fade in active table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th>PROVIDER NAME</th>
							<th class="col-md-1 col-xs-2"><button data-doctor_id = "{{$doctor_details->doctor_id}}" class="btn-primary btn btn-sm add-doctor-provider"><i class="fa fa-plus"></i> ADD PROVIDER</button></th>
						</tr>
						@foreach($_doctor_provider as $doctor_provider)
						<tr class="table-row">
							<td>{{$doctor_provider->provider_name}}</td>
							@if($doctor_provider->doctor_archive == 0)
								<td><span class="label label-success">active</span></td>
							@else
								<td><span class="label label-danger">inactive</span></td>
							@endif
							<td><span  data-size="md" data-provider_id="{{$doctor_provider->provider_id}}" class="label label-info view-provider-details"><i class="fa fa-eye"></i> VIEW  PROVIDER</span></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>