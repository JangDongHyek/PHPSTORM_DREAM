<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 7;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

$comment_action_url = G5_BBS_URL."/write_comment_update.php";

/*
$row = sql_fetch("select sum(wr_subject) as sum1, 
				(select sum(wr_content) from g5_write_asset where (wr_1 = '' or wr_1 = 'success') and wr_is_comment = '1') as sum2, 
				avg(wr_content) as avgs from g5_write_asset 
				where wr_1 != 'end' and wr_is_comment = '0' ");
$sum = $row['sum1'] - $row['sum2'];		// 190220 총 판매중인 금 합계(완료제외) - 총 구매된 금 합계(완료제외 안함) = 총 잔여 금 ?
echo  $row['sum1'] ."//". $row['sum2'];
*/
$row = sql_fetch("select sum(wr_remainCnt) as sum, 
				avg(wr_content) as avgs from g5_write_asset 
				where wr_1 != 'end' and wr_is_comment = '0' ");
$sum = $row['sum'];
$avg = $row['avgs'];

$avgSTR = sprintf("%06d", $avg);
$avgSTR = substr($avgSTR, 0, 3).",".substr($avgSTR, 3, 3);
$avgSTR = str_replace("0", "<span>0</span>", $avgSTR);

$ca_name = "판매";

$wal_action_url = G5_BBS_URL."/asset_update.php";

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?v='.date("Ymd").'">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
.wal-input { width:100%; border:1px solid #DBDBDB; padding:5px 10px; border-radius: 4px !important; height:44px !important; font-size:1.5em !important;}
.wl_btn { margin:0 !important; height:44px !important; width:100%; }
#goldAvg {font-size: 1.15em;}
#goldAvg > span {font-size: 0.75em;}
</style>
<div class="top_asset">
	<div class="logo"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/logo.png" alt="로고"/><p>wecash account</p></div>
	<dl>
		<dt>직거래 시장</dt>
		<dd>평균시세 <strong class="twinkle_txt" style="font-size:1.5em;" id="goldAvg"><?php echo $avgSTR;?></strong></dd>
		<dd>골드거래량 <strong><?php echo number_format($sum);?></strong> </dd>
    </dl>
</div>

<div class="asset_info">
골드거래를 환영합니다.<br>
디지털 자산의 골드 직거래소에서 <br>
골드거래 할 수 있습니다. 
</div>

<img src="<?php echo G5_THEME_IMG_URL?>/mobile/graph.png" width="95%" style="margin:10px 2.5%;">

<script>
$(function (e){
	$(".twinkle_txt").animate({opacity:1}, 1000).animate({opacity:0}, 1000);
	setInterval(function(){
		$(".twinkle_txt").animate({opacity:1}, 1000).animate({opacity:0}, 1000);
	}, 2000);
});
</script>
<?php if(!$is_adm){ ?>
<div>
	<dl class="row" style="padding:10px;">
		<dd class="col-xs-4"><input type="button" class="btn btn-danger" value="골드보내기" style="width:100%;" onclick="setModal('#req_modal2')"></dd>
		<dd class="col-xs-4"><input type="button" class="btn btn-danger" value="판매하기" style="width:100%;" onclick="setModal('#req_modal3')"></dd>
		<dd class="col-xs-4"><a href="<?php echo G5_BBS_URL;?>/myasset.php" class="btn btn-danger" style="width:100%;">My거래내역</a></dd>
	</dl>
</div>

<!-- Small modal -->
<div id="req_modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<dl class="modal-dialog modal-lg">
		<dd class="modal-content modal-point">
			<form name="wal_write" id="wal_write" action="<?php echo $wal_action_url ?>" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit(this);" >
				<input type="hidden" name="wl_tel_chk" id="wl_tel_chk" value="">
				<p class="row" style="padding-bottom:0; ">
					<span class="col-xs-9" style="padding:0;">
						<input type="text" name="wl_tel" id="wl_tel" value="" class="wal-input" placeholder="모바일 번호를 입력해주세요." onkeyup="$('#wl_tel_chk').val('')">
					</span>
					<span class="col-xs-3" style="padding:0;">
						<input type="button" class="btn btn-default btn-sm wl_btn" value="찾기" style="background:#FFF;" onclick="findTel()">
					</span>
					<span class="col-xs-12" id="wl_font" style="font-weight:bold;"></span>
				</p>
				<p class="row">
					<span class="col-xs-9" style="padding:0;">
						<input type="number" name="wl_money" id="wl_money" value="" class="wal-input" placeholder="골드거래수량을 입력해주세요.">
					</span>
					<span class="col-xs-3" style="padding:0;">
						<input type="submit" id="wl_submit" class="btn btn-danger btn-sm wl_btn" value="보내기">
					</span>
				</p>
			</form>
		</dd>
	</dl>
</div>
<!-- Small modal -->
<div id="req_modal3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<dl class="modal-dialog modal-lg">
		<dd class="modal-content modal-point">
			<form name="fwrite" id="fwrite" action="<?php echo G5_BBS_URL ?>/write_update.php" onsubmit="return fwrite_submit2(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="sst" value="<?php echo $sst ?>">
			<input type="hidden" name="sod" value="<?php echo $sod ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="ca_name" id="ca_name" value="판매">
			<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>">
			<input type="hidden" name="wr_sum" id="wr_sum" value="<?php echo $sum ?>">
			<div class="div_form">
				<dl>
					<dd>
						<input type="number" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>" class="wal-input required" required placeholder="골드판매" style="width:100%;">
					</dd>
				</dl>
				<dl>
					<dd>
						<input type="number" name="wr_content" id="wr_content" value="<?php echo $content ?>" class="wal-input required" required placeholder="1골드 단가" style="width:100%;">
					</dd>
				</dl>
			</div>

			<div class="text-center" style="padding:10px;">
				<input type="submit" value="작성완료" id="btn_submit" class="btn btn-primary btn-sm" accesskey="s">
			</div>
			</form>
		</dd>
	</dl>
</div>

<!-- Small modal -->
<div id="req_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<dl class="modal-dialog modal-lg">
		<dd class="modal-content modal-point">
			<form name="fviewcomment" action="<?php echo $comment_action_url; ?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
			<input type="hidden" name="w" value="c" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" id="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" id="comment_id" value="<?php echo $c_id ?>">
				<p>※ 결제하실 에셋 입력 후 결제버튼을 눌러주세요. </p>
				<p>※ 에셋은 거래 후 취소할 수 없습니다. 한번 더 확인 후 진행해주세요.</p>
				<p class="row wc-price">
					<span class="col-xs-6">판매중인 에셋</span>
					<span class="col-xs-6 text-right"><strong id="tr_asset"></strong></span>
				</p>
				<p class="row wc-price">
					<span class="col-xs-6">판매단가</span>
					<span class="col-xs-6 text-right"><strong id="tr_selcash"></strong></span>
				</p>
				<p class="row wc-price">
					<span class="col-xs-6">보유중인 에셋</span>
					<span class="col-xs-6 text-right"><strong><?php echo number_format($member['mb_asset']);?></strong></span>
				</p>
				<p class="row wc-price">
					<span class="col-xs-6">보유중인 위캐시</span>
					<span class="col-xs-6 text-right"><strong><?php echo number_format($member['mb_point']);?></strong></span>
				</p>
				<div class="wc-tbl">
					<table>
						<thead>
						<tr>
							<th>거래 에셋</th>
							<th>거래 위캐시</th>
							<th>거래후 잔액</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td id="tr_content">0</td>
							<td id="tr_wecash">0</td>
							<td id="tr_afcash">0</td>
						</tr>
						</tbody>
					</table>
				</div>
				<p class="row" style="padding:5px 0;">
					<span class="col-xs-7">
						<input type="number" name="wr_content" id="wr_asset" value="" class="frm-input" placeholder="거래 에셋" style="width:100%;" onkeyup="setTrd(this.value);">
					</span>
					<span class="col-xs-1">
					</span>
					<span class="col-xs-4 text-right">
						<input id="asset_submit" type="submit" value="결제" class="btn btn-danger" style="width:100%;">
					</span>
				</p>
			</form>
		</dd>
	</dl>
</div>
<?php } ?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
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

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
            <tr>
                <?php if ($is_adm) { ?>
                <th scope="col">
                    <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
                </th>
                <?php } ?>
                <th scope="col">일</th>
                <th scope="col">id</th>
                <th scope="col">단가</th>
                <th scope="col">수량</th>
                <th scope="col">구매/결제</th>
            </tr>
        </thead>
        <tbody>
        <?php 
		for ($i=0; $i<count($list); $i++) { 
			$row = sql_fetch("select count(*) as cnt from {$write_table} where wr_parent = '{$list[$i]['wr_id']}' and wr_is_comment = '1'");
			$cnt = $row['cnt'];
			$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$list[$i]['wr_id']}' and wr_is_comment = '1' and (wr_1 = '' or wr_1 = 'success')");
			$sum = $list[$i]['subject'] - $row['wr_content'];

			$temp = explode(" ", $list[$i]['wr_datetime']);
			$temp_date = explode("-", $temp[0]);
			$temp_time = explode(":", $temp[1]);

			$mk_now = mktime();
			$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

			$now_date = $mk_now - $mk_date;
			$date_str = floor($now_date / 86400);
			
		?>
        <tr>
            <?php if ($is_adm) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
			<td class="td_num"><?php echo $temp_date[1]."-".$temp_date[2]; ?></td>
			<td class="text-center"><?php echo substr($list[$i]['mb_id'], -4); ?></td>
			<td class="text-center"><?php echo number_format($list[$i]['wr_content']);?> </td>
            <td class="td_subject text-center"><?php echo number_format($sum) ?></td>
			<td class="text-center" style="width:60px;">
				<?php if($list[$i]['ca_name'] == "구매"){ // 190219 현재 DB에 '구매' 없음 ?>
					<?php
					if($list[$i]['mb_id'] == $member['mb_id'] || $is_admin){
					?>
					<a href="<?php echo $list[$i]['href'];?>" class="btn btn-default btn-xs">자세히</a>
					<?php
					} else {
					$mb = sql_fetch("select * from g5_member where mb_id = '{$list[$i]['mb_id']}'");
					?>
					<a href="<?php if($mb['mb_tel']) { ?>tel:<?php echo $mb['mb_tel']?><?php }else{ ?>javascript:alert('전화번호가 없습니다.');<?php } ?>" class="btn btn-default btn-xs">전화하기</a>
					<?php } ?>

				<?php } else { // 판매 ?>
					<?php if($is_adm || $list[$i]['mb_id'] == $member['mb_id']){ ?>
					<a href="<?php echo $list[$i]['href'];?>" class="btn btn-default btn-xs">
						자세히 <span style="color:#DA2820; font-weight:bold;">(<?php echo $cnt;?>)</span>
					</a>
					<?php }else{ ?>
						<?php if($list[$i]['wr_1']){ ?>
							<input type="button" class="btn btn-danger btn-xs" value="거래완료">
						<?php }else{ ?>
							<?php if($list[$i]['wr_content'] * $sum == 0){ ?>
							<input type="button" class="btn btn-danger btn-xs" value="거래완료">
							<?php }else{?>
							<label onclick="setReq('<?php echo $list[$i]['wr_id'];?>', '<?php echo $list[$i]['wr_subject'];?>')" class="twinkle_txt">
							<?php echo number_format($list[$i]['wr_content'] * $sum); ?>
							</label>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } // 판매 END ?>
			</td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">판매중인 에셋이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($is_adm) { ?>
    <div class="bo_fx">
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        </ul>
    </div>
    <?php } ?>
    </form>
    
    <?php if ($is_adm) { ?>
	<!-- 게시판 검색 시작 { -->
	<fieldset id="bo_sch">
		<div class="text-center">
			<legend>게시물 검색</legend>

			<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">
			<label for="sfl" class="sound_only">검색대상</label>
			
			<select name="sfl" id="sfl">
				<option value="mb_id"<?php echo get_selected($sfl, 'mb_id'); ?>>아이디</option>
				<option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>이름</option>
			</select>
			
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
			<input type="submit" value="검색" class="btn btn-default btn-xs">
			</form>
		</div>
	</fieldset>
	<!-- } 게시판 검색 끝 -->
    <?php } ?>

	<!-- 페이지 -->
	<?php echo $write_pages;  ?>
</div>
<div class="ass_txt">
골드asset 가치팽창~~<br>
회원의 절대적 우위 경이로운 자산성장
<h3>초간편모바일 회원거래소</h3>
골드 미래의 자산으로 더 큰 권리의 통화로 성장할 것입니다.
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<script>

function fwrite_submit2(f)
{
    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

function findTel(){
	var wl_tel = $("#wl_tel").val();

	$.get("<?php echo G5_BBS_URL;?>/ajax.find_tel.php", {wl_tel:wl_tel}, function (e){
		if(e.success)
			$("#wl_tel_chk").val(1);
		else
			$("#wl_tel_chk").val("");

		$("#wl_font").html(e.msg);
	}, "json");
}

function fwrite_submit(f){
	var mon = document.getElementById("wl_money").value;
	var wl_tel = document.getElementById("wl_tel").value;
	var wl_tel_chk = document.getElementById("wl_tel_chk").value;

	if(mon == ""){
		alert("결제금액을 입력해주세요.");
		return false;
	}

	if(wl_tel == ""){
		alert("전화번호를 입력해주세요.");
		return false;
	}
	
	if(wl_tel_chk == ""){
		alert("찾기 버튼 클릭 후 결제를 눌러주세요.");
		return false;
	}

	return true;
}

var v4 = 0;
function setReq(wr_id, wr_subject){
	document.getElementById("wr_id").value = wr_id;
	$.get("<?php echo G5_BBS_URL;?>/ajax.request.php", {wr_id:wr_id}, function (e){
		$("#tr_asset").html(e.sum);
		$("#tr_selcash").html(e.sel);
		$('#req_modal').modal();
	}, "json");
}

function setModal(i){
	$(i).modal();
}

function fviewcomment_submit(f){
	var wr_id = f.wr_id.value; 
	var amount = f.wr_content.value;
	
	if(!amount){
		alert("에셋을 입력해주세요.");
		return false;
	}

	if(v4 < 0){
		alert("위캐시가 부족합니다. 확인 후 다시 시도해주세요.");
		return false;
	}

	$("#asset_submit").attr("disabled", "disabled");

	// 판매에셋보다 많은 금액 입력 불가, 거래내역, 승인필요, 거래중인 에셋은 거래안되도록
	$.get("<?php echo G5_BBS_URL;?>/ajax.asset.php", {bo_table:"<?php echo $bo_table;?>", wr_id:wr_id, amount:amount}, function (e){

		if(e.success){
			f.submit();
		}else{
			alert(e.msg);
			$("#asset_submit").removeAttr("disabled");
		}
	}, "json");

	return false;
}

function setTrd(v){
	var v1 = parseInt(number_only(v))
	var v2 = parseInt(number_only(document.getElementById("tr_selcash").innerHTML));
	var v3 = v1 * v2;

	v4 = parseInt("<?php echo $member['mb_point'];?>") - v3;
	var m = "";

	if(v4 < 0)
		m = "-";

	document.getElementById("tr_content").innerHTML = number_format(v1);
	document.getElementById("tr_wecash").innerHTML = number_format(v3);
	document.getElementById("tr_afcash").innerHTML = m + number_format(v4);
}

function number_only(num) {
	num = num + "";
	num = num.replace(/[^0-9]/gi, ""); 
	return num ;
}
//콤마

function number_format(num, decimals, dec_point, thousands_sep) {
	num = num + "";
	num = num.replace(/,/gi, "");
	num = num.replace(/[^0-9]/gi, ""); 
    num = parseFloat(num);

    if(isNaN(num)) return '0';

    if(typeof(decimals) == 'undefined') decimals = 0;
    if(typeof(dec_point) == 'undefined') dec_point = '.';
    if(typeof(thousands_sep) == 'undefined') thousands_sep = ',';

    decimals = Math.pow(10, decimals);
    num = num * decimals;
    num = Math.round(num);
    num = num / decimals;
    num = String(num);

    var reg = /(^[+-]?\d+)(\d{3})/;
    var tmp = num.split('.');
    var n = tmp[0];
    var d = tmp[1] ? dec_point + tmp[1] : '';

    while(reg.test(n)) n = n.replace(reg, "$1"+thousands_sep+"$2");

    return n + d;
}
</script>

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

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->