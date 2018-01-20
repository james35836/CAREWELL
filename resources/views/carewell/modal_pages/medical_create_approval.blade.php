<script>
$(function () 
{
	$('.select2').select2()
	$('.datepicker').datepicker(
	{
	autoclose: true
	})
})
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Name</label>
		</div>
		<div class="col-md-4 form-content form-group">
			<select class="form-control select2 get-member-info" style="width: 100%;">
                <option selected="selected">Select Member SAMPLE</option>
				@foreach($_member as $member)
				<option value="{{$member->member_id}}">{{$member->member_first_name." ".$member->member_middle_name." ".$member->member_last_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>Company</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"  disabled/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Universal ID</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" disabled/>
		</div>
		<div class="col-md-2 form-content">
			<label>Carewell ID</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" disabled/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" disabled/>
		</div>
		<div class="col-md-2 form-content">
			<label>Age</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" disabled/>
		</div>
	</div>
	<div class="form-holder">
		<div class="pull-right multiple-button-holder">
			<button type="button" class="btn btn-success btn-sm  pop-up-import-member col-xs-6" data-modalname="IMPORT MEMBER" data-link="/member/import_member" disabled><i class="fa fa-upload btn-icon"></i> OPEN PAYMENT HISTORY</button>
			<button type="button" class="btn btn-warning btn-sm pop-up-md col-xs-6" data-modalname="TRANSACTION DETAILS" data-link="/member/transaction_details" disabled><i class="fa fa-info btn-icon"></i> OPEN AVAILMENT HISTORY</button>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
		<div class="col-md-3 form-content pull-right">
			<div  style="display:inline-block;">
				<select name="" id="" class="form-control">
					<option value="" class="">OUT PATIENT</option>
				</select>
			</div>
		</div>
	</div>
	<div class="form-holder">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr>
					<th>CAL</th>
					<th>Period Month</th>
					<th>Date Coverage</th>
					<th>Company</th>
					<th>Payment Period</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<tr>
					<td>CAL 01</td>
					<td>DEC-NOV</td>
					<td>DEC-NOV</td>
					<td>DIGIMA</td>
					<td>DEC-NOV</td>
					<td><span class="label label-success">active</span></td>
					<td><span class="label label-success">view details</span></td>
				</tr>
				<tr>
					<td>CAL 01</td>
					<td>DEC-NOV</td>
					<td>DEC-NOV</td>
					<td>DIGIMA</td>
					<td>DEC-NOV</td>
					<td><span class="label label-success">active</span></td>
					<td><span class="label label-success">view details</span></td>
				</tr>
				<tr>
					<td>CAL 01</td>
					<td>DEC-NOV</td>
					<td>DEC-NOV</td>
					<td>DIGIMA</td>
					<td>DEC-NOV</td>
					<td><span class="label label-success">active</span></td>
					<td><span class="label label-success">view details</span></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Provider</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>MAKATI MED</option>
			</select>
		</div>
		<div class="col-md-3 form-content">
			<label>Name Of Doctor</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>JAMES OMOSORA</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Name Of Doctor</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>JAMES OMOSORA</option>
			</select>
		</div>
		<div class="col-md-3 form-content">
			<label>Specialization</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control">
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Payee</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control">
		</div>
		<div class="col-md-3 form-content">
			<label>SOA #</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>MAKATI MED</option>
			</select>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>SOA Satus</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>MAKATI MED</option>
			</select>
		</div>
		<div class="col-md-3 form-content">
			<label>Date Processing</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control">
		</div>
		
		
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			
		</div>
		<div class="col-md-3 form-content">
			
		</div>
		<div class="col-md-3 form-content">
			<label>Date Processing</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control">
		</div>
	</div>
</div>