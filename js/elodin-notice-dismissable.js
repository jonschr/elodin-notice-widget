jQuery(document).ready(function ($) {

    $('a.close-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice').addClass('hide');
    });

    $('a.close-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice-bar').addClass('hide');
    });

    $('a.show-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", null, { expires: 0.25, path: '/' });
        $('#site-notice-bar').removeClass('hide');
    });

    $('a.show-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", null, { expires: 0.25, path: '/' });
        $('#site-notice').removeClass('hide');
    });

});