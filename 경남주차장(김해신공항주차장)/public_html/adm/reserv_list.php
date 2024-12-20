<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ($sfl like '%$stx%') ";
    $sql_search .= " ) ";
}else{
	if($s_wr_11=="예약신청"){
		$today=date("Y-m-d",strtotime(date("Y-m-d")." -1 day"));
		$sql_search .= " and wr_1 like '%$today%'";
		
	}else if($s_wr_11=="주차중"){
		$today=strtotime(date("Y-m-d"));
		$sql_search .= " and ('$today' <= unix_timestamp(wr_2))";
	}else if($s_wr_11=="출차완료"){
		$today=strtotime(date("Y-m-d"));
		$sql_search .= " and (unix_timestamp(wr_2) <= '$today')";
	}else if($s_wr_11==""||$s_wr_11=="예약취소"){
	}else{
		$today=strtotime(date("Y-m-d"));
		$sql_search .= " and ('$today' <= unix_timestamp(wr_1))";
	}
}
if($stx2){
	$sql_search.=" and ($sfl2 like '%$stx2%')";
}
if($s_wr_11){
	$s_wr_11Arr=explode("|",$s_wr_11);
	if(0<count($s_wr_11Arr)){
		$sql_search.=" and wr_11 in (";
		for($i=0;$i<count($s_wr_11Arr);$i++){
			$sql_search.="'{$s_wr_11Arr[$i]}',";
		}
		$sql_search.="'')";
	}else{
		$sql_search.=" and wr_11='$s_wr_11'";
	}
}
if($ss_wr_subject){
	$sql_search.=" and wr_subject = '$ss_wr_subject'";
}

$sod="desc";
if(!$sst2){
	$sst2="wr_datetime";	
}

$sql_order = " order by $sst2 $sod ";

$sql = " select count(*) as cnt from g5_write_b_reserv {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
//정렬 필드 변경
if($s_wr_11=="주차중"){
	$sort="wr_2";
}else{
	$sort="wr_1";
}

$sql = " select * from g5_write_b_reserv {$sql_search} order by $sort asc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '실시간예약관리';
include_once('./admin.head.php');
$wr_9Arr=array("유카~유카","유카~유카 C","명성~1","명성~2","명성~3","명성~4","명성~5","B~1","C~1","마당~1","D~1","E~E","A~1","A~2","없음");
$wr_11Arr=array("주차중","출차완료","예약신청","예약취소","예약완료");
$colspan = 17;
?>
<link rel="stylesheet" href="<?=G5_CSS_URL?>/datepicker.css"/>

<style>
	.wr-9-select select option:first-child{
		color:black;
	}
	.wr-9-select select option{
		color:blue;
	}
	.wr-9-select select option:last-child{
		color:red;
	}
</style>

<!--주차장 탭메뉴-->
<div id="cate">
		<dl>
				
            <dd>
				<a href="?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&sst2=<?=$sst2?>&s_wr_11=<?=$s_wr_11?>&sfl2=<?=$sfl2?>&stx2=<?=$stx2?>" class="<?php echo !$ss_wr_subject?"on":"";?>">전체</a> 
			</dd>    
            <dd><a href="?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&sst2=<?=$sst2?>&s_wr_11=<?=$s_wr_11?>&sfl2=<?=$sfl2?>&stx2=<?=$stx2?>&ss_wr_subject=명성주차장" class="<?php echo $ss_wr_subject=="명성주차장"?"on":"";?>">명성주차장</a> </dd> 
            <dd><a href="?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&sst2=<?=$sst2?>&s_wr_11=<?=$s_wr_11?>&sfl2=<?=$sfl2?>&stx2=<?=$stx2?>&ss_wr_subject=유니티주차장" class="<?php echo $ss_wr_subject=="유니티주차장"?"on":"";?>">유니티주차장</a> </dd> 
            <dd><a href="?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&sst2=<?=$sst2?>&s_wr_11=<?=$s_wr_11?>&sfl2=<?=$sfl2?>&stx2=<?=$stx2?>&ss_wr_subject=유카주차장" class="<?php echo $ss_wr_subject=="유카주차장"?"on":"";?>">유카주차장</a> </dd> 
            <dd><a href="?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&sst2=<?=$sst2?>&s_wr_11=<?=$s_wr_11?>&sfl2=<?=$sfl2?>&stx2=<?=$stx2?>&ss_wr_subject=신공항주차장" class="<?php echo $ss_wr_subject=="신공항주차장"?"on":"";?>">신공항주차장</a> </dd>   
		</dl>
</div>
<!--//주차장 탭메뉴-->

<!--검색필터-->
<div class="tbl_filter">
			<table>
				<tbody><tr>
					<td bgcolor="#ffffff">

						<table width="98%">
							<tbody><tr>
								<td>
									<form name="form2" method="get" action="./reserv_list.php">
									<input type="hidden" name="s_wr_11" value="<?=$s_wr_11?>">
									
									<input type="hidden" name="ss_wr_subject" value="<?=$ss_wr_subject?>">
                                     <table>
										<tbody>
											<tr>

											<td>					
												<select name="order" onchange="location.href='?sst2='+this.value+'&<?=$qstr?>';">
													<option value="wr_datetime"<?php echo $sst2=="wr_datetime"?" selected":"";?>>등록일순</option>
													<option value="wr_1"<?php echo $sst2=="wr_1"?" selected":"";?>>입고예정일순</option>
													<option value="wr_2"<?php echo $sst2=="wr_2"?" selected":"";?>>출고예정(시간)순</option>
												</select>
											</td>
											<td>	
												
												<input type="hidden" name="sst2" value="<?=$sst2?>">
												
												<table cellpadding="3" cellspacing="3" border="0" style="border-collapse:collapse; font-size:13px; color:#41454B;">
													<tbody><tr>
														<td>
															<select name="sfl" style="height:25px;">
															<option value="wr_1"<?php echo $sfl=="wr_1"?" selected":"";?>>입고예정시간</option>
															<option value="wr_2"<?php echo $sfl=="wr_2"?" selected":"";?>>출차예정시간</option>															
															</select>																	
														</td>
														<td>
														
														
														
														<input type="text" id="datepicker1" name="stx" readonly="" title="YYYY-MM-DD" value="<?=$stx?>" class="frm_input"></td>
														<script>
														$(function() {
														  $( "#datepicker1" ).datepicker({
															dateFormat: 'yy-mm-dd',
															prevText: '이전 달',
															nextText: '다음 달',
															monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
															monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
															dayNames: ['일', '월', '화', '수', '목', '금', '토'],
															dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
															dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
															showMonthAfterYear: true,
															yearSuffix: '년'
														  });
														});
														</script>
                                                     </tr>
												</tbody>
                                                </table>
												
												
											</td>
										</tr>
									</tbody>
                                 </table>
                                 
                                 <table>
                                     <tr><td><input type="submit" value="검색" class="btn_submit"></td></tr>
                                 </table>

								</td>

								


							</tr>
						</tbody></table>
						</form>
								
					</td>
					<td bgcolor="#ffffff" align="right">
								
					
						<table>
							<tbody><tr>
								<td>
									<table>
										<tbody><tr>
											<td>
												<input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=예약신청|예약완료';"<?php echo $s_wr_11=="예약신청|예약완료"?" checked":"";?>>(예약신청,예약완료만)
											</td>
											<td><input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=예약신청&ss_wr_subject=<?=$ss_wr_subject?>';"<?php echo $s_wr_11=="예약신청"?" checked":"";?>>예약신청</td>
											<td><input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=주차중&ss_wr_subject=<?=$ss_wr_subject?>';"<?php echo $s_wr_11=="주차중"?" checked":"";?>>주차중</td>
											
											<td><input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=출차완료&ss_wr_subject=<?=$ss_wr_subject?>';"<?php echo $s_wr_11=="출차완료"?" checked":"";?>>출차완료</td>
											<td><input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=예약완료&ss_wr_subject=<?=$ss_wr_subject?>';"<?php echo $s_wr_11=="예약완료"?" checked":"";?>>예약완료</td>
											<td><input type="radio" name="s" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&stx=<?=$stx?>&sst2=<?=$sst2?>&s_wr_11=예약취소&ss_wr_subject=<?=$ss_wr_subject?>';"<?php echo $s_wr_11=="예약취소"?" checked":"";?>>예약취소</td>




											<td><input type="radio" onclick="javascript:window.location.href='?sst=<?=$sst?>&sod=<?=$sod?>&sfl=<?=$sfl?>&&sst2=<?=$sst2?>&ss_wr_subject=<?=$ss_wr_subject?>&s_wr_11=';"<?php echo $s_wr_11==""?" checked":"";?>>모든데이터</td>

										</tr>
									</tbody></table>
								</td>
							</tr>
							<tr>
								<td align="right">
									<form name="form3" method="get" action="?">
									<input type="hidden" name="sst2" value="<?=$sst2?>">
									<input type="hidden" name="s_wr_11" value="<?=$s_wr_11?>">
									<input type="hidden" name="stx" value="<?=$stx?>">
									<input type="hidden" name="sfl" value="<?=$sfl?>">

									<table cellpadding="3" cellspacing="3" border="0" style="border-collapse:collapse; font-size:13px; color:#41454B;">
										<tbody><tr>
											<td>
												<select name="sfl2">
												<option value="">::선택::</option>
												<option value="wr_name"<?php echo $sfl2=="wr_name"?" selected":"";?>>이름</option>
												<option value="wr_6"<?php echo $sfl2=="wr_6"?" selected":"";?>>차량번호</option>
												<option value="wr_5"<?php echo $sfl2=="wr_5"?" selected":"";?>>차량이름</option>
												<option value="right(wr_3,4)"<?php echo $sfl2=="right(wr_3,4)"?" selected":"";?>>핸드폰(뒤4자리)</option>

												</select>															
											</td>
											<td><input size="10" type="text" name="stx2" class="frm_input" value="<?=$stx2?>"></td>
											<td><input type="submit" value="검색" class="btn_submit"></td>				
										</tr>
									</tbody></table>
									</form>


								</td>

							</tr>
						</tbody></table>								
					</td>
				</tr>
			</tbody>
       </table>
</div>
<!--//검색필터-->

<div class="local_ov01 local_ov">
    총 <?php echo number_format($total_count) ?>건의 예약정보가 있습니다.
</div>



<?php if ($is_admin == 'super') { ?>
<!--
<div class="btn_add01 btn_add">
    <a href="./board_form.php" id="bo_add">게시판 추가</a>
</div>-->
<div class="btn_add01 btn_add">
    <a href="./excel.reserv.php?sfl=<?=$sfl?>&stx=<?=$stx?>" id="bo_add">엑셀변환</a>
	<a href="#" id="bo_add">프린터</a>
</div>
<?php } ?>

<form name="fboardlist" id="fboardlist" action="./reserv_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">게시판 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		<th scope="col">주차장명</th>
		<th scope="col">주차라인</th>
		<!--<th scope="col">주차라인(수기)</th>-->
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
		<th scope="col">온도체크</th>
		<th scope="col">등록/수정일</th>
		<th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $one_update = '<a href="./board_form.php?w=u&amp;bo_table='.$row['bo_table'].'&amp;'.$qstr.'">수정</a>';
        $one_copy = '<a href="./board_copy.php?bo_table='.$row['bo_table'].'" class="board_copy" target="win_board_copy">복사</a>';

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['bo_subject']) ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<input type="hidden" name="wr_idx[<?=$i?>]" value="<?=$row[wr_id]?>">
        </td>
		<td scope="col"><?=$row[wr_subject]?></td>
		<td scope="col" class="wr-9-select">
			<select name="wr_9[]" onchange="reservChange('<?=$row[wr_id]?>','wr_9',this.value)">
				<option value="">:::선택:::</option>
				<?php
					$sql="select * from park_line order by line_order asc";
					$result2=sql_query($sql);
					while($row2=sql_fetch_array($result2)){
				?>
				<option value="<?php echo $row2[line_name]?>"<?php echo $row[wr_9]==$row2[line_name]?" selected":"";?>><?=$row2[line_name]?></option>
				<?php }?>
			</select>
			<?/*
					if($_SERVER['REMOTE_ADDR']!="183.103.22.103"){
					for($a=0;$a<count($wr_9Arr);$a++){
				?>
				<option value="<?=$wr_9Arr[$a]?>"<?php echo $row[wr_9]==$wr_9Arr[$a]?" selected":"";?>><?=$wr_9Arr[$a]?></option>
				<?php }}else{*/?>
		</td>
		<!--<td><?=$row[wr_parking]?></td>-->
		<td scope="col">
			<select name="wr_10[]" onchange="reservChange('<?=$row[wr_id]?>','wr_10',this.value)">
				<option value="">:::선택</option>
				<option value="카드"<?php echo $row[wr_10]=="카드"?" selected":"";?>>카드</option>
				<option value="현금"<?php echo $row[wr_10]=="현금"?" selected":"";?>>현금</option>
			</select>
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
    
			<select name="wr_11[]"  onchange="reservChange('<?=$row[wr_id]?>','wr_11',this.value)">
				<?
					for($a=0;$a<count($wr_11Arr);$a++){
				?>
				<option value="<?=$wr_11Arr[$a]?>"<?php echo $row[wr_11]==$wr_11Arr[$a]?" selected":"";?>><?=$wr_11Arr[$a]?></option>
				<? }?>
			</select>
		</td>
		<td scope="col">
			<select name="wr_12[]"  onchange="reservChange('<?=$row[wr_id]?>','wr_12',this.value)">
				<option value="미보관"<?php echo $row[wr_12]=="미보관"?" selected":"";?>>미보관</option>
				<option value="보관"<?php echo $row[wr_12]=="보관"?" selected":"";?>>보관</option>
			</select>
		</td>
		<td scope="col">
			<select name="wr_13[]"  onchange="reservChange('<?=$row[wr_id]?>','wr_13',this.value)">
				<option value="X"<?php echo $row[wr_13]=="X"?" selected":"";?>>X</option>
				<option value="O"<?php echo $row[wr_13]=="O"?" selected":"";?>>O</option>
			</select>
		</td>
		<td scope="col">
			<select name="wr_22[]"  onchange="reservChange('<?=$row[wr_id]?>','wr_22',this.value)">
				<option value="O"<?php echo $row[wr_22]=="O"?" selected":"";?>>O</option>
				<option value="X"<?php echo $row[wr_22]=="X"?" selected":"";?>>X</option>
			</select>
		</td>
		<td scope="col"><?=$row[wr_datetime]?></td>
		<td scope="col">
			<a href="javascript:;" onclick="reservView('<?=$row[wr_id]?>')">보기</a> / 
			<a href="javascript:;" onclick="reservWrite('<?=$row[wr_id]?>')">수정</a> / 
			<a href="javascript:;" onclick="reservMemo('<?=$row['wr_id']?>')">메모</a>
		</td>
    </tr>
	<? if($row[wr_memo]!=""){?>
	<tr>
		<td colspan="<?=$colspan?>">MEMO - <?=$row[wr_memo]?></td>
	</tr>
	<? }?>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>
<script type="text/javascript">
	function reservChange(wr_id,field,val){
		$.ajax({
				url:"./reserv_change_update.php",
				data:{"wr_id":wr_id,"field":field,"val":val},
				dataType:"html",
				type:"GET",
				success:function(data){
					alert("상태가 변경되었습니다.");
				}
		});
//		document.getElementById("reserv-change").src="./reserv_change_update.php?wr_id="+wr_id+"&field="+field+"&val="+val;
	}
</script>
<div class="btn_list01 btn_list">
    <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
    <?php if ($is_admin == 'super') { ?>
<!--    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">-->
    <?php } ?>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;sst2='.$sst2.'&amp;s_wr_11='.$s_wr_11.'&amp;sfl2='.$sfl2.'&stx2='.$stx2.'&amp;page='); ?>

<script>
function reservMemo(wr_id){
	var width=800;
	var height=600;
	var left=($(window).width()-width)/2;
	var top=($(window).height()-height)/2;
	window.open("./reserv_memo.php?wr_id="+wr_id,"","width="+width+",height="+height+",left="+left+",top="+top+",scrollbars=1");
}
function reservView(wr_id){
	var width=800;
	var height=600;
	var left=($(window).width()-width)/2;
	var top=($(window).height()-height)/2;
	window.open("./reserv_view.php?wr_id="+wr_id,"","width="+width+",height="+height+",left="+left+",top="+top+",scrollbars=1");
}
function reservWrite(wr_id){
	var width=800;
	var height=600;
	var left=($(window).width()-width)/2;
	var top=($(window).height()-height)/2;
	window.open("./reserv_write.php?wr_id="+wr_id+"&w=u","","width="+width+",height="+height+",left="+left+",top="+top+",scrollbars=1");
}
function fboardlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$(function(){
    $(".board_copy").click(function(){
        window.open(this.href, "win_board_copy", "left=100,top=100,width=550,height=450");
        return false;
    });
});
</script>

<?php
include_once('./admin.tail.php');
?>
