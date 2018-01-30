<div class="form-holder">
	<div class="col-md-2 form-content">
		<label>Name</label>
	</div>
	<div class="col-md-4 form-content form-group">
		<select class="form-control select2 get-member-info" style="width: 100%;">
            <option selected="selected">{{$member_info->member_first_name." ".$member_info->member_middle_name." ".$member_info->member_last_name}}</option>
			@foreach($_member as $member)
				<option value="{{$member->member_id}}">{{$member->display_name}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-2 form-content">
		<label>Company</label>
	</div>
	<div class="col-md-4 form-content">
		<input type="text" class="form-control" value="{{$member_info->company_name}}" disabled/>
	</div>
	<input type="hidden" name="member_id" value="{{$member_info->member_id}}"/>
</div>
<div class="form-holder">
	<div class="col-md-2 form-content">
		<label>Universal ID</label>
	</div>
	<div class="col-md-4 form-content">
		<input type="text" class="form-control" value="{{$member_info->member_universal_id}}" disabled/>
	</div>
	<div class="col-md-2 form-content">
		<label>Carewell ID</label>
	</div>
	<div class="col-md-4 form-content">
		<input type="text" class="form-control"  value="{{$member_info->member_company_carewell_id}}" disabled/>
	</div>
</div>
<div class="form-holder">
	<div class="col-md-2 form-content">
		<label>Birthdate</label>
	</div>
	<div class="col-md-4 form-content">
		<input type="text" class="form-control"  value="{{$member_info->member_birthdate}}" disabled/>
	</div>
	<div class="col-md-2 form-content">
		<label>Age</label>
	</div>
	<div class="col-md-4 form-content">
		<input type="text" class="form-control"  value="{{date_create($member_info->member_birthdate)->diff(date_create('today'))->y }}" disabled/>
	</div>
</div>
<div class="form-holder">
	<div class="pull-right multiple-button-holder">
		<button type="button" data-member_id="{{$member_info->member_id}}" class="btn btn-warning button-lg medical-transaction-details" ><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
	</div>
</div>

