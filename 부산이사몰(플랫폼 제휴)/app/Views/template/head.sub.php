<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes">

    <!--<meta property="og:type" content="website">
    <meta property="og:title" content="부산이사몰">
    <meta property="og:description" content="쉽고 간단한 이사서비스 부산이사몰">
    <meta property="og:image" content="/img/common/logo.svg">-->

    <meta name="description" content="쉽고 간편한 이사서비스·실시간 이사 견적비교, 부산이사몰">
    <link rel="canonical" href="https://www.knn24.com"/>
    <meta name="Keywords" content="부울경이사, 부산지역 이사, 부산이사, 포장이사, 반포장이사, 일반이사, 원룸이사, 사다리차">

    <!--오픈그래프-->
    <meta property="og:type" content="website">
    <meta property="og:title" content="부산이사몰">
    <meta property="og:description" content="쉽고 간편한 이사서비스·실시간 이사 견적비교, 부산이사몰">
    <meta property="og:image" content="https://www.knn24.com/img/common/logo.svg">
    <meta property="og:url" content="https://www.knn24.com/">
    <!--오픈그래프 끝-->

    <title>부산이사몰</title>
    <script src="<?=base_url()?>js/lib/jquery-3.6.4.min.js"></script>
    <script src="<?=base_url()?>js/lib/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/lib/swiper-bundle.min.js"></script>
    <script src="<?=base_url()?>js/lib/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>js/common/utils.js?<?=JS_VER?>"></script>
    <script src="<?=base_url()?>js/common/common.js?<?=JS_VER?>"></script>
    <script src="<?=base_url()?>js/common/api.js?<?=JS_VER?>"></script>
    <script src="<?=base_url()?>js/common/search.js"></script>
    <script src="<?=base_url()?>js/ui.js?<?=JS_VER?>"></script>
    <script src="<?=base_url()?>js/common/files.js"></script>
    <!--<script src="<?=base_url()?>js/lib/dayjs.min.js"></script>-->
    <script src="<?=base_url()?>js/common/services.js?<?=JS_VER?>"></script>
    <script>
        const baseUrl = '<?=base_url()?>';
        const adPrice = <?=json_encode(AD_PRICE)?>;
        const hpPrice = <?=json_encode(HP_PRICE)?>;
        const isLoggedIn = <?= json_encode(session()->get('member') !== null) ?>;
        const member = <?= json_encode(session()->get('member')) ?>;
    </script>

    <link rel="shortcut icon" href="<?=base_url()?>img/common/favicon.png"/>
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/common.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/layout.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/style.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/font.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/all.min.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <?php // 로딩중 ?>
    <div id="loading" class="hide">
        <div class="box_wrap">
            <div class="box">
                <img src="<?=base_url()?>img/common/logo_mark.svg">
                <p>loading</p>
            </div>
        </div>
    </div>
