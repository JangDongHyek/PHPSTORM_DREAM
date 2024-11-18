<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

if($sch_wr_2 == '임대해지'){
	$where_url = '&sch_wr_2='.urlencode($sch_wr_2);
}
?>

<?php
function type_list($t_row){
	global $list_arr;

	if($t_row){

		$datas = '';
		$datas .= '<tr class="nt_tr1"><td class="b_tb_td x110" rowspan="2">'.$t_row['nt_date'].'</td>';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_list'].'</td>';
		if($t_row['nt_list'] == '컬러복사기'){
			$datas .= '<td class="b_tb_td">흑백 : '.$t_row['nt_page1'];
			$datas .= '&nbsp;&nbsp;&nbsp;&nbsp;컬러 : '.$t_row['nt_page1_2'].'</td>';
		}else{
			$datas .= '<td class="b_tb_td">'.$t_row['nt_page1'].'</td>';
		}
		$datas .= '<td class="b_tb_td">'.$t_row['nt_install'].'</td>';
		$datas .= '</tr><tr class="nt_tr2">';
		$datas .= '<td class="b_tb_td">'.$t_row['nt_model'].'</td>';
		if($t_row['nt_list'] == '컬러복사기'){
			$datas .= '<td class="b_tb_td">흑백 : '.$t_row['nt_page2'];
			$datas .= '&nbsp;&nbsp;&nbsp;&nbsp;컬러 : '.$t_row['nt_page2_2'].'</td>';
		}else{
			$datas .= '<td class="b_tb_td">'.$t_row['nt_page2'].'</td>';
		}
		$datas .= '<td class="b_tb_td talign_l">';
		if($t_row['nt_file'] != ''){
			$datas .= '<a href="'.G5_BBS_URL.'/download_new.php?nt_file='.$t_row['nt_file'].'">'.urldecode($t_row['nt_file']).'</a>';
		}
		$datas .= '</td></tr>';

		return $datas;
	}
}
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<article id="bo_v" style="width:<?php echo $width; ?>">
	
	<!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
        ?>
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?><?php echo $where_url ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?><?php echo $where_url ?>" class="btn_b01" onclick="del_new(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?><?php echo $where_url ?>" class="btn_b01">목록</a></li>
            <?php if ($write_href && $sch_wr_2 != '임대해지') { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->
	
	<div class="tbl_wrap">
        <table class="b_tbl">
		<tbody>
		<tr>
			<th class="b_th">계약일자</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_1'] ?></td>
		</tr>
		<tr>
			<th class="b_th">계약기간</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_18'] ?>년</td>
		</tr>
		<tr>
			<th class="b_th">고객분류</th>
			<td class="b_td" colspan="3">
				<?php echo $view['wr_2'] ?>
				<?php
				if($view['wr_2'] == '임대해지' && $view['wr_26'] != ''){
					echo '<span style="padding-left:10px;">[해지일자 : '.$view['wr_26'].']</span>';
				}
				?>
			</td>
		</tr>
		<tr>
			<th class="b_th">업체명</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_subject'] ?></td>
		</tr>
		<tr>
			<th class="b_th xp15">대표자</th>
			<td class="b_td xp35"><?php echo $view['wr_3'] ?></td>
			<th class="b_th xp15">대표자 H.P</th>
			<td class="b_td xp35"><?php echo $view['wr_4'] ?></td>
		</tr>
		<tr>
			<th class="b_th">담당자</th>
			<td class="b_td"><?php echo $view['wr_5'] ?></td>
			<th class="b_th">담당자 H.P</th>
			<td class="b_td"><?php echo $view['wr_6'] ?></td>
		</tr>
		<tr>
			<th class="b_th">Tel</th>
			<td class="b_td"><?php echo $view['wr_7'] ?></td>
			<th class="b_th">Fax</th>
			<td class="b_td"><?php echo $view['wr_8'] ?></td>
		</tr>
		<tr>
			<th class="b_th">주소</th>
			<td class="b_td" colspan="3">
				<?php if($view['wr_9'] != '') echo '['.$view['wr_9'].'] '; ?>
				<?php if($view['wr_10'] != '') echo $view['wr_10'].' ' ?>
				<?php if($view['wr_11'] != '') echo $view['wr_11'].' ' ?>
				<?php if($view['wr_12'] != '') echo '<br>'.$view['wr_12'].' ' ?>
			</td>
		</tr>
		<tr>
			<th class="b_th">임대기종</th>
			<td class="b_td" colspan="3">
			
<table class="b_tbl2">
<thead>
<tr>
	<th class="b_th_th" rowspan="2">설치일자</th>
	<th class="b_th_th x200">분류선택</th>
	<th class="b_th_th x200">기본장수</th>
	<th class="b_th_th">설치위치</th>
</tr>
<tr>
	<th class="b_th_th">모델</th>
	<th class="b_th_th x100">시작장수</th>
	<th class="b_th_th">첨부파일</th>
</tr>
</thead>
<tbody id="nt_tbody">
<?php
$t_sql = " select * from g5_write_new_type where nt_wr_id='{$wr_id}' order by nt_idx asc ";
$t_qry = sql_query($t_sql);
$t_num = sql_num_rows($t_qry);
if($t_num > 0){
	for($b=0; $b<$t_num; $b++){
		$t_row = sql_fetch_array($t_qry);
		echo type_list($t_row);
	}
}else{
?>
<tr>
	<td colspan="5" class="talign_c">등록된 임대기종이 없습니다.</td>
</tr>
<?php
}
?>
</tbody>
</table>


			</td>
		</tr>
		<tr>
			<th class="b_th">보증금</th>
			<td class="b_td" colspan="3"><?php if($view['wr_19'] != '') echo number_format($view['wr_19']).'원' ?></td>
		</tr>
		<tr>
			<th class="b_th">임대금액</th>
			<td class="b_td">
				<?php if($view['wr_13'] != '') echo number_format($view['wr_13']).'원' ?>
				<?php
				if($view['wr_21'] != '') echo '&nbsp;&nbsp;['.$view['wr_21'].']';
				?>
			</td>
			<th class="b_th">출금일자</th>
			<td class="b_td"><?php if($view['wr_14'] != '') echo $view['wr_14'].'일'; ?></td>
		</tr>
		<tr>
			<th class="b_th">임대금액 결제방식</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_15'] ?></td>
		</tr>
		<tr>
			<th class="b_th">VAT</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_20'] ?></td>
		</tr>
		<tr>
			<th class="b_th">정기점검세팅</th>
			<td class="b_td" colspan="3"><?php echo $view['wr_16'] ?></td>
		</tr>
		<tr>
			<th class="b_th">비고</th>
			<td class="b_td" colspan="3"><?php echo get_view_thumbnail($view['content']); ?></td>
		</tr>
		<tr>
			<th class="b_th">사업자등록증</th>
			<td class="b_td" colspan="3">
				<ul style="margin:0; padding:0 0;">
				<?php
				// 가변 파일
				for ($i=0; $i<1; $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
				?>
					<li>
						<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
							<img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
							<strong><?php echo $view['file'][$i]['source'] ?></strong>
						</a>
					</li>
				<?php
					}
				}
				?>
				</ul>
			</td>
		</tr>
		<tr>
			<th class="b_th">계약서</th>
			<td class="b_td" colspan="3">
				<ul style="margin:0; padding:0 0;">
				<?php
				// 가변 파일
				for ($i=1; $i<2; $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
				?>
					<li>
						<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
							<img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
							<strong><?php echo $view['file'][$i]['source'] ?></strong>
						</a>
					</li>
				<?php
					}
				}
				?>
				</ul>
			</td>
		</tr>
		<tr>
			<th class="b_th">CMS</th>
			<td class="b_td" colspan="3">
				<ul style="margin:0; padding:0 0;">
				<?php
				// 가변 파일
				for ($i=2; $i<3; $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
				?>
					<li>
						<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
							<img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
							<strong><?php echo $view['file'][$i]['source'] ?></strong>
						</a>
					</li>
				<?php
					}
				}
				?>
				</ul>
			</td>
		</tr>
		<tr>
			<th class="b_th">수금사항</th>
			<td class="b_td" colspan="3">
				<?php echo $view['wr_17'] ?>
				<?php
				if($view['wr_17'] == '수금'){
					if($view['wr_22'] != ''){
						echo '<span style="padding-left:15px; font-weight:bold;">수금일자 :&nbsp;&nbsp;</span>';
						echo $view['wr_22'];
					}
					if($view['wr_23'] != ''){
						echo '<span style="padding-left:15px; font-weight:bold;">수금방법 :&nbsp;&nbsp;</span>';
						echo $view['wr_23'];
					}
				}

				if($view['wr_17'] == '미수'){
					if($view['wr_24'] != ''){
						echo '<span style="padding-left:15px; font-weight:bold;">미수금액 :&nbsp;&nbsp;</span>';
						echo number_format($view['wr_24']).'원';
					}
					if($view['wr_25'] != ''){
						echo '<span style="padding-left:15px; font-weight:bold;">미수금된 개월수 :&nbsp;&nbsp;</span>';
						echo $view['wr_25'].'개월';
					}
				}
				?>
				<?php if($view['wr_17_text'] != ''){ ?>
				<div id="wr_17_text" style="display:block;"><?php echo nl2br($view['wr_17_text']) ?></div>
				<?php } ?>
			</td>
		</tr>
		</tbody>
		</table>

		<?php
		$rows = 5;	// 한 페이지당 추출될 라인수
		$from_record4 = ($page4 - 1) * $rows4; // 시작 열을 구함
		?>

		<div class="title_container">
			<h3 class="view_title">정기점검 및 A/S</h3>
			<?php if($sch_wr_2 != '임대해지'){ ?>
			<a class="btn_b02" style="position:absolute; top:19px; right:0;" href="<?php echo G5_BBS_URL ?>/write.php?bo_table=as&p_wr_id=<?php echo $view['wr_id'] ?>">정기점검 및 A/S 등록하기</a>
			<?php } ?>
		</div>
		<?php
		$as_where="";
		if($sch_inspection1){
			$as_where.=" and ".strtotime($sch_inspection1)."<=unix_timestamp(wr_3) ";
		}
		if($sch_inspection2){
			$as_where.=" and unix_timestamp(wr_3)<=".strtotime($sch_inspection2);
		}
		$as_sql = " select count(*) as cnt from g5_write_as where wr_1='{$wr_id}' $as_where";
		$as_row = sql_fetch($as_sql);
		$total_count_as = $as_row['cnt'];
		$total_page_as = ceil($total_count_as / $rows);  // 전체 페이지 계산
		if ($page_as < 1) $page_as = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
		$from_record_as = ($page_as - 1) * $rows; // 시작 열을 구함
		?>
		<div class="l_tbl">
			<table>
			<thead>
			<tr>
				<th class="l_th_top" colspan="9"></th>
			</tr>
			<tr>
				<th class="l_th_th x80">구분</th>
				<th class="l_th_th x100">점검일자</th>
				<th class="l_th_th x80">점검위치</th>
				<th class="l_th_th x80">출력장수</th>
				<th class="l_th_th x80">기기교체</th>
				<th class="l_th_th x100">첨부파일</th>
				<th class="l_th_th">A/S 요청사항</th>
				<th class="l_th_th">담당A/S기사</th>
				<th class="l_th_th x80">상세정보</th>
			</tr>
			</thead>
			<tbody>
			<?php
			

			$as_sql = " select * from g5_write_as where wr_1='{$wr_id}' $as_where order by wr_3 desc, wr_id desc limit {$from_record_as}, {$rows} ";
			$as_qry = sql_query($as_sql);
			$as_num = sql_num_rows($as_qry);
			if($as_num > 0){
				$as_list = array();
				for($i=0; $i<$as_num; $i++){
					$as_row = sql_fetch_array($as_qry);

					$as_board = sql_fetch(" select * from {$g5['board_table']} where bo_table = 'as' ");
					$as_list[$i] = get_list($as_row, $as_board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
					if (strstr($sfl, 'subject')) {
						$as_list[$i]['subject'] = search_font($stx, $as_list[$i]['subject']);
					}
					$as_list[$i]['is_notice'] = false;
			?>
			<tr>
				<td class="l_tb_td talign_c"><?php echo $as_list[$i]['wr_2'] ?></td>
				<td class="l_tb_td talign_c"><?php echo $as_list[$i]['wr_3'] ?></td>
				<td class="l_tb_td talign_c"><?php echo $as_list[$i]['wr_4'] ?></td>
				<td class="l_tb_td talign_r"><?php echo $as_list[$i]['wr_8'] ?></td>
				<td class="l_tb_td talign_c"><?php echo $as_list[$i]['wr_9'] ?></td>
				<td class="l_tb_td talign_c">
					<?php
					$asf_sql = " select * from $g5[board_file_table] where bo_table = 'as' and wr_id = '".$as_list[$i]['wr_id']."' order by bf_no ";
					$asf_result = sql_query($asf_sql);
					$down_link = '';
					while ($asf_row = sql_fetch_array($asf_result))
					{
						$down_link = "download.php?bo_table=as&wr_id={$as_list[$i]['wr_id']}&no={$asf_row['bf_no']}";
						$file_source = addslashes($asf_row['bf_source']);
						$file_type = preg_replace('/^.*\.([^.]+)$/D', '$1', $file_source);
						echo '<a href="'.G5_BBS_URL.'/'.$down_link.'">[다운로드]</a>';
					}
					?>
				</td>
				<td class="l_tb_td talign_c">
					<?php
					if($as_list[$i]['wr_5'] != '' && $as_list[$i]['wr_6'] != ''){
						// A/S 요청사항 & 처리사항에 글이 있으면 처리완료
						echo '<span style="color:#0000ff;">처리완료</span>';
					}else if($as_list[$i]['wr_5'] != ''){
						// A/S 요청사항에 글이 있으면 있음
						echo '<span style="color:#ff0000;">있음</span>';
					}else if($as_list[$i]['wr_5'] == ''){
						// A/S 요청사항에 글이 없으면 없음
						echo '<span>없음</span>';
					}
					?>
				</td>
				<td class="l_tb_td talign_c"><?php echo $as_list[$i]['wr_11'] ?></td>
				<td class="l_tb_td talign_c">
					<a class="go_view_btn" style="color:#fff;" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=as&wr_id=<?php echo $as_list[$i]['wr_id'] ?>">상세정보</a>
				</td>
			</tr>
			<?php
				}
			}else{
			?>
			<tr>
				<td class="l_tb_td talign_c" colspan="8">등록된 게시물이 없습니다.</td>
			</tr>
			<?php
			}
			?>
			</tbody>
			</table>
			<?php
			echo get_paging_as(G5_IS_MOBILE ? 5 : 10, $page_as, $total_page_as, 'board.php?bo_table='.$bo_table.'&wr_id='.$wr_id."&sch_inspection1=".$sch_inspection1."&sch_inspection2=".$sch_inspection2);
			?>
		</div>

    </div>

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

function del_new(href){
	if(confirm('신규고객을 삭제하시면 신규고객에 연동되는 임대기종, 정기정검 및 A/S, 기기교체 등을 복구할 수 없습니다.\n정말 삭제하시겠습니까?')){
		location.href = href;
	}
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>
<!-- } 게시글 읽기 끝 -->