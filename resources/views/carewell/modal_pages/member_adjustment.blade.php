
<div class="row box-globals">
	<form class="member-adjustment-form" method="post">
		<input type="hidden" name="member_id_adjustment" id="member_id_adjustment" value="{{$member_id}}">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>COMPANY</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="company_id_adjustment" id="company_id_adjustment" class="form-control">
					<option value="0">SELECT COMPANY</option>
					@foreach($_company as $company)
					<option value="{{$company->company_id}}">{{$company->company_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>DEPLOYMENT</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="deployment_id_adjustment" id="deployment_id_adjustment" class="form-control">
					<option>SELECT COMPANY FIRST</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>COVERAGE PLAN</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="coverage_plan_id_adjustment" id="coverage_plan_id_adjustment" class="form-control">
					<option>SELECT COMPANY FIRST</option>
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>EMPLOYEE NUMBER</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" placeholder="THIS FIELD IS REQUIRED"  name="employee_number_adjustment" id="employee_number_adjustment" class="form-control"/>
			</div>
		</div>
		<div class="row"></div>
		<div class="form-holder ">
			<div class="col-md-2 form-content">
				<label>MODE OF PAYMENT</label>
			</div>
			<div class="col-md-4 form-content">
				<select name="member_payment_mode_adjustment" id="member_payment_mode_adjustment" class="form-control">
					@foreach($_payment as $payment)
					<option>{{$payment->payment_mode_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
	</form>
</div>
