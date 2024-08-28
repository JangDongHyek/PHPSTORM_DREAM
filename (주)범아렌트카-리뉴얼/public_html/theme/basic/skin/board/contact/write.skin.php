<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
//중고차량 쿼리문
if($w==""){
	
}else{
	$f_wr_id=$view[wr_10];
}
$sql="select * from g5_write_rent_old_sch where wr_id='$f_wr_id'";
$row=sql_fetch($sql);

$sql="select bf_file from g5_board_file where bo_table='rent_old_sch' and wr_id='$f_wr_id' and bf_no='0'";
$row2=sql_fetch($sql);
$carImageUrl="<img src='".G5_DATA_URL."/file/rent_old_sch/".$row2[bf_file]."'>";
?>

<section id="bo_w">


	<div id="top_date_box">
		<div class="imgbox">
			<?php echo get_view_thumbnail($carImageUrl);?>
		</div>
		<div class="txtbox">
			<h3 class="bo_w_tit"><?=$row[wr_subject]?></h3>
			<ul>
				<li><span class="tit">배기량</span><span><?=$row[wr_5]?></span></li>
				<li><span class="tit">연료</span><span><?=$row[wr_6]?></span></li>
				<li><span class="tit">자차보험</span><span><?=$row[wr_7]?></span></li>
				<li class="btype"><span class="tit">보증금</span><span><?=number_format($row[wr_1])?> 원</span></li>
				<li class="ctype"><span class="tit">월 렌트료</span><span><?=number_format($row[wr_2])?> 원</span></li>
			</ul>
		</div>
	</div>


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
	<input type="hidden" name="wr_10" value="<?php echo $f_wr_id?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';

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
	<h4>견적신청</h4>
		<dl>
			<dt><label for="wr_subject">성명 및 회사명<strong class="sound_only">필수</strong></label></dt>
			<dd>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
                </div>
			</dd>
		</dl>

		<dl>
			<dt><label for="wr_phffrm_input frm_tel required wr_1_1">핸드폰</label></dt>
			<dd class="st_telVer">
				<input type="text" id="wr_1_1" name="wr_1[]" required="" class="frm_input frm_tel " maxlength="3" value="<?php echo $wr_1[0]?>">&nbsp;-&nbsp;
				<input type="text" id="wr_1_2" name="wr_1[]" required="" class="frm_input frm_tel " maxlength="4" value="<?php echo $wr_1[1]?>">&nbsp;-&nbsp;
				<input type="text" id="wr_1_3" name="wr_1[]" required="" class="frm_input frm_tel "  maxlength="4" value="<?php echo $wr_1[2]?>">
			</dd>
		</dl>

		<dl>
			<dt><label for="wr_2">신용카테고리</label></dt>
			<dd>
				<select name="wr_2" id="wr_2">
					<option value="신용 1~6등급"<?php echo $write[wr_2]=="신용 1~6등급"?" selected":"";?>>신용 1~6등급</option>
					<option value="신용 7~10등급"<?php echo $write[wr_2]=="신용 7~10등급"?" selected":"";?>>신용 7~10등급</option>
				</select>

			</dd>
		</dl>
		<dl>
			<dt><label for="wr_content">나이</label></dt>
			<dd>
				<select name="wr_content" id="wr_content">
					<option value="만 26세 이상"<?php echo $write[wr_content]=="만 26세 이상"?" selected":"";?>>만 26세 이상</option>
					<option value="만 26세 미만"<?php echo $write[wr_content]=="만 26세 미만"?" selected":"";?>>만 26세 미만</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>필요한 차종</dt>
			<dd><?=$row[wr_subject]?></dd>
		</dl>


<div class="btn_confirm">
	<input type="submit" value="견적문의" id="btn_submit" accesskey="s" class="btn_submit">
	<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
</div>


</div>





	<!-- NAVER SCRIPT -->
	<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
	<script type="text/javascript">
	var _nasa={};
	_nasa["cnv"] = wcs.cnv("5","1");
	</script>
	<!-- NAVER SCRIPT END-->
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