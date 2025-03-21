<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
   <h2 id="board_title"><?php echo $g5['title'] ?></h2> 
	
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
	
	<div id="area_write">
		<ul class="write_list">
			<?php if ($option) { ?>
			<li>
				<em>옵션</em>
				<div class="area_box"><?php echo $option ?></div>        
			</li>
			<?php } ?>
			<li>
				<em>제목</em>
				<div class="area_box">
					<div id="autosave_wrapper">
						<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
					</div>
				</div>        
			</li>
			<li>
				<em>사진첨부</em>
				<div class="area_box">
					<input type="file" name="bf_file[]" id="bf-file" onchange="setImage(event)" accept="image/*" style="display:none">
					<!-- 첨부사진 영역-->
					<div class="area_img" id="file-btn">
						<?php
						// 파일 출력
						$v_img_count = count($file);
						if($w=="u"){

							if($v_img_count) {


								for ($i=0; $i<=count($file); $i++) {
									if ($file[$i]['view']) {
										//echo $view['file'][$i]['view'];
										echo strip_tags(get_view_thumbnail($file[$i]['view']),"<img>");
									}
								}
							}
						}
						 ?>
						<!--<img src="<?php echo G5_THEME_IMG_URL?>/main/port01.jpg">-->
					</div>

					<!-- 이미지 첨부하면 나타나는 버튼 -->
					<button class="btn_delete" id="file-btn-remove" type="button" style="display:<?php echo $w == 'u' && $file[0]['file']?"":"none";?>">삭제</button>
					<?php if($w == 'u' && $file[0]['file']) { ?>
						<input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1" style="display:none"> 
					<?php } ?>
					<script type="text/javascript">
						//+눌렀을 때 파일 첨부하기
						document.querySelector("#file-btn").addEventListener("click",function(){
							$("#bf-file").click();
						});
						//삭제를 눌렀을 때 사진 없애기
						document.querySelector("#file-btn-remove").addEventListener("click",function(){
							$("#file-btn").html("");
							$("#file-btn-remove").css("display","none");
							var agent = navigator.userAgent.toLowerCase();
							if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ){
								// ie 일때 input[type=file] init.
								$("#bf-file").replaceWith( $("#bf-file").clone(true) );
							} else {
								//other browser 일때 input[type=file] init.
								$("#bf-file").val("");
							}
							$("#bf_file_del0").prop("checked",true);

						});
						//미리보기
						function setImage(event){
							var input=event.target;	
							var reader = new FileReader();
							reader.onload=function(event){
								/*var img = document.createElement("img");
								img.setAttribute("src",event.target.result);*/
								
								//var img = '<div class="view-class" id="view'+fileSu2+'"><div class="img-remove" onclick="imgRemove('+fileSu2+')">X</div><img src="'+event.target.result+'" style="width:100px;height:100px"></div>';
								$("#file-btn").html('<img src="'+event.target.result+'">');
								$("#file-btn-remove").css("display","");
								
							};
							reader.readAsDataURL(event.target.files[0]);
							
						}
					</script>
				</div>
			</li>
			<input type="hidden" name="wr_content" value=".."/>
			<!-- <li>
				<em>블루샥을 선택한 이유</em>
				<div class="area_box"><textarea name="wr_content" id="wr_content" required><?php echo $write[wr_content]?></textarea></div>
			</li>
			<li>
				<em>매장을 운영하면서 느낀 점</em>
				<div class="area_box"><textarea name="wr_1" id="wr_1" required><?php echo $write[wr_1]?></textarea></div>
			</li>
			<li>
				<em>예비 점주들에게 전하고 싶은 말</em>
				<div class="area_box"><textarea name="wr_2" id="wr_2" required><?php echo $write[wr_2]?></textarea></div>
			</li> -->
			<li>
				<em>유튜브 동영상 주소</em>
				<div class="area_box"><input type="text" name="wr_3" id="wr_3" class="frm_input" value="<?php echo $write[wr_3]?>"></div>
			</li>
		</ul>
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