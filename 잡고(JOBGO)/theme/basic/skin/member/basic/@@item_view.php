<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
?>
<link href="<?php echo G5_THEME_CSS_URL; ?>/flexslider.css" rel="stylesheet" type="text/css"><!--swiper CSS-->

<article id="item_view">

    <!--아이템 뷰-->
    <section id="content_wrap">

        <!--아이템정보 왼쪽-->
        <div class="scroll_content">

            <!--이미지롤링-->
            <div id="slider" class="flexslider">
                <ul class="slides">
                    <?php for($i=0; $main_file=sql_fetch_array($main_file_result1); $i++) { ?>
                    <li>
                        <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$main_file['bf_file']?>" alt="포트폴리오">
                    </li>
                    <?php }
                    if($i == 0) {
                    ?>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                    <?php
                    }
                    ?>
                    <!-- items mirrored twice, total of 12 -->
                </ul>
            </div>
            <div id="carousel" class="flexslider">
                <ul class="slides">
                    <?php
                    if($main_file_count > 1) { // 이미지가 1개일 경우 썸네일 보이지 않음
                        for($i=0; $main_file=sql_fetch_array($main_file_result2); $i++) { ?>
                    <li>
                        <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$main_file['bf_file']?>" alt="포트폴리오">
                    </li>
                    <?php
                        }
                    }
                    ?>
                    <!-- items mirrored twice, total of 12 -->
                </ul>
            </div>

            <!--탭-->
            <div class="tabArea">

                <section class="et-hero-tabs">
                    <div class="et-hero-tabs-container">
                        <a class="et-hero-tab" href="#service">서비스 설명</a>
                        <a class="et-hero-tab" href="#price">가격정보</a>
                        <a class="et-hero-tab" href="#edit_react">수정 및 재진행</a>
                        <a class="et-hero-tab" href="#cancel">취소 및 환불</a>
                        <a class="et-hero-tab" href="#review" style="border-right:0">서비스 평가</a>
                        <span class="et-hero-tab-slider" style="width: 0px; left: 0px;"></span>
                    </div>
                </section>

                <div class="et-main cont">
                    <section class="et-slide" id="service">
                        <h3 class="title">서비스 설명</h3>
                        <p style="white-space: pre-wrap !important;"><?=$ta['ta_service_info']?></p>
                        <div class="port" style="height: 100% !important;">
                            <?php for($i=0; $sub_file=sql_fetch_array($sub_file_result); $i++) { ?>
                            <img src="<?php echo G5_DATA_URL ?>/file/sub_talent/<?=$sub_file['bf_file']?>" alt="포트폴리오">
                            <?php } ?>
                        </div>
                    </section>

                    <hr/>

                    <section class="et-slide" id="price">
                        <h3 class="title t_margin50">가격정보</h3>
                        <div class="tbl">
                            <table summary="가격정보">
                                <caption>가격정보</caption>
                                <colgroup>
                                    <col style="width:*"/>
                                    <col style="width:28%"/>
                                    <col style="width:28%"/>
                                    <col style="width:28%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>STANDARD<br/><?=number_format($pta_st['pta_pay'])?>원</th>
                                    <th>DELUXE<br/><?=number_format($pta_de['pta_pay'])?>원</th>
                                    <th>PREMIUM<br/><?=number_format($pta_pr['pta_pay'])?>원</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>패키지 설명</th>
                                    <td><?=$pta_st['pta_content']?></td>
                                    <td><?=$pta_de['pta_content']?></td>
                                    <td><?=$pta_pr['pta_content']?></td>
                                </tr>
                                <tr>
                                    <th>상업적<br>이용 가능</th>
                                    <td><?php if($pta_st['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } ?></td>
                                    <td><?php if($pta_de['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } ?></td>
                                    <td><?php if($pta_pr['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } ?></td>
                                </tr>
                                <tr>
                                    <th>시안 개수</th>
                                    <td><?=$pta_st['pta_select4']?>개</td>
                                    <td><?=$pta_de['pta_select4']?>개</td>
                                    <td><?=$pta_pr['pta_select4']?>개</td>
                                </tr>
                                <tr>
                                    <th>수정 횟수</th>
                                    <td><?=$pta_st['pta_select2']?>회</td>
                                    <td><?=$pta_de['pta_select2']?>회</td>
                                    <td><?=$pta_pr['pta_select2']?>회</td>
                                </tr>
                                <tr>
                                    <th>작업일</th>
                                    <td><?=$pta_st['pta_select1']?>일</td>
                                    <td><?=$pta_de['pta_select1']?>일</td>
                                    <td><?=$pta_pr['pta_select1']?>일</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <hr/>

                    <section class="et-slide" id="edit_react">
                        <h3 class="title t_margin50">수정 및 진행</h3>
                        <p style="white-space: pre-wrap !important;"><?=$ta['ta_update_info']?></p>
                    </section>

                    <hr/>

                    <section class="et-slide" id="cancel">
                        <h3 class="title t_margin50">취소 및 환불</h3>
                        <p>
                            01. 전문가와 의뢰인 간의 상호 협의 후 청약철회가 가능합니다.<br/><br/>

                            02. 전문가의 귀책사유로 디자인작업을 시작하지 않았거나 혹은 이에 준하는 보편적인 관점에서 심각하게 잘못 이행한 경우 결제 금액 전체 환불이 가능합니다.<br/><br/>

                            03. 전문가가 작업 기간 동안 지정된 서비스를 제공하지 못할 것이 확실한 경우 지급받은 서비스 비용을 일할 계산하여 작업물 개수와 작업 기간 일수만큼 공제하고 잔여 금액을
                            환불합니다.<br/><br/>

                            04. 서비스 받은 항목을 공제하여 환불하며, 공제 비용은 정가 처리됩니다.<br/>
                            가. 소비자 피해 보상 규정에 의거하여 작업물 원본의 멸실 및 작업 기간 미이행 및 이에 상응하는 전문가 책임으로 인한 피해 발생 시, 전액 환불<br/>
                            나. 시안 작업 진행된 상품 차감 환불<br/>
                            ⓐ. '디자인'에 대한 금액이 서비스 내 별도 기재가 되지 않았거나, 디자인 상품 패키지 내 수정 횟수가 1회(1회 포함) 이상인 서비스 상품의 시안 or 샘플이 제공된
                            경우<br/>
                            → 구매금액의 10% 환불(디자인 비용이 별도 기재되어 있는 경우, 해당금액 차감 후 환불)<br/>
                            ※ 시안 제공 및 수정이 추가로 이뤄진 경우 환불 금액내 수정 횟수에 따라 분할하여 환불.<br/><br/>

                            05. 주문 제작 상품 등 서비스 받은 항목이 없으며, 결제 후 1일 이내 작업이 진행되기 전 시점은 전액 환불 가능.<br/><br/>

                            06. 다만, 환불이 불가능한 서비스에 대한 사실을 표시사항에 포함한 경우에는 의뢰인의 환불요청이 제한될 수 있습니다.<br/>
                            가. 고객의 요청에 따라 개별적으로 주문 제작되는 재판매가 불가능한 경우(인쇄, 이니셜 각인, 사이즈 맞춤 등)<br/>
                            ⓐ. 주문 제작 상품 특성상 제작(인쇄 등) 진행된 경우.<br/>
                            ⓑ. 인쇄 색상의 차이 : 모니터의 종류에 따라 색상의 차이가 발생하며,인쇄 시마다 합판 인쇄 방법의 특성상 색상 표현의 오차가 발생함.<br/>
                            ⓒ. 디자인 서비스이며 수정 횟수가 존재하지 않았던 상품일 경우 시안 수령 후 환불 불가
                        </p>
                    </section>

                    <hr/>

                    <section class="et-slide" id="review">
                        <h3 class="title t_margin50">서비스 평가</h3>
                        <div class="grade">
                            <ul>
                                <li><p class="point">4.4</p></li>
                                <li>
                                    <span class="star_rating"><span style="width:90%"></span></span><br/>15개의 후기
                                </li>
                            </ul>
                        </div>
                        <!--리뷰리스트-->
                        <div id="item_review">
                            <div class="in">
                                <div class="rev cf">
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm29.jpg">
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="txt">3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다.
                                                    앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다. 3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘
                                                    해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다.
                                                </div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>아름다운***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.23 12:05
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm30.jpg">
                                            </div>
                                            <div class="info">
                                                <div class="txt">빠르고 정확한 번역 굿입니다. 이후에도 다시 한번 맡기고 싶은 마음입니다. 번창하세요!!</div>
                                                <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>공하나***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.22 09:30
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm31.jpg">
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="txt">디자인 너무 잘 나왔어요^^ 항상 친절하시고 많은 요구사항에도 작업 빨리 해주셨어요. 수정요청사항도
                                                    너무 잘 반영해 주셔서 만족만족 또 만족입니다. 감사합니다. 또 이용할게요~~~
                                                </div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>콩나라***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.23 12:05
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm32.jpg">
                                            </div>
                                            <div class="info">
                                                <div class="txt">지금까지 맡겨본 전문인 중에 가장 만족도가 높아요. 하나하나 꼼꼼하게 살펴봐주시고,,
                                                    친절하시고,,다음에 또 인연이 되길 바랍니다.
                                                </div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>소나무***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.22 09:30
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm33.jpg">
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="txt">3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다.
                                                    앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다. 3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘
                                                    해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다.
                                                </div> <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>둘리둘***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.23 12:05
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="list cf">
                                        <a href="javascript:;">
                                            <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm34.jpg">
                                            </div>
                                            <div class="info">
                                                <div class="txt">빠르고 정확한 번역 굿입니다. 이후에도 다시 한번 맡기고 싶은 마음입니다. 번창하세요!!</div>
                                                <!-- 리뷰내용최대3줄추출 -->
                                                <div class="nick"><span><i class="fas fa-user-circle"></i></span>숑숑숑***
                                                </div><!--닉네임 일부분 노출-->
                                                <div class="date">2020.12.22 09:30
                                                    <div class="star">
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                        <span class="on"><i class="fas fa-star"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div><!--rev-->
                            </div><!--in-->
                            <div class="review_more"><a href="">더 보기</a></div>
                        </div>
                    </section>
                </div>

            </div><!--//tabArea-->

        </div>


        <!--가격/재능 정보 오른쪽-->
        <div class="fix_info">
            <header>
                <p class="item_tit"><?=$ta['ta_title']?></p>
                <div class="clearfix">
                    <div class="col-md-10 eval">
                        <ul>
                            <li><!--평점-->
                                <span class="star_rating"><span style="width:90%"></span></span>4.4
                            </li>
                            <li>96명의 평가</li>
                        </ul>
                    </div>
                    <div class="col-md-2 text-right"><i class="fas fa-heart"></i>150</div>
                </div>
                <p class="price"><?=number_format($pta_st['pta_pay'])?><?php if($pta_st['pta_package'] == 'Y') { echo '~'; } ?><span>원</span><br/><span>(VAT 포함가)</span></p>
            </header>

            <!--가격정보-->
            <section class="box_price">
                <ul class="accordion">
                    <li class="item">
                        <h2 class="accordionTitle accordionTitleActive"><?=number_format($pta_st['pta_pay'])?>원 <span class="type">STANDARD</span>
                            <!--<span class="accIcon"></span>--></h2>
                        <div class="text show">
                            <div class="box">
                                <p class="tit"><?=$pta_st['pta_title']?></p> <!-- 제목 -->
                                <p><?=$pta_st['pta_content']?></p><!-- 설명 -->
                                <div class="cont_list">
                                    <ul>
                                        <li>반응형 웹</li>
                                        <li>컨텐츠 업로드</li>
                                        <li>맞춤 디자인 제공</li>
                                        <li>페이지 수 : <?=$pta_st['pta_select4']?>페이지</li>
                                    </ul>
                                </div>
                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?=$pta_st['pta_select1']?>일</li>
                                        <li><i class="fal fa-comment-alt-edit"></i>수정횟수 : <?=$pta_st['pta_select2']?>회</li>
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <?php if(!empty($pta_st['pta_package'])) { ?> <!-- 패키지로 가격설정 시 조회 가능하도록 -->
                    <li class="item">
                        <h2 class="accordionTitle"><?=number_format($pta_de['pta_pay'])?>원 <span class="type">DELUXE</span>
                            <!--<span class="accIcon"></span>--></h2>
                        <div class="text">
                            <div class="box">
                                <p class="tit"><?=$pta_de['pta_title']?></p> <!-- 제목 -->
                                <p><?=$pta_de['pta_content']?></p><!-- 설명 -->
                                <div class="cont_list">
                                    <ul>
                                        <li>반응형 웹</li>
                                        <li>컨텐츠 업로드</li>
                                        <li>맞춤 디자인 제공</li>
                                        <li>페이지 수 : <?=$pta_de['pta_select4']?>페이지</li>
                                    </ul>
                                </div>
                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?=$pta_de['pta_select1']?>일</li>
                                        <li><i class="fal fa-comment-alt-edit"></i>수정횟수 : <?=$pta_de['pta_select2']?>회</li>
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <h2 class="accordionTitle"><?=number_format($pta_pr['pta_pay'])?>원 <span class="type">PREMIUM</span>
                            <!--<span class="accIcon"></span>--></h2>
                        <div class="text">
                            <div class="box">
                                <p class="tit"><?=$pta_pr['pta_title']?></p> <!-- 제목 -->
                                <p><?=$pta_pr['pta_content']?></p><!-- 설명 -->
                                <div class="cont_list">
                                    <ul>
                                        <li>반응형 웹</li>
                                        <li>컨텐츠 업로드</li>
                                        <li>맞춤 디자인 제공</li>
                                        <li>페이지 수 : <?=$pta_pr['pta_select4']?>페이지</li>
                                    </ul>
                                </div>
                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?=$pta_pr['pta_select1']?>일</li>
                                        <li><i class="fal fa-comment-alt-edit"></i>수정횟수 : <?=$pta_pr['pta_select2']?>회</li>
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </section>


            <!--재능인정보-->
            <section class="mem_info">
                <!--사진-->
                <div class="myimg">
                    <!-- 등록 이미지 있을 경우 -->
                    <div class="p_box">
                        <div class="img_rd">
                            <img class="p_img" src='<?= G5_THEME_IMG_URL ?>/sub/01.png'>
                        </div>
                        <p class="name"><i class="fal fa-user-tag"></i> 태양청년</p>
                        <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                    </div>
                </div>
                <p class="text-center contact">
                    <span>전화문의 : </span>010.1234.5678<br/>
                    <span>연락가능시간 : </span>10시~20시
                </p>
                <div class="profile">
                    <ul>
                        <li>
                            <dl>
                                <dt>총 작업수</dt>
                                <dd>565<span>건</span></dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>의뢰인 만족도</dt>
                                <dd>98%</dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>평균응답시간</dt>
                                <dd>1시간<span>이내</span></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <p class="introduce">반갑습니다. 저는 컴퓨터 공학과 4학년에 재학중이며, 동아리 활동에서도 많은 홈페이지와 앱 제작 경험이 있습니다.
                <div id="detail" class="collapse">
                    또한 로고 디자인을 포함하여 CI, BI의 전반적인 디자인 작업도 겸하고 있습니다. 밑고 맡겨 주시면 열심히 하겠습니다. 100만 다운로드 앱등 다수의 인기앱을 기획하였고 현재
                    운영중에 있습니다. 개발을 제외한 기획부터 디자인, 마케팅까지 모든 노하우를 전달해 드립니다.
                </div>
                </p>
                <div class="text-center t_margin10 b_margin10"><a data-toggle="collapse" data-target="#detail" class="t_margin10">더보기 <i class="fal fa-angle-down"></i></a></div>
                <div class="request"><a href=""><i class="fal fa-pen-square"></i> 문의 남기기</a></div>
            </section>
        </div>
        <!--고정 아이템정보-->
    </section>
    <!--아이템 뷰-->

    <!--관련 서비스-->
    <section id="goods" class="t_margin75">
        <div class="in">
            <h2 class="title"><strong>관련</strong> 서비스</h2><!--회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
            <div class="list cf">
                <div class="thm">
                    <a href="<?php echo G5_BBS_URL; ?>/item_view.php">
                        <div class="mg">
                            <span class="pri">PRIME</span><!--prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                            <div class="heart">
                                <button type="button" class="heart on">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on">
                                </button><!--좋아요 누른후-->
                                <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>-->
                                <!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm21.jpg"></div>
                            </div><!--상품사진-->
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">인스타그램 마케팅관리, 계정 활성화 및 게시물 피드 관리해 드립니다.</div>
                            <!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div>
                                <!--사람들이 좋아요 한 횟수-->
                            </div>
                            <div class="price">11,000원</div><!--상품가격-->
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <span class="pri">PRIME</span>
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm22.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">유튜브 구독자, 조회수 높은채널 활용 영상 채널수익창출 드립니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span>
                                </div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                            </div>
                            <div class="price">5,000원~</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm23.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">한글속기 보유, 속기사무소 소장 직접 작업 녹취록, 각종 타이핑 드립니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                            </div>
                            <div class="price">28,000원</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm24.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">영어 번역 회사소개서, 카달로그, 게임, 홈페이지 브로셔 해드립니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                            </div>
                            <div class="price">65,000원</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <span class="pri">PRIME</span>
                            <div class="heart">
                                <button type="button" class="heart on"><img
                                            src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on"
                                            title="좋아요on"></button><!--좋아요 누른후-->
                                <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>-->
                                <!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm25.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">가격파괴 블로그 모바일 및 PC 블로그탭 타겟 키워드 한달 유지해 드립니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div>
                            </div>
                            <div class="price">11,000원</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <span class="pri">PRIME</span>
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm26.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">모던한 디자인으로 간단한 웹사이트와 안드로이드 앱 저렴한 가격에 개발해 드립니다..</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                            </div>
                            <div class="price">770,000원~</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm27.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">기악 및 작곡전공생이 클래식 기타 및 클래식 악기를 가르쳐 드립니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                            </div>
                            <div class="price">155,000원</div>
                        </div>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                        <div class="mg">
                            <div class="heart">
                                <!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>-->
                                <!--좋아요 누른후-->
                                <button type="button" class="heart off">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off">
                                </button><!--좋아요 누르기전-->
                            </div>
                            <div class="mg_in">
                                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm28.jpg"></div>
                            </div>
                        </div><!--mg-->
                        <div class="info">
                            <div class="tit">영상학과 전공, 100건의 다양한 경험으로 고퀄리티 2D, 3D 모션그래픽 영상 제작합니다.</div>
                            <div class="rate cf">
                                <div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                                <div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                            </div>
                            <div class="price">100,000원</div>
                        </div>
                    </a>
                </div>
            </div><!--list-->
        </div><!--in-->
    </section>
    <!--//관련 서비스-->

</article>

<script id="rendered-js">
    class StickyNavigation {//스크롤탭 JS

        constructor() {
            this.currentId = null;
            this.currentTab = null;
            this.tabContainerHeight = 147;
            this.lastScroll = 0;
            let self = this;
            $('.et-hero-tab').click(function () {
                self.onTabClick(event, $(this));
            });
            $(window).scroll(() => {
                this.onScroll();
            });
            $(window).resize(() => {
                this.onResize();
            });
        }

        onTabClick(event, element) {
            event.preventDefault();
            let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
            $('html, body').animate({scrollTop: scrollTop}, 600);
        }

        onScroll() {
            this.checkHeaderPosition();
            this.findCurrentTabSelector();
            this.lastScroll = $(window).scrollTop();
        }

        onResize() {
            if (this.currentId) {
                this.setSliderCss();
            }
        }

        checkHeaderPosition() {
            const headerHeight = 75;
            if ($(window).scrollTop() > headerHeight) {
                $('.et-header').addClass('et-header--scrolled');
            } else {
                $('.et-header').removeClass('et-header--scrolled');
            }
            let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight - headerHeight;
            if ($(window).scrollTop() > this.lastScroll && $(window).scrollTop() > offset) {
                $('.et-header').addClass('et-header--move-up');
                $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-first');
                $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top-second');
            } else if ($(window).scrollTop() < this.lastScroll && $(window).scrollTop() > offset) {
                $('.et-header').removeClass('et-header--move-up');
                $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-second');
                $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top-first');
            } else {
                $('.et-header').removeClass('et-header--move-up');
                $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-first');
                $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top-second');
            }
        }

        findCurrentTabSelector(element) {
            let newCurrentId;
            let newCurrentTab;
            let self = this;
            $('.et-hero-tab').each(function () {
                let id = $(this).attr('href');
                let offsetTop = $(id).offset().top - self.tabContainerHeight;
                let offsetBottom = $(id).offset().top + $(id).height() - self.tabContainerHeight;
                if ($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
                    newCurrentId = id;
                    newCurrentTab = $(this);
                }
            });
            if (this.currentId != newCurrentId || this.currentId === null) {
                this.currentId = newCurrentId;
                this.currentTab = newCurrentTab;
                this.setSliderCss();
            }
        }

        setSliderCss() {
            let width = 0;
            let left = 0;
            if (this.currentTab) {
                width = this.currentTab.css('width');
                left = this.currentTab.offset().left;
            }
            $('.et-hero-tab-slider').css('width', width);
            $('.et-hero-tab-slider').css('left', left);
        }
    }

    new StickyNavigation();
    //# sourceURL=pen.js
</script>

<!-- Swiper JS -->
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.flexslider-min.js"></script>

<!-- Initialize Swiper -->
<script>
    $(window).load(function () {
        // The slider being synced must be initialized first
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 150,
            itemMargin: 5,
            asNavFor: '#slider'
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
    });


    // 아코디언
    var accordionBtn = document.querySelectorAll('.accordionTitle');
    var allTexts = document.querySelectorAll('.text');
    var accIcon = document.querySelectorAll('.accIcon');

    // event listener
    accordionBtn.forEach(function (el) {
        el.addEventListener('click', toggleAccordion)
    });

    // function
    function toggleAccordion(el) {
        var targetText = el.currentTarget.nextElementSibling.classList;
        var targetAccIcon = el.currentTarget.children[0];
        var target = el.currentTarget;

        if (targetText.contains('show')) {
            targetText.remove('show');
            targetAccIcon.classList.remove('anime');
            target.classList.remove('accordionTitleActive');
        } else {
            accordionBtn.forEach(function (el) {
                el.classList.remove('accordionTitleActive');

                allTexts.forEach(function (el) {
                    el.classList.remove('show');
                })

                accIcon.forEach(function (el) {
                    el.classList.remove('anime');
                })

            })

            targetText.add('show');
            target.classList.add('accordionTitleActive');
            targetAccIcon.classList.add('anime');
        }
    }
</script>
