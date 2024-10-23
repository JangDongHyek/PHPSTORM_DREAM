<?php

if ($recent_totalCount * 1 <= 0 && $member){
    //* 구매이력 없는 회원만 */
    //require_once(APPPATH.'mall/index_no_purchase.php');
}else if ($recent_totalCount * 1 > 0 && $member){
    //* 구매이력 있는 회원만 */
    //require_once(APPPATH.'mall/index_yes_purchase.php');
} else {
    //require_once(APPPATH.'mall/index_main.php');
}

?>
