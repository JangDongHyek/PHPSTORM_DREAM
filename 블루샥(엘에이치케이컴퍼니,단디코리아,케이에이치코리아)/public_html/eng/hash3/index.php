<?php
include_once('../common.php');
?>
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="./js/jquery.ba-hashchange.1.3.min.js"></script>
<script src="./js/hash.eazy-0.3.js"></script>

<style>
</style>
</head>
<body>

<div class="well" style="margin-top:500px">
	<div class="well" style="">
	해쉬 아작스 테스트
	</div>
	
	<a href="#hash-mypage" id="hash_mypage" class="btn btn-warning" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
		<span class="sound_only">열기</span>
	</a>

</div>

<script>
$(function (){
	hashload();
	//해쉬태그 레이어 슬라이드
	$(window).hashchange(function(){
		var hashTag = location.hash;
		hashAjax(hashTag);

	}).hashchange();
});
</script>