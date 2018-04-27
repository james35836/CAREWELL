<script>
	$(function ()
	{
		$('.select2').select2()
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
			<input type="text" value="{{$payable_details->provider_name}}" class="form-control" id="provider_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>SOA #</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->payable_soa_number}}" class="form-control" id="payable_soa_number"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Recieved</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->payable_recieved}}""  class="form-control datepicker" id="payable_recieved"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Due</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{$payable_details->payable_due}}"  class="form-control datepicker" id="payable_due"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Preperation Date</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text"  value="{{date("F j, Y",strtotime($payable_details->payable_created))}}"  class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Prepared by</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" value="{{$payable_details->user_first_name." ".$payable_details->user_last_name }}" class="form-control" id="doctor_middle_name"/>
		</div>
	</div>
</div>
<div class="payable-create-table" id="payable-create-table">
	<div class="row clearfix box-globals">
		<div class="col-md-12">
			<div class="row clearfix">
				<div class="col-md-3 col-xs-12 pull-left">
		            <h4 class="box-title medical-btn-sample">APPROVAL LIST</h4>
		        </div>
		        <div class="col-md-3 col-xs-12 pull-right">
		          <button type="submit" class="btn btn-primary top-element"><i class="fa fa-file-excel-o" ></i> EXPORT TO EXCEL</button>
		        </div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th>APPROVAL #</th>
							<th>CAREWELL ID</th>
							<th>MEMBER NAME</th>
							<th>APPROVAL CREATED</th>
							<th>PROCEDURE</th>
							<th>AMOUNT</th>
							<th>PHYSICIAN</th>
							<th>PROFESIONAL FEE</th>
							<th>D/A</th>
							<th>CHARGE CAREWELL</th>
							<th>REMARKS</th>
						</tr>
						@foreach($_payable_approval as $payable_approval)
						<tr>
							<td>{{$payable_approval->approval_number}}</td>
							<td>{{$payable_approval->member_carewell_id}}</td>
							<td>{{$payable_approval->member_first_name." ".$payable_approval->member_last_name }}</td>
							<td>{{date("F j, Y",strtotime($payable_approval->approval_created))}}</td>
							<td>
								@foreach($payable_approval->availed as $availed)
								<span class="label label-default">{{$availed->procedure_name }}</span>
								@endforeach
							</td>
							<td>{{$payable_approval->member_carewell_id}}</td>
							<td>
								@foreach($payable_approval->doctor as $doctor)
								<span class="label label-default">{{$doctor->doctor_full_name}}</span>
								@endforeach
							</td>
							<td>{{$payable_approval->doctor_fee}}</td>
							<td>{{$payable_approval->provider_name}}</td>
							<td>{{$payable_approval->charge_carewell}}</td>
							<td>{{$payable_approval->charge_carewell}}</td>
						</tr>
						@endforeach
						
					</table>
			</div>
		</div>
	</div>
</div>