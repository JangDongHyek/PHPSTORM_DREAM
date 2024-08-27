<?php
/*****************************************
회원관리 - 매칭등록

1. 매칭DB 등록 
2. 회원DB 업데이트 (마지막소개일자) - 매칭회원, 매칭소개회원 모두 업데이트
*****************************************/
$sub_menu = "350100";
include_once('./_common.php');

$mc_list = array();

foreach ($list_no AS $key=>$val) {
    $match_type = $_POST['match_type'][$val];
    $mb_id = $_POST['mb_id']; // 매칭회원 아이디
    $mb_no = $_POST['mb_no']; // 매칭회원 번호
    $target_id = $_POST['target_id'][$val]; // 상대회원 아이디
    $target_no = $_POST['target_no'][$val]; // 상대회원 번호
    $male_mb_no = ($_POST['mb_sex']=="남")? $mb_no : $target_no; // 남자회원 번호


    $coupon_count = getMemberCoupon($male_mb_no);
    $heart_count = getMemberHeart($male_mb_no);

    switch ($match_type) {
        case $match_type_arr[2] :
            if($coupon_count <= 0) {
                echo "남자회원의 쿠폰이 부족합니다.";
                die;
            }
            break;

        case $match_type_arr[3] :   // 2.3 `포인트소개`이면 포인트-10
            if($heart_count < 10000) {
                echo "남자회원의 포인트가 부족합니다. 보유 포인트 ($heart_count)";
                die;
            }
            break;
    }


	// 1. 매칭DB 등록
	$sql = "INSERT INTO g5_matching SET
			mb_id = '{$_POST['mb_id']}',
			target_id = '{$_POST['target_id'][$val]}',
			helper_id = '{$_POST['helper_id'][$val]}',
			match_type = '{$_POST['match_type'][$val]}',
			match_date = '".G5_TIME_YMDHIS."'
			";
	
	$result = sql_query($sql);
    $matching_idx = sql_insert_id();

	if ($result) {
		// 2. 회원DB 업데이트 (마지막소개일)
		$sql = "UPDATE g5_member SET mb_last_match = '".G5_TIME_YMDHIS."'
				WHERE mb_id IN ('{$_POST['mb_id']}', '{$_POST['target_id'][$val]}');
				";
		sql_query($sql);

        // 소개종류에 따른 쿠폰, 포인트 처리 (남자회원에게만 적용)
        switch ($match_type) {
            case $match_type_arr[2] :   // 2.1 `쿠폰소개`이면 소지중인 쿠폰-1
                $row = sql_fetch("SELECT idx FROM g5_coupon WHERE mb_no = '{$male_mb_no}' AND use_date = '' ORDER BY idx ASC LIMIT 1"); // 미사용된 쿠폰 인덱스 조회

                if ($row['idx']) {
                    $update_sql = "UPDATE g5_coupon SET 
                                use_date = '".G5_TIME_YMDHIS."', matching_idx = '{$matching_idx}' 
                                WHERE idx = '{$row['idx']}'";
                    sql_query($update_sql);
                }

                break;

            case $match_type_arr[0] :   // 2.2 `계좌결제소개`, `폰&카드소개`이면 포인트+1
            case $match_type_arr[1] :
                setMemberHeart($male_mb_no, 1000, 0, "소개팅 포인트지급", $matching_idx);
                break;

            case $match_type_arr[3] :   // 2.3 `포인트소개`이면 포인트-10
                setMemberHeart($male_mb_no, 0, 10000, "포인트 소개팅 사용", $matching_idx);
                break;
        }

		$mc_list['succ'][] = $target_name[$val];

	} else {
		$mc_list['fail'][] = $target_name[$val];
	}
}

if (count($mc_list['fail']) == 0) {
	echo "<script>
		alert('매칭 등록이 완료되었습니다.');
		window.opener.location.reload();
		window.open('', '_self', '');
		window.close();
	  </script>";

} else {
	echo "실패한 매칭이 있습니다.<br><br>";
	echo "총 : " . (count($mc_list['fail']) + count($mc_list['succ'])) . "건<br>";
	echo "성공 : ".count($mc_list['succ']) . "건 - ".implode(",", $mc_list['succ'])."<br>";
	echo "실패 : ".count($mc_list['fail']) . "건 - ".implode(",", $mc_list['fail']);
}

/*

// 1. 매칭DB 등록
$sql = "INSERT INTO g5_matching SET
		mb_id = '{$_POST['mb_id']}',
		target_id = '{$_POST['target_id']}',
		helper_id = '{$member['mb_id']}',
		match_type = '{$_POST['match_type']}',
		match_date = '".G5_TIME_YMDHIS."'
		";
$result = sql_query($sql);

if ($result) {
	// 2. 회원DB 업데이트 (마지막소개일)
	$sql = "UPDATE g5_member SET mb_last_match = '".G5_TIME_YMDHIS."'
			WHERE mb_id IN ('{$_POST['mb_id']}', '{$_POST['target_id']}');
			";
	sql_query($sql);

	echo "<script>
			alert('매칭 등록이 완료되었습니다.');
			window.opener.location.reload();
			window.open('', '_self', '');
			window.close();
		  </script>";

} else {
	echo "<script>
			alert('매칭 등록에 실패하였습니다. 다시 시도해 주세요.');
			window.open('', '_self', '');
			window.close();
		</script>";
}

exit;
*/

?>