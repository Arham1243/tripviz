//dropdown-start//

(function($) {
    jQuery.fn.customDropdown = function(options) {
        var options = $.extend({
            template: null,
            data: null,
            multiple: false,
            //placeholder: "Please select ... "
        }, options);

        jQuery.fn.extend({ // add methods
            uncheck: function() { // uncheck all checked input in list 
                var list = $(this).find('.js-cdp__list ul');
                var button = $(this).find('.js-cdp__open');
                if (options.multiple) {
                    list.find('li').each(function() {
                        $(this).attr('aria-checked', false).find('input').prop('checked', false);
                    });
                    button.attr('data-val', "").text(button.attr('data-place'));
                } else {
                    button.attr('data-val', "").text(button.attr('data-place'));
                }

                return $(this);
            }
        });

        var make = function() {
            // custom drop down skeleton

            var big_list = "";
            var dropdown_template = '<div class="js-cdp__list cdp__list" style="display:none;"><ul></ul></div>';
            $(this).append(dropdown_template);

            var cdp = $(this);
            var button = $(this).find('.js-cdp__open');
            var list = $(this).find('.js-cdp__list ul');
            var submenu = "";

            var placeholder = button.attr('data-place');
            var aria_label = button.attr('aria-label');

            // build drop down list
            var list_items = "";
            if (options.data == null) { // if no  data then  create demo info
                list_items = '<li>Test option 1</li><li>Test option 2</li>';
            } else { // else
                if (!options.multiple) { // if you can choise just one element
                    for (var i = 0; i < options.data.length; i++) {
                        // default template for simple selection
                        list += '<li data-val="' + options.data[i].value + '">' + options.data[i].text + '</li>';
                    }
                } else { // if its multiple option
                    var list_items = "";
                    for (var i = 0; i < options.data.length; i++) {
                        // default template for multiple select
                        (options.data[i].dataClass !== "") && (options.data[i].dataClass !== undefined) ? list.parent().addClass('biger'): "";
                        if (!(options.data[i].dataClass == undefined || options.data[i].dataClass == "")) {

                            if (i > 0 && options.data[i - 1].dataClass !== options.data[i].dataClass) {
                                list_items += '<li class="js-has_submenu" data-class="' + options.data[i].dataClass + '" data-val="' + options.data[i].value + '" role="checkbox" aria-checked="false" > ' +
                                    '<input tabindex="-1" aria-hidden="true" type="checkbox" name="' + options.data[i].text + '" value="' + options.data[i].value + '">' +
                                    '<label for="">' + options.data[i].text + '</label>' +
                                    '</li>';
                            } else {
                                list_items += '<li class="submenu" data-class="' + options.data[i].dataClass + '" data-val="' + options.data[i].value + '" role="checkbox" aria-checked="false" > ' +
                                    '<input tabindex="-1" aria-hidden="true" type="checkbox" name="' + options.data[i].text + '" value="' + options.data[i].value + '">' +
                                    '<label for="">' + options.data[i].text + '</label>' +
                                    '</li>';
                            }
                        } else {
                            options.data[i].dataClass !== undefined ? submenu = "js-has_submenu" : submenu = "";
                            list_items += '<li class="' + submenu + '" data-class="' + options.data[i].dataClass + '" data-val="' + options.data[i].value + '" role="checkbox" aria-checked="false" > ' +
                                '<input tabindex="-1" aria-hidden="true" type="checkbox" name="' + options.data[i].text + '" value="' + options.data[i].value + '">' +
                                '<label for="">' + options.data[i].text + '</label>' +
                                '</li>';
                        }
                    }
                }
                list.append(list_items);
            }

            // add tabindex attribute to keycontroll
            cdp.find('li').attr('tabindex', 0);

            // show hide dropdown list
            button.click(function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('open');
                button.attr('aria-expanded') == 'true' ? $(this).attr('aria-expanded', false) : $(this).attr('aria-expanded', true);
            });

            // click on item in  dropdown list
            cdp.find('li:not(.js-has_submenu)').click(function() {
                var index = $(this).index();
                if (!options.multiple) {
                    button.text(options.data[index].text).attr('data-val', options.data[index].value);
                    button.attr('aria-label', aria_label + ' ' + options.data[index].value);
                    cdp.removeClass('open').find('.js-cdp__open').focus();
                } else { // multiple select
                    // selsect or deselect input
                    $(this).find('input').prop('checked') ? $(this).attr('aria-checked', false) : $(this).attr('aria-checked', true);
                    $(this).find('input').prop('checked') ? $(this).find('input').prop('checked', false) : $(this).find('input').prop('checked', true);


                    var multiple_text = ""; // text that is visible in button
                    var multiple_value = []; // array for selected values
                    var checkbox_list = cdp.find('input'); // array with all inputs in dropdown list
                    function checkEvery(item) {
                        for (var i = 0; i < item.length; i++) {
                            if ($(item[i]).prop('checked') == false && !($(item[i]).parents('li').hasClass('js-has_submenu'))) {
                                return false;
                            }
                        }
                        return true;
                    }
                    if (checkEvery(checkbox_list)) {
                        cdp.find('li.js-has_submenu').click();
                    } else {
                        cdp.find('li.js-has_submenu').attr('aria-checked', false);
                        cdp.find('li.js-has_submenu input').prop('checked', false);
                    }
                    var count = 0; // count for unselected inputs
                    for (var i = 0; i < checkbox_list.length; i++) {
                        // if input is selected then save his value & text
                        $(checkbox_list[i]).prop('checked') ? multiple_text = '<span>' + checkbox_list[i].name + '</span>' + multiple_text : count++;
                        $(checkbox_list[i]).prop('checked') ? multiple_value.push($(checkbox_list[i]).val()) : "";
                    }
                    // if there is no input selected then show placeholder text
                    count == checkbox_list.length ? button.html(placeholder).attr('data-val', "") : button.html(multiple_text).attr('data-val', multiple_value);
                    count == checkbox_list.length ? button.attr('aria-label', aria_label) : button.attr('aria-label', aria_label + ' ' + multiple_value);

                }
            });

            cdp.hover(function() {
                // cdp.removeClass('open');
            }, function() {
                cdp.removeClass('open');
            });

            cdp.find('.js-has_submenu').on('click', function() { // if check all button vas clicked

                var checkAll = $(this);
                $(this).find('input').prop('checked') ? $(this).attr('aria-checked', false) : $(this).attr('aria-checked', true);
                $(this).find('input').prop('checked') ? $(this).find('input').prop('checked', false) : $(this).find('input').prop('checked', true);


                var multiple_text = ""; // text that is visible in button
                var multiple_value = []; // array for selected values

                if (checkAll.attr('data-class') == "") {
                    var checkbox_list = cdp.find('input'); // array with all inputs in dropdown list
                } else {
                    var dataClass = checkAll.attr('data-class');
                    var checkbox_list = cdp.find('li[data-class=' + dataClass + '] input'); // array with all inputs in dropdown list

                }

                for (var i = 0; i < checkbox_list.length; i++) {
                    // if input is selected then save his value & text
                    if ($(checkbox_list[i]).parents('li').index() !== checkAll.index()) {
                        if (checkAll.find('input').prop('checked')) {
                            $(checkbox_list[i]).prop('checked', true);
                            $(checkbox_list[i]).parents('li').attr('aria-checked', true);
                            $(checkbox_list[i]).prop('checked') ? multiple_text = '<span>' + checkbox_list[i].name + '</span>' + multiple_text : "";
                            $(checkbox_list[i]).prop('checked') ? multiple_value.push($(checkbox_list[i]).val()) : "";
                            button.html(multiple_text).attr('data-val', multiple_value).html(checkAll.find('input').attr('name'));
                        } else {
                            $(checkbox_list[i]).prop('checked', false);
                            $(checkbox_list[i]).parents('li').attr('aria-checked', false);
                            button.html(placeholder).attr('data-val', ""); // if there is no input selected then show placeholder text
                        }
                    }

                }

            });

            // accessibility ********************************************************************************
            $(this).keydown(function(e) {
                var focused = $(this).find('li:focus'); // find active element in list
                var keyCode = e.keyCode;

                if (keyCode == 40) { // down arrow is pressed
                    e.preventDefault();
                    $(this).addClass('open'); // if dropdown  is closed then open it
                    if (focused.length == 0 | focused.index() == options.data.length - 1) { // if no active element in list or focus is on last item then
                        $(this).find('li').eq(0).focus(); //f ocus on  first element in  list
                    } else {
                        focused.next().focus(); // else focus on next element
                    }
                }

                if (keyCode == 38) { // ENTER
                    e.preventDefault();
                    $(this).addClass('open'); // if dropdown is closed then open it
                    if (focused.length == 0 | focused.index() == 0) { // if no active element in list or focus is on last item then
                        $(this).find('li').eq(options.data.length - 1).focus(); //f ocus on  last element in  list
                    } else {
                        focused.prev().focus(); // else focus on next element
                    }
                }



                if (keyCode == 32) { // SPASE
                    e.preventDefault();
                    if (!options.multiple) {
                        var index = focused.index();
                        if (focused.length !== 0) {
                            button.text(options.data[index].text).attr('data-val', options.data[index].value);
                            button.attr('aria-label', aria_label + ' ' + options.data[index].value);
                            button.focus();
                        }
                    } else {
                        // selsect or deselect input
                        if (focused.hasClass('js-has_submenu')) {
                            focused.click();
                        } else {
                            focused.find('input').prop('checked') ? focused.find('input').prop('checked', false) : focused.find('input').prop('checked', true);

                            var multiple_text = ""; // text that is visible in button
                            var multiple_value = []; // array for selected values
                            var checkbox_list = cdp.find('input'); // array with all inputs in dropdown list
                            var count = 0; // count for unselected inputs
                            for (var i = 0; i < checkbox_list.length; i++) {
                                // if input is selected then save his value & text
                                $(checkbox_list[i]).prop('checked') ? multiple_text += '<span>' + checkbox_list[i].name + '</span>' : count++;
                                $(checkbox_list[i]).prop('checked') ? multiple_value.push($(checkbox_list[i]).val()) : "";
                            }
                            // if there is no input selected then show placeholder text
                            count == checkbox_list.length ? button.html(placeholder).attr('data-val', "") : button.html(multiple_text).attr('data-val', multiple_value);
                            count == checkbox_list.length ? button.attr('aria-label', aria_label) : button.attr('aria-label', aria_label + ' ' + multiple_value);
                        }
                    }
                }

                if (keyCode == 27 || keyCode == 9) { // ESC or Tab
                    $(this).removeClass('open');
                    button.attr('aria-expanded', false);
                    button.focus();
                }
            });
        };

        return this.each(make);
    };
})(jQuery);


//custom template
/*
    text
    valur
    type
    multiple
*/
var data = [{
        value: "To Do ",
        text: "To Do ",
        dataClass: "someClass"
    },
    {
        value: "To Know",
        text: "To Know",
        dataClass: "someClass"
    },
    {
        value: "To Be",
        text: "To Be",
        dataClass: "someClass"
    },
]
$(document).ready(function() {
    $('.js-custom_select').customDropdown({
        multiple: true,
        data: data
    });
});

//dropdown-end//


$(".view a").on('click', function() {
    $('.products ul').toggleClass('list');
    return false;
});


$(".enter-icon").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $(".enter-input");
    if (input.attr("type") === "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


$('.home-slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})





// owl-slider//////
// $('.custom1').owlCarousel({
//     // animateOut: 'slideOutDown',
//     animateIn: 'flipInX',
//     items: 1,
//     loop: true,
//     autoplay: true,
//     margin: 30,
//     stagePadding: 30,
//     smartSpeed: 450
// });
// owl-slider//////


$(document).ready(function() {

    setTimeout(function() {
        $('.preloader').fadeOut(100);
    }, 1000);

});
// wow animation//////
// new WOW().init();
// wow animation//////

$("input[type=number]").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl/cmd+A
        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: Ctrl/cmd+C
        (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: Ctrl/cmd+X
        (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});


//
//function setNextButton(event) {
//	event.preventDefault();
//	const ids = ["csfb-span", "cnfb-span", "cpb-span"]
//	const {id} = event.target;
//	if(!id) return;
//	let buttons = document.querySelectorAll(".ntBtn");
//	buttons.forEach(item => {
//		if(id.includes(item.id)) {
//			item.classList.remove("d-none");
//			document.getElementById(`${item.id}-checkmark`).checked = true;
//		}
//		else {
//			item.classList.add("d-none");			
//		}
//	})
//}
// 

/*custom accordian show hide start here*/

//const handleIcon = (icon, classToRemove, classToAdd) => {
//			icon.classList.remove(classToRemove);
//			icon.classList.add(classToAdd);								
//}
//
//const handleHint = (hint, classToRemove, classToAdd) => {
//			classToRemove.length ? hint.classList.remove(classToRemove) : null;
//			classToAdd.length ? hint.classList.add(classToAdd) : null;								
//}
//
//const registerDivClick = (divId, iconId, hintId) => {
//	let div = document.getElementById(divId);
//	div.onclick= function () {
//		let icon = document.getElementById(iconId);
//		let hint = document.getElementById(hintId);
//		setTimeout(() => {
//			if(div.classList.value.includes("collapsed"))
//			{
//			handleIcon(icon, 'fa-angle-down', 'fa-angle-right');
//			handleHint(hint, '', 'd-none');
//		}
//			else
//		{
//			handleIcon(icon, 'fa-angle-right','fa-angle-down')		
//			handleHint(hint, 'd-none', '')			
//		}
//	}, 100)	
//}
//}
//
//try {
//	registerDivClick("friendly-bet-accordian-div", "icon-friendly-bet", "hint-friendly-bet");
//	registerDivClick("pool-bet-accordian-div", "icon-pool-bet", "hint-pool-bet");
//}
//catch(e) {
//	console.log(e)
//}



/*custom accordian end hide start here*/



/*scroll bar start here*/

//(function($){
//			$(window).on("load",function(){
//				
//				$(".scroll-bar").mCustomScrollbar();
//				
//				$(".disable-destroy a").click(function(e){
//					e.preventDefault();
//					var $this=$(this),
//						rel=$this.attr("rel"),
//						el=$(".scroll-bar"),
//						output=$("#info > p code");
//					switch(rel){
//						case "toggle-disable":
//						case "toggle-disable-no-reset":
//							if(el.hasClass("mCS_disabled")){
//								el.mCustomScrollbar("update");
//								output.text("$(\".scroll-bar\").mCustomScrollbar(\"update\");");
//							}else{
//								var reset=rel==="toggle-disable-no-reset" ? false : true;
//								el.mCustomScrollbar("disable",reset);
//								if(reset){
//									output.text("$(\".scroll-bar\").mCustomScrollbar(\"disable\",true);");
//								}else{
//									output.text("$(\".content\").mCustomScrollbar(\"disable\");");
//								}
//							}
//							break;
//						case "toggle-destroy":
//							if(el.hasClass("mCS_destroyed")){
//								el.mCustomScrollbar();
//								output.text("$(\".scroll-bar\").mCustomScrollbar();");
//							}else{
//								el.mCustomScrollbar("destroy");
//								output.text("$(\".scroll-bar\").mCustomScrollbar(\"destroy\");");
//							}
//							break;
//					}
//				});
//				
//			});
//		})(jQuery);



/*scroll bar end here*/


/*time picker start her*/
//
// $('#timepicker-1').timepicker({
//   uiLibrary: 'bootstrap4'
// });
// 
/*time picker end her*/
/*date picker start here*/

//
// 

$('#datepicker-2').datepicker({
    uiLibrary: 'bootstrap4'
});
$('#datepicker-3').datepicker({
    uiLibrary: 'bootstrap4'
});

/*
 





 
$('#datepicker-13').datepicker({
            uiLibrary: 'bootstrap4'
});

 $('#datepicker-14').datepicker({
            uiLibrary: 'bootstrap4'
});

 $('#datepicker-15').datepicker({
            uiLibrary: 'bootstrap4'
});

 $('#datepicker-16').datepicker({
            uiLibrary: 'bootstrap4'
});

 $('#datepicker-17').datepicker({
            uiLibrary: 'bootstrap4'
}); 
$('#datepicker-18').datepicker({
            uiLibrary: 'bootstrap4'
});

 $('#datepicker-19').datepicker({
            uiLibrary: 'bootstrap4'
});*/
/*date picker end here*/

/*modal click change start here*/

//$(function(){
//	
//    $('#submit-report').on('click', function(){
//        $('.friendly-bet-report-modal').modal('hide');
//        $('.submit-report-modal-thank').modal('show');
//    }); 
//
//}); 


/*modal click change end here*/


/*ck editor start here*/

// try{

//     CKEDITOR.replace( 'editorr', {
//         customConfig: '/ckeditor_settings/config.js',
//     });
// 	CKEDITOR.editorConfig = function( config )
//     {
//         config.height = '100px';
//     };

// }
// catch(e){
//     console.log(e);
// }


/*ck editor end here*/

/*slider start here*/

// 	jQuery( '#home' ).owlCarousel( {
// 	loop: true,
// 	margin: 0,
// 	autoplay: true,
// 	autoplayTimeout: 3000,
// 	autoplayHoverPause: true,
// 	responsiveClass: true,
// 	responsive: {
// 		0: {
// 			items: 1,
// 			nav: true
// 		},
// 		600: {
// 			items: 1,
// 			nav: false
// 		},
// 		1000: {
// 			items: 1,
// 			nav: false,

// 		}
// 	}
// } );
/*slider end here*/


/*nav start here*/


!(function(n, i, e, a) {
    (n.navigation = function(t, s) {
        var o = {
                responsive: !0,
                mobileBreakpoint: 991,
                showDuration: 200,
                hideDuration: 200,
                showDelayDuration: 0,
                hideDelayDuration: 0,
                submenuTrigger: "hover",
                effect: "fade",
                submenuIndicator: !0,
                submenuIndicatorTrigger: !1,
                hideSubWhenGoOut: !0,
                visibleSubmenusOnMobile: !1,
                fixed: !1,
                overlay: !0,
                overlayColor: "rgba(0, 0, 0, 0.5)",
                hidden: !1,
                hiddenOnMobile: !1,
                offCanvasSide: "left",
                offCanvasCloseButton: !0,
                animationOnShow: "",
                animationOnHide: "",
                onInit: function() {},
                onLandscape: function() {},
                onPortrait: function() {},
                onShowOffCanvas: function() {},
                onHideOffCanvas: function() {}
            },
            r = this,
            u = Number.MAX_VALUE,
            d = 1,
            l = "click.nav touchstart.nav",
            f = "mouseenter focusin",
            c = "mouseleave focusout";
        r.settings = {};
        var t = (n(t), t);
        n(t).find(".nav-search").length > 0 &&
            n(t)
            .find(".nav-search")
            .find("form")
            .prepend(
                "<span class='nav-search-close-button' tabindex='0'>&#10005;</span>"
            ),
            (r.init = function() {
                (r.settings = n.extend({}, o, s)),
                r.settings.offCanvasCloseButton &&
                    n(t)
                    .find(".nav-menus-wrapper")
                    .prepend(
                        "<span class='nav-menus-wrapper-close-button'>&#10005;</span>"
                    ),
                    "right" == r.settings.offCanvasSide &&
                    n(t)
                    .find(".nav-menus-wrapper")
                    .addClass("nav-menus-wrapper-right"),
                    r.settings.hidden &&
                    (n(t).addClass("navigation-hidden"),
                        (r.settings.mobileBreakpoint = 99999)),
                    v(),
                    r.settings.fixed && n(t).addClass("navigation-fixed"),
                    n(t)
                    .find(".nav-toggle")
                    .on("click touchstart", function(n) {
                        n.stopPropagation(),
                            n.preventDefault(),
                            r.showOffcanvas(),
                            s !== a && r.callback("onShowOffCanvas");
                    }),
                    n(t)
                    .find(".nav-menus-wrapper-close-button")
                    .on("click touchstart", function() {
                        r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas");
                    }),
                    n(t)
                    .find(".nav-search-button, .nav-search-close-button")
                    .on("click touchstart keydown", function(i) {
                        i.stopPropagation(), i.preventDefault();
                        var e = i.keyCode || i.which;
                        "click" === i.type ||
                            "touchstart" === i.type ||
                            ("keydown" === i.type && 13 == e) ?
                            r.toggleSearch() :
                            9 == e && n(i.target).blur();
                    }),
                    n(t).find(".megamenu-tabs").length > 0 && y(),
                    n(i).resize(function() {
                        r.initNavigationMode(C()), O(), r.settings.hiddenOnMobile && m();
                    }),
                    r.initNavigationMode(C()),
                    r.settings.hiddenOnMobile && m(),
                    s !== a && r.callback("onInit");
            });
        var h = function() {
                n(t)
                    .find(".nav-submenu")
                    .hide(0),
                    n(t)
                    .find("li")
                    .removeClass("focus");
            },
            v = function() {
                n(t)
                    .find("li")
                    .each(function() {
                        n(this).children(".nav-dropdown,.megamenu-panel").length > 0 &&
                            (n(this)
                                .children(".nav-dropdown,.megamenu-panel")
                                .addClass("nav-submenu"),
                                r.settings.submenuIndicator &&
                                n(this)
                                .children("a")
                                .append(
                                    "<span class='submenu-indicator'><span class='submenu-indicator-chevron'></span></span>"
                                ));
                    });
            },
            m = function() {
                n(t).hasClass("navigation-portrait") ?
                    n(t).addClass("navigation-hidden") :
                    n(t).removeClass("navigation-hidden");
            };
        (r.showSubmenu = function(i, e) {
            C() > r.settings.mobileBreakpoint &&
                n(t)
                .find(".nav-search")
                .find("form")
                .fadeOut(),
                "fade" == e ?
                n(i)
                .children(".nav-submenu")
                .stop(!0, !0)
                .delay(r.settings.showDelayDuration)
                .fadeIn(r.settings.showDuration)
                .removeClass(r.settings.animationOnHide)
                .addClass(r.settings.animationOnShow) :
                n(i)
                .children(".nav-submenu")
                .stop(!0, !0)
                .delay(r.settings.showDelayDuration)
                .slideDown(r.settings.showDuration)
                .removeClass(r.settings.animationOnHide)
                .addClass(r.settings.animationOnShow),
                n(i).addClass("focus");
        }),
        (r.hideSubmenu = function(i, e) {
            "fade" == e
                ?
                n(i)
                .find(".nav-submenu")
                .stop(!0, !0)
                .delay(r.settings.hideDelayDuration)
                .fadeOut(r.settings.hideDuration)
                .removeClass(r.settings.animationOnShow)
                .addClass(r.settings.animationOnHide) :
                n(i)
                .find(".nav-submenu")
                .stop(!0, !0)
                .delay(r.settings.hideDelayDuration)
                .slideUp(r.settings.hideDuration)
                .removeClass(r.settings.animationOnShow)
                .addClass(r.settings.animationOnHide),
                n(i)
                .removeClass("focus")
                .find(".focus")
                .removeClass("focus");
        });
        var p = function() {
                n("body").addClass("no-scroll"),
                    r.settings.overlay &&
                    (n(t).append("<div class='nav-overlay-panel'></div>"),
                        n(t)
                        .find(".nav-overlay-panel")
                        .css("background-color", r.settings.overlayColor)
                        .fadeIn(300)
                        .on("click touchstart", function(n) {
                            r.hideOffcanvas();
                        }));
            },
            g = function() {
                n("body").removeClass("no-scroll"),
                    r.settings.overlay &&
                    n(t)
                    .find(".nav-overlay-panel")
                    .fadeOut(400, function() {
                        n(this).remove();
                    });
            };
        (r.showOffcanvas = function() {
            p(),
                "left" == r.settings.offCanvasSide ?
                n(t)
                .find(".nav-menus-wrapper")
                .css("transition-property", "left")
                .addClass("nav-menus-wrapper-open") :
                n(t)
                .find(".nav-menus-wrapper")
                .css("transition-property", "right")
                .addClass("nav-menus-wrapper-open");
        }),
        (r.hideOffcanvas = function() {
            n(t)
                .find(".nav-menus-wrapper")
                .removeClass("nav-menus-wrapper-open")
                .on(
                    "webkitTransitionEnd moztransitionend transitionend oTransitionEnd",
                    function() {
                        n(t)
                            .find(".nav-menus-wrapper")
                            .css("transition-property", "none")
                            .off();
                    }
                ),
                g();
        }),
        (r.toggleOffcanvas = function() {
            C() <= r.settings.mobileBreakpoint &&
                (n(t)
                    .find(".nav-menus-wrapper")
                    .hasClass("nav-menus-wrapper-open") ?
                    (r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas")) :
                    (r.showOffcanvas(), s !== a && r.callback("onShowOffCanvas")));
        }),
        (r.toggleSearch = function() {
            "none" ==
            n(t)
                .find(".nav-search")
                .find("form")
                .css("display") ?
                (n(t)
                    .find(".nav-search")
                    .find("form")
                    .fadeIn(200),
                    n(t)
                    .find(".nav-search")
                    .find("input")
                    .focus()) :
                (n(t)
                    .find(".nav-search")
                    .find("form")
                    .fadeOut(200),
                    n(t)
                    .find(".nav-search")
                    .find("input")
                    .blur());
        }),
        (r.initNavigationMode = function(i) {
            r.settings.responsive ?
                (i <= r.settings.mobileBreakpoint &&
                    u > r.settings.mobileBreakpoint &&
                    (n(t)
                        .addClass("navigation-portrait")
                        .removeClass("navigation-landscape"),
                        S(),
                        s !== a && r.callback("onPortrait")),
                    i > r.settings.mobileBreakpoint &&
                    d <= r.settings.mobileBreakpoint &&
                    (n(t)
                        .addClass("navigation-landscape")
                        .removeClass("navigation-portrait"),
                        k(),
                        g(),
                        r.hideOffcanvas(),
                        s !== a && r.callback("onLandscape")),
                    (u = i),
                    (d = i)) :
                (n(t).addClass("navigation-landscape"),
                    k(),
                    s !== a && r.callback("onLandscape"));
        });
        var b = function() {
                n("html").on("click.body touchstart.body", function(i) {
                    0 === n(i.target).closest(".navigation").length &&
                        (n(t)
                            .find(".nav-submenu")
                            .fadeOut(),
                            n(t)
                            .find(".focus")
                            .removeClass("focus"),
                            n(t)
                            .find(".nav-search")
                            .find("form")
                            .fadeOut());
                });
            },
            C = function() {
                return (
                    i.innerWidth || e.documentElement.clientWidth || e.body.clientWidth
                );
            },
            w = function() {
                n(t)
                    .find(".nav-menu")
                    .find("li, a")
                    .off(l)
                    .off(f)
                    .off(c);
            },
            O = function() {
                if (C() > r.settings.mobileBreakpoint) {
                    var i = n(t).outerWidth(!0);
                    n(t)
                        .find(".nav-menu")
                        .children("li")
                        .children(".nav-submenu")
                        .each(function() {
                            n(this)
                                .parent()
                                .position().left +
                                n(this).outerWidth() >
                                i ?
                                n(this).css("right", 0) :
                                n(this).css("right", "auto");
                        });
                }
            },
            y = function() {
                function i(i) {
                    var e = n(i)
                        .children(".megamenu-tabs-nav")
                        .children("li"),
                        a = n(i).children(".megamenu-tabs-pane");
                    n(e).on("click.tabs touchstart.tabs", function(i) {
                        i.stopPropagation(),
                            i.preventDefault(),
                            n(e).removeClass("active"),
                            n(this).addClass("active"),
                            n(a)
                            .hide(0)
                            .removeClass("active"),
                            n(a[n(this).index()])
                            .show(0)
                            .addClass("active");
                    });
                }
                if (n(t).find(".megamenu-tabs").length > 0)
                    for (var e = n(t).find(".megamenu-tabs"), a = 0; a < e.length; a++)
                        i(e[a]);
            },
            k = function() {
                w(),
                    h(),
                    navigator.userAgent.match(/Mobi/i) ||
                    navigator.maxTouchPoints > 0 ||
                    "click" == r.settings.submenuTrigger ?
                    n(t)
                    .find(".nav-menu, .nav-dropdown")
                    .children("li")
                    .children("a")
                    .on(l, function(e) {
                        if (
                            (r.hideSubmenu(
                                    n(this)
                                    .parent("li")
                                    .siblings("li"),
                                    r.settings.effect
                                ),
                                n(this)
                                .closest(".nav-menu")
                                .siblings(".nav-menu")
                                .find(".nav-submenu")
                                .fadeOut(r.settings.hideDuration),
                                n(this).siblings(".nav-submenu").length > 0)
                        ) {
                            if (
                                (e.stopPropagation(),
                                    e.preventDefault(),
                                    "none" ==
                                    n(this)
                                    .siblings(".nav-submenu")
                                    .css("display"))
                            )
                                return (
                                    r.showSubmenu(n(this).parent("li"), r.settings.effect),
                                    O(), !1
                                );
                            if (
                                (r.hideSubmenu(n(this).parent("li"), r.settings.effect),
                                    "_blank" === n(this).attr("target") ||
                                    "blank" === n(this).attr("target"))
                            )
                                i.open(n(this).attr("href"));
                            else {
                                if (
                                    "#" === n(this).attr("href") ||
                                    "" === n(this).attr("href") ||
                                    "javascript:void(0)" === n(this).attr("href")
                                )
                                    return !1;
                                i.location.href = n(this).attr("href");
                            }
                        }
                    }) :
                    n(t)
                    .find(".nav-menu")
                    .find("li")
                    .on(f, function() {
                        r.showSubmenu(this, r.settings.effect), O();
                    })
                    .on(c, function() {
                        r.hideSubmenu(this, r.settings.effect);
                    }),
                    r.settings.hideSubWhenGoOut && b();
            },
            S = function() {
                w(),
                    h(),
                    r.settings.visibleSubmenusOnMobile ?
                    n(t)
                    .find(".nav-submenu")
                    .show(0) :
                    (n(t)
                        .find(".submenu-indicator")
                        .removeClass("submenu-indicator-up"),
                        r.settings.submenuIndicator && r.settings.submenuIndicatorTrigger ?
                        n(t)
                        .find(".submenu-indicator")
                        .on(l, function(i) {
                            return (
                                i.stopPropagation(),
                                i.preventDefault(),
                                r.hideSubmenu(
                                    n(this)
                                    .parent("a")
                                    .parent("li")
                                    .siblings("li"),
                                    "slide"
                                ),
                                r.hideSubmenu(
                                    n(this)
                                    .closest(".nav-menu")
                                    .siblings(".nav-menu")
                                    .children("li"),
                                    "slide"
                                ),
                                "none" ==
                                n(this)
                                .parent("a")
                                .siblings(".nav-submenu")
                                .css("display") ?
                                (n(this).addClass("submenu-indicator-up"),
                                    n(this)
                                    .parent("a")
                                    .parent("li")
                                    .siblings("li")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    n(this)
                                    .closest(".nav-menu")
                                    .siblings(".nav-menu")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    r.showSubmenu(
                                        n(this)
                                        .parent("a")
                                        .parent("li"),
                                        "slide"
                                    ), !1) :
                                (n(this)
                                    .parent("a")
                                    .parent("li")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    void r.hideSubmenu(
                                        n(this)
                                        .parent("a")
                                        .parent("li"),
                                        "slide"
                                    ))
                            );
                        }) :
                        n(t)
                        .find(".nav-menu, .nav-dropdown")
                        .children("li")
                        .children("a")
                        .on(l, function(e) {
                            if (
                                (e.stopPropagation(),
                                    e.preventDefault(),
                                    r.hideSubmenu(
                                        n(this)
                                        .parent("li")
                                        .siblings("li"),
                                        r.settings.effect
                                    ),
                                    r.hideSubmenu(
                                        n(this)
                                        .closest(".nav-menu")
                                        .siblings(".nav-menu")
                                        .children("li"),
                                        "slide"
                                    ),
                                    "none" ==
                                    n(this)
                                    .siblings(".nav-submenu")
                                    .css("display"))
                            )
                                return (
                                    n(this)
                                    .children(".submenu-indicator")
                                    .addClass("submenu-indicator-up"),
                                    n(this)
                                    .parent("li")
                                    .siblings("li")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    n(this)
                                    .closest(".nav-menu")
                                    .siblings(".nav-menu")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    r.showSubmenu(n(this).parent("li"), "slide"), !1
                                );
                            if (
                                (n(this)
                                    .parent("li")
                                    .find(".submenu-indicator")
                                    .removeClass("submenu-indicator-up"),
                                    r.hideSubmenu(n(this).parent("li"), "slide"),
                                    "_blank" === n(this).attr("target") ||
                                    "blank" === n(this).attr("target"))
                            )
                                i.open(n(this).attr("href"));
                            else {
                                if (
                                    "#" === n(this).attr("href") ||
                                    "" === n(this).attr("href") ||
                                    "javascript:void(0)" === n(this).attr("href")
                                )
                                    return !1;
                                i.location.href = n(this).attr("href");
                            }
                        }));
            };
        (r.callback = function(n) {
            s[n] !== a && s[n].call(t);
        }),
        r.init();
    }),
    (n.fn.navigation = function(i) {
        return this.each(function() {
            if (a === n(this).data("navigation")) {
                var e = new n.navigation(this, i);
                n(this).data("navigation", e);
            }
        });
    });
})(jQuery, window, document);



(function($) {
    'use strict';

    var $window = $(window);

    if ($.fn.navigation) {
        $("#navigation1").navigation();
        $("#always-hidden-nav").navigation({
            hidden: true
        });
    }

    $window.on('load', function() {
        $('#preloader').fadeOut('slow', function() {
            $(this).remove();
        });
    });

})(jQuery);
/*nav end here*/


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


makeColor(95,"--color-primary-light");