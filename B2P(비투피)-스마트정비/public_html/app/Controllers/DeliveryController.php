<?php namespace App\Controllers;

use App\Models\GmAc\DeliveryModel;

class DeliveryController extends BaseController {
    
    //주소록관리
    public function deliCompanyCode() {
        $this->data['pid'] = 'delivery_code_list';

        return view('delivery/delivery_code_list',$this->data);
    }

    //주소록관리
    public function addressBookList() {
        $this->data['pid'] = 'address_book_list';

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => $this->data['sf'],
            'st' => $this->data['st'],
            'page' => $this->data['page'],
            'items_per_page' => 15
        ];
        $deliveryModal = new DeliveryModel();
        $this->data['address_data'] = $deliveryModal->getList($getData, 'address_book_list');

        return view('delivery/address_book_list',$this->data);
    }

    public function addressBookForm() {
        $this->data['pid'] = 'address_book_form';

        if(!empty($this->data['w'])){
            $getData = [
                'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
                'sf' => '',
                'st' => '',
                'page' => 1,
                'idx' => $this->data['idx'],
                'items_per_page' => 1
            ];
            $deliveryModal = new DeliveryModel();
            $address_data = $deliveryModal->getList($getData, 'address_book_list');
            if(empty($address_data['list']) || count($address_data['list']) == 0){
                return redirect()->to("/delivery/address_book_list");
            }
            $this->data['address_data'] = $address_data['list'][0];
        }
        return view('delivery/address_book_form',$this->data);
    }

    // 판매자주소록 가져오기
    public function getAddress(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_type'] = GMAC;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/sellers/addresses";
            $apiModel = new DeliveryModel();
            $result = $apiModel->callApi($this->data);
        }
        return $this->response->setJSON($result);
    }

    // 판매자주소록 저장하기
    public function setAddress(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $deliveryModal = new DeliveryModel();
            $result[GMAC] = $deliveryModal->setAddress($this->data);
        }
        return $this->response->setJSON($result);
    }

    //    촐고지 관리
    public function placesList(){
        $this->data['pid'] = 'address_delivery_list';

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => $this->data['sf'],
            'st' => $this->data['st'],
            'page' => $this->data['page'],
        ];

        $deliveryModal = new DeliveryModel();
        $this->data['delivery_data'] = $deliveryModal->getList($getData, 'places_list');

        return view('delivery/places_list',$this->data);
    }

    public function placesForm(){
        $this->data['pid'] = 'address_delivery_form';

        if(!empty($this->data['w'])){
            $getData = [
                'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
                'sf' => '',
                'st' => '',
                'page' => 1,
                'idx' => $this->data['idx'],
                'items_per_page' => 1
            ];

            $deliveryModal = new DeliveryModel();
            $places_data = $deliveryModal->getList($getData, 'places_list');
            if(empty($places_data['list']) || count($places_data['list']) == 0){
                return redirect()->to("/delivery/places_list");
            }
            $this->data['places_data'] = $places_data['list'][0];
        }

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => '',
            'st' => '',
            'page' => 1,
            'items_per_page' => 9999
        ];
        $deliveryModal = new DeliveryModel();
        $address_data = $deliveryModal->getList($getData, 'address_book_list');
        if(count($address_data['list']) == 0){
            $session = session();
            $session->setFlashdata('msg', '주소록을 먼저 등록해주세요.');
            return redirect()->to("/delivery/addressList");
        }
        $this->data['address_data'] = $address_data;



        return view('delivery/places_form',$this->data);
    }

    // 출고지 저장
    public function setPlaces(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $deliveryModal = new DeliveryModel();
            $result[GMAC] = $deliveryModal->setPlaces($this->data);
        }
        return $this->response->setJSON($result);
    }

    // 출고지 불러오기
    public function getPlaces(){
        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => 'placeNo',
            'st' => $this->data['placeNo'],
            'page' => 1,
        ];

        $deliveryModal = new DeliveryModel();
        $places_data = $deliveryModal->getList($getData, 'places_list');
        return $this->response->setJSON($places_data);
    }
    
    
//    배송비관리
    public function bundlePolicyList()
    {
        $this->data['pid'] = 'delivery_charge_list';

        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => '',
            'st' => '',
            'page' => 1,
            'items_per_page' => 9999
        ];

        $deliveryModal = new DeliveryModel();
        $places_data = $deliveryModal->getList($getData, 'places_list');
        $this->data['places_data'] = $places_data;
        return view('delivery/bundle_policy_list',$this->data);
    }
    public function bundlePolicyForm()
    {
        $this->data['pid'] = 'delivery_charge_form';

        if(!empty($this->data['w'])){
            $getData = [
                'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
                'sf' => '',
                'st' => '',
                'page' => 1,
                'idx' => $this->data['idx'],
                'items_per_page' => 1
            ];

            $deliveryModal = new DeliveryModel();
            $bundle_data = $deliveryModal->getList($getData, 'bundle_policies_list');
            if(empty($bundle_data['list']) || count($bundle_data['list']) == 0){
                return redirect()->to("/delivery/bundle_policies_list");
            }
            $this->data['bundle_data'] = $bundle_data['list'][0];
        }

        return view('delivery/bundle_policy_form',$this->data);
    }

    public function setBundlePolicy(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $deliveryModal = new DeliveryModel();
            $result[GMAC] = $deliveryModal->setBundlePolicy($this->data);
        }
        return $this->response->setJSON($result);
    }

    public function getBundlePolicy(){
        $getData = [
            'member' => ['mb_id' => $this->data['member']['mb_id'], 'mb_level' => $this->data['member']['mb_level']],
            'sf' => 'placeNo',
            'st' => $this->data['placeNo'],
            'page' => 1,
            'items_per_page' => 9999
        ];

        $deliveryModal = new DeliveryModel();
        $bundle_data = $deliveryModal->getList($getData, 'bundle_policies_list');
        return $this->response->setJSON($bundle_data);
    }

    
    //    발송정책 관리
    public function dispatchPolicyList(){
        $this->data['pid'] = 'shipping_policy_list';

        $apiModel = new DeliveryModel();
        $this->data['dispatchPolicyData'] = $apiModel->getDispatchPolicy();
        return view('delivery/dispatch_policy_list',$this->data);
    }

    public function dispatchPolicyForm(){
        $this->data['pid'] = 'shipping_policy_form';
        return view('delivery/dispatch_policy_form',$this->data);
    }

    public function getDispatchPolicy(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $this->data['api_type'] = GM;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/dispatch-policies";
            $apiModel = new DeliveryModel();
            $result[GM] = $apiModel->callApi($this->data);

            $result[GM]['api_type'] = GM;
            $result[GM."_SET"] = $apiModel -> setDispatchPolicy2($result[GM]);

            $this->data['api_type'] = AC;
            $this->data['api_method'] = "GET";
            $this->data['api_url'] = "https://sa2.esmplus.com/item/v1/shipping/dispatch-policies";
            $apiModel = new DeliveryModel();
            $result[AC] = $apiModel->callApi($this->data);

            $result[AC]['api_type'] = AC;
            $result[AC."_SET"] = $apiModel -> setDispatchPolicy2($result[AC]);
        }
        return $this->response->setJSON($result);
    }

    public function setDispatchPolicy(){
        $result = [];
        if($this->data['api_type'] == GMAC){
            $deliveryModal = new DeliveryModel();
            $this->data['api_type'] = GM;
            $result[GM] = $deliveryModal->setDispatchPolicy($this->data);

            $this->data['api_type'] = AC;
            $result[AC] = $deliveryModal->setDispatchPolicy($this->data);
        }
        return $this->response->setJSON($result);
    }

}
