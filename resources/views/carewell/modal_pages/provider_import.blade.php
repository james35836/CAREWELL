<div class=" menu-holder">
    <div class="row menu-content">
        <div class="col-md-1 center">
            <i class="fa fa-download import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11">
            <a href="/provider/export_template" class="download-link">
                <button class="btn btn-primary import-element provider-download-template" id="providerDownloadTemplate" >DOWNLOAD TEMPLATE</button>
            </a>
        </div>
    </div>
    <div class="row  menu-content">
        <div class="col-md-1 center">
            <i class="fa fa-search import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11 center">
            {{-- <span class="btn btn-danger import-file import-element">
                <span class="file-name">SELECT FILE</span><input type="file" class="form-control" id="importProviderFile">
            </span> --}}
            <input type="file" id="importProviderFile" class="btn btn-danger import-element"/>
        </div>
    </div>
    <div class="row  menu-content">
        <div class="col-md-1 center">
            <i class="fa fa-upload import-icons import-element" aria-hidden="true"></i>
        </div>
        <div class="col-md-11">
            <button type="button" class="btn btn-success import-element import-provider-confirm">IMPORT TEMPLATE</button>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.file-name').html(fileName);
        });
    });
</script> --}}
{{-- <style>
.import-file {
position: relative;
overflow: hidden;
}
.import-file input[type=file] {
position: absolute;

opacity: 0;

}
</style> --}}
