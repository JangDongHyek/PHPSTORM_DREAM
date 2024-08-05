ㅡ<? 
include_once("./_common.php");

$g5['title'] = '포인트 사용하기';
$pid = "use_point";
include_once('./_head.php');

if(!$is_member){
	goto_url(G5_URL."/bbs/login.php");
}

if($mb_id == "" || $mb_id == null){
	alert("잘못된 접근입니다.", G5_URL."/bbs/logout.php");
}

$mb = get_member($mb_id);
if($mb == null){
	alert("잘못된 접근입니다.", G5_URL."/bbs/logout.php");
}

if($member[mb_level] < 8){
	alert("관리자만 접근 가능합니다.", G5_URL."/bbs/logout.php");
}
if($type == ""){
	$now = time();
	if($time != "" || $time != null){
		if($now - $time >= 60*5){
			alert("5분이 지난 QR코드입니다. QR코드를 다시 생성해서 찍어주세요.");
		}
	} else {
		alert("잘못된 접근입니다.", G5_URL."/bbs/logout.php");
	}
} else if($type == "sticker"){

} else {

}


if($is_app == false){
	alert("잘못된 접근입니다.", G5_URL."/bbs/logout.php");
}



?>
<link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">
<style>
	.btm_nav_box{
		background: transparent;
	}
	#mypage_wrap .con_wrap{
		width: 100%;
	}
</style>

<div class="autoW bdpd">
    <div id="mypage_wrap" class="qr_ver">
		<div class="con_wrap">
            <ul class="top_con">
                <li class="info">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_myinfo.svg" class="menu_ic">
                    <div class="profile_wrap">
                        <span class="rating vvip">VVIP</span>
                        <!--        <span class="rating vip">VIP</span>-->
                        <h1><span class="user_name"><?=$mb["mb_name"]?></span> 님</h1>
                    </div>
                </li>
                <li>
                    <a>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/sub/ic_point.svg" class="menu_ic">
                        <div class="wrap">
                        <a class="info_tit">포인트 잔액</a>
                        <a class="btn_count"><strong class="color_gold"><?=number_format($mb[mb_point])?></strong><span class="em">P</span></a>
                        </div>
                    </a>
				</li>
                <li>
                    <a>
                        <img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_point_deducted.svg" class="menu_ic">
                        <div class="wrap">
                        <a class="info_tit">사용할 포인트</a>
                        <a class="btn_count ver2"><strong class="color_gold">- <input type="number" id="input_use_point" class="point_input"></strong><span class="em">P</span></a>
                        </div>
                    </a>
				</li>
            </ul>

        </div>
    </div>
</div>
</div>
<script>

	function use_point(){

		
		var point = "<?=$mb[mb_point]?>";
		if(point == "" || point == null) point = 0;
		var use_pointt = $("#input_use_point").val();

		point = Number(point);
		use_pointt = Number(use_pointt);


		if(use_pointt == "" || use_pointt == null){
			alert("사용할 포인트를 입력하세요.");
			return;
		}

		if(use_pointt <= 0 ){
			alert("사용할 포인트를 입력하세요.");
			return;
		}

		if(point < use_pointt){
			alert("사용 가능한 포인트가 부족합니다.");
			return;
		}

		var mb_id = "<?=$mb[mb_id]?>";
		if(mb_id == "" || mb_id == null) {
			alert("잘못된 접근입니다.");
			return;
		}
		$("#btn_use_point").prop("disabled", true);
		var token = get_cjax_token("use_point");

		$.post("<?=G5_URL?>/cjax/use_point.php",{"mb_id":mb_id, "use_point":use_pointt,"token":token},function(data){
			$("#btn_use_point").prop("disabled", false);
			if(data == -1){
				alert("잘못된 접근입니다.");
			}
			alert("포인트가 사용되었습니다.");
			location.reload();

		});


	}

	function get_cjax_token(token_type=""){
		var token = "";

		$.ajax({
			type: "POST",
			url: "<?=G5_URL?>/cjax/get_cjax_token.php",
			data: {"token_type":token_type},
			cache: false,
			async: false,
			dataType: "json",
			success: function(data) {
				token = data.token;
			}
		});

		return token;
	}

</script>

<?php
include_once('./_tail.php');
?>
