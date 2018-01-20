
	<div class=" row box-globals">
		<div class=" col-md-4 pull-right">
			<button type="button" data-member_company_id="{{$company_id}}" data-member_cal_id="{{$cal_id}}" class="btn btn-primary import-cal-members  button-lg" ><i class="fa fa-plus btn-icon"></i>IMPORT MEMBER</button>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-3  col-xs-6 form-content">
				<label>CAL NUMBER : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> CAL-00005</label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>COMPANY NAME : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> DIGIMA</label>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-3  col-xs-6 form-content">
				<label>COMPANY JOBSITE : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label> BULACAN</label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>STATUS : </label>
			</div>
			<div class="col-md-3  col-xs-6 form-content">
				<label>ACTIVE </label>
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
							@endforeach
						</table>
					</div>
					<div class="box-footer clearfix">
						@include('globals.pagination', ['paginator' => $_cal_member])
					</div>
				</div>
			</div>
		</div>
	</div>
