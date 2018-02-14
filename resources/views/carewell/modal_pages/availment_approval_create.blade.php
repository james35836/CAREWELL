<script>
$(document).ready(function()
{
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
});
$('body').find('.get-member-info').select2();

$('body').on("click",".add-row", function()
{
	var $table = $(this).closest('table');
	$table.find('tbody tr.table-row:first').clone().appendTo($(this).closest('table tbody')).find('.select2').select2();
	
});
$('body').on("click",".remove-row", function()
{
	var $table = $(this).closest('table');
	var count  = $table.find('tr.table-row').length;
	if($(this).closest('table tr.table-row').index()==0)
	{
		toastr.error('You cannot remove first rows.', 'Something went wrong!', {timeOut: 3000})
	}
	else
	{
		$(this).closest("tr").remove();
	}
	
});
$('body').on('change','.amount',function()
{
	var sum=$(".amount").val();
	alert(sum);
});

});
</script>
<form class="approval-submit-form" method="post">
	<div  id="insertMember">
		<div class="row box-globals" >
			
			<div class="form-holder">
				<div class="col-md-2 form-content">
					<label>Name</label>
				</div>
				<div class="col-md-4 form-content form-group">
					<select data-name="member" class="form-control select2 get-member-info" style="width: 100%;">
						<option selected="selected">SELECT PATIENT</option>
						@foreach($_member as $member)
						<option value="{{$member->member_id}}">{{$member->member_carewell_id." ".$member->member_first_name." ".$member->member_middle_name." ".$member->member_last_name}}</option>
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
					<button type="button" class="btn btn-warning button-lg availment-transaction-details" disabled><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row box-globals">
		
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Network Provider</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control get-doctor-info" id="provider_id" name="provider_id">
					<option>SELECT PROVIDER</option>
					@foreach($_provider as $provider)
					<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 form-content">
				<label>Type of availment</label>
			</div>
			<div class="col-md-4 form-content">
				<select data-name="availment" class="form-control get-availment-info" name="availment_id" id="availment_id">
					<option>SELECT AVAILMENT</option>
					<option disabled>Availment List</option>
					@foreach($_availment as $availment)
					<option value="{{$availment->availment_id}}">{{$availment->availment_name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Cheif Complaint</label>
			</div>
			<div class="col-md-4 form-content">
				<textarea name="approval_complaint" id="approval_complaint" cols="2" rows="3" class="form-control" ></textarea>
			</div>
			<div class="col-md-6 form-content">
				<input type="checkbox" class="minimal" ><label> Laboratory?</label>
			</div>
		</div>
		<div class="row form-holder">
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Initial Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control" id="approval_initial_diagnosis" name="approval_initial_diagnosis" >
					<option>HYPERTENSION</option>
				</select>
			</div>
		</div>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Final Diagnosis</label>
			</div>
			<div class="col-md-10 form-content">
				<select class="form-control" id="approval_final_diagnosis" name="approval_final_diagnosis" >
					<option>HYPERTENSION</option>
				</select>
			</div>
		</div>
		<div class="row form-holder">
		</div>
	</div>
	<div id="insertAvailed">
		
	</div>
	<div id="insertDoctor">
		
	</div>
</form>