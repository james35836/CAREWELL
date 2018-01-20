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

<div class=" row box-globals">
  <div class="form-holder">
    <div class="col-md-3 form-content">
      <label>Company Name</label>
    </div>
    <div class="col-md-9 form-content">
      <select name="" id="cal_company_id" class="form-control">
        <option value="company" >SELECT NAME</option>
        @foreach($_company as $company)
        <option value="{{$company->company_id}}" >{{$company->company_name}}</option>
        @endforeach
      </select>
    </div>
    
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <label>Revenue Period Month</label>
    </div>
    <div class="col-md-6 form-content">
      <label>Revenue Period Year</label>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <input type="text" class="form-control datepicker" id="cal_reveneu_period_month"/>
    </div>
    <div class="col-md-6 form-content">
      <input type="text" class="form-control datepicker" id="cal_reveneu_period_year"/>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <label>Revenue Period</label>
    </div>
    <div class="col-md-6 form-content">
      <label>Revenue Period Count</label>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <select name="" id="cal_reveneu_period" class="form-control">
        <option value="semi" >SEMI-MONTHLY</option>
      </select>
    </div>
    <div class="col-md-6 form-content">
      <select name="" id="cal_reveneu_period_count" class="form-control">
        <option value="first" >FIRST-PERIOD</option>
      </select>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <label>Coverage Period Start</label>
    </div>
    <div class="col-md-6 form-content">
      <label>Coverage Period End</label>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_company_period_start">
      </div>
    </div>
    <div class="col-md-6 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_company_period_end">
      </div>
    </div>
  </div>
  <div class="form-holder">
    <div class="col-md-12 form-content">
      <label>Payment Date</label>
    </div>
    
  </div>
  <div class="form-holder">
    <div class="col-md-6 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_payment_date">
      </div>
    </div>
    <div class="col-md-6 form-content">
      <button type="button" class="btn btn-primary pull-right create-cal-confirm" >Create Cal</button>
    </div>
  </div>
</div>