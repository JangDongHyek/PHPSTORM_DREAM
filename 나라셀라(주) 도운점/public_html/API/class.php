<?php



error_reporting(E_ALL);
ini_set('display_errors', '1');



include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
        
    case 'setClassThumbnail':
        if(empty($_FILES['files'])){
            $result['msg'] = '파일을 찾지 못했습니다.';
            die(json_encode($reuslt));
        }
        
        $folderDir = "/data/thumbnail";
        $files = cmmFileUpload($_FILES['files'], $folderDir);
        
        if(!count($files)){
            $result['msg'] = '파일 업로드 도중 문제가 발생하였습니다.';
            die(json_encode($reuslt));
        }
                
        $result['files'] = $files;        
        $result['result'] = true;
    break;
        
    case 'setClass':
        $class_idx = $_POST['class_idx'];
        $floor = $_POST['floor'];
        $className = $_POST['className'];
        $thumbnailImgArr = json_encode($_POST['thumbnailImgArr'], JSON_UNESCAPED_UNICODE);        
        $eventDate = $_POST['eventDate'];
        $eventTime1 = $_POST['eventTime1'];
        $eventTime2 = $_POST['eventTime2'];
        $maxPerson = $_POST['maxPerson'];
        $price = $_POST['price'];
        $content = $_POST['content'];
        $classContent = $_POST['classContent'];
        
        $eventDateTime = $eventDate.' '.$eventTime1;
        $settingType = empty($class_idx)? 'insert' : 'update';
        
        if(!$is_member){            
            $result['msg'] = '로그인 후 이용가능한 서비스입니다.';
            die(json_encode($result));    
        }
        
        $sql = "";
        $setSql = "
            floor = '{$floor}',
            className = '{$className}',
            thumbnailImgJson = '{$thumbnailImgArr}',
            eventDateTime = '{$eventDateTime}',
            eventDate = '{$eventDate}',
            eventTime1 = '{$eventTime1}',
            eventTime2 = '{$eventTime2}',
            maxPerson = '{$maxPerson}',
            price = '{$price}',
            content = '{$content}',
            classContent = '{$classContent}'
        ";
        
        if($settingType == 'insert'){
            $sql = "
                INSERT INTO 
                    class_list
                SET
                    $setSql
            ";
        }else{
            $sql = "
                UPDATE
                    class_list
                SET
                    $setSql
                WHERE
                    class_idx = '$class_idx'
            ";
        }
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = 'CLASS세팅 에러';
            die(json_encode($result));            
        }
        
    break;            
        
    case 'onClassHeart':
        $class_idx = $_POST['class_idx'];
        $isUse = $_POST['isUse'];
        
        if(!$is_member){
            $result['msg'] = '로그인 후 이용가능한 서비스입니다.';
            die(json_encode($result));    
        }
        
        $sql = "
                UPDATE
                    heart_list
                SET
                    isUse = 'N'
                WHERE
                    class_idx = '{$class_idx}' AND
                    mb_id = '{$member['mb_id']}';
            ";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = 'HEART 초기화 에러';
            die(json_encode($result));
        }
        
        
        if($isUse == 'Y'){
            $sql = "
                INSERT INTO 
                    heart_list
                SET
                    class_idx = '{$class_idx}',
                    mb_id = '{$member['mb_id']}'
            ";

            $result['result'] = sql_query($sql);

            if(empty($result['result'])){
                $result['msg'] = 'HEART세팅 에러';
                die(json_encode($result));        
            }        
        }
    break;
        
    case 'checkSubmitClass':
        $class_idx = $_POST['class_idx'];
        
        if(!$is_member){
            $result['msg'] = '로그인 후 이용가능한 서비스입니다.';
            die(json_encode($result));    
        }
        
        $result = checkClassEff($class_idx, $member['mb_id']);
    break;
        
    case 'classPay':
        $class_idx = $_POST['class_idx'];            
        $users = $_POST['users'];
        $payType = $_POST['payType'];
        
        if(!$is_member){
            $result['msg'] = '로그인 후 이용가능한 서비스입니다.';
            die(json_encode($result));    
        }
        
        $result = checkClassEff($class_idx, $member['mb_id'], count($users));
        
        if(empty($result['result'])){
            die(json_encode($result));
        }
        
        $users = json_encode($users, JSON_UNESCAPED_UNICODE);
        
        $sql = "
            INSERT INTO
                tmp_users_data
            SET            
                class_idx = '{$class_idx}',
                mb_id = '{$member['mb_id']}',
                users = '{$users}'
        ";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '유저등록 실패<br>고객센터에 문의해주세요.';
            die(json_encode($result));
        }
        
        $tmp_users_idx = sql_insert_id();
        $result['tmp_users_idx'] = $tmp_users_idx;
        
    break;
        
    case 'getAppList':
 
        $class_idx = $_POST['class_idx'];
        $list = array();
        $memberList = array();
        
        $sql = " 
            SELECT
                *
            FROM
                class_app_list
            WHERE
                class_idx = '{$class_idx}' AND
                isUse = 'Y'
            ORDER BY
                class_app_idx ASC
        ";
        
        $res = sql_query($sql);                
        
        for($i=0; $row=sql_fetch_array($res); $i++) {
            
            $key = array_search($row['mb_id'], $memberList);
                        
            if($key === false){
                $memberList[] = $row['mb_id'];
                $list[][] = $row;
                continue;
            }
            
            $list[$key][] = $row;            
        }
        
        $result['result'] = (count($list) > 0);
        $result['list'] = $list;
        
        if(empty($result['result'])){
            $result['msg'] = "신청내역이 존재하지 않습니다.";
        }
    break;
        
    case 'changeStatus':
        $mb_id = $_POST['mb_id'];
        $class_idx = $_POST['class_idx'];
        $class_app_idx = $_POST['class_app_idx'];        
        $status = $_POST['status'];

        $cancelMsg = $_POST['cancelMsg']; /* 가상계좌 취소시 */
        $refundBankCd = $_POST['refundBankCd']; /* 가상계좌 취소시 */
        $refundAcctNo = $_POST['refundAcctNo']; /* 가상계좌 취소시 */
        $refundAcctNm = $_POST['refundAcctNm']; /* 가상계좌 취소시 */

        if($status == 'CANCEL') {
            $classInfo = getClassInfo($class_idx);
            $today = date("Y-m-d");
            $event_date = date("Y-m-d", strtotime($classInfo['eventDate']));
            // 날짜 차이 계산
            $diff = (strtotime($event_date) - strtotime($today)) / (60 * 60 * 24); // 날짜 차이 일 단위로 계산

            if (abs($diff) <= 7) {
                echo "해당 날짜는 7일 이내입니다.";

                $result['result'] = false;

                $result['msg'] = '잘못된 접근. 7일이내 환불은 불가능합니다.';
                die(json_encode($result));
            }
        }

        if($status == 'CANCEL' || $status == 'REFUND_END'){
            $classAppInfo = getClassAppInfo($class_app_idx);
            $payInfo = getPayInfo($class_app_idx);
            
            $svcCd = '';
            switch($payInfo['payMethod']){
                case 'VBANK':  /* 가상계좌 */
                    $svcCd = '03';
                break;
				case 'EPAY': /* 간편결제 */
					//$svcCd = '12';
					$svcCd = '16'; //로직 오류 변경_24.02.22 간편결제 코드는 16임
				break;
                default: /* 신용카드 */
                    $svcCd = '01';
                break;
            }

            //MID 판단 [2층 or 6층]
            $chkMIDRow = sql_fetch("select * from class_list where class_idx = '{$class_idx}' ; ");
            $floor = $chkMIDRow['floor'];
            $refundMID = $floor == '2' ? MID_2FLOOR : MID;
            //$refundMID = substr($payInfo['TID'], 0, 10);
            
            $data = array(
                'mid' => $refundMID,
                'tid' => $payInfo['TID'],
                'svcCd' => $svcCd,
                'partialCancelCode' => 0, /* 선택: 0:default, 0:전체취소, 1:부분취소 (부분취소 사용 가능 가맹점만 사용 가능)  */
                'cancelAmt' => $payInfo['Amt'], /* 필수: 취소금액 (숫자)  */
                'cancelMsg' => $cancelMsg, /* 필수: 취소사유  */
                'cancelPwd' => CANCEL_PWD /* 필수: 취소비밀번호  */
            );
                                    
            /* 카드결제, 간편결제 예약 취소 */
            //if($svcCd == '01' || $svcCd == '12'){
            if($svcCd == '01' || $svcCd == '16'){ //로직 오류 변경_24.02.22 간편결제 코드는 16임

                $cancelRes = innopayCurl('/api/cancelApi', $data);

                if($cancelRes['resultCode'] != '2001'){
                    $result['msg'] = $cancelRes['resultMsg'];
                    die(json_encode($result));
                }

                //알림톡 기능추가_231023_결제취소
                //수정_관리자가 아닌 실제 유저에게 알림톡이 날라가야함
                $mb = get_member($mb_id);
                $params = array("mb_name" => $mb['mb_name'], "tab" => "class");
                $sendAlimTalk = sendAlimTalk(2, $params, $mb['mb_hp']);
            }

            /* 관리자이고 가상계좌 환불 */
            else if($member['mb_id'] == 'admin' && $svcCd == '03'){
                $data['refundBankCd'] = $refundBankCd; /* 환불시필수: 은행  */
                $data['refundAcctNo'] = $refundAcctNo; /* 환불시필수: 계좌번호  */
                $data['refundAcctNm'] = $refundAcctNm; /* 환불시필수: 계좌주  */

                $cancelRes = innopayCurl('/api/cancelApi', $data);

                if($cancelRes['resultCode'] != '2211'){
                    $result['msg'] = $cancelRes['resultMsg'];
                    die(json_encode($result));
                }
                
                $sql = "
                    UPDATE
                        pay_list
                    SET
                        refundAdmRequestYN = 'Y',
                        pgApprovalAmt = '{$cancelRes['pgApprovalAmt']}',
                        pgAppDate = '{$cancelRes['pgAppDate']}',
                        pgAppTime = '{$cancelRes['pgAppTime']}',
                        stateCd = '{$cancelRes['stateCd']}'
                    WHERE
                        pay_idx = '{$payInfo['pay_idx']}';";

                $result['result'] = sql_query($sql);

                if(empty($result['result'])){
                    $result['msg'] = '결제상태 업데이트 에러(admin/03)';
                    die(json_encode($result));
                }
            }
            
            /* 이용자 가상계좌 환불요청시 */            
            else if($member['mb_id'] != 'admin' && $svcCd == '03' && $classAppInfo['status'] != 'DEPOSIT_WAIT'){
                
                $status = 'REFUND';
                
                $sql = "
                    UPDATE
                        pay_list
                    SET                        
                        refundRequestYN = 'Y',
                        refundBankCd = '{$refundBankCd}',
                        refundAcctNo = '{$refundAcctNo}',
                        refundAcctNm = '{$refundAcctNm}'
                    WHERE
                        pay_idx = '{$payInfo['pay_idx']}';";

                $result['result'] = sql_query($sql);

                if(empty($result['result'])){
                    $result['msg'] = '결제상태 업데이트 에러(REFUND/03)';
                    die(json_encode($result));
                }
            }            
            
            $sql = "
                UPDATE
                    class_member_list
                SET                        
                    isUse = 'N'
                WHERE
                    class_app_idx = '{$class_app_idx}';";

            $result['result'] = sql_query($sql);

            if(empty($result['result'])){
                $result['msg'] = '상태 업데이트 에러';
                die(json_encode($result));
            }
        }
        
        $sql = "
                UPDATE
                    class_app_list
                SET
                    status = '{$status}'
                WHERE
                    class_app_idx = '{$class_app_idx}';";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '상태변경 에러';
            die(json_encode($result));
        }
    break;
}

die(json_encode($result));

?>