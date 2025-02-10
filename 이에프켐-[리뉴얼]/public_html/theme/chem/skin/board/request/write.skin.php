<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
if($w==""){
	$subject="제품문의";
}
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
$wr_5Array=array(
"Pentaerythritol",
"Di-Pentaerythritol",
"Ammonium polyphosphate",
"Aramid pulp",
"high-temperature specialty fiber",
"Carbon Fiber",
"Al Paste",
"Kronos Products",
"Lolotint-LM",
"Talc",
"Graphtol Red F3RK",
"CY Green 7",
"Ultra blue EP-62",
"Products of EGE KIMYA (Turkey)",
"Cs2CO3 (Cesium Carbonate)",
"Sodium p-styrenesulfonate",
"TPO",
"(Diphenyl(2,4,6-trimethylbenzoyl)phosphine oxide)",
"Terpene Phenolic Resin",
"Intumescent Epoxy Resin (YD-128)",
"Epoxy Intumescent Curing Agent",
"Polyvinyl butyral resins",
"Soya-Lecithin",
"Soybean fatty acid",
"Linseed oil fatty acid",
"C9",
"Chloride Rubber",
"DMP-30 (2,4,6-Tris(dimethylaminomethyl)phenol)",
"Top coat",
"Tie coat",
"Primer");
$wr_6Array=array("FOB","CIF","EXW","CFR","기타");

?>
<script type="text/javascript">
	$(function(){
		$("input[name=wr_1]").bind("click",function(){

			var isCheck=$(this).prop("checked");
			var isIndex=$(this).index();
			if(isIndex=="0"){
				$("#product-form").css("display","");
			}else{
				$("#product-form").css("display","none");
			}
		});
	});
</script>

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
		<input type="hidden" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" maxlength="255">
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
           <col style="width:20%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
				<tr>
					<th colspan="2" align="center" class="top">
						<div class="lef"><input type="radio" name="wr_1" value="견적/샘플요청" <? echo $write[wr_1]=="견적/샘플요청"||$w==""?" checked":"";?>>견적/샘플요청 <span class="en">Quotation/Sample</span></div>
						<? /*
						<div class="lef"><input type="radio" name="wr_1" value="제품/기술문의" <? echo $write[wr_1]=="제품/기술문의"?" checked":"";?>>제품/기술문의 <span class="en">Product/Technical Inquiry</span></div>
						<div class="lef"><input type="radio" name="wr_1" value="파트너쉽 문의" <? echo $write[wr_1]=="파트너쉽 문의"?" checked":"";?>>파트너쉽 문의 <span class="en">Partnership Inquiry</span></div>
						*/ ?>
					</th>
				</tr>
        <tr>
            <th scope="row"><label for="wr_name">이름 <span class="en">Company Name</span><strong class="sound_only">필수</strong></label></th>
            <td><input type="text" oninput="validateInput(this)" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
				<tr>
            <th scope="row"><label for="wr_2">휴대폰번호 <span class="en">Tel</span></label></th>
            <td><input type="text" oninput="validateNumber(this)" name="wr_2" value="<?php echo $write[wr_2] ?>" id="wr_2" class="frm_input"></td>
        </tr>
				<tr>
            <th scope="row"><label for="wr_email">이메일 <span class="en">E-mail</span></label></th>
            <td><input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"></td>
        </tr>
      
				</tbody>
				<tbody id="product-form" style="display:<? echo $w==""||$write[wr_1]=="견적/샘플요청"?"":"none";?>">
				
				<tr>
            <th scope="row"><label for="wr_5">제품 <span class="en">Product</span></label></th>
            <td>
                <input type="text" name="wr_5" value="<?php echo $_GET['wr_1'] ?>" id="wr_5" class="frm_input">
            </td>
        </tr>
				<tr>
            <th scope="row"><label for="wr_4">수량 <span class="en">Quantity</span></label></th>
            <td><input type="number" name="wr_4" value="<?php echo $write[wr_4] ?>" id="wr_4" class="frm_input"></td>
        </tr>
				<!--<tr>
            <th scope="row"><label for="wr_6">가격조건</label></th>
            <td>
							<select name="wr_6">
								<option value="">가격조건</option>
								<? for($i=0;$i<count($wr_6Array);$i++){?>
								<option value="<?=$wr_6Array[$i]?>"<? echo $wr_6Array[$i]==$write[wr_6]?" selected":"";?>><?=$wr_6Array[$i]?></option>
								<? }?>
							</select>
						</td>
        </tr>-->
        <tr>
            <th scope="row"><label for="wr_7">기타 <span class="en">Etc.</span></label></th>
            <td><input type="text" name="wr_7" value="<?php echo $write[wr_7] ?>" id="wr_7" class="frm_input"></td>
        </tr>
				</tbody>
				<tbody>
        

        
        <tr>
            <th scope="row"><label for="wr_content">내용 <span class="en">Content</span><strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

        

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_orderby) { ?>
        <tr>
            <th scope="row"><label for="wr_orderby">우선순위</label></th>
            <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="Submit 작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="javascript:;" onclick="history.back();" class="btn_cancel">Cancel 취소</a>
				<? if($is_admin){?>
				<input type="button" onclick="location.href='./board.php?bo_table=<?=$bo_table?>'" class="btn_submit" style="color:#fff" value="List 목록보기">
				<? }?>
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
        function validateInput(input) {
            input.value = input.value.replace(/[^a-zA-Z가-힣ㄱ-ㅎㅏ-ㅣ]/g, ''); // 영문, 한글(초성/중성 포함) 외 삭제
        }

        function validateNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, ''); // 숫자(0-9) 외 삭제
        }

        function isValidEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }

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
				if(f.wr_name.value.length<2){
					alert("이름을 입력하세요");
					f.wr_name.focus();
					return false;
				}
				if(f.wr_2.value.length<10){
					alert("휴대폰번호 자릿수가 맞지 않습니다.");
					f.wr_2.focus();
					return false;
				}

				if(!isValidEmail(f.wr_email.value)) {
				    alert("이메일 형식이 맞지않습니다");
				    return false;
                }



				if($("#product-form").css("display")!="none"){
					if(f.wr_4.value==""){
						alert("수량을 입력하세요");
						f.wr_4.focus();
						return false;
					}
					if(f.wr_5.value==""){
						alert("제품을 선택하세요");
						return false;
					}
					if(f.wr_6.value==""){
						alert("가격조건을 선택하세요");
						return false;
					}
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