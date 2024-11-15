<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
<title>KakaoLink v2 Demo(Default / Feed) - Kakao JavaScript SDK</title>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

</head>
<body>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
[카카오링크 v2] 동적 링크 (디폴트, 피드형)
</h3>
</div>
<div class="panel-body">
<h4>카카오톡 앱이 설치되어 있는 모바일 기기라면 아래의 링크가 동작합니다.</h4>
<a id="kakao-link-btn" href="javascript:sendLink()">
<img src="//dev.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_medium.png"/>
</a>
</div>
</div>
<script type='text/javascript'>
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('aee322cb87cf618d04fdaa0c5169b5ac');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    function sendLink() {
      Kakao.Link.sendDefault({
    	objectType: 'feed',
    	content: {
    	  title: '딸기 치즈 케익',
    	  description: '#케익 #딸기 #삼평동 #카페 #분위기 #소개팅',
    	  imageUrl: 'http://www.elflower.co.kr/market/images2/logo.png',
    	  link: {
    		mobileWebUrl: 'http://www.elflower.co.kr',
    		webUrl: 'http://www.elflower.co.kr'
    	  }
    	},
    	social: {
    	  likeCount: 286,
    	  commentCount: 45,
    	  sharedCount: 845
    	},
    	buttons: [{
    	  title: '웹으로 보기',
    	  link: {
    		mobileWebUrl: 'http://www.elflower.co.kr',
    		webUrl: 'http://www.elflower.co.kr'
    	  }
    	}, {
    	  title: '앱으로 보기',
    	  link: {
    		mobileWebUrl: 'http://www.elflower.co.kr',
    		webUrl: 'http://www.elflower.co.kr'
    	  }
    	}]
      });
    }
  //]]>
</script>

</body>
<!--------------- 아래의 코드는 삭제해주세요. 샘플이 제대로 동작하지 않을 수 있습니다. ---------------------->

</html>
