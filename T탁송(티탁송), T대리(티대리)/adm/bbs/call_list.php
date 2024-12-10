<?
/*************************************
드라이버 콜내역
1. 콜접수내역 (내가 진행한 콜 전체) : m=my
2. 인덱스 (대기)
*************************************/
include_once('./_common.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>
<script>
var page = 1;
var current_page = 1;

var scrollchk = true;	//스크롤 체크 여부 플래그
var totallist = "";		// ajax로 받아온 list 누적

$(function() {
	if(location.hash){	// ##앵커태그가 있으면 true (뒤로가기로 왔을경우)
		var data = history.state;

		if (data) { 
			scrollchk = false;		//데이터를 세팅하는동안 스크롤 체크를 하지않게하자. 
			$("#req_list ul").html(data.list); //저장된 데이터를 뿌려준다. 

			totallist = data.list;
			page = data.page;
			current_page = data.current_page;
			scrollchk = true;

			console.log('(save)load page : ' + page);

			statusUpdate();

		}
	} else {
		getCallList();
	}
});

// 뒤로가기로 콜내역왔을때 상태 업데이트
function statusUpdate() {
	var el = $("#req_list > ul > li");
	$.each(el, function(index, item) {
		var idx = $(item).attr('id');
		idx = idx.replace("box", "");

		$.post(g5_bbs_url + "/ajax.call_list_status.php", {"idx" : idx} ).done(function(json) {
			var data = JSON.parse(json);
			if (data.result == "T") {
				var btn = $(item).children("div.state");
				var btn_class = "off";
				var btn_name = "";

				switch (data.status) {
					case "-1": btn_name = "취소"; break;
					//case "0": btn_name = ""; break;
					case "1": btn_name = "진행중"; btn_class = "on"; break;
					case "2": btn_name = "진행완료"; break;
				}
				if (btn_name.length > 0) {
					if (btn.length > 0) { // 진행여부 버튼존재하면
						btn.removeClass("on").removeClass("off");
						btn.addClass(btn_class).text(btn_name);
					} else { // 진행여부 버튼없으면
						var create_btn = $('<div class="state '+ btn_class +'">'+ btn_name +'</div>');
						$(item).append(create_btn);
					}
				}
			}
		}, "json");
	});
}

// 콜내역 호출
function getCallList() {
	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.call_list.php",
		data : {"m" : $("input[name=m]").val(), "page" : page},
		dataType : "html",
		success : function(html) {
			console.log('(new)load page : ' + page);

			if (html.replace(/\r\n/g, "") == "end") {
				console.log('page end');
				return false;
			}

			if (page == 1) {
				$("#req_list ul").html(html);
			} else {
				$("#req_list ul").append(html);
			}
			current_page = page;
			page++;

			// 리스트 누적
			totallist += html;
			history.replaceState({list:totallist, page:page, current_page:current_page},'Page ' + current_page, 'call_list.php#'+page);
			scrollchk = true;
		},  
		error : function(xhr,status,error) {
			var tag = "<li><div style='color: #FFF; padding: 20px; font-size: 1.15em;'>콜내역을 불러오는데 실패하였습니다.<br>다시 시도해 주세요.</div></li>";
			$("#req_list").html(tag);
		},
		complete : function() {
			setHeight();
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
		if ($(window).scrollTop() == ($(document).height()-$(window).height())) { 
			getCallList();
		}
	}
});

// 상세페이지 이동
function getCallView(idx) {
	/*
	$("input[name=idx]").val(idx);
	var url = location.href + "#view";
	*/
	var url = g5_bbs_url + "/call_view.php?idx=" + idx + "&page=" + current_page;	// 현재페이지

	location.href = url;
}
/*
window.onhashchange = function (event) {
	var old_url = event.oldURL,
		new_url = event.newURL;
	var view_area = $("#view_page"),
		view_frame = view_area.find("iframe");

	if (typeof new_url != "undefined" && new_url.indexOf("#view") != -1) {
		var url = g5_bbs_url + "/call_view.php?idx=" + $("input[name=idx]").val();
		$(document).find('html, body').css({'overflow': 'hidden', 'height': '100%'});
		//view_frame.attr("src", url);
		view_frame.get(0).contentWindow.location.replace(url);
		view_area.show();

	} else {
		view_area.hide();
		view_frame.contents().find("body").html("");
		$(document).find('html, body').css({'overflow': 'initial', 'height': 'auto'});
	}
}
*/
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
		<a href="javascript:;" onclick="setPosition()">새로고침</a>
		<a href="#" class="active">최근순</a>
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