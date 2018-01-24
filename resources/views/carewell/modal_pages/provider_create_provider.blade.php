<script>  
	$(function () 
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
		//iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass   : 'iradio_minimal-blue'
	    })
	})

</script> 
<style>
#bb
{
    padding: 20px;
    background: #929090; 
    display: table;
    color: #fff;
    width:100%;
    text-align: center;
}
input[type="file"] {
    display: none;
}
</style>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Provider Name</label>
		</div>
		<div class="col-md-10 form-content">
			<input type="text" id="provider_name" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_person" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_email" class="form-control"/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Telephone Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_number" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_mobile_number" class="form-control"/>
		</div>
	</div>
	<div class="row form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Street </label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_street" class="form-control datepicker"/>
		</div>
		<div class="col-md-2 form-content">
			<label>City/Town</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_city" class="form-control datepicker"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>ZIP CODE </label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_zip" class="form-control datepicker"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Country</label>
		</div>
		<div class="col-md-4 form-content">
			
			<select id="provider_country" class="form-control">
				<option>PHILIPPINES</option>
				<option>SINGAPORE</option>
				<option>MALAYSIA</option>
				<option>CHINA</option>
				<option>JAPAN</option>
			</select>
		</div>
	</div>
	<div class="row form-holder">
		<div class="form-content pull-right col-md-4">
			<input type="checkbox" id="provider_name_agreed" class="minimal"/> <label> Use provider name as my billing name.</label>
		</div>
		
	</div>
</div>
<div class="row box-globals" >
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Billing Name</label>
		</div>
		<div class="col-md-10 form-content">
			<input type="text" id="provider_name" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label> Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_person" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Billing Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_email" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label> Telephone Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_contact_number" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_mobile_number" class="form-control"/>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>ATTACHMENT</label>
		</div>
		<div class="col-md-10 form-content">
			<label id="bb"> CLICK TO SELECT FILE (max.25MB)
    			<input type="file" id="File"   size="60" >
    		</label>
		</div>
	</div>
</div>


