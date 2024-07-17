<?
include_once('./_common.php');
$name = "profile";
$g5['title'] = '프로필';
include_once('./_head.php');

$mb = get_member_no($mb_no);

$sql_common = " from new_item ";
$sql_where = "where mb_no = '{$mb["mb_no"]}' ";

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

<div id="area_profile">
    <div class="inr">
        <div id="mypage_wrap">
            <div class="company_info">
                <div>
                    <div class="profile_box">
                        <div class="profile"><?php
                            $icon_file = G5_DATA_PATH.'/file/member/'.$mb['mb_no'].'.jpg';
                            if (file_exists($icon_file)) {
                                $icon_url = G5_DATA_URL.'/file/member/'.$mb['mb_no'].'.jpg';
                                echo '<img src="'.$icon_url.'" alt="">';
                            }else{
                                echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                            }
                            ?></div>
                        <div class="profile_info" onclick="location.href='<?=G5_URL?>/bbs/profile_company.php?mb_no=<?=$mb['mb_no']?>'">
                            <h3><?=$mb['mb_nick']?></h3>
                        </div>
                    </div>
                    <ul class="list_info">
                        <li>
                            <span>총작업수</span>
                            <h3>10건</h3>
                        </li>
                        <li>
                            <span>만족도</span>
                            <h3>98%</h3>
                        </li>
                        <li>
                            <span>평균응답시간</span>
                            <h3>
                                <? if($mb['re_time'] == "1") echo "30분 이내";
                                else if($mb['re_time'] == "2") echo "1시간 이내";
                                else echo "1시간 이상";
                                ?>
                            </h3>
                        </li>
                    </ul>
                    <!--자기소개글-->
                    <p class="pf_produce"><?=$mb['mb_about']?></p>
                </div>
                <div>
                    <div class="portfolio">
                        <h3>포트폴리오</h3>
                        <? for($i=1; $i<7; $i++ ) { ?>
                            <? if($mb['file'.$i] != "") { ?>
                                <i class="fa-light fa-download"></i> <a href="<?=G5_URL?>/bbs/file_download.php?mode=portfolio&temp=<?=$mb['file'.$i]?>&real=<?=$mb['file_name'.$i]?>"><?=$mb['file_name'.$i]?></a><br>
                            <?}?>
                        <?}?>

                       <!--<a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs"><i class="fa-light fa-comment"></i> 전문가에게 문의하기</a>-->
                    </div>
                </div>
            </div>
            <div class="mypage_cont">
                <div class="box">
                    <h3><strong><?=$mb['mb_nick']?></strong>님 재능리스트</h3>

                    <ul id="product_list">
                        <?php if (sql_num_rows($result) == 0){?>
                            <li class="nodata">
                                <div class="nodata_wrap">
                                    <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                                    <p>등록한 재능이 없습니다.</p>
                                </div>
                            </li>
                        <?php  }else {
                            for ($i = 0; $row = sql_fetch_array($result); $i++) {
                                $row['page_type'] = '';
                                include("./li_content.php");
                            }
                        } ?>

                    </ul>

                </div>
                <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page="); ?>

            </div>
        </div>
    </div>

</div>


<?
include_once('./_tail.php');
?>

