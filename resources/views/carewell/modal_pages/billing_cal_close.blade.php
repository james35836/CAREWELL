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
        <input type="hidden" id="cal_id" value="{{$cal_info->cal_id}}"/>
    </div>
</div>
<div class="row box-globals">
    
    <div class="form-holder">
        <div class="col-md-3  form-content">
            <label>TOTAL MEMBER</label>
        </div>
        <div class="col-md-3  form-content">
            <p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">{{$total_member}}</p>
        </div>
        
        <div class="col-md-3  form-content">
            <label>TOTAL AMOUNT</label>
        </div>
        <div class="col-md-3  form-content">
            <p style="font-size:20px;font-size: 25px;font-weight: bold;color: #157315;">{{$total_amount}}</p>
        </div>
    </div>
</div>
<div class=" row box-globals">
    <div class="form-holder">
        <div class="col-md-2 form-content">
            <label>Attached File</label>
        </div>
        <div class="col-md-4 form-content">
            <input type="file" class="form-control pull-right" id="cal_info_attached_file">
        </div>
        <div class="col-md-2 form-content">
            <label>Check Number</label>
        </div>
        <div class="col-md-4 form-content">
            <input type="text" class="form-control " id="cal_info_check_number">
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
                <input type="text" class="form-control pull-right datepicker" id="cal_info_collection_date">
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
                <input type="text" class="form-control pull-right datepicker" id="cal_info_check_date">
            </div>
        </div>
    </div>
    <div class="form-holder">
        <div class="col-md-2 form-content">
            <label>O.R Number</label>
        </div>
        <div class="col-md-4 form-content">
            <input type="text" class="form-control " id="cal_info_or_number">
        </div>
        <div class="col-md-2 form-content">
            <label>Amount</label>
        </div>
        <div class="col-md-4 form-content">
            <input type="text" class="form-control " id="cal_info_amount" value="{{$total_amount}}">
        </div>
    </div>
    <div class="form-holder">
        <div class="col-md-2 form-content">
            <label>BANK NAME</label>
        </div>
        <div class="col-md-4 form-content">
            <input type="text" class="form-control " id="cal_info_bank">
        </div>
    </div>
</div>