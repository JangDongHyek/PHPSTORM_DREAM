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
/* 해쉬 클래스 */
.hash { overflow-y: scroll; width:100%; height:100%;}
.hash-left { position:fixed; top:0;height:50%; left:-100%; transition: transform .3s ease; transform : translateX(0); background:#EFEFEF;}
.transform-left { transition: transform .3s ease; transform : translateX(100%); }
.hash-right { position:fixed; top:0;height:50%; left:100%; transition: transform .3s ease; transform : translateX(0); background:#EFEFEF; }
.transform-right { transition: transform .3s ease; transform : translateX(-100%); }
.hash-top { position:fixed; top:0; left:0; transition: transform .3s ease; transform : translateY(-100%); background:#EFEFEF; }
.transform-top { transition: transform .3s ease; transform : translateY(0); }
.hash-bottom { position:fixed; bottom:0; left:0; transition: transform .3s ease; transform : translateY(100%); background:#EFEFEF; }
.transform-bottom { transition: transform .3s ease; transform : translateY(0); }
.hash-fade { position:fixed; top:0; left:100%; width:0; height:0; transition: opacity .3s ease-in-out; opacity:0;  }
.transform-fade { opacity:1; width:100%; height:100%; left:0; transition: opacity .3s ease; }

</style>
</head>
<body>

<div class="well">
	<div class="well">
	해쉬 아작스 테스트
	</div>
	<a href="#hash_left" id="hash_left" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="left">
		왼쪽
	</a>

	<a href="#hash_right" id="hash_right" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="right">
		오른쪽
	</a>

	<a href="#hash_top" id="hash_top" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="top">
		위
	</a>

	<a href="#hash_bottom" id="hash_bottom" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="bottom">
		아래
	</a>

	<a href="#hash_fade" id="hash_fade" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="fade">
		페이드
	</a>
</div>

<script>
$(function (){
	//해쉬태그 레이어 슬라이드
	$(window).hashchange(function(){
		var hashTag = location.hash;
		hashAjax(hashTag);

	}).hashchange();
});
</script>