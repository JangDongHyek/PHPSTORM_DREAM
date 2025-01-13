<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/jl/JlConfig.php");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?v=1">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
    #layer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 999;
        background: rgba(255, 255, 255, 0.8);
        /*
        top: 50%!important;
        left: 50%!important;
        transform: translate(-50%,-50%)!important;
        max-width: 300px !important;
        max-height: 500px !important;
*/
    }

    #layer>div {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        max-width: 300px !important;
        max-height: 500px !important;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
    }

    #btnCloseLayer {
        position: absolute;
        right: 0;
        top: 0px;
        padding: 10px 0;
    }

    @media(max-width:768px){
        #layer>div{
            top: 45px !important;
            left: 0 !important;
            transform: unset !important;
        }
    }
</style>
<script type="text/javascript">
    const autoHyphen2 = (target) => {
        target.value = target.value
            .replace(/[^0-9]/g, '')
            .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
    }

</script>
<!-- } 게시물 작성/수정 끝 -->
   <div id="app">
       <bbs-prayer-input pc="true"></bbs-prayer-input>
   </div>

<?php
$jl->vueLoad('app');
$jl->componentLoad("/bbs/prayer");
?>