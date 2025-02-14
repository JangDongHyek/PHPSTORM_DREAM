<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
include_once(G5_BBS_PATH . "/profile_modal.php")

?>

<style>
    .noblur img, .noblur {
        -webkit-filter: blur(0px) !important;
        -moz-filter: blur(0px) !important
        -o-filter: blur(0px) !important;
        -ms-filter: blur(0px) !important;
        filter: blur(0px) !important;
    }

    .profilecate li a{
        font-size: 1.1em;
    }
    .cont .chul {
        width: 50%;
        text-align: right;
    }
    .cont .chul p {
        word-break: keep-all;
    }
</style>

<!-- 관심있어요 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">알림창</h4>
                </div>
                <div class="modal-body">
                    <strong class="nick">닉네임</strong> 회원님을 결제전회원으로 이미 등록하셨습니다^^
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">확인</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 관심있어요 모달팝업 -->

<!-- 신고하기 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">신고합니다</h4>
                </div>
                <div class="modal-body">
                    <div class="reason">
                        <select name="report_category" id="report_category" class="sch_sel">
                            <option value="대화관련">대화관련</option>
                            <option value="허위 개인정보">허위 개인정보</option>
                            <option value="광고 및 음란성 사진/글">광고 및 음란성 사진/글</option>
                            <option value="기타">기타</option>
                        </select>
                    </div>
                    <div class="cont">
                        <textarea class="form-control" rows="4" id="report_contents" name="report_contents" placeholder="신고내용을 입력해 주세요"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="member_report('register');">신고하기</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 신고하기 모달팝업 -->

<!-- 메세지 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">메세지 보내기</h4>
                </div>

                <!-- 나이차 7살나면 메세지 막는부분 wc -->
                <?php
                $member_year    =   substr($member["mb_birth"],0,4);
                $mb_year        =   substr($mb["mb_birth"],0,4);
                $age_dif        =   abs($member_year-$mb_year);
                $sql = "select * from g5_member_hope where mb_id = '{$member['mb_id']}' ";
                $member_mh = sql_fetch($sql);
                // 7살차이 AND 7살차이 제한이 아니오일때 가능
                ?>
                <?php if($age_dif >= 7 && $member_mh['mh_ten'] !='N'){ ?>
                    <div class="modal-body msg_con">
                        <div class="to_name"><strong class="nick"></strong>께 보내는<span class="ht"><i class="fas fa-heart"></i></span>메세지<span class="ht"><i class="fas fa-heart"></i></span></div>
                        <div class="cont">
                  <textarea class="form-control doc-text" rows="6" id="message" name="message"
                            placeholder="저희 어플은 7살이상 연상이나 연하에게는 메세지 강제제한합니다.&#13;&#10;7살이상 차이나는 분이 마음에 드실경우 관리자에게 문의하세요." readonly style="resize: unset;"></textarea>
                            <p id="counter">0 / 최대 200자</p>
                        </div>
                    </div><!--msg_con-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo G5_URL."/bbs/board.php?bo_table=qna" ?>'"><i class="fas fa-paper-plane"></i> 문의하러 가기</button>
                        <input type="hidden" id="receive_mb_no" name="receive_mb_no">
                    </div>
                <?php }else{ ?>
                    <div class="modal-body msg_con">
                        <div class="to_name"><strong class="nick"></strong>께 보내는<span class="ht"><i class="fas fa-heart"></i></span>메세지<span class="ht"><i class="fas fa-heart"></i></span></div>
                        <div class="cont">
                            <textarea class="form-control doc-text" rows="6" id="message" name="message" placeholder="200자 이내로 내용을 입력해 주세요." style="resize: unset;"></textarea>
                            <p id="counter">0 / 최대 200자</p>
                        </div>
                    </div><!--msg_con-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="send_message();"><i class="fas fa-paper-plane"></i> 메세지 전송하기</button>
                        <input type="hidden" id="receive_mb_no" name="receive_mb_no">
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 메세지 모달팝업 -->

<!-- 사진확대 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">프로필사진</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 5px;">
                    <div class="swiper-container">
                        <div class="swiper-wrapper <?=$blur?>">
                            <?php
                            // 프로필 이미지
                            $sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by idx ";
                            $file_result = sql_query($sql);

                            for($i=0; $file_row=sql_fetch_array($file_result); $i++) {
                                ?>
                                <img class="swiper-slide" src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file_row['img_file']?>" />
                            <?php } ?>
                        </div>
                        <div class="profile_img_prev" style="position: absolute; top: 0; bottom: 0; left: 0; width: 50%; cursor: pointer; z-index: 2;"></div>
                        <div class="profile_img_next" style="position: absolute; top: 0; bottom: 0; right: 0; width: 50%; cursor: pointer; z-index: 2;"></div>
                    </div>
                </div>
                <?php if($message == 0 && $profile_view == 0 && !$ios_payment_test) { ?>
                    <div class="modal-footer" style="padding-top: 5px">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">확인img_view</button>-->
                        <input type="button" class="btn btn-default img-view" value="사진보기" onclick="img_view(<?=$mb_no?>);">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 관심있어요 모달팝업 -->


<!--회원상세페이지(기본정보)-->
<div id="mem_view">
    <!--상단카테고리-->
    <!--
        <ul class="profilecate cf">
            <li class="active"><a href="#info01">배우자 정보</a></li>
            <li><a href="#info02" >신앙정보</a></li>
            <li><a href="#info04" >나의정보</a></li>
            <li><a href="#info03" >사진정보</a></li>
            <li><a href="#info05" >학벌/연봉/재산정보</a></li>
            <li><a href="#info06" >서류정보</a></li>
        </ul>
    -->

    <!--내용부분-->
    <div class="in">
        <div class="top_info">
            <div class="my">
                <div class="mg">
                    <?php if($blur =="noblur") { ?>
                        <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />
                    <?php } else { ?>
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                    <?php } ?>
                </div>
                <div class="nick <?=$bg?>">
                    <span class="mem_type"><?=$mb['mb_join_type']?></span><?=$mb['mb_nick']?>
                    <?php $sql = " select * from g5_member_disabled where mb_no = {$mb_no} order by idx ";
                    $result = sql_query($sql);

                    for($i=0; $row=sql_fetch_array($result); $i++) { ?>
                        <span class="mem_type"><?=$row['disab_type1']." ".$row['disab_type2']?></span>
                    <?php } ?>
                </div><!--닉네임 추출-->
                <div class="inf">
                    <span><?=$name?></span>
                    <span><?=$mb['mb_sex']?></span>
                    <?php
                    if($mb['mb_birth']){
                        // 생년월일로 나이 계산
                        $birthyear_mb = substr($mb['mb_birth'],0,4);
                        $nowyear_mb = date("Y");
                        $age_mb = $nowyear_mb - $birthyear_mb + 1;
                    }else{
                        $age_mb = "-";
                    }
                    ?>
                    <!--
                    <span><?=$age_mb?>살</span>
                    -->
                    <!--                <span><?=$mb['mb_blood_type']?>형</span>-->
                </div>
                <?php if ($member["mb_no"] == $mb['mb_no']){ ?><button onclick="javascript:$('#profile_com').modal()" class="btn_profile">내 프로필 수정신청하기</button><?php } ?>
                <!--
                <div class="body">
                <span>신체조건</span> <strong class="fix_blur"><?=$mb['mb_height']?></strong>cm / <strong class="fix_blur"><?=$mb['mb_weight']?></strong>kg
                </div>
-->
            </div><!--my-->
            <div class="m_btn cf <?=$hide?>">
                <!-- 특정회원 비노출-->
                <a class="private" href="#"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private.svg" /><span>비노출</span></a>

                <a href="#" onclick="member_love('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><span id="zzim_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$zzim?>.png" /></span><span id="zzim_text"><?=$zzim_text?></span></a>
                <!--관심있어요 누르면 확인창이 뜨게 되고, 회원닉네임을 추출함 / 확인 버튼 누르면 해당회원이 내결제전회원 리스트에 올라감-->

                <!--<a href="#" onclick="member_love('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_zzim_on.png" /><span>관심등록중</span></a>-->
                <!--관심등록중상태-->


                <a href="javascript:void(0);" onclick="send_message_modal('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_talk.png" /><span>메세지</span></a><!--메세지 클릭하면 메세지 보내기 창이 뜨게 됨. 회원닉네임을 추출. 전송하기 하면 내 메시지함의 보낸메세지함에 쌓임-->
                <a href="#" onclick="member_report();"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_singo.png" /><span><?=$member['mb_id'] == 'hong' ? '신고/차단' : '신고하기'; ?></span></a>
                <!--                --><?php //if ($member["mb_id"] == "test1"){ ?>
                <a href="javascript:cart_in(<?=$mb['mb_no']?>,'<?=$mb['mb_nick']?>')">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_cart.png"><span>결제후회원 담기</span>
                </a>
                <!--                --><?php //} ?>
            </div><!--m_btn-->
            <!--
            <div class="bx">
            	<dl>
                	<dt>지역</dt>
                    <dd><?=$mb['mb_live_si']?> <?=$mb['mb_live_gu']?></dd>
                </dl>
            	<dl>
                	<dt>휴대전화</dt>
                    <dd class="hp"><?=$mb['mb_hp']?></dd>
                </dl>
            	<dl style="margin-bottom: 10px;">
                	<dt>직업</dt>
                    <dd><?=$mb['mb_job']?></dd>
                </dl>
-->
            <!--            	<dl style="margin-bottom: 10px;">-->
            <!--                	<dt>출석교회</dt>-->
            <!--                    <dd class="church --><?php //echo $mb['mb_church_show'] == 'Y' ? 'noblur' : $blur; ?><!--">--><?//=$mb['mb_church']?><!--</dd>-->
            <!--                </dl>-->
            <!--            </div>-->
        </div><!--top_info-->
        <div class="con_info">
            <div class="list" id="info01">
                <dl class="part">
                    <dt class="title">배우자정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <!--							<dt class="part_title">희망하는 직업</dt>-->
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt">
                                        <strong>희망하는 직업</strong>
                                    </div>
                                </div>
                                <div class="bk" style="text-align:right;">
                                    <?php for ($i=0; $i < count($mh_job); $i++) {
                                        $ctg_key = array_search($mh_job[$i], array_column($mh_job_arr, 'code'));
                                        ?>
                                        <span><?= $mh_job_arr[$ctg_key+1]["name"] ?></span>
                                    <?php } ?>
                                    <?php if (in_array('8', $mh_job)) echo "<br>직접기재: ".$mh['mh_job_memo'] ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 키</strong></div>
                                </div>
                                <div class="chul">
                                    <?php for ($i=0; $i < count($mh_height); $i++) {
                                        $ctg_key = array_search($mh_height[$i], array_column($mh_height_arr, 'code'));
                                        ?>
                                        <p><?= $mh_height_arr[$ctg_key+1]["name"] ?></p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 학벌</strong></div>
                                </div>
                                <div class="chul">
                                    <?php for ($i=0; $i < count($mh_school); $i++) {
                                        $ctg_key = array_search($mh_school[$i], array_column($mh_school_arr, 'code'));
                                        ?>
                                        <p><?= $mh_school_arr[$ctg_key+1]["name"] ?></p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 연봉</strong></div>
                                </div>
                                <div class="chul">
                                    <?php for ($i=0; $i < count($mh_salary); $i++) {
                                        $ctg_key = array_search($mh_salary[$i], array_column($mh_salary_arr, 'code'));
                                        ?>
                                        <p><?= $mh_salary_arr[$ctg_key+1]["name"] ?></p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 근무형태</strong></div>
                                </div>
                                <div class="chul">
                                    <?php for ($i=0; $i < count($mh_type); $i++) {
                                        $ctg_key = array_search($mh_type[$i], array_column($mh_type_arr, 'code'));
                                        ?>
                                        <p><?= $mh_type_arr[$ctg_key+1]["name"] ?></p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 스타일</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?php $ctg_key = array_search($mh["mh_style"], array_column($mh_style_arr, 'code'));
                                        echo $mh_style_arr[$ctg_key+1]["name"]?></p>
                                    <?php  if ($mh["mh_style"] == 5 ) echo "<input type=\"text\" value = \"".$mh['mh_style_memo']."\" name=\"mmh_style_memo\" >" ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>희망하는 상대의 결혼 여부</strong></div>
                                </div>
                                <div class="chul">
                                    <?php for ($i=0; $i < count($mh_marry_yn); $i++) {
                                        $ctg_key = array_search($mh_marry_yn[$i], array_column($mh_marry_yn_arr, 'code'));
                                        ?>
                                        <p><?= $mh_marry_yn_arr[$ctg_key+1]["name"] ?></p>
                                    <?php } ?>
                                </div>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </div>
            <div class="list" id="info02">
                <dl class="part">
                    <dt class="title">신앙정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>신앙정보</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?=$mi_chance_arr[$mi["mi_chance"]]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>교회를 다닌 기간</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?=$mi_date_arr[$mi["mi_date"]]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>봉사</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?=$mi_angel_arr[$mi["mi_angel"]]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>십일조 여부</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?=$yn_arr[$mi["mi_ten"]]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>감사헌금 여부</strong></div>
                                </div>
                                <div class="chul">
                                    <p><?=$yn_arr[$mi["mi_tk"]]?></p>
                                </div>
                            </dd>
                        </dl>
                        <?php if ($mi["mi_church_open"] == 1){ ?>
                            <dl class="part_info">
                                <dd class="part_cont">
                                    <div class="bk"><div class="pt"><strong>다니는 교회이름</strong></div>
                                    </div>
                                    <div class="chul">
                                        <p><?=$mi["mi_church1"]?></p>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="part_info">
                                <dd class="part_cont">
                                    <div class="bk"><div class="pt"><strong>다니는 교회 담임목사</strong></div>
                                    </div>
                                    <div class="chul">
                                        <p><?=$mi["mi_church2"]?></p>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="part_info">
                                <dd class="part_cont">
                                    <div class="bk"><div class="pt"><strong>다니는 교회위치</strong></div>
                                    </div>
                                    <div class="chul">
                                        <p><?=$mi["mi_church_place1"]." ".$mi["mi_church_place2"]." ".$mi["mi_church_place3"]?></p>
                                    </div>
                                </dd>
                            </dl>
                        <?php }?>
                    </dd>
                </dl>
            </div>
            <div class="list" id="info03">
                <dl class="part">
                    <dt class="title">사진정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <div class="bk"><div class="pt"><strong>프로필사진</strong></div></div>
                            <ul class="photo cf"><!--해당사진 클릭하면 확대보기-->
                                <?php
                                // 프로필 이미지
                                $sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by idx ";
                                $file_result = sql_query($sql);

                                for($i=0; $file_row=sql_fetch_array($file_result); $i++) {
                                    ?>
                                        <!--
                                    <li class="<?=$blur?>" onclick="img_large('<?php echo G5_DATA_URL; ?>/file/member/<?=$file_row["img_file"]?>')"><img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file_row['img_file']?>" /></li>
                                    -->
                                    <li class="" onclick="img_large('<?php echo G5_DATA_URL; ?>/file/member/<?=$file_row["img_file"]?>')"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" /></li>

                                <?php } ?>
                            </ul><!--photo-->
                        </dl>
                    </dd>
                </dl>
            </div>
            <div class="list" id="info04">
                <dl class="part">
                    <dt class="title">나의정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>직업</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb["mb_job"]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>사는 지역</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb['mb_live_si']." ".$mb['mb_live_gu']?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>나이</strong></div></div>
                                <div class="chul">
                                    <?php
                                    // 생년월일로 나이 계산
                                    if($mb['mb_birth']){
                                        $birthyear_mb = substr($mb['mb_birth'],0,4);
                                        $nowyear_mb = date("Y");
                                        $age_mb = $nowyear_mb - $birthyear_mb + 1;
                                    }else{
                                        $age_mb = "-";
                                    }
                                    ?>

                                    <p><?=$age_mb?></p>
                                </div>
                            </dd>
                        </dl>

                        <!--        				<dl class="part_info">-->
                        <!--							<dd class="part_cont">-->
                        <!--								<div class="bk"><div class="pt"><strong>키</strong></div></div>-->
                        <!--								<div class="chul">-->
                        <!--									<p>--><?//=$mb["mb_height"]?><!--cm</p>-->
                        <!--								</div>-->
                        <!--							</dd>-->
                        <!--						</dl>-->
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>mbti</strong></div>
                                </div>
                                <div class="chul"><?=$mb["mb_mbti"]?></div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>혈액형</strong></div>
                                </div>
                                <div class="chul"><?=$mb["mb_blood_type"]?>형</div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>좋아하는 취미</strong></div>
                                    <?php
                                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                    if(!empty($mb['mb_no'])) {
                                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                    }
                                    $sql .= " where co.co_code_name = '취미' order by co.co_code*1 ";
                                    $result = sql_query($sql);
                                    for($i=0;$row=sql_fetch_array($result);$i++) {
                                        $class_on = "";
                                        $checked = "";
                                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {

                                            ?>
                                            <span><?=$row['co_main_code_value']?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">

                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>좋아하는 관심사</strong></div>
                                    <div class="chul" style="width:100%; text-align:left;">
                                        <div class="pt">
                                            <strong>영화부문</strong>
                                            <?php
                                            $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                            if(!empty($mb['mb_no'])) {
                                                $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                            }
                                            $sql .= " where co.co_code_name = '영화' order by co.co_code*1 ";
                                            $result = sql_query($sql);
                                            for($i=0;$row=sql_fetch_array($result);$i++) {

                                                if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {

                                                    ?>
                                                    <span><?=$row['co_main_code_value']?></span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="pt">
                                            <strong>음악부분</strong>
                                            <?php
                                            $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                            if(!empty($mb['mb_no'])) {
                                                $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                            }
                                            $sql .= " where co.co_code_name = '음악' order by co.co_code*1 ";
                                            $result = sql_query($sql);
                                            for($i=0;$row=sql_fetch_array($result);$i++) {

                                                if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {

                                                    ?>
                                                    <span><?=$row['co_main_code_value']?></span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="pt">
                                            <strong>TV부문</strong>
                                            <?php
                                            $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                            if(!empty($mb['mb_no'])) {
                                                $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                            }
                                            $sql .= " where co.co_code_name = 'TV' order by co.co_code*1 ";
                                            $result = sql_query($sql);
                                            for($i=0;$row=sql_fetch_array($result);$i++) {

                                                if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {

                                                    ?>
                                                    <span><?=$row['co_main_code_value']?></span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>연인과 함께 먹고 싶은 음식</strong></div>
                                    <div class="chul" style="width:100%; text-align:left;">
                                        <span><?php echo empty($mi['mi_food']) ? '등록예정입니다.' : ($mi['mi_food'] == '6' ?  $mi['mi_food_memo'] : $mi_food_arr[$mi['mi_food']])?></span>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>연인이 생기면 하고 싶은 것</strong></div>
                                    <div class="chul" style="width:100%; text-align:left;">
                                        <span><?php echo empty($mi['mi_want']) ? '등록예정입니다.' : $mi['mi_want'] ?></span>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>나의 매력 혹은 장점</strong></div>
                                    <div class="chul" style="width:100%; text-align:left;">
                                        <span><?php echo empty($mi['mi_charming']) ? '등록예정입니다.' : ($mi['mi_charming'] == '6' ?  $mi['mi_charming_memo'] : $mi_charming_arr[$mi['mi_charming']])?></span>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </div>
            <div class="list" id="info05">
                <dl class="part">
                    <dt class="title">학벌/연봉/재산정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>키</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb["mb_height"]?>cm</p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>몸무게</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb["mb_weight"]?>kg</p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>최종졸업 학교</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb["mb_school_sel"]." ".$mb["mb_school"]?></p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk"><div class="pt"><strong>학과</strong></div></div>
                                <div class="chul">
                                    <p><?=$mb["mb_department"]?>학과</p>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>본인연봉</strong></div>
                                </div>
                                <div class="chul">
                                    <?=$mb['mb_salary']?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>자차소유여부</strong></div>
                                </div>
                                <div class="chul">
                                    <?=$yn_arr2[$mb["mb_mycar"]]?><br>
                                    <?php echo $mb["mb_mycar"] == "Y" ? '<p>'.$mb["mb_mycar_name"].'</p>' : ""?>
                                </div>
                            </dd>
                        </dl>
                        <dl class="part_info">
                            <dd class="part_cont">
                                <div class="bk">
                                    <div class="pt"><strong>자가소유여부</strong></div>
                                </div>
                                <div class="chul">
                                    <?=$yn_arr2[$mb["mb_myhome"]]?>
                                </div>
                            </dd>
                        </dl>
                        <?php if ($mb["mb_join_type"] == "재혼"){ ?>
                            <dl class="part_info">
                                <dd class="part_cont">
                                    <div class="bk">
                                        <div class="pt"><strong>재혼일 경우 자녀</strong></div>
                                    </div>
                                    <div class="chul">
                                        <p><?=$mb["mb_children"]?></p>
                                    </div>
                                </dd>
                            </dl>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
            <div class="list" id="info06">
                <dl class="part">
                    <dt class="title">서류정보<span class="btn_arrow"><i class="fal fa-angle-down"></i></span></dt>
                    <dd class="cont">
                        <dl class="part_info">
                            <div class="bk"><div class="pt"><strong>등록한 서류</strong></div></div>
                            <ul class="addfile cf"><!--해당사진 클릭하면 확대보기-->
                                <li class="">
                                    <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file_row['img_file']?>" />
                                </li>
                            </ul><!--addfile-->
                        </dl>
                    </dd>
                </dl>
            </div>



        </div><!--con_info-->
    </div><!--in-->
</div><!--mem_view-->
<!--회원상세페이지(기본정보)-->

<script>


    //textarea 글자 수 제한
    $('.doc-text').keyup(function (e) {
        var content = $("textarea#message").val();
        $('#counter').html("" + content.length + " / 최대 200자");    //글자수 실시간 카운팅

        if (content.length > 200) {
            alert("최대 200자까지 입력 가능합니다.");
            $(this).val(content.substring(0, 200));
            $('#counter').html("200 / 최대 200자");
        }
    });

    // 관심있어요
    function member_love(mb_no, mb_nick) {
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.reg_member_love.php",
            data: {mb_no: mb_no},
            success: function (data) {
                if(data == 'success') {
                    $('#myModal .nick').text(mb_nick);
                    $('#myModal .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 회원님을 결제전회원으로 등록하였습니다.');
                    $('#zzim_text').html('관심<br>등록중');
                    $('#zzim_img').html('<img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_zzim_on.png" />');

                } else {
                    $('#myModal .modal-body').text('이미 결제전회원으로 등록된 회원입니다.');
                }
                $('#myModal').modal('show');
            }
        });
    }

    // 프로필 사진 확대
    function img_large(src) {
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 2,
        });
        $('.profile_img_next').click(function () {
            swiper.slideNext();
        });
        $('.profile_img_prev').click(function () {
            swiper.slidePrev();
        });

        $('#myModal3').on('shown.bs.modal', function(e) {
            swiper.update();
        });

        $('#myModal3').modal('show');
        // $('#myModal3 .modal-body img').attr('src', src);
    }

    // 신고하기
    function member_report(op) {
        $('#myModal2').modal('show');
        if(op == 'register') {
            if($.trim($('#report_contents').val()) == '') {
                swal('신고내용을 입력하세요.');
                return false;
            }
        }
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.reg_member_report.php",
            data: {
                mb_no: <?=$mb_no?>,
                category: $('#report_category').val(),
                contents: $('#report_contents').val(),
                op: op,
            },
            success: function (data) {
                if(op == 'register') {
                    if(data == 'success') {
                        <?php if($member['mb_id'] == 'hong') { ?>
                        swal('신고완료되었습니다.\n신고한 회원을 차단합니다.')
                            .then(() => {
                                location.href = g5_bbs_url+'/mem_new.php';
                            });
                        <?php } else { ?>
                        swal('신고완료되었습니다.')
                            .then(() => {
                                $('#myModal2').modal('hide');
                            });
                        <?php } ?>
                    }
                } else {
                    if(data > 0) {
                        $('#myModal2 .modal-body').text('이미 신고한 회원입니다.');
                        $('#myModal2 .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">확인</button>');
                    }
                }
            }
        });
    }

    // 메세지 모달
    function send_message_modal(mb_no, mb_nick) {
        // 초기화
        $('textarea#message').val('');
        $('#counter').html("0 / 최대 200자");
        $('#myModal6 .nick').text(mb_nick); // 닉네임
        $('#receive_mb_no').val(mb_no); // 받는사람
        $('#myModal6').modal('show');
    }

    // 메시지 전송하기
    var is_post = false;
    function send_message() {
        if(is_post) {
            return false;
        }
        is_post = true;

        if($.trim($('#message').val()).length == 0) {
            swal('메세지를 입력해주세요.');
            is_post = false;
            return false;
        }

        var text = "\n<?=$manna_arr['message']?>만나가 차감됩니다.";
        <?php if ($ios_payment_test || $member["mb_level"] == 10){ ?>
        text = "";
        <?php } ?>
        swal({
            text: "메세지를 보내시겠습니까?"+text,
            icon: "warning",
            buttons: {
                cancel: "취소",
                defeat: "확인",
            }
        }).then((value) => {
            switch (value) {
                case "defeat":
                    $.ajax({
                        type: 'POST',
                        url: g5_bbs_url + "/ajax.send_message.php",
                        data: {mb_no: $('#receive_mb_no').val(), message: $('textarea#message').val()},
                        success: function (data) {
                            if (data == 'success') {
                                swal('메세지를 전송하였습니다.')
                                    .then(() => {
                                        $('#myModal6').modal('hide');
                                    });
                            } else {
                                swal('메세지를 보낼 만나가 부족합니다.')
                                    .then(() => {
                                        $('#myModal6').modal('hide');
                                        location.href = g5_bbs_url + "/user_level.php"

                                    });
                            }
                        }
                    });
            }
            is_post = false;

        });

    }

    // 프로필 이미지 블러 해제 -- 확인 시 20만나 차감 --> 23.04.04 30만나로 변경 --> 23.10.24 만나 array로 뺌 wc
    function img_view(mb_no) {
        swal({
            text: "프로필사진을 보시겠습니까?\n<?=$manna_arr['photo']?>만나가 차감됩니다.",
            icon: "warning",
            buttons: {
                cancel: "취소",
                defeat: "확인",
            }
        })
            .then((value) => {
                switch (value) {
                    case "defeat":
                        $.ajax({
                            type: 'POST',
                            url: g5_bbs_url + "/ajax.profile_img_view.php",
                            data: {mb_no: mb_no},
                            success: function (data) {
                                if(data == 'fail') {
                                    swal('만나가 부족합니다.').then(() => {
                                        location.href = g5_bbs_url + "/user_level.php"
                                    });
                                }
                                else if(data == 'success') {
                                    swal('<?=$manna_arr['photo']?>만나가 차감되었습니다.')
                                        .then(() => {
                                            $('#basic_modal .modal-body .swiper-container img').attr('style', 'filter: blur(0px) !important;');
                                            $('.img-view').attr('style', 'display:none;');
                                        });
                                }
                            }
                        });
                        break;
                }
            });
    }


    //	회원상세뷰 토글
    $('.title').on('click',function(){

        var title_text = $(this).text();
        var click_this = $(this);
        var text1= "";

        <?php if($ios_payment_test){ ?>
        if(title_text == "서류정보"){
            swal("서류정보는 관리자에게 문의해주세요");
            return false;
        }else {
            click_this.next('.cont').slideToggle(100, 'linear');
            return false;
        }
        <?php } ?>

        //if 문안에 있는 정보일 경우 그냥 보여주기
        if (title_text != "사진정보" && title_text != "서류정보" && title_text != "배우자정보"&& title_text != "신앙정보" && "<?=$member['mb_no']?>" != "<?=$mb['mb_no']?>") {

            //학벌/연봉/재산정보일 경우 승인 후 차감
            if (title_text == "학벌/연봉/재산정보"){
                text1 = "\n<?=$manna_arr['education']?>만나가 차감되고 상대방이 열람을 거절 할 경우 <?=$manna_arr['education']?>만나가 다시 환불됩니다.";
            }//23.04.04 나의정보만 50만나로 변경 wc
            else if (title_text == "나의정보"){
                text1 = "\n<?=$manna_arr['myprofile']?>만나가 차감됩니다.";
            }else{
                text1 = "\n<?=$manna_arr['education']?>만나가 차감됩니다.";

            }

            //해당 섹션을 봤는지 안봤는지 확인.
            $.ajax({
                type: 'POST',
                url: g5_bbs_url + "/ajax.controller.php",
                data: {mb_no: "<?=$mb['mb_no']?>", mode:"section_manna_check",section:title_text},
                success: function (data) {
                    if(data == 'fail') {
                        swal({
                            text: title_text + " 보시겠습니까? "+text1,
                            icon: "warning",
                            buttons: {
                                cancel: "취소",
                                defeat: "확인"
                            }
                        })
                            .then((value) => {
                                switch (value) {
                                    case "defeat":
                                        $.ajax({
                                            type: 'POST',
                                            url: g5_bbs_url + "/ajax.controller.php",
                                            data: {mb_no: "<?=$mb['mb_no']?>", mode:"section_manna",section:title_text},
                                            success: function (data) {
                                                if(data != 'success') {
                                                    swal(data).then(() => {
                                                        if(data == "만나가 부족합니다."){
                                                            location.href = g5_bbs_url + "/user_level.php"
                                                        }
                                                    });
                                                }
                                                else if(data == 'success') {
                                                    if (title_text == "나의정보"){
                                                        var point_wc = <?=$manna_arr['myprofile']?>;
                                                    }else{
                                                        var point_wc = <?=$manna_arr['education']?>;
                                                    }
                                                    swal( point_wc +'만나가 차감되었습니다.')
                                                        .then(() => {
                                                            //학벌 연봉재산정보는 열람승인 후 보여줘야함
                                                            if(title_text != "학벌/연봉/재산정보") {
                                                                click_this.next('.cont').slideToggle(100, 'linear');
                                                            }
                                                        });
                                                }
                                            }
                                        });
                                        break;

                                    case "section":
                                        $.ajax({
                                            type: 'POST',
                                            url: g5_bbs_url + "/ajax.controller.php",
                                            data: {mb_no: "<?=$mb['mb_no']?>", mode:"section_minus",section:title_text},
                                            success: function (data) {
                                                if(data == 'fail') {
                                                    swal('섹션 횟수가 부족합니다.');
                                                }
                                                else if(data == 'success') {
                                                    swal('1섹션 횟수가 차감되었습니다.')
                                                        .then(() => {
                                                            click_this.next('.cont').slideToggle(100,'linear');
                                                        });
                                                }
                                            }
                                        });
                                        break;
                                }
                            });
                    } else if(data == 'success') {
                        click_this.next('.cont').slideToggle(100, 'linear');
                        return false;

                    }else if(data == "info_w") {
                        swal("열람 미승인 상태입니다. \n승인 시 보여지게 됩니다.");
                        return false;
                    }else if (data =="info_n"){
                        swal("열람을 거절했습니다. 해당 정보를 보실 수 없습니다.");
                        return false;
                    }

                }
            });

        }else if(title_text == "서류정보"){
            swal("서류정보는 관리자에게 문의해주세요");
            return false;
        }else{
            click_this.next('.cont').slideToggle(100,'linear');
        }
    });

    function cart_in(no,mb_nick) {
        $.ajax({
            url: g5_bbs_url + '/ajax.controller.php',
            data: {
                mb_no : no,
                mode : "cart_in"
            },
            type: 'POST',
            success: function(data) {

                if(data == 'success') {
                    $('#myModal .nick').text(mb_nick);
                    $('#myModal .modal-body').html('<strong class="nick">'+mb_nick+'</strong> 회원님을 결제후회원에 담았습니다.');
                } else {
                    $('#myModal .modal-body').text('이미 결제후회원에 담은 회원입니다.');
                }
                $('#myModal').modal('show');
            }
        });
    }
</script>