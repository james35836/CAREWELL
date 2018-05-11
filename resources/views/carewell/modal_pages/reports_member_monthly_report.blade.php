<script type="text/javascript">
	$(function ()
	{
		$("#datepicker").datepicker( {
		    format: "mm-yyyy",
		    viewMode: "month", 
		    minViewMode: "year",
		    changeYear: true,  
		    changeMonth: false
			});

	})

</script>

<div class="row box-globals" style="border:none !important">
	<div class="form-holder">
		<div class="table-responsive no-padding">
			<button class="btn btn-success pull-right">EXPORT TO EXCEL</button>
			<p>Payment Date: <input type="" name="" class="" id="datepicker"></p>
		</div>
	</div>
</div>
