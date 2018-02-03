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
    <div class="col-md-6">
      <select name=""  class="form-control import-element import-number-select" id="numRows">
        <option>SELECT NUMBER ROWS</option>
        <option >5</option>
        <option >10</option>
        <option >20</option>
        <option >30</option>
        <option >40</option>
        <option >50</option>
        <option >60</option>
        <option >70</option>
        <option >80</option>
        <option >90</option>
        <option >100</option>
        <option >110</option>
        <option >120</option>
        <option >130</option>
        <option >140</option>
        <option >150</option>
        <option >160</option>
        <option >170</option>
        <option >180</option>
        <option >190</option>
        <option >200</option>
        <option >210</option>
        <option >220</option>
      </select>
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