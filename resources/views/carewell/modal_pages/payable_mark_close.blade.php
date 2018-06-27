<form class="payable-payee-submit">
	<div class="row box-globals">
		<div class="form-holder">
			<center>
			<p style="font-size:20px;">PAYEE LIST</p>
			</center>
		</div>
	</div>
	@foreach($_payable_approval as $payable_approval)
	<div class="row box-globals">
		<div class="form-holder col-md-12">
			<div class="form-content top-label">
				<label>APP # : {{$payable_approval->approval_number}}</label>
			</div>
		</div>
		<input type="hidden" name="payable_id"  value="{{$payable_approval->payable_id}}"/>
		<input type="hidden" name="approval_id" value="{{$payable_approval->approval_id}}"/>
		<div class="payee-container">
			@foreach($payable_approval->doctor_assigned as $doctor_assigned)
				<input type="hidden" name="doctor_approval_id[]" value="{{$doctor_assigned->approval_doctor_id}}"/>
				<input type="hidden" name="provider_id[]" value="0"/>
				<div class="form-holder col-md-12">
					<div class="form-content col-md-2">
						<label>PAYEE</label>
					</div>
					<div class="form-content col-md-4">
						<input type="text" name="approval_doctor_id[]" readonly class="form-control required" value="{{$doctor_assigned->doctor_full_name}}"/>
					</div>
					<div class="form-content col-md-2">
						<label>CHECK NUMBER</label>
					</div>
					<div class="form-content col-md-4">
						<input type="text" name="payable_check_number[]" class="form-control required"/>
					</div>
				</div>
				<div class="form-holder col-md-12">
					<div class="form-content col-md-2">
						<label>RELEASE DATE</label>
					</div>
					<div class="form-content col-md-4">
						<input type="date" name="payable_release_date[]" class="form-control required" value="{{date('Y-m-d')}}"/>
					</div>
					<div class="form-content col-md-2">
						<label>CHECK DATE</label>
					</div>
					<div class="form-content col-md-4">
						<input type="date" name="payable_check_date[]" class="form-control required" value="{{date('Y-m-d')}}"/>
					</div>
				</div>
				<div class="form-holder col-md-12">
					<div class="form-content col-md-2">
						<label>CV NUMBER</label>
					</div>
					<div class="form-content col-md-4">
						<input type="text" name="payable_cv_number[]" class="form-control required"/>
					</div>
					<div class="form-content col-md-2">
						<label>AMOUNT</label>
					</div>
					<div class="form-content col-md-4">
						<input type="number" readonly name="payable_amount[]" class="form-control required" value="{{$doctor_assigned->approval_doctor_charge_carewell}}"/>
					</div>
				</div>
				<div class="form-holder col-md-12">
					<div class="form-content col-md-2">
						<label>BANK NAME</label>
					</div>
					<div class="form-content col-md-4">
						<input type="text" name="payable_bank_name[]" class="form-control required"/>
					</div>
					<div class="form-content col-md-2">
						<label>REFERENCE NUMBER</label>
					</div>
					<div class="form-content col-md-4">
						<input type="text" name="payable_refrence_number[]" class="form-control required"/>
					</div>
				</div>
				<div class="devider col-md-12" style="border: 1px solid #afaaaa;"></div>
			@endforeach
			<input type="hidden" name="doctor_approval_id[]" value="0"/>
			<input type="hidden" name="provider_id[]" value="{{$payable_approval->provider_id}}"/>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>PAYEE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="approval_doctor_id[]" readonly class="form-control required" value="{{$payable_approval->provider_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="payable_check_number[]" class="form-control required"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>RELEASE DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" name="payable_release_date[]" class="form-control required" value="{{date('Y-m-d')}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" name="payable_check_date[]" class="form-control required" value="{{date('Y-m-d')}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>CV NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="payable_cv_number[]" class="form-control required"/>
				</div>
				<div class="form-content col-md-2">
					<label>AMOUNT</label>
				</div>
				<div class="form-content col-md-4">
					<input type="number" readonly name="payable_amount[]" class="form-control required" value="{{$payable_approval->procedure_charge_carewell}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>BANK NAME</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="payable_bank_name[]" class="form-control required"/>
				</div>
				<div class="form-content col-md-2">
					<label>REFERENCE NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="payable_refrence_number[]" class="form-control required"/>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</form>