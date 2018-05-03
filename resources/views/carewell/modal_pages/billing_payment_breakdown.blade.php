<script type="text/javascript">
	$(function ()
	{
		$("body").on("click", ".date-select", function()
		{
			$(this).datepicker();
			$(this).datepicker("show");
		});
	})
</script>

<div class="row box-globals" style="border:none !important">
	@if($ref=='old')
	<div class="row">
		<div class="col-md-6 col-xs-12 pull-right">
			<button data-member_id="{{$member_id}}" class="btn-sm btn-primary top-element last-ten-payments">VIEW LAST TEN PAYMENTS</button>
		</div>
	</div>
	@endif
	<div class="form-holder">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr>
					<th>START</th>
					<th>END</th>
					<th>ACTION</th>
				</tr>
				@foreach($_payment_breakdown as $key=>$payment_breakdown)
				<tr>
					@if($payment_breakdown->cal_payment_start!='start'||$payment_breakdown->cal_payment_end!='end')
					<td><input type="text" class="form-control date-select cal_payment_start" value="{{date('m/d/Y',strtotime($payment_breakdown->cal_payment_start))}}"/></td>
					<td><input type="text" class="form-control date-select cal_payment_end" value="{{date('m/d/Y',strtotime($payment_breakdown->cal_payment_end))}}"/></td>
					@else
					<td><input type="text" class="form-control date-select cal_payment_start" value="{{$payment_breakdown->cal_payment_start}}"/></td>
					<td><input type="text" class="form-control date-select cal_payment_end" value="{{$payment_breakdown->cal_payment_end}}"/></td>
					@endif
					<td>
						<button type="button" class="btn btn-primary btn-sm update-payment-date" data-cal_new_member_id="{{$payment_breakdown->cal_new_member_id}}" data-cal_payment_id="{{$payment_breakdown->cal_payment_id}}" data-ref="{{$ref}}">UPDATE</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
