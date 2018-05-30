<div class="row">
            <div class="form-holder">
				<div class="col-md-6  form-content">
					<input type="text" value="{{date('Y-m')}}" data-member_id="{{$member_id}}" class="form-control top-element" id="datepicker" style="width:100%;" >	
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
					@foreach($_member as $member)
					<tr>
						<td>{{$member->cal_payment_start}}</td>
						<td>{{$member->amount}}</td>
					</tr>
					@endforeach

				</table>	
			</div>
		</div>