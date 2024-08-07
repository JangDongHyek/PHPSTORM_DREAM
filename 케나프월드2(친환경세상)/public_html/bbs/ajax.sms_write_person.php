<?php
$sub_menu = "900300";
include_once("./_common.php");

$page_size = 15;
$colspan = 10;


$g5['title'] = "휴대폰아이디 관리";

if ($page < 1) $page = 1;

$sql_search .= " and g5_member.mb_level < '10' ";

if($sv){
	$sql_search .= " and g5_member.mb_nick like '%{$sv}%'";
}

if ($ap > 0)
    $sql_korean = korean_index('g5_member.mb_nick', $ap-1);
else {
    $sql_korean = '';
    $ap = 0;
}

$sql_nomal = "and g5_member.mb_id = gcm_member.mb_id and gcm_member.state = '1' and gcm_member.RegID is not null";
//if ($no_hp_checked == 'checked')
//$sql_no_hp = "and g5_member.mb_id <> '' and bk_receipt=1";


$total_res = sql_fetch("SELECT count(*) as cnt FROM g5_member INNER JOIN gcm_member on 1 $sql_search $sql_korean $sql_nomal");
$total_count = $total_res['cnt'];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$vnum = $total_count - (($page-1) * $page_size);

$list = sql_query("select * from `g5_member` where `mb_org` <> '' group by `mb_org` ");


// 지구조직 불러오기
$org_sql = " select distinct(od_org_name) from org_duty order by od_idx asc ";
$org_qry = sql_query($org_sql);
for($o=0; $org_row = sql_fetch_array($org_qry); $o++){
	$org_arr[$o] = $org_row['od_org_name'];
}
?>
<div class="tbl_head01 tbl_wrap">

<form name="search_form" id="sms_person_form" method="get" action="<?php echo $_SERVER['SCRIPT_NAME']?>">
<input type="hidden" name="total_pg" value="<?php echo $total_page?>">
<input type="hidden" name="page" value="<?php echo $page?>">

<label for="stt" class="sound_only">검색대상</label>

<label for="svv" class="sound_only">검색어</label>
<input type="text" size="35" name="sv" value="<?php echo $sv?>" id="svv" class="frm_input">
<input type="submit" value="닉네임 검색" class="btn_submit" style="height:32px; width:120px;">
</form>

<br>

    <table>
    <thead>
    <tr>
		<th scope="col">
            <label for="all_checked" class="sound_only">회원 전체</label>
            <input type="checkbox" id="all_checked" onclick="all_checked(this.checked)">
        </th>
		<th scope="col">닉네임</th>
		<th scope="col">아이디</th>
        <th scope="col">추가</th>
    </tr>
    </thead>
    <tbody>
	<? if (!$total_count) { ?>
    <tr>
        <td colspan="<?php echo $colspan?>" class="td_mbstat">데이터가 없습니다.</td>
    </tr>
    <?php
	
    } else {
    $line = 0;
    $qry = sql_query("SELECT g5_member.mb_no, g5_member.mb_nick, g5_member.mb_id, gcm_member.RegID FROM g5_member INNER JOIN gcm_member on 1 $sql_search $sql_korean $sql_nomal order by mb_no desc limit $page_start, $page_size");
    while($res = sql_fetch_array($qry))
    {
        $bg = 'bg'.($line++%2);

        $tmp = sql_fetch("select bg_name from {$g5['sms5_book_group_table']} where bg_no='{$res['bg_no']}'");
        if (!$tmp)
            $group_name = '미분류';
        else
            $group_name = $tmp['bg_name'];
    ?>
    <tr class="<?php echo $bg; ?>">
		<td class="td_chk">
            <label for="mb_no_<?php echo $res['mb_no']; ?>" class="sound_only"><?php echo get_text($res['mb_nick']) ?></label>
            <input type="checkbox" name="mb_no" value="<?php echo $res['mb_no'].",".$res['mb_nick'].",".$res['mb_id']?>" id="mb_no_<?php echo $res['mb_id']; ?>">
        </td>
        <td style="text-align:center"><?php echo $res['mb_nick']?></td>
		<td style="text-align:center"><?php echo $res['mb_id']?></td>
        <td style="text-align:center"><button type="button" class="btn_frmline" onclick="sms_obj.person_add(<?php echo $res['mb_no']?>, '<?php echo get_text($res['mb_nick']) ?>', '<?php echo $res['mb_id']?>')">추가</button></td>
    </tr>
    <?php }} ?>
    </tbody>
    </table>
	<br>
	<button type="button" class="btn_frmline" onclick="btn_alladd();">체크한거 추가하기</button>
</div>


<nav class="pg_wrap">
    <span class="pg" id="person_pg"></span>
</nav>


<script>

function all_checked(chk){
$('input:checkbox[name="mb_no"]').each(function() {
      this.checked = chk; //checked 처리
 });
}

function btn_alladd(){
$('input:checkbox[name="mb_no"]').each(function() {
      if(this.checked){//checked 처리된 항목의 값
		  var v = this.value;
		  var temp = v.split(",");
		  sms_obj.person_add(temp[0], temp[1], temp[2]);
      }
 });	
}


/*
$('#org_list').change(function(){
	var mb_org = $('#org_list option:selected').val();

	$("#org_list2").find("option").remove();
	$("#org_list2").append("<option value=''>전체</option>");

	if(mb_org != ""){
		$.ajax({
			type:"GET",
			url:"<?=G5_BBS_URL?>/ajax_get_orglist.php",
			data: {
				"mb_org": mb_org
			},
			dataType: "json",
			success:function(datas){
				for(var i=0; i<datas.length; i++){
					var frm = document.search_form;
					var op = new Option();
					op.value = datas[i];
					op.text = datas[i];
					frm.org_list2.options.add(op);
					
				}
			},
			error:function(request,status,error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			},
			beforeSend:function(){
			},
			complete:function(){
			}
		});
	}
});
*/

// 지구조직 onChange 되었을 때
$(".mb_org_sch").on('change', function(){
	var _idx = $(".mb_org_sch").index(this);
	var od_org_name = $(this).val();

	$.ajax({
		type: "POST",
		url: "<?php echo G5_ADMIN_URL ?>/org_duty_ajax.php",
		data: { od_org_name: od_org_name },
		success:function( data ) {
			$(".mb_org_duty_sch:eq("+_idx+") option").remove();
			$(".mb_org_duty_sch").eq(_idx).append("<option value=''>전체</option>");
			if(data != ''){
				var data_arr = data.split('|||');
				if(data_arr.length > 0){
					for(var k=0; k<data_arr.length; k++){
						$(".mb_org_duty_sch").eq(_idx).append("<option value='"+data_arr[k]+"'>"+data_arr[k]+"</option>");
					}
				}
			}
			
		}
	});

});

</script>



<!--
총 건수 : <?php echo number_format($total_count)?> /
회원 : <?php echo number_format($member_count)?> /
비회원 : <?php echo number_format($no_member_count)?> /
수신 : <?php echo number_format($receipt_count)?> /
거부 : <?php echo number_format($reject_count)?>
-->