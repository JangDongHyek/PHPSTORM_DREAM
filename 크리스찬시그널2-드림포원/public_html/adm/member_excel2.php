<?php

include_once("./_common.php");
$filename = "".$config['cf_title']."_서비스관리_".date('Ymd',strtotime(G5_TIME_YMD));

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$filename.".xls" );
header( "Content-Description: PHP4 Generated Data" );

$user_type = $_REQUEST["user_type"];
$old = $_REQUEST["old"];
if(!empty($user_type)) {
    if($user_type == 'basic') {
        $sql_common .= " and mb_level = 2 ";
    } else if($user_type == 'secret') {
        $sql_common .= " and secret_member = 'Y' ";
    } else if($user_type == 'no_basic') {
        $sql_common .= " and mb_join_type = '장애인' ";

    }
}


$sql =  "select * from g5_member where mb_level != '10' {$sql_common} order by mb_datetime desc";
$result = sql_query($sql);


// 테이블 상단 만들기
$EXCEL_STR = "
  <table>
    <colgroup>
        <col width=\"3%\">
        <col width=\"3%\">
        <col width=\"5%\">
        <col width=\"5%\">
        <col width=\"10%\">
        <col width=\"10%\">
        <col width=\"4%\">
        <col width=\"8%\">
        <col width=\"4%\">
        <col width=\"7%\">
        <col width=\"5%\">
        <col width=\"5%\">
        <col width=\"7%\">
        <col width=\"5%\">
        <col width=\"5%\">
    </colgroup>
    <thead>
	<tr>
        <th>No.</th>
        <th>보기</th>
		<th>아이디</a></th>
		<th>닉네임</th>
		<th>이름</a></th>
		<th>나이</th>
        <th>성별</th>
		<th>휴대폰</th>
        <th>지역</th>
		<th>가입일</th>
        <th>상태</th>
        <th>보유만나</th>
        
        <th>가입유형</th>
        <th>희망하는 직업</th>
        <th>희망하는 키</th>
        <th>희망하는 학벌</th>
        <th>희망하는 연봉</th>
        <th>희망하는 근무형태</th>
        <th>희망하는 스타일</th>
        <th>희망하는 상대의 결혼여부</th>
        
        <th>교회에 다니는지?</th>
        <th>교회에 다닌 기간?</th>
        <th>봉사</th>
        <th>십일조 여부</th>
        <th>감사헌금</th>
        <th>교회공개 여부</th>
        <th>교회이름</th>
        <th>담임목사님</th>
        <th>교회위치 시</th>
        <th>교회위치 구</th>
        <th>교회위치 동</th>
        
        <th>직업</th>
        <th>혈액형</th>
        <th>키 (cm)</th>
        <th>몸무게 (kg)</th>
        <th>mbti</th>
        <th>사는지역</th>
        <th>나이</th>
        <th>취미</th>
        <th>영화</th>
        <th>음악</th>
        <th>TV</th>
        <th>나누고 싶은 음식</th>
        <th>해보고 싶은 것</th>
        <th>매력포인트나 장점</th>
        
        <th>최종졸업학교</th>
        <th>학과</th>
        <th>연봉</th>
        <th>자차</th>
        <th>자가</th>
        <th>자녀</th>
        
        
        
        
        ";
$no = 1;
while($row = sql_fetch_array($result)) {
    $mb_nick = $row['mb_nick'];
    $mb_id = $row['mb_id'];
    $mb = get_member($mb_id);
    $text = "";
    if ($row['mb_level'] == 2 && $row['mb_approval'] == 'Y') {
        if ($row['show_yn'] == 'Y') {
            $text = "공개";
        } else if ($row['show_yn'] == 'Y') {
            $text = "비공개";
        }
    } else if ($row['mb_level'] == 1) {
        $text = "탈퇴";
    }
    if($row['mb_approval'] == 'Y') { $state = '승인'; } else if($row['mb_approval_request'] == 'Y') { $state = '심사 요청'; }


    // 생년월일로 나이 계산
    if ($row['mb_birth']) {
        $birthyear_mb = substr($row['mb_birth'], 0, 4);
        $nowyear_mb = date("Y");
        $age_mb = $nowyear_mb - $birthyear_mb + 1;
    } else {
        $age_mb = "-";
    }


    //희망배우자정보
    $sql = "select * from g5_member_hope where mb_id = '{$mb_id}' ";
    $mh = sql_fetch($sql);
    $mh_job = explode(",",$mh["mh_job"]);
    $mh_height = explode(",",$mh["mh_height"]);
    $mh_school = explode(",",$mh["mh_school"]);
    $mh_salary = explode(",",$mh["mh_salary"]);
    $mh_type = explode(",",$mh["mh_type"]);
    $mh_marry_yn = explode(",",$mh["mh_marry_yn"]);

    //신앙정보
    $sql = "select * from new_member_interview where mb_id = '{$mb_id}' ";
    $mi = sql_fetch($sql);

    $mh_job_result = '';
    for ($i=1; $i <= count($mh_job_arr); $i++) {
        for ($a = 0; $a < count($mh_job); $a++) {
            if ($mh_job[$a] == $mh_job_arr[$i]["code"]) {
                $mh_job_result .= $mh_job_arr[$i]["name"].' ';
            }
        }
    }

    $mh_height_result = '';
    for ($i=1; $i <= count($mh_height_arr); $i++) {
        for ($a = 0; $a < count($mh_height); $a++) {
            if ($mh_height[$a] == $mh_height_arr[$i]["code"]) {
                $mh_height_result .= $mh_height_arr[$i]["name"].' ';
            }
        }
    }

    $mh_school_result = '';
    for ($i=1; $i <= count($mh_school_arr); $i++) {
        for ($a = 0; $a < count($mh_school); $a++) {
            if ($mh_school[$a] == $mh_school_arr[$i]["code"]) {
                $mh_school_result .= $mh_school_arr[$i]["name"].' ';
            }
        }
    }

    $mh_salary_result = '';
    for ($i=1; $i <= count($mh_salary_arr); $i++) {
        for ($a = 0; $a < count($mh_salary); $a++) {
            if ($mh_salary[$a] == $mh_salary_arr[$i]["code"]) {
                $mh_salary_result .= $mh_salary_arr[$i]["name"].' ';
            }
        }
    }



    $mh_type_result = '';
    for ($i=1; $i <= count($mh_type_arr); $i++) {
        for ($a = 0; $a < count($mh_type); $a++) {
            if ($mh_type[$a] == $mh_type_arr[$i]["code"]) {
                $mh_type_result .= $mh_type_arr[$i]["name"].' ';
            }
        }
    }

    $mh_style_result = '';
    for ($i=1; $i <= count($mh_style_arr); $i++) {
        if($mh_style_arr[$i]["code"] == $mh["mh_style"]){
            $mh_style_result .= $mh_style_arr[$i]["name"].' ';
        }
        if($mh["mh_style"] == 5 ){
            $mh_style_result .= $mh['mh_style_memo'].' ';
        }
    }

    $mh_marry_result = '';
    for ($i=1; $i <= count($mh_marry_yn_arr); $i++) {
        for ($a = 0; $a < count($mh_marry_yn); $a++) {
            if ($mh_marry_yn[$a] == $mh_marry_yn_arr[$i]["code"]) {
                $mh_marry_result .= $mh_marry_yn_arr[$i]["name"].' ';
            }
        }
    }

    $mi_chance_result = '';
    for ($i = 1; $i <= count($mi_chance_arr); $i++){
        if ($i == $mi['mi_chance']){
            $mi_chance_result .= $mi_chance_arr[$i].' ';
        }
    }

    $mh_date_result = '';
    for ($i=1; $i <= count($mi_date_arr); $i++) {
        if ($i == $mi['mi_date']){
            $mh_date_result .= $mi_date_arr[$i].' ';
        }
    }

    $mi_angel_result = '';
    for ($i=1; $i <= count($mi_angel_arr); $i++) {
        if ($i == $mi['mi_angel']){
            $mi_angel_result .= $mi_angel_arr[$i].' ';
        }
    }

    $mi_ten_result = '';
    if($mi['mi_ten'] == 'Y'){
        $mi_ten_result = '하고있다.';
    }else if($mi['mi_ten'] == 'N'){
        $mi_ten_result = '하지않는다.';
    }

    $mi_tk_result = '';
    if($mi['mi_tk'] == 'Y'){
        $mi_tk_result = '하고있다.';
    }else if($mi['mi_tk'] == 'N'){
        $mi_tk_result = '하지않는다.';
    }

    $mi_church_open_result = '';
    if($mi['mi_church_open'] == 1){
        $mi_church_open_result = '공개';
    }else if($mi['mi_church_open'] == 0){
        $mi_church_open_result = '비공개';
    }

    $hobby_result = '';
    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
    $sql .= " where co.co_code_name = '취미' order by co.co_code*1 ";
    $result0 = sql_query($sql);
    for($i=0;$row0=sql_fetch_array($result0);$i++) {
        if($mb['mb_no'] == $row0['mb_no'] && !empty($row0['hobby_code'])) {
            $hobby_result .= $row0['co_main_code_value'].' ';
        }
    }

    $movie_result = '';
    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
    $sql .= " where co.co_code_name = '영화' order by co.co_code*1 ";
    $result2 = sql_query($sql);
    for($i=0;$row2=sql_fetch_array($result2);$i++) {
        if($mb['mb_no'] == $row2['mb_no'] && !empty($row2['hobby_code'])) {
            $movie_result .= $row2['co_main_code_value'].' ';
        }
    }

    $music_result = '';
    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
    $sql .= " where co.co_code_name = '음악' order by co.co_code*1 ";
    $result3 = sql_query($sql);
    for($i=0;$row3=sql_fetch_array($result3);$i++) {
        if($mb['mb_no'] == $row3['mb_no'] && !empty($row3['hobby_code'])) {
            $music_result .= $row3['co_main_code_value'].' ';
        }
    }

    $tv_result = '';
    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
    $sql .= " where co.co_code_name = 'TV' order by co.co_code*1 ";
    $result4 = sql_query($sql);
    for($i=0;$row4=sql_fetch_array($result4);$i++) {
        if($mb['mb_no'] == $row4['mb_no'] && !empty($row4['hobby_code'])) {
            $tv_result = $row4['co_main_code_value'].' ';
        }
    }

    $mi_food_result = '';
    for ($i=1; $i <= count($mi_food_arr); $i++) {
        if ($i == $mi['mi_food']){
            $mi_food_result = $mi_food_arr[$i].' ';
        }
        if($mi["mi_food"] == 6){
            $mi_food_result = $mi["mi_food_memo"].' ';
        }
    }

    $mi_charming_result = '';
    for ($i=1; $i <= count($mi_charming_arr); $i++) {
        if ($i == $mi['mi_charming']){
            $mi_charming_result = $mi_charming_arr[$i].' ';
        }
        if($mi["mi_charming"] == 6){
            $mi_charming_result = $mi["mi_charming_memo"];
        }
    }

    $mb_myhome_result = '';
    if($mb['mb_myhome'] == 'Y'){
        $mb_myhome_result = '있음';
    }else if($mb['mb_myhome'] == 'N'){
        $mb_myhome_result = '없음';
    }




    $EXCEL_STR .= "
    <tr>
        <td>" . $no . "</td>
        <td>" . $text . "</td>
		<td>" . $mb_id . "</td>
		<td>" . $mb_nick . "</td>
		<td>" . get_text($row['mb_name']) . "</td>
		<td>" . $age_mb . "</td>
        <td>" . $row['mb_sex'] . "</td>
        <td>" . $row['mb_hp'] . "</td>
        <td>" . $row['mb_live_si'] . "</td>
		<td>" . substr($row['mb_datetime'], 0, 10) . "</td>
        <td>" . $state . "</td>
        <td>".number_format($row['cw_point'])."</td>
        
        <td>".$row['mb_join_type']."</td>
        
        <td>".$mh_job_result."</td>
        <td>".$mh_height_result."</td>
        <td>".$mh_school_result."</td>
        <td>".$mh_salary_result."</td>
        <td>".$mh_type_result."</td>
        <td>".$mh_style_result."</td>
        <td>".$mh_marry_result."</td>
        
        <td>".$mi_chance_result."</td>
        <td>".$mh_date_result."</td>
        <td>".$mi_angel_result."</td>
        <td>".$mi_ten_result."</td>
        <td>".$mi_tk_result."</td>
        <td>".$mi_church_open_result."</td>
        <td>".$mi['mi_church1']."</td>
        <td>".$mi['mi_church2']."</td>
        <td>".$mi['mi_church_place1']."</td>
        <td>".$mi['mi_church_place2']."</td>
        <td>".$mi['mi_church_place3']."</td>
        
        <td>".$mb['mb_job']."</td>
        <td>".$mb['mb_blood_type']."</td>
        <td>".$mb['mb_height']."</td>
        <td>".$mb['mb_weight']."</td>
        <td>".$mb['mb_mbti']."</td>
        <td>".$mb['mb_live_si'].' '.$mb['mb_live_gu']."</td>
        <td>".$mb['mb_old']."</td>
        <td>".$hobby_result."</td>
        <td>".$movie_result."</td>
        <td>".$music_result."</td>
        <td>".$tv_result."</td>
        <td>".$mi_food_result."</td>
        <td>".$mi['mi_want'].' '.$mi["mi_want_memo"]."</td>
        <td>".$mi_charming_result."</td>
        <td>".$mb['mb_school']."</td>
        <td>".$mb['mb_department']."</td>
        <td>".$mb['mb_salary']."</td>
        <td>".$mb["mb_mycar_name"].' '.$mb["mb_mycar_name_memo"]."</td>
        <td>".$mb_myhome_result."</td>
        <td>".$mb['mb_children']."</td>
    </tr>";
    $no++;

}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>

