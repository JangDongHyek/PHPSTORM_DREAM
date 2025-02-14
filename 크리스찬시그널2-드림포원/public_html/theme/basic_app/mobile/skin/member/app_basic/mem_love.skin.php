<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
    .noblur img {
        -webkit-filter: blur(0px) !important;
        -moz-filter: blur(0px) !important
        -o-filter: blur(0px) !important;
        -ms-filter: blur(0px) !important;
        filter: blur(0px) !important;
    }
	#mem_love #mem_list table tr > td{
		width: 100%;
		flex-direction: column;
	}
	#mem_love #mem_list table tr > td > .memb{
		width: 100%;
		padding: 30px 0 30px 30px;
	}
	#mem_love #mem_list table tr > td{
		position: relative;
	}
	#mem_list .memb > a{
		flex-direction: row;
	}
</style>

<!--관심회원리스트-->
<div id="mem_love">
	<div class="inb">
    	<div class="cons"><!--2020년 10월 20일-->결제전회원님들을 보실 수 있습니다.</div><!--con-->
    	<div class="all_del"><a href="javascript:void(0);" onclick="member_love_del();"><span>*</span> 선택한 회원님 <strong>삭제</strong></a></div><!--all_chk-->
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

                    // 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 1,000포인트 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
                    $blur = 'blur';
                    $message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$mb['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
                    $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$mb['mb_id']}'; ")['count'];
                    if($message > 0 || $profile_view > 0) {
                        $blur = 'noblur';
                    }

                    if ($mb["mb_8"] == 2){
                        $mb["mb_nick"] = "탈퇴한 회원";
                        $name = "OOO";
                        $href = "javascript:void(0)";
                    }else{
                        $href = G5_BBS_URL."/mem_view.php?mb_no=".$mb['mb_no'];
                    }
                    
                    //23.05.30 승인안된사람보이고 클릭하면 대기중뜨게
                    if($mb["mb_approval"] != 'Y'){
                        $href = "javascript:swal('승인대기중입니다.')";
                    }
                ?>
                <tr>
                    <td>
						<div class="ck_area">
							<div class="chk_ico"><input type="checkbox" class="checkbox" name="" id="chk_<?=$mb['mb_no']?>" value="<?=$mb['mb_no']?>"><label for="chk_<?=$mb['mb_no']?>"></label></div>
						</div>
                        <div class="memb">
                            <a href="<?php echo $href ?>">
                                <div class="face">
                                    <span class="love_ico"><i class="fas fa-heart"></i></span>
                                    <div class="mg <?=$blur?>">
                                    <?php if(isset($file['img_file'])) { ?>
                                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$cover_img?>" />
                                    <?php } else { ?>
                                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                                    <?php } ?>
                                    </div>
<!--                                    <div class="name"></div> -->
                                </div>
                                <div class="info">
                                    <h2 class="nick <?=$bg?>"><?=$mb['mb_nick']?></h2> <!--여성회원일때 색상--><!-- 닉네임 -->
                                    <h3 class="simp_info">
<!--
                                    <span><?=$mb['mb_live_si']?> <?=$mb['mb_live_gu']?></span>/
                                    <span><?=$age?>세</span>/<span><?=$job?></span>/
-->
                                   <span><?=$name?><!-- 이름 --></span> / 
                                    <span><?=$mb['mb_sex']?></span></h3> <!-- 사는곳/나이/직업/성별 -->
                                    <div class="con"><?=$mb['mb_confession']?></div><!--나의 신앙고백 내용이 추출될예정)/최대 3줄까지만 표현되도록-->
                                    <div class="date"><i class="fas fa-heart"></i> <?=$mb['love_date']?></div><!--관심등록한 날짜시간-->
                                </div>
                            </a>
                        </div><!--memb-->
                    </td>
                </tr>
                <?php } } else { ?>
                <div class="love_none"><span><i class="fas fa-leaf-heart"></i></span>결제전회원님이 없습니다.</div>
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

        if(del_member == '') {
            swal('삭제할 회원을 선택하세요.');
            return false;
        }

        swal({
            text: "선택하신 관심회원님을 삭제하시겠습니까?",
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
                        url: g5_bbs_url + "/ajax.del_member_love.php",
                        data: {del_member: del_member},
                        success: function (data) {
                            if(data) {
                                location.reload();
                            }
                        }
                    });
                    break;
            }
        });
    }
</script>