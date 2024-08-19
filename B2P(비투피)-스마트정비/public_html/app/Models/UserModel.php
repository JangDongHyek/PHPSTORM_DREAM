<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    public function checkOrder($data){
        $name = trim($data['name']);
        $hp = trim(str_replace("-", "", $data['hp']));
        $orderNo = trim($data['orderNo']);

        if(empty($name)){
            return ['code'=>400, 'msg'=>'주문번호를 확인해주세요.'];
        }

        if(empty($name)){
            return ['code'=>400, 'msg'=>'성함을 확인해주세요.'];
        }

        if(empty($hp)){
            return ['code'=>400, 'msg'=>'연락처를 확인해주세요.'];
        }



        $sql = "SELECT * FROM `order_list` WHERE `OrderNo` = '$orderNo'
            AND (`BuyerName` = '$name' OR `ReceiverName` = '$name')";
        $row = sql_fetch($sql);

        if(empty($row)){
            return ['code'=>400, 'msg'=>'입력한 정보를 다시 확인해주세요.'];
        }

        $dataArray = json_decode($row['ItemOptionSelectList'], true);
        $itemOptionValue = $dataArray[0]['ItemOptionValue'];
        preg_match('/\b\d{2,3}-?\d{3,4}-?\d{4}\b/', $itemOptionValue, $matches);
        if (!empty($matches)) {
            $phoneNumber = trim(str_replace("-", "", $matches[0]));
        }

        if($hp != $phoneNumber){
            return ['code'=>400, 'msg'=>'입력한 정보를 다시 확인해주세요.'];
        }

        if($row['CancelStatus'] != 0 || $row['ReturnStatus'] != 0){
            return ['code'=>400, 'msg'=>'반품/교환 상태에서는 예약 신청이 불가능 합니다.'];
        }

        $userData = [
            'orderNo' => $row['OrderNo'],
            'mbName' => $name,
            'mbHp' => $hp
        ];

        return ['code'=>200, 'msg'=>'로그인되었습니다.', 'userData'=>$userData];
    }

    public function getGsResveDataByOrderNoFromDb($orderNo)
    {
        $sql = "SELECT * FROM `gs_resve` WHERE `orderNo` = '$orderNo' and `resveAt` != 'C'";
        $resve_row = sql_fetch($sql);

        $sql = "SELECT * FROM `gs_store` WHERE `storCd` = '{$resve_row['storCd']}'";
        $store_row = sql_fetch($sql);

        $sql = "SELECT * FROM `order_list` WHERE `orderNo` = '$orderNo'";
        $order_row = sql_fetch($sql);

        return ['code'=>200, 'data'=>["resve"=>$resve_row, "store"=>$store_row, "order"=>$order_row]];
    }

    public function getStoreByRegionFromDb($si, $gu)
    {
        $sql = "SELECT * FROM `gs_store` WHERE `spotAdres` like '%{$si} {$gu}%'";
        $re = sql_query($sql);
        $rows = sql_fetch_array($re);
        return $rows;
    }

    public function getStoreFromApi()
    {
        // API URL 설정
        $url = "ap/stor";

        // 요청 데이터 설정
        $data = array(
            "searchDe" => date('Ymd')
        );

        // 공용 API 호출 함수 사용
        $response = $this->callApi($url, $data);
        $data = json_decode($response, true)['data'];

        if(!empty($data)){
            $sql = "delete from `gs_store` ";
            sql_query($sql);
            foreach ($data as $store) {
                // 데이터 파싱
                $storCd = $store['storCd'];
                $storNm = $store['storNm'];
                $storTyNm = $store['storTyNm'];
                $tel = $store['tel'];
                $zip = $store['zip'];
                $spotAdres = $store['spotAdres'];
                $spotAdresDtl = $store['spotAdresDtl'];
                $btnmgerOprtrNm = $this->decryptData($store['btnmgerOprtrNm']);
                $btnmgerOprtrMpNo = $this->decryptData($store['btnmgerOprtrMpNo']);
                $emailAdres = $this->decryptData($store['emailAdres']);
                $storRestdeNm = $store['storRestdeNm'];
                $storOperBeginHm = $store['storOperBeginHm'];
                $storOperEndHm = $store['storOperEndHm'];
                $bayQy = $store['bayQy'];
                $storInfo = $store['storInfo'];
                $useAt = $store['useAt'];

                // INSERT 또는 UPDATE 쿼리
                $sql = " INSERT INTO gs_store SET
                    storCd = '$storCd',
                    storNm = '$storNm',
                    storTyNm = '$storTyNm',
                    tel = '$tel',
                    zip = '$zip',
                    spotAdres = '$spotAdres',
                    spotAdresDtl = '$spotAdresDtl',
                    btnmgerOprtrNm = '$btnmgerOprtrNm',
                    btnmgerOprtrMpNo = '$btnmgerOprtrMpNo',
                    emailAdres = '$emailAdres',
                    storRestdeNm = '$storRestdeNm',
                    storOperBeginHm = '$storOperBeginHm',
                    storOperEndHm = '$storOperEndHm',
                    bayQy = '$bayQy',
                    storInfo = '$storInfo',
                    useAt = '$useAt'";

                // 쿼리 실행
                sql_query($sql);
            }
        }
    }

    public function getReservationDataFromApi($data)
    {
        // API URL 설정
        $url = "/ap/resve/posbl";

        // 공용 API 호출 함수 사용

        $apiData = [
            'storCd' => $data['storCd'],
            'resveDe' => $data['searchDate']
        ];

        return $this->callApi($url, $apiData);

    }

    public function updateResveConfirmGsToB2p($data)
    {
        if(empty($data['storCd'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'점포코드값이 없습니다.'];
        }

        if(empty($data['resveNo'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'예약번호값이 없습니다.'];
        }

        if(empty($data['resveAt'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'예약여부값이 없습니다.'];
        }

        $sql = "SELECT * FROM `gs_resve` where `resveNo` = '{$data['resveNo']}'";
        $resveRow = sql_fetch($sql);

        if(empty($resveRow)){
            return ['resultCode'=>'4000', 'resultMsg'=>'예약데이터가 없습니다.'];
        }

        $resveData = $this->getGsResveDataByOrderNoFromDb($resveRow['orderNo']);
        if(empty($resveData['data']['order'])){
            return ['resultCode'=>'4000', 'resultMsg'=>'예약데이터가 없습니다.'];
        }

        if($resveData['data']['order']['CancelStatus'] != 0){
            return ['resultCode'=>'4001', 'resultMsg'=>'취소되었거나 취소중인 상품입니다.'];
        }

        if($resveData['data']['order']['ReturnStatus'] != 0){
            return ['resultCode'=>'4002', 'resultMsg'=>'반품되었거나 반품중인 상품입니다.'];
        }

        if($resveData['data']['order']['ExchangeStatus'] != 0){
            return ['resultCode'=>'4003', 'resultMsg'=>'교환되었거나 교환중인 상품입니다.'];
        }

        $sql = "update `gs_resve` set `resveAt` = '{$data['resveAt']}' where `resveNo` = '{$data['resveNo']}'";
        sql_query($sql);

        return ['resultCode'=>'0000', 'resultMsg'=>'정상처리'];
    }

    public function updateMaintenanceReulstGsToB2p($data)
    {
        if(empty($data['storCd'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'점포코드값이 없습니다.'];
        }

        if(empty($data['resveNo'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'예약번호값이 없습니다.'];
        }

        if(empty($data['rprRsltCd'])){
            return ['resultCode'=>'1300', 'resultMsg'=>'정비코드값이 없습니다.'];
        }

        $sql = "SELECT * FROM `gs_resve` where `resveNo` = '{$data['resveNo']}'";
        $resveRow = sql_fetch($sql);

        if(empty($resveRow)){
            return ['resultCode'=>'4000', 'resultMsg'=>'예약데이터가 없습니다.'];
        }

        $resveData = $this->getGsResveDataByOrderNoFromDb($resveRow['orderNo']);
        if(empty($resveData['data']['order'])){
            return ['resultCode'=>'4000', 'resultMsg'=>'예약데이터가 없습니다.'];
        }

        if($resveData['data']['order']['CancelStatus'] != 0){
            return ['resultCode'=>'4001', 'resultMsg'=>'취소되었거나 취소중인 상품입니다.'];
        }

        if($resveData['data']['order']['ReturnStatus'] != 0){
            return ['resultCode'=>'4002', 'resultMsg'=>'반품되었거나 반품중인 상품입니다.'];
        }

        if($resveData['data']['order']['ExchangeStatus'] != 0){
            return ['resultCode'=>'4003', 'resultMsg'=>'교환되었거나 교환중인 상품입니다.'];
        }

        $sql = "update `gs_resve` set `rprRsltCd` = '{$data['rprRsltCd']}' where `resveNo` = '{$data['resveNo']}'";
        sql_query($sql);

        return ['resultCode'=>'0000', 'resultMsg'=>'정상처리'];

    }
    
    public function saveReservation($data)
    {
        $sql = "SELECT * FROM `gs_resve` where `orderNo` = '{$data['orderNo']}' and `resveAt` != 'C'";
        $resve_row = sql_fetch($sql);
        if(!empty($resve_row)){
            if($resve_row['resveAt'] == 'Y'){
                return ['code'=>400,'msg'=>'이미 예약아 확정되었습니다. 취소 후 재예약 부탁드립니다.'];
            }

            $cancelResult = $this->resveCancel($data);
            if($cancelResult['code'] != 200){
                return ['code'=>400,'msg'=>'예약 변경에 실패하였습니다. 취소 후 재예약 부탁드립니다.'];
            }
        }


        // 암호화 함수 호출
        $encryptedCustomerName = $this->encryptData($data['customerName']);
        $encryptedCarNumber = $this->encryptData($data['carNumber']);
        $maintenanceCodeArray = isset($data['maintenanceCode']) ? explode(',', $data['maintenanceCode']) : [];
        // API 요청 데이터 구성
        $requestData = array(
            'storCd' => $data['storeCode'],
            'resveDe' => $data['reserveDate'],
            'resveTime' => $data['reserveTime'],
            'cstmrNm' => $encryptedCustomerName,
            'vhcleNo' => $encryptedCarNumber,
            'rprReqMsg' => $data['requestMessage'],
            'rprCd' => $maintenanceCodeArray
        );

        // API 호출 URL 설정
        $apiUrl = '/ap/resve/conf';

        // API 호출
        $response = $this->callApi($apiUrl, $requestData);

        // API 응답 처리
        $responseArray = json_decode($response, true);
        if ($responseArray['resultCode'] == '0000') {

            $reservationNumber = $responseArray['data']['resveNo'];

            $sql = "INSERT INTO `gs_resve` SET 
                    orderNo = '" . $data['orderNo'] . "', 
                    storCd = '" . $data['storeCode'] . "', 
                    resveDe = '" . $data['reserveDate'] . "', 
                    resveTime = '" . $data['reserveTime'] . "', 
                    cstmrNm = '" . $data['customerName'] . "', 
                    vhcleNo = '" . $data['carNumber'] . "', 
                    rprReqMsg = '" . $data['requestMessage'] . "', 
                    rprCd = '" . $data['maintenanceCode'] . "', 
                    resveNo = '" . $reservationNumber . "'";

            sql_query($sql);

            return ['code'=>200,'msg'=>'예약 접수가 되었습니다.'];
        } else {
            return ['code'=>400,'msg'=>'예약 실패 - ' . $response];
        }
    }

    public function resveCancel($data)
    {
        // 배열이면 2가지 조건 체크
        if (is_array($data)) {
            $updateWhere = " Where `resveNo` = '{$data['resveNo']}'";
            $sql = "select * from `gs_resve` where `resveNo` = '{$data['resveNo']}'";
            $resve_row = sql_fetch($sql);

            if(empty($resve_row)){
                $updateWhere = " Where `orderNo` = '{$data['orderNo']}'";
                $sql = "select * from `gs_resve` where `orderNo` = '{$data['orderNo']}'";
                $resve_row = sql_fetch($sql);
            }
        } else {
            // 배열이 아니면 해당 문자열 자체가 orderNo
            $updateWhere = " Where `orderNo` = '{$data}'";
            $sql = "select * from `gs_resve` where `orderNo` = '{$data}'";
            $resve_row = sql_fetch($sql);
        }



        if(empty($resve_row)){
            return ['code'=>400, 'msg'=>'예약 정보가 없습니다.'];
        }

        if($resve_row['resveAt'] == 'C'){
            return ['code'=>400, 'msg'=>'취소된 예약건입니다.'];
        }

        // API 호출 URL 설정
        $apiUrl = '/ap/resve/cncl';

        $requestData = array(
            'storCd' => $resve_row['storCd'],
            'resveNo' => $resve_row['resveNo']
        );

        // API 호출
        $response = $this->callApi($apiUrl, $requestData);

        // API 응답 처리
        $responseArray = json_decode($response, true);
        if ($responseArray['resultCode'] == '0000') {

            $sql = "Update `gs_resve` SET `resveAt` = 'C' {$updateWhere} ";
            sql_query($sql);

            return ['code'=>200,'msg'=>'예약 취소가 되었습니다.'];
        } else {
            return ['code'=>400,'msg'=>'취소 실패 - ' . $response];
        }
    }

    private function callApi($url, $data) {
        // 요청 헤더 설정
        $headers = array(
            "Content-Type: application/json",
            "authKey: ao8d058mipnhyzs5o2upf6caeeg4obpg"
        );
        // ulr 설정
        $url = "https://t-api.autooasis.com:32443/".$url; // 개발 URL
        // $url = "https://api.autooasis.com:32443/".$url; // 운영 URL

        // 요청 데이터 설정
        $data_json = json_encode($data);

        // cURL 초기화
        $ch = curl_init($url);

        // cURL 옵션 설정
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL 인증서 검증을 끕니다. 필요한 경우 유지하세요.
        curl_setopt($ch, CURLOPT_RESOLVE, array(
            't-api.autooasis.com:32443:192.168.230.83'
        ));

        // API 호출
        $response = curl_exec($ch);

        // cURL 종료
        curl_close($ch);

        // 응답 반환
        return $response;
    }

    /*
     * AES256 암호화 함수
     */ 
    private function encryptData($plainData) {
        $secretKey = '1234567890ABCDEFGHIJKLMNOPQRSTUV';
        $iv = '1234567890ABCDEF';

        $encryptedData = openssl_encrypt($plainData, 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encryptedData);
    }

    /*
     * AES256 복호화 함수
     */
    private function decryptData($encryptedData) {
        $secretKey = '1234567890ABCDEFGHIJKLMNOPQRSTUV';
        $iv = '1234567890ABCDEF';

        $decodedData = base64_decode($encryptedData);
        return openssl_decrypt($decodedData, 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA, $iv);
    }

    public function getReservList($data){
        $where = " WHERE 1=1 ";

        // 회원 ID와 레벨 체크
        if(isset($data['member']['mb_id']) && isset($data['member']['mb_level'])){
            $mb_id = $data['member']['mb_id'];
            $mb_level = (int)$data['member']['mb_level'];

            if($mb_level < 9){
                $where .= " AND order_list.mb_id = '{$mb_id}'";
            }
        }

        // 검색어 처리
        $sf = isset($data['sf']) ? $data['sf'] : '';
        $st = isset($data['st']) ? $data['st'] : '';

        if(!empty($sf) && !empty($st)){
            if($sf == "placeNo"){
                $where .= " AND $sf = '$st'";
            } else {
                $where .= " AND $sf LIKE '%$st%'";
            }
        }

        // 특정 인덱스 처리
        if(!empty($data['idx'])){
            $where .= " AND gs_resve.idx = '{$data['idx']}'";
        }

        // 총 개수 구하기
        $sql = "SELECT COUNT(*) as total_count 
            FROM gs_resve
            JOIN order_list ON gs_resve.orderNo = order_list.OrderNo 
            JOIN gs_store ON gs_resve.storCd = gs_store.storCd
            $where";
        $total_count_result = sql_fetch($sql);
        $total_count = $total_count_result['total_count'];

        $return_data['total_count'] = $total_count;

        // 페이지 번호와 페이지당 아이템 수 설정
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $items_per_page = isset($data['items_per_page']) ? (int) $data['items_per_page'] : 15;
        $return_data['items_per_page'] = $items_per_page;

        // 시작 위치 계산 (0 기반 인덱스)
        $start_limit = ($page - 1) * $items_per_page;

        // 실제 데이터 리스트 가져오기
        $sql = "SELECT 
                gs_resve.*, 
                order_list.idx AS order_idx,
                gs_store.idx AS store_idx,
                order_list.*,
                gs_store.*
            FROM 
                gs_resve
            JOIN 
                order_list ON gs_resve.orderNo = order_list.OrderNo 
            JOIN 
                gs_store ON gs_resve.storCd = gs_store.storCd
            $where
            ORDER BY gs_resve.idx DESC 
            LIMIT $start_limit, $items_per_page";
        $re = sql_query($sql);
        $rows = sql_fetch_array($re);
        $list = [];

        foreach($rows as $row){
            $list[] = $row;
        }

        $return_data['list'] = $list;

        return $return_data;
    }
}