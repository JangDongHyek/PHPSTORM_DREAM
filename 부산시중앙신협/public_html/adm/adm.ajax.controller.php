<?php
include_once("./_common.php");

$mode = $_POST["mode"];
if (!$is_admin){
    alert("관리자만 이용 가능한 서비스 입니다.",G5_BBS_URL."/login.php?url=".$_REQUEST["url"]);
}

if ($mode == "wr_proc_change"){

    $sql = "update g5_write_cucenter set wr_proc = '{$_REQUEST["val"]}' where wr_id = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;
}elseif ($mode == "level_change"){


    //보조관리자
    if ($_REQUEST["val"] == 6){
        $_REQUEST["val"] = 8;
    }

    $sql = "update g5_member set mb_level = '{$_REQUEST["val"]}' where mb_id = '{$_REQUEST["id"]}' ";
    $result =sql_query($sql);

    echo $result;

}elseif ($mode == "autocomplete"){
    $sql = "select * from g5_member order by mb_id desc ";
    $result = sql_query($sql);
    $arr = [];
    for ($i = 0; $row = sql_fetch_array($result); $i++){
        $arr[$i] = $row["mb_id"]."/".$row["mb_name"]."/".$level_arr[$row["mb_level"]-1]."/".$row["mb_hp"];
    }

    die(json_encode($arr));
}elseif ($mode == "autocomplete_select"){
    $mb = get_member($_REQUEST["id"]);

    $arr = array(
      "name" => $mb["mb_name"],
      "id_level" =>$mb["mb_id"]."/".$level_arr[$mb["mb_level"]-1]."/".$mb["mb_1"],
      "hp" =>$mb["mb_hp"],
    );
    die(json_encode($arr));

}elseif($mode == "view_yn_change"){

    $sql = "update g5_write_cucenter set wr_view_yn = '{$_REQUEST["val"]}' where wr_id = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;

}elseif ($mode == "pr_update"){

    $sql = "update new_private_reserve set ";
    foreach ($_REQUEST as $key => $value) {
        if ($key != "idx" && $key != "mode") {
            $sql .= $key . "='" . $value . "',";
        }
    }
    $sql .= " up_datetime = '".G5_TIME_YMDHIS."' ";
    $sql .= " where pr_idx = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;
}elseif ($mode == "gr_update"){

	
	if($_REQUEST['gr_room'] <= 3){

		if($_REQUEST['gr_proc'] == "comp"){
			insert_point($_REQUEST['mb_id'], -100, "골프예약", '@passive', $_REQUEST['mb_id'], $member['mb_id'].'-'.uniqid(''), $expire);
		} else {
			insert_point($_REQUEST['mb_id'], 100, "골프예약 취소", '@passive', $_REQUEST['mb_id'], $member['mb_id'].'-'.uniqid(''), $expire);
		}
	}



    $sql = "update new_golf_reserve set ";
    foreach ($_REQUEST as $key => $value) {
        if ($key != "idx" && $key != "mode") {
            $sql .= $key . "='" . $value . "',";
        }
    }
    $sql .= " up_datetime = '".G5_TIME_YMDHIS."' ";
    $sql .= " where gr_idx = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;

}elseif ($mode == "payment_chk"){
    $sql = "update new_golf_reserve set payment_chk = '{$_REQUEST["val"]}' where gr_idx = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;
}elseif ($mode == "culture_payment_chk"){
    $sql = "update new_enrolment set payment_chk = '{$_REQUEST["val"]}' where e_idx = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;
}elseif ($mode == "e_proc_change"){

    $sql = "update new_enrolment set e_proc = '{$_REQUEST["val"]}' where e_idx = '{$_REQUEST["idx"]}' ";
    $result =sql_query($sql);

    echo $result;
}elseif ($mode== "wait_mem_update"){

    for ($i=0; $i<count($_POST['wait_mem_chk']); $i++) {

        // 실제 번호를 넘김
        $sql = "update new_enrolment set e_is_wait = 'N', up_datetime = '".G5_TIME_YMDHIS."' where e_idx = '{$_POST['wait_mem_chk'][$i]}' ";
        sql_query($sql);

    }

    alert("접수인원으로 변경되었습니다.",G5_ADMIN_URL."/culture_write.php?w=u&wr_id=".$_REQUEST["wr_id"]);
}elseif ($mode== "no_wait_mem_update"){

    for ($i=0; $i<count($_POST['no_wait_mem_chk']); $i++) {

        // 실제 번호를 넘김
        $sql = "update new_enrolment set e_is_wait = 'Y', up_datetime = '".G5_TIME_YMDHIS."' where e_idx = '{$_POST['no_wait_mem_chk'][$i]}' ";
        sql_query($sql);

    }

    alert("대기인원으로 변경되었습니다.",G5_ADMIN_URL."/culture_write.php?w=u&wr_id=".$_REQUEST["wr_id"]);
}
