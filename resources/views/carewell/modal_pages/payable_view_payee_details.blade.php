<div class="row box-globals">
	<div class="form-holder">
		<center>
			<p style="font-size:20px;">DOCTOR PAYEE</p>
		</center>
	</div>
</div>
<div class="row box-globals">
	@foreach($_payee_doctor as $payee_doctor)
			<div class="col-md-4">
				<label>{{$payee_doctor->doctor_full_name}}</label>
			</div>
			<div class="col-md-4">
				<input type="text"/>
			</div>
	@endforeach
</div>
<div class="row box-globals">
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
</div>

	





