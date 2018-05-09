<div class="row box-globals" >
	<div class="form-content">
		<input type="hidden" id="company_id" value="{{$company_id}}"/>
		<div class="form-holder">
			<div class="col-md-2 form-content">
				<label>Coverage Plan</label>
			</div>
			<div class="form-content col-md-10 form-element">
				<div class="input-group my-element">
					<select class="form-control coverage_plan_name" name="coverage_plan_name[]" id="coverage_plan">
						<option>SELECT COVERAGE</option>
						@foreach($_coverage_plan as $coverage_plan)
						<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_plan_name}}</option>
						@endforeach
					</select>
					<span class="input-group-btn">
						<button class="btn btn-primary add-element" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-element" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
