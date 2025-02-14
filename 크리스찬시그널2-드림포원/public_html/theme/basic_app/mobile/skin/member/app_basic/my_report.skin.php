<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!--관심회원리스트-->
<div id="mem_love" class="report">
	<div class="inb">
        <div id="mem_list">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php
                $bg = '';
                $default_img = '';
                if($count > 0) {
                for($i=0; $mb=sql_fetch_array($result); $i++) {
                    // 성별에 따라 폰트 색상 및 디폴트 이미지 변경
                    if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
                    if($mb['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';
                    if($mb['mb_sex'] == '여')  $cover_img = 'img_cover_women.png'; else $cover_img = 'img_cover_men.png';

                    // 직업
                    $sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
                    $job = sql_fetch($sql)['co_main_code_value'];

                    // 프로필 이미지 (첫번째 사진 한장)
                    $sql = " select * from g5_member_img where mb_no = {$mb['love_mb_no']} order by idx limit 1";
                    $file = sql_fetch($sql);

                    // 생년월일로 나이 계산
                    $birthyear = substr($mb['mb_birth'],0,4);
                    $nowyear = date("Y");
                    $age = $nowyear - $birthyear + 1;

                    // 이름 첫글자 제외 O처리
                    $name = iconv_substr($mb['mb_name'], 0, 1, "utf-8");
                    for ($i = 0; $i < (mb_strlen($mb['mb_name'], "utf-8") -1); $i++) {
                        if($i < 2) {
                            $name .= 'O';
                        }
                    }
                ?>
                <tr>
                    <!--<td class="ck_area">
                        <div class="chk_ico"><input type="checkbox" class="checkbox" name="" id="chk_<?/*=$mb['mb_no']*/?>" value="<?/*=$mb['mb_no']*/?>"><label for="chk_<?/*=$mb['mb_no']*/?>"></label></div>
                    </td>-->
                    <td>
                        <div class="memb">
                                <div class="face">
                                    <span class="love_ico"><i class="fas fa-exclamation"></i></span>
                                    <div class="mg">
                                    <?php if(isset($file['img_file'])) { ?>
                                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$cover_img?>" />
                                    <?php } else { ?>
                                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                                    <?php } ?>
                                    </div>
                                    <div class="name"><?=$name?></div> <!-- 이름 -->
                                </div>
                                <div class="info singo">
                                	<div><strong>신고대상</strong><span><?=$mb['mb_nick']?> (<?=$mb['mb_id']?>)</span></div>
                                    <div><strong>신고이유</strong><span><?=$mb['report_category']?></span></div>
                                    <div><strong>신고내용</strong><span><?=$mb['report_contents']?></span></div>
                                    <div><strong>신고일자</strong><span> <?=$mb['report_date']?></span></div>
                                </div>
                        </div><!--memb-->
                    </td>
                </tr>
                <?php } } else { ?>
                <div class="love_none"><span><i class="fas fa-leaf-heart"></i></span>신고한 회원님이 없습니다.</div>
                <?php } ?>
            </table>
        </div><!--mem_list--> 
    </div><!--inb-->
    
</div><!--mem_love-->
<!--관심회원리스트-->

<script>
    // 관심회원 삭제
    var del_member = '';
    function member_love_del() {
        $('.checkbox').each(function(){
            if($(this).is(":checked")) {
                del_member += this.value + ',';
            }
        });

        del_member = del_member.slice(0, -1);

        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.del_member_love.php",
            data: {del_member: del_member},
            success: function (data) {
                if(data) {
                    location.reload();
                }
            }
        });
    }
</script>