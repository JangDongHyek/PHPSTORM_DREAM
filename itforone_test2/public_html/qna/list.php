<?php 
include_once("./_head.php");

$get_params = array();

// 공통쿼리
$sql_common = "FROM project_qna WHERE is_notice = 'N' AND mid != '8910088' AND is_busan = 'N'"; // mid=8910088 (/test_editor/list.php)

// 검색조건
if (!empty($sdate)) { $sql_common .= " AND qa_regdate >= '{$sdate}'"; $get_params['sdate'] = $sdate; }	// 일자
if (!empty($edate)) { $sql_common .= " AND qa_regdate <= '{$edate} 23:59:59'"; $get_params['edate'] = $edate; }

if ($_GET['mid'] == "0") { $sql_common .= " AND mid = '0' AND is_admin = 'Y'"; $get_params['mid'] = $mid; }
else if (!empty($mid)) { $sql_common .= " AND (mid = '{$mid}' or mid_name = '{$mid}') "; $get_params['mid'] = $mid; }	// 업체명

if (!empty($stt)) { $sql_common .= " AND qa_status = '{$stt}'"; $get_params['stt'] = $stt; }	// 처리상태
if (!empty($stx)) { 	// 검색어

	$trim_stx = trim($stx);

	if ($sfl == "mng_name") {
	    if ($stx == "드림포원") {
            $sql_common .= " AND mid = '0' AND is_admin = 'Y'";

        } else {
            // 업체명 검색
            $add_mid = array();
            foreach ($manager as $mng_id => $val) {
                if (strpos($val['firm_name'], $trim_stx) !== false) {
                    // $srch_query .= " AND mid = '{$mng_id}' ";
                    $add_mid[] = $mng_id;
                }
            }

			if(count($add_mid) > 0){
				$sql_common .= " AND ( mid IN (". implode(",", $add_mid) .") or mid_name IN (". implode(",", $add_mid) .") or `mid_name` like '%{$stx}%' )";
			} else {
				$sql_common .= " AND (`mid_name` like '%{$stx}%' )";
			}
        }

	} else {
		$sql_common .= " AND {$sfl} LIKE '%{$trim_stx}%'"; 
	}

	$get_params['sfl'] = $sfl;
	$get_params['stx'] = $stx;
}
if ($_GET['chk']=='y') {$sql_common .= " AND rep_check = 'Y' "; $get_params['chk'] = 'y'; }  // 확인요망
if ($_GET['confirm']=='y') {$sql_common .= " AND work_check = 'Y' "; $get_params['chk'] = 'y'; }  // 검수요청


// 페이징
$sql = " SELECT COUNT(*) AS cnt {$sql_common}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$list_rows = 20;											// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)
// $list_no = 1 + ($list_rows * ($page - 1));				// 글번호(오름차순)

$sql_orderby = "ORDER BY idx DESC";

// 리스트
$sql = "SELECT *, 
		(SELECT COUNT(*) FROM project_qna_reply WHERE pidx = project_qna.idx) AS reply_cnt,
		(SELECT COUNT(*) FROM project_qna_reply2 WHERE pidx = project_qna.idx) AS reply_cnt2
		{$sql_common} {$sql_orderby} {$sql_limit}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


// 처리상태 클래스
$status_cls = array("접수완료"=>"btn01", "처리완료"=>"btn02", "담당자연락"=>"btn03");

// 공지사항
$noti_result = sql_query("SELECT * FROM project_qna WHERE is_notice = 'Y' ORDER BY idx DESC");

// 검색파라미터추가
$params = "";
if (count($get_params) > 0) {
	foreach ($get_params AS $key=>$val) {
		$params .= "&{$key}={$val}";
	}
}

?>

<h1>CS 관리</h1>

<div class="list_filter">
	<form name="sfrm" autocomplete="off" onsubmit="return frmSrch(this);">
		<ul>
			<li class="data">
				<em>일자</em>
				<span><input type="text" name="sdate" value="<?=$sdate?>"> ~ <input type="text" name="edate" value="<?=$edate?>"></span>&nbsp;
                <span class="chkbox">
                    <input type="checkbox" name="chk" id="chk" value="y" <?=($_GET['chk']=='y')?"checked":""?>/>
                    <label for="chk">확인요망</label>
                </span>
                <span class="chkbox">
                    <input type="checkbox" name="confirm" id="confirm" value="y" <?=($_GET['confirm']=='y')?"checked":""?>/>
                    <label for="confirm">검수요청</label>
                </span>
			</li>
			<li class="company">
				<em>업체명</em>
				<span>
					<select name="mid">
						<option value="">전체</option>
                        <option value="0" <?if($mid=="0") echo "selected";?>>드림포원</option>
						<?php foreach ($manager As $key=>$val) { ?>
						<option value="<?=$key?>" <?php if($mid==$key) echo "selected";?>><?=$val['firm_name']?></option>						
						<?php } ?>
					</select>
				</span>
			</li>
			<li class="state">
				<div class="state01">
					<em>처리상태</em>
					<span>
						<select name="stt">
							<option value="">전체</option>
							<?php foreach ($qa_status_list As $key=>$val) { ?>
							<option value="<?=$val?>" <?php if($stt==$val) echo "selected";?>><?=$val?></option>
							<?php } ?>
						</select>
					</span>
				</div>
				<div class="state02">
					<em>검색어</em>
					<span>
						<?php
						$srch_fileds = array("mng_name"=>"업체명", "qa_subject"=>"제목", "qa_name"=>"업체담당자명", "qa_dsgr"=>"작업담당(디)", "qa_prgr"=>"작업담당(프)");
						?>
						<select name="sfl">
							<?php foreach ($srch_fileds As $key=>$val) { ?>
							<option value="<?=$key?>" <?php if($key==$sfl) echo "selected";?>><?=$val?></option>
							<?php } ?>
						</select>
						<input type="text" name="stx" value="<?=$stx?>">
					</span>
				</div>
			</li>
		</ul>
		<button type="submit">검색</button>
		<button type="button" onclick="location.href='./list.php'">초기화</button>
	</form>
</div>

<div class="list_tbl">
	<!-- 공지사항 -->
	<dl class="notice_list">
		<?php for ($ii=0; $row=sql_fetch_array($noti_result); $ii++) { ?>
		<dd class="notice">
			<div class="num col10">공지</div>
			<div class="title col80"><a href="./view.php?idx=<?=$row['idx']?>&noti=y"><?=$row['qa_subject']?></a></div>
			<div class="data col10"><?=substr($row['qa_regdate'], 0, 10)?></div>
		</dd>
		<?php } ?>
	</dl>
	<span class="total">총 <?=number_format($total_count)?>건</span>
	<button type="button" class="btn btn_01" onclick="location.href='./write.php?noti=y'">공지등록</button>
	<button type="button" class="btn btn_01" onclick="location.href='./write.php'" style="margin-right: 5px;">수정접수등록</button>
	<dl>
		<dt>
			<div class="col5">No.</div>
			<div class="col25">업체명</div>
			<div class="col40">제목</div>
			<div class="col10">처리상태</div>
			<div class="col10">작업담당</div>
			<div class="col10">등록일</div>
		</dt>


		<!-- 글목록 -->
		<?php if ($result_cnt == 0) { ?>
        <dd style="padding: 10px; text-align: center">등록된 글이 없습니다.</dd>

		<?php 
		} else {
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				$is_file = (empty($row['qa_files_json']))? false : true;

				// 업체명
                if ($row['mid'] == "0") {
					$row['mid_name'] = trim($row['mid_name']);
					
					$mngr = $manager[$row['mid_name']];
					$cp_name = (!empty($mngr['site_name'])) ? $mngr['site_name'] : $mngr['firm_name'];
					if($cp_name == "") {
						$cp_name = $row['mid_name'];
					}

					if($cp_name == "0" || $cp_name == "" || $cp_name == null){
						$cp_name = "드림포원";
					}

					$cp_name = "(내부) ".$cp_name;
                   
                } else {
                    $mngr = $manager[$row['mid']];
                    $cp_name = (!empty($mngr['site_name'])) ? $mngr['site_name'] : $mngr['firm_name'];
                }

				// 답변수
				$reply_cnt = (int)$row['reply_cnt'];
				$reply_cnt2 = (int)$row['reply_cnt2'];
		?>
		<dd>
			<div class="num col5"><?=number_format($list_no)?></div>
			<div class="company col25"><?=$cp_name?></div>
			<div class="title col40">
				<a href="./view.php?idx=<?=$row['idx']?><?=$params?>">
					<?=$row['qa_subject']?> 
					<?php if ($is_file) { ?><img src="./img/icon_file.gif"><?php }?>
					

					<?php if ($reply_cnt > 0) { ?>		
					<span class="reply"><?=$reply_cnt?></span>
					<?php }?>

					<?php if ($reply_cnt2 > 0) { ?>
                    <span class="reply2"><i class="fa-regular fa-comment-dots"></i>
<!--                    <span class="txt-sm"><?=$reply_cnt2?></span>-->
                   	</span>
                    <?php }?>
                    
                    <?if ($row['rep_check'] == "Y") { ?>
                    <span class="cf">확인요망</span>
                    <?}?>

                    <?if ($row['work_check'] == "Y") { ?>
                    <span class="cf blue">검수요청</span>
                    <?}?>
				</a>
				</a>
			</div>
			<div class="state col10 <?=$status_cls[$row['qa_status']]?>"><span><?=$row['qa_status']?></span></div>
			<div class="wrkr col10">
				<div><span>디</span> <?=empty($row['qa_dsgr'])? "-" : $row['qa_dsgr'] ?></div>
				<div><span>프</span> <?=empty($row['qa_prgr'])? "-" : $row['qa_prgr']?></div>
			</div>
			<div class="data col10"><?=substr($row['qa_regdate'], 0, 10)?></div>
		</dd>
		<?php $list_no--; }} ?>
	</dl>

	<!-- 페이징 -->
	<nav class="pg_wrap">
		<span class="pg">
			<?php
			$page_num = ceil($total_count / $list_rows);	// 총페이지
			$block_num = ceil($page_num / $list_page_rows);	// 총블럭
			$now_block = ceil($page / $list_page_rows);

			$s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
			if ($s_page <= 1) $s_page = 1;
			$e_page = ($now_block * $list_page_rows);
			if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록
			?>
			<?php if ($now_block > 1) { ?>
			<a href="?page=1<?=$params?>" class="pg_page pg_start">처음</a>
			<?php } ?>
			<?php 
			for ($p=$s_page; $p<=$e_page; $p++) { 
				if ($page != $p) echo '<a href="?page='.$p.$params.'" class="pg_page">'.$p.'</a>';
				else echo '<span class="sound_only">열린</span><strong class="pg_current">'.$p.'</strong>';
			} 
			?>
			<?php if ($block_num > 1 && $block_num != $now_block) { ?>
			<a href="?page=<?=$e_page+1?><?=$params?>" class="pg_page pg_end">맨끝</a>
			<?php } ?>
		</span>
	</nav>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
	day_arr = ['일', '월', '화', '수', '목', '금', '토'];

$("input[name=sdate], input[name=edate]").datepicker({
	changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, showMonthAfterYear : true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr, currentText: '오늘', closeText: '닫기'
});

// 검색필터
function frmSrch(f) {
	const filter = Array();

	// 일자
	if (f.sdate.value != "") filter.push("sdate="+f.sdate.value);
	if (f.edate.value != "") filter.push("edate="+f.edate.value);
	// 업체명 select
	const mid = f.mid.options[f.mid.selectedIndex].value;
	if (mid.length > 0) filter.push("mid="+mid);
	// 처리상태 select
	const stt = f.stt.options[f.stt.selectedIndex].value;
	if (stt.length > 0) filter.push("stt="+stt);
	// 검색어
	if ((f.stx.value).replace(/ /g, '').length > 0) {
		filter.push("sfl="+f.sfl.options[f.sfl.selectedIndex].value);
		filter.push("stx="+f.stx.value);
	}
    // 확인요망
    if (f.chk.checked) filter.push("chk=y");
    // 검수요청
    if (f.confirm.checked) filter.push("confirm=y");

	const get = (filter.length > 0)? "?" + filter.join("&") : "";
	location.href = "./list.php" + get;

	return false;
}

</script>

<?
include_once("./_tail.php");
?>