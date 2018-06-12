<div class="table-responsive no-padding">
    <table class="table table-hover table-bordered procedure-doctor-form">
        <tr>
            <th>PHYSICIAN</th>
            <th>SPECIALIZATION</th>
            <th>RATE/R VS</th>
            <th>PROCEDURE</th>
            <th>ACTUAL PF CHARGES</th>
            <th>PHILHEALTH CHARITY/SWA</th>
            <th>CHARGE TO PATIENT</th>
            <th>CHARGE TO CAREWELL</th>
            <th><button type="button" data-ref="first" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button></th>
        </tr>
        <tr class="table-row">
            <td>
                <select class="form-control approval-select doctorList" name="doctor_id[]">
                    <option value="0">SELECT PROVIDER</option>
                </select>
            </td>
            <td>
                
                <div class="input-group">
                    <select class="form-control approval-select specializationList" name="specialization_name[]">
                        <option>SPECIALIZATION</option>
                       
                    </select>
                    <span class="input-group-btn">
                        <button data-ref="string" class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                    </span>
                </div>
            </td>
            <td><input type="text"  value="2017" name="" class="form-control rateRvs"/></td>
            <td>
                <select class="form-control approval-select doctorProcedureList" name="doctor_procedure_id[]">
                    <option>PROCEDURE</option>
                </select>
            </td>
            <td><input type="text" value="0.0" name="approval_doctor_actual_pf[]" class="gross-amount form-control"/></td>
            <td><input type="text" value="0.0" name="approval_doctor_phil_charity[]" class="philhealth form-control"/></td>
            <td><input type="text" value="0.0" name="approval_doctor_charge_patient[]" class="charge-patient form-control"/></td>
            <td><input type="text" value="0.0" name="approval_doctor_charge_carewell[]" class="charge-carewell form-control"/></td>
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
        <label>Total Actual PF Charges</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_gross_amount" name="doctor_total_gross_amount" id="total_gross_amount" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Philhealth Charity</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_philhealth" name="doctor_total_philhealth" id="total_philhealth" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Charge to Patient</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_charge_patient" name="doctor_total_charge_patient" id="total_charge_patient" value="0">
    </div>
</div>
<div class="col-md-6 pull-right col-xs-12">
    <div class="col-md-6 form-holder">
        <label>Total Charge to Carewell</label>
    </div>
    <div class="col-md-6 form-holder">
        <input type="text" class="form-control total_charge_carewell" name="doctor_total_charge_carewell" id="total_charge_carewell" value="0">
    </div>
</div>