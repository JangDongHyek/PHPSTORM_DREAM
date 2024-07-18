<?php
include_once('./_common.php');

if(!empty($id)){		

		$sql ="update g5_write_{$flg} set wr_5 = {$value} where wr_id = {$id}";
		sql_query($sql);

    if($value == "3"){
        $sql = "select * from g5_write_{$flg} where `wr_id` = '$id'";
        $row = sql_fetch($sql);

        if($flg == "apply01"){
            $bo_table = "edu";
        } else  if($flg == "apply02"){
            $bo_table = "certify";
        } else  if($flg == "apply03"){
            $bo_table = "academy";
        }

        $sql = "select * from `g5_order_list` where `mb_id` = '$row[mb_id]' and `bo_table` = '$bo_table' and `write_id` = '$row[wr_10]' and `TID` != ''";
        $order_row = sql_fetch($sql);
        if(!empty($order_row)){
            $objData = array(
                "mid" => $order_row['MID'],
                "tid" => $order_row['TID'],
                "svcCd" => "01",
                "cancelAmt" => $order_row['sum_cost'],
                "cancelMsg" => "취소",
                "cancelPwd" => $CANCEL_PASSWORD
            );
            $jsonData = json_encode($objData);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.innopay.co.kr/api/cancelApi",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json; charset=utf-8"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            var_dump($response);

            if(!$err){
                $sql = "update `g5_order_list` set `state` = '4' where `idx` = '$order_row[idx]'";
                sql_query($sql);

                $sql ="update g5_write_{$flg} set wr_7 = '' where wr_id = {$id}";
		        sql_query($sql);
            }
        }
    }

}




?>