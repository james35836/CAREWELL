<script type="text/javascript">
	$(function ()
	{
		$('body').on('click',"#datepicker",function()
			{
				$(this).datepicker( {
			    format: "yyyy-mm",
			    viewMode: "month", 
			    minViewMode: "year",
			    changeYear: true,  
			    changeMonth: false,
			    autoClose: true
				});
			})
	})

	// $(document).ready(function() {
 //    $('#datepicker').datepicker({ dateFormat: 'yyyy-mm' });
 //    $('#datepicker').datepicker('setDate', new Date());
	// });

	// $('#datepicker').on('change', function() {
	//   	alert(this.value);
	// })


</script>

<style type="text/css">
	
</style>
<div class="row box-globals" id="showMonthlyReport" style="border:none !important">
		<div class="row">
            <div class="form-holder">
				<div class="col-md-6  form-content">
					<input type="text" value="{{$date}}" data-member_id="{{$member_id}}" class="form-control top-element" id="datepicker" data-ref="{{$ref}}" style="width:100%;" >	
				</div>
				<div class="col-md-6 col-xs-12 form-content">
					<a href="{{$link}}"><button class="btn btn-success pull-right top-element"><strong>EXPORT TO EXCEL</strong></button></a>
				</div>
			</div>
         </div>
		<div class="row" >
			<div class="table-responsive no-padding">

				<table class="table table-hover table-bordered">
					<tr class="titlerow">
						<th>Date Paid</th>
						<th>Amount</th>
					</tr>
					@foreach($_member as $member)
					<tr>
						<td>{{$member->cal_payment_start}}</td>
						<td>{{$member->amount}}</td>
					</tr>
					@endforeach

				</table>	
				
			</div>
		</div>
	
</div>