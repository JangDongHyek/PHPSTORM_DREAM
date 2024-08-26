<?php
$sub_id = "message";
include_once('./_common.php');
$g5['title'] = '문의하기';
include_once('./_head.php');
?>


<div id="MessageBoxWrap">
	<div class="msgList">
		<div class="ListSearch">
			<div class="blockBox" >
				<div>
					<label for="sch_state" class="sound_only">검색창</label>
					<select name="" id="sch_state">
						<option value="0">닉네임</option>
						<option value="0">재능명</option>
					</select>
				</div>
				<div>
					<label class="sound_only">검색</label>
					<input type="text" placeholder="검색어를 입력하세요.">
					<button>검색</button>
				</div>

			</div>
			
		</div>
		<div class="scrollBox">

			<div class="inbox on"><!-- 안읽음 시 class명 'on' 추가 -->
				<p class="img">
					  <img class="p_img" src="http://jobgo.ac/theme/basic/img/sub/default.png" title="">
				</p>
				<p class="txt">
					<span class="ment"><b>관련내용이 나옵니다</b><b>06.28</b></span>
					<span class="name">아이디</span>
					<span class="cont">내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용</span> <!-- 마지막 채팅 시간 -->
				</p>
			</div>
			<div class="inbox">
				<span class="onnum">1</span><!-- 안읽은 채팅 추가 -->
				<p class="img">
					  <img class="p_img" src="http://jobgo.ac/theme/basic/img/sub/default.png" title="">
				</p>
				<p class="txt">
					<span class="ment"><b>관련내용이 나옵니다</b><b>06.28</b></span>
					<span class="name">아이디</span>
					<span class="cont">내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용</span> <!-- 마지막 채팅 시간 -->
				</p>

			</div>

		</div>
		<!-- /scrollBox -->
	</div>

	<div class="unMsgBox"><!-- 클릭안되는 페이지 div -->
		<p>멘트 필요하면 넣으실 수 있습니다.</p>
	</div> 
	<!-- /unMsgBox -->

	<div class="msgCont">
		<div class="msgConts">

			<!-- 메세지내용  -->
			<div class="msgBox">
				<p class="warning">
					잡고를 통하지 않고 전문가에게 직접 결제하는 경우<br/>서비스 불이행 / 환불 거부 / 연락두절 등의 문제가 발생할 수 있습니다.
				</p>
				<div class="today">2021년 6월 23일 수요일</div>	
				<div class="my-msg">
					<p class="nm">이름</p>
					<div class="date">오후 12:14</div>
					<div class="msg">안녕하세요</div>
				</div>
				<div class="you-msg">
					<p class="nm">이름</p>
					<div class="msg">문의드립니다. 문의드립니다 문의드립니다  문의드립니다 문의드립니다  문의드립니다문의드립니다 문의드립니다 문의드립니다 </div>
					<div class="date">오후 12:16</div>
				</div>
			
			<div class="you-msg">
					<p class="nm">이름</p>
					<div class="msg">안녕하세요</div>
					<div class="date">오후 12:16</div>
				</div>
			
			
			</div>


			<!-- 파트너 프로필 -->
			<div class="userBox">
				<div class="profileInfo">
					<p class="titleTextBoxDesign">합격률 높은 사업 계획 컨설팅을 하세요.</p><!-- 텍스트 타이틀 추가 위치 옮겨도 css 먹혀요 -->
					<p class="img"><img src="http://jobgo.ac/theme/basic/img/sub/default.png" alt=""></p>
					<p class="name">이름</p>
				</div>
				
				<div class="partnerInfo">
					<div><h5>만족도</h5><span>98%</span></div>
					<div><h5>회원구분</h5><span>개인회원</span></div>
					<div><h5>연락가능시간</h5><span>9시 - 20시</span></div>
					<div><h5>평균응단시간</h5><span>1시간이내</span></div>
				</div>
				<div class="partnerHis">
					<h4><a href="#">구매했던 서비스 <span>1건</span></a></h4>
				</div>
				<div class="partnerServ">
					<h4>전문가 서비스</h4>
					<ul class="serviceList">
						<li>
							<a href="#">
								<div><img src="<?php echo G5_THEME_IMG_URL ?>/common/msg_test.jpg" alt="서비스" ></div>
								<div class="txt">
									<p class="tit">합격률 높은 사업 계획서로 컨설팅을 하세요</p>
									<p class="pri">35,000원</p>
								</div>
							</a>
						</li>

						<li>
							<a href="#">
								<div><img src="<?php echo G5_THEME_IMG_URL ?>/common/msg_test.jpg" alt="서비스" ></div>
								<div class="txt">
									<p class="tit">합격률 높은 사업 계획서로 컨설팅을 하세요</p>
									<p class="pri">35,000원</p>
								</div>
							</a>
						</li>

						<li>
							<a href="#">
								<div><img src="<?php echo G5_THEME_IMG_URL ?>/common/msg_test.jpg" alt="서비스" ></div>
								<div class="txt">
									<p class="tit">합격률 높은 사업 계획서로 컨설팅을 하세요</p>
									<p class="pri">35,000원</p>
								</div>
							</a>
						</li>

						<li>
							<a href="#">
								<div><img src="<?php echo G5_THEME_IMG_URL ?>/common/msg_test.jpg" alt="서비스" ></div>
								<div class="txt">
									<p class="tit">합격률 높은 사업 계획서로 컨설팅을 하세요</p>
									<p class="pri">35,000원</p>
								</div>
							</a>
						</li>

					</ul>
				</div>

				
			</div>
		</div>
		<div class="msgTxt">
			<div class="textareaBox">
				<label for="" class="sound_only">메시지 입력창</label>
				<textarea name="" id="" cols="30" rows="1" placeholder="메시지를 입력하세요."></textarea>
			</div>
			<div class="btnBox">
				<button class="btn" id="btn-file" type="button">파일첨부</button>
				<span class="txtSend">
					<button class="btn" id="" type="button">전송</button>
				</span>
			</div>
		</div>
	</div>
	<!-- /msgCont -->
	
</div>
<!-- /MessageBoxWrap -->


<script>
$(document).ready(function() {

	$(".btnSchBox .img").click(function() {
		$(".blockBox").toggleClass("on");	
		$(this).toggleClass("on");	
	});

});

</script>

<?php
include_once('./_tail.php');
?>