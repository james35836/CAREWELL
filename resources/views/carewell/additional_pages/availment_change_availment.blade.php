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
                <select class="form-control approval-select procedureList" name="procedure_id[]">
                    <option value="0">-Select Description-</option>
                </select>
            </td>
            <td><input type="text"  value="0.0" name="procedure_gross_amount[]" id="laboratory_amount" class="gross-amount form-control"/></td>
            <td><input type="text" value="0.0" name="procedure_philhealth[]" id="" class="philhealth form-control"/></td>
            <td><input type="text" value="0.0" name="procedure_charge_patient[]" id="" class="charge-patient form-control"/></td>
            <td><input type="text" value="0.0" name="procedure_charge_carewell[]" id="" class="charge-carewell form-control"/></td>
            <td><textarea name="approval_remarks"  cols="2" rows="1"  id="approval_remarks" class="form-control">REMARKS</textarea></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" data-number="2" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Gross Amount</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_gross_amount" name="procedure_total_gross_amount" id="total_gross_amount" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Philhealth Charity</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_philhealth" name="procedure_total_philhealth" id="total_philhealth" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Charge to Patient</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_charge_patient" name="procedure_total_charge_patient" id="total_charge_patient" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Charge to Carewell</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_charge_carewell" name="procedure_total_charge_carewell" id="total_charge_carewell" value="0">
    </div>
</div>