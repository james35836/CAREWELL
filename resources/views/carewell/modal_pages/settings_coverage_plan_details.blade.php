<script>	
$(document).ready(function()
{
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

	$('body').on("click",".add-row", function()
	{
		var $table = $(this).closest('table');
		$table.find('tr.table-row:first').clone().appendTo($table).find('.select2').select2();
		
	});
	$('body').on("click",".remove-row", function()
	{
		var $table = $(this).closest('table');
		var count  = $table.find('tr.table-row').length;
		if($(this).closest('table tr.table-row').index()==0)
		{
			toastr.error('You cannot remove first rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest("tr").remove();
		}
		
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
				<input type="text" value="{{$coverage_plan_details->coverage_name}}" name="coverage_name" id="coverage_name" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Monthly Premium</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_monthly_premium}}" name="coverage_monthly_premium" id="coverage_monthly_premium" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Age Bracket</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_age_bracket}}" name="coverage_age_bracket" id="coverage_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>DL Case Handling FEE</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_case_handling}}" name="coverage_case_handling" id="coverage_case_handling" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Maximum Benefit Limit</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_maximum_benefit}}" name="coverage_maximum_benefit" id="coverage_maximum_benefit" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Patient Confinement</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$coverage_plan_details->coverage_patient_confinement}}" id="coverage_patient_confinement" name="coverage_patient_confinement" class="form-control">
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<div class="col-md-3 form-content">
				<label>Type of Coverage</label>
			</div>
		</div>
		<div class="form-holder">
			<div class="row type-of-availment-padding">
				<div class="row availment-container">
					@foreach($_coverage_plan_covered->where('availment_parent_id',0)  as $coverage_plan_covered)
					<div class=" availment-box">
						<div class="parent-availment ">
							<p style="font-size: 20px;font-weight: bold;">
								<input type="checkbox" class="minimal" name="parent_availment[]" value="{{$coverage_plan_covered->availment_id}}"/>
								{{$coverage_plan_covered->availment_name}}
							</p>
							<table class="table table-bordered availed-table">
								<thead>
									<tr>
										<th class="col-md-5">PROCEDURE</th>
										<th class="col-md-5" >CHARGE</th>
										<th class="col-md-2"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($coverage_plan_covered->child_plan_item as $child_plan_item)
									<tr class="table-row">
										<td class="col-md-5">
											<div class="input-group">
												<select name="child_availment[]" class="form-control procedure select2">
													<option value="0">{{$child_plan_item->availment_name}}</option>
													@foreach($coverage_plan_covered->child_availment as $child_availment)
													<option value="{{$child_availment->availment_id}}">{{$child_availment->availment_name}}</option>
													@endforeach
												</select>
												<span class="input-group-btn">
													<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
												</span>
											</div>
										</td>
										<td class="col-md-4">
											<div class="input-group">
												<select name="child_availment_charges[]" class="form-control select2 ">
													<option value="0">{{$child_plan_item->availment_charges_name}}</option>
													@foreach($coverage_plan_covered->availment_charges as $availment_charges)
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
												<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
												<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
											</div>
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