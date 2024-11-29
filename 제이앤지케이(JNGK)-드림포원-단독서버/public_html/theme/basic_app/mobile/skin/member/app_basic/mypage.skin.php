<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

$sql = " select mb.*, date_format(mb.mb_reg_date, '%Y-%m-%d') as mb_reg_date, lesson_name, lesson_count 
         from g5_member as mb 
         left join g5_lesson le on le.idx = mb.lesson_idx 
         where mb.mb_no = {$member['mb_no']}";
$mb = sql_fetch($sql);

$sql = " select le.*, (select min(lesson_remain_count*1) from g5_lesson_diary where le.lesson_code = lesson_code and mb_no = mb.mb_no and history_idx = mb.history_idx) AS lesson_remain_count
         from {$g5['member_table']} as mb left join g5_lesson as le on le.idx = mb.lesson_idx where mb.mb_no = {$member['mb_no']} ";
$lesson = sql_fetch($sql);

$diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$mb['mb_no']}' and history_idx = '{$mb['history_idx']}'; ")['count'];
?>

<style>
    #mypage .my_box .mem_state .ms_online {
        background: #eee;
        color: #777;
    }
</style>

<div id="mypage">
    <?php /*?><div class="my_hd">
        <a href="javascript:history.back();" class="btn_close">
        <i class="fal fa-times"></i><span class="sound_only">닫기</span>
        </a>
    </div><?php */?><!--.my_hd-->

    <div class="my_box">
		<?php if ($is_member) { ?>
        <div class="my_info">
        	<!--회원이미지 : 기본값은 mem_no_img.png-->
        	<div class="mem_img"><img src="<?php echo $member_skin_url ?>/img/mem_no_img.png" alt="회원이미지" /></div>
            <div class="mem_info">
            	<div class="mem_name">
					<?php echo $member['mb_name'] ?>

                    <!--신규/재등록 회원구분-->
                    <?php
                    $mem_class = '';
                    $mem_state = '';
                    if($mb['mb_state'] == 'new_member') {
                        $mem_class = 'ms_new';
                        $mem_state = '신규';
                    } else if($mb['mb_state'] == 're_member') {
                        $mem_class = 'ms_re';
                        $mem_state = '재등록';
                    } else if($mb['mb_state'] == 'online') {
                        $mem_class = 'ms_online';
                        $mem_state = '온라인';
                    } else if($mb['mb_state'] == 'no_register') {
                        $mem_class = 'ms_online';
                        $mem_state = '미등록';
                    } else if($mb['mb_state'] == 'no_long_register') {
                        $mem_class = 'ms_online';
                        $mem_state = '휴면';
                    }
                    ?>
                    <div class="mem_state"><span class="<?=$mem_class?>"><?=$mem_state?></span></div>
                 </div><!--.mem_name-->
            	<div class="mem_so"><strong><?=$mb['mb_center']?></strong> / <?=$mb['mb_charge_pro']?> 프로</div>
                <div class="mem_log"><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn2">로그아웃</a></div><!--.mem_log-->
            </div><!--.mem_info-->
        </div><!--.mb_info-->
		<?php } else { ?>
        <div class="my_info">
            <div class="no_login"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인 후, 이용해주세요</a></div>
            <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn2">로그인</a>
        </div><!--.mb_info-->
		<?php } ?>
    </div><!--.my_box-->


    <div class="my_lesson">
    	<!--로그인 후 등록된 레슨이 있는경우-->
        <div class="my_le">
        	<div class="ml_t"><i class="far fa-golf-club"></i> 수강중인 레슨</div>
            <?php if(empty($mb['lesson_idx'])) { ?>
            <div class="ml_name">레슨 정보가 없습니다.</div>
            <?php } else { ?>
            <div class="ml_name"><?=$mb['lesson_name']?> <span><?=$mb['lesson_count']?></span></div>
            <?php } ?>
            <div class="ml_txt"><span>시작일</span> <?=$mb['lesson_start_date']?></div> <!-- 회원 레슨 시작 일자로 설정, 아니라면 수정 필요 -->
            <div class="ml_txt"><span>레슨 잔여회차</span> <?php if(empty($diary_count)) echo explode('/',$lesson['lesson_count'])[0]; else echo $lesson['lesson_remain_count'].'회'; ?></span></div> <!-- 레슨 완료 기능 완료 후 수정 필요 -->
        </div><!--.my_le-->

    	<!--로그아웃 또는 로그인 후 등록된 레슨이 없는경우-->
        <!--<div class="my_le_no"><i class="far fa-comment-edit"></i> 수강 중인 레슨정보가 없습니다.<p>레슨을 등록해주세요!</p></div>-->
    </div><!--.my_lesson-->


    <div class="mypage_menu">
    	<ul>
        	<!--<li><a href="<?php /*echo G5_BBS_URL */?>/lesson_confirm.php">나의 레슨예약 <i class="fal fa-angle-right"></i></a></li>-->
        	<li><a href="<?php echo G5_BBS_URL ?>/lesson_list.php">나의 레슨정보 <i class="fal fa-angle-right"></i></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/lesson_reser.php">레슨 예약하기 <i class="fal fa-angle-right"></i></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u&mb_id=<?=$mb['mb_id']?>">비밀번호 변경하기 <i class="fal fa-angle-right"></i></a></li>
        </ul>
    </div><!--mypage_menu-->


</div>

