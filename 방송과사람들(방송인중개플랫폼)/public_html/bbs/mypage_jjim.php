<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

$name = "cmypage";
$pid = "mypage_jjim";
$g5['title'] = '찜 목록';
include_once('./_head.php');

$sql = "select i.* from new_heart h left join new_item i on h.h_p_idx = i.i_idx order by h_idx desc; ";
$result = sql_query($sql);

$sql_common = " from new_heart h ";
$sql_where = "where h.mb_no = '{$member["mb_no"]}' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common. " {$sql_where} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_1'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select i.* {$sql_common} left join new_item i on h.h_p_idx = i.i_idx {$sql_where} order by h_idx desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
    }
</style>

    <div id="area_mypage" class="jjim">
		<div class="inr">
            <?php include('./mypage_banner.php'); ?>
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

                <div id="app">
                    <product-mypage-like mb_no="<?=$member['mb_no']?>"></product-mypage-like>
                </div>

				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?>
            </div>
		</div>

    </div>


<?
$jl->vueLoad("app");
include_once($jl->ROOT."/component/product/product-mypage-like.php");
include_once('./_tail.php');
?>

