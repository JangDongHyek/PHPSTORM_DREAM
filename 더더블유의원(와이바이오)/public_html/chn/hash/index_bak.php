<?php

header('Content-Type: text/html; charset=utf-8');
$gmnow = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
?>
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="./js/jquery.ba-hashchange.1.3.min.js"></script>
<script src="./js/hash.eazy-0.3.js"></script>

<style>
/* 해쉬 클래스 */
.hash { overflow-y: scroll; width:100%; height:100%;}
.hash-left { position:fixed; z-index:10; top:0;height:50%; left:-100%; transition: transform .3s ease; transform : translateX(0); background:#EFEFEF;}
.transform-left { transition: transform .3s ease; transform : translateX(100%); }
.hash-right { position:fixed; z-index:10; top:0;height:50%; left:100%; transition: transform .3s ease; transform : translateX(0); background:#EFEFEF; }
.transform-right { transition: transform .3s ease; transform : translateX(-100%); }
.hash-top { position:fixed; z-index:10; top:0; left:0; transition: transform .3s ease; transform : translateY(-100%); background:#EFEFEF; }
.transform-top { transition: transform .3s ease; transform : translateY(100%); }
.hash-bottom { position:fixed; z-index:10; bottom:0; left:0; transition: transform .3s ease; transform : translateY(100%); background:#EFEFEF; }
.transform-bottom { transition: transform .3s ease; transform : translateY(-100%); }
.hash-fade { position:fixed; z-index:10; top:0; left:100%; width:0; height:0; transition: opacity .3s ease-in-out; opacity:0;  }
.hash-fade .circle-mymenus { transition: transform .5s ease; transform : translateY(100px); }
.hash-fade .circle-menus { transition: transform .5s ease; transform : translateY(0); }
.transform-fade { opacity:1; width:100%; height:100%; left:0; transition: opacity .3s ease; }
.transform-fade .circle-mymenus { transition: transform .7s ease; transform : translateY(-50px); }
.transform-fade .circle-menus { transition: transform .7s ease; transform : translateY(50px); }

</style>

<div class="well">
	해쉬 아작스 테스트
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<a href="#ajax-hash" id="ajax-hash" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="left">
		왼쪽
	</a>

	<a href="#ajax-hash2" id="ajax-hash2" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="right">
		오른쪽
	</a>
	<a href="#ajax-hash3" id="ajax-hash3" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="top">
		위
	</a>
	<a href="#ajax-hash4" id="ajax-hash4" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="bottom">
		아래
	</a>
	<a href="#ajax-hash5" id="ajax-hash5" class="btn btn-primary" data-role="button" data-url="./hash.php" data-ref="1" data-animation="fade">
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
