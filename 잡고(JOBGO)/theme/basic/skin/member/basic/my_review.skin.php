<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);


?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
#reply{ display:none}
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>받은 평가<span>전체 받은 평가 <?=$review_count?></span></h3>
             
                <!--평가 리스트-->
                   <div id="item_review">
                            <div class="in">
                                <div class="rev cf">
                                    <?php
                                    for($i=0; $row=sql_fetch_array($result); $i++) {
                                    ?>
                                    <div class="list cf">
                                        <a href="<?=G5_BBS_URL?>/item_view.php?idx=<?=$row['ta_idx']?>#review">
                                            <div class="mg">
                                            <?php
                                            $mb_dir = substr($row['mb_id'],0,2);
                                            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$row['mb_id'].'pro.jpg';
                                            if (file_exists($icon_file)) {
                                                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$row['mb_id'].'pro.jpg';
                                                ?>
                                                <img src="<?=$icon_url?>">
                                                <?php
                                            }else{
                                                ?>
                                                <img src='<?=G5_THEME_IMG_URL?>/sub/default.png'>
                                                <?php
                                            }
                                            ?>
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="txt"><?=$row['review']?></div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$row['mb_nick']?></div><!--닉네임 일부분 노출-->
                                                <div class="date"><?=substr($row['wr_datetime'],0, 16)?>
                                                    <div class="star">
                                                        <?php for($k=1; $k<=$row['rating']; $k++) { ?>
                                                            <span class="on"><i class="fas fa-star"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div><!--rev-->
                            </div><!--in-->
                            <div class="review_more"><a href="javascript:void(0);" onclick="review_append();">더 보기</a></div>
                    </div>
                      
        </section>

</article>

<script>
    // 리뷰 더 보기
    var rows = 9;
    function review_append() {
        $.ajax({
            url: g5_bbs_url+'/ajax.review_append.php',
            type: "POST",
            data: {
                rows : rows,
                ta_idx : '<?=$ta_idx?>',
            },
            success: function (data) {
                $('.rev').append(data);
                rows += 9;

                // 전체 리뷰 표시 시 더 보기 숨김
                if(rows >= '<?=$review_count?>') {
                    $('.review_more').hide();
                }
            },
        });
    }
</script>