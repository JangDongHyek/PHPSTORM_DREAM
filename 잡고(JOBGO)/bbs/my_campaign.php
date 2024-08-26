<?php
global $pid;
$pid = "my_campaign";
$sub_id = "my_campaign";
include_once('./_common.php');

$g5['title'] = '캠페인 관리';
include_once('./_head.php');

?>



    <article id="mypage">


        <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
            <h3>캠페인 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                <ul>
                    <li id="tab1"><a href="javascript:a_tab('1');">찜한 캠페인<span class="badge">0</span></a></li>
                    <li id="tab2"><a href="javascript:a_tab('2');">신청 캠페인<span class="badge">0</span></a></li>
                    <li id="tab3"><a href="javascript:a_tab('3');">캠페인 선정<span class="badge">0</span></a></li>
                </ul>

                <!--찜한 캠페인-->
                <div id="tab-content1" class="tab-content">
                    <div id="my_goods">
                        <!--  캠페인  -->
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="check"><a href="">전체</a></li>
                                <li id="li_all" class=""><a href="">SNS</a></li>
                                <li id="li_all" class=""><a href="">디자인</a></li>
                                <li id="li_all" class=""><a href="">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
                                <?php
                                for ($i = 0; $i < 8; $i++) {
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
                                                <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>
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

                    </div><!--my_goods-->
                </div>

                <!--신청 캠페인-->
                <div id="tab-content2" class="tab-content box-article">
                    <div id="my_goods">
                        <!--  캠페인  -->
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="check"><a href="">전체</a></li>
                                <li id="li_all" class=""><a href="">SNS</a></li>
                                <li id="li_all" class=""><a href="">디자인</a></li>
                                <li id="li_all" class=""><a href="">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
                                <?php
                                for ($i = 0; $i < 8; $i++) {
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
                                            <div id="lecture_writer_list" class="flex jc-sb ai-c">
                                                <p>24.01.01 신청</p>
                                                <button type="button" class="btn btn_mini btn_color2">
                                                    신청 취소
                                                </button>
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

                    </div><!--my_goods-->
                </div>

                <!--캠페인 선정-->
                <div id="tab-content3" class="tab-content">
                    <div id="my_list">
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="check"><a href="">전체</a></li>
                                <li id="li_all" class=""><a href="">SNS</a></li>
                                <li id="li_all" class=""><a href="">디자인</a></li>
                                <li id="li_all" class=""><a href="">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
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
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_color2">
                                                선정
                                            </span>
                                            <p>24.01.01 | 활동 종료 24.01.01</p>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
                                            <div class="tit">이름</div>
                                            <div class="txt_color">기업명</div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray btn_large">
                                            활동 안내
                                        </button>
                                        <button type="button" class="btn btn_color btn_large">
                                            완료 보고
                                        </button>
                                    </div>
                                </div><!--thm-->
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
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_color2">
                                                선정
                                            </span>
                                            <p>24.01.01 | 활동 종료 24.01.01</p>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php">
                                            <div class="tit">이름</div>
                                            <div class="txt_color">기업명</div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray btn_large">
                                            활동 안내
                                        </button>
                                        <button type="button" class="btn btn_gray3 btn_large">
                                            활동 완료
                                        </button>
                                    </div>
                                </div><!--thm-->
                            </div><!--list-->
                        </div><!--in-->
                    </div>
                </div>

                </div><!--//tabs-->
            </div>
        </section>
    </article>

<script>

    function a_tab(id) {
        location.href = g5_bbs_url + "/my_campaign.php?tab="+id
    }

</script>
<?php
include_once('./_tail.php');
?>