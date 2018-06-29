<script type="text/javascript">
$(function ()
{
$(".dateyearpicker").datepicker({format: "yyyy",viewMode: "years",minViewMode: "years"});
$('.datepicker').datepicker({autoclose: true});
});
</script>
<form class="cal-form-submit">
    <div class=" row box-globals">
        <div class="form-holder">
            <div class="col-md-2 form-content">
                <label>Company Name</label>
            </div>
            <div class="col-md-10 form-content">
                <select name="company_id" id="company_id" class="form-control required">
                    <option value="">SELECT COMPANY</option>
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
                <input type="text" name="cal_reveneu_period_year" id="cal_reveneu_period_year" class="form-control required dateyearpicker">
            </div>
            <div class="col-md-2 form-content">
                <label>Payment Mode</label>
            </div>
            <div class="col-md-4 form-content">
                <select id="cal_payment_mode" name="cal_payment_mode" class="form-control required">
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
                    <input type="text" class="form-control required pull-right datepicker" name="cal_start" id="cal_start">
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
                    <input type="text" class="form-control required pull-right datepicker" name="cal_end" id="cal_end">
                </div>
            </div>
        </div>
    </div>
</form>