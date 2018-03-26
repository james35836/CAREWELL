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
	@if($cal_check==0)
	<div class=" col-md-4 pull-right">
		<button type="button" data-member_company_id="{{$cal_details->company_id}}" data-member_cal_id="{{$cal_details->cal_id}}" class="btn btn-primary import-cal-members  button-lg" ><i class="fa fa-plus btn-icon"></i>IMPORT MEMBER</button>
	</div>
	@endif
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3  form-content">
			<label>COMPANY NAME </label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" class="form-control" value="{{$cal_details->company_name}}" disabled/>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-3  form-content">
			<label>MODE OF PAYMENT</label>
		</div>
		<div class="col-md-3  form-content">
			<input type="text" class="form-control" value="{{$cal_details->cal_payment_mode}}"/>
		</div>
		
		<div class="col-md-3  form-content">
			<label>REVENUE YEAR</label>
		</div>
		<div class="col-md-3  form-content">
			<input type="text" class="form-control" value="{{$cal_details->cal_reveneu_period_year}}"/>
		</div>
	</div>
</div>
@if($cal_check==1)
<div class=" row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Attached File</label>
		</div>
		<div class="col-md-3 form-content">
			<a href="{{$cal_details->cal_info_attached_file}}" target="_blank">
				OPEN FILE
			</a>
		</div>
		<div class="col-md-3 form-content">
			<label>Check Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" value="{{$cal_details->cal_info_check_number}}" class="form-control " id="cal_info_check_number">
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Collection Date</label>
		</div>
		<div class="col-md-3 form-content">
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input type="text" value="{{$cal_details->cal_info_collection_date}}" class="form-control pull-right datepicker" id="cal_info_collection_date">
			</div>
		</div>
		<div class="col-md-3 form-content">
			<label>Check Date</label>
		</div>
		<div class="col-md-3 form-content">
			<div class="input-group date">
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<input type="text" value="{{$cal_details->cal_info_check_date}}" class="form-control pull-right datepicker" id="cal_info_check_date">
			</div>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>O.R Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" value="{{$cal_details->cal_info_or_number}}" class="form-control " id="cal_info_or_number">
		</div>
		<div class="col-md-3 form-content">
			<label>Amount</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" value="{{$cal_details->cal_info_amount}}" class="form-control " id="cal_info_amount">
		</div>
	</div>
</div>
@endif
<div class="row box-globals">
	
	<div class="form-holder">
		<div class="col-md-3  form-content">
			<label>NUMBER OF MEMBER</label>
		</div>
		<div class="col-md-3  form-content">
			<p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">{{$total_member}}</p>
		</div>
		
		<div class="col-md-3  form-content">
			<label>TOTAL PAYMENT AMOUNT</label>
		</div>
		<div class="col-md-3  form-content">
			<p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">{{$total_amount}}</p>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr>
					<th>Universal ID</th>
					<th>Carewell ID</th>
					<th>Name</th>
					<th>Coverage Period</th>
					<th>Period Count</th>
					<th>Paid Amount</th>
					<th>Action</th>
				</tr>
				@foreach($_cal_member as $cal_member)
				<tr>
					<td>{{$cal_member->member_universal_id}}</td>
					<td>{{$cal_member->member_carewell_id}}</td>
					<td>{{$cal_member->member_first_name." ".$cal_member->member_last_name}}</td>
					<td>{{date("F j, Y",strtotime($cal_member->cal_payment_start))}}-{{date("F j, Y",strtotime($cal_member->cal_payment_end))}}</td>
					<td>{{$cal_member->cal_payment_count}}</td>
					<td>{{$cal_member->cal_payment_amount}}</td>
					<td>
						<button type="button" data-cal_member_id="{{$cal_member->cal_member_id}}" class="btn btn-danger btn-sm remove-cal-member"><i class="fa fa-minus-circle"></i></button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
