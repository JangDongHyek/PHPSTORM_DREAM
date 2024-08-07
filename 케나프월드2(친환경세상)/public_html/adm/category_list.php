<?php
$sub_menu = "500900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if(!sql_fetch("select * from Information_schema.tables where table_name = 'g5_category'")){
	sql_query("
		CREATE TABLE IF NOT EXISTS `g5_category` (
		`ca_id` int(4) auto_increment,
		`ca_code` varchar(255) NOT NULL default '',
		`ca_name` varchar(255) NOT NULL default '',
		`ca_order` int(4) NOT NULL default '0',
		`ca_file` varchar(255) NOT NULL default '',
		`ca_filename` varchar(255) NOT NULL default '',
		PRIMARY KEY  (`ca_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");
}

if($sca) {
	$sql_search .= " and ca_code like '{$sca}%' ";
	$row = sql_fetch(" select ca_name from g5_category where ca_code = '{$sca}' ");
	$ca_name = $row['ca_name'];
}

if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ) ";
}

// 부모-> 출력순서 -> ca_id 값 순
$sql_order = " order by ca_code asc, ca_order asc";

$sql = " select count(*) as cnt from g5_category where (1=1) {$sql_search} {$sql_order}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from g5_category where (1=1) {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$g5['title'] = $ca_name?$ca_name:"전체";
$g5['title'] .= " 관리";

include_once('./admin.head.php');
?>


<article class="row" style="min-height:320px;">
	<div class="col-xs-12 text-right" style="padding:10px 20px 0 0;">
		<form name="fsearch" id="fsearch" class="local_sch" method="get">

		<label for="sfl" class="sound_only">검색대상</label>
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
		<input type="submit" value="검색" class="btn_submit">

		</form>
	</div>

	<div class="col-xs-12 col-sm-9 tbl_head01 tbl_wrap">
		<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="token" value="<?php echo $token ?>">

		<table>
		<caption><?php echo $g5['title']; ?> 목록</caption>
		<thead>
		<tr>
			<th scope="col">분류코드</th>
			<th scope="col">아이콘</th>
			<th scope="col">분류명</th>
			<th scope="col">출력순서</th>
			<th scope="col">관리</th>
		</tr>
		</thead>
		<tbody>
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$bg = 'bg'.(strlen($row['ca_code'])/2)%2;

			$img_path = G5_DATA_PATH."/category/".substr($row['ca_code'], 0, 2)."/".$row['ca_file'];
			$img_content = "";
			if(is_file($img_path))
				$img_content = '<img src="'.G5_DATA_URL.'/category/'.substr($row['ca_code'], 0, 2).'/'.$row['ca_file'].'" style="width:100%; max-width:100px;">';
			else
				$img_content = '<i class="fa fa-times" aria-hidden="true"></i>';
		?>
		<tr class="<?php echo $bg; ?>">
			<td class="td_category">
				<?php for($j=2; $j<strlen($row['ca_code']); $j+=2){ ?><i class="fa fa-caret-right" aria-hidden="true"></i> <?php } ?> <?php echo $row['ca_code'];?>
			</td>
			<td class="td_image"><?php echo $img_content;?></td>
			<td>
				<?php echo $row['ca_name'];?>
			</td>
			<td class="td_date"><?php echo $row['ca_order'];?></td>
			<td class="td_btn">
				<?php if($member['mb_id'] == "lets080"){ ?>
				<input type="button" value="추가" class="btn btn-addblock btn-xs" onclick="setCategory('r', '<?php echo $row['ca_id'];?>');">
				<input type="button" value="수정" class="btn btn-default btn-xs" onclick="setCategory('u', '<?php echo $row['ca_id'];?>');">
				<input type="button" value="삭제" class="btn btn-default btn-xs" onclick="setCategory('d', '<?php echo $row['ca_id'];?>');">
				<?php }else{ ?>
				<?php if(strlen($row['ca_code']) == 2) { ?>
				<input type="button" value="추가" class="btn btn-addblock btn-xs" onclick="setCategory('r', '<?php echo $row['ca_id'];?>');">
				<?php }else{ ?>
				<input type="button" value="수정" class="btn btn-default btn-xs" onclick="setCategory('u', '<?php echo $row['ca_id'];?>');">
				<input type="button" value="삭제" class="btn btn-default btn-xs" onclick="setCategory('d', '<?php echo $row['ca_id'];?>');">
				<?php } ?>
				<?php } ?>
			</td>
		</tr>
		<?php
		}
		if ($i == 0)
			echo '<tr><td colspan="6" class="empty_table">자료가 없습니다.</td></tr>';
		?>
		</tbody>
		</table>

		</form>
	</div>
	<?php
    $len = strlen($sca);

    $len2 = $len + 1;
	$len3 = $len + 2;
	$sql = " select MAX(SUBSTRING(ca_code, $len2, 2)) as max_subid from g5_category
			  where SUBSTRING(ca_code,1,$len) = '{$sca}' ";
	$row = sql_fetch($sql);
	$subid = base_convert($row['max_subid'], 36, 10);
	$subid += 36;
	if ($subid >= 36 * 36)
		$subid = "  ";

	$subid = base_convert($subid, 10, 36);
	$subid = substr("00" . $subid, -2);
	$subid = $sca . $subid;

	$sql = " select max(ca_order) as max_order from g5_category where ca_code like '{$sca}%' and char_length(ca_code) = '{$len3}'";

	$row = sql_fetch($sql);
	$ca_order = $row['max_order']+1;
	?>

	<div class="col-xs-12 col-sm-3 tbl_head01 tbl_wrap">
		<form name="fcawrite" id="fcawrite" action="./category_form_update.php" onsubmit="return fcawrite_submit(this);" method="post" enctype="multipart/form-data">
			<input type="hidden" name="w" id="w" value="">
			<input type="hidden" name="sca" id="sca" value="<?php echo $sca;?>">
			<input type="hidden" name="ca_id" id="ca_id" value="">
			<input type="hidden" name="ca_code" id="ca_code" value="<?php echo $subid;?>">
			<table>
			<caption><?php echo $g5['title']; ?> 추가</caption>
			<thead>
				<tr>
					<th colspan="2">분류추가</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="td_cnt">분류코드</td>
					<td id="td_code"><?php echo $subid;?></td>
				</tr>
				<tr>
					<td class="td_cnt">분류명</td>
					<td><input type="text" name="ca_name" id="ca_name" class="frm_input" size="20"></td>
				</tr>
				<tr>
					<td class="td_cnt">출력순서</td>
					<td><input type="text" name="ca_order" id="ca_order" class="frm_input" size="4" value="<?php echo $ca_order;?>"></td>
				</tr>
				<tr>
					<td class="td_cnt">아이콘</td>
					<td>
						<input type="file" name="ca_file" id="ca_file" class="frm_input">
						<span id="sp_file"></span>
					</td>
				</tr>
			</tbody>
			</table>
			<p style="padding-top:10px;"><input type="submit" id="form_button" class="btn btn-primary btn-sm" value="분류추가" style="width:100%;"></p>
		</form>
	</div>
</article>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<script>
function setCategory(w, ca_id){
	if(w == "d"){
		if(confirm("정말 해당 분류를 삭제하시겠습니까?\n상위분류시, 하위 분류의 내용도 모두 삭제됩니다.")==false){
			return false;
		}
	}

	$.post("<?php echo G5_ADMIN_URL;?>/ajax.category.php", { w:w, ca_id:ca_id }, function (d){
		console.log(d);

		if(d.result){
			$("#w").val(d.w);
			$("#ca_id").val(d.ca_id);
			$("#ca_code").val(d.ca_code);
			$("#td_code").html(d.ca_code);
			$("#ca_name").val(d.ca_name);
			$("#ca_order").val(d.ca_order);

			if(d.ca_file){
				var file_check = $('<input />', {
										type: "checkbox",
										name: "ca_file_del",
										id: "ca_file_del"
									});
				var file_label = $('<label />', {
										for: "ca_file_del",
										class: "file_label",
										html: "파일삭제 ( "+d.ca_filename+" )",
									});
				$("#sp_file").html(file_check);
				$("#sp_file").append(file_label);
			}else{
				$("#sp_file").html("");
			}

			if(d.ca_id){
				$("#form_button").val("분류수정");
			}else{
				$("#form_button").val("분류추가");
			}

			$("#form_button").removeAttr("disabled");
		}else{
			alert(d.error);
			location.reload();
		}
	}, "json");
}

function fcawrite_submit(f){
	if(f.ca_name.value == ""){
		alert("분류명을 입력해주세요.");
		return false;
	}

	return true;
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

</script>

<?php
include_once('./admin.tail.php');
?>
