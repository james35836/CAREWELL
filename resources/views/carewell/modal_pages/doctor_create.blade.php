<script>
	
	$(document).ready(function()
	{
		
		//Date picker
		$('.datepicker').datepicker(
		{
		autoclose: true
		});
		$('body').on("click",".add-special", function()
		{
			var $table = $(this).closest('table');
			$table.find('tr.table-row:first').clone().appendTo($table).find('.select2').select2();
			
		});
		$('body').on("click",".remove-special", function()
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
		$('body').on("click",".add-provider", function()
		{
			var $table = $(this).closest('table');
			$table.find('tr.table-row:first').clone().appendTo($table).find('.select2').select2();
			
		});
		$('body').on("click",".remove-provider", function()
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
	});
	
	
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_last_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_first_name"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_middle_name"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control" id="doctor_gender">
				<option>MALE</option>
				<option>FEMALE</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_contact_number"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control" id="doctor_email_address"/>
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#specialization">SPECIALIZATION</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#provider">NETWORK PROVIDER</a></li>
		</ul>
		<div class="tab-content" >
			<div id="specialization" class="row tab-pane fade in active table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th>SPECIALIZATION NAME</th>
							<th></th>
						</tr>
						<tr class="table-row">
							<td class="col-md-9">
								<div class="input-group">
									<select name="specialization_name[]" class="form-control select2 specialization_name">
										<option>SELECT SPECIALIZATION</option>
										@foreach($_specialization as $specialization)
										
										<option value="{{$specialization->specialization_id}}">{{$specialization->specialization_name}}</option>
										@endforeach
									</select>
									<span class="input-group-btn">
										<button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> ADD ITEM</button>
									</span>
								</div>
							</td>
							<td class="col-md-3 last-td">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-primary btn-sm add-special"><i class="fa fa-plus-circle"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-special"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="provider" class="row tab-pane fade table-min-height" >
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered specialization-table">
						<tr>
							<th>PROVIDER NAME</th>
							<th></th>
						</tr>
						<tr class="table-row">
							<td class="col-md-9">
								<select name="provider_name[]" class="provider_name form-control ">
									<option>SELECT PROVIDER</option>
									@foreach($_provider as $provider)
									<option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
									@endforeach
								</select>
							</td>
							<td class="col-md-3 last-td">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-primary btn-sm add-provider"><i class="fa fa-plus-circle"></i></button>
									<button type="button" class="btn btn-danger btn-sm remove-provider"><i class="fa fa-minus-circle"></i></button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>