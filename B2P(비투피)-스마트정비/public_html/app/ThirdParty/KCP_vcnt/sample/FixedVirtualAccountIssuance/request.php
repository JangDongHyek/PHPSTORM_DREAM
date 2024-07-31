<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
    /* ============================================================================== */
    /* =   PAGE : ������� �߱� ��û PAGE                                           = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2024  NHN KCP Inc.   All Rights Reserverd.                = */
    /* ============================================================================== */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>*** NHN KCP FIXED VCNT ***</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>

<script language="javascript">

        /* �ֹ���ȣ ���� ���� */
        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth() + 1;
            var date  = today.getDate();
            var time  = today.getTime();

            if(parseInt(month) < 10) {
                month = "0" + month;
            }

            if(parseInt(date) < 10) {
                date = "0" + date;
            }

            var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;

            document.order_info.ordr_idxx.value = order_idxx;            
        }
    
        function  jsf__chk_ssl_vcnt( form )
        {
            if (form.va_uniq_key.value == "")
            {
                alert("����ũ Ű�� ��Ȯ�� �Է��� �ֽñ� �ٶ��ϴ�.");
                form.va_uniq_key.focus();
                return false;
            }
            else if (form.ipgm_name.value == "")
            {
                alert("�Ա��ڸ��� �Է��� �ֽñ� �ٶ��ϴ�.");
                form.ipgm_name.focus();
                return false;
            }           
            else if (form.ipgm_bank.value == "XXXX")
            {
                alert("�Ա������� ������ �ֽñ� �ٶ��ϴ�.");
                form.ipgm_bank.focus();
                return false;
            }       
            else if (form.ipgm_date.value == "")
            {
                alert("�Աݿ������� �Է��� �ֽñ� �ٶ��ϴ�.");
                form.ipgm_date.focus();
                return false;
            }   
            else
            {
                return true;
            }
        }

        function  jsf__pay_vcnt( form )
        {
            
            if ( jsf__chk_ssl_vcnt( form ) == false )
            {           
                return false;
            }

            form.submit();
        } 
    
</script>
</head>
<body onload="init_orderid();">
<div id="sample_wrap">
<form name="order_info" action="./pp_cli_hub.php" method="post">
    <h1>[������ ������� ��û] <span> �� �������� ������� �߱� ��û�ϴ� ����(����) �������Դϴ�.</span></h1>
    <!-- ��� ���� -->
    <div class="sample">
        <p>�ҽ� ���� �� �������� ��Ȳ�� �°� ������ ���� �����Ͻñ� �ٶ��ϴ�.<br />
        ������ �ʿ��� ������ ��Ȯ�ϰ� �Է��Ͻþ� ������ �����Ͻñ� �ٶ��ϴ�.</p>
    <!-- ��� ���̺� End -->

        <!-- �ֹ����� Ÿ��Ʋ -->
        <h2>&sdot; �ֹ� ����</h2>
        <table class="tbl" cellpadding="0" cellspacing="0">
            <!-- �ֹ� ��ȣ -->
            <tr>
                <th>�ֹ� ��ȣ</th>
                <td><input type="text" name="ordr_idxx" class="w200" value="" maxlength="40"/></td>
            </tr>
            <!-- ����ũ Ű(������� ���� Ű) -->
            <tr>
                <th>����ũ Ű(���� Ű)</th>
                <td><input type="text" name="va_uniq_key" class="w100" value=""maxlength="20"/></td>
            </tr>
            <!-- ��ǰ�� -->
            <tr>
                <th>��ǰ��</th>
                <td><input type="text" name="good_name" class="w100" value="�ڵ���" /></td>
            </tr>                       
            <!-- �ֹ��� �̸� -->
            <tr>
                <th>�ֹ��ڸ�</th>
                <td><input type="text" name="buyr_name" class="w100" value="ȫ�浿" maxlength="20" /></td>
            </tr>
            <!-- �ֹ��� �̸� -->
            <tr>
                <th>�ֹ��� E-Mail</th>
                <td><input type="text" name="buyr_mail" class="w100" value="test@kcp.co.kr" maxlength="40" /></td>
            </tr>
            <!-- �ֹ��� �̸� -->
            <tr>
                <th>�ֹ��� ��ȭ��ȣ</th>
                <td><input type="text" name="buyr_tel1" class="w100" value="02-0000-1000" maxlength="20" /></td>
            </tr>                       
            <!-- �ֹ��� �̸� -->
            <tr>
                <th>�ֹ��� �޴�����ȣ</th>
                <td><input type="text" name="buyr_tel2" class="w100" value="010-1234-5678" maxlength="20" /></td>
            </tr>                       
                        
        </table>
        <!-- �ֹ� ���� ��� ���̺� End -->

        <!-- �������� Ÿ��Ʋ -->
        <h2>&sdot; ���� ����</h2>
        <table class="tbl" cellpadding="0" cellspacing="0">
            <!-- �Ա� �ݾ� -->
            <tr>
                <th>�Ա� �ݾ�</th>
                <td><input type="text" name="good_mny" class="w100" value="0" maxlength="9"/>��(���ڸ� �Է�)</td>
            </tr>
            <!-- �Ա��ڸ� -->
            <tr>
                <th>�Ա��ڸ�</th>
                <td><input type="text" name="ipgm_name" value="" maxlength="10"></td>
            </tr>
            <!-- �Ա����� -->
            <tr>
                <th>�Ա�����</th>
                <td>
                <select name="ipgm_bank">
                    <option value="XXXX" selected>����</option>
                    <option value="BK03">�������</option>
                    <option value="BK04">��������</option>
                    <option value="BK07">��������</option>
                    <option value="BK11">�����߾�ȸ</option>
                    <option value="BK20">�츮����</option>
                    <option value="BK23">SC��������</option>
                    <option value="BK32">�λ�����</option>
                    <option value="BK34">��������</option>
                    <option value="BK71">��ü��</option>
                    <option value="BK81">KEB�ϳ�����</option>
                    <option value="BK26">��������</option>
                    <option value="BK31">�뱸����</option>
                    <option value="BK39">�泲����</option>					
                </select>
                </td>
            <tr>
                <th>�Ա� ������</th>
                <td><input type="text" name="ipgm_date" value="" maxlength="14"> ( ��: 20231228142019 )</td> 
            </tr>
        </table>
                    
        <!-- ������� �߱� ��û  Start -->
        
        <div class="btnset" id="display_pay_button" style="display:block">  
            <input name="" type="button" class="submit" value="�߱޿�û" onclick="jsf__pay_vcnt(this.form);"/>
            <a href="../index.html" class="home">ó������</a>
        </div>
    </div>
    <!-- ������� �߱� ��û End -->
    <div class="footer">
    Copyright (c) NHN KCP INC. All Rights reserved.
    </div>

<!-- KCP ���� �ʼ��׸� �����Ұ� -->
<input type="hidden" name="currency"    value="410">  <!-- �ʼ� �׸� : ���� �ݾ�/ȭ����� -->

</form>
</div>
</body>
</html>