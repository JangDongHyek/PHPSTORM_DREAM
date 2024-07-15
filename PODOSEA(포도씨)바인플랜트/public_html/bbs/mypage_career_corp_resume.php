<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 커리어';
include_once('./_head.php');

/** 기업 - 마이페이지 - 커리어 - 지원 이력서 보기 **/

// 페이징
$sql = " select count(*) as cnt from g5_resume where recruit_idx = '{$idx}' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 선택한 채용 공고에 대한 이력서 리스트
$rlt = sql_query(" select * from g5_resume where recruit_idx = '{$idx}' order by idx desc limit {$from_record}, {$rows} ");
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


    <div id="area_mypage" class="corp">
		<div class="inr v3">		
			<div id="mypage_wrap">	
				<?php include_once('./mypage_cinfo.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>커리어</h3>
						<div class="area_cont">
							<div id="help_list" class="inquiry">
								<ul class="list full">
                                    <?php
                                    $cnt = sql_num_rows($rlt);
                                    while($row = sql_fetch_array($rlt)) {
                                    ?>
                                    <li class="company">
                                        <div class="title">
                                            <h3><?=$row['re_subject']?></h3><!-- 제목 -->
                                            <div class="read_ck ck_<?=$row['idx']?>" style="<?= $row['read_yn'] == 'Y' ? 'display: block;' : 'display: none;'; ?>"><span>이력서 읽음</span></div>
                                        </div>
                                        <div class="cont">
                                            <ul class="list_cinfo">
                                                <li>이름 : <?=$row['re_name']?></li>
                                                <li>연락처 : <?=$row['re_hp']?></li>
                                                <li>이메일 : <?=$row['re_email']?></li>
                                            </ul>
                                            <ul class="list_file">
                                                <?php
                                                $file_rlt = sql_query(" select * from g5_resume_file where resume_idx = '{$row['idx']}' order by idx ");
                                                while($file = sql_fetch_array($file_rlt)) {
                                                ?>
                                                <li><a onclick="fileDownload('resume', '<?=$file['img_file']?>', '<?=$file['img_source']?>');fileDownloadChk('<?=$row['idx']?>');"><?=$file['img_source']?></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                            <div class="list_info">
                                                <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span><!--등록일-->
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    if($cnt == 0) {
                                    ?>
                                    <li class="nodata full">
                                        <p>등록된 내용이 없습니다.</p>
                                    </li>
                                    <?php
                                    }
                                    ?>
								</ul>
							</div>
						</div>

                        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?".$qstr."&idx=".$idx."&amp;page="); ?>
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

// 이력서 다운로드
function fileDownloadChk(idx) {
    $.ajax({
        url: g5_bbs_url+'/ajax.resume_read.php',
        type: 'POST',
        data: {idx: idx},
        success: function(data) {
            if(data) {
                $('.ck_'+idx).show();
            }
        },
    })
}
</script>