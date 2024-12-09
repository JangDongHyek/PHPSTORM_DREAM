
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

/*
 * 비번찾기 후
print_r($_POST);
Array
(
    [kcb_name] => 윤지영
    [kcb_birth] => 19890220
    [kcb_sex] => F
    [kcb_hp] => 01026120220
    [kcb_cert] => Y
    [kcb_telcom] => 02
)
*/
$kcb_cert = $_POST['kcb_cert']=="Y";

?>
<style>
    .win_btn {margin-top: 20px;}
	#certFrame {position: fixed; top: 0; left: 0; z-index: 1000; border: 0; width: 100%; height: 100%; display: none;}
    #pass-find input[type=radio] {display: inline-block; margin: 0; width: 18px; height: 18px;}
    #pass-find input[type=radio] + label {display: inline-block; margin: 0; font-weight: normal;}
    #pass-find ul {margin-top: 10px;}
    #pass-find li {margin: 3px 0;}
    #password_form {display: none;}
</style>
<!-- 회원정보 찾기 시작 { -->
<div id="find_info" class="mbskin">
    <h1 id="win_title">회원정보 찾기</h1>
	<!-- 탭메뉴 시작 -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="<?if(!$kcb_cert) echo "active"?>"><a href="#id-find" aria-controls="id-find" role="tab" data-toggle="tab">아이디찾기</a></li>
		<li role="presentation" class="<?if($kcb_cert) echo "active"?>"><a href="#pass-find" aria-controls="pass-find" role="tab" data-toggle="tab">비번재설정</a></li>
	</ul>
	<!-- 탭메뉴 끝 -->
	<!-- 탭 내용 시작-->
	<div class="tab-content">
	  <!-- 아이디 찾기 내용 시작-->
	  <div role="tabpanel" class="tab-pane <?if(!$kcb_cert) echo "active"?>" id="id-find">
          <form name="findIdFrm" method="post" autocomplete="off">
            <fieldset id="info_fs">
                <label for="mb_name">이름<strong class="sound_only">필수</strong></label>
                <input type="text" name="name" id="name" class="frm_input" size="30" placeholder="이름">
            </fieldset>
            <fieldset id="info_fs">
                <label for="mb_hp">휴대번호<strong class="sound_only">필수</strong></label>
                <input type="tel" name="hp" id="hp" class="frm_input f_num" size="30" placeholder="휴대번호" maxlength="11">
            </fieldset>
            <div class="text-center" id="id-result">
                <!-- /bbs/ajax.mb_id.find.php -->
            </div>
            <div class="win_btn">
                <button type="button" class="btn_submit" id="id-btn" onclick="findId()">확인</button>
            </div>
          </form>
	  </div>
	  <!-- 아이디 찾기 내용 끝 -->
	  <!-- 비번재설정 내용 시작 -->
	  <div role="tabpanel" class="tab-pane <?if($kcb_cert) echo "active"?>" id="pass-find">
        <? if (!$kcb_cert) { // 1. 본인인증 전 ?>
        <div>휴대폰 본인인증 후 새로운 비밀번호로<br>재설정 하실 수 있습니다.</div>
        <div class="win_btn">
            <input type="button" value="휴대폰 본인인증" class="btn_submit" onclick="findPw()">
        </div>

        <?
        } else { // 2. 본인인증 후
            $sql = "SELECT mb_no, mb_id, mb_datetime FROM g5_member 
                    WHERE mb_status = '일반' AND mb_hp = '{$_POST['kcb_hp']}' 
                    ORDER BY mb_no ASC;";
            $result = sql_query($sql);
            $result_cnt = sql_num_rows($result);

            if ($result_cnt == 0) { // 2.1 정보없음
        ?>
        <div>존재하지 않는 회원정보 입니다.</div>
        <div class="win_btn">
            <input type="button" value="휴대폰 본인인증" class="btn_submit" onclick="findPw()">
        </div>

        <?  } else { // 2.2 정보있음 ?>
        <form name="resetPassFrm" autocomplete="off">
            <div><strong><?=$result_cnt?>개</strong>의 아이디를 찾았습니다.<br>재설정 할 아이디를 선택하세요.</div>
            <ul>
                  <? for ($i = 0; $row = sql_fetch_array($result); $i++) { ?>
                  <li>
                      <input type="radio" name="reset_no" id="reset_no" value="<?=$row['mb_no']?>" id="chk<?=$i?>">
                      <label for="chk<?=$i?>">
                          <strong><?=$row['mb_id']?></strong>(가입일: <?=date("y.m.d", strtotime($row['mb_datetime']));?>)
                      </label>
                  </li>
                  <?} ?>
            </ul>
            <div class="win_btn" id="password_form">
                <input type="password" class="frm_input" name="pass1" id="pass1" placeholder="변경할 비밀번호">
                <input type="password" class="frm_input" name="pass2" id="pass2" placeholder="변경할 비밀번호확인">
                <input type="button" value="비밀번호 재설정" class="btn_submit" onclick="resetPassword()">
            </div>
        </form>
        <?
            }
        } // end if $kcb_cert ?>

	  </div>
	  <!-- 비번재설정 내용 끝 -->
	</div>
</div>

<script type="text/javascript">
    let token = "";

    // 페이지 로드 시 토큰 발급
    $(document).ready(function() {

    });

    function make_token(name) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "./ajax.make.token.php",
                data: {"name": name},
                dataType: "html",
                type: "POST",
                success: function (data) {
                    resolve(data); // 성공 시 Promise resolve
                },
                error: function (request, status, error) {
                    console.log(request);
                    swal("토큰 발급에 실패했습니다.");
                    reject(error); // 실패 시 Promise reject
                }
            });
        });
    }

    // 아이디찾기
    async function findId() {
        // 폼 제출 이벤트를 막음

        let hp = $("#hp").val().trim();
        let name = $("#name").val().trim();

        if (name === "") {
            swal("이름을 입력하세요.");
            return false;
        }

        if (hp === "") {
            swal("휴대번호를 입력하세요.");
            return false;
        }

        $("#id-result").html("");

        try {
            await make_token("find_id").then(data => {
                token = data;
            }).catch(error => {
            });

            await $.ajax({
                url: "./ajax.mb_id.find.php",
                data: {"mb_name": name, "mb_hp": hp, "token": token},
                dataType: "html",
                type: "POST",
                success: function (data) {
                    $("#id-result").html(data);
                },
                error: function (request, status, error) {
                    console.log(request);
                    swal("아이디찾기에 실패했습니다.");
                }
            });
        } catch (error) {
            console.error("아이디 찾기에 실패했습니다.", error);
            swal("아이디 찾기에 실패했습니다.");
        }

        return false;
    }

    // 비밀번호찾기 (본인인증)
    function findPw() {
        location.href = "./kcb/phone_popup1.php?req_page=find";
    }

    // 비밀번호 재설정
    async function resetPassword(f) {
        let reset_no = $("#reset_no").val().trim();
        let pass1 = $("#pass1").val().trim();
        let pass2 = $("#pass2").val().trim();

        if (reset_no === "") {
            swal("비밀번호를 재설정 할 아이디를 선택하세요.");
            return false;
        }

        if (pass1.length < 4) {
            swal("비밀번호를 4자 이상 입력해 주세요.");
            return false;
        }

        if (pass1.value !== pass2.value) {
            swal("비밀번호와 비밀번호확인이 일치하지 않습니다.");
            return false;
        }

        try {
            await make_token("find_pw").then(data => {
                token = data;
            }).catch(error => {
            });


            await $.ajax({
                url: "./ajax.mb_password.reset.php",
                data: {"mb_no": reset_no, "password": pass1, "token": token},
                dataType: "json",
                type: "POST",
                success: function (data) {
                    if (data.result) {
                        swal("비밀번호 변경이 완료되었습니다.").then(function() {
                            location.href = g5_url + "/bbs/login.php";
                        });
                    } else {
                        swal("비밀번호 재설정에 실패했습니다.");
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                    swal("비밀번호 재설정에 실패했습니다.");
                }
            });
        } catch (error) {
            console.error("비밀번호 재설정에 실패했습니다.", error);
            swal("비밀번호 재설정에 실패했습니다.");
        }

        return false;
    }


    $(function(){
        $('#myTab a:last').tab('show');

        $("input[name=reset_no]").on("click", function() {
            $("input[name=pass1], input[name=pass2]").val("");
            $("#password_form").slideDown();
        });

        // 상단 뒤로가기
        $("#hd_back a").on("click", function(e) {
            e.preventDefault();
            location.href = g5_url + "/bbs/login.php";
        });
    });


</script>
<!-- } 회원정보 찾기 끝 -->