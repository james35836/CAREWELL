<div  class="modal fade import-member-modal modal-top" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title import-title"></h4>
      </div>
      <div class="modal-body modal-body-import">
        <div class='ajax-loader-import'>
          <img src='/assets/loader/loading.gif'/>
        </div>
        <div class="import-member-action">
          <div class="row menu-content">
            <div class="col-md-5">
              <i class="fa fa-download import-icons" aria-hidden="true"></i>
            </div>
            <div class="col-md-7">
              <a href="/member/download_template"><button class="btn btn-primary button-lg">DOWNLOAD TEMPLATE</button></a>
            </div>
          </div>
          <div class="row menu-content">
            <div class="col-md-5">
              <i class="fa fa-search import-icons" aria-hidden="true"></i>
            </div>
            <div class="col-md-7">
              <input type="file" id="importMemberFile" class="btn btn-danger button-lg"/>
            </div>
          </div>
          <div class="row menu-content">
            <div class="col-md-5">
              <i class="fa fa-upload import-icons" aria-hidden="true"></i>
            </div>
            <div class="col-md-7">
              <button type="button" class="btn btn-success button-lg import-member">IMPORT TEMPLATE</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-footer-import">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




