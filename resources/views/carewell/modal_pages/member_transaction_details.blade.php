<div class="row box-globals" style="min-height:320px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#payment">Payment History</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#availment">Availment History</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#schedule">Schedule of Benifit</a></li>
		</ul>
		<div class="tab-content">
			<div id="payment" class="tab-pane fade in active">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Company</th>
								<th>Cal Number</th>
								<th>Payment Amount</th>
								<th>Payment Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($_payment_history as $payment_history)
							<tr>
								<td>{{$payment_history->company_name}}</td>
								<td>{{$payment_history->cal_number}}</td>
								<td>{{$payment_history->cal_member_amount}}</td>
								<td>{{date("F j, Y",strtotime($payment_history->cal_member_date_paid))}}</td>
								<td><span class="label label-success">active</span></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div id="availment" class="tab-pane fade">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Approval ID</th>
								<th>Universal ID</th>
								<th>Provider</th>
								<th>Date Created</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($_approval as $approval)
							<tr>
								<td>{{$approval->approval_number}}</td>
								<td>{{$approval->member_universal_id}}</td>
								<td>{{$approval->provider_name}}</td>
								<td>{{date("F j, Y",strtotime($approval->approval_created))}}</td>
								<td><span class="label label-success">active</span></td>
								<td><button data-approval_id="{{$approval->approval_id}}" class="btn btn-link btn-sm view-member-approval-details">view details</button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div id="schedule" class="tab-pane fade">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>John</td>
								<td>Doe</td>
								<td>john@example.com</td>
							</tr>
							<tr>
								<td>Mary</td>
								<td>Moe</td>
								<td>mary@example.com</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>