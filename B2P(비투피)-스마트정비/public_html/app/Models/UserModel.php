<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    public function checkOrder($data){
        $name = trim($data['name']);
        $hp = trim(str_replace("-", "", $data['hp']));
        $orderNo = trim($data['orderNo']);

        if(empty($name)){
            return ['code'=>400, 'msg'=>'주문번호를 확인해주세요.'];
        }

        if(empty($name)){
            return ['code'=>400, 'msg'=>'성함을 확인해주세요.'];
        }

        if(empty($hp)){
            return ['code'=>400, 'msg'=>'연락처를 확인해주세요.'];
        }

        $sql = "SELECT * FROM `order_list` WHERE `OrderNo` = '$orderNo' 
            AND (`BuyerName` = '$name' OR `ReceiverName` = '$name')
            AND (REPLACE(`BuyerMobileTel`, '-', '') = '$hp' OR REPLACE(`HpNo`, '-', '') = '$hp')";
        $row = sql_fetch($sql);

        if(empty($row)){
            return ['code'=>400, 'msg'=>'입력한 정보를 다시 확인해주세요.'];
        }

        // 세션 객체 생성
        $session = session();

        // 세션에 사용자 정보 저장
        $session->set('user', [
            'orderNo' => $row['OrderNo'],
            'name' => $name,
            'hp' => $hp
        ]);

        return ['code'=>200, 'msg'=>'로그인되었습니다.'];

    }
}