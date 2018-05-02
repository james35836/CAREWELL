<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Provider Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_name}}" id="provider_name" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Provider Rate/RVS</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$provider_details->provider_rvs}}" id="provider_rvs" class="form-control"/>
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
</div>
<div class="row box-globals" style="min-height: 258px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class=" active my-tab"><a data-toggle="tab" href="#doctors">List of Doctors</a></li>
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
										<td><span class="label label-success">active</span></td>
										<td><button data-doctor_id="{{$provider_doctor->doctor_id}}" data-size="md" class="btn btn-link view-doctor-details btn-sm">VIEW MORE</button></td>
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
<script>
	$(document).ready(function()
	{
		$(".table-searcher").on("keyup", function() {
		    var value = $(this).val();
		    var $table = $(this).closest("div.tab-pane table tr");

		    $("table."+$(this).data('name')+" tr").each(function(index) 
		    {
		        if (index !== 0) {

		            $row = $(this);

		            var id = $row.find("td.word").text();

		            if (id.indexOf(value) !== 0) 
		            {
		                $row.hide();
		            }
		            else {
		                $row.show();
		            }
		        }
		    });
  		});
	});
</script>