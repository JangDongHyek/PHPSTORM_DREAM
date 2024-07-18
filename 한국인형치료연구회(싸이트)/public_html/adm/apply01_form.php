<?php
$sub_menu = "400100";
include_once('./_common.php');

	auth_check($auth[$sub_menu], 'w');

	
	$g5['title'] .= '교육 신청';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fapply01" id="fapply01" action="./insert_apply01.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="wr_4">
<input type="hidden" name="ca_name" >

<input type="hidden" name="mb_level" value="<?=$mb['mb_level']?>">
<?php for ($i=1; $i<=10; $i++) { ?>
<input type="hidden" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>">
<?php }?>


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>

    <tr>
        <th scope="row"><label for="mb_id">고객 아이디</label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" required class="frm_input required" size="30" >		
        </td>
        <th scope="row"><label for="wr_subject">이름</label></th>
        <td><input type="text" name="wr_subject" id="wr_subject"  class="frm_input required" required size="30" ></td>
    </tr>

	<tr>
        <th scope="row"><label for="wr_content">생년월일</label></th>
        <td>
            <input type="text" readonly name="wr_content"  id="wr_content" required class="frm_input required picker" size="30" >		
        </td>
        <th scope="row"><label for="wr_email">이메일</label></th>
        <td><input type="text" name="wr_email" id="wr_email"  class="frm_input required" required size="30" ></td>
    </tr>
	<tr>
        <th scope="row"><label for="wr_1">입금날짜</label></th>
        <td>
            <input type="text" readonly name="wr_1"  id="wr_1" required class="frm_input required picker" size="30" >		
        </td>
        <th scope="row"><label for="wr_2">입금자명</label></th>
        <td><input type="text" name="wr_2" id="wr_2"  class="frm_input required" required size="30" ></td>
    </tr>
	<tr>
        <th scope="row"><label for="search_edulist">교육명</label></th>
        <td>
            <input type="text" readonly name="search_edulist"  id="search_edulist" required class="frm_input required" size="30" >		
        </td>      
		   <th scope="row"></th>
        <td></td>
    </tr>

    </tbody>
    </table >
<a class="trigger" href="#" id="open_modal" style="display:none">모달</a>
</div> 
<br>
<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>


<script>

	$( document ).ready(function() {

	$('.trigger').on('click', function() {
		$('.modal_wrapper').toggleClass('open');
		return false;
	});

	

	$( ".picker" ).datepicker({
			dayNamesMin: ['일', '월','화', '수', '목', '금', '토'],
			 monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dateFormat: "yy-mm-dd",
			yearRange: 'c-100:c+10',
			changeMonth: true,
			changeYear: true,
		});	

	$("input:radio[name='edu_list']").change(function(){
		
			var arr_values = $(this).val().split('|');
			$("#wr_4").val(arr_values[0]);
			$("#ca_name").val(arr_values[2]);
			$("#search_edulist").val(arr_values[1]);
			

			//console.log(arr_values);
			
	});

	$('.trigger > a.close').click(function () {

	alert("tesT");
		
		return false;});
});

$("#search_edulist").focus(function(){

			$("#open_modal").click();

});
</script>



	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
	<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>


<script>

	$(function() {

		$( ".picker" ).datepicker({
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			 monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dateFormat: "yy-mm-dd",
			yearRange: 'c-30:c+30',
			changeMonth: true,
			changeYear: true,
		});	

	


	});

function fmember_submit(f)
{
	
	alert("준비중 입니다.");
    return false;
    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>

