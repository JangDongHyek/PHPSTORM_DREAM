<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '소개이력';
include_once(G5_PATH.'/head.sub.php');

$row = sql_fetch(" SELECT mb_name, mb_birth, mb_sex, mb_hp, mb_si, mb_gu FROM g5_member WHERE mb_id = '{$mb_id}' ");
if (!$row) {
	echo "<script>alert('회원정보를 불러오는데 실패하였습니다. 다시 시도해 주세요.'); window.close();</script>";
	exit;
}

// 회원정보
$mb_name = $row['mb_name'];
$mb_birth = $row['mb_birth'];
$mb_sex = $row['mb_sex'];
$mb_hp = $row['mb_hp'];
$mb_si = $row['mb_si'];
$mb_gu = $row['mb_gu'];
$mb_age = (date("Y")+1) - substr($mb_birth, 0, 4);


// 220921. 카운슬러 제외/해제 추가
$block_result = sql_query("SELECT DISTINCT parent_mb_no FROM g5_member_block WHERE helper_no = {$member['mb_no']}");
$block_list = array();
for ($i = 0; $row = sql_fetch_array($block_result); $i++) {
    $block_list[] = $row['parent_mb_no'];
}


// 220921. 중복가입자 소개이력 조회
$add_query = "";
$my_id_list = array();
$my_id_list[] = $mb_id;


// 중복가입이력 통합노출
if ($_GET['re'] == "all") {
    $rejoin = memberRejoinList($mb_hp, $mb_birth);
    if (count($rejoin) > 1) {
        foreach ($rejoin as $key => $val) {
            if ($val['mb_id'] == $mb_id) continue;
            $my_id_list[] = $val['mb_id'];
            $add_query .= " OR A.mb_id = '{$val['mb_id']}' OR A.target_id = '{$val['mb_id']}' ";
        }
    }
}


// 소개이력리스트 (소개신청, 소개받음)
$sql = "SELECT A.*, (SELECT mb_name FROM g5_member WHERE mb_id = A.helper_id) AS helper_name FROM g5_matching A 
        WHERE A.mb_id = '{$mb_id}' OR A.target_id = '{$mb_id}' {$add_query}
        ORDER BY A.idx DESC;";
/*
// 소개신청만 노출
$sql = "SELECT A.*, (SELECT mb_name FROM g5_member WHERE mb_id = A.helper_id) AS helper_name
		FROM g5_matching A WHERE A.mb_id = '{$mb_id}' ORDER BY A.idx DESC;";
*/
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
$list = array();

for ($i = 0; $i < $result_cnt; $i++) {
	$list[$i] = sql_fetch_array($result);
}


?>

<div id="popup_wrap" class="match">
	<p>소개이력</p>

	<div class="tbl_head02 tbl_wrap">
		<!-- 회원정보 -->
		<? include_once("./member_info_pop.php"); ?>
		<!-- //회원정보 -->
		<br>

        <div class="btn_add01 btn_add" style="margin-right: 0;">
            <button type="button" onclick="checkMemberBlock()">변경완료</button>
        </div>

		<!-- 소개이력 -->
		<table>
		<caption>소개이력</caption>
		<colgroup>
			<col width="5%">
			<col width="">
			<col width="12%">
			<col width="8%">
			<col width="10%">
			<col width="12%">
			<col width="">
			<col width="">
			<col width="">
			<col width="">
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>소개구분</th>
			<th>상대이름</th>
			<th>나이</th>
			<th>지역</th>
			<th>상세지역</th>
			<th>매칭일자</th>
			<th>카운슬러</th>
            <th>
                <span>제외</span>
                <input type="checkbox" onclick="allCheck(this.checked);" id="list_all_chk">
            </th>
			<? if ($member['mb_status'] == "관리자") { ?><th>관리</th><? } ?>
		</tr>
		</thead>
		<tbody>
		<? if ($result_cnt == 0) { ?>
		<tr>
			<td colspan="10"><div style="text-align:center;padding: 15px 0;">소개이력이 없습니다.</div></td>
		</tr>
		<? 
		} else { 
			$num = $result_cnt;

			foreach ($list as $key=>$match) {
				$mat_mb_id = $match['mb_id'];
				$mat_target_id = $match['target_id'];
				$match_type = $match['match_type'];
				
				// 소개구분 (본인신청한경우 / 소개받은경우)
				if (in_array($mat_mb_id, $my_id_list)) { //if ($mat_mb_id == $mb_id) {
					//$match_type = "본인신청";
					$srch_mb_id = $mat_target_id;
				} else {
					//$match_type = "소개받음";
					$srch_mb_id = $mat_mb_id;
				}
				/*
				// 본인신청한 소개만 노출
				$srch_mb_id = $mat_target_id;
				*/

				$sql = "SELECT mb_name, mb_birth, mb_si, mb_gu, mb_no, mb_hp, parent_mb_no
                        FROM g5_member WHERE mb_id = '{$srch_mb_id}' ";
				$row = sql_fetch($sql);
				if(empty($row)) continue;
				$srch_name = $row['mb_name'];
				$srch_age = (date("Y")+1) - substr($row['mb_birth'], 0, 4);
				$srch_si = $row['mb_si'];
				$srch_gu = $row['mb_gu'];
				$srch_mb_no = $row['mb_no'];
                $srch_parent_mb_no = $row['parent_mb_no'];

				// 제외 on/off
                $block_checked = (in_array($srch_parent_mb_no, $block_list))? "checked" : "";

            ?>
		<tr style="text-align:center;">
			<td><?=$num?></td>
			<td><?=$match_type?></td>
			<td><?=$srch_name?></td>
			<td><?=$srch_age?></td>
			<td><?=$srch_si?></td>
			<td><?=$srch_gu?></td>
			<td><?=$match['match_date']?></td>
			<td><?=$match['helper_name']?></td>
            <td>
                <input type="checkbox" name="block_chk[]" value="<?=$srch_parent_mb_no?>" <?=$block_checked?> />
            </td>
			<? if ($member['mb_status'] == "관리자") { ?><td><button type="button" class="btn02" onclick="fnListDel('<?=$match['idx']?>');">삭제</button></td><? } ?>
		</tr>
		<?
			$num--;
			}
		}
		?>
		</tbody>
		</table>
		<!-- //소개이력 -->

		<br>
		<div class="btn_confirm01 btn_confirm">
			<a href="javascript:void(0);" onclick="getWinClose();">닫기</a>
		</div>
	</div>

	<!-- 관리자 코멘트 -->
	<? 
	$cmt_mode = "member";
	include_once(G5_ADMIN_PATH."/helper_comment.php"); 
	?>

</div>

<script>
function fnListDel(idx) {
	if (confirm("소개이력을 삭제하시겠습니까? 삭제된 내용은 복구되지 않습니다.") == true) {
		$.ajax({  
			type : "post",  
			url : "./ajax.helper_update.php",
			data : {"mode" : "match_del", "idx" : idx},
			dataType : "text",  
			success : function(data) {  
				if (data == "T") {
					location.reload();
				} else {
					alert("삭제에 실패하였습니다. 다시 시도해 주세요.");
				}
			},  
			error : function(xhr,status,error) {
				alert("삭제에 실패하였습니다. 다시 시도해 주세요.");
			}  
		});

	} else {
		return false;
	}
}


// 소개이력 회원 제외/해제 체크박스
function checkMemberBlock() {
    var chk = [];
    var unChk = [];
    var chkbox = document.querySelectorAll("input[name='block_chk[]']");

    for (var i=0; i<chkbox.length; i++) {
        if(chkbox[i].value == "" || chkbox[i].value == null) continue;
        if (chkbox[i].checked) chk.push(chkbox[i].value);
        else unChk.push(chkbox[i].value);
    }

    $.ajax({
        type : "post",
        url : "./ajax.helper_update.php",
        data : {"mode" : "mb_block_chk", "chk" : chk, "unChk" : unChk},
        dataType : "text",
        success : function(data) {
            // window.opener.location.reload();
            location.reload();
        },
        error : function(xhr,status,error) {
            alert("요청에 실패하였습니다. 다시 시도해 주세요.");
        }
    });

}

// 전체선택
function allCheck(checked) {
    var chkbox = document.querySelectorAll("input[name='block_chk[]']");
    for (var i=0; i<chkbox.length; i++) {
        chkbox[i].checked = checked;
    }
}
// 개별선택
var chkbox = document.querySelectorAll("input[name='block_chk[]']");
for (var i=0; i<chkbox.length; i++) {
    chkbox[i].addEventListener("click", function() {
        var value = false;
        if (this.checked) {
            var check_length = document.querySelectorAll("input[name='block_chk[]']:checked").length;
            if (chkbox.length == check_length) value = true;
            else value = false;
        }
        document.querySelector("#list_all_chk").checked = value;
    });
}


</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>