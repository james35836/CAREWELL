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
    <div class="col-md-2 form-content">
      <label>Company Name</label>
    </div>
    <div class="col-md-10 form-content">
      <select name="" id="company_id" class="form-control">
        <option value="0">SELECT COMPANY</option>
        @foreach($_company as $company)
        <option value="{{$company->company_id}}" >{{$company->company_name}}</option>
        @endforeach
      </select>
    </div>
    
  </div>
  
  <div class="form-holder">
    <div class="col-md-2 form-content">
      <label>Revenue Year</label>
    </div>
    <div class="col-md-4 form-content">
      <select name="" id="cal_reveneu_period_year" class="form-control">
        <option >2015</option>
        <option >2016</option>
        <option >2017</option>
        <option >2018</option>
        <option >2019</option>
        <option >2020</option>
        <option >2021</option>
        <option >2022</option>
        <option >2023</option>
        <option >2024</option>
        <option >2025</option>
        <option >2026</option>
        <option >2027</option>
        <option >2028</option>
      </select>
    </div>
    
    <div class="col-md-2 form-content">
      <label>Payment Mode</label>
    </div>
    <div class="col-md-4 form-content">
      <select name="" id="cal_payment_mode" class="form-control">
        @foreach($_period as $period)
        <option>{{$period->payment_mode_name}}</option>
        @endforeach
      </select>
    </div>
    
  </div>
  <div class="form-holder">
    <div class="col-md-2 form-content">
      <label>Payment Start</label>
    </div>
    <div class="col-md-4 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_start">
      </div>
    </div>
    <div class="col-md-2 form-content">
      <label>Payment End</label>
    </div>
    <div class="col-md-4 form-content">
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right datepicker" id="cal_end">
      </div>
    </div>
  </div>