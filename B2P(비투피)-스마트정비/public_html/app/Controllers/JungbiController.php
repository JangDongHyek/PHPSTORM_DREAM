<?php namespace App\Controllers;

class JungbiController extends BaseController
{
    
//    정보관리
    public function member_list()
    {
        $this->data['pid'] = 'member_list';
        return view('jungbi/member_list',$this->data);
    }
    public function member_write()
    {
        $this->data['pid'] = 'member_write';
        return view('jungbi/member_write',$this->data);
    }
    
    
//    예약관리
    public function reserv_list()
    {
        $this->data['pid'] = 'reserv_list';
        return view('jungbi/reserv_list',$this->data);
    }
    
    //Q&A
    public function qna_list()
    {
        $this->data['pid'] = 'qna_list';
        return view('jungbi/qna_list',$this->data);
    }
    public function qna_view()
    {
        $this->data['pid'] = 'qna_view';
        return view('jungbi/qna_view',$this->data);
    }
    public function qna_write()
    {
        $this->data['pid'] = 'qna_write';
        return view('jungbi/qna_write',$this->data);
    }
}
