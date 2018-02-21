
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
			<div class="col-md-3  col-xs-6 form-content">
				<label>COMPANY NAME : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> {{$cal_details->company_name}}</label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>PAYMENT DATE : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> {{$cal_details->cal_payment_date}}</label>
			</div>
			
		</div>
		<div class="form-holder">
			<div class="col-md-3  col-xs-6 form-content">
				<label>COVERAGE START : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> {{$cal_details->cal_company_period_start}}</label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>COVERAGE END : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>{{$cal_details->cal_company_period_end}} </label>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
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
							@foreach($_cal_member as $cal_member)
							<tr>
								<td>{{$cal_member->member_universal_id}}</td>
								<td>{{$cal_member->member_carewell_id}}</td>
								<td>{{$cal_member->member_first_name." ".$cal_member->member_last_name}}</td>
								<td>{{date("F j, Y",strtotime($cal_member->cal_payment_date))}}</td>
								<td>{{$cal_member->cal_payment_amount}}</td>
								<td><span class="label label-success">active</span></td>
								<td>
									<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i></button>
								</td>
							</tr>
							@endforeach
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>
