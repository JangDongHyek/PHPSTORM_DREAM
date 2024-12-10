<?php
/*
 * 콜접수내역 : 상태변경
 *
 * $origin_status : 현재상태
 * $status : 변경할 상태
 */
include_once ("../common.php");

$json = array();
$json['result'] = false;
$json['err_msg'] = "";
$json['post'] = $_POST;

if ($_POST['mode'] == "change") {

    $idx = $_POST['idx'];
    $status = $_POST['status']; // 변경할 값
    $origin_status = $_POST['origin_status']; // 변경전
    $call_req_dateTS = ($status == "0")? time() : "0";

    $sql = "UPDATE g5_call SET call_status = '{$status}' ";
    if ($status == "-1") $sql .= ", cancel_reason = '관리자취소', cancel_date = '".G5_TIME_YMDHIS."'";
    else if ($status == "2") $sql .= ", success_date = '".G5_TIME_YMDHIS."'";
    else if (($status == "0" || $status == "R") && $origin_status == "-1") $sql .= ", cancel_reason = '', cancel_date = ''";
    // 상태 '신청'으로 변경시 신청일자TS 추가 else 제거
    $sql .= ", call_req_dateTS = '{$call_req_dateTS}'";
    $sql .= " WHERE idx = '{$idx}'";

    //if ($origin_status == -1) $json['sql'] = $sql;

    if (sql_query($sql)) {
        $json['result'] = true;

        // 콜정보
        // 210701 포인트가 부족하면 마이너스 처리함
        $row = sql_fetch("SELECT * FROM g5_call WHERE idx = '{$idx}'");
        $json['row'] = $row;

        // 해당로직 변경시 /bbs/ajax.call_update.php도 함께 변경
        $po_point = (int)$row['call_total_price'];
        $po_content = ($row['call_type'] == "1")? "대리" : "탁송";
        //$save_adm_id = "admin";
        $call_kind = $row['call_kind']; // 콜종류

        // 요금계산
        $calc_fee = calculateFree($po_point, $call_kind, $row['call_payment']);
        $json['calc_fee'] = $calc_fee;

        $user_id = $row['mb_id'];
        $driver_id = $row['driver_id'];

        // 푸시관련정보
        $push_data = array('idx'=>$idx, 'call_type'=>$row['call_type'], 'consumer_id'=>$user_id, 'driver_id'=>$driver_id);


        if ($origin_status == "-1") { // 취소에서 신청/접수로 변경하는 경우
            // 푸시발송 (신청 or 접수)
            if ($status == "0" || $status == "R") {
                $push_status = ($status == "0")? "customers_request" : "ready_call";
                include_once (G5_PATH."/send_fcm.php");
            }

            // 결제방식이 포인트인경우 : 고객 포인트 재회수
            if ($row['call_payment'] == "P") {
                // 최초 고객 콜요청 정보조회
                $sql2 = "SELECT * FROM g5_point WHERE po_rel_id = '{$idx}' AND po_rel_action = 'user_call'
                         ORDER BY po_id DESC LIMIT 0, 1;
                        ";
                $rs = sql_fetch($sql2);

                $_tmp = $po_content."콜 요청(관리자재접수)";
                point_update($user_id, 0, (int)$rs['po_use_point'], $_tmp, $rs['po_rel_table'], $idx, $rs['po_rel_action']);
            }

        } else {
            switch ($status) {
                case "-1" :		// -1) 고객 대리취소 : 포인트결제 반환
                    //$po_content .= "콜 요청 관리자취소";

                    // 결제방식이 포인트인경우 : 고객 포인트 반환
                    if ($row['call_payment'] == "P") {
                        $_tmp = $po_content."콜 요청(관리자취소)";
                        point_update($user_id, $po_point, 0, $_tmp, 'call', $idx, 'user_call_cancel');
                    }

                    // 현재상태가 신청/접수일때 취소였으면 로직 EXIT;
                    if ($origin_status == "0" || $origin_status == "R") {
                        die(json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
                    }

                    // 콜무(가장빠른콜) 아니면
                    if ($call_kind != "3") {
                        // 기사 콜수락시 차감포인트
                        $driv_ded_point = $calc_fee['driv_ded_point'];

                        // 기사20% 차감 ==>포인트회수
                        $po_content_driv = $po_content."콜 수락(관리자취소)";
                        point_update($driver_id, $driv_ded_point, 0, $po_content_driv, 'call', $idx, 'driv_accept_cancel');
                    }

                    // (관리자페이지만 추가) 진행완료건인데 취소로 변경하는 경우, 적립된 포인트 회수
                    if ($origin_status == "2") {
                        if ($row['call_payment'] == "P") {
                            $_tmp = $po_content."콜 완료(관리자취소)";

                            // 2.1) 포인트결제 - 고객 콜요청시 사용한 포인트 기사에게 적립 ==>포인트회수
                            //$po_add = "";

                            if ($call_kind == "3") { // 220411. 콜무(가장빠른콜)는 포인트에서 원천징수+고용보험 공제
                                $cust_ded_point = $calc_fee['driv_sudang']; // 고객포인트-(원천징수+고용보험)한 실금액
                                /*$po_add .= " (요금 ".$calc_fee['cust_price'];
                                $po_add .= "/ 고용보험 -".$calc_fee['driv_insurance'];
                                $po_add .= "/ 원천징수3.3% -".$calc_fee['driv_tax'];
                                $po_add .= ")";*/
                                $_tmp = $po_content . "콜 완료-가장빠른콜(관리자취소)";

                            } else {
                                $cust_ded_point = $calc_fee['cust_price'];
                            }

                            point_update($driver_id, 0, $cust_ded_point, $_tmp, 'call', $idx, 'call_fin_cancel');
                        }

                        if ($call_kind == "2") {
                            // 적립콜 - 고객에게 적립 ==>포인트회수
                            $po_content_driv = $po_content."콜 완료-적립콜 포인트회수(관리자취소)";
                            point_update($user_id, 0, $calc_fee['cust_save_point'], $po_content_driv, 'call', $idx, 'cust_cancel');

                        } else if ($call_kind == "3") {
                            if ($row['call_payment'] != "P") {
                                // 콜무(가장빠른콜) - 기사에게 차감 ==>포인트재적립
                                $call_mu = $po_content . "콜 완료-가장빠른콜(관리자취소)";
                                $call_mu_use_point = ($calc_fee['driv_insurance'] + $calc_fee['driv_tax']);

                                point_update($driver_id, $call_mu_use_point, 0, $call_mu, 'call', $idx, 'call_mu_cancel');
                            }

                        } else {
                            // 빠른콜,환급콜 - 기사에게 적립 ==>포인트회수
                            $po_content_driv = $po_content."콜 완료-본사지원 포인트(관리자취소)";
                            point_update($driver_id, 0, $calc_fee['driv_save_point'], $po_content_driv, 'call', $idx, 'driv_cancel');
                        }

                    }

                    // 푸시발송-취소(해당기사/고객)
                    $push_status = "cancel_call";
                    include_once (G5_PATH."/send_fcm.php");

                    break;

                case "0" :      // 0) 신청 (취소에서 신청으로 변경시)
                    // 푸시발송-접수(모든기사/사장님)
                    $push_status = "customers_request";
                    include_once (G5_PATH."/send_fcm.php");
                    break;

                case "R" :      // R) 접수
                    // 푸시발송-접수(해당고객)
                    $push_status = "ready_call";
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

                        point_update($driver_id, $cust_ded_point, 0, $po_content.$po_add, 'call', $idx, 'call_fin');
                    }

                    // 2.2) 공통 (현금,포인트)
                    switch ($call_kind) {
                        case "2" :              // 2: 적립콜
                            // 고객에게 적립
                            // (220421) 고객이 포인트로 결제했으면 적립 불가
                            if ($row['call_payment'] != "P") {
                                $po_content_driv = $po_content . "-적립콜 포인트적립";
                                point_update($user_id, $calc_fee['cust_save_point'], 0, $po_content_driv, 'call', $idx, 'cust_save');
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

                                point_update($driver_id, 0, $call_mu_use_point, $call_mu, 'call', $idx, 'minus_call_mu');
                            }
                            break;

                        default :               // 그외: 빠른콜, 환급콜
                            // 기사에게 적립
                            $po_content_driv = $po_content."-본사지원 포인트";
                            point_update($driver_id, $calc_fee['driv_save_point'], 0, $po_content_driv, 'call', $idx, 'driv_save');

                    }

                    // 푸시발송-진행완료(해당고객/기사)
                    $push_status = "end_call";
                    include_once (G5_PATH."/send_fcm.php");

                    break;
            } // end switch
        }

    } // end if

}

echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

?>