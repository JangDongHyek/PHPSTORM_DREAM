<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
include_once(G5_BBS_PATH . "/profile_modal.php")


?>

<!--마이페이지 시작-->
<div id="mypage">
	<div class="in">
		<div class="top_info">
			<div class="my">
				<div class="mg">
					<?php if(isset($file['img_file'])) { ?>
					<img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>" />
					<?php } else { ?>
					<img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
					<?php } ?>
				</div>
				<?php if($mb['secret_member'] == 'Y') { ?><i class="secret"></i>
				<? } ?>
				<!-- 시크릿 회원 -->
				<div class="nick <?=$bg?>"><?=$mb['mb_nick']?></div>
				<!--닉네임 추출-->
				<?php if($member['mb_level'] == 10) { ?>
				<div class="inf"><span><?=$name?></span></div>
				<?php } else { ?>
				<div class="inf"><span><?=$name?></span><span><?=$age?><?php if(!empty($age)) { ?>세<?php } ?></span><span><?=$mb['mb_sex']?></span><span><?=$mb['mb_blood_type']?><?php if(!empty($mb['mb_blood_type'])) { ?>형<?php } ?></span></div>
				<?php } ?>
				<div class="body"><span>신체조건</span> <strong><?=$mb['mb_height']?></strong>cm / <strong><?=$mb['mb_weight']?></strong>kg</div>
				<?php if ($is_member) { ?>
				<p class="lg_btn">
					<a href="<?php echo G5_BBS_URL ?>/register_form.php?mb_id=<?=$mb['mb_id']?>&w=u">정보수정</a>
					<a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a>
				</p>
				<?php } else { ?>
				<?php } ?>
			</div>
			<!--my-->
			<?php if (!$ios_payment_test){ ?>
			<div class="mypoint">
				<h3>만나</h3>
				<span><?=number_format($mb['cw_point'])?> 만나</span>
			</div>
			<?php } ?>

			<div class="m_btn cf">
				<a href="<?=$profile_href?>"><i class="far fa-user-check"></i><span>내 프로필 수정</span></a>
				<!--<a href="<?php echo G5_BBS_URL ?>/register_form.php?mb_id=<?=$mb['mb_id']?>&w=u"><i class="far fa-user-lock"></i><span>내정보 수정</span></a>-->
				<a href="<?php echo G5_BBS_URL ?>/date_alarm.php"><i class="fas fa-heartbeat"></i><span>데이트설정</span></a>
				<a href="<?php echo G5_BBS_URL ?>/alarm.php"><i class="far fa-alarm-clock"></i><span>알림설정</span></a>
			</div>
			<!--m_btn-->
			<?php if($member['mb_approval'] == 'N'){ ?>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/file_upload_form.php">제출서류<span class="co"><i class="fas fa-bullseye-pointer"></i></span><?php if($no_confirm_count != 0) echo '<strong class="new">N</strong>'?></a></div>
			<?php } ?>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/mem_love.php">내 결제전회원 <span class="co"><i class="fas fa-heart"></i></span></a></div>
			<!--새로운 메세지(읽지 않은)가 있을시 new아이콘이 나타나게-->
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/msg_from.php">내 메세지함 <span class="co"><i class="fas fa-comments-alt"></i></span><?php if($no_read_count != 0) echo '<strong class="new">N</strong>'?></a></div>
			<!--새로운 데이트신청(수락/거절하지 않은)이 있을시 new아이콘이 나타나게-->
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/propose_from.php">내 데이트함 <span class="co"><i class="fas fa-hand-holding-heart"></i></span><?php if($no_confirm_count != 0) echo '<strong class="new">N</strong>'?></a></div>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/myinforeq_form.php">내정보 열람 신청함 <span class="co"><i class="fas fa-bullseye-pointer"></i></span><?php if($no_confirm_count != 0) echo '<strong class="new">N</strong>'?></a></div>
			<?php if (!$ios_payment_test){ ?>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/point.php">만나 사용내역 <span class="co"><i class="fas fa-coins"></i></span></a></div>
			<!--            <div class="bx"><a href="<?php echo G5_BBS_URL ?>/point_charge.php">만나 충전하기 <span class="co"><i class="point_plus"></i></span></a></div>-->
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/user_level.php">회원권 구매하기 <span class="co"><i class="fas fa-money-check-alt"></i></span></a></div>
			<div class="bx"><a href="<?php echo G5_BBS_URL ?>/get_out.php" >탈퇴하기 <span class="co"><i class="fa-solid fa-door-open"></i></span></a></div>
			<?php } ?>
		</div>
		<!--top_info-->
		<?php /* <ul class="my_menu">
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=memo">알림메세지<span><i class="fal fa-angle-right"></i></span></a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항<span><i class="fal fa-angle-right"></i></span></a></li>
		<!--            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=youtube">유튜브동영상<span><i class="fal fa-angle-right"></i></span></a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=use">이용안내<span><i class="fal fa-angle-right"></i></span></a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">자주묻는 질문<span><i class="fal fa-angle-right"></i></span></a></li>
		<!--            <li><a href="--><?php //echo G5_BBS_URL ?>
		<!--/talk_bbs.php" class="store_noshow">커뮤니티 공간<span><i class="fal fa-angle-right"></i></span></a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/my_report.php">내 신고함<span><i class="fal fa-angle-right"></i></span></a></li>
		<li><a href="javascript:service_out()">서비스 탈퇴<span><i class="fal fa-angle-right"></i></span></a></li>
		</ul>
		<!--my_menu--> */ ?>
	</div>
	<!--in-->
</div>
<!--mypage-->
<!--마이페이지 끝-->

<script>
	function service_out() {
		<?php if ($member["mb_id"] == "test"){ ?>
		if (confirm("탈퇴 시 해당 아이디로 다시 로그인 하실 수 없습니다. 탈퇴하시겠습니까? 무료만나 사용후 바로 탈퇴요청시 무료제공된 만나만큼 비용발생적용됩니다.")) {
			swal('서비스 탈퇴 처리 되었습니다.').then(() => {
				location.href = g5_bbs_url + "/logout.php?ios_payment_test=Y";
			});
		}
		<?php }else{ ?>
		swal({
			text: "탈퇴 시 해당 아이디로 다시 로그인 하실 수 없습니다. 탈퇴하시겠습니까? 무료만나 사용후 바로 탈퇴요청시 무료제공된 만나만큼 비용발생적용됩니다.",
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
						url: g5_bbs_url + "/ajax.controller.php",
						data: {
							mode: 'member_out_res'
						},
						success: function(data) {
							if (data == "success") {
								swal('탈퇴신청이 완료되었습니다. 관리자 승인 후 탈퇴가 완료됩니다.');
							} else {
								swal(data);
							}
						}
					});
					break;
			}
		});
		<?php } ?>
	}

</script>
