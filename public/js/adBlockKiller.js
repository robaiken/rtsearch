/**
 * Created by rob on 02/02/14.
 *
 * $(element).adBlockKiller({
 *           removeElementContent: 'html', // html element to delete and replace with stopMessage
 *           stopMessage: 'Your\'re seeing this message because you have an ad blocker enabled. Please consider turning off your ad blocker on our site. Our adverts are non-intrusive and help us keep the website running without cost. Please <a href="http://removeadblock.com/">click here</a> to find out why you should remove adblock.', // message that displays if user is using adblocker
 *           redirectUrl: null, // url to redirect to
 *           trollPopups: false, // turn off/ on infinite pop ups
 *           trollPopupsMessage: 'stop using adblocker' // message that is displayed in pop up
 * });
 *
 * It is recommend to attach adBlockKiller to the body object
 *
 */
(function ($) {
    $.fn.adBlockKiller = function (options) {

        var settings = $.extend({
            stopMessage: 'Your\'re seeing this message because you have an ad blocker enabled. Please consider turning off your ad blocker on our site. Our adverts are non-intrusive and help us keep the website running without cost. Please <a href="http://removeadblock.com/">click here</a> to find out why you should remove adblock',
            redirectUrl: null,
            trollPopups: false,
            trollPopupsMessage: 'stop using adblocker'
        }, options);

        return this.each(function () {

            $(this).append('<div class="_t c mnr-c" id="tads">These ads are based on your current search terms.</div>');
            if ($('#tads').height() == 0) {
                if( settings.redirectUrl === null ){
                    $(this).html(settings.stopMessage);
                } else {
                    window.location.replace(settings.redirectUrl);
                }

            }
            $('#tads').remove();

            if (settings.trollPopups) {
                while (1 == 1) {
                    alert(settings.trollPopupsMessage);
                }
            }
        });
    }
})(jQuery);