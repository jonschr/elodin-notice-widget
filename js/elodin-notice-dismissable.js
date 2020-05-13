jQuery(document).ready(function ($) {

    //* by default, with no cookies, show both the bar and the notice
    $('#site-notice').addClass('show');
    $('#site-notice-bar').addClass('show');


    //* if there's a cookie set saying "hide this," then hide the things
    if ($.cookie("notice_hidden") == 'true') {
        $('#site-notice').removeClass('show');
    }

    if ($.cookie("bar_hidden") == 'true') {
        $('#site-notice-bar').removeClass('show');
    }

    //* click events
    // click on the link to close the notice
    $('a.close-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice').removeClass('show');
    });

    // click on the link to open the notice
    $('a.show-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", "false", { expires: 0.25, path: '/' });
        $('#site-notice').addClass('show');
    });

    $('#site-notice .textwidget a').click(function (e) {
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
    });

    // click on the link to close the bar
    $('a.close-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice-bar').removeClass('show');
    });

    // click on the link to open the bar
    $('a.show-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", "false", { expires: 0.25, path: '/' });
        $('#site-notice-bar').addClass('show');
    });

});