<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<link rel="stylesheet" href="<?php echo $member_skin_url;?>/style.css">
<style>
    .notice-box {
        margin: 20px 0;
    }

    .notice-box li span {
        width: auto;
        padding: 0 9px;
        border-radius: 18px;
        font-size: 13px;
    }

    .notice-box li {
        padding-left: 70px;
    }

</style>

<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>

    <div class="chungwon_form">
        <table>
            <thead>
                <tr>
                    <th colspan="4">

                        <h6>새만큼 잼버리부지 케나프 특구지정</h6>
                        <h1>청원서</h1>
                        <p>
                            서울시 구로구 디지털로 32 나길 35 델타빌딩 6F,<br>
                            Tel: <span style="color:red;">1833-5633</span> 
                            <span style="color:blue">
                                www.ecofriendworld.co.kr
                            </span>
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <th>성명</th>
                    <td><input type="text" class="frm_input" id="name" name="name"></td>
                    <th>전화</th>
                    <td><input type="text" class="frm_input" id="mb_hp" name="mb_hp"></td>
                </tr>
                <tr>
                    <th>생년월일</th>
                    <td>
                        <select id="birth1" name="birth1">
                        </select>
                        <select id="birth2" name="birth2">
                        </select>
                        <select id="birth3" name="birth3">
                        </select>
                    </td>
                    <th>소속</th>
                    <td><input type="text" class="frm_input" id="organization" name="organization"></td>
                </tr>
                <tr>
                    <th>주소</th>
                    <td colspan="3">
                        <input type="text" class="frm_input adr_input" id="address" name="address">
                    </td>
                </tr>
                <tr>
                    <th>개인정보동의</th>
                    <td colspan="3">
                        <p>이름,주소,생년월일,전화번호</p>
                        <label for="yes_agr">
                            <input type="radio" name="radi_agr" id="yes_agr" value="true">
                            <strong style="color:red;">동의(본 청원서에만 사용허가)</strong>
                        </label>
                        <br>
                        <label for="no_agr">
                            <input type="radio" name="radi_agr" id="no_agr" value="false">
                            <strong style="color:#333;">미동의</strong>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th>후원계좌</th>
                    <td colspan="3">
                        기업은행 070-127990-04-012 케나프랜드(주)
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        위 본인은 <strong style="color:blue">사람, 땅, 공기, 물</strong> 모두를 살리는 미래친황경 고수익 작물 <strong style="color:green">케나프</strong>의 새만금 잼버리 지역의 특구지정을 강력히 청원하며, 이를 통한 우리나라가 이곳을 시발점으로 하여 케나프의 주종국이 되어 우리 후손들에게 자랑스러운 대한민국을 물려 줄 수 있을것을 확신하며, 이 청원서를 담당 관청에 접수하기를 원합니다.
                    </td>
                </tr>

            </tbody>
        </table>
        
		<input type="button" onclick="postData()" class="btn btn-primary btn-large" value="청원하기" style="position:absolute; bottom:0; left:0; width:100%; height:auto; text-align:center;">
    </div>
    <!--
    <form >
		<article class="box-article">
			<div class="box-body" style="margin-bottom:0;">
				<div class="box-contitle">
					 새만큼 잼버리부지 케나프 특구지정 청원하기
				</div>
				<div class="box-content box-bottom clearfix" style="border:none;">
					
					<dl style="padding:0 0 5px 0">
						<input type="text" name="mb_name" id="name" value="" class="frm_input" style="width:100%;" placeholder="성명을 입력하세요" required>
					</dl>
					
					
					<dl id="set_rec" style="padding:0 0 5px 0;">
						<input type="tel" name="mb_cert" id="mb_hp" value="" class="frm_input" placeholder="전화번호 입력하세요">
					</dl>
					
					<dl id="set_rec" style="padding:0 0 5px 0;">
						<input type="tel" name="mb_cert" id="addr" value="" class="frm_input" style="width:calc(100% - 60px)" placeholder="주소를 검색하세요">
						<input type="button" class="btn" value="검색" onclick="openZipSearch()" style="width:55px; height:38px; float:right;">
					</dl>
					<dl id="set_rec" style="padding:0 0 5px 0; display:;">	
						<input type="text" id="addr_dtl" class="frm_input" placeholder="상세주소를 입력하세요">
					</dl>
					
					<dl style="padding:0 0 5px 0">
						<input type="text" name="mb_class" id="organization" value="" class="frm_input" style="width:100%;" placeholder="소속을 입력하세요" required>
					</dl>
					
				</div>
              
                <div class="notice-box">
					<ul>
                    	<li>
                           <span>후원계좌</span>
                           기업은행 070-127990-04-012 케나프랜드(주)
                        </li>
                    </ul>
                </div>

			</div>
		</article>

  
	<article class="box-article">

			<div class="box-body" style="margin-bottom:0;">

				<div class="box-contitle">
					개인정보 동의
				</div>
                
				<div style="padding-top:10px;">
					<label for="agree33"><input type="checkbox" id="agree33" value="1" style="margin-top:0;"> 이름, 주소, 생년월일, 전화번호를 본 청원서에만 사용하는데 <br>동의합니다.</label>
				</div>
       
       <br><br>
       
				<div class="box-contitle">
					새만큼 잼버리부지 케나프 특구지정 청원서
				</div>
				<div class="box-content box-bottom clearfix" style="border:none;">
					<dl style="border:1px solid #EDEDED; padding:10px; height:150px; overflow-y:auto; ">
                        위 본인은 <strong style="color:blue">사람, 땅, 공기, 물</strong> 모두를 살리는 미래친황경 고수익 작물 <strong style="color:green">케나프</strong>의 새만금 잼버리 지역의 특구지정을 강력히 청원하며, 이를 통한 우리나라가 이곳을 시발점으로 하여 케나프의 주종국이 되어 우리 후손들에게 자랑스러운 대한민국을 물려 줄 수 있을것을 확신하며, 이 청원서를 담당 관청에 접수하기를 원합니다.
					</dl>
				</div>
				<div style="padding-top:10px;">
					<label for="reg_agree"><input type="checkbox" id="reg_agree" value="1" style="margin-top:0;"> 본인은 위 내용에 청원합니다.</label>
				</div>
        </div>

				
		</article>


		<input type="button" onclick="postData()" class="btn btn-primary btn-large" value="청원하기" style="position:absolute; bottom:0; left:0; width:100%; height:auto; text-align:center;">

    </form>
-->
</div>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    $(document).ready(function () {
        let today = new Date();
        let year = today.getFullYear();

        //년도 selectbox 만들기
        for (i = 1950; i <= year; i++) {
            $('#birth1').append('<option value="' + i + '">' + i + '</option>');
        }

        //월 selectbox 만들기
        for (i = 1; i <= 12; i++) {
            $('#birth2').append('<option value="' + i + '">' + i + '</option>');
        }


        //일 selectbox 만들기
        for (i = 1; i <= 31; i++) {
            $('#birth3').append('<option value="' + i + '">' + i + '</option>');
        }

    });
    function openZipSearch() {
        new daum.Postcode({
            oncomplete: function(data) {
                var addr = '';
                if (data.userSelectedType === 'R') {
                    addr = data.roadAddress;
                } else {
                    addr = data.jibunAddress;
                }

                $("#addr").val(addr);
                $("#addr_dtl").val("");
                $("#addr_dtl").focus();
            }
        }).open();
    }

    function postData() {
        var obj = new Object();
        obj.name = $("#name").val();
        obj.mb_hp = $("#mb_hp").val();
        obj.address = $("#address").val();
        obj.organization = $("#organization").val();
        obj.birthdate = [$("#birth1").val(),$("#birth2").val(),$("#birth3").val()].join("-");

        if (obj.name == "") {
            alert("성명을 입력해주세요.");
            return false;
        }

        if (obj.mb_hp == "") {
            alert("번호를 입력해주세요.");
            return false;
        }

        if (obj.address == "") {
            alert("주소를 검색해주세요.");
            return false;
        }

        if (obj.organization == "") {
            alert("소속을 입력해주세요.");
            return false;
        }

        if($("input:radio[name='radi_agr']:checked").val() != "true") {
            alert("개인정보동의에 체크해주세요.");
            return false;
        }

        console.log(obj);

        $.ajax({
            url: "chungwon_save.php",
            method: "post",
            async: false,
            cache: false,
            data: {
                _method : "post",
                obj : JSON.stringify(obj)
            },
            dataType: "json",
            success: function(res) {
                if (!res.success) alert(res.message);
                else {
                    alert("완료되었습니다.")
                    location.reload(true);
                }
            }
        });
    }

</script>
