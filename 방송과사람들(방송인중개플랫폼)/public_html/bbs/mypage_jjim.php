<?
include_once('./_common.php');
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
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?> 
				
				<div class="mypage_cont">
					<div class="box">
						<h3>찜한내역</h3>
						
						<ul id="product_list">
                            <?php if (sql_num_rows($result) == 0){?>
                                <li class="nodata">
                                    <div class="nodata_wrap">
                                        <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                                        <p>찜한 재능이 없습니다.</p>
                                    </div>
                                </li>
                            <?php  }else {
                                for ($i = 0; $row = sql_fetch_array($result); $i++) {
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

