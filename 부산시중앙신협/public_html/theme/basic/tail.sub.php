<?php


?>

<script>

	function deviceModel(){
		let currentOS;
		const mobile = (/iphone|ipad|ipod|android/i.test( navigator.userAgent.toLowerCase() ));
		if (mobile){
			const userAgent = navigator.userAgent.toLowerCase();
			if (userAgent.search("android") > -1) {
				currentOS = "android";
			} else if ((userAgent.search("iphone") > -1) || (userAgent.search("ipod") > -1) || (userAgent.search("ipad") > -1)) {
				currentOS = "ios";
			} else { 
				currentOS = "other"; 
			}
		} else { 
			currentOS = "web";
		}

		return currentOS;
	}

	function chkLogin(){
		var mb_id = "<?=$member[mb_id]?>";
		if(mb_id == "" || mb_id == null) mb_id = "";

		if(os == "") os = deviceModel();
		
		if(os == "android"){
			window.Android.setLogin(mb_id);
			//window.dreamforone.showLeftMenu(false);
		} else if(os == "ios"){
			window.webkit.messageHandlers.setLogin.postMessage(mb_id);
		}
	}

	function setFcmToken(token, mb_id="", type=""){

		if(mb_id == "") mb_id = "<?=$member[mb_id]?>";
		if(os == "") os = deviceModel();
		if(type == "") type = os;
		$.post("<?=G5_URL?>/plugin/gcm/insert.php",{"mb_id":mb_id,"token":token,"os":type},function(data){

		});
	}

	var os = "";
	$(document).ready(function(){
		os = deviceModel();
		chkLogin();
	});


</script>


<?php /*?><!-- Mirae Log Analysis Script Ver 1.0   -->
<script TYPE="text/javascript">
var mi_adkey = "nkzek";
var mi_script = "<scr"+"ipt "+"type='text/javascr"+"ipt' src='http://log1.toup.net/mirae_log.js?t="+(new Date().getTime())+"' async='true'></scr"+"ipt>"; 
document.writeln(mi_script);




</script>
<!-- Mirae Log Analysis Script END  -->
<!--NAVER SCRIPT-->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_26563a0c5861";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
</script>
<!--NAVER SCRIPT END-->
<?php */?></body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>