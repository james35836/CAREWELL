<form class="payable-payee-submit">
	<div class="row box-globals">
		<div class="col-md-8 pull-left top-label" style="">
			<p>PV #  : {{$payable_details->payable_number}}</p>
		</div>
	</div>
	<div class="row box-globals">
		<input type="hidden" value="{{$payable_details->payable_id}}" class="form-control" id="payable_id"/>
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
			<p style="font-size:20px;">PAYEE LIST</p>
			</center>
		</div>
	</div>
	@foreach($_payable_approval as $payable_approval)
	<div class="row box-globals">
		<input type="hidden" name="payable_id"  value="{{$payable_approval->payable_id}}"/>
		<input type="hidden" name="approval_id" value="{{$payable_approval->approval_id}}"/>
		<div class="payee-container">
			@foreach($payable_approval->payee_list as $payee_list)
			<input type="hidden" name="doctor_approval_id[]" value="{{$payee_list->approval_doctor_id}}"/>
			<input type="hidden" name="provider_id[]" value="0"/>
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>PAYEE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="approval_doctor_id[]" readonly class="form-control required" value="{{$payee_list->doctor_full_name}}"/>
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
					<input type="number" readonly name="payable_amount[]" class="form-control required" value="{{$payee_list->approval_doctor_charge_carewell}}"/>
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
		</div>
		<div class="payee-container">
			<input type="hidden" name="doctor_approval_id[]" value="0"/>
			<input type="hidden" name="provider_id[]" value="{{$payable_approval->approval_payee_id}}"/>
			{{-- @foreach($payable_approval->hospital_fee as $hospital_fee) --}}
			<div class="form-holder col-md-12">
				<div class="form-content col-md-2">
					<label>HOSPITAL FEE</label>
				</div>
				<div class="form-content col-md-4">
					<input type="text" name="approval_doctor_id[]" readonly class="form-control required" value=""/>
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
			{{-- @endforeach --}}
		</div>
	</div>
	@endforeach
</form>