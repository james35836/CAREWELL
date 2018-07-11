<div class="row box-globals" style="min-height:320px;border:none !important">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab "><a data-toggle="tab" href="#payment">PAYMENT HISTORY</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#availment">AVAILMENT HISTORY</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#schedule">SCHEDULE OF BENEFITS</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#diagnosis_balance">DIAGNOSIS BALANCE</a></li>
		</ul>
		<div class="tab-content">
			<div id="payment" class="tab-pane fade in active">
				<div class="table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Carewell ID</th>
								<th>Cal Number</th>
								<th>Payment Start</th>
								<th>Payment End</th>
								<th>Payment Amount</th>
							</tr>
						</thead>
						<tbody>
							@foreach($_payment_history as $payment_history)
							<tr>
								<td>{{$payment_history->member_carewell_id}}</td>
								<td>{{$payment_history->cal_number}}</td>
								<td>{{date("F j, Y",strtotime($payment_history->cal_payment_start))}}</td>
								<td>{{date("F j, Y",strtotime($payment_history->cal_payment_end))}}</td>
								<td>{{$payment_history->amount}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div id="availment" class="tab-pane fade">
				<div class="table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Approval ID</th>
								<th>Availment</th>
								<th>Charge to Carewell(PROCEDURE)</th>
								<th>Charge to Carewell(PF)</th>
								<th>Provider</th>
								<th>Charge to Diagnosis</th>
								<th>Balance</th>
								<th>Date Availed</th>
							</tr>
						</thead>
						<tbody>
							@foreach($_availment_history as $availment_history)
							<tr>
								<td>{{$availment_history->approval_number}}</td>
								<td>{{$availment_history->availment_name}}</td>
								<td><span class="label label-warning">{{$availment_history->charge_carewell_procedure}}</span></td>
								<td><span class="label label-info">{{$availment_history->charge_carewell_doctor}}</span></td>
								<td>{{$availment_history->provider_name}}</td>
								<td>{{$availment_history->diagnosis_name}}</td>
								<td>10000</td>
								<td>{{date("F j, Y",strtotime($availment_history->approval_created))}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row box-globals" style="border:none !important;">
					<div class=" form-holder ">
						<div class="col-md-3 form-content">
							<label>REMAINING BALANCE</label>
						</div>
						<div class="col-md-3  form-content">
							<span class="show-money">500</span>
						</div>
						<div class="col-md-3 form-content">
							<label>TOTAL AVAILED</label>
						</div>
						<div class="col-md-3  form-content">
							<span class="show-money">500</span>
						</div>
					</div>
				</div>
			</div>
			<div id="schedule" class="tab-pane fade">
				<div class="box-globals" style="border:none;">
					<center>
						<p style="font-size:20px;">COVERAGE PLAN</p>
					</center>
				</div>
				<div class="box-globals" style="border:none;">
					<div class="table-responsive no-padding">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>COVERAGE PLAN NAME</th>
									<td>{{$coverage_plan_details->coverage_plan_name}}</td>
								    <th>PEMIUM</th>
									<td>{{$coverage_plan_details->coverage_plan_premium}}</td>
								</tr>
								<tr>
									<th>AGE BRACKET</th>
									<td>{{$coverage_plan_details->coverage_plan_age_bracket}}</td>
									<th>CASE HANDLING FEE</th>
									<td>{{$coverage_plan_details->coverage_plan_case_handling}}</td>
								</tr>
								<tr>
									<th>PROCESSING FEE</th>
									<td>{{$coverage_plan_details->coverage_plan_processing_fee}}</td>
									<th>CARD FEE</th>
									<td>{{$coverage_plan_details->coverage_plan_cari_fee}}</td>
								</tr>
								<tr>
									<th>HIB</th>
									<td>{{$coverage_plan_details->coverage_plan_hib}}</td>
									<th>PRE-EXISTING</th>
									<td>{{$coverage_plan_details->coverage_plan_preexisting}}</td>
								</tr>
								<tr>
									<th>ABL</th>
									<td>{{$coverage_plan_details->coverage_plan_annual_benefit}}</td>
									<th>MBL</th>
									<td>{{$coverage_plan_details->coverage_plan_maximum_benefit}}</td>
								</tr>
							</thead>
						</table>
					</div>
					<div class="row form-holder ">
						<div class="col-md-4 form-content col-xs-12 pull-right">
							<div class="col-md-6 col-xs-12 form-content no-padding">
								<input disabled type="checkbox" class="minimal" @if($coverage_plan_details->coverage_plan_mbl_year=="on")checked @endif> <label> Year</label>
							</div>
							<div class="col-md-6 col-xs-12 form-content no-padding">
								<input disabled type="checkbox" class="minimal" @if($coverage_plan_details->coverage_plan_mbl_illness=="on")checked @endif> <label> Illness/Disease</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row box-globals" style="border:none;">
					<center>
						<p style="font-size:20px;">TYPE OF BENEFITS</p>
					</center>
				</div>
				<div class="box-globals" style="border:none;">
					<div class="availment-container">
						@foreach($_coverage_plan_covered as $coverage_plan_covered)
						<div class="parent-availment ">
							<p style="font-size: 20px;font-weight: bold;">
								{{$coverage_plan_covered->availment_name}}
							</p>
							<table class="table table-bordered availed-table">
								<thead>
									<tr>
										<th class="col-md-5">PROCEDURE</th>
										<th class="col-md-3" >CHARGE</th>
										<th class="col-md-1"> AMOUNT</th>
										<th class="col-md-1"> BALANCE</th>
										<th class="col-md-2">AVBAILABLE LIMIT</th>
									</tr>
								</thead>
								<tbody>
									@foreach($coverage_plan_covered->procedure as $procedure)
									<tr class="table-row">
										<td class="col-md-5">{{$procedure->procedure_name}}</td>
										<td class="col-md-4">{{$procedure->plan_charges}}</td>
										<td class="col-md-4">{{$procedure->plan_covered_amount}}</td>
										<td class="col-md-4"><span class="{{$procedure->class}}">{{$procedure->balance}}</span></td>
										<td class="col-md-4">{{$procedure->plan_limit}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div id="diagnosis_balance" class="tab-pane fade">
				<div class="box-globals" style="border:none;">
					<div class="availment-container">
						<table class="table table-bordered availed-table">
							<thead>
								<tr>
									<th class="col-md-5">DIAGNOSIS NAME</th>
									<th class="col-md-3" >BALANCE</th>
								</tr>
							</thead>
							<tbody>
								@foreach($_dianosis_balance as $dianosis_balance)
								<tr class="table-row">
									<td class="col-md-5">{{$dianosis_balance->diagnosis_name}}</td>
									<td class="col-md-4">{{$dianosis_balance->balance}}</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row box-globals" style="border:none !important;">
					<div class=" form-holder ">
						<div class="col-md-3 form-content">
							<label>REMAINING BALANCE</label>
						</div>
						<div class="col-md-3  form-content">
							<span class="show-money">500</span>
						</div>
						<div class="col-md-3 form-content">
							<label>TOTAL AVAILED</label>
						</div>
						<div class="col-md-3  form-content">
							<span class="show-money">500</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>