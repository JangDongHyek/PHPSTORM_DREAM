<?php
//if (!defined('_GNUBOARD_')) exit;
include_once ('../common.php');
//include_once(G5_PATH.'/head.sub.php');
include_once(G5_THEME_PATH.'/head.sub.php');

//include_once(G5_ADMIN_PATH.'/admin.lib.php');
//include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

if(!$is_admin){
    alert('관리자만 접근 가능합니다.', G5_URL."/bbs/login.php");
    exit;
}

if(empty($type)){
    $type = "베네피아";
}

$pid = "benepia";
$sub_menu = '100000';
if($type == "복지몰"){
    $pid = "benecafe";
    $sub_menu = '200000';
}

?>
<link rel="stylesheet" href="./css/style.css?v=<?=G5_CSS_VER?>">

<header>
    <a href="./index.php">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" class="logo">
        <strong>고객리스트</strong>
    </a>
    <ul class="menu">
        <li>
            <a href="./userlist.php?type=베네피아" class="<?php if($sub_menu =="100000") { echo ' active'; } ?>">베네피아 캐쉬백 고객 리스트</a>
        </li>
        <li>
            <a href="./userlist.php?type=복지몰" class="<?php if($sub_menu =="200000") { echo ' active'; } ?>">복지몰 캐쉬백 고객 리스트</a>
        </li>
    </ul>
</header>

<div id="admin">
    <div class="container">