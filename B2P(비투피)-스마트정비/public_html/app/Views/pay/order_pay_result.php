<?
/* ============================================================================== */
/* =   PAGE : 결제 결과 출력 PAGE                                               	= */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* =   지불 결과                                                                = */
/* = -------------------------------------------------------------------------- = */
$res_cd           = $_POST[ "res_cd"       ];      // 결과 코드
$res_msg          = $_POST[ "res_msg"      ];      // 결과 메시지
$amount           = $_POST[ "amount"       ];      // 총금액

$res_msg = iconv("euc-kr","utf-8",$res_msg);

/* = -------------------------------------------------------------------------- = */
$ordr_idxx        = $_POST[ "ordr_idxx"    ];      // 주문번호
$tno              = $_POST[ "tno"          ];      // NHN KCP 거래번호
$good_mny         = $_POST[ "good_mny"     ];      // 결제 금액
$good_name        = $_POST[ "good_name"    ];      // 상품명
$buyr_name        = $_POST[ "buyr_name"    ];      // 구매자명
$buyr_tel2        = $_POST[ "buyr_tel2"    ];      // 구매자 휴대폰번호
$buyr_mail        = $_POST[ "buyr_mail"    ];      // 구매자 E-Mail

$good_name = iconv("euc-kr","utf-8",$good_name);
$buyr_name = iconv("euc-kr","utf-8",$buyr_name);
/* = -------------------------------------------------------------------------- = */
$card_cd          = $_POST[ "card_cd"      ];      // 카드 코드
$card_no          = $_POST[ "card_no"      ];      // 카드 번호
$card_name        = $_POST[ "card_name"    ];      // 카드명
$app_time         = $_POST[ "app_time"     ];      // 승인시간
$app_no           = $_POST[ "app_no"       ];      // 승인번호
$quota            = $_POST[ "quota"        ];      // 할부개월

$card_name = iconv("euc-kr","utf-8",$card_name);

/* = -------------------------------------------------------------------------- = */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>가맹점 결제 결과</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <link href="/css/KCP_pay.css?v=<?= filemtime(FCPATH . 'css/KCP_pay.css'); ?>" rel="stylesheet" type="text/css" id="cssLink"/>
</head>
<body>
<div class="wrap">
    <form name="cancel" method="post">
        <!-- header -->
        <div class="header">
            <a href="../pay/OrderPay" class="btn-back"><span>뒤로가기</span></a>
            <h1 class="title">결과 출력</h1>
        </div>
        <!-- //header -->
        <!-- contents -->
        <div id="skipCont" class="contents">
            <p class="txt-type-2">요청 결과를 출력하는 페이지 입니다.<br />요청이 정상적으로 처리된 경우 결과코드(res_cd)값이 0000으로 표시됩니다.</p>
            <h2 class="title-type-3">처리결과</h2>
            <?
            /* ============================================================================== */
            /* =   결제 결과 코드 및 메시지 출력(결과페이지에 반드시 출력해주시기 바랍니다.)= */
            /* = -------------------------------------------------------------------------- = */
            /* =   결제 정상 : res_cd값이 0000으로 설정됩니다.                              = */
            /* =   결제 실패 : res_cd값이 0000이외의 값으로 설정됩니다.                     = */
            /* = -------------------------------------------------------------------------- = */
            ?>
            <ul class="list-type-1">
                <!-- 결과 코드 -->
                <li>
                    <div class="left"><p class="title">결과코드</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_cd ?></div></div>
                </li>
                <!-- 결과 메시지 -->
                <li>
                    <div class="left"><p class="title">결과메세지</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?= $res_msg ?></div></div>
                </li>
            </ul>

            <?
            /* ============================================================================== */
            /* =   정상 결제시 공통 결과 정보 출력 ( res_cd값이 0000인 경우)                  = */
            /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )                  // 정상 승인
            {
                ?>
                <div class="line-type-1"></div>
                <!-- 주문내역 -->
                <h2 class="title-type-3">주문정보</h2>
                <ul class="list-type-1">
                    <!-- 주문번호 -->
                    <li>
                        <div class="left"><p class="title">주문번호</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$ordr_idxx?></div></div>
                    </li>
                    <!-- KCP 거래번호 -->
                    <li>
                        <div class="left"><p class="title">KCP 거래번호</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$tno?></div></div>
                    </li>
                    <!-- 상품명 -->
                    <li>
                        <div class="left"><p class="title">상품명</p></div>
                        <div class="right"><?=$good_name?></div>
                    </li>
                    <!-- 결제금액 -->
                    <li>
                        <div class="left"><p class="title">결제금액</p></div>
                        <div class="right"><?= $amount ?>원</div>
                    </li>
                    <!-- 주문자명(buyr_name) -->
                    <li>
                        <div class="left"><p class="title">주문자명</p></div>
                        <div class="right"><?= $buyr_name ?></div>
                    </li>
                    <!-- 휴대폰번호(buyr_tel2) -->
                    <li>
                        <div class="left"><p class="title">휴대폰번호</p></div>
                        <div class="right"><?= $buyr_tel2 ?></div>
                    </li>
                    <!-- 주문자 E-mail(buyr_mail) -->
                    <li>
                        <div class="left"><p class="title">E-mail</p></div>
                        <div class="right"><?= $buyr_mail ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                <h2 class="title-type-3">신용카드 정보</h2>

                <ul class="list-type-1">
                    <!-- 결제 카드 -->
                    <li>
                        <div class="left"><p class="title">결제 카드</p></div>
                        <div class="right"><?=$card_cd ?> / <?=$card_name ?></div>
                    </li>
                    <!-- 승인 시간 -->
                    <li>
                        <div class="left"><p class="title">승인 시간</p></div>
                        <div class="right"><?=$app_time?></div>
                    </li>
                    <!-- 승인 번호 -->
                    <li>
                        <div class="left"><p class="title">승인 번호</p></div>
                        <div class="right"><?=$app_no?></div>
                    </li>
                    <!-- 할부 개월 -->
                    <li>
                        <div class="left"><p class="title">할부 개월</p></div>
                        <div class="right"><?=$quota ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>
                <?
            }
            ?>
            <div Class="Line-Type-1"></div>
            <ul class="list-btn-2">
                <li><a href="../pay/OrderPay" class="btn-type-3 pc-wd-2">처음으로</a></li>
            </ul>
        </div>
        <!-- //contents -->
        <div class="grid-footer">
            <div class="inner">
                <!-- footer -->
                <div class="footer">
                    ⓒ NHN KCP Corp.
                </div>
                <!-- //footer -->
            </div>
        </div>
    </form>
</div>
</body>
</html>