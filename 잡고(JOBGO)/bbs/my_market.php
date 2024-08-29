<?php
global $pid;
$pid = "my_market";
$sub_id = "my_market";
include_once('./_common.php');

$g5['title'] = '마켓 관리';
include_once('./_head.php');

?>


<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

    <section id="right_view">
        <h3>마켓 관리</h3>

        <div class="wrapper">
            <div class="tabs cf">
                <ul>
                    <li id="tab1"><a href="javascript:a_tab('1');">판매 상품<span class="badge">0</span></a></li>
                    <li id="tab2"><a href="javascript:a_tab('2');">결제/배송<span class="badge">0</span></a></li>
                    <li id="tab3"><a href="javascript:a_tab('3');">찜한 상품<span class="badge">0</span></a></li>
                </ul>

                <!--판매 상품-->
                <div id="tab-content1" class="tab-content">
                    <div id="my_list" class="mkt">
                        <div class="in">
                            <div class="list">
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
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
                                                판매 허가
                                            </span>
                                            <span class="icon icon_color2">
                                                24.08.01~
                                            </span>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div class="txt_color">판매리워드 | 판매가 5%</div>
                                            <div class="price">누적 판매 금액 <span>250,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray btn_middle">
                                            판매 종료
                                        </button>
                                        <button type="button" class="btn btn_color btn_middle">
                                            판매 링크
                                        </button>
                                        <button type="button" class="btn btn_line btn_middle" data-toggle="modal" href="#marketPurchase">
                                            판매 정산
                                        </button>
                                    </div>
                                </div><!--thm-->
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="mg_in">
                                                <div class="over">
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                                </div>
                                            </div><!--상품사진-->
                                        </a>
                                    </div><!--mg-->
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_red2">
                                                판매 허가
                                            </span>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div class="txt_color">판매리워드 | 판매가 5%</div>
                                            <div class="price">누적 판매 금액 <span>250,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_line btn_middle" data-toggle="modal" href="#marketCancel">
                                            불가 사유
                                        </button>
                                        <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                            판매 링크
                                        </button>
                                        <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                            판매 정산
                                        </button>
                                    </div>
                                </div><!--thm-->
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="mg_in">
                                                <div class="over">
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                                </div>
                                            </div><!--상품사진-->
                                        </a>
                                    </div><!--mg-->
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_gray">
                                                판매 종료
                                            </span>
                                            <span class="icon icon_gray">
                                                24.08.01~24.10.01
                                            </span>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div class="txt_color">판매리워드 | 판매가 5%</div>
                                            <div class="price">누적 판매 금액 <span>250,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                            판매 종료
                                        </button>
                                        <button type="button" class="btn btn_gray3 btn_middle" disabled>
                                            판매 링크
                                        </button>
                                        <button type="button" class="btn btn_line btn_middle" data-toggle="modal" href="#marketPurchase">
                                            판매 정산
                                        </button>
                                    </div>
                                </div><!--thm-->
                            </div><!--list-->
                        </div><!--in-->
                    </div>
                </div>

                <!--결제/배송-->
                <div id="tab-content2" class="tab-content box-article">
                    <div class="flex ai-c jc-sb sch">
                        <ul class="flex gap5">
                            <li><a class="icon icon_color2">결제완료</a></li>
                            <li><a class="icon icon_gray">배송중</a></li>
                            <li><a class="icon icon_gray">배송완료</a></li>
                            <li><a class="icon icon_red2">취소완료</a></li>
                        </ul>
                        <div id="tnb_sch">
                            <form name="frmsearch1" id="form4" action="" onsubmit="return search_submit(this);" autocomplete="off">
                                <input type="text" name="stx" value="" id="sch_str4" placeholder="검색어를 입력하세요." required="" onclick="input_word('4');">
                                <button type="submit" id="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sch_btn02.png" alt="검색"><span class="sound_only">검색</span></button>
                            </form>
                        </div>
                    </div>

                    <div id="my_list" class="mkt">
                        <div class="in">
                            <div class="list">
                                <h3 class="date">24.08.01 (월)</h3>
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
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
                                                결제완료
                                            </span>
                                            24.08.01 11:20
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div><a>주문상세<i class="fa-regular fa-chevron-right"></i></a></div>
                                            <div class="price"><span>50,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_line btn_large">
                                            구매 취소
                                        </button>
                                        <button type="button" class="btn btn_color2 btn_large">
                                            결제 완료
                                        </button>
                                    </div>
                                </div><!--thm-->
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="mg_in">
                                                <div class="over">
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                                </div>
                                            </div><!--상품사진-->
                                        </a>
                                    </div><!--mg-->
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_red2">
                                                취소완료
                                            </span>
                                            24.08.01 11:20
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div><a>주문상세<i class="fa-regular fa-chevron-right"></i></a></div>
                                            <div class="price"><span class="txt_through">50,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                    </div>
                                </div><!--thm-->
                                <div class="thm">
                                    <div class="mg">
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="mg_in">
                                                <div class="over">
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                                </div>
                                            </div><!--상품사진-->
                                        </a>
                                    </div><!--mg-->
                                    <div class="info">
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_gray">
                                                배송완료
                                            </span>
                                            24.08.01 11:20
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                            <div class="tit">상품명</div>
                                            <div><a>주문상세<i class="fa-regular fa-chevron-right"></i></a></div>
                                            <div class="price"><span>50,000원</span></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_line btn_large">
                                            교환/반품
                                        </button>
                                        <button type="button" class="btn btn_color2 btn_large">
                                            리뷰작성
                                        </button>
                                    </div>
                                </div><!--thm-->
                            </div><!--list-->
                        </div><!--in-->
                    </div>
                </div>

                <!--찜한 상품-->
                <div id="tab-content3" class="tab-content">
                    <div id="my_goods">

                        <div class="in">
                            <div class="list">
                                <?php
                                for ($i = 0; $i < 2; $i++) {
                                    ?>
                                    <div class="thm">
                                        <div class="mg">
                                            <a href="<?php echo G5_BBS_URL ?>/market_view.php">
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
                                                    <p>업체명</p>
                                                </div>
                                            </div>
                                            <a href="<?php echo G5_BBS_URL ?>/market_view.php">
                                                <div class="tit">이름</div>
                                                <div class="price">50,000원</div>
                                            </a>
                                        </div>
                                    </div><!--thm-->

                                <?php } ?>
                            </div><!--list-->
                        </div><!--in-->
                    </div><!--my_goods-->
                </div>

            </div><!--//tabs-->
        </div>
    </section>
</article>

    <!-- 판매 정산 -->
    <div class="modal fade" id="marketPurchase" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">판매 정산</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>판매 정산</p>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>판매일</th>
                                    <th>구매금액</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg1">
                                    <td>합계</td>
                                    <td class="text-right">1,000원</td>
                                </tr>
                                <tr>
                                    <td>24.01.01</td>
                                    <td class="text-right">1,000원</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 판매 정산  모달창 -->
    <!-- 불가 사유 -->
    <div class="modal fade" id="marketCancel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">불가 사유</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>판매 정산</p>
                    <textarea readonly>불가합니다.</textarea>

            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 불가 사유  모달창 -->
<script>

    function a_tab(id) {
        location.href = g5_bbs_url + "/my_market.php?tab="+id
    }

</script>

<?php

include_once('./_tail.php');
?>