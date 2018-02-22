/**
 * Created by Raketos - http://raketos.ru on 09.02.2017.
 */
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
            $(header).addClass('navbar-scroll');
        }
        else {
            $(header).addClass('navbar-offset-top');
            $(header).removeClass('navbar-scroll')
        }
        didScroll = false;
    }
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();

})();