<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/poll.lib.php');

//2018-08-21 배성현 : 야식 추가

if($w==""){
	$content = "메뉴";
	$wr_1 = $year."-".$month."-".$day;
	$wr_2 = "조 식";
}

$menu;
if($wr_2 == "조 식"){
	$menu = array("탕류", "추가");
}else if($wr_2 == "중 식"){
	$menu = array("한식", "일품", "쉐프", "음료", "샐러드");
}else if($wr_2 == "석 식"){
	$menu = array("한식 Or 일품", "한정 일품");
}else if($wr_2 == "야 식"){
	$menu = array("한식", "샌드위치","김밥");
}

set_session("ss_delete_token", $token = uniqid(time()));
$delete_href ='./delete.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;token='.$token.'&amp;page='.$page.urldecode($qstr);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
    <input type="hidden" name="wr_content" value="<?php echo $content ?>">
    <input type="hidden" name="year" value="<?php echo $year ?>">
    <input type="hidden" name="month" value="<?php echo $month ?>">
    <input type="hidden" name="day" value="<?php echo $day ?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
		<tr>
			<td colspan="2"> ※ 메뉴강조시, 리스트에 보여질 때 진하게 나타납니다.</td>
		</tr>

		<tr>
			<th scope="row">날짜</th>
			<td><input type="text" name="wr_1" value="<?php echo $wr_1 ?>" id="wr_1" required readonly class="frm_input required readonly" maxlength="255" style="width:120px;"></td>
		</tr>
		
		<tr>
			<th scope="row">조/중/석/야</th>
			<td>
				<select name="wr_2" id="wr_2" class="frm_input required" required>
					<option value="조 식" <?php if($wr_2=="조 식") echo "selected";?>>조 식</option>
					<option value="중 식" <?php if($wr_2=="중 식") echo "selected";?>>중 식</option>
					<option value="석 식" <?php if($wr_2=="석 식") echo "selected";?>>석 식</option>
					<option value="야 식" <?php if($wr_2=="야 식") echo "selected";?>>야 식</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<th scope="row">분류</th>
			<td>
				<select name="wr_3" id="wr_3" class="frm_input required" required>
					<?php for($i=0; $i<count($menu); $i++){ ?>
					<option value="<?php echo $menu[$i]?>" <?php if($wr_3 == $menu[$i]) echo "selected"; ?>><?php echo $menu[$i]?></option>
					<?php } ?>
				</select>
				<span id="wr_4span" style="display:<?php echo $wr_2!="중 식"?"none":""?>;">
				<input type="checkbox" name="wr_4" id="wr_4" value="1" <?php if($wr_4) echo "checked";?>> <label for="wr_4"> 직원식단 </label>
				</span>
			</td>
		</tr>

        <tr>
            <th scope="row"><label for="wr_subject">메인 메뉴 # 1<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
				<input type="checkbox" name="wr_5" id="wr_5" value="1" <?php if($wr_5) echo "checked";?>> <label for="wr_5">메뉴강조</label> 
			</td>
        </tr>

		<?php for($i=6; $i<=16; $i++){ ?>
		<tr>
			<th scope="row">메뉴 # <?php echo $i/2-2?></th>
			<td>
				<input type="text" name="wr_<?php echo $i?>" value="<?php echo ${"wr_".$i} ?>" id="wr_<?php echo $i?>" class="frm_input" maxlength="255">
				<?php $i++; ?>
				<input type="checkbox" name="wr_<?php echo $i?>" id="wr_<?php echo $i?>" value="1" <?php if(${"wr_".$i}) echo "checked";?>> <label for="wr_<?php echo $i?>">메뉴강조</label> 
			</td>
		</tr>
		<?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="#" onclick="self.close(); return false;" class="btn_cancel">닫기</a>
		<?php if($w=="u"){ ?>
		<a href="<?php echo $delete_href?>" class="btn_cancel" onclick="if(confirm('해당 메뉴를 삭제하시겠습니까?')==false) return false; return true;">삭제</a>
		<?php } ?>
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
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

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

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

		
		
        return true;
    }
	
	$( "#wr_1" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		showMonthAfterYear: true,
		showButtonPanel: true,
		dayNamesShort: [ "일", "월", "화", "수", "목", "금", "토" ] ,
		monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
		monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ]
	});

	$("#wr_2").change(function (){
		var meal = $(this).val();
		$("#wr_3 option").remove();
		var menu;
		
		if(meal=="조 식"){
			menu = new Array("탕류", "추가");
			$("#wr_4span").css("display", "none");
		}else if(meal=="중 식"){
			menu = new Array("한식", "일품", "쉐프", "음료", "샐러드");
			$("#wr_4span").css("display", "");
		}else if(meal=="석 식"){
			menu = new Array("한식 Or 일품", "한정 일품");
			$("#wr_4span").css("display", "none");
		}else if(meal=="야 식"){
			menu = new Array("한식", "샌드위치", "김밥");
			$("#wr_4span").css("display", "none");
		}
		
		for(var i=0; i< menu.length; i++){
			$("#wr_3").append("<option value='"+menu[i]+"'>"+menu[i]+"</option>");
		}
	});
	
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->