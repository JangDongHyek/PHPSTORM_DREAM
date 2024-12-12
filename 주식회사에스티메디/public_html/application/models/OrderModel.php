<?php

/**
 * 주문관리
 * @property OrderItemModel $OrderItemModel
 * @property ProductCartModel $ProductCartModel
 * @property MisuModel $MisuModel
 */
class OrderModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // 주문번호로 주문(공통) 조회
    public function getOrderInfoByOrdNo($orderNo, $column = "*"): array
    {
        $sql = "SELECT {$column} FROM bs_order WHERE del_yn = 'N' AND ord_no = ?";
        $query = $this->db->query($sql, array($orderNo));

        return $query->row_array() ?? array();
    }

    // 인덱스로 주문(공통) 조회
    public function getOrderInfoByIdx($idx, $column = "*"): array
    {
        $sql = "SELECT {$column} FROM bs_order WHERE del_yn = 'N' AND idx = ?";
        $query = $this->db->query($sql, array($idx));

        return $query->row_array() ?? array();
    }

    // 우편번호로 추가배송비 조회
    public function getOrderSendCost2($code): int
    {
        $sql = "SELECT sc_price FROM g5_shop_sendcost WHERE sc_zip1 <= '$code' AND sc_zip2 >= '$code'";
        $query = $this->db->query($sql);

        $result = $query->row(0)->sc_price;

        if($result){
            return $result;
        }else{
            return 0;
        }
    }

    // 주문서 등록
    public function registerOrder($orderData = array(), $orderDetailData = array(), $cartIdxData = array()): bool
    {
        // 트랜잭션 시작
        $this->db->trans_begin();

        try {
            $this->load->model('OrderItemModel');
            $this->load->model('ProductCartModel');
            $this->load->model('MisuModel');

            // 1. 주문서 DB 등록
            $this->db->insert('bs_order', $orderData);
            $orderIdx = $this->db->insert_id();

            // 2. 주문상세(상품정보) DB 등록
            $this->OrderItemModel->registerOrderItem($orderIdx, $orderDetailData);

            // 3. (PG외) 현금결제 OR 포인트결제 OR 월말결제
            if ($orderData['pay_method'] == 'CASH' || $orderData['pay_method'] == 'POINT' || $orderData['pay_method'] == 'CREDIT') {
                // 3.1 사용포인트가 존재하면 한의원 포인트 DB 차감

                // 3.2 포인트결제시 결제 DB 등록

                // 3.3 장바구니 DB 삭제
                if ($cartIdxData) {
                    $this->ProductCartModel->deleteCartItem($cartIdxData);
                    $cartIdxData = [];
                }
            }

            /*
            // 4. 미수 DB 등록
            if ($this->session->userdata('member')['misu_yn'] == 'Y') {
                $transContent = generateMisuTransTitle($orderData['pay_method'], $orderData['ord_no']);
                $creditPrice = ($orderData['pay_method'] == 'CREDIT') ? $orderData['total_price'] : 0; // 외상금액 (월말결제)
                $salesPrice = ($orderData['pay_method'] == 'CREDIT') ? 0 : $orderData['total_price']; // 외상외 매출금액 (나머지결제)
                if ($salesPrice == 0 && $orderData['pay_method'] == 'POINT') $salesPrice = $orderData['use_point'];
                $misuData = [
                    'mb_id' => $orderData['mb_id'],
                    'trans_type' => $orderData['pay_method'],
                    'trans_date' => date("Y-m-d"),
                    'trans_content' => $transContent,
                    'credit_price' => $creditPrice,
                    'deposit' => 0,
                    'sales_price' => $salesPrice,
                    'ord_idx' => $orderIdx,
                    'idx' => 0,
                ];
                $this->MisuModel->registerMisu($misuData);
            }
            */

            // 5. (PG결제 후 삭제시 매핑용) 장바구니 DB 주문 인덱스 추가
            if (!empty($cartIdxData)) {
                $this->ProductCartModel->updateCartOrderInx($cartIdxData, $orderIdx);
            }

            // 트랜잭션 완료
            $this->db->trans_complete();

            // 트랜잭션 상태 확인
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
            }

            return true;

        } catch (Exception $e) {
            // 실패시 롤백
            $this->db->trans_rollback();
            log_message('error', '주문서 등록실패' . $e->getMessage());
            return false;
        }
    }

    // 주문서 PG 결제성공 OR 현금결제 입금확인 OR 가상계좌 입금확인 노티 후 `결제상태` 변경
    public function updateOrderSuccess($orderData = array()): bool
    {
        try {
            // 정렬일자가 없으면 추가
            $row = $this->getOrderInfoByOrdNo($orderData['ord_no'], 'ord_date');
            if (empty($row['ord_date']) || substr($row['ord_date'], 0, 4) == '0000') $orderData['ord_date'] = date('Y-m-d H:i:s');

            $this->db->where('ord_no', $orderData['ord_no']);

            return $this->db->update('bs_order', $orderData);

        } catch (Exception $e) {
            log_message('error', 'updateOrderSuccess 실패' . $e->getMessage());
            return false;
        }
    }

    // 주문 목록
    public function getOrderList($param = array(), $isExcel = false, $isAdmin = false): array
    {
        $member = $this->session->userdata('member');

        // 공통 쿼리
        $sqlCommon = "FROM bs_order WHERE del_yn = 'N' AND tmp_save_yn = 'N' ";

        //24.02.28 비로그인자 주문
        if($member){
            if (!$isAdmin){ $sqlCommon .= " AND mb_id = '{$member['mb_id']}'"; };
        }else{
            $sqlCommon .= " AND ord_name = '{$param['ord_name']}' AND ord_tel like '%{$param['ord_tel']}' AND mb_id is null ";
        }


        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case "oName" : // 주문자명 (배송정보-주문자-성함 OR 주문자(회원) 이름)
                    $sqlCommon .= "AND (ord_name LIKE '%{$param['stx']}%' OR (SELECT mb_name FROM bs_member WHERE mb_id = bs_order.mb_id) LIKE '%{$param['stx']}%') ";
                    break;
                case "ordNo" : // 주문번호
                    $sqlCommon .= "AND ord_no LIKE '%{$param['stx']}%' ";
                    break;
                case "rId" : // 주문자아이디
                    $sqlCommon .= "AND mb_id LIKE '%{$param['stx']}%' ";
                    break;
                case "rName" : // 받는사람명
                    $sqlCommon .= "AND rec_name LIKE '%{$param['stx']}%' ";
                    break;
                case "cName": // 한의원명
                    $sqlCommon .= " AND mb_id IN (SELECT mb_id FROM bs_member WHERE cn_name LIKE '%{$param['stx']}%')";
                    break;
                case "item": // 상품명
                    $sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
                    break;
            }
        }

        // 시작일,종료일
        if (!empty($param['sdt'])) $sqlCommon .= "AND DATE(reg_date) >= '{$param['sdt']}' ";
        if (!empty($param['edt'])) $sqlCommon .= "AND DATE(reg_date) <= '{$param['edt']}' ";
        // 그룹다중선택 (checkbox)
        if (!empty($param['groupIdxList'])) $sqlCommon .= "AND mb_id IN (SELECT mb_id FROM bs_member WHERE group_idx IN ({$param['groupIdxList']}) )";
        // 주문상태, 결제수단
        if (!empty($param['status'])) $sqlCommon .= "AND ord_status = '{$param['status']}' ";
        if (!empty($param['method'])) $sqlCommon .= "AND pay_method = '{$param['method']}' ";
        if (!empty($param['UPDATE_KEY'])) $sqlCommon .= "AND UPDATE_KEY = '' ";

        // select 컬럼추가
        $sqlColumn = "";
        if (!$isAdmin) {
            // 상품 썸네일
            $sqlColumn .= ", (SELECT file_name_list FROM bs_product WHERE idx = 
				(SELECT product_idx FROM bs_order_item WHERE ord_idx = bs_order.idx ORDER BY idx ASC LIMIT 1)) AS file_name_list
			";
        }
        else {
            $sqlColumn .= "
            , (SELECT cn_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicName
            , (SELECT rep_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicDoctorName
            ";
        }

        // 엑셀다운로드 시 select 컬럼
        if($isExcel) {
            $sqlColumn = "
            , (SELECT cn_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicName
            , (SELECT cn_tel FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicTel
            ";
        }

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);
        $sqlPaging = "LIMIT {$paging['formRecord']}, {$paging['listRows']}";

        // 엑셀다운로드 (택배송장은 페이지별로 다운로드)
        $trackingExcelArr = ['orderProductTracking'];
        if ($isExcel && !in_array($param['excel'], $trackingExcelArr)) $sqlPaging = "";

        $sql = "SELECT * {$sqlColumn}
			{$sqlCommon}
			ORDER BY reg_date DESC, ord_date DESC
			{$sqlPaging}
		";
        $query = $this->db->query($sql);

        $resultData = array();
        foreach ($query->result_array() as $key => $row) {

            if($isExcel) {
                // 주문공통 정보
                $this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
                $orderCommon = $this->orderlibrary->getOrderCommonData($row['idx']);

                $orderData = $orderCommon['orderData'];            // 주문서
                $orderItemData = $orderCommon['orderItemData'];        // 주문서 상세
                $payData = $orderCommon['payData'];                // PG 결제

                $row['orderData'] = $orderData;
                $row['orderItemData'] = $orderItemData;
                $row['payData'] = $payData;
                // 주문서공통 끝
            }

            $row['thumbNail'] = getProductThumbnail($row['file_name_list']); // 썸네일

            $resultData['listData'][] = $row;
        }
        $resultData['paging'] = $paging;

        return $resultData;
    }

    // 주문 목록 엑셀다운
    public function getOrderListExcel(): array
    {
        // 공통 쿼리
        $sqlCommon = "FROM bs_order WHERE del_yn = 'N' AND tmp_save_yn = 'N' ";

        $sqlColumn = "
            , (SELECT cn_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicName
            , (SELECT cn_tel FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicTel
        ";

        $sql = "SELECT * {$sqlColumn}
			{$sqlCommon}
			ORDER BY reg_date DESC, ord_date DESC

		";

        $sql = "SELECT A.*,B.*,A.idx as idx 
			FROM bs_order_item A LEFT JOIN bs_order B ON A.ord_idx = B.idx  
        	WHERE B.del_yn = 'N' ORDER BY B.idx ASC";

        $query = $this->db->query($sql);

        $resultData = array();
        foreach ($query->result_array() as $key => $row) {

            // 주문공통 정보
            $this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
            $orderCommon = $this->orderlibrary->getOrderCommonData($row['idx']);
            $orderData = $orderCommon['orderData'];            // 주문서
            //$orderItemData = $orderCommon['orderItemData'];        // 주문서 상세
            $payData = $orderCommon['payData'];                // PG 결제

            $row['orderData'] = $orderData;
            //$row['orderItemData'] = $orderItemData;
            $row['payData'] = $payData;
            // 주문서공통 끝

            $resultData['listData'][] = $row;
        }

        return $resultData;
    }

    // 배송정보 수정
    public function updateOrderRecipient($orderData = array()): bool
    {
        try {
            $this->db->where('idx', $orderData['idx']);
            return $this->db->update('bs_order', $orderData);

        } catch (Exception $e) {
            log_message('error', '배송정보 수정실패' . $e->getMessage());
            return false;
        }
    }

    // api 업데이트
    public function updateApiOrder($orderData = array()): bool
    {
        try {
            $this->db->where('idx', $orderData['idx']);
            return $this->db->update('bs_order', $orderData);

        } catch (Exception $e) {
            log_message('error', '주문확인 API 오류' . $e->getMessage());
            return false;
        }
    }

    // 관리자 - 주문배송관리 목록 일괄수정 (주문상태, 배송정보)
    public function updateOrderListData($listData = array()): bool
    {
        // 트랜잭션 시작
        $this->db->trans_begin();

        try {
            // $this->load->model('PointModel');
            $this->load->model('MisuModel');

            foreach ($listData as $data) {
                $ordIdx = $data['idx'];
                // 수정 전 현재상태
                $curOrder = $this->getOrderInfoByIdx($ordIdx, "mb_id, ord_status, pay_method, refund_point_yn, (SELECT idx FROM bs_misu WHERE ord_idx = bs_order.idx LIMIT 1) as misu_idx");

                // // 수정상태가 `주문취소`일 때 포인트환불 가능여부 체크 (주문취소를 여러번 했을 경우 포인트환불 중복실행 방지)
                // $isPointCancel = false;
                // if ($data['ordStatus'] == 'C') {
                //     if ($curOrder['refund_point_yn'] == 'N') $isPointCancel = true;
                // }

                /*
                // 미수 DB에 등록된 경우
                if (!empty($curOrder['misu_idx'])) {
                    if ($data['ordStatus'] == 'C') { // 주문취소로 변경시 미수 DB 삭제
                        $this->MisuModel->updateMisuDelYn(0, $curOrder['mb_id'], $ordIdx, 'Y');
                    } else if ($curOrder['ord_status'] == 'C') { // 주문취소에서 주문복구 시키면 미수 DB 복구
                        $this->MisuModel->updateMisuDelYn(0, $curOrder['mb_id'], $ordIdx, 'N');
                    }
                }
                */

                $sql = "UPDATE bs_order SET
                    ord_status = ?,
                    courier = ?,
                    tracking_no = ?
                ";
                if ($data['ordStatus'] == 'DC') { // 주문상태 `배송완료`이면 완료일자 추가
                    $curDate = date('Y-m-d');
                    $sql .= ", ord_fin_date = '{$curDate}'";
                }
                if ($data['ordStatus'] == 'C') { // 주문상태 `취소`이면 포인트환불 Y
                    $sql .= ", refund_point_yn = 'Y'";
                }
                $sql .= " WHERE idx = ?";
                $this->db->query($sql, [$data['ordStatus'], $data['courier'], $data['trackingNo'], $data['idx']]);

                //log_message('debug', $this->db->last_query());

                // // 수정상태가 `주문취소`이면서 환불가능한 상태면 포인트환불 처리
                // if ($data['ordStatus'] == 'C' && $isPointCancel) {
                //     $cancelData = $this->getOrderInfoByIdx($ordIdx);
                //     if ((int)$cancelData['use_point'] > 0) {
                //         // (사용한 포인트가 있으면) 포인트 환불
                //         $pointData = array(
                //             'pointType' => '적립',
                //             'mb_id' => $cancelData['mb_id'],
                //             'mbId' => $cancelData['mb_id'],
                //             'refIdx' => $ordIdx,
                //             'refTable' => 'order',
                //             'savePoint' => $cancelData['use_point'], // 환불해줄 포인트
                //             'usePoint' => 0,
                //             'remainPoint' => 0,
                //             'content' => '주문취소 환불',
                //             'adminActionId' => $this->session->userdata('member')['mb_id'],
                //         );
                //         $pointModel->registerPoint($pointData);
                //     }
                // }

            }

            // 트랜잭션 상태 확인
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
            }

            // 트랜잭션 완료
            $this->db->trans_complete();
            return true;

        } catch (\Exception $e) {
            // 실패시 롤백
            $this->db->trans_rollback();
            log_message('error', $e->getMessage());
            return false;
        }
    }

    // 송장업로드
    public function uploadExcelTrackingNo($excelRows): bool
    {
        try {
            // 송장 업로드 시 주문상태 '배송중'으로 변경
            $sqlCommon = "
                ord_status = 'DI',
                courier = ?,
                tracking_no = ?
            ";

            // header 제외하고 1부터
            for($i=1; $i<count($excelRows); $i++) {
                $row = $excelRows[$i];
                if(empty($row[0]) || empty($row[1]) || empty($row[2])) continue; // 필수값 없으면 넘어감

                $ordNo = $row[0]; // 주문번호
                $courier = array_search($row[1], COURIER_CODE); // 택배사
                $trackingNo = $row[2]; // 운송장번호

                $uploadData = [
                    'courier' => $courier,
                    'trackingNo' => $trackingNo
                ];

                $sql = "UPDATE bs_order SET {$sqlCommon} WHERE ord_no = '{$ordNo}'";
                $this->db->query($sql, $uploadData);
            }
            return true;

        } catch (\Exception $e) {
            log_message('error', '송장업로드실패=>' . $e->getMessage());
            return false;
        }
    }


    // 주문 목록
    public function getOrderAgencyList($param = array()): array
    {
        $member = $this->session->userdata('member');

        // 공통 쿼리
        $sqlCommon = "FROM bs_order WHERE del_yn = 'N' AND tmp_save_yn = 'N' ";
        $sqlCommon .= " AND mb_id IN ({$param['agencyMembersInStr']}) ";

        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case "oName" : // 주문자명 (배송정보-주문자-성함 OR 주문자(회원) 이름)
                    $sqlCommon .= "AND (ord_name LIKE '%{$param['stx']}%' OR (SELECT mb_name FROM bs_member WHERE mb_id = bs_order.mb_id) LIKE '%{$param['stx']}%') ";
                    break;
                case "ordNo" : // 주문번호
                    $sqlCommon .= "AND ord_no LIKE '%{$param['stx']}%' ";
                    break;
                case "rId" : // 주문자아이디
                    $sqlCommon .= "AND mb_id LIKE '%{$param['stx']}%' ";
                    break;
                case "rName" : // 받는사람명
                    $sqlCommon .= "AND rec_name LIKE '%{$param['stx']}%' ";
                    break;
                case "cName": // 한의원명
                    $sqlCommon .= " AND mb_id IN (SELECT mb_id FROM bs_member WHERE cn_name LIKE '%{$param['stx']}%')";
                    break;
                case "item": // 상품명
                    $sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
                    break;
            }
        }

        //$sqlCommon .= "AND agency_fee2 != 0 ";

        // 시작일,종료일
        if (!empty($param['sdt'])) $sqlCommon .= "AND DATE(reg_date) >= '{$param['sdt']}' ";
        if (!empty($param['edt'])) $sqlCommon .= "AND DATE(reg_date) <= '{$param['edt']}' ";

        // 년도와 월을 파라미터로 받아서 SQL 쿼리에 추가
        if (!empty($param['year'])) { $sqlCommon .= "AND YEAR(reg_date) = '{$param['year']}' "; }
        if (!empty($param['year']) && !empty($param['month'])) { $sqlCommon .= " AND MONTH(reg_date) = '{$param['month']}' "; }

        // 그룹다중선택 (checkbox)
        if (!empty($param['groupIdxList'])) $sqlCommon .= "AND mb_id IN (SELECT mb_id FROM bs_member WHERE group_idx IN ({$param['groupIdxList']}) )";
        // 주문상태, 결제수단
        if (!empty($param['status'])) $sqlCommon .= "AND ord_status = '{$param['status']}' ";
        if (!empty($param['method'])) $sqlCommon .= "AND pay_method = '{$param['method']}' ";
        if (!empty($param['mb_id'])) $sqlCommon .= "AND mb_id = '{$param['mb_id']}' ";
        if (!empty($param['UPDATE_KEY'])) $sqlCommon .= "AND UPDATE_KEY = '' ";

        // select 컬럼추가
        $sqlColumn = "  ";
            // 상품 썸네일
            $sqlColumn .= ", (SELECT file_name_list FROM bs_product WHERE idx = 
				(SELECT product_idx FROM bs_order_item WHERE ord_idx = bs_order.idx ORDER BY idx ASC LIMIT 1)) AS file_name_list
			";
            
            //주문 최초날짜
        $sqlMin = " SELECT min(reg_date) as minDate FROM bs_order WHERE del_yn = 'N' AND tmp_save_yn = 'N' AND mb_id IN ({$param['agencyMembersInStr']}) ";
        $query_min = $this->db->query($sqlMin)->row('minDate');



        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);
        $sqlPaging = "LIMIT {$paging['formRecord']}, {$paging['listRows']}";

        $sql = "SELECT * {$sqlColumn}
			{$sqlCommon}
			ORDER BY reg_date DESC, ord_date DESC
			{$sqlPaging}
		";
        $query = $this->db->query($sql);

        $resultData = array();
        foreach ($query->result_array() as $key => $row) {


                // 주문공통 정보
                $this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
                $orderCommon = $this->orderlibrary->getOrderCommonData($row['idx']);

                $orderData = $orderCommon['orderData'];            // 주문서
                $orderItemData = $orderCommon['orderItemData'];        // 주문서 상세
                $payData = $orderCommon['payData'];                // PG 결제

                $row['orderData'] = $orderData;
                $row['orderItemData'] = $orderItemData;
                $row['payData'] = $payData;
                // 주문서공통 끝

            $this->load->model("MemberModel");
            $member_info = $this->MemberModel->getMemberById($row['mb_id']);
            $row['member_info'] = $member_info;

            $row['thumbNail'] = getProductThumbnail($row['file_name_list']); // 썸네일

            $resultData['listData'][] = $row;
        }
        $resultData['sql'] = $sql;
        $resultData['paging'] = $paging;
        $resultData['minDate'] = $query_min;

        return $resultData;
    }
}
