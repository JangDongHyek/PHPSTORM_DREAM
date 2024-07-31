<?php namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function login() {
        $this->data['pid'] = 'user_login';

        $session = session();
        $user = $session->get('user');
        if(!empty($user)){
            return redirect()->to('/user/rvWrite');
        }

        return view('user/login',$this->data);
    }
    
    public function ajax_check_order(){
        $userModel = new UserModel();
        $result = $userModel->checkOrder($this->data);
        return $this->response->setJSON($result);
    }

    public function rv_list01()
    {
        $this->data['pid'] = 'rv_list01';
        return view('user/rv_list01',$this->data);
    }
    public function rv_list02()
    {
        $this->data['pid'] = 'rv_list02';
        return view('user/rv_list02',$this->data);
    }
    public function rv_write()
    {
        $this->data['pid'] = 'rv_write';
        return view('user/rv_write',$this->data);
    }

    public function rv_confirm()
    {
        $this->data['pid'] = 'rv_confirm';
        return view('user/rv_confirm',$this->data);
    }
    
    
}
