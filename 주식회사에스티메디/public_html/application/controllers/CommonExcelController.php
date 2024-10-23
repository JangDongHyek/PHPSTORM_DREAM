<?php
require_once APPPATH.'libraries/PHPExcel/PHPExcel.php';

/**
 * 엑셀 다운로드/업로드
 * @property OrderModel $OrderModel
 */
class CommonExcelController extends CI_Controller {
    // 엑셀다운로드
    public function downloadExcel()
    {
        // 엑셀다운로드
        // excelColumns: 엑셀상단타이틀명
        // dbColumns: db컬럼명
        // excelColumns - dbColumns 1:1로 순서 동일하게 입력
        $get = $this->input->get();

        $excelColumns = ["주문번호", "주문상태", "결제수단", "배송비", "추가배송비", "총 결제금액", "수취인명", "수취인 우편번호", "수취인 주소", "수취인 전화번호", "발송자명", "발송자 우편번호", "발송자주소", "발송자 전화번호", "배송메시지", "계산서 사업자번호", "계산서 이메일", "계산서 대표자명", "현금영수증 휴대폰번호or사업자번호", "상품", "가격", "개수", "합계가"];
        $dbColumns = ["ord_no", "ord_status", "pay_method", "delivery_fee", "delivery_fee2", "total_price", "rec_name", "rec_zcode", "rec_addr_full", "rec_tel", "ord_name", "ord_zcode", "ord_addr_full", "ord_tel", "rec_memo", "invoice_biz_num", "invoice_email", "invoice_rep_name", "cash_receipt_auth_num", "item_name", "item_price", "item_cnt", "item_Amt"];
        $filename = "주문내역";

        $this->load->model('OrderModel');
        $response = $this->OrderModel->getOrderListExcel();


        $phpExcel = new PHPExcel();
        $sheet = $phpExcel->getActiveSheet();

        //테스트 로그남겨서 확인하는부분 wc
        //$response_log = print_r($response, true);
        //log_message('error', '엑셀다운 성공:'.print_r($response_log, true));
        // 행번호 초기화
        $column = 'A';
        foreach ($excelColumns as $header) {
            $sheet->setCellValue($column.'1', $header);
            $sheet->getColumnDimension($column)->setWidth(30);
            $sheet->getStyle($column.'1')->getFont()->setBold(true);

            $column++;
        }

        // No.를 포함하는 엑셀
        $includeNoArr = ['patient', 'medicine', 'misu'];

        // 열번호 초기화
        $rowNum = 2;
        $listNo = $response['paging']['listNo'];
        foreach ($response['listData'] as $data) {
            $column = 'A';
            for($i=0; $i<count($excelColumns); $i++) {

                $value = $data[$dbColumns[$i]];
                $isWrapText = false; // 줄바꿈여부

                switch ($dbColumns[$i]) {
                    case "rec_addr_full" : // 관리자-주문배송관리-택배송장 수취인 주소
                        $value = $data['rec_addr'].' '.$data['rec_addr_detail'];
                        break;
                    case "ord_addr_full" : // 관리자-주문배송관리-택배송장 발송자 주소
                        $value = $data['ord_addr'].' '.$data['ord_addr_detail'];
                        break;
                    case "pay_method" : // 관리자-결제구분
                        $value = ENABLE_PAYMENT_METHODS[$data['pay_method']];
                        break;
                    case "ord_status" : // 관리자-결제상태
                        $value = ORDER_RECIPE_STATUS[$data['ord_status']];
                        break;
                    case "item_Amt" : // 상품결제금액관련
                        $itemAmt = 0;
                        $price = 0;
                        $count = 0;
                        $price = (int)$data['item_price']; // 상품가격
                        $count = (int)$data['item_cnt']; // 장바구니수량
                        $itemAmt = $price * $count;
                        $value = $itemAmt;
                        break;
                }



                $sheet->setCellValueExplicit($column.$rowNum, $value, PHPExcel_Cell_DataType::TYPE_STRING);

                // 셀 서식 텍스트 (맨 앞이 0이면 없어지는 문제)
                if($dbColumns[$i] == 'ord_no' || $dbColumns[$i] == 'rec_zcode' || $dbColumns[$i] == 'ord_zcode') $sheet->getStyle($column.$rowNum)->getNumberFormat()->setFormatCode('@');
                // 줄바꿈
                if ($isWrapText) $sheet->getStyle($column.$rowNum)->getAlignment()->setWrapText(true);

                $column++;

                //log_message('error', '엑셀다운 ok:' .var_dump($data));
            }

            $rowNum++;
            $listNo--;
        }

        // 테두리 스타일 변수
        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $cellRange = 'A1:'.(chr(ord($column) - 1)).($rowNum-1);
        // $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); // 테두리 지정
        $sheet->getStyle($cellRange)->applyFromArray($borderStyle); // 테두리 지정
        $sheet->getStyle($cellRange)->getFont()->setName('맑은 고딕')->setSize(10); // 글꼴/폰트크기
        $sheet->getStyle($cellRange)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // 수직중앙 정렬
        $sheet->getStyle("A1:{$column}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEEEEEE'); // 첫행강조



        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        try {
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
            $writer->save('php://output');

        } catch (Exception $e) {
            log_message('error', '엑셀다운 error:'.$e->getMessage());
        }
    }

    // 엑셀다운로드
    public function downloadAgencyExcel()
    {
        // 엑셀다운로드
        // excelColumns: 엑셀상단타이틀명
        // dbColumns: db컬럼명
        // excelColumns - dbColumns 1:1로 순서 동일하게 입력
        $get = $this->input->get();

        $member = $this->session->userdata('member');

        if($member['mb_level'] >= 10){
            $param = array(
                'page' => $post['page'] ?? 1,
                'addGroupName' => 1, // 그룹명
                'agencyOnly' => 'Y',
            );
        }else{
            $param = array(
                'page' => $post['page'] ?? 1,
                'agency' => $member['mb_id'] ?? '',
                'addGroupName' => 1, // 그룹명
            );
        }

        $this->load->model("MemberModel");
        $memberData = $this->MemberModel->getMemberList($param,'agency');

        $mbIds = [];

        // mb_id만 추출하여 배열에 추가
        foreach ($memberData['listData'] as $item) {
            if (!empty($item['mb_id'])) {  // mb_id가 비어 있지 않은 경우에만 추가
                array_push($mbIds, $item['mb_id']);
            }
        }

        $agencyMembersInStr = "'" . implode("','", $mbIds) . "'";

        // 검색
        $param = array(
            'page' => $get['page'] ?? 1,
            'sfl' => $get['sfl'] ?? 'name',
            'stx' => $get['stx'] ?? '',
            'sdt' => $get['sdt'] ?? '',
            'edt' => $get['edt'] ?? '',
            'year' => $get['year'] ?? '',
            'month' => $get['month'] ?? '',
            'groupIdxList' => $get['groupIdxList'] ?? '',
            'status' => $get['status'] ?? '',
            'method' => $get['method'] ?? '',
            'excel' => $get['excel'] ?? '',
            'mb_id' => $get['mb_id'] ?? '',
            'UPDATE_KEY' => $get['UPDATE_KEY'] ?? '',
            'agencyMembersInStr' => $agencyMembersInStr ?? '',
        );

        $this->load->model('OrderModel');
        $response = $this->OrderModel->getOrderAgencyList($param);

        $excelColumns = [ "주문일", "에이전시", "업체 아이디", "주문 업체", "대표자명",   "주문상품", "주문가격", "총 주문금액","정산수수료","정산수수료 금액","총 정산금액"];
        $dbColumns = [ "reg_date","agency", "mb_id", "mb_name", "rep_name", "item_name", "item_price","order_price", "agency_fee", "agency_fee2" , "agency_fee2_total"];
        $filename = "정산관리";

        $phpExcel = new PHPExcel();
        $sheet = $phpExcel->getActiveSheet();

        //테스트 로그남겨서 확인하는부분 wc
        //$response_log = print_r($response, true);
        //log_message('error', '엑셀다운 성공:'.print_r($response_log, true));
        // 행번호 초기화
        $column = 'A';
        foreach ($excelColumns as $header) {
            $sheet->setCellValue($column.'1', $header);
            $sheet->getColumnDimension($column)->setWidth(30);
            $sheet->getStyle($column.'1')->getFont()->setBold(true);

            $column++;
        }

        // No.를 포함하는 엑셀
        $includeNoArr = ['patient', 'medicine', 'misu'];

        // 열번호 초기화
        $rowNum = 2;
        $listNo = $response['paging']['listNo'];
        foreach ($response['listData'] as $data) {
            $column = 'A';
            for($i=0; $i<count($excelColumns); $i++) {

                $value = $data[$dbColumns[$i]];
                $isWrapText = false; // 줄바꿈여부

                $orderData = $data['orderData'];
                $orderItemData = $data['orderItemData'];
                $memberInfo = $data['member_info'];
                $agency_fee_arr = explode('|', $orderData['agency_fee']);

                switch ($dbColumns[$i]) {
                    case "rec_addr_full" : // 관리자-주문배송관리-택배송장 수취인 주소
                        $value = $data['rec_addr'].' '.$data['rec_addr_detail'];
                        break;
                    case "ord_addr_full" : // 관리자-주문배송관리-택배송장 발송자 주소
                        $value = $data['ord_addr'].' '.$data['ord_addr_detail'];
                        break;
                    case "pay_method" : // 관리자-결제구분
                        $value = ENABLE_PAYMENT_METHODS[$data['pay_method']];
                        break;
                    case "ord_status" : // 관리자-결제상태
                        $value = ORDER_RECIPE_STATUS[$data['ord_status']];
                        break;
                    case "item_Amt" : // 상품결제금액관련
                        $itemAmt = 0;
                        $price = 0;
                        $count = 0;
                        $price = (int)$data['item_price']; // 상품가격
                        $count = (int)$data['item_cnt']; // 장바구니수량
                        $itemAmt = $price * $count;
                        $value = $itemAmt;
                        break;
                    case "reg_date" :
                        $value = replaceDateFormat($data['reg_date']);
                        break;
                    case "mb_id" :
                        $value = $memberInfo['mb_id'];
                        break;
                    case "mb_name" :
                        $value = $memberInfo['mb_name'];
                        break;
                    case "rep_name" :
                        $value = $memberInfo['rep_name'];
                        break;
                    case "agency" :
                        $value = $memberInfo['agency'];
                        break;

                    case "item_name" :
                        $value = '';
                        $count2 = 0;
                        foreach ($orderItemData as $orderItem){
                            if($count2 != 0){
                                $value .= PHP_EOL;
                            }
                            $count2++;
                            $value .= $orderItem['item_name'].' '.$orderItem['item_cnt'].'개 ';
                        }
                        $isWrapText = true;
                        break;
                    case "item_price" :
                        $value = '';
                        $count2 = 0;
                        foreach ($orderItemData as $orderItem){
                            if($count2 != 0){
                                $value .= PHP_EOL;
                            }
                            $value .= number_format($orderItem['item_price'] * $orderItem['item_cnt']).'원 ';
                            $count2++;
                        }
                        $isWrapText = true;
                        break;
                    case "order_price" :
                        $value = number_format($data['order_price']);
                        break;

                    case "agency_fee" :
                        $value = '';
                        $count2 = 0;
                        foreach ($orderItemData as $orderItem){
                            $agency_fee_arr[$count2] ? $agency_fee = $agency_fee_arr[$count2] : $agency_fee = 0;
                            if($count2 != 0){
                                $value .= PHP_EOL;
                            }
                            $value .= $agency_fee.'%';
                            $count2++;
                        }
                        $isWrapText = true;
                        break;
                    case "agency_fee2" :
                        $value = '';
                        $count2 = 0;
                        foreach ($orderItemData as $orderItem){
                            $agency_fee_arr[$count2] ? $agency_fee = $agency_fee_arr[$count2] : $agency_fee = 0;

                            if($count2 != 0){
                                $value .= PHP_EOL;
                            }
                            $value .= number_format($orderItem['item_price'] * $orderItem['item_cnt'] * ($agency_fee_arr[$count2] / 100), 1).'원 ';
                            $count2++;
                        }
                        $isWrapText = true;
                        break;
                    case "agency_fee2_total" :
                        $value = $orderData['agency_fee2'] ? number_format($orderData['agency_fee2'], 1) : 0;
                        break;
                }



                $sheet->setCellValueExplicit($column.$rowNum, $value, PHPExcel_Cell_DataType::TYPE_STRING);

                // 셀 서식 텍스트 (맨 앞이 0이면 없어지는 문제)
                if($dbColumns[$i] == 'ord_no' || $dbColumns[$i] == 'rec_zcode' || $dbColumns[$i] == 'ord_zcode') $sheet->getStyle($column.$rowNum)->getNumberFormat()->setFormatCode('@');
                // 줄바꿈
                if ($isWrapText) $sheet->getStyle($column.$rowNum)->getAlignment()->setWrapText(true);

                $column++;

                //log_message('error', '엑셀다운 ok:' .var_dump($data));
            }

            $rowNum++;
            $listNo--;
        }

        // 테두리 스타일 변수
        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $cellRange = 'A1:'.(chr(ord($column) - 1)).($rowNum-1);
        // $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); // 테두리 지정
        $sheet->getStyle($cellRange)->applyFromArray($borderStyle); // 테두리 지정
        $sheet->getStyle($cellRange)->getFont()->setName('맑은 고딕')->setSize(10); // 글꼴/폰트크기
        $sheet->getStyle($cellRange)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // 수직중앙 정렬
        $sheet->getStyle("A1:{$column}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEEEEEE'); // 첫행강조



        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        try {
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
            $writer->save('php://output');

        } catch (Exception $e) {
            log_message('error', '엑셀다운 error:'.$e->getMessage());
        }
    }

    // 엑셀업로드
    // $file: 업로드된 엑셀파일
    // $excelRows: 읽어온 엑셀데이터
    public function uploadExcel()
    {
        $resultData = ['result'=>false, 'message' => '엑셀 업로드에 실패하였습니다.'];
        $file = $_FILES['uploaded_file']; // Input name for the uploaded file
        $post = $this->input->post();

        $phpExcel = PHPExcel_IOFactory::load($file['tmp_name']);
        $sheet = $phpExcel->getActiveSheet();
        $excelRows = $sheet->toArray();

        switch ($post['target']) { // 엑셀업로드 메뉴
            case "trackingNo": // 관리자 주문배송관리 송장업로드
                $this->load->model('OrderModel');
                $response = $this->OrderModel->uploadExcelTrackingNo($excelRows);
                break;
        }

        if($response) {
            $resultData['result'] = true;
            $resultData['message'] = '';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultData));
    }



    // 엑셀다운로드 옜날꺼
    public function downloadExcel_old()
    {
        // 엑셀다운로드
        // excelColumns: 엑셀상단타이틀명
        // dbColumns: db컬럼명
        // excelColumns - dbColumns 1:1로 순서 동일하게 입력
        $get = $this->input->get();
        $excel = $get['excel'] ?? ''; // 엑셀다운로드 메뉴

        switch ($excel) {
            /*
            case "orderProductTracking": // 관리자 주문배송관리 택배 송장
                $excelColumns = ["주문번호", "한의원명", "한의원전화번호", "수취인명", "수취인 우편번호", "수취인 주소", "수취인 전화번호", "수취인 이동통신", "환자명", "발송자명", "발송자 우편번호", "발송자주소", "발송자 전화번호", "발송자 이동통신", "배송메시지"];
                $dbColumns = ["ord_no", "clinicName", "clinicTel", "rec_name", "rec_zcode", "rec_addr_full", "rec_tel", "rec_tel", "rec_name", "ord_name", "ord_zcode", "ord_addr_full", "ord_tel", "ord_tel", "rec_memo"];
                $filename = "택배송장";

                // 검색
                $param = getOrderListParam($get);
                $isExcel = !empty($get['excel']);

                $this->load->model('OrderModel');
                $response = $this->OrderModel->getOrderList($param, $isExcel, true);
                // print_r($response);
                break;
            */
            case "orderProductTracking": // 관리자 주문배송관리 택배 송장
                $excelColumns = ["주문번호", "주문상태", "결제수단", "배송비", "추가배송비", "총 결제금액", "수취인명", "수취인 우편번호", "수취인 주소", "수취인 전화번호", "발송자명", "발송자 우편번호", "발송자주소", "발송자 전화번호", "배송메시지" , "계산서 사업자번호" , "계산서 이메일" , "계산서 대표자명" , "현금영수증 휴대폰번호or사업자번호", "상품" , "가격" , "개수" , "합계가"];
                $dbColumns = ["ord_no", "ord_status", "pay_method", "delivery_fee","delivery_fee2", "total_price", "rec_name", "rec_zcode", "rec_addr_full", "rec_tel", "ord_name", "ord_zcode", "ord_addr_full", "ord_tel", "rec_memo" , "invoice_biz_num" , "invoice_email" , "invoice_rep_name" , "cash_receipt_auth_num", "item" , "" , "" , "" ];
                $filename = "주문내역";

                // 검색
                $param = getOrderListParam($get);
                $isExcel = !empty($get['excel']);

                $this->load->model('OrderModel');
                $response = $this->OrderModel->getOrderList($param, $isExcel, true);
                // print_r($response);
                break;
        }

        $phpExcel = new PHPExcel();
        $sheet = $phpExcel->getActiveSheet();

        // 행번호 초기화
        $column = 'A';
        foreach ($excelColumns as $header) {
            $sheet->setCellValue($column.'1', $header);
            $sheet->getColumnDimension($column)->setWidth(30);
            $sheet->getStyle($column.'1')->getFont()->setBold(true);

            $column++;
        }

        // No.를 포함하는 엑셀
        $includeNoArr = ['patient', 'medicine', 'misu'];

        // 열번호 초기화
        $rowNum = 2;
        $listNo = $response['paging']['listNo'];
        foreach ($response['listData'] as $data) {
            $column = 'A';
            for($i=0; $i<count($excelColumns); $i++) {
                if($i==0 && in_array($excel, $includeNoArr)) $value = $listNo; // No.
                else $value = $data[$dbColumns[$i]];

                $isWrapText = false; // 줄바꿈여부

                switch ($dbColumns[$i]) {
                    case "rec_addr_full" : // 관리자-주문배송관리-택배송장 수취인 주소
                        $value = $data['rec_addr'].' '.$data['rec_addr_detail'];
                        break;
                    case "ord_addr_full" : // 관리자-주문배송관리-택배송장 발송자 주소
                        $value = $data['ord_addr'].' '.$data['ord_addr_detail'];
                        break;
                    case "pay_method" : // 관리자-결제구분
                        $value = ENABLE_PAYMENT_METHODS[$data['pay_method']];
                        break;
                    case "ord_status" : // 관리자-결제상태
                        $value = ORDER_RECIPE_STATUS[$data['ord_status']];
                        break;

                    case "item" : // 상품명
                        $value = '';
                        $column_old = $column;
                        $price = 0;
                        $count = 0;
                        $itemAmt = 0;

                        for ($j = 0 ; $j < count($data['orderItemData']) ; $j++){
                            $item_name = $data['orderItemData'][$j]['item_name']; //아이템이름
                            $price = (int)$data['orderItemData'][$j]['item_price']; // 상품가격
                            $count = (int)$data['orderItemData'][$j]['item_cnt']; // 장바구니수량
                            $itemAmt = $price * $count;
                            //$value = $item_name."(".$count."x".$price."=".$itemAmt.")";
                            $value = $item_name;
                            $sheet->setCellValueExplicit($column.$rowNum, $value, PHPExcel_Cell_DataType::TYPE_STRING);
                            $column++;
                            $sheet->setCellValueExplicit($column.$rowNum, $price, PHPExcel_Cell_DataType::TYPE_STRING);
                            $column++;
                            $sheet->setCellValueExplicit($column.$rowNum, $count, PHPExcel_Cell_DataType::TYPE_STRING);
                            $column++;
                            $sheet->setCellValueExplicit($column.$rowNum, $itemAmt, PHPExcel_Cell_DataType::TYPE_STRING);

                            $column = $column_old;



                            $rowNum++;
                        }
                        //$value = substr($value, 0, -3);

                        break;
                }

                if($dbColumns[$i] == "item"){

                }else{
                    // 셀 입력

                    $sheet->setCellValueExplicit($column.$rowNum, $value, PHPExcel_Cell_DataType::TYPE_STRING);
                }

                // 셀 서식 텍스트 (맨 앞이 0이면 없어지는 문제)
                if($dbColumns[$i] == 'ord_no' || $dbColumns[$i] == 'rec_zcode' || $dbColumns[$i] == 'ord_zcode') $sheet->getStyle($column.$rowNum)->getNumberFormat()->setFormatCode('@');
                // 줄바꿈
                if ($isWrapText) $sheet->getStyle($column.$rowNum)->getAlignment()->setWrapText(true);

                $column++;

                //log_message('error', '엑셀다운 ok:' .var_dump($data));
            }

            $rowNum++;
            $listNo--;
        }

        // 테두리 스타일 변수
        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $cellRange = 'A1:'.(chr(ord($column) - 1)).($rowNum-1);
        // $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); // 테두리 지정
        $sheet->getStyle($cellRange)->applyFromArray($borderStyle); // 테두리 지정
        $sheet->getStyle($cellRange)->getFont()->setName('맑은 고딕')->setSize(10); // 글꼴/폰트크기
        $sheet->getStyle($cellRange)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // 수직중앙 정렬
        $sheet->getStyle("A1:{$column}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEEEEEE'); // 첫행강조



        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        try {
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
            $writer->save('php://output');

        } catch (Exception $e) {
            log_message('error', '엑셀다운 error:'.$e->getMessage());
        }
    }
}