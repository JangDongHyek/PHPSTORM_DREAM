<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!--매니저용 마이페이지 시작-->
<div id="mypage">
	<div class="in">
        <div class="top_info">
            <h2 class="title"><?= $member["mb_name"]?><span>매니저님</span></h2><!--title-->
            <?php if ($is_member) { ?>
            <ul class="lg_btn">
            	<li><a href="<?php echo G5_BBS_URL ?>/register_form_manager.php?w=u&mb_id=<?=$member['mb_id']?>"><i class="fas fa-pen-square"></i> 내정보</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-lock-open-alt"></i> 로그아웃</a></li>
            </ul>
            <?php } else { ?>
            <?php } ?>


            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_order.php">내 작업현황<span class="co"><i class="fas fa-calendar-edit"></i></span></a></div>
            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_order_end.php">완료된 작업<span class="co"><i class="fas fa-car-wash"></i></span></a></div>
            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/my_money.php?car_date_type=3&ma_step=2"">정산내역<span class="co"><i class="fas fa-coins"></i></span></a></div>
        </div><!--top_info-->
        <ul class="my_menu">
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=use">자주묻는 질문<span><i class="fal fa-angle-right"></i></span></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php">탈퇴하기<span><i class="fal fa-angle-right"></i></span></a></li>
            <!--
            <li><a href="" data-toggle="modal" data-target="#widthdrawal">탈퇴하기<span><i class="fal fa-angle-right"></i></span></a></li>
            -->
        </ul><!--my_menu-->
    </div><!--in-->    
</div><!--mypage-->
<!--매니저용 마이페이지 시작-->


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
			<h2>회원 탈퇴가 완료되었습니다.</h2>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" href="<?php echo G5_BBS_URL ?>/logout.php">확인</a>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->