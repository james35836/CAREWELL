<script type="text/javascript">
$(function ()
{
	$(".dateyearpicker").datepicker({
	format: "yyyy",
	viewMode: "years",
	minViewMode: "years"
	});
	$('.datepicker').datepicker(
	{
	autoclose: true
	});
});
</script>
<div class="row box-globals" id="showPaymentReport" >
	<div class="row">
		<div class=" col-md-3 col-xs-12 pull-left">
			<input type="text" value="SELECT YEAR" data-member_id="{{$member_id}}" class="form-control top-element dateyearpicker" id="yearFilter">
		</div>
		<div class="col-md-3 col-xs-12 pull-right">
			<a href="{{$link}}"><button class="btn btn-primary pull-right top-element"><i class="fa fa-file-excel-o btn-icon"></i><strong>EXPORT TO EXCEL</strong></button></a>
		</div>
	</div>
	
	<div class="box-body table-responsive no-padding">
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr class="titlerow">
					<th>Year</th>
					<th colspan="2">January</th>
					<th colspan="2">February</th>
					<th colspan="2">March</th>
					<th colspan="2">April</th>
					<th colspan="2">May</th>
					<th colspan="2">June</th>
					<th colspan="2">July</th>
					<th colspan="2">August</th>
					<th colspan="2">September</th>
					<th colspan="2">October</th>
					<th colspan="2">November</th>
					<th colspan="2">December</th>
				</tr>
				@foreach($_payment as $payment)
				<tr>
					<td class="col-md-5">{{$payment->year}}</td>
					<td colspan="{{$payment->colspan}}"></td>
					@foreach($payment->cal_payment as $payments)
					<td colspan="1"><span class="label label-info">{{$payments->cal_number}}</span><span class="label label-warning">{{date("F j, Y",strtotime($payments->cal_payment_start))}}</span><span class="label label-primary">{{date("F j, Y",strtotime($payments->cal_payment_end))}}</span></td>
					@endforeach
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	
	{{-- <div class="row" >
		<div class="table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr class="titlerow">
					<th>Year</th>
					<th>January</th>
					<th>February</th>
					<th>March</th>
					<th>April</th>
					<th>May</th>
					<th>June</th>
					<th>July</th>
					<th>August</th>
					<th>September</th>
					<th>October</th>
					<th>November</th>
					<th>December</th>
				</tr>
				@foreach($_payment as $payment)
				<tr>
					<td>{{$payment->year}}</td>
					@foreach($payment->cal_payment as $payments)
					<td colspan="{{$payments->cal_payment_count}}">{{$payments->cal_number}}</td>
					@endforeach
				</tr>
				@endforeach
			</table>
			
		</div>
	</div> --}}
	
</div>