<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '마이페이지 관심기업';
include_once('./_head.php');

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


    <div id="area_mypage" class="help">
		<div class="inr v3">
			<div id="mypage_wrap">
				<?php include_once('./mypage_cinfo.php'); ?>
				<div class="mypage_cont">
					<div class="box">
						<h3>관심기업</h3>
						<div class="box_cont">
							<div id="help_list" class="inquiry">
								<ul class="list full">
                                    <?php
                                    $result = sql_query(" select com.*, mb.mb_no, mb.mb_company_name, mb.mb_company_introduce, mb.mb_hashtag from g5_like_company as com left join g5_member as mb on mb.mb_id = com.company_mb_id where com.mb_id = '{$member['mb_id']}' and mb.mb_level != 1 order by idx desc ");
                                    $i = 0;
                                    while($row = sql_fetch_array($result)) {
                                        $i++;

                                        // 로고
                                        $logo = sql_fetch(" select * from g5_member_img where mb_id = '{$row['company_mb_id']}' and category = '로고' ")['img_file'];
                                        if (empty($logo)) {
                                            $img_src = G5_THEME_IMG_URL . '/app/logo.png';
                                        } else {
                                            $img_src = G5_DATA_URL . '/file/company/' . $logo;
                                        }

                                        //해시태그
                                        $hashtag = '';
                                        if(!empty($row['mb_hashtag'])) {
                                            $tag = explode(',',$row['mb_hashtag']);
                                            for($j=0; $j<count($tag); $j++) {
                                                $hashtag .= '<li>'.$tag[$j].'</li>';
                                            }
                                        }
                                    ?>
                                    <li class="company">
                                        <a href="<?php echo G5_BBS_URL ?>/company.php?mb_no=<?=$row['mb_no']?>">
                                            <div class="title">
                                                <div class="company_logo"><?=getProfileImg($row['company_mb_id'], '기업')?></div>
                                                <div class="company_info">
                                                    <h3><?=$row['mb_company_name']?></h3><!-- 회사이름 -->
                                                    <div class="area_star">
                                                        <div class="img_star v5">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 관심기업버튼 클릭하면 class="on" 추가-->
                                                <div class="interest_corp on" onclick="event.preventDefault();likeCompany('<?=$row['company_mb_id']?>', 'del');"></div>
                                            </div>
                                            <div class="cont">
                                                <span class="intro"><?=$row['mb_company_introduce']?></span>
                                                <ul class="tag">
                                                    <?=$hashtag?>
                                                </ul>
                                                <div class="list_info">
                                                    <span class="reply">총 거래건수 <em>0</em></span>
                                                    <span>리뷰수 <em>0</em></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                    }
                                    if($i == 0) {
                                    ?>
                                    <li class="nodata full">
                                        <p>관심 기업이 없습니다.</p>
                                    </li>
                                    <?php
                                    }
                                    ?>
								</ul>
							</div>
						</div>
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

