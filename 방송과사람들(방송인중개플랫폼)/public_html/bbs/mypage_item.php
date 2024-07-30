<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '서비스관리';
include_once('./_head.php');


$sql_common = " from new_item ";
$sql_where = "where mb_no = '{$member["mb_no"]}' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common. " {$sql_where} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_1'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * {$sql_common} {$sql_where} order by i_idx desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
?>

<? if($name=="cmypage") { ?>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

<div id="area_mypage" class="jjim">
    <div class="inr">
        <div id="mypage_wrap">
            <?php include_once('./mypage_info.php'); ?>

            <div class="mypage_cont">
                <div class="box">
                    <h3>나의 서비스관리</h3>

                    <ul id="product_list">
                        <?php if (sql_num_rows($result) == 0){?>
                            <li class="nodata">
                                <div class="nodata_wrap">
                                    <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                                    <p>등록한 서비스이 없습니다.</p>
                                    <button onclick="location.href='<? echo G5_BBS_URL ?>/item_write01.php'" class="btn">서비스 등록하기</button>
                                </div>
                            </li>
                        <?php  }else {
                            for ($i = 0; $row = sql_fetch_array($result); $i++) {
                                $row['page_type'] = 'update';
                                include("./li_content.php");
                            }
                        } ?>

                    </ul>

                </div>
                <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page="); ?>

            </div>
            <!-- 마이페이지에만 나오는 메뉴 -->
            <?php include_once('./mypage_menu.php'); ?>
        </div>
    </div>

</div>


<?
include_once('./_tail.php');
?>

