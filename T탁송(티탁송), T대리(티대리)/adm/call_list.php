<?php
$sub_menu = 250100;
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// 상단 상태탭
$tab = (string)$_GET['tab'];

$sql_common = " from g5_call where is_public = 'Y' ";

// (대리점 로그인시) 본인 대리점만 조회
if ($member['mb_level'] != "10") {
	$sql_common .= " AND agency_no = '{$member['mb_no']}' ";
} else {
	// (관리자) 대리점 카테고리 선택가능
	if ($sca != "")
		$sql_common .= " AND agency_no = '{$sca}' ";
}

// 검색
if ($stx) {
	if ($sfl == "mb_name") {		// 고객명
		$result = sql_query("SELECT mb_id FROM g5_member WHERE {$sfl} LIKE '%{$stx}%'");
		$tmp = array();
		while($row = sql_fetch_array($result)) {
			$tmp[] = "'{$row['mb_id']}'";
		}
		if (count($tmp) > 0) {
			$sql_common .= " AND mb_id IN (".implode(",", $tmp).")";
		}
	} else if ($sfl == "idx") {
        $sql_common .= " AND idx = '{$stx}' ";
    }
}
// 탭
if ($tab != "") {
	$sql_common .= " AND call_status = '{$tab}'";
}
// 오늘신청현황
$today = $_GET['today'];
if ((int)$today == 1) {
    $sql_common .= " AND call_regdate LIKE '".G5_TIME_YMD."%' ";
}

// 포인트현황에서 링크로 왔을때
if (!empty($_GET['idx'])) {
    $sql_common .= " AND idx = '{$_GET['idx']}'";
}

//$sql_order = " order by idx DESC ";
//$sql_order = "ORDER BY (CASE call_status WHEN '0' THEN 1 ELSE 2 END) ASC, idx DESC";
//$sql_order = "ORDER BY call_req_dateTS DESC, (CASE call_status WHEN '0' THEN 2 ELSE 1 END) DESC, idx DESC";
$sql_order = "ORDER BY call_req_dateTS DESC, idx DESC";

// 페이징
$sql = " select count(*) as cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);			// 전체 페이지 계산
if ($page < 1) $page = 1;							// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;					// 시작 열을 구함
$list_no = $total_count - ($rows * ($page - 1));	// 글번호(내림차순)

// 리스트
$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = '콜접수내역';
include_once('./admin.head.php');

?>
<style>
.tbl_wrap {text-align: center;}
.memo {margin-top: 10px; padding: 5px; background: #f7f7f7;}
.tbl_head02 tbody td {padding: 6px 2px;}
.new {background: #FFFFC0 !important;}
.local_sch .tab ul {display: inline-block;}
.local_sch .tab button.btn {float: right; height: 32px; line-height: 32px; background: #ff3061; border: 0; color: #FFF;}
</style>

<div class="local_ov01 local_ov">
    <a href="./call_list.php" class="ov_listall">전체목록</a>
    총 <?php echo number_format($total_count) ?>개
</div>

<form id="fsearch" name="fsearch" class="local_sch" method="get">
	<div class="local_sch01">
		<label for="sfl" class="sound_only">검색대상</label>
		<? 
		if ($member['mb_level'] == "10") { 
			$rst = sql_query("SELECT mb_no, mb_nick FROM g5_member WHERE mb_level = '9' ORDER BY mb_nick ASC;");
			$rst_cnt = sql_num_rows($rst);
			if ($rst_cnt > 0) { 
		?>
		<select name="sca" onchange="document.fsearch.submit();">
			<option value="">대리점전체</option>
			<? while($agency = sql_fetch_array($rst)) { ?>
			<option value="<?=$agency['mb_no']?>" <? if ($sca == $agency['mb_no']) echo "selected"; ?>><?=$agency['mb_nick']?></option>
			<? } ?>
		</select>
		<? 
			}
		}
		?>
		<select name="sfl" id="sfl">
			<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>고객명</option>
			<option value="idx"<?php echo get_selected($_GET['sfl'], "idx"); ?>>콜번호</option>
		</select>
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
		<input type="submit" class="btn_submit" value="검색">
	</div>
	<div class="tab">
		<ul>
			<li><label for="tall" <? if ($tab == "") { ?>class="on"<? } ?>><input type="radio" name="tab" id="tall" value="" <? if ($tab == "") echo "checked"; ?>>전체</label></li>
			<? 
			foreach ($callstt_name as $key=>$val) {
				$checked = ($tab == (String)$key && $tab != "")? true : false;
			?>
			<li><label for="t<?=$key?>" <? if ($checked) { ?>class="on"<? } ?>><input type="radio" name="tab" id="t<?=$key?>" value="<?=$key?>" <? if ($checked) echo "checked"; ?>><?=$val?></label></li>
			<? } ?>
		</ul>

        <input type="hidden" name="today" value="<?=$today?>">
        <button type="button" class="btn" onclick="getTodayList()">오늘신청현황</button>
	</div>
</form>

<!--<div class="local_desc01 local_desc">
    <p>승인완료 되어야 대리점 사용이 가능합니다.</p>
</div>-->


<!--<div class="btn_add01 btn_add">-->
<!--    <a href="./agency_form.php" id="member_add">오늘신청현황</a>-->
<!--</div>-->

<form name="flist" id="flist" action="" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
	<colgroup>
		<col width="4%">
		<col width="*">
		<col width="7%">
		<col width="7%">
		<col width="*">
		<col width="*">
		<col width="*">
		<col width="*">
        <col width="4%">
		<col width="*">
		<col width="*">
		<col width="*">
		<col width="5%">
		<col width="5%">
		<col width="5%">
		<col width="7%">
		<col width="5%">
		<col width="*">
		<col width="*">
	</colgroup>
    <thead>
	<tr>
		<th rowspan="2">No.</th>
		<th rowspan="2">대리점</th>
		<th rowspan="2">고객</th>
		<th rowspan="2">기사</th>
		<th rowspan="2">요청구분</th><!-- 탁송, 대리 -->
		<th rowspan="2">콜구분</th><!-- 빠른콜, 환급콜 -->
		<th rowspan="2">결제</th><!-- 현금, 포인트 -->
		<th rowspan="2">날짜/시간</th>
        <th rowspan="2">콜번호</th>
		<th rowspan="2">전체경로</th>
		<th rowspan="2">총거리</th>
		<th colspan="4">요금</th>
		<th>신청일자</th>
		<th rowspan="2">상태</th>
	</tr>
	<tr>
		<th>기본</th>
		<th>경유콜</th>
		<th>2.5톤</th>
		<th>총금액</th>
		<th>완료일자</th>
	</tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg0'; //'bg'.($i%2);
        if ($row['call_status']=="0") $bg = "new";

        $mb_id = $row['mb_id'];

		// 대리점
		$agency = sql_fetch("SELECT mb_nick FROM g5_member WHERE mb_no = '{$row['agency_no']}'");

		// 고객, 기사
		$names = array();
		if ($row['driver_id'] != "") {
			$sql = "SELECT mb_name AS driver_name, mb_hp AS driver_tel,
					(SELECT mb_name FROM g5_member WHERE mb_id = '{$mb_id}') AS cust_name
					FROM g5_member WHERE mb_id = '{$row['driver_id']}'";
		} else {
			$sql = "SELECT mb_name AS cust_name FROM g5_member WHERE mb_id = '{$mb_id}'";
		}
		$names = sql_fetch($sql);

        // 날짜/시간
        $start_time = callStartTime($row['call_req_today'], $row['call_regdate'], $row['call_req_time']);

        $start_place = $row['start_place'];
        $pass_place = $row['pass_place'];
        $end_place = $row['end_place'];

        // 좌표로 상세주소
        $path = '/v2/local/geo/coord2address';
        $content_type = 'json'; // json or xml

        $update_query = array();

        if ($row['start_addr'] == "") {
            // 1) 출발지 주소
            $params = http_build_query(array('x' => $row['start_lng'], 'y' => $row['start_lat']));
            $decode = kakaoRestApi($path, $params, $content_type);
            if ($decode['meta']['total_count'] > 0) {
                $search_data = $decode['documents'][0];
                // if 도로명 else 지번
                if (count($search_data['road_address']) > 0) $start_place = $search_data['road_address']['address_name'] . " " . $search_data['road_address']['building_name'];
                else $start_place = $search_data['address']['address_name'];
            }
            $update_query[] = "start_addr = '{$start_place}'";
        }
        // 2) 경유지 주소 (존재하면)
        if ($row['pass_addr'] == "" && $row['pass_place'] != "") {
            $params = http_build_query(array('x' =>$row['pass_lng'], 'y'=>$row['pass_lat']));
            $decode = kakaoRestApi($path, $params, $content_type);
            if ($decode['meta']['total_count'] > 0) {
                $search_data = $decode['documents'][0];
                // if 도로명 else 지번
                if (count($search_data['road_address']) > 0) $pass_place = $search_data['road_address']['address_name']." ".$search_data['road_address']['building_name'];
                else $pass_place = $search_data['address']['address_name'];
            }
            $update_query[] = "pass_addr = '{$pass_place}'";
        }
        // 3) 도착지 주소
        if ($row['end_addr'] == "") {
            $params = http_build_query(array('x' => $row['end_lng'], 'y' => $row['end_lat']));
            $decode = kakaoRestApi($path, $params, $content_type);
            if ($decode['meta']['total_count'] > 0) {
                $search_data = $decode['documents'][0];
                // if 도로명 else 지번
                if (count($search_data['road_address']) > 0) $end_place = $search_data['road_address']['address_name'] . " " . $search_data['road_address']['building_name'];
                else $end_place = $search_data['address']['address_name'];
            }
            $update_query[] = "end_addr = '{$end_place}'";
        }

        if (count($update_query) > 0) {
            $query = "UPDATE g5_call SET ";
            $query .= implode(",", $update_query);
            $query .= " WHERE idx = '{$row['idx']}'";
            sql_query($query);
        }

    ?>
	<tr class="<?=$bg?>">
		<td rowspan="2"><?=$list_no?></td>
		<td rowspan="2"><?=$agency['mb_nick']?></td>
		<td><?=$names['cust_name']?></td>
		<td><?=$names['driver_name']?></td>
		<!-- 요청구분 : 탁송/대리 -->
		<td rowspan="2"><?=iconv_substr($calltype_name[$row['call_type']], 0, 2, "utf-8")?></td>
		<!-- 콜구분 : 빠른콜, 환급콜 -->
		<td rowspan="2"><?=$callkind_name[$row['call_kind']]?></td>
		<!-- 결제 -->
		<td rowspan="2"><?=$callpay_name[$row['call_payment']]?></td>
        <!-- 날짜/시간 -->
        <td rowspan="2"><?=$start_time?></td>
        <!-- 콜번호 -->
        <td rowspan="2"><?=$row['idx']?></td>
		<!-- 전체경로 -->
		<td rowspan="2" style="text-align: left;">
			<div>
                <div><strong style="color:red;">출발</strong> <?=$row['start_place']?></div>
                <div style="margin-left: 30px;">(<?=$row['start_addr']?>)</div>
            <div>
			<? if ($row['pass_addr'] != "") { ?>
                <div><strong>경유</strong> <?=$row['pass_place']?></div>
                <div style="margin-left: 30px;">(<?=$row['pass_addr']?>)</div>
            <? } ?>
			<div style="margin-top: 5px;">
                <div><strong style="color: blue">도착</strong> <?=$row['end_place']?></div>
                <div style="margin-left: 30px;">(<?=$row['end_addr']?>)</div>
            <div>

			<? if ($row['call_memo'] != "" || $row['call_memo2'] != "") { ?>
			<div class="memo">
                <? if ($row['call_memo'] != "") { ?>
                <div><strong>출발 상세</strong> : <?=$row['call_memo']?></div>
                <? } ?>
                <? if ($row['call_memo2'] != "") { ?>
                <div><strong>도착 상세</strong> : <?=$row['call_memo2']?></div>
                <? } ?>
            </div>
			<? } ?>

		</td>
		<!-- 총거리 -->
		<td rowspan="2"><?=$row['call_dist']?>km</td>
		<!-- 기본요금 -->
		<td rowspan="2"><?=number_format($row['call_price'])?></td>
		<!-- 경유콜 -->
		<td rowspan="2"><?=number_format($row['call_pass_call_price'])?></td>
		<!-- 2.5톤 -->
		<td rowspan="2"><?=number_format($row['call_5t_price'])?></td>
		<!-- 총요금 -->
		<td rowspan="2"><?=number_format($row['call_total_price'])?></td>
		<!-- 신청일자 -->
		<td><?=substr(date("Y.m.d H:i", strtotime($row['call_regdate'])), 2, 14)?></td>
		<!-- 상태 -->
		<td rowspan="2">
            <?php
            $change_status_arr = array();

            switch ($row['call_status']) {
                case "1" :  // 1:진행중이면 = 2:완료 or -1:취소 가능
                    $change_status_arr[] = "1";
                    $change_status_arr[] = "2";
                    $change_status_arr[] = "-1";
                    break;

                case "2" :  // 2:진행완료이면 = -1:취소가능 (기사가 완료안했는데 완료처리 하는경우가 있다함)
                    $change_status_arr[] = "2";
                    $change_status_arr[] = "-1";
                    break;

                case "-1" : // -1취소이면 = 0:신청, R:접수로 변경가능
                    $change_status_arr[] = "0";
                    $change_status_arr[] = "R";
                    $change_status_arr[] = "-1";
                    break;

                default :
                    if ($row['call_status'] == "0" || $row['call_status'] == "R") { // 0:신청 or R:접수이면 = 서로 변경, 취소가능
                        $change_status_arr[] = "0";
                        $change_status_arr[] = "R";
                        $change_status_arr[] = "-1";
                    }
            }

            if (count($change_status_arr) > 0) {
            ?>
            <select name="status[]" onchange="changeStatus(this)" data-idx="<?=$row['idx']?>" data-origin="<?=$row['call_status']?>">
                <?
                foreach ($change_status_arr AS $key=>$val) {
                    $_selected = ($val==$row['call_status'])? "selected" : "";
                ?>
                <option value="<?=$val?>" <?=$_selected?>><?=$callstt_name[$val]?></option>
                <? } ?>
            </select>
            <?php } else { ?>
            <?=$callstt_name[$row['call_status']]?>
            <?php } ?>
        </td>
	</tr>
	<tr class="<?=$bg?>">
		<td><?=$row['mb_hp']?></td>
		<td><?=$names['driver_tel']?></td>
		<td>
			<? if ($row['call_status'] == "2") { // 진행완료인경우 날짜표시 ?>
			<?=substr(date("Y.m.d H:i", strtotime($row['success_date'])), 2, 14)?>
			<? } ?>
		</td>
	</tr>
    <?php
		$list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan=\"17\" class=\"empty_table\">내역이 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<? /*
<div class="btn_list01 btn_list">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <input type="submit" name="act_button" value="상태변경" onclick="document.pressed=this.value">
</div>
*/ ?>

</form>

<?
// 페이징 파라미터
$qstr_arr = [];
foreach ($_GET AS $key=>$val) {
    if ($key == "page" || $key == "token" || $val == "") continue;
    $qstr_arr[] = $key."=".$val;
}
$qstr = implode("&", $qstr_arr);
echo get_paging($config['cf_write_pages'], $page, $total_page, '?'.$qstr);
?>

<script>
$(function() {
	$("#fsearch input[name=tab]").on("click", function() {
		$("#fsearch").submit();
	});
});

// 오늘신청현황
function getTodayList() {
    document.querySelector("[name=today]").value = 1;
    document.fsearch.submit();
}

// 상태변경 (현재 신청,접수만 변경가능)
function changeStatus(el) {
    var status = el.options[el.selectedIndex].value;
    var opt_txt = el.options[el.selectedIndex].text;
    var idx = el.getAttribute("data-idx");
    var origin_status = el.getAttribute("data-origin");
    var msg = opt_txt + "(으)로 상태를 변경하시겠습니까?";
    console.log(`origin_status ${origin_status}, 변경상태 status ${status}`);

    if (!confirm(msg)) { // 상태변경 취소시 select 원복
        var opts = el.options;
        for (var i=0; i<opts.length; i++) {
            if (origin_status == opts[i].value) opts[i].selected = true;
        }
        return false;
    }

    $.post("./ajax.call_list_update.php", {mode: "change", status: status, origin_status: origin_status, idx: idx} ).done(function(json) {
        console.log(json);
        var data = JSON.parse(json);
        if (!data.result) {
            alert("변경에 실패하였습니다. 다시 시도해 주세요.");
        }
    }, "json").fail(function() {
        alert("변경에 실패하였습니다. 다시 시도해 주세요.");

    }).always(function() {
        location.reload();
    });
}

/*
$(".mb_tbl select").on("change", function() {
	var idx = $(this).data("idx");
	if (typeof idx != "undefined") {
		$("#chk_" + idx).prop("checked", true);
	}
});

function flist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "상태변경") {
        if(!confirm("선택한 대리점의 상태를 변경하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
*/
</script>

<?php
include_once ('./admin.tail.php');
?>
