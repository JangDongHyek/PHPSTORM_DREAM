<?
    /* ============================================================================================= */
    /* =   PAGE : ��� ��û PAGE                                                                   = */
    /* = ----------------------------------------------------------------------------------------- = */
    /* =   ������� ����� ���� �߱��� ������¿� �Ա��� ���� �ʵ��� �߱ް��� ������ �ǹ��մϴ�. = */
    /* =                                                                                           = */
    /* =   �̹� �Ա��� �� ������°ǿ� ���� ȯ��ó���� ��⿡�� �����ϴ� �κ��� �ƴϸ�             = */
    /* =                                                                                           = */
    /* =   ���������� ��ü������ ȯ��ó���� �����ؾ� �մϴ�.                                       = */
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
            alert( "NHNKCP �ŷ� ��ȣ�� Ȯ���ϼ���" );
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
    
    <h1>[������ ������� ������û] <span> �� �������� ������ ������� ���� ��û�ϴ� ����(����) �������Դϴ�.</span></h1>
    <!-- ��� ���� -->
    <div class="sample">
        <p>�ҽ� ���� �� �������� ��Ȳ�� �°� ������ ���� �����Ͻñ� �ٶ��ϴ�.<br />
        ������ �ʿ��� ������ ��Ȯ�ϰ� �Է��Ͻþ� ������ �����Ͻñ� �ٶ��ϴ�.</p>
    <!-- ��� ���̺� End --> 
    
        <!-- ���� ��û -->
        <h2>&sdot; ���� ��û</h2>
        <table class="tbl" cellpadding="0" cellspacing="0">
            <!-- ��� ��û -->
            <tr>
            <th>�ŷ���ȣ</th>
                <td><input type="text" name="tno" class="w200" value="" maxlength="14"/></td>
            </tr>
            <!-- ���� -->
            <tr>
            <th>����</th>
                <td><input type="text" name="mod_desc" class="w100" value=""maxlength="100"/></td>
            </tr>
        </table>
    
        <div class="btnset" id="display_pay_button" style="display:block">  
            <input name="" type="button" class="submit" value="������û" onclick="jsf__go_mod(this.form);"/>
            <a href="../index.html" class="home">ó������</a>
        </div>

    <input type="hidden" name="mod_type" value="STSC">                  
    </div>
</div>

</form>
</div>
</body>
</html>