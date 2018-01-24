<script>
$(function () {
//select2
$('.select2').select2()
//Date picker
$('.datepicker').datepicker({
autoclose: true
})
})



	$(".child").on("click",function() 
	{
	    $parent = $(this).prevAll("parent");
		if ($(this).is(":checked")) $parent.prop("checked",true);
		else 
		{
			var len = $(this).parent().find(".child:checked").length;
			$parent.prop("checked",len>0);
		}
		
	});
	$(".parent").on("click",function() {
		$(this).parent().find(".child").prop("checked",this.checked);
		
	});
</script>
<div class="row box-globals">
	<div class="row form-holder ">
		<div class="col-md-2 form-content">
			<label>Coverage Plan Name</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="availment_plan_name" class="form-control">
		</div>
		<div class="col-md-2 form-content">
			<label>Monthly Premium</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="availment_plan_price" class="form-control">
		</div>
	</div>
	<div class="row form-holder ">
		<div class="col-md-2 form-content">
			<label>Age Bracket</label>
		</div>
		<div class="col-md-2 form-content">
			<input type="number" id="availment_plan_name" class="form-control" placeholder="FROM">
		</div>
		<div class="col-md-2 form-content">
			<input type="number" id="availment_plan_name" class="form-control" placeholder="TO">
		</div>
		<div class="col-md-2 form-content">
			<label>DL Case Handling FEE</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="availment_plan_price" class="form-control">
		</div>
	</div>
	<div class="row form-holder ">
		<div class="col-md-2 form-content">
			<label>Maximum Benefit Limit</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="availment_plan_name" class="form-control">
		</div>
		<div class="col-md-2 form-content">
			<label>Patient Confinement</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="availment_plan_price" class="form-control">
		</div>
	</div>
</div>
<div class="row box-globals">
	<div class="row form-holder">
		<div class="col-md-3 form-content">
			<label>Type of Benefits</label>
		</div>
	</div>
	<div class="form-holder">
		<div class="row type-of-availment-padding">
			<div class="row availment-container">
				@foreach($_benefits as $benefits)
				<div class=" availment-box col-md-6 ">
					<div class="parent-availment ">
						<input type="checkbox" class="parent" name="availment_type" value="{{$benefits->benifits_id}}"/> {{$benefits->benefits_name}}
					    @foreach($benefits->child_benefits as $child_benefits)
						<div class="child-availment ">
							<input type="checkbox" class="child" name="availment_type" value="{{$child_benefits->benifits_id}}"/> {{$child_benefits->benefits_name}}
						</div>
						@endforeach
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
	
