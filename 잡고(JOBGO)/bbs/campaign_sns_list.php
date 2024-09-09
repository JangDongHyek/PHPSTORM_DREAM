<?php
include_once("../jl/JlConfig.php");
global $pid;
$pid = "sns_list";
$sub_id = "campaign_list";
include_once('./_common.php');

$g5['title'] = 'SNS 포스팅';
include_once('./_head.php');


?>

<div id="vueContent">
    <div id="banner" class="black mt0">
        <h6><b class="txt_color3">대학생에게 필요한 ○○</b></h6>
        <h6 class="txt_bold2 txt_white">용돈, 알바, 대외활동!</h6>
        <h6 class="txt_thin txt_white">잡고가 함께 해요</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_cpn_service.php'">새로워진 잡고 <i class="fa-solid fa-right"></i></button>
    </div>

    <div id="goods">
        <!--  캠페인  -->
        <div class="in">
            <div class="list">
                <?php
                for ($i = 0; $i < 2; $i++) {
                    ?>
                    <div class="thm">
                        <div class="mg">
                            <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
                                <div class="mg_in">
                                    <div class="over">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                    </div>
                                </div><!--상품사진-->
                            </a>
                        </div><!--mg-->
                        <div class="info">
                            <div class="heart" name="">
                                <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                            <div id="lecture_writer_list">
                                <div class="mb flex gap5 ai-c">
                                    <div class="count">
                                        <b class="txt_color">0</b>/5
                                    </div>
                                    <p>모집중</p>
                                </div>
                            </div>
                            <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
                                <div class="tit">이름</div>
                                <div class="txt_color">기업명</div>
                            </a>
                        </div>
                    </div><!--thm-->

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->

    <nav class="pg_wrap">
        <span class="pg" id="emo_pg"></span>
    </nav>
</div>

<script>

</script>

<?php
include_once('./_tail.php');
?>