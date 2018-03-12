<script>  
	$(function () 
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
	})
</script> 
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-5 form-content">
			<label>USER ACCESS LEVEL</label>
		</div>
		
		<div class="col-md-7 form-content">
			<select id="user_position" class="form-control">
				<option>{{$user_details->user_position}}</option>
				<option disabled>ROLE</option>
				<option>ADMIN</option>
				<option>MED-REP</option>
				<option>BILLING</option>
				<option>ENCODER</option>
				<option>ACCOUNTING</option>
			</select>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_last_name" value="{{$user_details->user_last_name}}" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_first_name" value="{{$user_details->user_first_name}}" class="form-control"/>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_middle_name" value="{{$user_details->user_middle_name}}" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			
			<select id="user_gender" class="form-control">
				<option>{{$user_details->user_gender}}</option>
				<option>MALE</option>
				<option>FEMALE</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_birthdate" value="{{$user_details->user_birthdate}}" class="form-control datepicker"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_contact_number" value="{{$user_details->user_contact_number}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_email" value="{{$user_details->user_email}}" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>ID NUMBER</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="user_id_number" value="{{$user_details->user_number}}" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea id="user_address" class="form-control" rows="5">{{$user_details->user_address}}</textarea>
		</div>
	</div>
</div>

