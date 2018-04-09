<script>
// $(document).ready(function()
// {
// 	$('div.box-container').find('.form-control').attr('disabled',!this.checked);
// 	$('div.box-container').find('.btn').attr('disabled',!this.checked);
// 	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
// 	checkboxClass: 'icheckbox_minimal-blue',
// 	radioClass   : 'iradio_minimal-blue'
// 	})
// 	$("body").on('click','.parent-box',function()
// 	{
// 	var $parent = $(this).closest('div.availment-box');
// 	$parent.find('.form-control').attr('enabled',this.checked);
// 	$parent.find('.btn').attr('enabled',this.checked);
// 	$parent.find('.form-control').attr('disabled',!this.checked);
// 	$parent.find('.btn').attr('disabled',!this.checked);
// 	});
// });
</script>
<script>
    $(function () {
        $('select[multiple].active.3col').multiselect({
            columns: 3,
            placeholder: 'Select States',
            search: true,
            searchOptions: {
                'default': 'Search States'
            },
            selectAll: true
        });
    });
</script>

<link   href="/assets/plugins/fselect/multiselect.css" rel="stylesheet">
<script src="/assets/plugins/fselect/multiselect.js"></script>

<form class="coverage-plan-form" method="POST">
	<div class="row box-globals">
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Coverage Plan Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_name" id="coverage_plan_name" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Premium</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_premium" id="coverage_plan_premium" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Age Bracket</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_age_bracket" id="coverage_plan_age_bracket" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Case Handling FEE</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_case_handling" id="coverage_plan_case_handling" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Processing Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_processing_fee" id="coverage_plan_processing_fee" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>CARD Fee</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_cari_fee" id="coverage_plan_cari_fee" class="form-control">
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>HIB</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" name="coverage_plan_hib" id="coverage_plan_hib" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Pre-Existing</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" name="coverage_plan_preexisting" id="coverage_plan_preexisting">
					<option>WAIVED</option>
					<option>12 MONTHS</option>
				</select>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>ABL</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select class="form-control " name="coverage_plan_annual_benefit" id="coverage_plan_annual_benefit">
						<option>10,000</option>
						<option>20,000</option>
						<option>30,000</option>
						<option>40,000</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
			</div>
			<div class="col-md-2 form-content">
				<label>MBL</label>
			</div>
			<div class="col-md-4 form-content">
				<div class="input-group">
					<select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
						<option>10,000</option>
						<option>20,000</option>
						<option>30,000</option>
						<option>40,000</option>
					</select>
					<span class="input-group-btn">
						<button class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
					</span>
				</div>
			</div>
		</div>
		<div class="row form-holder ">
			<div class="col-md-4 form-content col-xs-12 pull-right">
				<div class="col-md-6 col-xs-12 form-content no-padding">
					<input type="checkbox" checked class="minimal" name="coverage_plan_mbl_year" id="coverage_plan_mbl_year"> <label> Year</label>
				</div>
				<div class="col-md-6 col-xs-12 form-content no-padding">
					<input type="checkbox" checked class="minimal" name="coverage_plan_mbl_illness" id="coverage_plan_mbl_illness"> <label> Illness/Disease</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row box-globals">
		<div class="row form-holder">
			<center>
				<p style="font-size:20px;">TYPE OF BENEFITS</p>
			</center>
		</div>
	</div>
	<div class="row box-globals">
		<div class="form-holder">
			<div class="row type-of-availment-padding">
				<div class="row availment-container box-container">
					<?php $count  = 0; ?>
					@foreach($_availment as $availment)
					<div class="availment-box">
						<div  class="table-responsive no-padding">
							<table class="table table-bordered" >
								<tr>
									<p style="font-size: 20px;font-weight: bold;">
										{{$availment->availment_name}}
									</p>
								</tr>
								<tr>
						            <th class="col-md-3">PROCEDURES</th>
						            <th class="col-md-1"></th>
						        </tr>
								<tr class="table-row">
									<td >
										<div class="input-group">
											<span class="input-group-btn">
												<button class="btn btn-success add-coverage-item" data-name="{{$availment->name}}" data-availment_id="{{$availment->availment_id}}" type="button" tabindex="-1">SELECT PROCEDURE</button>
											</span>
											<input type="text" class="form-control"/>
										</div>
									</td>
									<td >
										<div class="btn-group" role="group" aria-label="Basic example">
											<button type="button" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
											<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</form>