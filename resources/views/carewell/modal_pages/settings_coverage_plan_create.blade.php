<script>
$(document).ready(function()
{
$('div.box-container').find('.form-control').attr('disabled',!this.checked);
$('div.box-container').find('.btn').attr('disabled',!this.checked);
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})

$("body").on('click','.parent-box',function()
{
var $parent = $(this).closest('div.availment-box');
$parent.find('.form-control').attr('enabled',this.checked);
$parent.find('.btn').attr('enabled',this.checked);
$parent.find('.form-control').attr('disabled',!this.checked);
$parent.find('.btn').attr('disabled',!this.checked);
});
});
</script>
<form class="coverage-plan-form" method="POST">
	<div class="row box-globals">
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Coverage Plan Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_name" id="coverage_plan_name" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Premium</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_premium" id="coverage_plan_premium" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Age Bracket</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_age_bracket" id="coverage_plan_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Case Handling FEE</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_case_handling" id="coverage_plan_case_handling" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Processing Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_processing_fee" id="coverage_plan_processing_fee" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>CARI Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_cari_fee" id="coverage_plan_cari_fee" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>HIB</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_hib" id="coverage_plan_hib" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Pre-Existing</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_plan_preexisting" id="coverage_plan_preexisting">
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
				<select class="form-control" name="coverage_plan_annual_benefit" id="coverage_plan_annual_benefit">
					<option>10,000</option>
					<option>20,000</option>
					<option>30,000</option>
					<option>40,000</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>MBL</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="col-md-4 no-padding">
					<select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
						<option>10,000</option>
						<option>20,000</option>
						<option>30,000</option>
						<option>40,000</option>
					</select>
				</div>
				
				<div class="col-md-3 form-content">
					<input type="checkbox" name="coverage_plan_mbl_year" id="coverage_plan_mbl_year"><label>Year</label>
				</div>
				<div class="col-md-5 form-content no-padding">
					<input type="checkbox" name="coverage_plan_mbl_illness" id="coverage_plan_mbl_illness"><label>Illness/ Disease</label>
				</div>
				
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<div class="col-md-3 form-content">
				<label>Type of Benefits</label>
			</div>
		</div>
		<div class="form-holder">
			<div class="row type-of-availment-padding">
				<div class="row availment-container box-container">
					@foreach($_availment as $availment)
					<div class="availment-box">
						<div  class="table-responsive no-padding">
							<table class="table table-bordered" >
								<tr>
									<p style="font-size: 20px;font-weight: bold;">
										<input type="checkbox" id="availment_id" class="availment_id parent-box" name="availment_id[]" value="{{$availment->availment_id}}"/>
										{{$availment->availment_name}}
									</p>
								</tr>
								
								<tr>
									<th class="col-md-5">PROCEDURES</th>
									<th class="col-md-5" >CHARGES</th>
									<th class="col-md-2">
										
									</th>
								</tr>
								
								<tr class="table-row">
									<td class="col-md-5">
										<div class="input-group">
											<select name="procedure_id_{{$availment->availment_id}}[]" class="form-control procedure_id procedure select2">
												<option value="0">SELECT PROCEDURE</option>
												@foreach($availment->procedure as $procedure)
												<option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
												@endforeach
											</select>
											<span class="input-group-btn">
												<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
											</span>
										</div>
									</td>
									<td class="col-md-4">
										<div class="input-group">
											<select name="availment_charges_id_{{$availment->availment_id}}[]" class="form-control select2 ">
												@foreach($availment->availment_charges as $availment_charges)
												<option value="{{$availment_charges->availment_charges_id}}">{{$availment_charges->availment_charges_name}}</option>
												@endforeach
											</select>
											<span class="input-group-btn">
												<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
											</span>
										</div>
									</td>
									<td class="col-md-2 last-td">
										<div class="btn-group" role="group" aria-label="Basic example">
											<button type="button" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
											<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</form>