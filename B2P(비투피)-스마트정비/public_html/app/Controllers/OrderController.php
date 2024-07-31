<?php

namespace App\Controllers;
use App\Models\GmAc\OrderModel;
use App\Models\GmarketApiModel;
use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use CodeIgniter\Files\File;

class OrderController extends BaseController{

    public function message($to = 'World')
    {
        echo "Hello {$to}!".PHP_EOL;
    }

    public function Test()
    {
        log_message('error','cron_1시간 단위테스트');
        //echo 'g2';
        //echo command('migrate:create TestMigration');
    }

    // 신규주문
    public function Newlist(){
        $this->data['pid'] = 'new_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_category' => 'new_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        return view('order/new_list',$this->data);
    }

    // 발송처리
    public function Sendlist(){
        $this->data['pid'] = 'send_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_category' => 'send_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        //$this->data['order_send_data'] = $orderModel->getSendList($getData);
        $this->data['delivery_company_list'] = get_delivery_company_list();

        return view('order/send_list',$this->data);
    }

    // 배송중완료
    public function Deliverlist(){
        $this->data['pid'] = 'deliver_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'OrderStatus' => $this->data['OrderStatus'],
            'list_category' => 'deliver_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        return view('order/deliver_list',$this->data);
    }

    // 구매결정완료
    public function Confirmlist(){
        $this->data['pid'] = 'confirm_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_category' => 'confirm_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        return view('order/confirm_list',$this->data);
    }

    // 발주서 출력
    public function OrderPrint($idx = 0){

        $post = $this->data;
        if(!$idx){
            $idx = $post['OrderPrint_idx'];
        }

        $orderModel = new OrderModel();
        $words = explode(',' , $idx);
        for($i=0; $i<count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);
            //array_push($resultData['result'][$i],$orderModel->getOrderInfoByIdx($idx));
        }
        //$resultData['result'] = $orderModel->getOrderInfoByIdx($idx);

        //return $this->response->setJSON($resultData);
        return view('order/order_print',$resultData);
    }
    
    //라벨인쇄
    public function OrderLabelPrint($idx = 0){

        $post = $this->data;
        if(!$idx){
            $idx = $post['OrderLabelPrint_idx'];
        }

        $orderModel = new OrderModel();
        $words = explode(',' , $idx);
        for($i=0; $i<count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);
            //array_push($resultData['result'][$i],$orderModel->getOrderInfoByIdx($idx));
        }
        //$resultData['result'] = $orderModel->getOrderInfoByIdx($idx);

        //return $this->response->setJSON($resultData);
        return view('order/order_label_print',$resultData);
    }

    // api주문목록 가져오기
    public function GetOrder($orderStatus = 1,$api_type = 'GM'){
        $benchmark = \Config\Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Order/RequestOrders";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d',strtotime('-29Day'));
        $time_end = date('Y-m-d',strtotime('+1Day'));

        $this->data['api_data'] = [
            //"siteType" => 1,
            "orderStatus" => $orderStatus,
            "requestDateType" => 1,
            "requestDateFrom" => $time_start,
            "requestDateTo" => $time_end,
            //"isGiftOrder" => "Y",
            //"giftOrderStatus" => 0,
            "pageIndex" => 1,
            "pageSize" => 100
        ];

        if($api_type == 'GM'){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($api_type == 'AC'){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $orderModel = new OrderModel();

        if($result['body']['Data']['RequestOrders'][0]){
            $SiteType = $result['body']['Data']['SiteType'];
            foreach ($result['body']['Data']['RequestOrders'] as $get_data){
                $get_data['SiteType'] = $SiteType;
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setOrder($get_data);
                //log_message('error','cron : GetOrder실행 :  $get_data - ' . print_r($get_data,true));
            }
        }else{
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));

        return $this->response->setJSON($result);

    }

    // api주문목록 가져오기
    public function GetOrderCancel($api_type = 'GM'){
        $benchmark = \Config\Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Cancels";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d',strtotime('-7Day'));
        $time_end = date('Y-m-d',strtotime('+0Day'));

        $this->data['api_data'] = [
            "CancelStatus" => 0,
            "Type" => 2,
            "StartDate" => $time_start,
            "EndDate" => $time_end
        ];

        if($api_type == 'GM'){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($api_type == 'AC'){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $orderModel = new OrderModel();

        if($result['body']['Data']['RequestOrders'][0]){
            $SiteType = $result['body']['Data']['SiteType'];
            foreach ($result['body']['Data'] as $get_data){
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setOrderCancel($get_data);
                log_message('error','cron : GetOrderCancel실행 :  $get_data - ' . print_r($get_data,true));
            }
        }else{
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);



        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();

        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));

        return $this->response->setJSON($result);

    }

    // api주문목록 가져오기
    public function GetOrderByIdx($idx = 0){

        $resultData = ['result' => false];
        $post = $this->data;
        if(!$idx){
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $resultData['result'] = $orderModel->getOrderInfoByIdx($idx);

        return $this->response->setJSON($resultData);
    }

    // api주문확인
    public function OrderCheck($idx = 0){
        $orderData = [];

        $post = $this->data;
        if(!$idx){
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Order/OrderCheck/".$OrderNo;
        $this->data['api_data'] = [];


        $this->data['api_data'] = [
            "orderNo" => $OrderNo
        ];


        if($orderData['result']['SiteType'] == 2){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($orderData['result']['SiteType'] == 1){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }
        
        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if(!$result['body']['ResultCode']){
            $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($OrderNo);
            log_message('error','OrderCheck실행 :  $get_data - ' . print_r($result['body'],true));
        }else{

            if($result['body']['Message'] == '이미 주문확인 처리된 건입니다.'){
                $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($OrderNo);
            }

            if($result['body']['Message'] == '취소된 주문번호입니다.'){
                $result['body']['result'] = $orderModel->setOrderCheckCancelByOrderNo($OrderNo);
            }

            log_message('error','OrderCheck실행 :  $result[body] - ' . print_r($result['body'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        return $this->response->setJSON($result);

    }





    // api 배송예정일 등록
    public function OrderShippingExpectedDate($idx = 0){
        $orderData = [];

        $post = $this->data;
        $post = $post['data_arr'];
        $post = json_decode(json_encode($post), true);
        //log_message('error','ShippingExpectedDate 실행 :  $post - ' . print_r($post,true));
        if(!$idx){
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];
        if($orderData['result']['ShippingExpectedDate'] != '0000-00-00' && $orderData['result']['ShippingExpectedDate'] != ''){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '이미 발송예정일이 등록된 주문입니다.';
            return $this->response->setJSON($result);
        }

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Order/ShippingExpectedDate";
        $this->data['api_data'] = [];


        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ReasonType" => $post['ReasonType'],
            "ShippingExpectedDate" => $post['ShippingExpectedDate'],
            "ReasonDetail" => $post['ReasonDetail']
        ];

        if($orderData['result']['SiteType'] == 2){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($orderData['result']['SiteType'] == 1){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if(!$result['body']['ResultCode']){
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            log_message('error','ShippingExpectedDate 실행 :  $get_data - ' . print_r($result['body'],true));
        }else{
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            log_message('error','ShippingExpectedDate 실행 :  $result[body] - ' . print_r($result['body'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        return $this->response->setJSON($result);

    }

    // api 발송처리
    public function OrderSend($idx = 0){
        $orderData = [];

        $post = $this->data;
        $post = $post['data_arr'];
        $post = json_decode(json_encode($post), true);
        if(!$idx){
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        /*
        $result = [];
        if($orderData['result']['ShippingExpectedDate']){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '이미 발송예정일이 등록된 주문입니다.';
            return $this->response->setJSON($result);
        }*/

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/ShippingInfo";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ShippingDate" => $now,
            "DeliveryCompanyCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
            "TakbaeName" => $post['TakbaeName'],
        ];

        if($orderData['result']['SiteType'] == 2){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($orderData['result']['SiteType'] == 1){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if(!$result['body']['ResultCode']){
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo($this->data['api_data']);
            log_message('error','OrderSend 실행 :  $get_data - ' . print_r($result['body'],true));
            //log_message('error','OrderSend 실행 :  data - ' . print_r($this->data,true));
        }else{
            log_message('error','OrderSend 실행 :  $result[body] - ' . print_r($result['body'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        return $this->response->setJSON($result);

    }

    // api 발송처리
    public function OrderSendTransDueDate(){
        $orderData = [];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->setOrderSendByTransDueDate();
        //log_message('error','cron : OrderSendTransDueDate 실행 :' . print_r($orderData,true));
        return $this->response->setJSON($orderData);
    }

    // api 발송처리
    public function OrderDeliTransDueDate(){
        $orderData = [];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->setOrderDeliByTransDueDate();
        //log_message('error','cron : OrderDeliTransDueDate 실행 :' . print_r($orderData,true));
        return $this->response->setJSON($orderData);
    }

    // api 발송처리orderDeliEditModal
    public function OrderDeliEdit(){
        $orderData = [];
        $post = $this->data;
        $post = $post['data_arr'];
        $post = json_decode(json_encode($post), true);
        //log_message('error','OrderSend 실행 :  $post - ' . print_r($post,true));
        $idx = $post['idx'];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        /*
        $result = [];
        if($orderData['result']['ShippingExpectedDate']){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '이미 발송예정일이 등록된 주문입니다.';
            return $this->response->setJSON($result);
        }*/

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/ShippingInfo";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ShippingDate" => $now,
            "DeliveryCompanyCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
            "TakbaeName" => $post['TakbaeName'],
        ];



        if($orderData['result']['SiteType'] == 2){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($orderData['result']['SiteType'] == 1){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if(!$result['body']['ResultCode']){
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('error','OrderDeliEdit 실행 :  $get_data - ' . print_r($result['body'],true));
        }else{
            log_message('error','OrderDeliEdit 실행 :  $result[body] - ' . print_r($result['body'],true));
        }
        return $this->response->setJSON($result);

    }

    public function OrderSendExcelUpload(){
        $post = $this->data;
        $file = $this->request->getFile('OrderSendExcelFile');

        $orderNo_row = $post['selOrderNoCell'];
        $TakbaeName_row = $post['selDeliveryCompCell'];
        $NoSongjang_row = $post['selInvoiceCell'];

        if (empty($file)) {
            return; // 파일이 없으면 작업을 종료합니다.
        }

        $kilobytes = $file->getSizeByUnit('kb'); // 250.880
        if($kilobytes > 750){

            $result['body']['aValue'] = 'error';
            $result['body']['bValue'] = $kilobytes;
            $result['body']['cValue'] = 'kb';
            $result['body']['Message'] = '파일 크기가 750kb를 넘습니다.';
            $jsonData[] = $result['body'];

            return view('order/send_excel_list',$jsonData);
        }
        // 엑셀 파일을 로드하고 작업을 수행합니다.
        try {
            $spreadsheet = IOFactory::load($file->getTempName());
            $worksheet = $spreadsheet->getActiveSheet();
        } catch (\Exception $e) {
            // 예외가 발생하면 로그를 남기거나 오류를 처리합니다.
            log_message('error', 'orderSendExcelUpload processing file: ' . $file . '. Error: ' . $e->getMessage());
        }
        $highestRow = $worksheet->getHighestRow(); // 스프레드시트의 최대 행 수를 가져옵니다.

        //택배사 배송코드가져오기
        $delivery_company_list = get_delivery_company_list();

        //발송처리 하는부분
        $orderData = [];
        $orderModel = new OrderModel();
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/ShippingInfo";
        $now = date('Y-m-d h:i:s ', time());

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $orderModel = new OrderModel();

        $startRow = 2;
        if ($startRow <= $highestRow) {
            foreach ($worksheet->getRowIterator($startRow) as $row) {
                $cellIterator = $row->getCellIterator('A'); // 'B'열부터 시작
                $cellIterator->setIterateOnlyExistingCells(FALSE);

                $rowData = [];
                $aValue = null;
                $bValue = null;
                $cValue = null;

                foreach ($cellIterator as $cell) {
                    $column = $cell->getColumn();
                    $value = $cell->getValue();

                    if ($column == $orderNo_row) {
                        $aValue = $value;
                    } elseif ($column == $TakbaeName_row) {
                        $bValue = $value;
                    } elseif($column == $NoSongjang_row){
                        $cValue = $value;
                    }

                    $rowData[strtolower($column)] = $value;
                }

                $this->data['api_data'] = [];
                $orderData['result'] = $orderModel->getOrderInfoByOrderNo($aValue);
                $companyNo = '';
                foreach ($delivery_company_list as $index => $delivery_data) {
                    if($bValue == $delivery_data['name']){
                        $companyNo = $delivery_data['code'];
                    }
                }

                $this->data['api_data'] = [
                    "orderNo" => $aValue,
                    "ShippingDate" => $now,
                    "DeliveryCompanyCode" => $companyNo,
                    "InvoiceNo" => $cValue,
                    "TakbaeName" => $bValue,
                ];

                if($orderData['result']['SiteType'] == 2){
                    $this->data['api_type'] = GM;
                    $this->data['api_data']['siteType'] = 2;
                }else if($orderData['result']['SiteType'] == 1){
                    $this->data['api_type'] = AC;
                    $this->data['api_data']['siteType'] = 1;
                }

                if ((empty($bValue) || $bValue == 'F') && (empty($cValue) || $cValue == 'F')) {
                    break; // B와 C가 동시에 빈 값이거나 'F'이면 루프 중지
                }

                // mb_id와 mb_level 체크
                if(isset($post['member']['mb_id']) && isset($post['member']['mb_level'])){
                    $mb_id = $post['member']['mb_id'];
                    $mb_level = (int)$post['member']['mb_level'];
                }


                if($orderData['result']['mb_id'] != $mb_id && $mb_level < 9){
                    $result['body']['Message'] = '자신의 주문번호가 아닙니다.'.$mb_level;
                    log_message('error','OrderSendExcelUpload 실행 :  member - '.$orderData['result']['mb_id'].'|'. print_r($post['member'],true));
                }else{
                    $result = $orderModel->getOrder($this->data);
                    //성공 ResultCode = 0
                    if(!$result['body']['ResultCode']){
                        $result['body']['result'] = $orderModel->setOrderSendByOrderNo($this->data['api_data']);
                        log_message('error','OrderSendExcelUpload 실행 :  $get_data - ' . print_r($result['body'],true));
                    }else{
                        log_message('error','OrderSendExcelUpload 실행 :  $result[body] - ' . print_r($result['body'],true));
                    }
                }

                $result['body']['aValue'] = $aValue;
                $result['body']['bValue'] = $bValue;
                $result['body']['cValue'] = $cValue;
                $jsonData[] = $result['body'];
            }
        }


        //return $this->response->setJSON($jsonData);

        return view('order/send_excel_list',$jsonData);

    }

    // api 발송처리orderDeliEditModal
    public function OrderDeliProgress($idx = 0){

        $resultData = ['result' => false];
        $post = $this->data;
        if(!$idx){
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/Progress";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo
        ];

        if($orderData['result']['SiteType'] == 2){
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        }else if($orderData['result']['SiteType'] == 1){
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if(!$result['body']['ResultCode']){
            //$result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('error','OrderDeliProgress 실행 :  $get_data - ' . print_r($result['body'],true));
        }else{
            log_message('error','OrderDeliProgress 실행 :  $result[body] - ' . print_r($result['body'],true));
        }

        return $this->response->setJSON($result);

    }

}