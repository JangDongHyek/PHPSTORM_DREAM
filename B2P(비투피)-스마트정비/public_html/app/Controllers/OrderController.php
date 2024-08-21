<?php

namespace App\Controllers;

use App\Libraries\JlModel;
use App\Models\GmAc\OrderModel;
use App\Models\UserModel;
use App\Models\GmarketApiModel;
use App\Models\GmAc\GoodsModel;
use CodeIgniter\Model;
use Config\Services;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OrderController extends BaseController
{

    public function message($to = 'World')
    {
        echo "Hello {$to}!" . PHP_EOL;
    }

    /**
     * ************************************************************************************************
     *                                        페이지 리스트 start
     * ************************************************************************************************
     */

    /**
     * B2P 신규주문 리스트를 보여줍니다
     */
    public function Newlist()
    {
        $this->data['pid'] = 'new_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'new_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        return view('order/new_list', $this->data);
    }

    /**
     * B2P 발송처리 리스트를 보여줍니다
     */
    public function Sendlist()
    {
        $this->data['pid'] = 'send_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'send_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        //$this->data['order_send_data'] = $orderModel->getSendList($getData);
        $this->data['delivery_company_list'] = get_delivery_company_list();

        return view('order/send_list', $this->data);
    }

    /**
     * B2P 배송중완료 리스트를 보여줍니다
     */
    public function Deliverlist()
    {
        $this->data['pid'] = 'deliver_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'OrderStatus' => $this->data['OrderStatus'],
            'list_category' => 'deliver_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        //$this->data['order_data'] = $orderModel->getList($getData);
        return view('order/deliver_list', $this->data);
    }

    /**
     * B2P 구매결정완료 리스트를 보여줍니다
     */
    public function Confirmlist()
    {
        $this->data['pid'] = 'confirm_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'confirm_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        return view('order/confirm_list', $this->data);
    }

    /**
     * B2P 취소관리 리스트를 보여줍니다
     */
    public function Cancellist()
    {
        $this->data['pid'] = 'cancel_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'cancel_list',
            'CancelStatus' => $this->data['CancelStatus'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['cancel_data'] = $orderModel->getJoinlList($getData, 'order_cancel_list');

        return view('order/cancel_list', $this->data);
    }

    /**
     * B2P 반품관리 리스트를 보여줍니다
     */
    public function Returnlist()
    {
        $this->data['pid'] = 'return_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'return_list',
            'ReturnStatus' => $this->data['ReturnStatus'],
            'return_IsFastRefund' => $this->data['return_IsFastRefund'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['return_data'] = $orderModel->getJoinlList($getData, 'order_return_list');
        return view('order/return_list', $this->data);
    }

    /**
     * B2P 교환관리 리스트를 보여줍니다
     */
    public function Exchangelist()
    {
        $this->data['pid'] = 'exchange_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'exchange_list',
            'ExchangeStatus' => $this->data['ExchangeStatus'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['exchange_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        return view('order/exchange_list', $this->data);
    }


    /**
     * ESM Trading API 주문 목록 가져오기
     *
     * @param int $orderStatus 가져올 주문상태
     * 0 : 주문번호로 조회
     * 1 : 결제완료 (주문 확인전)
     * 2 : 배송준비중 (주문 확인완료)
     * 3 : 배송중 (발송처리건)
     * 4 : 배송완료
     * 5 : 구매결정완료
     * 6 : 장바구니(결제)번호로 조회 (G마켓만 가능).
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    public function GetOrder($orderStatus = 1, $api_type = 'GM')
    {
        $benchmark = Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Order/RequestOrders";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-29Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

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

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $orderModel = new OrderModel();

        if ($result['body']['Data']['RequestOrders'][0]) {
            $SiteType = $result['body']['Data']['SiteType'];
            foreach ($result['body']['Data']['RequestOrders'] as $get_data) {
                $get_data['SiteType'] = $SiteType;
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setOrder($get_data);
                $orderModel->sendOrderSMS($result2['type'],$get_data);

                //log_message('error','cron : GetOrder실행 :  $get_data - ' . print_r($get_data,true));
            }
        } else {
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * 주문목록 가져오기
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function GetOrderByIdx($idx = 0)
    {

        $resultData = ['result' => false];
        $post = $this->data;
        if (!$idx) {
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $resultData['result'] = $orderModel->getOrderInfoByIdx($idx);


        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($resultData);
        }
    }

    /**
     * Join테이블 주문목록 가져오기
     */
    public function GetJoinOrderByIdx()
    {

        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];
        $join_table = $post['join_table'];

        $result = [];
        if (!$idx) {
            $result['body']['Message'] = 'idx값이 없습니다.';
            return $this->response->setJSON($result);
        }

        $orderModel = new OrderModel();

        $data = [
            "idx" => $idx,
            "join_table" => $join_table
        ];

        $resultData['result'] = $orderModel->getJoinOrderInfo($data);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($resultData);
        }
    }

    /**
     * ESM Trading API 주문취소 목록 가져오기
     * Type : 2 날짜기간으로 검색 (최대 7일)
     *
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    // api주문목록 가져오기
    public function GetOrderCancel($api_type = 'GM')
    {
        $benchmark = Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Cancels";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-6Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $this->data['api_data'] = [
            "CancelStatus" => 0,
            "Type" => 2,
            "StartDate" => $time_start,
            //"Type" => 0,
            //"OrderNo" => '4178933689',
            "EndDate" => $time_end
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $orderModel = new OrderModel();

        //오아시스 취소하는부분
        $userModel = new UserModel;

        //log_message('pay', 'cron : GetOrder실행 : api_data - ' . print_r($this->data['api_data'], true));

        if ($result['body']['Data'][0]) {
            $SiteType = $result['body']['Data']['SiteType'];
            foreach ($result['body']['Data'] as $get_data) {
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setOrderCancel($get_data);

                //오아시스 취소
                $resveCancel = $userModel->resveCancel($get_data['OrderNo']);
                log_message('error','cron : GetOrderCancel실행 :  $resveCancel - ' . print_r($resveCancel,true));
                //log_message('error','cron : GetOrderCancel실행 :  $result2 - ' . print_r($result2,true));
            }
        } else {
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 주문반품 목록 가져오기
     * Type : 2 날짜기간으로 검색 (최대 7일)
     *
     * @param int $ReturnStatus 가져올 주문반품 상태
     * 1 : 반품요청
     * 2 : 반품수거완료
     * 3 : 반품환불보류
     * 4 : 반품환불완료
     * 5 : 반품철회
     * 6 : 사이트 직권 환불건(반품완료건 중, 고객센터에서 환불처리한 Case)
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    public function GetOrderReturn($ReturnStatus = 1, $api_type = 'GM')
    {
        $benchmark = Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Returns";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-6Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $this->data['api_data'] = [
            "ReturnStatus" => $ReturnStatus,
            "Type" => 2,
            "StartDate" => $time_start,
            "EndDate" => $time_end
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $orderModel = new OrderModel();

        //오아시스 취소하는부분
        $userModel = new UserModel;

        //log_message('error','cron : GetOrderReturn :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {
            foreach ($result['body']['Data'] as $get_data) {
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setOrderReturn($get_data);

                //오아시스 취소
                $resveCancel = $userModel->resveCancel($get_data['OrderNo']);
                log_message('error','cron : GetOrderReturn :  $resveCancel - ' . print_r($resveCancel,true));

                //log_message('error', 'cron : GetOrderReturn :  $get_data - ' . print_r($get_data, true));
                //log_message('error', 'cron : GetOrderReturn :  $result2 - ' . print_r($result2, true));
            }
        } else {
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 주문교환 목록 가져오기
     * Type : 2 날짜기간으로 검색 (최대 7일)
     *
     * @param int $ExchangeStatus 가져올 주문반품 상태
     * 1 : 교환요청/교환물품반송중
     * 2 : 교환수거완료
     * 3 : 교환보류
     * 4 : 교환완료
     * 5 : 교환철회
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    public function GetOrderExchange($ExchangeStatus = 1, $api_type = 'GM')
    {
        $benchmark = Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Exchanges";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-6Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $this->data['api_data'] = [
            "ExchangeStatus" => $ExchangeStatus,
            "Type" => 2,
            "StartDate" => $time_start,
            "EndDate" => $time_end
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $orderModel = new OrderModel();
        //오아시스 취소하는부분
        $userModel = new UserModel;

        //log_message('error','cron : GetOrderReturn :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {
            foreach ($result['body']['Data'] as $get_data) {
                $result2 = $orderModel->setOrderExchange($get_data);

                //오아시스 취소
                $resveCancel = $userModel->resveCancel($get_data['OrderNo']);
                log_message('error','cron : GetOrderExchange :  $resveCancel - ' . print_r($resveCancel,true));
            }
        } else {
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 주문교환 목록 가져오기
     * SearchDateConditionType : 1 결제일자로 검색 (최대 7일)
     * 필요없어보여서 일단 패스
     */
    public function GetOrderDeliveryStatus()
    {
        $benchmark = Services::timer();
        $benchmark->start('render view');

        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/GetDeliveryStatus";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-6Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $this->data['api_data'] = [
            "orderNo" => 0,
            "SearchDateConditionType" => 1,
            "FromDate" => $time_start,
            "ToDate" => $time_end,
            "Page" => 1
        ];
        $api_type = 'GM';
        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $orderModel = new OrderModel();
        //log_message('error','cron : GetOrderReturn :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {
            foreach ($result['body']['Data'] as $get_data) {
                //$request_orders = json_encode($get_data);
                //$result2 = $orderModel->setOrderDeliveryStatus($get_data);
                log_message('error', 'cron : GetOrderDeliveryStatus :  $get_data - ' . print_r($get_data, true));
                log_message('error', 'cron : GetOrderDeliveryStatus :  $result2 - ' . print_r($result2, true));
            }
        } else {
            //log_message('error','cron : GetOrder실행 :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }
        $benchmark->stop('render view');
        $timers = $benchmark->getTimers();
        //log_message('error','cron : GetOrder실행 :  $timers - ' . print_r($timers,true));
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 정산 목록 가져오기
     *
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    public function GetSettleOrder($api_type = 'GM')
    {
        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/account/v1/settle/getsettleorder";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-29Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        /* SrchType
         * D1 : 입금확인일 -정상
         * D2 : 배송일 -정상
         * D3 : 배송완료일 -정상
         * D4 : 구매결정일 -정상
         * D5 : 정산예정일
         * D6 : 송금일(당일데이터는 영업일 기준 D+1일 조회가능함)
         * D7 : 환불일 -환불
         * D8 : 입금확인일+환불일(지마켓), 송금일 + 송금취소일 (옥션)
         * D9 : 배송완료일(옥션은 매출기준일) + 배송완료일 있는 환불일
         */
        $this->data['api_data'] = [
            "SrchStartDate" => $time_start,
            "SrchEndDate" => $time_end,
            "SrchType" => 'D2',
            "PageNo" => 1,
            "PageRowCnt" => 100
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 'G';
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 'A';
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $orderModel = new OrderModel();
        log_message('alert','cron : GetSettleOrder :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {
            $SiteType = $result['body']['Data']['SiteType'];
            $ResultCode = $result['body']['Data']['ResultCode'];
            $Message = $result['body']['Data']['Message'];
            foreach ($result['body']['Data'] as $get_data) {
                $get_data['SiteType'] = $SiteType;
                $get_data['ResultCode'] = $ResultCode;
                $get_data['Message'] = $Message;
                $result2 = $orderModel->setSettleOrder($get_data);
            }
        } else {
            //log_message('error','cron : GetSettleOrder :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 미수령신고조회
     * SearchType : 1 미수령신고일 조회 (최대 7일)
     */
    // api주문목록 가져오기
    public function GetClaimList($idx = 0)
    {
        $result = [];
        $post = $this->data;

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/ClaimList";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-6Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "SearchType" => 1,
            "StartDate" => $time_start,
            "EndDate" => $time_end
        ];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //log_message('alert', 'cron : GetClaimList : api_data - ' . print_r($this->data['api_data'], true));

        if ($result['body']['Data'][0]) {
            $SiteType = $result['body']['Data']['SiteType'];
            foreach ($result['body']['Data'] as $get_data) {
                //$request_orders = json_encode($get_data);
                $result2 = $orderModel->setClaim($get_data);
                //log_message('alert','cron : GetClaimList :  $get_data - ' . print_r($get_data,true));
                //log_message('alert','cron : GetClaimList :  $result2 - ' . print_r($result2,true));
            }
        } else {
            //log_message('error','cron : GetClaimList :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 미수령신고조회 크론버전
     * 배송중,배송완료 상품들만 미수령신고 체크해주기
     */
    // api주문목록 가져오기
    public function GetClaimList_cron()
    {
        $orderModel = new OrderModel();
        $result = $orderModel->getOrderDeliverInfo();

        foreach ($result['list'] as $row){
            $this->GetClaimList($row['idx']);
        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * 정산목록 가져오기
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function getCalc($OrderNo) {
        $model_config = array(
            "table" => "order_settle_list",
            "primary" => "idx",
            "autoincrement" => true,
            "empty" => false
        );

        $model = new JlModel($model_config);

        $model->where("ContrNo",$OrderNo);
        $data = $model->get();

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($data);
        }
    }
    /**
     * ************************************************************************************************
     *                                        페이지 리스트 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        발송관리 start
     * ************************************************************************************************
     */

    /**
     * B2P 발주서 출력을 보여줍니다.
     *
     * @param int $idx 발주서를 보여줄 order_list의 idx주문번호.
     */
    public function OrderPrint($idx = 0)
    {

        $post = $this->data;
        if (!$idx) {
            $idx = $post['OrderPrint_idx'];
        }

        $orderModel = new OrderModel();
        $words = explode(',', $idx);
        for ($i = 0; $i < count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);
            //array_push($resultData['result'][$i],$orderModel->getOrderInfoByIdx($idx));
        }
        //$resultData['result'] = $orderModel->getOrderInfoByIdx($idx);

        //return $this->response->setJSON($resultData);
        return view('order/order_print', $resultData);
    }

    /**
     * B2P 라벨인쇄를 보여줍니다.
     *
     * @param int $idx 발주서를 보여줄 order_list의 idx주문번호.
     */
    public function OrderLabelPrint($idx = 0)
    {

        $post = $this->data;
        if (!$idx) {
            $idx = $post['OrderLabelPrint_idx'];
        }

        $orderModel = new OrderModel();
        $words = explode(',', $idx);
        for ($i = 0; $i < count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);
            //array_push($resultData['result'][$i],$orderModel->getOrderInfoByIdx($idx));
        }
        //$resultData['result'] = $orderModel->getOrderInfoByIdx($idx);

        //return $this->response->setJSON($resultData);
        return view('order/order_label_print', $resultData);
    }
    /**
     * ************************************************************************************************
     *                                        발송관리 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        배송현황 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 미수령신고 철회요청
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderClaimRelease()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        log_message('alert','OrderClaimRelease 실행 :  $post - ' . print_r($post,true));
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Delivery/ClaimRelease";
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ClaimCancelType" => $post['ClaimCancelType'],
        ];


        $this->data['api_data']['DeliveryCompCode'] = $post['DeliveryCompCode'];
        $this->data['api_data']['InvoiceNo'] = $post['InvoiceNo'];
        $this->data['api_data']['CancelComment'] = $post['CancelComment'];

        if($post['ClaimCancelType'] == 1 && !$post['DeliveryCompCode'] ){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '택배사를 선택해주세요.';
            return $this->response->setJSON($result);
        }

        if($post['ClaimCancelType'] == 1 &&  !$post['InvoiceNo'] ){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '송장번호를 입력해주세요.';
            return $this->response->setJSON($result);
        }

        if($post['ClaimCancelType'] == 2 && !$post['CancelComment']){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '철회요청 메시지를 입력해주세요';
            return $this->response->setJSON($result);
        }



        log_message('alert', 'OrderClaimRelease 실행 :  api_data - ' . print_r($this->data['api_data'], true));

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            //$this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            //$this->data['api_data']['siteType'] = 1;
        }


        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('alert', 'OrderClaimRelease 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setClaimRelease($result['api_data']);
            log_message('alert', 'OrderClaimRelease 실행 :  $get_data - ' . print_r($result['body'], true));
            log_message('alert','OrderClaimRelease 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            log_message('alert', 'OrderClaimRelease 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }
    /**
     * ************************************************************************************************
     *                                        배송현황 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        신규주문 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 주문확인
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderCheck($idx = 0)
    {
        $orderData = [];

        $post = $this->data;
        if (!$idx) {
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/shipping/v1/Order/OrderCheck/" . $OrderNo;
        $this->data['api_data'] = [];


        $this->data['api_data'] = [
            "orderNo" => $OrderNo
        ];


        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($OrderNo);
            //log_message('error','OrderCheck실행 :  $get_data - ' . print_r($result['body'],true));
        } else {

            if ($result['body']['Message'] == '이미 주문확인 처리된 건입니다.') {
                $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($OrderNo);
            }

            if ($result['body']['Message'] == '취소된 주문번호입니다.') {
                $result['body']['result'] = $orderModel->setOrderCheckCancelByOrderNo($OrderNo);
            }

            //log_message('error','OrderCheck실행 :  $result[body] - ' . print_r($result['body'],true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 배송예정일 등록
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderShippingExpectedDate($idx = 0)
    {
        $orderData = [];

        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        //log_message('error','ShippingExpectedDate 실행 :  $post - ' . print_r($post,true));
        if (!$idx) {
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];
        if ($orderData['result']['ShippingExpectedDate'] != '0000-00-00' && $orderData['result']['ShippingExpectedDate'] != '') {
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

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            log_message('error', 'ShippingExpectedDate 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            log_message('error', 'ShippingExpectedDate 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }
    /**
     * ************************************************************************************************
     *                                        신규주문 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        발송관리 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 발송처리
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderSend($idx = 0)
    {
        $orderData = [];

        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        if (!$idx) {
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

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $result['api_data']['OrderNo'] = $OrderNo;

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo($this->data['api_data']);
            log_message('error', 'OrderSend 실행 :  $get_data - ' . print_r($result['body'], true));
            //log_message('error','OrderSend 실행 :  data - ' . print_r($this->data,true));
        } else {
            log_message('error', 'OrderSend 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * 자동 주문확인
     * 발송마감일 지나면 상태변경
     */
    public function OrderSendTransDueDate()
    {
        $orderData = [];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->setOrderSendByTransDueDate();
        //log_message('error','cron : OrderSendTransDueDate 실행 :' . print_r($orderData,true));

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($orderData);
        }
    }

    /**
     * ESM Trading API 발송처리
     */
    public function OrderDeliEdit()
    {
        $orderData = [];
        $post = $this->data['data_arr'];

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


        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('error', 'OrderDeliEdit 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('error', 'OrderDeliEdit 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 발송처리 엑셀업로드
     */
    public function OrderSendExcelUpload()
    {
        $post = $this->data;
        $file = $this->request->getFile('OrderSendExcelFile');

        $orderNo_row = $post['selOrderNoCell'];
        $TakbaeName_row = $post['selDeliveryCompCell'];
        $NoSongjang_row = $post['selInvoiceCell'];

        if (empty($file)) {
            return; // 파일이 없으면 작업을 종료합니다.
        }

        $kilobytes = $file->getSizeByUnit('kb'); // 250.880
        if ($kilobytes > 750) {

            $result['body']['aValue'] = 'error';
            $result['body']['bValue'] = $kilobytes;
            $result['body']['cValue'] = 'kb';
            $result['body']['Message'] = '파일 크기가 750kb를 넘습니다.';
            $jsonData[] = $result['body'];

            return view('order/send_excel_list', $jsonData);
        }
        // 엑셀 파일을 로드하고 작업을 수행합니다.
        try {
            $spreadsheet = IOFactory::load($file->getTempName());
            $worksheet = $spreadsheet->getActiveSheet();
        } catch (Exception $e) {
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
                    } elseif ($column == $NoSongjang_row) {
                        $cValue = $value;
                    }

                    $rowData[strtolower($column)] = $value;
                }

                $this->data['api_data'] = [];
                $orderData['result'] = $orderModel->getOrderInfoByOrderNo($aValue);
                $companyNo = '';
                foreach ($delivery_company_list as $index => $delivery_data) {
                    if ($bValue == $delivery_data['name']) {
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

                if ($orderData['result']['SiteType'] == 2) {
                    $this->data['api_type'] = GM;
                    $this->data['api_data']['siteType'] = 2;
                } else if ($orderData['result']['SiteType'] == 1) {
                    $this->data['api_type'] = AC;
                    $this->data['api_data']['siteType'] = 1;
                }

                if ((empty($bValue) || $bValue == 'F') && (empty($cValue) || $cValue == 'F')) {
                    break; // B와 C가 동시에 빈 값이거나 'F'이면 루프 중지
                }

                // mb_id와 mb_level 체크
                if (isset($post['member']['mb_id']) && isset($post['member']['mb_level'])) {
                    $mb_id = $post['member']['mb_id'];
                    $mb_level = (int)$post['member']['mb_level'];
                }


                if ($orderData['result']['mb_id'] != $mb_id && $mb_level < 9) {
                    $result['body']['Message'] = '자신의 주문번호가 아닙니다.' . $mb_level;
                    log_message('error', 'OrderSendExcelUpload 실행 :  member - ' . $orderData['result']['mb_id'] . '|' . print_r($post['member'], true));
                } else {
                    $result = $orderModel->getOrder($this->data);
                    //성공 ResultCode = 0
                    if (!$result['body']['ResultCode']) {
                        $result['body']['result'] = $orderModel->setOrderSendByOrderNo($this->data['api_data']);
                        log_message('error', 'OrderSendExcelUpload 실행 :  $get_data - ' . print_r($result['body'], true));
                    } else {
                        log_message('error', 'OrderSendExcelUpload 실행 :  $result[body] - ' . print_r($result['body'], true));
                    }
                }

                $result['body']['aValue'] = $aValue;
                $result['body']['bValue'] = $bValue;
                $result['body']['cValue'] = $cValue;
                $jsonData[] = $result['body'];
            }
        }


        //return $this->response->setJSON($jsonData);

        return view('order/send_excel_list', $jsonData);

    }
    /**
     * ************************************************************************************************
     *                                        발송관리 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        배송현황 start
     * ************************************************************************************************
     */

    /**
     * 자동 구매결정완료
     * 배송중(28일 뒤) ,배송완료(8일 뒤)
     */
    public function OrderDeliTransDueDate()
    {
        $orderData = [];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->setOrderDeliByTransDueDate();
        //log_message('error','cron : OrderDeliTransDueDate 실행 :' . print_r($orderData,true));
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($orderData);
        }
    }

    /**
     * ESM Trading API 배송 진행 정보 조회
     */
    public function OrderDeliProgress($idx = 0)
    {

        $resultData = ['result' => false];
        $post = $this->data;
        if (!$idx) {
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

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            //$result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            //log_message('error','OrderDeliProgress 실행 :  $get_data - ' . print_r($result['body'],true));
        } else {
            log_message('error', 'OrderDeliProgress 실행 :  $result[body] - ' . print_r($result['body'], true));
        }


        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }
    /**
     * ************************************************************************************************
     *                                        배송현황 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        취소관리 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 판매취소
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderCancelSoldOut()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];

        if(!$idx){
            $result['api_data']['orderNo'] = $idx;
            $result['body']['Message'] = '상품번호가 없습니다.'.$post;
            return $this->response->setJSON($result);
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $orderData['goods_result'] = $orderModel->getGoodsInfoByIdx($orderData['result']['SiteGoodsNo']);
        $OrderNo = $orderData['result']['OrderNo'];
        $goods_no = $orderData['goods_result']['goods_no'];

        //log_message('alert', 'OrderCancelSoldOut 실행 :  $post - ' . print_r($post, true));

        $result = [];
        if($orderData['result']['OrderStatus'] > 2){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '발송 처리 전 상품만 취소 가능합니다.';
            return $this->response->setJSON($result);
        }

        if(!$OrderNo){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '주문번호가 없습니다.';
            return $this->response->setJSON($result);
        }

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Cancel/{$OrderNo}/SoldOut";
        $this->data['api_data'] = [
            "orderNo" => $OrderNo
        ];



        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $goodsModel = new GoodsModel();
        $result = $apiModel->getOrder($this->data);
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        //log_message('alert', 'OrderCancelSoldOut  :  $result - ' . print_r($result, true));

        $SoldOutData = [
            "OrderNo" => $OrderNo,
            "CancelReason" => $post['cancelSoldOutReason']
        ];

        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderCancelSoldOut($SoldOutData);
            log_message('alert', 'OrderCancelSoldOut 실행 여기 :  $SoldOutData - ' . print_r($SoldOutData, true));
            log_message('alert', 'OrderCancelSoldOut 실행 여기 :  $result - ' . print_r($result, true));
            //상품 바로 판매중지하는곳

            $goods_api = [];
            $goods_api['api_type'] = GMAC;
            $goods_api['api_method'] = "GET";
            $goods_api['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$goods_no}";
            $result2 = $goodsModel->callApi($goods_api);
            if(!empty($result2['body'])){
                // 데이터가 있으면 즉시 db업데이트
                $goodsData = json_decode($result2['body'], true);
                $goodsData['w'] = 'u';
                $goodsData['goods_no'] = $goods_no;
                $good = $goodsModel->updateGoods($goodsData);
            }

        } else {
            log_message('alert', 'OrderCancelSoldOut 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 취소처리
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderCancelCheck($idx = 0)
    {
        $resultData = ['result' => false];
        $post = $this->data;
        if (!$idx) {
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

        $this->data['api_method'] = "PUT";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Cancel/".$OrderNo;
        $this->data['api_data'] = [];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('error', 'OrderCancelCheck 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderCancelCheckByOrderNo($OrderNo);
            log_message('error', 'OrderCancelCheck 실행 :  $get_data - ' . print_r($result['body'], true));
            log_message('error','OrderCancelCheck 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            log_message('error', 'OrderCancelCheck 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }
    /**
     * ************************************************************************************************
     *                                        취소관리 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        반품관리 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 반품처리
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderReturnCheck($idx = 0)
    {
        $resultData = ['result' => false];
        $post = $this->data;
        if (!$idx) {
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

        $this->data['api_method'] = "PUT";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/return/{$OrderNo}";
        $this->data['api_data'] = [
            "OrderNo" => $OrderNo
        ];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $result['api_data']['OrderNo'] = $OrderNo;
        $result['api_data']['api_url'] = $this->data['api_url'];
        $result['api_data']['api_method'] = $this->data['api_method'];
        log_message('alert', 'OrderReturnCheck 실행 :  $result - ' . print_r($result, true));
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderReturnCheckByOrderNo($OrderNo);
            log_message('alert', 'OrderReturnCheck 실행 :  $get_data - ' . print_r($result['body'], true));
            log_message('alert','OrderReturnCheck 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            log_message('alert', 'OrderReturnCheck 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 반품보류
     */
    public function OrderReturnHold()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/return/{$OrderNo}/hold";

        if(!$post['ReturnShippingFee']){
            $post['ReturnShippingFee'] = 0;
        }

        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "HoldReason" => (int)$post['HoldReason'],
            "HoldReasonDetail" => $post['HoldReasonDetail'],
            "ReturnShippingFee" => $post['ReturnShippingFee']
        ];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('alert', 'OrderReturnHold 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderReturnHoldByOrderNo($OrderNo);
        } else {
            //log_message('error', 'OrderReturnSelf 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 판매자 직접 반품 신청
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderReturnSelf($idx = 0)
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        //log_message('error','OrderSend 실행 :  $post - ' . print_r($post,true));
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];
        if($orderData['result']['SiteType'] != 2){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '지마켓만 가능한 기능입니다.';
            return $this->response->setJSON($result);
        }

        $OrderReturnCheck = $post['returnSelfModal_OrderReturnCheck'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Return/{$OrderNo}/Request";
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "payNo" => $orderData['result']['PayNo'],
            "reason" => $post['reason'],
            "itemStatus" => $post['itemStatus'],
            "alreadySent" => $post['alreadySent'] ? true : false,
            "pickupCompCode" => $post['pickupCompCode'],
            "invoiceNo" => $post['invoiceNo']
        ];

        log_message('error', 'OrderReturnSelf 실행 :  api_data - ' . print_r($this->data['api_data'], true));

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('error', 'OrderReturnSelf 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            //바로환불시 반품확인api 호출
            if($OrderReturnCheck){
                $this->OrderReturnCheck($idx);
            }
            //$result['body']['result'] = $orderModel->setOrderReturnSelf($result);
        } else {
            //log_message('error', 'OrderReturnSelf 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : GetOrder실행 :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 반품건 교환전환
     */
    public function OrderReturnExchange()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];
        if($orderData['result']['SiteType'] == 1 && !$post['InvoiceNo']){
            $result['api_data']['OrderNo'] = $OrderNo;
            $result['body']['Message'] = '옥션은 재배송 송장번호가 필수입니다.';
            return $this->response->setJSON($result);
        }

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/return/{$OrderNo}/exchange";
        $this->data['api_data'] = [
            "OrderNo" => $OrderNo,
            "DeliveryCompCode" => $post['DeliveryCompCode'],
            "InvoiceNo" => $post['InvoiceNo']
        ];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('error', 'OrderReturnExchange 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderReturnExchange($this->data['api_data']);

            log_message('error', 'OrderReturnExchange 실행 :  $get_data - ' . print_r($result['body'], true));
            log_message('error','OrderReturnExchange 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            log_message('error', 'OrderReturnExchange 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : OrderReturnExchange :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 반품수거 송장등록
     */
    public function OrderReturnDeliEdit()
    {
        $orderData = [];
        $post = $this->data['data_arr'];

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
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/return/{$OrderNo}/pickup";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ShippingDate" => $now,
            "DeliveryCompanyCode" => $post['companyNo'],
            "DeliveryCompCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
            "TakbaeName" => $post['TakbaeName'],
        ];


        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('error', 'OrderReturnDeliEdit 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('error', 'OrderReturnDeliEdit 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }
    /**
     * ************************************************************************************************
     *                                        반품관리 end
     * ************************************************************************************************
     */


    /**
     * ************************************************************************************************
     *                                        교환관리 start
     * ************************************************************************************************
     */

    /**
     * ESM Trading API 교환수거 송장등록
     */
    public function OrderExchangeDeliEdit()
    {
        $orderData = [];
        $post = $this->data['data_arr'];

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
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/pickup";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "ShippingDate" => $now,
            "DeliveryCompanyCode" => $post['companyNo'],
            "DeliveryCompCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
            "TakbaeName" => $post['TakbaeName'],
        ];


        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('error', 'OrderExchangeDeliEdit 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('error', 'OrderExchangeDeliEdit 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 교환건 반품전환
     */
    public function OrderExchangeReturn()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $result = [];
        if($orderData['result']['SiteType'] == 1 && !$post['InvoiceNo']){
            $result['api_data']['OrderNo'] = $OrderNo;
            $result['body']['Message'] = '옥션은 재배송 송장번호가 필수입니다.';
            return $this->response->setJSON($result);
        }

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/return";
        $this->data['api_data'] = [
            "OrderNo" => $OrderNo,
            "DeliveryCompCode" => $post['DeliveryCompCode'],
            "InvoiceNo" => $post['InvoiceNo']
        ];

        if ($orderData['result']['SiteType'] == 2) {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 2;
        } else if ($orderData['result']['SiteType'] == 1) {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 1;
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        log_message('error', 'OrderExchangeReturn 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderExchangeReturn($this->data['api_data']);

            log_message('error', 'OrderExchangeReturn 실행 :  $get_data - ' . print_r($result['body'], true));
            log_message('error','OrderExchangeReturn 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            log_message('error', 'OrderExchangeReturn 실행 :  $result[body] - ' . print_r($result['body'], true));
        }

        //log_message('error','cron : OrderExchangeReturn :  $orderStatus - ' . $orderStatus . ' $api_type ' . $api_type);

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }
    /**
     * ************************************************************************************************
     *                                        교환관리 end
     * ************************************************************************************************
     */




}