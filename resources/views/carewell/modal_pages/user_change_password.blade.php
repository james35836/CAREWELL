
<form class="profile-form">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="form-content">
				<label>Current Password</label>
			</div>
			<div class="form-content">
				<input type="password" id="current_password" class="form-control"/>
				<input type="text" id="old_password" value="{{$old_password}}"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="form-content">
				<label>New Password</label>
			</div>
			<div class="form-content">
				<input type="password" id="new_password" class="form-control"/>
			</div>
		</div>
		<div class="form-holder">
			<div class="form-content">
				<label>Confirm New Password</label>
			</div>
			<div class="form-content">
				<input type="password" id="confirm_password" class="form-control"/>
			</div>
		</div>
		
	</div>
</form>