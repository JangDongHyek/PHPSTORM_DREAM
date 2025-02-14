<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$g5['member_table'] = 'g5_member2_old';
$sql_common = " from {$g5['member_table']} where mb_id != 'hong' and mb_level < 8 ";

if (!empty($stx)) {
    $sql_common .= "and {$sfl} like '%{$stx}%'";
}

if(!empty($_GET['sex'])) { $sql_common .= " and mb_sex = '{$_GET['sex']}' "; }
if(!empty($_GET['age'])) {
    /* 나이~나이 범위로하던거 그냥나이입력으로 변경
    $min_age = explode('~',$_GET['age'])[0];
    $max_age = explode('~',$_GET['age'])[1];
    if(empty($max_age)) { $max_age = 99; }
    $min_birth = date('Y')+1-$max_age;
    $max_birth = date('Y')+1-$min_age;
    $sql_common .= " and mb_birth >= '{$min_birth}' and mb_birth <= '{$max_birth}' ";
    */

    /*
    //나이 그냥입력으로 변경 wc
    // 생년월일로 나이 계산
    $age = $_GET['age'];
    $nowyear = date("Y");
    $birthyear = (int)$nowyear - (int)$age + 1;
    $sql_common .= " and LEFT(mb_birth,4) = '{$birthyear}' ";
    */

    /*23.04.06 나이 하나만입력이 아닌 범위로 할수있게 wc*/
    $min_age = explode('~',$_GET['age'])[0];
    $max_age = explode('~',$_GET['age'])[1];
    $nowyear = date("Y");

    $min_birth = (int)$nowyear - (int)$max_age + 1;
    $max_birth = (int)$nowyear - (int)$min_age + 1;
    if(empty($max_age)) {
        //범위입력안하고 하나만하면 그나이만 딱
        $sql_common .= " and LEFT(mb_birth,4) = '{$max_birth}'";
    }else{
        $sql_common .= " and LEFT(mb_birth,4) >= '{$min_birth}' and LEFT(mb_birth,4) <= '{$max_birth}'";
    }

}
if(!empty($_GET['si'])) { $sql_common .= " and mb_live_si = '{$_GET['si']}' "; }
if(!empty($_GET['gu'])) { $sql_common .= " and mb_live_gu = '{$_GET['gu']}' "; }
if(!empty($_GET['type'])) { $sql_common .= " and mb_character_type = '{$_GET['type']}' "; }
if(!empty($_GET['join_type'])) { $sql_common .= " and mb_join_type = '{$_GET['join_type']}' "; }
if(!empty($_GET['job'])) { $sql_common .= " and mb_job = '{$_GET['job']}' "; }
if(!empty($_GET['salary'])) { $sql_common .= " and mb_salary = '{$_GET['salary']}' "; }

if(!empty($mem_type)) {
    if($mem_type == '비공개') {
        $sql_common .= " and show_yn = 'N' and mb_level = 2 ";
    }
    else if($mem_type == '탈퇴') {
        $sql_common .= " and mb_level = 1 ";
    }else if($mem_type == '공개') {
        $sql_common .= " and show_yn <> 'N' and mb_level = 2 ";
    }
}

$title_text = "일반";
$user_type = empty($user_type) ? "basic" : $user_type;
if(!empty($user_type)) {
    if($user_type == 'basic') {
        $sql_common .= " and mb_8 != 2 and secret_member != 'Y' and mb_join_type != '장애인' ";
    } else if($user_type == 'secret') {
        $sql_common .= " and mb_8 != 2 and secret_member = 'Y' ";
        $title_text = '시크릿 ';
    } else if($user_type == 'no_basic') {
        $sql_common .= " and mb_8 != 2 and mb_join_type = '장애인' ";
        $title_text = '장애인 ';

    }
}

$sql_search = "  ";
// 가입일 검색
if(!empty($_REQUEST['st_date']) && !empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(mb_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' and date_format(mb_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
} else if(!empty($_REQUEST['st_date']) && empty($_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(mb_datetime, '%Y-%m-%d') >= '{$_REQUEST['st_date']}' ";
} else if(empty($_REQUEST['st_date']) && empty(!$_REQUEST['ed_date'])) {
    $sql_search .= " and date_format(mb_datetime, '%Y-%m-%d') <= '{$_REQUEST['ed_date']}' ";
}

/*


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080'";
*/

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

/*
// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];
*/

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall" style="font-weight: bold;">전체목록</a>';

$g5['title'] = $title_text.'회원관리(구)';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//print_r($sql);
$result = sql_query($sql);

$show = sql_fetch(" select count(*) as count from g5_member where mb_level = 2 and show_yn = 'Y' ")['count'];
$no_show = sql_fetch(" select count(*) as count from g5_member where mb_level = 2 and show_yn = 'N' ")['count'];

$colspan = 18;
?>

<style>
    .mb_tbl table {text-align: center;}
    .btn_send {
        display: inline-block;
        width: 100%;
        text-align: center;
        border-radius: 3px;
        border: 1px solid #ccc;
        background: #f2f2f2;
    }

    #age{width: 70px;padding-left:3px;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 회원 수 <?php echo number_format($total_count) ?>명 <!--| 공개 <?/*=number_format($show)*/?>명 | 비공개 <?/*=number_format($no_show)*/?>명 -->
    <!--<a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">차단 <?php /*echo number_format($intercept_count) */?></a>명,
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php /*echo $sfl */?>&amp;stx=<?php /*echo $stx */?>">탈퇴 <?php /*echo number_format($leave_count) */?></a>명-->
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="user_type" value="<?=$user_type?>">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
        <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰</option>
        <option value="mb_church"<?php echo get_selected($_GET['sfl'], "mb_church"); ?>>교회</option>
        <option value="mb_mbti"<?php echo get_selected($_GET['sfl'], "mb_mbti"); ?>>mbti</option>
        <option value="mb_school"<?php echo get_selected($_GET['sfl'], "mb_school"); ?>>학교</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <select name="sex" id="sex" class="sch_sel">
        <option value="">성별</option>
        <option value="여">여성</option>
        <option value="남">남성</option>
    </select>
    <!-- 나이직접입력 부분 wc-->
    <input type="text" name="age" value="<?=$_GET['age']?>" id="age" class="frm_input"  placeholder="나이~나이"  maxlength="5" >

    <!--
    <select name="age" id="age" class="sch_sel">
        <option value="">나이별</option>
        <option value="20~25">20~25</option>
        <option value="26~30">26~30</option>
        <option value="30~35">30~35</option>
        <option value="36~40">36~40</option>
        <option value="40~45">40~45</option>
        <option value="45~49">45~49</option>
        <option value="50~">50~</option>
    </select>
    -->
    <select name="si" id="si" class="sch_sel" onchange="changeCity();">
        <option value="">지역별</option>
        <option value="서울">서울</option>
        <option value="경기">경기</option>
        <option value="세종">세종</option>
        <option value="인천">인천</option>
        <option value="부산">부산</option>
        <option value="대구">대구</option>
        <option value="대전">대전</option>
        <option value="울산">울산</option>
        <option value="광주">광주</option>
        <option value="충남">충남</option>
        <option value="충북">충북</option>
        <option value="경남">경남</option>
        <option value="경북">경북</option>
        <option value="전남">전남</option>
        <option value="전북">전북</option>
        <option value="강원">강원</option>
        <option value="제주">제주</option>
    </select>
    <select name="gu" id="gu" class="sch_sel sel_gu" style="display: none;">
        <option value="">지역상세</option>
    </select>
    <!--    <select name="type" id="type" class="sch_sel">-->
    <!--        <option value="">유형별</option>-->
    <!--        <option value="노아">노아</option>-->
    <!--        <option value="요나단">요나단</option>-->
    <!--        <option value="여호수아">여호수아</option>-->
    <!--        <option value="바울">바울</option>-->
    <!--    </select>-->
    <select name="join_type" id="join_type" class="sch_sel">
        <option value="">타입별</option>
        <option value="초혼">초혼</option>
        <option value="재혼">재혼</option>
        <!--        <option value="장애인">장애인</option>-->
    </select>
    <select name="mem_type" id="mem_type" class="sch_sel">
        <option value="">회원구분</option>
        <option value="공개">공개</option>
        <option value="비공개">비공개</option>
        <!--        <option value="시크릿">시크릿</option>-->
        <option value="탈퇴">탈퇴</option>
    </select>
    <select name="school" id="school" class="sch_sel">
        <option value="">최종학력</option>
        <option value="비공개">비공개</option>
        <!--        <option value="시크릿">시크릿</option>-->
        <option value="탈퇴">탈퇴</option>
    </select>
    <!--
    <select name="job" id="job" class="sch_sel">
        <option value="">직업</option>
        <?php
    $sql = " select * from g5_code where co_code_name = '사회적 역할' group by co_main_code_value order by co_code*1 ";
    $job_result = sql_query($sql);
    for($i=0;$job_row=sql_fetch_array($job_result);$i++) { ?>
            <option value="<?=$job_row['co_code']?>"><?=$job_row['co_main_code_value']?></option>
        <?php } ?>
    </select>
    -->
    <select name="salary" id="salary" class="sch_sel">
        <option value="">연봉</option>
        <option value="1000만원이하" >1000만원이하</option>
        <option value="1000~2000만원">1000~2000만원</option>
        <option value="2000~3000만원">2000~3000만원</option>
        <option value="3000~4000만원">3000~4000만원</option>
        <option value="4000~5000만원">4000~5000만원</option>
        <option value="5000~6000만원">5000~6000만원</option>
        <option value="6000만원이상">6000만원이상</option>
    </select>
    <span style="display: inline; margin-left: 15px">
    <input type="date" id="st_date" value="<?php echo $_REQUEST['st_date'] ?>" name="st_date" max="<?=date('yy-m-d')?>"> ~
    <input type="date" id="ed_date" value="<?php echo $_REQUEST['ed_date'] ?>" name="ed_date" max="<?=date('yy-m-d')?>">
    </span>
    <input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>※ <?=$listall?>을 클릭하면 검색조건이 초기화됩니다.</p>
    <p>※ 승인되지 않은 회원은 앱 회원 리스트에 공개되지 않으며 보기(공개/비공개) 설정을 할 수 없습니다.</p>
</div>

<!--<div class="local_desc01 local_desc">
    <p>회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>
</div>-->

<?php /*if ($is_admin == 'super') { */?><!--
<div class="btn_add01 btn_add">
    <a href="./member_form.php" id="member_add">회원추가</a>
</div>
--><?php /*} */?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head02 tbl_wrap mb_tbl">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>

                <col width="5%">
                <col width="10%">
                <col width="5%">
                <col width="8%">
                <col width="9%">
                <col width="7%">
                <!--        <col width="5%">-->
                <!--        <col width="5%">-->
                <col width="7%">
                <!--        <col width="5%">-->
                <col width="5%">
                <col width="4%">
                <col width="4%">
                <col width="4%">
                <col width="7%">
            </colgroup>
            <thead>
            <tr>

                <th>No.</th>
                <th>보기</th>
                <th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
                <th>닉네임</th>
                <th><?php echo subject_sort_link('mb_name') ?>이름</a></th>
                <th>나이</th>
                <th>성별</th>
                <th>휴대폰</th>
                <th>교회 위치</th>
                <th>회원구분</th>
                <th>가입유형</th>
                <!--        <th>나의성격유형</th>-->
                <th>가입일</th>
                <!--        <th>시크릿회원</th>-->
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $k = $total_count-($rows*($page-1)); // 글번호
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                if($row['mb_9']=='N'){
                    $s_mod = '<a href="./member_form2.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" style="color: red">보기/수정</a>';
                }else{
                    $s_mod = '<a href="./member_form2.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">보기/수정</a>';
                }

                $mb_nick = $row['mb_nick'];
                $mb_id = $row['mb_id'];
                $state = '';
                if($row['mb_approval'] == 'Y') { $state = '승인'; } else if($row['mb_approval_request'] == 'Y') { $state = '심사 요청'; }
                $bg = 'bg'.($i%2);

                // 메세지 보내기 버튼
                $btn = '<input type="button" class="btn_send" value="메세지" onclick="send_message_popup('.$row['mb_no'].');">';

                // 메세지 현황 버튼
                $btn2 = '<input type="button" class="btn_send" value="내역" onclick="show_message_list(\''.$row["mb_name"].'\');">';
                // 데이트 현황 버튼
                $btn3 = '<input type="button" class="btn_send" value="내역" onclick="show_propose_list(\''.$row["mb_name"].'\');">';
                // 만나 현황 버튼
                $btn4  = '<input type="button" class="btn_send" value="내역" onclick="show_point_list(\''.$row["mb_id"].'\');">';

                // 시크릿회원여부
                $secret_member = '';
                if($row['secret_member'] == 'Y') {
                    $secret_member = '○';
                }

                $sql = "select mi_church_place1 from new_member_interview where mb_id = '{$row["mb_id"]}' ";
                $place = sql_fetch($sql)["mi_church_place1"];
                ?>
                <tr class="<?php echo $bg; ?>">

                    <td><?=$k?></td>

                    <td>
                        <?php if($row['mb_level'] == 2 && $row['mb_approval'] == 'Y') { ?>
                            <select id="show_yn" name="show_yn" onchange="member_show_change('<?=$row['mb_no']?>', this.value)">
                                <option value="공개" <?php echo ($row['show_yn'] == 'Y') ? 'selected' : '' ?>>공개</option>
                                <option value="비공개" <?php echo ($row['show_yn'] == 'N') ? 'selected' : '' ?>>비공개</option>
                            </select>
                        <?php } else if($row['mb_level'] == 1) { ?>
                            탈퇴
                        <?php } ?>
                    </td>
                    <td><?=$mb_id?></td>
                    <td><?=$mb_nick?></td>
                    <td><?=get_text($row['mb_name'])?></td>
                    <?php
                    // 생년월일로 나이 계산
                    if($row['mb_birth']){
                        $birthyear_mb = substr($row['mb_birth'],0,4);
                        $nowyear_mb = date("Y");
                        $age_mb = $nowyear_mb - $birthyear_mb + 1;
                    }else{
                        $age_mb = "-";
                    }
                    ?>
                    <td><?=$age_mb?></td>
                    <td><?=$row['mb_sex']?></td>
                    <td><?=$row['mb_hp']?></td>
                    <td><?=$place?></td>
                    <td><?=$title_text?></td>
                    <td><?=$row['mb_join_type']?></td>

                    <!--        <td>--><?//=$row['mb_character_type']?><!--</td>-->
                    <td><?=substr($row['mb_datetime'],0,10)?></td>
                    <!--        <td>--><?//=$secret_member?><!--</td>-->


                    <td><?=$s_mod?></td>
                </tr>
                <?php
                $k--;
            }
            if ($i == 0)
                echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_list01 btn_list">
        <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
        <input type="button" name="act_button" value="엑셀출력 전체" onclick="excel_down2()">
        <!--<input type="button" name="act_button" value="단체메세지" onclick="send_message_popup('');">-->
    </div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&job='.$_REQUEST["job"].'&salary='.$_REQUEST["salary"].'&user_type='.$user_type.'&sex='.$_REQUEST['sex'].'&age='.$_REQUEST['age'].'&si='.$_REQUEST['si'].'&gu='.$_REQUEST['gu'].'&type='.$_REQUEST['type'].'&join_type='.$_REQUEST['join_type'].'&mem_type='.$_REQUEST['mem_type'].'&st_date='.$_REQUEST['st_date'].'&ed_date='.$_REQUEST['ed_date'].'&amp;page='); ?>

<script>
    //input number 자릿수고정먹게
    function maxLengthCheck(object){
        if (object.value.length > object.maxLength){
            object.value = object.value.slice(0, object.maxLength);
        }
    }



    // 엑셀 다운로드
    function excel_down2() {
        location.href = g5_admin_url + '/member_excel_old.php?user_type=<?=$user_type?>&old=true';
    }

    $(function() {
        $('#sex').val('<?=$_GET['sex']?>').attr('selected', 'selected');
        $('#si').val('<?=$_GET['si']?>').attr('selected', 'selected');
        if('<?=$_GET['si']?>' != '') {
            $('#gu').show();
            changeCity();
        }
        $('#age').val('<?=$_GET['age']?>').attr('selected', 'selected');
        $('#type').val('<?=$_GET['type']?>').attr('selected', 'selected');
        $('#join_type').val('<?=$_GET['join_type']?>').attr('selected', 'selected');
        $('#mem_type').val('<?=$_GET['mem_type']?>').attr('selected', 'selected');
        $('#job').val('<?=$_GET['job']?>').attr('selected', 'selected');
        $('#salary').val('<?=$_GET['salary']?>').attr('selected', 'selected');
    });




</script>

<?php
include_once ('./admin.tail.php');
?>
