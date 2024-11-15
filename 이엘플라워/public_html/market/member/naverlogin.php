<?php
              // 네이버 로그인 접근토큰 요청 예제
              $client_id = "nFOybrONlylOuHPg4C1Z";
              $redirectURI = urlencode("http://elflower.co.kr/market/member/callback.php");
              $state = "RAMDOM_STATE";
              $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
               
               
            ?>
<a href="<?php echo $apiURL ?>"><img height="32" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a> //로그인 버튼
 
