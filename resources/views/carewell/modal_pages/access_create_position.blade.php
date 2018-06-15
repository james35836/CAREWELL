<style>
	.role-container
	{
		border: 1px solid gray;
	}
	.role-container label
	{
		text-decoration: underline;
	}
	.sub-role
	{
		padding-left:50px;
	}
</style>
<form  class="position-submit-form">
	<div class="row box-globals">
		<div class="form-holder">
			<div class="col-md-5 form-content">
				<label>POSITION NAME</label>
			</div>
			
			<div class="col-md-7 form-content">
				<input type="text" name="position_name" id="position_name" class="form-control"/>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
			<p style="font-size:20px;">ACCESS LIST</p>
			</center>
		</div>
	</div>

	<div class="row box-globals">
		@foreach($_access as $access)
		<div class="form-holder col-md-6  parent">
			<div class="role-container">
				<div class="main-role col-md-12" >
					<div class="col-md-2 form-content">
					<input type="checkbox" name="access_id[]" value="{{$access->access_id}}" id="user_last_name" class="parent"/>
					</div>
					<div class="col-md-10 form-content">
						<label>{{$access->access_name}}</label>
					</div>
				</div>
				@foreach($access->sub_acces as $sub_acces)
				<div class="sub-role child">
					<div class="col-md-2 form-content">
						<input type="checkbox" name="access_id[]" value="{{$sub_acces->access_id}}" id="user_last_name" class="child"/>
					</div>
					<div class="col-md-10 form-content">
						<label>{{$sub_acces->access_name}}</label>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endforeach
	</div>
</form>