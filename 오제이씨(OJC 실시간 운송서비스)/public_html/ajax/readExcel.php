<?php

/* 엑셀 업로드 공통 */

ini_set('memory_limit','-1');
set_time_limit(300);

include_once('../common.php');
include_once(G5_LIB_PATH.'/PHPExcel/Classes/PHPExcel/IOFactory.php');

$result = array('result' => false, 'msg' => '');
$fileName = iconv("UTF-8", "EUC-KR", $_FILES['file']['tmp_name']);
$falseCnt = 0;

try {
    $objPHPExcel = PHPExcel_IOFactory::load($fileName);
    $worksheet = $objPHPExcel->getActiveSheet();
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();

    $result['worksheet'] = $worksheet;
    $result['highestRow'] = $highestRow;
    $result['highestColumn'] = $highestColumn;
    
    $rows = [];
    $highestDataColumn = 0; // keep track of highest column with data
    for ($row = 1; $row <= $highestRow; ++$row) {
        for ($col = 0; $col <= PHPExcel_Cell::columnIndexFromString($highestColumn); ++$col) {
            $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            if ($cellValue !== null) {
                $rowData[$col] = $cellValue;
                if ($col > $highestDataColumn) { // if this column is higher than the current highest column with data, set new highest column with data
                    $highestDataColumn = $col;
                }
            }
        }
        if (isset($rowData)) { // if there's row data
            $rows[] = $rowData;
            unset($rowData); // reset for next row
        }
    }

    $result['list'] = $rows;
    
    foreach($rows as $key=>$val){
        if($key == 0) continue;
        else if(empty($val[0])) break;
        
        $cmmTable = "";
        $cmmSql = "";
        
        switch($_POST['mode']){
            case 'driver': /* 기사일괄등록 */
                                                
                $isMember = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id = '{$val[0]}';")['cnt'];
                if($isMember > 0){
                    $result["msg"] .= "중복되는 아이디입니다 : {$val[0]}\n";
                    $falseCnt++;
                    continue;
                }
                
                /* 아이디, 비밀번호, 이름, 차량번호, 연락처, member key */
                $cmmTable = "g5_member";
                
                $cmmSql = " mb_id = '".($val[0])."',";
                $cmmSql .= " mb_password = '".($val[1])."',";
                $cmmSql .= " mb_name = '".($val[2])."',";
                $cmmSql .= " driver_car_number = '".($val[3])."',";
                $cmmSql .= " mb_hp = '".(unHyphen($val[4]))."',";
                $cmmSql .= " driver_member_key = '".($val[5])."',";
                
                /* 엑셀 시트에없는 데이터 추가 */                
                $cmmSql .= " mb_type = '".(DELIVERY)."' ";
            break;
                
            case 'company': /* 업체일괄등록 */
                $isMember = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id = '{$val[0]}';")['cnt'];
                if($isMember > 0){
                    $result["msg"] .= "중복되는 아이디입니다 : {$val[0]}\n";
                    $falseCnt++;
                    continue;
                } 
                
                $address = $val[6]; // 위도와 경도를 얻고자 하는 주소
                $apiUrl = "https://dapi.kakao.com/v2/local/search/address.json?query=" . urlencode($address);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: KakaoAK '.KakaoRestApiKey));
                $response = curl_exec($ch);
                curl_close($ch);

                $responseArr = json_decode($response, true);
                
                $lat = $lng = "";                
                if($responseArr['meta']['total_count'] > 0) {
                    $lat = $responseArr['documents'][0]['y']; // 위도
                    $lng = $responseArr['documents'][0]['x']; // 경도                    
                }
                
                if(empty($lat) || empty($lng)){
                    $result["msg"] .= "주소 위,경도 변환실패 : {$address}\n";
                    $falseCnt++;
                    continue;
                }
                
                /* 아이디, 비밀번호, 이름, 차량번호, 연락처, member key */
                $cmmTable = "g5_member";
                
                $cmmSql = " mb_id = '".($val[0])."',";
                $cmmSql .= " mb_password = '".($val[1])."',";
                $cmmSql .= " mb_company_name = '".($val[2])."',";
                $cmmSql .= " mb_company_tel = '".(unHyphen($val[3]))."',";
                $cmmSql .= " mb_company_number = '".(unHyphen($val[4]))."',";
                $cmmSql .= " mb_company_email = '".($val[5])."',";
                $cmmSql .= " mb_addr = '".($val[6])."',";
                $cmmSql .= " mb_addr_detail = '".($val[7])."',";
                $cmmSql .= " mb_lat = '".($lat)."',";
                $cmmSql .= " mb_lng = '".($lng)."',";
                $cmmSql .= " mb_name = '".($val[8])."',";
                $cmmSql .= " mb_hp = '".(unHyphen($val[9]))."',";
                
                /* 엑셀 시트에없는 데이터 추가 */
                $cmmSql .= " mb_type = '".(CUSTOMER)."' ";
            break;
        }
        
        if(!empty($cmmSql)){
            $sql = "
                INSERT INTO
                    $cmmTable
                SET
                    $cmmSql
            ";
            
            $result['result'] = sql_query($sql);

            if(empty($result['result'])){
                $result['msg'] .= "업로드에 실패하였습니다.";
                die(json_encode($result));
            }   
        }
    }    
} catch (\Exception $e) {
    $result['msg'] .= $e->getMessage();
    die(json_encode($result));
}

$result['result'] = true;

if($falseCnt > 0){
    $result['msg'] .= "\n중복되는 아이디 {$falseCnt}건 외에\n ";
}

$result['msg'] .= "모두 등록되었습니다.";

die(json_encode($result));
?>