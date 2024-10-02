<html lang="ko">
<head>
    <title>더더블유클리닉</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, user-scalable=yes">
	<meta name="naver-site-verification" content="f93f88255b96af9a9416fb98f4cfca49af5935d9"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" media="all" href="css/common.css">
    <script src="js/jquery-1.11.3.min.js"></script>
	
</head>
<body>
<STYLE type="text/css">
		/*{padding:0;margin:0;overflow-x:hidden;}
	.counsel_wrap{position:fixed; width:100%; background:#313131; z-index:9999;}
	.counsel{width:640px;height:141px; margin:0 auto;background:url('img/counsel02.jpg') no-repeat;position:relative;}
	.c_name{position:absolute;left:110px; top:40px;width:196px; height:20px;border:0; }
	.c_cate{position:absolute;left:110px; top:68px;width:196px; height:20px;border:0; }
	.c_phone1{position:absolute;left:110px; top:70px;width:60px; height:20px;border:0; }
	.c_phone2{position:absolute;left:178px; top:70px;width:60px; height:20px;border:0; }
	.c_phone3{position:absolute;left:246px; top:70px;width:60px; height:20px;border:0; }
	.c_txt{position:absolute; left:730px;top:40px;width:250px; height:50px; }
	.c_agree{position:absolute; left:110px;top:100px;font-size:13px; color:#9b9b9b; position:absolute;}
	.c_agree a{font-size:13px; color:#ffffff}
	.btn01{position:absolute; right:112px; top:40px;}
    .btn02{position:absolute; right:10px; top:40px;}
	.btn_list{overflow:hidden; position:absolute; left:392px; bottom:30px;}
	.btn_list li{float:left;margin-right:10px;}
	#quick{width:640px; margin:0 auto; }*/
		
		
  #header-wrap{		
		 
	background:url('http://thewclinic.co.kr/landing/m/img/back.png') no-repeat;
	background-size:100%;
	position:fixed; 
	margin:0 auto; 
	z-index:9999;
	width:100%;
	height:150px;    /*상단 메뉴 높이*/
	top:0;     /*맨 상단에 위치*/
	position:fixed;    /*위치 fixed*/
  }
  #contents{
	width:640px;	
	background-color:1b212f;
	margin:0 auto;    /*컨텐츠 중앙 정렬*/
	margin-top:101px;    /*상단 메뉴 높이만큼을 띄워주고 컨텐츠 시작*/


	}
		
   #btn_box{
	display:block;
	position:absolute;
	right:20px;
	top:80px;
	width:80px;
	height:40px;
	text-align:center;
	font-size:13px;
	color:#fff;
	font-weight:700;
	border:0;background:#273955
		}
		
	.cnt img{width:100%; margin:0 auto;
		display:block;}
		
	#cnt{
			margin-top:0px;
		}
		
		
		#label_box{
	top:20px;
			
	text
	{float:left;
	padding:0 10px;
	width:80px;
	height:50px;
	font-size:18px;
	color:#333;
	border:0;
	background:#fff;
	line-height:100px;}	
		}
		
		contains{
			top:20px;
			
		}

.sub_footer .footer_counsel{padding-top:60px;height:174px}
.sub_footer .footer_counsel .title{height:78px}
.sub_footer .footer_counsel .form_box{position:relative;height:100px}
.sub_footer .footer_counsel {float:left;margin-right:22px}
.sub_footer .footer_counsel .label{display:block;float:left;margin-right:10px;height:50px;line-height:50px;font-size:18px;color:#333}
.sub_footer .footer_counsel .text{float:left;padding:0 10px;width:80px;height:50px;font-size:18px;color:#333;border:0;background:#fff;*line-height:50px;line-height:50px\9}
.sub_footer .footer_counsel select{float:left;padding:0 10px;width:140px;height:50px;font-size:18px;color:#333;border:0}
.sub_footer .footer_counsel .phone_box select{width:98px}
.sub_footer .footer_counsel .phone_box .text{padding:0;width:98px;text-align:center}
.sub_footer .footer_counsel .phone_box .unit{display:block;float:left;width:24px;height:50px;line-height:50px;text-align:center;font-size:24px;color:#999}
.sub_footer .footer_counsel .btn_counsel{display:block;position:absolute;right:0;top:0;width:127px;height:50px;text-align:center;font-size:18px;color:#fff;font-weight:700;border:0;background:#273955}
.c_agree{font-size:13px; color:#ffffff}
	</style>
	
	
	
	
<!-----상담신청------>

	
<div id="header-wrap">
		<div class="footer_counsel bg_cover">
        <div class="contains" align="left">
            <!----p class="title">&nbsp;</p---->

            <div style="margin-top: 20px; margin-left: 60px" class="form_box">
				<!---img src="http://thewclinic.co.kr/img/common/logo.png"><span class="title">
				<img src="http://thewclinic.co.kr/landing/img/the_call.png"></span--->
                <form method="post" action="http://thewclinic.co.kr/sms_send.php" id="form_sms" name="sms" >
                  <label class="label_box">
                    <input size=13 type="text" name="data[]" title="이름" class="text">
				  </label><br>
						
						
                    <label class="label_box phone_box"><span class="unit"></span>
                        <select class="select" name="phone[]">
							<option value="010">010</option>
							<option value="011">011</option>
							<option value="016">016</option>
							<option value="017">017</option>
							<option value="018">018</option>
							<option value="019">019</option>

                      </select>
						<span class="unit"><font color="#ffffff">-</font></span>
						<input size=10 type="tel" id="phone2" name="phone[]" class="number" maxlength="4">
						<span class="unit"><font color="#ffffff">-</font></span>
                        <input size=10 type="tel" id="phone3" name="phone[]" class="number" maxlength="4">
                  </label>
					
					<br>
                    <label class="label_box">
                      <select lass="select" name="data[]">
                        <option>가슴재수술499</option>
                            <option>마이크로텍스쳐290</option>
                            <option>벨라젤가슴499</option>
                            <option>앨러간390</option>
                            <option>기타가슴성형상담문의</option>
                      </select>
                  </label>
						<br>
					<INPUT name="agree" type="checkbox" checked="checked"> <font color="#ffffff">개인정보취급방침에 동의합니다.</font> <br>
                    <button id="btn_box">상담신청</button>
				  </center>
              </form>
            </div>
        </div>
    </div>	
	</div>	
	

	
	<!-----이미지------>
<DIV class="cnt" style="margin:auto" align="center">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_01.png"><img  src="http://thewclinic.co.kr/landing/m/img/m_event_landing_02.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_03.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_04.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_05.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_06.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_07.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_08.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_09.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_10.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_11.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_12.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_13.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_14.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_15.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_16.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_17.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_18.png">
	<img src="http://thewclinic.co.kr/landing/m/img/m_event_landing_19.png">
		
	
	
		</div>
	
	
</body>
</html>