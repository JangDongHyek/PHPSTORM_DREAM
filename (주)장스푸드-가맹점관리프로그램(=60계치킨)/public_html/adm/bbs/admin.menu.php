<?php

$sub_menu = "001000";  

if ($_GET['bo_table'] == 'notice') {
	$sub_menu = "001500";   
}

auth_check($auth[$sub_menu], 'r'); 

$token = get_token();

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.'); 

?>