<div class=" menu-holder">
  <div class="row menu-content">
    <div class="col-md-5">
      <i class="fa fa-download import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <a href="/billing/cal_download_template/{{$cal_id}}/{{$company_id}}"><button class="btn btn-primary button-lg">DOWNLOAD TEMPLATE</button></a>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-5">
      <i class="fa fa-search import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <input type="file" id="importCalMemberFile" class="btn btn-danger button-lg"/>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-5">
      <i class="fa fa-upload import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <button type="button" data-cal_cal_id = "{{$cal_id}}" data-cal_company_id = "{{$company_id}}" class="btn btn-success button-lg import-cal-member-confirm">IMPORT TEMPLATE</button>
    </div>
  </div>
</div>