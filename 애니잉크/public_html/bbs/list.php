<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        $category_option .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
        }
        $category_option .= '>'.$category_msg.$category.'</a></li>';
    }
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx) {
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

	@include_once($board_skin_path.'/list_search.head.skin.php');

    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "";

	if($bo_table == 'new'){
		if($sch_wr_2 == '' || $sch_wr_2 == '임대'){
			$sql_search .= " and wr_2 = '임대'";
		}
		if($sch_wr_2 == '임대해지'){
			$sql_search .= " and wr_2 = '임대해지'";
		}
		if($sch_wr_subject != ''){
			$sql_search .= " and wr_subject like '%{$sch_wr_subject}%'";
		}
		if($sch_wr_5 != ''){
			$sql_search .= " and wr_5 like '%{$sch_wr_5}%'";
		}
		if($sch_wr_7 != ''){
			$sql_search .= " and wr_7 like '%{$sch_wr_7}%'";
		}
		if($si != ''){
			$sql_search .= " and wr_10 like '{$si}%'";
		}
		if($gu != ''){
			$sql_search .= " and wr_10 like '%{$gu}%'";
		}
		if($sch_fdate1 != ''){
			$sql_search .= " and wr_1 >= '{$sch_fdate1}'";
		}
		if($sch_ldate1 != ''){
			$sql_search .= " and wr_1 <= '{$sch_ldate1}'";
		}
		if($sch_fdate2 != ''){
			$sql_search .= " and next_check_date >= '".str_replace('-','',$sch_fdate2)."'";
		}
		if($sch_ldate2 != ''){
			$sql_search .= " and next_check_date <= '".str_replace('-','',$sch_ldate2)."'";
		}
        if($sch_wr_17 != ''){
            $sql_search .= " and wr_17 = '{$sch_wr_17}'";
        }


		$as_where="";
		if($sch_inspection1){
			$as_where.=" and ".strtotime($sch_inspection1)."<=unix_timestamp(wr_3)";
		}
		if($sch_inspection2){
			$as_where.=" and unix_timestamp(wr_3)<=".strtotime($sch_inspection2);
		}
		//업무확인 검색
		if($sch_inspection1){
			$asSql=" select * from g5_write_as where 1 $as_where";

			$asResult=sql_query($asSql);
			$as_search= " and wr_id in (";
			for($i=0;$asRow=sql_fetch_array($asResult);$i++){
				$as_search.="'".$asRow[wr_1]."',";
			}
			$as_search = substr($as_search,0,strlen($as_search)-1);
			$as_search.=" )";
			$sql_search.= $as_search;
		}
		//기종검색
		if($sch_nt_model){
			$newSql="select * from g5_write_new_type where 1 and nt_model like '%$sch_nt_model%'";
			$newResult=sql_query($newSql);
			$new_search= " and wr_id in (";
			for($i=0;$newRow=sql_fetch_array($newResult);$i++){
				$new_search.="'".$newRow[nt_wr_id]."',";
			}
			$new_search = substr($new_search,0,strlen($new_search)-1);
			$new_search.=" )";
			$sql_search.= $new_search;
		}
	





		if($sch_wr_31 || $sch_wr_32){


			if($sch_wr_31 != ''){
				$sql_search .= " and unix_timestamp(next_check_date) >= '".strtotime($sch_wr_31)."'";
			}
			if($sch_wr_32 != ''){
				$sql_search .= " and unix_timestamp(next_check_date) <= '".strtotime($sch_wr_32)."'";
			}

			$check_sql = " select * from g5_write_as where $add_query ";

			/*$check_qry = sql_query($check_sql);
			$check_num = sql_num_rows($check_qry);
		
			if($check_num > 0){
				
				for($cn=0; $cn<$check_num; $cn++){

					$check_row = sql_fetch_array($check_qry);
					
					if($SEL){
						$SEL .= " or ";
					}
					$SEL .= " wr_id='$check_row[wr_1]' ";
				}
			}

		 $sql_search .= " and (".$SEL.")";*/
		// echo $sql_search;
		}

	}

	if($bo_table == 'sell'){
		if($sch_wr_2 != ''){
			$sql_search .= " and wr_2 = '{$sch_wr_2}'";
		}
		if($si != ''){
			$sql_search .= " and wr_4 like '{$si}%'";
		}
		if($gu != ''){
			$sql_search .= " and wr_4 like '%{$gu}%'";
		}
        if($sch_wr_subject != ''){
            $sql_search .= " and wr_subject like '%{$sch_wr_subject}%'";
        }
	}

    if($bo_table == 'date'){
        if($sch_wr_subject != ''){
            $sql_search .= " and wr_subject like '%{$sch_wr_subject}%'";
        }

        if($sch_nt_model != ''){
            $sql_search .= " and wr_2 like '%{$sch_nt_model}%'";
        }
    }

    //$total_count = $board['bo_count_write'];
	
	@include_once($board_skin_path.'/list_search.head.skin.php');

    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE (1) {$sql_search}";


    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
if (!$sca && !$stx) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    $from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {

if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if($board['bo_orderby']){
	$sst = "wr_orderby desc, " . $sst;
}

if ($sst) {
    $sql_order = " order by {$ob} {$sst} {$sod} ";
}

if($sch_wr_2 == '임대해지'){
    $sql_order = " order by wr_26 desc ";
}


if ($sca || $stx) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 {$sql_search}";
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);

    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

if($bo_table == 'new'){
	$geturl = '';
	if($sch_wr_subject) $geturl .= '&sch_wr_subject='.urlencode($sch_wr_subject);
	if($sch_wr_5) $geturl .= '&sch_wr_5='.urlencode($sch_wr_5);
	if($si) $geturl .= '&si='.urlencode($si);
	if($gu) $geturl .= '&gu='.urlencode($gu);
	if($sch_fdate1) $geturl .= '&sch_fdate1='.$sch_fdate1;
	if($sch_ldate1) $geturl .= '&sch_ldate1='.$sch_ldate1;
	if($sch_fdate2) $geturl .= '&sch_fdate2='.$sch_fdate2;
	if($sch_ldate2) $geturl .= '&sch_ldate2='.$sch_ldate2;
    if($sch_wr_17) $geturl .= '&sch_wr_17='.$sch_wr_17;



if($sch_wr_31) $geturl .= '&sch_wr_31='.$sch_wr_31;
if($sch_wr_32) $geturl .= '&sch_wr_32='.$sch_wr_32;
		$geturl.="&sch_nt_model=".$sch_nt_model;
	$geturl.="&sch_inspection1=".$sch_inspection1;
	$geturl.="&sch_inspection2=".$sch_inspection2;
	if($sch_wr_2 == '임대해지'){
		$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.$geturl.'&sch_wr_2='.urlencode($sch_wr_2).'&amp;page=');
	}else{
		$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.$geturl.'&amp;page=');
	}
}else{
	$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');
}
$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx) {
    $list_href = './board.php?bo_table='.$bo_table;

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$prev_spt.'&amp;page=1';
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$next_spt.'&amp;page=1';
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">다음검색</a>');
    }
}


$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = './write.php?bo_table='.$bo_table;
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = './rss.php?bo_table='.$bo_table;
}

$stx = get_text(stripslashes($stx));
include_once($board_skin_path.'/list.skin.php');
?>
