<?php
include_once('./_common.php');
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = ".date("Ymd")."reserv.xls" );   
header( "Content-Description: PHP4 Generated Data" ); 
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 
$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ($sfl like '%$stx%') ";
    $sql_search .= " ) ";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt from g5_write_b_reserv {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from g5_write_b_reserv {$sql_search} ";
$result = sql_query($sql);
$colspan="15";
?>
<table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
		<th scope="col">주차장명</th>
		<th scope="col">주차라인</th>
		<th scope="col">결제</th>
		<th scope="col">국내/국제</th>
		<th scope="col">예약자이름</th>
		<th scope="col">연락처</th>
		<th scope="col">차종</th>
		<th scope="col">차량번호</th>
		<th scope="col">입고예정시간</th>
		<th scope="col">출고예정시간</th>
		<th scope="col">총금액</th>
		<th scope="col">상태</th>
		<th scope="col">키보관여부</th>
		<th scope="col">확인전화</th>
		<th scope="col">등록/수정일</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
       
    ?>

    <tr class="<?php echo $bg; ?>">
       
		<td scope="col"><?=$row[wr_subject]?></td>
		<td scope="col" class="wr-9-select">
			<?php echo $row[wr_9];?>
		</td>
		<td scope="col">
			<?php echo $row[wr_10];?>
		</td>
		<td scope="col"><?=$row[wr_4]?></td>
		<td scope="col"><?=$row[wr_name]?></td>
		<td scope="col"><?=$row[wr_3]?></td>
		<td scope="col"><?=$row[wr_5]?></td>
		<td scope="col"><?=$row[wr_6]?></td>
		<td scope="col"><?=$row[wr_1]?></td>
		<td scope="col"><?=$row[wr_2]?></td>
		<td scope="col"><?=number_format($row[wr_8])?></td>
		<td scope="col">
			<?php echo $row[wr_11];?>
		</td>
		<td scope="col">
			<?php echo $row[wr_12];?>
		</td>
		<td scope="col">
			<?php echo $row[wr_13];?>
		</td>
		<td scope="col"><?=$row[wr_datetime]?></td>

        <!--<td>
            <?php if ($is_admin == 'super'){ ?>
                <?php echo get_group_select("gr_id[$i]", $row['gr_id']) ?>
            <?php }else{ ?>
                <input type="hidden" name="gr_id[<?php echo $i ?>]" value="<?php echo $row['gr_id'] ?>"><?php echo $row['gr_subject'] ?>
            <?php } ?>
        </td>
        <td>
            <input type="hidden" name="board_table[<?php echo $i ?>]" value="<?php echo $row['bo_table'] ?>">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row['bo_table'] ?>"><?php echo $row['bo_table'] ?></a>
        </td>
        <td>
            <label for="bo_skin_<?php echo $i; ?>" class="sound_only">스킨</label>
            <?php echo get_skin_select('board', 'bo_skin_'.$i, "bo_skin[$i]", $row['bo_skin']); ?>
        </td>
        <td>
            <label for="bo_mobile_skin_<?php echo $i; ?>" class="sound_only">모바일 스킨</label>
            <?php echo get_mobile_skin_select('board', 'bo_mobile_skin_'.$i, "bo_mobile_skin[$i]", $row['bo_mobile_skin']); ?>
        </td>
        <td>
            <label for="bo_subject_<?php echo $i; ?>" class="sound_only">게시판 제목<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="bo_subject[<?php echo $i ?>]" value="<?php echo get_text($row['bo_subject']) ?>" id="bo_subject_<?php echo $i ?>" required class="required frm_input bo_subject full_input" size="10">
        </td>
        <td class="td_numsmall">
            <label for="bo_read_point_<?php echo $i; ?>" class="sound_only">읽기 포인트</label>
            <input type="text" name="bo_read_point[<?php echo $i ?>]" value="<?php echo $row['bo_read_point'] ?>" id="bo_read_point_<?php echo $i; ?>" class="frm_input" size="2">
        </td>
        <td class="td_numsmall">
            <label for="bo_write_point_<?php echo $i; ?>" class="sound_only">쓰기 포인트</label>
            <input type="text" name="bo_write_point[<?php echo $i ?>]" value="<?php echo $row['bo_write_point'] ?>" id="bo_write_point_<?php echo $i; ?>" class="frm_input" size="2">
        </td>
        <td class="td_numsmall">
            <label for="bo_comment_point_<?php echo $i; ?>" class="sound_only">댓글 포인트</label>
            <input type="text" name="bo_comment_point[<?php echo $i ?>]" value="<?php echo $row['bo_comment_point'] ?>" id="bo_comment_point_<?php echo $i; ?>" class="frm_input" size="2">
        </td>
        <td class="td_numsmall">
            <label for="bo_download_point_<?php echo $i; ?>" class="sound_only">다운 포인트</label>
            <input type="text" name="bo_download_point[<?php echo $i ?>]" value="<?php echo $row['bo_download_point'] ?>" id="bo_download_point_<?php echo $i; ?>" class="frm_input" size="2">
        </td>
        <td class="td_chk">
            <label for="bo_use_sns_<?php echo $i; ?>" class="sound_only">SNS 사용</label>
            <input type="checkbox" name="bo_use_sns[<?php echo $i ?>]" value="1" id="bo_use_sns_<?php echo $i ?>" <?php echo $row['bo_use_sns']?"checked":"" ?>>
        </td>
        <td class="td_chk">
            <label for="bo_use_search_<?php echo $i; ?>" class="sound_only">검색 사용</label>
            <input type="checkbox" name="bo_use_search[<?php echo $i ?>]" value="1" id="bo_use_search_<?php echo $i ?>" <?php echo $row['bo_use_search']?"checked":"" ?>>
        </td>
        <td class="td_chk">
            <label for="bo_order_<?php echo $i; ?>" class="sound_only">출력 순서</label>
            <input type="text" name="bo_order[<?php echo $i ?>]" value="<?php echo $row['bo_order'] ?>" id="bo_order_<?php echo $i ?>" class="frm_input" size="2">
        </td>
        <td class="td_mngsmall">
            <label for="bo_device_<?php echo $i; ?>" class="sound_only">접속기기</label>
            <select name="bo_device[<?php echo $i ?>]" id="bo_device_<?php echo $i ?>">
                <option value="both"<?php echo get_selected($row['bo_device'], 'both', true); ?>>모두</option>
                <option value="pc"<?php echo get_selected($row['bo_device'], 'pc'); ?>>PC</option>
                <option value="mobile"<?php echo get_selected($row['bo_device'], 'mobile'); ?>>모바일</option>
            </select>
        </td>
        <td class="td_mngsmall">
            <?php echo $one_update ?>
            <?php echo $one_copy ?>
        </td>-->
    </tr>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>