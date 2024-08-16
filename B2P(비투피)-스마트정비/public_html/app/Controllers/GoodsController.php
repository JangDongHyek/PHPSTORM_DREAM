<?php namespace App\Controllers;

use App\Models\GmarketApiModel;
use App\Models\GmAc\GoodsModel;
use App\Models\GmAc\DeliveryModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GoodsController extends BaseController {
    // 제품관리 리스트
    public function goodsList(){
        $this->data['pid'] = 'goods_list';

        $goodsModel = new GoodsModel();
        $this->data['goods_data'] = $goodsModel->getGoodsList($this->data);
        $this->data['esm_category_list'] = get_esm_category();

        $this->data['delivery_company_list'] = get_delivery_company_list();
        $this->data['quickServiceJiyuck'] = getQuickServiceJiyuck();

        $deliveryModel = new DeliveryModel();
        $this->data['dispatch_policy_data'] = $deliveryModel->getDispatchPolicy();

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'page' => 1,
            'items_per_page' => 9999
        ];
        $this->data['places_data'] = $deliveryModel->getList($getData, 'places_list');
        $this->data['address_book_data'] = $deliveryModel->getList($getData, 'address_book_list');
        $this->data['bundle_policies_data'] = $deliveryModel->getList($getData, 'bundle_policies_list');

        //var_dump($this->data['goods_data']);

        return view('goods/goods_list',$this->data);
    }

    // 제품관리 폼
    public function goodsForm(){
        $this->data['pid'] = 'goods_write';

        $this->data['GMARKET_CHARGE'] = get_gmarket_charge_list();
        $this->data['delivery_company_list'] = get_delivery_company_list();
        $this->data['quickServiceJiyuck'] = getQuickServiceJiyuck();

        $deliveryModel = new DeliveryModel();
        $this->data['dispatch_policy_data'] = $deliveryModel->getDispatchPolicy();

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'page' => 1,
            'items_per_page' => 9999
        ];
        $this->data['places_data'] = $deliveryModel->getList($getData, 'places_list');
        $this->data['address_book_data'] = $deliveryModel->getList($getData, 'address_book_list');
        $this->data['bundle_policies_data'] = $deliveryModel->getList($getData, 'bundle_policies_list');

        if($this->data['places_data']['total_count'] == 0 || $this->data['address_book_data']['total_count'] == 0 || $this->data['bundle_policies_data']['total_count'] == 0){
            session()->setFlashdata('msg', '배송관련 정보를 최소 한개 이상씩 입력해주세요.');
            return redirect()->to("/delivery/addressList");
        }


        if($this->data['w'] == 'u' && !empty($this->data['idx'])){
            // api로 지마켓 데이터를 가져옴
            $goodsModel = new GoodsModel();
            $this->data['api_type'] = GMAC;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$this->data['goods_no']}";
            $result = $goodsModel->callApi($this->data);

            if(!empty($result['body'])){
                // 데이터가 있으면 즉시 db업데이트
                $goodsData = json_decode($result['body'], true);
                $goodsData['w'] = 'u';
                $goodsData['goods_no'] = $this->data['goods_no'];
                $goodsModel->updateGoods($goodsData);
            }

            // db에서 상품정보 가져옴
            $getData = [
                'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
                'page' => 1,
                'items_per_page' => 1,
                'idx' => $this->data['idx']
            ];
            $this->data['goods_data'] = $goodsModel->getList($getData, 'goods_list')['list'][0];
            if($this->data['goods_data']['is_view'] != 'T'){
                session()->setFlashdata('msg', '삭제되었거나 일시적인 오류입니다. 나중에 다시 시도해주세요.');
                return redirect()->to("/goods/goods_list");
            }
        }

        if(!empty($this->data['copy_idx']) && !empty($this->data['copy_goods_no'])){
            // api로 지마켓 데이터를 가져옴
            $goodsModel = new GoodsModel();
            $this->data['api_type'] = GMAC;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$this->data['copy_goods_no']}";
            $result = $goodsModel->callApi($this->data);

            if(!empty($result['body'])){
                // 데이터가 있으면 즉시 db업데이트
                $goodsData = json_decode($result['body'], true);
                $goodsData['w'] = 'u';
                $goodsData['goods_no'] = $this->data['copy_goods_no'];
                $goodsModel->updateGoods($goodsData);
            }

            // db에서 상품정보 가져옴
            $getData = [
                'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
                'page' => 1,
                'items_per_page' => 1,
                'idx' => $this->data['copy_idx']
            ];
            $this->data['goods_data'] = $goodsModel->getList($getData, 'goods_list')['list'][0];
            if($this->data['goods_data']['is_view'] != 'T'){
                session()->setFlashdata('msg', '삭제되었거나 일시적인 오류입니다. 나중에 다시 시도해주세요.');
                return redirect()->to("/goods/goods_list");
            }
        }

        return view('goods/goods_form',$this->data);
    }

    // 일괄변경
    public function setGoodsBatch(){
        $goodsModel = new GoodsModel();
        $result = $goodsModel->setGoodsBatch($this->data);
        return $this->response->setJSON($result);
    }

    // 중립(?)카테고리 가져오기
    public function getCategory(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_type'] = GMAC;
            $this->data['api_method'] = "GET";
            if(empty($this->data['cate_no'])){
                $this->data['cate_no'] = GMAC_CAR_CATE;
            }
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/categories/sd-cats/".$this->data['cate_no'];
            $apiModel = new GmarketApiModel();
            $result = $apiModel->basicCallApi($this->data);
        }
        return $this->response->setJSON($result);
    }

    // 진짜 카테고리 가져오기
    public function getGmAcCategory(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_type'] = GMAC;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/categories/sd-cats/{$this->data['cate_no']}/site-cats";
            $apiModel = new GmarketApiModel();
            $result = $apiModel->basicCallApi($this->data);
        }
        return $this->response->setJSON($result);
    }

    // 출고지기준 묶음배송리스트 가져오기 (deliveryTmplId)
    public function getDeliveryTmplIdList(){
        $deliveryModel = new DeliveryModel();
        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'page' => 1,
            'items_per_page' => 9999,
            'sf' => 'placeNo',
            'st' => $this->data['placeNo'],
        ];
        $result = $deliveryModel->getList($getData, 'bundle_policies_list');
        return $this->response->setJSON($result);
    }

    public function getDeliveryCompany(){
/*        if($this->data['api_type'] == GMAC){
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/delivery-company";
            $apiModel = new GmarketApiModel();
            $result = $apiModel->basicCallApi($this->data);

            $body = json_decode($result['body'], true);
            $deliveryCompanies = $body['deliveryCompanies'];

            $result['deliveryCompanies'] = $deliveryCompanies;

            for($i=0; $i<count($deliveryCompanies); $i++){
                $l_data = $deliveryCompanies[$i];

                try {
                    //$sql = "insert into `delivery_company_list` set `code` = '$l_data[deliveryCompCode]', `name` = '$l_data[deliveryCompName]'";
                    //sql_query($sql);
                } catch (Excetpion $e) {

                }
            }
        }*/
        $result = ['code'=>400];
        return $this->response->setJSON($result);
    }

    public function getItemOfficialNotice(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/official-notice/groups/15/codes";
            $apiModel = new GmarketApiModel();
            $result = $apiModel->basicCallApi($this->data);
        }
        return $this->response->setJSON($result);
    }

    public function setGoods(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            if($this->data['w'] == 'u'){
                $this->data['api_method'] = "PUT";
                $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/{$this->data['goods_no']}";
            } else {
                $this->data['api_method'] = "POST";
                $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/goods";
            }


            $apiModel = new GoodsModel();
            $result = $apiModel->setGoods($this->data);
        }
        return $this->response->setJSON($result);
    }

    public function getGoods(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/goods/4525405971";
            //$apiModel = new GoodsModel();
            //$result = $apiModel->callApi($this->data);
        }
        return $this->response->setJSON($result);
    }

    public function getBrand(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $brandName = urlencode($this->data['brandName']);
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/catalogs/brands/{$brandName}";
            $apiModel = new GoodsModel();
            $result1 = $apiModel->callApi($this->data);

            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/catalogs/makers/{$brandName}";
            $apiModel = new GoodsModel();
            $result2 = $apiModel->callApi($this->data);
            
            $result = array_merge($result1, $result2);
        }
        return $this->response->setJSON($result);
    }

    // 제품일괄등록
    public function goodsUpload(){
        $this->data['pid'] = 'goods_upload';

        $directory = WRITEPATH . 'uploads/goods';
        $files = glob($directory . '/*'); // 모든 파일 가져오기
        $userFiles = [];
        foreach ($files as $file) {
            $filename = basename($file);
            if (strpos($filename, $this->data['member']['mb_id'] . '_') === 0) {
                $userFiles[] = $filename;
            }
        }
        $this->data['file_count'] = count($userFiles);

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => $this->data['sf'],
            'st' => $this->data['st'],
            'page' => $this->data['page'],
            'items_per_page' => 15
        ];
        $goodsModel = new GoodsModel();
        $this->data['goods_excel_data'] = $goodsModel->getList($getData, 'goods_excel_upload');

        return view('goods/goods_upload',$this->data);
    }

    // 크론탭으로 엑셀행들을 db에 넣기
    public function cronExcelToDB(){
        $goodsModel = new GoodsModel();
        $goodsModel->cronExcelToDB();
    }

    // 크론탭으로 db에 저장된 엑셀행 가져와서 api 던지기
    public function cronDBToApi(){
        $goodsModel = new GoodsModel();
        $goodsModel->cronDBToApi();
    }
}
