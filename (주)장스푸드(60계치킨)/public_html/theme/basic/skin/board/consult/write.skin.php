<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//is_member($is_member);//로그인여부확인

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

//$wr_1Arr=array("서울","경기","강원","충북","충남","전북","전남","경북","경남","제주","인천","대구","대전","울산","포항","부산");
$wr_1Arr = $sct_wr_1;

// 24-06-13 문자인증 보안을위해 페이지 들어올때마다 시큐코드 변경
$_SESSION["secu_code"] = uniqid().str_pad(rand(0, 99), 2, "0", STR_PAD_LEFT);
?>
<style>
#bo_w #wr_1, #bo_w #wr_2 {width: 30%; float: left;}
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
	<input type="hidden" name="wr_password" id="wr_password" value="1234">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            //$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                //$option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
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

	<div class="tbl_wrap">
		<div class="cf line">
			<div class="frm_title">연락처</div>
			
			<div class="phone_certi_wrap">
                <div id="certi_wrap01">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input" maxlength="255"
                       onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="숫자만 입력">
                    <button type="button" class="frm_input certi_ready" onclick="postCert()" id="certBtn">인증번호 받기</button>
                </div>
                <div style="display: none" id="certDiv">
                    <input type="text" name="certVal" value="" id="certVal" class="frm_input" maxlength="255" placeholder="인증번호 입력">
                    <button type="button" class="frm_input certi_ok" onclick="checkCert()">인증번호 확인</button>
                </div>
            </div>
		</div>

        <script>
            var certPostBool = false;
            var certCheck = false;
            var secu_code = "<?=$_SESSION['secu_code']?>";

            function checkCert() {
                if($("#certVal").val() == "") {
                    alert("인증번호를 입력해주세요.");
                    return false;
                }

                if(certCheck) {
                    alert("이미 인증이 완료되었습니다.");
                    return false;
                }

                $.ajax({
                    url : "bbs_cert_api.php",
                    method : "post",
                    enctype : "multipart/form-data",
                    async : false,
                    cache : false,
                    data : {
                        "_method" : "get",
                        "num" : $("#certVal").val()
                    },
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            alert("확인되었습니다.");
                            certCheck = true;
                            console.log(res);
                        }
                    }
                });
            }

            function postCert() {
                if($("#wr_subject").val() == "") {
                    alert("휴대폰번호를 입력해주세요.");
                    return false;
                }
                if(certPostBool) {
                    return false;
                }
                certPostBool = true;

                $.ajax({
                    url : "bbs_cert_api.php",
                    method : "post",
                    enctype : "multipart/form-data",
                    async : false,
                    cache : false,
                    data : {
                        "_method" : "post",
                        "mb_hp" : $("#wr_subject").val(),
                        "secu_code" : secu_code
                    },
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            alert("인증번호를 발송했습니다.\n10분이내로 인증번호를 입력하세요.")
                            $("#wr_subject").prop("readonly",true);
                            $("#certDiv").show();
                            $("#my_id").attr("disabled", true);
                            $("#certi_wrap01").css("opacity","0.5");
                        }
                    }
                });


            }
        </script>

		<?php if ($is_name) { ?>
		<div class="cf line">
			<div class="frm_title">이름</div>
			<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input" maxlength="20">
		</div>
		<?php } ?>

		<div class="cf line">
			<div class="frm_title">성별</div>
			<select name="wr_14" id="wr_14" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_14);$i++){?>
				<option value="<?=$cst_wr_14[$i]?>"<?php echo $cst_wr_14[$i]==$write['wr_14']?" selected":"";?>><?=$cst_wr_14[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="cf line">
			<div class="frm_title">연령대</div>
			<select name="wr_13" id="wr_13" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_13);$i++){?>
				<option value="<?=$cst_wr_13[$i]?>"<?php echo $cst_wr_13[$i]==$write['wr_13']?" selected":"";?>><?=$cst_wr_13[$i]?></option>
				<?php }?>
			</select>
		</div>
		
		<div class="cf line">
			<div class="frm_title">개설희망지역</div>
			<select name="wr_1" id="wr_1" class="frm_input" required>
				<option value="">1차</option>
				<?php for($i=0;$i<count($wr_1Arr);$i++){?>
				<option value="<?=$wr_1Arr[$i]?>"<?php echo $wr_1Arr[$i]==$write[wr_1]?" selected":"";?>><?=$wr_1Arr[$i]?></option>
				<?php }?>
			</select>

			<select name="wr_2" id="wr_2" class="frm_input" style="margin-left: 5px;">
				<option value="">2차</option>
			</select>
			
		</div>

		<div class="cf line">
			<div class="frm_title">문의경로</div>
			<select name="wr_3" id="wr_3" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_3);$i++){?>
				<option value="<?=$cst_wr_3[$i]?>"<?php echo $cst_wr_3[$i]==$write['wr_3']?" selected":"";?>><?=$cst_wr_3[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="cf line">
			<div class="frm_title">운영주체</div>
			<select name="wr_4" id="wr_4" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_4);$i++){?>
				<option value="<?=$cst_wr_4[$i]?>"<?php echo $cst_wr_4[$i]==$write['wr_4']?" selected":"";?>><?=$cst_wr_4[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="cf line">
			<div class="frm_title">인원조달 계획</div>
			<select name="wr_15" id="wr_15" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_15);$i++){?>
				<option value="<?=$cst_wr_15[$i]?>"<?php echo $cst_wr_15[$i]==$write['wr_15']?" selected":"";?>><?=$cst_wr_15[$i]?></option>
				<?php }?>
			</select>
		</div>

		<!--
		<div class="cf line">
			<div class="frm_title">문의자주변 60계운영</div>
			<select name="wr_5" id="wr_5" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_5);$i++){?>
				<option value="<?=$cst_wr_5[$i]?>"<?php echo $cst_wr_5[$i]==$write['wr_5']?" selected":"";?>><?=$cst_wr_5[$i]?></option>
				<?php }?>
			</select>
		</div>

		<?
		$wr_6_css = (!empty($write['wr_5']) && $write['wr_5'] != "없음")? "" : "display:none;";
		?>
		<div class="cf line" style="<?=$wr_6_css?>">
			<div class="frm_title">지인 운영 매장명</div>
			<input type="text" name="wr_6" value="<?=$write['wr_6']?>" id="wr_6" class="frm_input" maxlength="50">
		</div>

		<div class="cf line">
			<div class="frm_title">희망 순이익</div>
			<input type="text" name="wr_7" value="<?=$write['wr_7']?>" id="wr_7" class="frm_input" maxlength="50" required>
		</div>
		-->

		<div class="cf line">
			<div class="frm_title">창업예상비용</div>
			<select name="wr_8" id="wr_8" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_8);$i++){?>
				<option value="<?=$cst_wr_8[$i]?>"<?php echo $cst_wr_8[$i]==$write['wr_8']?" selected":"";?>><?=$cst_wr_8[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="cf line">
			<div class="frm_title">창업비용출처</div>
			<select name="wr_9" id="wr_9" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_9);$i++){?>
				<option value="<?=$cst_wr_9[$i]?>"<?php echo $cst_wr_9[$i]==$write['wr_9']?" selected":"";?>><?=$cst_wr_9[$i]?></option>
				<?php }?>
			</select>
		</div>
		
		<div class="cf line">
			<div class="frm_title">창업경험</div>
			<select name="wr_10" id="wr_10" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_10);$i++){?>
				<option value="<?=$cst_wr_10[$i]?>"<?php echo $cst_wr_10[$i]==$write['wr_10']?" selected":"";?>><?=$cst_wr_10[$i]?></option>
				<?php }?>
			</select>
		</div>
		<div class="cf line">
			<div class="frm_title">점포유무</div>
			<select name="wr_16" id="wr_16" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_16);$i++){?>
				<option value="<?=$cst_wr_16[$i]?>"<?php echo $cst_wr_16[$i]==$write['wr_16']?" selected":"";?>><?=$cst_wr_16[$i]?></option>
				<?php }?>
			</select>
		</div>
		<div class="cf line">
			<div class="frm_title">창업예상시기</div>
			<select name="wr_11" id="wr_11" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_11);$i++){?>
				<option value="<?=$cst_wr_11[$i]?>"<?php echo $cst_wr_11[$i]==$write['wr_11']?" selected":"";?>><?=$cst_wr_11[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="cf line">
			<div class="frm_title">양도인수희망</div>
			<select name="wr_12" id="wr_12" class="frm_input" required>
				<option value="">선택하세요</option>
				<?php for($i=0;$i<count($cst_wr_12);$i++){?>
				<option value="<?=$cst_wr_12[$i]?>"<?php echo $cst_wr_12[$i]==$write['wr_12']?" selected":"";?>><?=$cst_wr_12[$i]?></option>
				<?php }?>
			</select>
		</div>

		<div class="frm_title">문의상세내용</div>
		<div>
			<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
			<?php } ?>
			<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
			<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<div id="char_count_wrap"><span id="char_count"></span>글자</div>
			<?php } ?>
		</div>

<!--		--><?php //if ($is_password) { ?>
<!--        <div class="cf line">-->
<!--		<div class="frm_title">비밀번호</div>-->
<!--			<input type="password" name="wr_password" id="wr_password" --><?php //echo $password_required ?><!-- class="frm_input"  maxlength="20">-->
<!--		</div>-->
<!--        --><?php //} ?>

<!--		--><?php //if ($is_guest) { //자동등록방지  ?>
<!--		<div class="cf line">-->
<!--		<div class="frm_title">자동등록방지</div>-->
<!--			--><?php //echo $captcha_html ?>
<!--		</div>-->
<!--		--><?php //} ?>
	</div>
	
		<?php if($w==""){?>
	    <input name="checkbox" type="checkbox" id="agree"/>
              <label style="padding:4px 0;">개인정보 수집·활용 동의</label>
         

              <textarea name="textarea" style="font-size:11px; font-weight:200; width:100%; height:140px; color:#646464; padding:10px">개인정보 수집·활용 동의

주식회사 장스푸드는 60계치킨 가맹 문의를 이용하는 고객님의 개인정보 보호를 위하여, 개인정보 수집의 목적과 그 정보의 정책적, 시스템적 보안에 관하여 규정하고 그에 따른 동의를 받고자 합니다.

1. 개인정보 수집 및 이용목적
 - 가맹점 개설에 대한 상담 목적 외에 어떠한 용도로도 사용되지 않습니다.
 - 60계 치킨 가맹 문의에 있어, 원활하게 문의 사항의 접수 및 답변이 이루어질 수 있도록 최소한의 정보를 수집합니다.

2. 수집하는 개인정보의 항목
 - 이름, 연락처(전화번호, 핸드폰번호), 성별, 이메일 

3. 보유기간 및 이용기간
 - 보유 및 이용기간은 5년으로 하며, 기간 경과 후 본사는 해당 자료를 지체 없이 파기 합니다.
</textarea>
		<?php }?>




    <div class="btn_confirm">
        <!--<input type="button" value="문의글 전송하기" id="btn_submit" accesskey="s" class="btn_submit" onclick="modalView()">-->
		<input type="submit" value="문의글 전송하기" id="btn_submit" accesskey="s" class="btn_submit">
        <?php if($is_admin){ ?>
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">문의신청목록</a>
		<?php } ?>
    </div>
	<script type="text/javascript">
		function modalView(){
			$("#modal-name").html($("#wr_name").val());
			$("#modal-tel").html($("#wr_subject").val());
			$("#modal-region").html($("#wr_1").val());
			$("#myModal").modal('show');
		}
	</script>
	<!-- Button trigger modal -->
	

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">신청내용</h4>
		  </div>
		  <div class="modal-body" style="height:100px">
			<div class="col-xs-4 col-md-4 col-lg4">이름 : </div>
			<div class="col-xs-8 col-md-8 col-lg8" id="modal-name"></div>
			<div class="col-xs-4 col-md-4 col-lg4">연락처 : </div>
			<div class="col-xs-8 col-md-8 col-lg8" id="modal-tel"></div>
			<div class="col-xs-4 col-md-4 col-lg4">희망지역 : </div>
			<div class="col-xs-8 col-md-8 col-lg8" id="modal-region"></div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">확인</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
		  </div>
		</div>
	  </div>
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

	$(function() {
		//changeWr5();
		//$("#wr_5").on("change", changeWr5);

		changeWr1();
		$("#wr_1").on("change", changeWr1);
	});

	// 개설희망지역 1차변경시 - 2차
	function changeWr1() {
		var si = $("#wr_1").val();
		var gugun = "<?=$write['wr_2']?>";

		if (si == "") return;

		$.ajax({
			type : "post",  
			url : "./ajax.gugun.php",
			data : {si : si, gugun: gugun},
			dataType : "html",  
		}).done(function(data, textStatus, xhr) {
			$("#wr_2").html(data).prop("required", true);
		}).fail(function(data, textStatus, errorThrown) {
			$("#wr_2").html("<option value=''>2차</option>").prop("required", false);
		}).always(function() {
			
		});
	}

	/*
	// 문의자주변60계운영 - 없음 외 매장명 입력필드 노출
	function changeWr5() {
		var opt = $("#wr_5").val();
		var area = $("#wr_6").parents(".cf");

		if (opt != "" && opt != "없음") {
			area.slideDown();
			$("#wr_6").focus().prop("required", true);

		} else {
			area.slideUp();
			$("#wr_6").val("").prop("required", false);
		}
	}
	*/

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
		<?php if($w==""){?>
			if($("#agree").prop("checked")==false){
				alert("개인정보 수집·활용 동의를 하셔야합니다.");
				return false;
			}
		<?php }?>

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

        if(!certCheck) {
            alert("인증을 완료해주세요.");
            return false;
        }

		if (!confirm("창업문의를 완료하시겠습니까?")) return false;

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->