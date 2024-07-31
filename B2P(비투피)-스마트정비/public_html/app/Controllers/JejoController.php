<?php namespace App\Controllers;

class JejoController extends BaseController
{
    
    //제조사 정보관리
    public function member_list()
    {
        $this->data['pid'] = 'member_list';
        return view('jejo/member_list',$this->data);
    }
    public function member_write()
    {
        $this->data['pid'] = 'member_write';
        return view('jejo/member_write',$this->data);
    }
    

    //제품관리
    public function manager_product_list()
    {
        $this->data['pid'] = 'manager_product_list';
        return view('jejo/manager_product_list',$this->data);
    }
    public function manager_product_write()
    {
        $this->data['pid'] = 'manager_product_write';
        return view('jejo/manager_product_write',$this->data);
    }
    
    //재고관리
    public function manager_stock_list()
    {
        $this->data['pid'] = 'manager_stock_list';
        return view('jejo/manager_stock_list',$this->data);
    }
    public function manager_stock_write()
    {
        $this->data['pid'] = 'manager_stock_write';
        return view('jejo/manager_stock_write',$this->data);
    }

    
    //판매관리
    public function sell_list()
    {
        $this->data['pid'] = 'sell_list';
        return view('jejo/sell_list',$this->data);
    }
    
    //배송관리
    public function ship_list()
    {
        $this->data['pid'] = 'ship_list';
        return view('jejo/ship_list',$this->data);
    }
    
    //구매변경/취소
    public function cancel_list()
    {
        $this->data['pid'] = 'cancel_list';
        return view('jejo/cancel_list',$this->data);
    }

    
    //공지사항
    public function notice_list()
    {
        $this->data['pid'] = 'notice_list';
        return view('jejo/notice_list',$this->data);
    }
    
    //Q&A
    public function qna_list()
    {
        $this->data['pid'] = 'qna_list';
        return view('jejo/qna_list',$this->data);
    }
    public function qna_view()
    {
        $this->data['pid'] = 'qna_view';
        return view('jejo/qna_view',$this->data);
    }
    public function qna_write()
    {
        $this->data['pid'] = 'qna_write';
        return view('jejo/qna_write',$this->data);
    }
}
