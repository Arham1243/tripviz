function generateNotification(messageType, message, _url) {
    if (!_url) {
        _url = '';
    }
    var iconUse = '';
    if (messageType == 'danger') {
        iconUse = 'fa fa-exclamation-triangle';
    } else if (messageType == 'success' || messageType == 1) {
        iconUse = 'fa fa-check';
        messageType = 'success';
    } else if (messageType == 'info') {
        iconUse = 'fa fa-info-circle';
    } else if (messageType == 'error' || messageType == 0) {
        messageType = 'danger'
        iconUse = 'fa fa-exclamation-triangle';
    }
    $.notify({
        // options
        icon: iconUse,
        title: '',
        message: message,
        url: _url,
        target: '_blank'
    }, {
        // settings
        element: 'body',
        position: null,
        type: messageType,
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "bottom",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
    });
}

function updateCustomFieldOne(updateCol, key, table, updateAgainst, updateValue) {
    var keyArray = [];
    keyArray.push(updateCol);
    keyArray.push(key);
    keyArray.push(table);
    keyArray.push(updateAgainst);
    keyArray.push(updateValue);
    var path = $('#web_base_url').val() + '/admin/statusAjaxUpdateCustom';
    childFormSubmitAsync(keyArray, 'POST', path, fireNotify, '');
}
$(document).ready(function() {

    /*MULTIPLE CONTENT START*/
    $('.contentEditBtn').click(function() {
        var key = $(this).data("update-key");
        var counter = $(this).data("counter");
        var keyArray = [];
        keyArray.push('flag_value');
        keyArray.push(key);
        keyArray.push('m_flag');
        keyArray.push('flag_type');
        if ($(this).html() == 'Add') {
            keyArray.push(counter + 1);
        }
        if ($(this).html() == 'Less') {
            keyArray.push(counter - 1);
        }
        var path = $('#web_base_url').val() + '/admin/statusAjaxUpdateCustom';
        childFormSubmitAsync(keyArray, 'POST', path, fireNotify, '');
    });
    /*MULTIPLE CONTENT END*/
    /*IMAGE UPDATE START*/
    $('img').bind("contextmenu", function(event) {
        $('.custom-menu').remove();
        event.preventDefault();
        if ($(this).data('key')) {} else {
            return false;
        }
        $('#img_href_admin').show();
        $('#img_css_admin').html('');
        if ($(this).data('table')) {
            $('#img_href_admin').hide();
        }
        $('#imagehref').val('');
        var appender = '';
        if ($(this).data('imgid')) {
            //updateCustomFieldOne(updateCol,key,table,updateAgainst,updateValue)
            if (!$(this).data('table')) {
                // appender += "<li><a onclick='updateCustomFieldOne(\"is_active_img\"," + $(this).data('imgid') + ",\"imagetable\",\"id\",0)' href='javascript:void(0)'>Hide Image</a></li>";
                // appender += "<li><a onclick='updateCustomFieldOne(\"is_active_img\"," + $(this).data('imgid') + ",\"imagetable\",\"id\",1)' href='javascript:void(0)'>Show Image</a></li>";
            }
        }
        if ($(this).data('table')) {
            appender += "<li><a onclick='uploadImageInlineTable(this);' data-key='" + $(this).data('key') + "' data-width='" + $(this).data('width') + "' data-height='" + $(this).data('height') + "' data-refid='" + $(this).data('ref_id') + "' data-table='" + $(this).data('table') + "' href='javascript:void(0)'>Update Image</a></li>";
        } else {
            appender += "<li><a onclick='uploadImageInline(this);' data-key='" + $(this).data('key') + "' data-width='" + $(this).data('width') + "' data-height='" + $(this).data('height') + "' href='javascript:void(0)'>Update Image</a></li>";
        }
        $("<ul class='custom-menu list-unstyled'>" + appender + "</ul>")
            .appendTo("body")
            .css({ top: event.pageY + "px", left: event.pageX + "px" });
    }).bind("click", function(event) {
        $(".custom-menu").remove();
    });
    $('html').click(function() {
        $(".custom-menu").remove();
    });
    /*IMAGE UPDATE END*/
    /*Anchor Update*/
    $('a[data-anchorupdate="true"]').bind("contextmenu", function(event) {
        $('.custom-menu').remove();
        event.preventDefault();
        if ($(this).data('update')) {} else {
            return false;
        }
        let _key = $(this).data('update');
        var appender = '';
        appender += '<li><a onclick="updateAnchor(\'' + _key + '\')" href="javascript:void(0)">Link Manager</a></li>';
        $('<ul class="custom-menu list-unstyled">' + appender + '</ul>').appendTo("body")
            .css({ top: event.pageY + "px", left: event.pageX + "px" });
    }).bind("click", function(event) {
        $(".custom-menu").remove();
    });
    /*Anchor Update End*/
    /*CONTENT UPDATE START*/
    $('body').on('focus', '[contenteditable]', function() {
        var $this = $(this);
        //console.log($this.html());
        if ($(this).attr('data-ckeditor') == 'true') {
            $('#yruxcontentEditorkey').val($this.data('update'));
            $('#yruxcontentEditor').modal('toggle');
            CKEDITOR.instances['yruxcontentEditorta'].setData($this.html())
            $('#normalEditor').show();
            $('#tableEditor').hide();
            if ($this.data('table')) {
                $('#normalEditor').hide();
                $('#tableEditor').attr('data-table', $this.data('table'));
                $('#tableEditor').attr('data-col', $this.data('col'));
                $('#tableEditor').show();
            }
        }
        $(this).attr('data-before', $this.html());
        return $this;
    }).on('blur paste', '[contenteditable]', function() {
        var $this = $(this);
        if ($this.data('before') !== $this.html()) {
            $this.data('before', $this.html());
            var key = $this.data('update');
            if ($this.html() == "") {
                $this.html($this.attr('data-before'));
                $this.attr('data-before', $this.attr('data-before'));
                generateNotification('error', 'Can not set data to empty');
                return false;
            }
            if ($this.data('table')) {
                childFormSubmitAsync([$this.data('col'), key, $this.data('table'), 'id', $this.html()], 'POST', $('#web_base_url').val() + '/admin/statusAjaxUpdateCustom', (a, b) => {
                    generateNotification('success', 'Content Updated');
                }, '');
            } else {
                updateContet(key, $this.html());
            }
            // var url = $('#base_url').val()+'/adminiy/updateFlagOnKey';
            //var url = '{{url('/adminiy/updateFlagOnKey')}}';
            // childFormSubmitAsync(keyArray,'POST',url,contentEditAft,$this);
        }
        return $this;
    });
    $('body').on('dblclick', '[contentbackground]', function() {
        var $this = $(this);
        //console.log($this.data());
        $('#adminuploadImage').modal('toggle');
        $('#img_href_admin').hide();
        $('#imagehref').val('');
        $('#img_css_admin').html('');
        // $('#adminuploadAjaxInput').val($this.data('key')+'|'+$this.data('width')+'|'+$this.data('height'));
        // console.log(($this.data('key')));
        $('#adminuploadAjaxInput').val($this.data('key'));
        $('#msgIndicator').html('<div class="alert alert-info"><strong>Info!</strong> Default Height of image you are uploading is <b>' + $this.data('height') + '</b> and width is <b>' + $this.data('width') + '</b>. However you can change them from the inputs we provided below</div>');
        // console.log($this.data('width'));
        $('#imageinlinewidth').val($this.data('width'));
        $('#imageinlineheight').val($this.data('height'));
    });
    //CKEDITOR.replace('yruxcontentEditorta');
    // CKEDITOR.replace('yruxcontentEditorta', {
    //     contentsCss : $('#mystylesheet').val()
    // });
    CKEDITOR.replace('yruxcontentEditorta', {
        filebrowserBrowseUrl: $('#roxyFile').val(),
        filebrowserImageBrowseUrl: $('#roxyFile').val() + '?type=image',
        contentsCss: $('#mystylesheet').val(),
        removeDialogTabs: 'link:upload;image:upload'
    });
    CKEDITOR.config.contentsCss = $('#mystylesheet').val();
    $.fn.modal.Constructor.prototype.enforceFocus = function() {
        modal_this = this
        $(document).on('focusin.modal', function(e) {
            if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length &&
                !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') &&
                !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                modal_this.$element.focus()
            }
        })
    };

    /*Image Upload On Change*/
    $('#adminuploadAjax').change(function() {
        var _URL = window.URL || window.webkitURL;
        var image, file;
        if ((file = this.files[0])) {
            image = new Image();
            image.onload = function() {
                console.log(this.width);
                console.log(this.height);
                var imgwidth = this.width;
                var imgheight = this.height;
              //  console.log(imgwidth + ' '+ imgheight);
               $('#imageinlinewidth').val(imgwidth);
               $('#imageinlineheight').val(imgheight);
            };
            image.src = _URL.createObjectURL(file);
           // console.log(image.src);
        }
    });
    /*CONTENT UPDATE END*/

});
/*STATUS UPDATING*/
function fireNotify(data, obj) {
    generateNotification('success', 'Content Added');
    ReloadPage();
}

function updateStatusIfActive(id, updatedId, updatedAgainst, curStatus, table) {
    var keyArray = [];
    keyArray.push(id);
    keyArray.push(updateId);
    keyArray.push(table);
    keyArray.push(updatedAgainst);
    keyArray.push(curStatus);
    var path = $('#web_base_url').val() + '/admin/statusAjaxUpdate';
    childFormSubmitAsync(keyArray, 'POST', path, statusUpdateAft, obj)
}

function statusUpdateAft(data, obj) {
    generateNotification('success', 'Status Updated');
}
/*END STATUS UPDATING*/
function contentEditAft(data, obj) {
    if (data == 'success') {
        generateNotification('success', 'Content Edited');
        $("[data-update='" + obj[0] + "']").html(obj[1]);
    }
}

function ajaxifyWojson(d, m, u) {
    if (typeof d != 'string') {
        d = $.param(d);
    }
    return new Promise(function(resolve, reject) {
        var xhhtp = new XMLHttpRequest();
        xhhtp.onreadystatechange = function() {
            if (this.status == 200 && this.readyState == 4) {
                resolve(xhhtp.responseText);
            } else if (this.status == 404) {
                reject(Error('Error occured'));
            }
        };
        xhhtp.onload = function() {

        };
        xhhtp.open(m, u, true);
        xhhtp.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        try {
            xhhtp.send(d)
        } catch (ex) {
            reject(Error('Error occured'));
        }
    });
}
async function updateContet(key, value) {
    var keyArray = [];
    //console.log(key);
    keyArray.push(key);
    keyArray.push(value.trim());
    var url = $('#web_base_url').val() + '/admin/updateFlagOnKey';
    await ajaxifyWojson({ ArrayofArrays: keyArray }, 'POST', url);
    generateNotification('success', 'Content Edited');
    $("[data-update='" + key[0] + "']").html(key);
    $('#yruxcontentEditor').modal('hide');
    // ReloadPage();
    //childFormSubmitAsync(keyArray,'POST',url,contentEditAft,keyArray);
}

function uploadImageInlineTable(obj) {
    $('#adminuploadImage').modal('toggle');
    $('#normal_admin_ajax_image_upload').show();
    $('#adminuploadAjaxInput').val($(obj).data('key') + '|' + $(obj).data('table') + '|' + $(obj).data('refid'));
    $('#msgIndicator').html('<div class="alert alert-info"><strong>Info!</strong> Default Height of image you are uploading is <b>' + $(obj).data('height') + '</b> and width is <b>' + $(obj).data('width') + '</b>. However you can change them from the inputs we provided below</div>');
    $('#imageinlinewidth').val($(obj).data('width'));
    $('#imageinlineheight').val($(obj).data('height'));
}

function uploadImageInline(obj) {
    var $this = $(this);
    console.log($(obj).data('key'));
    $('#adminuploadImage').modal('toggle');
    $('#normal_admin_ajax_image_upload').show();
    //$('#adminuploadAjaxInput').val($(obj).data('key')+'|'+$(obj).data('width')+'|'+$(obj).data('height'));
    $('#adminuploadAjaxInput').val($(obj).data('key'));
    $('#msgIndicator').html('<div class="alert alert-info"><strong>Info!</strong> Default Height of image you are uploading is <b>' + $(obj).data('height') + '</b> and width is <b>' + $(obj).data('width') + '</b>. However you can change them from the inputs we provided below</div>');
    $('#imageinlinewidth').val($(obj).data('width'));
    $('#imageinlineheight').val($(obj).data('height'));
}

function UploadFile(id, obj) {
    console.log(obj);
    //return 0;
    var path = $('#web_base_url').val() + '/admin/imageUpload';
    //console.log(path);
    data = new FormData();
    data.append('file', $('#' + id)[0].files[0]);
    data.append('id', obj);
    data.append('href', $('#imagehref').val());
   
    $.ajax({
        type: 'POST',
        data: data,
        async: true,
        contentType: false,
        processData: false,
        url: path,
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        
        success: function(result) {
            //return 0;
            generateNotification('success', 'Image Uploaded Successfully');
            ReloadPage();
            //$('.changeImage').attr('src',$('#autoLink').val()+result);
        },
        error: function(error) {
            generateNotification('error', 'Could not upload please try again');
        }
    });
}
const updateAnchor = (_flgid) => {
    $('#anchorModal').modal('show');
    let anc = $('a[data-update="' + _flgid + '"]');
    document.getElementById('anchor_key_admin_ajax').value = _flgid;
    document.getElementById('anchor_link_admin_ajax').value = $(anc).attr('href') ? $(anc).attr('href') : '#';
    document.getElementById('anchor_name_admin_ajax').value = $(anc).text();
}
const updatingAnchor = () => {
    let key = document.getElementById('anchor_key_admin_ajax').value;
    let link = document.getElementById('anchor_link_admin_ajax').value;
    let name = document.getElementById('anchor_name_admin_ajax').value;
    var keyArray = [];
    keyArray.push(key);
    keyArray.push([name, link]);
    var url = $('#web_base_url').val() + '/admin/updateFlagOnKey';
    childFormSubmitAsync(keyArray, 'POST', url, (a, b) => {
        if (a == 'success') {
            ReloadPage();
        } else {
            generateNotification('error', 'Some Error occured');
        }
    }, keyArray);
}
const updatePageContent = (_key, _data, obj) => {
    console.log(_key, _data, obj);
    childFormSubmitAsync([$(obj).data('col'), _key, $(obj).data('table'), 'id', _data], 'POST', $('#web_base_url').val() + '/admin/statusAjaxUpdateCustom', (a, b) => {
        $("div[data-update='" + _key + "']").html(_data);
        generateNotification('success', 'Content Updated');
    }, [_key, _data, obj]);
}