var bodyEl = document.querySelector('body');
var winW = window.innerWidth;

function Loader(type) {
    this.type = type ? type : null;
    this.start = function() {
        if ( document.querySelector('#loader') ) document.querySelector('#loader').remove();
        this.el = document.createElement('div');
        this.el.id = 'loader';
        if ( this.type !== null ) this.el.classList.add(this.type);
        document.body.appendChild(this.el);
        this.items = [];
        for (var i = 1; i <= 5; i++) {
            this.items[i] = document.createElement('div');
            this.items[i].classList = 'loader-item'
            this.el.appendChild(this.items[i]);
        }
    };
    this.stop = function(callback) {
        if (this.el) {
            var thisEl = this.el;
            gsap.to(thisEl, {
                duration: .5,
                autoAlpha: 0,
                ease: Power2.easeInOut,
                onComplete: function () {
                    if ( callback ) callback();
                    thisEl.remove();
                    // thisEl.parentNode.removeChild(thisEl);
                }
            });
        }
    };
}
var loaderEl = document.querySelector('#loader');
if ( loaderEl === null ) {
    loaderEl = document.createElement('div');
    loaderEl.id = 'loader';
    bodyEl.appendChild(loaderEl);
}
var _SPINNER = null;    // 로딩바 객체 변수
var spinnerOpts = {
    lines: 5, // The number of lines to draw
    length: 0, // The length of each line
    width: 17, // The line thickness
    radius: 45, // The radius of the inner circle
    scale: 0.6, // Scales overall size of the spinner
    corners: 1, // Corner roundness (0..1)
    color: '#5AD3C0', // CSS color or array of colors
    fadeColor: 'transparent', // CSS color or array of colors
    opacity: 0.5, // Opacity of the lines
    rotate: 0, // The rotation offset
    direction: 1, // 1: clockwise, -1: counterclockwise
    speed: 1, // Rounds per second
    trail: 60, // Afterglow percentage
    shadow: false, // Whether to render a shadow
    fps: 20, // Frames per second when using setTimeout() as a fallback in IE 9
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    className: 'spinner', // The CSS class to assign to the spinner
    top: '50%', // Top position relative to parent
    left: '50%', // Left position relative to parent
    position: 'absolute' // Element positioning
};
function startSpinLoader() {
    // var items = [];
    // for (var i = 1; i <= 5; i++) {
    //     items[i] = document.createElement('div');
    //     items[i].classList = 'loader-item';
    //     el.appendChild(items[i]);
    // }

    var target = document.querySelector("#loader");

    if (_SPINNER == null) {
        _SPINNER = new Spinner(spinnerOpts).spin(target);
    }
}
function startSpinDimmedLoader() {
    // var items = [];
    // for (var i = 1; i <= 5; i++) {
    //     items[i] = document.createElement('div');
    //     items[i].classList = 'loader-item';
    //     el.appendChild(items[i]);
    // }

    var target = document.querySelector("#loader");
    target.classList.add('dimmed');
    gsap.set(target, {autoAlpha: 1});

    if (_SPINNER == null) {
        _SPINNER = new Spinner(spinnerOpts).spin(target);
    }
}
function stopSpinLoader(callback) {
    if (_SPINNER != null) {
        _SPINNER.stop();
        _SPINNER = null;
        gsap.to('#loader', {
            duration: .5,
            autoAlpha: 0,
            ease: Power2.easeInOut,
            onComplete: function () {
                if ( callback ) callback();
                if ( loaderEl.classList.contains('dimmed') ) loaderEl.classList.remove('dimmed');
                // document.querySelector("#loader").remove();
            }
        });
    }
}
// var globalLoader = new Loader();
// globalLoader.start();
startSpinLoader();
var globalLoaderDark = new Loader('dimmed');

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// missing forEach on NodeList for IE11
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}

var vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

gsap.registerPlugin(ScrollTrigger);

var dropdown = function(target) {
    var me = this;
    var el = $(target);

    var dropdownTarget = $(el.data('dropdown-target'));

    me.init = function() {
        dropdownTarget.toggleClass('active');
        if ( dropdownTarget.hasClass("active") ) {
            gsap.to(dropdownTarget, {
                autoAlpha: 1
            });
        } else {
            gsap.to(dropdownTarget, {
                autoAlpha: 0
            });
        }
    };
    me.init();

    return me;
};
function modal(target, startCallback, openCallback, closeCallback) {

//     startCallback = startCallback ? startCallback() : null;
//     openCallback = openCallback ? openCallback() : null;
//     closeCallback = closeCallback ? closeCallback() : null;

    var targetType = typeof target == 'string';
    var targetEl = targetType ? document.querySelector(target) : target;
    var modalTarget = targetEl.getAttribute('data-modal-target');
    var modalTriggerToggle = targetEl.getAttribute('data-modal-trigger-toggle');
    var modalMultiContI = targetEl.getAttribute('data-modal-index');
    var getModalDuration = targetEl.getAttribute('data-modal-duration'),
        modalDuration = getModalDuration ? getModalDuration : 0.3;
    var modalTargetEl = modalTarget === null ? targetEl : document.querySelector(modalTarget);
    var modalCloseEls = modalTargetEl.querySelectorAll('[data-modal="close"]');
    var modalBottomType = modalTargetEl.classList.contains('modal-bottom');
    var bodyOverflowScroll = modalTargetEl.getAttribute('data-modal-overflow');

    function initActions() {
        if (modalTriggerToggle === 'true') {
            if (modalTargetEl.classList.contains('modal-hidden')) {
                open();
            } else {
                // close();
                modalClose(target, target, modalBottomType, modalTriggerToggle, closeCallback);
            }
        } else {
            open();
        }
    }
    function init() {
        gsap.utils.toArray(modalCloseEls).forEach(function(el, i) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                // close(el);
                modalClose(target, el, modalBottomType, modalTriggerToggle, closeCallback);
            });
        });
        if ( targetEl.classList.contains('modal') ) {
            initActions();
            return;
        }
        if ( targetType ) {
            targetEl.addEventListener('click', function (e) {
                e.preventDefault();
                initActions();
            });
        } else {
            initActions();
        }
    }
    function open() {
        if ( bodyOverflowScroll !== 'false' ) bodyEl.classList.add('body-overflow');
        if ( modalBottomType ) gsap.to(modalTargetEl.querySelector('.modal-content'), {bottom: 0, duration: 0.4, ease: 'power3.out'});
        if ( modalTriggerToggle === 'true' ) targetEl.classList.add('active');
        if ( modalMultiContI !== null ) {
            var modalContActiveEl = modalTargetEl.querySelector('.modal-content.active');
            if ( modalContActiveEl !== null ) modalContActiveEl.classList.remove('active');
            modalTargetEl.querySelector('.modal-content[data-modal-index="'+modalMultiContI+'"]').classList.add('active');
        }
        modalTargetEl.classList.remove('modal-hidden');
        gsap.fromTo(modalTarget, {
            autoAlpha: 0
        }, {
            duration: modalDuration,
            autoAlpha: 1,
            onStart: function () {
                if ( modalTarget === '#modal-room' ) return;
                if (startCallback) startCallback();
            },
            onComplete: function () {
                if ( modalTarget === '#modal-room' ) startCallback();
                if (openCallback) openCallback();
            }
        });
    }
    // function close(target) {
    //     if ( modalBottomType ) {
    //         console.log("1");
    //         gsap.to(modalTargetEl.querySelector('.modal-content'), {bottom: '-100%', duration: 0.5, ease: 'power3.out'});
    //     }
    //     if ( modalTriggerToggle === 'true' ) {
    //         console.log("2");
    //         targetEl.classList.remove('active');
    //         modalTarget = targetEl.getAttribute('data-modal-target');
    //         modalTargetEl = modalTarget === null ? targetEl : document.querySelector(modalTarget);
    //         gsap.to(modalTarget, {
    //             duration: .3,
    //             delay: modalBottomType ? 0.3 : 0,
    //             autoAlpha: 0,
    //             onComplete: function () {
    //                 if (closeCallback) closeCallback();
    //             }
    //         });
    //         modalTargetEl.classList.add('modal-hidden');
    //     } else {
    //         console.log("3", target);
    //         gsap.to($(target).parents('.modal'), {
    //             duration: .3,
    //             delay: modalBottomType ? 0.3 : 0,
    //             autoAlpha: 0,
    //             onComplete: function () {
    //                 if (closeCallback) closeCallback();
    //             }
    //         });
    //         $(target).parents('.modal').addClass('modal-hidden');
    //     }
    //     bodyEl.classList.remove('body-overflow');
    // }
    init();
}
function modalClose(target, closeBtn, modalBottomType, modalTriggerToggle, closeCallback) {
    var targetType = typeof target == 'string';
    var targetEl = targetType ? document.querySelector(target) : target;
    var modalTarget = targetEl.getAttribute('data-modal-target');
    var modalTargetEl = modalTarget === null ? targetEl : document.querySelector(modalTarget);
    if ( modalBottomType ) {
        gsap.to(modalTargetEl.querySelector('.modal-content'), {bottom: '-100%', duration: 0.5, ease: 'power3.out'});
    }
    if ( modalTriggerToggle === 'true' ) {
        targetEl.classList.remove('active');
        modalTarget = targetEl.getAttribute('data-modal-target');
        modalTargetEl = modalTarget === null ? targetEl : document.querySelector(modalTarget);
        gsap.to(modalTarget, {
            duration: .3,
            delay: modalBottomType ? 0.3 : 0,
            autoAlpha: 0,
            onComplete: function () {
                if (closeCallback) closeCallback();
            }
        });
        modalTargetEl.classList.add('modal-hidden');
    } else {
        gsap.to($(closeBtn).parents('.modal'), {
            duration: .3,
            delay: modalBottomType ? 0.3 : 0,
            autoAlpha: 0,
            onComplete: function () {
                if (closeCallback) closeCallback();
            }
        });
        $(closeBtn).parents('.modal').addClass('modal-hidden');
    }
    bodyEl.classList.remove('body-overflow');
}
$.fn.formSelect = function(method) {
    var $this = $(this);

    this.hide();
    this.each(function() {
        var $select = $(this);

        if (!$select.hasClass('form-select__init')) {
            createSelect($select);
        }
    });
    function createSelect($select) {
        var $selectIcon = $select.data('select-icon');
        $select.wrap('<div class="form-select form-select__init"></div>');

        var $dropdown = $select.parent();

        $dropdown.addClass($select.attr('class') || '')
            .addClass($select.attr('disabled') ? 'disabled' : '')
            .attr('tabindex', $select.attr('disabled') ? null : '0')
            .append('<span class="form-select__current"><span class="form-select__text"></span></span><ul class="form-select__list"></ul>');

        var $options = $select.find('option');
        var $selected = $select.find('option:selected');

        $dropdown.find('.form-select__current .form-select__text').html($selected.data('display') || $selected.text());

        $options.each(function(i) {
            var $option = $(this);
            var display = $option.data('display');

            if ( $option.val() === '' ) return;

            $dropdown.find('ul').append($('<li class="form-select__option"></li>')
                .attr('data-value', $option.val())
                .attr('data-display', (display || null))
                .addClass('option' +
                    ($option.is(':selected') ? ' selected' : '') +
                    ($option.is(':disabled') ? ' disabled' : ''))
                .html($option.text())
            );
        });
    }

    $(document).off('.form-select');
    $(document).on('click.form-select', '.form-select', function() {
        var $dropdown = $(this);
        var current = $dropdown.find('.form-select__current');

        $('.form-select').not($dropdown).removeClass('active')
            .find('.form-select__current').removeClass('btn-dimmed')
            .addClass('btn-ghost');
        $dropdown.toggleClass('active');
        if ($dropdown.hasClass('active')) {
            $dropdown.find('.form-select__option');
            $dropdown.find('.focus').removeClass('focus');
            $dropdown.find('.selected').addClass('focus');
            current.addClass('btn-dimmed')
                .removeClass('btn-ghost');
        } else {
            current.removeClass('btn-dimmed')
                .addClass('btn-ghost');
            $dropdown.focus();
        }
    });
    $(document).on('click.form-select', function (e) {
        var $formSelect = $this.parent('.form-select');
        var current = $formSelect.find('.form-select__current');
        if ( !$formSelect.is(e.target) && $formSelect.has(e.target).length === 0 ) {
            current.removeClass('btn-dimmed')
                .addClass('btn-ghost');
            $formSelect.removeClass('active');
        }
    });
    $(document).on('click.form-select', '.form-select .form-select__option:not(.disabled)', function(e) {
        var $option = $(this);
        var $dropdown = $option.closest('.form-select');

        $dropdown.find('.selected').removeClass('selected');
        $option.addClass('selected');

        var text = $option.data('display') || $option.text();
        $dropdown.find('.form-select__current .form-select__text').text(text);

        $dropdown.find('select.form-select').val($option.data('value')).trigger('change');
    });

    return this;
};
function formSelectDisabled(selectId) {     // jquery
    ScrollTrigger.matchMedia({
        "(min-width: 1024px)": function () {
            selectId.parent('.form-select').removeClass('disabled');
        }
    });
}
function reInitSmoothScroll() {
    ScrollTrigger.matchMedia({
        "(min-width: 1024px)": function () {
            smoothScroll("#contents");
        }
    });
}
var navTab = function(target) {
    var me = this;
    var getTabNavEl = target.getAttribute('data-nav-target');
    var tabNavEl = document.querySelector(getTabNavEl);
    var tabNavBtnEl = tabNavEl.querySelectorAll('.nav-link');

    me.navTabSwiper = null;
    me.navTabItemSwiper = null;
    me.init = function() {
        if ( target.classList.contains('swiper-container') ) {
            me.navTabSwiper = new Swiper(target, {
                allowTouchMove: false,
                speed: 0,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                on: {
                    init: function () {
                        target.classList.add('swiper-initialized');
                        reInitSmoothScroll();
                    },
                    slideChangeTransitionEnd: function () {
                        reInitSmoothScroll();
                    }
                },
                autoHeight: true
            });
        }
        var tabNavActiveEl;
        if ( tabNavEl.classList.contains('swiper-container') ) {
            me.navTabItemSwiper = new Swiper(tabNavEl, {
                slidesPerView: 'auto',
                freeMode: true,
            });
            gsap.utils.toArray(tabNavEl.querySelectorAll('.swiper-slide')).forEach(function(el, i) {
                el.setAttribute('data-swiper-index', i);
            });
        }
        var getHash = window.location.hash;
        if (getHash) {
            scroll(0,0);
            setTimeout( function() { scroll(0,0); }, 1);
            gsap.utils.toArray(target.querySelectorAll('.tab-pane')).forEach(function(el, i) {
                if (getHash === '#' + el.id) {
                    if ( target.classList.contains('swiper-container') ) {
                        me.navTabSwiper.slideTo(i);
                    } else {
                        el.classList.add('active');
                    }
                }
            });
            var getHashNavTabEl = tabNavEl.querySelector('.nav-link[href="'+getHash+'"]');
            tabNavActiveEl = tabNavEl.querySelector('.nav-link.active');
            tabNavActiveEl.classList.remove('active');
            getHashNavTabEl.classList.add('active');
        }
        if ( tabNavEl.classList.contains('swiper-container') ) {
            tabNavActiveEl = tabNavEl.querySelector('.nav-link.active');
            var tabNavActiveElParent = tabNavActiveEl.parentElement;
            var tabNavActiveI = tabNavActiveElParent.getAttribute('data-swiper-index');
            me.navTabItemSwiper.slideTo(tabNavActiveI, 0);
        }
        gsap.utils.toArray(tabNavBtnEl).forEach(function(el, i) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                var tabNavActiveEl;
                var tabNavBtnTarget, tabNavBtnTargetActiveEl, tabNavBtnTargetEl;
                if ( el.classList.contains('nav-btn') ) {
                    tabNavActiveEl = tabNavEl.querySelector('.nav-btn:not(.btn-clean)');
                    tabNavActiveEl.classList.add('btn-clean');
                    el.classList.remove('btn-clean');
                    tabNavBtnTarget = el.getAttribute('href');
                    tabNavBtnTargetActiveEl = target.querySelector('.tab-pane.active');
                    if ( tabNavBtnTargetActiveEl !== null ) tabNavBtnTargetActiveEl.classList.remove('active');
                    if ( tabNavBtnTarget !== null ) {
                        tabNavBtnTargetEl = target.querySelector(tabNavBtnTarget);
                        tabNavBtnTargetEl.classList.add('active');
                    }
                    reInitSmoothScroll();
                } else if (el.classList.contains('nav-heading')) {
                    tabNavActiveEl = tabNavEl.querySelector('.nav-heading.active');
                    tabNavActiveEl.classList.remove('active');
                    el.classList.add('active');
                    tabNavBtnTarget = el.getAttribute('href');
                    tabNavBtnTargetActiveEl = target.querySelector('.tab-pane.active');
                    if ( tabNavBtnTargetActiveEl !== null ) tabNavBtnTargetActiveEl.classList.remove('active');
                    if ( tabNavBtnTarget !== null ) {
                        tabNavBtnTargetEl = target.querySelector(tabNavBtnTarget);
                        tabNavBtnTargetEl.classList.add('active');
                    }
                    reInitSmoothScroll();
                } else {
                    tabNavActiveEl = tabNavEl.querySelector('.nav-link.active');
                    tabNavActiveEl.classList.remove('active');
                    el.classList.add('active');
                    me.navTabSwiper.slideTo(i);
                }
                if ( tabNavEl.classList.contains('swiper-container') ) {
                    me.navTabItemSwiper.slideTo(i, 0);
                }
            });
        });
    };
    me.init();

    return me;
}
function youtubePlayer(target) {
    var $this = $(target);
    var videoId = $this.find('.video__iframe').attr('id');
    var videoYoutubeId = $this.find('.video__iframe').data('video-id');
    var videoCover = $this.find('.video__cover');

    var player = new YT.Player(videoId, {
        videoId: videoYoutubeId,
        events: {
            onReady: onPlayerReady
        }
    });

    function onPlayerReady(event) {
        gsap.to(videoCover, {
            autoAlpha: 0,
            onComplete: function () {
                videoCover.remove();
            }
        });
        event.target.playVideo();
    }
}
var uiGlobalSearch = {
    openInteraction: function() {
        gsap.to('#globalSearch .modal-content', {top: 0, duration: 0.4, ease: 'power3.out'});
    },
    closeCallback: function () {
        gsap.set('#globalSearch .modal-content', {top: '-100%'});
    }
}
var modalRoomSwiper = new Swiper('#modal-room .swiper-container', {
    slidesPerView: 'auto',
    freeMode: true,
    scrollbar: {
        el: '#modal-room .slide-scrollbar',
        draggable: true,
    },
});
var modalRoom = {
    openInteraction: function () {
        $('#modal-room .swiper-wrapper').imagesLoaded()
            .done( function( instance ) {
                modalRoomSwiper.update();
                setTimeout(function (){
                    modalRoomSwiper.update();
                }, 1);
            });
    },
    closeCallback: function () {
        // modalRoomSwiper.setTranslate(0);
    }
}
var modalDrawing = {
    openInteraction: function () {
        new Swiper('#modal-drawing .swiper-container', {
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '#modal-drawing .slide-scrollbar',
                draggable: true,
            },
        })
    }
}
var modalTownMap = {
    swiper: null,
    open: function () {
        this.swiper = new Swiper('#modal-town-map .modal-content.active .swiper-container', {
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '#modal-town-map .modal-content.active .slide-scrollbar',
                draggable: true,
            },
        });
    },
    close: function () {
        this.swiper.destroy();
    }
}
var modalCheckin = {
    openCallback: function () {
        if ( document.querySelector('.swiper-container.slide-free') ) {
            new Swiper('#modal-checkin .swiper-container.slide-free', {
                spaceBetween: 10,
                slidesPerView: 'auto',
                freeMode: true
            });
        }
        if ( document.querySelector('#checkinContent') ) {
            $('#modal-checkin [name="smartCheckin"]').on('change', function () {
                $('#modal-checkin #checkinSelected').removeClass('d-none');
            });
            navTab(document.querySelector('#checkinContent'));
        }
    },
}
function ModalSlide(target) {
    this.swiper = null;
    this.el = null;
    this.open = function () {
        this.el = document.querySelector(target);
        this.swiper = new Swiper(this.el.querySelector('.modal-content.active .swiper-container'), {
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: this.el.querySelector('.modal-content.active .slide-scrollbar'),
                draggable: true,
            },
        });
    };
    this.close = function () {
        this.swiper.destroy();
    }
}
var defaultModalSlide = new ModalSlide('#modal-slide');
function smoothScroll(content, viewport, smoothness) {
    content = gsap.utils.toArray(content)[0];
    smoothness = smoothness || 0.5;

    gsap.set(viewport || content.parentNode, {overflow: "hidden", position: "fixed", height: "100%", width: "100%", top: 0, left: 0, right: 0, bottom: 0});
    gsap.set(content, {overflow: "visible", width: "100%"});

    let getProp = gsap.getProperty(content),
        setProp = gsap.quickSetter(content, "y", "px"),
        setScroll = ScrollTrigger.getScrollFunc(window),
        removeScroll = () => content.style.overflow = "visible",
        killScrub = trigger => {
            let scrub = trigger.getTween ? trigger.getTween() : gsap.getTweensOf(trigger.animation)[0]; // getTween() was added in 3.6.2
            scrub && scrub.kill();
            trigger.animation.progress(trigger.progress);
        },
        height, width, isProxyScrolling;

    function onResize() {
        width = content.clientWidth;
        height = content.clientHeight;
        content.style.overflow = "visible";
        document.body.style.height = height + "px";
    }
    onResize();
    ScrollTrigger.addEventListener("refreshInit", onResize);
    ScrollTrigger.addEventListener("refresh", () => {
        removeScroll();
        requestAnimationFrame(removeScroll);
    })
    ScrollTrigger.defaults({scroller: content});
    ScrollTrigger.prototype.update = p => p; // works around an issue in ScrollTrigger 3.6.1 and earlier (fixed in 3.6.2, so this line could be deleted if you're using 3.6.2 or later)

    ScrollTrigger.scrollerProxy(content, {
        scrollTop(value) {
            if (arguments.length) {
                isProxyScrolling = true; // otherwise, if snapping was applied (or anything that attempted to SET the scroll proxy's scroll position), we'd set the scroll here which would then (on the next tick) update the content tween/ScrollTrigger which would try to smoothly animate to that new value, thus the scrub tween would impede the progress. So we use this flag to respond accordingly in the ScrollTrigger's onUpdate and effectively force the scrub to its end immediately.
                setProp(-value);
                setScroll(value);
                return;
            }
            return -getProp("y");
        },
        getBoundingClientRect() {
            return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
        }
    });

    return ScrollTrigger.create({
        animation: gsap.fromTo(content, {y:0}, {
            y: () => document.documentElement.clientHeight - height,
            ease: "none",
            onUpdate: ScrollTrigger.update
        }),
        scroller: window,
        invalidateOnRefresh: true,
        start: 0,
        end: () => height - document.documentElement.clientHeight,
        scrub: smoothness,
        onUpdate: self => {
            if (isProxyScrolling) {
                killScrub(self);
                isProxyScrolling = false;
            }
        },
        onRefresh: killScrub
        // when the screen resizes, we just want the animation to immediately go to the appropriate spot rather than animating there, so basically kill the scrub.
    });
}
ScrollTrigger.saveStyles(
    "body, #contents, #contentTop, #navBar"
);
var uiGlobalNav = {
    openInteraction: function() {
        gsap.to('#globalNav .modal-content', {right: 0, delay: 0.2, duration: 0.4, ease: 'power3.out'});
    },
    closeCallback: function () {
        gsap.set('#globalNav .modal-content', {right: '-100%'});
    }
}

function DatePickerTooltip(target, timeOut) {
    var me = this;
    var targetEl = target;
    me.timeOut = setTimeout(function () {
        me.close();
    }, timeOut);
    me.open = function () {
        gsap.to($(targetEl).find('.date-tooltip'), {
            autoAlpha: 1,
            duration: 0.2
        });
    };
    me.close = function () {
        gsap.to($(targetEl).find('.date-tooltip'), {
            autoAlpha: 0,
            duration: 0.2
        });
        clearTimeout(me.timeOut);
    }
}
ScrollTrigger.matchMedia({

    "(min-width: 1024px)": function() {
        // console.log('desktop desktop-large');

        var resizeWinW = window.innerWidth;
        if (winW !== resizeWinW)  window.location.reload();

        var viewportEl = document.querySelector('#viewport');
        var mainHubEl = document.querySelector('body.hub');
        var mainTimesEl = document.querySelector('body.times');
        var topBannerEl = document.querySelector('#topBanner');
        var headerEl = document.querySelector('#header');
        var footerEl = document.querySelector('#footer');
        var toTopEl = document.querySelector('#contentTop');
        if ( headerEl ) {
            var scrollDirection = false;
            var headerH = headerEl.offsetHeight;
            var topBannerH = topBannerEl ? topBannerEl.offsetHeight : null;
            var subHeaderEl = document.querySelector('#subHeaderCategory');
            if ( topBannerEl ) {
                var topBannerCloseBtn = topBannerEl.querySelector('.btn-close');
                bodyEl.classList.add('has-topBanner');
                if ( topBannerEl.style.display === 'none' ) bodyEl.classList.remove('has-topBanner');
                topBannerCloseBtn.addEventListener('click', function () {
                    topBannerEl.style.display = 'none';
                    topBannerH = 0;
                    headerH = headerEl.offsetHeight;
                    viewportEl.style.paddingTop = headerH + 'px';
                    footerEl.style = '';
                    bodyEl.classList.remove('has-topBanner');
                    if ( subHeaderEl ) gsap.set('#subHeaderCategory', {top: headerH});
                    if ( !mainHubEl && !mainTimesEl ) reInitSmoothScroll();
                });
            }
            ScrollTrigger.addEventListener("refreshInit", function () {
                // vh = window.innerHeight * 0.01;
                // document.documentElement.style.setProperty('--vh', `${vh}px`);

                headerH = headerEl.offsetHeight;
                if ( topBannerEl ) {
                    topBannerH = topBannerEl.offsetHeight;
                    viewportEl.style.paddingTop = headerH+'px';
                    if (!mainHubEl) footerEl.style.paddingBottom = '130px';
                }
                if ( scrollDirection === true ) {
                    gsap.set('#header', {top: -headerH});
                    if ( subHeaderEl ) gsap.set('#subHeaderCategory', {top: 0});
                } else {
                    gsap.set('#header', {top: 0});
                    if ( subHeaderEl ) gsap.set('#subHeaderCategory', {top: headerH});
                }
            });

            ScrollTrigger.create({
                onUpdate: function(self) {
                    // -1 = down 1 = up
                    if ( self.direction === 1 ) {   // down
                        if ( scrollDirection === false ) {
                            gsap.to('#header', {
                                duration: 0.3,
                                top: -headerH,
                                ease: Power3.out,
                                scrollTrigger: {
                                    trigger: "body",
                                    toggleClass: {
                                        targets: "#header",
                                        className: 'header-black',
                                    },
                                    start: `${headerH} top`,
                                    // markers: true,
                                }
                            });
                            if ( subHeaderEl ) {
                                gsap.to('#subHeaderCategory', {
                                    duration: 0.3,
                                    top: 0,
                                    ease: Power3.out,
                                    scrollTrigger: {
                                        trigger: "body",
                                        start: `${headerH} top`,
                                        // markers: true,
                                    }
                                });
                            }
                        }
                        scrollDirection = true;
                    } else {    // up
                        if ( scrollDirection === true ) {
                            if ( topBannerEl ) {
                                gsap.to('#header', {
                                    duration: 0.3,
                                    top: -topBannerH,
                                    ease: Power3.out,
                                    scrollTrigger: {
                                        trigger: "body",
                                        start: `${headerH} top`,
                                        onLeaveBack: function () {
                                            gsap.to(headerEl, {duration: 0.3, top: 0, ease: Power3.out});
                                            if ( subHeaderEl ) gsap.to('#subHeaderCategory', {duration: 0.3, top: headerH, ease: Power3.out});
                                        }
                                        // markers: true,
                                    }
                                });
                                if ( subHeaderEl ) gsap.to('#subHeaderCategory', {duration: 0.3, top: headerH-topBannerH, ease: Power3.out});
                            } else {
                                gsap.to('#header', {duration: 0.3, top: 0, ease: Power3.out});
                                if ( subHeaderEl ) gsap.to('#subHeaderCategory', {duration: 0.3, top: headerH, ease: Power3.out});
                            }
                        }
                        scrollDirection = false;
                    }
                }
            });

            var headerLayerEl = headerEl.querySelector('.header-nav__layer');
            if ( headerLayerEl ) {
                gsap.utils.toArray(".header-nav .header-nav__item").forEach((el, i) => {
                    el.addEventListener('mouseenter', function () {
                        if ( el.querySelector('.header-nav__layer') ) {
                            gsap.to(el.querySelector('.header-nav__layer'), {
                                duration: 0.3,
                                autoAlpha: 1,
                                ease: Power3.out,
                            });
                        }
                    });
                    el.addEventListener('mouseleave', function () {
                        if ( el.querySelector('.header-nav__layer') ) {
                            gsap.to(el.querySelector('.header-nav__layer'), {
                                duration: 0.3,
                                autoAlpha: 0,
                                ease: Power3.out,
                            });
                        }
                    });
                });
            }
        }
        if (toTopEl) {
            gsap.to('#contentTop', {
                autoAlpha: 1,
                x: 0,
                duration: 0.4,
                scrollTrigger: {
                    trigger: "body",
                    start: "600px top",
                    end: "600px top",
                    toggleActions: "play none reverse none",
                    // markers: true,
                }
            });
        }
        ScrollTrigger.addEventListener("refreshInit", function () {
            vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        });
        var listParallax = $('.list-parallax__item');
        if ( listParallax ) {
            listParallax.on('mouseenter', function () {
                gsap.to($(this).children('.list-parallax__img'), {
                    duration: 0.5,
                    scale: 1.06,
                });
            });
            listParallax.on('mouseleave', function () {
                gsap.to($(this).children('.list-parallax__img'), {
                    duration: 0.5,
                    scale: 1,
                });
            });
        }

        $('.form-select').formSelect();

        $('#contentTop, #footer .content-top').on('click', function () {
            gsap.to(window, {scrollTo: 0, duration: 0.8, ease: "power4.out"});
        });

        if ( !mainHubEl && !mainTimesEl ) smoothScroll("#contents");
    },

    "(max-width: 1023px)": function() {
        console.log('mobile tablet');

        var resizeWinW = window.innerWidth;
        if (winW !== resizeWinW) window.location.reload();

        var viewportEl = document.querySelector('#viewport');
        var headerEl = document.querySelector('#header');
        var subHeaderEl = document.querySelector('#subHeader');
        var topBannerEl = document.querySelector('#topBanner'),
            topBannerH;
        var toTopEl = document.querySelector('#contentTop');
        var appUtilBtnEl = document.querySelector('#appUtilsBtn');
        var navBarEl = document.querySelector('#navBar:not(.btn-group)'),
            navBarBtnGroupEl = document.querySelector('#navBar.btn-group');
        var subHeaderCategoryEl = document.querySelector('#subHeaderCategory');
        if ( headerEl ) {
            var headerH = headerEl.offsetHeight;
        }
        if ( topBannerEl ) {
            topBannerH = topBannerEl.offsetHeight;
            // viewportEl.style.paddingTop = topBannerH+'px';
            bodyEl.classList.add('has-topBanner');
            if ( topBannerEl.style.display === 'none' ) bodyEl.classList.remove('has-topBanner');
            // if (subHeaderEl) subHeaderEl.style.top = topBannerH+'px';
            var topBannerCloseBtn = topBannerEl.querySelector('.btn-close');
            topBannerCloseBtn.addEventListener('click', function () {
                topBannerEl.style.display = "none";
                topBannerH = 0;
                // viewportEl.style.paddingTop = 0;
                bodyEl.classList.remove('has-topBanner');
                // if (subHeaderEl) subHeaderEl.style.top = 0;
                ScrollTrigger.refresh();
            });
        }
        if ( navBarEl ) {
            var navBarH = navBarEl.offsetHeight + 1;    // +1 = box shadow value
        } else {
            if ( navBarBtnGroupEl ) {
                if ( appUtilBtnEl ) gsap.set(appUtilBtnEl, {bottom: 94});
                gsap.set('#contentTop', {bottom: 94});
            } else {
                if ( appUtilBtnEl ) gsap.set(appUtilBtnEl, {bottom: 94});
                gsap.set('#contentTop', {bottom: 24});
            }
        }
        if ( subHeaderEl ) {
            ScrollTrigger.create({
                trigger: "body:not(.village) #subHeader",
                // pin: "#subHeader",
                start: "top top",
                end: "max",
                toggleClass: "fixed",
                // markers: true
            });
        }
        if ( subHeaderCategoryEl ) {
            ScrollTrigger.create({
                trigger: "body:not(.village) #subHeaderCategory",
                start: "top top",
                end: "max",
                toggleClass: "fixed",
                // markers: true
            });
        }
        var scrollDirection = false, toTopClick = false;
        ScrollTrigger.create({
            onUpdate: function (self) {
                // -1 = down 1 = up
                if (self.direction === 1) {   // down
                    if (scrollDirection === false) {
                        if ( headerEl ) {
                            gsap.to('#header', {
                                duration: 0.3,
                                top: -headerH,
                                ease: Power3.out,
                                scrollTrigger: {
                                    trigger: "body",
                                    toggleClass: {
                                        targets: "#header",
                                        className: 'header-black',
                                    },
                                    start: `${headerH} top`,
                                }
                            });
                        }
                        if ( navBarEl && !toTopClick ) {
                            gsap.to('#navBar:not(.btn-group)', {duration: 0.3, bottom: -navBarH, ease: Power3.out});
                            gsap.to('#contentTop', {duration: 0.3, y: navBarH, ease: Power3.out});
                            if ( appUtilBtnEl ) gsap.to(appUtilBtnEl, {duration: 0.3, y: navBarH, ease: Power3.out});
                        }
                    }
                    scrollDirection = true;
                } else {    // up
                    if (scrollDirection === true && !toTopClick) {
                        if ( headerEl ) {
                            if ( topBannerEl ) {
                                gsap.to('body.has-topBanner #header', {
                                    duration: 0.3,
                                    top: -topBannerH,
                                    ease: Power3.out,
                                    scrollTrigger: {
                                        trigger: "body",
                                        start: `${headerH} top`,
                                        onLeaveBack: function () {
                                            gsap.to(headerEl, {duration: 0.3, top: 0, ease: Power3.out});
                                        }
                                        // markers: true,
                                    }
                                });
                            } else {
                                gsap.to('#header', {duration: 0.3, top: 0, ease: Power3.out});
                            }
                        }
                        if ( navBarEl ) {
                            gsap.to('#navBar:not(.btn-group)', {duration: 0.3, bottom: 0, ease: Power3.out});
                            gsap.to('#contentTop', {duration: 0.3, y: 0, ease: Power3.out});
                            if ( appUtilBtnEl ) gsap.to(appUtilBtnEl, {duration: 0.3, y: 0, ease: Power3.out});
                        }
                    }
                    scrollDirection = false;
                }
            }
        });
        if (toTopEl) {
            gsap.to('#contentTop', {
                autoAlpha: 1,
                x: 0,
                duration: 0.4,
                scrollTrigger: {
                    trigger: "body",
                    start: "400px top",
                    end: "400px top",
                    toggleActions: "play none reverse none",
                    // markers: true,
                }
            });
            if ( appUtilBtnEl ) {
                gsap.to(appUtilBtnEl, {
                    bottom: 164,
                    duration: 0.4,
                    scrollTrigger: {
                        trigger: "body",
                        start: "400px top",
                        end: "400px top",
                        toggleActions: "play none reverse none",
                        // markers: true,
                    }
                });
            }
        }

        $('#contentTop, #footer .content-top').on('click', function () {
            toTopClick = true;
            gsap.to(window, {
                scrollTo: 0, duration: 0.8, ease: "power4.out",
                onComplete: function () {
                    if ( headerEl ) {
                        gsap.to('#header', {duration: 0.3, top: 0, ease: Power3.out});
                    }
                    if ( navBarEl ) {
                        gsap.to('#navBar:not(.btn-group)', {duration: 0.3, bottom: 0, ease: Power3.out});
                        gsap.to('#contentTop', {duration: 0.3, y: 0, ease: Power3.out});
                        if ( appUtilBtnEl ) gsap.to(appUtilBtnEl, {duration: 0.3, y: 0, ease: Power3.out});
                    }
                    toTopClick = false;
                }
            });
        });
    },

    // all
    "all": function() {
        if ( document.querySelector('.hero .hero-visual') ) {
            const heroVisualTl = gsap.timeline({
                scrollTrigger: {
                    trigger: ".hero",
                    start: "top top",
                    end: "bottom top",
                    scrub: true,
                    invalidateOnRefresh: true
                }
            });
            heroVisualTl.to(".hero:not(.swiper-container) .hero-visual", {
                yPercent: 50,
                ease: "none",
            }, 0);
        }
        gsap.utils.toArray(".list-parallax").forEach((section, i) => {
            section.bg = section.querySelector(".list-parallax__img");

            if (i) {
                section.bg.style.backgroundPosition = `50% ${-innerHeight / 2}px`;

                gsap.to(section.bg, {
                    backgroundPosition: `50% ${innerHeight / 2}px`,
                    ease: "none",
                    scrollTrigger: {
                        trigger: section,
                        scrub: true
                    }
                });
            } else {
                section.bg.style.backgroundPosition = "50% 0px";

                gsap.to(section.bg, {
                    backgroundPosition: `50% ${innerHeight / 2}px`,
                    ease: "none",
                    scrollTrigger: {
                        trigger: section,
                        start: "top top",
                        end: "bottom top",
                        scrub: true,
                    }
                });
            }
        });
    }
});
var swiperDatepicker;
function slideDatepicker() {
    swiperDatepicker = new Swiper('.date-picker__slide .swiper-container', {
        scrollbar: {
            el: '.date-picker__slide .slide-scrollbar',
            draggable: true,
        },
        navigation: {
            nextEl: '.date-picker__slide .slide-next',
            prevEl: '.date-picker__slide .slide-prev',
        },
        spaceBetween: 20,
        slidesPerView: 2,
        breakpoints: {
            767: {
                spaceBetween: 0,
                slidesPerView: 1
            }
        }
    });
}
function slideRoomTypeFunc() {
    if ( $('.slide-roomType').length ) {
        new Swiper('.slide-roomType', {
            spaceBetween: 24,
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.slide-roomType .slide-scrollbar',
                draggable: true,
            },
            breakpoints: {
                1023: {
                    spaceBetween: 10
                }
            }
        });
    }
}
function slideDefaultProgressSwiper() {
    if ( $('.bg-gray .slide-default[data-pagination="progress"]').length ) {
        new Swiper('.slide-default[data-pagination="progress"]', {
            spaceBetween: 30,
            slidesPerView: 3,
            pagination: {
                el: '.bg-gray .slide-default .slide-scrollbar',
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.bg-gray .slide-default[data-pagination="progress"] .slide-next',
                prevEl: '.bg-gray .slide-default[data-pagination="progress"] .slide-prev',
            },
            breakpoints: {
                767: {
                    spaceBetween: 10,
                    slidesPerView: 1
                },
                1023: {
                    spaceBetween: 20,
                    slidesPerView: 2
                },
                1439: {
                    spaceBetween: 24,
                    slidesPerView: 'auto'
                }
            }
        });
    }
}
function slideDefaultContentPrimarySwiper() {
    if ( $('.content-primary .slide-default[data-pagination="progress"]').length ) {
        new Swiper('.content-primary .slide-default[data-pagination="progress"]', {
            spaceBetween: 10,
            slidesPerView: 'auto',
            pagination: {
                el: '.content-primary .slide-default .slide-scrollbar',
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.content-primary .slide-default[data-pagination="progress"] .slide-next',
                prevEl: '.content-primary .slide-default[data-pagination="progress"] .slide-prev',
            },
            breakpoints: {
                767: {
                    spaceBetween: 10,
                    slidesPerView: 1
                },
                1023: {
                    spaceBetween: 20,
                    slidesPerView: 'auto'
                },
            }
        });
    }
}
function slideBoardPoint() {
    if ($('.board-point__slide').length) {
        new Swiper('.board-point__slide', {
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.board-point__slide .slide-scrollbar',
                draggable: true,
            },
        });

        $('.board-point__spot').on('click', function () {
            var $target = $(this).data('spot-target');
            gsap.to(window, {
                duration: 1,
                scrollTo: {
                    y: $target,
                    offsetY: $('#subHeader').outerHeight() + 10  // 10 = 그냥 간격
                },
                ease: 'power3.out'
            });
        });
    }
}
function billboardMain2Tl(target) {
    var journeyFadeUpEl = target.querySelectorAll('.billboard-fadeUp');

    gsap.to(journeyFadeUpEl, {
        duration: 0.8,
        opacity: 1,
        y: 0,
        stagger: 0.1,
        ease: Power3.easeOut,
        scrollTrigger: {
            trigger: target,
            start: "top 90%",
            // markers: true
        }
    });
}
function billboardMain3Tl(target) {
    var journeyFadeUpEl = target.querySelectorAll('.billboard-fadeUp');

    gsap.to(journeyFadeUpEl, {
        duration: 0.8,
        opacity: 1,
        y: 0,
        stagger: 0.1,
        ease: Power3.easeOut,
        scrollTrigger: {
            trigger: target,
            start: "top 90%",
            // markers: true
        }
    });
}
function fixedBoardTrigger(offsetTop) {
    gsap.utils.toArray(".fixed-board").forEach((el, i) => {
        var target = el.getAttribute('data-rail-target');
        var boardH = el.offsetHeight;
        ScrollTrigger.create({
            trigger: target,
            pin: el,
            start: "+="+offsetTop+"px top",
            end: "bottom-="+boardH+"px top",
            toggleClass: {targets: el, className: "fixed"},
            // markers: true,
        });
    });
}

// s : 플로팅 키 클릭시 삼각함수 이용 하위 메뉴 원형 배치
function appUtilsCircleXY($el, degrees, r) {
    let sin = Math.sin((degrees * Math.PI) / 180);
    let cos = Math.cos((degrees * Math.PI) / 180);
    let x, y;
    x = cos * r;
    y = sin * r;
    $el.css({ top: y + 'px', left: x + 'px' });
}
function appUtilsOpen() {
    let $appUtilsBtn = $('#appUtilsBtn');
    $('body').addClass('__floating-button');
    gsap.to($appUtilsBtn, {
        right: '-30vw',
        rotate: 405
    });

    let deg = 90;
    let thisCount = $('#appUtils .appUtils__list > li').length;
    $('#appUtils .appUtils__list > li').each(function () {
        appUtilsCircleXY($(this), deg, 120);
        deg += 180 / (thisCount - 1);
    });
}
$(window).on('load', function () {
    // globalLoader.stop(loaderStopFunc);
    stopSpinLoader(loaderStopFunc);
    function loaderStopFunc() {
        // Fade Up Tween //
        var itemFadeEls = $('.fade');
        itemFadeEls.each(function (index, element) {
            var $this = $(element);
            var textTl = gsap.timeline({
                scrollTrigger: {
                    trigger: element,
                    start: "top 95%",
                    // markers: true
                }
            });
            textTl
                .to($this.find('.fade__item'), {
                    duration: 1,
                    stagger: 0.1,
                    opacity: 1,
                    ease: Power3.easeOut,
                });
        });
        // Fade Tween //
        var itemFadeUpEls = $('.fadeUp');
        itemFadeUpEls.each(function (index, element) {
            var $this = $(element);
            var textTl = gsap.timeline({
                scrollTrigger: {
                    trigger: element,
                    start: "top 95%",
                    // markers: true
                }
            });
            textTl
                .to($this.find('.fadeUp__item'), {
                    duration: 0.8,
                    stagger: 0.1,
                    opacity: 1,
                    y: 0,
                    ease: Power3.easeOut,
                });
        });
        // Slide Fade Tween //
        var slideFadeUpEls = $('.slide-fadeIn');
        if ( slideFadeUpEls.length ) {
            slideFadeUpEls.each(function (index, element) {
                var slideRoomTypeTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: element,
                        start: "top 95%",
                        // markers: true
                    }
                });
                slideRoomTypeTl
                    .to($(element).find('.swiper-slide'), {
                        duration: 0.8,
                        stagger: 0.2,
                        opacity: 1,
                        x: 0,
                        ease: Power3.easeOut,
                    })
                    .to($(element).find('.slide-scrollbar'), {
                        duration: 0.6,
                        opacity: 1,
                        ease: Power3.easeOut,
                    }, '-=0.5');
            });
        }

        // if ( document.querySelector('.main-brand') ) {
        //     brandMainHero.on('slideChange', function () {
        //         console.log('slide changed');
        //     });
        // }
    }

    var interleaveOffset = 1;
    if ( document.querySelector('.main-brand') ) {
        var brandMainHeroLeft, brandMainHeroRight;
        var heroSlideWrapEl = document.querySelector('.billboard-hero');
        var heroSlideEl = document.querySelector('.billboard-hero .billboard-hero__center');
        var heroSlideLeftEl = document.querySelector('.billboard-hero .billboard-hero__left');

        var heroFractionEl = document.querySelector('.billboard-hero .slide-fraction');
        var heroSlideEls = heroSlideEl.querySelectorAll('.swiper-slide'),
            heroSlideLen = heroSlideEls.length;
        var heroFractionTotalEl = heroFractionEl.querySelector('.slide-fraction__length');
        var heroFractionIndexEl = heroFractionEl.querySelector('.slide-fraction__active');
        heroFractionTotalEl.innerText = heroSlideLen;
        var brandMainHero = new Swiper('.billboard-hero .billboard-hero__center', {
            speed: 1000,
            loop: true,
            watchSlidesProgress: true,
            autoplay: {
                delay: 4000,
                autoplayDisableOnInteraction: true,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.billboard-hero .btn-next',
                prevEl: '.billboard-hero .btn-prev',
            },
            pagination: {
                el: '.billboard-hero .billboard-hero__center .slide-scrollbar',
                type: 'progressbar'
            },
            allowTouchMove: false,
            breakpoints: {
                1023: {
                    allowTouchMove: true,
                }
            },
            on: {
                init: function () {
                    heroFractionIndexEl.innerText = this.realIndex + 1;
                    gsap.to('.billboard-hero .slide-controls', {opacity: 1});
                    var fadeUpItem = $(this.$el).find('.swiper-slide-active .fadeUp__item');
                    gsap.to(fadeUpItem, {
                        duration: 1,
                        opacity: 1,
                        y: 0,
                        stagger: 0.1,
                        ease: Power3.easeOut
                    });

                    gsap.set($(this.$el).find('.swiper-slide-duplicate-active .fadeUp__item'), {
                        opacity: 1,
                        y: 0,
                    });
                },
                transitionEnd: function () {
                    heroFractionIndexEl.innerText = this.realIndex + 1;
                    var fadeUpItem = $(this.$el).find('.swiper-slide-active .fadeUp__item');
                    gsap.to(fadeUpItem, {
                        duration: 1,
                        opacity: 1,
                        y: 0,
                        stagger: 0.1,
                        ease: Power3.easeOut
                    });
                },
                progress: function() {
                    var _this = this;
                    var i, slideProgress, innerOffset, innerTranslate;
                    for (i = 0; i < _this.slides.length; i++) {
                        slideProgress = _this.slides[i].progress;
                        innerOffset = _this.width * interleaveOffset;
                        innerTranslate = slideProgress * innerOffset;
                        _this.slides[i].querySelector(".billboard-hero__inner").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },
                touchStart: function() {
                    var _this = this;
                    var i;
                    for (i = 0; i < _this.slides.length; i++) {
                        _this.slides[i].style.transition = "";
                    }
                },
                setTransition: function(speed) {
                    var _this = this;
                    var i;
                    for (i = 0; i < _this.slides.length; i++) {
                        _this.slides[i].style.transition = speed + "ms";
                        _this.slides[i].querySelector(".billboard-hero__inner").style.transition =
                            speed + "ms";
                    }
                }
            }
        });
        heroSlideWrapEl.addEventListener('mouseenter', function () {
            brandMainHero.autoplay.stop();
        });
        heroSlideWrapEl.addEventListener('mouseleave', function () {
            brandMainHero.autoplay.start();
        });
        ScrollTrigger.matchMedia({
            "(min-width: 1024px)": function() {
                var heroSlideLeftEls = heroSlideLeftEl.querySelectorAll('.swiper-slide'),
                    heroSlideLeftLen = heroSlideLeftEls.length;
                brandMainHeroLeft = new Swiper('.billboard-hero .billboard-hero__left', {
                    initialSlide: heroSlideLeftLen-1,
                    speed: 1000,
                    loop: true,
                    allowTouchMove: false,
                    watchSlidesProgress: true,
                    autoplay: {
                        delay: 4000,
                        autoplayDisableOnInteraction: true,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.billboard-hero .btn-next',
                        prevEl: '.billboard-hero .btn-prev',
                    },
                    on: {
                        init: function () {
                            var _this = this;
                            _this.$el[0].classList.add('swiper-initialized');
                        },
                        progress: function() {
                            var swiper = this;
                            for (var i = 0; i < swiper.slides.length; i++) {
                                var slideProgress = swiper.slides[i].progress;
                                var innerOffset = swiper.width * interleaveOffset;
                                var innerTranslate = slideProgress * innerOffset;
                                swiper.slides[i].querySelector(".billboard-hero__inner").style.transform =
                                    "translate3d(" + innerTranslate + "px, 0, 0)";
                            }
                        },
                        touchStart: function() {
                            var _this = this;
                            var i;
                            for (i = 0; i < _this.slides.length; i++) {
                                _this.slides[i].style.transition = "";
                            }
                        },
                        setTransition: function(speed) {
                            var swiper = this;
                            for (var i = 0; i < swiper.slides.length; i++) {
                                swiper.slides[i].style.transition = speed + "ms";
                                swiper.slides[i].querySelector(".billboard-hero__inner").style.transition =
                                    speed + "ms";
                            }
                        }
                    }
                });
                brandMainHeroRight = new Swiper('.billboard-hero .billboard-hero__right', {
                    initialSlide: 1,
                    speed: 1000,
                    loop: true,
                    allowTouchMove: false,
                    watchSlidesProgress: true,
                    autoplay: {
                        delay: 4000,
                        autoplayDisableOnInteraction: true,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.billboard-hero .btn-next',
                        prevEl: '.billboard-hero .btn-prev',
                    },
                    on: {
                        init: function () {
                            var _this = this;
                            _this.$el[0].classList.add('swiper-initialized');
                        },
                        progress: function() {
                            var swiper = this;
                            for (var i = 0; i < swiper.slides.length; i++) {
                                var slideProgress = swiper.slides[i].progress;
                                var innerOffset = swiper.width * interleaveOffset;
                                var innerTranslate = slideProgress * innerOffset;
                                swiper.slides[i].querySelector(".billboard-hero__inner").style.transform =
                                    "translate3d(" + innerTranslate + "px, 0, 0)";
                            }
                        },
                        touchStart: function() {
                            var _this = this;
                            var i;
                            for (i = 0; i < _this.slides.length; i++) {
                                _this.slides[i].style.transition = "";
                            }
                        },
                        setTransition: function(speed) {
                            var swiper = this;
                            for (var i = 0; i < swiper.slides.length; i++) {
                                swiper.slides[i].style.transition = speed + "ms";
                                swiper.slides[i].querySelector(".billboard-hero__inner").style.transition =
                                    speed + "ms";
                            }
                        }
                    }
                });
                heroSlideWrapEl.addEventListener('mouseenter', function () {
                    brandMainHeroLeft.autoplay.stop();
                    brandMainHeroRight.autoplay.stop();
                });
                heroSlideWrapEl.addEventListener('mouseleave', function () {
                    brandMainHeroLeft.autoplay.start();
                    brandMainHeroRight.autoplay.start();
                });
            },
            "(max-width: 1023px)": function() {
                if ( heroSlideLeftEl.classList.contains('swiper-initialized') ) {
                    brandMainHeroLeft.destroy();
                    brandMainHeroRight.destroy();
                }
            }
        });
        if ( document.querySelectorAll('.primary-board .swiper-container .swiper-slide').length > 1 ) {
            new Swiper('.primary-board .swiper-container', {
                loop: true,
                spaceBetween: 0,
                // autoplay: true,
                navigation: {
                    nextEl: '.primary-board .slide-next',
                    prevEl: '.primary-board .slide-prev',
                },
                pagination: {
                    el: '.primary-board .slide-fraction',
                    type: 'fraction'
                },
                breakpoints: {
                    1023: {
                        spaceBetween: 10,
                    },
                },
                on: {
                    init: function () {
                        this.$el[0].classList.add('swiper-initialized');
                    }
                }
            });
        }
    }
    if ( document.querySelector('.main-hub') ) {
        var hubHeroSlideEl = document.querySelector('.billboard-hero .swiper-container');

        var hubHeroFractionEl = document.querySelector('.billboard-hero .slide-fraction');
        var hubHeroSlideEls = hubHeroSlideEl.querySelectorAll('.swiper-slide'),
            hubHeroSlideLen = hubHeroSlideEls.length;
        var hubHeroFractionTotalEl = hubHeroFractionEl.querySelector('.slide-fraction__length');
        var hubHeroFractionIndexEl = hubHeroFractionEl.querySelector('.slide-fraction__active');
        hubHeroFractionTotalEl.innerText = hubHeroSlideLen;
        var hubMainHero = new Swiper('.billboard-hero .swiper-container', {
            speed: 1000,
            loop: true,
            watchSlidesProgress: true,
            autoplay: {
                delay: 4000,
                autoplayDisableOnInteraction: true,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.billboard-hero .btn-next',
                prevEl: '.billboard-hero .btn-prev',
            },
            pagination: {
                el: '.billboard-hero .slide-scrollbar',
                type: 'progressbar'
            },
            on: {
                init: function () {
                    hubHeroFractionIndexEl.innerText = this.realIndex + 1;
                    gsap.to('.billboard-hero .slide-controls', {opacity: 1});
                    var fadeUpItem = $(this.$el).find('.swiper-slide-active .fadeUp__item');
                    gsap.to(fadeUpItem, {
                        duration: 1,
                        opacity: 1,
                        y: 0,
                        stagger: 0.1,
                        ease: Power3.easeOut
                    });

                    gsap.set($(this.$el).find('.swiper-slide-duplicate-active .fadeUp__item'), {
                        opacity: 1,
                        y: 0,
                    });
                },
                transitionEnd: function () {
                    hubHeroFractionIndexEl.innerText = this.realIndex + 1;
                    var fadeUpItem = $(this.$el).find('.swiper-slide-active .fadeUp__item');
                    gsap.to(fadeUpItem, {
                        duration: 1,
                        opacity: 1,
                        y: 0,
                        stagger: 0.1,
                        ease: Power3.easeOut
                    });
                },
                progress: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        var slideProgress = swiper.slides[i].progress;
                        var innerOffset = swiper.width * interleaveOffset;
                        var innerTranslate = slideProgress * innerOffset;
                        swiper.slides[i].querySelector(".billboard-hero__inner").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },
                touchStart: function() {
                    var _this = this;
                    var i;
                    for (i = 0; i < _this.slides.length; i++) {
                        _this.slides[i].style.transition = "";
                    }
                },
                setTransition: function(speed) {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = speed + "ms";
                        swiper.slides[i].querySelector(".billboard-hero__inner").style.transition =
                            speed + "ms";
                    }
                }
            }
        });
        hubHeroSlideEl.addEventListener('mouseenter', function () {
            hubMainHero.autoplay.stop();
        });
        hubHeroSlideEl.addEventListener('mouseleave', function () {
            hubMainHero.autoplay.start();
        });
        var mainJourney1Msnry = new Masonry( '#mainJourney', {
            itemSelector: '.billboard-item',
            transitionDuration: 0,
            horizontalOrder: true
        });
        // var mainJourney2Msnry = new Masonry( '#hubRail1', {
        //     itemSelector: '.billboard-item',
        //     transitionDuration: 0,
        //     horizontalOrder: true
        // });
        var mainJourney3Msnry = new Masonry( '#hubRail2', {
            itemSelector: '.billboard-item',
            transitionDuration: 0,
            horizontalOrder: true
        });
        var membershipSlide;
        function destroyMembershipSlide() {
            var membershipSlideEl = document.querySelector('.billboard-membership .swiper-container');
            if ( membershipSlideEl.classList.contains('swiper-initialized') ) {
                membershipSlide.destroy();
                membershipSlideEl.classList.remove('swiper-initialized');
            }
        }
        function initMembershipSlide() {
            membershipSlide = new Swiper('.billboard-membership .swiper-container', {
                spaceBetween: 10,
                slidesPerView: 2,
                breakpoints: {
                    767: {
                        slidesPerView: 1
                    }
                },
                on: {
                    init: function () {
                        var _this = this;
                        _this.$el[0].classList.add('swiper-initialized');
                    }
                }
            });
        }
        ScrollTrigger.matchMedia({
            "(min-width: 1440px)": function() {
                fixedBoardTrigger(80);
                destroyMembershipSlide();
            },
            "(min-width: 1024px) and (max-width: 1439px)": function() {
                fixedBoardTrigger(60);
                destroyMembershipSlide();
            },
            // small
            "(min-width: 768px) and (max-width: 1023px)": function() {
                fixedBoardTrigger(50);
                initMembershipSlide();
            },
            // xsmall
            "(max-width: 767px)": function() {
                initMembershipSlide();
            }
        });
        // ScrollTrigger.matchMedia({
        //     "(min-width: 768px)": function() {
        //         var scrollDirection = false;
        //         var headerEl = document.querySelector('#header');
        //         var headerH = headerEl.offsetHeight;
        //         ScrollTrigger.create({
        //             onUpdate: function(self) {
        //                 // -1 = down 1 = up
        //                 if ( self.direction === 1 ) {   // down
        //                     if ( scrollDirection === false ) {
        //                         gsap.to('.fixed-board.fixed', {
        //                             duration: 0.3,
        //                             top: 0,
        //                             ease: Power3.out,
        //                         });
        //                     }
        //                     scrollDirection = true;
        //                 } else {    // up
        //                     if ( scrollDirection === true ) {
        //                         gsap.to('.fixed-board.fixed', {
        //                             duration: 0.3,
        //                             top: headerH,
        //                             ease: Power3.out,
        //                         });
        //                     }
        //                     scrollDirection = false;
        //                 }
        //             }
        //         });
        //     },
        // });

        gsap.utils.toArray('.billboard-main__title').forEach(function(el, i) {
            var journeyLineEl = el.querySelector('.text-highlight__line');
            var textTl = gsap.timeline({
                scrollTrigger: {
                    trigger: el,
                    start: "top 95%",
                    // markers: true
                }
            });
            textTl
                .to(el, {
                    duration: 0.6,
                    opacity: 1,
                    y: 0,
                    ease: Power3.easeOut,
                })
                .to(journeyLineEl, {
                    duration: 0.5,
                    scaleX: 1
                }, '-=0.2');
        });
        gsap.utils.toArray('.billboard-main-1 .billboard').forEach(function(el, i) {
            var journeyFadeUpEl = el.querySelectorAll('.billboard-fadeUp');

            gsap.to(journeyFadeUpEl, {
                duration: 0.8,
                opacity: 1,
                y: 0,
                stagger: 0.1,
                ease: Power3.easeOut,
                scrollTrigger: {
                    trigger: el,
                    start: "top 95%",
                    // markers: true
                }
            });
        });
        // gsap.to('.billboard-membership .card-banner', {
        //     duration: 0.8,
        //     opacity: 1,
        //     x: 0,
        //     stagger: 0.2,
        //     ease: Power3.easeOut,
        //     scrollTrigger: {
        //         trigger: '.billboard-membership .swiper-container',
        //         start: "top 95%",
        //         // markers: true
        //     }
        // });
        // gsap.utils.toArray('.fixed-board').forEach(function(el, i) {
        //     var journeyFadeUpEl = el.querySelectorAll('.billboard-fadeUp');
        //
        //     gsap.to(el, {
        //         duration: 0.8,
        //         opacity: 1,
        //         ease: Power3.easeOut,
        //         scrollTrigger: {
        //             trigger: el,
        //             start: "top 90%",
        //             // markers: true
        //         }
        //     });
        //     gsap.to(journeyFadeUpEl, {
        //         duration: 0.8,
        //         opacity: 1,
        //         y: 0,
        //         stagger: 0.1,
        //         ease: Power3.easeOut,
        //         scrollTrigger: {
        //             trigger: el.querySelector('.fixed-board__caption'),
        //             start: "top 95%",
        //             // markers: true
        //         }
        //     });
        // });
        // gsap.utils.toArray('.billboard-main-2 .billboard').forEach(function(el, i) {
        //     billboardMain2Tl(el);
        // });
        // gsap.utils.toArray('.billboard-main-3 .billboard').forEach(function(el, i) {
        //     billboardMain3Tl(el);
        // });
    }

    slideDefaultProgressSwiper();
    slideDefaultContentPrimarySwiper();
    slideRoomTypeFunc();
    slideBoardPoint();

    /* Accordion */
    var accordions = document.querySelectorAll('.accordion__head');
    accordions.forEach(function(element) {
        // var toggleTarget = element.querySelector('.accordion__head');
        element.addEventListener('click', function () {
            var target = element.getAttribute('data-collapse-target');
            var targetEl;
            if (element.classList.contains('active')) {
                element.classList.remove('active');
                if ( target !== null ) {
                    targetEl = document.querySelector(target);
                    targetEl.classList.remove('active');
                }
            } else {
                element.classList.add('active');
                if ( target !== null ) {
                    targetEl = document.querySelector(target);
                    targetEl.classList.add('active');
                }
            }
            reInitSmoothScroll();
        });
    });

    gsap.utils.toArray('.table-container .swiper-container').forEach(function(el, i) {
        var tableScrollBarEl = el.querySelector('.slide-scrollbar');
        new Swiper(el, {
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: tableScrollBarEl,
                draggable: true,
            },
        });
    });

    $('#appUtils .appUtils__close').on('click', function () {
        $('body').removeClass('__floating-button');
        gsap.to('#appUtilsBtn', {
            right: '24px',
            rotate: 0
        });
        $('#appUtils .appUtils__list > li').each(function () {
            $(this).css({ top: '0', left: '0' });
        });
    });
    // e : 플로팅 키 클릭시 삼각함수 이용 하위 메뉴 원형
});