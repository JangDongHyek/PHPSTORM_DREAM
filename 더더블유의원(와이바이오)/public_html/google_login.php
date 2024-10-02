<!DOCTYPE html>
<html>
<head>
    <title>구글 아이디로 로그인하기 1</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://code.jquery.com/jquery.js"></script>
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>
    <script>

	function onSignIn() {
	    google.accounts.id.initialize({
	        client_id: "772637742961-q1hjpfcu42k3r946n82k90n2fcjo99lo.apps.googleusercontent.com",
			prompt_parent_id:'11',
	        callback: handleCredentialResponse
	    });
		
	    google.accounts.id.prompt((notification) => {
		  if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
			document.cookie =  `g_state=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT`;
            google.accounts.id.prompt()
			// continue with another identity provider.
		  }
		});
	}

	function handleCredentialResponse(response) {
	    var profile = jwt_decode(response.credential);
		console.log("ID: " + profile.sub);
		console.log('Name: ' + profile.name);
	    console.log("Image URL: " + profile.picture);
	    console.log("Email: " + profile.email);    
		
	}
	function signOut() {
	    google.accounts.id.disableAutoSelect();
	  
	}
		
	</script>
</head>
<body>


<div id="login">
    <input type="button" onclick="onSignIn();" value="로그인" /><br>
</div>

<div id="logout" style="display: none;">
    <input type="button" onclick="signOut();" value="로그아웃" /><br>

    <img id="upic" src=""><br>
    <span id="uname"></span>
</div>




</body>
</html>
[출처] [ERROR] 구글 아이디로 로그인하는 중 idpiframe_initialization_failed|작성자 뇨내

