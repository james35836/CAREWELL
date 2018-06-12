<form class="add-availment-details-form">
	<input type="hidden" name="ref" value="{{$ref}}" id="ref"/>
	<input type="hidden" name="title" value="{{$title}}" id="title"/>
	<input type="hidden" name="approval_id" value="{{$approval_id}}" id="approval_id"/>
	@if($ref=='procedure')
	<div class="row box-globals">
		<div class="table-responsive no-padding">
			<table class="table table-bordered" >
				<tr>
					<th>DESCRIPTION</th>
					<th>GROSS AMOUNT</th>
					<th>PHILHEALTH CHARITY/SWA</th>
					<th>CHARGE TO PATIENT</th>
					<th>CHARGE TO CAREWELL</th>
					<th>REMARKS</th>
					<th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
				</tr>
				<tr class="table-row">
					<td>
						<select style="width: 250px;" class="form-control select2 newProcedureList" name="procedure_id[]">
							<option value="0">-Select Description-</option>
							@foreach($_procedure as $procedure)
							<option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
							@endforeach
						</select>
					</td>
					<td><input type="text"  value="0.0" name="procedure_gross_amount[]" id="laboratory_amount" class="gross-amount form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_philhealth[]" id="" class="philhealth form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_patient[]" id="" class="charge-patient form-control"/></td>
					<td><input type="text" value="0.0" name="procedure_charge_carewell[]" id="" class="charge-carewell form-control"/></td>
					<td><textarea name="approval_remarks" cols="2" rows="1" id="approval_remarks" class="form-control">REMARKS</textarea></td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button" data-number="2" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	@else
	@endif
</form>