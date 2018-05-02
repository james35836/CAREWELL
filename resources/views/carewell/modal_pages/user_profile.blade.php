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
	$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
<style>
.upload-button {
    padding: 10px;
    border-radius: 30px;
    display: block;
    float: left;
    width: 100%;
 
}

.profile-pic {
    /*max-width: 250px;
    max-height: 250px;*/
    width:100%;
    display: block;
}

.file-upload {
    display: none !important;
}
</style>
<form class="profile-form">
	<div class="row box-globals">
		<div class="col-md-4">
			<div class="form-holder">
				<div class="form-content ">
					<img class="profile-pic" src="{{$user->user_profile}}" />
					<input class="file-upload" id="new_profile" id="newFile" type="file" accept="image/*"/>
					<input id="old_profile" value="{{$user->user_profile}}" type="hidden" />
					<input id="user_id" value="{{$user->user_id}}" type="hidden" />
				</div>
				<div class="form-content">
					<div class="upload-button 	btn btn-primary">Upload New Profile</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="form-holder">
				<div class="form-content">
					<label>USER ACCESS LEVEL</label>
				</div>
				<div class="form-content">
					<select id="user_position" class="form-control">
						<option>{{$user->user_position}}</option>
						<option disabled>ROLE</option>
						<option>ADMIN</option>
						<option>MED-REP</option>
						<option>BILLING</option>
						<option>ENCODER</option>
						<option>ACCOUNTING</option>
					</select>
				</div>
				<div class="form-content">
					<label>ID NUMBER</label>
				</div>
				<div class="form-content">
					<input type="text" disabled id="user_number" value="{{$user->user_number}}" class="form-control"/>
				</div>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Last Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="user_last_name" value="{{$user->user_last_name}}" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>First Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="user_first_name" value="{{$user->user_first_name}}" class="form-control"/>
			</div>
			
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Middle Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="user_middle_name" value="{{$user->user_middle_name}}" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Gender</label>
			</div>
			<div class="col-md-4 form-content">
				
				<select id="user_gender" class="form-control">
					<option>{{$user->user_gender}}</option>
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
				<input type="text" id="user_birthdate" value="{{$user->user_birthdate}}" class="form-control datepicker"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Contact Number</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="user_contact_number" value="{{$user->user_contact_number}}" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Email Address</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="user_email" value="{{$user->user_email}}" class="form-control"/>
			</div>
			<div class="col-md-2 form-content">
				<label>Address</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea id="user_address" class="form-control" rows="5">{{$user->user_address}}</textarea>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-4 form-content">
				<button type="button" data-user_id="{{$user->user_id}}" class="btn btn-warning change-password">CHANGE PASSWORD</button>
			</div>
		</div>
	</div>
</form>