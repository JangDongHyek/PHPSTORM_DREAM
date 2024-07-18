<?php
include_once('./_common.php');

if($member['mb_level'] == 10){
    if(!empty($id)){

        $sql ="update g5_member set mb_1 = {$value} where mb_no = {$id}";
        sql_query($sql);

    }
}






?>