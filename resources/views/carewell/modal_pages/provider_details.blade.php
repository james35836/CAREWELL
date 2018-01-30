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
	<div class=" form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea id="user_permanent_address" class="form-control" rows="5">{{$provider_details->provider_address}}</textarea>			
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
					<div class="col-md-3 form-content">
						<label>Billing Name</label>
					</div>
					<div class="col-md-9 form-content">
						<input type="text" id="contract_number" class="form-control" />
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Billing Email Address</label>
					</div>
					<div class="col-md-9 form-content">
						<input type="text" id="contract_number" class="form-control" />
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Billing Address</label>
					</div>
					<div class="col-md-9 form-content">
						<input type="text" id="contract_number" class="form-control" />
					</div>
				</div>
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Telephone Number</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="text" name="contract_image" id="contract_image" class="form-control convoFile"/>
					</div>
					<div class="col-md-3 form-content">
						<label>Mobile Number</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="text" id="contract_schedule_of_benifits_image" class="form-control"/>
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
									<th>Universal ID</th>
									<th>Carewell ID</th>
									<th>Name</th>
									<th>Date Paid</th>
									<th>Paid Amount</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								{{-- @foreach($_cal_member as $cal_member)
								<tr>
									<td>{{$cal_member->member_universal_id}}</td>
									<td>{{$cal_member->member_company_carewell_id}}</td>
									<td>{{$cal_member->member_first_name." ".$cal_member->member_last_name}}</td>
									<td>{{date("F j, Y",strtotime($cal_member->cal_member_date_paid))}}</td>
									<td>{{$cal_member->cal_member_amount}}</td>
									<td><span class="label label-success">active</span></td>
									<td>
										<select name="" class="form-control cal-action">
											<option value="" >ACTION</option>
											<option value="member" >View Member</option>
											<option value="billing" class="pop-up-lg">Billing Statement</option>
										</select>
									</td>
								</tr>
								@endforeach --}}
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


