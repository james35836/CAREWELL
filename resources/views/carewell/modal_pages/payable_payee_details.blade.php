<form class="payable-payee-submit">
	<input type="hidden" value="{{$payable_details->payable_id}}" name="payable_id" class="form-control"/>
	<div class="row box-globals">
		<div class="col-md-8 pull-left top-label" style="">
			<p>PV #  : {{$payable_details->payable_number}}</p>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>PROVIDER</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$payable_details->provider_name}}" class="form-control" id="provider_name" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>SOA #</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$payable_details->payable_soa_number}}" class="form-control" id="payable_soa_number" disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Recieved</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$payable_details->payable_recieved}}""  class="form-control datepicker" id="payable_recieved" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Due</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{$payable_details->payable_due}}"  class="form-control datepicker" id="payable_due" disabled/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Preperation Date</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text"  value="{{date("F j, Y",strtotime($payable_details->payable_created))}}"  class="form-control" id="doctor_middle_name" disabled/>
			</div>
			<div class="col-md-2 form-content">
				<label>Prepared by</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" value="{{$payable_details->user_first_name." ".$payable_details->user_last_name }}" class="form-control" id="doctor_middle_name" disabled/>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<center>
			<p style="font-size:20px;">HOSPITAL FEE</p>
			</center>
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="payee-container">
			@foreach($_payable_hospital_provider as $key=>$payable_hospital_provider)
			@if($key!=0)
			<div class="devider col-md-12" style="border: 1px solid #afaaaa;"></div>
			@endif
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>PAYEE(P)</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="reference_payee[]"  class="form-control required" value="{{$payable_hospital_provider->provider_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_check_number[]"  class="form-control required"  value="{{$payable_hospital_provider->payable_check_number}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>RELEASE DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" readonly name="payable_release_date[]"  class="form-control required" value="{{$payable_hospital_provider->payable_release_date}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" readonly name="payable_check_date[]"  class="form-control required" value="{{$payable_hospital_provider->payable_check_date}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>CV NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_cv_number[]"  class="form-control required" value="{{$payable_hospital_provider->payable_cv_number}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>AMOUNT</label>
				</div>
				<div class="form-content col-md-4">
					<input type="number" readonly name="payable_amount[]"  class="form-control required" value="{{$payable_hospital_provider->payable_amount}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>BANK NAME</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="payable_bank_name[]" readonly class="form-control required"   value="{{$payable_hospital_provider->payable_bank_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>REFERENCE NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_refrence_number[]" class="form-control required" value="{{$payable_hospital_provider->payable_refrence_number}}"/>
				</div>
			</div>
			@endforeach
			@foreach($_payable_hospital_doctor as $key=>$payable_hospital_doctor)
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>PAYEE(D)</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="reference_payee[]"  class="form-control required" value="{{$payable_hospital_doctor->doctor_full_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_check_number[]" class="form-control required" value="{{$payable_hospital_doctor->payable_check_number}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>RELEASE DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" readonly name="payable_release_date[]" class="form-control required" value="{{$payable_hospital_doctor->payable_release_date}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date" readonly name="payable_check_date[]" class="form-control required" value="{{$payable_hospital_doctor->payable_check_date}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>CV NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_cv_number[]" class="form-control required" value="{{$payable_hospital_doctor->payable_cv_number}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>AMOUNT</label>
				</div>
				<div class="form-content col-md-4">
					<input type="number"  readonly name="payable_amount[]" class="form-control required" value="{{$payable_hospital_doctor->payable_amount}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>BANK NAME</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_bank_name[]" class="form-control required"  value="{{$payable_hospital_doctor->payable_bank_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>REFERENCE NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_refrence_number[]" class="form-control required" value="{{$payable_hospital_doctor->payable_refrence_number}}"/>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<center>
			<p style="font-size:20px;">PHYSICIAN FEE</p>
			</center>
		</div>
	</div>
	<div class="row box-globals">
		<div class="payee-container">
			@foreach($_payable_doctor as $key=>$payable_doctor)
			@if($key!=0)
			<div class="devider col-md-12" style="border: 1px solid #afaaaa;"></div>
			@endif
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>PAYEE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text"  readonly name="reference_payee[]"  class="form-control required" value="{{$payable_doctor->doctor_full_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text"  readonly name="payable_check_number[]" class="form-control required" value="{{$payable_doctor->payable_check_number}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>RELEASE DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date"  readonly name="payable_release_date[]" class="form-control required" value="{{$payable_doctor->payable_release_date}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>CHECK DATE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="date"  readonly name="payable_check_date[]" class="form-control required" value="{{$payable_doctor->payable_check_date}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>CV NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text"  readonly name="payable_cv_number[]" class="form-control required" value="{{$payable_doctor->payable_cv_number}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>AMOUNT</label>
				</div>
				<div class="form-content col-md-4">
					<input type="number" readonly name="payable_amount[]" class="form-control required" value="{{$payable_doctor->payable_amount}}"/>
				</div>
			</div>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>BANK NAME</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text"  readonly name="payable_bank_name[]" class="form-control required" value="{{$payable_doctor->payable_bank_name}}"/>
				</div>
				<div class="form-content col-md-2">
					<label>REFERENCE NUMBER</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" readonly name="payable_refrence_number[]" class="form-control required" value="{{$payable_doctor->payable_refrence_number}}"/>
				</div>
			</div>
			@endforeach
		</div>
    </div>
</form>