<?php
include_once('./_common.php');
$g5['title'] = '기타서비스';
include_once(G5_THEME_PATH.'/head.php');
?>
<div id="serv_menu">
	<ul>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=map01"><img src="<?php echo G5_IMG_URL ?>/serv_icon01.png" />중고매매</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=map02"><img src="<?php echo G5_IMG_URL ?>/serv_icon02.png" />폐차장</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=map03"><img src="<?php echo G5_IMG_URL ?>/serv_icon03.png" />대리점</a></li>
        <li><a href="https://play.google.com/store/apps/details?id=kr.foryou.scflower"><img src="<?php echo G5_IMG_URL ?>/serv_icon04.png" />서비스플라워</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=map04"><img src="<?php echo G5_IMG_URL ?>/serv_icon03.png" />핸드폰매장</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=map05">우리치과<br /> <span>임플란트 2개 무료<br />틀니 1개 무료<br />&lt;65세 이상&gt;</span></a></li>
    </ul>
</div>


<? /* 
<? if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") { ?>
<!-- sign Modal -->
<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="signModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin: 0;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signModalLabel">서명하기</h5>
      </div>
      <div class="modal-body" id="pad_load">
		<!-- pad load -->
		<form method="POST" name="pfrm">
			<div class="pad_bg"><canvas class="pad" id="sign_pad"></canvas></div>
			<fieldset style="margin-top: 5px;"><input type="reset" class="btn btn-default" value="서명 다시하기" /></fieldset>
		</form>
		<!-- // pad load -->
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary">서명완료</button>
      </div>
    </div>
  </div>
</div>

<button type="button" onclick="openSignPad();">사인</button>

<link href="<?=G5_URL?>/css/jquery.signaturepad.css" rel="stylesheet">
<script src="<?=G5_URL?>/js/jquery.signaturepad.js"></script>
<script>
var api;
var canvas;
var padResize = function(event) {
	canvas.attr({
		height: 260,
		width: window.innerWidth - 36 // padding+border빼기
	});
};

$(function() {
	api = $('#pad_load form').signaturePad({
		drawOnly: true,
		defaultAction: 'drawIt',
		validateFields: false,
		lineWidth: 0,
		output: null,
		sigNav: null,
		name: null,
		typed: null,
		clear: 'input[type=reset]',
		typeIt: null,
		drawIt: null,
		typeItDesc: null,
		drawItDesc: null,
		penColour: '#000'
	});
});

function openSignPad() {
	$('#signModal').modal('show');
	canvas = $('canvas');

	window.addEventListener('orientationchange', padResize, false);
	window.addEventListener('resize', padResize, false);
	padResize();
}

function signSubmit() {
	if (!api.validateForm()) {
		return false;
	}

	var sign = document.getElementById("sign_pad").toDataURL("image/png");
	sign = sign.replace('data:image/png;base64,', '');

	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.sign_upload.php",
		data : {"sign" : sign, "page" : "agency"},
		dataType : "text",  
		success : function(data) {  
			console.log(data);
		},  
		error : function(xhr,status,err) {
			console.log(err);
		}
	});
}


</script>
<? } // ip ?>
*/ ?>

<?php
include_once('./_tail.sub.php');
//include_once(G5_THEME_PATH.'/tail.php');
?>