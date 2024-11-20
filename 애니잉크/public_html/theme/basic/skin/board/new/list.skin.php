<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$where_url="";
if($sch_wr_2 == '임대해지'){
	$where_url .= '&sch_wr_2='.urlencode($sch_wr_2);
}
if($sch_inspection1){
	$where_url .= '&sch_inspection1='.urlencode($sch_inspection1);
}
if($sch_inspection2){
	$where_url .= '&sch_inspection2='.urlencode($sch_inspection2);
}
$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo $board_skin_url ?>/jquery-ui.js"></script>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

	<!-- 게시물 검색 시작 { -->
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>
			
			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<?php if($sch_wr_2 == '임대해지'){ ?>
				<input type="hidden" name="sch_wr_2" value="<?php echo $sch_wr_2 ?>">
				<?php } ?>
				<div class="shop_search" width="100%" style="padding-top:8px;">
					<table class="list_search_tbl">
					<tbody>
                    <?php if($sch_wr_2 != '임대해지'){ ?>

                    <tr>
						<th class="list_search_th" style="">업체명</th>
						<td class="list_search_td talign_l x210">
							<input type="text" name="sch_wr_subject" class="frm_input x150" id="sch_wr_subject" value="<?php echo $sch_wr_subject ?>">
						</td>
						<th class="list_search_th">담당자</th>
						<td class="list_search_td talign_l">
							<input type="text" name="sch_wr_5" class="frm_input x130" id="sch_wr_5" value="<?php echo $sch_wr_5 ?>">
						</td>
						<th class="list_search_th">지역(시/도)</th>
						<td class="list_search_td talign_l x120">
							<select name="si" id="si" class="sch_sel">
								<option value="">시/도(전체)</option>
								<?php for($i=0; $i<count($si_arr); $i++){ ?>
								<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
								<?php } ?>
							</select>
						</td>
						<th class="list_search_th">지역(구/군)</th>
						<td class="list_search_td talign_l x130" style="border-radius:0px 7px 0px 0px;">
							<select name="gu" id="gu" class="sch_sel">
								<option value="" >구/군(전체)</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="list_search_th" style="border-radius:0px 0px 0px 0px;">계약일자</th>
						<td class="list_search_td talign_l x210">
							<input type="text" name="sch_fdate1" class="frm_input x80" id="sch_fdate1" value="<?php echo $sch_fdate1 ?>"> ~ 
							<input type="text" name="sch_ldate1" class="frm_input x80" id="sch_ldate1" value="<?php echo $sch_ldate1 ?>">
						</td>
						<th class="list_search_th">다음점검일자</th>
						<td class="list_search_td talign_l">
							<input type="text" name="sch_fdate2" class="frm_input x80" id="sch_fdate2" value="<?php echo $sch_fdate2 ?>"> ~ 
							<input type="text" name="sch_ldate2" class="frm_input x80" id="sch_ldate2" value="<?php echo $sch_ldate2 ?>">
						</td>
						<th class="list_search_th">Tel</th>
						<td class="list_search_td talign_l x120">
							<input type="text" name="sch_wr_7" class="frm_input x110" id="sch_wr_7" value="<?php echo $sch_wr_7 ?>">
						</td>
						<th class="list_search_th">임대기종</th>
						<td class="list_search_td talign_l x120">
							<input type="text" name="sch_nt_model" class="frm_input x110" id="sch_nt_model" value="<?php echo $sch_nt_model ?>">
						</td>
					</tr>
					<tr>
						<th class="list_search_th" style="border-radius:0px 0px 0px 7px;">정기점검일자</th>
						<td class="list_search_td talign_l x210">
							<input type="text" name="sch_wr_31" class="frm_input x80" id="sch_wr_31" value="<?php echo $sch_wr_31 ?>" autocomplete='off'> ~ 
							<input type="text" name="sch_wr_32" class="frm_input x80" id="sch_wr_32" value="<?php echo $sch_wr_32 ?>" autocomplete='off'>
						</td>
						<th class="list_search_th" style="border-radius:0px 0px 0px 7px;">업무확인</th>
						<td class="list_search_td talign_l x210">
							<input type="text" name="sch_inspection1" class="frm_input x80" id="sch_inspection1" value="<?php echo $sch_inspection1 ?>"> ~ 
							<input type="text" name="sch_inspection2" class="frm_input x80" id="sch_inspection2" value="<?php echo $sch_inspection2 ?>">
						</td>
                        <th class="list_search_th" style="border-radius:0px 0px 0px 7px;">정기점검미체크확인</th>
                        <td class="list_search_td talign_l x210">
                            <select name="check_date">
                                <option value="">선택해주세요</option>
                                <? for ($i = 1; $i < 37; $i++) { ?>
                                <option value="<?=$i?>"><?=$i?>개월</option>
                                <? } ?>
                            </select>
                        </td>
                        <th class="list_search_th" style="border-radius:0px 0px 0px 7px;">미수금업체</th>
                        <td class="list_search_td talign_l x210">
                            <input type="checkbox" name="sch_wr_17" value="미수" <?if($sch_wr_17 == '미수') echo 'checked';?> >
                        </td>

					</tr>
                    <tr>
                        <td class="list_search_td talign_c x130" style="border-radius:0px 0px 7px 0px;" colspan="8">
                            <input type="submit" value="검색" class="search_btn">
                        </td>
                    </tr>
					</tbody>
                    <?php }else { ?>
                        <tr>
                            <th class="list_search_th" style="">업체명</th>
                            <td class="list_search_td talign_l x210" colspan="4">
                                <input type="text" name="sch_wr_subject" class="frm_input x150" id="sch_wr_subject" value="<?php echo $sch_wr_subject ?>">
                            </td>

                            <td class="list_search_td talign_c x130" style="border-radius:0px 0px 7px 0px;" colspan="4">
                                <input type="submit" value="검색" class="search_btn">
                            </td>
                        </tr>
                        <?}?>
                    </table>
				</div>
			</form>
	</fieldset>
	<!-- 게시물 검색 끝 } -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
		<?php if($is_admin){ ?>
        <div id="bo_list_total">
			<!--
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
			-->
			<?php if($is_admin && $sch_wr_2 != '임대해지'){ ?>
			<label style="padding-right:12px;">관리업체수 : <?php echo number_format($total_count) ?></label>
			<?php
			$where_str2 = "";
			if($sch_wr_subject != ''){
				$where_str2 .= " and n.wr_subject like '%{$sch_wr_subject}%'";
			}
			if($sch_wr_5 != ''){
				$where_str2 .= " and n.wr_5 like '%{$sch_wr_5}%'";
			}
			if($si != ''){
				$where_str2 .= " and n.wr_10 like '{$si}%'";
			}
			if($gu != ''){
				$where_str2 .= " and n.wr_10 like '{$gu}%'";
			}
			if($sch_wr_7 != ''){
				$where_str2 .= " and n.wr_7 like '%{$sch_wr_7}%'";
			}
			if($sch_fdate1 != ''){
				$where_str2 .= " and n.wr_1 >= '{$sch_fdate1}'";
			}
			if($sch_ldate1 != ''){
				$where_str2 .= " and n.wr_1 <= '{$sch_ldate1}'";
			}
			if($sch_fdate2 != ''){
				$where_str2 .= " and n.next_check_date >= '".str_replace('-','',$sch_fdate2)."'";
			}
			if($sch_ldate2 != ''){
				$where_str2 .= " and n.next_check_date <= '".str_replace('-','',$sch_ldate2)."'";
			}

			// 총임대댓수
			$tot1_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id {$where_str2} ";
			$tot1_row = sql_fetch($tot1_sql);
			?>
			<label style="padding-right:12px;">총임대댓수 : <?php echo number_format($tot1_row['cnt']) ?></label>
			<?php
			// 복사기임대대수
			$tot2_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='흑백복사기' or nt.nt_list='컬러복사기') {$where_str2} ";
			$tot2_row = sql_fetch($tot2_sql);
			?>
			<label style="padding-right:12px;">복사기임대수 : <?php echo number_format($tot2_row['cnt']) ?></label>
			<?php
			// 잉크젯임대수
			$tot3_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='잉크젯복합기' or nt.nt_list='잉크젯프린터') {$where_str2} ";
			$tot3_row = sql_fetch($tot3_sql);
			?>
			<label style="padding-right:12px;">잉크젯임대수 : <?php echo number_format($tot3_row['cnt']) ?></label>
			<?php
			// 레이져임대수
			$tot4_sql = " select count(distinct(nt.nt_idx)) as cnt from g5_write_new_type as nt, g5_write_new as n where n.wr_2='임대' and nt.nt_wr_id=n.wr_id and (nt.nt_list='레이져복합기' or nt.nt_list='레이져프린터' or nt.nt_list='흑백레이져프린터' or nt.nt_list='컬러레이져프린터' or nt.nt_list='컬러레이져복합기' or nt.nt_list='흑백레이져복합기') {$where_str2} ";
			$tot4_row = sql_fetch($tot4_sql);
			?>
			<label style="padding-right:12px;">레이져임대수 : <?php echo number_format($tot4_row['cnt']) ?></label>
			<?php } ?>
        </div>
		<?php } ?>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if($sch_wr_2 != '임대해지'){ ?>
			<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
			<?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
	<?php if($sch_wr_2 == '임대해지'){ ?>
	<input type="hidden" name="sch_wr_2" value="<?php echo $sch_wr_2 ?>">
	<?php } ?>

	<div style="padding:5px 0 15px 0;">

		<table class="l_tbl">
		<thead>
		<tr>
			<th class="l_th_top" colspan="10"></th>
		</tr>
		<tr>
			<?php if ($is_checkbox) { ?>
			<th class="l_th_th x30">
				<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
			</th>
			<?php } ?>
			<th class="l_th_th x60">고객분류</th>
			<th class="l_th_th">업체명</th>
			<th class="l_th_th x130">임대기종</th>
			<th class="l_th_th x90">TEL</th>
			<th class="l_th_th x80">계약일자</th>
<?if($sch_wr_2 == '임대해지'){?>
			<th class="l_th_th x80">해지일자</th>
<?}else{?>
			<th class="l_th_th x80">최근점검일자</th>
			<th class="l_th_th x80">다음점검일자</th>
<?}?>
			<th class="l_th_th x150">수금사항</th>
			<th class="l_th_th x75">상세정보</th>
		</tr>
		</thead>
		<tbody>
		<?php
        for ($i=0; $i<count($list); $i++) {
        ?>
		<tr>
			<?php if ($is_checkbox) { ?>
			<td class="l_tb_td talign_c">
				<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</td>
			<?php } ?>
			<td class="l_tb_td talign_c"><?php echo $list[$i]['wr_2'] ?></td>
			<td class="l_tb_td"><?php echo $list[$i]['wr_subject'] ?></td>
			<td class="l_tb_td talign_c">
				<?php
				$t_sql = " select * from g5_write_new_type where nt_wr_id='{$list[$i]['wr_id']}' order by nt_idx asc limit 0,2 ";
				$t_qry = sql_query($t_sql);
				$t_num = sql_num_rows($t_qry);
				for($u=0; $u<$t_num; $u++){
					$t_row = sql_fetch_array($t_qry);
					echo '<div>'.$t_row['nt_model'].'</div>';
				}
				?>
			</td>
			<td class="l_tb_td talign_c"><?php echo $list[$i]['wr_7'] ?></td>

			<td class="l_tb_td talign_c"><?php echo $list[$i]['wr_1'] ?></td>
			
<?if($sch_wr_2 == '임대해지'){?>
			<td class="l_tb_td talign_c"><?php echo $list[$i]['wr_26'] ?></td>

<?}else{?>
			<td class="l_tb_td talign_c"><?php echo $list[$i]['latest_check_date'] ?></td>

			<td class="l_tb_td talign_c"><?php echo $list[$i]['next_check_date'] ?></td>
<?}?>


			<td class="l_tb_td talign_c">
				<?php
				if($list[$i]['wr_17'] == '수금'){
					echo '없음';
				}else if($list[$i]['wr_17'] == '미수'){
					echo '미수금 : '.number_format($list[$i]['wr_24']).'원'." ({$list[$i]['wr_25']}개월)";
				}
				?>
			</td>
			<td class="l_tb_td talign_c">
				<a class="go_view_btn" style="color:#fff;" href="<?php echo $list[$i]['href'] ?><?php echo $where_url ?>">상세정보</a>
			</td>
		</tr>
		<?php
		}
		?>
		<?php if (count($list) == 0) { echo '<tr><td colspan="10" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
		</tbody>
		</table>

	</div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
			<?php if($sch_wr_2 != '임대해지'){ ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
			<?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>

<script>
function getCity(si, gu){
	if(!si && !gu){
		return false;
	}

	var opt;
	var opt_select;

	$.ajax({
		type:"GET",
		url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType: "json",
		data: {
			"si": si,
			"gu": gu
		},
		success:function(datas){
			for(var i=0; i<datas.length; i++){
				if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
					opt_select = "selected";
				else 
					opt_select = "";

				opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";
				if(!gu){
					$("#gu").append(opt);
				}else{
					$("#dong").append(opt);
				}
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

$(document).ready(function (){
	getCity("<?php echo $si?>");
});

$("#si").change(function (){
	$("#gu").find("option").remove();
	$("#gu").append("<option value=''>구/군(전체)</option>");
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity($(this).val(), "")
});



function datepicker_act(){
	$("#sch_fdate1,#sch_ldate1,#sch_fdate2,#sch_ldate2,#sch_wr_31,#sch_wr_32,#sch_inspection1,#sch_inspection2").datepicker({	// UI 달력을 사용할 Class / Id 를 콤마(,) 로 나누어서 다중으로 가능
		buttonText: "Select date",
		dateFormat: "yy-mm-dd",	// Form에 입력될 Date Type
		prevText: '이전 달',	// ◀ 에 마우스 오버하면 나타나는 타이틀
		nextText: '다음 달',	// ▶ 에 마우스 오버하면 나타나는 타이틀
		changeMonth: true,	// 월 SelectBox 형식으로 선택변경 유무
		changeYear: true,	// 년 SelectBox 형식으로 선택변경 유무
		showMonthAfterYear: true,	// 년도 다음에 월이 나타나게 할지 여부 ( true : 년 월 , false : 월 년 )
		showButtonPanel: true,	// UI 하단에 버튼 사용 유무
		monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],	// 요일에 마우스 오버하면 나타나는 타이틀
		dayNamesMin: ['일','월','화','수','목','금','토'],	// 요일 텍스트 값
		duration: 'fast', // 달력 나타나는 속도 ( Slow , Normal , Fast )
		showAnim: 'slideDown'
	});
}

$(function(){
	datepicker_act();
});
</script>
<!-- } 게시판 목록 끝 -->