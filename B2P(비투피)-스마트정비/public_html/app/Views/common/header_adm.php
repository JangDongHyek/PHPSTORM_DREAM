<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <link rel="canonical" href=""/>
    <meta name="Keywords" content="">
    <!--오픈그래프-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="B2P">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <!--오픈그래프 끝-->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2P</title>

    <style>
    </style>
    <link href="/css/all.min.css?v=<?= filemtime(FCPATH . 'css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/fonts.css?v=<?= filemtime(FCPATH . 'css/fonts.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css?v=<?= filemtime(FCPATH . 'css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/common.css?v=<?= filemtime(FCPATH . 'css/common.css'); ?>" rel="stylesheet" type="text/css">
    <link href="/css/adm.css?v=<?= filemtime(FCPATH . 'css/adm.css'); ?>" rel="stylesheet" type="text/css">
    <?/**/?>
    <link href="/css/sweetalert2.min.css?v=<?= filemtime(FCPATH . 'css/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css">

    <script src="/js/jquery-3.7.1.min.js?v=<?= filemtime(FCPATH . 'js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="/js/sweetalert2.all.min.js?v=<?= filemtime(FCPATH . 'js/sweetalert2.all.min.js'); ?>"></script>
    <script src="/js/modal.js?v=<?= filemtime(FCPATH . 'js/modal.js'); ?>"></script>
    <script src="/js/common.js?v=<?= filemtime(FCPATH . 'js/common.js'); ?>"></script>
    <script src="/js/ui.js?v=<?= filemtime(FCPATH . 'js/ui.js'); ?>"></script>
    <script src="/js/bootstrap.min.js?v=<?= filemtime(FCPATH . 'js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.7/dayjs.min.js"></script><!--date.js-->
    <script>
        const baseUrl = '<?=base_url()?>';
    </script>
</head>

<body>
    <div id="loading" style="display: none;">
        <div class="box_wrap">
            <div class="box">
                <img src="/img/common/logo.png">
                <p>loading</p>
            </div>
        </div>
    </div>
