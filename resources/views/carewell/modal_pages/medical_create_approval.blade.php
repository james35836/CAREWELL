<script>
$(function () 
{
	$('.select2').select2()
	$('.datepicker').datepicker(
	{
	autoclose: true
	})
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //append
    $(document).ready(function() {  
        $(".add-procedure").on("click", function() {  
            $(".procedure-form").append('<tr><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><select class="form-control select2"><option>JAMES OMOSORA</option></select></td><td><span class="label label-success">active</span></td></tr>');  
        });  
        $(".remove-procedure").on("click", function() {  
        	if ($(".procedure-form tr").length != 1) 
        	{
			    $(".procedure-form tr:last").remove();
			}
        	
        });  
    });  
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
			<button type="button" class="btn btn-warning button-lg medical-transaction-details" disabled><i class="fa fa-upload btn-icon"></i> TRANSACTION DETAILS</button>
		</div>
	</div>
</div>

<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Network Provider</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>Select Provider</option>
				@foreach($_provider as $provider)
				<option>{{$provider->provider_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2 form-content">
			<label>Type of availment</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>OUT PATIENT</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		
		<div class="col-md-2 form-content">
			<label>Cheif Complaint</label>
		</div>
		<div class="col-md-4 form-content">
			<textarea name="" id="" cols="2" rows="3" class="form-control"></textarea>
		</div>
		<div class="col-md-6 form-content">
			<input type="checkbox" class="minimal"><label> Laboratory?</label>
		</div>
	</div>
	<div class="row form-holder">
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Initial Diagnosis</label>
		</div>
		<div class="col-md-10 form-content">
			<select class="form-control">
				<option>HYPERTENSION</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Final Diagnosis</label>
		</div>
		<div class="col-md-10 form-content">
			<select class="form-control">
				<option>HYPERTENSION</option>
			</select>
		</div>
	</div>
	<div class="row form-holder">
	</div>
    <div class="form-holder">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form">
				<thead>
					<tr>
						<th>PROCEDURE/LABORATORY</th>
						<th>AMOUNT</th>
						<th>REMARKS</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>DISAPPROVE</th>
						<th>CHARGE TO CAREWELL</th>
						{{-- <th>
							<div class="btn-group">
							  <button type="button" class="btn btn-primary add-procedure btn-sm"><i class="fa fa-plus"></i></button>
							  <button type="button" class="btn btn-danger remove-procedure btn-sm"><i class="fa fa-minus"></i></button>
							</div>
						</th> --}}
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						{{-- <td>
							<span class="label label-success">active</span>
						</td> --}}
					</tr>
					<tr>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						{{-- <td>
							<span class="label label-success">active</span>
						</td> --}}
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
	</div>
    <div class="form-holder">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered procedure-form" style="text-align:center !important;">
				<thead>
					<tr>
						<th>NAME OF DOCTOR</th>
						<th>SPECIALIZATION</th>
						<th>ACTUAL PF CHARGES</th>
						<th>PROCEDURE</th>
						<th>RATE/R VS</th>
						<th>PHILHEALTH CHARITY/SWA</th>
						<th>CHARGE TO PATIENT</th>
						<th>DISAPPROVED</th>
						<th>CHARGE TO CAREWELL</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						{{-- <td>
							<span class="label label-success">active</span>
						</td> --}}
					</tr>
					<tr>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						<td>
							<select class="form-control select2">
								<option>JAMES OMOSORA</option>
							</select>
						</td>
						{{-- <td>
							<span class="label label-success">active</span>
						</td> --}}
					</tr>
				</tbody>
			</table>
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