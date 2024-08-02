<?
include_once('./_common.php');
$g5['title'] = '포트폴리오 상세';
include_once('./_head.php');
include_once("../class/Lib.php");
$name = "portfolio";
$pid = "portfolio";
$jl = new JL();
?>

        <style>
            @media screen and (max-width:1024px) {
                #nav_area{display: none;}
            }
        </style>

<div id="appView">
    <portfolio-view mb_no="<?=$member['mb_no']?>" primary="<?=$_GET['idx']?>"></portfolio-view>
</div>

<?
$jl->vueLoad("appView");
$jl->includeDir("/component/portfolio");
include_once('./_tail.php');
?>

