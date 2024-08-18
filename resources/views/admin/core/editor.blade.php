<div id="adminuploadImage" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Upload Image</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="adminuploadImageBody">
          <div class="col-md-12">
              <input type="file" id="adminuploadAjax" name="adminuploadAjax" />
              <input type="hidden" id="adminuploadAjaxInput" />
          </div>
        <div class="col-md-12" id="msgIndicator">
<div class="alert alert-info">
<strong>Info!</strong> Indicates a neutral informative change or action.
</div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Width</label>
                        <input type="number" class="form-control" step="any" min="0" id="imageinlinewidth" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Height</label>
                        <input type="number" class="form-control" step="any" min="0" id="imageinlineheight" />
                    </div>
                </div>
                <div class="col-md-12" id="img_href_admin" style="display:none;">
                    <div class="form-group">
                        <label class="control-label">Apply href link</label>
                        <input type="text"  id="imagehref" class="form-control" />
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <label class="control-label">Applied Css</label>
                    <div id="img_css_admin">
                        
                    </div>
                </div> -->
            </div>
        </div>
        <div class="text-center">
            <input type="button" id="normal_admin_ajax_image_upload" class="btn btn-success" value="Upload" onclick="UploadFile('adminuploadAjax',$('#adminuploadAjaxInput').val()+'|'+$('#imageinlinewidth').val()+'|'+$('#imageinlineheight').val())" />
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="anchorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Anchor Management</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label class="control-label col-md-4">Anchor Link</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="anchor_link_admin_ajax" />
            </div>
          </div>
          <div class="col-md-12">
            <label class="control-label col-md-4">Anchor Name</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="anchor_name_admin_ajax" />
            </div>
          </div>
          <div class="col-md-12" style="margin-top:10px;">
            <div class="col-md-12">
              <input type="hidden" class="form-control" id="anchor_key_admin_ajax" />
              <button class="btn btn-success pull-right" onclick="updatingAnchor()">Update</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="yruxcontentEditor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Advanced Content Editor</h1>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <p>Write your content however you want</p>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                      <input type="hidden" id="yruxcontentEditorkey" />
                                        <textarea id="yruxcontentEditorta"></textarea>
                                    </div>
                                    <input onclick="updateContet($('#yruxcontentEditorkey').val(),CKEDITOR.instances['yruxcontentEditorta'].getData());" class="btn btn-lg btn-primary btn-block" value="Update Content" type="submit" id="normalEditor">
                  <input onclick="updatePageContent($('#yruxcontentEditorkey').val(),CKEDITOR.instances['yruxcontentEditorta'].getData(),this)" data-table="" data-col="" class="btn btn-lg btn-primary btn-block" value="Update Content" type="submit" id="tableEditor">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>

<style>
    .close {
    float: right !important;
    font-size: 1.5rem !important;
    font-weight: 700 !important;
    line-height: 1 !important;
    color: #000 !important;
    text-shadow: 0 1px 0 #fff !important;
    opacity: .5 !important;
}
.modal-header h1 {
    display: block;
    width: 100%;
    font-family: 'Luckiest Guy', cursive;
}
.panel-body p {
    font-family: 'Montserrat' , sans-serif;
    margin-bottom: 20px;
    border-bottom: 1px solid #d1d1d1;
    padding-bottom: 5px;
}
.close:focus,
.close:hover {
    color: #000;
    text-decoration: none;
    opacity: .75
}

.close:not(:disabled):not(.disabled) {
    cursor: pointer
}

button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none
}

.modal-open {
    overflow: hidden
}

.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    outline: 0;
}

.modal-open .modal {
    overflow-x: hidden !important;
    overflow-y: auto !important;
    opacity: 1 !important;
}

.modal-dialog {
    position: relative;
    width: auto;
    margin: .5rem;
    pointer-events: none
}

.modal.fade .modal-dialog {
    transition: -webkit-transform .3s ease-out;
    transition: transform .3s ease-out;
    transition: transform .3s ease-out, -webkit-transform .3s ease-out;
    -webkit-transform: translate(0, -25%);
    transform: translate(0, -25%)
}

.modal.show .modal-dialog {
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0)
}

.modal-dialog-centered {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    min-height: calc(100% - (.5rem * 2))
}

.modal-content {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0
}

.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000
}

.modal-backdrop.fade {
    opacity: 0
}

.modal-backdrop.show {
    opacity: .5
}

.modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem
}

.modal-header .close {
    padding: 1rem;
    margin: -1rem -1rem -1rem auto
}

.modal-title {
    margin-bottom: 0;
    line-height: 1.5
}

.modal-body {
    position: relative;
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1rem
}

.modal-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #e9ecef
}

.modal-footer>:not(:first-child) {
    margin-left: .25rem
}

.modal-footer>:not(:last-child) {
    margin-right: .25rem
}

.modal-scrollbar-measure {
    position: absolute;
    top: -9999px;
    width: 50px;
    height: 50px;
    overflow: scroll
}

.modal-header h4 {
    display: block;
    width: 100%;
    text-align: center;
    font-family: 'Luckiest Guy';
}

input#adminuploadAjax {
    width: 100%;
    display: block;
    margin: 10px 0;
    border: 1px solid #d1ecf1;
    border-radius: 5px;
    padding: 10px;
}
.control-label {
    margin-bottom : 10px ;
}




@media (min-width:576px) {
    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto
    }
    .modal-dialog-centered {
        min-height: calc(100% - (1.75rem * 2))
    }
    .modal-sm {
        max-width: 300px
    }
}

@media (min-width:992px) {
    .modal-lg {
        max-width: 800px
    }
}

.alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem
}

.alert-heading {
    color: inherit
}

.alert-link {
    font-weight: 700
}

.alert-dismissible {
    padding-right: 4rem
}

.alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: .75rem 1.25rem;
    color: inherit
}

.alert-primary {
    color: #004085;
    background-color: #cce5ff;
    border-color: #b8daff
}

.alert-primary hr {
    border-top-color: #9fcdff
}

.alert-primary .alert-link {
    color: #002752
}

.alert-secondary {
    color: #383d41;
    background-color: #e2e3e5;
    border-color: #d6d8db
}

.alert-secondary hr {
    border-top-color: #c8cbcf
}

.alert-secondary .alert-link {
    color: #202326
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb
}

.alert-success hr {
    border-top-color: #b1dfbb
}

.alert-success .alert-link {
    color: #0b2e13
}

.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb
}

.alert-info hr {
    border-top-color: #abdde5
}

.alert-info .alert-link {
    color: #062c33
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba
}

.alert-warning hr {
    border-top-color: #ffe8a1
}

.alert-warning .alert-link {
    color: #533f03
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb
}

.alert-danger hr {
    border-top-color: #f1b0b7
}

.alert-danger .alert-link {
    color: #491217
}

.alert-light {
    color: #818182;
    background-color: #fefefe;
    border-color: #fdfdfe
}

.alert-light hr {
    border-top-color: #ececf6
}

.alert-light .alert-link {
    color: #686868
}

.alert-dark {
    color: #1b1e21;
    background-color: #d6d8d9;
    border-color: #c6c8ca
}

.alert-dark hr {
    border-top-color: #b9bbbe
}

.alert-dark .alert-link {
    color: #040505
}

</style>