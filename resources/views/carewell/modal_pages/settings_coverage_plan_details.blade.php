<script>
$(document).ready(function()
{
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})

});
</script>
<form class="coverage-plan-form" method="POST">
	<div class="row box-globals">
		<input  type="hidden" value="{{$coverage_plan_details->coverage_plan_id}}"  name="coverage_plan_id" id="coverage_plan_id" class="form-control">
		<div class="row form-holder col-md-12 col-xs-12">
		    <div class=" col-md-1 col-xs-6 pull-right no-padding">
		      <button class="btn btn-default top-element enable-element" type="button" ><i class="fa fa-pencil-square-o btn-icon "></i>EDIT</button>
		    </div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Coverage Plan Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input  type="text" value="{{$coverage_plan_details->coverage_plan_name}}" data-ref="old"  name="coverage_plan_name" id="coverage_plan_name" class="form-control" readonly>
			</div>
			<div class="col-md-2 form-content">
				<label>Premium</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="number" value="{{$coverage_plan_details->coverage_plan_premium}}" name="coverage_plan_premium" id="coverage_plan_premium" class="form-control" readonly>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Age Bracket</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_plan_age_bracket}}" name="coverage_plan_age_bracket" id="coverage_plan_age_bracket" class="form-control" readonly>
			</div>
			<div class="col-md-2 form-content">
				<label>Case Handling FEE</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="number" value="{{$coverage_plan_details->coverage_plan_case_handling}}" name="coverage_plan_case_handling" id="coverage_plan_case_handling" class="form-control" readonly>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Processing Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="number" value="{{$coverage_plan_details->coverage_plan_processing_fee}}" name="coverage_plan_processing_fee" id="coverage_plan_processing_fee" class="form-control" readonly>
			</div>
			<div class="col-md-2 form-content">
				<label>CARI Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="number" value="{{$coverage_plan_details->coverage_plan_cari_fee}}" name="coverage_plan_cari_fee" id="coverage_plan_cari_fee" class="form-control" readonly>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>HIB</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="number" value="{{$coverage_plan_details->coverage_plan_hib}}" name="coverage_plan_hib" id="coverage_plan_hib" class="form-control" readonly>
			</div>
			<div class="col-md-2 form-content">
				<label>Pre-Existing</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_plan_preexisting" id="coverage_plan_preexisting" readonly>
					<option>{{$coverage_plan_details->coverage_plan_name}}</option>
					<option>WAVE</option>
					<option>12 MONTHS</option>
				</select>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>ABL</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select class="form-control " name="coverage_plan_annual_benefit" id="coverage_plan_annual_benefit" readonly>
						<option>{{$coverage_plan_details->coverage_plan_annual_benefit}}</option>
						<option>20,000</option>
						<option>30,000</option>
						<option>40,000</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
			</div>
			<div class="col-md-2 form-content">
				<label>MBL</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit" readonly>
						<option>{{$coverage_plan_details->coverage_plan_maximum_benefit}}</option>
						<option>20,000</option>
						<option>30,000</option>
						<option>40,000</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
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
					<p style="font-size: 20px;font-weight: bold;">
						{{$coverage_plan_covered->availment_name}}
					</p>
					<div class=" availment-box">
						<div class="table-responsive parent-availment">
							
							<table class="table table-bordered availed-table">
								<thead>
									<tr>
										@if($coverage_plan_covered->availment_id!=4)
										<th class="col-md-5">PROCEDURE</th>
										@endif
										<th class="col-md-5" >CHARGE</th>
										<th class="col-md-2">AMOUNT COVERED</th>
										<th class="col-md-2">LIMIT</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach($coverage_plan_covered->procedure as $procedure)
									<tr class="table-row">
										@if($coverage_plan_covered->availment_id!=4)
										<td class="col-md-5">
											{{$procedure->procedure_name}}
										</td>
										@endif
										<td class="col-md-4">
											{{$procedure->plan_charges}}
										</td>
										<td class="col-md-4">
											{{number_format($procedure->plan_covered_amount)}}
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