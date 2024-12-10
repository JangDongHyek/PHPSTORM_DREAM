<? 
include_once("./_common.php");

// 로그아웃 처리
session_unset(); // 모든 세션변수를 언레지스터 시켜줌
session_destroy(); // 세션해제함

// 자동로그인 해제 --------------------------------
set_cookie('ck_mb_id', '', 0);
set_cookie('ck_auto', '', 0);
// 자동로그인 해제 end --------------------------------

include_once(G5_THEME_PATH.'/head.sub.php');

?>
<script>
// 대리점 검색
function getSrch(f){
	if (f.stx.value == "") {
		getNoti(1, "대리점명을 입력하세요.");
		f.stx.focus();
		return false;
	}

	$.ajax({  
		type : "post",  
		url : g5_bbs_url + "/ajax.srch_agency.php",
		data : {"stx" : f.stx.value, "agency_no" : f.agency_no.value},
		dataType : "html",  
		async : false,
		beforeSend : function() {
			$("#srch_result").hide();
		},
		success : function(result) {  
			$("#srch_result").html(result).slideDown(500);
		},  
		error : function(xhr,status,error) {
			getNoti(1, "대리점 검색에 실패하였습니다. 다시 시도해 주세요.");
		},
		complete : function(){
			return false;
		}
	});

	return false;
}

// 대리점 검색결과 선택
function setAgency(mb_no, el){
	var f = document.fsrch;
	f.agency_no.value = mb_no;
	f.agency_name.value = $(el).text();
	f.stx.value = $(el).text();

	$("#srch_result li").removeClass("active");
	$(el).addClass("active");
	$("#srch_result").slideUp(500);
}

// 입장
function mainEnter(){
	var f = document.fsrch;

	if (f.agency_no.value == "") {
		getNoti(1, "대리점을 선택하셔야 합니다.");
		f.stx.focus();
		return false;
	}

	swal({
		title: "입장하기",
		text: "대리점은 우측 상단 메뉴에서 변경하실 수 있습니다.",
		icon: "success",
		buttons: ["닫기", "확인"],
		dangerMode: true,
	}).then(function(result) {
		if (result) {
			//sessionStorage.setItem("myAgency", f.agency_no.value);
			//location.href = g5_url + '/index.php';
			var f = document.fmain;
			f.action = g5_url + '/index.php';
			f.myAgency.value = document.fsrch.agency_no.value;
			f.submit();
		}
	});
}

<?php
// 아이폰 위치호출
if (strpos($_SERVER['HTTP_USER_AGENT'], "IOS_APP") !== false) {
?>
sessionStorage.setItem("APP_OS", "IOS");
//sessionStorage.setItem("IOS_REFRESH", "1");

<?php } ?>

</script>

<div id="enter">
    <div class="title">
        <h1>T대리 대리점 선택</h1>
        <span>원하시는 대리점을 선택하시고<br />
        입장해주시길 바랍니다.</span>
    </div>
    
    <div id="agency">
    	<div class="agency_sch">
        <fieldset>
            <legend>대리점 선택</legend>
            <form name="fsrch" autocomplete="off" onsubmit="return getSrch(this);">
				<input type="hidden" name="agency_no" value=""><!-- 대리점no -->
				<input type="hidden" name="agency_name" value=""><!-- 대리점명 -->
                <input type="text" name="stx" id="" maxlength="100" placeholder="대리점명 검색 (ex : T대리)" required>
                <input type="submit" id="sch_submit" value="검색">
            </form>
        </fieldset>
        </div>
        <div class="result_list" id="srch_result">
        	<!--<ul>
            	<li class="active">A대리점</li>
				<li>B대리점</li>
				<li>C대리점</li>
            </ul>-->
        </div>
    </div>
    
    <a href="javascript:void(0)" class="enter_btn" onclick="mainEnter();">입장하기</a>
    <a href="<?php echo G5_BBS_URL ?>/register_agc_form.php" class="btn">대리점가입</a>

</div>

<form name="fmain" method="post">
	<input type="hidden" name="myAgency">
</form>

<?
include_once(G5_THEME_PATH.'/tail.sub.php');
?>