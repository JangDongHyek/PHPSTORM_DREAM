<?php
include_once('./_common.php');

//23.04.04 성별에 맞는것만 나오게 wc
$mysex = $_POST['mysex']; // 검색데이터
$sex = $_POST['sex']; // 검색데이터
$age = $_POST['age'];
$si = $_POST['si'];
$gu = $_POST['gu'];
$type = $_POST['type'];
$join_type = $_POST['join_type'];
$sch = $_POST['sch'];

$min_age = explode('~',$age)[0];
$max_age = explode('~',$age)[1];
if(empty($max_age)) { $max_age = 99; }
$min_birth = date('Y')+1-$max_age;
$max_birth = date('Y')+1-$min_age;

// 가입한지 1주일 이내 회원만 조회 -- and date_format(mb_join_date, '%Y-%m-%d') >= '{$date}' order by mb_no desc -- 주석
//$timestamp = strtotime(date('Y-m-d') . "-1 week");
//$date = date("Y-m-d", $timestamp);

// 검색 필터링
$sql_add = '';

//23.04.04 같은교회사람 안보이게 빼주는거 wc
if($member['mb_id']){
    $sql = "select * from new_member_interview where mb_id = '{$member['mb_id']}' ";
    $mi = sql_fetch($sql);
    $sql = " select * from new_member_interview where mi_church1 = '{$mi['mi_church1']}'; "; // 내가 비노출 처리한 회원
    $result = sql_query($sql);
    $noshow2 = '';
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $noshow2 .= '\''.$row['mb_id'].'\',';
    }
    $noshow2 = substr($noshow2, 0, -1);
    if(!empty($noshow2)) {
        $sql_add .= ' and mb_id not in ('.$noshow2.') ';
    }
}

//23.04.04 남자면 여자만보이고, 여자면 남자만 보이게 wc
if(!empty($mysex)){
    if($mysex == "남"){
        $sql_add .= ' and mb_sex = "여" ';
    }else if($mysex == "여"){
        $sql_add .= ' and mb_sex = "남" ';
    }
}


if(!empty($sex)) { $sql_add .= " and mb_sex = '{$sex}' "; }
if(!empty($sex)) { $sql_add .= " and mb_sex = '{$sex}' "; }
if(!empty($age)) { $sql_add .= " and substring(mb_birth, 1, 4) >= '{$min_birth}' and substring(mb_birth, 1, 4) <= '{$max_birth}' "; }
if(!empty($si)) { $sql_add .= " and mb_live_si like '{$si}%' "; }
if(!empty($gu)) { $sql_add .= " and mb_live_gu like '{$gu}%' "; }
if(!empty($type)) { $sql_add .= " and mb_character_type = '{$type}' "; }
if(!empty($join_type)) { $sql_add .= " and mb_join_type = '{$join_type}' "; }
if(!empty($sch)) { $sql_add .= " and ( mb_nick like '%{$sch}%' )"; }
//if(!empty($sch)) { $sql_add .= " and (mb_nick like '%{$sch}%' or mb_mbti like '%{$sch}%' or mb_school like '%{$sch}%' or mb_job like '%{$sch}%' )"; }


// 장애인회원은 장애인회원만 검색
if($member['mb_join_type'] == '장애인' && $sch == "") {
    $sql_add .= " and mb_join_type = '장애인' ";
}else if($member['mb_join_type'] != '장애인' && $sch == "") {
    $sql_add .= " and mb_join_type != '장애인' ";
}

/**
 * 앱 심사용 - 신고한 사용자 숨김
 * mem_new.php, mem_love.php, ajax.change_option.php
 */
if($member['mb_id'] == 'hong') {
    if(!empty(blockUser($member['mb_id']))) {
        $block = blockUser($member['mb_id']);
        $sql_add .= " and mb_id not in ({$block}) ";
    }
}
$sql_add .= " and mb_id != 'hong' "; // 테스트아이디
$sql_add .= " and mb_8 != '2' "; // 탈퇴아이디 X

if ($sch == "" ){
    $secret_sql = "and (secret_member is null or secret_member = '')";
}
$sql = " select * from {$g5['member_table']} where mb_level = '2' and mb_approval = 'Y' {$secret_sql} {$sql_add} and show_yn = 'Y' ";
$sql .= " order by mb_no desc ";



$result = sql_query($sql);

$bg = '';
$default_img = '';
for($i=0; $mb=sql_fetch_array($result); $i++) {
    // 성별에 따라 폰트 색상 및 디폴트 이미지 변경
    if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
    if($mb['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';
    if($mb['mb_sex'] == '여')  $cover_img = 'img_cover02.png'; else $cover_img = 'img_cover01.png';

    // 직업
    $sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
    $job = sql_fetch($sql)['co_main_code_value'];

    // 프로필 이미지 (첫번째 사진 한장)
    $sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx limit 1";
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

    // 본인은 관심있어요/대화신청 숨김
    if($member['mb_no'] == $mb['mb_no'] || $mb["mb_8"] == 2) { $hide = 'hide'; } else { $hide = ''; }

    // 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 1,000포인트 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
    $blur = 'blur';
    $message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$mb['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
    $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$mb['mb_id']}'; ")['count'];
    if($message > 0 || $profile_view > 0 || $member['mb_no'] == $mb['mb_no']) {
        $blur = 'noblur';
    }
    $sql = "select count(*) cnt from g5_member_love where mb_no = '{$member["mb_no"]}' and love_mb_no = '{$mb['mb_no']}' ";
    $zzim_cnt = sql_fetch($sql)["cnt"];
    $zzim = ($zzim_cnt > 0) ? "co_zzim_on" : "co_zzim";
    $zzim_text = ($zzim_cnt > 0) ? "관심등록중" : "관심있어요";

    if ($mb["mb_8"] == 2){
        $mb["mb_nick"] = "탈퇴한 회원";
        $name = "OOO";
        $href = "javascript:void(0)";
    }else{
        $href = G5_BBS_URL."/mem_view.php?mb_no=".$mb['mb_no'];
    }
    ?>
    <div class="memb">
        <a href="<?=$href?>">
            <div class="face"><span class="new_ico">N</span>
                <div class="mg <?=$blur?>">
                    <?php if(isset($file['img_file'])) { ?>
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$cover_img?>" />
                    <?php } else { ?>
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                    <?php } ?>
                </div>
                <!--                    <div class="name"><?=$name?></div> -->
            </div>
            <div class="info">
                <?php if($mb['secret_member'] == 'Y') { ?><i class="secret"></i><? } ?> <!-- 시크릿 회원 -->
                <h2 class="nick <?=$bg?>"><?=$mb['mb_nick']?></h2>
                <!--여성회원일때 색상--><!-- 닉네임 -->
                <h3 class="simp_info">
                    <!--                    <span><?=$mb['mb_live_si']?> <?=$mb['mb_live_gu']?></span>/<span><?=$age?>세</span>/<span><?=$job?></span>/-->
                    <span><?=$name?></span><!-- 이름 --> /
                    <span><?=$mb['mb_sex']?></span>
                    <!-- 나이 -->
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
                    /<span><?=$age_mb?>살</span>
                    -->
                </h3>
                <!-- 사는곳/나이/직업/성별 -->
                <div class="con"><?=$mb['mb_introduce']?></div><!--나의 신앙고백 내용이 추출될예정/최대 3줄까지만 표현되도록 ==> 자기소개글로 변경-->
            </div>
        </a>
        <div class="love_btn cf <?=$hide?>">
            <!-- 특정회원 비노출-->
            <?php
            //23.04.04 어래이없을때 오류나던거 막아줌 wc
            if($noshow_arr){
                if(in_array($mb['mb_no'], $noshow_arr)) {
                    ?>
                    <!-- 비노출 중일 때-->
                    <a class="private" href="javascript:void(0);" onclick="member_show('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                        <div class="on">
                            <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private_on.svg" />
                            <span>비노출중</span>
                        </div>
                    </a>
                    <!-- //비노출 중일 때-->
                    <?php
                } else {
                    ?>
                    <a class="private" href="javascript:void(0);" onclick="member_noshow('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                        <div class="on">
                            <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private.svg" />
                            <span>노출중</span>
                        </div>
                    </a>
                    <?php
                }
            }else{
                ?>
                <a class="private" href="javascript:void(0);" onclick="member_noshow('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');">
                    <div class="on">
                        <img src="<?php echo G5_THEME_IMG_URL; ?>/app/icon_private.svg" />
                        <span>노출중</span>
                    </div>
                </a>
                <?php
            }
            ?>
            <a class="zzim" href="javascript:void(0);" onclick="member_love('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$zzim?>.png" /><span id="zzim_text_<?=$mb['mb_no']?>"><?=$zzim_text?></span></a><!--관심있어요 누르면 확인창이 뜨게 되고, 회원닉네임을 추출함 / 확인 버튼 누르면 해당회원이 내관심회원 리스트에 올라감-->
            <a href="javascript:void(0);" onclick="send_message_modal('<?=$mb['mb_no']?>', '<?=$mb['mb_nick']?>');"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_talk.png" /><span>메세지</span></a><!--메세지 클릭하면 메세지 보내기 창이 뜨게 됨. 회원닉네임을 추출. 전송하기 하면 내 메시지함의 보낸메세지함에 쌓임-->
            <a href="javascript:cart_in(<?=$mb['mb_no']?>,'<?=$mb['mb_nick']?>')">
                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/co_cart.png" alt="">
                <span>장바구니 담기</span>
            </a>
        </div>
    </div><!--memb-->
    <?php
}
if($i==0) {
    ?>
    <div class="love_none"><span><i class="fas fa-leaf-heart"></i></span>검색된 회원님이 없습니다.</div>
    <?php
}
?>