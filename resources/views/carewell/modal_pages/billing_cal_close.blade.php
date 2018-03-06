<script>
$(function () {
//select2
$('.select2').select2()
//Date picker
$('.datepicker').datepicker({
autoclose: true
})
})
</script>
<div class="row box-globals">
  <div class="col-md-8 pull-left top-label" style="">
    <p>CAL NUMBER  : {{$cal_info->cal_number}}</p>
  </div>
  
</div>
<div class=" row box-globals">

  <div class="form-holder">
    <div class="col-md-2 form-content">
      <label>Attached File</label>
    </div>
    <div class="col-md-4 form-content">
      <input type="file" class="form-control pull-right" id="cal_payment_date">
    </div>
    <div class="col-md-2 form-content">
      <label>Check Number</label>
    </div>
    <div class="col-md-4 form-content">
      <input type="text" class="form-control " id="cal_payment_date">
    </div>
    
  </div>
  <div class="form-holder">
    <div class="col-md-2 form-content">
      <label>Collection Date</label>
    </div>
    <div class="col-md-4 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_company_period_start">
      </div>
    </div>
    <div class="col-md-2 form-content">
      <label>Check Date</label>
    </div>
    <div class="col-md-4 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_company_period_start">
      </div>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-2 form-content">
      <label>O.R Number</label>
    </div>
    <div class="col-md-4 form-content">
      <input type="text" class="form-control " id="cal_payment_date">
    </div>
    <div class="col-md-2 form-content">
      <label>Amount</label>
    </div>
    <div class="col-md-4 form-content">
      <input type="text" class="form-control " id="cal_payment_date">
    </div>
  </div>
  
</div>