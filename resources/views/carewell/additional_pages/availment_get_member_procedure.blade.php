<div class="row box-globals">
	<div class="table-responsive no-padding">
		<table class="table table-bordered" >
			<thead>
				<tr>
					<th>PROCEDURE/LABORATORY</th>
					<th>AMOUNT</th>
					<th>PHILHEALTH CHARITY/SWA</th>
					<th>CHARGE TO PATIENT</th>
					<th>CHARGE TO CAREWELL</th>
					<th>REMARKS</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table-row">
					<td>
						<select class="form-control select2 get-procedure-amount" name="availed_id[]">
							<option>Select Procedure</option>
							@foreach($_procedure as $procedure)
							<option value="{{$procedure->availment_id}}">{{$procedure->availment_name}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="text" value="0.0" name="[]" id="procedure_availed_amount" class="amount form-control"/></td>
					<td><input type="text" value="0.0" name="availed_phil_charity[]" id="" class="form-control"/></td>
					<td><input type="text" value="0.0" name="availed_charge_patient[]" id="" class="form-control"/></td>
					<td><input type="text" value="0.0" name="availed_charge_carewell[]" id="" class="form-control"/></td>
					<td><textarea  name="availed_remarks[]" id="" cols="20" rows="2">NONE</textarea></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-primary  add-row"><i class="fa fa-plus"></i></button>
							<button type="button" class="btn btn-danger  remove-row"><i class="fa fa-minus"></i></button>
						</div>
					</td>
				</tr>
			</tbody>
			<tfooter>
				<tr>
					<th>TOTAL:</th>
					<th>0.0</th>
					<th>0.0</th>
					<th>0.0</th>
					<th>0.0</th>
					<th>0.0</th>
					<th>0.0</th>
				</tr>
				</tfooter>
		</table>
	</div>
</div>