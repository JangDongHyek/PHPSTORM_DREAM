<?
include_once('./_common.php');
include_once("../jl/JlConfig.php");
include_once(G5_PATH.'/head.sub.php');
include_once(G5_BBS_PATH.'/board_head.php');

?>

    <div id="app">
        <bbs-prayer-view primary="<?=$_GET['idx']?>" mb_no="<?=$member['mb_no']?>" mb_1="<?=$member['mb_1']?>"></bbs-prayer-view>
    </div>

<?

$jl->vueLoad('app',["swal"]);
$jl->componentLoad("/bbs/prayer");
$jl->componentLoad("/item");


include_once(G5_BBS_PATH.'/board_tail.php');

include_once(G5_PATH.'/tail.sub.php');
?>