<div class=" menu-holder">
    <div class="row menu-content">
        <div class="col-md-1">
            <i class="fa fa-download import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11">
            <a href="/billing/cal_download_template/{{$cal_id}}/{{$company_id}}"><button class="btn btn-primary import-element button-lg">DOWNLOAD TEMPLATE</button></a>
        </div>
    </div>
    <div class="row  menu-content">
        <div class="col-md-1">
            <i class="fa fa-search import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11">
            <input type="file" id="importCalMemberFile" class="btn btn-danger import-element button-lg"/>
        </div>
    </div>
    <div class="row  menu-content">
        <div class="col-md-1">
            <i class="fa fa-upload import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11">
            <button type="button" data-cal_id = "{{$cal_id}}" data-company_id="{{$company_id}}" class="btn btn-success import-element button-lg import-cal-member-confirm">IMPORT TEMPLATE</button>
        </div>
    </div>
</div>