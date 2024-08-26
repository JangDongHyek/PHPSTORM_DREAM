<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
header("Content-Type: text/html; charset=utf-8");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);

?>

<style>
    #price table tr td {
        white-space: pre-wrap !important;
    }
	.accordionTitle.dir{ font-size:1.28em !important}
	.box_price .work input .dir{ width:100%;}
</style>

<link href="<?php echo G5_THEME_CSS_URL; ?>/flexslider.css" rel="stylesheet" type="text/css"><!--swiper CSS-->

<form id="payfrm" name="payfrm" method="post" action="<?=G5_BBS_URL?>/my_order.php">
<!-- 이노페이 필수 -->
<input type="hidden" name="ta_idx" id="ta_idx" value="<?=$ta['ta_idx']?>">
<input type="hidden" name="pta_idx" id="pta_idx" value="">
<input type="hidden" name="pta_write_price" id="pta_write_price" value="">

</form>

<!-- 문의 남기기 MODAL MODAL -->
<div class="modal fade" id="Question" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-envelope-open-text"></i>&nbsp;문의 남기기</h4>
            </div>

            <div class="modal-body">
                <div id="pro_step">

                    <!--등록 폼 시작-->
                    <div class="in">
                        <form id="frmpro" method="post">
                            <input type="hidden" id="comment_idx" name="comment_idx" value="">

                            <div class="form-group">
                                <label for="test01">재능인에게 문의 하실 말씀을 입력하세요</label>
                                <div class="txt_bx">
                                    <textarea name="cp_logo_content" id="tq_content" class="form-control txt doc_text" rows="5" placeholder="재능 관련 의뢰인에게 하시고 싶으신 말씀을 입력하세요."></textarea>
                                    <div class="text_limit"><span id="tq_content_count">0</span> / 최대 500자</div>
                                    <!--텍스트입력시 카운트가 올라감-->
                                </div>
                            </div><!--form-group-->

                        </form>
                    </div><!--in-->

                    <!--저장 부분-->
                    <div class="f_save cf">
                        <div class="save hide"><a href="javascript: form_action('save');">임시저장</a></div>
                        <div class="arr"><a href="javascript: question_update()">등록완료</a></div>
                    </div><!--f_save-->

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //문의 남기기 MODAL -->


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


            <!--가격/재능 정보 모바일 view-->
            <div class="fix_info visible-xs">
                <header>
                    <p class="item_tit"><?=$ta['ta_title']?><?php if($member["mb_no"] == "31"){ ?><span>신고 및 차단하기</span><?php } ?></p>
                    <div class="clearfix">
                        <div class="col-md-10 eval">
                            <ul>
                                <li><!--평점-->
                                    <span class="star_rating"><span style="width:<?=review_avg($ta['ta_idx'])*20?>%"></span></span><?=review_avg($ta['ta_idx'])?>
                                </li>
                                <li><?=review_cnt($ta['ta_idx'])?>명의 평가</li>
                            </ul>
                        </div>
                        <div class="col-md-2 text-right"><i class="fas fa-heart"></i><?= like_cnt($ta['ta_idx'],'talent') ?></div>
                    </div>
                    <p class="price">
                        <?php //스탠다드 가격 ~
                        $sql = "select pta_pay from {$g5['pay_talent_table']} where ta_idx = '{$ta['ta_idx']}' and pta_info = 1 ";
                        $pay_row = sql_fetch($sql);
                        echo number_format($pay_row["pta_pay"]). "<span>원</span> ~ " ?>
                        <br/><span>(VAT 포함가)</span></p>
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
                                    <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_st['pta_text']?></div>

                                    <div class="work">
                                        <ul>
                                            <li><i class="far fa-clock"></i>작업일 : <?= $pta_st['pta_select1'] == 0 ? '선택안함': $pta_st['pta_select1'].'일';?></li>
                                        </ul>
                                    </div>
                                    <input type="button" value="구매하기" name = "<?=$pta_st['pta_idx']?>" class="btn_submit">
                                </div>
                            </div>
                        </li>
                        <?php if(!empty($pta_de['pta_pay'])) {?> <!-- 패키지로 가격설정 시 조회 가능하도록 -->
                        <li class="item">
                            <h2 class="accordionTitle"><?=number_format($pta_de['pta_pay'])?>원 <span class="type">DELUXE</span>
                                <!--<span class="accIcon"></span>--></h2>
                            <div class="text">
                                <div class="box">
                                    <p class="tit"><?=$pta_de['pta_title']?></p> <!-- 제목 -->
                                    <p><?=$pta_de['pta_content']?></p><!-- 설명 -->
                                    <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_de['pta_text']?></div>

                                    <div class="work">
                                        <ul>
                                            <li><i class="far fa-clock"></i>작업일 : <?= $pta_de['pta_select1'] == 0 ? '선택안함': $pta_de['pta_select1'].'일';?></li>
                                        </ul>
                                    </div>
                                    <input type="submit" value="구매하기" name = "<?=$pta_de['pta_idx']?>" class="btn_submit">
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                        <?php if(!empty($pta_pr['pta_pay'])) {?> <!-- 패키지로 가격설정 시 조회 가능하도록 -->
                        <li class="item">
                            <h2 class="accordionTitle"><?=number_format($pta_pr['pta_pay'])?>원 <span class="type">PREMIUM</span>
                                <!--<span class="accIcon"></span>--></h2>
                            <div class="text">
                                <div class="box">
                                    <p class="tit"><?=$pta_pr['pta_title']?></p> <!-- 제목 -->
                                    <p><?=$pta_pr['pta_content']?></p><!-- 설명 -->
                                    <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_pr['pta_text']?></div>
                                    <div class="work">
                                        <ul>
                                            <li><i class="far fa-clock"></i>작업일 : <?= $pta_pr['pta_select1'] == 0 ? '선택안함': $pta_pr['pta_select1'].'일';?></li>
                                        </ul>
                                    </div>
                                    <input type="submit" value="구매하기" name = "<?=$pta_pr['pta_idx']?>" class="btn_submit">
                                </div>
                            </div>
                        </li>
                        <?php } ?>
						<li class="item">
							<h2 class="accordionTitle dir">직접입력</h2>
								<!--<span class="accIcon"></span>--></h2>
							<div class="text">
								<div class="box">
									<p class="tit">가격 직접입력</p> <!-- 제목 -->
									<p>판매자와 상의 후 가격을 입력 후 결제해주세요.</p><!-- 설명 -->
									<div class="cont_list" style="white-space: pre-wrap;"></div>
									<div class="work">
										<ul>
											<input type="tel" id="pta_write_price_input2" class="dir" name=pta_write_price_input" onkeyup="numberWithCommas(this)" style="width:100%; height:40px; text-indent:10px">
										</ul>
									</div>
									<input type="submit" value="구매하기" name = "pta_write_price" class="btn_submit">
								</div>
							</div>
						</li>
                    </ul>
                </section>
    
    
                <!--재능인정보-->
                <section class="mem_info">
                    <!--사진-->
                    <div class="myimg">
                        <!-- 등록 이미지 있을 경우 -->
                        <div class="p_box">
                            <div class="img_rd">
                                <?php if(file_exists($dest_path)){
                                    echo '<img class="p_img" src="'.$dest_url.'">';
                                }else{
                                    echo '<img class="p_img" src="'.G5_THEME_IMG_URL.'/sub/default.png">';
                                } ?>
                            </div>
                            <p class="name"><i class="fal fa-user-tag"></i> <?= $mb['mb_nick'] ?></p>
                            <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                        </div>
                    </div>
                    <p class="text-center contact">
<!--                        <span>전화문의 : </span>--><?//= $mb['mb_hp']?><!--<br/>-->
                        <span>연락가능시간 : </span><?=date('H:i',strtotime($profile['pf_call_time1']))?>~<?=date('H:i',strtotime($profile['pf_call_time2']))?>
                    </p>
                    <div class="profile">
                        <ul>
                            <li>
                                <dl>
                                    <dt>총 작업수</dt>
                                    <dd><?=number_format($member_cnt)?><span>건</span></dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>의뢰인 만족도</dt>
                                    <dd><i class="fas fa-star"></i><?=$member_avg?></dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>평균응답시간</dt>
                                    <dd><?= $pf_time_list[$profile['pf_time']] ?></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <p class="introduce"><span name="prev_produce" style="display: inline"><?= $profile['pf_produce'] ?><? /* = cut_str($profile['pf_produce'],30) */ ?></span>
                    <!--<div id="detail" class="collapse"><?= $profile['pf_produce'] ?></div>-->
                    </p>
                    <? /* php if( mb_strlen($profile['pf_produce']) > 20 ){ ?>
                    <div class="text-center t_margin10 b_margin10"><a data-toggle="collapse" data-target="#detail" class="t_margin10" onclick="detail_produce()">더보기 <i class="fal fa-angle-down"></i></a></div>
                    <?php } */ ?>
                    
                    <!--보유자격증 안내-->
                    <div class="certi">
                        <h4><i class="fal fa-address-card"></i> 보유 자격증 안내</h4>
                        <div class="certi_list">
                            <ul>
                                <?php for($i = 0; $i < count($certificate_arr); $i++) {
                                    if($certificate_arr[$i] != "") {
                                        echo '<li>' . $certificate_arr[$i] . '</li>';
                                    }else{
                                        echo '<li>보유 자격증 없음</li>';
                                    }
                                } ?>
                                <!--                                <li>운전면허증/202109/교통부</li>-->
                            </ul>
                        </div>
                    </div>
                    
<!--                    <div class="request"><a href="javascript:question_modal()"><i class="fal fa-pen-square"></i> 문의 남기기</a></div>-->
                    <!--전문인에게 채팅요청(방만들기)-->
                    <?php if($member['mb_id'] != $profile['mb_id'] && $is_member) { ?>
                        <?php if($member["mb_no"] != "31"){ ?>
                             <div class="request"><a onclick="chatting();"><i class="fal fa-pen-square"></i> 문의 채팅</a></div>
                        <?php } ?>
                    <?php } ?>
                </section>
            </div>
            <!--//가격/재능 정보 모바일 view-->


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
                        <?php if (sql_num_rows($qna_result) != 0){?>
                        <!--자주묻는질문-->
                        <h4><i class="fal fa-question-circle"></i> 자주하는 질문과 답변</h4>
                            <?php for ($i = 0; $qna = sql_fetch_array($qna_result); $i++){ ?>
                             <div class="item_faq">
                                 <dl>
                                     <dt><span>Q.</span><?= $qna['qna_q'] ?></dt>
                                     <dd><span>A.</span><?= $qna['qna_a'] ?></dd>
                                 </dl>  
                             </div>
                            <?php } ?>
                        <?php } ?>
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
                                    <th>DELUXE<br/><?= !empty($pta_de['pta_pay'] || $pta_de['pta_pay'] != 0) ? number_format($pta_de['pta_pay'])."원" : "" ?></th>
                                    <th>PREMIUM<br/><?= !empty($pta_pr['pta_pay'] || $pta_pr['pta_pay'] != 0) ? number_format($pta_pr['pta_pay'])."원" : "" ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>제목</th>
                                    <td><?=$pta_st['pta_title']?></td>
                                    <td><?=$pta_de['pta_title']?></td>
                                    <td><?=$pta_pr['pta_title']?></td>
                                </tr>
                                <tr>
                                    <th>설명</th>
                                    <td><?=$pta_st['pta_content']?></td>
                                    <td><?=$pta_de['pta_content']?></td>
                                    <td><?=$pta_pr['pta_content']?></td>
                                </tr>
                                <tr>
                                    <th>옵션설명</th>
                                    <td><?=$pta_st['pta_text']?></td>
                                    <td><?=$pta_de['pta_text']?></td>
                                    <td><?=$pta_pr['pta_text']?></td>
                                </tr>
                                <tr>
                                    <th>금액</th>
                                    <td><?php echo !empty($pta_st['pta_pay']) ? number_format($pta_st['pta_pay']).'원' : '' ?></td>
                                    <td><?php echo !empty($pta_de['pta_pay']) ? number_format($pta_de['pta_pay']).'원' : '' ?></td>
                                    <td><?php echo !empty($pta_pr['pta_pay']) ? number_format($pta_pr['pta_pay']).'원' : '' ?></td>
                                </tr>
                                <!--<tr>
                                    <th>상업적<br>이용 가능</th>
                                    <td><?php /*if($pta_st['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } */?></td>
                                    <td><?php /*if($pta_de['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } */?></td>
                                    <td><?php /*if($pta_pr['pta_com'] == 'Y') { echo '<i class="fal fa-check"></i>'; } */?></td>
                                </tr>
                                <tr>
                                    <th>시안 개수</th>
                                    <td><?/*=$pta_st['pta_select4']*/?>개</td>
                                    <td><?/*=$pta_de['pta_select4']*/?>개</td>
                                    <td><?/*=$pta_pr['pta_select4']*/?>개</td>
                                </tr>
                                <tr>
                                    <th>수정 횟수</th>
                                    <td><?/*=$pta_st['pta_select2']*/?>회</td>
                                    <td><?/*=$pta_de['pta_select2']*/?>회</td>
                                    <td><?/*=$pta_pr['pta_select2']*/?>회</td>
                                </tr>-->
                                <tr>
                                    <th>작업일</th>
                                    <td><?php echo !empty($pta_st['pta_select1']) ? $pta_st['pta_select1'].'일' : '' ?></td>
                                    <td><?php echo !empty($pta_de['pta_select1']) ? $pta_de['pta_select1'].'일' : '' ?></td>
                                    <td><?php echo !empty($pta_pr['pta_select1']) ? $pta_pr['pta_select1'].'일' : '' ?></td>
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
                        <div style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content']: "등록안됨";?></div>
                    </section>

                    <hr/>

                    <section class="et-slide" id="review">
                        <h3 class="title t_margin50">서비스 평가</h3>
                        <div class="grade">
                            <ul>
                                <li><p class="point"><?=review_avg($ta['ta_idx'])?></p></li>
                                <li>
                                    <!-- 1점이 20% -->
                                    <span class="star_rating"><span style="width:<?=review_avg($ta['ta_idx'])*20?>%"></span></span><br/><?=review_cnt($ta['ta_idx'])?>개의 후기
                                </li>
                            </ul>
                        </div>
                        <!--리뷰리스트-->
                        <div id="item_review">
                            <div class="in">
                                <div class="rev cf">

                                    <!--서비스 평가 글쓰기-->
                                    <div id="reply" class="b_margin50">
                                        <section class="cmt">
                                            <textarea name="review_contents" id="review_contents" required="" maxlength="5000" placeholder="서비스 평가글을 입력해주세요" style="resize: unset;"></textarea>
                                            <input type="button" onclick="review_insert();" id="cmt_btn_submit" value="평가 입력" accesskey="s">
                                        </section>
                                        <div class="grade_wrap">
                                            <input type="radio" id="grade_star1" name="grade_stars" value="1">
                                            <label for="grade_star1"><span><i class="fas fa-star"></i></label>
                                            <input type="radio" id="grade_star2" name="grade_stars" value="2">
                                            <label for="grade_star2"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                            <input type="radio" id="grade_star3" name="grade_stars" value="3">
                                            <label for="grade_star3"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label> <br class="grade_br"/>
                                            <input type="radio" id="grade_star4" name="grade_stars" value="4">
                                            <label for="grade_star4"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                            <input type="radio" id="grade_star5" name="grade_stars" value="5">
                                            <label for="grade_star5"><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i><span><i class="fas fa-star"></i></label>
                                        </div>
                                    </div>
                                    <!--//서비스 평가 글쓰기-->

                                    <?php
                                    for($i=0; $row=sql_fetch_array($review_result); $i++) {
                                    ?>
                                    <div class="list cf">
                                        <div class="mg">
                                            <?php
                                            $mb_dir = substr($row['mb_id'],0,2);
                                            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$row['mb_id'].'.jpg';
                                            if (file_exists($icon_file)) {
                                                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$row['mb_id'].'.jpg';
                                            ?>
                                            <img src="<?=$icon_url?>">
                                            <?php
                                            }else{
                                            ?>
                                            <img src='<?=G5_THEME_IMG_URL?>/sub/default.png'>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="info">
                                            <div class="txt"><?=$row['review']?></div>
                                            <!-- 리뷰내용최대3줄추출 -->
                                            <div class="nick"><span><i class="fas fa-user-circle"></i></span><?=$row['mb_nick']?>
                                            </div><!--닉네임 일부분 노출-->
                                            <div class="date"><?=substr($row['wr_datetime'],0,16)?>
                                                <div class="star">
                                                    <?php for($k=1; $k<=$row['rating']; $k++) { ?>
                                                    <span class="on"><i class="fas fa-star"></i></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                </div><!--rev-->
                            </div><!--in-->
                            <div class="review_more">
                                <?php if($review_count > 5) { ?>
                                <a href="javascript:void(0);" onclick="review_append();">더 보기</a>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                </div>

            </div><!--//tabArea-->

        </div>


        <!--가격/재능 정보 오른쪽 모바일 사라짐-->
        <div class="fix_info hidden-xs">
            <header>
                <p class="item_tit"><?=$ta['ta_title']?><?php if($member["mb_no"] == "31"){ ?><span onclick="report()" style="float: right;font-size: 12pt; cursor: pointer; color: #7d75dc">신고 및 차단하기</span><?php } ?></p>
                <div class="clearfix">
                    <div class="col-md-10 eval">
                        <ul>
                            <li><!--평점-->
                                <span class="star_rating"><span style="width:<?=review_avg($ta['ta_idx'])*20?>%"></span></span><?=review_avg($ta['ta_idx'])?>
                            </li>
                            <li><?=review_cnt($ta['ta_idx'])?>명의 평가</li>
                        </ul>
                    </div>
                    <div class="col-md-2 text-right"><i class="fas fa-heart"></i><?= like_cnt($ta['ta_idx'],'talent') ?></div>
                </div>
                <p class="price">
                    <?php //스탠다드 가격 ~
                    $sql = "select pta_pay from {$g5['pay_talent_table']} where ta_idx = '{$ta['ta_idx']}' and pta_info = 1 ";
                    $pay_row = sql_fetch($sql);
                    echo number_format($pay_row["pta_pay"]). "<span>원</span> ~ " ?>
                   <br/><span>(VAT 포함가)</span></p>
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
                                <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_st['pta_text']?></div>

                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?= $pta_st['pta_select1'] == 0 ? '선택안함': $pta_st['pta_select1'].'일';?></li>
<!--                                        <li><i class="fal fa-comment-alt-edit"></i>수정횟수 : --><?//=$pta_st['pta_select2']?><!--회</li>-->
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" name = "<?=$pta_st['pta_idx']?>" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <?php if(!empty($pta_de['pta_pay'])) {?> <!-- 패키지로 가격설정 시 조회 가능하도록 -->
                    <li class="item">
                        <h2 class="accordionTitle"><?=number_format($pta_de['pta_pay'])?>원 <span class="type">DELUXE</span>
                            <!--<span class="accIcon"></span>--></h2>
                        <div class="text">
                            <div class="box">
                                <p class="tit"><?=$pta_de['pta_title']?></p> <!-- 제목 -->
                                <p><?=$pta_de['pta_content']?></p><!-- 설명 -->
                                <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_de['pta_text']?></div>

                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?= $pta_de['pta_select1'] == 0 ? '선택안함': $pta_de['pta_select1'].'일';?></li>
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" name = "<?=$pta_de['pta_idx']?>" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if(!empty($pta_pr['pta_pay'])) {?> <!-- 패키지로 가격설정 시 조회 가능하도록 -->
                    <li class="item">
                        <h2 class="accordionTitle"><?=number_format($pta_pr['pta_pay'])?>원 <span class="type">PREMIUM</span>
                            <!--<span class="accIcon"></span>--></h2>
                        <div class="text">
                            <div class="box">
                                <p class="tit"><?=$pta_pr['pta_title']?></p> <!-- 제목 -->
                                <p><?=$pta_pr['pta_content']?></p><!-- 설명 -->
                                <div class="cont_list" style="white-space: pre-wrap;"><?=$pta_pr['pta_text']?></div>
                                <div class="work">
                                    <ul>
                                        <li><i class="far fa-clock"></i>작업일 : <?= $pta_pr['pta_select1'] == 0 ? '선택안함': $pta_pr['pta_select1'].'일';?></li>
<!--                                        <li><i class="fal fa-comment-alt-edit"></i>수정횟수 : --><?//=$pta_pr['pta_select2']?><!--회</li>-->
                                    </ul>
                                </div>
                                <input type="submit" value="구매하기" name = "<?=$pta_pr['pta_idx']?>" class="btn_submit">
                            </div>
                        </div>
                    </li>
                    <?php } ?>
					<li class="item">
						<h2 class="accordionTitle dir">직접입력</span>
							<!--<span class="accIcon"></span>--></h2>
						<div class="text">
							<div class="box">
								<p class="tit">가격 직접입력</p> <!-- 제목 -->
								<p>판매자와 상의 후 가격을 입력 후 결제해주세요.</p><!-- 설명 -->
								<div class="cont_list" style="white-space: pre-wrap;"></div>
								<div class="work">
									<ul>
										<input type="tel" placeholder="가격을 입력해주세요." id="pta_write_price_input" class="dir" name="pta_write_price_input" onkeyup="numberWithCommas(this)" style="width:100%; height:40px; text-indent:10px">
									</ul>
								</div>
								<input type="submit" value="구매하기" name = "pta_write_price" class="btn_submit">
							</div>
						</div>
					</li>
                </ul>
            </section>


            <!--재능인정보-->
            <section class="mem_info">
                <!--사진-->
                <div class="myimg">
                    <!-- 등록 이미지 있을 경우 -->
                    <div class="p_box">
                        <div class="img_rd">
                            <?php if(file_exists($dest_path)){
                                echo '<img class="p_img" src="'.$dest_url.'">';
                            }else{
                                echo '<img class="p_img" src="'.G5_THEME_IMG_URL.'/sub/default.png">';
                            } ?>
                        </div>
                        <p class="name"><?= $mb['mb_nick']?><i class="fal fa-user-tag"></i> </p>
                        <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                    </div>
                </div>
                <p class="text-center contact">
<!--                    <span>전화문의 : </span>--><?//= $mb['mb_hp']?><!--<br/>-->
                    <span>연락가능시간 : </span><?=date('H:i',strtotime($profile['pf_call_time1']))?>~<?=date('H:i',strtotime($profile['pf_call_time2']))?>
                </p>
                <div class="profile">
                    <ul>
                        <li>
                            <dl>
                                <dt>총 작업수</dt>
                                <dd><?=number_format($member_cnt)?><span>건</span></dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>의뢰인 만족도</dt>
                                <dd><i class="fas fa-star"></i><?=$member_avg?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>평균응답시간</dt>
                                <dd><?= $pf_time_list[$profile['pf_time']] ?></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                
                <!--자기소개글 더보기 기능은 일단 삭제-->
                <p class="introduce">
                      <span name="prev_produce" style="white-space: pre-wrap;display: inline;"><?= $profile['pf_produce'] ?></span>
                     <? /* = cut_str($profile['pf_produce'],30)  <div id="detail" class="collapse"><?= $profile['pf_produce'] ?></div> */ ?>
                </p>
                <? /* php if( mb_strlen($profile['pf_produce']) > 20 ){ ?>
                <div class="text-center t_margin10 b_margin10"><a data-toggle="collapse" data-target="#detail" class="t_margin10" onclick="detail_produce()">더보기 <i class="fal fa-angle-down"></i></a></div>
                <?php } */ ?>
                
                <!--보유자격증 안내-->
                <div class="certi">
                      <h4><i class="fal fa-address-card"></i> 보유 자격증 안내</h4>
                      <div class="certi_list">
                            <ul>
                                <?php for($i = 0; $i < count($certificate_arr); $i++) {
                                    if($certificate_arr[$i] != "") {
                                        echo '<li>' . $certificate_arr[$i] . '</li>';
                                    }else{
                                        echo '<li>보유 자격증 없음</li>';
                                    }
                                } ?>
<!--                                <li>운전면허증/202109/교통부</li>-->
                            </ul>
                      </div>
                </div>
                
<!--                <div class="request"><a href="javascript:question_modal()"><i class="fal fa-pen-square"></i> 문의 남기기</a></div>-->
                <!--전문인에게 채팅요청(방만들기//)-->
                <?php if($member['mb_id'] != $profile['mb_id']  && $is_member) { ?>
                    <?php if($member["mb_no"] != "31"){ ?>

                        <div class="request"><a onclick="chatting();"><i class="fal fa-pen-square"></i> 문의 채팅</a></div>
                    <?php } ?>
                <?php } ?>
            </section>
        </div>
        <!--//가격/재능 정보 오른쪽 모바일 사라짐-->
        
    </section>
    <!--아이템 뷰-->
<?php /*
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
                            <div class="tit">유튜브 구독자, 조회수 높은채널 활용 영상 채널수익창출 zzz드립니다.</div>
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
    <!--//관련 서비스--> */?>

</article>

<script id="rendered-js">

    function detail_produce(){
        $('[name = prev_produce]').css('display','none')
    }
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

        <?php //ios심사
        if ($user_agent == '/ioshappy100'){ ?>
            $(".btn_submit").css("display","none");
        <?php } ?>
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

<script>

    function question_update() {
        //문의남기기
        $.ajax({
            url: g5_bbs_url+'/ajax.competition.php',
            type: "POST",
            data: {
                "mode": "competition_comment_update",
                "wr_table": "talent",
                "wr_content": $('#tq_content').val(),
                "comment_idx": $('#comment_idx').val(),
                "mb_id": "<?=$mb['mb_id']?>",
                "talent_title": '<?=$ta['ta_title']?>',
                "alim_mode": 'comment_update',
                "wr_cp_idx": '<?=$ta['ta_idx']?>'
            },
            dataType: "json",
            success: function (data) {

                if (data.msg == 'success'){
                    swal('등록이 완료되었습니다.');
                    $('#Question').modal("hide"); //닫기
                    $('#tq_content').val("");
                    $('#tq_content_count').text("0");
                }
            },
        });

    }
    $('.doc_text').keyup(function (e) {
        var content = $("textarea#"+this.id).val();
        $('#'+this.id+'_count').text("" + content.length); // 글자 수 실시간 카운팅

        if(this.id.indexOf('content') != -1) { // 설명
            if (content.length > 500) {
                swal("최대 500자까지 입력 가능합니다.");
                var content_slice = content.slice(0, 500);
                $("textarea#"+this.id).val(content_slice);
                $('#'+this.id+'_count').text("500");
            }
        }


    });

    //이노페이 금액 보내기
    $(".btn_submit").on("click", function() {
        $('#pta_idx').val(this.name);
        $('#pta_write_price').val($(this).parent().find('input')[0].value.replace(/,/g, ""));
        $('#payfrm').submit();
    });

    // 평가 입력
    function review_insert() {
        if($('input[name=grade_stars]:checked').val() == undefined) {
            swal('평점을 선택해주세요.');
            return false;
        }

        $.ajax({
            url: g5_bbs_url+'/ajax.review_insert.php',
            type: "POST",
            data: {
                contents : $('#review_contents').val(),
                ta_idx : $('#ta_idx').val(),
                rating : $('input[name=grade_stars]:checked').val(),
            },
            success: function (data) {
                if (data == 'success'){
                    swal('평가 작성 완료하였습니다.')
                    .then(()=>{
                        location.replace(g5_bbs_url+'/item_view.php?idx='+$('#ta_idx').val());
                    });
                }
                else {
                    swal('구매자만 평가를 작성할 수 있습니다.');
                }
            },
        });
    }

    // 리뷰 더 보기
    var rows = 5;
    function review_append() {
        $.ajax({
            url: g5_bbs_url+'/ajax.review_append.php',
            type: "POST",
            data: {
                rows : rows,
                ta_idx : $('#ta_idx').val(),
            },
            success: function (data) {
                $('.rev').append(data);
                rows += 5;

                // 전체 리뷰 표시 시 더 보기 숨김
                if(rows >= '<?=$review_count?>') {
                    $('.review_more').hide();
                }
            },
        });
    }

    //로그인 안되어있으면 이동
    function question_modal() {
        <?php if($is_member){ ?>
        $('#Question').modal();
        <?php }else{ ?>
        swal('로그인 후 이용해주세요.').then(function(){
            document.location.replace( g5_bbs_url+ "/login.php" );
        });

        <?php } ?>

    }
</script>

<!--채팅-->
<form name="fchatting" id="fchatting" method="post">
    <input type="hidden" name="ta_idx" value="<?=$ta['ta_idx']?>">
    <input type="hidden" name="room_name" value="<?=$mb['mb_nick']?>">
    <input type="hidden" name="master_id" value="<?=$member['mb_id']?>">
    <input type="hidden" name="sub_id" value="<?=$mb['mb_id']?>">
    <input type="hidden" name="room_id" id="room_id" value="">
</form>
<script>
    $(function() {
        if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/chat_room.php');
        } else {
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/message.php');
        }
    });

    // 채팅방 입장
    function chatting() {
        var form = $('#fchatting')[0];
        var formdata = new FormData(form);

        $.ajax({
            url: g5_bbs_url+'/ajax.chat.control.php',
            processData: false,
            contentType: false,
            type: "POST",
            data: formdata,
            async: false,
            success: function (data) {
                if(data) {
                    $('#room_id').val(data);

                    $('#fchatting').submit();
                }
            },
        });
        /*if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/chat_room.php');
        } else {
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/message.php');
        }

        $('#fchatting').submit();*/
    }
    
    function report() {

        if(!confirm("해당 게시물을 신고하면 게시물이 차단되어 볼수 없습니다. 신고하시겠습니까?")){
            return false;
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            data: {"r_p_idx":'<?=$ta["ta_idx"]?>', "mode": "report_update"},
            type: 'POST',
            success : function(data) {
                if(data == 1){
                    swal('신고가 완료되었습니다. 신고된 게시물은 차단됩니다.').then(function(){
                        document.location.replace(g5_bbs_url + "/category_list.php?category=<?=common_code($ta['ta_category1'], 'code_idx')[0]['name']?>");

                    });
                    // $('#del_file').val(data);
                }else if (data == 2){
                    swal("이미 신고한 게시물 입니다.");
                }else{
                    swal("통신에 실패했습니다.");
                }
                $('#ReportModal').hide();
                $('[name = r_content]').val('');
            },
            err : function(err) {
                alert(err.status);
            }
        });
    }

    function numberWithCommas(x) {
        var val = x.value;
        var id = x.id;
        final_val = val.replace(/[^0-9]/g,''); // 입력값이 숫자가 아니면 공백
        final_val = final_val.replace(/,/g,''); // ,값 공백처리
        $("#"+id).val(final_val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
    }
</script>