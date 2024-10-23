<?php if ($footer_type == 0) { ?>
	</div><!--wrapper-->
<?php } else  { ?>
	</div><!--wrapper-->
	</div><!--container-->
<?php } ?>

<?php
//  공지사항
$CI =& get_instance();
$CI->load->model('BoardModel');
$noticeData = $CI->BoardModel->getBoardList(array('page'=>1,'cate'=>'notice'));

?>
<div id="contact">
	<div class="inr">
		<div class="area_cus">
			<h5>에스티메디 고객센터</h5>
			<div class="call">
				<p> 051-715-1730</p>
				<span>상담시간 : 평일 10:00 ~ 17:00 / 점심시간 : 12:00 ~ 13:00
                        <strong>토요일 일요일 공휴일 휴무</strong></span>
			</div>
			<div class="btn_wrap">
				<a href="<?=PROJECT_URL?>/board?cate=faq">FAQ 자주 묻는 질문</a>
				<a href="<?=PROJECT_URL?>/board?cate=qna">고객문의 게시판</a>
			</div>
		</div>
		<div class="area_bank">
			<h5>입금 정보</h5>
			<div class="bank">
				<p> NH농협 301-0340-3603-71</p>
				<span>예금주 : (주)에스티메디</span>
			</div>
			<p class="info">빠르고 정확한 입금확인을 위해 주문시,<br>
				작성하신 주문자명으로 입금하여 주시기 바랍니다.</p>
		</div>
		<div class="area_latest">
			<h5>공지사항</h5>
			<ul>
				<?if(count($noticeData['listData']) == 0) {?>
				<li>등록된 공지가 없습니다.</li>
				<?
				}else{
					foreach ($noticeData['listData'] AS $list) {
				?>
				<li>
					<p><a href="<?=PROJECT_URL?>/board/<?=$list['idx']?>?cate=notice"><?=$list['title']?></a></p>
					<span><?=replaceDateFormat($list['reg_date'])?></span>
				</li>
				<?}}?>
			</ul>
		</div>
	</div>
</div>

<footer id="footer">
	<div id="ft_wrapper">
		<div class="area_top flex js">
			<div class="ft_menu">
				<a href="<?=PROJECT_URL?>/guide">이용안내</a>
				<a href="<?=PROJECT_URL?>/privacy"><strong class="txt_blue">개인정보취급(처리)방침</strong></a>
				<a href="<?=PROJECT_URL?>/provision">서비스 이용약관</a>
				<a href="<?=PROJECT_URL?>/adm/member">관리자</a>
				<a href="<?=PROJECT_URL?>/agency">에이전시</a>
			</div>
			<div class="ft_sns">
				<a href="javascript:alert('서비스 오픈 예정이에요!')"><img src="<?=ASSETS_URL?>/img/common/sns1.png" alt="네이버"></a>
				<a href="javascript:alert('서비스 오픈 예정이에요!')"><img src="<?=ASSETS_URL?>/img/common/sns2.png" alt="카카오스토리"></a>
				<a href="javascript:alert('서비스 오픈 예정이에요!')"><img src="<?=ASSETS_URL?>/img/common/sns3.png" alt="인스타그램"></a>
			</div>
		</div>
		<div class="area_bottom">
			<address>
				<ul>
					<li><strong>상호 :</strong> 주식회사 에스티메디</li>
					<li><strong>대표 :</strong> 오석환</li>
					<li><strong>사업자등록번호 :</strong> 631-87-02972</li>
					<!--li><strong>통신판매 신고번호 :</strong> </li>-->
					<li><strong>주소 :</strong> 부산광역시 동래구 온천장로 114-12, 502호(온천동, 쿤스트하우스)</li>
					<li><strong>고객센터 :</strong> 051-715-1730</li>
					<li><strong>팩스 :</strong> 051-715-1731</li>
					<li><strong>개인정보관리자 :</strong> 오석환</li>
					<li><strong>개인정보책임관리 E-mail :</strong> stmedi1@naver.com</li>
				</ul>
			</address>
			<p class="copy">COPYRIGHT(C) <?=date('Y')?> STmedi. ALL RIGHTS RESERVED.</p>
		</div>
	</div>
</footer>

<?php include_once VIEWPATH. '_common/side_navigator.php'; // 해쉬메뉴 ?>


<?php include_once VIEWPATH. '_common/modal.php'; // 모달 ?>

<script>
    <?php if($_GET['first02']=='true'){ ?>
    $(document).ready(function(){
        fncChked();
        var offset = $("#first02").offset(); //해당 위치 반환
        $("html, body").animate({scrollTop: offset.top},400); // 선택한 위치로 이동. 두번째 인자는 0.4초를 의미한다.
    });
    <?php } ?>
	function fncChked(){
		const div = document.querySelector('#first02');
		const fix = document.querySelector('#fixed');
		if (div.classList.contains('off')) {
			div.classList.remove('off');
			fix.style.display = "block"
		} else {
			div.classList.remove('off');
			fix.style.display = "block"
		}
	}
</script>

</body>
</html>
