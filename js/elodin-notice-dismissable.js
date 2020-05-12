jQuery(document).ready(function ($) {

    $('#site-notice').addClass('show');
    $('#site-notice-bar').addClass('show');

    if ($.cookie("notice_hidden")) {
        $('#site-notice').removeClass('show');
    }

    if ($.cookie("bar_hidden")) {
        $('#site-notice-bar').removeClass('show');
    }

    $('a.close-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice').removeClass('show');
    });

    $('#site-notice .textwidget a').click(function (e) {
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
    });

    $('a.close-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice-bar').removeClass('show');
    });

    $('a.show-bar').click(function (e) {
        e.preventDefault();
        $.removeCookie("bar_hidden");
        $('#site-notice-bar').addClass('show');
    });

    $('a.show-notice').click(function (e) {
        e.preventDefault();
        $.removeCookie("notice_hidden");
        $('#site-notice').addClass('show');
    });

});