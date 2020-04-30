jQuery(document).ready(function ($) {

    $('a.close-notice').click(function (e) {
        e.preventDefault();
        $.cookie("notice_hidden", "true", { expires: 0.25, path: '/' });
        $('#site-notice').hide();
    });

});