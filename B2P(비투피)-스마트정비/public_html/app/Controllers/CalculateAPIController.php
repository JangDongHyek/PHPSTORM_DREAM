<?php namespace App\Controllers;

use App\Libraries\Model;
use CodeIgniter\RESTful\ResourceController;
use App\Models\GmarketApiModel;
use Matrix\Exception;
use App\Libraries\JlModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;

class CalculateAPIController extends ResourceController {
    public $api_response = array("message"=>"");

    public $model_config = array(
        "table" => "order_list",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    );

    public function downloadExcel(){
        $data = $this->request->getGet();
        $member = session()->get("member");

        if(empty($data['year'])) $data['year'] = date("y");
        if(empty($data['month'])) $data['month'] = date("n");

        $model_config = array(
            "table" => "order_list",
            "primary" => "idx",
            "autoincrement" => true,
            "empty" => false
        );
        $model = new JlModel($model_config);

        $model->join("order_settle_list","OrderNo","ContrNo");
        //일자 조건문
        if($member['mb_id'] != "lets080" && $member['mb_id'] != "admin") $model->where("mb_id",$member['mb_id']);
        $model->where("CancelStatus","0");
        $model->where("ReturnStatus","0");
        $model->addSql(" and order_settle_list.BuyDecisonDate <= DATE_SUB(CURDATE(), INTERVAL 4 DAY) AND order_settle_list.BuyDecisonDate != '0000-00-00'");

        if($data['start_day'] && $data['end_day']) {
            $start_day = $data['start_day'];
            $end_day = $data['end_day'];
        }else {
            $start_day = date('Y-m-d', mktime(0, 0, 0, $data['month'], 1, $data['year']));
            $end_day = date('Y-m-d', mktime(0, 0, 0, $data['month'] + 1, 0, $data['year']));
        }
        $model->between("OrderDate",$start_day,$end_day);
        //검색 조건문
        if($data['search_key'] && $data['search_value']) {
            $model->like($data['search_key'],$data['search_value']);
        }
        if($data['SiteType']) {
            $model->where("SiteType",$data['SiteType']);
        }

        $model->orderBy("OrderDate","DESC");

        $orders = $model->get(array(
            "reset" => false,
            "sql" => true,
            "select" => array(
                "SellOrderPrice","OptionPrice","SellerDiscountTotalPrice","TotCommission",
                "dl_DelFeeAmt","dl_DelFeeCommission","DeductTaxPrice","BuyerPayAmt","category_fee_cost","GoodsCost"
            )
        ));

        ob_start();

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            "판매일자", "구분", "판매자코드/거래처명", "회사명", "담당자", "주문번호", "구매자명(아이디)", "상품명", "결제방식",
            "판매금액", "카테고리 수수료", "공급원가", "판매자할인 / 공제금", "KCP수수료", "배송비", "최종정산금액",
        ];
        $sheet->fromArray($headers, NULL, 'A1');

        $row = 2;
        foreach ($orders['data'] as $o) {
            $order = processOrder($o);

            $siteType = $order['SiteType'] == "1" ? "auction" : "gmarket";

            $cell = [
                $order['OrderDate'],
                $siteType,
                $order['OutGoodsNo'],
                $order['cp_name'],
                $order['mb_name'],
                $order['OrderNo'],
                $order['BuyerName']."({$order['BuyerId']})",
                $order['GoodsName'],
                "카드결제",
                number_format($order['b2p']['OrderAmount']),
                number_format($order['b2p']['category_fee_cost']),
                number_format($order['OrderAmount']  - $order['b2p']['category_fee_cost']),
                number_format($order['b2p']['totalDiscount']),
                number_format($order['b2p']['new_b2p_kcp_price'] - $order['b2p']['new_b2p_cp_fee_price']),
                number_format($order['b2p']['dl_DelFeeAmt'] - $order['b2p']['dl_DelFeeCommission'] + $order['b2p']['b2p_shipping_fee']),
                number_format($order['b2p']['calcPrice'])
            ];

            $sheet->fromArray($cell, NULL, "A{$row}");

            $row++;
        }
        // 글자 길이만큼 cell 늘어나는 부분
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        ob_end_clean();

        // 파일을 출력하기 위해 Writer 객체 생성
        $writer = new XlsxWriter($spreadsheet);

        $file_name = $member['mb_id'].'-'.$data['year']."-".$data['month']."-정산관리";

        // HTTP 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$file_name.xlsx");
        header('Cache-Control: max-age=0');

        // 파일 출력
        $writer->save('php://output');
        exit;
    }



    public function getData() {
        try {
            $model = new Model($this->model_config);
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                //if(strpos($key,"search_key") !== false) $column = $value;
                //if(strpos($key,"search_value") !== false) $obj[$column] = $value;
            }
            if($obj['s_date']) {
                $model->between("OrderDate",$obj['s_date'],$obj['e_date']);
            }
            if($obj['search_key'] && $obj['search_value']) {
                $model->like($obj['search_key'],$obj['search_value']);
            }

            $model->where($obj);

            $object = $model->get($obj["page"], $obj["limit"]);
            $this->api_response['sql'] = $model->getSql();
            $this->api_response['success'] = true;
            $this->api_response['response'] = $object;
            $this->api_response['filter'] = $obj;
        }catch (Exception $e) {
            $this->api_response['success'] = false;
            $this->api_response['message'] = $e->getMessage();
        }


        return $this->respond($this->api_response);
    }

    public function checkAPI($OrderNo) {
        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/account/v1/settle/getsettleorder";
        $data['api_data'] = [];
        $data['api_type'] = GM;
        $time_start = date('Y-m-d', strtotime('-60Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $data['api_data'] = [
            "SiteType" => "G",
            "ContrNo" => $OrderNo,
            "SrchType" => "D7",
            "SrchStartDate" => $time_start,
            "SrchEndDate" => $time_end,
            "PageNo" => 0,
            "PageRowCnt" => 0
        ];

        $apiModel = new GmarketApiModel();
        $result = $apiModel->checkOrder($data);

        var_dump($result);
    }

}
