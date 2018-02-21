<div class="row box-globals">
	<div class="form-holder">
		<form class="procedure-doctor-submit-form" method="post">
			
			<div class="table-responsive no-padding">
				<table class="table table-hover table-bordered procedure-doctor-form">
					<thead>
						<tr>
							<th>PHYSICIAN/DOCTOR</th>
							<th>SPECIALIZATION</th>
							<th>ACTUAL PF CHARGES</th>
							<th>PROCEDURE/LABORATORY</th>
							<th>RATE/R VS</th>
							<th>PHILHEALTH CHARITY/SWA</th>
							<th>CHARGE TO PATIENT</th>
							<th>CHARGE TO CAREWELL</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="table-row">
							<td>
								<select class="form-control select2 get-doctor-specialty" name="doctor_id[]">
									<option>SELECT DOCTOR</option>
									@foreach($_doctor as $doctor)
									<option value="{{$doctor->doctor_id}}">{{$doctor->doctor_first_name." ".$doctor->doctor_last_name}}</option>
									@endforeach
								</select>
							</td>
							<td>
								<select class="form-control select2 doctor-specialty" name="specialization_id[]">
									<option>SELECT SPECIALIZATION</option>
								</select>
							</td>
							<td><input type="text"  value="0.0" name="approval_doctor_actual_pf[]" class="form-control"/></td>
							<td>
								<select class="form-control select2" name="procedure_id[]">
									<option>SELECT PROCEDURE</option>
									@foreach($_procedure_doctor as $procedure_doctor)
									<option value="{{$procedure_doctor->doctor_procedure_id}}">{{$procedure_doctor->doctor_procedure_descriptive}}</option>
									@endforeach
								</select>
							</td>
							<td><input type="text" value="0.0" name="approval_doctor_rate_rvs[]" class="form-control"/></td>
							<td><input type="text" value="0.0" name="approval_doctor_phil_charity[]" class="form-control"/></td>
							<td><input type="text" value="0.0" name="approval_doctor_charge_patient[]" class="form-control"/></td>
							<td><input type="text" value="0.0" name="approval_doctor_charge_carewell[]" class="form-control"/></td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary add-row"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-danger remove-row"><i class="fa fa-minus"></i></button>
								</div>
							</td>
						</tr>

						
					</tbody>
					<tfoot>
						<tr class="last-tr">
							<th>TOTAL:</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
							<th>0.0</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</form>
	</div>
</div>