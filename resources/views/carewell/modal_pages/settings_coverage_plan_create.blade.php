<script>	
$(document).ready(function()
{
	$('div.box-container').find('.form-control').attr('disabled',!this.checked); 
	$('div.box-container').find('.btn').attr('disabled',!this.checked); 

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
				<input type="text" name="coverage_name" id="coverage_name" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Premium</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_monthly_premium" id="coverage_monthly_premium" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Age Bracket</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_age_bracket" id="coverage_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>DL Case Handling FEE</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_case_handling" id="coverage_case_handling" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Processing Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_age_bracket" id="coverage_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>CARI Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_case_handling" id="coverage_case_handling" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>HIV</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_age_bracket" id="coverage_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Patient Confinement</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_patient_confinement" id="coverage_patient_confinement">
					<option>10,000</option>
					<option>20,000</option>
					<option>30,000</option>
					<option>40,000</option>
				</select>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>MBL</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_maximum_benefit" id="coverage_maximum_benefit">
					<option>10,000</option>
					<option>20,000</option>
					<option>30,000</option>
					<option>40,000</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Illness</label>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Year</label>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Desease</label>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>AMOUNT</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_maximum_benefit" id="coverage_maximum_benefit">
					<option>10,000</option>
					<option>20,000</option>
					<option>30,000</option>
					<option>40,000</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Illness</label>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Year</label>
			</div>
			<div class="col-md-2 form-content">
				<input type="checkbox" ><label>Desease</label>
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
						<div class="parent-availment">
							<p style="font-size: 20px;font-weight: bold;">
								<input type="checkbox" id="parent-box" class="parent-box" name="parent_availment[]" value="{{$availment->availment_id}}"/>
								{{$availment->availment_name}}
							</p>
							<div  style="overflow-x:scroll;">
								<table class="table table-bordered availed-table" >
									<thead>
										<tr>
											<th class="col-md-5">PROCEDURE</th>
											<th class="col-md-5" >CHARGE</th>
											<th class="col-md-2"></th>
										</tr>
									</thead>
									<tbody>
										<tr class="table-row">
											<td class="col-md-5">
												<div class="input-group">
													<select name="child_availment[]" class="form-control procedure select2">
														<option value="0">SELECT PROCEDURE</option>
														@foreach($availment->child_availment as $child_availment)
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
													<button type="button" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
													<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
												</div>
												
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</form>