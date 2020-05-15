jQuery(document).ready(function ($) {


    // get the height of the notice bar
    var height = $('#site-notice-bar').outerHeight();

    // add the body padding by default
    $('body').css('padding-bottom', height + 'px');

    //* by default, with no cookies, show both the bar and the notice
    $('#site-notice').addClass('show');
    $('#site-notice-bar').addClass('show');

    //* if there's a cookie set saying "hide this," then hide the things
    if ($.cookie("notice_hidden") == 'true') {
        $('#site-notice').removeClass('show');
    }

    if ($.cookie("bar_hidden") == 'true') {
        $('#site-notice-bar').removeClass('show');
        $('body').css('padding-bottom', '0px');
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
        $('body').css('padding-bottom', '0px');
    });

    // click on the link to open the bar
    $('a.show-bar').click(function (e) {
        e.preventDefault();
        $.cookie("bar_hidden", "false", { expires: 0.25, path: '/' });
        $('#site-notice-bar').addClass('show');

        // get the height of the notice bar
        var height = $('#site-notice-bar').outerHeight();

        // add the body padding by default
        $('body').css('padding-bottom', height + 'px');
    });

});