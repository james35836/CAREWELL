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
			<label>APPROVAL NUMBER : {{$payable_approval->approval_number}}</label>
		</div>
	</div>
	<div class="payee-container">
		@foreach($payable_approval->_payee_doctor as $_payee_doctor)
{{-- _payee_other --}}
		<div class="form-holder col-md-12">
			<div class="form-content col-md-2">
				<label>NAME</label>
			</div>
			<div class="form-content col-md-4">
				<input type="text" class="form-control"/>
			</div>
			<div class="form-content col-md-2">
				<label>NAME</label>
			</div>
			<div class="form-content col-md-4">
				<input type="text" class="form-control"/>
			</div>
		</div>
		@endforeach
	</div>
	
</div>
@endforeach
{{-- <div class="row box-globals">
	<div class="form-holder">
		<center>
		<p style="font-size:20px;">OTHER PAYEE</p>
		</center>
	</div>
</div>
<div class="row box-globals">
	@foreach($_payee_other as $payee_other)
	<div class="col-md-4">
		<label>{{$payee_other->payee_name}}</label>
	</div>
	<div class="col-md-4">
		<input type="text"/>
	</div>
	@endforeach
</div> --}}