<div class=" menu-holder">
 
  <div class="row menu-content">
    <div class="col-md-3">
    </div>
    <div class="col-md-9">
      <select name=""  class="form-control button-lg import-company-select" id="companyID">
        <option value="" class="">SELECT PROVIDER</option>
        @foreach($_provider as $provider)
        <option value="{{$provider->provider_id}}" class="">{{$provider->provider_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row menu-content">
    <div class="col-md-3">
      <i class="fa fa-download import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-9">
      <a href="" class="download-link">
        <button class="btn btn-primary button-lg member-download-template">DOWNLOAD TEMPLATE</button>
      </a>
    </div>
  </div>

  <div class="row  menu-content">
    <div class="col-md-3">
      <i class="fa fa-search import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-9">
      <input type="file" id="importMemberFile" class="btn btn-danger button-lg"/>
    </div>
  </div>
  <div class="row  menu-content">
    <div class="col-md-3">
      <i class="fa fa-upload import-icons" aria-hidden="true"></i>
    </div>
    <div class="col-md-9">
      <button type="button" class="btn btn-success button-lg import-member-confirm">IMPORT TEMPLATE</button>
    </div>
  </div>
</div>