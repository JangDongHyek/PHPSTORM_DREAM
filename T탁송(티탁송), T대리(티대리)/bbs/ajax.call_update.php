<?php
/************************************************
$mode
insert : 주소검색후 탁송/대리 요청하기 DB등록
status : 콜내역 상세화면 상태변경
amt_mod : 콜상세 - 금액수정
************************************************/
include_once('./_common.php');

$json = array();
$mode = $_POST['mode'];

if ($mode == "insert") {
	$call_dist = preg_replace("/[^0-9]*/s", "", $call_dist);
	$call_time = preg_replace("/[^0-9]*/s", "", $call_time);

	$call_price = preg_replace("/[^0-9]*/s", "", $call_price);
	$call_pass_price = preg_replace("/[^0-9]*/s", "", $call_pass_price);
	$call_pass_call_price = preg_replace("/[^0-9]*/s", "", $call_pass_call_price);
	$call_5t_price = preg_replace("/[^0-9]*/s", "", $call_5t_price);
	$call_total_price = preg_replace("/[^0-9]*/s", "", $call_total_price);
	$call_price_origin = preg_replace("/[^0-9]*/s", "", $call_price_origin);

	$call_status = 0; // 신청
    $call_req_dateTS = time(); //콜상태 '신청'시 등록시간TS

	$is_public = 'Y'; // 노출여부 (카드결제 때문에 임시저장 체크변수)
	if ($call_payment == "CD") $is_public = 'N';	// 결제-카드 : 임시저장 (210701 카드결제 빠짐)

    // 콜요청일자(오늘,내일), 시간
    $call_req_today = ($_POST['call_req_today'] == "1")? 1 : 0; // 내일:오늘
    $call_req_time = preg_replace("/\s+/","", $_POST['call_req_time']);
    $call_req_time_now = preg_replace("/\s+/","", $_POST['call_req_time_now']);
    if ($call_req_today == 0 && $call_req_time == $call_req_time_now) $call_req_time = ""; // 즉시 (오늘이면서 시간변경 안하면 값을비워 즉시 처리)

    $call_memo = mb_substr(trim($_POST['call_memo']), 0, 200, 'utf-8');
    $call_memo2 = mb_substr(trim($_POST['call_memo2']), 0, 200, 'utf-8');

	$sql = "INSERT INTO g5_call SET
			agency_no = '{$member['agency_no']}',
			mb_id = '{$member['mb_id']}',
			mb_hp = '{$member['mb_hp']}',
			is_public = '{$is_public}',
			start_place = '{$_POST['start_place']}',
			start_lat = '{$_POST['start_lat']}',
			start_lng = '{$_POST['start_lng']}',
			end_place = '{$_POST['end_place']}',
			end_lat = '{$_POST['end_lat']}',
			end_lng = '{$_POST['end_lng']}',
			pass_place = '{$_POST['pass_place']}',
			pass_lat = '{$_POST['pass_lat']}',
			pass_lng = '{$_POST['pass_lng']}',
			call_dist = '{$call_dist}',
			call_time = '{$call_time}',
			call_price = '{$call_price}',
			call_price_origin = '{$call_price_origin}',
			call_pass_price = '{$call_pass_price}',
			call_pass_call_price = '{$call_pass_call_price}',
			call_5t_price = '{$call_5t_price}',
			call_total_price = '{$call_total_price}',
			call_kind = '{$call_kind}',
			call_status = '{$call_status}',
			call_payment = '{$call_payment}',
			call_type = '{$call_type}',
			driver_id = '',
			cancel_reason = '',
			call_memo = '{$call_memo}',
			call_memo2 = '{$call_memo2}',
            call_req_time = '{$call_req_time}',
            call_req_today = '{$call_req_today}',
            call_req_dateTS = '{$call_req_dateTS}'
			";

	$json['result'] = "F";

	if (sql_query($sql)) {
		// 북마크&히스토리 등록
		$history = array(
			"start"=>array("place"=>$start_place, "lat"=>$start_lat, "lng"=>$start_lng),
			"pass"=>array("place"=>$pass_place, "lat"=>$pass_lat, "lng"=>$pass_lng),
			"end"=>array("place"=>$end_place, "lat"=>$end_lat, "lng"=>$end_lng)
		);

		setBookmark($member['mb_id'], $history);

        // 등록된콜 idx 조회
        $sql = "SELECT idx FROM g5_call WHERE mb_id = '{$member['mb_id']}' AND agency_no = '{$member['agency_no']}' AND is_public = '{$is_public}'
                ORDER BY idx DESC LIMIT 0, 1";
        $rs = sql_fetch($sql);
        $idx = $rs['idx'];

		// 결제-포인트 : 포인트차감
		if ($call_payment == "P") {
			$po_content = ($call_type == "1")? "대리" : "탁송";
			$po_content .= "콜 요청";
			
			// 고객 포인트차감
			point_update($member['mb_id'], 0, $call_total_price, $po_content, 'call', $idx, 'user_call');
		}
		$json['result'] = "T";
        $json['idx'] = $idx;

        if ($member['mb_id'] != "0031-00023") { // 테스트고객 아니면
            // 사장님에게 SMS발송 (문자박스)
            $sms_msg = "[T탁송] {$member['mb_name']}님이 ";
            $sms_msg .= ($call_type == "1") ? "대리" : "탁송";
            $sms_msg .= " 요청 하셨습니다.";
            goSms(SMS_RECEIVE_NUM, SMS_SEND_NUM, $sms_msg);

            // 푸시발송-신청(기사전체)
            $push_status = "customers_request";
            $push_data = array('idx'=>$idx, 'call_type'=>$call_type);
            include_once (G5_PATH."/send_fcm.php");
        }

	}

} else if ($mode == "status") {
	
	$json['result'] = "F";
	$idx = $_POST['idx'];
    $call_req_dateTS = ($status == "0")? time() : "0";
	
	$sql = "UPDATE g5_call SET 
			call_status = '{$status}', ";
    // 상태 '신청'으로 변경시 신청일자TS 추가 else 제거
    $sql .= "call_req_dateTS = '{$call_req_dateTS}', ";

	// 콜정보
    // 210701 포인트가 부족하면 마이너스 처리함
	$row = sql_fetch("SELECT * FROM g5_call WHERE idx = '{$idx}'");

	switch ($status) {
		case "-1" :		// -1) 고객 대리취소
            // 23.04.07 콜상태가 '진행'으로 변경되면 신청일자 다음날 0시부터 취소 불가능
            // if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") {
            if ($row['call_status'] == "R") {
                $call_regdate = $row['call_regdate']; // 2023-03-20 15:51:48
                $next_date = date("Y-m-d 00:00:00", strtotime("+1 days", strtotime($call_regdate)));
                $next_ts = strtotime($next_date);
                $cancel_yn = ($next_ts > time()) ? "Y" : "N"; // 취소가능 : 불가능

                if ($cancel_yn == "N") {
                    $json['result'] = "CALL_CANCEL_DISABLED";
                    die(json_encode($json));
                }
            }
            // }

			$sql .= "cancel_reason = '{$cancel_reason}',
					 cancel_date = now()
					 WHERE idx = '{$idx}'";
			break;

		case "1" :		// 1) 기사 수락함
			// 수락전 대기콜이 맞는지 상태확인 (수락되었으면 해당콜 패스)
			if ($row['call_status'] == "0" || $row['call_status'] == "R") {
            } else {
				$json['result'] = "CALL_PASS";
				die(json_encode($json));
			}

            // 콜무(가장빠른콜) 아니면서
            if ($row['call_kind'] != "3") {
                // 현금콜 & 차감할 20% 포인트가 있는지 확인
                if ($row['call_payment'] == "C" && ((int)$row['call_total_price'] * 0.2) > (int)$member['mb_point']) {
                    $json['result'] = "LACK_POINT";
                    echo json_encode($json);
                    exit;
                }
            }

			$sql .= "driver_id = '{$member['mb_id']}'
					 WHERE idx = '{$idx}'";
			break;

		case "2" :		// 2) 기사 진행완료
            // 콜무(가장빠른콜) 아니면서
            if ($row['call_kind'] != "3") {
                // 현금콜 & 차감할 20% 포인트가 있는지 확인
                if ($row['call_payment'] == "C" && ((int)$row['call_total_price'] * 0.2) > (int)$member['mb_point']) {
                    $json['result'] = "LACK_POINT2";
                    echo json_encode($json);
                    exit;
                }
            }

            // 완료전 취소된 콜인지 확인
            if ($row['call_status'] == "-1") {
                $json['result'] = "CALL_CANCEL";
                die(json_encode($json));
            }

			$sql .= "success_date = now()
					 WHERE idx = '{$idx}'";
			break;
	}

	//$json['sql'] = $sql;

	if (sql_query($sql)) {
		$json['result'] = "T";

        // 해당로직 변경시 /adm/ajax.call_list_update.php도 함께 변경
		$po_point = (int)$row['call_total_price'];
		$po_content = ($row['call_type'] == "1")? "대리" : "탁송";
		//$save_adm_id = "admin";
        $call_kind = $row['call_kind']; // 콜종류

        // 요금계산
        $calc_fee = calculateFree($po_point, $call_kind, $row['call_payment']);

        // 푸시관련정보
        $push_data = array('idx'=>$idx, 'call_type'=>$row['call_type'], 'consumer_id'=>$row['mb_id'], 'driver_id'=>$row['driver_id']);

		switch ($status) {
			case "-1" :		// -1) 고객 대리취소 : 포인트결제 반환
				$po_content .= "콜요청 취소";

				// 결제방식이 포인트인경우 : 고객 포인트 반환
				if ($row['call_payment'] == "P") {
					point_update($member['mb_id'], $po_point, 0, $po_content, 'call', $idx, 'user_call_cancel');
				}

                // 푸시발송-취소(해당고객)
                $push_status = "cancel_call";
                include_once (G5_PATH."/send_fcm.php");

				break;

			case "1" :		// 1) 기사 수락함
                $po_content .= "콜 수락";

                // 콜무(가장빠른콜) 아니면
                if ($row['call_kind'] != "3") {
                    // 기사 콜수락시 차감포인트
                    $driv_ded_point = $calc_fee['driv_ded_point'];

                    // 기사20% 차감
                    $po_content_driv = $po_content;
                    point_update($member['mb_id'], 0, $driv_ded_point, $po_content_driv, 'call', $idx, 'driv_accept');
                    // 본사20% 적립
                    //$po_content_adm = "[본사적립] ".$po_content;
                    //point_update($save_adm_id, $driv_ded_point, 0, $po_content_adm, 'call', $idx, 'adm_save');
                }

                // 푸시발송-접수(해당고객)
                $push_status = "driver_apply_call";
                include_once (G5_PATH."/send_fcm.php");

				break;

			case "2" :		// 2) 기사 진행완료 : 포인트적립
				$po_content .= "콜 완료";

                if ($row['call_payment'] == "P") {
                    // 2.1) 포인트결제 - 고객 콜요청시 사용한 포인트 기사에게 적립
                    $po_add = "";

                    if ($call_kind == "3") { // 220411. 콜무(가장빠른콜)는 포인트에서 원천징수+고용보험 공제
                        $cust_ded_point = $calc_fee['driv_sudang']; // 고객포인트-(원천징수+고용보험)한 실금액
                        $po_add .= " (요금 ".$calc_fee['cust_price'];
                        $po_add .= "/ 고용보험 -".$calc_fee['driv_insurance'];
                        $po_add .= "/ 원천징수3.3% -".$calc_fee['driv_tax'];
                        $po_add .= ")";

                    } else {
                        $cust_ded_point = $calc_fee['cust_price'];
                    }

                    point_update($member['mb_id'], $cust_ded_point, 0, $po_content.$po_add, 'call', $idx, 'call_fin');
                }

                // 2.2) 공통 (현금,포인트)
                // 본사 차감
                //$po_content_adm = "[본사차감] ".$po_content;
                //point_update($save_adm_id, 0, $calc_fee['driv_save_point'], $po_content_adm, 'call', $idx, 'adm_support');
                switch ($call_kind) {
                    case "2" :              // 2: 적립콜
                        // 고객에게 적립
                        // (220421) 고객이 포인트로 결제했으면 적립 불가
                        if ($row['call_payment'] != "P") {
                            $po_content_driv = $po_content . "-적립콜 포인트적립";
                            point_update($row['mb_id'], $calc_fee['cust_save_point'], 0, $po_content_driv, 'call', $idx, 'cust_save');
                        }
                        break;

                    case "3" :              // 3: 콜무(가장빠른콜)
                        // 포인트결제 아니면 - 220411. 기사에게 원천징수+고용보험 차감
                        if ($row['call_payment'] != "P") {
                            $call_mu = $po_content;
                            $call_mu .= " (요금 " . $calc_fee['cust_price'];
                            $call_mu .= "/ 고용보험 -" . $calc_fee['driv_insurance'];
                            $call_mu .= "/ 원천징수3.3% -" . $calc_fee['driv_tax'];
                            $call_mu .= ")";

                            $call_mu_use_point = ($calc_fee['driv_insurance'] + $calc_fee['driv_tax']);

                            point_update($member['mb_id'], 0, $call_mu_use_point, $call_mu, 'call', $idx, 'minus_call_mu');
                        }
                        break;

                    default :               // 그외: 빠른콜, 환급콜
                        // 빠른콜,환급콜 - 기사에게 적립
                        $po_content_driv = $po_content."-본사지원 포인트";
                        point_update($member['mb_id'], $calc_fee['driv_save_point'], 0, $po_content_driv, 'call', $idx, 'driv_save');
                }

                // 푸시발송-진행완료(해당고객/기사)
                $push_status = "end_call";
                include_once (G5_PATH."/send_fcm.php");

				break;
		} // end switch
	}

} else if ($mode == 'amt_mod') {
	// 콜상세 - 총금액수정
    // call_total_price : 총금액
    // call_price : 기본요금
	$sql = "UPDATE g5_call SET 
            call_total_price = '{$total}', 
            call_price = '{$price}'
			WHERE mb_id = '{$member['mb_id']}' AND idx = '{$idx}'";

	$json['result'] = (sql_query($sql))? "T" : "F";

    if ($json['result'] == "T") {
        $calc_str = $_POST['calc'];
        $calc_point = preg_replace("/[^0-9]*/s", "", $calc_str);
        // 차액 차감/반환 확인 (true:차감, false:반환)
        $is_po_minus = (strpos($calc_str, "-") !== false)? false : true;

        // 포인트결제시 차액분 추가로 차감/반환하기
        if ($_POST['pay_type'] == "P") {
            $po_content = ($_POST['call_type'] == "1")? "대리" : "탁송";
            $po_content .= "콜 요청-금액수정";

            if ($is_po_minus) {
                // 차액만큼 고객 포인트차감
                point_update($member['mb_id'], 0, $calc_point, $po_content, 'call', $idx, 'user_call_modify');

            } else {
                // 차액만큼 고객 포인트반환
                point_update($member['mb_id'], $calc_point, 0, $po_content, 'call', $idx, 'user_call_modify');
            }
        }
    }

}

echo json_encode($json);



?>