<?php
include_once("./_head.php");
include_once("./lib/store_list_lib.php");

$get_params = array();

// 공통쿼리
$sql_common = " FROM store_receipt_list WHERE (1) ";

// 검색어 분류
$sfl = $_GET['sfl'];
// 검색어
$stx = $_GET['stx'];
// 스토어 계정
$stg = $_GET['stg'];
// 상태
$stt = $_GET['stt'];
// 구분
$os_type = $_GET['os_type'];

if($stx){
    $sql_common .= " AND ( ";
    switch ($sfl){
        case "srl_comp_name" :
            $sql_common .= " ({$sfl} LIKE '%{$stx}%') ";
            break;
        default :
            $sql_common .= " ({$sfl} LIKE '%{$stx}%') ";
            break;

    }
    $sql_common .= " ) ";
}

$sdate = $_GET['sdate'];
$edate = $_GET['edate'];
$end_sdate = $_GET['end_sdate'];
$end_edate = $_GET['end_edate'];


if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $sdate) ) $sdate = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $edate) ) $edate = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $end_sdate) ) $end_sdate = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $end_edate) ) $end_edate = '';

if ($sdate != '' && $edate != '') {
    $sql_common .= "  and srl_reg_date BETWEEN '$sdate' AND '$edate' ";
}else if($sdate != '' && $edate == ''){
    $sql_common .= "  and srl_reg_date >= '$sdate' && srl_reg_date != '0000-00-00' ";
}else if($sdate == '' && $edate != ''){
    $sql_common .= "  and srl_reg_date <= '$edate' && srl_reg_date != '0000-00-00' ";
}

if ($end_sdate != '' && $end_edate != ''){
    $sql_common .= "  and srl_complete_date BETWEEN '$end_sdate' AND '$end_edate' ";
}else if($end_sdate != '' && $end_edate == ''){
    $sql_common .= "  and srl_complete_date >='$end_sdate' && srl_complete_date != '0000-00-00' ";
}else if($end_sdate == '' && $end_edate != ''){
    $sql_common .= "  and srl_complete_date <='$end_edate' && srl_complete_date != '0000-00-00' ";
}

if ($stg != '')
    $sql_common .= "  and srl_account_class = '$stg' ";

if ($stt != '')
    $sql_common .= "  and srl_state = '$stt' ";

if ($os_type != '')
    $sql_common .= "  and srl_class = '$os_type' ";


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

$sql_orderby = "ORDER BY srl_reg_date DESC";

// 리스트
$sql = "SELECT *,
		(SELECT COUNT(*) FROM store_history WHERE srl_no = store_receipt_list.srl_no) AS history_cnt
		{$sql_common} {$sql_orderby} {$sql_limit}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

$params = "&stt=$stt&os_type=$os_type&stg=$stg&sdate=$sdate&edate=$edate&end_sdate=$end_sdate&end_edate=$end_edate&sfl=$sfl&stx=$stx";

?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="./css/store_list.css?ver=<?=JS_CSS_NUM?>">
<script src="./js/store_list.js?ver=<?=JS_VER_NUM?>"></script>



<div class="list_filter">
    <form name="sfrm" autocomplete="off" onsubmit="return frmSrch(this);" class="search_frm" method="get">
        <ul>
            <li class="state" style="padding:0px;">
                <div class="state01">
                    <em class="li_title">상태</em>
                    <span>
						<select name="stt">
                            <option <?=$stt=='' ? "selected" : "" ?> value="">선택</option>
							<option <?=$stt=='준비중' ? "selected" : "" ?> >준비중</option>
							<option <?=$stt=='심사중' ? "selected" : "" ?> >심사중</option>
							<option <?=$stt=='거절' ? "selected" : "" ?> >거절</option>
							<option <?=$stt=='재심사' ? "selected" : "" ?> >재심사</option>
							<option <?=$stt=='완료' ? "selected" : "" ?> >완료</option>
						</select>
					</span>
                </div>
            </li>

            <li class="state">
                <div class="data01">
                    <em  class="li_title">구분</em>
                    <span>
						<select name="os_type">
                            <option <?=$os_type=='' ? "selected" : "" ?> value="">선택</option>
							<option <?=$os_type=='aOS' ? "selected" : "" ?> >aOS</option>
							<option <?=$os_type=='IOS' ? "selected" : "" ?> >IOS</option>
							<option <?=$os_type=='aOS(업데이트)' ? "selected" : "" ?> >aOS(업데이트)</option>
							<option <?=$os_type=='IOS(업데이트)' ? "selected" : "" ?> >IOS(업데이트)</option>
						</select>
					</span>
                </div>
            </li>


            <li class="data" style="margin:0px;">
                <div class="state01" >
                    <em  class="li_title">스토어계정</em>
                    <span>
						<select name="stg">
                            <option <?=$stg=='' ? "selected" : "" ?> value="">선택</option>
							<option <?=$stg=='자계정' ? "selected" : "" ?> >자계정</option>
							<option <?=$stg=='타계정' ? "selected" : "" ?> >타계정</option>
						</select>
					</span>
                </div>
            </li>


            <li class="data" style="width:100%;">
                <em>일자</em>
                <span>
                    <input type="text" id="start_date" name="sdate" value="<?=$sdate?>" /> ~ <input type="text" id="end_date" name="edate" value="<?=$edate?>" />
                </span>
            </li>

            <li class="data">
                <div class="state02">
                    <em>완료일자</em>
                    <span>
                        <input type="text" id="comp_start_date" name="end_sdate" value="<?=$end_sdate?>" /> ~ <input type="text" id="comp_end_date" name="end_edate" value="<?=$end_edate?>" />
                    </span>
                </div>
            </li>


            <li class="state">
                <div class="state02">
                    <em style="width:64px;">검색어</em>
                    <span>
						<select name="sfl">
							<option value="srl_comp_name">업체명</option>
						</select>
						<input type="text" name="stx" value="<?=$stx?>">
					</span>
                </div>
            </li>

        </ul>

        <button type="submit">검색</button>
        <button type="button" onclick="location.href='./store_list.php'">초기화</button>
    </form>
</div>


<h1>스토어 등록현황</h1>

<div class="list_tbl">

	<span class="total">총 <?=number_format($total_count)?>건</span>
	<button type="button" class="btn btn_01" onclick="location.href='./store_write.php'">스토어 기록 등록</button>
	<dl>
		<dt>
			<div class="wid10">No.</div>
			<div class="wid40">업체명</div>
			<div class="wid10">신청일</div>
			<div class="wid10">구분</div>
			<div class="wid10">상태</div>
			<div class="wid10">스토어계정</div>
			<div class="wid10">완료일</div>
		</dt>

        <?php
        if($result_cnt==0){
            echo '<dd>등록된 글이 없습니다.</dd>';

        }else{
        for($i=0;$row=sql_fetch_array($result);$i++){
            // 답변수
            $history_cnt = (int)$row['history_cnt'];
            $box_color = "";
            switch($row['srl_state']){
                case '재심사':
                    $box_color = 'box_blue';
                    break;
                case '거절':
                    $box_color = 'box_red';
                    break;
                default :
                    $box_color = ' ';
            }

            ?>
			<dd>
				<div class="wid10"><?=number_format($list_no)?></div>
				<div class="wid40">
                    <a href="./store_read.php?srl_no=<?=$row['srl_no']?>" class="bld_chk" >
                        <?=$row['srl_comp_name']?>
                        <?php if ($history_cnt > 0) { ?><span class="cnt_style"><?=$history_cnt?></span><?php }?>
                    </a>
                </div>
				<div class="wid10"><?=$row['srl_reg_date']!=null ? substr($row['srl_reg_date'],0,10) : "" ?></div>
				<div class="wid10"><?=$row['srl_class']?></div>
				<div class="wid10 "><span class="box_size <?=$box_color?>"><?=$row['srl_state']?></span></div>
				<div class="wid10"><?=$row['srl_account_class']?></div>
				<div class="wid10"><?=$row['srl_complete_date']!=null ? substr($row['srl_complete_date'],0,10) : "" ?></div>
			</dd>
		<? $list_no--; }} ?>

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
                <a href="?page=<?=($e_page+1).$params?>" class="pg_page pg_end">맨끝</a>
            <?php } ?>
		</span>
    </nav>
</div>


<?
include_once("./_tail.php");
?>
