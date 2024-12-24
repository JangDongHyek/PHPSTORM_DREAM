<?
include_once("./_common.php");
include_once(G5_PATH.'/head.sub2.php');

//echo $member['mb_id'];
//echo "\n";
//print_r($member);

if(isRegisterPetition($member['mb_id']) && $member['mb_id'] != 'admin'){
    alert('이미 청원서를 작성하셨습니다!', G5_URL);
}

?>
<?php if($is_member){
    include_once(G5_PATH.'/head.php');
} ?>

<meta property="og:type" content="website">
<meta property="og:title" content="친환경세상">
<meta property="og:description" content="친환경세상">
<meta property="og:image" content="<?php echo G5_URL; ?>/img/logo-y.jpg">

<style>
    .flex{display: flex;}
    .txt_red{color: red; font-weight: 600;}
    .txt_blue{color: blue; font-weight: 600;}
    .txt_green{color: green; font-weight: 600;}
    #petition{max-width: 600px; width: 100%; margin: 0 auto; background:#FBFBFB;
        /*font-size:0.677vw*/; padding: 3%; font-size: 1.1em;}
    #petition input{border: 1px solid #eee;}
    #petition .logo{height: 30px; margin-right: 10px;}
    #petition .area_head{text-align: center;  padding: 1.5em 0;}
    #petition .area_head h1{font-size: 1.5em; line-height: 2em; font-weight: 700; margin-bottom: 30px;}
    #petition .area_head h1 strong{}
    #petition .area_head h1 p{ font-size: 2em; letter-spacing: 20px;}
    #petition table th,
    #petition table td{padding: 0.5em; word-break: keep-all;}
    #petition table input{width: 100%;}
    #petition table input::placeholder{opacity: 0.5;}
    #petition table input[type=checkbox]{width:initial; margin: 0; line-height: 1.6em; margin-right: 3px;}
    #petition table input[type=checkbox] + label{margin: 0; line-height: 1.6em;}
    #petition table .content{line-height: 1.8em;}
    #petition table .sign{text-align: center; margin: 20px auto; line-height: 1.8em;}
    #petition table .sign input{max-width: 50px; text-align: center;}
    #petition table .flex{align-items: center; justify-content: center; font-weight: 600; margin-bottom: 2px;}
    #petition table select{width: max-content; min-width: 40px; margin: 1px}
    #petition table .btn{font-size: 1em; line-height: 25px; padding: 0 10px; border-radius: 0; margin: 0 0 0 2px; width: auto;}
    #petition button{background-color: #333; color:  #fff; width: 100%; margin-top: 5%; font-size: 1.4em; line-height: 2.4em; border: 0; height: auto}

</style>

<form id="petition-form" action="./petition_form_update.php" method="POST">
    <!--청원서-->
    <div id="petition">
        <table border="1">
            <colgroup>
                <col width="80px"/>
                <col width="auto"/>
                <col width="60px"/>
                <col width="auto"/>
            </colgroup>
            <thead>
            <tr>
                <td colspan="4">
                    <div class="area_head">
                        <h1>
                            <strong>새만금 잼버리 부지 케나프 특구지정</strong>
                            <p>청원서</p>
                        </h1>
                        <div class="info">
                            <p>서울시 구로구 디지털로 32 나길 35 델타빌딩 6F,</p>
                            <p>Tel : 1833-5633 www. ecofriendlyworld.co.kr</p>
                        </div>
                    </div>
                </td>
            </tr>
            </thead>
            <tbody>
            <input type="hidden" name="mb_cert_no" id="mb_cert_no" value="">
            <tr>
                <th>성명</th>
                <td><input type="text" name="mb_name" value=""></td>
                <th>전화</th>
                <td>
                    <div class="flex">
                        <input type="tel" name="mb_hp" id="mb_hp" value="<?php echo $member['mb_id']?>" class="frm_input" placeholder="본인ID : 01012345678" required onkeyup="this.value = number_only(this.value)" readonly="true">
                        <!--<input type="button" class="btn btn-danger" value="인증번호 발송" onclick="setRec();" style="width:115px; height:38px; float:right; <?php if($w!="") echo "display:none;";?>">-->
                        <!--<input type="tel" placeholder="휴대폰번호 입력"><button class="btn">인증</button>-->
                    </div>
                    <div class="flex" id="set_rec" style="display: none">
                        <input type="tel" name="mb_cert" id="mb_cert" value="" class="frm_input" style="width:calc(100% - 60px)" placeholder="인증번호 입력" onkeyup="this.value = number_only(this.value)">
                        <input type="button" class="btn btn-danger" value="인증" style="width:55px; height:38px; float:right;" onclick="setCert()">
                        <!--<input type="number" placeholder="인증번호 입력"><button class="btn">확인</button>-->
                        <span id="stx_rec" style="padding:0 0 5px 0; display:;"><span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>생년월일</th>
                <td>
                    <select name="year">
                        <?php
                        $currentYear = date("Y");
                        for ($year = 1910; $year <= $currentYear; $year++) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                    <br class="visible-sm visible-xs">
                    <select name="month">
                        <?php
                        for ($month = 1; $month <= 12; $month++) {
                            echo "<option value='$month'>$month 월</option>";
                        }
                        ?>
                    </select>
                    <select name="day">
                        <?php
                        // 현재 선택된 월을 기준으로 최대 일수를 계산합니다.
                        //$selectedMonth = date("m");
                        //$lastDay = date("t", strtotime("{$currentYear}-{$selectedMonth}-01"));

                        for ($day = 1; $day <= 31; $day++) {
                            echo "<option value='$day'>$day 일</option>";
                        }
                        ?>
                    </select>
                    <!--<input type="date">-->
                </td>
                <th>소속</th>
                <td><input type="text" name="organization" value=""></td>
            </tr>
            <tr>
                <th>주소</th>
                <td colspan="3"><input type="text" name="address" value=></td>
            </tr>
            <tr>
                <th>개인정보 동의</th>
                <td colspan="3">
                    <div>
                        <p>이름, 주소, 생년월일 전화번호</p>
                        <p class="txt_red"><input type="checkbox" id="agree" name="agree"><label for="agree">동의</label> (본 청원서에서만 사용허가)</p>
                    </div>
                    <div>
                        <input type="checkbox" id="no_agree" name="no_agree"><label for="no_agree">미동의</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th>후원계좌</th>
                <td colspan="3">기업은행 070-127990-04-012 케나프랜드(주)</td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="content">
                        위 본인은 <span class="txt_blue"> "사람, 땅, 공기, 물"</span> 모두를 살리는 미래친환경 고수익 작물 <span class="txt_green">케나프</span>의 새만금 잼버리 지역의 특구지정을 강력히 청원하며, 이를 통한 우리나라가 이곳을 시발점으로 하여 케나프의 종주국이 되어 우리 후손들에게 자랑스러운 대한민국을 물려 줄 수 있을 것을 확신하며, 이 청원서를 담담 관청에 접수하기를 원합니다.</div>
                    <div class="sign">
                        <div>2024년 <input type="text" value="">월 <input type="text" value="">일</div>
                        <div>위 본인 <input type="text" value="">(인)</div>
                    </div>
                    <div class="flex">
                        <img src="<?php echo G5_THEME_IMG_URL;?>/app/logo_mark.png" alt="" class="logo"/>
                        <div>
                            <p>새만금 잼버리부지 케나프 특구지정</p>
                            <p>준비위 귀중</p>
                        </div>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
        <!--<button id="submit-button">청원서 등록</button>-->
        <button type="submit">청원서 등록</button>
    </div>
</form>

<script>
    function setRec(){
        if(!$("#mb_id").val()){
            $("#stx_rec").css("display", "").html("아이디를 입력해주세요.");
            return false;
        }else{
            if($("#mb_id").val().length<11){
                alert("자릿수가 맞지 않습니다.");
                return false;
            }
            if($("#mb_id").val().substring(0,3)!="010"){
                alert("올바른 휴대폰 번호가 아닙니다.");
                return false;
            }
        }

        var mb_hp = $("#mb_id").val();
        $.post(g5_bbs_url + "/ajax.hp_check.php",{ "mb_hp":mb_hp }, function (result){
            if(result.status == "false"){
                $("#stx_rec").html("이미 회원가입한 회원입니다.");
                return false;
            }

            $("#mb_cert_no").val(result.cret);
            $("#set_rec").slideDown(300);

            //$("#mb_cert").val(result.cret);
            //setTimeout("autoCert('"+result.cret+"')","10000");
        }, "json");
    }

    function setCert(){
        if($("#mb_cert").val() != $("#mb_cert_no").val()){
            $("#stx_rec").html("<font color=red>인증번호가 틀렸습니다.</font>");
        }else{
            $("#stx_rec").html("<font color=blue>인증이 완료 되었습니다.</font>");
            $("#set_pass").slideDown(300);
        }
    }

    /*
    document.getElementById('submit-button').addEventListener('click', () => {
        // FormData 객체를 사용하여 폼 데이터를 가져옵니다.
        const formData = new FormData(document.getElementById('petition-form'));

        fetch ('http://itforone.co.kr/~canadaw3/bbs/register_form_update.php', {
            method: 'POST',
            mode: 'cors',		// 모드 명시
            cache: 'no-cache',
            body: formData, // 폼 데이터를 요청 본문에 포함
        })
            .then((res) => res.text())
            .then(data => {
                // 응답 데이터를 처리하는 로직을 여기에 작성
                console.log(data);
                alert('청원서가 등록되었습니다.');
            })
            .catch(error => {
                // 오류 처리 로직을 여기에 작성
                console.error('오류 발생:', error);
                alert('오류가 발생했습니다.');
            });
    });*/

</script>