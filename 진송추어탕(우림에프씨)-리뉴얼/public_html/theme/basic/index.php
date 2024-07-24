<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
$captcha_html = '';
$captcha_js   = '';
if ($is_guest) {
    $captcha_html = captcha_html();
    $captcha_js   = chk_captcha_js();
}
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<section id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeIn animated"> 
        <ul class="sliderbx">
		
		   <li class="mv02">
				<div id="slogan">
					<h2>급변하는 시대에 <span class="red">단기적인 아이템</span> <br>더 이상 승부할 수 없다!</h2>
					<h4>장기적인 <span class="yellow"><i>평</i><i>생</i> <i>아</i><i>이</i><i>템</i></span>이 필요하다!</h4>
					<h4>바로 <span class="bold">진송추어탕</span>입니다!</h4>
				</div><!--#slogan-->
			</li>
			
						
        	<li class="mv01">
				 <div id="slogan">
					<h3>맛, 건강, 자연을 담은 우리나라 대표 보양식 </h3>
					<div class="logo">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.png" alt="로고">
					</div>
					
					<ul class="slogon_list">
						<li>
							<p>맛</p>
						</li>
						<li>
							<p>건강</p>
						</li>
						<li>
							<p>자연</p>
						</li>
					</ul>
					
				</div><!--#slogan-->
			</li>

        	<li class="mv03">
				<div id="slogan">
					
					<div class="logo">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.png" alt="로고"><h5 style="display: inline-block;
    margin-bottom: -50px!important;
    vertical-align: -webkit-baseline-middle;">은</h5>
					</div><h5>어머니의 밥상에 대한 그리움에서 탄생<br>
   웰빙시대 우리나라의 대표적인 보양식인 추어탕을<br>
   대중의 기호에 맞추고 전통적인 조리방식을 중심으로<br>
   매일 가마솥에서 정성으로 추어탕을 끓여냅니다.<br><br></h5>
   <div class="">
						<h5 style="display: inline-block;
    margin-bottom: 0px!important;
    vertical-align: -webkit-baseline-middle;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_whitetxt.png" class="txtlogo">은 앞으로도 변하지 않는 정직한 맛과 가족애로 믿음에 보답하겠습니다.</h5>
					</div>
				</div><!--#slogan-->
			</li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</section><!--  #idx_wrapper -->

<section id="about">
	<div class="area_jinsong">
		<div class="inr">
			<div class="title">
				<h2>진송소개</h2>
				<span>가맹점주가 ‘만족’하고 ‘추천’하는 브랜드</span>
			</div>
			<div class="area_box">
				<img src="<?php echo G5_THEME_IMG_URL ?>/main/img_jinsong.jpg">
			</div>
		</div>	
	</div>
	<div class="area_organization">
		<div class="inr">
			<div class="title">
				<h2>진송 조직도</h2>
			</div>
			<ul class="list">
				<li>
					<div class="area_icon"></div>
					<div class="area_txt">
						<h3>메뉴개발팀</h3>
						<p>진송만의 특별한 메뉴 이색적인 추어탕, 지속적인 맛의 연구, 누구나 쉽게 조리가 가능한 레시피를 준비하고 있습니다.</p>
					</div>
				</li>
				<li>
					<div class="area_icon"></div>
					<div class="area_txt">
						<h3>인테리어 시설팀</h3>
						<p>창의적인 동선과 전통적인 컨셉을 현대적인 디자인으로 접목시켜 고객이 편안함을 느낄 수 있는 공간으로 창출하였습니다.</p>
					</div>
				</li>
				<li>
					<div class="area_icon"></div>
					<div class="area_txt">
						<h3>슈퍼바이저</h3>
						<p>직영매장과 여러 매장의 운영 노하우와 경험으로 사장님들 매장운영을 도와드리며 서비스ㆍ조리교육등 매장에서 일어나는 모든 것을 전수하고 있습니다.</p>
					</div>
				</li>
				<li>
					<div class="area_icon"></div>
					<div class="area_txt">
						<h3>물류 시스템</h3>
						<p>본사가 운영하는 생산공장과 물류 창고를 설립, 요식업의 경험이 없으신 점주님들도 누구나 쉽게 운영할 수 있도록 최상의 퀄리티로 배송시스템을 갖추었습니다.</p>
					</div>
				</li>
			</ul>
		</div>	
	</div>
</section>
<section id="interior">
	<div class="inr">
		<div class="title">
			<h2>진송추어탕 인테리어 특징</h2>
			<span>
			넓고 편안한 전통적 컨셉과 현대적인 디자인의 만남 <br>
			청결하고 깔끔한 오픈형 주방으로 연출 하였습니다.
			</span>
		</div>
		<div class="area_box">
			<div class="r_top">
				<h3>ONE - STEP 인테리어 서비스</h3>
				<p>진송추어탕 내외부 모든 인테리어는 전담 디자인팀이 빠르게 처리하도록 하고 있으며 점포를 개설한 후에도 지속적으로 관리해드리고 있습니다.</p>
			</div>
			<img class="w" src="<?php echo G5_THEME_IMG_URL ?>/main/img_interior.png">
			<img class="m" src="<?php echo G5_THEME_IMG_URL ?>/main/m_img_interior.png">
		</div>
		<!--
		<div class="area_interior">
			<div class="left">
				<img src="<?php echo G5_THEME_IMG_URL ?>/main/img_interior01.jpg">	
			</div>
			<div class="right">
				<div class="r_top">
					<h3>ONE - STEP 인테리어 서비스</h3>
					<p>진송추어탕 내외부 모든 인테리어는 전담 디자인팀이 빠르게 처리하도록 하고 있으며 점포를 개설한 후에도 지속적으로 관리해드리고 있습니다.</p>
				</div>
				<div class="r_bottom">
					<img src="<?php echo G5_THEME_IMG_URL ?>/main/img_interior02.jpg">	
					<img src="<?php echo G5_THEME_IMG_URL ?>/main/img_interior03.jpg">	
				</div>
			</div>
		</div>
		-->
	</div>	
</section>

<section id="menu">
	<div class="inr">
		<div class="title">
			<h2>메뉴소개</h2>
		</div>	
		<ul class="tabs">
			<li class="active" rel="tab1"><span>추어탕</span></li>
			<li rel="tab2"><span>사이드</span></li>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<ul class="list">
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu01.jpg"></div>
						<div class="area_txt"><p>진송추어탕</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu04.jpg"></div>
						<div class="area_txt"><p>얼큰이추어탕</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu05.jpg"></div>
						<div class="area_txt"><p>수제비추어탕</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu06.jpg"></div>
						<div class="area_txt"><p>우렁이추어탕</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu02.jpg"></div>
						<div class="area_txt"><p>통추어탕</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu03.jpg"></div>
						<div class="area_txt"><p>인삼추어탕(선택메뉴)</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu15.jpg"></div>
						<div class="area_txt"><p>생선구이정식(선택메뉴)</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu11.jpg"></div>
						<div class="area_txt"><p>추어전골(선택메뉴)</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu12.jpg"></div>
						<div class="area_txt"><p>추어통전골(선택메뉴)</p></div>
					</li>
				</ul>
			</div>
			<div id="tab2" class="tab_content">
				<ul class="list">
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu07.jpg"></div>
						<div class="area_txt"><p>진송돈까스</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu08.jpg"></div>
						<div class="area_txt"><p>고구마치즈돈까스</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu09.jpg"></div>
						<div class="area_txt"><p>추어튀김</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu10.jpg"></div>
						<div class="area_txt"><p>고추만두</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu18.jpg"></div>
						<div class="area_txt"><p>진송물만두</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu13.jpg"></div>
						<div class="area_txt"><p>고등어구이(선택메뉴)</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu16.jpg"></div>
						<div class="area_txt"><p>적어구이(선택메뉴)</p></div>
					</li>
					<li>
						<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/img_menu17.jpg"></div>
						<div class="area_txt"><p>가자미구이(선택메뉴)</p></div>
					</li>
				</ul>
			</div>
		</div>	
	</div>	
</section>

<section id="store">
	<div class="area_store">
		<div class="inr">
			<div class="title">
				<h2>가맹안내</h2>
			</div>				
			<div class="area_photo">
				<div class="area_txt">
					<h3>" 단골장사만으로 <span class="red">20개의 가맹점</span> 오픈 "</h3>
					<span>
						상권을 초월하는 매출! <br>
						그 상권에서 기대했던 매출을 모조리 넘어섰습니다.
					</span>
				</div>
				<div class="area_img">
					 <?php echo latest("theme/gallery", "store",14, 15); ?>
				</div>
			</div>
			<?php
			if($member[mb_level]=="10"){?>
			<a href="<?=G5_BBS_URL?>/write.php?bo_table=store" class="btn btn-primary board">등록하기</a>
			<?php }?>
		</div>
	</div>
	<div class="area_process">
		<div class="inr">	
			<div class="title">
				<h2>가맹절차</h2>
			</div>
			<ul class="process_list">
				<li>
					<div class="area_icon">
						<i><span>STEP 01</span></i>
					</div>
					<h3>개설상담</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 02</span></i>
					</div>
					<h3>창업컨설팅</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 03</span></i>
					</div>
					<h3>매장계약 및 가맹계약</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 04</span></i>
					</div>
					<h3>인테리어공사</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 05</span></i>
					</div>
					<h3>운영교육 및 최종점검</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 06</span></i>
					</div>
					<h3>매장오픈</h3>
				</li>
				<li>
					<div class="area_icon">
						<i><span>STEP 07</span></i>
					</div>
					<h3>사후관리 및 운영지원</h3>
				</li>
			</ul>
		</div>
	</div>
	<div class="area_cost">
		<div class="inr">
			<div class="title">
				<h2>가맹비용</h2>
			</div>
			<div class="table_cost">
				<div class="left">
					<div class="area_table">					
						<div class="cost_title">가맹금</div>
						<table class="table">
							<caption>가맹금</caption>
							<colgroup>
								<col style="width:50%"/>
								<col style="width:50%"/>
							</colgroup>
							<thead>
								<tr>
									<td>항목</td>
									<td>40평 이상</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>가맹비</td>
									<td>500만원<span>(부가세별도)</span></td>
								</tr>
								<tr>
									<td>교육비</td>
									<td>500만원<span>(부가세별도)</span></td>
								</tr>
								<tr>
									<td>계약이행보증금</td>
									<td>200만원</td>
								</tr>
								<tr>
									<td>합계</td>
									<td><em>1200만원</em></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="right">
					<div class="area_table">					
						<div class="cost_title">개설비용</div>
						<table class="table">
							<caption>개설비용</caption>
							<colgroup>
								<col style="width:50%"/>
								<col style="width:50%"/>
							</colgroup>
							<thead>
								<tr>
									<td>항목</td>
									<td>40평 이상</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>인테리어</td>
									<td rowspan="8"><em>상담후 결정</em></td>
								</tr>
								<tr>
									<td>주방설비</td>
								</tr>
								<tr>
									<td>간판,사인물</td>
								</tr>
								<tr>
									<td>주방기기</td>
								</tr>
								<tr>
									<td>가구</td>
								</tr>
								<tr>
									<td>포스장비</td>
								</tr>
								<tr>
									<td>홍보물</td>
								</tr>
								<tr>
									<td>메뉴얼비용</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="area_info">
				<div class="cost_title">별도공사</div>	
				<div class="cost_box">
					<div class="left">
						<p>냉난방기구입 · 가스가설공사 · 전기승압 및 분전함 철거공사 · 식기세척기 · 인조대리석 · 단기보험공사어닝 · 공조(외부연장)공사 · 휴게공간(창고) · 샤시공사 · 화장실공사 · 외부난간공사 · CCTV · TV설치</p>
					</div>
					<div class="right">
						<ul>
							<li>※ 오픈 시 초도물량(식자재 등) 비용은 약 350만원입니다.</li>
							<li>※ 지방의 경우 추가적인 경비가 발생할 수 있습니다.</li>
							<li>※ 위 사항은 점포에 따라 변동될 수 있습니다.</li>
							<li>※ 건물 높이 3.5M 이상의 점포시 추가공사 비용 발생 </li>
							<li>※ VAT 별도입니다.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--section id="sns">
	<div class="inr">
		<div class="title">
			<h2>진송추어탕 SNS</h2>
		</div>	
		<ul class="area_sns">
			<li>
				<a href="https://blog.naver.com/qorrkfka5" target="_blank">
					<div class="area_icon"></div>
					<h3>네이버 블로그 <Br>바로가기</h3>
				</a>
			</li>
			<li>
				<a href="https://www.instagram.com/jinsong_0882" target="_blank">	
					<div class="area_icon"></div>
					<h3>인스타그램 <Br>바로가기</h3>
				</a>
			</li>
		</ul>
	</div>		
</section-->

<section id="media">
	<div class="inr">
		<div class="title">
			<h2>언론보도</h2>
		</div>	
		<div class="area_photo">	
			<?php echo latest("theme/gallery3", "media",10, 15); ?>
		</div>
		<?php
			if($member[mb_level]=="10"){?>
			<a href="<?=G5_BBS_URL?>/write.php?bo_table=media" class="btn btn-primary board">등록하기</a>
		<?php }?>
	</div>		
</section>

<section id="inquiry">
	<div class="title">
		<h2>SMS 상담</h2>
		<span>빠르고 간편하게 상담받으실 수 있는 서비스입니다.</span>
	</div>	
	<div class="cs_inquiry">
		<!--div class="cs"><a href="tel:080-000-1995"><span>창업문의 080-000-1995</span></a></div-->
		<div class="cs center"><a href="tel:080-000-1995"><span>가맹문의·고객센터 080-000-1995</a></span></div>
		<p>평일 09:00 ~ 18:00 / 토요일 09:00 ~ 13:00 <br>일요일/공휴일은 휴무입니다.</p>
	</div>

		

	<form name="form" action="<?php echo G5_BBS_URL?>/write_update.php" method="POST" id="online_form" onsubmit="return checkValue()">
	<div class="area_inquiry">	
		<div class="area_form">
			<i></i>
			<i></i>
			<i></i>
			<i></i>
			
				<input type="hidden" name="bo_table" value="request">
				<input type="hidden" name="w" value="">
				<fieldset>								
					<ul class="list_input">
						<li>
							<label for="name">이름</label>
							<input type="text" title="이름" name="wr_name" placeholder="이름" required/>
						</li>
						<li>
							<label for="phone">연락처</label>
							<input type="text" title="연락처" name="wr_subject" placeholder="연락처" required/>
						</li>
						<li>
							<label for="variable">내용</label>
							<textarea class="inputFull" name="wr_content" placeholder="내용" title="내용" required></textarea>
						</li>	
					</ul>
				</fieldset>
			<?php if ($is_guest) { //자동등록방지  ?>
    
            
                <?php echo $captcha_html ?>
            
			 <?php } ?>
		</div>
		<div class="area_bottom">
			<div>
				<input type="checkbox" id="check" name="check">
				<label for="check"><span></span><em>개인정보의 수집 및 이용에 동의합니다.</em></label>
			</div>
			<input class="inputFull" type="submit" value="문의하기" id="online_btn">

			<?php
			if($member[mb_level]=="10"){?>
			<a href="<?=G5_BBS_URL?>/board.php?bo_table=request" class="btn btn-primary" style="color:#fff;width:100%;margin-top:10px;padding:15px;font-size:20px">목록보기</a>
		<?php }?>
		</div>
		<script type="text/javascript">
			function checkValue(){
				var f= document.form;
				if(!$("#check").prop("checked")){
					alert("개인정보 수집 이용약관에 동의하셔야 합니다.");
					return false;
				}
				<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
			}
		</script>
		</form>
	</div>
</section>


<?php
include_once(G5_PATH.'/tail.php');
?>