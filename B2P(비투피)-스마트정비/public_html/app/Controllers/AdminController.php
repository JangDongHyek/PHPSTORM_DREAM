<?php namespace App\Controllers;

class AdminController extends BaseController {
    public function manager01_01_list() {
        return view('admin/manager01_01_list',$this->data);
    }
    public function manager01_01_write()
    {
        return view('admin/manager01_01_write',$this->data);
    }
    public function manager01_02_list()
    {
        return view('admin/manager01_02_list',$this->data);
    }
    public function manager01_02_write()
    {
        return view('admin/manager01_02_write',$this->data);
    }
    public function manager01_03_list()
    {
        return view('admin/manager01_03_list',$this->data);
    }

    // 제품관리
    public function manager_product_list()
    {
        $this->data['pid'] = 'manager_product_list';
        return view('admin/manager_product_list',$this->data);
    }
    public function manager_product_write()
    {
        $this->data['GMARKET_CHARGE'] = get_gmarket_charge_list();
        $this->data['pid'] = 'manager_product_write';
        return view('admin/manager_product_write',$this->data);
    }
    
//    재고관리
    public function manager_stock_list()
    {
        $this->data['pid'] = 'manager_stock_list';
        return view('admin/manager_stock_list',$this->data);
    }
    public function manager_stock_write()
    {
        $this->data['pid'] = 'manager_stock_write';
        return view('admin/manager_stock_write',$this->data);
    }

//    판매관리
    public function sell_list()
    {
        $this->data['pid'] = 'sell_list';
        return view('admin/sell_list',$this->data);
    }
    
//  배송관리
    public function ship_list()
    {
        $this->data['pid'] = 'ship_list';
        return view('admin/ship_list',$this->data);
    }
    
/*  구매취소
    public function cancel_list()
    {
        $this->data['pid'] = 'cancel_list';
        return view('admin/cancel_list',$this->data);
    }
*/
//  예약관리
    public function reserv_list()
    {
        $this->data['pid'] = 'reserv_list';
        return view('admin/reserv_list',$this->data);
    }
    
//  정산리스트
    public function calcul_list()
    {
        $this->data['pid'] = 'calcul_list';
        return view('admin/calcul_list',$this->data);
    }
    
    /*주문관리 24.06.04*/

//    입금확인중
    public function waiting_list()
    {
        $this->data['pid'] = 'waiting_list';
        return view('order/waiting_list',$this->data);
    }
//    신규주문
    public function new_list()
    {
        $this->data['pid'] = 'new_list';
        return view('order/new_list',$this->data);
    }
//    발송처리
    public function send_list()
    {
        $this->data['pid'] = 'send_list';
        return view('order/send_list',$this->data);
    }
//    배송중완료
    public function deliver_list()
    {
        $this->data['pid'] = 'deliver_list';
        return view('order/deliver_list',$this->data);
    }
//    구매결정완료
    public function confirm_list()
    {
        $this->data['pid'] = 'confirm_list';
        return view('order/confirm_list',$this->data);
    }
//    발송처리현황
    public function state_list()
    {
        $this->data['pid'] = 'state_list';
        return view('order/state_list',$this->data);
    }

//    발주서출력
    public function order_print()
    {
        $this->data['pid'] = 'order_print';
        return view('order/order_print',$this->data);
    }

    /*클레임관리 25.06.07*/



//    취소관리
    public function cancel_list()
    {
        $this->data['pid'] = 'cancel_list';
        return view('order/cancel_list',$this->data);
    }


//    반품관리
    public function return_list()
    {
        $this->data['pid'] = 'return_list';
        return view('order/return_list',$this->data);
    }


//    교환관리
    public function exchange_list()
    {
        $this->data['pid'] = 'exchange_list';
        return view('order/exchange_list',$this->data);
    }


//    주문통합검색
    public function order_search()
    {
        $this->data['pid'] = 'order_search';
        return view('order/order_search',$this->data);
    }
//정산관리
//    옥션판매
    public function auction_list()
    {
        $this->data['pid'] = 'auction_list';
        return view('calculate/auction_list',$this->data);
    }
//    지마켓판매
    public function gmarket_list()
    {
        $this->data['pid'] = 'gmarket_list';
        return view('calculate/gmarket_list',$this->data);
    }


//    지마켓판매
    public function calculate_view()
    {
        $this->data['pid'] = 'calculate_view';
        return view('calculate/calculate_view',$this->data);
    }


//    고객센터
//      공지사항
    public function notice_list()
    {
        $this->data['pid'] = 'notice_list';
        return view('admin/notice_list',$this->data);
    }
    public function notice_write()
    {
        $this->data['pid'] = 'notice_write';
        return view('admin/notice_write',$this->data);
    }
    
//      Q&A
    public function qna_list()
    {
        $this->data['pid'] = 'qna_list';
        return view('admin/qna_list',$this->data);
    }
    public function qna_view()
    {
        $this->data['pid'] = 'qna_view';
        return view('admin/qna_view',$this->data);
    }
    
//    메시지관리
    public function msg_list()
    {
        $this->data['pid'] = 'msg_list';
        return view('admin/msg_list',$this->data);
    }
    public function msg_write()
    {
        $this->data['pid'] = 'msg_write';
        return view('admin/msg_write',$this->data);
    }
    
//    LMS로그
    public function lms_log_list()
    {
        $this->data['pid'] = 'lms_log_list';
        return view('admin/lms_log_list',$this->data);
    }
    
//   출고지관리
    public function delivery_info_list()
    {
        $this->data['pid'] = 'delivery_info_list';
        return view('admin/delivery_info_list',$this->data);
    }
    public function delivery_info_write()
    {
        $this->data['pid'] = 'delivery_info_write';
        return view('admin/delivery_info_write',$this->data);
    }
}
