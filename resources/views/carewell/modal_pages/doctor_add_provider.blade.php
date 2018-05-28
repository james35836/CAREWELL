<div class="row box-globals" >
	<input type="hidden" id="doctor_id" value="{{$doctor_id}}"/>
	<div class="form-holder">
		<div class="form-content col-md-4">
			<label>PROVIDER NAME</label>
		</div>
		<div class="form-content col-md-8 form-element">
			<div class="input-group my-element">
				<select name="provider_name[]" class="provider_name form-control ">
					<option>SELECT PROVIDER</option>
					@foreach($_provider as $provider)
					@if($provider->ref!="hidden")
					<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
					@endif
					@endforeach
				</select>
				<span class="input-group-btn">
					<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
					<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
				</span>
			</div>
		</div>
	</div>
</div>