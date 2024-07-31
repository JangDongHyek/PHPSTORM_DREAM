
<!DOCTYPE html>
<html lang="en">

<head>


    <!--
<meta name="description" content="손대면 톡 먹고 싶은 생밤을 간편하게, 자연터짐 약단밤, 칼집밤, 군밤용 판매 및 안내">
<link rel="canonical" href="http://www.chungha.co.kr/"/> 
<meta name="Keywords" content="생밤, 약담밤, 칼집밤, 군밤">
-->

    <!--오픈그래프-->
    <!--
<meta property="og:type" content="website">
<meta property="og:title" content="청하생률">
<meta property="og:description" content="손대면 톡 먹고 싶은 생밤을 간편하게, 자연터짐 약단밤, 칼집밤, 군밤용 판매 및 안내">
<meta property="og:image" content="http://chungha.co.kr/assets/img/common/logo.svg">
<meta property="og:url" content="http://www.chungha.co.kr">
-->
    <!--오픈그래프 끝-->


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2P</title>

    <link href="/css/all.min.css?v=<?= filemtime(FCPATH . 'css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/sweetalert2.min.css?v=<?= filemtime(FCPATH . 'css/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/common.css?v=<?= filemtime(FCPATH . 'css/common.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/fonts.css?v=<?= filemtime(FCPATH . 'css/fonts.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/adm.css?v=<?= filemtime(FCPATH . 'css/adm.css'); ?>" rel="stylesheet" type="text/css">

    <script src="/js/jquery-3.7.1.min.js?v=<?= filemtime(FCPATH . 'js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="/js/sweetalert2.all.min.js?v=<?= filemtime(FCPATH . 'js/sweetalert2.all.min.js'); ?>"></script>
    <script src="/js/modal.js?v=<?= filemtime(FCPATH . 'js/modal.js'); ?>"></script>
    <script src="/js/common.js?v=<?= filemtime(FCPATH . 'js/common.js'); ?>"></script>
    <script>
        const baseUrl = '<?=base_url()?>';
    </script>
</head>


<?php
//    $header_type = 0;       // 헤더타입
//    $header_name = "";      // 상단페이지명
//    $lnb_name = "";      // 서브페이지명
//    $content_id = "";       // div id
//    $content_class = "";    // div class
//    
//    
//    switch ($pid) {
//        case "login" :
//        $header_name = "로그인";
//        break;
//    }
?>


<body class="user_body">

    <div id="loading" style="display: none;">
        <div class="box_wrap">
            <div class="box">
                <img src="/img/common/logo.png">
                <p>loading</p>
            </div>
        </div>
    </div>
