<?php
	include_once("./_common.php");
	/*$jwt_client_secret = generateJWT($keyId, $teamId, $clientId);
	echo $jwt_client_secret;*/
	/*print_r($_REQUEST['id_token']);
	$token = explode(".",$_REQUEST['id_token']);
	$id_token = base64_decode($token);
	$token_data = json_decode($id_token);
	$token_array = (array)$token_data;

	print_r($token_array);*/
?>
<script src="<?php echo G5_JS_URL ?>/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	window.onload=function(){
		parseJwt("<?=$_REQUEST['id_token']?>");
	}
	function parseJwt (token) {
		var base64Url = token.split('.')[1];
		var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
		var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
		}).join(''));
		var json=JSON.parse(jsonPayload);
		var email=json.email;
		setLogin(email);

		console.log(JSON.parse(jsonPayload));
	};
	function setLogin(email){
		$.ajax({
			url:"<?=G5_BBS_URL?>/ajax.apple.check.php",
			data:{"mb_id":email},
			type:"POST",
			dataType:"json",
			success:function(data){
				var jsonData = JSON.stringify(data);
				var json=JSON.parse(jsonData);
				var login=json.login;
				console.log(login);
				
				if(login=="no"){
					location.href="<?=G5_BBS_URL?>/register.php?mb_id="+email;
				}else{
					location.href="<?=G5_BBS_URL?>/apple.login_check.php?mb_id="+email;
				}
			}
		});
	}
</script>