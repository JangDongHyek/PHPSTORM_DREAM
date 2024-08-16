$(function(){
    var hide_menu = false;
    var mouse_event = false;
    var oldX = oldY = 0;

    $(document).mousemove(function(e) {
        if(oldX == 0) {
            oldX = e.pageX;
            oldY = e.pageY;
        }

        if(oldX != e.pageX || oldY != e.pageY) {
            mouse_event = true;
        }
    });

    // 주메뉴
    var $snb = $(".snb_1dli > a");
    $snb.mouseover(function() {
        if(mouse_event) {
            $(".snb_1dli").removeClass("snb_1dli_over snb_1dli_over2 snb_1dli_on");
            $(this).parent().addClass("snb_1dli_over snb_1dli_on");
            hide_menu = false;
        }
    });

    $snb.mouseout(function() {
        hide_menu = true;
    });

    $(".snb_2dli").mouseover(function() {
        hide_menu = false;
    });

    $(".snb_2dli").mouseout(function() {
        hide_menu = true;
    });

    $snb.focusin(function() {
        $(".snb_1dli").removeClass("snb_1dli_over snb_1dli_over2 snb_1dli_on");
        $(this).parent().addClass("snb_1dli_over snb_1dli_on");
        hide_menu = false;
    });

    $snb.focusout(function() {
        hide_menu = true;
    });

    $(".snb_2da").focusin(function() {
        $(".snb_1dli").removeClass("snb_1dli_over snb_1dli_over2 snb_1dli_on");
        var $snb_li = $(this).closest(".snb_1dli").addClass("snb_1dli_over snb_1dli_on");
        hide_menu = false;
    });

    $(".snb_2da").focusout(function() {
        hide_menu = true;
    });

    $('#snb_1dul>li').bind('mouseleave',function(){
        submenu_h_hide();
    });

    $(document).bind('click focusin',function(){
        if(hide_menu) {
            submenu_h_hide();
        }
    });
});

function submenu_h_hide() {
    $(".snb_1dli").removeClass("snb_1dli_over snb_1dli_over2 snb_1dli_on");
}
