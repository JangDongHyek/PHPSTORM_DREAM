<?
    /* ============================================================================================= */
    /* =   PAGE : 취소 요청 PAGE                                                                   = */
    /* = ----------------------------------------------------------------------------------------- = */
    /* =   가상계좌 취소의 경우는 발급한 가상계좌에 입금이 되지 않도록 발급계좌 해지를 의미합니다. = */
    /* =                                                                                           = */
    /* =   이미 입금이 된 가상계좌건에 대해 환불처리는 모듈에서 진행하는 부분은 아니며             = */
    /* =                                                                                           = */
    /* =   가맹점에서 자체적으로 환불처리를 진행해야 합니다.                                       = */
    /* =                                                                                           = */
    /* =   Copyright (c)  2024  NHN KCP Inc.   All Rights Reserverd.                              = */
    /* ============================================================================================= */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>*** NHN KCP FIXED VCNT MOD ***</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>

<script language="javascript">

    function  jsf__chk_mod( form )
    {
        if ( form.tno.value.length < 14 )
        {
            alert( "NHNKCP 거래 번호를 확인하세요" );
            form.tno.focus();
            return false;
        }
        else
        {
            return true;
        }
    }

    function  jsf__go_mod( form )
    {   
        if ( jsf__chk_mod( form ) == false )
        {           
            return false;
        }

        form.submit();
    } 

</script>

</head>
<body>
<div id="sample_wrap">
<form name="mod_form" action="pp_cli_hub.php" method="post">
    
    <h1>[고정식 가상계좌 중지요청] <span> 이 페이지는 고정식 가상계좌 중지 요청하는 샘플(예시) 페이지입니다.</span></h1>
    <!-- 상단 문구 -->
    <div class="sample">
        <p>소스 수정 시 가맹점의 상황에 맞게 적절히 수정 적용하시길 바랍니다.<br />
        결제에 필요한 정보를 정확하게 입력하시어 결제를 진행하시기 바랍니다.</p>
    <!-- 상단 테이블 End --> 
    
        <!-- 중지 요청 -->
        <h2>&sdot; 중지 요청</h2>
        <table class="tbl" cellpadding="0" cellspacing="0">
            <!-- 취소 요청 -->
            <tr>
            <th>거래번호</th>
                <td><input type="text" name="tno" class="w200" value="" maxlength="14"/></td>
            </tr>
            <!-- 사유 -->
            <tr>
            <th>사유</th>
                <td><input type="text" name="mod_desc" class="w100" value=""maxlength="100"/></td>
            </tr>
        </table>
    
        <div class="btnset" id="display_pay_button" style="display:block">  
            <input name="" type="button" class="submit" value="중지요청" onclick="jsf__go_mod(this.form);"/>
            <a href="../index.html" class="home">처음으로</a>
        </div>

    <input type="hidden" name="mod_type" value="STSC">                  
    </div>
</div>

</form>
</div>
</body>
</html>