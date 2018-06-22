<script type="text/javascript">
	$(document).ready(function()
	{
		settings_reports.calculateSum('sum-row');
		settings_reports.calculateSum('sum-mem');
		settings_reports.calculateSum('sum-ape');
		settings_reports.calculateSum('sum-cot');
		settings_reports.calculateSum('sum-emc');
		settings_reports.calculateSum('sum-con');
		settings_reports.calculateSum('sum-den');
		settings_reports.calculateSum('sum-lab');
		settings_reports.calculateSum('sum-mop');
		settings_reports.calculateSum('sum-fas');
		settings_reports.calculateSum('sum-all');
		$("#datepicker-filtering").datepicker( {
format: "yyyy-mm",
startView: "months",
minViewMode: "months",
autoclose: true
});
	});
</script>
<div class="row top-element">
<!-- 	<div class="col-md-3 col-xs-12 pull-left">
		<select class="form-control">
			<option value="">SELECT COMPANY</option>
			@foreach($_company as $company)
			<option>{{$company->company_name}}</option>
			@endforeach
		</select>
	</div> -->
	<div class="col-md-3 col-xs-12">
		<div class="btn-group">
			<a href="{{$link}}"><button type="button" class="btn btn-success">EXPORT EXCEL</button></a>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 pull-right">
		<div class="col-md-4">
			<label style="display:inline-block;">Filter Report:</label>
		</div>
		<div class="col-md-8">
			<input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="breakdown" >
		</div>
		
	</div>
</div>
<div id="showTable" class="load-data load-reports-breakdown" data-target="load-reports-breakdown">
	<div class="table-responsive no-padding">
		<table class="table table-hover table-bordered sum_table" id="showReport">
			<tr class="titlerow">
				<th>COMPANY</th>
				<th>NUMBER OF MEMBER</th>
				<th>AVAILMENT AS OF</th>
				<th>YEAR TO DATE AVAIL</th>
				<th>APE</th>
				<th>CONFINEMENT-MED</th>
				<th>CONFINEMENT-SURG</th>
				<th>CONS/OP</th>
				<th>DENTAL</th>
				<th>LAB</th>
				<th>MO</th>
				<th>FA</th>
				<th>DB</th>
				<th>HIB</th>
				<th>TOTAL</th>
			</tr>
			@foreach($_company as $company)
			<tr>
				<td>{{$company->company_name}}</td>
				<td class="sum-mem">{{$company->count_mem}}</td>
				<td>0</td>
				<td>0</td>
				<td class="sum-row sum-ape">{{$company->count_ape}}</td>
				<td class="sum-row sum-cot">{{$company->count_cot}}</td>
				<td class="sum-row sum-emc">{{$company->count_emc}}</td>
				<td class="sum-row sum-con">{{$company->count_con}}</td>
				<td class="sum-row sum-den">{{$company->count_den}}</td>
				<td class="sum-row sum-lab">{{$company->count_lab}}</td>
				<td class="sum-row sum-mop">{{$company->count_mop}}</td>
				<td class="sum-row sum-fas">{{$company->count_fas}}</td>
				<td></td>
				<td></td>
				<td  class="sum-all" id="sum-row">0</td>
			</tr>
			@endforeach
			<tr>
				<td>ACTUAL</td>
				<td id="sum-mem"></td>
				<td>0</td>
				<td>0</td>
				<td id="sum-ape"></td>
				<td id="sum-cot"></td>
				<td id="sum-emc"></td>
				<td id="sum-con"></td>
				<td id="sum-den"></td>
				<td id="sum-lab"></td>
				<td id="sum-mop"></td>
				<td id="sum-fas"></td>
				<td></td>
				<td></td>
				<td id="sum-all">0</td>
			</tr>
			
		</table>
	</div>
</div>
<div class="box-footer clearfix">
	@include('globals.pagination', ['paginator' => $_company])
</div>