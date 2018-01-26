<div class="table-responsive no-padding">
	<table class="table table-hover table-bordered procedure-form" style="display: inline !important;text-align:center !important;">
		<thead>
			<tr>
				<th>PHYSICIAN/DOCTOR</th>
				<th>SPECIALIZATION</th>
				<th>ACTUAL PF CHARGES</th>
				<th>PROCEDURE/LABORATORY</th>
				<th>RATE/R VS</th>
				<th>PHILHEALTH CHARITY/SWA</th>
				<th>CHARGE TO PATIENT</th>
				<th>DISAPPROVED</th>
				<th>CHARGE TO CAREWELL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<select class="form-control select2" name="doctor_id">
						<option>SELECT DOCTOR</option>
						@foreach($_doctor as $doctor)
						<option value="{{$doctor->doctor_id}}">{{$doctor->doctor_first_name." ".$doctor->doctor_last_name}}</option>
						@endforeach
					</select>
				</td>
				<td>
					<select class="form-control select2" name="">
						<option>JAMES OMOSORA</option>
					</select>
				</td>
				<td><input type="text" name="procedure_doctor_actual_pf_charges" class="form-control"/></td>
				<td>
					<select class="form-control select2" name="procedure_id">
						<option>SELECT PROCEDURE</option>
						@foreach($_procedure as $procedure)
						<option>{{$procedure->procedure_name}}</option>
						@endforeach
					</select>
				</td>
				<td><input type="text" name="procedure_doctor_rate_r_vs" class="form-control"/></td>
				<td><input type="text" name="procedure_doctor_philhealth_charity" class="form-control"/></td>
				<td><input type="text" name="procedure_doctor_charge_to_patient" class="form-control"/></td>
				<td><input type="text" name="procedure_doctor_disapproved" class="form-control"/></td>
				<td><input type="text" name="procedure_doctor_charge_to_carewell" class="form-control"/></td>
			</tr>
		</tbody>
	</table>
</div>