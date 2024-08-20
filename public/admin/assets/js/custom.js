$(function() {
            $('.custom-select2').each(function() {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });
        
            document.addEventListener('DOMContentLoaded', function () {
    const ckeditorInstances = document.querySelectorAll('.ckeditor');
    ckeditorInstances.forEach(function(textarea) {
        CKEDITOR.replace(textarea);
    });
});

$(".custom-select").each(function () {
    var $this = $(this),
        numberOfOptions = $this.children("option").length,
        originalId = $this.attr("id"),
        originalValue = $this.val(),
        originalClass = $this.attr("class");

    $this.addClass("select-hidden");

    // Create a new class for the main div
    var mainDivClass = "custom-select-wrapper"; // You can change this class name

    $this.wrap('<div class="select ' + mainDivClass + '"></div>'); // Add the new class to the parent div
    var $mainDiv = $this.parent(); // Get a reference to the main div

    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next("div.select-styled");
    $styledSelect.text($this.children("option").eq(0).text());

    var $list = $("<ul />", {
        class: "select-options",
    }).insertAfter($styledSelect);

    for (var i = 0; i < numberOfOptions; i++) {
        $("<li />", {
            text: $this.children("option").eq(i).text(),
            rel: $this.children("option").eq(i).val(),
        }).appendTo($list);
        if ($this.children("option").eq(i).is(":selected")) {
            $(
                'li[rel="' + $this.children("option").eq(i).val() + '"]'
            ).addClass("is-selected");
        }
    }

    var $listItems = $list.children("li");

    $styledSelect.click(function (e) {
        e.stopPropagation();
        $("div.select-styled.active")
            .not(this)
            .each(function () {
                $(this).removeClass("active").next("ul.select-options").hide();
            });
        $(this).toggleClass("active").next("ul.select-options").toggle();
    });

    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass("active");
        $this.val($(this).attr("rel"));
        $list.find("li.is-selected").removeClass("is-selected");
        $list
            .find('li[rel="' + $(this).attr("rel") + '"]')
            .addClass("is-selected");
        $list.hide();
        //console.log($this.val());
    });

    $(document).click(function () {
        $styledSelect.removeClass("active");
        $list.hide();
    });

    // Add the original ID and class to the custom select
    $this.parent().attr("id", originalId);
    if (originalValue != null) {
        $this.parent().find(".select-styled").text(originalValue);
    } else {
        $this.parent().find(".select-styled").text("Select");
    }
    $this.parent().addClass(originalClass);

    // Remove ID and class from the original select
    $this.removeAttr("id");
    $this.removeClass(originalClass);
});

$(document).ready(function () {
    $(".date-picker").datepicker();
    $("#user-table").DataTable();
    $(".user-table").DataTable();

    // function generateNotification(messageType, message, _url) {
    //     if (!_url) {
    //         _url = '';
    //     }
    //     var iconUse = '';
    //     if (messageType == 'danger') {
    //         iconUse = 'fa fa-exclamation-triangle';
    //     } else if (messageType == 'success' || messageType == 1) {
    //         iconUse = 'fa fa-check';
    //         messageType = 'success';
    //     } else if (messageType == 'info') {
    //         iconUse = 'fa fa-info-circle';
    //     } else if (messageType == 'error' || messageType == 0) {
    //         messageType = 'danger'
    //         iconUse = 'fa fa-exclamation-triangle';
    //     }
    //     $.notify({
    //         // options
    //         icon: iconUse,
    //         title: '',
    //         message: message,
    //         url: _url,
    //         target: '_blank'
    //     }, {
    //         // settings
    //         element: 'body',
    //         position: null,
    //         type: messageType,
    //         allow_dismiss: true,
    //         newest_on_top: false,
    //         showProgressbar: false,
    //         placement: {
    //             from: "bottom",
    //             align: "right"
    //         },
    //         offset: 20,
    //         spacing: 10,
    //         z_index: 1031,
    //         delay: 5000,
    //         timer: 1000,
    //         url_target: '_blank',
    //         mouse_over: null,
    //         animate: {
    //             enter: 'animated fadeInDown',
    //             exit: 'animated fadeOutUp'
    //         },
    //         onShow: null,
    //         onShown: null,
    //         onClose: null,
    //         onClosed: null,
    //         icon_type: 'class',
    //         template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
    //             '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
    //             '<span data-notify="icon"></span> ' +
    //             '<span data-notify="title">{1}</span> ' +
    //             '<span data-notify="message">{2}</span>' +
    //             '<div class="progress" data-notify="progressbar">' +
    //             '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
    //             '</div>' +
    //             '<a href="{3}" target="{4}" data-notify="url"></a>' +
    //             '</div>'
    //     });
    // }

    // MULTI-IMAGE UPLOAD
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    var file = e.target;
                    $(
                        '<span class="pip">' +
                            '<img class="imageThumb" src="' +
                            e.target.result +
                            '" title="' +
                            file.name +
                            '"/>' +
                            "<br/><span class=\"remove\"><img src='./images/delete-icon.svg'></span>" +
                            "</span>"
                    ).appendTo(".upload-img-container");
                };
                fileReader.readAsDataURL(f);
            }
        });
        $(".remove").click(function () {
            $(this).parent(".pip").remove();
        });
    } else {
        alert("Your browser doesn't support to File API");
    }
});

var Loader = (function () {
    return {
        show: function () {
            jQuery("#preloader").show();
        },

        hide: function () {
            jQuery("#preloader").hide();
        },
    };
})();

const computedStyle = getComputedStyle(document.documentElement);
const color_primary = computedStyle.getPropertyValue("--color-primary");

function makeColor(opacity, newColor) {
    // Making the primary color to light
    const hexToHsl = (hex) => {
        const r = parseInt(hex.slice(1, 3), 16) / 255;
        const g = parseInt(hex.slice(3, 5), 16) / 255;
        const b = parseInt(hex.slice(5, 7), 16) / 255;

        const max = Math.max(r, g, b);
        const min = Math.min(r, g, b);
        let h,
            s,
            l = (max + min) / 2;

        if (max === min) {
            h = s = 0;
        } else {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

            switch (max) {
                case r:
                    h = (g - b) / d + (g < b ? 6 : 0);
                    break;
                case g:
                    h = (b - r) / d + 2;
                    break;
                case b:
                    h = (r - g) / d + 4;
                    break;
            }

            h /= 6;
        }

        return [Math.round(h * 360), Math.round(s * 100), Math.round(l * 100)];
    };

    const hslToHex = (h, s, l) => {
        h /= 360;
        s /= 100;
        l /= 100;

        let r, g, b;

        if (s === 0) {
            r = g = b = l;
        } else {
            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1 / 6) return p + (q - p) * 6 * t;
                if (t < 1 / 2) return q;
                if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
                return p;
            };

            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1 / 3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1 / 3);
        }

        const toHex = (x) => {
            const hex = Math.round(x * 255).toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        };

        return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
    };

    const getComputedStyleValue = (element, property) =>
        window.getComputedStyle(element).getPropertyValue(property);

    const originalColor = getComputedStyleValue(
        document.documentElement,
        "--color-primary"
    );

    const lightnessValue = opacity;

    const hslValues = hexToHsl(originalColor);
    const lightenedColor = hslToHex(hslValues[0], hslValues[1], lightnessValue);

    document.documentElement.style.setProperty(newColor, lightenedColor);
}

makeColor(95, "--color-primary-light");

$(document).ready(function () {
    const labelElement = document.querySelector("#user-table_filter label");
    const inputElement = labelElement.firstChild;
    const searchElement = document.querySelector(
        "#user-table_filter label input"
    );
    labelElement.removeChild(labelElement.firstChild);
    searchElement.placeholder = "Search";
});

$(".custom-dropdown__active").click(function () {
    $(this).parent().toggleClass("open");
});

function openSideBar() {
    document.getElementById("sideBar").classList.add("show");
}

function closeSideBar() {
    document.getElementById("sideBar").classList.remove("show");
}

function readURL(input, targetId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#" + targetId).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function() {
    var selected_option = $('.is-selected').html().trim()
    if(selected_option){
        
    var selected_value = $('.select-styled').html(selected_option)
    }
 });