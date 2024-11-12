<?php
include_once("./_common.php");


	if($bo_table =='b_notice'){
	
	$sql_fcm = "select * from g5_fcm group by token";
	$result_fcm = sql_query($sql_fcm);

	for ($i=0; $row=sql_fetch_array($result_fcm); $i++){
		    $tokens=array($row['token']);
            $push_message=array(
                "message"=>" ",
                "subject"=>"공지사항이 있습니다.",
                "goUrl"=>"",
                );

            $fcm=sendFcm($tokens,$push_message);

			if($row['mb_id']!=''){

					$now = date('Y-m-d H:i:s');
					$sql_list ="insert into g5_fcm_list set token = '{$row['token']}', mb_id = '{$row['mb_id']}', tes_id = {$wr_id}, type='공지',  wr_datetime = '{$now}' ";
					sql_query($sql_list);

			}
		}		
	}

?>