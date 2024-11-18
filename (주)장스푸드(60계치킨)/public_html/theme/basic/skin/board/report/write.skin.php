<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css?ver='.date("Ymd").'">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

if($is_admin) {
	//echo "<script>location.href='/bbs/board.php?bo_table=report';</script>";
	//exit;
}

?>

<div id="top_noti">
	<h1>기름 재사용 매장 신고 시 아래의 내용을 꼭 확인 바랍니다.</h1>
	<ul>
		<li>본인의 이름, 전화번호, 이메일을 꼭 기입 바랍니다. (차 후 보상금 제공시 신분 확인에 필요)</li>
		<li>CCTV 캡쳐 화면은 날짜와 시간이 정확하게 나오도록 캡쳐 또는 촬영 바랍니다. (CCTV 대조에 필요)</li>
		<li>이름, 전화번호, 이메일, 신고매장, 신고날짜, CCTV 캡쳐화면 중 정확하지 않은 정보가 있을 경우 신고로 인정되지 않을 수 있습니다.</li>
		<li>동일매장, 동일날짜 신고일 경우 1순위 신고자에게만 보상금 지급해 드립니다.</li>
		<li>5일이내에 신고해주셔야 접수가 가능합니다.</li>
		<li>보상금 지급은 제세공과급 22%를 제외하고 지급해드립니다.</li>
	</ul>
</div>

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

	<input type="hidden" id="secret" name="secret" value="secret">
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
        <colgroup>
           <col style="width:15%" />
           <col style="width:auto" />
        </colgroup>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" class="frm_input" size="10" maxlength="20" required></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" class="frm_input" maxlength="20" required></td>
        </tr>
        <?php } ?>

		<tr>
            <th scope="row"><label for="wr_1">전화번호</label></th>
            <td>
				<input type="text" name="wr_1" value="<?=$write["wr_1"]?>" id="wr_1" class="frm_input"  maxlength="100" <?echo ($w != "u")? "required" : "readonly style='background: #DDD;'";?>>
				<? if($w != "u") { ?>
				<div class="auth_wrap">
					<input type="button" class="btn btn-sm btn-primary" id="btnAuth" value="인증요청"><input type="text" id="hpAuth" class="frm_input" maxlength="6" required>
					<span id="chkTxt"></span>				</div>
				<? } ?>			</td>
        </tr>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td>
				<?
				$wr_email_arr = explode("@", $write["wr_email"]);
				$emailArr = array("naver.com", "daum.net", "nate.com", "gmail.com", "hotmail.com", "yahoo.com", "empas.com", "korea.com", "dreamwiz.com");
				?>
				<input type="hidden" name="wr_email" value="<?=$write["wr_email"]?>" id="wr_email" class="frm_input email">
				<input type="text" name="wr_email_head" value="<?=$wr_email_arr[0]?>" class="frm_input"  maxlength="100" required style="width: 20%">
				@
				<input type="text" name="wr_email_tail" value="<?=$wr_email_arr[1]?>" class="frm_input"  maxlength="100" required style="width: 20%">
				<select id="emailList">
					<option value="" <? if(!in_array($wr_email_arr[1], $emailArr)) echo "selected" ?> >직접입력</option>
					<? for($e = 0; $e < count($emailArr); $e++) { ?>
					<option value="<?=$emailArr[$e]?>" <?if($wr_email_arr[1] == $emailArr[$e]) echo "selected" ?>><?=$emailArr[$e]?></option>
					<? } ?>
				</select>			</td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required>
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" class="frm_input" maxlength="255" required>
                </div>            </td>
        </tr>

		<tr>
            <th scope="row"><label for="wr_2">신고 매장</label></th>
            <td>
				<select name="wr_2" id="wr_2" required>
					<option value="">시/도(전체)</option>
					<?php for($i=0; $i<count($si_arr); $i++){ ?>
					<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
					<?php } ?>
				</select>
				<select name="wr_3" id="wr_3" required>
					<option value="">구/군(전체)</option>
				</select>
				<select name="wr_4" id="wr_4" required>
					<option value="">매장</option>
				</select>			</td>
        </tr>

		<tr>
            <th scope="row"><label for="">신고 날짜 (재사용 날짜)</label></th>
            <td>
				<?
				$wr_5_arr = explode("-", $write["wr_5"]);
				?>
				<input type="hidden" name="wr_5" value="<?=$write["wr_5"]?>">
				<select id="wr_5_year">
					<option value="">년</option>
					<? for ($yyyy = date("Y"); $yyyy >= 2016; $yyyy--){ ?>
					<option value=<?=$yyyy?> <? if($yyyy == $wr_5_arr[0]) echo "selected"?> ><?=$yyyy?></otion>
					<? } ?>
				</select>
				<select id="wr_5_month">
					<option value="">월</option>
					<? for ($mm = 1; $mm <= 12; $mm++){ ?>
					<option value=<?=sprintf('%02d', $mm)?> <? if(sprintf('%02d', $mm) == $wr_5_arr[1]) echo "selected"?> ><?=$mm?></otion>
					<? } ?>
				</select>
				<select id="wr_5_day">
					<option value="">일</option>
					<?
					if($wr_5_arr[2] != "") {
						$setDate = $wr_5_arr[0]."-".$wr_5_arr[1]."-01";
						$lastDay = date('t', strtotime($setDate));
						for($dd = 1; $dd <= $lastDay; $dd++) {
					?>	
					<option value=<?=sprintf('%02d', $dd)?> <? if(sprintf('%02d', $dd) == $wr_5_arr[2]) echo "selected"?> ><?=$dd?></otion>
					<?
						}
					}
					?>
				</select>			</td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>            </td>
        </tr>        

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">사진 파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>            </td>
        </tr>

        <?php } ?>
        <?php if($w==""){?>
            <tr>
                <th colspan="2" scope="row">
                    <input name="checkbox" type="checkbox" id="agree"/>
                    <label style="padding:4px 0;">개인정보 수집·활용 동의(필수)</label>


                    <textarea name="textarea" style="font-size:11px; font-weight:200; background-color:#fff; width:100%; height:140px; color:#646464; padding:10px">개인정보 수집·활용 동의

주식회사 장스푸드는 60계치킨 기름 재사용신고를 이용하는 고객님의 개인정보 보호를 위하여, 개인정보 수집의 목적과 그 정보의 정책적, 시스템적 보안에 관하여 규정하고 그에 따른 동의를 받고자 합니다.

1. 개인정보 수집 및 이용목적
 - 기름 재사용 신고 확인 목적 외에 어떠한 용도로도 사용되지 않습니다.
 - 신고 건 확인에 있어, 원활하게 신고 사항의 접수 및 답변이 이루어질 수 있도록 하기 위한 최소한의 정보를 수집합니다.

2. 수집하는 개인정보의 항목
 - 이름, 연락처(전화번호, 핸드폰번호), 이메일 

3. 보유기간 및 이용기간
 - 보유 및 이용기간은 5년으로 하며, 기간 경과 후 본사는 해당 자료를 지체 없이 파기 합니다.


          </textarea>

                </th>
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
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <!--<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>-->
    </div>
    </form>

    <script>
	var setAddrSi_1 = "<?=$write[wr_2]?>", 
		setAddrSi_2 = "<?=$write[wr_2]?>",
		setAddrGu_1 = "<?=$write[wr_3]?>",
		setAddrGu_2 = "<?=$write[wr_3]?>",
		setAddrStore = "<?=$write[wr_4]?>";

	var smsAuthCHk = false;
	var authSubmit = false;

	$(function(){
		$("#wr_1").on("keyup", function(e) {
			var _val = $.trim($(this).val());
			$(this).val(autoHypenPhone(_val));
		});

		$("#btnAuth").on("click", fnRequestAuth);

		
		// 인증번호 입력
		$("#hpAuth").blur(fnAuthNoChk).focus(function(){
			$("#chkTxt").text("");
		});

		// 이메일 입력
		$("[name=wr_email_head]").blur(function(){
			var email = $(this).val() + "@" + $("[name=wr_email_tail]").val();
			$("#wr_email").val(email);
		});
		$("[name=wr_email_tail]").blur(function(){
			var email = $("[name=wr_email_head]").val() + "@" + $(this).val();
			$("#wr_email").val(email);
		});

		// 이메일 선택2
		$("#emailList").on("change", function(){
			var emailTail = $(this).val();
			var inputBox = $("[name=wr_email_tail]");

			if(emailTail == "") {
				inputBox.attr("readonly", false).val("").focus();
			} else {
				inputBox.attr("readonly", true).val(emailTail);
				$("#wr_email").val($("[name=wr_email_head]").val() + "@" + emailTail);
			}
		});

		// 신고날짜 선택
		$("#wr_5_year").on("change", getRepDate);
		$("#wr_5_month").on("change", getRepDate);

		// 매장주소 선택
		$("#wr_2").on("change", getAddr);
		$("#wr_3").on("change", getStore);

		<? if(setAddrSi_1 != "") { // 수정시 신고매장 Load ?>
		getAddr();
		getStore();
		<? } ?>
	});

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

		//f.wr_email.value = f.wr_email_head.value + "@" + f.wr_email_tail.value;
		f.wr_5.value = $("#wr_5_year").val() + "-" + $("#wr_5_month").val() + "-" + $("#wr_5_day").val();
		<?php if($w==""){?>
			if($("#agree").prop("checked")==false){
				alert("개인정보 수집·활용 동의를 하셔야합니다.");
				return false;
			}
		<?php }?>

		<? if($w != "u") { ?>
		if(!smsAuthCHk) {
			alert("전화번호 인증이 필요합니다.");
			return false;
		}

		if(!authSubmit) {
			alert("인증번호가 맞지 않습니다.");
			return false;
		}
		<? } ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

	// 신고날짜 선택
	function getRepDate(){
		var y = $("#wr_5_year").val();
		var m = $("#wr_5_month").val();

		if(y != "" && m != "") {
			$.ajax({
				type : "GET",
				url : "<?=G5_BBS_URL?>/report_date.php",
				dataType : "html",
				data : {"year" : y, "month": m},
				success : function(tag){
					$("#wr_5_day").html(tag);
				},
				error : function(request,status,error){
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		} 

	}

	// 매장주소 선택
	// - 군/구
	function getAddr(){
		var opt, opt_select,
			si = $("#wr_2").val();
	
		if(setAddrSi_1 != "") {
			si = setAddrSi_1;
			$("#wr_2").val(setAddrSi_1).prop("selected", true);
		}

		$.ajax({
			type : "GET",
			url : "<?=G5_PLUGIN_URL?>/address/address.php",
			dataType : "json",
			data : {"si": si},
			success : function(datas){
				getValidAddr(si, datas);
				setAddrSi_1 = "";
			},
			error:function(request,status,error){
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
	// - 존재하는 매장이 있는 군/구 
	function getValidAddr(si, datas){
		var addrArr = new Array();

		for (var i=0; i<datas.length; i++) {
			addrArr[i] = datas[i];
		}
		$("#wr_4 option").remove();
		$("#wr_4").append("<option value=''>매장</option>");

		$.ajax({
			type : "GET",
			url : "./report_addr.php",
			data : {"mode" : 'findGu', "si" : si, "addr" : addrArr},
			dataType : "html",  
			success : function(tag){
				$("#wr_3").html(tag);
				if(setAddrGu_1 != ""){
					$("#wr_3").val(setAddrGu_1).prop("selected", true);
					setAddrGu_1 = "";
				}
			},
			error:function(request,status,error){
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
	// - 매장
	function getStore(){
		var si = $("#wr_2").val(),
			gu = $("#wr_3").val();

		if(setAddrSi_2 != ""){
			si = setAddrSi_2;
			gu = setAddrGu_2;
		}

		$.ajax({
			type : "GET",
			url : "./report_addr.php",
			data : {"mode" : 'findStore', "si" : si, "gu" : gu},
			dataType : "html",  
			success : function(tag){
				$("#wr_4").html(tag);
				if(setAddrStore != ""){
					$("#wr_4").val(setAddrStore).prop("selected", true);
					setAddrSi_2 = "";
					setAddrGu_2 = "";
					setAddrStore = "";
				}
			},
			error:function(request,status,error){
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});

	}

	// 인증요청
	function fnRequestAuth(){
		var userNumber = $("#wr_1").val();

		if(!smsAuthCHk) {
		
			if (userNumber.length > 0) {
				$.ajax({
					type : "GET",
					url : "./report_sms.php",
					data : {"mode" : "request", "number" : userNumber, "bo_table" : "<?=$bo_table?>"},
					dataType : "json",
					success : function(data){
						var result = data.result, 
							expDate = data.expDate;

						if(result){
							alert("인증번호가 발송되었습니다.");
							$("#hpAuth").val("");
							smsAuthCHk = true;

						} else {
							alert("인증요청이 실패하였습니다. 다시 시도해 주세요.");
							return false;
						}
					},
					error:function(request,status,error){
						alert("페이지에 오류가 발생하였습니다.");
						location.reload();
					}
				});

			} else {
				alert("인증 받으실 전화번호를 입력하세요.");
				$("#wr_1").focus();
				return false;

			}
		}

	}

	// 인증번호 확인
	function fnAuthNoChk(){
		var authNo = $("#hpAuth").val();
		var userNumber = $("#wr_1").val();
		var errTxt = $("#chkTxt");

		errTxt.text("");

		if(smsAuthCHk){
			if(authNo.length == 6){
				$.ajax({
					type : "GET",
					url : "./report_sms.php",
					data : {"mode" : "confirm", "number" : userNumber, "authChkNo" : authNo, "bo_table" : "<?=$bo_table?>"},
					dataType : "json",
					success : function(data){
						if(data.result){
							$("#btnAuth").removeClass("btn-primary").val("인증완료");
							$("#wr_1").attr("readonly", true).css("background", "#dddddd");
							$("#hpAuth").attr("readonly", true).css("background", "#dddddd");
							authSubmit = true;
							return;

						} else {
							errTxt.text("인증번호를 정확히 입력해 주세요.");
							//$("#hpAuth").focus();
							console.log(1);
							return;
						}
					},
					error:function(request,status,error){
						errTxt.text("인증번호를 정확히 입력해 주세요.");
						location.reload();
					}
				});

			} else {
				errTxt.text("인증번호를 정확히 입력해 주세요.");
				return false;
			}

		} else {
			errTxt.text("인증요청 버튼을 클릭하세요.");
			return;
		}
	}


	// 이메일 유효성 검사
	function validateEmail(sEmail) {
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		if (filter.test(sEmail)) return true;
		else return false;
	}

	// 휴대폰 하이픈(-) 자동생성
	function autoHypenPhone(str){
		str = str.replace(/[^0-9]/g, '');
		var tmp = '';
		if( str.length < 4){
			return str;
		}else if(str.length < 7){
			tmp += str.substr(0, 3) + '-' + str.substr(3);
			return tmp;
		}else if(str.length < 11){
			tmp += str.substr(0, 3) + '-' + str.substr(3, 3) + '-' + str.substr(6);
			return tmp;
		}else{				
			tmp += str.substr(0, 3) + '-' + str.substr(3, 4) + '-' + str.substr(7);
			return tmp;
		}
		return str;
	}

    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->