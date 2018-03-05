<script>
$(function () {
//select2
$('.select2').select2()
//Date picker
$('.datepicker').datepicker({
autoclose: true
})
})
</script>
<div class=" row box-globals">
	<div class="col-md-8 pull-left top-label" style="">
		<p>CAL NUMBER  : {{$cal_details->cal_number}}</p>
	</div>
	<div class=" col-md-4 pull-right">
		<button type="button" data-member_company_id="{{$cal_details->company_id}}" data-member_cal_id="{{$cal_details->cal_id}}" class="btn btn-primary import-cal-members  button-lg" ><i class="fa fa-plus btn-icon"></i>IMPORT MEMBER</button>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2  form-content">
			<label>COMPANY NAME </label>
		</div>
		<div class="col-md-4  form-content">
			<input type="text" class="form-control " value="{{$cal_details->company_name}}" disabled/>
		</div>
		<div class="col-md-2  form-content">
			<label>PAYMENT DATE</label>
		</div>
		<div class="col-md-4  form-content">
			<input type="text" class="form-control datepicker" value="{{$cal_details->cal_payment_date}}"/>
		</div>
		
		
	</div>
	<div class="form-holder">
		<div class="col-md-2  form-content">
			<label>COVERAGE START </label>
		</div>
		<div class="col-md-4  form-content">
			<input type="text" class="form-control datepicker" value="{{$cal_details->cal_company_period_start}}"/>
		</div>
		
		<div class="col-md-2  form-content">
			<label>COVERAGE END </label>
		</div>
		<div class="col-md-4  form-content">
			<input type="text" class="form-control datepicker" value="{{$cal_details->cal_company_period_end}}"/>
		</div>
		
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="row">
			<div class="col-md-3 col-xs-12 pull-right">
				<div class="input-group margin">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
					</span>
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
				@foreach($_cal_member as $cal_member)
				<tr>
					<td>{{$cal_member->member_universal_id}}</td>
					<td>{{$cal_member->member_carewell_id}}</td>
					<td>{{$cal_member->member_first_name." ".$cal_member->member_last_name}}</td>
					<td>{{date("F j, Y",strtotime($cal_member->cal_payment_date))}}</td>
					<td>{{$cal_member->cal_payment_amount}}</td>
					<td><span class="label label-success">active</span></td>
					<td>
						<button type="button" data-cal_member_id="{{$cal_member->cal_member_id}}" class="btn btn-danger btn-sm remove-cal-member"><i class="fa fa-minus-circle"></i></button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>