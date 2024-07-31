
<link href="/css/user.css?v=<?= filemtime(FCPATH . 'css/user.css'); ?>" rel="stylesheet" type="text/css">

<?
switch ($pid) {
    case "user_login" :
        $header_name = "로그인";
        break;
    case "rv_list01" :
        $header_name = "예약리스트";
        break;
    case "rv_list02" :
        $header_name = "예약리스트";
        break;
    case "rv_confirm" :
        $header_name = "예약확인";
        break;
    case "rv_write" :
        $header_name = "예약하기";
        break;

}


?>
<header>
    <a class="logo" href="<?=base_url('/user/rvList')?>">
        <img src="/img/common/logo.png" alt="">
    </a>
    <div class="title">
        <?php echo $header_name ?>
    </div>
</header>

<div id="user_content">
    <div class="<?php echo $pid;?>">

