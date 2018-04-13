
<div class="row box-globals" style="border:none !important">
	<div class="form-holder">
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover table-bordered">
				<tr>
					<th>START</th>
					<th>END</th>
					<th>AMOUNT</th>
				</tr>
				@foreach($start[$ref] as $key=>$start)
				<tr>
					<td>{{date("F j, Y",strtotime($start))}}</td>
					<td>{{date("F j, Y",strtotime($end[$ref][$key]))}}</td>
					<td><span class="label label-success">{{$payment}}</span></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
