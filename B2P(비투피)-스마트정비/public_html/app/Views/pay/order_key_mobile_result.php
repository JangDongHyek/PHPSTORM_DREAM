<?
/* ============================================================================== */
/* =   PAGE : 결제 결과 출력 PAGE                                               	= */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* =   01. 인증 결과                                                            = */
/* = -------------------------------------------------------------------------- = */
$res_cd      = $_POST[ "res_cd"      ];                // 결과 코드
$res_msg     = $_POST[ "res_msg"     ];                // 결과 메시지
/* = -------------------------------------------------------------------------- = */
$ordr_idxx   = $_POST[ "ordr_idxx"   ];                // 주문번호
$buyr_name   = $_POST[ "buyr_name"   ];                // 주문자명

$card_cd     = $_POST[ "card_cd"     ];                // 카드 코드
$batch_key   = $_POST[ "batch_key"   ];                // 배치키

/* ============================================================================== */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>가맹점 결제 샘플페이지</title>
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
        <!-- 타이틀 Start -->
        <div class="header">
            <h1 class="title">배치키 발급 결과 출력</h1>
        </div>
        <!-- 타이틀 End -->

        <div id="skipCont" class="contents">
            <p class="txt-type-1">이 페이지는 배치키 결과를 출력하는 샘플(예시) 페이지입니다.</p>
            <p class="txt-type-2">요청 결과를 출력하는 페이지 입니다.<br />정상적으로 처리된 경우 결과코드(res_cd)값이 0000으로 표시됩니다.</p>
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
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$res_cd?></div></div>
                </li>
                <!-- 결과 메시지 -->
                <li>
                    <div class="left"><p class="title">결과메세지</p></div>
                    <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$res_msg?></div></div>
                </li>
            </ul>

            <?
            /* ============================================================================== */
            /* =   1. 정상 결제시 결제 결과 출력 ( res_cd값이 0000인 경우)                  = */
            /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )
            {
                ?>
                <div class="line-type-1"></div>

                <h2 class="title-type-3">주문정보</h2>
                <ul class="list-type-1">
                    <!-- 주문번호 -->
                    <li>
                        <div class="left"><p class="title">주문번호</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$ordr_idxx?></div></div>
                    </li>

                    <!-- 주문자명 -->
                    <li>
                        <div class="left"><p class="title">주문자명</p></div>
                        <div class="right"><?= $buyr_name ?></div>
                    </li>
                </ul>

                <h2 class="title-type-3">정기 과금 정보</h2>
                <ul class="list-type-1">
                    <!-- 인증카드코드 -->
                    <li>
                        <div class="left"><p class="title">인증카드코드</p></div>
                        <div class="right"><div class="ipt-type-1 pc-wd-2"><?=$card_cd?></div></div>
                    </li>

                    <!-- 배치키 -->
                    <li>
                        <div class="left"><p class="title">배치키</p></div>
                        <div class="right"><?= $batch_key ?></div>
                    </li>
                </ul>
                <div class="line-type-1"></div>

                <?
            }
            ?>
            <div Class="Line-Type-1"></div>
            <ul class="list-btn-2">
                <li><a href="../pay/OrderKeyMobile" class="btn-type-3 pc-wd-2">처음으로</a></li>
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