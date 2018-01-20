
<div class="row box-holder">
	<!-- CHEAT -->
		<input type="hidden" id="value-link" class="value-link" value="/company/create_company/submit"/>
		<input type="hidden" class="value-title" value="Are you sure you want to add this AVAILMENT PLAN?"/>
	<!-- CHEAT -->
	<div class="row box-globals">
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Plan Name</label>
			</div>
			<div class="col-md-4 form-content">
				{{$availment_plan->availment_plan_name}}
			</div>
			<div class="col-md-2 form-content">
				<label>Plan Price</label>
			</div>
			<div class="col-md-4 form-content">
				{{$availment_plan->availment_plan_price}}
			</div>
		</div>
	</div>
	
	<div class="row box-globals">
		<div class="row form-holder">
			<div class="col-md-3 form-content">
				<label>Type of availment</label>
			</div>
		</div>
	    <div class="form-holder">
			<div class="row type-of-availment-padding">
				<div class="row availment-container">
					@foreach($_availment_plan_details->where('availment_parent_id',0) as $availment)
						<div class="availment-box col-md-6 ">
							<div class="parent-availment ">
								<ul style="list-style-type:square">
								  <li>{{$availment->availment_name}}</li>
								</ul>
							</div>
			            	@foreach($_availment_plan_details->where('availment_parent_id',$availment->availment_id) as $child_availment)
				            	<div class="child-availment">
					            	<ul style="list-style-type:square">
									  <li>{{$child_availment->availment_name}}</li>
									</ul>
				            	</div>
			            	@endforeach
			            	<div class="child-availment">
								<label>Coverage Amount : 500</label>
			            	</div>
				        </div>
		            @endforeach
				</div>
			</div>
	    </div>
	    <div class="form-holder">
			<div class="col-md-2 form-content">
				<label>REMARKS</label>
			</div>
			<div class="col-md-10 form-content">
				<textarea class="form-control" rows="4"></textarea>
			</div>
		</div>
	</div>
	
</div>

