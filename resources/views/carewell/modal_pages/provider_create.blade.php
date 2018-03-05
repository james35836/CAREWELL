<script>
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
	
	$('body').on("click",".add-payee", function()
	{
		$('.payee-form-element:first').clone().appendTo('.payee-number-form');
	});
	$('body').on("click",".remove-payee", function()
	{
		if($('.payee-form-element').length==1)
		{
			toastr.error('You cannot remove all text-box.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".payee-form-element").remove();
		}
	});
	
	
});
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
		<div class="col-md-4 form-content">
			<input type="text" id="provider_name" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Provider Rate/RVS</label>
		</div>
		<div class="col-md-4 form-content">
			<select name="provider_rvs" id="provider_rvs" class="form-control">
				<option value="201">201</option>
				<option value="209">209</option>
			</select>
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
			<input type="text" id="provider_telephone_number" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label> Mobile Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="provider_mobile_number" class="form-control"/>
		</div>
	</div>
	
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea cols="30" rows="3" id="provider_address" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-holder ">
			<div class="col-md-2 form-content">
				<label>Payee</label>
			</div>
			<div class="col-md-10 payee-number-form">
				<div class=" form-content payee-form-element">
					<div class="input-group">
						<input type="text" name="payee_name[]" id="company_number" class="form-control"/>
						<span class="input-group-btn">
							<button class="btn btn-primary add-payee" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
							<button class="btn btn-danger remove-payee" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
						</span>
					</div>
				</div>
				
			</div>
		</div>
</div>
{{-- <div class="row box-globals">
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
</div> --}}


