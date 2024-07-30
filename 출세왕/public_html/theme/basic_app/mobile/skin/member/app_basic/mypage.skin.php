<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
if ($member['mb_level'] == 2){
    $register_url = "register_form";
}else{
    $register_url = "register_form_manager";

}
?>
<!-- 쿠폰 불러오기 모달팝업 wc-->
<div id="basic_modal_coupon">
    <!-- Modal -->
    <div class="modal fade" id="myModal_coupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">내 쿠폰</h4>
                </div>
                <div class="modal-body">
                    <?php if ($coupon_cnt <= 0){ ?>
                    <!--등록된 쿠폰이 없을때는 아래 부분이 뜨도록-->
                    <div class="service_none"><span><i class="fas fa-smile"></i></span>사용 가능한 쿠폰이 없습니다.</div>
                </div>
                <?php }else{ ?>
                <ul class="mcar_list">
                    <?php
                    $recomend_array = array();
                    $recomend_cnt = 0;
                    for($k = 0; $cp = sql_fetch_array($coupon_result); $k++){
                        array_push($recomend_array,explode("-", $cp['cp_subject'])[0] );
                        $recomend_cnt++;
                        //사용 가능한 쿠폰인지 체크
                        if (is_used_coupon($member['mb_id'], $cp['cp_id']))
                            continue;

                        $price = $money_list[$cdt . "" . $cs];
                        $dc = 0;

                        if ($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
                            $dc = $cp['cp_maximum'];

                        if($cp['cp_type'])
                            $cp_price = $cp['cp_price'].'%';
                        else
                            $cp_price = number_format($cp['cp_price']).'원';

                        ?>


                        <li id="idx_<?=$cp['cp_id']?>" onclick="coupon_select(this)">
                            <h4 class="color-blue"><span class="ico"><i class="fa-solid fa-ticket"></i></span><span name="modal_cp_price_view"> <?= $cp_price ?></span></h4>
                            <p class="color-blue"><span name="modal_cp_subject"> <?= $cp['cp_subject']?></span> </p>
                            <p class="color-gray"><span name="modal_cp_id"> <?= $cp['cp_id'] ?></span> </p>
                            <span name="modal_cp_price" style="display: none"> <?= $cp['cp_price']?></span>
                            <span name="modal_cp_type" style="display: none"> <?= $cp['cp_type']?></span>
                        </li>
                    <?php } ?>

                    <?php if($recomend_array){ ?>
                        <li>
                            <p class="color-gray">
                                <span name="modal_cp_id">
                                    추천인 <?=$recomend_cnt?>명 :
                                    <?= implode(", ",$recomend_array) ?>
                                </span>
                            </p>
                        </li>
                    <?php } ?>
                    <!--                <li class="select"><span class="ico"><i class="fas fa-car"></i></span>12가1234 / 제네시스 G80 / 검정색</li>-->
                </ul>
            </div>
            <?php } ?>


        </div>
    </div>
</div>
</div><!--basic_modal-->
<!-- 쿠폰 불러오기 모달팝업 -->




<!--마이페이지 시작-->
<div id="mypage">
	<div class="in">
        <div class="top_info">
            <h2 class="title"><?= $member['mb_name']?><span>님</span></h2><!--title-->
            <?php if ($is_member) { ?>
            <ul class="lg_btn">

            	<li><a href="<?php echo G5_BBS_URL ?>/<?=$register_url?>.php?w=u&mb_id=<?= $member['mb_id']?>"><i class="fas fa-pen-square"></i> 내정보</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-lock-open-alt"></i> 로그아웃</a></li>
                <li><a data-toggle="modal" data-target="#myModal_coupon" class="car_btn"><i class="fa-solid fa-ticket"></i> 쿠폰</a></li>
            </ul>
            <?php } else { ?>
            <?php } ?>


            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_reser.php">내 예약현황 <span class="co"><i class="fas fa-calendar-edit"></i></span></a></div>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_car.php">내 차량관리<span class="co"><i class="fas fa-car"></i></span></a></div>
            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_service_end.php">완료된 서비스<span class="co"><i class="fas fa-car-wash"></i></span></a></div>
            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_clean_reser.php">청소서비스<span class="co"><i class="fas fa-shower"></i></span></a></div>
        </div><!--top_info-->
        <ul class="my_menu">
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=use">자주묻는 질문<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/my_report.php">내 건의함<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/card_info_form.php">카드재등록<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a onclick="swal('대표자에게 문의후 중단을 할수 있습니다.\n 출세왕 연락처 : 010-6610-3103')">정기세차 서비스 중지<span><i class="fal fa-angle-right"></i></span></a></li>

            <?php
            //누적이용금액
            $sql = "select sum(total_cnt) as total_cnt from new_complete_history where mb_id = '{$member["mb_id"]}' and update_yn = 'N' order by ch_idx desc ";
            $complete_cnt = sql_fetch($sql)['total_cnt'];
            ?>
            <?php if((int)$complete_cnt <= 0 ){ ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php">탈퇴하기<span><i class="fal fa-angle-right"></i></span></a></li>
            <?php }else{ ?>
                <li><a href="" data-toggle="modal" data-target="#widthdrawal">탈퇴하기<span><i class="fal fa-angle-right"></i></span></a></li>
            <?php } ?>

        </ul><!--my_menu-->
    </div><!--in-->    
</div><!--mypage-->
<!--마이페이지 끝-->


<!--탈퇴하기 팝업-->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="widthdrawal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">탈퇴하기</h4>
      </div>
      <div class="modal-body">
			<span class="ic_tal"><i class="fas fa-comment-exclamation"></i></span>
			<h2>누적이용금액 <?=number_format((int)$complete_cnt  * 11250 )?>원 남아있어<br>탈퇴가 불가능합니다.</h2>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" href="">확인</a>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->