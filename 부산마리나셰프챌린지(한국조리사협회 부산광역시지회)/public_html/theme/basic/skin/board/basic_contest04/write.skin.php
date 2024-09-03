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
	<input type="hidden" name="wr_subject" value="<?=$write['wr_subject']?>">
	<input type="hidden" name="wr_content" value="라이브 단체경연 신청서">
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

	<div class="contest_title">
		<p>부산마리나셰프챌린지 2024 <br>
	BUSAN MARINA CHEF CALLENGE 2024</p>
		<h1>라이브 카빙 경연 신청서 </h1>
		<h2>Live Carving Contest Application</h2>
	</div>
	<!--신청서start-->
	<div class="btn_bg">
        <a href="<?php echo G5_THEME_URL ?>/dawnload/2024마리나 1인라이브, 전시 참가신청서 (워드).docx">
            <div class="btn btn-info">참가신청서 다운로드.docx</div>
        </a>
        <a href="<?php echo G5_THEME_URL ?>/dawnload/2024마리나 1인, 라이브, 전시 참가 신청서 (한글).hwp">
            <div class="btn btn-info">참가신청서 다운로드.hwp</div>
        </a>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="contest_table">
	  <tbody>
		<tr>
		  <th rowspan="2" width="14%">구분<br>(division)</th>
		  <th colspan="2" width="30%">이름<br>(NAME)</th>
		  <th rowspan="2" width="14%">생년월일<br>
	(Date of birth, <br>
	birth date)</th>
		  <th rowspan="2" width="14%">휴대전화<br>
	(Cell Phone)</th>
		  <th rowspan="2" width="14%">이메일<br>
	(E-mail)</th>
		  <th rowspan="2" width="14%">소속<br>
	 (Occuption/Work)</th>
		</tr>
		<tr>
		  <th width="15%" class="table_color">한글</th>
		  <th width="15%" class="table_color">English</th>
		</tr>
		<tr>
		  <th rowspan="2">셰프1 (Chef1)</th>
		  <td><input type="text" class="form-control" name="wr_name" value="<?=$write['wr_name']?>" required></td><!-- 국문이름 -->
		  <td><input type="text" class="form-control" name="wr_1" value="<?=$write['wr_1']?>"></td><!-- 영문이름 -->
		  <td><input type="text" class="form-control" name="wr_2" value="<?=$write['wr_2']?>"></td><!-- 생년월일 -->
		  <td><input type="text" class="form-control" name="wr_3" value="<?=$write['wr_3']?>" required></td><!-- 휴대전화 -->
		  <td><input type="text" class="form-control email" name="wr_email" value="<?=$write['wr_email']?>"></td><!-- 이메일 -->
		  <td><input type="text" class="form-control" name="wr_4" value="<?=$write['wr_4']?>"></td><!-- 소속 -->
		</tr>
		
<!-- 
		<tr>
		  <th>셰프2 (Chef2)</th>
		  <td><input type="text" class="form-control" name="wr_7" value="<?=$write['wr_7']?>"></td>
		  <td><input type="text" class="form-control" name="wr_8" value="<?=$write['wr_8']?>"></td>
		  <td><input type="text" class="form-control" name="wr_9" value="<?=$write['wr_9']?>"></td>
		  <td><input type="text" class="form-control" name="wr_10" value="<?=$write['wr_10']?>"></td>
		  <td><input type="text" class="form-control" name="wr_11" value="<?=$write['wr_11']?>"></td>
		  <td><input type="text" class="form-control" name="wr_12" value="<?=$write['wr_12']?>"></td>
		</tr>
        

		<tr>
		  <th>셰프2 (Chef2)</th>
		  <td><input type="text" class="form-control" name="wr_13" value="<?=$write['wr_13']?>"></td>
		  <td><input type="text" class="form-control" name="wr_14" value="<?=$write['wr_14']?>"></td>
		  <td><input type="text" class="form-control" name="wr_15" value="<?=$write['wr_15']?>"></td>
		  <td><input type="text" class="form-control" name="wr_16" value="<?=$write['wr_16']?>"></td>
		  <td><input type="text" class="form-control" name="wr_17" value="<?=$write['wr_17']?>"></td>
		  <td><input type="text" class="form-control" name="wr_18" value="<?=$write['wr_18']?>"></td>
		</tr>
		<tr>
		  <th>셰프3 (Chef3)</th>
		  <td><input type="text" class="form-control" name="wr_19" value="<?=$write['wr_19']?>"></td>
		  <td><input type="text" class="form-control" name="wr_20" value="<?=$write['wr_20']?>"></td>
		  <td><input type="text" class="form-control" name="wr_21" value="<?=$write['wr_21']?>"></td>
		  <td><input type="text" class="form-control" name="wr_22" value="<?=$write['wr_22']?>"></td>
		  <td><input type="text" class="form-control" name="wr_23" value="<?=$write['wr_23']?>"></td>
		  <td><input type="text" class="form-control" name="wr_24" value="<?=$write['wr_24']?>"></td>
		</tr>
		-->
		<tr>
		  <th class="table_color">팩스(Fax)</th>
		  <td colspan="2"><input type="text" class="form-control" name="wr_5" value="<?=$write['wr_5']?>"></td>
		  <th class="table_color">주소(Address)</th>
		  <td colspan="2"><input type="text" class="form-control" name="wr_6" value="<?=$write['wr_6']?>"></td>
		</tr>
        
		<!-- <tr>
		  <th>셰프2 (Chef2)</th>
		  <td><input type="text" class="form-control" name="wr_7" value="<?=$write['wr_7']?>"></td>
		  <td><input type="text" class="form-control" name="wr_8" value="<?=$write['wr_8']?>"></td>
		  <td><input type="text" class="form-control" name="wr_9" value="<?=$write['wr_9']?>"></td>
		  <td><input type="text" class="form-control" name="wr_10" value="<?=$write['wr_10']?>"></td>
		  <td><input type="text" class="form-control" name="wr_11" value="<?=$write['wr_11']?>"></td>
		  <td><input type="text" class="form-control" name="wr_12" value="<?=$write['wr_12']?>"></td>
		</tr> -->
		<?if(!$w){?>
		<?php if ($is_password) { ?>
		<tr>
			<th>비밀번호</th>
			<td colspan="6" style="text-align:left;">				
				<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20">
				(신청서 확인 및 수정시 필요합니다.)
			</td>
		</tr>
		<?}?>
		<?}?>
		<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th>첨부파일</th>
            <td colspan="6" style="text-align:left;">
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
	  </tbody>
	</table>
	</div>
	
	<!--
	<div class="contest_title">
		<h1>라이브카빙 경연 (Food Carving)</h1>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cha_table">
	  <tbody>
		<tr>
		  <th width="20%">전시</th>
		  <th width="10%">종목번호</th>
		  <th width="60%">종목 명칭</th>
	    </tr>
		<tr>
		  <th rowspan="4">카빙경연</th>
		  <td rowspan="4">Class 9</td>
		  <td>수박 1개, 호박 1개, 작은 조각을 위해 당근과 무를 사용 </td>
	    </tr>
		<tr>
		  <td>높이 60cn ~ 최대 120cm 기지 포함 </td>
	    </tr>
		<tr>
		  <td rowspan="2">경연자는 테이블 90cm X 75cm 위에 전시물을 조립하며, 주어진 시간은 3시간이다. </td>
	    </tr>
		<tr>	    </tr>
	  </tbody>
	</table>	
    <br />
	-->
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cha_table">
	  <tbody>
		<tr>
		  <th width="30%">카빙 라이브</th>
		  <th width="10%">종목번호</th>
		  <th width="50%">종목 명칭</th>
		  <th width="10%">참가희망종목</th>
		</tr>
		<tr>
		  <th>Food Carving</th>
		  <td>Class 16</td>
		  <td>Food Carving</td>
		  <td><div class="checkbox">
		<label>
		  <input type="checkbox" name="wr_13" id="" value="1" <?if($write['']){echo "checked";}?>>
		</label>
	  </div></td>
		</tr>
		<!-- <tr>
		  <th rowspan="2">Ice Caving</th>
		  <td>Class 11</td>
		  <td>Ice Caving<br />개인</td>
		  <td><div class="checkbox">
		<label>
		  <input type="checkbox" name="wr_14" id="" value="1" <?if($write['']){echo "checked";}?>>
		</label>
			  </div></td>
		</tr> -->
		<!-- <tr>
		  <th >Ice Caving</th>
		  <td>Class 12</td>
		  <td>Ice Caving<br />2인1조</td>
		  <td><div class="checkbox">
		<label>
		  <input type="checkbox" name="wr_15" id="" value="1" <?if($write['']){echo "checked";}?>>
		</label>
			  </div></td>
		</tr> -->
		<!-- <tr>
		  <td>Class 12</td>
		  <td>Ice Caving<br />2인1조</td>
		  <td><div class="checkbox">
		<label>
		  <input type="checkbox" name="wr_15" id="" value="1" <?if($write['']){echo "checked";}?>>
		</label>
			  </div></td>
		</tr> -->
		
	  </tbody>
	</table>
	
	
	<?if(!$w){?>
<div class="border">
    	<div class="scroll">
        <h2>[부산마리나셰프챌린지 서비스 이용 필수정보 수집동의]</h2>
        부산마리나셰프챌린지사무국은 신청서를 진행함에 있어 다음의 이용정보를 수집, 이용하게 됩니다. 따라서 부산마리나셰프챌린지 사무국은 [개인정보보호법]에 따라 법률 사무 절차를 진행함에 있어 필수적인 신청자의 식별정보를 다음과 같이 수집하고자 합니다.
		<br><br>
        <p>▶ 개인정보 수집, 이용 목적</p>
        
        신청서, 질의응답
        <br><br>         
        <p>▶ 수집, 이용할 개인정보의 내용</p>
           - 신청자의 성함<br>
           - 신청자의 소속<br>
           - 신청자의 생년월일<br>
           - 신청자의 주소<br>
           - 신정자의 전자우편<br>
        <br>
        <p>▶ 개인정보의 보유 이용시간</p>
           - 수집, 이용, 동의일로부터 계약상의 목절 달성 시점까지(단, 목적달성, 거래종료후 5년이<br>
             경과한 후에는 민원처리, 법령상의무이행을 위한 경우에 한하여 보유. 이용하며 별도 보관함)
        </div>
    </div>
	<div class="border">
    <p>* <strong>경연일정: 2024년 10월 4일(금) ~ 6일(일)</strong>  (Contest schedule: 2023. SEP. 1. (Fri.) - SEP. 3. (Sun.))</p>
	<p>* <strong>등 록 비 : 50,000원(1인)</strong>(Registration fee : 50,000won)</p>
	<p>* <strong>참가신청서와 함께 참가등록비가 입금해야만 등록이 인정됨</strong>
	  (Registration must be made and payment must be made before registration)</p>
	<p>* <strong>참가규정을 읽었으며 이에 전적으로 동의함</strong>(I have read and agree to the rules of participation)
	  </div>
	</p>
		<div class="checkbox">
		<label>
		  <input type="checkbox" name="agree1" value="1" id="agree1"> <span class="red">위 항목 모두 동의합니다.</span>
		</label>
        </div>
	<?}?>
	<!--신청서end-->

	<br />

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
		<!--?if($is_admin){?-->
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">목록</a>    
		<!--?}?-->
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
		if (!f.agree1.checked) {
            alert("참가규정 내용에 동의하셔야 신청하실 수 있습니다.");
            f.agree1.focus();
            return false;
        }

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

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->