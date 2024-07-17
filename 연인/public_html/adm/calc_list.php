<?php
$sub_menu = "500100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '정산현황';
include_once('./admin.head.php');

// 비고 삭제 목적
array_pop($match_type_arr);

// 검색조건
$t = ($_GET['t'])? $_GET['t'] : "1";	// 1:당일, 2:월별
$s_date = ($_GET['s_date'])? $_GET['s_date'] : date("Y-m-d");
$s_year = ($_GET['s_year'])? $_GET['s_year'] : date("Y");
$s_month = ($_GET['s_month'])? $_GET['s_month'] : date("m");

// 조건문
if ($t == "2") {
	$start_date = $s_year."-".sprintf('%02d', $s_month)."-01";
	$end_date = date("Y-m-d", strtotime("+1 month", strtotime($start_date))); // 다음달1일
} else {
	$start_date = $s_date;
	$end_date = date("Y-m-d", strtotime("+1 day", strtotime($s_date)));	// 다음날
	
}
$sql_common = " AND match_date >= '{$start_date}' AND match_date < '{$end_date}'";


// 헬퍼리스트
/*$sql = "SELECT helper_id, (SELECT mb_name FROM g5_member WHERE g5_matching.helper_id = mb_id) AS helper_name FROM g5_matching
		GROUP BY helper_id ORDER BY helper_id ASC";*/
$sql = "SELECT mb_id AS helper_id, mb_name AS helper_name FROM g5_member 
		WHERE mb_level = '10' AND mb_status = '헬퍼' AND mb_3 != 'out' ORDER BY mb_no ASC;";
$result = sql_query($sql);
$helper_cnt = sql_num_rows($result);

$helpers = array();

for ($i = 0; $i < $helper_cnt; $i++) {
	$helpers[$i] = sql_fetch_array($result);

	// 카운팅
	$sql = "SELECT COUNT(CASE WHEN match_type = '{$match_type_arr[0]}' THEN 1 END) AS 'case1',
			COUNT(CASE WHEN match_type = '{$match_type_arr[1]}' THEN 1 END) AS 'case2',
			COUNT(CASE WHEN match_type = '{$match_type_arr[2]}' THEN 1 END) AS 'case3',
			COUNT(CASE WHEN match_type = '{$match_type_arr[3]}' THEN 1 END) AS 'case4',
            COUNT(CASE WHEN match_type = '{$match_type_arr[4]}' THEN 1 END) AS 'case5',
            COUNT(CASE WHEN match_type = '{$match_type_arr[5]}' THEN 1 END) AS 'case6'
			FROM g5_matching
			WHERE helper_id = '{$helpers[$i]['helper_id']}' 
			{$sql_common}
			";
	$rs = sql_fetch($sql);

    $_coupon = (double)($rs['case3'] / 2);  // 쿠폰소개 (1건당 0.5건으로 표기)
    $_heart = (double)($rs['case4'] / 2);   // 하트소개 (1건당 0.5건으로 표기)

	$helpers[$i][$match_type_arr[0]] = $rs['case1'];	// 계좌결제
	$helpers[$i][$match_type_arr[1]] = $rs['case2'];	// 폰&카드
	$helpers[$i][$match_type_arr[2]] = $_coupon;	// 쿠폰
	$helpers[$i][$match_type_arr[3]] = $_heart;	// 하트
    $helpers[$i][$match_type_arr[4]] = $rs['case5'];	// 리매칭
    $helpers[$i][$match_type_arr[5]] = $rs['case6'];	// 이벤트
	$helpers[$i]['total'] = $rs['case1'] + $rs['case2'] + $_coupon + $_heart;
}

// 비교 함수 정의
function compareByTotal($a, $b) {
    if ($a['total'] == $b['total']) {
        return 0;
    }
    return ($a['total'] > $b['total']) ? -1 : 1;
}

usort($helpers, 'compareByTotal');
$helpers_re = $helpers;

// total순으로 재정렬
//$helpers_re = arrReSort($helpers, 'total', 'desc');

?>

<style>
    #popup_layer {position: absolute; padding: 10px; border: 2px solid #444; z-index: 999; background: #FFF; display: none; max-height: 400px; overflow-y: scroll;}
    #popup_layer .tbl_wrap {padding:0; margin:0;}
    #popup_layer th {padding: 5px; background: #f2f5f9;}
    #popup_layer td {text-align: center;}
    .total_rows {background: #F9F9F9;}
    .total_rows td {font-weight: bold;}
</style>

<div class="local_ov01 local_ov">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a>
    <span>전체 <?php echo number_format($helper_cnt) ?>명</span>
</div>

<!-- 검색 -->
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<input type="radio" name="t" value="1" id="m01" <? if ($t == "1") echo "checked"; ?>><label for="m01"> 당일소개</label>
	<input type="text" name="s_date" id="s01" value="<?=$s_date?>" class="frm_input" style="margin-right: 20px;" readonly>
	<input type="radio" name="t" value="2" id="m02" <? if ($t == "2") echo "checked"; ?>><label for="m02"> 월별소개</label>
	<select name="s_year" id="s02">
		<? for ($y = 2019; $y <= date("Y"); $y++) { ?>
		<option value="<?=$y?>" <? if ($s_year == $y) echo "selected"; ?>><?=$y?></option>
		<? } ?>
	</select>
	<select name="s_month" id="s03">
		<? for ($m = 1; $m < 13; $m++) { ?>
		<option value="<?=$m?>" <? if ((int)$s_month == $m) echo "selected"; ?>><?=$m?></option>
		<? } ?>
	</select>
	<input type="submit" class="btn_submit" value="검색">
</form>
<!-- // 검색 -->
<div class="max1200" id="calc_list">
	<div class="tbl_head02 tbl_wrap mb_tbl">
		<table class="avg">
		<caption><?php echo $g5['title']; ?> 목록</caption>
		<colgroup>
			<col width="8%">
			<col width="15%">
			<? foreach ($match_type_arr as $key=>$val) { ?>
			<col width="10%">
			<? } ?>
            <col width="10%">
		</colgroup>
		<thead>
		<tr>
			<th>순위</th>
			<th>헬퍼</th>
			<? foreach ($match_type_arr as $key=>$val) { ?>
			<th><?=$val?></th>
			<? } ?>
			<th>총 건수</th>
		</tr>
		</thead>
		<tbody>
		<?php
        $type_total_count = []; // 소개별 합계
		for ($i=0; $i < $helper_cnt; $i++) {
			$helper_id = $helpers_re[$i]['helper_id'];
		
		?>
		<tr>
			<td><?=$i+1?></td>
			<td><?=$helpers_re[$i]['helper_name']?></td>
			<? 
			// 계좌결제소개, 폰&카드소개, 리매칭소개, 이벤트소개
			for ($j = 0; $j < count($match_type_arr); $j++) {
				$unq_no = $j.$i;
                $match_cnt = $helpers_re[$i][$match_type_arr[$j]];
			?>
			<td>
				<span id="col<?=$unq_no?>"><?=$match_cnt?></span>
				<? if ($match_cnt > 0) { ?>
				<a href="javascript:void(0)" class="btn_detail" onclick="getCalcDetail(this, '<?=$j?>', '<?=$helper_id?>', '<?=$unq_no?>');">▼</a>
				<? } ?>
			</td>
			<?
                $type_total_count[$j] += $match_cnt;
            } // end for
            $type_total_count['total'] += $helpers_re[$i]['total'];
            ?>
			<td><strong><?=$helpers_re[$i]['total']?></strong></td>
		</tr>
		<?php } ?>
        
        <?php
        // 220705 소개별 총합계 추가
        ?>
        <tr class="total_rows">
            <td colspan="2">소개별 합계</td>
            <? for ($j = 0; $j < count($match_type_arr); $j++) { ?>
            <td><?=$type_total_count[$j]?></td>
            <? } ?>
            <td><?=$type_total_count['total']?></td>
        </tr>

        <?php
		if ($i == 0)
			echo "<tr><td colspan='7' class=\"empty_table\">조회 결과가 없습니다.</td></tr>";
		?>
		</tbody>
		</table>
		
		<br>
        <p>※ 총 건수는 계좌결제소개 + 폰&카드소개 + 쿠폰소개 + 포인트소개</p>
        <p>※ 쿠폰소개, 포인트소개는 1건당 0.5건으로 집계됩니다.</p>
	</div>

	

	<!-- 관리자 코멘트 -->
	<? 
	$cmt_mode = "calc";
	include_once(G5_ADMIN_PATH."/helper_comment.php"); 
	?>

</div>


<!-- 팝업레이어 -->
<div id="popup_layer"></div>


<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
	day_arr = ['일', '월', '화', '수', '목', '금', '토'];

var clk_row = "",	// 상세보기 클릭행
	clk_el = "";	// 상세보기 클릭버튼

$(function() {
	$("#s01").datepicker({ 
		changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr

	}).on("change", function() {
		$("#m01").prop("checked", true);
	});

	$("#s02, #s03").on("change", function() {
		$("#m02").prop("checked", true);
	});

});


// 상세보기
function getCalcDetail(elem, t, id, row) {
	var el = $(elem),
		el_h = el[0].offsetHeight + 10,
		left = el.offset().left,
		//top = el.offset().top + el_h,
		toggle = $("#popup_layer").css("display"); //document.getElementById("popup_layer").style.display;

    var contanier_top = $("#wrapper").offset().top;
    var top = (el.offset().top + el_h) - contanier_top;

	var show_flag = false;

	// 초기화
	$("#popup_layer").hide();
	$(".btn_detail").html("▼");
	if (clk_row == "") clk_row = row;

	if (toggle == "none") {
		show_flag = true;

	} else {
		if (clk_row != row) {
			show_flag = true;
		}
	}

	if (show_flag) {
		var srch_t = $("input[name=t]:checked").val(),
			srch_date = $("#s01").val();
		if (srch_t == "2") {
			srch_date = $("#s02 option:selected").val() + "-" + $("#s03 option:selected").val()
		}

		$.ajax({  
			type : "post",  
			url : g5_admin_url + "/ajax.calc_detail.php",
			data : {"t" : t, "helper_id" : id, "srch_t" : srch_t, "srch_date" : srch_date},
			dataType : "html",  
			success : function(data) {  
				el.html("▲");
				$("#popup_layer").html(data).css({
					"top": top,
					"left": left
				}).show();
			},  
			error : function(xhr,status,error) {
				alert("상세내역을 불러오는데 실패하였습니다. 다시 시도해주세요.");
			}  
		});
	}

	clk_row = row;
	clk_el = elem;
}

// 소개이력 삭제
function fnListDel(idx, t, id) {
	if (confirm("소개이력을 삭제하시겠습니까? 삭제된 내용은 복구되지 않습니다.") == true) {
		$.ajax({  
			type : "post",  
			url : "./ajax.helper_update.php",
			data : {"mode" : "match_del", "idx" : idx},
			dataType : "text",  
			success : function(data) {  
				if (data == "T") {
					var cnt = parseInt($("#col"+clk_row).text()) - 1;
					if (cnt < 0)	cnt = 0;

					$("#popup_layer").hide();
					$("#col"+clk_row).html(cnt);
					getCalcDetail(clk_el, t, id, clk_row);
					//location.reload();

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
</script>


<?php
include_once ('./admin.tail.php');
?>

