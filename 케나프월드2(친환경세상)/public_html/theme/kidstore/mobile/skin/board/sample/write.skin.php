<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

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
	<input type="hidden" value="html1" name="html">
    <div class="row">
		<div class="col-xs-12 col-md-4 col-lg-4" style="margin-top:10px">
			<input type="text" name="wr_subject" required class="form-control" id="" placeholder="회사명">
		</div>
		<div class="col-xs-12 col-md-4 col-lg-4"  style="margin-top:10px">
				<input type="text" name="wr_1" required class="form-control" id="" placeholder="부서명">
		</div>
		<div class="col-xs-12 col-md-4 col-lg-4 " style="margin-top:10px">
				<input type="text" name="wr_name" required class="form-control" id="" placeholder="담당자 성명">
		</div>
		
		<div class="col-xs-12 col-md-12 col-lg-12 " style="margin-top:10px">
			<input type="text" name="wr_2" required class="form-control" id="" placeholder="전화번호">
		</div>
		<div class="col-xs-12 col-md-8 col-lg-8 " style="margin-top:10px">
				<input type="text" name="wr_content" required class="form-control" id="" placeholder="주소">
		</div>
		<div class="col-xs-12 col-md-4 col-lg-4 " style="margin-top:10px">
				<input type="text" name="wr_3" required class="form-control" id="" placeholder="우편번호">
		</div>

		<div class="col-xs-12 col-md-4 col-lg-4 " style="margin-top:10px">
				<input type="text" name="wr_4" required class="form-control" id="" placeholder="여직원수">
		</div>
		<div class="col-xs-12 col-md-8 col-lg-8 " style="margin-top:10px">
				<input type="text" name="wr_5" required class="form-control" id="" placeholder="유니폼번호 ex)RF-1907">
		</div>
	</div>

    <div class="btn_confirm" style="margin-top:20px;">
        <input type="submit" value="보내기" id="btn_submit" accesskey="s" class="btn_submit">
				<? if($is_admin){?>
				<a href="./board.php?bo_table=<?php echo $bo_table?>" class="btn_cancel">목록보기</a>
				<? }?>
       <?/* <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>*/?>
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
            alert("회사명에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("회사명에 금지단어('"+content+"')가 포함되어있습니다");
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
                    alert("주소는 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("주소는 "+char_max+"글자 이하로 쓰셔야 합니다.");
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