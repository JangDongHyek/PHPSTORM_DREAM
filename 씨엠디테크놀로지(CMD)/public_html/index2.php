<?php
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/*
if(!ipconfig($ip)){
    goto_url('./_blank/');
}
*/


################### statistics start ###########################
$url_gubun = explode("~",$PHP_SELF);
if($url_gubun[1]!=""){//계정접속
        $url_gubun_ex = explode("/",$url_gubun[1]);
        $account = $url_gubun_ex[0];

}else{//도메인접속
        $account_ex=explode("/",$_SERVER[DOCUMENT_ROOT]);
        $account=$account_ex[2];

}
include("/home/counter/public_html/counter.php");
################### statistics end #############################


/*
if(!ipconfig($ip)){
    goto_url('./_blank/');
}
*/

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>


<?php
include_once(G5_PATH.'/tail.php');
?>
