<?
/* ============================================================================== */
/* =   PAGE : 가상계좌 해지 결과 출력 PAGE                                      = */
/* = -------------------------------------------------------------------------- = */
/* =   가상계좌 결과값을 출력하는 페이지입니다.                                 = */
/* =   Copyright (c)  2024  NHN KCP Inc.   All Rights Reserverd.                = */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* =   지불 결과                                                                = */
/* = -------------------------------------------------------------------------- = */
$res_cd      = $_POST[ "res_cd"      ];             // 결과 코드
$res_msg     = $_POST[ "res_msg"     ];             // 결과 메시지
/* = -------------------------------------------------------------------------- = */
$res_msg = iconv("euc-kr","utf-8",$res_msg);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>*** NHN KCP ***</title>
    <meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    <link href="/css/KCP_vcnt.css?v=<?= filemtime(FCPATH . 'css/KCP_vcnt.css'); ?>" rel="stylesheet" type="text/css" id="cssLink"/>
</head>
<body>
<form name="cancel" method="post">
    <div id="sample_wrap">
        <!--타이틀-->
        <h1>[결과출력]</h1>
        <!--//타이틀-->
        <div class="sample">
            <!--상단문구-->
            <p>
                요청 결과를 출력하는 페이지 입니다.<br />
                요청이 정상적으로 처리된 경우 결과코드(res_cd)값이 0000으로 표시됩니다.
            </p>
            <!--//상단문구-->

            <?
            /* ============================================================================== */
            /* =   결제 결과 코드 및 메시지 출력(결과페이지에 반드시 출력해주시기 바랍니다.)= */
            /* = -------------------------------------------------------------------------- = */
            /* =   결제 정상 : res_cd값이 0000으로 설정됩니다.                              = */
            /* =   결제 실패 : res_cd값이 0000이외의 값으로 설정됩니다.                     = */
            /* = -------------------------------------------------------------------------- = */
            ?>
            <h2>&sdot; 처리 결과</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 결과 코드 -->
                <tr>
                    <th>결과 코드</th>
                    <td><?=$res_cd?></td>
                </tr>
                <!-- 결과 메시지 -->
                <tr>
                    <th>결과 메세지</th>
                    <td><?=$res_msg?></td>
                </tr>
            </table>
            <?
            /* = -------------------------------------------------------------------------- = */
            /* =   결제 결과 코드 및 메시지 출력 끝                                         = */
            /* ============================================================================== */
            ?>

            <tr>

                <div class="btnset">
                    <a href="<?=base_url()?>pay/OrderVcntCancle" class="home">처음으로</a>
                </div>
            </tr>
            </tr>
        </div>
        <div class="footer">
            Copyright (c) NHN KCP INC. All Rights reserved.
        </div>
    </div>
</body>
</html>