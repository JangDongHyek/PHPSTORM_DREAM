<?
/**********************************
 * status : 카운슬러관리 - 출퇴근on,off변경
 * match_del : 회원관리 - 소개이력 삭제, 정산현황 - 건별건수에서 삭제
 * delete : 카운슬러관리 - 카운슬러삭제 (카운슬러상태를 out으로 변경 mb_3)
 * mb_block : 회원관리 - 소개이력 제외/해제 (1건)
 * mb_block_chk : 회원관리 - 소개이력 제외/해제 (체크박스)
**********************************/
include_once('./_common.php');

switch ($mode) {
	case "status" :

		if ($_POST['mb_id'] == "" || $_POST['flag'] == "") die("F");

		// 본인정보인지 확인
		if ($member['mb_status'] == "카운슬러" && $member['mb_id'] != $_POST['mb_id']) {
			die("E");
		}

		$stt = ($_POST['flag'] == "on")? "off" : "on";

		$sql = "UPDATE g5_member SET 
				mb_3 = '{$stt}'
				WHERE mb_id = '{$mb_id}' AND mb_status = '카운슬러'
				";
		
		echo (sql_query($sql))? "T" : "F";
		break;
	
	case "match_del" :
		if ($_POST['idx'] == "" || $member['mb_status'] != "관리자") die("F");

		$idx = $_POST['idx'];
		$sql = "DELETE FROM g5_matching WHERE idx = '{$idx}'";
		$result = sql_query($sql);

		if ($result) {
		    // 매칭시 사용된 쿠폰있으면 초기화
            $update_sql = "UPDATE g5_coupon SET use_date = '', matching_idx = 0 WHERE matching_idx = {$idx}";
            sql_query($update_sql);
        }

		echo ($result)? "T" : "F";
		break;

	case "delete" :

		$h_list = "";

		foreach ($_POST['list'] as $key=>$val) {
			if ($h_list == "")
				$h_list .= "'{$val}'";
			else 
				$h_list .= ", '{$val}'";
		}
		
		$sql = "UPDATE g5_member SET mb_3 = 'out' 
				WHERE mb_id IN ({$h_list})";

		echo (sql_query($sql))? "T" : "F";
		break;

    case "mb_block_chk" :
        $helper_no = $member['mb_no'];
        $chk_list = $_POST['chk'];
        $unChk_list = $_POST['unChk'];

        // 체크 회원
        if (count($chk_list) > 0) {
            $sql = "INSERT INTO g5_member_block (parent_mb_no, helper_no) VALUES ";
            $values = [];
            foreach ($chk_list AS $key=>$parent_mb_no) {
                $values[] = "({$parent_mb_no}, {$helper_no})";
            }
            $sql .= implode($values, ",");
            sql_query($sql);
        }

        // 체크안한 회원
        if (count($unChk_list) > 0) {
            $sql = "DELETE FROM g5_member_block WHERE helper_no = '{$helper_no}'";
            $sql .= " AND parent_mb_no IN (". implode($unChk_list, ",") .")";
            sql_query($sql);
        }

        break;
}


?>