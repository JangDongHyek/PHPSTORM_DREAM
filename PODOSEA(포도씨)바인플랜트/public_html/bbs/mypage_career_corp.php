<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 커리어';
include_once('./_head.php');

/** 기업 - 마이페이지 - 커리어 **/

// 페이징
$sql = " select count(*) as cnt from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where cr.mb_id = '{$member['mb_id']}' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 등록한 채용공고 리스트
$rlt = sql_query(" select cr.*, mb.mb_company_name from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where cr.mb_id = '{$member['mb_id']}' order by idx desc limit {$from_record}, {$rows} ");
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


    <div id="area_mypage" class="corp help">
		<div class="inr v3">		
			<div id="mypage_wrap">	
				<?php include_once('./mypage_cinfo.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>커리어</h3>
						<div class="area_cont">	
							<ul class="list_receive">
                                <?php
                                while($row = sql_fetch_array($rlt)) {
                                    $state = '';
                                    if($row['cr_state'] == '마감' || (($row['cr_eddate'] < date('Y-m-d') && $row['cr_eddate'] != '0000-00-00'))) {
                                        $state = '채용마감';
                                    } else if($row['cr_always'] == 'Y') {
                                        $state = '상시채용';
                                    } else {
                                        $state = '채용진행';
                                    }
                                ?>
                                <li>
                                    <i class="<?= ($row['cr_eddate'] < date('Y-m-d') && $row['cr_always'] != 'Y') ? 'finish' : 'check'; ?>"><?=$state?></i>
                                    <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
                                    <div class="company"><?=$row['mb_company_name']?></div>
                                    <p><?=$row['cr_subject']?></p>
                                    <p class="end">
                                        <?php if($state != '상시채용') { ?>
                                        접수마감 : <?=str_replace('-','.',$row['cr_stdate'])?>
                                        <?php } ?>
                                    </p>
                                    <div class="btn_link">
                                        <a href="<?=G5_BBS_URL?>/career_view.php?idx=<?=$row['idx']?>">채용공고 상세보기</a>
                                        <a href="<?=G5_BBS_URL?>/mypage_career_corp_resume.php?idx=<?=$row['idx']?>">지원 이력서보기</a>
                                    </div>
                                </li>
                                <?php
                                }
                                if($total_count == 0) {
                                ?>
                                <li class="nodata full"><p>등록된 내용이 없습니다.</p></li>
                                <?php
                                }
                                ?>
							</ul>
						</div>

                        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?".$qstr."&amp;page="); ?>
                    </div>
				</div>
				<?php include_once('./mypage_cmenu.php'); ?> 
			</div>			
		</div>
	</div>

<?
include_once('./_tail.php');
?>

<script>

$(document).ready(function() {
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
    });
});

</script>

