<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>���̵� �޴���</title>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"/>
		<link rel="stylesheet" href="style.css" type="text/css" charset="euc-kr"/>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script type="text/javascript">
		 var stmnLEFT = 10; // ������ ���� 
		 var stmnGAP1 = 0; // ���� ���� 
		 var stmnGAP2 = 150; // ��ũ�ѽ� ������ ���ʰ� �������� �Ÿ� 
		 var stmnBASE = 150; // ��ũ�� ������ġ 
		 var stmnActivateSpeed = 35; //��ũ���� �ν��ϴ� ������ (���ڰ� Ŭ���� ������ �ν�)
		 var stmnScrollSpeed = 20; //��ũ�� �ӵ� (Ŭ���� ����)
		 var stmnTimer; 
		 
		 function RefreshStaticMenu() { 
			var stmnStartPoint, stmnEndPoint; 
			stmnStartPoint = parseInt(document.getElementById('STATICMENU').style.top, 10); 
			stmnEndPoint = Math.max(document.documentElement.scrollTop, document.body.scrollTop) + stmnGAP2; 
			if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1; 
			if (stmnStartPoint != stmnEndPoint) { 
			 stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 ); 
			 document.getElementById('STATICMENU').style.top = parseInt(document.getElementById('STATICMENU').style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount ) + 'px'; 
			 stmnRefreshTimer = stmnScrollSpeed; 
			 }
			stmnTimer = setTimeout("RefreshStaticMenu();", stmnActivateSpeed); 
			} 
		 function InitializeStaticMenu() {
			document.getElementById('STATICMENU').style.left = stmnLEFT + 'px';  //ó���� �����ʿ� ��ġ. left�� �ٲ㵵.
			document.getElementById('STATICMENU').style.top = document.body.scrollTop + stmnBASE + 'px'; 
			RefreshStaticMenu();
			}
		</script>

		<style type="text/css">
		#STATICMENU { margin: 0pt; padding: 0pt;  position: absolute; right: 0px; top: 0px;}
		</style>

	</head>
	<body onload="InitializeStaticMenu();">
		<div id="STATICMENU">
			<div id="keyword-Label">��
				<div id="top-label">��</div>
			</div>
		</div>
	</body>
</html>