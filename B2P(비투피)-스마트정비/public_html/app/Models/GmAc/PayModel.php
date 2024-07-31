<?php

namespace App\Models\GmAc;


class PayModel  extends GmAcBasicApiModel
{
    public function getPayKeyList($data){
        $table_name = 'pay_key_list';
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
    public function getPayKeyByMbid($mb_id): array
    {
        //$sql = "select * from `pay_key_list` where `mb_id` = '{$mb_id}'";
        $sql = "select * from `pay_key_list`";
        $re = sql_query($sql);
        $return_data = sql_fetch_array($re);
        return $return_data;
    }

    // 인덱스로 주문(공통) 조회
    public function getPayInfoByIdx($idx): array
    {
        $sql = "select * from `pay_key_list` where `idx` = '{$idx}'";
        $re = sql_fetch($sql);
        return $re ?? array();
    }

    // 주문번호로 결제키 조회
    public function getPayInfoByOrderNo($OrderNo): array
    {
        $sql = "select * from `pay_key_list` where `OrderNo` = '{$OrderNo}'";
        $re = sql_fetch($sql);
        return $re ?? array();
    }

    // 가상계좌 리스트 조회
    public function getVcntTnoByMbid($tno): array
    {
        //$sql = "select * from `pay_key_list` where `mb_id` = '{$mb_id}'";
        $sql = "select * from `pay_vcnt_list` where `tno` <> '' ";
        $re = sql_query($sql);
        $return_data = sql_fetch_array($re);
        return $return_data;
    }

    // 가상계좌 노티 조회
    public function getVcntNoti($data): array
    {
        //$sql = "select * from `pay_key_list` where `mb_id` = '{$mb_id}'";
        $sql = "select * from `pay_vcnt_noti` where `tx_cd` = '{$data['tx_cd']}' ";
        $re = sql_query($sql);
        $return_data = sql_fetch_array($re);
        return $return_data;
    }

    // 주문번호로 결제키 조회
    public function getVcntNotiBytno($tno): array
    {
        $sql = "select * from `pay_vcnt_noti` where `tno` = '{$tno}'";
        $re = sql_fetch($sql);
        return $re ?? array();
    }

    // 매입요청 조회
    public function getPerchaseBytno($data): array
    {
        //$sql = "select * from `pay_key_list` where `mb_id` = '{$mb_id}'";
        $sql = "select * from `pay_perchase` where `purchase_state ` = '{$data['purchase_state ']}' ";
        $re = sql_query($sql);
        $return_data = sql_fetch_array($re);
        return $return_data;
    }



    // 배치키 등록
    public function setPayKey($data){

        $sql = "select count(*) as cnt from pay_key_list where `ordr_idxx` = '{$data['ordr_idxx']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data);
        //log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_key_list` set $insert_str where `ordr_idxx` = '{$data['ordr_idxx']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `pay_key_list` set $insert_str ";
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

    // 배치키로 결제 등록
    public function setPay($data){

        $sql = "select count(*) as cnt from pay_list where `ordr_idxx` = '{$data['ordr_idxx']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data);
        //log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_list` set $insert_str where `ordr_idxx` = '{$data['ordr_idxx']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `pay_list` set $insert_str ";
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

    // 배치키로 결제 등록
    public function setVcnt($data){

        $sql = "select count(*) as cnt from pay_vcnt_list where `ordr_idxx` = '{$data['ordr_idxx']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data);
        //log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_vcnt_list` set $insert_str where `ordr_idxx` = '{$data['ordr_idxx']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `pay_vcnt_list` set $insert_str ";
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

    // 배치키로 결제 등록
    public function setVcntCancle($data){

        $sql = "select count(*) as cnt from pay_vcnt_list where `tno` = '{$data['tno']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data);
        //log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_vcnt_list` set $insert_str where `tno` = '{$data['tno']}'";
            $result['type'] = '업데이트';
        } else {
            //$sql = "insert into `pay_vcnt_list` set $insert_str ";
            $result['type'] = '추가 오류';
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

    // 노티 db등록
    public function setVcntNotiByTno($data){

        $sql = "select count(*) as cnt from pay_vcnt_noti where `tno` = '{$data['tno']}'";
        $data['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data);
        //log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_vcnt_noti` set $insert_str where `tno` = '{$data['tno']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `pay_vcnt_noti` set $insert_str ";
            $result['type'] = '추가';
        }

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

    // 노티 db등록
    public function setPurchase($data){



        $data2 = [];
        //$log_dir = '/home/b2p/public_html/app/ThirdParty/KCP_purchase/'.$data['status'];
        $log_dir = '/home/b2p/public_html/writable/KCP_'.$data['status'].'/';

        //$log_dir = WRITEPATH . 'logs2/';


        $PageCall = date("Y-m-d [H:i:s]",time());
        $date = date("Ymd",time());
        $site_cd = $data['site_cd'];
        $status = $data['status'] = 'up' ? 'INX' : 'OUT';
        $data2['status'] = $status;

        //$logfile = fopen( $log_dir . "KCP_BCFS_FILE_MR01_".$status."_".$site_cd."_".$date."", "w+" );
        //$logfile = fopen( $log_dir . "KCP_BCFS_FILE_MR01_".$status."_".$site_cd."_".$date."", "w+" );
        $logfile = fopen( $log_dir . "KCP_BCFS_FILE_MR01_".$status."_".$site_cd."_".$date."","w+" );
        $data2['file_name'] = "KCP_BCFS_FILE_MR01_".$status."_".$site_cd."_".$date."";

        /**
         * [ Start Record ]
        항목 위치 길이 타입 설명
        레코드구분 0 1 A “S”
        요청일자 1 8 N YYYYMMDD ( 파일생성일자 )
        Filler 9 391 AN 공백
        **/

        //레코드구분
        fwrite( $logfile,"S");
        $data2['record1'] = "S";


        //요청일자
        fwrite( $logfile,$date);
        $data2['request_date'] = $date;
        /*
        $filter = 0;
        for ($i = 0 ; $i < 391 ; $i++){
            $filter .= $i;
        }
        fwrite( $logfile,$filter);
        */
        //Filler
        fwrite( $logfile,str_pad('', 391,' ',STR_PAD_LEFT));
        $data2['Filler1'] = str_pad('', 391,' ',STR_PAD_LEFT);
        /**
         * [ Data Record ]
        항목 위치 길이 타입 설명
        레코드 구분 0 1 AN “D”
        사이트코드 1 5 AN KCP 로부터 제공받은 자동결제 사이트코드 ( 부품제조사 )
        매입구분 6 4 AN 매입 요청 : STMR
        승인일자 10 8 N 승인일자(YYYYMMDD)
        거래번호 18 20 AN KCP거래번호 ( 거래번호 왼쪽 정렬 )
        거래금액 38 9 N 1004
        가맹점 필드 47 40 AN 가맹점 사용 데이터를 요청파일에 전달 시 결과파일에서 그대로 전달.
        누적금액 검증코드 87 5 AN 누적금액 검증 사이트코드 ( 유통대리점 )
        예비필드 92 306 AN 공백
        결과코드 398 2 N
        - 10 : 레이아웃 형식 오류
        - 20 : 데이터 정보 불일치
        Filler 400 - -
         */

        //레코드
        fwrite( $logfile,"D");
        $data2['record2'] = "D";

        //사이트코드
        fwrite( $logfile,$site_cd);
        $data2['site_cd'] = $site_cd;

        //매입구분
        fwrite( $logfile,"STMR");
        $data2['request_state'] = "STMR";

        //승인일자
        fwrite( $logfile,$date);
        $data2['approve_date'] = $date;

        //거래번호
        fwrite( $logfile,str_pad($data['tno'], 20));
        $data2['tno'] = str_pad($data['tno'], 20);

        //거래금액
        fwrite( $logfile,str_pad($data['ipgm_mnyx'], 9,0,STR_PAD_LEFT));
        $data2['ipgm_mnyx'] = str_pad($data['ipgm_mnyx'], 9,0,STR_PAD_LEFT);
        
        //가맹점 필드
        fwrite( $logfile,str_pad('data', 40,0,STR_PAD_LEFT));
        $data2['shop_field'] = str_pad('data', 40,0,STR_PAD_LEFT);
        
        //누적금액 검증코드
        fwrite( $logfile,str_pad('', 5,0,STR_PAD_LEFT));
        $data2['amount_check_code'] = str_pad('', 5,0,STR_PAD_LEFT);

        //예비필드
        fwrite( $logfile,str_pad('', 306,' ',STR_PAD_LEFT));
        $data2['etc_field'] = str_pad('', 306,' ',STR_PAD_LEFT);

        //결과필드
        //- 10 : 레이아웃 형식 오류
        //- 20 : 데이터 정보 불일치
        fwrite( $logfile,str_pad('', 2,0,STR_PAD_LEFT));
        $data2['result_code'] = str_pad('', 2,0,STR_PAD_LEFT);

        //Filler
        fwrite( $logfile,"");
        $data2['Filler2'] = "";
        /**
         * [ End Record ]
        항목 위치 길이 타입 설명
        레코드 구분 0 1 A “S”
        요청일자 1 8 N YYYYMMDD ( 파일생성일자 )
        Filler 9 391 AN 공백
         */

        //레코드
        fwrite( $logfile,"S");
        $data2['record3'] = "S";

        //요청일자
        fwrite( $logfile,$date);
        $data2['request_date2'] = $date;

        //Filler
        fwrite( $logfile,str_pad('', 391,' ',STR_PAD_LEFT));
        $data2['Filler3'] = str_pad('', 391,' ',STR_PAD_LEFT);

        fclose( $logfile );

        $sql = "select count(*) as cnt from pay_purchase where `tno` = '{$data['tno']}'";
        $data2['up_datetime'] = date('Y-m-d H:i:s');

        $insert_str = array_to_sql_insert_str($data2);
        log_message('alert',$sql);
        $count = sql_fetch($sql)['cnt'];
        $result = [];
        if($count > 0){
            $sql = "update `pay_purchase` set $insert_str where `tno` = '{$data['tno']}'";
            $result['type'] = '업데이트';
        } else {
            $sql = "insert into `pay_purchase` set $insert_str ";
            $result['type'] = '추가';
        }

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