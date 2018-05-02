<div class=" menu-holder">
  <div class="row menu-content">
    <div class="col-md-6">
      <select name=""  class="form-control import-element import-member-company-select" id="companyID">
        <option>SELECT COMPANY</option>
        @foreach($_company as $company)
        <option value="{{$company->company_id}}" class="">{{$company->company_name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 ">
      <div class="input-group import-element">
          <select class="form-control import-member-number-select" name="import-member-number-select" id="import-element import-member-number-select">
            <option>100</option>
            <option>200</option>
            <option>300</option>
            <option>400</option>
          </select>
          <span class="input-group-btn">
            <button class="btn btn-secondary add-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
          </span>
        </div>
      
    </div>
  </div>
  <div class="row menu-content">
    <div class="col-md-1 center">
      <i class="fa fa-download import-icons import-element" aria-hidden="true"></i>
    </div>
    <div class="col-md-11">
      <a href="" class="download-link">
        <button class="btn btn-primary import-element member-download-template" id="memberDownloadTemplate" disabled>DOWNLOAD TEMPLATE</button>
      </a>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-1 ">
      <i class="fa fa-search import-icons import-element" aria-hidden="true"></i>
    </div>
    <div class="col-md-11 center">
      <input type="file" id="importMemberFile" class="btn btn-danger import-element"/>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-1 center">
      <i class="fa fa-upload import-icons import-element" aria-hidden="true"></i>
    </div>
    <div class="col-md-11">
      <button type="button" class="btn btn-success import-element import-member-confirm">IMPORT TEMPLATE</button>
    </div>
  </div>
</div>