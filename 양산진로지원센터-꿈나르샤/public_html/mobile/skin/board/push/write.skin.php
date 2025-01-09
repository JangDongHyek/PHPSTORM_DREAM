<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<script>
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
		changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
		changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
        yearSuffix: '년'
    });

    $(function() {
        $("#wr_3,#wr_6").datepicker();
    });

</script>
<section id="bo_w">
   

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
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
   

<div style="padding:6px; background-color:#f7f7f7; border-radius:4px; line-height:18px; border:1px solid #e4eaec; letter-spacing:0px; width:90%; margin:0 auto; margin-top:10px; margin-bottom:10px">
저희 센터에서는 개최되는 프로그램 및 다양한 행사 등의 내용을 문자,이메일로 보내드리는 서비스를 운영 중입니다.<br />
서비스를 받기를 원하시는 분께서는 다음 내용을 확인하시고 신청하여 주십시오.<br />
※ 신청하신 개인 정보는 센터 행사 알림으로만 이용되며, 비공개 보호됨을 알려드립니다.
</div>



    <div class="tbl_frm01 tbl_wrap">
         <div class="bbs-title">◎ 개인정보 수집 및 이용동의</div><br/>
	   <div style="width:100%;font-size:12px; text-align:left; line-height:30px;">
	   <textarea readonly style="color:#545454"> 1. 목적 : 양산진로지원센터 행사 안내
 2. 항목 : 성명, 휴대전화번호, 거주지, 생년월일
 3. 기간 : 서비스 해제 요청 시
 4. 개인정보 수집 및 이용에 동의하시지 않는 경우 문자 서비스가 되지 않습니다.</textarea></div>
		<div>
		
				<input type="checkbox" name="agree" id="agree" value="1" style="margin:10px 0;"> <label for="agree"> 개인정보 수집 이용에 동의합니다.</label></div>
				
				
			<table>
				<tbody>
					<tr>
						<th colspan="2">학부모 정보<span style="color:#00a56b">(필수)</span></th>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">성명</th>
						<td><input type="text" name="wr_name" value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">휴대폰</th>
						<td><input type="tel" name="wr_subject" value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">거주동</th>
						<td><input type="text" name="wr_content" value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th colspan="2">자녀1 정보<span style="color:#00a56b">(필수)</span></th>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">성명</th>
						<td><input type="text" name="wr_1" value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">학교</th>
						<td><input type="text" name="wr_2" value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">생년월일</th>
						<td><input type="text" name="wr_3" id="wr_3" readonly value="" class="frm_input required" required></td>
					</tr>
					<tr>
						<th colspan="2">자녀2 정보<span style="color:#00a56b">(선택)</span></th>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">성명</th>
						<td><input type="text" name="wr_4" value="" class="frm_input"></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">학교</th>
						<td><input type="text" name="wr_5" value="" class="frm_input"></td>
					</tr>
					<tr>
						<th bgcolor="f9f9f9">생년월일</th>
						<td><input type="text" name="wr_6" id="wr_6" readonly value="" class="frm_input"></td>
					</tr>
				</tbody>
		  </table>
		</div>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
		<? if($member[mb_level]=="10"){?>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록보기</a>
		<? }else{?>
		<? }?>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
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
		if($("#agree").prop("checked")==false){
			alert("개인정보 수집 이용에 동의하십시오");
			return false;
		}

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
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->