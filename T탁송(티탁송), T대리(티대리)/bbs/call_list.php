<?
/*************************************
드라이버 콜내역
1. 콜접수내역 (내가 진행한 콜 전체) : m=my
2. 인덱스 (대기)
*************************************/
include_once('./_common.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');

goto_url(G5_BBS_URL."/call_list_new.php");
exit;

// 콜요청후 '전화'를 누른경우 tel: 실행
$run_call = ($_GET['call']=="1" && !$is_driver)? "T" : "F";


?>
<script>
var page = 1;
var current_page = 1;
var run_call = "<?=$run_call?>";

var scrollchk = true;	//스크롤 체크 여부 플래그

$(function() {
	getCallList();

    if (run_call == "T") {
        history.replaceState({data: "replaceState"}, "", g5_bbs_url + "/call_list.php?m=my");
        location.href = "tel:1599-1009";
    }
});

// 콜내역 호출
function getCallList() {
	console.log('getCallList()');

	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.call_list.php",
		data : {"m" : $("input[name=m]").val(), "page" : page},
		dataType : "html",
		success : function(html) {
			console.log('(new)load page : ' + page);

			if (html.replace(/\r\n/g, "") == "end") {
				console.log('page end');
				scrollchk = false;
				return false;
			}

			if (page == 1) {
				$("#req_list ul").html(html);
			} else {
				$("#req_list ul").append(html);
			}
			current_page = page;
			page++;
			scrollchk = true;
		},  
		error : function(xhr,status,error) {
			var tag = "<li><div style='color: #FFF; padding: 20px; font-size: 1.15em;'>콜내역을 불러오는데 실패하였습니다.<br>다시 시도해 주세요.</div></li>";
			$("#req_list").html(tag);
		},
		complete : function() {
			setHeight();
			var st = fnStorage('get', 'list_st');
			if (st != null) {
				$(window).scrollTop(st);
				fnStorage('remove', 'list_st');
			}
		}
	});
}

function setHeight() {
	var win_height = $(window).height() - $("#hd").height();
	var wrap_height = $("#driver_wrap").height();
	if (win_height > wrap_height) {
		$("#driver_wrap").css("height", win_height+"px");
	}
}

// 스크롤 끝이면 페이지 추가
$(window).scroll(function() {
	if (scrollchk) {	// 새로고침 또는 뒤로가기시 스크롤이 밑으로 가있으면 로딩체크
		if ( Math.ceil($(window).scrollTop()) == ($(document).height()-$(window).height()) ) { 
			getCallList();
		}
	}
});

// 상세페이지 이동
function getCallView(idx) {
	var url = g5_bbs_url + "/call_view.php?idx=" + idx + "&page=" + current_page;	// 현재페이지
	var st = $(window).scrollTop();
	fnStorage('set', 'list_st', st);

	location.href = url;
}

</script>

<?
// css
$div_id = "driver_wrap";
if ($member['mb_level'] == "2") $div_id = "user_wrap";
?>
<div id="<?=$div_id?>">
	<input type="hidden" name="m" value="<?=$_GET['m']?>">
	<input type="hidden" name="idx" value="">
	
	<? if ($member['mb_level'] != "2") { ?>
	<div class="sort">
		<a href="javascript:void(0);" onclick="location.reload();">새로고침</a>
		<a href="javascript:void(0);" onclick="location.reload();" class="active">최근순</a>
		<a href="#" class="" onclick="getNoti(1, '위치정보 준비중입니다.');">근거리순</a>
	</div>
	<? } ?>

	<div id="req_list">
		<ul><!-- 콜내역 /bbs/ajax.call_list.php --></ul>
    </div>
</div>

<!-- hash wrap -->
<div class="hash_wrap" id="view_page"><iframe id="view_frame" style="width: 100%; height: 100%; border: 0;"><!-- /bbs/call_view.php --></iframe></div>

<?
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>