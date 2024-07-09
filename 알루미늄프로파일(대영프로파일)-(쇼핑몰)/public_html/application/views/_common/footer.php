</div>
</div><!--container-->
</div><!--wrapper-->

<?php if ($footer_type == 0) { ?>
<?php } else  { ?>
<?php } ?>

<?php
// 한약재몰 공지사항
$CI =& get_instance();
$CI->load->model('BoardModel');
$noticeData = $CI->BoardModel->getBoardList(array('page'=>1,'cate'=>'notice'));

?>

<footer id="footer">
	<div id="ft_wrapper">
		<div class="area_top flex js">
			<div class="ft_menu">
				<a href="<?=PROJECT_URL?>/greet">회사소개</a>
<!--				<a href="<?=PROJECT_URL?>/guide">이용안내</a>-->
				<a href="<?=PROJECT_URL?>/privacy">개인정보취급(처리)방침</a>
				<a href="<?=PROJECT_URL?>/provision">서비스 이용약관</a>
			</div>
            <div class="area_latest">
                <h5>공지사항</h5>
                <ul>
                    <?if(count($noticeData['listData']) == 0) {?>
                    <li class="nodata">등록된 공지가 없습니다.</li>
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
		<div class="area_bottom">
           <div class="adr">
			<address>
				<ul>
					<li><strong>상호 :</strong> 알루미늄프로파일</li>
					<li><strong>주소 :</strong> 경기도 김포시 통진읍 김포대로 2003-27</li><br>
					<li><strong>대표 :</strong> 이한수</li>
					<li><strong>사업자등록번호 :</strong> 137-81-46971</li><br>
					<li><strong>통신판매 신고번호 :</strong> -</li><br>
					<li><strong>고객센터 :</strong> 031-988-4747</li>
					<li><strong>팩스 :</strong> 031-989-5385</li><br>
					<li><strong>E-mail :</strong> dyp6060@naver.com</li>
				</ul>
			</address>
            <p class="copy">COPYRIGHT(C)2024. dyprofile CO.,LTD. ALL RIGHTS RESERCED.</p>
            </div>
            <div id="contact">
                    <div class="area_bank">
                        <h5>입금계좌</h5>
                        <div class="bank">
                            <p>123456-12-123456</p>
                            <span>국민은행 알루미늄프로파일</span>
                        </div>
                    </div>
                    <div class="area_cus">
                        <h5>고객센터</h5>
                        <div class="call">
                            <p>031-988-4747</p>
                            <span>상담시간 : 평일 09:00 ~ 16:30
                            <strong>주말,공휴일 휴무</strong></span>
                        </div>
                    </div>
            </div>
		</div>
	</div>
</footer>

<?php include_once VIEWPATH. '_common/side_navigator.php'; // 해쉬메뉴 ?>


<?php include_once VIEWPATH. '_common/modal.php'; // 모달 ?>


</body>
</html>
