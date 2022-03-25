/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
(function ($) {
    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', text);
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    }
    $(document).on('click', '.button-primary.create-demo', function (e) {
        e.preventDefault();
        if ($('#swa-ie-id').val() === '') {
            $('#swa-ie-id').focus();
        } else {
            $('.swa-export-contents').submit();
        }
    });
    $(document).on('click', '.swa-import-btn.swa-import-submit', function (e) {
        e.preventDefault();
        var _form = $(this).parents('form.swa-ie-demo-item');
        if (confirm('Are you sure you want to install this demo data?')) {
            _form.find(".swa-loading").css('display', 'block');
            _form.submit();
        } else {
            return;
        }
    });
    $(document).on('click', '.swa-delete-demo', function (e) {
        e.preventDefault();
        var _this = $(this);
        var _validate = prompt("Type \"reset\" in the confirmation field to confirm the reset and then click the OK button");
        if (_validate === "reset") {
            if (confirm('Are you sure you want to reset site?')) {
                _this.parents('form.swa-ie-demo-item').find('input[name="action"]').val('swa-reset');
                _this.parents('form.swa-ie-demo-item').submit();
            } else {
                return;
            }
        } else {
            if (_validate !== null) {
                alert('Invalid confirmation. Please type \'reset\' in the confirmation field.');
            } else {
                return;
            }
        }
    });
    $(document).on('click', 'li.swa-advance-reset', function (e) {
        e.preventDefault();
        var _form = $(document).find('form.swa-reset-form-advance');
        var _validate = prompt("Type \"reset\" in the confirmation field to confirm the reset and then click the OK button");
        if (_validate === "reset") {
            if (confirm('Are you sure you want to reset site?')) {
                $.ajax({
                    url: swa_ie.ajax_url,
                    type: "POST",
                    beforeSend: function () {
                        $('body').addClass('loading');
                    },
                    data: {
                        action: 'swa_before_reset',
                    },
                }).done(function (res) {
                    _form.submit();
                }).fail(function (res) {
                    alert('Fail to reset. Please try again!');
                }).always(function () {

                });
            } else {
                return false;
            }
        } else {
            if (_validate !== null) {
                alert('Invalid confirmation. Please type \'reset\' in the confirmation field.');
            } else {
                return false;
            }
        }
    });
    $(document).on('click', 'li.swa-show-regenerate-thumbnail', function (e) {
        e.preventDefault();
        var _form = $(document).find('form.swa-regenerate-thumbnail-sm');
        if (confirm('Are you sure you want to Regenerate Thumbnail?')) {
            _form.submit();
        } else {
            return false;
        }
    });
    $(document).on('click', '.swa-show-manual-import', function (e) {
        e.preventDefault();
        $(document).find(".swa-manual-import-layout").css('display','block');
        setTimeout(function () {
            $(document).find(".tabs-contents.swa-mi-demo-list").addClass("active");
            $(document).find(".swa-manual-import-layout").removeClass("swa-m-hidden");
        },10);
    });
    $(document).on('click', '.swa-contain .dashicons.dashicons-dismiss', function (e) {
        e.preventDefault();
        $(document).find(".swa-manual-import-layout").addClass("swa-m-hidden");
        setTimeout(function () {
            $(document).find(".swa-manual-import-layout").css('display','none');
        },600);
    });

    $(document).on('click', '.swa-mi-select', function (e) {
        e.preventDefault();
        $(document).find(".swa-mi-image.swa-selected").removeClass("swa-selected");
        $(document).find(".tabs-contents.active").removeClass("active");
        $(document).find("#attachments").addClass("active");
        $(document).find(".tabs-demos[data-id=select-demo]").addClass("swa-mi-done");
        $(document).find(".tabs-demos[data-id=select-demo]").removeClass("swa-mi-active");
        $(document).find(".tabs-demos[data-id=attachments]").addClass("swa-mi-active");
        var _this = $(this),
            _img = _this.parents(".swa-mi-image");
        _img.addClass("swa-selected");
        $(".swa-mi-image-selected img").attr("src",_img.find("img").attr("src"));
        $("#swa-download-attachment-btn").attr("data-attachment",_this.attr("data-attachment"));
        $(".swa-mi-demo-title-selected").html(_img.find(".swa-mi-demo-title").html());
        $("input[name=swa-ie-id]").val(_this.attr("data-demo"));
        setTimeout(function () {
            $(document).find("#select-demo").css('display','none');
        },300);
    });
    $(document).on('click', '.tabs-demos.swa-mi-done', function (e) {
        e.preventDefault();
        var _this = $(this);
        $(document).find(".tabs-demos").removeClass("swa-mi-done");
        $(document).find(".tabs-demos").removeClass("swa-mi-active");
        var _data_id = _this.attr("data-id");
        switch (_data_id) {
            case "attachments":
                $(document).find(".tabs-demos").removeClass("swa-mi-done");
                $(document).find(".tabs-demos").removeClass("swa-mi-active");
                $(document).find(".tabs-contents.active").removeClass("active");
                $(document).find("#attachments").addClass("active");
                $(document).find(".tabs-demos[data-id=select-demo]").addClass("swa-mi-done");
                $(document).find(".tabs-demos[data-id=select-demo]").removeClass("swa-mi-active");
                $(document).find(".tabs-demos[data-id=attachments]").addClass("swa-mi-active");
                break;
            case "select-demo":
                $(document).find("#select-demo").css('display','block');
                $(document).find(".tabs-demos").removeClass("swa-mi-done");
                $(document).find(".tabs-demos").removeClass("swa-mi-active");
                setTimeout(function () {
                    $(document).find(".tabs-contents.active").removeClass("active");
                    $(document).find("#select-demo").addClass("active");
                    $(document).find(".tabs-demos[data-id=attachments]").removeClass("swa-mi-active");
                    $(document).find(".tabs-demos[data-id=select-demo]").addClass("swa-mi-active");
                },10);
                break;
            default:
                break;
        }
    });
    $(document).on('click','#swa-download-attachment-btn',function (e) {
        e.preventDefault();
        var _this = $(this);
        download("swa-attachments.zip",_this.attr("data-attachment"));
    });
    $(document).on('change','#swa-accept-unzip-done',function (e) {
        e.preventDefault();
        var _checked = $("input#swa-accept-unzip-done:checked").length;
        if(_checked === 1){
            $(document).find(".swa-mi-dl-step.step-4 button").addClass("active");
        }else{
            $(document).find(".swa-mi-dl-step.step-4 button").removeClass("active");
        }
    });
    $(document).on('click','.swa-mi-dl-step.step-4 button.active',function (e) {
        e.preventDefault();
        var _this = $(this);
        var _checked = $("input#swa-accept-unzip-done:checked").length;
        if(_checked === 1){
            if (confirm('Are you sure you want to install this demo data?')) {
                _this.next().submit();
            } else {
                return false;
            }
        }else{
            alert("Please accept \"I uploaded and unzipped file\"");
        }
    });
})(jQuery);
