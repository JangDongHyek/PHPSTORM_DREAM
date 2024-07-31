<?php


namespace App\Models\GmAc;


class OrderModel  extends GmAcBasicApiModel{
    public function getList($data){
        $table_name = 'order_list';
        $where = " where 1=1 ";

        // mb_id와 mb_level 체크
        if(isset($data['member']['mb_id']) && isset($data['member']['mb_level'])){
            $mb_id = $data['member']['mb_id'];
            $mb_level = (int)$data['member']['mb_level'];

            if($mb_level < 9){
                $where .= " and `mb_id` = '{$mb_id}'";
            }
        }
        
        // 검색
        if (!empty($data['stx'])) {
            switch ($data['sfl']) {
                case "OrderNo" : // 주문번호
                    $where .= "AND OrderNo LIKE '%{$data['stx']}%' ";
                    break;
                case "SiteGoodsNo" : // 상품번호
                    $where .= "AND SiteGoodsNo LIKE '%{$data['stx']}%' ";
                    break;

                case "BuyerName": // 구매자명
                    $where .= "AND BuyerName LIKE '%{$data['stx']}%' ";
                    break;

                case "BuyerID": // 구매자ID
                    $where .= "AND BuyerID LIKE '%{$data['stx']}%' ";
                    break;

                case "GoodsName": // 상품명
                    $where .= "AND GoodsName LIKE '%{$data['stx']}%' ";
                    break;
            }
        }

        // 시작일,종료일
        if (!empty($data['sdt'])) $where .= "AND DATE(OrderDate) >= '{$data['sdt']}' ";
        if (!empty($data['edt'])) $where .= "AND DATE(OrderDate) <= '{$data['edt']}' ";
        
        //취소된거
        if (1) $where .= "AND CancelStatus = '{$data['CancelStatus']}' ";

        // 검색
        if (!empty($data['list_category'])) {
            switch ($data['list_category']) {
                case "new_list" : // 신규주문
                    $where .= "AND OrderStatus = 1 ";
                    break;
                case "send_list" : // 발송처리
                    $where .= "AND OrderStatus = 2 ";
                    break;
                case "deliver_list" : // 배송중/배송완료
                    if (!empty($data['OrderStatus'])){
                        $where .= "AND OrderStatus = {$data['OrderStatus']} ";
                    }else{
                        $where .= "AND ( OrderStatus = 3 OR OrderStatus = 4 ) ";
                    }
                    break;
                case "confirm_list" : // 구매결정완료
                    $where .= "AND OrderStatus = 5 ";
                    break;
            }
        }



        //발송관리 count들
        if($data['list_category'] == 'send_list'){
            $now = date('Y-m-d', time());

            $sql = "select * from `$table_name` $where AND DATE(TransDueDate) = '{$now}'";
            $re = sql_query($sql);
            $send_count = sql_num_rows($re);
            $return_data['send_count'] = $send_count;

            $sql = "select * from `$table_name` $where AND DATE(TransDueDate) < '{$now}'";
            $re = sql_query($sql);
            $send_delay_count = sql_num_rows($re);
            $return_data['send_delay_count'] = $send_delay_count;
        }

        //배송현황 count들
        if($data['list_category'] == 'deliver_list'){
            $sql = "select * from `$table_name` $where AND `OrderStatus` = 3";
            $re = sql_query($sql);
            $deliver_count = sql_num_rows($re);
            $return_data['deliver_count'] = $deliver_count;

            $sql = "select * from `$table_name` $where AND `OrderStatus` = 4";
            $re = sql_query($sql);
            $deliver_delay_count = sql_num_rows($re);
            $return_data['deliver_complete_count'] = $deliver_delay_count;

            $sql = "select * from `$table_name` $where AND `OrderStatus` = 6";
            $re = sql_query($sql);
            $deliver_error_count = sql_num_rows($re);
            $return_data['deliver_error_count'] = $deliver_error_count;
        }



        // 특정 인덱스 처리
        if(!empty($data['idx'])){
            $where .= " and `idx` = '{$data['idx']}'";
        }

        $sql = "select * from `$table_name` $where";
        $re = sql_query($sql);
        $total_count = sql_num_rows($re);
        $return_data['total_count'] = $total_count;

        //log_message('error','확인2용 : '.$sql);
        // 페이지 번호와 페이지당 아이템 수 설정
        $page = isset($data['page']) ? (int) $data['page'] : 1;
        $items_per_page = isset($data['items_per_page']) ? (int) $data['items_per_page'] : 15;
        $items_per_page = $total_count < $items_per_page  ? (int) $total_count : (int) $items_per_page;
        $return_data['items_per_page'] = $items_per_page;

        // 시작 위치 계산 (0 기반 인덱스)
        $start_limit = ($page - 1) * $items_per_page;

        // 실제 데이터 리스트 만들기
        $sql = "SELECT * FROM `$table_name` $where ORDER BY `idx` DESC LIMIT $start_limit, $items_per_page";
        $re = sql_query($sql);
        $return_data['list'] = $row = sql_fetch_array($re);


        return $return_data;
    }

    // 인덱스로 주문(공통) 조회
    public function getOrderInfoByIdx($idx): array
    {
        $sql = "select * from `order_list` where `idx` = '{$idx}'";
        $re = sql_fetch($sql);
        return $re ?? array();
    }

    // 주문번호로 주문(공통) 조회
    public function getOrderInfoByOrderNo($OrderNo): array
    {
        $sql = "select * from `order_list` where `OrderNo` = '{$OrderNo}'";
        $re = sql_fetch($sql);
        return $re ?? array();
    }

    // 주문확인 주문번호로 상태변경
    public function setOrderCheckByOrderNo($OrderNo): array
    {
        $sql = "update `order_list` set `OrderStatus` = 2 where `OrderNo` = '{$OrderNo}' and `OrderStatus` < 2";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }

    }

    // 주문확인 주문번호 취소로 상태변경
    public function setOrderCheckCancelByOrderNo($OrderNo): array
    {
        $sql = "update `order_list` set `CancelStatus` = 3 where `OrderNo` = '{$OrderNo}' and `CancelStatus` < 3";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }

    // 주문확인 주문번호로 상태변경
    public function setOrderShippingExpectedDateByOrderNo($data): array
    {
        $sql = "update `order_list` set `OrderStatus` = 2, `ReasonType` = '{$data['ReasonType']}', `ShippingExpectedDate` = '{$data['ShippingExpectedDate']}', `ReasonDetail` = '{$data['ReasonDetail']}' where `OrderNo` = '{$data['orderNo']}' and `ShippingExpectedDate` = '0000-00-00' and `OrderStatus` < 3";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.', "msg2" => $sql];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }

    // 주문확인 주문번호로 상태변경
    public function setOrderSendByOrderNo($data): array
    {
        $sql = "update `order_list` set `OrderStatus` = 3, `TakbaeName` = '{$data['TakbaeName']}', `NoSongjang` = '{$data['InvoiceNo']}', `TransDate` = '{$data['ShippingDate']}' where `OrderNo` = '{$data['orderNo']}' and `OrderStatus` < 3";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }



    // 주문확인 주문번호로 상태변경x
    public function setOrderSendByOrderNo2($data): array
    {
        $sql = "update `order_list` set `TakbaeName` = '{$data['TakbaeName']}', `NoSongjang` = '{$data['InvoiceNo']}', `TransDate` = '{$data['ShippingDate']}' where `OrderNo` = '{$data['orderNo']}' ";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }

    // 주문확인 발송마감일 지나면 상태변경
    public function setOrderSendByTransDueDate(): array
    {
        $date = date('Y-m-d');
        $sql = "update `order_list` set `OrderStatus` = 3 and `TransDate` = '{$date}' where `TransDueDate` <= '{$date}' and `OrderStatus` = 2";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }

    // 배송중,배송완료 -> 자동구매결정완료
    public function setOrderDeliByTransDueDate(): array
    {
        $timestamp = strtotime("+28 days");
        $date = date('Y-m-d');

        //$sql = "select * from `order_list` where DATEDIFF('{$date}' , TransDueDate ) > 8 and `OrderStatus` = 4";

        //배송완료는 8일뒤 자동구매완료
        $sql = "update `order_list` set `OrderStatus` = 5,`BuyDecisionDate` = '{$date}' where DATEDIFF('{$date}' , TransDueDate ) > 8 and `OrderStatus` = 4";
        $re = sql_query($sql);
        
        //배송중은 28일뒤 자동구매완료
        $sql = "update `order_list` set `OrderStatus` = 5,`BuyDecisionDate` = '{$date}' where DATEDIFF('{$date}' , TransDueDate ) > 28 and `OrderStatus` = 3";
        $re = sql_query($sql);
        if($re){
            return ['code' => 200, 'msg'=>'저장하였습니다.'];
        }else{
            return ["code" => 400, "msg" => $sql];
        }
    }

    // 상품등록
    public function setOrder($data){

        $sql = "select count(*) as cnt from order_list where `OrderNo` = '{$data['OrderNo']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        if($data['OutGoodsNo']){
            $data['mb_id'] = explode('_',$data['OutGoodsNo'])[0];
        }

        $insert_str = array_to_sql_insert_str($data);

        //log_message('alert',$sql);

        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){

            $sql = "update `order_list` set $insert_str where `OrderNo` = '{$data['OrderNo']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `order_list` set $insert_str ";
            $result['type'] = '추가';
        }

        //log_message('alert',$sql);
        $sql_result = sql_query($sql);

        if($sql_result){
            $result['status'] = '성공';
        }else{
            $result['status'] = '실패';
        }

        // 결과를 객체나 배열로 반환
        return [
            'result' => $result,
            'sql' => $sql,
        ];

    }

    // 상품취소등록
    public function setOrderCancel($data){

        $sql = "select count(*) as cnt from order_list where `OrderNo` = '{$data['OrderNo']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $data_all = [];
        $data_all['cancel_ResultCode'] = $data['ResultCode'];
        $data_all['cancel_Message'] = $data['Message'];
        $data_all['cancel_AddShippingFee'] = $data['AddShippingFee'];
        $data_all['cancel_ApproveUser'] = $data['ApproveUser'];
        $data_all['cancel_Reason'] = $data['Reason'];
        $data_all['cancel_ReasonCode'] = $data['ReasonCode'];
        $data_all['cancel_ReasonDetail'] = $data['ReasonDetail'];
        $data_all['cancel_OrderDate'] = $data['OrderDate'];
        $data_all['cancel_PayDate'] = $data['PayDate'];
        $data_all['cancel_RequestDate'] = $data['RequestDate'];
        $data_all['cancel_WithdrawDate'] = $data['WithdrawDate'];
        $data_all['cancel_ApproveDate'] = $data['ApproveDate'];
        $data_all['cancel_CompleteDate'] = $data['CompleteDate'];

        $insert_str = array_to_sql_insert_str($data_all);

        log_message('alert',$sql);

        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `order_list` set $insert_str where `OrderNo` = '{$data['OrderNo']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `order_list` set $insert_str ";
            $result['type'] = '추가';
        }

        //log_message('alert',$sql);
        $sql_result = sql_query($sql);

        if($sql_result){
            $result['status'] = '성공';
        }else{
            $result['status'] = '실패';
        }

        // 결과를 객체나 배열로 반환
        return [
            'result' => $result,
            'sql' => $sql,
        ];

    }








}