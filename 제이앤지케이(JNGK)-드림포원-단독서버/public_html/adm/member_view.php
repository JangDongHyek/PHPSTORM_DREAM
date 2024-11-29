<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$mb_no = $_GET['mb_no'];

$mb = get_member_no($mb_no);

$state_class = 'amv_na_hu';
if ($mb['mb_state'] == 'new_member') {
    $mb_state = '신규';
    $state_class = 'amv_na_new';
} else if ($mb['mb_state'] == 're_member') {
    $mb_state = '재등록';
    $state_class = 'amv_na_re';
} else if ($mb['mb_state'] == 'one_point_lesson') {
    $mb_state = '원포인트';
    $state_class = 'amv_na_one';
} else if ($mb['mb_state'] == 'online') {
    $mb_state = '온라인';
} else if ($mb['mb_state'] == 'no_register') {
    $mb_state = '미등록';
} else if ($mb['mb_state'] == 'no_long_register') {
    $mb_state = '휴면';
}

$lesson_info = sql_fetch(" select * from g5_lesson where lesson_code = '{$mb['lesson_code']}' and center_code = '{$mb['center_code']}' ");

if($member['mb_level'] == 9) {
    $g5['title'] .= $mb['mb_category'].'관리';
}
if($member['mb_level'] == 8) {
    $g5['title'] .= $mb['mb_category'].'정보';
}

// 레슨완료여부 확인
$diary_count = sql_fetch(" select count(*) as count from g5_lesson_diary where mb_no = '{$mb['mb_no']}' and history_idx = '{$mb['history_idx']}' ")['count'];

include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="adm_width">
    <div class="adm_mem_vbox">
        <div class="amv_img">
         <?
        $sql = " select * from g5_member_img where mb_no = '{$mb['mb_no']}' ";
        $file = sql_fetch($sql);

        if(!empty($file['img_file'])) {
        ?>
        <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>">
        <?
        } else {
        ?>
        <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif "/>
        <?php
        }
        ?>
        </div><!--.amv_img-->

        <div class="amv_info">
        	<div class="amv_name">
				<span class="amv_na"><span class="<?=$state_class?>"><?=$mb_state?></span></span>
				<span class="amv_nb"><?=$mb['mb_id_no']?></span>
				<span class="amv_nc"><?=$mb['mb_name']?></span>
				<?=$mb['mb_category']?>님
            </div><!--.amv_name-->

            <ul>
               <li><strong>휴대전화</strong> <?=$mb['mb_hp']?></li>
               <li><strong>주소</strong> <?=$mb['mb_addr1']?> <?=$mb['mb_addr2']?></li>
               <?php if($mb['mb_state'] != 'one_point_lesson') { ?>
               <li><strong>이메일</strong> <?=$mb['mb_email']?></li>
               <li><strong>생년월일</strong> <?=$mb['mb_birth']?></li>
               <?php } ?>
            </ul>
        </div><!--.amv_info-->
    </div><!--.adm_mem_vbox-->



    <!--<div class="tbl_frm01 tbl_wrap member_state new_member">-->
    <div class="tbl_frm03">
        <table>
        <caption><?php echo $g5['title']; ?></caption>
        <colgroup>
            <col class="grid_5">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <?php if($mb['mb_state'] != 're_member') { ?>
        <tr>
            <th scope="row"><label for="mb_option">구분<?php echo $sound_only ?></label></th>
            <td><?=$mb['mb_option']?></td>
        </tr>
        <?php } ?>
        <tr>
            <th scope="row"><label for="mb_center">센터/아카데미<?php echo $sound_only ?></label></th>
            <td><?=$mb['mb_center']?></td>
        </tr>
        <?php if($mb['mb_category'] == '회원') { ?>
        <tr>
            <th scope="row"><label for="mb_charge_pro">담당프로<?php echo $sound_only ?></label></th>
            <td><?=$mb['mb_charge_pro']?></td>
        </tr>
        <?php } ?>
        <tr>
            <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
            <td><?=$mb['mb_id']?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_reg_date">등록일자<?php echo $sound_only ?></label></th>
            <td><?php echo $mb['mb_reg_date'] == '0000-00-00 00:00:00' ? '' :  substr($mb['mb_reg_date'], 0, 10); ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="lesson_start_date">레슨시작일자<?php echo $sound_only ?></label></th>
            <td><?php if($mb['mb_state'] == 'one_point_lesson' && $diary_count == 0) { echo '-'; } else { echo $mb['lesson_start_date']; } ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="lesson_end_date">레슨종료일자<?php echo $sound_only ?></label></th>
            <td><?php if($mb['mb_state'] == 'one_point_lesson' && $diary_count == 0) { echo '-'; } else { echo $mb['lesson_end_date'] == '1970-01-01' ? '' : $mb['lesson_end_date']; } ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_goods_name']">레슨명<?php echo $sound_only ?></label></th>
            <td>
                <?php
                // 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정)
                $tmp0 = sql_fetch(" select lesson_name from g5_member_history where idx = '{$mb['history_idx']}' ");
                $tmp1 = explode('/', $tmp0['lesson_name']);
                $lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.$tmp1[3].' / '.number_format($tmp1[4]);
                if($tmp1[0] == '원포인트') $lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.number_format($tmp1[3]);
                ?>
                <?php /*if(!empty($lesson_info['lesson_name'])) { */?><!--<?/*=$lesson_info['lesson_name']*/?> / <?/*=$lesson_info['lesson_time']*/?> / <?/*=$lesson_info['lesson_count']*/?> / <?/*=number_format($lesson_info['lesson_price'])*/?>--><?php /*} */?>
                <?=$lesson_name?>
            </td>
        </tr>
        <?php if($mb['mb_state'] != 'one_point_lesson') { ?>
        <tr>
            <th scope="row"><label for="mb_recommend']">추천인<?php echo $sound_only ?></label></th>
            <td><?=$mb['mb_recommend']?></td>
        </tr>
        <tr>
            <th scope="row"><label for="mb_career">골프 경력사항<strong class="sound_only">필수</strong></label></th>
            <td><?php if($mb['mb_state'] == 'new_member') { ?>점수 : <?=empty($mb['mb_score'])?'-':$mb['mb_score']?> / 골프경력 : <?=empty($mb['mb_career'])?'-':$mb['mb_career']?> / 레슨경험 : <?=empty($mb['mb_lesson'])?'-':$mb['mb_lesson']?> <?php if($mb['mb_lesson'] == '있다') { echo ' ('.$mb['mb_lesson_de'].'개월)'; } ?> / 평균 라운딩 수 : <?=empty($mb['mb_rounding'])?'-':$mb['mb_rounding']?><?php } ?></td>
        </tr>
        <?php } ?>
        <?php if($mb['mb_category'] == '회원') { ?>
        <tr>
            <th scope="row" colspan="2" class="th_pln"><label for="mb_wish">가장 개선하고 싶은 부분이나 담당 프로에게 바라는 점<strong class="sound_only">필수</strong></label></th>
        </tr>
        <tr>
            <td colspan="2" class="td_hi"><?=$mb['mb_wish']?></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>


<div class="adm_mw_btn">
    <?php if(($mb['mb_state'] == 'online')) { ?>
    <input type="button" class="btn_adm_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/member_form_app.php?w=u&mb_no=<?=$mb_no?>'">
    <?php } else if($mb['mb_state'] == 'new_member' || $mb['mb_state'] == 're_member' || ($mb['mb_state'] == 'one_point_lesson' && $diary_count == 0)) { ?>
    <input type="button" class="btn_adm_ok" value="정보수정" onclick="location.href='<?=G5_ADMIN_URL?>/member_form.php?sst=&sod=&sfl=&stx=&page=0&w=u&mb_no=<?=$mb_no?>'">
    <?php } else if($mb['mb_state'] == 'no_register' || $mb['mb_state'] == 'no_long_register') { ?>
    <input type="button" class="btn_adm_ok" value="재등록" onclick="location.href='<?=G5_ADMIN_URL?>/member_form_re.php?w=u&mb_no=<?=$mb_no?>'">
    <?php } ?>
    <a href="<?=G5_ADMIN_URL?>/member_list.php" class="btn_adm_cancel">목록</a>
</div>

<?php
include_once('./admin.tail.php');
?>
