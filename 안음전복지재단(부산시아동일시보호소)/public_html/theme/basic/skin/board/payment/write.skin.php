<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<!--<script src="/theme/basic/skin/board/payment/jquery-1.8.3.min.js"></script>-->
<link href="/theme/basic/skin/board/payment/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
 $(function(){
  $.datepicker.regional['ko'] = {
  closeText: '닫기',
  prevText: '이전달',
  nextText: '다음달',
  currentText: '오늘',
  monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
  '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
  monthNamesShort: ['1월','2월','3월','4월','5월','6월',
  '7월','8월','9월','10월','11월','12월'],
  dayNames: ['일','월','화','수','목','금','토'],
  dayNamesShort: ['일','월','화','수','목','금','토'],
  dayNamesMin: ['일','월','화','수','목','금','토'],
  weekHeader: 'Wk',
  dateFormat: 'yy-mm-dd',
  firstDay: 0,
  isRTL: false,
  showMonthAfterYear: true,
  yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['ko']);

 

  $('#wr_1').datepicker({ 
   showOn: 'button',
   buttonImage: '/theme/basic/skin/board/payment/mon_icon.gif', //이미지 url
   buttonImageOnly: true,
   buttonText: "달력",
   changeMonth: true,
   changeYear: true,
   showButtonPanel: true
  });

 });
</script>
<style>
.ui-datepicker-trigger {
	vertical-align:middle;
}
</style>
<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

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
       <input type="hidden" name="wr_content" value="..">
       <input type="hidden" name="wr_name" value="..">
<?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
         <tr>
            <th scope="row"><label for="wr_name">날짜<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_1" value="<?php echo $wr_1 ?>" id="wr_1" required class="frm_input required"></td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_name">불자명<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_2" value="<?php echo $wr_2 ?>" id="wr_2" required class="frm_input required"></td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_name">불사<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required"></td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_name">링크주소<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3" required class="frm_input required" ></td>
        </tr>
		<?
		$wr_4_ex = explode("-",$wr_4);
		?>
        <tr>
            <th scope="row"><label for="wr_name">핸드폰<strong class="sound_only"> 필수</strong></label></th>
            <td>
            <input type="text" name="wr_4_1" value="<?php echo $wr_4_ex[0] ?>" id="wr_4_1" required class="frm_input required phone"> -
            <input type="text" name="wr_4_2" value="<?php echo $wr_4_ex[1] ?>" id="wr_4_2" required class="frm_input required phone"> -
            <input type="text" name="wr_4_3" value="<?php echo $wr_4_ex[2] ?>" id="wr_4_3" required class="frm_input required phone">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_name">기부금액<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_5" value="<?php echo $wr_5 ?>" id="wr_5" required class="frm_input required"></td>
        </tr>
        <tr>
            <th scope="row"><label for="wr_name">등·위패 위치<strong class="sound_only"> 필수</strong></label></th>
            <td><input type="text" name="wr_6" value="<?php echo $wr_6 ?>" id="wr_6" required class="frm_input required"></td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_name">영수증<strong class="sound_only"> 필수</strong></label></th>
            <td>
			<select name="wr_7">
				<option value="발행" <?if(!$wr_7 || $wr_7 == "발행"){echo"selected";}?>>발행</option>
				<option value="미발행" <?if($wr_7 == "미발행"){echo"selected";}?>>미발행</option>
			</select>
			</td>
        </tr>




        
        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
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
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->