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
<div class="payable-create-table" id="payable-create-table">
	<div class="box-globals">
		<div class="row">
            <div class=" col-md-4 col-xs-12 pull-left">
            	<div class="col-md-6">
					<input type="text" class="form-control datepicker" placeholder="FROM">
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control datepicker" placeholder="TO">
				</div>
               
            </div>
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control " id="search_key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th><input type="checkbox" class="checkAllCheckbox"></th>
							<th>APPROVAL #</th>
							<th>UNIVERSAL ID</th>
							<th>CAREWELL ID</th>
							<th>PATIENT NAME</th>
							<th>COMPANY</th>
							<th>PROVIDER</th>
							<th>STATUS</th>
						</tr>
						@foreach($_approval as $approval)
						<tr>
							<td><input type="checkbox" ></td>
							<td>{{$approval->approval_number}}</td>
							<td>{{$approval->member_universal_id}}</td>
							<td>{{$approval->member_carewell_id}}</td>
							<td>{{$approval->member_first_name." ".$approval->member_last_name }}</td>
							<td>{{$approval->company_name}}</td>
							<td>{{$approval->provider_name}}</td>
							<td><span class="label label-success">active</span></td>
						</tr>
						@endforeach
					</table>
				</div>
				<div class="box-footer clearfix">
					@include('globals.pagination', ['paginator' => $_approval])
				</div>
			</div>
		</div>
	</div>
</div>