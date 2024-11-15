<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>사이드 메뉴바</title>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"/>
		<link rel="stylesheet" href="style.css" type="text/css" charset="euc-kr"/>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script type="text/javascript">
		 var stmnLEFT = 10; // 오른쪽 여백 
		 var stmnGAP1 = 0; // 위쪽 여백 
		 var stmnGAP2 = 150; // 스크롤시 브라우저 위쪽과 떨어지는 거리 
		 var stmnBASE = 150; // 스크롤 시작위치 
		 var stmnActivateSpeed = 35; //스크롤을 인식하는 딜레이 (숫자가 클수록 느리게 인식)
		 var stmnScrollSpeed = 20; //스크롤 속도 (클수록 느림)
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
			document.getElementById('STATICMENU').style.left = stmnLEFT + 'px';  //처음에 오른쪽에 위치. left로 바꿔도.
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
			<div id="keyword-Label">행
				<div id="top-label">행</div>
			</div>
		</div>
	</body>
</html>