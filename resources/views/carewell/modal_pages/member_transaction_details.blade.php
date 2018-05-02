<div class="row box-globals" style="min-height:320px;border:none !important">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab "><a data-toggle="tab" href="#payment">Payment History</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#availment">Availment History</a></li>
			<li class="my-tab "><a data-toggle="tab" href="#schedule">Schedule of Benifit</a></li>
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
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Approval ID</th>
								<th>Availment</th>
								<th>Availment Amount</th>
								<th>PF Amount</th>
								<th>Provider</th>
								<th>Date Availed</th>
							</tr>
						</thead>
						<tbody>
							@foreach($_availment_history as $availment_history)
							<tr>
								<td>{{$availment_history->approval_number}}</td>
								<td>{{$availment_history->availment_name}}</td>
								<td>30000</td>
								<td>4500</td>
								<td>{{$availment_history->provider_name}}</td>
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
							<p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">500</p>
						</div>
						<div class="col-md-3 form-content">
							<label>TOTAL AVAILED</label>
						</div>
						<div class="col-md-3  form-content">
							<p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">500</p>
						</div>
					</div>
				</div>
			</div>
			<div id="schedule" class="tab-pane fade">
				<form class="coverage-plan-form" method="POST">
					
					<div class="row box-globals">
						<div class="row form-holder ">
							<div class="col-md-2 form-content">
								<label>Coverage Plan Name</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_name}}"  name="coverage_plan_name" id="coverage_plan_name" class="form-control">
							</div>
							<div class="col-md-2 form-content">
								<label>Premium</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_premium}}" name="coverage_plan_premium" id="coverage_plan_premium" class="form-control">
							</div>
						</div>
						<div class="row form-holder ">
							<div class="col-md-2 form-content">
								<label>Age Bracket</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_age_bracket}}" name="coverage_plan_age_bracket" id="coverage_plan_age_bracket" class="form-control">
							</div>
							<div class="col-md-2 form-content">
								<label>Case Handling FEE</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_case_handling}}" name="coverage_plan_case_handling" id="coverage_plan_case_handling" class="form-control">
							</div>
						</div>
						<div class="row form-holder ">
							<div class="col-md-2 form-content">
								<label>Processing Fee</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_processing_fee}}" name="coverage_plan_processing_fee" id="coverage_plan_processing_fee" class="form-control">
							</div>
							<div class="col-md-2 form-content">
								<label>CARI Fee</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_cari_fee}}" name="coverage_plan_cari_fee" id="coverage_plan_cari_fee" class="form-control">
							</div>
						</div>
						<div class="row form-holder ">
							<div class="col-md-2 form-content">
								<label>HIB</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_hib}}" name="coverage_plan_hib" id="coverage_plan_hib" class="form-control">
							</div>
							<div class="col-md-2 form-content">
								<label>Pre-Existing</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_name}}" class="form-control">
							</div>
						</div>
						<div class="row form-holder ">
							<div class="col-md-2 form-content">
								<label>ABL</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_annual_benefit}}" class="form-control">
							</div>
							<div class="col-md-2 form-content">
								<label>MBL</label>
							</div>
							<div class="col-md-4 form-content">
								<input type="text" value="{{$coverage_plan_details->coverage_plan_maximum_benefit}}" class="form-control">
							</div>
						</div>
						<div class="row form-holder ">
							<div class="col-md-4 form-content col-xs-12 pull-right">
								<div class="col-md-6 col-xs-12 form-content no-padding">
									<input type="checkbox" class="minimal"  value="{{$coverage_plan_details->coverage_plan_mbl_year}}" name="coverage_plan_mbl_year" id="coverage_plan_mbl_year"> <label> Year</label>
								</div>
								<div class="col-md-6 col-xs-12 form-content no-padding">
									<input type="checkbox" class="minimal"  value="{{$coverage_plan_details->coverage_plan_mbl_illness}}" name="coverage_plan_mbl_illness" id="coverage_plan_mbl_illness"> <label> Illness/Disease</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row box-globals">
						<div class="row form-holder">
							<center>
							<p style="font-size:20px;">TYPE OF BENEFITS</p>
							</center>
						</div>
					</div>
					<div class="row box-globals">
		<div class="form-holder">
			<div class="row type-of-availment-padding">
				<div class="row availment-container">
					@foreach($_coverage_plan_covered as $coverage_plan_covered)
					<div class=" availment-box">
						<div class="parent-availment ">
							<p style="font-size: 20px;font-weight: bold;">
								{{-- <input type="checkbox" class="minimal" name="parent_availment[]" value="{{$coverage_plan_covered->availment_id}}"/> --}}
								{{$coverage_plan_covered->availment_name}}
							</p>
							<table class="table table-bordered availed-table">
								<thead>
									<tr>
										<th class="col-md-5">PROCEDURE</th>
										<th class="col-md-5" >CHARGE</th>
										<th class="col-md-2">AMOUNT COVERED</th>
										<th class="col-md-2">LIMIT</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach($coverage_plan_covered->procedure as $procedure)
									<tr class="table-row">
										<td class="col-md-5">
											{{$procedure->procedure_name}}
										</td>
										<td class="col-md-4">
											{{$procedure->plan_charges}}
										</td>
										<td class="col-md-4">
											{{$procedure->plan_covered_amount}}
										</td>
										<td class="col-md-4">
											{{$procedure->plan_limit}}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
					
					
					
					
				</form>
			</div>
		</div>
	</div>
</div>