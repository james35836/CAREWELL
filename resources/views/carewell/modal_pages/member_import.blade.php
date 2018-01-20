<div class=" menu-holder">
 
  <div class="row menu-content">
    <div class="col-md-5">
    </div>
    <div class="col-md-7">
      <select name=""  class="form-control button-lg import-company-select" id="companyID">
        <option value="" class="">SELECT COMPANY</option>
        @foreach($_company as $company)
        <option value="{{$company->company_id}}" class="">{{$company->company_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row menu-content">
    <div class="col-md-5">
      <i class="fa fa-download import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <a href="" class="download-link">
        <button class="btn btn-primary button-lg member-download-template">DOWNLOAD TEMPLATE</button>
      </a>
    </div>
  </div>

  <div class="row  menu-content">
    <div class="col-md-5">
      <i class="fa fa-search import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <input type="file" id="importMemberFile" class="btn btn-danger button-lg"/>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-5">
      <i class="fa fa-upload import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-7">
      <button type="button" class="btn btn-success button-lg import-member-confirm">IMPORT TEMPLATE</button>
    </div>
  </div>
</div>