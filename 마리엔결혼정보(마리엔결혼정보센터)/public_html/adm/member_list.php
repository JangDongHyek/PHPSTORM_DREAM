<?php
$sub_menu = "200100";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) and mb_id <> 'admin' and mb_id <> 'lets080'  ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point':
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level':
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel':
        case 'mb_hp':
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default:
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super') {
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_add = '';
$sql_add .= " and mb_memo NOT LIKE '삭제함' ";
if(!empty($_GET['merry'])) { $sql_add .= " and mb_merry = '{$_GET['merry']}' "; }
if(!empty($_GET['sex'])) { $sql_add .= " and mb_sex = '{$_GET['sex']}' "; }
if(!empty($_GET['age1']) || !empty($_GET['age2'])) {
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
    $min_age = $_GET['age1'];
    $max_age = $_GET['age2'];
    $nowyear = date("Y");

    $min_birth = (int)$nowyear - (int)$max_age + 1;
    $max_birth = (int)$nowyear - (int)$min_age + 1;

    if($max_age && $min_age) {
        $sql_add .= " and LEFT(mb_birth,4) >= '{$min_birth}' and LEFT(mb_birth,4) <= '{$max_birth}'";
    }else if($min_age){
        $sql_add .= " and LEFT(mb_birth,4) <= '{$max_birth}'";
    }else if($max_age){
        $sql_add .= " and LEFT(mb_birth,4) >= '{$min_birth}'";
    }

}

if(!empty($_GET['job'])) { $sql_add .= " and mb_job_div = '{$_GET['job']}' "; }
if(!empty($_GET['education'])) { $sql_add .= " and mb_education = '{$_GET['education']}' "; }
if(!empty($_GET['addr_div'])) { $sql_add .= " and mb_addr_div = '{$_GET['addr_div']}' "; }


if(!empty($_GET['height1']) || !empty($_GET['height2'])) {
    $min_height = $_GET['height1'];
    $max_height = $_GET['height2'];

    if($max_height && $min_height){
        $sql_add .= " and mb_height >= '{$min_height}' and mb_height <= '{$max_height}'";
    }else if($min_height) {
        //범위입력안하고 하나만하면 그나이만 딱
        $sql_add .= " and mb_height <= '{$max_height}'";
    }else if($max_height){
        $sql_add .= " and mb_height >= '{$min_height}'";
    }
}

if(!empty($_GET['religion'])) { $sql_add .= " and mb_religion = '{$_GET['religion']}' "; }
if(!empty($_GET['state'])) { $sql_add .= " and mb_state = '{$_GET['state']}' "; }

$leave = $_REQUEST['leave'];
if($leave == "Y"){
    $sql_add .= " and ( mb_leave_date <> '' )  ";
    $sql_order = " order by mb_leave_date desc ";
}else{
    $sql_add .= " and ( mb_leave_date = '' )  ";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common}  {$sql_search} ";
$row = sql_fetch($sql);
$total_count_all = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common}  {$sql_search} {$sql_add} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];




$rows = $config['cf_page_rows'];
$total_page = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함


// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search}  and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_add} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];



$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');




$sql = " select * {$sql_common} {$sql_search} {$sql_add} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);


$colspan = 20;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
<style>
    .tbl_wrap td {
        text-align: center
    }

    .tbl_wrap td.td_no {
        font-weight: bold;
        font-size: 13px !important
    }
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <a href="./member_list.php">총회원수 <?php echo number_format($total_count_all) ?>명</a>
    <a href="./member_list.php?leave=Y" class="btn_ov01"> <span class="ov_txt">탈퇴 </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>

<?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 9) { ?>
<!-- 상세검색 S -->
<form id="fsearch2" name="fsearch2" class="local_sch01 local_sch" method="get">
    <input type="hidden" name="stx_d" value="detail" id="stx_d"><!-- 검색 텍스트 디테일 -->
    <input type="hidden" name="leave" value="<?=$leave?>" id="leave"><!-- 검색 텍스트 디테일 -->
    <? } ?>

    <? //매니저 명
    if ($is_admin) {
        $sql = "select * from `g5_member` where mb_level <= 8 and mb_level >= 7 group by mb_name order by mb_datetime";
    } else {
        $sql = "select * from `g5_member` where mb_level <= 8 and mb_level >= 7 and mb_company = '" . $_SESSION['ss_mb_company'] . "' group by mb_name order by mb_datetime";
    }
    $manager_name = sql_query($sql);
    ?>
    <!-- 결혼유형 -->
    <span class="schTit">결혼유형 : </span>
    <select id="merry" name="merry">
        <option value="">선택하세요.</option>
        <option value="초혼" <?php echo get_selected($_GET['merry'], "초혼"); ?>>초혼</option>
        <option value="재혼" <?php echo get_selected($_GET['merry'], "재혼"); ?>>재혼</option>
        <option value="썸혼" <?php echo get_selected($_GET['merry'], "썸혼"); ?>>썸혼</option>
        <option value="황혼" <?php echo get_selected($_GET['merry'], "황혼"); ?>>황혼</option>
    </select>
    <!-- 결혼유형 -->

    <!-- 성별 -->
    <span class="schTit">성별 : </span>
    <select id="sex" name="sex">
        <option value="">선택하세요.</option>
        <option value="M" <?php echo get_selected($_GET['sex'], "M"); ?>>남</option>
        <option value="F" <?php echo get_selected($_GET['sex'], "F"); ?>>여</option>
    </select>
    <!-- 성별 -->
    <!-- 나이 -->
    <span class="schTit">나이 : </span>
    <select name="age1" id="age1" onchange="mb_age_check()">
        <option value="">전체</option>
        <? for ($i = 20; $i <= 70; $i++) { ?>
            <option value="<?= $i ?>"<?php echo get_selected($_GET['age1'], $i); ?>><?= $i ?></option>
        <? } ?>
    </select>
    ~
    <select name="age2" id="age2" onchange="mb_age_check()">
        <option value="">전체</option>
        <? for ($i = 20; $i <= 70; $i++) { ?>
            <option value="<?= $i ?>"<?php echo get_selected($_GET['age2'], $i); ?>><?= $i ?></option>
        <? } ?>
    </select>
    <!-- 나이 -->
    <!-- 직업 -->
    <span class="schTit">직업 : </span>
    <!--<input type="text" name="stx_mb_323" value="<?php echo $stx_mb_323 ?>" id="stx_mb_323" class="frm_input" style="width:5%;">-->
    <select id="job" name="job">
        <option value="">전체</option>
        <?php
        foreach (array_keys($mb_job_arr) as $item) {
            ?>
            <option value="<?=$item?>" <?=$_GET['job'] == $item ? 'selected' : ''?>><?=$mb_job_arr[$item]?></option>
            <?php
        }
        ?>

    </select>

    <!-- 직업 -->
    &nbsp;&nbsp;
    <!-- 학력 -->
    <span class="schTit">학력 : </span>
    <!--<input type="text" name="stx_mb_322" value="<?php echo $stx_mb_322 ?>" id="stx_mb_322" class="frm_input" style="width:5%;">-->
    <select name="education" id="education">
        <option value="">전체</option>
        <?php
        foreach (array_keys($mb_education_arr) as $item) {
            ?>
            <option value="<?=$item?>" <?=$_GET['education'] == $item ? 'selected' : ''?>><?=$mb_education_arr[$item]?></option>
            <?php
        }
        ?>
    </select>
    &nbsp;&nbsp;
    <!-- 학력 -->
    <!-- 지역 -->
    <span class="schTit nn">지역 :</span>
    <select name="addr_div" id="addr_div">
        <option value="">전체</option>
        <?php
        foreach (array_keys($mb_addr_div_arr) as $item) {
            ?>
            <option value="<?= $item ?>" <?= $_GET['addr_div'] == $item ? 'selected' : '' ?> <?php echo get_selected($_GET['addr_div'], "<?=$item?>"); ?>><?= $mb_addr_div_arr[$item] ?></option>
            <?php
        }
        ?>


    </select>
    &nbsp;&nbsp;
    <!-- 지역 -->
    <!-- 신장 -->
    <span class="schTit">신장 : </span>
    <select name="height1" id="height1" onchange="mb_tall_check()">
        <option value="">전체</option>
        <? for ($i = 150; $i <= 200; $i++) { ?>
            <option value="<?= $i ?>"<?php echo get_selected($_GET['height1'], $i); ?>><?= $i ?></option>
        <? } ?>
    </select>
    ~
    <select name="height2" id="height2" onchange="mb_tall_check()">
        <option value="">전체</option>
        <? for ($i = 150; $i <= 200; $i++) { ?>
            <option value="<?= $i ?>"<?php echo get_selected($_GET['height2'], $i); ?>><?= $i ?></option>
        <? } ?>
    </select>
    <script>
        function mb_tall_check() {
            var mb_48_1 = document.fsearch2.stx_mb_48_1;
            var mb_48_2 = document.fsearch2.stx_mb_48_2;
            if (mb_48_1.value > mb_48_2.value) {
                if (mb_48_2.value != "") {
                    alert("첫번째 선택한 신장 보다 낮습니다. 범위를 올바르게 설정해주세요.");
                }
                mb_48_2.value = "";
                mb_48_2.focus();
            }
        }
    </script>
    &nbsp;&nbsp;
    <!-- 신장 -->

    <!-- 종교 -->
    <span class="schTit">종교 : </span>
    <select name="religion" id="religion">
        <option value="">전체</option>
        <option value="기독교" <?php echo get_selected($_GET['religion'], "기독교"); ?>>기독교</option>
        <option value="천주교" <?php echo get_selected($_GET['religion'], "천주교"); ?>>천주교</option>
        <option value="불교" <?php echo get_selected($_GET['religion'], "불교"); ?>>불교</option>
        <option value="무교" <?php echo get_selected($_GET['religion'], "무교"); ?>>무교</option>
        <option value="기타" <?php echo get_selected($_GET['religion'], "기타"); ?>>기타</option>
    </select>
    <!-- 종교 -->

    <!-- 진행상태 -->
    <span class="schTit">진행상태 : </span>
    <select name="state" id="state">
        <option value="">선택하세요.</option>
        <?php
        foreach (array_keys($mb_state_arr) as $item) {
            ?>
            <option value="<?= $item ?>" <?= $_GET['state'] == $item ? 'selected' : '' ?> <?php echo get_selected($_GET['state'], "<?=$item?>"); ?>><?= $mb_state_arr[$item] ?></option>
            <?php
        }
        ?>
    </select>
    <!-- 진행상태 -->

    <?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 9) { ?>
        <br/><br/>
    <? } ?>

    <input type="submit" class="btn_submit" value="상세검색">
    <input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list.php'">

</form>

<div class="btn_add01 btn_add">
    <a href="./member_form.php" id="member_add"
       style="background-color:#ff3061; color:#fff; border:0px; font-weight:900">회원추가</a>
    <?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 8) { ?>
        <!--<a href="./member_form_manager.php" id="member_add">매니저 추가</a>-->
        <?php if ($is_admin == 'super') { ?>
            <!--<a href="./member_form_company.php" id="member_add">가맹점 추가</a>-->
        <?php } ?>
    <?php } ?>
</div>
<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);"
      method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <div class="row row-horizon">
        <div class="tbl_head02 tbl_wrap">
            <table id="table_td_center">
                <caption><?php echo $g5['title']; ?> 목록</caption>
                <colgroup>
                    <col style="width:2%"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:*"/>
                    <col style="width:5%"/>
                    <col style="width:8%"/>
                    <col style="width:*"/>
                </colgroup>
                <thead>
                <tr>


                    <th width="5" align="center" id="mb_list_chk">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th id="mb_list_no">회원번호</th>
                    <th id="mb_id">회원아이디</th>
                    <!--<th id="mb_list_join">등록일시</th>-->
                    <th id="mb_list_mb_10">지역</th>
                    <th id="mb_3">결혼유형</th>
                    <th id="mb_4">성별</a></th>
                    <th id="mb_list_name">이름<?php echo subject_sort_link('mb_name', $search_add) ?><span class="ud"></span></a></th>
                    <th id="mb_6">출생일시</a></th>
                    <th id="mb_312">나이(만)<?php echo subject_sort_link('mb_6', $search_add) ?><span class="ud"></span></a>
                    </th>
                    <th id="mb_323">직업</th>
                    <th id="mb_322">학력</th>
                    <th id="mb_23">신장</th>
                    <th id="mb_list_mb_16">종교</th>
                    <th id="mb_324">부친직업</th>
                    <th id="mb_52">연락처</th>
                    <th id="mb_memo">이상형 메모</th>
                    <th id="mb_status">진행상태</th>
                    <th id="mb_memo">상태 메모</th>
                    <th id="mb_list_auth">계약서</span></a></th>
                    <!--<th id="mb_list_mng">수정</th>-->
                </tr>


                </thead>
                <tbody>

                <?php

                for ($i = 0; $row = sql_fetch_array($result); $i++) {


                    $mb_id = $row['mb_id'];
                    $bg = 'bg' . ($i % 2);
                    $s_mod = '<a href="./member_form.php?' . $qstr . '&amp;w=u&amp;mb_id=' . $row['mb_id'] . '" class="btn btn_03">수정</a>';


                    $mb_list_no = '';
                    $rand_num = sprintf('%02d', $row['mb_no']);
                    $mb_list_no = str_replace('-', '', substr($row['mb_datetime'],2,8)).$rand_num;

                    $mb_sex = '';
                    $row['mb_sex'] == 'F' ? $mb_sex = '여' : $mb_sex = '남';


                    $leave_msg = '';
                    $intercept_msg = '';
                    $intercept_title = '';
                    if ($row['mb_leave_date']) {
                        $mb_id = $mb_id;
                        $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
                    } elseif ($row['mb_intercept_date']) {
                        $mb_id = $mb_id;
                        $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
                        $intercept_title = '차단해제';
                    }
                    if ($intercept_title == '') {
                        $intercept_title = '차단하기';
                    }


                    // 생년월일로 나이 계산
                    if ($row['mb_birth']) {
                        //$birthyear_mb = substr($row['mb_birth'], 0, 4);
                        //$nowyear_mb = date("Y");
                        //$age_mb = $nowyear_mb - $birthyear_mb;


                        // 생년월일
                        $date = date_create($row['mb_birth']);

                        // 만나이 계산
                        if($date){
                            $birthday = date_format($date, 'Y-m-d H:i:s');
                            $birthday = new DateTime($birthday);
                            // 기준일
                            $referenceDate = new DateTime(date("Y-m-d"));
                            $age_mb = $birthday->diff($referenceDate)->y;
                        }else{
                            $age_mb = '생년월일 오류';
                        }

                    } else {
                        $age_mb = "-";
                    }

                    ?>

                    <tr>
                        <td headers="mb_list_chk" class="td_chk">
                            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>"
                                   id="mb_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>"
                                   class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>
                                님</label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
                        <td id="mb_list_no<?=$mb_list_no?>" align="center" class="td_no" headers="mb_list_no"><a
                                    href="./member_form.php?w=u&mb_id=<?=$mb_id?>"><?=$mb_list_no?></a><br /><i
                                    class="fa fa-copy"
                                    onclick="path_copy_campain('<?= $mb_list_no ?>')"></i>
                        </td>
                        <!--<td headers="mb_list_join" class="td_date"></td>-->
                        <td id="mb_id<?=$mb_list_no?>" align="center" class="td_company" headers="mb_id"><?= $row['mb_id'] ?></td>
                        <td id="mb_addr_div<?=$mb_list_no?>" headers="mb_addr_div" class="td_mb_3"><?= $mb_addr_div_arr[$row['mb_addr_div']] ?></td>
                        <td id="mb_merry<?=$mb_list_no?>" align="center" class="td_company" headers="mb_merry"><?= $row['mb_merry'] ?></td>
                        <td id="mb_sex<?=$mb_list_no?>" headers="mb_sex" class="td_mb_8"><?= $mb_sex ?></td>
                        <td id="mb_name<?=$mb_list_no?>" headers="mb_name" class="td_mb_3"><?= $row['mb_name'] ?></td>
                        <td headers="mb_birth"
                            class="td_mbname"><span id="mb_birth<?=$mb_list_no?>"><?= $row['mb_birth'] ?></span> <span id="mb_birth_time<?=$mb_list_no?>"><?= $row['mb_birth_time'] ?></span></td>
                        <td id="age_mb<?=$mb_list_no?>" headers="" class="td_mb_4"><?= $age_mb ?></td>
                        <td id="mb_job_div<?=$mb_list_no?>" headers="mb_job_div" class="td_mb_323"><?= $mb_job_arr[$row['mb_job_div']] ?></td>
                        <td id="mb_education<?=$mb_list_no?>" headers="mb_education" class="td_mb_322"><?= $mb_education_arr[$row['mb_education']] ?></td>
                        <td  headers="mb_list_mb_48" class="td_mb_48"><span id="mb_height<?=$mb_list_no?>"><?= $row['mb_height'] ?>cm</span> <span id="mb_weight<?=$mb_list_no?>"><?= $row['mb_weight'] ?>kg</span>
                        </td>
                        <td id="mb_religion<?=$mb_list_no?>" headers="mb_list_mb_62" class="td_mb_62"><?= $row['mb_religion'] ?></td>
                        <td headers="mb_list_mb_324" class="td_mb_324"><span id="mb_dad<?=$mb_list_no?>">부:<?= $row['mb_dad'] ?></span>
                            <span id="mb_mom<?=$mb_list_no?>">모:<?= $row['mb_mom'] ?></span></td>
                        <td id="mb_tel<?=$mb_list_no?>" headers="mb_30" class="td_mb_30"><?= $row['mb_tel'] ?></td>
                        <td headers="mb_memo" class="td_mngsmall"><span id="mb_love_job<?=$mb_list_no?>"><?= $row['mb_love_job'] ?></span>/<span id="mb_love_age<?=$mb_list_no?>"><?= $row['mb_love_age'] ?></span>
                            /<span id="mb_love_height<?=$mb_list_no?>"><?= $row['mb_love_height'] ?></span>/<span id="mb_love_money<?=$mb_list_no?>"><?= $row['mb_love_money'] ?></span></td>
                        <td headers="mb_status" class="td_status">
                            <select id="mb_status" name="mb_status[]" onchange="approvalYNChk('<?=$mb_id?>',this.value)">

                                <option value="">선택하세요.</option>
                                <?php
                                foreach (array_keys($mb_state_arr) as $item) {
                                    ?>
                                    <option value="<?= $item ?>" <?= $row['mb_state'] == $item ? 'selected' : '' ?> <?php echo get_selected($row['mb_state'], "<?=$item?>"); ?>><?= $mb_state_arr[$item] ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </td>
                        <td headers="mb_30" class="td_mb_30"><?php
                            if ($leave_msg || $intercept_msg) {
                                echo $leave_msg . ' ' . $intercept_msg;
                            } else {
                                echo "정상";
                            }
                            ?></td>
                        <td headers="mb_list_auth" class="td_mbstat">
                            <!--
                            <?php if($row['mb_contract'] != "Y"){ ?>
                                <div class="btn_t01" onclick="contractYNChk('<?=$mb_id?>','Y')"><a>계약서작성</a></div>
                            <?php } ?>
                            -->
                            <?php
                                $sql = "select count(*) as cnt from g5_member_contract where mb_id = '{$mb_id}' and use_yn <> 'N'";
                                $contract_row_cnt = sql_fetch($sql)['cnt'];
                            ?>
                            <?php if($contract_row_cnt){ ?>
                                <div class="btn_t01">
                                    <a href="./contract_pop.php?mb_id=<?=$mb_id?>&w=u&pop=true" onclick="window.open(this.href, '_blank', 'width=1200, height=2130'); return false;">계약서보기</a>
                                </div>
                            <?php }else{ ?>
                                <div class="btn_t02">
                                    <a href="./contract_pop.php?mb_id=<?=$mb_id?>&pop=true" onclick="contractYNChk('<?=$mb_id?>','Y');window.open(this.href, '_blank', 'width=1200, height=2130'); return false;">계약서작성</a>
                                </div>
                            <?php } ?>

                        </td>
                        <!--<td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?> <?//php echo $s_grp ?></td>-->

                        <td id="mb_profile<?=$mb_list_no?>" style="display: none"><?= $row['mb_profile'] ?></td>
                    </tr>

                    <?php
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"" . $colspan . "\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
                </tbody>
            </table>
        </div>
    </div><!--row row-horizon-->

    <div class="btn_list01 btn_list">
        <!--
        <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
        -->
        <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    </div>
    <textarea id="share_path_campain2" style="display: none">회원정보 복사하는곳 입니다.</textarea>
    <input type="hidden" name="" value="" id="share_path_campain" class="regist-input" placeholder="추천인링크">
    <script>
        // 키워드복사
        function path_copy_campain(mb_list_no) {

            var html = '';
            if (mb_list_no) {
                html += '회원번호: ' + mb_list_no + '\n';
            }
            if ($('#mb_addr_div' + mb_list_no).html()) {
                html += '지역: ' + $('#mb_addr_div' + mb_list_no).html() + '\n';
            }
            if ($('#mb_merry' + mb_list_no).html()) {
                html += '결혼유형: ' + $('#mb_merry' + mb_list_no).html() + '\n';
            }
            if ($('#mb_sex' + mb_list_no).html()) {
                html += '성별: ' + $('#mb_sex' + mb_list_no).html() + '\n';
            }
            if ($('#mb_name' + mb_list_no).html()) {
                html += '이름: ' + $('#mb_name' + mb_list_no).html() + '\n';
            }
            if ($('#mb_birth' + mb_list_no).html()) {
                html += '출생일시: ' + $('#mb_birth' + mb_list_no).html() + '\n';
            }
            if ($('#mb_birth_time' + mb_list_no).html()) {
                html += '출생시간: ' + $('#mb_birth_time' + mb_list_no).html() + '\n';
            }
            if ($('#age_mb' + mb_list_no).html()) {
                html += '나이: ' + $('#age_mb' + mb_list_no).html() + '\n';
            }
            if ($('#mb_job_div' + mb_list_no).html()) {
                html += '직업: ' + $('#mb_job_div' + mb_list_no).html() + '\n';
            }
            if ($('#mb_education' + mb_list_no).html()) {
                html += '학력: ' + $('#mb_education' + mb_list_no).html() + '\n';
            }
            if ($('#mb_height' + mb_list_no).html()) {
                html += '신장: ' + $('#mb_height' + mb_list_no).html() + '\n';
            }
            if ($('#mb_weight' + mb_list_no).html()) {
                html += '몸무게: ' + $('#mb_weight' + mb_list_no).html() + '\n';
            }
            if ($('#mb_religion' + mb_list_no).html()) {
                html += '종교: ' + $('#mb_religion' + mb_list_no).html() + '\n';
            }
            if ($('#mb_dad' + mb_list_no).html()) {
                html += '' + $('#mb_dad' + mb_list_no).html() + '\n';
            }
            if ($('#mb_mom' + mb_list_no).html()) {
                html += '' + $('#mb_mom' + mb_list_no).html() + '\n';
            }
            //if (mb_tel) {
                //html += '연락처: ' + mb_tel + '\n';
            //}
            if ($('#mb_love_job' + mb_list_no).html()) {
                html += '이상형 직업: ' + $('#mb_love_job' + mb_list_no).html() + '\n';
            }
            if ($('#mb_love_age' + mb_list_no).html()) {
                html += '이상형 나이: ' + $('#mb_love_age' + mb_list_no).html() + '\n';
            }
            if ($('#mb_love_height' + mb_list_no).html()) {
                html += '이상형 신장: ' + $('#mb_love_height' + mb_list_no).html() + '\n';
            }
            if ($('#mb_love_money' + mb_list_no).html()) {
                html += '이상형 자산: ' + $('#mb_love_money' + mb_list_no).html() + '\n';
            }
			if ($('#mb_profile' + mb_list_no).html()) {
                html += '자기 소개: ' + $('#mb_profile' + mb_list_no).html() + '\n';
            }
            html += '마리엔 7179-0034';

            $('#share_path_campain2').val(html);
            $('#share_path_campain2').select();
            document.execCommand("Copy");

            window.navigator.clipboard.writeText($('#share_path_campain2').val()).then(() => {
                // 복사가 완료되면 호출된다.
                alert("복사완료");
            });

        }
    </script>
</form>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page=', $add_search); ?>

<script>
    function age(input_year, id) {
        var year = parseInt(new Date().getFullYear());
        var age = input_year;
        var ck = parseInt(age);
        $("#" + id).age(age);
        //document.all.mb_312.value=(year-ck)+1; // 우리나라 나이 표시 +1 더함
    }

    function fmemberlist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if (document.pressed == "선택삭제") {
            if (!confirm("선택한 자료를 정말 삭제하시겠습니까? \n" +
                "삭제한 회원은 복구가 불가능합니다.")) {
                return false;
            }
        }

        return true;
    }

    // 회원상태 변경
    function approvalYNChk(mb_id, approvalYN) {
        $.ajax({
            url: './ajax.set_mb_state.php',
            type: 'post',
            data: {
                mb_id: mb_id,
                approvalYN: approvalYN
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    //location.reload();
                }
            },
            error: function(request, error) {
                alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            }
        });
    }

    // 회원상태 변경
    function contractYNChk(mb_id, approvalYN) {

        //if(confirm('계약서작성 승인하시겠습니까?')){
        if(1){
            $.ajax({
                url: './ajax.set_mb_contract.php',
                type: 'post',
                data: {
                    mb_id: mb_id,
                    approvalYN: approvalYN
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        //location.reload();
                    }
                },
                error: function(request, error) {
                    alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            });

        }else{
            return false;
        }


    }
</script>

<?php
include_once('./admin.tail.php');
?>
