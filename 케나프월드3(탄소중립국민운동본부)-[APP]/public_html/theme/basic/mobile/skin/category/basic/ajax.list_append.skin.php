<?php
include_once("./_common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$sca = $_POST['sca'];
$sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
$sql_search = get_sql_search($sca, $sfl, $stx, $sop);

// 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
$sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
$row = sql_fetch($sql);
$min_spt = (int)$row['min_wr_num'];

if (!$spt) $spt = $min_spt;

$sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";
$sql_search .= " and wr_primeium != '1' ";
$sql_search .= " and wr_is_comment = '0' ";

@include_once($board_skin_path.'/list_search.head.skin.php');

// 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
// 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$page_rows = 10;
$list_page_rows = 10;

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

if(!$sst)
    $sst  = "wr_num, wr_reply";

if($board['bo_orderby'])
	$sst = "wr_orderby desc, " . $sst;

if ($sst) 
    $sql_order = " order by {$sst} {$sod} ";

if ($sca || $stx) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 {$sql_search} ";
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

        $list[$i] = get_list($row, $board, $board_skin_url, $board['bo_mobile_subject_len']);
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

for($i=0; $i<count($list); $i++){ 
	$addr = explode(" ", $list[$i]['wr_addr1']);
	$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
	if($thumb['src']) {
		$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="100%">';
	} else {
		$img_content = '';
	}
?>
<?/*
<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&wr_id=<?php echo $primeium[$i]['wr_id'];?>" target="_blank">
*/?>
<div>
	<dl class="img-box" onclick="getView('<?php echo $list[$i]['wr_id'];?>')">
		<?php echo $img_content; ?>
	</dl>
	<dl class="info-box" style="padding:0 5px;" onclick="getView('<?php echo $list[$i]['wr_id'];?>')">
		<dt><?php echo $list[$i]['wr_subject'] ?></dt>
		<dd>
			<span class="box-txt"># <?php echo $list[$i]['wr_4'];?></span> 
		</dd>
		<dd>
			<span class="box-title02">리뷰</span> 
			<?php
			$cnt = sql_fetch("select count(*) as cnt from {$write_table} where wr_is_comment = '1' and wr_parent = '{$list[$i]['wr_id']}' and mb_id != '{$list[$i]['mb_id']}'");
			?>
			<?php echo $cnt['cnt'];?> 개
			
			<span class="box-title01">좋아요</span> 
			<?php echo $list[$i]['wr_good'];?> 개
		</dd>
	</dl>
	<dl class="tel-box">
		<?php if($list[$i]['wr_tel']){ ?>
		<a href="tel:<?php echo $list[$i]['wr_tel']; ?>">
			<dd>
				<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/phone.png" style=" width: 50px">
			</dd>
		</a>
		<?php } ?>
	</dl>
</div>
<?/*
</a>
*/?>
<?php } ?>
