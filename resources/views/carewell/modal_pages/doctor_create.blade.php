<script>  
	$(document).ready(function() {  
	    $(".addDependent").on("click", function() {  
	    	$(".appendDependent").append("<div class='form-holder'><div class='col-md-3 form-content'><label>Dependent Full Name</label></div><div class='col-md-9 form-content'><input type='text' class='form-control'/></div></div><div class='form-holder' ><div class='col-md-3 form-content'><label>Birthdate</label></div><div class='col-md-3 form-content'><input type='text' class='form-control'/></div><div class='col-md-3 form-content'><label>Relationship</label></div><div class='col-md-3 form-content'><input type='text' class='form-control'/></div></div>");  
	    });  
	    $(".removeDependent").on("click", function() {  
	        $(".appendDependent").children().last().remove();  
	    });  
	}); 
	$(function () 
	{
		//select2
		$('.select2').select2()
		//Date picker
		$('.datepicker').datepicker({
		autoclose: true
		})
	})
</script>  
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Last Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>First Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Middle Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Gender</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>SINGLE</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
		
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Specialization</label>
		</div>
		<div class="col-md-4 form-content">
			<select class="form-control">
				<option>SINGLE</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
				<option>MARIED</option>
			</select>
		</div>
		
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Dependent Full Name</label>
		</div>
		<div class="col-md-9 form-content">
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="form-holder" >
		<div class="col-md-3 form-content">
			<label>Birthdate</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Relationship</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="appendDependent">
		
	</div>
	<div class="form-holder">
		<div class="form-content" style="text-align: center;margin-top:3px;">
			<button type="button" class="btn btn-primary addDependent" style="margin-top: 8px;"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Phil-Health Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>SSS Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Tin Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>HDMF</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Carewell ID Number</label>
		</div>
		<div class="col-md-3 form-content">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-md-3 form-content">
			<label>Coverage Plan</label>
		</div>
		<div class="col-md-3 form-content">
			<select class="form-control">
				<option>PLAN 300</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Company</label>
		</div>
		<div class="col-md-9 form-content">
			<select class="form-control">
				<option>DIGIMA</option>
			</select>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-3 form-content">
			<label>Status</label>
		</div>
		<div class="col-md-9 form-content">
			<select class="form-control">
				<option>ACTIVE</option>
			</select>
		</div>
	</div>
</div>