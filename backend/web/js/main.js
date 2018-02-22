/**
 * Created by Vladimir on 27.12.2016.
 */
/* w4-collapse */
$(document).ready(function () {
    var width = window.innerWidth;
    if (width < 750) {
        $("body").addClass("mini-navbar");
        $(".sidebar-collapse").removeClass("collapse")
    }
});

