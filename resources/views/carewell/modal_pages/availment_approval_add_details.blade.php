<script type="text/javascript">
$(document).ready(function()
{
	$('body').on('change','.gross-amount',function()
	{
		
		var value 		= $(this).val();
		var $amount 	= $(this).parents('tr').find('.gross-amount');
		var $philhealth = $(this).parents('tr').find('.philhealth');
		var $patient 	= $(this).parents('tr').find('.charge-patient');
		var $carewell 	= $(this).parents('tr').find('.charge-carewell');

		$philhealth.val('0');
		$patient.val('0');
		$carewell.val(value);

		var $this 		= $(this).closest('div.box-globals');
		availment_center.get_total($this);
	});
	$('body').on('change','.philhealth',function()
	{
		var new_carewell = 0;
		var value = $(this).val();
		
		var $amount 	= $(this).parents('tr').find('.gross-amount');
		var $patient 	= $(this).parents('tr').find('.charge-patient');
		var $carewell 	= $(this).parents('tr').find('.charge-carewell');
		new_carewell = parseInt($amount.val())-(parseInt(value)+parseInt($patient.val()));


		if (new_carewell >=0)
		{
			$carewell.val(new_carewell);
			var $this 		= $(this).closest('div.box-globals');
			availment_center.get_total($this);
		}
		else
		{
			toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
		}
	});
	$('body').on('change','.charge-patient',function()
		{
			var new_carewell = 0;
			var value = $(this).val();
			
			var $amount 	= $(this).parents('tr').find('.gross-amount');
			var $philhealth = $(this).parents('tr').find('.philhealth');
			var $carewell 	= $(this).parents('tr').find('.charge-carewell');
			new_carewell = parseInt($amount.val())-(parseInt(value)+parseInt($philhealth.val()));

			if (new_carewell >= 0)
			{
				$carewell.val(new_carewell);
				var $this 		= $(this).closest('div.box-globals');
				availment_center.get_total($this);
			}
			else
			{
				toastr.error('Please check the amount distribution.', 'Something went wrong!', {timeOut: 3000})
			}
			
	});
});
</script>
<form action="" method="" class="add-availment-details">
	<div class="row box-globals">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
							<thead>
								<tr>
									<th style="width: 300px;">DESCRIPTION</th>
									<th>GROSS AMOUNT</th>
									<th>PHILHEALTH CHARITY/SWA</th>
									<th>CHARGE TO PATIENT</th>
									<th>CHARGE TO CAREWELL</th>
									<th><button type="button" data-ref="first" data-number="2" data-approval_id="{{$approval_id}}" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
								</tr>
							</thead>
							<tbody>
								@foreach($_availed as $availed)
								<tr>
									<td>
										<select style="width: 250px;" class="form-control select2 procedureList" name="procedure_id[]">
											<option value="0">-Select Description-</option>
											@foreach($_procedure as $procedure)
											<option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" name="procedure_gross_amount[]" id="" class="form-control gross-amount" value="{{$availed->procedure_gross_amount}}" /></td>
									<td><input type="text" name="procedure_philhealth[]" id="" class="form-control philhealth" value="{{$availed->procedure_philhealth}}" /></td>
									<td><input type="text" name="procedure_charge_patient[]" id="" class="form-control charge-patient" value="{{$availed->procedure_charge_patient}}" /></td>
									<td><input type="text" name="procedure_charge_carewell[]" id="" class="form-control charge-carewell" value="{{$availed->procedure_charge_carewell}}" /></td>
									<td>
										<div class="btn-group" role="group" aria-label="Basic example">
											<button type="button" data-number="2" data-ref="procedure" data-id="{{$availed->procedure_approval_id}}" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
			</table>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Actual PF Charges</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control total_gross_amount" name="procedure_total_gross_amount" id="total_gross_amount">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Philhealth Charity</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control total_philhealth" name="procedure_total_philhealth" id="total_philhealth">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Patient</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control total_charge_patient" name="procedure_total_charge_patient" id="total_charge_patient">
				</div>
			</div>
			<div class="col-md-6 pull-right col-xs-12">
				<div class="col-md-6 form-holder">
					<label>Total Charge to Carewell</label>
				</div>
				<div class="col-md-6 form-holder">
					<input type="text" class="form-control total_charge_carewell" name="procedure_total_charge_carewell" id="total_charge_carewell">
				</div>
			</div>	
			<br><br><br><br>
			<br>
		</div>
	</div>	
</form>	


