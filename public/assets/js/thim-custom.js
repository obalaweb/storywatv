/**
 * Script custom for theme
 *
 * TABLE OF CONTENT
 *
 * Header: main menu
 * Header: main menu mobile
 * Sidebar: sticky sidebar
 * Feature: Preloading
 * Feature: Back to top
 * Custom select.
 */

(function($) {
    'use strict';

    $(document).ready(function() { 
        thim_startertheme.ready();
    });

    $(window).load(function() {
        thim_startertheme.load();
    });

    var thim_startertheme = {

        /**
         * Call functions when document ready
         */
        ready: function() {
            this.turnoff_autocompleteinput();
            this.feature_preloading();
            this.back_to_top();
            this.header_menu();
            this.header_menu_mobile();
            this.login_popup();
            this.login_error();
            this.slide_slick_col();
            this.select2()
            this.search_open();
            this.magnific_popup_video();
            this.input_num_product();
            this.thim_tabs();
            this.grid_isotope_filter();
            this.custom_input_file();
            this.popup_form();
            this.validate_form();
            this.fillter_full_container();
        },

        /**
         * Call functions when window load.
         */
        load: function() {
            this.bp_grid_isotope();
            this.sticky_sidebar();
        },

        /**
         * turnoff_autocompleteinput
         */
        turnoff_autocompleteinput: function() { 
            try {
                $('input').attr('autocomplete','off');

            } catch(er) {console.log(er);}   
        },

        /**
         * feature: Preloading
         */
        feature_preloading: function() {
            var $preload = $('#thim-preloading');
            if ($preload.length > 0) {
                $preload.fadeOut(1000, function() {
                    $preload.remove();
                });
            }
        },

        /**
         * Back to top
         */
        back_to_top: function() {
            var $element = $('#back-to-top');
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $element.addClass('scrolldown').removeClass('scrollup');
                } else {
                    $element.addClass('scrollup').removeClass('scrolldown');
                }
            });

            $element.on('click', function() {
                $('html,body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        },

        /**
         * Header menu sticky, scroll, v.v.
         */
        header_menu: function() { 
            var off_Top = ($('#wrapper-container').length > 0) ? $('#wrapper-container').offset().top : 0;
            var dentalTop = off_Top;
            if($(window).outerWidth() <= 600) {
                dentalTop = 0;
            }
            var $topbar = $('#toolbar');
            var $header = $('.sticky-header');
            var $elementToStick = $header.find('.element-to-stick');
            var latestScroll = 0; 

            if ($('#toolbar').length) {
                $('.header-overlay').css({
                    top: $('#toolbar').outerHeight() + off_Top + 'px', 
                });
            }
            else {
                $('.header-overlay').css({
                    top: off_Top + 'px',
                });
            }

            $elementToStick.css('top', dentalTop + 'px');

            var startFixed = $elementToStick.offset().top - dentalTop;

            $(window).on('resize', function() {

                if ($(this).scrollTop() > startFixed) {
                    $header.removeClass('fixed');
                    $header.css('height', 'auto');
                }

                off_Top = ($('#wrapper-container').length > 0) ? $('#wrapper-container').offset().top : 0;
                dentalTop = off_Top;

                if($(window).outerWidth() <= 600) {
                    dentalTop = 0;
                }

                if ($('#toolbar').length) {
                    $('.header-overlay').css({
                        top: $('#toolbar').outerHeight() + off_Top + 'px', 
                    });
                }
                else {
                    $('.header-overlay').css({
                        top: off_Top + 'px',
                    });
                }

                $elementToStick.css('top', dentalTop + 'px');

                startFixed = $elementToStick.offset().top - dentalTop;

                if ($(this).scrollTop() > startFixed) {
                    $header.css('height', $header.outerHeight() + 'px');
                    $header.addClass('fixed');
                }
            })

            $(window).scroll(function() {
                var current = $(this).scrollTop();

                if (current > startFixed) {
                    $header.css('height', $header.outerHeight() + 'px');

                    $header.addClass('fixed');
                } else {
                    $header.removeClass('fixed');
                    $header.css('height', 'auto');
                }

                if (current > latestScroll && current > $elementToStick.outerHeight() + startFixed) {
                    if (!$header.hasClass('menu-hidden')) {
                        $header.addClass('menu-hidden');
                        $elementToStick.css({
                            top: - $elementToStick.outerHeight(),
                        });
                    }
                } else {
                    if ($header.hasClass('menu-hidden')) {
                        $header.removeClass('menu-hidden');
                        $elementToStick.css({
                            top: dentalTop,
                        });
                    }
                }

                latestScroll = current;
            });
        },

        /**
         * Mobile menu
         */
        header_menu_mobile: function() {
            let $main_menu = $('#primaryMenu');

            $(document).on('click', '.menu-mobile-effect', function(e) {
                e.stopPropagation();
                $('.responsive #wrapper-container').toggleClass('mobile-menu-open');

                if($('.responsive #wrapper-container').hasClass('mobile-menu-open')) {
                    $('body').css('overflow', 'hidden');
                }
                else {
                    $('body').css('overflow', 'auto');
                } 
            });

            $(document).on('click', '.mobile-menu-open', function() {
                $('.responsive #wrapper-container.mobile-menu-open').
                removeClass('mobile-menu-open');
                
                $('body').css('overflow', 'auto');
            });

            $('.responsive .mobile-menu-container .navbar-nav>li.menu-item-has-children >a').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
            $('.mobile-menu-container .widget_nav_menu .menu-useful-links-container .menu>li.menu-item-has-children >a').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');

            $('.responsive .mobile-menu-container .navbar-nav>li.menu-item-has-children .icon-toggle, .mobile-menu-container .widget_nav_menu .menu-useful-links-container .menu>li.menu-item-has-children .icon-toggle').
            on('click', function() {
                if ($(this).next('ul.sub-menu').is(':hidden')) {
                    $(this).next('ul.sub-menu').slideDown(200, 'linear');
                    $(this).html('<i class="fa fa-angle-up"></i>');
                } else {
                    $(this).next('ul.sub-menu').slideUp(200, 'linear');
                    $(this).html('<i class="fa fa-angle-down"></i>');
                }
            });

            $('.mobile-menu-container').on('click', function(e) {
                e.stopPropagation();
            })
        },
         
        /**
         * Slide slick col.
         */
        slide_slick_col: function() { 
            $('.js-call-slick-col').each(function(){
                var data =  [
                                ['responsive', 'array'],
                                ['customdot', 'bool'],
                                ['numofshow', 'number'],
                                ['numofscroll', 'number'],
                                ['fade', 'bool'],
                                ['loopslide', 'bool'],
                                ['autoscroll', 'bool'],
                                ['speedauto', 'number'],
                                ['verticalslide', 'bool'],
                                ['verticalswipe', 'bool'],
                                ['rtl', 'bool'],
                                ['navfor', 'string'],
                                ['animate', 'bool'],
                                ['middlearrow', 'string']
                            ]

                var parameter = {
                                    responsive: [[1, 1], [1, 1], [1, 1], [1, 1], [1, 1]],
                                    customdot: false,
                                    numofshow: 1,
                                    numofscroll: 1,
                                    fade: false,
                                    loopslide: false,
                                    autoscroll: false,
                                    speedauto: 5000,
                                    verticalslide: false,
                                    verticalswipe: false,
                                    rtl: false,
                                    navfor: '',
                                    animate: false,
                                    middlearrow: null
                                }

                var showDot = false;
                var showArrow = false;
                var wrapSlick = $(this);
                var slideSlick = $(this).find('.slide-slick');
                var itemSlick = $(slideSlick).find('.item-slick');
                var layerSlick = $(slideSlick).find('[data-appear]');
                var actionSlick = [];
        
                // Check show dot, arrows
                if($(wrapSlick).find('.wrap-dot-slick').length > 0) {
                    showDot = true;
                }

                if($(wrapSlick).find('.wrap-arrow-slick').length > 0) {
                    showArrow = true;
                }

                // Get data
                for(var i=0; i<data.length; i++) {
                    var value = $(this).data(data[i][0]); 

                    if (value != null) {
                        if(data[i][1] === 'bool') {
                            if(value === '1' || value === 1) { 
                                parameter[data[i][0]] = true;
                            } else {
                                parameter[data[i][0]] = false;
                            }
                        } 
                        else if(data[i][1] === 'number') {
                            parameter[data[i][0]] = Number(value);
                        }
                        else if(data[i][1] === 'string') {
                            parameter[data[i][0]] = value;
                        }
                        else if(data[i][1] === 'array') {
                            var strArray = value.match(/(\d+)/g);
                            parameter[data[i][0]] = [  
                                                        [Number(strArray[0]), Number(strArray[1])], 
                                                        [Number(strArray[2]), Number(strArray[3])], 
                                                        [Number(strArray[4]), Number(strArray[5])], 
                                                        [Number(strArray[6]), Number(strArray[7])], 
                                                        [Number(strArray[8]), Number(strArray[9])] 
                                                    ]
                        }
                    }
                }

                // Call slick
                if(parameter.animate) {
                    $(layerSlick).addClass('animated').css('visibility', 'hidden');

                    $(slideSlick).on('init', function(){
                        showLayer(0);
                    });
                }

                $(slideSlick).slick({ 
                    asNavFor: parameter.navfor,
                    rtl: parameter.rtl,
                    vertical: parameter.verticalslide,
                    verticalSwiping: parameter.verticalswipe,
                    pauseOnFocus: false,
                    pauseOnHover: true,
                    slidesToShow: parameter.numofshow,
                    slidesToScroll: parameter.numofscroll,
                    fade: parameter.fade,
                    infinite: parameter.loopslide,
                    autoplay: parameter.autoscroll,
                    autoplaySpeed: parameter.speedauto,
                    arrows: showArrow,
                    appendArrows: $(wrapSlick).find('.wrap-arrow-slick'),
                    prevArrow: $(wrapSlick).find('.prev-slick'),
                    nextArrow: $(wrapSlick).find('.next-slick'),
                    dots: showDot,
                    appendDots: $(wrapSlick).find('.wrap-dot-slick'),
                    dotsClass:'dots-slick',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');

                        if(parameter.customdot) return '<img src=" ' + portrait + ' "/>';

                        return '<span></span>'
                    },  
                    responsive: [
                        {
                          breakpoint: 1368,
                          settings: {
                            slidesToShow: parameter.responsive[0][0],
                            slidesToScroll: parameter.responsive[0][1]
                          }
                        },
                        {
                          breakpoint: 1199,
                          settings: {
                            slidesToShow: parameter.responsive[1][0],
                            slidesToScroll: parameter.responsive[1][1]
                          }
                        },
                        {
                          breakpoint: 991,
                          settings: {
                            slidesToShow: parameter.responsive[2][0],
                            slidesToScroll: parameter.responsive[2][1]
                          }
                        },
                        {
                          breakpoint: 767,
                          settings: {
                            slidesToShow: parameter.responsive[3][0],
                            slidesToScroll: parameter.responsive[3][1]
                          }
                        },
                        {
                          breakpoint: 575,
                          settings: {
                            slidesToShow: parameter.responsive[4][0],
                            slidesToScroll: parameter.responsive[4][1]
                          }
                        }
                    ]
                })
                .on('setPosition', function(event, slick){
                    // Equal height
                    if($(this).parent().data('equalheight') === '1' || $(this).parent().data('equalheight') === 1) {
                        var maxHeight = 0;
                        var $items = $(this).find('.item-slick');

                        $items.each(function(){
                            if($(this).outerHeight() > maxHeight) {
                                maxHeight = $(this).outerHeight();
                            }
                        })

                        $items.css('min-height', maxHeight);
                    }

                    // Middle Arrow
                    if(parameter.middlearrow != null) {
                        var $wrapArrows = $(wrapSlick).find('.wrap-arrow-slick');
                        var middleOf = $(wrapSlick).find(parameter.middlearrow).outerHeight();
                        
                        $wrapArrows.css('height', middleOf + 'px');
                    }
                });

                // Animate
                if(parameter.animate) {
                    $(slideSlick).on('afterChange', function(event, slick, currentSlide){ 
                        showLayer(currentSlide);
                    });
                }

                function showLayer(currentSlide) {
                    var layerCurrentItem = $(itemSlick[currentSlide]).find('[data-appear]');

                    for(var i=0; i<actionSlick.length; i++) {
                        clearTimeout(actionSlick[i]);
                    }

                    $(layerSlick).each(function(){
                        $(this).removeClass($(this).data('appear')).css('visibility', 'hidden');
                    })
                        

                    for(var i=0; i<layerCurrentItem.length; i++) {
                        actionSlick[i] = setTimeout(function(index) {
                            $(layerCurrentItem[index]).addClass($(layerCurrentItem[index]).data('appear')).css('visibility', 'visible');
                        },$(layerCurrentItem[i]).data('delay'),i); 
                    }
                };
            });
        },
        
        /**
         * Login popup form
         */
        login_popup: function () {

            $('.login-popup').on('click', '.display-box', function (e) {
                e.preventDefault();

                var classbox = $(this).attr('data-display');

                $('.login-popup' + classbox).addClass('active').siblings().removeClass('active');
            });

            var loginLink = $('.login-links .login').attr('href');

            if($(window).width() >= 992) {
                $('.login-links .login').attr('href', '#bp-popup-login');

                $('.login-links .login').magnificPopup({
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    fixedContentPos : false,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');

                        },
                        open: function () {
                            var classactive = this.st.el.attr('data-active');
                            $('.login-popup' + classactive).addClass('active').siblings().removeClass('active');
                        }
                    },
                    midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                });
                $('.login-links .register').magnificPopup({
                    type: 'inline',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');

                        },
                        open: function () {
                            var classactive = this.st.el.attr('data-active');
                            $('.login-popup' + classactive).addClass('active').siblings().removeClass('active');
                        }
                    },
                    midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                });
            }
            else {
                $('.login-links .login').attr('href', loginLink);
            }

                


            $('#bp-popup-login #loginform').submit(function (event) {
                var elem = $('#bp-popup-login'),
                    input_username = elem.find('#bp_login_name').val(),
                    input_password = elem.find('#bp_login_pass').val();

                if (input_username === '' || input_password === '') {
                    return;
                }

                elem.addClass('loading');
                elem.find('.message').slideDown().remove();

                var data = {
                    action: 'builderpress_login_ajax',
                    username: input_username,
                    password: input_password,
                    remember: elem.find('#rememberme').val()
                };

                $.post(ajaxurl, data, function (res) {
                    try {
                        var response = JSON.parse(res);
                        elem.find('.login-popup .inner-login').append(response.message);
                        if (response.code === '1') {
                            location.reload();
                        }
                        elem.removeClass('loading');
                    } catch (e) {
                        return false;
                    }
                });

                event.preventDefault();
                return false;
            });

            // $(function ($) {
            //     $('#bp_login_name, #bp_login_name_ac').attr('placeholder', login_popup_js.login);
            //     $('#bp_login_pass, #bp_login_pass_ac').attr('placeholder', login_popup_js.password);
            // });

        },

        /**
         * Notifications error for form
         */
        login_error: function () {

            // Validate login submit
            $('.login-popup form#loginform').submit(function (event) {
                var elem = $(this),
                    input_username = elem.find('#bp_login_name, #bp_login_name_ac'),
                    input_pass = elem.find('#bp_login_pass, #bp_login_pass_ac');

                if (input_username.length > 0 && input_username.val() === '') {
                    input_username.addClass('invalid');
                    event.preventDefault();
                }

                if (input_pass.length > 0 && input_pass.val() === '') {
                    input_pass.addClass('invalid');
                    event.preventDefault();
                }
            });

            //Register form untispam
            $('.login-popup form#registerform').submit(function (event) {
                var elem = $(this),
                    input_username = elem.find('#user_login_register'),
                    input_email = elem.find('#user_email'),
                    input_pass = elem.find('#password'),
                    input_rppass = elem.find('#repeat_password');

                var email_valid = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

                if (input_username.length > 0 && input_username.val() === '') {
                    input_username.addClass('invalid');
                    event.preventDefault();
                }

                if (input_email.length > 0 && (input_email.val() === '' || !email_valid.test(input_email.val()))) {
                    input_email.addClass('invalid');
                    event.preventDefault();
                }

                if (input_pass.val() !== input_rppass.val() || input_pass.val() === '') {
                    input_pass.addClass('invalid');
                    input_rppass.addClass('invalid');
                    event.preventDefault();
                }
            });

            // Validate lostpassword submit
            $('.login-popup form#lostpasswordform').submit(function (event) {
                var elem = $(this),
                    input_username = elem.find('#user_login_lostpass');

                if (input_username.length > 0 && input_username.val() === '') {
                    input_username.addClass('invalid');
                    event.preventDefault();
                }
            });

            // Remove class invalid
            $('.login-popup #bp_login_name, .login-popup #bp_login_pass, .login-popup #user_login_lostpass, .login-popup #user_login_register, .login-popup #bp_login_name_ac, .login-popup #bp_login_pass_ac').on('focus', function () {
                $(this).removeClass('invalid');
            });

        },

        /**
         * grid_isotope
         */
        bp_grid_isotope: function() {
            if ( $().isotope ) {
                $('.grid-isotope').isotope({
                    // set itemSelector so .grid-sizer is not used in layout
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    masonry: {
                        // use element for option
                        columnWidth: '.grid-sizer'
                    }
                })
            }
        },

        /**
         * select2
         */
        select2: function() { 
            try {
                $('select').each(function() {
                    if(!$(this).parent().hasClass('wrap-select2')) {
                        $(this).parent().addClass('wrap-select2');
                    }
                });

                $(".wrap-select2").each(function(){
                    $(this).append('<span class="dropDownSelect2"></span>');

                    var select = $(this).children('select');
                    var style = $(this).data('style');
                    var dropdown = $(this).children('.dropDownSelect2');

                    $(select).select2({
                        minimumResultsForSearch: 20,
                        dropdownParent: dropdown,
                        theme: style,
                    });
                });

            } catch(er) {console.log(er);}   
        },
        
        /**
         * Search Open
         */
        search_open:function(){
            var $search = $('.bp-element-search');
            var $open_form = $search.find('.search-button');
            var $close_form = $search.find('.close-form');
            var $search_form = $search.find('.search-form');
            var $searchField = $search.find('.search-field');

            $open_form.click(function(){
                $search_form.addClass('open');
                setTimeout(function() { $searchField.focus(); }, 800);
            });

            $close_form.click(function(){
                $search_form.removeClass('open');
            });

            $(window).keydown(function( event ) {
                if ( event.which === 27 ) {
                    $search_form.removeClass('open');
                }
            });
        },

        /**
         * Magnific-Popup-Video
         */
         magnific_popup_video: function() {
            try {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    iframe: {
                        patterns: {
                            youtube: {
                                index: 'youtube.com/', 
                                id: function(url) {        
                                    var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                                    if ( !m || !m[1] ) return null;
                                    return m[1];
                                },
                                src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                            },
                        }
                    },
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,

                    fixedContentPos: false
                });
            } catch(er) {console.log(er);}
         },


        /**
         * Magnific-Popup-Video
         */
        input_num_product: function() {
            try {
                $(document).on("click",'.wrap-num-product .btn-num-down', function () {
                    var numProduct = Number($(this).parent().find('.num-product').val());
                    if(numProduct > 0) $(this).parent().find('.num-product').val(numProduct - 1);
                    $('.woocommerce-cart-form button[name="update_cart"]').removeAttr("disabled")
                });


                $(document).on("click",'.wrap-num-product .btn-num-up', function () {
                    var numProduct = Number($(this).parent().find('.num-product').val());
                    $(this).parent().find('.num-product').val(numProduct + 1);
                    $('.woocommerce-cart-form button[name="update_cart"]').removeAttr("disabled")
                });
            } catch(er) {console.log(er);}
        },

        /**
         * thim-tabs
         */
        thim_tabs: function() {
            try {
                $('.js-call-tabs').each(function(){
                    var navTabs = $(this).find('.thim-nav-tabs');
                    var contentTabs = $(this).find('.thim-content-tabs');

                    $(contentTabs).find('.tab-panel').hide();

                    var getPanelActive = $(navTabs).find('.item-nav.active').data('panel');

                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").show();
                    $(contentTabs).find(".tab-panel[data-nav='" + getPanelActive + "']").addClass('active');


                    $(navTabs).find('.item-nav').each(function(){
                        $(this).on('click', function(e){
                            e.preventDefault();
                            var getPanel = $(this).data('panel');

                            $(contentTabs).find('.tab-panel').hide();
                            $(contentTabs).find('.tab-panel').removeClass('active');
                            $(navTabs).find('.item-nav').removeClass('active');

                            $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").show();
                            $(contentTabs).find(".tab-panel[data-nav='" + getPanel + "']").addClass('active');
                            $(this).addClass('active');

                            var curentItemNav = Number($(this).data('step'));

                            for(var i=1; i<curentItemNav; i++) {
                                $(navTabs).find(".item-nav[data-step='" + i + "']").addClass('active');
                            }
                        });
                    });

                });
            } catch(er) {console.log(er);}
         },


        /**
         * thim-tabs
         */
        grid_isotope_filter: function() {
            try {
                $('.js-call-isotope-filter').each(function(){
                    var $topeContainer = $(this).find('.isotope-grid');
                    var $filter = $(this).find('.filter-tope-group');

                    // filter items on button click
                    //$filter.each(function () {
                        $filter.on('click', '.item-tope', function () {
                            var filterValue = $(this).attr('data-filter');
                            $topeContainer.isotope({filter: filterValue});
                        });
                        
                    //});

                    // init Isotope
                    $(window).on('load', function () {
                        var $grid = $topeContainer.each(function () {
                            $(this).isotope({
                                itemSelector: '.isotope-item',
                                layoutMode: 'fitRows',
                                percentPosition: true,
                                animationEngine : 'best-available',
                                masonry: {
                                    columnWidth: '.isotope-item'
                                }
                            });
                        });
                    });

                    var $isotopeButton = $filter.find('.item-tope');

                    $isotopeButton.each(function(){
                        $(this).on('click', function(){
                            $isotopeButton.removeClass('active');

                            $(this).addClass('active');
                        });
                    });
                });
                    
            } catch(er) {console.log(er);}
         },

        /**
         * sticky_sidebar
         */
        sticky_sidebar: function() {
            try {
                var offsetTop = 10;
                var spacingTop = 10;

                if($('#wpadminbar').length) {
                    offsetTop += $('#wpadminbar').outerHeight();
                    spacingTop += $('#wpadminbar').outerHeight();
                }

                if($('.sticky-header .element-to-stick').length) {
                    offsetTop += $('.sticky-header .element-to-stick').outerHeight();
                }

                $('.sticky-sidebar').each(function () {
                    if ($(this).length > 0) {
                        if ( $().theiaStickySidebar ) {
                            $(this).theiaStickySidebar({
                                'typeSticky'            : 1,
                                'spacingTopDefault'     : spacingTop,
                                'containerSelector'     : '',
                                'additionalMarginTop'   : offsetTop,
                                'additionalMarginBottom': 10,
                                'updateSidebarHeight'   : false,
                                'minWidth'              : 992,
                                'sidebarBehavior'       : 'modern',
                            });
                        }
                    }
                });
                    
            } catch(er) {console.log(er);}
        },

        /**
         * custom_input_file
         */
        custom_input_file: function() {
            try {
                $('.input-choose-file').each(function(){
                    var $inputField = $(this).find('.input-field input[type="file"]');
                    var $inputValue = $(this).find('.input-file-value');

                    $inputField.on('change', function(){
                        $inputValue.html($inputField.val());
                    })
                });
                    
            } catch(er) {console.log(er);}
        },


        /**
         * validate_form
         */
        validate_form: function() {
            try {
                    var input = $('.require input, .require textarea');

                    $('.validate-form').on('submit',function(){
                        var check = true;

                        for(var i=0; i<input.length; i++) {
                            if(validate(input[i]) === false){
                                showValidate(input[i]);
                                check = false;
                            }
                        }

                        return check;
                    });


                    $(input).each(function(){
                        $(this).on('focus',function(){
                            hideValidate(this);
                        });
                    });

                    function validate (input) {
                        if($(input).val().trim() === ''){
                            return false;
                        }
                    }

                    function showValidate(input) {
                        var thisAlert = $(input).parent();

                        $(thisAlert).addClass('alert-validate');
                    }

                    function hideValidate(input) {
                        var thisAlert = $(input).parent();

                        $(thisAlert).removeClass('alert-validate');
                    }
                    
            } catch(er) {console.log(er);}
        },

        /**
         * Magnic popup
         */
        popup_form: function () {
            $('.js-popup-form').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#name',

                // When elemened is focused, some mobile browsers in some cases zoom in
                // It looks not nice, so we disable it:
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = this.st.el.attr('data-effect');
                        
                        if($(window).width() < 700) {
                            this.st.focus = false;
                        } else {
                            this.st.focus = '#name';
                        }
                    }
                }
            });
        },

        /**
         * fillter_full_container
         */
        fillter_full_container: function () {
            try {
                $('.js-filter-full-container').each(function() {
                    var wrapFilter = $(this);
                    var toggle = $(this).find('.toggle-filter');
                    var content = $(this).find('.content-filter');

                    if($(wrapFilter).hasClass('active-filter')) {
                        $(content).show();
                    }
                    else {
                        $(content).hide();
                    }

                    $(toggle).on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if($(wrapFilter).hasClass('active-filter')) {
                            $(wrapFilter).removeClass('active-filter');
                            $(content).slideUp('fast');
                        }
                        else {
                            $(wrapFilter).addClass('active-filter');
                            $(content).slideDown('fast');
                        }
                    })

                    $(content).on('click', function(e) {
                        e.stopPropagation();
                    })

                    $(window).on('click', function() {
                        $(wrapFilter).removeClass('active-filter');
                        $(content).slideUp('fast');
                    })
                });
                    
            } catch(er) {console.log(er);}
        }
    };

})(jQuery);