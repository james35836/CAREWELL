<script>
	$(function ()
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
	})
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>PROVIDER</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control select2 get-all-approval" id="provider_id">
				<option>Select Provider</option>
				@foreach($_provider as $provider)
				<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>SOA #</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="payable_soa_number"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Recieved</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control datepicker" id="payable_recieved"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Due</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control datepicker" id="payable_due"/>
		</div>
	</div>
	
</div>
<div class="row box-globals" id="load-approval">
	<div class="form-holder">
		<div class=" col-md-4 col-xs-12 pull-left">
			<h4 class="box-title medical-btn-sample">APPROVAL LIST</h4>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="load-data load-member-approval" data-target="load-member-approval">
			<div class="box-body table-responsive no-padding">
	              	<table class="table table-hover table-bordered">
		               <tr>
		               	<th><input type="checkbox" class="checkAllCheckbox"></th>
		                  	<th class="live-search">APPROVAL #</th>
		                  	<th class="live-search">UNIVERSAL ID</th>
		                  	<th class="live-search">CAREWELL ID</th>
		                  	<th class="live-search">MEMBER NAME</th>
		                  	<th class="live-search">COMPANY</th>
		                  	<th class="live-search">PROVIDER</th>
		                  	<th class="live-search">DATE ISSUED</th>
		               </tr>
		               @foreach($_approval_active as $approval_active)
		               <tr>
		               	<td><input type="checkbox" ></td>
		                  	<td><span class="label label-success view-approval-details" data-size="md" data-approval_id="{{$approval_active->approval_id}}">{{$approval_active->approval_number}}</span></td>
		                  	<td>{{$approval_active->member_universal_id}}</td>
		                  	<td>{{$approval_active->member_carewell_id}}</td>
		                  	<td>{{$approval_active->member_first_name." ".$approval_active->member_last_name }}</td>
		                  	<td>{{$approval_active->company_name}}</td>
		                  	<td>{{$approval_active->provider_name}}</td>
		                  	<td>{{date("F j, Y",strtotime($approval_active->approval_created))}}</td>
		               </tr>
		               @endforeach
	              	</table>
	          </div>
	     </div>
	</div>
</div>
