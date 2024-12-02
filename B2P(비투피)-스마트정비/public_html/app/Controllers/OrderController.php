<?php

namespace App\Controllers;

use App\Libraries\JlModel;
use App\Models\GmAc\OrderModel;
use App\Models\JungbiModel;
use App\Models\UserModel;
use App\Models\GmarketApiModel;
use App\Models\GmAc\GoodsModel;
use CodeIgniter\Model;
use Config\Services;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;


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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'new_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        return view('order/new_list', $this->data);
    }

    /**
     * B2P 신규주문 엑셀다운로드
     */
    public function NewlistExcelDown()
    {
        // 출력 버퍼링 시작
        ob_start();
        $this->data['pid'] = 'new_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'new_list',
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '주문일자', '주문번호', '구매자명', '구매자ID',
            '상품번호', '상품명', '수량', '주문옵션', '추가구성', '사은품', '사은품 관리코드',
            '덤', '덤 관리코드', '판매단가', '판매금액', '판매자 관리코드', '구매자 휴대폰',
            '구매자 전화번호', '수령인명', '수령인 휴대폰', '수령인 전화번호', '우편번호',
            '주소', '배송시 요구사항','배송비 결제방법', '배송비', '추가배송비', '배송번호', '발송정책',
            'SKU번호 및 수량', '배송점포', '장바구니번호(결제번호)', '결제완료일', '발송마감일',
            '정산예정금액', '서비스이용료', '판매자쿠폰할인', '구매쿠폰적용금액',
            '(옥션)우수회원할인', '복수구매할인', '스마일캐시적립'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['order_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];
            $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];
            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분 (옥션 또는 G마켓)
                $OrderStatus[$row['OrderStatus']], // 주문 상태 (신규주문, 발송대기중, 배송중 등)
                get_dateformat($row['OrderDate']), // 주문일자
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['BuyerId'], // 구매자ID
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션 (선택된 옵션)
                $ItemOptionAdditionList_html, // 추가구성 (추가 옵션)
                $row['FreeGift'], // 사은품 (무료로 제공된 상품)
                $row['FreeGiftCode'], // 사은품 관리코드
                $row['Bonus'], // 덤 (추가로 제공된 상품)
                $row['BonusCode'], // 덤 관리코드
                number_format((int)$row['SalePrice']), // 판매단가 (상품의 개당 가격)
                number_format((int)$row['OrderAmount']), // 판매금액 (총 주문 금액)
                $row['OutGoodsNo'], // 판매자 관리코드 (판매자가 관리하는 상품 코드)
                $row['BuyerMobileTel'], // 구매자 휴대폰번호
                $row['BuyerTel'], // 구매자 전화번호
                $row['ReceiverName'], // 수령인명 (상품을 받을 사람의 이름)
                $row['HpNo'], // 수령인 휴대폰번호
                $row['TelNo'], // 수령인 전화번호
                $row['order_b2pZip'] ? $row['order_b2pZip'] : $row['ZipCode'], // 우편번호 (배송지)
                // 배송 주소 (order_b2pAutoDelFullAddress가 있으면 사용, 없으면 DelFullAddress 사용)
                $row['order_b2pAutoDelFullAddress'] ? $row['order_b2pAutoDelFullAddress'] : $row['DelFullAddress'],
                $row['DelMemo'], // 배송시 요구사항 (배송 메모)
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']), // 배송비
                // 추가배송비 (제주 및 도서산간 추가 배송비)
                number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']),
                $row['GroupNo'], // 배송번호
                $TransType[$row['TransType']] ?? '스마일배송', // 발송유형 (당일발송, 순차발송 등)
                $row['SKUNo'], // SKU 번호 (재고 관리 코드)
                $row['BranchCode'], // 지점 코드 (상품이 출발하는 지점 코드)
                $row['PayNo'], // 장바구니번호 (결제번호)
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['TransDueDate']), // 발송예정일
                number_format((int)$row['SettlementPrice'] - $b2p_cost), // 정산예정금액 (정산 금액에서 비용을 뺀 값)
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료 (서비스 수수료에 추가 비용 포함)
                number_format((int)$row['SellerDiscountPrice']), // 판매자 쿠폰 할인
                number_format((int)$row['DirectDiscountPrice']), // 구매자 쿠폰 적용 금액
                number_format((int)$row['GreatMembDcAmnt']), // 우수회원 할인 (옥션)
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매 할인
                number_format((int)$row['SellerCashbackMoney']) // 스마일캐시 적립 (구매자에게 적립된 금액)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        // 파일명 설정
        $filename = 'newList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');
    }

    /**
     * B2P 발송관리 리스트를 보여줍니다
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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'send_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        //$this->data['order_send_data'] = $orderModel->getSendList($getData);
        $this->data['delivery_company_list'] = get_delivery_company_list();

        return view('order/send_list', $this->data);
    }

    /**
     * B2P 발송관리 엑셀다운로드
     */
    public function sendExcelDown()
    {
        // 출력 버퍼링 시작
        ob_start();
        $this->data['pid'] = 'send_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'send_list',
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '주문일자(결제확인전)', '주문번호', '수령인명', '구매자명',
            '발송마감일', '발송예정일', '택배사명', '송장번호', '상품번호', '상품명',
            '수량', '주문옵션', '추가구성', '사은품', '사은품 관리코드', '덤', '덤 관리코드',
            '판매단가', '판매금액', '판매자 관리코드', '수령인 휴대폰', '수령인 전화번호',
            '우편번호', '주소', '배송시 요구사항', '배송비 결제방법', '배송비', '추가배송비', '배송번호',
            '배송지연사유', 'SKU번호 및 수량', '구매자ID', '구매자 휴대폰', '구매자 전화번호',
            '장바구니번호(결제번호)', '결제완료일', '주문확인일자', '발송예정일', '정산예정금액',
            '서비스이용료', '판매자쿠폰할인', '구매쿠폰적용금액', '(옥션)우수회원할인',
            '복수구매할인', '스마일캐시적립', '판매자북캐시적립', '제휴사명'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['order_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];
            $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];
            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];
            $orderDelayReasons = ['1' => '상품준비중(재고부족)','2' => '고객요청','3' => '기타'];
            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                $row['OrderNo'], // 주문번호
                $row['ReceiverName'], // 수령인명
                $row['BuyerName'], // 구매자명
                get_dateformat($row['TransDueDate']), // 발송마감일
                get_dateformat($row['ShippingExpectedDate']), // 발송예정일
                $row['TakbaeName'], // 택배사명
                $row['NoSongjang'], // 송장번호
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                $row['FreeGiftCode'], // 사은품 관리코드
                $row['Bonus'], // 덤
                $row['BonusCode'], // 덤 관리코드
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                $row['OutGoodsNo'], // 판매자 관리코드
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['order_b2pZip'] ? $row['order_b2pZip'] : $row['ZipCode'], // 우편번호
                $row['order_b2pAutoDelFullAddress'] ? $row['order_b2pAutoDelFullAddress'] : $row['DelFullAddress'], // 주소
                $row['DelMemo'], // 배송시 요구사항
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']), // 배송비
                number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']), // 추가배송비
                $row['GroupNo'], // 배송번호
                $orderDelayReasons[$row['ReasonType']].$row['ReasonDetail'], // 배송지연사유 (데이터가 없는 경우 빈 값)
                $row['SKUNo'], // SKU번호 및 수량
                $row['BuyerId'], // 구매자ID
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['TransDueDate']), // 발송예정일
                number_format((int)$row['SettlementPrice'] - $b2p_cost), // 정산예정금액
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['DirectDiscountPrice']), // 구매쿠폰적용금액
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-', // 판매자북캐시적립 (데이터가 없는 경우 빈 값)
                '-' // 제휴사명 (데이터가 없는 경우 빈 값)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);


        }


        if(!$this->data['order_data']){
            //$sheet->fromArray('데이터가 없습니다.', NULL, 'A1');
        }

        // 파일명 설정
        $filename = 'sendList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');
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
            'page' =>  $this->data['page'],
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'OrderStatus' => $this->data['OrderStatus'],
            'list_category' => 'deliver_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        //$this->data['order_data'] = $orderModel->getList($getData);
        return view('order/deliver_list', $this->data);
    }

    /**
     * B2P 발송관리 엑셀다운로드
     */
    public function DeliverExcelDown(){
        // 출력 버퍼링 시작
        ob_start();
        $this->data['pid'] = 'deliver_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'OrderStatus' => $this->data['OrderStatus'],
            'list_category' => 'deliver_list',
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '발송일자', '배송상태', '주문번호', '구매자명',
            '구매자ID', '수령인명', '택배사명(발송방법)', '송장번호', '상품번호', '상품명',
            '수량', '주문옵션', '추가구성', '사은품', '사은품 관리코드', '덤', '덤 관리코드',
            '판매단가', '판매금액', '판매자 관리코드', '구매자 휴대폰', '구매자 전화번호',
            '수령인 휴대폰', '수령인 전화번호', '우편번호', '주소', '배송시 요구사항', '배송비 결제방법', '배송비',
            '추가배송비', '배송지연사유', 'SKU번호 및 수량', '상품미수령 신고일자',
            '상품미수령 신고사유', '상품미수령 상세사유', '상품미수령 철회일자',
            '상품미수령 이의제기일자', '재배송 택배사명', '재배송 운송장번호',
            '재배송 우편번호', '재배송 주소', '장바구니번호(결제번호)', '결제완료일',
            '주문일자(결제확인전)', '주문확인일자', '발송예정일', '정산예정금액', '서비스이용료',
            '판매자쿠폰할인', '구매쿠폰적용금액', '(옥션)우수회원할인', '복수구매할인',
            '스마일캐시적립', '판매자북캐시적립', '제휴사명'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['order_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];
            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
            $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];
            $orderDelayReasons = ['1' => '상품준비중(재고부족)','2' => '고객요청','3' => '기타'];

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $ResendInfo = json_decode($row['exchange_ResendInfo'], true);
            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                get_dateformat($row['TransDate']), // 발송일자
                $OrderStatus[$row['OrderStatus']], // 배송상태
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['BuyerId'], // 구매자ID
                $row['ReceiverName'], // 수령인명
                $row['TakbaeName'] . ' (' . ($TransType[$row['TransType']] ?? '스마일배송') . ')', // 택배사명(발송방법)
                $row['NoSongjang'], // 송장번호
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                $row['FreeGiftCode'], // 사은품 관리코드
                $row['Bonus'], // 덤
                $row['BonusCode'], // 덤 관리코드
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                $row['OutGoodsNo'], // 판매자 관리코드
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['order_b2pZip'] ? $row['order_b2pZip'] : $row['ZipCode'], // 우편번호
                $row['order_b2pAutoDelFullAddress'] ? $row['order_b2pAutoDelFullAddress'] : $row['DelFullAddress'], // 주소
                $row['DelMemo'], // 배송시 요구사항
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']), // 배송비
                number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']), // 추가배송비
                $orderDelayReasons[$row['ReasonType']].$row['ReasonDetail'], // 배송지연사유
                $row['SKUNo'], // SKU번호 및 수량
                get_dateformat($row['ClaimDate']), // 상품미수령 신고일자
                $row['ClaimReason'], // 상품미수령 신고사유
                $row['ClaimList_Message'], // 상품미수령 상세사유
                get_dateformat($row['ClaimSolveDate']), // 상품미수령 철회일자
                get_dateformat($row['Claim_up_datetime']), // 상품미수령 이의제기일자
                $ResendInfo['DeliveryCompName'] ?? '', // 재배송 택배사명
                $ResendInfo['InvoiceNo'] ?? '', // 재배송 운송장번호
                $ResendInfo['ReceiverInfo']['ZipCode'] ?? '', // 재배송 우편번호
                $ResendInfo['ReceiverInfo']['Address'] ?? '', // 재배송 주소
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['TransDueDate']), // 발송예정일
                number_format((int)$row['SettlementPrice'] - $b2p_cost), // 정산예정금액
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['DirectDiscountPrice']), // 구매쿠폰적용금액
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-', // 판매자북캐시적립 (데이터가 없는 경우 빈 값)
                '-' // 제휴사명 (데이터가 없는 경우 빈 값)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        if (!$this->data['order_data']['list']) {
            // 데이터가 없을 경우 메시지 출력
            $sheet->setCellValue('A2', '데이터가 없습니다.');
        }

        // 파일명 설정
        $filename = 'deliverList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');
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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'confirm_list',
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        return view('order/confirm_list', $this->data);
    }

    /**
     * B2P 구매결정완료 엑셀다운로드
     */
    public function ConfirmExcelDown(){

        // 출력 버퍼링 시작
        ob_start();
        $this->data['pid'] = 'confirm_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'confirm_list',
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['order_data'] = $orderModel->getList($getData);

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '구매결정일자', '정산상태','정산예정일','정산완료일', '주문번호', '구매자명',
            '구매자ID', '수령인명', '상품번호', '상품명', '수량', '주문옵션', '추가구성',
            '사은품', '사은품 관리코드', '덤', '덤 관리코드', '판매단가', '판매금액',
            '판매자 관리코드', '정산예정금액', '서비스이용료', '판매자쿠폰할인', '구매쿠폰적용금액',
            '(옥션)우수회원할인', '복수구매할인', '스마일캐시적립', '판매자북캐시적립', '제휴사명',
            '구매자 휴대폰', '구매자 전화번호', '수령인 휴대폰', '수령인 전화번호',
            '택배사명(발송방법)', '송장번호', '배송비 결제방법', '추가배송비', '배송번호', 'SKU번호 및 수량',
            '장바구니번호(결제번호)', '주문일자(결제확인전)', '주문확인일자', '결제완료일',
            '발송일자', '배송완료일자', '정산완료일자'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['order_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];
            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
            $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];
            $now = date('Y-m-d'); // 현재 날짜 (형식: YYYY-MM-DD)
            $futureDate = date('Y-m-d', strtotime($row['BuyDecisionDate'] . ' +4 days'));

            //정산예정,완료 날짜 계산식
            $buyDecisionDate = $row['BuyDecisionDate']; // 'Y-m-d' 형식의 날짜 문자열이라고 가정
            $startDate = new \DateTime($buyDecisionDate);

            // 4일 동안 포함된 주말 수 계산
            $weekendCount = 0;
            $tempDate = new \DateTime($buyDecisionDate);

            $tempDate->modify('+4 day');

            if ($tempDate->format('N') == 6) { // 6 = 토요일, 7 = 일요일
                $weekendCount++;
                $weekendCount++;
            }
            if ($tempDate->format('N') == 7) { // 6 = 토요일, 7 = 일요일
                $weekendCount++;
            }

            // 기본적으로 4일을 더함
            $startDate->modify('+4 days');

            // 주말이 포함되었으면 추가로 2일 더함
            if ($weekendCount > 0) {
                $startDate->modify('+' . $weekendCount . ' days');
            }

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                get_dateformat($row['BuyDecisionDate']), // 구매결정일자
                $futureDate > $now ? '정산예정' : '정산완료', // 정산상태
                $startDate->format('Y-m-d'), // 정산예정일
                $startDate->format('Y-m-d H:i:s'), // 정산완료일
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['BuyerId'], // 구매자ID
                $row['ReceiverName'], // 수령인명
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                $row['FreeGiftCode'], // 사은품 관리코드
                $row['Bonus'], // 덤
                $row['BonusCode'], // 덤 관리코드
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                $row['OutGoodsNo'], // 판매자 관리코드
                number_format((int)$row['SettlementPrice'] - $b2p_cost), // 정산예정금액
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['DirectDiscountPrice']), // 구매쿠폰적용금액
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-', // 판매자북캐시적립 (데이터가 없는 경우 빈 값)
                '-', // 제휴사명 (데이터가 없는 경우 빈 값)
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['TakbaeName'] . ' (' . ($TransType[$row['TransType']] ?? '스마일배송') . ')', // 택배사명(발송방법)
                $row['NoSongjang'], // 송장번호
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']) . '/' . number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']), // 추가배송비
                $row['GroupNo'], // 배송번호
                $row['SKUNo'], // SKU번호 및 수량
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['TransDate']), // 발송일자
                get_dateformat($row['TransCompleteDate']), // 배송완료일자
                '-' // 정산완료일자 (데이터가 없는 경우 빈 값)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        if (!$this->data['order_data']['list']) {
            // 데이터가 없을 경우 메시지 출력
            $sheet->setCellValue('A2', '데이터가 없습니다.');
        }

        // 파일명 설정
        $filename = 'confirmList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');
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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'cancel_list',
            'CancelStatus' => $this->data['CancelStatus'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['cancel_data'] = $orderModel->getJoinlList($getData, 'order_cancel_list');
        $this->data['cancel_data'] = $orderModel->getMemberDataList($this->data['cancel_data']); //회원정보 넣어주는곳

        return view('order/cancel_list', $this->data);
    }

    /**
     * B2P 취소관리 엑셀다운로드
     */
    public function CancelExcelDown()
    {
        // 출력 버퍼링 시작
        ob_start();

        $this->data['pid'] = 'cancel_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'cancel_list',
            'CancelStatus' => $this->data['CancelStatus'],
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['cancel_data'] = $orderModel->getJoinlList($getData, 'order_cancel_list');
        $this->data['cancel_data'] = $orderModel->getMemberDataList($this->data['cancel_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['cancel_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '아이디', '취소요청일', '취소상태', '주문번호', '구매자명',
            '구매자ID', '취소사유', '상세취소사유', '취소완료일', '상품번호', '상품명',
            '수량', '주문옵션', '추가구성', '사은품', '판매단가', '판매금액', '판매자 관리코드',
            '구매자 휴대폰', '구매자 전화번호', '수령인 휴대폰', '수령인 전화번호',
            '우편번호', '주소', '배송시 요구사항', '택배사명(발송방법)', '배송번호', '배송비 결제방법', '배송비',
            '배송지연사유', 'SKU번호 및 수량', '미수령신고일자', '상품미수령철회요청일자',
            '상품미수령이의제기일자', '장바구니번호(결제번호)', '주문일자(결제확인전)',
            '주문확인일자', '발송예정일', '서비스이용료', '판매자쿠폰할인',
            '(옥션)우수회원할인', '복수구매할인', '스마일캐시적립', '제휴사명'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['cancel_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];

            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
            $CancelStatus = [1 => '취소요청', 2 => '취소중', 3 => '취소완료', 4 => '취소철회', 5 => '사이트 직권환불 (고객센터 환불처리)', 6 => '거래완료 후 환불 (송금 후 취소)'];
            $cancel_Reason = [0 => '판매자귀책', 1 => '구매자귀책', 2 => '기타 고객'];
            $cancel_ReasonCode = [0 => '기타', 1 => '단순변심', 2 => '사이즈/색상 등 변경', 3 => '오배송', 4 => '상품미도착', 5 => '상품불량', 6 => '재고없음(판매자요청)', 7 => '선물수락기한만료', 8 => '선물거절'];
            $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];
            $orderDelayReasons = ['1' => '상품준비중(재고부족)','2' => '고객요청','3' => '기타'];

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                $row['BuyerId'], // 아이디
                get_dateformat($row['cancel_RequestDate']), // 취소요청일
                $CancelStatus[$row['CancelStatus']], // 취소상태
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['BuyerId'], // 구매자ID
                $cancel_Reason[$row['cancel_Reason']] . ' / ' . $cancel_ReasonCode[$row['cancel_ReasonCode']], // 취소사유
                ($row['CancelReason'] ? $row['CancelReason'] . '<br>' : '') . $row['cancel_ReasonDetail'], // 상세취소사유
                get_dateformat($row['cancel_CompleteDate']), // 취소완료일
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                $row['OutGoodsNo'], // 판매자 관리코드
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['order_b2pZip'] ? $row['order_b2pZip'] : $row['ZipCode'], // 우편번호
                $row['order_b2pAutoDelFullAddress'] ? $row['order_b2pAutoDelFullAddress'] : $row['DelFullAddress'], // 주소
                $row['DelMemo'], // 배송시 요구사항
                $row['TakbaeName'] . ' (' . ($TransType[$row['TransType']] ?? '스마일배송') . ')', // 택배사명(발송방법)
                $row['GroupNo'] . ' / ' . $row['NoSongjang'], // 배송번호 및 송장번호
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']) . ' / ' . number_format((int)$row['BackwoodsAddDeliveryFee']) . ' / ' . number_format((int)$row['JejuAddDeliveryFee']), // 추가배송비
                $orderDelayReasons[$row['ReasonType']].$row['ReasonDetail'], // 배송지연사유
                $row['SKUNo'], // SKU번호 및 수량
                get_dateformat($row['ClaimDate']), // 미수령신고일자
                get_dateformat($row['ClaimSolveDate']), // 상품미수령 철회일자
                get_dateformat($row['Claim_up_datetime']), // 상품미수령 이의제기일자
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['ShippingExpectedDate']), // 발송예정일
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-' // 제휴사명 (데이터가 없는 경우 빈 값)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        if (!$this->data['cancel_data']['list']) {
            // 데이터가 없을 경우 메시지 출력
            $sheet->setCellValue('A2', '데이터가 없습니다.');
        }

        // 파일명 설정
        $filename = 'cancelList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');

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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'return_list',
            'ReturnStatus' => $this->data['ReturnStatus'],
            'return_IsFastRefund' => $this->data['return_IsFastRefund'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['return_data'] = $orderModel->getJoinlList($getData, 'order_return_list');
        $this->data['return_data'] = $orderModel->getMemberDataList($this->data['return_data']); //회원정보 넣어주는곳


        return view('order/return_list', $this->data);
    }

    /**
     * B2P 반품관리 엑셀다운로드
     */
    public function ReturnExcelDown()
    {
        // 출력 버퍼링 시작
        ob_start();

        $this->data['pid'] = 'return_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'return_list',
            'ReturnStatus' => $this->data['ReturnStatus'],
            'return_IsFastRefund' => $this->data['return_IsFastRefund'],
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['return_data'] = $orderModel->getJoinlList($getData, 'order_return_list');
        $this->data['return_data'] = $orderModel->getMemberDataList($this->data['return_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['return_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '아이디', '반품신청일', '반품상태', '주문번호', '구매자명',
            '상품번호', '상품명', '수량', '주문옵션', '추가구성', '사은품', '판매단가', '판매금액',
            '서비스이용료', '판매자 관리코드', '반품사유', '상세사유', '상품상태', '보상상태',
            '빠른환불여부', '반품수거택배사명', '반품송장번호', '최초배송비부담', '반품배송비지불주체',
            '반품배송비금액', '반품추가비지불주체', '반품추가비금액', '원배송택배사명(발송방법)',
            '원배송송장번호', '배송비 결제방법', '추가배송비금액', '배송번호', 'SKU번호 및 수량', '구매자ID',
            '구매자 휴대폰', '구매자 전화번호', '수령인명', '수령인 휴대폰', '수령인 전화번호',
            '배송시 요구사항', '장바구니번호(결제번호)', '결제완료일', '주문일자(결제확인전)',
            '주문확인일자', '발송일자', '배송완료일자', '수거완료일', '환불보류일', '환불보류사유',
            '환불보류해제일', '환불승인일', '(A)거래완료 후 환불', '판매자쿠폰할인',
            '구매쿠폰적용금액', '(옥션)우수회원할인', '복수구매할인', '스마일캐시적립', '제휴사명'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['return_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];

            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
            $ReturnStatus = [1 => '반품요청', 2 => '반품수거완료', 3 => '반품환불보류', 4 => '반품환불완료', 5 => '반품철회', 6 => '사이트'];
            $return_Reason = [0 => '판매자귀책', 1 => '구매자귀책', 2 => '기타 고객'];
            $return_ReasonCode = [0 => '기타', 1 => '단순변심', 2 => '사이즈/색상 등 변경', 3 => '오배송', 4 => '상품미도착', 5 => '상품불량', 6 => '재고없음(판매자요청)'];
            $return_GoodsStatus = [0 => '알수없음', 1 => '포장 개봉미사용', 2 => '포장개방사용', 3 => '미개봉'];
            $return_FastRefundRewardStatus = [0 => '상태없음', 1 => '보상요청', 2 => '보상검토중', 3 => '보상완료', 4 => '보상불가', 5 => '보상요청취소'];
            $return_WhoReturnShippingFee = [1 => '사이트 부담', 2 => '구매자 부담', 3 => '판매자 부담', 4 => '구매자 부분 부담'];
            $return_WhoAddReturnShippingFee = [1 => '사이트 부담', 2 => '구매자 부담', 3 => '판매자 부담'];
            $HoldInfo_Reason = [0 => '기타유보사유', 1 => '추가반품비청구 (기타반품비)', 4 => '반품미입고'];

            $PickupInfo = json_decode($row['return_PickupInfo'], true);
            $ShippingInfo = json_decode($row['return_ShippingInfo'], true);
            $HoldInfo = json_decode($row['return_HoldInfo'], true);

            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                $row['BuyerId'], // 아이디
                get_dateformat($row['return_RequestDate']), // 반품신청일
                $ReturnStatus[$row['return_ReturnStatus']], // 반품상태
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $row['ContrAmount'], // 수량
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                $row['OutGoodsNo'], // 판매자 관리코드
                $return_Reason[$row['return_Reason']] . ' / ' . $return_ReasonCode[$row['return_ReasonCode']], // 반품사유
                $row['return_ReasonDetail'], // 상세사유
                $return_GoodsStatus[$row['return_GoodsStatus']], // 상품상태
                $return_FastRefundRewardStatus[$row['return_FastRefundRewardStatus']], // 보상상태
                $row['return_IsFastRefund'] ? 'Y' : 'N', // 빠른환불여부
                $PickupInfo['DeliveryCompName'] ?? '', // 반품수거택배사명
                $PickupInfo['InvoiceNo'] ?? '', // 반품송장번호
                $ShippingInfo['ShippingFee'] ?? '', // 최초배송비부담
                $return_WhoReturnShippingFee[$row['return_WhoReturnShippingFee']], // 반품배송비지불주체
                number_format((int)$row['return_ReturnShippingFee']), // 반품배송비금액
                $return_WhoAddReturnShippingFee[$row['return_WhoAddReturnShippingFee']], // 반품추가비지불주체
                number_format((int)$row['return_AddReturnShippingFee']), // 반품추가비금액
                $ShippingInfo['DeliveryCompName'] ?? '', // 원배송택배사명(발송방법)
                $ShippingInfo['InvoiceNo'] ?? '', // 원배송송장번호
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']) . '/' . number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']), // 추가배송비
                $row['GroupNo'], // 배송번호
                $row['SKUNo'], // SKU번호 및 수량
                $row['BuyerId'], // 구매자ID
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['ReceiverName'], // 수령인명
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['DelMemo'], // 배송시 요구사항
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['TransDate']), // 발송일자
                get_dateformat($row['TransCompleteDate']), // 배송완료일자
                get_dateformat($PickupInfo['CompleteDate']), // 수거완료일
                get_dateformat($HoldInfo['HoldDate']), // 환불보류일
                $HoldInfo_Reason[$HoldInfo['Reason']] ?? '', // 환불보류사유
                get_dateformat($HoldInfo['FeeDate']), // 환불보류해제일
                get_dateformat($row['return_ApproveDate']), // 환불승인일
                '-', // (A)거래완료 후 환불 (데이터 없음)
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['DirectDiscountPrice']), // 구매쿠폰적용금액
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-' // 제휴사명 (데이터 없음)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        if (!$this->data['return_data']['list']) {
            // 데이터가 없을 경우 메시지 출력
            $sheet->setCellValue('A2', '데이터가 없습니다.');
        }

        // 파일명 설정
        $filename = 'returnList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');

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
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'exchange_list',
            'ExchangeStatus' => $this->data['ExchangeStatus'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();
        $this->data['exchange_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        $this->data['exchange_data'] = $orderModel->getMemberDataList($this->data['exchange_data']); //회원정보 넣어주는곳

        return view('order/exchange_list', $this->data);
    }

    /**
     * B2P 교환관리 엑셀다운로드
     */
    public function ExchangeExcelDown()
    {
        // 출력 버퍼링 시작
        ob_start();

        $this->data['pid'] = 'exchange_list';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => 1,
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'list_category' => 'exchange_list',
            'ExchangeStatus' => $this->data['ExchangeStatus'],
            'items_per_page' => 999999
        ];

        $orderModel = new OrderModel();
        $this->data['exchange_data'] = $orderModel->getJoinlList($getData, 'order_exchange_list');
        $this->data['exchange_data'] = $orderModel->getMemberDataList($this->data['exchange_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['exchange_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 시트의 헤더 설정
        $headers = [
            '회사명','담당자명','셀러ID', '구분', '구분상태', '아이디', '교환신청일', '교환상태', '주문번호', '구매자명',
            '상품번호', '상품명', '주문옵션', '추가구성', '사은품', '수량', '판매단가', '판매금액',
            '서비스이용료', '판매자관리코드', '교환접수채널', '교환사유', '상세사유', '교환보류일',
            '교환보류사유', '교환수거택배사명', '교환수거송장번호', '최초배송비부담', '교환배송비금액',
            '교환배송비지불주체', '재발송택배사명', '재발송송장번호', '재발송지 우편번호', '재발송지 주소',
            '원배송택배사명(발송방법)', '원배송송장번호', '배송비 결제방법', '배송금액', '배송번호', 'SKU번호 및 수량',
            '구매자ID', '구매자 휴대폰', '구매자 전화번호', '수령인명', '수령인 휴대폰', '수령인 전화번호',
            '우편번호', '주소', '배송시 요구사항', '장바구니번호(결제번호)', '결제완료일', '주문일자(결제확인전)',
            '주문확인일자', '발송일자', '배송완료일자', '교환보류해제일', '교환수거완료일', '교환재발송일',
            '교환재배송 배송완료일', '서비스이용료', '판매자쿠폰할인', '구매쿠폰적용금액', '(옥션)우수회원할인',
            '복수구매할인', '스마일캐시적립', '제휴사명'
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 추가
        $rowNum = 2; // 엑셀의 2번째 줄부터 데이터 시작
        foreach ($this->data['exchange_data']['list'] as $row) {
            //$b2p_cost = (int)$row['OrderAmount'] * 0.05;
            $b2p_cost = (int)$row['b2p_cost'];

            $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
            $ExchangeStatus = [1 => '교환요청/교환물품반송중', 2 => '교환수거완료', 3 => '교환보류', 4 => '교환완료', 5 => '교환철회'];
            $exchange_ApproveUser = [0 => '없음', 1 => '구매자', 2 => '판매자' , 3 => '고객센터' , 5 => '기타'];
            $exchange_Reason = [0 => '판매자귀책', 1 => '구매자귀책', 2 => '기타 고객'];
            $exchange_ReasonCode = [0 => '기타', 1 => '단순변심', 2 => '사이즈/색상 등 변경', 3 => '오배송', 4 => '상품미도착', 5 => '상품불량', 6 => '재고없음(판매자요청)'];
            $WhoExchangeShippingFee = [1 => '사이트 부담', 2 => '구매자 부담', 3 => '판매자 부담', 4 => '무료반품쿠폰사용'];
            $HoldInfo_Reason = [0 => '기타유보사유', 1 => '추가반품비청구 (기타반품비)', 4 => '반품미입고'];

            $PickupInfo = json_decode($row['exchange_PickupInfo'], true);
            $ShippingInfo = json_decode($row['exchange_ShippingInfo'], true);
            $HoldInfo = json_decode($row['exchange_HoldInfo'], true);
            $ResendInfo = json_decode($row['exchange_ResendInfo'], true);


            if ($row['ItemOptionSelectList']){
                $data2 = json_decode($row['ItemOptionSelectList']);
                $ItemOptionSelectList_html = '';
                $data2_count = 1;
                foreach ($data2 as $ItemOptionSelectList){
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '';
                    $ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '' : '';
                    //$ItemOptionSelectList_html .= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '';
                    $ItemOptionSelectList_html .= PHP_EOL;
                    $data2_count++;
                }
            }

            if ($row['ItemOptionAdditionList']){
                $data3 = json_decode($row['ItemOptionAdditionList']);
                $ItemOptionAdditionList_html = '';
                $data3_count = 1;
                foreach ($data3 as $ItemOptionAdditionList){
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '';
                    $ItemOptionAdditionList_html .= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '';
                    $ItemOptionAdditionList_html .= PHP_EOL;
                    $data3_count++;
                }
            }

            $DeliveryFeeCondition = ['M' => '선불','R' => '선불','F' => '선불','D' => '착불','X' => '선불','S' => '선불','W' => '착불','Q' => '착불','C' => '착불'];

            $data = [
                $row['cp_name'], // 회사명
                $row['mb_name'], // 담당자명
                $row['mb_id'], // 셀러ID
                ($row['SiteType'] == 1) ? '옥션' : 'G마켓', // 구분
                $OrderStatus[$row['OrderStatus']], // 구분상태
                $row['BuyerId'], // 아이디
                get_dateformat($row['exchange_RequestDate']), // 교환신청일
                $ExchangeStatus[$row['exchange_ExchangeStatus']], // 교환상태
                $row['OrderNo'], // 주문번호
                $row['BuyerName'], // 구매자명
                $row['SiteGoodsNo'], // 상품번호
                $row['order_b2pAutoCar'] ? '('.$row['carNo'].','.$row['repairName'].','.$row['carName'].')'.PHP_EOL.$row['GoodsName'] : $row['GoodsName'], // 상품명
                $ItemOptionSelectList_html, // 주문옵션
                $ItemOptionAdditionList_html, // 추가구성
                $row['FreeGift'], // 사은품
                $row['ContrAmount'], // 수량
                number_format((int)$row['SalePrice']), // 판매단가
                number_format((int)$row['OrderAmount']), // 판매금액
                number_format((int)$row['ServiceFee']), // 서비스이용료
                $row['OutGoodsNo'], // 판매자 관리코드
                $exchange_ApproveUser[$row['exchange_ApproveUser']], // 교환접수채널
                $exchange_Reason[$row['exchange_Reason']] . ' / ' . $exchange_ReasonCode[$row['exchange_ReasonCode']], // 교환사유
                $row['exchange_ReasonDetail'], // 상세사유
                $HoldInfo['HoldDate'] ?? '', // 교환보류일
                $HoldInfo_Reason[$HoldInfo['Reason']] ?? '', // 교환보류사유
                $PickupInfo['DeliveryCompName'] ?? '', // 교환수거택배사명
                $PickupInfo['InvoiceNo'] ?? '', // 교환수거송장번호
                $ShippingInfo['ShippingFee'] ?? '', // 최초배송비부담
                number_format((int)$row['exchange_ExchangeShippingFee']), // 교환배송비금액
                $WhoExchangeShippingFee[$row['exchange_WhoExchangeShippingFee']] ?? '', // 교환배송비지불주체
                $ResendInfo['DeliveryCompName'] ?? '', // 재발송택배사명
                $ResendInfo['InvoiceNo'] ?? '', // 재발송송장번호
                $ResendInfo['ReceiverInfo']['ZipCode'] ?? '', // 재발송지 우편번호
                $ResendInfo['ReceiverInfo']['Address'] ?? '', // 재발송지 주소
                $ShippingInfo['DeliveryCompCode'] ?? '', // 원배송택배사명(발송방법)
                $ShippingInfo['InvoiceNo'] ?? '', // 원배송송장번호
                array_key_exists($row['DeliveryFeeCondition'], $DeliveryFeeCondition) ? $DeliveryFeeCondition[$row['DeliveryFeeCondition']] : '',
                number_format((int)$row['ShippingFee']) . '/' . number_format((int)$row['BackwoodsAddDeliveryFee']) . '/' . number_format((int)$row['JejuAddDeliveryFee']), // 배송금액
                $row['GroupNo'], // 배송번호
                $row['SKUNo'], // SKU번호 및 수량
                $row['BuyerId'], // 구매자ID
                $row['BuyerMobileTel'], // 구매자 휴대폰
                $row['BuyerTel'], // 구매자 전화번호
                $row['ReceiverName'], // 수령인명
                $row['HpNo'], // 수령인 휴대폰
                $row['TelNo'], // 수령인 전화번호
                $row['order_b2pZip'] ? $row['order_b2pZip'] : $row['ZipCode'], // 우편번호
                $row['order_b2pAutoDelFullAddress'] ? $row['order_b2pAutoDelFullAddress'] : $row['DelFullAddress'], // 주소
                $row['DelMemo'], // 배송시 요구사항
                $row['PayNo'], // 장바구니번호(결제번호)
                get_dateformat($row['PayDate']), // 결제완료일
                get_dateformat($row['OrderDate']), // 주문일자(결제확인전)
                get_dateformat($row['OrderConfirmDate']), // 주문확인일자
                get_dateformat($row['TransDate']), // 발송일자
                get_dateformat($row['TransCompleteDate']), // 배송완료일자
                get_dateformat($HoldInfo['FreeDate'] ?? ''), // 교환보류해제일
                get_dateformat($PickupInfo['CompleteDate'] ?? ''), // 교환수거완료일
                get_dateformat($ResendInfo['ResendDate'] ?? ''), // 교환재발송일
                get_dateformat($ResendInfo['CompleteDate'] ?? ''), // 교환재배송 배송완료일
                number_format((int)$row['ServiceFee'] + $b2p_cost), // 서비스이용료
                number_format((int)$row['SellerDiscountPrice']), // 판매자쿠폰할인
                number_format((int)$row['DirectDiscountPrice']), // 구매쿠폰적용금액
                number_format((int)$row['GreatMembDcAmnt']), // (옥션)우수회원할인
                number_format((int)$row['MultiBuyDcAmnt']), // 복수구매할인
                number_format((int)$row['SellerCashbackMoney']), // 스마일캐시적립
                '-' // 제휴사명 (데이터가 없는 경우 빈 값)
            ];

            // 각 행에 데이터 추가
            $sheet->fromArray($data, NULL, 'A' . $rowNum++);
        }

        if (!$this->data['exchange_data']['list']) {
            // 데이터가 없을 경우 메시지 출력
            $sheet->setCellValue('A2', '데이터가 없습니다.');
        }

        // 파일명 설정
        $filename = 'exchangeList_' . date('Ymd') . '.xlsx';

        // 파일 다운로드 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // 출력 버퍼 플러시
        ob_end_clean();

        // 파일을 다운로드 형태로 출력
        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');

    }

    /**
     * B2P 주문통합검색 리스트를 보여줍니다
     */
    public function Searchlist()
    {
        $this->data['pid'] = 'order_search';

        $getData = [
            'member' => $this->data['member'],
            'sfl' => $this->data['sfl'],
            'stx' => $this->data['stx'],
            'sdt' => $this->data['sdt'],
            'edt' => $this->data['edt'],
            'page' => $this->data['page'],
            'SiteType' => $this->data['SiteType'],
            'list_sql' => $this->data['list_sql'],
            'items_per_page' => $this->data['items_per_page'] ? $this->data['items_per_page'] : 10
        ];

        $orderModel = new OrderModel();

        //$this->data['order_data'] = $orderModel->getList($getData);
        $this->data['order_data'] = $orderModel->getJoinlList($getData, 'order_settle_list');
        $this->data['order_data'] = $orderModel->getMemberDataList($this->data['order_data']); //회원정보 넣어주는곳

        $jungbiModel = new JungbiModel();
        $this->data['order_data'] = $jungbiModel->getReservDataList($this->data['order_data']);

        return view('order/order_search',$this->data);
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

                // 기존 데이터를 가져옴
                $orderData = $orderModel->getOrderInfoByOrderNo($get_data['OrderNo']);

                // 업데이트 함
                $result2 = $orderModel->setOrder($get_data);

                // 값이 없으면 신규?
                if(empty($orderData)){
                    $smsRe = $orderModel->sendOrderSMS($orderStatus, $get_data);
                } else {
                    // 기존데이터가 배송완료전이면서 배송완료가 되었을때
                    if($orderData['OrderStatus'] < 4 && $orderStatus == 4){
                        $smsRe = $orderModel->sendOrderSMS($orderStatus, $get_data);
                    }
                }




                //log_message('error','cron : GetOrder실행111111 :  $get_data - ' . print_r($get_data,true));
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

        $jungbiModel = new JungbiModel();
        $resultData['result'] = $jungbiModel->getReservData($resultData['result']);


        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($resultData);
        }
    }

    /**
     * 주문목록 가져오기
     *
     * @param int $OrderNo order_list의 주문번호.
     */
    public function GetOrderByOrderNo($OrderNo = 0)
    {

        $resultData = ['result' => false];
        $post = $this->data;
        if (!$OrderNo) {
            $OrderNo = $post['OrderNo'];
        }

        $orderModel = new OrderModel();
        $resultData['result'] = $orderModel->getOrderInfoByOrderNo($OrderNo);

        $jungbiModel = new JungbiModel();
        $resultData['result'] = $jungbiModel->getReservData( $resultData['result']);

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

                //바이크 취소
                $bikeData = ['orderNo'=>$get_data['OrderNo'], 'action'=>'delete'];
                $bikeCancel = $userModel->postBadreamApi($bikeData);
                //log_message('error','cron : GetOrderCancel실행 :  $resveCancel - ' . print_r($resveCancel,true));
                //log_message('error','cron : postBadreamApi실행 :  bikeCancel - ' . print_r($bikeCancel,true));
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
                //log_message('error','cron : GetOrderReturn :  $resveCancel - ' . print_r($resveCancel,true));

                //바이크 취소
                $bikeData = ['orderNo'=>$get_data['OrderNo'], 'action'=>'delete'];
                $bikeCancel = $userModel->postBadreamApi($bikeData);
                //log_message('error','cron : postBadreamApi실행 :  bikeCancel - ' . print_r($bikeCancel,true));
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

                //바이크 취소
                $bikeData = ['orderNo'=>$get_data['OrderNo'], 'action'=>'delete'];
                $bikeCancel = $userModel->postBadreamApi($bikeData);
                //log_message('error','cron : GetOrderExchange :  $resveCancel - ' . print_r($resveCancel,true));
                //log_message('error','cron : postBadreamApi실행 :  bikeCancel - ' . print_r($bikeCancel,true));
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
    public function GetSettleOrder($SrchType = 'D1',$api_type = 'GM')
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
            "SrchType" => $SrchType,
            "PageNo" => 1,
            "PageRowCnt" => 200
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 'G';

            $SiteType = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 'A';
            $SiteType = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);
        $orderModel = new OrderModel();
        $esm_category_list = get_esm_category();

        //log_message('alert','cron : GetSettleOrder :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {

            $ResultCode = $result['body']['Data']['ResultCode'];
            $Message = $result['body']['Data']['Message'];
            foreach ($result['body']['Data'] as $get_data) {
                $get_data['SiteType'] = $SiteType;
                $get_data['ResultCode'] = $ResultCode;
                $get_data['Message'] = $Message;
                $get_data['esm_category_list'] = $esm_category_list;
                $get_data['goods_result'] = $orderModel->getGoodsInfoByIdx($get_data['SiteGoodsNo']);
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
     * ESM Trading API 정산 배송비목록 가져오기
     *
     * @param string $api_type 사이트 구분
     * GM : G마켓
     * AC : 옥션
     */
    public function GetSettleDeliveryFee($SrchType = 'D1',$api_type = 'GM')
    {
        $result = [];
        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/account/v1/settle/getsettledeliveryfee";
        $this->data['api_data'] = [];
        $time_start = date('Y-m-d', strtotime('-29Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        /* SrchType
         * D1 : 입금확인일 -정상
         * D3 : 매출마감일(일반적으로는 배송완료일 익일, 환불건일 경우 차이발생 가능)
         * D6 : 송금일(당일데이터는 영업일 기준 D+1일로 조회가능함)
         * D7 : 환불일 -환불
         * D8 : 입금확인일(옥션은 입금확인되었으면서 실제 송금이 발생된 주문건 기준)+환불일
         */
        $this->data['api_data'] = [
            "SrchStartDate" => $time_start,
            "SrchEndDate" => $time_end,
            "SrchType" => $SrchType,
            "PageNo" => 1,
            "PageRowCnt" => 100
        ];

        if ($api_type == 'GM') {
            $this->data['api_type'] = GM;
            $this->data['api_data']['siteType'] = 'G';
            $SiteType = 2;
        } else if ($api_type == 'AC') {
            $this->data['api_type'] = AC;
            $this->data['api_data']['siteType'] = 'A';
            $SiteType = 1;
        }

        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        $orderModel = new OrderModel();
        //log_message('alert','cron : GetSettleDeliveryFee :  $result - ' . print_r($result,true));
        if ($result['body']['Data'][0]) {
            $ResultCode = $result['body']['Data'][0]['ResultCode'];
            $Message = $result['body']['Data'][0]['Message'];
            foreach ($result['body']['Data'] as $get_data) {
                $get_data['SiteType'] = $SiteType;
                $get_data['ResultCode'] = $ResultCode;
                $get_data['Message'] = $Message;
                $result2 = $orderModel->setSettleDeliveryFee($get_data);
            }
        } else {
            //log_message('error','cron : GetSettleDeliveryFee :  $result[body][Data] - ' . print_r($result['body']['Data'],true));
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
            "table" => "order_list",
            "primary" => "idx",
            "autoincrement" => true,
            "empty" => false
        );

        $model = new JlModel($model_config);

        $model->join("order_settle_list","OrderNo","ContrNo");

        $model->where("OrderNo",$OrderNo);
        $data = $model->get(array(
                "sql" => true,
                "select" => array(
                    "SellOrderPrice","OptionPrice","SellerDiscountTotalPrice","TotCommission",
                    "dl_DelFeeAmt","dl_DelFeeCommission","DeductTaxPrice","BuyerPayAmt","category_fee_cost","GoodsCost"
                )
            )
        );

        $order = null;
        if($data['count']) $order = processOrder($data['data'][0]);


        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($order);
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
        $userModel = new UserModel();
        $words = explode(',', $idx);
        for ($i = 0; $i < count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);

            if($resultData['result'][$i]['order_b2pAutoT'] == 'T'){
                $OrderNo = $resultData['result'][$i]['OrderNo'];
                $resultData['result'][$i]['resveData'] = $userModel->getGsResveDataByOrderNoFromDb($OrderNo);
            }
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
        $userModel = new UserModel();
        $words = explode(',', $idx);
        for ($i = 0; $i < count($words); $i++) {
            $resultData['result'][$i] = $orderModel->getOrderInfoByIdx($words[$i]);

            if($resultData['result'][$i]['order_b2pAutoT'] == 'T'){
                $OrderNo = $resultData['result'][$i]['OrderNo'];
                $resultData['result'][$i]['resveData'] = $userModel->getGsResveDataByOrderNoFromDb($OrderNo);
            }
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

        //오토 오아시스상품인지 체크해주는곳
        //$orderData['goods_result'] = $orderModel->getGoodsInfoByIdx($orderData['result']['SiteGoodsNo']);
        $data_arr = [
            "orderNo" => $OrderNo,
            "order_b2pAutoT" => "",
        ];

        //발송관리에서 발송처리할때도 주문확인 한번하니까 신규주문일떄만 작동하게
        if($orderData['result']['OrderStatus'] != 1){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '신규주문만 주문확인이 가능합니다.';
            return $this->response->setJSON($result);
        }

        //if($orderData['goods_result']['b2pAuto'] == 'T'){
        if($orderData['result']['order_b2pAutoT'] == 'T'){
            $userModel = new UserModel();
            $resveData = $userModel->getGsResveDataByOrderNoFromDb($OrderNo);
            log_message('alert','OrderCheck실행 :  $resveData - ' . print_r($resveData,true));
            if($orderData['result']['order_b2pAutoT'] == 'T' && $resveData['data']['resve']['resveAt'] != 'Y'){
                $result['api_data']['orderNo'] = $OrderNo;
                $result['body']['Message'] = '오아시스 상품 예약승인을 완료해주세요.';
                return $this->response->setJSON($result);
            }
        }




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
            $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($data_arr);
            //log_message('error','OrderCheck실행 :  $get_data - ' . print_r($result['body'],true));
        } else {

            if ($result['body']['Message'] == '이미 주문확인 처리된 건입니다.') {
                $result['body']['result'] = $orderModel->setOrderCheckByOrderNo($data_arr);
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

        //오토 오아시스상품인지 체크해주는곳
        $orderData['goods_result'] = $orderModel->getGoodsInfoByIdx($orderData['result']['SiteGoodsNo']);
        //$this->data['api_data']['order_b2pAutoT'] = $orderData['goods_result']['b2pAuto'];

        //if($orderData['goods_result']['b2pAuto'] == 'T'){
        if($orderData['result']['order_b2pAutoT'] == 'T'){
            $userModel = new UserModel();
            $resveData = $userModel->getGsResveDataByOrderNoFromDb($OrderNo);
            log_message('alert','OrderCheck실행 :  $resveData - ' . print_r($resveData,true));
            if($orderData['result']['order_b2pAutoT'] == 'T' && $resveData['data']['resve']['resveAt'] != 'Y'){
                $result['api_data']['orderNo'] = $OrderNo;
                $result['body']['Message'] = '오아시스 상품 예약승인을 완료해주세요.';
                return $this->response->setJSON($result);
            }
        }

        //getOrder 공통으로씀
        $apiModel = new GmarketApiModel();
        $result = $apiModel->getOrder($this->data);

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            //log_message('error', 'ShippingExpectedDate 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            $result['body']['result'] = $orderModel->setOrderShippingExpectedDateByOrderNo($this->data['api_data']);
            //log_message('error', 'ShippingExpectedDate 실행 :  $result[body] - ' . print_r($result['body'], true));
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
            $result['body']['result2'] = $orderModel->setClaimReDeliEdit($this->data['api_data']);
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
                    log_message('alert', 'OrderSendExcelUpload 실행 :  member - ' . $orderData['result']['mb_id'] . '|' . print_r($post['member'], true));
                } else {

                    $result2 = $apiModel->getOrder($this->data);

                    //성공 ResultCode = 0
                    if (!$result2['body']['ResultCode']) {
                        $orderModel->setOrderSendByOrderNo($this->data['api_data']);
                        $result['body']['Message'] = $result2['body']['Message'] == 'Success' ? '성공' : $result2['body']['Message'];
                        log_message('error', 'OrderSendExcelUpload 실행 :  $get_data - ' . print_r($result['body'], true));
                    } else {
                        $result['body']['Message'] = $result2['body']['Message'] == 'Success' ? '성공' : $result2['body']['Message'];
                        log_message('error', 'OrderSendExcelUpload 실행 :  $result[body] - ' . print_r($result2['body'], true));
                    }

                    //$result['body']['Message'] = $this->OrderSend($orderData['result']['idx']);
                    //$result['body']['result'] = $orderModel->setOrderSendByOrderNo($orderData['result']);
                    //log_message('alert', 'OrderSendExcelUpload 실행 :  $get_data - ' . print_r($result['body']['Message'], true));

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
     * ESM Trading API 취소처리
     *
     * @param int $idx order_list의 idx주문번호.
     */
    public function OrderAfterRemittanceBySeller($idx = 0)
    {
        $resultData = ['result' => false];
        $post = $this->data;
        if (!$idx) {
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        if($orderData['result']['SiteType'] != 1){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['api_data']['OrderNo'] = $OrderNo;
            $result['body']['Message'] = '옥션만 가능한 기능입니다.';
            return $this->response->setJSON($result);
        }

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/Cancel/{$OrderNo}/AfterRemittanceBySeller";
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
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {

        } else {

        }

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
        //log_message('alert', 'OrderReturnCheck 실행 :  $result - ' . print_r($result, true));
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderReturnCheckByOrderNo($OrderNo);
            //log_message('alert', 'OrderReturnCheck 실행 :  $get_data - ' . print_r($result['body'], true));
            //log_message('alert','OrderReturnCheck 실행 :  OrderCancelCheck - ' . print_r($this->data,true));
        } else {
            //log_message('alert', 'OrderReturnCheck 실행 :  $result[body] - ' . print_r($result['body'], true));
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
            //"ShippingDate" => $now,
            //"DeliveryCompanyCode" => $post['companyNo'],
            "DeliveryCompCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
            //"TakbaeName" => $post['TakbaeName'],
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

        $this->data['api_data']['ShippingDate'] = $now;
        $this->data['api_data']['TakbaeName'] = $post['TakbaeName'];

        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {
            $result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            //log_message('alert', 'OrderExchangeDeliEdit 실행 :  $get_data - ' . print_r($this->data['api_data'], true));
        } else {
            //log_message('alert', 'OrderExchangeDeliEdit 실행 :  $result[body] - ' . print_r($this->data['api_data'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 교환 수거완료 처리
     */
    public function OrderExchangeDeliComplete($idx = 0)
    {
        $orderData = [];
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
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/pickup";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "OrderNo" => $OrderNo,
            "PickupCompleteDate" => $now,
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
            log_message('alert', 'OrderExchangeDeliComplete 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('alert', 'OrderExchangeDeliComplete 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 교환재발송 송장등록
     */
    public function OrderExchangeReDeliEdit()
    {
        $orderData = [];
        $post = $this->data['data_arr'];

        $post = json_decode(json_encode($post), true);
        //log_message('error','OrderSend 실행 :  $post - ' . print_r($post,true));
        $idx = $post['idx'];
        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $OrderExchangeHoldReleaseCheck = $post['OrderExchangeHoldReleaseCheck'];
        /*
        $result = [];
        if($orderData['result']['ShippingExpectedDate']){
            $result['api_data']['orderNo'] = $OrderNo;
            $result['body']['Message'] = '이미 발송예정일이 등록된 주문입니다.';
            return $this->response->setJSON($result);
        }*/

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/resend";
        $this->data['api_data'] = [];

        $now = date('Y-m-d h:i:s ', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "OrderNo" => $OrderNo,
            "DeliveryCompCode" => $post['companyNo'],
            "InvoiceNo" => $post['NoSongjang'],
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

            //G마켓은 교환 재발송처리시 보류해제도 같이해야함 (보류되어있는 주문만, 옥션은 자동으로 처리됨)
            if($OrderExchangeHoldReleaseCheck && $this->data['api_data']['siteType'] == 2){
                $this->OrderExchangeHoldRelease($idx);
            }

            $result['body']['result'] = $orderModel->setClaimReDeliEdit($this->data['api_data']);

            //$result['body']['result'] = $orderModel->setOrderSendByOrderNo2($this->data['api_data']);
            log_message('alert', 'OrderExchangeReDeliEdit 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('alert', 'OrderExchangeReDeliEdit 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 교환재발송 배송완료
     */
    public function OrderExchangeReDeliComplete($idx = 0)
    {
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
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/resend";
        $this->data['api_data'] = [];

        $now = date('Y-m-d', time());
        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "PickupCompleteDate" => $now
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
            log_message('alert', 'OrderExchangeReDeliComplete 실행 :  $get_data - ' . print_r($result['body'], true));
        } else {
            log_message('alert', 'OrderExchangeReDeliComplete 실행 :  $result[body] - ' . print_r($result['body'], true));
        }
        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }
    }

    /**
     * ESM Trading API 교환보류
     */
    public function OrderExchangeHold()
    {
        $orderData = [];
        $post = $this->data['data_arr'];
        $post = json_decode(json_encode($post), true);
        $idx = $post['idx'];

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/hold";

        if(!$post['ReturnShippingFee']){
            $post['ReturnShippingFee'] = 0;
        }

        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
            "HoldReason" => (int)$post['HoldReason'],
            "ResendExpectDate" => $post['ResendExpectDate']
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
        log_message('alert', 'OrderExchangeHold 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {

        } else {

        }

        if ($this->response === null) {
            //log_message('error', 'Response object is null');
        } else {
            return $this->response->setJSON($result);
        }

    }

    /**
     * ESM Trading API 교환보류해제
     */
    public function OrderExchangeHoldRelease($idx = 0)
    {
        $post = $this->data;
        if (!$idx) {
            $idx = $post['idx'];
        }

        $orderModel = new OrderModel();
        $orderData['result'] = $orderModel->getOrderInfoByIdx($idx);
        $OrderNo = $orderData['result']['OrderNo'];

        $this->data['api_method'] = "POST";
        $this->data['api_url'] = "https://sa2.esmplus.com/claim/v1/sa/exchange/{$OrderNo}/hold";

        if(!$post['ReturnShippingFee']){
            $post['ReturnShippingFee'] = 0;
        }

        $this->data['api_data'] = [
            "orderNo" => $OrderNo,
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
        log_message('alert', 'OrderExchangeHoldRelease 실행 :  $result - ' . print_r($result, true));
        $result['api_data']['OrderNo'] = $OrderNo;
        //성공 ResultCode = 0
        if (!$result['body']['ResultCode']) {

        } else {

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
            "orderNo" => $OrderNo,
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