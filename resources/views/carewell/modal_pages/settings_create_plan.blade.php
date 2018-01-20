<script>
$(function () {
//select2
$('.select2').select2()
//Date picker
$('.datepicker').datepicker({
autoclose: true
})
})

// $('.parent-availment').click(function()
// {
//     checkBox = $(this).find('input[type=checkbox]');
//     checkBox.prop("checked", checkBox.prop("checked")); // inverse selection
// });
// $('.child-availment').click(function()
// {
//     checkBox = $(this).find('input[type=checkbox]');
//     checkBox.prop("checked", checkBox.prop("checked")); // inverse selection
// });

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
<style>
</style>
<div class="row box-holder">
	<div class="row box-globals">
		<div class="row form-holder ">
			<div class="col-md-2 form-content">
				<label>Plan Name</label>
			</div>
			<div class="col-md-4 form-content">
				<input type="text" id="availment_plan_name" class="form-control">
			</div>
			<div class="col-md-2 form-content">
				<label>Plan Price</label>
			</div>
			<div class="col-md-4 form-content">
				<select class="form-control" id="availment_plan_price">
					<option value="5000">5000</option>
					<option value="5000">5000</option>
					<option value="5000">5000</option>
					<option value="5000">5000</option>
				</select>
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
					@foreach($_availment->where('availment_parent_id',0) as $availment)
					<div class=" availment-box col-md-6 ">
						<div class="parent-availment ">
							<input type="checkbox" class="parent" name="availment_type" value="{{$availment->availment_id}}"/> {{$availment->availment_name}}
						    @foreach($_availment->where('availment_parent_id',$availment->availment_id) as $child_availment)
							<div class="child-availment ">
								<input type="checkbox" class="child" name="availment_type" value="{{$child_availment->availment_id}}"/> {{$child_availment->availment_name}}
								@foreach($_availment->where('availment_parent_id',$child_availment->availment_id) as $child_child_availment)
								<div class="child-availment ">
									<input type="checkbox" class="child" name="availment_type" value="{{$child_child_availment->availment_id}}"/> {{$child_child_availment->availment_name}}
								</div>
								@endforeach
							</div>
							@endforeach
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	
</div>