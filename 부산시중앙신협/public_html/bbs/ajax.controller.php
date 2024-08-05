<?php
include_once("./_common.php");

$mode = $_POST["mode"];

if (!$is_member){
    alert("회원만 이용 가능한 서비스 입니다.",G5_BBS_URL."/login.php?url=".$_REQUEST["url"]);
}

if ($mode== "private_reserve_form"){

    $sql = "insert into new_private_reserve set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'pr_') === 0) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= "mb_id = '{$member["mb_id"]}', ";
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    $result = sql_query($sql);

    if ($result == 1) {
        alert("프라이빗 센터 예약이 완료되었습니다.", G5_URL);
    }else{
        alert("프라이빗 센터 예약이 실패했습니다. 다시시도해주세요.", $_REQUEST["url"]);
    }

}elseif ($mode == "reserve_time"){
    $date =$_REQUEST["date"];

    $sql = "select * from new_private_reserve where pr_date = '{$date}' and pr_window = '{$_REQUEST["window"]}'";
    $result = sql_query($sql);
    $html = "";
    $time_arr = [];
    for ($a=0; $row = sql_fetch_array($result); $a++){
       $time_arr[] = $row;
    }


    for ($i =10; $i <= 15; $i ++){

            $hour = $i;
            $min ="00";

            $disable = "";
            $class = "";
            if ($date." ".$hour.":".$min < date("Y-m-d H:i",strtotime(G5_TIME_YMDHIS))){
                $disable = "disabled";
                $class = "disable";
            }

            for ($a=0; $a < count($time_arr); $a++){
                if ($time_arr[$a]["pr_time"] == $hour.":".$min ){

                    $disable = "disabled";
                    $class = "disable";
                    break;
                }
            }


            $html .= '<input class="'.$class.'" type="radio" id="time'.$i.'" name="pr_time" value="'.$hour.':'.$min.'" '.$disable.'>';
            $html .= '<label class="'.$class.'" for="time'.$i.'">'.$hour.':'.$min.'</label>';

       }

      echo $html;
      exit;
}elseif ($mode == "golf_reserve_time"){

    $date =$_REQUEST["date"];

    $sql = "select * from new_golf_reserve where gr_date = '{$date}' and gr_room = '{$_REQUEST["room"]}' and gr_proc = 'comp' ";
    $result = sql_query($sql);

    $html = "";
    $time_arr = [];
    for ($a=0; $row = sql_fetch_array($result); $a++){
        $time_arr[] = $row;
    }


    //타석시간
    if ($_REQUEST["room"] <= 3) {
        for ($i = 0; $i < 9; $i++) {
            $hour = 9 + $i;
            $zero = '';
            if ($hour == 9) {
                $zero = '0';
            }
            $final_hour = $zero . $hour;
            $final_hour_text = $final_hour . ":00 ~ " . ($hour + 1) . ":00";

            if ($final_hour_text == "12:00 ~ 13:00" || $final_hour_text == "17:00 ~ 18:00" ){
                continue;
            }
            $disable = "";
            $class = "";
            if (strtotime($date . " " . $final_hour . ":00") < strtotime(date("Y-m-d H:i", strtotime(G5_TIME_YMDHIS)))) {
                $disable = "disabled";
                $class = "disable";
            }

            for ($a = 0; $a < count($time_arr); $a++) {
                if ($i + 1 == $time_arr[$a]["gr_time"]) {
                    $disable = "disabled";
                    $class = "disable";
                    break;
                }
            }


            $html .= '<input class="' . $class . '" ' . $disable . ' type="radio" id="time0' . ($i + 1) . '" name="gr_time" value="' . ($i + 1) . '">';
            $html .= '<label class="' . $class . '" for="time0' . ($i + 1) . '">' . $final_hour_text . '</label>';

        }
    //스크린룸
    }else{
        $am_disable = "";
        $am_class = "";
        $pm_disable = "";
        $pm_class = "";


        if (strtotime($date . "  13:00") < strtotime(date("Y-m-d H:i", strtotime(G5_TIME_YMDHIS))) ) {
            $am_disable = "disabled";
            $am_class = "disable";
        }
        if (strtotime($date . "  18:00") < strtotime(date("Y-m-d H:i", strtotime(G5_TIME_YMDHIS)))) {
            $pm_disable = "disabled";
            $pm_class = "disable";
        }
//        print_r($time_arr);
        for ($a = 0; $a < count($time_arr); $a++) {
            if (1 == $time_arr[$a]["gr_time"]) {
                $am_disable = "disabled";
                $am_class = "disable";
            }else if (2 == $time_arr[$a]["gr_time"]){
                $pm_disable = "disabled";
                $pm_class = "disable";
            }
        }


        $html .= '<input class="' . $am_class . '" ' . $am_disable . ' type="radio" id="time01" name="gr_time" value="1">';
        $html .= '<label class="' . $am_class . '" for="time01">오전(9~13시)</label>';
        $html .= '<input class="' . $pm_class . '" ' . $pm_disable . ' type="radio" id="time02" name="gr_time" value="2">';
        $html .= '<label class="' . $pm_class . '" for="time02">오후(13~18시)</label>';


    }

    echo $html;
    exit;
}elseif($mode== "golf_reserve_form"){

	$gr_roomd = $_REQUEST["gr_room"];

    if ($_REQUEST["gr_room"] < 4){
        $room_where = "< 4";
    } else if ($_REQUEST["gr_room"] > 3){
        $room_where = "> 3";
    }
    $sql = "select count(*) cnt from new_golf_reserve
            where gr_proc = 'comp' and gr_room {$room_where} and mb_id = '{$member["mb_id"]}' and DATE_FORMAT(gr_date,'%Y-%m') = '".date("Y-m",strtotime($_REQUEST["gr_date"]))."' ";

    $reser_ok_cnt = sql_fetch($sql)["cnt"];

    $text = "예약가능 횟수를 초과했습니다. \\n 예약횟수 문의는 프라이빗센터로 문의주시기 바랍니다.";
    $url = G5_URL;


	// 일제한
	//예약가능 횟수: 타석 - vvip 2회, vip 1회
    //예약가능 횟수: 스크린룸- - vvip  1회, vip 1회
	if($member['mb_level'] < 9) {
		$sql = "SELECT count(*) cnt FROM `new_golf_reserve` WHERE DATE(`wr_datetime`) = CURDATE() and `mb_id` = '{$member['mb_id']}' and `gr_proc` = 'comp' and gr_room {$room_where}";
		$count = sql_fetch($sql)['cnt'];

		//vip(타석)
		if ($member["mb_level"] == 4 && $count >= 1 && $_REQUEST["gr_room"] < 4){
			alert($text, $url);
		//vip(스크린룸)
		}else if ($member["mb_level"] == 4 && $count >= 1 && $_REQUEST["gr_room"] > 3){
			alert($text, $url);
		}

		//vvip(타석)
		if ($member["mb_level"] == 5 && $count >= 2 && $_REQUEST["gr_room"] < 4){
			alert($text, $url);
		//vvip(스크린룸)
		}else if ($member["mb_level"] == 5 && $count >= 1 && $_REQUEST["gr_room"] > 3){
			alert($text, $url);
		}
	}

	// 월제한
	//예약가능 횟수: 타석 - vvip  월 8회ㅡ vip 월 4회 , 조합원 월 1회
    //예약가능 횟수: 스크린룸- - vvip  월 4회ㅡ vip 월 2회 , 조합원 월 1회

	if($member['mb_level'] < 9) {
		//조합원
		if ($member["mb_level"] == 3 && $reser_ok_cnt > 0){
			alert($text, $url);
		}

		//vip(타석)
		if ($member["mb_level"] == 4 && $reser_ok_cnt >= 4 && $_REQUEST["gr_room"] < 4){
			alert($text, $url);
		//vip(스크린룸)
		}else if ($member["mb_level"] == 4 && $reser_ok_cnt >= 2 && $_REQUEST["gr_room"] > 3){
			alert($text, $url);
		}

		//vvip(타석)
		if ($member["mb_level"] == 5 && $reser_ok_cnt >= 8 && $_REQUEST["gr_room"] < 4){
			alert($text, $url);
		//vvip(스크린룸)
		}else if ($member["mb_level"] == 5 && $reser_ok_cnt >= 4 && $_REQUEST["gr_room"] > 3){
			alert($text, $url);
		}

		$allowed_ip = '121.140.204.65';
		$client_ip = $_SERVER['REMOTE_ADDR'];

		if ($client_ip == $allowed_ip) {

		}


		$sql = "select count(*) cnt from new_golf_reserve
			where gr_proc = 'comp' and gr_room {$room_where} and mb_id = '{$member["mb_id"]}' and DATE_FORMAT(gr_date,'%Y-%m-%d') = '".date("Y-m-d",strtotime($_REQUEST["gr_date"]))."' ";

		$reser_ok_cnt = sql_fetch($sql)["cnt"];

		if($reser_ok_cnt >= 2 && $_REQUEST["gr_room"] > 3){
			alert($text, $url);
		}
	}




	$room = $_REQUEST["gr_room"];
	$time = $_REQUEST["gr_time"];
	$date = $_REQUEST["gr_date"];

	$sql = "select * from `new_golf_reserve` where `gr_room` = '$room' and `gr_time` = '$time' and `gr_date` = '$date' and `gr_proc` = 'comp'";
	$row = sql_fetch($sql);

	if($row != null){
		alert("이미 예약된 시간입니다.", $url);
	}


	if($use_point != 0){
		if($member['mb_point'] <= 0 || $member['mb_point'] < 100) {
			alert("보유포인트가 부족합니다.", $url);
		}
		insert_point($member["mb_id"], -100, "골프예약", '@passive', $member["mb_id"], $member['mb_id'].'-'.uniqid(''), $expire);
	}


	

    $sql = "insert into new_golf_reserve set ";

    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, 'gr_') === 0) {
            $sql .= $key . "='" . $value . "',";
        }
    }

    $sql .= "mb_id = '{$member["mb_id"]}', ";
    $sql .= "wr_datetime = '" . G5_TIME_YMDHIS . "'";

    $result = sql_query($sql);

    if ($result == 1) {

        //예약완료 문자발송
        $mb_hp = str_replace("-", "", $member["mb_hp"]);
        $send_phone = '0516111255';
        $time = '';
        $people_cnt = '';
        if ($_REQUEST["gr_room"] > 3) {
            if ($_REQUEST["gr_time"] == 1) {
                $time = "오전(9시~13시)";
            }if ($_REQUEST["gr_time"] == 2) {
                $time = "오후(13시~18시)";
            }
            $people_cnt =  $_REQUEST["gr_cnt"]."인 ";
        }else{
            $time = $reserve_time_arr[$_REQUEST["gr_time"]];
        }
        $msg = "[".$config["cf_title"]."] ".date("Y-m-d",strtotime($_REQUEST["gr_date"]))." ".$time." ".$people_cnt.$gr_room_arr[$_REQUEST["gr_room"]]." 예약되었습니다.";

        goSms($mb_hp, $send_phone, $msg);



        alert("골프 예약이 완료되었습니다.", G5_BBS_URL."/golf_order_form.php");
    }else{
        alert("골프 예약이 실패했습니다. 다시 시도 해주세요.", $_REQUEST["url"]);
    }

}elseif ($mode == "cucenter_payment"){
    $url = G5_BBS_URL."/board.php?bo_table=cucenter&wr_id=".$_REQUEST["wr_id"];

    $sql = "select count(*) cnt from new_enrolment where wr_id = '{$_REQUEST["wr_id"]}' and mb_id = '{$member["mb_id"]}'";
    $cnt = sql_fetch($sql)["cnt"];

    if ($cnt > 0) {
        alert("이미 수강을 신청한 강좌입니다." ,$url );
    }

    //수강인원 리스트를 설정한 경우
    if ($_REQUEST["wr_9"] == 0){
        $sql = "select count(*) cnt from new_cucenter_member where cm_wr_id ='{$_REQUEST["wr_id"]}' and mb_id = '{$member["mb_id"]}'  ";
        $member_cnt = sql_fetch($sql)["cnt"];

        if ($member_cnt == 0){
            alert("기존 수강생 대상 접수하는 강좌입니다." ,$url);
        }


    }

    $sql = "select count(*) cnt from new_enrolment where wr_id ='{$_REQUEST["wr_id"]}' ";
    $result = sql_fetch($sql);

    $e_is_wait= "N";
    if($result["cnt"] >= $_REQUEST["wr_9"] && $_REQUEST["wr_9"] > 0){
        $msg = "수강인원을 초과하였습니다. 대기접수로 등록됩니다.";
        $e_is_wait = "Y";
    }else{
        $msg = "수강신청되었습니다. \\n수강료를 지점 방문 납부 혹은 계좌 이체해주셔야 확정됩니다.";

		$hp = str_replace("-","",$member[mb_hp]);
		$alimTlak = array("name"=>$member[mb_name], "class_name"=>$title, "class_cost"=>$cost."원");
		sendAlimTalk("0",$alimTlak, $hp);
    }


    $sql = "insert into new_enrolment set e_is_wait = '{$e_is_wait}', wr_id = '{$_REQUEST["wr_id"]}', mb_id = '{$member["mb_id"]}', wr_datetime = '" . G5_TIME_YMDHIS . "' ";
    sql_query($sql);




    alert($msg, $url);


}elseif ($mode == "reser_cancel"){
    $sql_common = "";
    $type = $_REQUEST["type"];

    if ($type == "private" || $type == "golf"){
        if ($type == "private"){
            $text = "pr";
        }else{
			if($_REQUEST['gr_room'] <= 3){
				insert_point($member['mb_id'], 100, "골프예약 취소", '@passive', $member['mb_id'], "admin".'-'.uniqid(''), $expire);
			}
			
            $text = "gr";
        }
        $sql_common = "new_".$type."_reserve";
    }else{
        $text = "e";
        $sql_common = "new_enrolment";
    }


    $sql = "update {$sql_common} set {$text}_proc = 'cancel' where {$text}_idx = '{$_REQUEST["idx"]}' ";
    $result = sql_query($sql);

    echo $result;


}elseif ($mode == "service_ana_picture"){

    $bo_table = "service_ana";

    if (!$is_admin){
        alert("관리자만 이용가능합니다.",G5_BBS_URL."/login.php");
    }
    // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);


    for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

//        if ($_FILES['image']['tmp_name'][$i] == ""){
//            break;
//        }

        $upload[$i]['file'] = '';
        $upload[$i]['source'] = '';
        $upload[$i]['filesize'] = 0;
        $upload[$i]['image'] = array();
        $upload[$i]['image'][0] = '';
        $upload[$i]['image'][1] = '';
        $upload[$i]['image'][2] = '';

        $tmp_file = $_FILES['image']['tmp_name'][$i];
        $filesize = $_FILES['image']['size'][$i];
        $filename = $_FILES['image']['name'][$i];
        $filename = get_safe_filename($filename);


        // 서버에 설정된 값보다 큰파일을 업로드 한다면
//        if ($filename) {
//            if ($_FILES['image']['error'][$i] == 1) {
//                $file_upload_msg .= '\"' . $filename . '\" 파일의 용량이 서버에 설정된 값보다 크므로 업로드 할 수 없습니다.\\n';
//
//                continue;
//            } else if ($_FILES['image']['error'][$i] != 0) {
//                $file_upload_msg .= '\"' . $filename . '\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
//
//                continue;
//            }
//        }

        if (is_uploaded_file($tmp_file) && $tmp_file != "") {


            //=================================================================\
            // 090714
            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
            // 에러메세지는 출력하지 않는다.
            //-----------------------------------------------------------------
            $timg = @getimagesize($tmp_file);
            // image type
            if (preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                preg_match("/\.({$config['cf_flash_extension']})$/i", $filename)) {
                if ($timg['2'] < 1 || $timg['2'] > 16)
                    continue;
            }
            //=================================================================

            $upload[$i]['image'] = $timg;

            // 프로그램 원래 파일명
            $upload[$i]['source'] = $filename;
            $upload[$i]['filesize'] = $filesize;

            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
            $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
            $upload[$i]['file'] = $i."_".abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

            $dest_file = G5_DATA_PATH . '/file/'.$bo_table.'/' . $upload[$i]['file'];

//            $filename = compress_image($tmp_file, $dest_file, 70); //실제 파일용량 줄이는 부분
//            list($width, $height, $type, $attr) = getImagesize($tmp_file);


            //이미지 크기조정
//            size_image($_FILES['image'], 500, 500, $dest_file, 'multi', $i);
            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['image']['error'][$i]);

            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);


            $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$idx}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '" . G5_TIME_YMDHIS . "' ";

            sql_query($sql);



        }
    }


    alert("완료되었습니다.",'./content.php?co_id=trv_service_ana');


}elseif ($mode == "service_ana_del"){
    $del_arr = $_REQUEST["btn_chk"];

    for ($i =0; $i < count($del_arr);$i++){

        @unlink(G5_DATA_PATH."/file/service_ana/{$del_arr[$i]}");
        $sql = "delete from g5_board_file where bf_file = '{$del_arr[$i]}' ";
        sql_query($sql);
    }

    alert("완료되었습니다.",'./content.php?co_id=trv_service_ana');

}