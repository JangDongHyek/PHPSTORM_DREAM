<?php
	header('Content-Type: text/html; charset=euc-kr');
	//**************************************************************************
	// ���ϸ� : hs_cnfrm_popup1.php
	//
	// ����Ȯ�μ��� ��û ���� �Է� ȭ��
	//
	//**************************************************************************
?>
<html>
<head>
<title>KCB ����Ȯ�μ��� ����</title>
<style type="text/css">
.table_style ul {
 clear: left;
 margin: 0; 
 padding: 0; 
 list-style-type: none; 
}
.table_style ul li {
 float: left;
 margin: 0;
 padding: 2px 1px;
}
.table_style ul .column1 {
 width: 140px; 
}
</style>
<script>
<!--
	function jsSubmit(){	
		var form1 = document.form1;
		var inTpBit = "";

		inTpBit = form1.in_tp_bit.value;

		if (inTpBit & 1) {
			if (form1.name.value == "") {
				alert("������ �Է����ּ���");
				return;
			}
		}
		if (inTpBit & 2) {
			if (form1.birthday.value == "") {
				alert("��������� �Է����ּ���");
				return;
			}
		}
		if (inTpBit & 8) {
			if (form1.tel_com_cd.value == "") {
				alert("��Ż��ڵ带 �Է����ּ���");
				return;
			}
			if (form1.tel_no.value == "") {
				alert("�޴�����ȣ�� �Է����ּ���");
				return;
			}
		}

		window.open("", "auth_popup", "width=430,height=590,scrollbar=yes");

		var form1 = document.form1;
		form1.target = "auth_popup";
		form1.submit();
	}

	function input_display() {
		if (document.form1.in_tp_bit.value == '0') {
			document.getElementById('divInput').style.display = 'none';
		}
		else {
			document.getElementById('divInput').style.display = 'block';
		}
	}
//-->
</script>
</head>
<body>
<form name="form1" action="hs_cnfrm_popup2.php" method="post">
<input type=hidden name="rqst_caus_cd" value="00">
<input type=hidden name="in_tp_bit" value="7">




	<div>
		<strong> - KCB �������� �Է¿�</strong>
	</div>
	<div class="table_style">


		</ul>
		<div id="divInput">
			<ul>
				<li class="column1">����</li>
				<li>
					<input type="text" name="name" maxlength="20" size="20" value="">
				</li>
			</ul>
			<ul>
				<li class="column1">�������</li>
				<li>
					<input type="text" name="birthday" maxlength="8" size="10" value="">
				</li>
			</ul>
			<ul>
				<li class="column1">����</li>
				<li>
					<input type="radio" name="sex" value="1" checked>��
					<input type="radio" name="sex" value="0">��
			</ul>
			<ul>
				<li class="column1">���ܱ��α���</li>
				<li>
					<input type="radio" name="nation" value="1" checked>������
					<input type="radio" name="nation" value="2">�ܱ���
			</ul>
			<ul>
				<li class="column1">�޴���</li>
				<li>
					<select name="tel_com_cd">
						<option value="">��Ż缱��</option>
						<option value="01">SKT</option>
						<option value="02">KT</option>
						<option value="03">LGU+</option>
						<option value="04">�˶���SKT</option>
						<option value="05">�˶���KT</option>
						<option value="06">�˶���LGU+</option>
					</select>
					<input type="text" name="tel_no" maxlength="11" size="15" value="">
				</li>
			</ul>
		</div>
	</div>
	<div>
		<input type="button" value="����Ȯ��" onClick="jsSubmit();">
	</div>
</form>

<!-- ����Ȯ�� ó����� ���� -->
<form name="kcbResultForm" method="post" >
	<input type="hidden" name="mem_id" 					value="" 	/>
	<input type="hidden" name="svc_tx_seqno"			value=""	/>
	<input type="hidden" name="rqst_caus_cd"			value="" 	/>
	<input type="hidden" name="result_cd" 				value="" 	/>
	<input type="hidden" name="result_msg" 				value="" 	/>
	<input type="hidden" name="cert_dt_tm" 				value="" 	/>
	<input type="hidden" name="di" 						value="" 	/>
	<input type="hidden" name="ci" 						value="" 	/>
	<input type="hidden" name="name" 					value="" 	/>
	<input type="hidden" name="birthday" 				value="" 	/>
	<input type="hidden" name="sex" 					value="" 	/>
	<input type="hidden" name="nation" 					value="" 	/>
	<input type="hidden" name="tel_com_cd" 				value="" 	/>
	<input type="hidden" name="tel_no" 					value="" 	/>
	<input type="hidden" name="return_msg" 				value="" 	/>
</form>  
</body>
</html>
