json = {
    misc: {
        navbar_menu_visible: 0,
        window_width: 0,
        transparent: true,
        colored_shadows: true,
        fixedTop: false,
        navbar_initialized: false,
        isWindow: document.documentMode || /Edge/.test(navigator.userAgent)
    },
    checkScrollForTransparentNavbar: debounce(function () {
        if ($(document).scrollTop() > scroll_distance) {
            if (json.misc.transparent) {
                json.misc.transparent = false;
                $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                $('.navbar-color-on-scroll').addClass('navbar-dark bg-primary fixed-top');

            }
        } else {
            if (!json.misc.transparent) {
                json.misc.transparent = true;
                $('.navbar-color-on-scroll').addClass('navbar-transparent');
                $('.navbar-color-on-scroll').removeClass('navbar-dark bg-primary fixed-top');
            }
        }
    }, 17)

}

$(document).ready(function () {

    window_width = $(window).width();

    $navbar = $('.navbar[color-on-scroll]');
    scroll_distance = $navbar.attr('color-on-scroll') || 500;
    console.log(scroll_distance);

    $navbar_collapse = $('.navbar').find('.navbar-collapse');

    if ($('.navbar-color-on-scroll').length != 0) {
        $(window).on('scroll', json.checkScrollForTransparentNavbar);
    }

    json.checkScrollForTransparentNavbar();

});

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};
