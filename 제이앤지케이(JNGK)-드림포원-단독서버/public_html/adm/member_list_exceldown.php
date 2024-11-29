<?php

    $sub_menu = "200100";
    include_once('./_common.php');
    
    auth_check($auth[$sub_menu], 'r');
    
    // 엑셀 다운로드 함수
    function array_to_excel($data, $filename)
    {
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $out = fopen('php://output', 'w');
        fputs($out, "\xEF\xBB\xBF"); // UTF-8 with BOM
        if(!empty($data)) {
            fputcsv($out, (array)array_keys($data[0]), "\t");
            foreach ($data as $row) {
                fputcsv($out, (array)$row, "\t");
            }
        }
        fclose($out);
    }


    // ===== 21.02.28 회원현황 조회 시 미등록회원, 휴면회원 체크 끝 =====
    
    // 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정)
    $sql_common = " from {$g5['member_table']} as mb ";
    // 22.01.07 이전내용
    /*$sql_common = " from {$g5['member_table']} as mb
                    left join g5_lesson as le on le.idx = mb.lesson_idx ";*/
    
    $sql_search = " where mb_id != 'admin' and mb_category = '회원' and use_yn = 'Y' "; // 온라인(online)/휴면(no_long_register)/미등록(no_register)은 유효회원에서 제외, 21.04.29 삭제한 회원 제외
    
    //센터코드입력시 해당센터 가져오는곳
    $center_code = '';

    // 팀장으로 로그인 시 본인 센터 정보만 조회
    if($member['mb_level'] == 9) {
        $g5['title'] = '회원관리';
        $center_code = $member['center_code'];
        $sql_search .= " and mb.center_code = '{$member['center_code']}' ";
    }else if($member['mb_level'] == 8){
        $g5['title'] = '회원정보';
        $center_code = $member['center_code'];
        $sql_search .= " and pro_mb_no = '{$member['mb_no']}' and mb.center_code = '{$member['center_code']}' ";
    }else{
        $g5['title'] = '회원관리';
        $center_code = $_REQUEST['center_code'];
        $sql_search .= " and mb.center_code = '{$_REQUEST['center_code']}' ";
    }

    /* 23.10.31 이런식으로하면 다이어리 없는애들 안적힘;; wc
    $center_arr = array();
    $center = sql_query(" select lesson_name,lesson_code from g5_lesson where center_code = '{$center_code}' ");
    for ($j = 0 ; $center_row = sql_fetch_array($center) ; $j++){
        $center_arr[$center_row['lesson_code']] = array('lesson_name' => $center_row['lesson_name']);
    }
    */

    // 검색
    if ($stx) {
        $name = str_replace(' ', '', $stx);
        $sql_search .= " and (mb_id_no like '%{$name}%' or mb_name like '%{$name}%' or mb_id like '%{$name}%') ";
    }
    
    // 정렬
    if (!$sst) {
        $sst = "mb_reg_date";
        $sod = "desc";
    }
    
    // 회원구분
    $current = '';
    if(!empty($_GET['member_option'])) {
        if($_GET['member_option'] == '유효회원') {
            $sql_search .= " and mb_state not in ('online', 'no_register', 'no_long_register') ";
        } else if($_GET['member_option'] == '신규회원') {
            $sql_search .= " and mb_state = 'new_member' ";
        } else if($_GET['member_option'] == '재등록회원') {
            $sql_search .= " and mb_state = 're_member' ";
        } else if($_GET['member_option'] == '온라인회원') {
            $sql_search .= " and mb_state = 'online' ";
        } else if($_GET['member_option'] == '미등록회원') {
            $sql_search .= " and mb_state = 'no_register' ";
        } else if($_GET['member_option'] == '휴면회원') {
            $sql_search .= " and mb_state = 'no_long_register' ";
        } else if($_GET['member_option'] == '유보회원') {
            $sql_search .= " and mb_state in ('no_register', 'no_long_register') "; // 온라인회원은 팀장이 등록 후 조회
        } else if($_GET['member_option'] == '전체') {

        }
    } else {
        $sql_search .= " and mb_state not in ('online', 'no_register', 'no_long_register') ";
        $current = 'current';
    }
    
    // 미등록회원에서 프로명 선택 시
    $pro = '';
    if(!empty($_GET['pro'])) {
        $pro = $_GET['pro'];
        $sql_search .= " and pro_mb_no = '{$pro}' ";
    }
    $sql_order = " order by mb_reg_date asc ";

    $sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
    $result = sql_query($sql);
    
    // 테이블 출력을 위한 HTML 코드 추가
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>번호</th>";
    echo "<th>회원번호</th>";
    echo "<th>아이디</th>";
    echo "<th>상태</th>";
    echo "<th>이름</th>";
    echo "<th>휴대전화</th>";
    echo "<th>주소</th>";
    echo "<th>이메일</th>";
    echo "<th>생년월일</th>";
    echo "<th>구분</th>";
    echo "<th>센터/아카데미</th>";
    echo "<th>담당프로</th>";
    echo "<th>상품명</th>";
    echo "<th>등록일</th>";
    echo "<th>레슨시작일</th>";
    echo "<th>레슨종료일</th>";

    echo "<th>잔여회차</th>";
    echo "<th>사용회차</th>";

    echo "<th>총 회차</th>";
    echo "<th>추천인</th>";
    echo "<th>골프점수</th>";
    echo "<th>골프경력</th>";
    echo "<th>레슨경험</th>";
    echo "<th>평균 라운딩 수</th>";
    echo "<th>바라는점</th>";






    
    echo "</tr>";

    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        // 데이터 가공
        if ($row['mb_state'] == 'new_member') {
            $mb_state = '신규';
            $state_class = 'mbs_new';
        } else if ($row['mb_state'] == 're_member') {
            $mb_state = '재등록';
            $state_class = 'mbs_re';
        } else if ($row['mb_state'] == 'one_point_lesson') {
            $mb_state = '원포인트';
            $state_class = 'mbs_one';
        } else if ($row['mb_state'] == 'online') {
            $mb_state = '온라인';
        } else if ($row['mb_state'] == 'no_register') {
            $mb_state = '미등록';
        } else if ($row['mb_state'] == 'no_long_register') {
            $mb_state = '휴면';
        }

        //23.10.30 left join 최대한빼고 쿼리실행 최소화 wc
        //$info = sql_fetch(" select md.lesson_remain_count, his.lesson_name from g5_lesson_diary as md right outer join g5_member_history as his on md.history_idx = his.idx where his.idx = '{$row['history_idx']}' order by md.idx desc limit 1 ");
        $info = sql_fetch(" select lesson_code,lesson_count,lesson_remain_count from g5_lesson_diary where mb_no = '{$row['mb_no']}' and history_idx = '{$row['history_idx']}' order by idx desc limit 1 ");

        $lesson_name = '';
        //$lesson_name = $center_arr->$info['lesson_code']->lesson_name;
        //$lesson_name = $center_arr[$info['lesson_code']]['lesson_name'];

        $lesson_count = '0회';
        $lesson_remain_count = 0;
        $lesson_total_count = '0회';

        // 22.01.07 레슨정보 수정 (레슨 삭제 시 데이터 제대로 나오지 않아 수정) -> 23.10.31 살짝더 커스텀
        $tmp0 = sql_fetch(" select lesson_name from g5_member_history where idx = '{$row['history_idx']}' order by idx desc limit 1");
        if($tmp0){
            $tmp1 = explode('/', $tmp0['lesson_name']);
            //$lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.$tmp1[3].' / '.number_format($tmp1[4]);
            $lesson_name = $tmp1[0];
            $lesson_remain_count = '0회';
            $lesson_total_count = $tmp1[2];
            if($tmp1[0] == '원포인트'){
                //$lesson_name = $tmp1[0].' / '.$tmp1[1].'/'.$tmp1[2].' / '.number_format($tmp1[3]);
                $lesson_name = $tmp1[0];
                $lesson_total_count = $tmp1[1];
            }
        }


        if($info){
            $info['lesson_count'] <= 0 ? $lesson_count = '0회' : $lesson_count = $info['lesson_count'].'회';
            $info['lesson_remain_count'] <= 0 ? $lesson_remain_count = '0회' : $lesson_remain_count = $info['lesson_remain_count'].'회';

            $lesson_total_count = $info['lesson_count']*1 + $info['lesson_remain_count']*1;
            $lesson_total_count = $lesson_total_count.'회';
        }else{
            $lesson_remain_count = $lesson_total_count;
        }





        if($row['mb_reg_date'] >= '2000-01-01'){
            $mb_reg_date =  date("Y-m-d", strtotime($row['mb_reg_date']));
        }else{
            $mb_reg_date = '-';
        }

        if($row['lesson_start_date'] >= '2000-01-01'){
            $lesson_start_date =  date("Y-m-d", strtotime($row['lesson_start_date']));
        }else{
            $lesson_start_date = '-';
        }

        if($row['lesson_end_date'] >= '2000-01-01'){
            $lesson_end_date =  date("Y-m-d", strtotime($row['lesson_end_date']));
        }else{
            $lesson_end_date = '-';
        }






        // 테이블 출력을 위한 HTML 코드 추가
        echo "<tr>";
    
        echo "<td>" . ($i + 1) . "</td>";
        echo "<td>" . $row['mb_id_no'] . "</td>";
        echo "<td style='mso-number-format:\"@\";'>" . $row['mb_id'] . "</td>";
        echo "<td>" . $mb_state . "</td>";
        echo "<td>" . $row['mb_name'] . "</td>";
        echo "<td style='mso-number-format:\"@\";'>" . $row['mb_hp'] . "</td>";
        echo "<td>" . $row['mb_addr1'] . $row['mb_addr2'] ."</td>";
        echo "<td>" . $row['mb_email'] . "</td>";
        echo "<td>" . $row['mb_birth'] . "</td>";
        echo "<td>" . $row['mb_option'] . "</td>";
        echo "<td>" . $row['mb_center'] . "</td>";
        echo "<td>" . $row['mb_charge_pro'] . "</td>";
        echo "<td>" . $lesson_name . "</td>";
        echo "<td>" . $mb_reg_date . "</td>";
        echo "<td>" . $lesson_start_date . "</td>";
        echo "<td>" . $lesson_end_date . "</td>";

        echo "<td>" . $lesson_remain_count . "</td>";
        echo "<td>" . $lesson_count . "</td>";

        echo "<td>" . $lesson_total_count . "</td>";
        echo "<td>" . $row['mb_recommend'] . "</td>";
        echo "<td>" . $row['mb_score'] . "</td>";
        echo "<td>" . $row['mb_career'] . "</td>";
        echo "<td>" . $row['mb_lesson'] . "</td>";
        echo "<td>" . $row['mb_rounding'] . "</td>";
        echo "<td>" . $row['mb_wish'] . "</td>";

        echo "</tr>";
    }
    
    // 테이블 출력을 위한 HTML 코드 추가
    echo "</table>";
    
    // 엑셀 다운로드
    array_to_excel($data, '회원리스트');


