<div class=" form-holder">
	<div class="pull-right">
		<div class="btn-group">
		  <button type="button" class="btn btn-primary add-procedure-availed"><i class="fa fa-plus"></i></button>
		  <button type="button" class="btn btn-danger remove-procedure-availed"><i class="fa fa-minus"></i></button>
		</div>
	</div>
</div>
<div class="row form-holder">
</div>
<div class="table-responsive no-padding">
	<table class="table table-hover table-bordered procedure-availed-form" style="display: inline !important;">
		<thead>
			<tr>
				<th>PROCEDURE/LABORATORY</th>
				<th>AMOUNT</th>
				<th>REMARKS</th>
				<th>PHILHEALTH CHARITY/SWA</th>
				<th>CHARGE TO PATIENT</th>
				<th>DISAPPROVE</th>
				<th>CHARGE TO CAREWELL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<select class="form-control select2" name="procedure_id[]">
						<option>Select Procedure</option>
						@foreach($_procedure as $procedure)
						<option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
						@endforeach
					</select>
				</td>
				<td><input type="text" name="procedure_availed_amount[]" id="procedure_availed_amount" class="form-control"/></td>
				<td><textarea  name="procedure_availed_remarks[]" id="" cols="20" rows="2"></textarea></td>
				<td><input type="text" name="procedure_availed_philhealth_charity[]" id="" class="form-control"/></td>
				<td><input type="text" name="procedure_availed_charge_to_patient[]" id="" class="form-control"/></td>
				<td><input type="text" name="procedure_availed_disapproved[]" id="" class="form-control"/></td>
				<td><input type="text" name="procedure_availed_charge_to_carewell[]" id="" class="form-control"/></td>
			</tr>
		</tbody>
	</table>
</div>
	