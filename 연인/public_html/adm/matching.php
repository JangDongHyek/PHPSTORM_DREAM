<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '매칭하기';
include_once(G5_PATH.'/head.sub.php');

$row = sql_fetch(" SELECT mb_no, mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu FROM g5_member WHERE mb_id = '{$mb_id}' ");
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

// 매칭회원정보
$mb_no = $row['mb_no'];
$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);


// 남자회원이면 포인트, 쿠폰 조회
$coupon_cnt = 0;
$heart_cnt = 0;
if ($mb_sex == "남") {
    $coupon_cnt = getMemberCoupon($mb_no);
    $heart_cnt = getMemberHeart($mb_no);
}

?>
<style>
#match_list .init {border: 1px solid #ececec; padding: 20px; text-align: center;}
</style>

<script>
// 매칭등록
function matchSubmit(f) {
	var leng = $(".valid_helper").length;
	var valid = 0;	// 헬퍼선택, 소개종류 체크

	if (leng == 0) {
		alert("매칭상대를 선택하세요.");
		return false;
	}

	for (var i=0; i < leng; i++) {
		if ($(".valid_helper").eq(i).val() == "") valid = 1;
		else if ($(".valid_type").eq(i).val() == "") valid = 2;
	}

	if (valid > 0) {
		var msg = (valid == 1)? "헬퍼" : "소개종류";
		alert(msg + "를 선택하세요.");
		return false;
	}

    var match_coupon_cnt = 0;   // 쿠폰소개 숫자
    var match_heart_cnt = 0;    // 포인트소개 숫자
    $.each($('select.valid_type'), function(index, elem) {
        if (elem.value == "쿠폰소개") match_coupon_cnt++;
        else if (elem.value == "포인트소개") match_heart_cnt++;
    });

    // 소개종류 > 쿠폰소개이면 남자회원 쿠폰 체크
    if (match_coupon_cnt > 0) {
        console.log(match_coupon_cnt, );
        if (f.mb_sex.value == "남") { // 매칭 주체가 남자이면, (내쿠폰 개수 >= 총 쿠폰소개 횟수) 여야 매칭가능
            if (f.mb_coupon.value >= match_coupon_cnt) console.log("쿠폰소개 매칭가능");
            else {
                alert("매칭가능한 쿠폰이 부족합니다.\n(쿠폰소개 1건 = 쿠폰 1개 필요)");
                return false;
            }
        } else { // 타겟이 남자이면, 타겟의 쿠폰 확인 (소개1건 = 쿠폰1개)
            var _submit = true;
            $.each($('select.valid_type'), function(index, elem) {
                if (elem.value == "쿠폰소개") {
                    var _num = $(elem).data("num");
                    var _target_coupon = $("[name='target_coupon[" + _num + "]']").val();

                    if (parseInt(_target_coupon) < 1) {
                        var _name = $("[name='target_name[" + _num + "]']").val();
                        alert("매칭가능한 쿠폰이 부족합니다. (" + _name + ")");
                        _submit = false;
                    }
                }
            });
            if (!_submit) return false;
        }
    }

    // 소개종류 > 포인트소개이면 남자회원 포인트 체크
    if (match_heart_cnt > 0) {
        if (f.mb_sex.value == "남") { // 매칭 주체가 남자이면, (내포인트 개수 >= 총 포인트소개 횟수*10) 여야 매칭가능
            if (f.mb_heart.value >= (match_heart_cnt * 10000)) console.log('포인트소개 매칭가능');
            else {
                alert("매칭가능한 포인트가 부족합니다.\n(포인트소개 1건 = 포인트 10,000P 필요)");
                return false;
            }
        } else {  // 타겟이 남자이면, 타겟의 포인트 확인 (소개1건 = 포인트10개)
            var _submit = true;
            $.each($('select.valid_type'), function(index, elem) {
                if (elem.value == "포인트소개") {
                    var _num = $(elem).data("num");
                    var _target_heart = $("[name='target_heart[" + _num + "]']").val();

                    if (parseInt(_target_heart) < 10000) {
                        var _name = $("[name='target_name[" + _num + "]']").val();
                        alert("매칭가능한 포인트가 부족합니다. (" + _name + ")");
                        _submit = false;
                    }
                }
            });
            if (!_submit) return false;
        }
    }
	
	return true;
}

// 회원검색
function getMemberList() {
	var f = document.fMatch,
		data_list = {"sfl" : f.sfl.options[f.sfl.selectedIndex].value, "stx" : f.stx.value, "mb_sex" : f.mb_sex.value};

	if (f.stx.value.length < 2) {
		alert("검색어를 2자 이상 입력하세요.");
		return false;
	}

	$.ajax({  
		type : "post",  
		url : "./ajax.member_list.php",
		data : data_list, 
		dataType : "html", 
		beforeSend : function() {
			$("#match_s_result").hide().html("");
		},
		success : function(html) {  
			$("#match_s_result").html(html).slideDown(500);
		},  
		error : function(xhr,status,error) {
			alert("검색결과를 불러오는데 실패하였습니다. 다시 시도해 주세요.");
			$("#match_s_result").slideUp(500).html("");
		}  
	});

}

// 회원검색-선택
var list_no = 1;
function setMatchTarget(no,id, name, sex, age, tel, si, gu) {
	var obj = {};

	// 중복등록확인
	// if () {

	// }

	obj.list_no = list_no;
	obj.no = no;
	obj.id = id;
	obj.name = name;
	obj.sex = sex;
	obj.age = age;
	obj.tel = tel;
	obj.si = si;
	obj.gu = gu;

	$.ajax({
		type : "post",  
		url : "./ajax.matching_list.php",
		data : obj,
		dataType : "html",  
	}).done(function(data, textStatus, xhr) {
		$("#match_list .init").hide();
		$("#match_list").append(data);

	}).fail(function(data, textStatus, errorThrown) {
		alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.');

	}).always(function() {
		list_no++;
		$("#match_s_result").slideUp(500).html("");
		document.fMatch.stx.value = "";
	});
}

// 매칭상대 회원정보 삭제
function delMatchList(no) {
	if (!confirm("매칭상대를 삭제하시겠습니까?")) return false;
	else {
		$("#match"+no).remove();
		if ($("#match_list .tbl_match").length == 0) $("#match_list .init").show();
	}
}
</script>

<div id="popup_wrap" class="match">
	<p>매칭하기</p>

	<form name="fMatch" action="./matching_update.php" method="post" onsubmit="return matchSubmit(this);" autocomplete="off">
        <input type="hidden" name="mb_no" value="<?=$mb_no?>">
		<input type="hidden" name="mb_id" value="<?=$mb_id?>">
		<input type="hidden" name="mb_sex" value="<?=$mb_sex?>">
        <input type="hidden" name="mb_coupon" value="<?=$coupon_cnt?>">
        <input type="hidden" name="mb_heart" value="<?=$heart_cnt?>">
        <input type="hidden" name="target_id" value="">
        <input type="hidden" name="target_no" value="">

		<div class="tbl_head02 tbl_wrap">
			<!-- 매칭회원정보 -->
			<? include_once("./member_info_pop.php"); ?>
			<!-- //매칭회원정보 -->
			
			<!-- 회원검색 -->
			<div class="srch_area">
				<select name="sfl">
					<option value="mb_name">이름</option>
					<option value="mb_birth">나이</option>
					<option value="mb_hp">연락처</option>
					<option value="mb_si">지역</option>
				</select>
				<input type="text" name="stx" class="frm_input" onKeypress="javascript:if(event.keyCode==13) { event.preventDefault(); getMemberList(); }">
				<button type="button" class="btn_frmline" onclick="getMemberList();">회원검색</button>
				1)진행불 회원만 검색되며 2)블랙회원은 검색되지않습니다.
				<div id="match_s_result" class="tbl_head02 tbl_wrap"><!-- 검색결과 Load --></div>
			</div>
			<!-- //회원검색 -->
			
			<!-- 매칭상대 회원정보 -->
			<div id="match_list">
				<div class="init">매칭상대를 검색하세요.</div>
				<!-- ./ajax.matcing_list.php -->
			</div>
			<!-- //매칭상대 회원정보 -->
			
			<br><br>
			<div class="btn_confirm01 btn_confirm">
				<input type="submit" value="매칭등록" class="btn_submit">
				<a href="javascript:void(0);" onclick="getWinClose('refresh');">닫기</a>
			</div>

		</div>
	</form>

	<!-- 관리자 코멘트 -->
	<? 
	$cmt_mode = "member";
	include_once(G5_ADMIN_PATH."/helper_comment.php"); 
	?>

</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>