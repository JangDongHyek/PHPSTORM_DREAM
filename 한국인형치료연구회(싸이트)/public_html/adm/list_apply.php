<?php

include_once('./_common.php');

if($flg=='edu')
	$sub_menu = "400100";
else
	$sub_menu = "400200";

switch($flg){
	case 'edu' : $table = 'apply01'; $g5['title'] = '교육신청현황'; break;
	case 'certify' :  $table = 'apply02'; $g5['title'] = '자격신청현황'; break;
	case 'academy' :  $table = 'apply03'; $g5['title'] = '워크샵/학술대회 접수현황'; break;
	default : $table = 'apply01';  $g5['title'] = '교육신청현황';  break;
}

	$sql_search = "(1)";
	$sql_joinsearch = "(1)";
include_once('./admin.head.php');


if($sfl){

	switch($sfl){
			case "mb_name" : $sql_search .= " and wr_subject like '%{$sch_text}%' "; $sql_joinsearch .= " and a.wr_subject like '%{$sch_text}%' "; break;
			case "mb_id" : $sql_search .= " and mb_id = '{$sch_text}' "; $sql_joinsearch .= " and a.mb_id = '{$sch_text}'"; break;
			case "wr_4" : {

				$sql ="select wr_id from g5_write_{$flg} where wr_subject like '%{$sch_text}%' ";

				$result = sql_fetch($sql);
				$sql_search .=" and wr_4 = {$result['wr_id']} "	;  $sql_joinsearch .= " and a.wr_4 = '{$result['wr_id']}'";

				break;
			}

			default : break;
	}
}

//SELECT gg._id, gg.name, s.title FROM girl_group AS gg LEFT OUTER JOIN song AS s ON s._id = gg.hit_song_id;

//$sql ="select * from g5_write_{$table} where {$sql_search}";
//$result  = sql_query($sql);


$sql ="select count(a.wr_id) as cnt from g5_write_{$table} as a left outer join g5_write_{$flg} as b on a.wr_4 = b.wr_id where {$sql_joinsearch}";
$result_cnt  = sql_fetch($sql);

$total_count = $result_cnt['cnt'];
$colspan = 16;

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql ="select * from g5_write_{$table} where {$sql_search} order by wr_datetime asc limit  {$from_record} , {$rows} ";
$result  = sql_query($sql);

?>

<style>
.mb_tbl table {text-align: center;}
</style>
<!--
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총신청수 <?php echo number_format($total_count) ?>
</div> -->

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="wr_4"<?php echo get_selected($_GET['sfl'], "wr_4"); ?>>교육명</option>
	<? /*
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
	*/ ?>
</select>
<label for="sch_text" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="hidden" name="flg" value="<?php echo $flg ?>" id="input_flg" required class="required frm_input">
<input type="text" name="sch_text" value="<?php echo $sch_text ?>" id="sch_text" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>
<!-- 교육/자격 신청 직접 접수 부분 -->
<?if($table=='apply01'){?>
<!-- <div class="btn_add01 btn_add">
    <a href="./apply01_form.php" id="member_add">교육신청추가</a>
</div> -->
<?}?>
<!-- 교육/자격 신청 직접 접수 부분 -->
<form name="fapplylist" id="fapplylist" action="./apply_list_update.php" onsubmit="return fapplylist_submit(this);" method="post">
	<input type="hidden" name="dltflg"   id="dltflg" value="<?=$table?>"/>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
	<tr>
		<th scope="col" rowspan="2">
		            <label for="chkall" class="sound_only">회원 전체</label>
		            <input type="checkbox" name="chkall"  id="chkall" >
		        </th>
		<th><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th><?if($flg=='academy') echo '제목'; else echo '교육명'?></th>
<!-- 		<th><?php echo subject_sort_link('mb_name') ?>이름</a></th> -->
<!-- 		<th>휴대폰</th> -->
		<th>접수기간</th>
		<th><?if($flg=='academy') echo '행사기간'; else echo '교육기간'?></th>
		<th><?if($flg=='academy') echo '비용'; else echo '교육비용'?></th>
		<?if($flg=='edu') {?>		<th>교육분류</th><?}?>
		<th>이수현황</th>
		<th colspan="1">입금현황</th>
		<th>파일첨부(<?if($flg=='edu' || $flg=='academy') echo '수료증'; else echo '자격증'?>)</th
	</tr>
	<tr>
		<th >이름</th>
		<th>이메일</th>
		<?if($flg=='edu') {?>	<th>연락처</th><?}?>
		<th colspan="2">생년월일</th>
		<th colspan="2">입급날짜</th>
		<th colspan="2">입급자명</th>
	</tr>
	<? /*
    <tr>
        <th scope="col" rowspan="2" id="mb_list_chk">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" rowspan="2" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th scope="col" colspan="6" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>본인확인</a></th>
        <th scope="col" id="mb_list_mobile">휴대폰</th>
        <th scope="col" id="mb_list_auth">상태/<?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
        <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
        <th scope="col" rowspan="2" id="mb_list_grp">접근<br>그룹</th>
        <th scope="col" rowspan="2" id="mb_list_mng">관리</th>
    </tr>
    <tr>
        <th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>
        <th scope="col" id="mb_list_mailc"><?php echo subject_sort_link('mb_email_certify', '', 'desc') ?>메일<br>인증</a></th>
        <th scope="col" id="mb_list_open"><?php echo subject_sort_link('mb_open', '', 'desc') ?>정보<br>공개</a></th>
        <th scope="col" id="mb_list_mailr"><?php echo subject_sort_link('mb_mailling', '', 'desc') ?>메일<br>수신</a></th>
        <th scope="col" id="mb_list_sms"><?php echo subject_sort_link('mb_sms', '', 'desc') ?>SMS<br>수신</a></th>
        <th scope="col" id="mb_list_adultc"><?php echo subject_sort_link('mb_adult', '', 'desc') ?>성인<br>인증</a></th>
        <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_intercept_date', '', 'desc') ?>접근<br>차단</a></th>
        <th scope="col" id="mb_list_tel">전화번호</th>
        <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
        <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
    </tr>
	*/ ?>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
		$sql ="select * from g5_write_{$flg} where wr_id = {$row['wr_4']}";

		$info_wr = sql_fetch($sql);
		if($info_wr['wr_id']==''){
			continue;
		}
        $bg = 'bg'.($i%2);
    ?>
	<tr class="<?php echo $bg; ?>">
	<td rowspan="2">
			<input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
		            <input type="checkbox" name="chk[]" value="<?php echo $row['wr_id'] ?>" id="chk_<?php echo $i ?>">
		</td>
		<td><?=$row['mb_id']?></td>
		<td><?=$info_wr['wr_subject']?></td>
		<td><?=$info_wr['wr_1']?> ~ <?=$info_wr['wr_2']?></td>
		<td><?=$info_wr['wr_3']?> ~ <?=$info_wr['wr_4']?></td>
<!-- 		<td><?=$row['mb_hp']?></td> -->
		<td><?=number_format($info_wr['wr_5']);?></td>
		<?if($flg=='edu') {?>		<td><?=$row['ca_name']?></td><?}?>
		<td >
				<select name="slc_state" id="<?=$row['wr_id']?>_wr5">
						<?if($flg=='certify'){?><option value=0 <?if($row['wr_5']==0) echo 'selected';?>>심사중</option><?}?>
						<option value=1 <?if($row['wr_5']==1) echo 'selected';?>><?if($flg=='edu' || $flg=='academy') echo '미완료'; else echo '불합격'?></option>
						<option value=2 <?if($row['wr_5'] == 2) echo 'selected';?>><?if($flg=='edu' || $flg=='academy') echo '완료'; else echo '합격'?></option>
						<option value=3 <?if($row['wr_5'] == 3) echo 'selected';?>><?if($flg=='edu' || $flg=='academy') echo '환불'; else echo '취소'?></option>
				</select>
		</td>
		<td  colspan="1">
            <select id="<?=$row['wr_id']?>_wr7" name="slc_wr7">
                <option value="0" <?if($row['wr_7'] != 1) echo 'selected' ?>>미입금</option>
                <option value="1" <?if($row['wr_7'] == 1) echo 'selected' ?>>입금</option>
            </select>
		</td>

		<td>

		<?if($row['wr_6']!=''){?>
				<a href="<?=G5_DATA_URL?>/file/<?=$table?>/<?=$row['wr_6']?>">보기</a>
                <? //if($member['mb_id']=="lets080"){ ?>
                <a href="javascript:del_file('<?=$table?>','<?=$row['wr_id']?>');">파일삭제</a>
                <? //} ?>
		<?}else{?>
				<form id="fileform<?=$i+1?>"  method="post" enctype="multipart/form-data">
							<input type="hidden" name="wr_id" id="wr_id<?=$i+1?>"  value="<?=$row['wr_id']?>"/>
							<input type="hidden" name="flg"   id="flg<?=$i+1?>" value="<?=$table?>"/>
							<input type="file" id="<?=$i+1?>" name="bf_file<?=$i+1?>" class="uploadfile"/>
				</form>
		<?}?>
		</td>

	</tr>
	<tr class="<?php echo $bg; ?>">
						<td  ><?=$row['wr_subject']?></td>
						<td><?=$row['wr_email']?></td>
						<?if($flg=='edu') {?>
						<td><?=$row['wr_8']?></td>
						<?}?>
						<td colspan="2"><?=$row['wr_content']?></td>
						<td colspan="2"><?=$row['wr_1']?></td>
						<td colspan="2"><?=$row['wr_2']?></td>
	</tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
<div class="btn_list01 btn_list">
<!--     <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value"> -->
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
</div>

</form>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?flg='.$flg.'&amp;sch_text='.$sch_text.'&amp;'.$qstr.'&amp;page='); ?>

<script>

	$(".uploadfile").change(function(){

        var id = $(this).attr("id");
        var form = $('#fileform'+id)[0];
        var wr_id  =$("#wr_id"+id).val();
        var flg  =$("#flg"+id).val();

        var formData = new FormData(form);
        formData.append("bf_file", $(this)[0].files[0]);
        formData.append("wr_id", wr_id);
        formData.append("flg", flg);

        // console.log(formData);
        // return false;

        $.ajax({
            url: './ajax.upload_wrfile.php',
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                dataType:"json",
                success: function(data){
                    if(data.result){
                        alert("업로드 되었습니다.");
                        location.reload();
                    }
                    else{
                        alert("업로드 실패했습니다. - "+data.error);
                    }
                }
            });
	});

	$("select[name='slc_state']").change(function(){

			var value = $(this).val();

			if(value == "3"){
                if(!confirm("정말로 환불 하시나요?\n이 작업은 취소할수 없습니다.")){
                    location.reload();
                    return false;
                }
            }

			var id = $(this).attr("id");
			id = id.split("_");
		$.ajax({
				url: "./ajax.chg_wrstate.php",
				type: "POST",
				data: {
						"value" : value,
						"id" : id[0],
						"flg" : '<?=$table?>'
				},
				success: function(data){
				    console.log(data);
				}
		});

	});

	$("select[name='slc_wr7']").change(function(){

		var wr_7 = $(this).val();
		var wr_id = $(this).attr("id");
		wr_id = wr_id.split("_");
		console.log(wr_id);

		$.ajax({
				url: "./ajax.chg_wr7state.php",
				type: "POST",
				data: {
						"value" : wr_7,
						"id" : wr_id[0],
						"table" : '<?=$table?>'
				},
				success: function(data){
					console.log(data);
				}
		});

	});

$("#chkall").change(function(){

	if($(this).is(":checked")){
			$("input:checkbox[name='chk[]']").prop("checked",true);
	}
	else{
			$("input:checkbox[name='chk[]']").prop("checked",false);
	}

});

// 신청현황 삭제
function del_file(table,wr_id){
    console.log(table,wr_id);

    if(!confirm("정말 삭제하시겠습니까?")){
        return false;
    }

    const data = HttpPostJson(g5_url+"/adm/ajax.table_file_delete.php",{
        table:table,
        wr_id:wr_id,
        mode:"delete",
    });

    console.log(data);
    if(data.result){
        alert("삭제가 완료되었습니다.");
        location.reload();
    }else{
        alert("잘못된 연결방식 입니다.");
    }

}

function fapplylist_submit(f){
		if(	$("input:checkbox[name='chk[]']:checked").length<=0){
			alert("한개이상 체크를 해야 합니다.");
			return false;
		}
		return true;
}




</script>


<?php
include_once ('./admin.tail.php');
?>


