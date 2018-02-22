/**
 * Created by Raketos - http://raketos.ru on 09.02.2017.
 */
$(document).ready(function () {

    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 80
    });

    // Page scrolling feature
    $('a.page-scroll').bind('click', function(event) {
        var link = $(this);
        $('html, body').stop().animate({
            scrollTop: $(link.attr('href')).offset().top - 50
        }, 500);
        event.preventDefault();
    });
});

var cbpAnimatedHeader = (function() {
    var docElem = document.documentElement,
        headerTop = document.querySelector( '.navbar-default' ),
        header = document.querySelector( '.navbar-default' ),
        didScroll = false,
        changeHeaderOn = 10;
    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 10 );
            }
        }, false );
    }
    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            $(header).removeClass('navbar-offset-top');
        }
        else {
            $(header).addClass('navbar-offset-top');
        }
        didScroll = false;
    }
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();

})();